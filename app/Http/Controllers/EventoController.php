<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Evento;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        try {
            $request->validate([
                'doctor_id' => 'required',
                'fecha_cita' => 'required|date|after_or_equal:today',
                'hora_cita' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        if (Carbon::parse($request->fecha_cita)->isToday() && 
                            Carbon::parse($value)->lt(now()->format('H:i'))) {
                            $fail('La hora debe ser posterior a la hora actual para citas hoy');
                        }
                    }
                ]
            ], [
                'doctor_id.required' => 'El doctor es obligatorio',
                'fecha_cita.required' => 'La fecha de cita es obligatoria',
                'fecha_cita.after_or_equal' => 'La fecha no puede ser anterior a hoy',
                'hora_cita.required' => 'La hora de cita es obligatoria'
            ]);
        } catch (ValidationException $e) {
            // Si es una petición AJAX, devolver errores JSON
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors()
                ], 422);
            }
            
            // Si no es AJAX, comportamiento normal de Laravel
            throw $e;
        }

        try {
            $doctor = Doctor::findOrFail($request->doctor_id);

            $fechaHoraInicio = Carbon::parse($request->fecha_cita . " " . $request->hora_cita);
            $fechaHoraFin = $fechaHoraInicio->copy()->addHour();
            
            $evento = new Evento();
            $evento->title = $request->hora_cita . " - " . $doctor->especialidad;
            $evento->start =  $fechaHoraInicio->format('Y-m-d H:i:s');
            $evento->end = $fechaHoraFin->format('Y-m-d H:i:s');
            $evento->user_id = Auth::user()->id;
            $evento->doctor_id = $request->doctor_id;
            $evento->save();

            // Si es una petición AJAX, devolver JSON con datos para SweetAlert
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Se registró la cita correctamente',
                    'icon' => 'success',
                    'showSweetAlert' => true
                ]);
            }

            return redirect()->route('admin.index')
                ->with('mensaje', 'Se registró la cita correctamente')
                ->with('icono', 'success');

        } catch (\Exception $e) {
            // Si es una petición AJAX, devolver error JSON
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al registrar la cita',
                    'icon' => 'error',
                    'showSweetAlert' => true
                ], 500);
            }

            return redirect()->back()
                ->with('mensaje', 'Error al registrar la cita')
                ->with('icono', 'error');
        }
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
