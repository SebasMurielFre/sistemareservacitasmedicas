@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de Citas Médicas: {{ $user-> name}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3><b>Citas Registradas</b></h3>
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
                                <td style="text-align: center"><b>Fecha de la Reserva</b></td>
                                <td style="text-align: center"><b>Horario de la Reserva</b></td>
                                <td style="text-align: center"><b>Acciones</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($eventosConHorario as $evento)
                                <tr>
                                    <td style="text-align: center">{{ $contador++ }}</td>
                                    <td style="text-align: center">{{ $evento->id }}</td>
                                    <td>{{ $evento->doctor->nombres }} {{ $evento->doctor->apellidos }}</td>
                                    <td style="text-align: center">{{ $evento->doctor->especialidad }}</td>
                                    <td>{{ $evento->horario->consultorio->nombre }}, {{ $evento->horario->consultorio->ubicacion }}</td>
                                    <td style="text-align: center">{{ \Carbon\Carbon::parse($evento->start)->format('Y-m-d') }}</td>
                                    <td style="text-align: center">{{ \Carbon\Carbon::parse($evento->start)->format('H:i') }} - {{ \Carbon\Carbon::parse($evento->end)->format('H:i') }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url('admin/eventos/'.$evento->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ de Citas",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Citas",
                                    "infoFiltered": "(Filtrado de _MAX_ total de Citas)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ de Citas",
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
