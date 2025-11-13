<?php
require_once("lib/lib-sesion-datos.php");
require_once("lib/lib-datos-consulta-direccion.php"); 

if (!$usuario || $usuario['id_rol'] != 1) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: Panel-admin.php?error=no_id");
    exit();
}
$id_usuario_a_editar = $_GET['id'];

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id_us = ?");
$stmt->bind_param("i", $id_usuario_a_editar);
$stmt->execute();
$resultado = $stmt->get_result();
$user_data = $resultado->fetch_assoc();

if (!$user_data) {
    header("Location: Panel-admin.php?error=no_existe");
    exit();
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/login.css?v=1.3" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div class="login-container">
    <div class="login-card register-card">
      
      <h2 style="color: white; text-align: center; margin-bottom: 25px;">Editando Usuario</h2>
      <p style="color: #c1a2ff; text-align: center; margin-top: -20px; margin-bottom: 20px; font-weight: bold;">
          Estás editando a: <?= htmlspecialchars($user_data['nombre_completo']); ?>
      </p>

      <form action="lib/lib-actualizar-usuario-admin.php" method="POST">
        
        <input type="hidden" name="id_us" value="<?= $user_data['id_us']; ?>">

        <label for="nombre_completo">Nombre completo</label>
        <div class="input-group">
            <i class="fa fa-user"></i>
            <input type="text" id="nombre_completo" name="nombre_completo" value="<?= htmlspecialchars($user_data['nombre_completo']); ?>" required>
        </div>
        
        
        <label for="email">Email</label>
        <div class="input-group">
            <i class="fa fa-envelope"></i>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user_data['email']); ?>" required>
        </div>

        <label for="telefono">Teléfono</label>
        <div class="input-group">
            <i class="fa fa-phone"></i>
            <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($user_data['telefono']); ?>" required> 
        </div>


        <hr style="border-color: rgba(255,255,255,0.3); margin: 20px 0;">

        <label for="id_rol">Rol del Usuario</label>
        <div class="input-group">
            <select name="id_rol" id="id_rol" required>
                <option value="" disabled>Elige el rol...</option>
                <?php 
                if (isset($consulta5) && $consulta5->num_rows > 0) {
                    while ($row = $consulta5->fetch_assoc()) { 
                        $selected = ($row['id_rol'] == $user_data['id_rol']) ? 'selected' : '';
                ?>
                        <option value="<?= $row['id_rol']; ?>" <?= $selected; ?>><?= $row['nombre_rol']; ?></option>
                    <?php }
                } ?>
            </select>
        </div>

        <hr style="border-color: rgba(255,255,255,0.3); margin: 20px 0;">

        <label for="clave">Nueva Clave (Dejar en blanco para no cambiar)</label>
        <div class="input-group">
            <i class="fa fa-lock"></i>
            <input type="password" id="clave" name="clave" placeholder="Escribir solo si se quiere cambiar">
        </div>
        
        <button type="submit" class="btn-login" style="margin-top: 15px;">Actualizar Usuario</button>

        <a href="Panel-admin.php" class="btn-login" style="background: #6c757d; margin-top: 10px; display: block; text-align: center; text-decoration: none;">
            Cancelar
        </a>

      </form>
    </div>
  </div>

    <?php
    if (isset($consulta)) $consulta->free();
    if (isset($consulta2)) $consulta2->free();
    if (isset($consulta3)) $consulta3->free();
    if (isset($consulta4)) $consulta4->free();
    if (isset($consulta5)) $consulta5->free();
    ?>
</body>
</html>