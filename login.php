
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="css/login.css?v=1.2">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="avatar">
        <i class="fa fa-user"></i>
      </div>

      <form action="lib/lib-login.php" method="POST">
        <div class="input-group">
          <i class="fa fa-id-card"></i> <input type="text" name="rut" placeholder="RUT" required>
        </div>

        <div class="input-group">
          <i class="fa fa-lock"></i>
          <input type="password" name="clave" placeholder="Contraseña" required>
        </div>

        <div class="options">
          <label><input type="checkbox"> Recuérdame</label>
          <a href="#">¿Olvidaste tu clave?</a>
        </div>

        <button type="submit" class="btn-login">LOGIN</button>

        <?php 
        if (isset($_GET['error'])) {
            $mensaje = "";
            if ($_GET['error'] == '1') $mensaje = "RUT o clave incorrecta.";
            if ($_GET['error'] == '2') $mensaje = "Campos vacíos.";
            echo "<div style='color: #ffb6b9; margin-top: 15px; font-weight: bold;'>".$mensaje."</div>";
        }
        ?>
      </form>

      <div class="register-link" style="margin-top: 25px; color: white; font-size: 0.95em;">
        <p>¿No tienes una cuenta? 
            <a href="registrarse.php" style="color: #c1a2ff; text-decoration: none; font-weight: bold;">
                Regístrate aquí
            </a>
        </p>
      </div>

    </div>
  </div>
</body>
</html>