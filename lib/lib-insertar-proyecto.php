<?php
session_start();
require_once("lib-conexion.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../proyectos.php");
    exit;
}

if (!isset($_SESSION['id_us']) || !isset($_SESSION['id_rol']) || 
    ($_SESSION['id_rol'] != 1 && $_SESSION['id_rol'] != 2)) {
    header("Location: ../proyectos.php?error=no_permiso");
    exit;
}

$id_usuario_creador = intval($_POST['id_usuario_creador']);
$titulo = trim($_POST['titulo']);
$descripcion = trim($_POST['descripcion']);
$fecha_inicio = !empty($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : date('Y-m-d'); 
$fecha_fin = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : NULL;

$id_estado = 1;

$permite_postulacion = isset($_POST['permite_postulacion']) ? 1 : 0;

if ($id_usuario_creador != $_SESSION['id_us']) {
    header("Location: ../proyectos.php?error=creador_invalido");
    exit;
}

$sql = "INSERT INTO proyectos 
        (titulo, descripcion, fecha_inicio, fecha_fin, id_usuario_creador, id_estado, permite_postulacion)
        VALUES (?, ?, ?, ?, ?, ?, ?)"; 

$stmt = $conexion->prepare($sql);

$stmt->bind_param("ssssiii", 
    $titulo, 
    $descripcion, 
    $fecha_inicio, 
    $fecha_fin, 
    $id_usuario_creador, 
    $id_estado,
    $permite_postulacion 
);

if ($stmt->execute()) {
    header("Location: ../proyectos.php?status=creado_pendiente");
} else {
    header("Location: ../crear-proyecto.php?error=sql_insert");
}

$stmt->close();
$conexion->close();
?>