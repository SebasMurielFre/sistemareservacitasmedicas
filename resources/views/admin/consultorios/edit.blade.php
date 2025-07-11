@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Editar Consultorio: {{$consultorio->nombre}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos del Consultorio</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/consultorios',$consultorio->id)}}" method ="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nombre</label><b>*</b>
                                    <input type="text" value="{{$consultorio->nombre}}" name="nombre" class="form-control" required>
                                    @error('nombre')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Ubicación</label><b>*</b>
                                    <input type="text" value="{{$consultorio->ubicacion}}" name="ubicacion" class="form-control" required>
                                    @error('ubicacion')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Capacidad</label><b>*</b>
                                    <input type="number" value="{{$consultorio->capacidad}}" name="capacidad" class="form-control" required>
                                    @error('capacidad')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Teléfono</label>
                                    <input type="text" value="{{$consultorio->telefono}}" name="telefono" class="form-control">
                                    @error('telefono')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Extensión</label>
                                    <input type="text" value="{{$consultorio->extension}}" name="extension" class="form-control">
                                    @error('extension')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Especialidad</label><b>*</b>
                                    <input type="text" value="{{$consultorio->especialidad}}" name="especialidad" class="form-control" required>
                                    @error('especialidad')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Estado</label><b>*</b>
                                    <select name="estado" id="estado" class="form-control" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="Activo" {{ $consultorio->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="Inactivo" {{ $consultorio->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                    @error('estado')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Equipamiento</label>
                                    <textarea 
                                        name="equipamiento" 
                                        id="equipamiento"
                                        class="form-control" 
                                        rows="4" 
                                    >{{$consultorio->equipamiento}}</textarea>
                                    @error('equipamiento')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <textarea 
                                        name="descripcion" 
                                        id="descripcion"
                                        class="form-control" 
                                        rows="4"
                                    >{{$consultorio->descripcion}}</textarea>
                                    @error('descripcion')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('admin/consultorios')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar Consultorio</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection