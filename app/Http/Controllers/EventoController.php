<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Evento;
use App\Models\Horario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function index(){
        //
    }

    public function create(){
        //
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'fecha_cita' => 'required|date|after_or_equal:today',
            'hora_cita' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if (Carbon::parse($request->fecha_cita)->isToday() && 
                        Carbon::parse($value)->lt(now()->format('H:i'))) {
                        $fail('La hora debe ser posterior a la hora actual para agendar citas para hoy');
                    }
                }
            ]
        ], [
            'doctor_id.required' => 'El doctor es obligatorio',
            'fecha_cita.required' => 'La fecha de cita es obligatoria',
            'fecha_cita.after_or_equal' => 'La fecha no puede ser anterior a hoy',
            'hora_cita.required' => 'La hora de cita es obligatoria'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $doctor = Doctor::find($request->doctor_id);
        $fechaCita = $request->fecha_cita;
        $horaCita = $request->hora_cita;
        $diaEspanol = ucfirst(Carbon::parse($fechaCita)->isoFormat('dddd'));

        $horariosDias = Horario::where('doctor_id', $doctor->id)
            ->where('dia', $diaEspanol)
            ->exists();

        if(!$horariosDias){
            return redirect()->back()->with([
                'mensaje' => 'El doctor no esta disponible el día '. $fechaCita,
                'icons' => 'error',
                'fecha_cita' => 'El doctor no esta disponible el día '. $fechaCita,
            ]);
        }

        $horarios = Horario::where('doctor_id', $doctor->id)
            ->where('dia', $diaEspanol)
            ->where('hora_inicio', '<=', $horaCita)
            ->where('hora_fin', '>', $horaCita)
            ->exists();

        if(!$horarios){
            return redirect()->back()->with([
                'mensaje' => 'El doctor no esta disponible en ese horario',
                'icons' => 'error',
                'hora_cita' => 'El doctor no esta disponible en ese horario',
            ]);
        }

        $fechaHoraInicio = Carbon::parse($request->fecha_cita . " " . $request->hora_cita);

        $eventosUsuarioDuplicados = Evento::where('user_id', Auth::user()->id)
            ->where('start', $fechaHoraInicio)
            ->exists();

        if($eventosUsuarioDuplicados){
            return redirect()->back()->with([
                'mensaje' => 'Ya tienes una cita en ese horario',
                'icons' => 'error',
                'hora_cita' => 'Ya tienes una cita en ese horario',
            ]);
        }

        $eventosDoctorDuplicados = Evento::where('doctor_id', $doctor->id)
            ->where('start', $fechaHoraInicio)
            ->exists();

        if($eventosDoctorDuplicados){
            return redirect()->back()->with([
                'mensaje' => 'Ya hay una cita en ese horario con el doctor',
                'icons' => 'error',
                'hora_cita' => 'Ya hay una cita en ese horario con el doctor',
            ]);
        }
        
        $fechaHoraFin = $fechaHoraInicio->copy()->addHour();
            
        $evento = new Evento();
        $evento->title = $fechaHoraInicio->format('H:i') . " - " . $fechaHoraFin->format('H:i') . " " . $doctor->especialidad;
        $evento->start =  $fechaHoraInicio->format('Y-m-d H:i:s');
        $evento->end = $fechaHoraFin->format('Y-m-d H:i:s');
        $evento->user_id = Auth::user()->id;
        $evento->doctor_id = $request->doctor_id;
        $evento->save();

        return redirect()->route('admin.index')
                ->with('mensaje', 'Se registró la cita correctamente')
                ->with('icons', 'success');

        /*
        $request->validate([
            'doctor_id' => 'required',
            'fecha_cita' => 'required|date|after_or_equal:today',
            'hora_cita' => 'required',
        ], [
            'doctor_id.required' => 'El doctor es obligatorio',
            'fecha_cita.required' => 'La fecha de cita es obligatoria',
            'fecha_cita.after_or_equal' => 'La fecha no puede ser anterior a hoy',
            'hora_cita.required' => 'La hora de cita es obligatoria'
        ]);
        $doctor = Doctor::find($request->doctor_id);
        $fechaCita = $request->fecha_cita;
        $horaCita = $request->hora_cita;
        $diaEspanol = ucfirst(Carbon::parse($fechaCita)->isoFormat('dddd'));

        $horariosDias = Horario::where('doctor_id', $doctor->id)
            ->where('dia', $diaEspanol)
            ->exists();

        if(!$horariosDias){
            return redirect()->back()->with([
                'mensaje' => 'El doctor no esta disponible el día '. $fechaCita,
                'icons' => 'error',
                'fecha_cita' => 'El doctor no esta disponible el día '. $fechaCita,
            ]);
        }

        $horarios = Horario::where('doctor_id', $doctor->id)
            ->where('dia', $diaEspanol)
            ->where('hora_inicio', '<=', $horaCita)
            ->where('hora_fin', '>', $horaCita)
            ->exists();

        if(!$horarios){
            return redirect()->back()->with([
                'mensaje' => 'El doctor no esta disponible en ese horario',
                'icons' => 'error',
                'hora_cita' => 'El doctor no esta disponible en ese horario',
            ]);
        }

        $fechaHoraInicio = Carbon::parse($request->fecha_cita . " " . $request->hora_cita);

        $eventosDoctorDuplicados = Evento::where('doctor_id', $doctor->id)
            ->where('start', $fechaHoraInicio)
            ->exists();

        if($eventosDoctorDuplicados){
            return redirect()->back()->with([
                'mensaje' => 'Ya hay una cita en ese horario con el doctor',
                'icons' => 'error',
                'hora_cita' => 'Ya hay una cita en ese horario con el doctor',
            ]);
        }

        $eventosUsuarioDuplicados = Evento::where('user_id', Auth::user()->id)
            ->where('start', $fechaHoraInicio)
            ->exists();

        if($eventosUsuarioDuplicados){
            return redirect()->back()->with([
                'mensaje' => 'Ya tienes una cita en ese horario',
                'icons' => 'error',
                'hora_cita' => 'Ya tienes una cita en ese horario',
            ]);
        }

        $fechaHoraFin = $fechaHoraInicio->copy()->addHour();
            
        $evento = new Evento();
        $evento->title = $fechaHoraInicio->format('H:i') . " - " . $fechaHoraFin->format('H:i') . " " . $doctor->especialidad;
        $evento->start =  $fechaHoraInicio->format('Y-m-d H:i:s');
        $evento->end = $fechaHoraFin->format('Y-m-d H:i:s');
        $evento->user_id = Auth::user()->id;
        $evento->doctor_id = $request->doctor_id;
        $evento->save();

        return redirect()->route('admin.index')
                ->with('mensaje', 'Se registró la cita correctamente')
                ->with('icons', 'success');
        */
    }

    public function show(Evento $evento){
        //
    }

    public function edit(Evento $evento){
        //
    }

    public function update(Request $request, Evento $evento){
        //
    }

    public function destroy(Evento $evento){
        //
    }
}
