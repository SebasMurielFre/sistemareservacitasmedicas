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
                        <button type="button" class="btn" style="background-color: #8111cb98; color: white; border: none;" data-toggle="modal" data-target="#exampleModal">
                            Agendar Cita
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color:black"><b>Agendar Cita</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="form-agendar-cita">
                                        @csrf
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
                                                        <small class="error-message text-danger" data-field="doctor_id"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label style="color:black">Fecha de Cita</label><b style="color:black">*</b>
                                                        <input type="date" 
                                                            name="fecha_cita" 
                                                            id="fecha_cita_modal"
                                                            class="form-control" 
                                                            required>
                                                        <small class="error-message text-danger" data-field="fecha_cita"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label style="color:black">Hora de Cita</label><b style="color:black">*</b>
                                                        <input type="time" 
                                                            name="hora_cita" 
                                                            id="hora_cita_modal"
                                                            class="form-control" 
                                                            required>
                                                        <small class="error-message text-danger" data-field="hora_cita"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary" id="btn-agendar">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                                Agendar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <div class="input-group">
                                <select name="doctor_id2" id="doctor_id2" class="form-control">
                                    <option value="">Seleccione un doctor</option>
                                    @foreach($doctores as $doctor)
                                        <option value="{{ $doctor->id }}" {{ $doctor_id == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->nombres }} {{ $doctor->apellidos }} - {{ $doctor->especialidad }} 
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <a href="#" class="btn btn-secondary" id="limpiar-filtro2" style="display:none; margin-left: 15px;">Limpiar filtro</a>
                                </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es'
            });
            calendar.render();
        });
    </script>
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

            // AJAX para el formulario de agendar cita
            $('#form-agendar-cita').on('submit', function(e) {
                e.preventDefault();
                
                // Limpiar errores previos
                limpiarErrores();
                
                // Mostrar spinner
                mostrarCargando(true);
                
                $.ajax({
                    url: '{{ url('/admin/eventos/create') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Cerrar modal inmediatamente
                            $('#exampleModal').modal('hide');
                            
                            // Limpiar formulario
                            $('#form-agendar-cita')[0].reset();
                            
                            // Mostrar SweetAlert con timer (igual que tu layout)
                            Swal.fire({
                                position: "center",
                                icon: response.icon,
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                // Recargar página después del SweetAlert
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Errores de validación - mantener modal abierto
                            mostrarErroresValidacion(xhr.responseJSON.errors);
                        } else if (xhr.status === 500) {
                            // Error del servidor - mostrar SweetAlert de error
                            var response = xhr.responseJSON;
                            if (response && response.showSweetAlert) {
                                Swal.fire({
                                    position: "center",
                                    icon: response.icon,
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            } else {
                                mostrarErrorGeneral('Error interno del servidor');
                            }
                        } else {
                            // Otros errores
                            mostrarErrorGeneral('Error al procesar la solicitud');
                        }
                    },
                    complete: function() {
                        // Ocultar spinner
                        mostrarCargando(false);
                    }
                });
            });

            // Funciones auxiliares para el modal
            function limpiarErrores() {
                $('.error-message').text('');
                $('#errores-validacion').hide();
                $('.form-control').removeClass('is-invalid');
            }

            function mostrarCargando(mostrar) {
                if (mostrar) {
                    $('#btn-agendar .spinner-border').show();
                    $('#btn-agendar').prop('disabled', true);
                } else {
                    $('#btn-agendar .spinner-border').hide();
                    $('#btn-agendar').prop('disabled', false);
                }
            }

            function mostrarErroresValidacion(errors) {
                var errorList = '';
                
                $.each(errors, function(field, messages) {
                    // Mostrar error debajo del campo específico
                    $('[data-field="' + field + '"]').text(messages[0]);
                    
                    // Agregar clase de error al campo
                    $('[name="' + field + '"]').addClass('is-invalid');
                    
                    // Agregar a la lista general de errores
                    $.each(messages, function(index, message) {
                        errorList += '<li>' + message + '</li>';
                    });
                });
                
                $('#lista-errores').html(errorList);
                $('#errores-validacion').show();
            }

            function mostrarErrorGeneral(mensaje) {
                $('#lista-errores').html('<li>' + mensaje + '</li>');
                $('#errores-validacion').show();
            }

            // Limpiar errores cuando se cierre el modal
            $('#exampleModal').on('hidden.bs.modal', function() {
                limpiarErrores();
                $('#form-agendar-cita')[0].reset();
            });

            // Limpiar errores cuando el usuario empiece a escribir
            $('.form-control').on('input change', function() {
                $(this).removeClass('is-invalid');
                var fieldName = $(this).attr('name');
                $('[data-field="' + fieldName + '"]').text('');
                
                // Si no hay más errores, ocultar el contenedor general
                if ($('.error-message:not(:empty)').length === 0) {
                    $('#errores-validacion').hide();
                }
            });
        });
    </script>
@endsection

