<?php
require_once("lib/lib-sesion-datos.php"); 
include("lib/lib-datos-consulta-direccion.php");

if (!$usuario || $usuario['id_rol'] != 1) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registrar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/login.css?v=1.3" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div class="login-container">
    <div class="login-card register-card">
      
      <h2 style="color: white; text-align: center; margin-bottom: 25px;">Crear Nuevo Usuario</h2>
      
      <form action="lib/lib-insertar-usuario-admin.php" method="POST">
        
        <label for="nombre_completo">Nombre completo</label>
        <div class="input-group">
            <i class="fa fa-user"></i>
            <input type="text" id="nombre_completo" name="nombre_completo" placeholder="Tu nombre y apellido" required>
        </div>
        
        <label for="rut">RUT</label>
        <div class="input-group">
            <i class="fa fa-id-card"></i>
            <input type="text" id="rut" name="rut" placeholder="Ej: 12345678-9" required>
        </div>
        
        <label for="email">Email</label>
        <div class="input-group">
            <i class="fa fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required>
        </div>
        
        <label for="telefono">Teléfono</label>
        <div class="input-group">
            <i class="fa fa-phone"></i>
            <input type="tel" id="telefono" name="telefono" placeholder="+56912345678" required>
        </div>

        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        <div class="input-group">
            <i class="fa fa-calendar-alt"></i>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required style="color-scheme: dark;">
        </div>

        <hr style="border-color: rgba(255,255,255,0.3); margin: 20px 0;">

        <label for="nombre_calle">Nombre de Calle</label>
        <div class="input-group">
            <i class="fa fa-map-marker-alt"></i>
            <input type="text" id="nombre_calle" name="nombre_calle" placeholder="Nombre de la calle" required>
        </div>

        <label for="numero_casa">Número de Casa</label>
        <div class="input-group">
            <i class="fa fa-home"></i>
            <input type="number" id="numero_casa" name="numero_casa" placeholder="Número de casa" required>
        </div>
        
        <label for="id_pais">País</label>
        <div class="input-group">
            <select name="id_pais" id="id_pais" required>
                <option value="" disabled selected>Elija un país...</option>
                <?php 
                if (isset($consulta) && $consulta->num_rows > 0) {
                    while ($row = $consulta->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_pais']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php }
                } ?>
            </select>
        </div>

        <label for="id_region">Región</label>
        <div class="input-group">
            <select name="id_region" id="id_region" required>
                <option value="" disabled selected>Elija una región...</option>
                <?php 
                if (isset($consulta4) && $consulta4->num_rows > 0) {
                    while ($row = $consulta4->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_region']; ?>"><?php echo $row['nombre_region']; ?></option>
                    <?php }
                } ?>
            </select>
        </div>

        <label for="id_provincia">Provincia</label>
        <div class="input-group">
            <select name="id_provincia" id="id_provincia" required>
                <option value="" disabled selected>Elija una provincia...</option>
                <?php 
                if (isset($consulta2) && $consulta2->num_rows > 0) {
                    while ($row = $consulta2->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_provincia']; ?>"><?php echo $row['nom_provincia']; ?></option>
                    <?php }
                } ?>
            </select>
        </div>

        <label for="id_comuna">Comuna</label>
        <div class="input-group">
            <select name="id_comuna" id="id_comuna" required>
                <option value="" disabled selected>Elija una comuna...</option>
                <?php 
                if (isset($consulta3) && $consulta3->num_rows > 0) {
                    while ($row = $consulta3->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_comuna']; ?>"><?php echo $row['comuna']; ?></option>
                    <?php }
                } ?>
            </select>
        </div>

        <label for="id_rol">Rol de Usuario</label>
        <div class="input-group">
            <select name="id_rol" id="id_rol" required>
                <option value="" disabled selected>Elige el usuario</option>
                <?php 
                if (isset($consulta5) && $consulta5->num_rows > 0) {
                    while ($row = $consulta5->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_rol']; ?>"><?php echo $row['nombre_rol']; ?></option>
                    <?php }
                } ?>
            </select>
        </div>


        <hr style="border-color: rgba(255,255,255,0.3); margin: 20px 0;">

        <label for="clave">Crea una Clave</label>
        <div class="input-group">
            <i class="fa fa-lock"></i>
            <input type="password" id="clave" name="clave" placeholder="Mínimo 6 caracteres" required>
        </div>
        
        <button type="submit" class="btn-login" style="margin-top: 15px;">Crear Cuenta</button>

      </form>

      </div>
  </div>

    <?php
    if (isset($consulta)) $consulta->free();
    if (isset($consulta2)) $consulta2->free();
    if (isset($consulta3)) $consulta3->free();
    if (isset($consulta4)) $consulta4->free();
    if (isset($consulta5)) $consulta5->free();
    $conexion->close();
    ?>
</body>
</html>