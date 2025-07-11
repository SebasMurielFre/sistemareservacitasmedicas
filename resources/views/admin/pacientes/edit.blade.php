@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Editar Paciente: {{$paciente->nombres}} {{$paciente->apellidos}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos del Paciente</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/pacientes',$paciente->id)}}" method ="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nombres</label><b>*</b>
                                    <input type="text" value="{{$paciente->nombres}}" name="nombres" class="form-control" required>
                                    @error('nombres')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Apellidos</label><b>*</b>
                                    <input type="text" value="{{$paciente->apellidos}}" name="apellidos" class="form-control" required>
                                    @error('apellidos')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">DNI</label><b>*</b>
                                    <input type="text" value="{{$paciente->dni}}" name="dni" class="form-control" required>
                                    @error('dni')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Fecha Nacimiento</label><b>*</b>
                                    <input type="date" value="{{$paciente->fecha_nacimiento}}" name="fecha_nacimiento" class="form-control" required>
                                    @error('fecha_nacimiento')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Género</label><b>*</b>
                                    <select name="genero" id="genero" class="form-control" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="Masculino" {{ $paciente->genero == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Femenino" {{ $paciente->genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                    @error('genero')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Estado Civil</label><b>*</b>
                                    <select name="estado_civil" id="estado_civil" class="form-control" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="Soltero" {{ $paciente->estado_civil == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                                        <option value="Casado" {{ $paciente->estado_civil == 'Casado' ? 'selected' : '' }}>Casado</option>
                                        <option value="Unión de hecho" {{ $paciente->estado_civil == 'Unión de hecho' ? 'selected' : '' }}>Unión de hecho</option>
                                        <option value="Divorciado" {{ $paciente->estado_civil == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                                        <option value="Viudo" {{ $paciente->estado_civil == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                                    </select>
                                    @error('estado_civil')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Celular</label><b>*</b>
                                    <input type="text" value="{{$paciente->celular}}" name="celular" class="form-control" required>
                                    @error('celular')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Correo Electrónico</label><b>*</b>
                                    <input type="email" value="{{$paciente->email}}" name="email" class="form-control" required>
                                    @error('email')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Dirección</label><b>*</b>
                                    <input type="address" value="{{$paciente->direccion}}" name="direccion" class="form-control" required>
                                    @error('direccion')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Grupo Sanguíneo</label><b>*</b>
                                    <select name="grupo_sanguineo" id="grupo_sanguineo" class="form-control" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="A+" {{ $paciente->grupo_sanguineo == 'A+' ? 'selected' : '' }}>A+</option>
                                        <option value="A-" {{ $paciente->grupo_sanguineo == 'A-' ? 'selected' : '' }}>A-</option>
                                        <option value="B+" {{ $paciente->grupo_sanguineo == 'B+' ? 'selected' : '' }}>B+</option>
                                        <option value="B-" {{ $paciente->grupo_sanguineo == 'B-' ? 'selected' : '' }}>B-</option>
                                        <option value="AB+" {{ $paciente->grupo_sanguineo == 'AB+' ? 'selected' : '' }}>AB+</option>
                                        <option value="AB-" {{ $paciente->grupo_sanguineo == 'AB-' ? 'selected' : '' }}>AB-</option>
                                        <option value="O+" {{ $paciente->grupo_sanguineo == 'O+' ? 'selected' : '' }}>O+</option>
                                        <option value="O-" {{ $paciente->grupo_sanguineo == 'O-' ? 'selected' : '' }}>O-</option>
                                    </select>
                                    @error('grupo_sanguineo')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Contacto de Emergencia</label><b>*</b>
                                    <input type="text" value="{{$paciente->contacto_emergencia}}" name="contacto_emergencia" class="form-control" required>
                                    @error('contacto_emergencia')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
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
                                    >{{$paciente->enfermedades}}</textarea>
                                    @error('enfermedades')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
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
                                    >{{$paciente->alergias}}</textarea>
                                    @error('alergias')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
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
                                    >{{$paciente->antecedentes}}</textarea>
                                    @error('antecedentes')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
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
                                    >{{$paciente->observaciones}}</textarea>
                                    @error('observaciones')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('admin/pacientes')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar Paciente</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection