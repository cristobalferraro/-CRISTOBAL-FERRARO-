<?php
session_start();
require_once("lib-conexion.php");

// Seguridad: Solo Admin (Rol 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. Recibir datos del formulario
    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);
    $importancia = $_POST['importancia'];
    $id_usuario_creador = $_POST['id_usuario_creador'];
    $imagen_url = NULL; // Por defecto es NULO (sin imagen)

    // 2. Lógica de subida de imagen (si se envió una)
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        
        $target_dir = "../uploads/"; // La carpeta que creamos
        $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
        
        // Crear un nombre de archivo único (ej: noticia_16788865_id.jpg)
        $nuevo_nombre_archivo = "noticia_" . time() . "_" . uniqid() . "." . $extension;
        $target_file = $target_dir . $nuevo_nombre_archivo;

        // Validar tipo de imagen
        $check = getimagesize($_FILES['imagen']['tmp_name']);
        if($check === false) {
            header("Location: ../admin-gestionar-anuncios.php?error=No+es+una+imagen");
            exit;
        }

        // Mover el archivo
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
            // Si se subió bien, guardamos el nombre en la variable
            $imagen_url = $nuevo_nombre_archivo;
        } else {
            header("Location: ../admin-gestionar-anuncios.php?error=Error+al+subir+imagen");
            exit;
        }
    }

    // 3. Insertar en la Base de Datos
    // La consulta SQL ahora incluye 'imagen_url'
    $sql = "INSERT INTO anuncios (titulo, contenido, imagen_url, importancia, id_usuario_creador) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conexion->prepare($sql);
    // 5 variables: s, s, s, s, i
    $stmt->bind_param("ssssi", 
        $titulo, 
        $contenido, 
        $imagen_url, // Puede ser el nombre del archivo o NULL
        $importancia, 
        $id_usuario_creador
    );

    if ($stmt->execute()) {
        header("Location: ../admin-gestionar-anuncios.php?status=ok");
    } else {
        header("Location: ../admin-gestionar-anuncios.php?error=sql_error");
    }
    
    $stmt->close();
    $conexion->close();

} else {
    header("Location: ../admin-gestionar-anuncios.php");
    exit;
}
?>