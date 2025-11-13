<?php
require_once("lib/lib-sesion-datos.php");

// 1. Seguridad: Validar que venga el ID de la noticia
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: noticias.php?error=no_encontrado");
    exit;
}

// Recibir el ID
$id_noticia = intval($_GET['id']);

// 2. Obtener datos de la noticia
$sql_noticia = "SELECT 
                    a.id_anuncio,
                    a.titulo,
                    a.contenido,
                    a.imagen_url,
                    a.fecha_creacion,
                    u.nombre_completo AS creador_nombre
                FROM anuncios a
                JOIN usuarios u ON a.id_usuario_creador = u.id_us
                WHERE a.id_anuncio = ?";

$stmt = $conexion->prepare($sql_noticia);
$stmt->bind_param("i", $id_noticia);
$stmt->execute();
$resultado = $stmt->get_result();
$noticia = $resultado->fetch_assoc();
$stmt->close();

// 3. Si no existe la noticia, redirigir
if (!$noticia) {
    header("Location: noticias.php?error=no_disponible");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($noticia['titulo']); ?> - Detalle Noticia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="css/estilo-index.css?v=1.3" rel="stylesheet">
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">

                <?php if (!empty($noticia['imagen_url'])): ?>
                    <img src="uploads/<?= htmlspecialchars($noticia['imagen_url']); ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars($noticia['titulo']); ?>"
                         style="max-height: 400px; object-fit: cover;">
                <?php endif; ?>

                <div class="card-body p-4 p-md-5">
                    <a href="novedades.php" class="btn btn-sm btn-outline-secondary mb-4">
                        <i class="fas fa-arrow-left"></i> Volver a Noticias
                    </a>

                    <h1 class="display-5 fw-bold text-dark mb-3"><?= htmlspecialchars($noticia['titulo']); ?></h1>

                    <p class="text-muted mb-4">
                        <i class="fas fa-user"></i> Publicado por: 
                        <strong><?= htmlspecialchars($noticia['creador_nombre']); ?></strong><br>
                        <i class="fas fa-calendar-alt"></i> Fecha: 
                        <?= date('d/m/Y H:i', strtotime($noticia['fecha_creacion'])); ?> hrs.
                    </p>

                    <div class="fs-5 text-dark" style="white-space: pre-wrap;">
                        <?= nl2br(htmlspecialchars($noticia['contenido'])); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
