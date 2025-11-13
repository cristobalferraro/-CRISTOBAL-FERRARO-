<?php
session_start();
require_once("lib-conexion.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../admin-gestionar-certificados.php");
    exit;
}

if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_POST['id_solicitud']) || !isset($_POST['id_estado_nuevo'])) {
    header("Location: ../admin-gestionar-certificados.php?error=faltan_datos");
    exit;
}
$id_solicitud = $_POST['id_solicitud'];
$id_estado_nuevo = $_POST['id_estado_nuevo'];

if ($id_estado_nuevo != 2 && $id_estado_nuevo != 3) {
    header("Location: ../admin-gestionar-certificados.php?error=estado_invalido");
    exit;
}

$sql = "UPDATE solicitud_certificado SET id_estado = ? WHERE id_solicitud = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    header("Location: ../admin-gestionar-certificados.php?error=sql_prepare");
    exit();
}

$stmt->bind_param("ii", $id_estado_nuevo, $id_solicitud);

if ($stmt->execute()) {
    header("Location: ../admin-gestionar-certificados.php?status=ok");
} else {
    header("Location: ../admin-gestionar-certificados.php?error=sql_execute");
}

$stmt->close();
$conexion->close();
?>