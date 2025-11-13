<?php
session_start();
require_once("lib-conexion.php");

// 1. Seguridad
if (!isset($_SESSION['id_us']) || !isset($_GET['id']) || !isset($_GET['accion'])) {
    header("Location: ../certificados.php?error=pago_invalido");
    exit;
}

$id_solicitud = $_GET['id'];
$accion = $_GET['accion'];
$id_usuario_actual = $_SESSION['id_us'];

// 2. Determinar el nuevo estado
if ($accion == 'pagar') {
    $nuevo_estado_pago = 2; // 2 = Pagado
    $status_msg = 'pagado';
} elseif ($accion == 'cancelar') {
    $nuevo_estado_pago = 3; // 3 = Cancelado
    $status_msg = 'cancelado';
} else {
    header("Location: ../certificados.php?error=accion_invalida");
    exit;
}

// 3. Actualizar la base de datos
// (Solo actualizamos si la solicitud pertenece al usuario)
$sql = "UPDATE solicitud_certificado 
        SET id_estado_pago = ? 
        WHERE id_solicitud = ? AND id_us = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iii", $nuevo_estado_pago, $id_solicitud, $id_usuario_actual);
$stmt->execute();
$stmt->close();
$conexion->close();

// 4. Redirigir de vuelta a la página de certificados
header("Location: ../certificados.php?status=" . $status_msg);
exit;
?>