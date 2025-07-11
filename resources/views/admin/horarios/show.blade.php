@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Horario del Doctor: {{$horario->doctor->nombres}} {{$horario->doctor->apellidos}} para el día {{$horario->dia}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos del Horario</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Doctor</label>
                                <input type="text" value="{{$horario->doctor->nombres}} {{$horario->doctor->apellidos}} - {{$horario->doctor->especialidad}}" name="doctor_id" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Consultorio</label>
                                <input type="text" value="{{$horario->consultorio->nombre}} - {{$horario->consultorio->ubicacion}}" name="consultorio_id" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Día</label>
                                <input type="text" value="{{$horario->dia}}" name="dia" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Hora de Inicio</label>
                                <input type="time" value="{{$horario->hora_inicio}}" name="hora_inicio" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Hora de Finalización</label>
                                <input type="time" value="{{$horario->hora_fin}}" name="hora_fin" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('admin/horarios')}}" class="btn btn-secondary">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection