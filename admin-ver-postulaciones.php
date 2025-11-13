<?php
require_once("lib/lib-sesion-datos.php");

if (!$usuario || $usuario['id_rol'] != 1) {
    header("Location: index.php");
    exit();
}


$sql_proyectos_con_postulaciones = "SELECT DISTINCT
                                        p.id_proyecto,
                                        p.titulo
                                    FROM proyectos p
                                    JOIN postulaciones post ON p.id_proyecto = post.id_proyecto
                                    ORDER BY p.titulo ASC";

$resultado_proyectos = $conexion->query($sql_proyectos_con_postulaciones);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestionar Postulaciones a Proyectos</title>
    <style>
        .proyecto-grupo {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: .5rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
        }
        .proyecto-titulo {
            border-bottom: 2px solid #0d6efd;
            padding-bottom: .5rem;
            margin-bottom: 1rem;
            color: #0d6efd;
        }
    </style>
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    <h2 class="mb-3">Gestionar Postulaciones a Proyectos</h2>
    <p class="lead mb-4">Revisa qué vecinos se han inscrito en cada proyecto y gestiona las postulaciones.</p>

    <?php
    if (isset($_GET['status']) && $_GET['status'] == 'eliminado') {
        echo "<div class='alert alert-success'>Postulación eliminada correctamente.</div>";
    }
    if (isset($_GET['error'])) {
        echo "<div class='alert alert-danger'>Error al procesar la solicitud.</div>";
    }
    ?>

    <?php
    if ($resultado_proyectos && $resultado_proyectos->num_rows > 0):
        while ($proyecto = $resultado_proyectos->fetch_assoc()):
            $id_proyecto_actual = $proyecto['id_proyecto'];
            $titulo_proyecto = $proyecto['titulo'];

            $sql_postulantes = "SELECT
                                    post.id_postulacion,
                                    u.nombre_completo AS nombre_usuario,
                                    u.rut AS rut_usuario,
                                    post.fecha_postulacion
                                FROM postulaciones post
                                JOIN usuarios u ON post.id_usuario_postulante = u.id_us
                                WHERE post.id_proyecto = ?
                                ORDER BY post.fecha_postulacion DESC";

            $stmt_postulantes = $conexion->prepare($sql_postulantes);
            $stmt_postulantes->bind_param("i", $id_proyecto_actual);
            $stmt_postulantes->execute();
            $resultado_postulantes = $stmt_postulantes->get_result();
            $num_postulantes = $resultado_postulantes->num_rows;
    ?>
            <div class="proyecto-grupo shadow-sm">
                <h4 class="proyecto-titulo"><?= htmlspecialchars($titulo_proyecto); ?></h4>
                <p><strong><?= $num_postulantes; ?></strong> participante(s) inscrito(s):</p>

                <?php if ($num_postulantes > 0): ?>
                    <ul class="list-group">
                        <?php while ($postulante = $resultado_postulantes->fetch_assoc()): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?= htmlspecialchars($postulante['nombre_usuario']); ?></strong>
                                    (RUT: <?= htmlspecialchars($postulante['rut_usuario']); ?>)
                                    <br>
                                    <small class="text-muted">Fecha: <?= date('d/m/Y H:i', strtotime($postulante['fecha_postulacion'])); ?></small>
                                </div>
                                <a href="admin-eliminar-postulacion.php?id=<?= $postulante['id_postulacion']; ?>"
                                   class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('¿Estás seguro de eliminar esta postulación?');">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif;  ?>
                <?php $stmt_postulantes->close(); ?>
            </div>
    <?php
        endwhile; 
    else: 
    ?>
        <div class="alert alert-info text-center mt-4">
            Aún no hay postulaciones registradas para ningún proyecto.
        </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</body>
</html>