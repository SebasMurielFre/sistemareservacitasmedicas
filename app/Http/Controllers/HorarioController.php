<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use App\Models\Doctor;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index(){
        $horarios = Horario::with('doctor','consultorio')->get();
        return view('admin.horarios.index', compact('horarios'));
    }

    public function horarioPorDoctor(Request $request){
        $doctor_id = $request->doctor_id;
        $horarios = Horario::with('doctor','consultorio')->get();
        return view('admin.horarios.partials.tabla_horario_doctor', compact('horarios', 'doctor_id'))->render();
    }

    public function horarioPorConsultorio(Request $request){
        $consultorio_id = $request->consultorio_id;
        $horarios = Horario::with('doctor','consultorio')->get();
        return view('admin.horarios.partials.tabla_horario_consultorio', compact('horarios', 'consultorio_id'))->render();
    }

    public function create(){
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        $horarios = Horario::with('doctor','consultorio')->get();
        return view('admin.horarios.create', compact('doctores', 'consultorios', 'horarios'));
    }

    public function store(Request $request){
        $request->validate([
            'dia' => 'required|max:100',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'doctor_id' => 'required',
            'consultorio_id' => 'required',
        ], [
            'dia.required' => 'El día es obligatorio',
            'hora_inicio.required' => 'La hora de inicio es obligatoria',
            'hora_fin.required' => 'La hora de finalización es obligatoria',
            'hora_fin.after' => 'La hora de finalización debe ser posterior a la hora de inicio',
            'doctor_id.required' => 'El doctor es obligatorio',
            'consultorio_id.required' => 'El consultorio es obligatorio',
        ]);

        // Verifica si el doctor ya tiene un horario en el mismo día y rango horario
        $conflictoDoctor = Horario::where('doctor_id', $request->doctor_id)
            ->where('dia', $request->dia)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('hora_inicio', '<', $request->hora_fin)
                    ->where('hora_fin', '>', $request->hora_inicio);
                });
            })
            ->exists();

        // Verifica conflictos de consultorio en el mismo día y rango horario
        $conflictoConsultorio = Horario::where('dia', $request->dia)
            ->where('consultorio_id', $request->consultorio_id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('hora_inicio', '<', $request->hora_fin)
                    ->where('hora_fin', '>', $request->hora_inicio);
                });
            })
            ->exists();

        if ($conflictoDoctor){
            return redirect()->back()
                ->withInput()
                ->with('mensaje','El doctor ya tiene un horario asignado en este rango de horas')
                ->with('icons','error');
        }

        if ($conflictoConsultorio){
            return redirect()->back()
                ->withInput()
                ->with('mensaje','El consultorio ya está ocupado en este horario por otro doctor')
                ->with('icons','error');
        }

        Horario::create($request->all());

        return redirect()->route('admin.horarios.index')
            ->with('mensaje','Se registró el horario correctamente')
            ->with('icons','success');
    }

    public function show($id){
        $horario = Horario::with('doctor','consultorio')->findOrFail($id);
        return view('admin.horarios.show', compact ('horario'));
    }

    public function edit($id){
        $horario = Horario::findOrFail($id);
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        $horarios = Horario::with('doctor','consultorio')->get();
        return view('admin.horarios.edit', compact ('doctores', 'consultorios', 'horario', 'horarios'));
    }

    public function update(Request $request, $id){
        $horario = Horario::find($id);

        $request->validate([
            'dia' => 'required|max:100',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'doctor_id' => 'required',
            'consultorio_id' => 'required',
        ], [
            'dia.required' => 'El día es obligatorio',
            'hora_inicio.required' => 'La hora de inicio es obligatoria',
            'hora_fin.required' => 'La hora de finalización es obligatoria',
            'hora_fin.after' => 'La hora de finalización debe ser posterior a la hora de inicio',
            'doctor_id.required' => 'El doctor es obligatorio',
            'consultorio_id.required' => 'El consultorio es obligatorio',
        ]);

        // Verifica si el doctor ya tiene un horario en el mismo día y rango horario
        $conflictoDoctor = Horario::where('doctor_id', $request->doctor_id)
            ->where('dia', $request->dia)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('hora_inicio', '<', $request->hora_fin)
                    ->where('hora_fin', '>', $request->hora_inicio);
                });
            })
            ->exists();

        // Verifica conflictos de consultorio en el mismo día y rango horario
        $conflictoConsultorio = Horario::where('dia', $request->dia)
            ->where('consultorio_id', $request->consultorio_id)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('hora_inicio', '<', $request->hora_fin)
                    ->where('hora_fin', '>', $request->hora_inicio);
                });
            })
            ->exists();

        if ($conflictoDoctor){
            return redirect()->back()
                ->withInput()
                ->with('mensaje','El doctor ya tiene un horario asignado en este rango de horas')
                ->with('icons','error');
        }

        if ($conflictoConsultorio){
            return redirect()->back()
                ->withInput()
                ->with('mensaje','El consultorio ya está ocupado en este horario por otro doctor')
                ->with('icons','error');
        }

        $horario->update($request->all());

        return redirect()->route('admin.horarios.index')
            ->with('mensaje','Se actualizó el horario correctamente')
            ->with('icons','success');
    }

    public function confirmDelete($id){
        $horario = Horario::findOrFail($id);
        return view('admin.horarios.delete', compact ('horario'));
    }

    public function destroy($id){
        $horario = Horario::find($id);
        $horario->delete();
        return redirect()->route('admin.horarios.index')
            ->with('mensaje','Se eliminó al horario correctamente')
            ->with('icons','success');
    }
}
