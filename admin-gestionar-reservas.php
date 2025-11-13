<?php
require_once("lib/lib-sesion-datos.php");

if (!$usuario || $usuario['id_rol'] != 1) {
    header("Location: index.php");
    exit();
}

$sql_pendientes = "SELECT 
                        r.id_reserva,
                        r.titulo_evento,
                        r.fecha_inicio,
                        r.fecha_fin,
                        u.nombre_completo AS vecino_nombre,
                        e.nombre_espacio
                   FROM reservas r
                   JOIN usuarios u ON r.id_usuario_reserva = u.id_us
                   JOIN espacios_comunales e ON r.id_espacio = e.id_espacio
                   WHERE r.id_estado = 1
                   ORDER BY r.fecha_inicio ASC"; 

$resultado_pendientes = $conexion->query($sql_pendientes);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="css/estilo-index.css?v=1.2" rel="stylesheet">
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    
    <div class="seccion-anuncios p-4 p-md-5"> 
        <h2><i class="fas fa-calendar-check"></i> Gestionar Solicitudes de Reserva</h2>
        <p class="lead">Revisa las solicitudes de espacios comunales pendientes.</p>

        <?php
        if (isset($_GET['status']) && $_GET['status'] == 'ok') {
            echo "<div class='alert alert-success'>Estado de la reserva actualizado.</div>";
        }
        if (isset($_GET['status']) && $_GET['status'] == 'conflict') {
            echo "<div class='alert alert-danger'><strong>Error:</strong> No se pudo aprobar. Ya existe una reserva aprobada para ese espacio en ese horario.</div>";
        }
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger'>Error al actualizar el estado.</div>";
        }
        ?>

        <?php if ($resultado_pendientes && $resultado_pendientes->num_rows > 0): ?>
            
            <table class="table table-hover align-middle mt-4">
                <thead class="table-light">
                    <tr>
                        <th>Vecino</th>
                        <th>Evento y Espacio</th>
                        <th>Fecha y Hora de Inicio</th>
                        <th>Fecha y Hora de Fin</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($reserva = $resultado_pendientes->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($reserva['vecino_nombre']); ?></td>
                            <td>
                                <strong><?= htmlspecialchars($reserva['titulo_evento']); ?></strong><br>
                                <small class="text-muted"><?= htmlspecialchars($reserva['nombre_espacio']); ?></small>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($reserva['fecha_inicio'])); ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($reserva['fecha_fin'])); ?></td>
                            <td class="text-end">
                                <form action="lib/lib-cambiar-estado-reserva.php" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que quieres RECHAZAR esta reserva?')">
                                    <input type="hidden" name="id_reserva" value="<?= $reserva['id_reserva']; ?>">
                                    <input type="hidden" name="id_estado_nuevo" value="2">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-times"></i> Rechazar
                                    </button>
                                </form>
                                
                                <form action="lib/lib-cambiar-estado-reserva.php" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que quieres APROBAR esta reserva? Aparecerá en el calendario.')">
                                    <input type="hidden" name="id_reserva" value="<?= $reserva['id_reserva']; ?>">
                                    <input type="hidden" name="id_estado_nuevo" value="3">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i> Aprobar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            
        <?php else: ?>
            <div class="alert alert-info mt-4">No hay solicitudes de reserva pendientes.</div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>