<?php
require_once("lib/lib-sesion-datos.php");

if (!$usuario) {
    header("Location: login.php");
    exit;
}

$id_usuario_actual = $usuario['id_us'];
$rol_usuario_actual = $usuario['id_rol'];

if ($rol_usuario_actual != 1 && $rol_usuario_actual != 2) {
    header("Location: crear-proyecto.php");
    exit;
}

require_once("lib/lib-conexion.php");
$sql_estados = "SELECT id_estado, tipo_estado FROM estados ORDER BY id_estado ASC";
$resultado_estados = $conexion->query($sql_estados);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proyecto - MiBarrioAp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo-index.css" rel="stylesheet">
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    <div class="card shadow-lg p-4">
        <h1 class="mb-4 text-center">🧩 Crear Nuevo Proyecto</h1>

        <form action="lib/lib-insertar-proyecto.php" method="POST" class="needs-validation" novalidate>
            <input type="hidden" name="id_usuario_creador" value="<?= $id_usuario_actual; ?>">

            <div class="mb-3">
                <label for="titulo" class="form-label fw-bold">Título del Proyecto</label>
                <input type="text" name="titulo" id="titulo" class="form-control" maxlength="150" required>
                <div class="invalid-feedback">Por favor ingresa un título.</div>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label fw-bold">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="5" class="form-control" required></textarea>
                <div class="invalid-feedback">Por favor ingresa una descripción.</div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fecha_inicio" class="form-label fw-bold">Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="fecha_fin" class="form-label fw-bold">Fecha de Fin</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="permite_postulacion" id="permite_postulacion" value="1">
                <label class="form-check-label" for="permite_postulacion">
                    Permitir que los vecinos postulen a este proyecto
                </label>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-save"></i> Guardar Proyecto
                </button>
                <a href="proyectos.php" class="btn btn-secondary btn-lg ms-2">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
</body>
</html>
