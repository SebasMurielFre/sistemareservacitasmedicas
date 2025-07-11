@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de Pacientes</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{url('admin/pacientes/create')}}" class="btn btn-primary">
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
                                <td style="text-align: center"><b>Nombre Completo</b></td>
                                <td style="text-align: center"><b>DNI</b></td>
                                <td style="text-align: center"><b>Fecha de Nacimiento</b></td>
                                <td style="text-align: center"><b>Género</b></td>
                                <td style="text-align: center"><b>Estado Civil</b></td>
                                <td style="text-align: center"><b>Celular</b></td>
                                <td style="text-align: center"><b>Grupo Sanguíneo</b></td>
                                <td style="text-align: center"><b>Enfermedades</b></td>
                                <td style="text-align: center"><b>Acciones</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($pacientes as $paciente)
                                <tr>
                                    <td style="text-align: center">{{ $contador++ }}</td>
                                    <td style="text-align: center">{{ $paciente->id }}</td>
                                    <td>{{ $paciente->nombres }} {{ $paciente->apellidos }}</td>
                                    <td style="text-align: center">{{ $paciente->dni }}</td>
                                    <td style="text-align: center">{{ $paciente->fecha_nacimiento }}</td>
                                    <td style="text-align: center">{{ $paciente->genero }}</td>
                                    <td style="text-align: center">{{ $paciente->estado_civil }}</td>
                                    <td style="text-align: center">{{ $paciente->celular }}</td>
                                    <td style="text-align: center">{{ $paciente->grupo_sanguineo }}</td>
                                    <td>{{ $paciente->enfermedades }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url('admin/pacientes/'.$paciente->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                            <a href="{{url('admin/pacientes/'.$paciente->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                            <a href="{{url('admin/pacientes/'.$paciente->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ de Pacientes",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Pacientes",
                                    "infoFiltered": "(Filtrado de _MAX_ total de Pacientes)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ de Pacientes",
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
@endsection
