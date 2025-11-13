-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2025 a las 00:56:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `barrio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `id_comuna` int(11) NOT NULL,
  `comuna` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`id_comuna`, `comuna`) VALUES
(13101, 'Santiago'),
(13102, 'Cerrillos'),
(13103, 'Colina'),
(13104, 'Conchalí'),
(13105, 'El Bosque'),
(13106, 'Estación Central'),
(13107, 'Huechuraba'),
(13108, 'Independencia'),
(13109, 'La Cisterna'),
(13110, 'La Florida'),
(13111, 'La Granja'),
(13112, 'La Pintana'),
(13113, 'La Reina'),
(13114, 'Las Condes'),
(13115, 'Lo Barnechea'),
(13116, 'Lo Espejo'),
(13117, 'Lo Prado'),
(13118, 'Macul'),
(13119, 'Maipú'),
(13120, 'Ñuñoa'),
(13121, 'Pedro Aguirre Cerda'),
(13122, 'Peñalolén'),
(13123, 'Providencia'),
(13124, 'Pudahuel'),
(13125, 'Quilicura'),
(13126, 'Quinta Normal'),
(13127, 'Recoleta'),
(13128, 'Renca'),
(13129, 'San Bernardo'),
(13130, 'San Joaquín'),
(13131, 'San Miguel'),
(13132, 'San Ramón'),
(13133, 'Vitacura'),
(13134, 'Puente Alto'),
(13135, 'Pirque'),
(13136, 'San José de Maipo'),
(13137, 'Melipilla'),
(13138, 'Alhué'),
(13139, 'Curacaví'),
(13140, 'María Pinto'),
(13141, 'San Pedro'),
(13142, 'Talagante'),
(13143, 'El Monte'),
(13144, 'Isla de Maipo'),
(13145, 'Padre Hurtado'),
(13146, 'Peñaflor'),
(13147, 'Buin'),
(13148, 'Calera de Tango'),
(13149, 'Paine'),
(13150, 'San Francisco de Mostazal'),
(13151, 'Tiltil'),
(13152, 'Lampa'),
(13153, 'Huincul'),
(13154, 'Las Cabras'),
(13155, 'Doñihue'),
(13156, 'Codegua'),
(13157, 'Graneros'),
(13158, 'Rancagua'),
(13159, 'Machalí'),
(13160, 'Gultro'),
(13161, 'Mostazal'),
(13162, 'Malloa'),
(13163, 'Olivar'),
(13164, 'Requínoa'),
(13165, 'Rengo'),
(13166, 'Quinta de Tilcoco'),
(13167, 'San Vicente de Tagua Tagua'),
(13168, 'Coltauco'),
(13169, 'Pichidegua'),
(13170, 'Coinco'),
(13171, 'Litueche'),
(13172, 'Pichilemu'),
(13173, 'Navidad'),
(13174, 'Paredones'),
(13175, 'La Estrella'),
(13176, 'Marchigüe'),
(13177, 'Lolol'),
(13178, 'Pumanque'),
(13179, 'Santa Cruz'),
(13180, 'Palmilla'),
(13181, 'Peralillo'),
(13182, 'Nancagua'),
(13183, 'Chépica'),
(13184, 'Chimbarongo'),
(13185, 'San Fernando'),
(13186, 'Placilla'),
(13187, 'Tinguiririca'),
(13188, 'Población'),
(13189, 'Río Claro'),
(13190, 'Curicó'),
(13191, 'Teno'),
(13192, 'Romeral'),
(13193, 'Vichuquén'),
(13194, 'Licantén'),
(13195, 'Hualañé'),
(13196, 'Rauco'),
(13197, 'Sagrada Familia'),
(13198, 'Molina'),
(13199, 'Curepto'),
(13200, 'Talca'),
(13201, 'Maule'),
(13202, 'San Clemente'),
(13203, 'Pelarco'),
(13204, 'San Rafael'),
(13205, 'Pencahue'),
(13206, 'Constitución'),
(13207, 'Empedrado'),
(13208, 'Linares'),
(13209, 'Yerbas Buenas'),
(13210, 'Colbún'),
(13211, 'Longaví'),
(13212, 'Parral'),
(13213, 'Retiro'),
(13214, 'Villa Alegre'),
(13215, 'San Javier'),
(13216, 'Cauquenes'),
(13217, 'Chanco'),
(13218, 'Pelluhue'),
(13219, 'Arauco'),
(13220, 'Cabrero'),
(13221, 'Chillán'),
(13222, 'Chillán Viejo'),
(13223, 'Cobquecura'),
(13224, 'Coelemu'),
(13225, 'Coihueco'),
(13226, 'El Carmen'),
(13227, 'Florida'),
(13228, 'Hualpén'),
(13229, 'Laja'),
(13230, 'Lebu'),
(13231, 'Los Álamos'),
(13232, 'Los Ángeles'),
(13233, 'Mulchén'),
(13234, 'Nacimiento'),
(13235, 'Negrete'),
(13236, 'Pemuco'),
(13237, 'Penco'),
(13238, 'Quilaco'),
(13239, 'Quilleco'),
(13240, 'Quillón'),
(13241, 'San Carlos'),
(13242, 'San Fabián'),
(13243, 'San Ignacio'),
(13244, 'San Nicolás'),
(13245, 'Santa Bárbara'),
(13246, 'Talcahuano'),
(13247, 'Tomé'),
(13248, 'Tucapel'),
(13249, 'Yumbel'),
(13250, 'Concepción'),
(13251, 'Coronel'),
(13252, 'Chiguayante'),
(13253, 'Lota'),
(13254, 'San Pedro de la Paz'),
(13255, 'Tirúa'),
(13256, 'Antuco'),
(13257, 'Alto Biobío'),
(13258, 'Curanipe'),
(13259, 'Portezuelo'),
(13260, 'Ránquil'),
(13261, 'Treguaco'),
(13262, 'Bulnes'),
(13263, 'Quirihue'),
(13264, 'Ninhue'),
(13265, 'San Clemente de Llo Lleo'),
(13266, 'Villarrica'),
(13267, 'Pucón'),
(13268, 'Curarrehue'),
(13269, 'Cunco'),
(13270, 'Melipeuco'),
(13271, 'Vilcún'),
(13272, 'Freire'),
(13273, 'Pitrufquén'),
(13274, 'Gorbea'),
(13275, 'Loncoche'),
(13276, 'Toltén'),
(13277, 'Teodoro Schmidt'),
(13278, 'Nueva Imperial'),
(13279, 'Carahue'),
(13280, 'Puerto Saavedra'),
(13281, 'Temuco'),
(13282, 'Padre Las Casas'),
(13283, 'Cholchol'),
(13284, 'Perquenco'),
(13285, 'Lautaro'),
(13286, 'Galvarino'),
(13287, 'Traiguén'),
(13288, 'Lumaco'),
(13289, 'Los Sauces'),
(13290, 'Purén'),
(13291, 'Angol'),
(13292, 'Renaico'),
(13293, 'Ercilla'),
(13294, 'Victoria'),
(13295, 'Curacautín'),
(13296, 'Lonquimay'),
(13297, 'Pto. Montt'),
(13298, 'Maullín'),
(13299, 'Calbuco'),
(13300, 'Cochamó'),
(13301, 'Fresia'),
(13302, 'Frutillar'),
(13303, 'Llanquihue'),
(13304, 'Los Muermos'),
(13305, 'Osorno'),
(13306, 'Puerto Varas'),
(13307, 'Purranque'),
(13308, 'Puyehue'),
(13309, 'Río Negro'),
(13310, 'San Pablo'),
(13311, 'San Juan de la Costa'),
(13312, 'Ancud'),
(13313, 'Castro'),
(13314, 'Chaitén'),
(13315, 'Chonchi'),
(13316, 'Dalcahue'),
(13317, 'Futaleufú'),
(13318, 'Hualaihué'),
(13319, 'Palena'),
(13320, 'Puqueldón'),
(13321, 'Queilén'),
(13322, 'Quellón'),
(13323, 'Quemchi'),
(13324, 'Quinchao'),
(13325, 'Aisén'),
(13326, 'Cisnes'),
(13327, 'Coyhaique'),
(13328, 'Chile Chico'),
(13329, 'Cochrane'),
(13330, 'Guaitecas'),
(13331, 'Lago Verde'),
(13332, 'O\'Higgins'),
(13333, 'Río Ibáñez'),
(13334, 'Tortel'),
(13335, 'Natales'),
(13336, 'Punta Arenas'),
(13337, 'Porvenir'),
(13338, 'Primavera'),
(13339, 'Río Verde'),
(13340, 'San Gregorio'),
(13341, 'Timaukel'),
(13342, 'Torres del Paine'),
(13343, 'Cabo de Hornos'),
(13344, 'Antártica'),
(13345, 'Arica'),
(13346, 'Camarones'),
(13347, 'Putre'),
(13348, 'General Lagos'),
(13349, 'Iquique'),
(13350, 'Alto Hospicio'),
(13351, 'Pozo Almonte'),
(13352, 'Camiña'),
(13353, 'Colchane'),
(13354, 'Huara'),
(13355, 'Pica'),
(13356, 'Antofagasta'),
(13357, 'Mejillones'),
(13358, 'Sierra Gorda'),
(13359, 'Taltal'),
(13360, 'Calama'),
(13361, 'Ollagüe'),
(13362, 'San Pedro de Atacama'),
(13363, 'Tocopilla'),
(13364, 'María Elena'),
(13365, 'Copiapó'),
(13366, 'Caldera'),
(13367, 'Tierra Amarilla'),
(13368, 'Chañaral'),
(13369, 'Diego de Almagro'),
(13370, 'Vallenar'),
(13371, 'Alto del Carmen'),
(13372, 'Freirina'),
(13373, 'Huasco'),
(13374, 'Illapel'),
(13375, 'Canela'),
(13376, 'Los Vilos'),
(13377, 'Salamanca'),
(13378, 'Ovalle'),
(13379, 'Combarbalá'),
(13380, 'Monte Patria'),
(13381, 'Punitaqui'),
(13382, 'Río Hurtado'),
(13383, 'La Serena'),
(13384, 'Coquimbo'),
(13385, 'Andacollo'),
(13386, 'La Higuera'),
(13387, 'Paihuano'),
(13388, 'Vicuña'),
(13389, 'Valparaíso'),
(13390, 'Casablanca'),
(13391, 'Concón'),
(13392, 'Juan Fernández'),
(13393, 'Quintero'),
(13394, 'Viña del Mar'),
(13395, 'Isla de Pascua'),
(13396, 'Los Andes'),
(13397, 'Calle Larga'),
(13398, 'Llay-Llay'),
(13399, 'San Esteban'),
(13400, 'La Ligua'),
(13401, 'Cabildo'),
(13402, 'Papudo'),
(13403, 'Petorca'),
(13404, 'Zapallar'),
(13405, 'Quillota'),
(13406, 'La Calera'),
(13407, 'Hijuelas'),
(13408, 'La Cruz'),
(13409, 'Nogales'),
(13410, 'San Antonio'),
(13411, 'Algarrobo'),
(13412, 'Cartagena'),
(13413, 'El Quisco'),
(13414, 'El Tabo'),
(13415, 'Santo Domingo'),
(13416, 'San Felipe'),
(13417, 'Catemu'),
(13418, 'Llaillay'),
(13419, 'Panquehue'),
(13420, 'Putaendo'),
(13421, 'Santa María'),
(13422, 'Villa Alemana'),
(13423, 'Limache'),
(13424, 'Olmué'),
(13425, 'Quilpué'),
(13426, 'Aysén');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `tipo_estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `tipo_estado`) VALUES
(1, 'Pendiente'),
(2, 'En revisión'),
(3, 'Aprobado'),
(4, 'Rechazado'),
(5, 'Completado'),
(6, 'Cancelado'),
(7, 'Publicado'),
(9, 'no vigente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `codigo_pais` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_pais`, `nombre`, `codigo_pais`) VALUES
(1, 'Chile', 'CL'),
(2, 'Argentina', 'AR'),
(3, 'México', 'MX'),
(4, 'Colombia', 'CO'),
(5, 'España', 'ES'),
(6, 'Perú', 'PE'),
(7, 'Brasil', 'BR'),
(8, 'Estados Unidos', 'US'),
(9, 'Canadá', 'CA'),
(10, 'Francia', 'FR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id_provincia` int(11) NOT NULL,
  `nom_provincia` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id_provincia`, `nom_provincia`) VALUES
(1, 'Arica'),
(2, 'Parinacota'),
(3, 'Iquique'),
(4, 'Tamarugal'),
(5, 'Antofagasta'),
(6, 'El Loa'),
(7, 'Tocopilla'),
(8, 'Copiapó'),
(9, 'Chañaral'),
(10, 'Huasco'),
(11, 'Elqui'),
(12, 'Choapa'),
(13, 'Limarí'),
(14, 'Valparaíso'),
(15, 'Isla de Pascua'),
(16, 'Los Andes'),
(17, 'Petorca'),
(18, 'Quillota'),
(19, 'San Antonio'),
(20, 'San Felipe de Aconcagua'),
(21, 'Marga Marga'),
(22, 'Santiago'),
(23, 'Cordillera'),
(24, 'Chacabuco'),
(25, 'Maipo'),
(26, 'Melipilla'),
(27, 'Talagante'),
(28, 'Cachapoal'),
(29, 'Colchagua'),
(30, 'Cardenal Caro'),
(31, 'Talca'),
(32, 'Cauquenes'),
(33, 'Curicó'),
(34, 'Linares'),
(35, 'Diguillín'),
(36, 'Itata'),
(37, 'Punilla'),
(38, 'Concepción'),
(39, 'Arauco'),
(40, 'Biobío'),
(41, 'Cautín'),
(42, 'Malleco'),
(43, 'Valdivia'),
(44, 'Ranco'),
(45, 'Llanquihue'),
(46, 'Chiloé'),
(47, 'Osorno'),
(48, 'Palena'),
(49, 'Coyhaique'),
(50, 'Aysén'),
(51, 'Capitán Prat'),
(52, 'General Carrera'),
(53, 'Magallanes'),
(54, 'Antártica Chilena'),
(55, 'Tierra del Fuego'),
(56, 'Última Esperanza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_publicacion` date DEFAULT curdate(),
  `fecha_inicio` date DEFAULT curdate(),
  `fecha_fin` date DEFAULT NULL,
  `id_usuario_creador` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `titulo`, `descripcion`, `fecha_publicacion`, `fecha_inicio`, `fecha_fin`, `id_usuario_creador`, `id_estado`, `fecha_creacion`) VALUES
(1, 'Arreglos de luminaria', 'arreglara las luminaria de una plaza vieja y anticuada', '2025-10-29', '2025-10-19', '2025-12-10', 5, 3, '2025-10-29 23:25:49'),
(2, 'Arreglos de luminaria', 'arreglara las luminaria de una plaza vieja y anticuada', '2025-10-29', '2025-10-19', '2025-12-10', 5, 3, '2025-10-29 23:25:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `nombre_region` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_region`, `nombre_region`) VALUES
(1, 'Región de Arica y Parinacota'),
(2, 'Región de Tarapacá'),
(3, 'Región de Antofagasta'),
(4, 'Región de Atacama'),
(5, 'Región de Coquimbo'),
(6, 'Región de Valparaíso'),
(7, 'Región del Libertador General Bernardo O’Higgins'),
(8, 'Región del Maule'),
(9, 'Región de Ñuble'),
(10, 'Región del Biobío'),
(11, 'Región de La Araucanía'),
(12, 'Región de Los Ríos'),
(13, 'Región de Los Lagos'),
(14, 'Región de Aysén del General Carlos Ibáñez del Camp'),
(15, 'Región de Magallanes y de la Antártica Chilena'),
(16, 'Región Metropolitana de Santiago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'Moderador'),
(2, 'Miembro de la junta de vecinos'),
(3, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id_solicitud` int(11) NOT NULL,
  `id_usuario_solicita` int(11) NOT NULL,
  `id_tipo_soli` int(11) NOT NULL,
  `asunto` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `id_estado` int(11) NOT NULL DEFAULT 1,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id_solicitud`, `id_usuario_solicita`, `id_tipo_soli`, `asunto`, `descripcion`, `id_estado`, `fecha_creacion`) VALUES
(1, 8, 1, 'necesito poder cambiar mi direccion por favor', 'safdsffsf', 1, '2025-10-24 20:50:33'),
(2, 5, 8, 'sdadasdasd', 'asdasdasdasda', 1, '2025-10-29 23:30:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_certificado`
--

CREATE TABLE `solicitud_certificado` (
  `id_solicitud` int(11) NOT NULL,
  `id_us` int(11) NOT NULL,
  `id_certi` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL DEFAULT 1,
  `motivo` text NOT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_certificado`
--

INSERT INTO `solicitud_certificado` (`id_solicitud`, `id_us`, `id_certi`, `id_estado`, `motivo`, `fecha_solicitud`) VALUES
(1, 5, 3, 1, 'para destruir el mundo y nada mas', '2025-10-29 22:16:15'),
(2, 5, 3, 1, 'dksldfkdlñasdkalsñdkaslñdkaslñdas', '2025-10-29 22:16:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_certificado`
--

CREATE TABLE `tipo_certificado` (
  `id_certi` int(11) NOT NULL,
  `nombre_certificado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_certificado`
--

INSERT INTO `tipo_certificado` (`id_certi`, `nombre_certificado`) VALUES
(1, 'Certificado de residencia'),
(2, 'Certificado de inscripción vecinal'),
(3, 'Certificado de participación en proyectos comunitarios'),
(4, 'Certificado de buena conducta vecinal'),
(5, 'Certificado de voluntariado barrial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_solicitud`
--

CREATE TABLE `tipo_solicitud` (
  `id_tipo_soli` int(11) NOT NULL,
  `tipo_soli` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_solicitud`
--

INSERT INTO `tipo_solicitud` (`id_tipo_soli`, `tipo_soli`) VALUES
(1, 'Reportar un Problema (Ej: Luz quemada, f'),
(2, 'Enviar una Sugerencia (Ej: Poner una ban'),
(3, 'Consulta General (Ej: Próxima reunión)'),
(4, 'Inscripción como vecino en la junta'),
(8, 'Actualización de datos personales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_us` int(11) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `rut` varchar(20) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `nombre_calle` varchar(40) DEFAULT NULL,
  `numero_casa` int(11) DEFAULT NULL,
  `clave` varchar(40) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `id_comuna` int(11) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `id_region` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_us`, `nombre_completo`, `fecha_nacimiento`, `rut`, `telefono`, `email`, `nombre_calle`, `numero_casa`, `clave`, `id_rol`, `id_comuna`, `id_provincia`, `id_pais`, `id_region`) VALUES
(1, 'constanza valeria leiva vera', '1994-10-24', '18.608.676-7', 8491253, 'con.leiva@duocuc.cl', 'los alarifes', 2222, '123456789', 1, 13118, 22, 1, 16),
(2, 'Cristobal Ferraro Freire', '2001-10-03', '20.111.111-5', 8491253, 'cri.ferraro@duocuc.cl', 'los alarifes', 3333, '123456789', 2, 13113, 22, 1, 16),
(5, 'Bob construye podran hacerlo No podemos', '2002-10-10', '20.204.205-7', 8491253, 'bob-Destrulle@gmail.com', 'los alarifes', 2424, '123456789', 2, 13102, 3, 1, 9),
(7, 'Patricio estrella', '1999-06-09', '11.111.111-1', 12354789, 'donpatricio.@gmail.com', 'Padre hurtado', 2223, '123456789', 3, 13119, 22, 1, 16),
(8, 'Bob construye podran hacerlo si podemos', '2002-11-11', '20.999.444-5', 8491253, 'bob-construye@gmail.com', 'los alarifes', 234455, '123456789', 3, 13116, 14, 1, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`id_comuna`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_provincia`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `id_usuario_creador` (`id_usuario_creador`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_usuario_solicita` (`id_usuario_solicita`),
  ADD KEY `id_tipo_soli` (`id_tipo_soli`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `solicitud_certificado`
--
ALTER TABLE `solicitud_certificado`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_us` (`id_us`),
  ADD KEY `id_certi` (`id_certi`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `tipo_certificado`
--
ALTER TABLE `tipo_certificado`
  ADD PRIMARY KEY (`id_certi`);

--
-- Indices de la tabla `tipo_solicitud`
--
ALTER TABLE `tipo_solicitud`
  ADD PRIMARY KEY (`id_tipo_soli`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_us`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_comuna` (`id_comuna`),
  ADD KEY `id_provincia` (`id_provincia`),
  ADD KEY `id_pais` (`id_pais`),
  ADD KEY `fk_region` (`id_region`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `id_comuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13427;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitud_certificado`
--
ALTER TABLE `solicitud_certificado`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_certificado`
--
ALTER TABLE `tipo_certificado`
  MODIFY `id_certi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_solicitud`
--
ALTER TABLE `tipo_solicitud`
  MODIFY `id_tipo_soli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`id_usuario_creador`) REFERENCES `usuarios` (`id_us`),
  ADD CONSTRAINT `proyectos_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`id_usuario_solicita`) REFERENCES `usuarios` (`id_us`),
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`id_tipo_soli`) REFERENCES `tipo_solicitud` (`id_tipo_soli`),
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`);

--
-- Filtros para la tabla `solicitud_certificado`
--
ALTER TABLE `solicitud_certificado`
  ADD CONSTRAINT `solicitud_certificado_ibfk_1` FOREIGN KEY (`id_us`) REFERENCES `usuarios` (`id_us`),
  ADD CONSTRAINT `solicitud_certificado_ibfk_2` FOREIGN KEY (`id_certi`) REFERENCES `tipo_certificado` (`id_certi`),
  ADD CONSTRAINT `solicitud_certificado_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_region` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`),
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_comuna`) REFERENCES `comuna` (`id_comuna`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id_provincia`),
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
