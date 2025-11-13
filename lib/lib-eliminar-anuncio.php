<?php
session_start();
require_once("lib-conexion.php");

// Seguridad: Solo Admin (Rol 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../admin-gestionar-anuncios.php?error=no_id");
    exit;
}
$id_anuncio = $_GET['id'];

// 1. (NUEVO) Buscar el nombre de la imagen antes de borrar
$stmt_img = $conexion->prepare("SELECT imagen_url FROM anuncios WHERE id_anuncio = ?");
$stmt_img->bind_param("i", $id_anuncio);
$stmt_img->execute();
$resultado = $stmt_img->get_result();
$anuncio = $resultado->fetch_assoc();
$stmt_img->close();

if ($anuncio && !empty($anuncio['imagen_url'])) {
    // 2. (NUEVO) Si existe una imagen, borrar el archivo del servidor
    $ruta_archivo = "../uploads/" . $anuncio['imagen_url'];
    if (file_exists($ruta_archivo)) {
        unlink($ruta_archivo); // Borra el archivo de la carpeta /uploads/
    }
}

// 3. Borrar el registro de la Base de Datos (como antes)
$stmt_del = $conexion->prepare("DELETE FROM anuncios WHERE id_anuncio = ?");
$stmt_del->bind_param("i", $id_anuncio);

if ($stmt_del->execute()) {
    header("Location: ../admin-gestionar-anuncios.php?status=eliminado");
} else {
    header("Location: ../admin-gestionar-anuncios.php?error=sql_delete");
}

$stmt_del->close();
$conexion->close();
?>