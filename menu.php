<?php
require_once("lib/lib-sesion-datos.php");

$current_page = basename($_SERVER['PHP_SELF']);
$rol_actual = $usuario['id_rol'] ?? null;

$panel = panelPorRol($rol_actual);
$es_panel_admin = ($panel && $current_page == 'Panel-admin.php');
?>
<link rel="stylesheet" href="assets/css/estilo-index.css">
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold titulo" href="index.php">MiBarrioAp</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'proyectos.php' || $current_page == 'crear-proyecto.php') ? 'active' : ''; ?>" href="proyectos.php">Proyectos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'novedades.php') ? 'active' : ''; ?>" href="novedades.php">Noticias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'certificados.php') ? 'active' : ''; ?>" href="certificados.php">Certificados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'calendario.php') ? 'active' : ''; ?>" href="calendario.php">Reservas</a>
        </li>

        <?php if ($rol_actual == 2 || $rol_actual == 3): // Solo para Miembros y Vecinos ?>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'solicitudes.php') ? 'active' : ''; ?>" href="solicitudes.php">Solicitudes</a>
          </li>
        <?php endif; ?>
        <?php if ($panel): // Esto solo se muestra para Rol 1 y 2 ?>
            <li class="nav-item">
              <a class="nav-link <?= ($es_panel_admin) ? 'active' : ''; ?>" href="<?= htmlspecialchars($panel[0]); ?>">
                <?= htmlspecialchars($panel[1]); ?>
              </a>
            </li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if ($usuario): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user me-1"></i> <?= htmlspecialchars($usuario['nombre_completo']); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
            <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'login.php') ? 'active' : ''; ?>" href="login.php">Iniciar sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'registrarse.php') ? 'active' : ''; ?>" href="registrarse.php">Registrarse</a>
          </li>
        <?php endif; ?>
      </ul>

    </div>
  </div>
</nav>