<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Evento;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index(){
        $horarios = Horario::with('doctor','consultorio')->get();
        return view('index', compact('horarios'));
    }

    public function horarioPorDoctor(Request $request){
        $doctor_id = $request->input('doctor_id');
        $horarios = Horario::with(['doctor', 'consultorio'])
                    ->when($doctor_id, function($query) use ($doctor_id) {
                        return $query->where('doctor_id', $doctor_id);
                    })
                    ->get();

        return view('tabla_horario_doctor', [
            'horarios' => $horarios,
            'doctor_id' => $doctor_id
        ]);
    }

    public function cargarCitasDoctores($id){
        try {
            $eventos = Evento::where('user_id', Auth::user()->id)
                ->where('doctor_id', $id)
                ->get()
                ->map(function ($evento) {
                    // Genera un color basado en el título (para consistencia)
                    $hash = md5($evento->title);
                    $color = '#' . substr($hash, 0, 6);
                    
                    return [
                        'title' => $evento->title,
                        'start' => \Carbon\Carbon::parse($evento->start)->format('Y-m-d'),
                        'end' => \Carbon\Carbon::parse($evento->end)->format('Y-m-d'),
                        'color' => $color
                    ];
                });

            return response()->json($eventos);
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error'], 500);
        }
    }

    public function cargarTodasCitas(){
        try {
            $eventos = Evento::where('user_id', Auth::user()->id)
                ->get()
                ->map(function ($evento) {
                    // Genera un color basado en el título (para consistencia)
                    $hash = md5($evento->doctor_id);
                    $color = '#' . substr($hash, 0, 6);
                    
                    $doctor = Doctor::find($evento->doctor_id);

                    return [
                        'title' => $evento->title. ' - ' .$doctor->nombres. ' ' . $doctor->apellidos,
                        'start' => \Carbon\Carbon::parse($evento->start)->format('Y-m-d'),
                        'end' => \Carbon\Carbon::parse($evento->end)->format('Y-m-d'),
                        'color' => $color
                    ];
                });

            return response()->json($eventos);
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error'], 500);
        }
    }
}
