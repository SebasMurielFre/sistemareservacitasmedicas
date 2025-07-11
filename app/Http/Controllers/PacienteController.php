<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index(){
        $pacientes = Paciente::all();
        return view('admin.pacientes.index', compact('pacientes'));
    }

    public function create(){
        return view('admin.pacientes.create');
    }

    public function store(Request $request){
        $request->validate([
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'dni' => 'required|max:20|unique:pacientes',
            'fecha_nacimiento' => 'required',
            'genero' => 'required|max:20|in:Masculino,Femenino',
            'estado_civil' => 'required|max:20|in:Soltero,Casado,Unión de hecho,Divorciado,Viudo',
            'celular' => 'required|max:20',
            'email' => 'required|max:100|unique:pacientes',
            'direccion' => 'required|max:250',
            'grupo_sanguineo' => 'required|max:5|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'contacto_emergencia' => 'required|max:20',
            'enfermedades' => 'nullable',
            'alergias' => 'nullable',
            'antecedentes' => 'nullable',
            'observaciones' => 'nullable',
        ], [
            'nombres.required' => 'El nombre es obligatorio',
            'apellidos.required' => 'El apellido es obligatorio',
            'dni.required' => 'El DNI es obligatorio',
            'dni.unique' => 'Este DNI ya está registrado',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatorio',
            'genero.required' => 'El género es obligatorio',
            'genero.in' => 'El género seleccionado no es válido',
            'estado_civil.required' => 'El estado civil es obligatorio',
            'estado_civil.in' => 'El estado civil seleccionado no es válido',
            'celular.required' => 'El número celular es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.unique' => 'Este correo ya está registrado',
            'direccion.required' => 'La dirección de domicilio es obligatorio',
            'grupo_sanguineo.required' => 'El grupo sanguíneo es obligatorio',
            'grupo_sanguineo.in' => 'El grupo sanguíneo seleccionado no es válido',
            'contacto_emergencia.required' => 'El contacto de emergencia es obligatorio',
        ]);

        $paciente = new Paciente();
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->dni = $request->dni;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero = $request->genero;
        $paciente->estado_civil = $request->estado_civil;
        $paciente->celular = $request->celular;
        $paciente->email = $request->email;
        $paciente->direccion = $request->direccion;
        $paciente->grupo_sanguineo = $request->grupo_sanguineo;
        $paciente->contacto_emergencia = $request->contacto_emergencia;
        $paciente->enfermedades = $request->enfermedades;
        $paciente->alergias = $request->alergias;
        $paciente->antecedentes = $request->antecedentes;
        $paciente->observaciones = $request->observaciones;
        $paciente->save();

        return redirect()->route('admin.pacientes.index')
            ->with('mensaje','Se registró al paciente correctamente')
            ->with('icons','success');
    }

    public function show($id){
        $paciente = Paciente::findOrFail($id);
        return view('admin.pacientes.show', compact ('paciente'));
    }

    public function edit($id){
        $paciente = Paciente::findOrFail($id);
        return view('admin.pacientes.edit', compact ('paciente'));
    }

    public function update(Request $request, $id){
        $paciente = Paciente::find($id);

        $request->validate([
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'dni' => 'required|max:20|unique:pacientes,dni,'.$paciente->id,
            'fecha_nacimiento' => 'required',
            'genero' => 'required|max:20|in:Masculino,Femenino',
            'estado_civil' => 'required|max:20|in:Soltero,Casado,Unión de hecho,Divorciado,Viudo',
            'celular' => 'required|max:20',
            'email' => 'required|max:100|unique:pacientes,email,'.$paciente->id,
            'direccion' => 'required|max:250',
            'grupo_sanguineo' => 'required|max:5|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'contacto_emergencia' => 'required|max:20',
            'enfermedades' => 'nullable',
            'alergias' => 'nullable',
            'antecedentes' => 'nullable',
            'observaciones' => 'nullable',
        ], [
            'nombres.required' => 'El nombre es obligatorio',
            'apellidos.required' => 'El apellido es obligatorio',
            'dni.required' => 'El DNI es obligatorio',
            'dni.unique' => 'Este DNI ya está registrado',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatorio',
            'genero.required' => 'El género es obligatorio',
            'genero.in' => 'El género seleccionado no es válido',
            'estado_civil.required' => 'El estado civil es obligatorio',
            'estado_civil.in' => 'El estado civil seleccionado no es válido',
            'celular.required' => 'El número celular es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.unique' => 'Este correo ya está registrado',
            'direccion.required' => 'La dirección de domicilio es obligatorio',
            'grupo_sanguineo.required' => 'El grupo sanguíneo es obligatorio',
            'grupo_sanguineo.in' => 'El grupo sanguíneo seleccionado no es válido',
            'contacto_emergencia.required' => 'El contacto de emergencia es obligatorio',
        ]);

        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->dni = $request->dni;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero = $request->genero;
        $paciente->estado_civil = $request->estado_civil;
        $paciente->celular = $request->celular;
        $paciente->email = $request->email;
        $paciente->direccion = $request->direccion;
        $paciente->grupo_sanguineo = $request->grupo_sanguineo;
        $paciente->contacto_emergencia = $request->contacto_emergencia;
        $paciente->enfermedades = $request->enfermedades;
        $paciente->alergias = $request->alergias;
        $paciente->antecedentes = $request->antecedentes;
        $paciente->observaciones = $request->observaciones;
        $paciente->save();

        return redirect()->route('admin.pacientes.index')
            ->with('mensaje','Se actualizó al paciente correctamente')
            ->with('icons','success');
    }

    public function confirmDelete($id){
        $paciente = Paciente::findOrFail($id);
        return view('admin.pacientes.delete', compact ('paciente'));
    }

    public function destroy($id){
        $paciente = Paciente::find($id);
        $paciente->delete();
        return redirect()->route('admin.pacientes.index')
            ->with('mensaje','Se eliminó al paciente correctamente')
            ->with('icons','success');
    }
}
