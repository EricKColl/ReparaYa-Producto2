<a href="/public/admin" class="top-link">← Volver al panel</a>
<h2>Calendario de Servicios</h2>

<p>
    <span style="background:#fee2e2;color:#b91c1c;padding:4px 10px;border-radius:8px;font-weight:700;margin-right:8px;">■ Urgente</span>
    <span style="background:#dcfce7;color:#166534;padding:4px 10px;border-radius:8px;font-weight:700;">■ Estándar</span>
</p>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

<div id="calendario" style="margin-top:20px;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendario');
        var eventos = <?php
                        $eventos = [];
                        foreach ($incidencias as $inc) {
                            $eventos[] = [
                                'title' => $inc['localizador'] . ' — ' . $inc['nombre_especialidad'],
                                'start' => $inc['fecha_servicio'],
                                'color' => $inc['tipo_urgencia'] === 'Urgente' ? '#dc2626' : '#166534',
                                'extendedProps' => [
                                    'localizador' => $inc['localizador'],
                                    'cliente'     => $inc['cliente_nombre'],
                                    'tecnico'     => $inc['tecnico_nombre'] ?? 'Sin asignar',
                                    'estado'      => $inc['estado'],
                                    'direccion'   => $inc['direccion'],
                                    'descripcion' => $inc['descripcion'],
                                ]
                            ];
                        }
                        echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
                        ?>;

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: eventos,
            eventClick: function(info) {
                var p = info.event.extendedProps;
                alert(
                    '📋 ' + info.event.title +
                    '\n\nCliente: ' + p.cliente +
                    '\nTécnico: ' + p.tecnico +
                    '\nEstado: ' + p.estado +
                    '\nDirección: ' + p.direccion +
                    '\nDescripción: ' + p.descripcion
                );
            }
        });
        calendar.render();
    });
</script>