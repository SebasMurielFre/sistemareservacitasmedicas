<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index(){
        $doctores = Doctor::with('user')->get();
        return view('admin.doctores.index', compact('doctores'));
    }

    public function create(){
        return view('admin.doctores.create');
    }

    public function store(Request $request){
        $request->validate([
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'dni' => 'required|max:20|unique:doctors',
            'licencia_medica' => 'required|max:20|unique:doctors',
            'especialidad' => 'required|max:100',
            'celular' => 'required|max:20',
            'fecha_nacimiento' => 'required',
            'direccion' => 'required|max:250',
            'email' => 'required|max:250|unique:users',
            'password' => 'required|max:250|confirmed',
        ], [
            'nombres.required' => 'El nombre es obligatorio',
            'apellidos.required' => 'El apellido es obligatorio',
            'dni.required' => 'El DNI es obligatorio',
            'dni.unique' => 'Este DNI ya está registrado',
            'licencia_medica.required' => 'La licencia médica es obligatorio',
            'licencia_medica.unique' => 'Esta licencia médica ya está registrado',
            'especialidad.required' => 'La especialidad es obligatorio',
            'celular.required' => 'El número celular es obligatorio',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatorio',
            'direccion.required' => 'La dirección de domicilio es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.unique' => 'Este correo ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres.' '.$request->apellidos;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        $doctor = new Doctor();
        $doctor->user_id = $usuario->id;
        $doctor->nombres = $request->nombres;
        $doctor->apellidos = $request->apellidos;
        $doctor->dni = $request->dni;
        $doctor->licencia_medica = $request->licencia_medica;
        $doctor->especialidad = $request->especialidad;
        $doctor->celular = $request->celular;
        $doctor->fecha_nacimiento = $request->fecha_nacimiento;
        $doctor->direccion = $request->direccion;
        $doctor->save();

        return redirect()->route('admin.doctores.index')
            ->with('mensaje','Se registró al doctor correctamente')
            ->with('icons','success');

    }

    public function show($id){
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('admin.doctores.show', compact ('doctor'));
    }

    public function edit($id){
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('admin.doctores.edit', compact ('doctor'));
    }

    public function update(Request $request, $id){
        $doctor = Doctor::find($id);

        $request->validate([
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'dni' => 'required|max:20|unique:doctors,dni,'.$doctor->id,
            'licencia_medica' => 'required|max:20|unique:doctors,dni,'.$doctor->id,
            'especialidad' => 'required|max:100',
            'celular' => 'required|max:20',
            'fecha_nacimiento' => 'required',
            'direccion' => 'required|max:250',
            'email' => 'required|max:250|unique:users,email,'.$doctor->user->id,
            'password' => 'nullable|max:250|confirmed',
        ], [
            'nombres.required' => 'El nombre es obligatorio',
            'apellidos.required' => 'El apellido es obligatorio',
            'dni.required' => 'El DNI es obligatorio',
            'dni.unique' => 'Este DNI ya está registrado',
            'licencia_medica.required' => 'La licencia médica es obligatorio',
            'licencia_medica.unique' => 'Esta licencia médica ya está registrado',
            'especialidad.required' => 'La especialidad es obligatorio',
            'celular.required' => 'El número celular es obligatorio',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatorio',
            'direccion.required' => 'La dirección de domicilio es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.unique' => 'Este correo ya está registrado',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        $doctor->nombres = $request->nombres;
        $doctor->apellidos = $request->apellidos;
        $doctor->dni = $request->dni;
        $doctor->licencia_medica = $request->licencia_medica;
        $doctor->especialidad = $request->especialidad;
        $doctor->celular = $request->celular;
        $doctor->fecha_nacimiento = $request->fecha_nacimiento;
        $doctor->direccion = $request->direccion;
        $doctor->save();

        $usuario = User::find($doctor->user->id);

        $usuario->name = $request->nombres.' '.$request->apellidos;
        $usuario->email = $request->email;

        if($request->filled('password')){
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        return redirect()->route('admin.doctores.index')
            ->with('mensaje','Se actualizó al doctor correctamente')
            ->with('icons','success');
    }

    public function confirmDelete($id){
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('admin.doctores.delete', compact ('doctor'));
    }

    public function destroy($id){
        $doctor = Doctor::find($id);
        
        //eliminar al usuario asociado
        $usuario = $doctor->user;
        $usuario->delete();

        
        //eliminar a la secretaria
        $doctor->delete();

        return redirect()->route('admin.doctores.index')
            ->with('mensaje','Se eliminó al doctor correctamente')
            ->with('icons','success');
    }
}
