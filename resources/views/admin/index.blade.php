@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1><b>Bienvenido al Panel Principal</b></h1>
    </div>

    <hr>

    <div class="row">
        @can('admin.usuarios.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$total_usuarios}}</h3>
                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-file-person"></i>
                    </div>
                    <a href="{{url('admin/usuarios')}}" class="small-box-footer">Más Información <i class="fas bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.secretarias.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$total_secretarias}}</h3>
                        <p>Secretarias</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-person-workspace"></i>
                    </div>
                    <a href="{{url('admin/secretarias')}}" class="small-box-footer">Más Información <i class="fas bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.pacientes.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$total_pacientes}}</h3>
                        <p>Pacientes</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-person-heart"></i>
                    </div>
                    <a href="{{url('admin/pacientes')}}" class="small-box-footer">Más Información <i class="fas bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.consultorios.index')
            <div class="col-lg-3 col-6">
                <div class="small-box" style="background-color: #6f42c1;">
                    <div class="inner text-white">
                        <h3>{{$total_consultorios}}</h3>
                        <p>Consultorios</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-hospital"></i>
                    </div>
                    <a href="{{url('admin/consultorios')}}" class="small-box-footer">Más Información <i class="fas bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.doctores.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner text-white">
                        <h3>{{$total_doctores}}</h3>
                        <p>Doctores</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-person-vcard"></i>
                    </div>
                    <a href="{{url('admin/doctores')}}" class="small-box-footer">Más Información <i class="fas bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.horarios.index')
            <div class="col-lg-3 col-6">
                <div class="small-box" style="background-color:rgb(240, 156, 88);">
                    <div class="inner text-white">
                        <h3>{{$total_horarios}}</h3>
                        <p>Horarios</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-calendar2-week"></i>
                    </div>
                    <a href="{{url('admin/horarios')}}" class="small-box-footer">Más Información <i class="fas bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="col-md-8">
                        <h1 class="card-title mb-0"><b>Calendario del Doctor</b></h1>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <div class="input-group">
                                <select name="doctor_id" id="doctor_id" class="form-control">
                                    <option value="">Seleccione un doctor</option>
                                    @foreach($doctores as $doctor)
                                        <option value="{{ $doctor->id }}" {{ $doctor_id == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->nombres }} {{ $doctor->apellidos }} - {{ $doctor->especialidad }} 
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <a href="#" class="btn btn-secondary" id="limpiar-filtro" style="display:none; margin-left: 15px;">Limpiar filtro</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="tabla-horario-doctor-container">
                        @include('tabla_horario_doctor_index', ['horarios' => $horarios, 'doctor_id' => $doctor_id, 'doctor' => $doctor_id ? Doctor::find($doctor_id) : null])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-cyan">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="col-md-8">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Agendar Cita</button>

                        <!-- Modal -->
                        <form action="{{url('/admin/eventos/create')}}" method="post">
                            @csrf
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="color:black" id="exampleModalLabel"><b>Agendar Cita</b></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label style="color:black">Doctor</label><b style="color:black">*</b>
                                                        <select name="doctor_id" id="doctor_id_modal" class="form-control" required>
                                                            <option value="">Seleccione una opción</option>
                                                            @foreach($doctores as $doctor)
                                                                <option value="{{ $doctor->id }}">
                                                                    {{ $doctor->nombres }} {{ $doctor->apellidos }} - {{ $doctor->especialidad }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('doctor_id')
                                                            <small style="color:red">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label style="color:black">Fecha de Cita</label><b style="color:black">*</b>
                                                        <input type="date" name="fecha_cita" id="fecha_cita_modal" value="<?php echo date('Y-m-d');?>" min="<?php echo date('Y-m-d');?>" class="form-control" required>
                                                        <small id="fecha_error" style="color:red; display:none;"></small>
                                                        @error('fecha_cita')
                                                            <small style="color:red">{{$message}}</small>
                                                        @enderror
                                                        @if(($message = Session::get('fecha_cita')))
                                                            <script>
                                                                document.addEventListener('DOMContentLoaded',function (){
                                                                    $('#exampleModal').modal('show');
                                                                });
                                                            </script>
                                                            <small style="color:red">{{$message}}</small>
                                                        @endif
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded',function (){
                                                                const fechaReservaInput = document.getElementById('fecha_cita_modal');
                                                                const fechaError = document.getElementById('fecha_error');

                                                                //Escuchar el evento de cambio en el campo de fecha reserva
                                                                fechaReservaInput.addEventListener('change', function() {
                                                                    let selectedDate = this.value; // Obtener la Fecha seleccionada

                                                                    //Obtener la fecha actual en formato ISO (yyyy-mm-dd)
                                                                    let today = new Date().toISOString().slice(0, 10);

                                                                    //Verificar si la fecha seleccionada es anterior a la fecha actual
                                                                    if (selectedDate < today) {
                                                                        // Si es así, establecer la fecha seleccionada en null
                                                                        this.value = null;
                                                                        fechaError.textContent = 'No se puede agendar en una fecha pasada.';
                                                                        fechaError.style.display = 'block';
                                                                    } else {
                                                                        fechaError.style.display = 'none';
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label style="color:black">Hora de Cita</label><b style="color:black">*</b>
                                                        <input type="time" name="hora_cita" id="hora_cita_modal" class="form-control" required>
                                                        <small id="hora_error" style="color:red; display:none;"></small>
                                                        @error('hora_cita')
                                                            <small style="color:red">{{$message}}</small>
                                                        @enderror
                                                        @if(($message = Session::get('hora_cita')))
                                                            <script>
                                                                document.addEventListener('DOMContentLoaded',function (){
                                                                    $('#exampleModal').modal('show');
                                                                });
                                                            </script>
                                                            <small style="color:red">{{$message}}</small>
                                                        @endif
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function (){
                                                                const horaReservaInput = document.getElementById('hora_cita_modal');
                                                                const horaError = document.getElementById('hora_error');
                                                                
                                                                //Escuchar el evento de cambio en el campo de hora reserva
                                                                horaReservaInput.addEventListener('change',function (){
                                                                    let seletedTime = this.value;
                                                                    
                                                                    if(seletedTime){
                                                                        seletedTime = seletedTime.split(':');
                                                                        seletedTime = seletedTime[0]+ ':00';
                                                                        this.value = seletedTime;
                                                                    }
                                                                    
                                                                    if(seletedTime<'00:00' || seletedTime>'23:00'){
                                                                        this.value = null;
                                                                        horaError.textContent = 'No se puede agendar a la hora seleccionada.';
                                                                        horaError.style.display = 'block';
                                                                    } else {
                                                                        horaError.style.display = 'none';
                                                                    };
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary" id="btn-agendar">Agendar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <div class="input-group">
                                <select name="doctor_id2" id="doctor_id2" class="form-control">
                                    <option value="">Seleccione un doctor</option>
                                    <option value="0">Todos</option>
                                    @foreach($doctores as $doctor)
                                        <option value="{{ $doctor->id}}" {{ $doctor_id == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->nombres }} {{ $doctor->apellidos }} - {{ $doctor->especialidad }} 
                                        </option>
                                    @endforeach
                                </select>
                                <script>
                                    $('#doctor_id2').on('change', function() {
                                        var doctor_id2 = $(this).val();

                                        var calendarEl = document.getElementById('calendar');
                                        var calendar = new FullCalendar.Calendar(calendarEl, {
                                            initialView: 'dayGridMonth',
                                            locale: 'es',
                                            events: [],
                                        });

                                        if(doctor_id2) {
                                            if(doctor_id2 == 0) {
                                                $.ajax({
                                                    url: "{{ url('/cargar-citas/') }}",
                                                    type: 'GET',
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        calendar.removeAllEventSources();
                                                        calendar.addEventSource(data);
                                                    },
                                                    error: function(){
                                                        alert('Error al cargar los datos')
                                                    }
                                                });
                                            }else {
                                                $.ajax({
                                                    url: "{{ url('/cargar-citas-doctores/') }}" + '/' + doctor_id2,
                                                    type: 'GET',
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        calendar.removeAllEventSources();
                                                        calendar.addEventSource(data);
                                                    },
                                                    error: function(){
                                                        alert('Error al cargar los datos')
                                                    }
                                                });
                                            }
                                        } else {
                                            calendar.removeAllEvents();
                                        }
                                        calendar.render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <script>
            $(document).ready(function() {
                $('#exampleModal').modal('show');
            });
        </script>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Función existente para cargar tabla de horarios
            function cargarTablaHorarioDoctor(doctorId) {
                $.ajax({
                    url: '{{ route('tabla_horario_doctor_index') }}',
                    type: 'GET',
                    data: { doctor_id: doctorId },
                    success: function(data) {
                        $('#tabla-horario-doctor-container').html(data);
                    }
                });
            }

            // Eventos existentes para el filtro de horarios
            $('#doctor_id').on('change', function() {
                var doctorId = $(this).val();
                if(doctorId) {
                    cargarTablaHorarioDoctor(doctorId);
                    $('#limpiar-filtro').show();
                } else {
                    $('#limpiar-filtro').hide();
                }
            });

            $('#limpiar-filtro').on('click', function(e) {
                e.preventDefault();
                $('#doctor_id').val('');
                cargarTablaHorarioDoctor('');
                $(this).hide();
            });

            // Mostrar el botón si ya hay filtro
            if($('#doctor_id').val()) {
                $('#limpiar-filtro').show();
            }
        });
    </script>
@endsection

