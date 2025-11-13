<?php

require_once("lib-conexion.php");

$us="SELECT 
    u.id_us,
    u.nombre_completo,
    u.fecha_nacimiento,
    u.rut,
    u.email,
    u.telefono,
    u.nombre_calle,
    p.nombre AS pais,
    c.comuna,
    pr.nom_provincia AS provincia,
    r.nombre_region AS region,
    ro.nombre_rol AS rol,
    u.id_rol
FROM usuarios u
JOIN pais p       ON p.id_pais = u.id_pais
JOIN comuna c     ON c.id_comuna = u.id_comuna
JOIN provincia pr ON pr.id_provincia = u.id_provincia
JOIN region r     ON r.id_region = u.id_region
JOIN roles ro     ON ro.id_rol = u.id_rol
WHERE u.id_rol IN (2, 3)";

$result=$conexion->query($us);
$datos=$result->num_rows;

?>
