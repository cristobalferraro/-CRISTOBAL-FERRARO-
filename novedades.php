<?php
require_once("lib/lib-sesion-datos.php");

// Consultar TODAS las noticias, uniéndolas con el nombre del creador
$sql_noticias = "SELECT 
                    a.id_anuncio,
                    a.titulo,
                    a.contenido,
                    a.imagen_url,
                    a.fecha_creacion,
                    u.nombre_completo AS creador_nombre
                 FROM anuncios a
                 JOIN usuarios u ON a.id_usuario_creador = u.id_us
                 ORDER BY a.fecha_creacion DESC";

$resultado_noticias = $conexion->query($sql_noticias);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="css/estilo-index.css?v=1.2" rel="stylesheet">

</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    <div class="seccion-anuncios p-4 p-md-5">
        <h1 class="display-5 mb-4"><i class="fas fa-bullhorn"></i> Noticias y Novedades</h1>

        <?php if ($resultado_noticias && $resultado_noticias->num_rows > 0): ?>
            <div class="row g-4">
                
                <?php while ($noticia = $resultado_noticias->fetch_assoc()): ?>
                    <div class="col-md-6">
                        <div class="card shadow-sm h-100">
                            
                            <?php if (!empty($noticia['imagen_url'])): ?>
                                <img src="uploads/<?= htmlspecialchars($noticia['imagen_url']); ?>" 
                                     class="card-img-top" 
                                     alt="<?= htmlspecialchars($noticia['titulo']); ?>" 
                                     style="height: 250px; object-fit: cover;">
                            <?php endif; ?>

                            <div class="card-body">
                                <h3 class="card-title"><?= htmlspecialchars($noticia['titulo']); ?></h3>
                                <p class="card-text"><?= nl2br(htmlspecialchars($noticia['contenido'])); ?></p>
                                <a class="boton" href="noticia-detalle.php?id=<?php echo $noticia['id_anuncio']; ?>">Leer mas</a>

                            
                            </div>
                            <div class="card-footer text-muted">
                                Publicado por: <?= htmlspecialchars($noticia['creador_nombre']); ?><br>
                                Fecha: <?= date('d/m/Y H:i', strtotime($noticia['fecha_creacion'])); ?> hrs.
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
        <?php else: ?>
            <div class="alert alert-info">No hay noticias publicadas por el momento.</div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>