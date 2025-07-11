@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de Horarios</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{url('admin/horarios/create')}}" class="btn btn-primary">
                            Registrar Nuevo
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                        <thead style="background-color: #c0c0c0">
                            <tr>
                                <td style="text-align: center"><b>N°</b></td>
                                <td style="text-align: center"><b>ID</b></td>
                                <td style="text-align: center"><b>Doctor</b></td>
                                <td style="text-align: center"><b>Especialidad</b></td>
                                <td style="text-align: center"><b>Consultorio</b></td>
                                <td style="text-align: center"><b>Día</b></td>
                                <td style="text-align: center"><b>Horario</b></td>
                                <td style="text-align: center"><b>Acciones</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($horarios as $horario)
                                <tr>
                                    <td style="text-align: center">{{ $contador++ }}</td>
                                    <td style="text-align: center">{{ $horario->id }}</td>
                                    <td>{{ $horario->doctor->nombres }} {{ $horario->doctor->apellidos }}</td>
                                    <td>{{ $horario->doctor->especialidad }}</td>
                                    <td>{{ $horario->consultorio->nombre }} - {{ $horario->consultorio->ubicacion }}</td>
                                    <td style="text-align: center">{{ $horario->dia }}</td>
                                    <td style="text-align: center">{{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url('admin/horarios/'.$horario->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                            <a href="{{url('admin/horarios/'.$horario->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                            <a href="{{url('admin/horarios/'.$horario->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        $(function () {
                            var table = $("#example1").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ de Horarios",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Horarios",
                                    "infoFiltered": "(Filtrado de _MAX_ total de Horarios)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ de Horarios",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Último",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    },
                                    "buttons": {
                                        "copyTitle": "Copiado al portapapeles",
                                        "copySuccess": {
                                            "_": "Copiadas %d filas",
                                            "1": "Copiada 1 fila"
                                        },
                                        "colvisRestore": "Restaurar visibilidad",
                                    },
                                },
                                "responsive": true,
                                "lengthChange": true,
                                "autoWidth": false,
                                buttons: [
                                    {
                                        extend: 'collection',
                                        text: 'Reportes',
                                        orientation: 'landscape',
                                        buttons: [
                                            { extend: 'copy', text: 'Copiar' },
                                            { extend: 'pdf' },
                                            { extend: 'csv' },
                                            { extend: 'excel' },
                                            { extend: 'print', text: 'Imprimir' }
                                        ]
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        align: 'button-right',
                                        postfixButtons: ['colvisRestore'],
                                    }
                                ]
                            });

                            table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script>
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
                                    <select name="doctor_id" id="doctor_id" class="form-control">
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
                                    <select name="consultorio_id" id="consultorio_id" class="form-control">
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
            $('#doctor_id').on('change', function() {
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
            $('#consultorio_id').on('change', function() {
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
                $('#consultorio_id').val('');
                cargarTablaHorarioConsultorio('');
                $(this).hide();
            });
            // Mostrar el botón si ya hay filtro
            if($('#consultorio_id').val()) {
                $('#limpiar-filtro2').show();
            }
        });
    </script>
@endsection