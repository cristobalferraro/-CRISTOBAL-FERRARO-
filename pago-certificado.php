<?php
require_once("lib/lib-sesion-datos.php");

// 1. Validar que el usuario esté logueado y que tengamos un ID
if (!$usuario) {
    header("Location: login.php");
    exit;
}
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: certificados.php?error=pago_invalido");
    exit;
}

$id_solicitud = $_GET['id'];
$id_usuario_actual = $usuario['id_us'];

// 2. Buscar los datos de la solicitud
$sql = "SELECT s.monto_pagar, s.id_us, t.nombre_certificado
        FROM solicitud_certificado s
        JOIN tipo_certificado t ON s.id_certi = t.id_certi
        WHERE s.id_solicitud = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_solicitud);
$stmt->execute();
$resultado = $stmt->get_result();
$solicitud = $resultado->fetch_assoc();
$stmt->close();

// 3. Seguridad: Si no existe o no pertenece al usuario, lo sacamos
if (!$solicitud || $solicitud['id_us'] != $id_usuario_actual) {
     header("Location: certificados.php?error=pago_ajeno");
     exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo-index.css?v=1.3" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .pago-card { max-width: 500px; margin: 0 auto; }
        .pago-header { background-color: #0d6efd; color: white; }
    </style>
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            
            <div class="card shadow-lg pago-card">
                <div class="card-header pago-header text-center">
                    <h2 class="mb-0"><i class="fas fa-shield-alt"></i> Simulación de Pago Seguro</h2>
                </div>
                <div class="card-body p-4 text-center">
                    <h3 class="card-title">Resumen de la Orden</h3>
                    <p class="lead fs-4">Estás pagando por:</p>
                    <h1 class="display-6 fw-bold"><?= htmlspecialchars($solicitud['nombre_certificado']); ?></h1>
                    
                    <hr class="my-4">
                    
                    <p class="lead fs-5">Monto a Pagar:</p>
                    <h1 class="display-3 fw-bold mb-4">$<?= number_format($solicitud['monto_pagar'], 0, ',', '.'); ?></h1>

                    <p class="text-muted">Esto es solo una simulación para el proyecto. No se procesará ningún pago real.</p>
                    
                    <div class="d-grid gap-2 mt-4">
                        <form action="lib/lib-procesar-pago.php?accion=pagar&id=<?= $id_solicitud; ?>" method="POST" onsubmit="return confirm('Simular PAGO EXITOSO')">
                            <button type="submit" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-check-circle"></i> Pagar (Simulación Exitosa)
                            </button>
                        </form>
                        
                        <form action="lib/lib-procesar-pago.php?accion=cancelar&id=<?= $id_solicitud; ?>" method="POST" onsubmit="return confirm('Simular PAGO CANCELADO')">
                            <button type="submit" class="btn btn-danger btn-lg w-100 mt-2">
                                <i class="fas fa-times-circle"></i> Cancelar Pago
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>