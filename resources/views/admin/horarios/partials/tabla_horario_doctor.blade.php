<table id="example2" class="table table-striped table-bordered table-hover table-sm">
    <thead style="background-color: #c0c0c0">
        <tr>
            <td style="text-align: center"><b>Hora/Día</b></td>
            <td style="text-align: center"><b>Lunes</b></td>
            <td style="text-align: center"><b>Martes</b></td>
            <td style="text-align: center"><b>Miércoles</b></td>
            <td style="text-align: center"><b>Jueves</b></td>
            <td style="text-align: center"><b>Viernes</b></td>
            <td style="text-align: center"><b>Sábado</b></td>
            <td style="text-align: center"><b>Domingo</b></td>
        </tr>
    </thead>
    <tbody>
        @if($doctor_id)
            @php
                $horas = [];
                $horaInicio = strtotime('00:00:00');
                $horaFin = strtotime('23:00:00');
                while ($horaInicio <= $horaFin) {
                    $horaActual = date('H:i:s', $horaInicio);
                    $horaSiguiente = ($horaActual == '23:00:00') 
                        ? '24:00:00' 
                        : date('H:i:s', strtotime('+1 hour', $horaInicio));
                    $horas[] = $horaActual . ' - ' . $horaSiguiente;
                    $horaInicio = strtotime('+1 hour', $horaInicio);
                }
                $dias_semana = [
                    'Lunes',
                    'Martes',
                    'Miércoles',
                    'Jueves',
                    'Viernes',
                    'Sábado',
                    'Domingo'
                ];
            @endphp
            @foreach ($horas as $hora)
                @php
                    list($hora_inicio, $hora_fin) = explode(' - ', $hora);
                @endphp
                <tr>
                    <td style="text-align: center">{{ $hora }}</td>
                    @foreach ($dias_semana as $dia)
                        @php
                            $estado = '';
                            $nombre_consultorio = '';
                            foreach ($horarios as $horario){
                                if($horario->doctor_id == $doctor_id && strtoupper($horario->dia) == strtoupper($dia)){
                                    $horaInicioHorario = strtotime($horario->hora_inicio);
                                    $horaFinHorario = strtotime($horario->hora_fin);
                                    $horaInicioIntervalo = strtotime($hora_inicio);
                                    $horaFinIntervalo = strtotime($hora_fin);
                                    if($horaInicioIntervalo >= $horaInicioHorario && $horaFinIntervalo <= $horaFinHorario){
                                        $estado = '';
                                        $nombre_consultorio = $horario->consultorio->nombre.' - '.$horario->consultorio->especialidad.', '.$horario->consultorio->ubicacion;
                                        break;
                                    }else {
                                        $estado = 'No atiende';
                                        $nombre_consultorio = '';
                                    }
                                }
                                else {
                                    $estado = 'No atiende';
                                    $nombre_consultorio = '';
                                }
                            }
                        @endphp
                        <td style="text-align: center" class="@if($estado == '') bg-success @else bg-danger @endif text-white">{{ $estado }}{{ $nombre_consultorio }}</td>
                    @endforeach
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function () {
        var table = $("#example2").DataTable({
            "pageLength": 24,
            "dom": 'Bfrtip',
            "language": {
                "emptyTable": "Seleccione un doctor para ver su horario",
                "buttons": {
                    "copyTitle": "Copiado al portapapeles",
                    "copySuccess": {
                        "_": "Horario Copiado",
                    },
                    "colvisRestore": "Restaurar visibilidad",
                },
            },
            "responsive": true,
            "autoWidth": false,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "paging": false,
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
        table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>