<?php
session_start();
require_once("lib-conexion.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_SESSION['id_us'])) {
    header("Location: ../calendario.php");
    exit;
}

$id_usuario_reserva = $_POST['id_usuario_reserva'];
$id_espacio = $_POST['id_espacio'];
$titulo_evento = trim($_POST['titulo_evento']);
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$id_estado = 1; // estado siempre pendiente

if ($id_usuario_reserva != $_SESSION['id_us']) {
    header("Location: ../calendario.php?error=usuario_invalido");
    exit;
}

$inicio_dt = new DateTime($fecha_inicio);
$fin_dt = new DateTime($fecha_fin);
$ahora = new DateTime();

if ($inicio_dt < $ahora) {
    header("Location: ../reservas.php?status=error_pasado");
    exit;
}
if ($inicio_dt >= $fin_dt) {
    header("Location: ../reservas.php?status=error_fecha");
    exit;
}

$sql = "INSERT INTO reservas (id_espacio, id_usuario_reserva, titulo_evento, fecha_inicio, fecha_fin, id_estado)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iisssi", $id_espacio, $id_usuario_reserva, $titulo_evento, $fecha_inicio, $fecha_fin, $id_estado);

if ($stmt->execute()) {
    header("Location: ../calendario.php?status=ok");
} else {
    header("Location: ../calendario.php?status=error_sql");
}
$stmt->close();
$conexion->close();
?>