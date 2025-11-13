<?php
require_once("lib/lib-sesion-datos.php");

// Seguridad: Solo Admin (Rol 1)
if (!$usuario || $usuario['id_rol'] != 1) {
    header("Location: index.php");
    exit();
}

// SQL MODIFICADA: Ahora trae el estado del PAGO
$sql_pendientes = "SELECT 
                        s.id_solicitud,
                        s.motivo,
                        s.fecha_solicitud,
                        s.id_estado_pago, -- (Nuevo) ID del estado de pago
                        u.nombre_completo AS vecino_nombre,
                        u.rut AS vecino_rut,
                        t.nombre_certificado,
                        ep.nombre_estado_pago -- (Nuevo) Nombre del estado de pago
                   FROM solicitud_certificado s
                   JOIN usuarios u ON s.id_us = u.id_us
                   JOIN tipo_certificado t ON s.id_certi = t.id_certi
                   JOIN estado_pago ep ON s.id_estado_pago = ep.id_estado_pago
                   WHERE s.id_estado = 1 -- Solo solicitudes pendientes (Admin)
                   ORDER BY s.fecha_solicitud ASC"; 

$resultado_pendientes = $conexion->query($sql_pendientes);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Certificados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="css/estilo-index.css?v=1.3" rel="stylesheet">
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    <div class="seccion-anuncios p-4 p-md-5"> 
        <h2><i class="fas fa-file-signature"></i> Gestionar Solicitudes de Certificados</h2>
        <p class="lead">Revisa las solicitudes pendientes de los vecinos.</p>

        <?php
        if (isset($_GET['status']) && $_GET['status'] == 'rechazado') {
            echo "<div class='alert alert-success'>Solicitud rechazada correctamente.</div>";
        }
        if (isset($_GET['status']) && $_GET['status'] == 'aprobado') {
            echo "<div class='alert alert-success'>Solicitud marcada como Aprobada (PDF generado).</div>";
        }
        ?>

        <?php if ($resultado_pendientes && $resultado_pendientes->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mt-4">
                    <thead class="table-light">
                        <tr>
                            <th>Vecino (RUT)</th>
                            <th>Certificado</th>
                            <th>Fecha Solicitud</th>
                            <th>(NUEVO) Estado del Pago</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($solicitud = $resultado_pendientes->fetch_assoc()): ?>
                            <?php
                            // Lógica para el color del badge de pago
                            $pago_realizado = ($solicitud['id_estado_pago'] == 2); // 2 = Pagado
                            $color_pago = 'secondary'; // Pendiente
                            if ($pago_realizado) {
                                $color_pago = 'success'; // Pagado
                            } elseif ($solicitud['id_estado_pago'] == 3) {
                                $color_pago = 'danger'; // Cancelado
                            }
                            ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($solicitud['vecino_nombre']); ?><br>
                                    <small class="text-muted"><?= htmlspecialchars($solicitud['vecino_rut']); ?></small>
                                </td>
                                <td><?= htmlspecialchars($solicitud['nombre_certificado']); ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($solicitud['fecha_solicitud'])); ?></td>
                                
                                <td>
                                    <span class="badge bg-<?= $color_pago; ?>">
                                        <?= htmlspecialchars($solicitud['nombre_estado_pago']); ?>
                                    </span>
                                </td>
                                
                                <td class="text-end">
                                    <form action="lib/lib-cambiar-estado-certificado.php" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que quieres RECHAZAR esta solicitud?')">
                                        <input type="hidden" name="id_solicitud" value="<?= $solicitud['id_solicitud']; ?>">
                                        <input type="hidden" name="id_estado_nuevo" value="2">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i> Rechazar
                                        </button>
                                    </form>
                                    
                                    <a href="generar-certificado-pdf.php?id=<?= $solicitud['id_solicitud']; ?>" 
                                       class="btn btn-sm btn-success <?= $pago_realizado ? '' : 'disabled'; ?>"
                                       <?php if (!$pago_realizado): ?>
                                            onclick="alert('El pago de este certificado aún está pendiente o fue cancelado.'); return false;"
                                            title="El pago aún está pendiente"
                                       <?php else: ?>
                                            onclick="return confirm('Esto generará el PDF y marcará la solicitud como Aprobada. ¿Continuar?')"
                                            target="_blank"
                                       <?php endif; ?>
                                    >
                                        <i class="fas fa-file-pdf"></i> Generar PDF
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info mt-4">No hay solicitudes de certificados pendientes.</div>
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>