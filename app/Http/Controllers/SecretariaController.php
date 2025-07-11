<?php

namespace App\Http\Controllers;

use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecretariaController extends Controller
{
    public function index(){
        $secretarias = Secretaria::with('user')->get();
        return view('admin.secretarias.index', compact('secretarias'));
    }

    public function create(){
        return view('admin.secretarias.create');
    }

    public function store(Request $request){
        $request->validate([
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'dni' => 'required|max:20|unique:secretarias',
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

        $secretaria = new Secretaria();
        $secretaria->user_id = $usuario->id;
        $secretaria->nombres = $request->nombres;
        $secretaria->apellidos = $request->apellidos;
        $secretaria->dni = $request->dni;
        $secretaria->celular = $request->celular;
        $secretaria->fecha_nacimiento = $request->fecha_nacimiento;
        $secretaria->direccion = $request->direccion;
        $secretaria->save();

        $usuario->assignRole('secretaria');

        return redirect()->route('admin.secretarias.index')
            ->with('mensaje','Se registró la secretaria correctamente')
            ->with('icons','success');
    }

    public function show($id){
        $secretaria = Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.show', compact ('secretaria'));
    }

    public function edit($id){
        $secretaria = Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.edit', compact ('secretaria'));
    }

    public function update(Request $request, $id){
        $secretaria = Secretaria::find($id);

        $request->validate([
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'dni' => 'required|max:20|unique:secretarias,dni,'.$secretaria->id,
            'celular' => 'required|max:20',
            'fecha_nacimiento' => 'required',
            'direccion' => 'required|max:250',
            'email' => 'required|max:250|unique:users,email,'.$secretaria->user->id,
            'password' => 'nullable|max:250|confirmed',
        ], [
            'nombres.required' => 'El nombre es obligatorio',
            'apellidos.required' => 'El apellido es obligatorio',
            'dni.required' => 'El DNI es obligatorio',
            'dni.unique' => 'Este DNI ya está registrado',
            'celular.required' => 'El número celular es obligatorio',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatorio',
            'direccion.required' => 'La dirección de domicilio es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.unique' => 'Este correo ya está registrado',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        $secretaria->nombres = $request->nombres;
        $secretaria->apellidos = $request->apellidos;
        $secretaria->dni = $request->dni;
        $secretaria->celular = $request->celular;
        $secretaria->fecha_nacimiento = $request->fecha_nacimiento;
        $secretaria->direccion = $request->direccion;
        $secretaria->save();

        $usuario = User::find($secretaria->user->id);

        $usuario->name = $request->nombres.' '.$request->apellidos;
        $usuario->email = $request->email;

        if($request->filled('password')){
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        return redirect()->route('admin.secretarias.index')
            ->with('mensaje','Se actualizó a la secretaria correctamente')
            ->with('icons','success');
    }

    public function confirmDelete($id){
        $secretaria = Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.delete', compact ('secretaria'));
    }

    public function destroy($id){
        $secretaria = Secretaria::find($id);
        
        //eliminar al usuario asociado
        $usuario = $secretaria->user;
        $usuario->delete();

        
        //eliminar a la secretaria
        $secretaria->delete();

        return redirect()->route('admin.secretarias.index')
            ->with('mensaje','Se eliminó a la secretaria correctamente')
            ->with('icons','success');
    }
}
