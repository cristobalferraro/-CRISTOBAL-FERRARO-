<?php
require_once("lib-conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre_completo   = trim($_POST['nombre_completo']);
    $rut               = trim($_POST['rut']);
    $email             = trim($_POST['email']);
    $nombre_calle      = trim($_POST['nombre_calle']);
    $numero_casa       = trim($_POST['numero_casa']);
    $id_pais           = $_POST['id_pais'];
    $id_region         = $_POST['id_region'];
    $id_provincia      = $_POST['id_provincia'];
    $id_comuna         = $_POST['id_comuna'];
    $clave             = $_POST['clave']; 
    $fecha_nacimiento  = $_POST['fecha_nacimiento'];
    $telefono          = trim($_POST['telefono']);


    $fecha_actual = new DateTime();
    $fecha_nac = new DateTime($fecha_nacimiento);
    $diferencia = $fecha_actual->diff($fecha_nac)->y;

    if ($diferencia < 14) {
        echo "<script>alert('Debes tener al menos 14 años para registrarte.'); window.history.back();</script>";
        exit;
    }
    

    $verificar_rut = $conexion->prepare("SELECT rut FROM usuarios WHERE rut = ?");
    $verificar_rut->bind_param("s", $rut);
    $verificar_rut->execute();
    $verificar_rut->store_result();

    if ($verificar_rut->num_rows > 0) {
        echo "<script>alert('El RUT ingresado ya está registrado.'); window.history.back();</script>";
        $verificar_rut->close();
        exit;
    }
    $verificar_rut->close();

   
    $sql = $conexion->prepare("INSERT INTO usuarios 
        (nombre_completo, rut, email, nombre_calle, numero_casa, id_pais, id_region, id_provincia, id_comuna, clave, fecha_nacimiento, telefono, id_rol)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 3)");

    $sql->bind_param(
        "ssssiiiissss",
        $nombre_completo, $rut, $email, $nombre_calle, $numero_casa,
        $id_pais, $id_region, $id_provincia, $id_comuna,
        $clave, 
        $fecha_nacimiento, $telefono
    );

    if ($sql->execute()) {
        echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href='../login.php';</script>";
    } else {
        echo "<script>alert('Error al registrar el usuario: " . $sql->error . "'); window.history.back();</script>";
    }

    $sql->close();
    $conexion->close();

} else {
    header("Location: ../registrarse.php");
    exit;
}
?>