<?php
// Este archivo NO es una página, es un 'endpoint' que devuelve JSON
require_once("lib-conexion.php"); 
header('Content-Type: application/json');

// Inicializar el array de datos
$datos = [
    'kpi_vecinos' => 0,
    'kpi_proyectos' => 0,
    'kpi_cert_pendientes' => 0,
    'grafico_certificados' => [
        'labels' => [],
        'data' => []
    ],
    'grafico_reservas' => [
        'labels' => [],
        'data' => []
    ]
];

// --- 1. KPI: Total Vecinos (Roles 2 y 3) ---
$sql_vecinos = "SELECT COUNT(*) AS total FROM usuarios WHERE id_rol IN (2, 3)";
$res_vecinos = $conexion->query($sql_vecinos);
if ($res_vecinos) {
    $datos['kpi_vecinos'] = $res_vecinos->fetch_assoc()['total'];
}

// --- 2. KPI: Total Proyectos Aprobados ---
$sql_proy = "SELECT COUNT(*) AS total FROM proyectos WHERE id_estado = 3";
$res_proy = $conexion->query($sql_proy);
if ($res_proy) {
    $datos['kpi_proyectos'] = $res_proy->fetch_assoc()['total'];
}

// --- 3. KPI: Certificados Pendientes de PAGO ---
$sql_cert = "SELECT COUNT(*) AS total FROM solicitud_certificado WHERE id_estado = 1 AND id_estado_pago = 1";
$res_cert = $conexion->query($sql_cert);
if ($res_cert) {
    $datos['kpi_cert_pendientes'] = $res_cert->fetch_assoc()['total'];
}

// --- 4. Gráfico de Pastel: Tipos de Certificados Solicitados ---
$sql_graf_cert = "SELECT 
                    t.nombre_certificado, 
                    COUNT(s.id_solicitud) AS total
                  FROM solicitud_certificado s
                  JOIN tipo_certificado t ON s.id_certi = t.id_certi
                  GROUP BY t.nombre_certificado
                  ORDER BY total DESC";
$res_graf_cert = $conexion->query($sql_graf_cert);
while ($fila = $res_graf_cert->fetch_assoc()) {
    $datos['grafico_certificados']['labels'][] = $fila['nombre_certificado'];
    $datos['grafico_certificados']['data'][] = $fila['total'];
}

// --- 5. Gráfico de Barras: Reservas Aprobadas por Espacio ---
$sql_graf_res = "SELECT 
                    e.nombre_espacio, 
                    COUNT(r.id_reserva) AS total
                 FROM reservas r
                 JOIN espacios_comunales e ON r.id_espacio = e.id_espacio
                 WHERE r.id_estado = 3 -- Solo aprobadas
                 GROUP BY e.nombre_espacio
                 ORDER BY total DESC";
$res_graf_res = $conexion->query($sql_graf_res);
while ($fila = $res_graf_res->fetch_assoc()) {
    $datos['grafico_reservas']['labels'][] = $fila['nombre_espacio'];
    $datos['grafico_reservas']['data'][] = $fila['total'];
}

// --- Devolver todos los datos como JSON ---
echo json_encode($datos);
$conexion->close();
?>