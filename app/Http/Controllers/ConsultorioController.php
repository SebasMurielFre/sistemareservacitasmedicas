<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    public function index(){
        $consultorios = Consultorio::all();
        return view('admin.consultorios.index', compact('consultorios'));
    }

    public function create(){
        return view('admin.consultorios.create');
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|max:100',
            'ubicacion' => 'required|max:100',
            'capacidad' => 'required',
            'telefono' => 'nullable|max:20',
            'extension' => 'nullable|max:10',
            'especialidad' => 'required|max:100',
            'estado' => 'required|max:20|in:Activo,Inactivo',
            'equipamiento' => 'nullable',
            'descripcion' => 'nullable',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'ubicacion.required' => 'La ubicación es obligatorio',
            'capacidad.required' => 'La capacidad es obligatorio',
            'especialidad.required' => 'La especialidad es obligatorio',
            'estado.required' => 'El estado civil es obligatorio',
            'estado.in' => 'El estado civil seleccionado no es válido',
        ]);

        Consultorio::create($request->all());

        return redirect()->route('admin.consultorios.index')
            ->with('mensaje','Se registró al consultorio correctamente')
            ->with('icons','success');
    }

    public function show($id){
        $consultorio = Consultorio::findOrFail($id);
        return view('admin.consultorios.show', compact ('consultorio'));
    }

    public function edit($id){
        $consultorio = Consultorio::findOrFail($id);
        return view('admin.consultorios.edit', compact ('consultorio'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nombre' => 'required|max:100',
            'ubicacion' => 'required|max:100',
            'capacidad' => 'required',
            'telefono' => 'nullable|max:20',
            'extension' => 'nullable|max:10',
            'especialidad' => 'required|max:100',
            'estado' => 'required|max:20|in:Activo,Inactivo',
            'equipamiento' => 'nullable',
            'descripcion' => 'nullable',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'ubicacion.required' => 'La ubicación es obligatorio',
            'capacidad.required' => 'La capacidad es obligatorio',
            'especialidad.required' => 'La especialidad es obligatorio',
            'estado.required' => 'El estado civil es obligatorio',
            'estado.in' => 'El estado civil seleccionado no es válido',
        ]);

        
        $consultorio = Consultorio::find($id);
        $consultorio->update($request->all());

        return redirect()->route('admin.consultorios.index')
            ->with('mensaje','Se actualizó al consultorio correctamente')
            ->with('icons','success');
    }

    public function confirmDelete($id){
        $consultorio = Consultorio::findOrFail($id);
        return view('admin.consultorios.delete', compact ('consultorio'));
    }

    public function destroy($id){
        $consultorio = Consultorio::find($id);
        $consultorio->delete();
        return redirect()->route('admin.consultorios.index')
            ->with('mensaje','Se eliminó al consultorio correctamente')
            ->with('icons','success');
    }
}
