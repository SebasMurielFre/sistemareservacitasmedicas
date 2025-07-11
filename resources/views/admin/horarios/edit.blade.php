@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Editar Horario del Doctor: {{$horario->doctor->nombres}} {{$horario->doctor->apellidos}} para el día {{$horario->dia}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos del Horario</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/horarios',$horario->id)}}" method ="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Doctor</label><b>*</b>
                                    <select name="doctor_id" id="doctor_id" class="form-control" required>
                                        <option value="">Seleccione una opción</option>
                                        @foreach($doctores as $doctor)
                                            <option value="{{ $doctor->id }}" {{ $horario->doctor_id == $doctor->id ? 'selected' : '' }}>{{$doctor->nombres}} {{$doctor->apellidos}} - {{$doctor->especialidad}}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Consultorio</label><b>*</b>
                                    <select name="consultorio_id" id="consultorio_id" class="form-control" required>
                                        <option value="">Seleccione una opción</option>
                                        @foreach($consultorios as $consultorio)
                                            @if ( $consultorio->estado == 'Activo')
                                                <option value="{{ $consultorio->id }}" {{ $horario->consultorio_id == $consultorio->id ? 'selected' : '' }}>{{$consultorio->nombre}} - {{$consultorio->ubicacion}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('consultorio_id')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Día</label><b>*</b>
                                    <select name="dia" id="dia" class="form-control" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="Lunes" {{ $horario->dia == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                                        <option value="Martes" {{ $horario->dia == 'Martes' ? 'selected' : '' }}>Martes</option>
                                        <option value="Miércoles" {{ $horario->dia == 'Miércoles' ? 'selected' : '' }}>Miércoles</option>
                                        <option value="Jueves" {{ $horario->dia == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                                        <option value="Viernes" {{ $horario->dia == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                                        <option value="Sábado" {{ $horario->dia == 'Sábado' ? 'selected' : '' }}>Sábado</option>
                                        <option value="Domingo" {{ $horario->dia == 'Domingo' ? 'selected' : '' }}>Domingo</option>
                                    </select>
                                    @error('dia')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Hora de Inicio</label><b>*</b>
                                    <input type="time" value="{{$horario->hora_inicio}}" name="hora_inicio" class="form-control" required>
                                    @error('hora_inicio')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Hora de Finalización</label><b>*</b>
                                    <input type="time" value="{{$horario->hora_fin}}" name="hora_fin" class="form-control" required>
                                    @error('hora_fin')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('admin/horarios')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar Horario</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-inline float-right">
                                <div class="form-group mr-2">
                                    <label for="doctor_id" class="mr-2">Filtrar por doctor:</label>
                                    <select name="doctor_id_filtro" id="doctor_id_filtro" class="form-control">
                                        <option value="">Seleccione un doctor</option>
                                        @foreach($horarios->pluck('doctor')->unique() as $doctor)
                                            <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                                {{ $doctor->nombres }} {{ $doctor->apellidos }} - {{ $doctor->especialidad }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <a href="#" class="btn btn-secondary" id="limpiar-filtro" style="display:none;">Limpiar filtro</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="tabla-horario-doctor-container">
                        @include('admin.horarios.partials.tabla_horario_doctor', ['horarios' => $horarios, 'doctor_id' => request('doctor_id')])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-inline float-right">
                                <div class="form-group mr-2">
                                    <label for="consultorio_id" class="mr-2">Filtrar por consultorio:</label>
                                    <select name="consultorio_id_filtro" id="consultorio_id_filtro" class="form-control">
                                        <option value="">Seleccione un consultorio</option>
                                        @foreach($horarios->pluck('consultorio')->unique() as $consultorio)
                                            <option value="{{ $consultorio->id }}" {{ request('consultorio_id') == $consultorio->id ? 'selected' : '' }}>
                                                {{ $consultorio->nombre }} - {{ $consultorio->especialidad }}, {{ $consultorio->ubicacion }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <a href="#" class="btn btn-secondary" id="limpiar-filtro2" style="display:none;">Limpiar filtro</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="tabla-horario-consultorio-container">
                        @include('admin.horarios.partials.tabla_horario_consultorio', ['horarios' => $horarios, 'consultorio_id' => request('consultorio_id')])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function cargarTablaHorarioDoctor(doctorId) {
                $.ajax({
                    url: '{{ route('admin.horarios.tabla_horario_doctor') }}',
                    type: 'GET',
                    data: { doctor_id: doctorId },
                    success: function(data) {
                        $('#tabla-horario-doctor-container').html(data);
                    }
                });
            }
            $('#doctor_id_filtro').on('change', function() {
                var doctorId = $(this).val();
                cargarTablaHorarioDoctor(doctorId);
                if(doctorId) {
                    $('#limpiar-filtro').show();
                } else {
                    $('#limpiar-filtro').hide();
                }
            });
            $('#limpiar-filtro').on('click', function(e) {
                e.preventDefault();
                $('#doctor_id_filtro').val('');
                cargarTablaHorarioDoctor('');
                $(this).hide();
            });
            // Mostrar el botón si ya hay filtro
            if($('#doctor_id_filtro').val()) {
                $('#limpiar-filtro').show();
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            function cargarTablaHorarioConsultorio(consultorioId) {
                $.ajax({
                    url: '{{ route('admin.horarios.tabla_horario_consultorio') }}',
                    type: 'GET',
                    data: { consultorio_id: consultorioId },
                    success: function(data) {
                        $('#tabla-horario-consultorio-container').html(data);
                    }
                });
            }
            $('#consultorio_id_filtro').on('change', function() {
                var consultorioId = $(this).val();
                cargarTablaHorarioConsultorio(consultorioId);
                if(consultorioId) {
                    $('#limpiar-filtro2').show();
                } else {
                    $('#limpiar-filtro2').hide();
                }
            });
            $('#limpiar-filtro2').on('click', function(e) {
                e.preventDefault();
                $('#consultorio_id_filtro').val('');
                cargarTablaHorarioConsultorio('');
                $(this).hide();
            });
            // Mostrar el botón si ya hay filtro
            if($('#consultorio_id_filtro').val()) {
                $('#limpiar-filtro2').show();
            }
        });
    </script>
@endsection