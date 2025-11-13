<?php 
require_once("lib-conexion.php");
$sql = "Select id_pais,nombre from pais";
$consulta=$conexion->query($sql);
$fila=$consulta->num_rows;

$sql2="select * from provincia";
$consulta2=$conexion->query($sql2); 
$fila2=$consulta2->num_rows;

$sql3 = "SELECT * FROM comuna";
$consulta3= $conexion->query($sql3); 
$fila3 = $consulta3->num_rows;

$sql4 = "SELECT * FROM region";
$consulta4= $conexion->query($sql4); 
$fila4 = $consulta4->num_rows;

$sql5= "SELECT * FROM roles WHERE id_rol IN (2, 3);";
$consulta5=$conexion->query($sql5); 
$fila5=$consulta5->num_rows;


?>