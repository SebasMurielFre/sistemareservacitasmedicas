@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Eliminar Consultorio: {{$consultorio->nombre}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">¿Estás seguro de eliminar al consultorio?</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/consultorios',$consultorio->id)}}" method ="POST">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" value="{{$consultorio->nombre}}" name="nombre" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Ubicación</label>
                                    <input type="text" value="{{$consultorio->ubicacion}}" name="ubicacion" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Capacidad</label>
                                    <input type="number" value="{{$consultorio->capacidad}}" name="capacidad" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Teléfono</label>
                                    <input type="text" value="{{$consultorio->telefono}}" name="telefono" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Extensión</label>
                                    <input type="text" value="{{$consultorio->extension}}" name="extension" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Especialidad</label>
                                    <input type="text" value="{{$consultorio->especialidad}}" name="especialidad" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <input type="text" value="{{$consultorio->estado}}" name="estado" class="form-control" disabled>
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
                                        disabled
                                    >{{$consultorio->equipamiento}}</textarea>
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
                                        disabled
                                    >{{$consultorio->descripcion}}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('admin/consultorios')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-danger">Eliminar Consultorio</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection