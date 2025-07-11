<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Horario;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(){
        $horarios = Horario::with('doctor','consultorio')->get();
        return view('index', compact('horarios'));
    }

    public function horarioPorDoctor(Request $request)
{
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
}
