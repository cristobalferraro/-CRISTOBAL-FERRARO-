<?php
require_once("lib-conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id_usuario        = intval($_POST['id_us']);
    $nombre_completo   = trim($_POST['nombre_completo']);
    $email             = trim($_POST['email']);
    $telefono          = trim($_POST['telefono']);
    $id_rol            = intval($_POST['id_rol']);
    $clave             = trim($_POST['clave']);

    if (!empty($clave)) {
        $sql = $conexion->prepare("
            UPDATE usuarios 
            SET nombre_completo = ?, email = ?, telefono = ?, id_rol = ?, clave = ? 
            WHERE id_us = ?
        ");
        $sql->bind_param("sssisi", $nombre_completo, $email, $telefono, $id_rol, $clave, $id_usuario);
    } else {
        $sql = $conexion->prepare("
            UPDATE usuarios 
            SET nombre_completo = ?, email = ?, telefono = ?, id_rol = ?
            WHERE id_us = ?
        ");
        $sql->bind_param("sssii", $nombre_completo, $email, $telefono, $id_rol, $id_usuario);
    }

    if ($sql->execute()) {
        echo "<script>alert('Usuario actualizado correctamente.'); window.location.href='../Panel-admin.php';</script>";
    } else {
        echo "Error al actualizar usuario: " . $sql->error;
    }

    $sql->close();
    $conexion->close();
} else {
    header("Location: ../Panel-admin.php");
    exit;
}
?>
