<?php
require('lib-conexion.php');
if (!isset($_SESSION)) session_start();

if (empty($_POST['rut']) || empty($_POST['clave'])) {
    header('Location: ../login.php?error=2'); // Error 2: Campos vacíos
    exit;
}

$rut = $_POST['rut'];
$clave_ingresada = $_POST['clave'];

$stmt = $conexion->prepare("SELECT id_us, id_rol, clave FROM usuarios WHERE rut = ?");
$stmt->bind_param("s", $rut);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
    $row = $resultado->fetch_assoc();
    
    if ($clave_ingresada === $row['clave']) {
        
        $_SESSION['id_us'] = $row['id_us'];
        $_SESSION["id_rol"] = $row['id_rol'];
        
        header('Location: ../index.php');
        exit;

    } else {
        header('Location: ../login.php?error=1');
        exit;
    }

} else {
    header('Location: ../login.php?error=1');
    exit;
}

$stmt->close();
$conexion->close();
?>