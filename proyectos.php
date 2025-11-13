<?php
require_once("lib/lib-sesion-datos.php");

if (!$usuario) {
    header("Location: login.php");
    exit;
}

$id_usuario_actual = $usuario['id_us'];
$rol_usuario_actual = $usuario['id_rol'];

// (Obtener proyectos en los que ya postulé)
$proyectos_postulados = [];
if ($rol_usuario_actual == 3) {
    $sql_postulados = "SELECT id_proyecto FROM postulaciones WHERE id_usuario_postulante = ?";
    $stmt_post = $conexion->prepare($sql_postulados);
    $stmt_post->bind_param("i", $id_usuario_actual);
    $stmt_post->execute();
    $res_post = $stmt_post->get_result();
    while ($fila = $res_post->fetch_assoc()) {
        $proyectos_postulados[] = $fila['id_proyecto'];
    }
    $stmt_post->close();
}

// (Obtener todos los proyectos APROBADOS (id_estado = 3))
// SQL CORREGIDA: Sin 'tipo_proyecto' y con 'estados' (plural)
$sql_proyectos = "SELECT 
    p.id_proyecto,
    p.permite_postulacion, 
    p.titulo,
    p.descripcion,
    DATE_FORMAT(p.fecha_inicio, '%d/%m/%Y') AS fecha_inicio,
    DATE_FORMAT(p.fecha_fin, '%d/%m/%Y') AS fecha_fin,
    u.nombre_completo AS creador_nombre,
    DATE_FORMAT(p.fecha_creacion, '%d/%m/%Y') AS fecha_creacion,
    e.tipo_estado AS estado 
FROM proyectos p
JOIN usuarios u ON p.id_usuario_creador = u.id_us
JOIN estados e ON p.id_estado = e.id_estado 
WHERE p.id_estado = 3
ORDER BY p.fecha_creacion DESC";

$resultado_proyectos = $conexion->query($sql_proyectos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos - MiBarrioAp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="css/estilo-index.css?v=1.3" rel="stylesheet">
    <style>
        .project-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }
    </style>
</head>
<body>
<?php include("menu.php"); ?>

<div class="container-fluid py-5" style="background-color: #f8f9fa;">
    <div class="container">
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold text-dark">Proyectos Comunitarios</h1>
                <p class="fs-4 text-muted">Explora y participa en las iniciativas activas de nuestra comunidad.</p>
            </div>
            
            <?php if ($rol_usuario_actual == 1 || $rol_usuario_actual == 2): ?>
            <div class="col-md-4 text-md-end">
                <a href="crear-proyecto.php" class="btn btn-primary btn-lg shadow-sm">
                    <i class="fas fa-plus-circle"></i> Crear Nuevo Proyecto
                </a>
            </div>
            <?php endif; ?>
        </div>

        <div class="row g-4">
        <?php if ($resultado_proyectos && $resultado_proyectos->num_rows > 0): ?>
            <?php while ($proyecto = $resultado_proyectos->fetch_assoc()): ?>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 project-card">
                    <div class="card-body d-flex flex-column">
                        
                        <h4 class="card-title fw-bold text-dark mb-2">
                            <a href="proyecto-detalle.php?id=<?= $proyecto['id_proyecto']; ?>" class="text-dark text-decoration-none">
                                <?= htmlspecialchars($proyecto['titulo']); ?>
                            </a>
                        </h4>
                        
                        <p class="card-subtitle text-muted small mb-3">
                            <i class="fas fa-calendar-alt"></i> Inicio: <?= $proyecto['fecha_inicio'] ?? 'N/A'; ?> | Fin: <?= $proyecto['fecha_fin'] ?? 'N/A'; ?>
                        </p>
                        
                        <?php
                        $descripcion_completa = nl2br(htmlspecialchars($proyecto['descripcion']));
                        $limite_caracteres = 180; 
                        $descripcion_mostrada = $descripcion_completa;

                        if (strlen(strip_tags($descripcion_completa)) > $limite_caracteres) {
                            $descripcion_mostrada = substr($descripcion_completa, 0, $limite_caracteres) . "...";
                        }
                        ?>
                        
                        <p class="card-text fs-5 text-dark flex-grow-1">
                            <?= $descripcion_mostrada; ?>
                        </p>
                        
                        <p class="card-text small text-muted fst-italic mt-3 mb-4">
                            Publicado por: <?= htmlspecialchars($proyecto['creador_nombre']); ?>
                        </p>

                        <?php
                        // Lógica del botón de postulación
                        if ($proyecto['permite_postulacion'] == 1 && $rol_usuario_actual == 3):
                            $id_proyecto_actual = $proyecto['id_proyecto'];
                            $ya_postulo = in_array($id_proyecto_actual, $proyectos_postulados);
                        ?>
                            <form action="lib/lib-postular-proyecto.php" method="POST" class="mt-3">
                                <input type="hidden" name="id_proyecto" value="<?= $id_proyecto_actual; ?>">
                                <input type="hidden" name="id_usuario" value="<?= $id_usuario_actual; ?>">
                                <button type="submit" class="btn btn-success w-100" 
                                    <?= $ya_postulo ? 'disabled' : ''; ?> 
                                    onclick="return confirm('¿Estás seguro de que quieres inscribirte en este proyecto?');">
                                    <i class="fas fa-check-circle"></i> <?= $ya_postulo ? 'Ya estás Inscrito' : '¡Quiero Participar!'; ?>
                                </button>
                            </form>
                        <?php endif; ?>
                        </div>
                </div>
            </div>

        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-info text-center mt-5 shadow-sm">
                <i class="fas fa-info-circle"></i> No hay proyectos publicados aún.
            </div>
        </div>
    <?php endif; ?>
    </div> </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>