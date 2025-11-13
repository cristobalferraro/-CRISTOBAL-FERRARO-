<?php
session_start();
require_once("lib-conexion.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../proyectos.php");
    exit;
}

if (!isset($_SESSION['id_us']) || !isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 3) {
    header("Location: ../proyectos.php?error=no_permiso_postular");
    exit;
}

if (!isset($_POST['id_proyecto']) || !isset($_POST['id_usuario'])) {
    header("Location: ../proyectos.php?error=faltan_datos");
    exit;
}
$id_proyecto = $_POST['id_proyecto'];
$id_usuario_postulante = $_POST['id_usuario'];

if ($id_usuario_postulante != $_SESSION['id_us']) {
    header("Location: ../proyectos.php?error=usuario_invalido");
    exit;
}

$sql = "INSERT INTO postulaciones (id_proyecto, id_usuario_postulante) VALUES (?, ?)";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("ii", $id_proyecto, $id_usuario_postulante);

if ($stmt->execute()) {
    header("Location: ../proyectos.php?status=postulado");
} else {
    if ($conexion->errno == 1062) { 
        header("Location: ../proyectos.php?error=ya_postulado");
    } else {
        header("Location: ../proyectos.php?error=sql_postular");
    }
}

$stmt->close();
$conexion->close();
?>