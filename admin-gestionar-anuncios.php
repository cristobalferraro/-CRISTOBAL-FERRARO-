<?php
require_once("lib/lib-sesion-datos.php");

// Seguridad: Solo Admin (Rol 1)
if (!$usuario || $usuario['id_rol'] != 1) {
    header("Location: index.php");
    exit();
}
$id_admin = $usuario['id_us'];

// Obtener anuncios existentes
$sql_anuncios = "SELECT a.*, u.nombre_completo AS creador 
                 FROM anuncios a 
                 JOIN usuarios u ON a.id_usuario_creador = u.id_us 
                 ORDER BY a.fecha_creacion DESC";
$resultado_anuncios = $conexion->query($sql_anuncios);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Anuncios y Noticias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="css/estilo-index.css?v=1.2" rel="stylesheet">
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    <div class="row g-5">
        
        <div class="col-lg-5">
            <div class="seccion-anuncios p-4">
                <h2><i class="fas fa-plus-circle"></i> Crear Nueva Noticia</h2>
                <hr>
                
                <?php
                if (isset($_GET['status']) && $_GET['status'] == 'ok') {
                    echo "<div class='alert alert-success'>Noticia publicada con éxito.</div>";
                }
                if (isset($_GET['error'])) {
                    echo "<div class='alert alert-danger'>Error: " . htmlspecialchars($_GET['error']) . "</div>";
                }
                ?>
                
                <form action="lib/lib-insertar-anuncio.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_usuario_creador" value="<?= $id_admin; ?>">

                    <div class="mb-3">
                        <label for="titulo" class="form-label fw-bold">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>

                    <div class="mb-3">
                        <label for="contenido" class="form-label fw-bold">Contenido</label>
                        <textarea class="form-control" id="contenido" name="contenido" rows="6" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label fw-bold">Imagen (Opcional)</label>
                        <input class="form-control" type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
                    </div>
                    <div class="mb-3">
                        <label for="importancia" class="form-label fw-bold">Importancia (para el Index)</label>
                        <select class="form-select" id="importancia" name="importancia">
                            <option value="Informativo">Informativo</option>
                            <option value="Urgente">Urgente (Destacado)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">Publicar Noticia</button>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="seccion-anuncios p-4">
                <h2><i class="fas fa-list-alt"></i> Noticias Publicadas</h2>
                <hr>
                
                <?php
                if (isset($_GET['status']) && $_GET['status'] == 'eliminado') {
                    echo "<div class='alert alert-success'>Noticia eliminada correctamente.</div>";
                }
                ?>

                <?php if ($resultado_anuncios && $resultado_anuncios->num_rows > 0): ?>
                    <ul class="list-group">
                        <?php while($anuncio = $resultado_anuncios->fetch_assoc()): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="d-block"><?= htmlspecialchars($anuncio['titulo']); ?></strong>
                                    <small class="text-muted">Por: <?= htmlspecialchars($anuncio['creador']); ?> - <?= date('d/m/Y', strtotime($anuncio['fecha_creacion'])); ?></small>
                                </div>
                                <a href="lib/lib-eliminar-anuncio.php?id=<?= $anuncio['id_anuncio']; ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('¿Seguro que quieres borrar esta noticia?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No hay noticias publicadas.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>