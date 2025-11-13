<?php
// Cargar sesión, conexión y datos de usuarios
require_once("lib/lib-sesion-datos.php");
require_once("lib/lib-datos-usuario.php"); 

if (!$usuario || $usuario['id_rol'] != 1) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="css/estilo-index.css?v=1.3" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">
    
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-4">Dashboard de Administración</h1>
            <p class="lead fs-3">Estadísticas y gestión del sistema.</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-3 h-100">
                <i class="fas fa-users fa-3x text-primary mb-2"></i>
                <h2 class="card-title" id="kpi-vecinos">...</h2>
                <p class="card-text fs-5">Vecinos Registrados</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-3 h-100">
                <i class="fas fa-project-diagram fa-3x text-primary mb-2"></i>
                <h2 class="card-title" id="kpi-proyectos">...</h2>
                <p class="card-text fs-5">Proyectos Aprobados</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-3 h-100">
                <i class="fas fa-file-invoice-dollar fa-3x text-primary mb-2"></i>
                <h2 class="card-title" id="kpi-cert-pendientes">...</h2>
                <p class="card-text fs-5">Pagos de Certificados Pendientes</p>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-3">Solicitudes de Certificados</h3>
                    <canvas id="graficoCertificados"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-3">Reservas Aprobadas por Espacio</h3>
                    <canvas id="graficoReservas"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="seccion-anuncios p-4 p-md-5 mb-5">
        <h2 class="text-center mb-4">Acciones Rápidas</h2>
        <div class="row g-4">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="panel-admin-agregar-usuario.php" class="card-portal card text-center h-100">
                    <div class="card-body p-4"><i class="fas fa-user-plus"></i><h3 class="card-title">Agregar Usuario</h3></div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="admin-aprobar-proyectos.php" class="card-portal card text-center h-100">
                    <div class="card-body p-4"><i class="fas fa-clipboard-check"></i><h3 class="card-title">Aprobar Proyectos</h3></div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="admin-gestionar-anuncios.php" class="card-portal card text-center h-100">
                    <div class="card-body p-4"><i class="fas fa-bullhorn"></i><h3 class="card-title">Gestionar Noticias</h3></div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="admin-gestionar-certificados.php" class="card-portal card text-center h-100">
                    <div class="card-body p-4"><i class="fas fa-file-signature"></i><h3 class="card-title">Certificados</h3></div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="admin-gestionar-reservas.php" class="card-portal card text-center h-100">
                    <div class="card-body p-4"><i class="fas fa-calendar-check"></i><h3 class="card-title">Reservas</h3></div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="admin-ver-postulaciones.php" class="card-portal card text-center h-100">
                    <div class="card-body p-4"><i class="fas fa-users"></i><h3 class="card-title">Postulaciones</h3></div>
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0"><i class="fas fa-users-cog"></i> Gestión de Usuarios</h3>
        </div>
        <div class="card-body p-0"> 
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre Completo</th>
                            <th>RUT</th>
                            <th>Email / Teléfono</th>
                            <th>Rol</th>
                            <th class="text-end" style="padding-right: 20px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($result) && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['nombre_completo']); ?></td>
                                    <td><?= htmlspecialchars($row['rut']); ?></td>
                                    <td>
                                        <?= htmlspecialchars($row['email']); ?><br>
                                        <small class="text-muted"><?= htmlspecialchars($row['telefono']); ?></small>
                                    </td>
                                    <td>
                                        <?php 
                                        $color = 'secondary';
                                        if ($row['id_rol'] == 2) $color = 'warning';
                                        if ($row['id_rol'] == 3) $color = 'info';
                                        echo "<span class='badge bg-{$color}'>" . htmlspecialchars($row['rol']) . "</span>";
                                        ?>
                                    </td>
                                    <td class="text-end" style="padding-right: 20px;">
                                        <a href="admin-editar-usuario.php?id=<?= $row['id_us']; ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <a href="admin-eliminar-usuario.php?id=<?= $row['id_us']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('¿Estás seguro de que quieres eliminar a este usuario? Se borrarán también sus solicitudes.');">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center p-4">No hay usuarios (Rol 2 o 3) registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Cuando el documento esté listo
    document.addEventListener("DOMContentLoaded", () => {
        
        // 1. Ir a buscar los datos a nuestro "cerebro" PHP
        fetch("lib/lib-datos-dashboard.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la red o 404 - No se encontró lib-datos-dashboard.php');
                }
                return response.json();
            })
            .then(data => {
                
                // 2. Rellenar las tarjetas KPI (los números)
                document.getElementById("kpi-vecinos").innerText = data.kpi_vecinos;
                document.getElementById("kpi-proyectos").innerText = data.kpi_proyectos;
                document.getElementById("kpi-cert-pendientes").innerText = data.kpi_cert_pendientes;

                // 3. Dibujar Gráfico de Pastel (Certificados)
                const ctxCert = document.getElementById("graficoCertificados");
                if (ctxCert) {
                    new Chart(ctxCert.getContext("2d"), {
                        type: 'pie',
                        data: {
                            labels: data.grafico_certificados.labels,
                            datasets: [{
                                label: 'Solicitudes',
                                data: data.grafico_certificados.data,
                                backgroundColor: [
                                    'rgba(25, 135, 84, 0.7)', // Verde (nuestro primario)
                                    'rgba(255, 206, 86, 0.7)', // Amarillo
                                    'rgba(255, 99, 132, 0.7)', // Rojo
                                    'rgba(54, 162, 235, 0.7)', // Azul
                                ],
                                borderColor: '#fff',
                                borderWidth: 1
                            }]
                        },
                        options: { responsive: true }
                    });
                }

                // 4. Dibujar Gráfico de Barras (Reservas)
                const ctxRes = document.getElementById("graficoReservas");
                if (ctxRes) {
                    new Chart(ctxRes.getContext("2d"), {
                        type: 'bar',
                        data: {
                            labels: data.grafico_reservas.labels,
                            datasets: [{
                                label: 'N° de Reservas Aprobadas',
                                data: data.grafico_reservas.data,
                                backgroundColor: 'rgba(25, 135, 84, 0.7)', // Verde (nuestro primario)
                                borderColor: 'rgba(25, 135, 84, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: { stepSize: 1 }
                                }
                            }
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error al cargar datos del dashboard:', error);
                // Mostrar un error al admin
                document.getElementById("kpi-vecinos").innerText = "Error";
                document.getElementById("kpi-proyectos").innerText = "Error";
                document.getElementById("kpi-cert-pendientes").innerText = "Error";
            });
    });
</script>

</body>
</html>