<?php
session_start();
require_once("lib-conexion.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../admin-gestionar-reservas.php");
    exit;
}

if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_POST['id_reserva']) || !isset($_POST['id_estado_nuevo'])) {
    header("Location: ../admin-gestionar-reservas.php?error=faltan_datos");
    exit;
}
$id_reserva = $_POST['id_reserva'];
$id_estado_nuevo = $_POST['id_estado_nuevo'];

if ($id_estado_nuevo != 2 && $id_estado_nuevo != 3) {
    header("Location: ../admin-gestionar-reservas.php?error=estado_invalido");
    exit;
}

if ($id_estado_nuevo == 3) {
    
    $stmt_info = $conexion->prepare("SELECT id_espacio, fecha_inicio, fecha_fin FROM reservas WHERE id_reserva = ?");
    $stmt_info->bind_param("i", $id_reserva);
    $stmt_info->execute();
    $res_info = $stmt_info->get_result();
    $reserva_actual = $res_info->fetch_assoc();
    $stmt_info->close();

    $id_espacio = $reserva_actual['id_espacio'];
    $inicio = $reserva_actual['fecha_inicio'];
    $fin = $reserva_actual['fecha_fin'];

    $sql_conflicto = "SELECT id_reserva FROM reservas
                      WHERE id_espacio = ? 
                        AND id_estado = 3 
                        AND id_reserva != ?
                        AND (
                            (fecha_inicio < ? AND fecha_fin > ?) OR 
                            (fecha_inicio BETWEEN ? AND ?) OR       
                            (fecha_fin BETWEEN ? AND ?)           
                        )";
    
    $stmt_conflicto = $conexion->prepare($sql_conflicto);
    $stmt_conflicto->bind_param("iissssss", 
        $id_espacio, $id_reserva, 
        $fin, $inicio,             
        $inicio, $fin,             
        $inicio, $fin              
    );
    $stmt_conflicto->execute();
    $stmt_conflicto->store_result();

    if ($stmt_conflicto->num_rows > 0) {
        $stmt_conflicto->close();
        header("Location: ../admin-gestionar-reservas.php?status=conflict");
        exit;
    }
    $stmt_conflicto->close();
}

$sql_update = "UPDATE reservas SET id_estado = ? WHERE id_reserva = ?";
$stmt_update = $conexion->prepare($sql_update);
$stmt_update->bind_param("ii", $id_estado_nuevo, $id_reserva);

if ($stmt_update->execute()) {
    header("Location: ../admin-gestionar-reservas.php?status=ok");
} else {
    header("Location: ../admin-gestionar-reservas.php?error=sql_execute");
}

$stmt_update->close();
$conexion->close();
?>