<html>

<head>
    <meta charset="utf-8">
    <title>Informe de Proyectos</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        header {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px;
        }

        th {
            background: #f0f0f0;
        }

        p {
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
    <header>
        <table>
            <tr>
                <td style="width: 50%; border: 0; vertical-align: top;">
                    <img src="{{ public_path('img/logo_simj.png') }}" alt="Logo" style="width: 75%;">
                </td>
                <td style="width: 50%; border: 0; vertical-align: top;">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2">
                                    Informe de proyectos
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fecha de generación:</td>
                                <td>{{ now()->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td>Generado por:</td>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <td>Proyectos:</td>
                                <td>{{ $filtros['proyecto_id'] ? $filtros['proyecto_id'] : 'Todos' }}</td>
                            </tr>
                            <tr>
                                <td>Usuarios:</td>
                                <td>{{ $filtros['usuario_id'] ? $filtros['usuario_id'] : 'Todos' }}</td>
                            </tr>
                            <tr>
                                <td>Fecha inicio:</td>
                                <td>{{ $filtros['inicio'] ? \Carbon\Carbon::parse($filtros['inicio'])->format('d/m/Y') : 'Sin filtro' }}</td>
                            </tr>
                            <tr>
                                <td>Fecha fin:</td>
                                <td>{{ $filtros['fin'] ? \Carbon\Carbon::parse($filtros['fin'])->format('d/m/Y') : 'Sin filtro' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </header>


    @foreach ($proyectos as $nombre => $tareas)
        <div style="page-break-inside: avoid;">
            <h2>Proyecto: {{ $nombre }}</h2>
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Duración (min)</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sumaProyecto = 0; @endphp
                    @foreach ($tareas as $tarea)
                        <tr>
                            <td>{{ $tarea['usuario'] }}</td>
                            <td>{{ $tarea['inicio'] }}</td>
                            <td>{{ $tarea['fin'] }}</td>
                            <td>{{ $tarea['minutos'] }}</td>
                            <td>{{ $tarea['descripcion'] }}</td>
                        </tr>
                        @php $sumaProyecto += $tarea['minutos']; @endphp
                    @endforeach
                </tbody>
            </table>
            <p><strong>Total del proyecto "{{ $nombre }}": {{ $sumaProyecto }} minutos</strong></p>
        </div>
    @endforeach
</body>

</html>
