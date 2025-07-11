@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Eliminar Paciente: {{$paciente->nombres}} {{$paciente->apellidos}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">¿Estás seguro de eliminar al paciente?</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/pacientes',$paciente->id)}}" method ="POST">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nombres</label>
                                    <input type="text" value="{{$paciente->nombres}}" name="nombres" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Apellidos</label>
                                    <input type="text" value="{{$paciente->apellidos}}" name="apellidos" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">DNI</label>
                                    <input type="text" value="{{$paciente->dni}}" name="dni" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Fecha Nacimiento</label>
                                    <input type="date" value="{{$paciente->fecha_nacimiento}}" name="fecha_nacimiento" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Género</label>
                                    <input type="text" value="{{$paciente->genero}}" name="genero" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Estado Civil</label>
                                    <input type="text" value="{{$paciente->estado_civil}}" name="estado_civil" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Celular</label>
                                    <input type="text" value="{{$paciente->celular}}" name="celular" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Correo Electrónico</label>
                                    <input type="email" value="{{$paciente->email}}" name="email" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Dirección</label>
                                    <input type="address" value="{{$paciente->direccion}}" name="direccion" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Grupo Sanguíneo</label>
                                    <input type="address" value="{{$paciente->grupo_sanguineo}}" name="grupo_sanguineo" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Contacto de Emergencia</label>
                                    <input type="text" value="{{$paciente->contacto_emergencia}}" name="contacto_emergencia" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Enfermedades</label>
                                    <textarea 
                                        name="enfermedades" 
                                        id="enfermedades"
                                        class="form-control" 
                                        rows="4"
                                        disabled 
                                    >{{$paciente->enfermedades}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Alergias</label>
                                    <textarea 
                                        name="alergias" 
                                        id="alergias"
                                        class="form-control" 
                                        rows="4"
                                        disabled
                                    >{{$paciente->alergias}}</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Antecedentes</label>
                                    <textarea 
                                        name="antecedentes" 
                                        id="antecedentes"
                                        class="form-control" 
                                        rows="4" 
                                        disabled
                                    >{{$paciente->antecedentes}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Observaciones</label>
                                    <textarea 
                                        name="observaciones" 
                                        id="observaciones"
                                        class="form-control" 
                                        rows="4" 
                                        disabled
                                    >{{$paciente->observaciones}}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('admin/pacientes')}}" class="btn btn-secondary">Regresar</a>
                                    <button type="submit" class="btn btn-danger">Eliminar Paciente</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection