<?php
require_once("lib/lib-sesion-datos.php");

if (!$usuario || $usuario['id_rol'] != 1) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin-ver-postulaciones.php?error=no_id");
    exit();
}
$id_postulacion_a_eliminar = $_GET['id'];

$sql = "DELETE FROM postulaciones WHERE id_postulacion = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    header("Location: admin-ver-postulaciones.php?error=sql_prepare");
    exit();
}

$stmt->bind_param("i", $id_postulacion_a_eliminar);

if ($stmt->execute()) {
    header("Location: admin-ver-postulaciones.php?status=eliminado");
} else {
    header("Location: admin-ver-postulaciones.php?error=sql_execute");
}

$stmt->close();
$conexion->close();
?>