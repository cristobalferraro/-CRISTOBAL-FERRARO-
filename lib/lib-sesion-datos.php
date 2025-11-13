<?php
session_start();
require_once("lib-conexion.php");

$idUsuario = $_SESSION['id_us'] ?? null;

if ($idUsuario) {
    $stmt = $conexion->prepare("
        SELECT 
            u.id_us, u.nombre_completo, u.fecha_nacimiento, u.rut, u.email, 
            u.telefono, u.nombre_calle, 
            p.nombre AS pais, 
            c.comuna, 
            pr.nom_provincia AS provincia, 
            r.nombre_region AS region, 
            ro.nombre_rol AS rol, 
            u.id_rol
        FROM usuarios u
        JOIN pais p       ON p.id_pais = u.id_pais
        JOIN comuna c     ON c.id_comuna = u.id_comuna
        JOIN provincia pr ON pr.id_provincia = u.id_provincia
        JOIN region r     ON r.id_region = u.id_region
        JOIN roles ro     ON ro.id_rol = u.id_rol
        WHERE u.id_us = ?
    ");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    $_SESSION['id_rol'] = $usuario['id_rol'];
     $_SESSION['nombre'] = $usuario['nombre_completo'];
} else {
    $usuario = null;
}

function panelPorRol(?int $rol): ?array {
    if ($rol === 1) return ["Panel-admin.php", "Panel Admin"];
    if ($rol === 2) return ["crear-proyecto.php", "Panel "];
    return null;
}

$rol = isset($_SESSION['id_rol']) ? (int)$_SESSION['id_rol'] : null;
$panel = panelPorRol($rol);
$nombreMostrar = $usuario['nombre_completo'] ?? ($_SESSION['nombre'] ?? null);

?>