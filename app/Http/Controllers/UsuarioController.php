<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(){
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create(){
        return view('admin.usuarios.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:250',
            'email' => 'required|max:250|unique:users',
            'password' => 'required|max:250|confirmed',
        ], [
            'name.required' => 'El nombre de usuario es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.unique' => 'Este correo ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();
        $usuario->assignRole('usuario');

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje','Se registró el usuario correctamente')
            ->with('icons','success');
    }

    public function show($id){
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.show', compact ('usuario'));
    }

    public function edit($id){
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact ('usuario'));
    }

    public function update(Request $request, $id){
        $usuario = User::find($id);

        $request->validate([
            'name' => 'required|max:250',
            'email' => 'required|max:250|unique:users,email,'.$usuario->id,
            'password' => 'nullable|max:250|confirmed',
        ], [
            'name.required' => 'El nombre de usuario es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.unique' => 'Este correo ya está registrado',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if($request->filled('password')){
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje','Se actualizó el usuario correctamente')
            ->with('icons','success');
    }

    public function confirmDelete($id){
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.delete', compact ('usuario'));
    }

    public function destroy($id){
        $usuario = User::find($id);
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje','Se eliminó el usuario correctamente')
            ->with('icons','success');
    }
}