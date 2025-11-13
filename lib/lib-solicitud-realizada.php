<?php
require_once("lib-sesion-datos.php");

if (!$usuario) {
    header("Location: login.php");
    exit;
}

if ($usuario['id_rol'] == 1) {
    header("Location: Panel-admin.php");
    exit;
}

$mensaje = "";
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'ok') {
        $mensaje = "<div class='alert alert-success fs-5'>¡Solicitud enviada con éxito!</div>";
    } else {
        $mensaje = "<div class='alert alert-danger fs-5'>Hubo un error al enviar tu solicitud.</div>";
    }
}

$id_us_actual = $usuario['id_us'];

$sql_historial = "
    SELECT 
        s.id_solicitud,
        s.asunto,
        s.descripcion,
        t.tipo_soli AS tipo_solicitud,
        e.tipo_estado AS estado,
        s.fecha_creacion
    FROM solicitud s
    JOIN tipo_solicitud t ON t.id_tipo_soli = s.id_tipo_soli
    JOIN estados e ON e.id_estado = s.id_estado
    WHERE s.id_usuario_solicita = ?
    ORDER BY s.fecha_creacion DESC
";

$stmt_historial = $conexion->prepare($sql_historial);
$stmt_historial->bind_param("i", $id_us_actual);
$stmt_historial->execute();
$resultado_historial = $stmt_historial->get_result();

$sql_tipo = "SELECT id_tipo_soli, tipo_soli FROM tipo_solicitud ORDER BY tipo_soli ASC";
$resultado_tipos = $conexion->query($sql_tipo);
?>
