<?php
require_once("lib-conexion.php");

$sql = "SELECT 
            r.titulo_evento AS title,
            r.fecha_inicio AS start,
            r.fecha_fin AS end,
            e.nombre_espacio
        FROM reservas r
        JOIN espacios_comunales e ON r.id_espacio = e.id_espacio
        WHERE r.id_estado = 3"; 

$resultado = $conexion->query($sql);
$eventos = [];

while($fila = $resultado->fetch_assoc()) {
    $fila['title'] = $fila['title'] . ' (' . $fila['nombre_espacio'] . ')';
    $eventos[] = $fila;
}

header('Content-Type: application/json');
echo json_encode($eventos);

$conexion->close();
?>