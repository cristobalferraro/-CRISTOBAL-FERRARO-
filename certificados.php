<?php
require_once("lib/lib-sesion-datos.php");
if (!$usuario) {
    header("Location: login.php?error=3"); 
    exit;
}
$id_usuario_actual = $usuario['id_us']; 

// (NUEVO) Manejo de mensajes de estado del pago
$mensaje_pago = "";
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'pagado') {
        $mensaje_pago = "<div class='alert alert-success'>¡Pago procesado exitosamente! Tu solicitud está en revisión.</div>";
    } elseif ($_GET['status'] == 'cancelado') {
        $mensaje_pago = "<div class='alert alert-info'>El pago fue cancelado. Puedes intentarlo de nuevo desde tu lista de solicitudes.</div>";
    }
}
if (isset($_GET['error'])) {
     $mensaje_pago = "<div class='alert alert-danger'>Error: " . htmlspecialchars($_GET['error']) . "</div>";
}

// 1. Cargar tipos de certificados para el formulario
$certificados = $conexion->query("SELECT id_certi, nombre_certificado FROM tipo_certificado");

// 2. Cargar solicitudes antiguas (como ya lo hacía)
$sql_solicitudes = "
  SELECT s.id_solicitud, t.nombre_certificado, e.tipo_estado, 
         p.nombre_estado_pago, s.id_estado_pago, s.motivo, s.fecha_solicitud
  FROM solicitud_certificado s
  INNER JOIN tipo_certificado t ON s.id_certi = t.id_certi
  INNER JOIN estados e ON s.id_estado = e.id_estado
  INNER JOIN estado_pago p ON s.id_estado_pago = p.id_estado_pago
  WHERE s.id_us = ? 
  ORDER BY s.fecha_solicitud DESC
";
$stmt = $conexion->prepare($sql_solicitudes);
$stmt->bind_param("i", $id_usuario_actual);
$stmt->execute();
$solicitudes = $stmt->get_result(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/estilo-index.css?v=1.3" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <title>Certificados</title>
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
  <div class="row g-5">

    <div class="col-lg-5">
      <div class="seccion-anuncios p-4">
        <h2 class="mb-3"><i class="fas fa-file-alt"></i> Solicitar Certificado</h2>
        <p>Completa el formulario para iniciar tu solicitud. Esto te llevará a la simulación de pago.</p>
        
        <form action="lib/lib-insert-cert.php" method="POST">
          <div class="mb-3">
            <label for="id_certi" class="form-label fw-bold">Tipo de Certificado</label>
            <select name="id_certi" id="id_certi" class="form-select" required>
              <option value="">Selecciona un tipo...</option>
              <?php while($cert = $certificados->fetch_assoc()): ?>
                <option value="<?= $cert['id_certi']; ?>"><?= htmlspecialchars($cert['nombre_certificado']); ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="motivo" class="form-label fw-bold">Motivo</label>
            <textarea name="motivo" id="motivo" class="form-control" rows="3" placeholder="Ej: Trámite municipal, bono, etc." required></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-lg w-100">
            <i class="fas fa-dollar-sign"></i> Ir a Pagar
          </button>
        </form>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="seccion-anuncios p-4">
        <h2 class="mb-3"><i class="fas fa-history"></i> Historial de Solicitudes</h2>
        
        <?= $mensaje_pago; // Muestra mensajes de éxito/error del pago ?>

        <?php if ($solicitudes && $solicitudes->num_rows > 0): ?>
          <div class="list-group">
            <?php while($row = $solicitudes->fetch_assoc()): ?>
              <?php
              // Color para el estado del Admin
              $color_estado = 'secondary';
              if ($row['tipo_estado'] == 'Aprobado') $color_estado = 'success';
              if ($row['tipo_estado'] == 'Rechazado') $color_estado = 'danger';

              // Color para el estado del Pago
              $color_pago = 'secondary';
              if ($row['id_estado_pago'] == 2) $color_pago = 'success'; // Pagado
              if ($row['id_estado_pago'] == 3) $color_pago = 'danger'; // Cancelado
              ?>
              <div class="list-group-item list-group-item-action flex-column align-items-start mb-2 border-0 shadow-sm">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1"><?= htmlspecialchars($row['nombre_certificado']); ?></h5>
                  <small class="text-muted"><?= date('d/m/Y', strtotime($row['fecha_solicitud'])); ?></small>
                </div>
                <p class="mb-1"><strong>Motivo:</strong> <?= htmlspecialchars($row['motivo']); ?></p>
                
                <span class="badge bg-<?= $color_estado; ?>">Admin: <?= htmlspecialchars($row['tipo_estado']); ?></span>
                <span class="badge bg-<?= $color_pago; ?>">Pago: <?= htmlspecialchars($row['nombre_estado_pago']); ?></span>
                
                <?php if ($row['id_estado_pago'] == 1 || $row['id_estado_pago'] == 3): // Si está Pendiente o Cancelado ?>
                  <a href="pago-certificado.php?id=<?= $row['id_solicitud']; ?>" class="btn btn-warning btn-sm float-end">
                    Pagar Ahora
                  </a>

                <?php endif; ?>
               <?php
// Solo se puede descargar si:
// - Pago realizado (2)
// - Aprobado (estado admin = Aprobado)
// - Usuario es rol 3
$puede_descargar = (
    $row['id_estado_pago'] == 2 &&         // pagado
    $row['tipo_estado'] == 'Aprobado' &&   // aprobado por admin
    $usuario['id_rol'] == 3                // solo rol 3
);
?>

<?php if ($puede_descargar): ?>
    <a href="generar-certificado-pdf.php?id=<?= $row['id_solicitud']; ?>"
       class="btn btn-success btn-sm float-end"
       target="_blank"
       onclick="return confirm('¿Descargar certificado en PDF?');">
        <i class="fas fa-file-pdf"></i> Descargar PDF
    </a>
<?php endif; ?>
              </div>
            <?php endwhile; ?>
          </div>
        <?php else: ?>
          <p class="fs-5 text-muted">Aún no has solicitado certificados.</p>
        <?php endif; ?>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>