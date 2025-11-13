<?php
require_once("lib-conexion.php"); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id_usuario_solicita = $_POST['id_usuario_solicita'];
    $id_tipo_soli = $_POST['id_tipo_soli'];
    $asunto = trim($_POST['asunto']);
    $descripcion = trim($_POST['descripcion']);

    $id_estado = 1;
    $fecha_creacion = date("Y-m-d H:i:s");

    $sql = "INSERT INTO solicitud 
            (id_usuario_solicita, id_tipo_soli, asunto, descripcion, id_estado, fecha_creacion)
            VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $conexion->prepare($sql)) {

        $stmt->bind_param("iissis", 
            $id_usuario_solicita, 
            $id_tipo_soli, 
            $asunto, 
            $descripcion, 
            $id_estado, 
            $fecha_creacion
        );

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>✅ Solicitud registrada correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>❌ Error al registrar la solicitud: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>⚠️ Error en la preparación de la consulta: " . $conexion->error . "</div>";
    }

    $conexion->close();
}
?>
