<?php
require_once("lib/lib-sesion-datos.php");

if (!$usuario || $usuario['id_rol'] != 1) {
    header("Location: index.php");
    exit();
}

$sql_pendientes = "SELECT p.*, u.nombre_completo AS creador_nombre
                   FROM proyectos p
                   JOIN usuarios u ON p.id_usuario_creador = u.id_us
                   WHERE p.id_estado = 1 
                   ORDER BY p.fecha_creacion ASC"; 

$resultado_pendientes = $conexion->query($sql_pendientes);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Aprobar Proyectos Pendientes</title>
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    <h2>Aprobar Proyectos Pendientes</h2>
    <p>Revisa los siguientes proyectos propuestos y decide si aprobarlos o rechazarlos.</p>

    <?php
    if (isset($_GET['status']) && $_GET['status'] == 'ok') {
        echo "<div class='alert alert-success'>Estado del proyecto actualizado correctamente.</div>";
    }
    if (isset($_GET['error'])) {
        echo "<div class='alert alert-danger'>Error al actualizar el estado del proyecto.</div>";
    }
    ?>

    <?php if ($resultado_pendientes && $resultado_pendientes->num_rows > 0): ?>
        <?php while ($proyecto = $resultado_pendientes->fetch_assoc()): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-header">
                    Propuesto por: <?= htmlspecialchars($proyecto['creador_nombre']); ?>
                    el <?= date('d/m/Y', strtotime($proyecto['fecha_creacion'])); ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($proyecto['titulo']); ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($proyecto['descripcion'])); ?></p>
                </div>
                <div class="card-footer bg-light d-flex justify-content-end gap-2">
                    
                    <form action="lib/lib-cambiar-estado-proyecto.php" method="POST" onsubmit="return confirm('¿Seguro que quieres RECHAZAR este proyecto?')">
                        <input type="hidden" name="id_proyecto" value="<?= $proyecto['id_proyecto']; ?>">
                        <input type="hidden" name="id_estado_nuevo" value="2">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times"></i> Rechazar
                        </button>
                    </form>
                    
                    <form action="lib/lib-cambiar-estado-proyecto.php" method="POST" onsubmit="return confirm('¿Seguro que quieres APROBAR este proyecto? Se publicará.')">
                        <input type="hidden" name="id_proyecto" value="<?= $proyecto['id_proyecto']; ?>">
                        <input type="hidden" name="id_estado_nuevo" value="3">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Aprobar
                        </button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="alert alert-info mt-4">No hay proyectos pendientes de aprobación en este momento.</div>
    <?php endif; ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>