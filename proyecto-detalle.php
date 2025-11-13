<?php
require_once("lib/lib-sesion-datos.php");

// 1. Seguridad: Si no hay usuario, a login
if (!$usuario) {
    header("Location: login.php");
    exit;
}
 
$id_usuario_actual = $usuario['id_us'];
$rol_usuario_actual = $usuario['id_rol'];

// 2. Seguridad: Validar el ID del proyecto desde la URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: proyectos.php?error=no_encontrado");
    exit;
}
$id_proyecto = intval($_GET['id']);


// 3. Obtener los datos del proyecto (SQL corregida, usa 'estados')
$sql_proyecto = "SELECT 
    p.id_proyecto,
    p.permite_postulacion, 
    p.titulo,
    p.descripcion,
    DATE_FORMAT(p.fecha_inicio, '%d/%m/%Y') AS fecha_inicio,
    DATE_FORMAT(p.fecha_fin, '%d/%m/%Y') AS fecha_fin,
    u.nombre_completo AS creador_nombre,
    p.id_estado
FROM proyectos p
JOIN usuarios u ON p.id_usuario_creador = u.id_us
JOIN estados e ON p.id_estado = e.id_estado 
WHERE p.id_proyecto = ?";

$stmt = $conexion->prepare($sql_proyecto);
$stmt->bind_param("i", $id_proyecto);
$stmt->execute();
$resultado = $stmt->get_result();
$proyecto = $resultado->fetch_assoc();
$stmt->close();

// 4. Seguridad: Si el proyecto no existe O no está Aprobado (id_estado 3), no lo mostramos.
if (!$proyecto || $proyecto['id_estado'] != 3) {
    header("Location: proyectos.php?error=no_disponible");
    exit;
}

// 5. Lógica de postulación (solo para esta página)
$ya_postulo = false;
if ($rol_usuario_actual == 3 && $proyecto['permite_postulacion'] == 1) {
    $sql_post = "SELECT id_postulacion FROM postulaciones WHERE id_usuario_postulante = ? AND id_proyecto = ?";
    $stmt_post = $conexion->prepare($sql_post);
    $stmt_post->bind_param("ii", $id_usuario_actual, $id_proyecto);
    $stmt_post->execute();
    $stmt_post->store_result();
    if ($stmt_post->num_rows > 0) {
        $ya_postulo = true;
    }
    $stmt_post->close();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle: <?= htmlspecialchars($proyecto['titulo']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="css/estilo-index.css?v=1.3" rel="stylesheet">
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    <a href="proyectos.php" class="btn btn-sm btn-outline-secondary mb-3">
                        <i class="fas fa-arrow-left"></i> Volver a Proyectos
                    </a>

                    <h1 class="display-5 fw-bold text-dark mb-3"><?= htmlspecialchars($proyecto['titulo']); ?></h1>
                    
                    <p class="card-subtitle text-muted fs-5 mb-4">
                        <i class="fas fa-calendar-alt"></i> 
                        Inicio: <?= $proyecto['fecha_inicio'] ?? 'N/A'; ?> | 
                        Fin: <?= $proyecto['fecha_fin'] ?? 'N/A'; ?>
                    </p>

                    <div class="fs-4 text-dark" style="white-space: pre-wrap;"><?= htmlspecialchars($proyecto['descripcion']); ?></div>
                    
                </div>
            </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="fw-bold">Detalles del Proyecto</h5>
                    <hr>
                    <p class="small text-muted fst-italic">
                        Publicado por:<br>
                        <strong><?= htmlspecialchars($proyecto['creador_nombre']); ?></strong>
                    </p>

                    <?php
                    // Mostrar botón SOLO si:
                    // 1. El proyecto lo permite (permite_postulacion == 1)
                    // 2. El usuario es Vecino (Rol 3)
                    if ($proyecto['permite_postulacion'] == 1 && $rol_usuario_actual == 3):
                    ?>
                        <hr>
                        <h5 class="fw-bold">Participar</h5>
                        <p class="text-muted small">Inscríbete para participar en esta iniciativa.</p>
                        
                        <form action="lib/lib-postular-proyecto.php" method="POST" class="mt-3">
                            <input type="hidden" name="id_proyecto" value="<?= $id_proyecto; ?>">
                            <input type="hidden" name="id_usuario" value="<?= $id_usuario_actual; ?>">
                            <button type="submit" class="btn btn-success w-100 btn-lg" 
                                <?= $ya_postulo ? 'disabled' : ''; ?> 
                                onclick="return confirm('¿Estás seguro de que quieres inscribirte en este proyecto?');">
                                <i class="fas fa-check-circle"></i> <?= $ya_postulo ? 'Ya estás Inscrito' : '¡Quiero Participar!'; ?>
                            </button>
                        </form>
                        
                    <?php elseif ($proyecto['permite_postulacion'] == 0): ?>
                        <hr>
                        <span class="badge bg-light text-dark fs-6">Este proyecto no permite postulaciones.</span>
                    <?php endif; ?>
                    </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>