<?php
// lib/lib-insert-cert.php
session_start();
require_once("lib-conexion.php");

// 1. Seguridad y validación
if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_SESSION['id_us'])) {
    // Si no es POST o no hay sesión, va a certificados
    header("Location: ../certificados.php?error=acceso_denegado");
    exit;
}
if (!isset($_POST['id_certi']) || !isset($_POST['motivo'])) {
    // Si faltan datos del formulario
    header("Location: ../certificados.php?error=faltan_datos");
    exit;
}

// 2. Recibir datos del formulario
$id_certi = $_POST['id_certi'];
$motivo = trim($_POST['motivo']);
$id_us = $_SESSION['id_us'];

// 3. Definir valores del pago (Según tu BD barrio.sql)
$monto = 1000; // Precio fijo del certificado (o el que definas)
$id_estado_pago = 1; // 1 = Pendiente de Pago
$id_estado_admin = 1;

$sql = "INSERT INTO solicitud_certificado 
            (id_us, id_certi, motivo, id_estado, monto_pagar, id_estado_pago) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("iisiii", 
    $id_us, 
    $id_certi, 
    $motivo, 
    $id_estado_admin, 
    $monto, 
    $id_estado_pago
);

if ($stmt->execute()) {
    $id_solicitud_creada = $conexion->insert_id;
    

    header("Location: ../pago-certificado.php?id=" . $id_solicitud_creada);
    exit;

} else {
    header("Location: ../certificados.php?error=sql_insert");
    exit;
}

$stmt->close();
$conexion->close();
?>