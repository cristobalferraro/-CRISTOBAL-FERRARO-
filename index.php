<?php 
require_once("lib/lib-sesion-datos.php"); 

$sql_anuncios = "SELECT titulo, contenido, importancia, fecha_creacion, imagen_url 
                 FROM anuncios 
                 ORDER BY fecha_creacion DESC LIMIT 5";
$resultado_anuncios = $conexion->query($sql_anuncios);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo-index.css?v=1.3" rel="stylesheet"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Bienvenido - MiBarrioAp</title>
</head>
<body>
<?php 
include("menu.php"); 
?>

<div class="container mt-5 mb-5">

    <div class="row mb-4">
        <div class="col-12 text-center">
            <?php if ($usuario): ?>
                <h1 class="display-4">¡Bienvenida/o, <?php echo htmlspecialchars(explode(' ', $usuario['nombre_completo'])[0]); ?>!</h1>
                <p class="lead fs-3">Bienvenido a tu portal vecinal.</p>
            <?php else: ?>
                <h1 class="display-4">Bienvenido al Portal Vecinal</h1>
                <p class="lead fs-3">Conéctate, participa y mantente informado.</p>
                <a href="login.php" class="btn btn-primary btn-lg">Iniciar Sesión</a>
                <a href="registrarse.php" class="btn btn-secondary btn-lg">Registrarse</a>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($usuario): // Solo mostrar si el usuario inició sesión ?>
    <div class="seccion-anuncios p-4 p-md-5 mb-5">
        <h2 class="text-center mb-4">Acceso Rápido</h2>
        <div class="row g-4">
            
            <div class="col-md-4">
                <a href="proyectos.php" class="card-portal card text-center h-100">
                    <div class="card-body p-4">
                        <i class="fas fa-project-diagram"></i>
                        <h3 class="card-title">Proyectos</h3>
                        <p class="card-text">Revisa las iniciativas e inscríbete.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="novedades.php" class="card-portal card text-center h-100">
                    <div class="card-body p-4">
                        <i class="fas fa-bullhorn"></i>
                        <h3 class="card-title">Noticias</h3>
                        <p class="card-text">Lee los últimos anuncios y novedades.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="calendario.php" class="card-portal card text-center h-100">
                    <div class="card-body p-4">
                        <i class="fas fa-calendar-alt"></i>
                        <h3 class="card-title">Reservas</h3>
                        <p class="card-text">Agenda el salón comunal y otros espacios.</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
    <?php endif; ?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="seccion-anuncios p-4 p-md-5">
                <h2 class="text-center mb-4"><i class="fas fa-bell"></i> Anuncios Recientes</h2>
                
                <?php if ($resultado_anuncios && $resultado_anuncios->num_rows > 0): ?>
                    <div class="list-group shadow-sm">
                    <?php
                    while ($anuncio = $resultado_anuncios->fetch_assoc()):
                        $clase_lista = ($anuncio['importancia'] == 'Urgente') ? 'list-group-item-warning' : '';
                        
                        $contenido_completo = $anuncio['contenido'];
                        $resumen = $contenido_completo;
                        $es_largo = false;
                        if (strlen($contenido_completo) > 200) {
                            $resumen = substr($contenido_completo, 0, 200) . "...";
                            $es_largo = true;
                        }
                    ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start <?= $clase_lista; ?> mb-2 border-0">
                            <div class="d-flex w-100 justify-content-between">
                                <h4 class="mb-1"><?= htmlspecialchars($anuncio['titulo']); ?></h4>
                                <small class="text-muted"><?= date('d/m/Y', strtotime($anuncio['fecha_creacion'])); ?></small>
                            </div>
                            <p class="mb-2 fs-5"><?= nl2br(htmlspecialchars($resumen)); ?></p>
                            <?php if ($es_largo): ?>
                                <a href="novedades.php" class="btn btn-sm btn-primary mt-2">Leer más...</a>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-secondary fs-5" role="alert">
                        No hay anuncios importantes por el momento.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>