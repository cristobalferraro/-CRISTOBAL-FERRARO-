<?php
require_once("lib/lib-sesion-datos.php");

require_once('lib/fpdf186/fpdf.php'); 


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: ID de solicitud no válido.");
}
$id_solicitud = $_GET['id'];

$stmt_aprobar = $conexion->prepare("UPDATE solicitud_certificado SET id_estado = 3 WHERE id_solicitud = ?");
$stmt_aprobar->bind_param("i", $id_solicitud); 
$stmt_aprobar->execute();
$stmt_aprobar->close();

$sql_datos = "SELECT 
                u.nombre_completo, 
                u.rut, 
                u.nombre_calle, 
                u.numero_casa, 
                c.comuna,
                t.nombre_certificado,
                s.motivo
              FROM solicitud_certificado s
              JOIN usuarios u ON s.id_us = u.id_us
              JOIN tipo_certificado t ON s.id_certi = t.id_certi
              JOIN comuna c ON u.id_comuna = c.id_comuna
              WHERE s.id_solicitud = ?";

$stmt_datos = $conexion->prepare($sql_datos);
$stmt_datos->bind_param("i", $id_solicitud);
$stmt_datos->execute();
$resultado = $stmt_datos->get_result();
$datos_vecino = $resultado->fetch_assoc();

if (!$datos_vecino) {
    die("Error: No se encontraron datos para esta solicitud.");
}

$nombre_vecino = utf8_decode($datos_vecino['nombre_completo']);
$rut_vecino = utf8_decode($datos_vecino['rut']);
$direccion_vecino = utf8_decode($datos_vecino['nombre_calle'] . ' #' . $datos_vecino['numero_casa']);
$comuna_vecino = utf8_decode($datos_vecino['comuna']);
$tipo_certificado = utf8_decode(strtoupper($datos_vecino['nombre_certificado']));
setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish');
$fecha_hoy = utf8_decode(strftime('%d de %B de %Y'));


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(0, 10, $tipo_certificado, 0, 1, 'C');
$pdf->Ln(20); 

$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 7, utf8_decode("La Junta de Vecinos 'MiBarrioAp', RUT 70.123.456-K, certifica que:"), 0, 'J');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->MultiCell(0, 7, utf8_decode("Don (Doña) " . $nombre_vecino . ", RUT N° " . $rut_vecino . "."), 0, 'J');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 7, utf8_decode("Es residente de esta unidad vecinal, con domicilio en " . $direccion_vecino . ", comuna de " . $comuna_vecino . "."), 0, 'J');
$pdf->Ln(10);

$pdf->MultiCell(0, 7, utf8_decode("Se extiende el presente certificado para los fines que estime convenientes."), 0, 'J');
$pdf->Ln(20);

$pdf->Cell(0, 10, 'Santiago, ' . $fecha_hoy, 0, 1, 'R');
$pdf->Ln(30);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, '________________________', 0, 1, 'C');
$pdf->Cell(0, 5, 'Juan Perez Gonzalez', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 5, 'Presidente', 0, 1, 'C');
$pdf->Cell(0, 5, 'Junta de Vecinos MiBarrioAp', 0, 1, 'C');

$pdf->Output('D', 'Certificado_' . $rut_vecino . '.pdf');

$stmt_datos->close();
$conexion->close();
?>