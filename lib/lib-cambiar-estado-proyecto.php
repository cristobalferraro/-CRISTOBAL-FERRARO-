<?php
session_start();
require_once("lib-conexion.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../admin-aprobar-proyectos.php");
    exit;
}

if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_POST['id_proyecto']) || !isset($_POST['id_estado_nuevo'])) {
    header("Location: ../admin-aprobar-proyectos.php?error=faltan_datos");
    exit;
}
$id_proyecto = $_POST['id_proyecto'];
$id_estado_nuevo = $_POST['id_estado_nuevo']; 

if ($id_estado_nuevo != 2 && $id_estado_nuevo != 3) {
    header("Location: ../admin-aprobar-proyectos.php?error=estado_invalido");
    exit;
}

$sql = "UPDATE proyectos SET id_estado = ? WHERE id_proyecto = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    header("Location: ../admin-aprobar-proyectos.php?error=sql_prepare");
    exit();
}

$stmt->bind_param("ii", $id_estado_nuevo, $id_proyecto);

if ($stmt->execute()) {
    header("Location: ../admin-aprobar-proyectos.php?status=ok");
} else {
    header("Location: ../admin-aprobar-proyectos.php?error=sql_execute");
}

$stmt->close();
$conexion->close();
?>