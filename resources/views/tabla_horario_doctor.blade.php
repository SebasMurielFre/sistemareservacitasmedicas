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
                    $horaActual = date('H:i', $horaInicio); 
                    $horaSiguiente = ($horaActual == '23:00')
                        ? '24:00' 
                        : date('H:i', strtotime('+1 hour', $horaInicio));
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
                                        $nombre_consultorio = $horario->consultorio->nombre.' - '.$horario->consultorio->especialidad;
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