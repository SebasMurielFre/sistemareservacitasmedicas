<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use App\Models\Doctor;
use App\Models\Evento;
use App\Models\Horario;
use App\Models\Paciente;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $total_usuarios = User::count();
        $total_secretarias = Secretaria::count();
        $total_pacientes = Paciente::count();
        $total_consultorios = Consultorio::count();
        $total_doctores = Doctor::count();
        $total_horarios = Horario::count();

        $doctores = Doctor::all();

        $doctor_id = request('doctor_id');
        $horarios = Horario::with(['doctor', 'consultorio'])
            ->when($doctor_id, function($query) use ($doctor_id) {
                return $query->where('doctor_id', $doctor_id);
            })
            ->get();

        
        $eventos = Evento::where('user_id', Auth::id())->get();

        return view('admin.index', 
            array_merge(
                compact(
                    'total_usuarios', 
                    'total_secretarias', 
                    'total_pacientes', 
                    'total_consultorios', 
                    'total_doctores',
                    'total_horarios',
                    'horarios',
                    'doctores',
                    'doctor_id',
                    'eventos'
                )
            )
        );
    }
    
    public function horarioPorDoctor(Request $request){
        $doctor_id = $request->input('doctor_id');
        $doctor = $doctor_id ? Doctor::find($doctor_id) : null;
        $horarios = Horario::with(['doctor', 'consultorio'])
            ->when($doctor_id, function($query) use ($doctor_id) {
                return $query->where('doctor_id', $doctor_id);
            })
            ->get();
            
        return view('tabla_horario_doctor_index', [
            'horarios' => $horarios,
            'doctor' => $doctor,
            'doctor_id' => $doctor_id
        ]);
    }
}
