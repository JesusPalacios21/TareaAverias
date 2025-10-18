<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Averías Pendientes</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilo personalizado -->
    <style>
        body {
            background: #f8fafc;
            font-family: "Segoe UI", Roboto, sans-serif;
        }

        h1 {
            text-align: center;
            margin: 30px 0;
            font-weight: 600;
            color: #0d6efd;
        }

        .table-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            padding: 20px;
            margin: 0 auto;
            max-width: 1100px;
        }

        table th {
            background-color: #0d6efd;
            color: #fff;
            text-align: center;
        }

        table td {
            vertical-align: middle;
        }

        tr:nth-child(even) {
            background-color: #f3f6fa;
        }

        .btn-volver {
            display: inline-block;
            margin: 20px auto;
            text-align: center;
        }

        .status-pendiente {
            color: #ffc107;
            font-weight: 600;
        }

        .status-solucionado {
            color: #198754;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <h1>🔧 Averías Pendientes</h1>

    <div class="table-container">
        <table class="table table-hover align-middle" id="tablaAverias">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Problema</th>
                    <th>Fecha y Hora</th>
                    <th>Status</th>
                    <?php if (isset($esTecnico) && $esTecnico): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody id="cuerpoTabla">
                <?php if (count($averias) > 0): ?>
                    <?php foreach ($averias as $averia): ?>
                        <tr id="averia-<?= esc($averia['id']) ?>">
                            <td class="text-center fw-semibold"><?= esc($averia['id']) ?></td>
                            <td><?= esc($averia['cliente']) ?></td>
                            <td><?= esc($averia['problema']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($averia['fechahora'])) ?></td>
                            <td class="text-center <?= esc($averia['status']) === 'pendiente' ? 'status-pendiente' : 'status-solucionado' ?>">
                                <?= ucfirst(esc($averia['status'])) ?>
                            </td>
                            <?php if (isset($esTecnico) && $esTecnico): ?>
                                <td class="text-center">
                                    <a href="/averias/solucionar/<?= esc($averia['id']) ?>" class="btn btn-success btn-sm">
                                        <i class="bi bi-check-circle"></i> Marcar como solucionado
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr id="sinAverias">
                        <td colspan="<?= (isset($esTecnico) && $esTecnico) ? '6' : '5' ?>" class="text-center text-muted py-4">
                            No hay averías pendientes.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center btn-volver">
        <a href="/registrar" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- WebSocket Script -->
    <script>
    const ws = new WebSocket('ws://localhost:8080');
    const cuerpoTabla = document.getElementById('cuerpoTabla');

    ws.onopen = () => console.log('Conectado al WebSocket');
    ws.onclose = () => console.log('Conexión WebSocket cerrada');
    ws.onerror = (e) => console.error('Error WebSocket:', e);

    ws.onmessage = (event) => {
        const data = JSON.parse(event.data);
        if (data.action === 'nuevo') agregarAveria(data.averia);
        else if (data.action === 'solucionado') eliminarAveria(data.id);
    };

    function agregarAveria(averia) {
        const sinAverias = document.getElementById('sinAverias');
        if (sinAverias) sinAverias.remove();

        const tr = document.createElement('tr');
        tr.id = `averia-${averia.id}`;

        tr.innerHTML = `
            <td class="text-center fw-semibold">${averia.id}</td>
            <td>${esc(averia.cliente)}</td>
            <td>${esc(averia.problema)}</td>
            <td>${esc(averia.fechahora)}</td>
            <td class="text-center status-pendiente">${averia.status}</td>
            <?php if (isset($esTecnico) && $esTecnico): ?>
                <td class="text-center">
                    <a href="/averias/solucionar/${averia.id}" class="btn btn-success btn-sm">
                        <i class="bi bi-check-circle"></i> Marcar como solucionado
                    </a>
                </td>
            <?php endif; ?>
        `;
        cuerpoTabla.appendChild(tr);
    }

    function eliminarAveria(id) {
        const tr = document.getElementById(`averia-${id}`);
        if (tr) tr.remove();

        if (cuerpoTabla.children.length === 0) {
            const trVacio = document.createElement('tr');
            trVacio.id = 'sinAverias';
            trVacio.innerHTML = `
                <td colspan="<?= (isset($esTecnico) && $esTecnico) ? '6' : '5' ?>" class="text-center text-muted py-4">
                    No hay averías pendientes.
                </td>`;
            cuerpoTabla.appendChild(trVacio);
        }
    }

    function esc(text) {
        if (!text) return '';
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
    </script>

</body>
</html>
