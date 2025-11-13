<?php
require_once("lib/lib-sesion-datos.php");

if (!$usuario) {
    header("Location: login.php?error=3");
    exit;
}
$id_usuario_actual = $usuario['id_us'];

$espacios = $conexion->query("SELECT * FROM espacios_comunales ORDER BY nombre_espacio");

$mensaje = "";
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'ok') {
        $mensaje = "<div class='alert alert-success'>¡Solicitud de reserva enviada correctamente! Está pendiente de aprobación.</div>";
    } elseif ($_GET['status'] == 'error_fecha') {
        $mensaje = "<div class='alert alert-danger'>Error: La fecha de inicio no puede ser posterior a la fecha de fin.</div>";
    } elseif ($_GET['status'] == 'error_pasado') {
        $mensaje = "<div class='alert alert-danger'>Error: No puedes reservar en una fecha que ya pasó.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Espacios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="css/estilo-index.css?v=1.2" rel="stylesheet">
    
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <style>
        #calendario { max-width: 1100px; margin: 0 auto; background-color: white; padding: 15px; border-radius: 10px; }
    </style>
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    
    <div class="seccion-anuncios p-4 p-md-5 mb-5">
        <h2><i class="fas fa-calendar-plus"></i> Solicitar Reserva de Espacio</h2>
        <p>Completa el formulario para solicitar un espacio. Tu solicitud será revisada por un administrador.</p>
        
        <?= $mensaje;  ?>

        <form action="lib/lib-insertar-reserva.php" method="POST">
            <input type="hidden" name="id_usuario_reserva" value="<?= $id_usuario_actual; ?>">
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="titulo_evento" class="form-label fw-bold">Nombre del Evento</label>
                    <input type="text" class="form-control" name="titulo_evento" id="titulo_evento" placeholder="Ej: Cumpleaños, Reunión, etc." required>
                </div>
                <div class="col-md-6">
                    <label for="id_espacio" class="form-label fw-bold">Espacio Solicitado</label>
                    <select name="id_espacio" id="id_espacio" class="form-select" required>
                        <option value="">Selecciona un espacio...</option>
                        <?php while($espacio = $espacios->fetch_assoc()): ?>
                            <option value="<?= $espacio['id_espacio']; ?>"><?= htmlspecialchars($espacio['nombre_espacio']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="fecha_inicio" class="form-label fw-bold">Inicio del Evento</label>
                    <input type="datetime-local" class="form-control" name="fecha_inicio" id="fecha_inicio" required>
                </div>
                <div class="col-md-6">
                    <label for="fecha_fin" class="form-label fw-bold">Fin del Evento</label>
                    <input type="datetime-local" class="form-control" name="fecha_fin" id="fecha_fin" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg mt-4">Enviar Solicitud</button>
        </form>
    </div>

    <h2 class="text-center mb-4"><i class="fas fa-calendar-alt"></i> Calendario de Ocupación</h2>
    <div id='calendario' class="shadow-sm"></div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendario');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', 
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events: 'lib/lib-cargar-reservas.php',
        
        eventTimeFormat: { 
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        }
    });
    calendar.render();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>