-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2025 a las 01:24:45
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
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id_anuncio` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `importancia` enum('Informativo','Urgente') NOT NULL DEFAULT 'Informativo',
  `id_usuario_creador` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id_anuncio`, `titulo`, `contenido`, `imagen_url`, `importancia`, `id_usuario_creador`, `fecha_creacion`) VALUES
(1, 'festival', 'Proximamente una festival del hallowheen', NULL, 'Informativo', 1, '2025-11-04 00:10:09'),
(2, 'Corte de luz', 'En unos días se cortara la luz', NULL, 'Urgente', 1, '2025-11-04 00:12:32'),
(3, 'nuevas luminarias', 'vygyjgj', 'noticia_1762889021_69138d3d13864.png', 'Informativo', 1, '2025-11-11 19:23:41'),
(4, 'Diputado Oyarzo acusa al Gobierno y a Pardow de \"manipular plazos\" para retrasar votación de AC', 'El diputado del Partido Radical, Rubén Oyarzo, acusó al Gobierno y al exministro de Energía, Diego Pardow, de haber “manipulado los plazos” para que la acusación constitucional en contra del exsecretario de Estado se vote después de las elecciones presidenciales y parlamentarias del próximo domingo.\r\n\r\nEl parlamentario calificó la situación como un acto de “mala fe” y una “falta de respeto” hacia los clientes afectados por los cobros irregulares en las cuentas de la luz, hechos que motivaron la presentación del libelo.\r\n\r\n“Sería bien impresentable que la acusación constitucional en contra del exministro Pardow no se vote antes de la elección del próximo domingo”, señaló Oyarzo, quien confirmó su voto a favor de la iniciativa.', 'noticia_1762986854_69150b6687886.jpg', 'Informativo', 1, '2025-11-12 22:34:14');

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
-- Estructura de tabla para la tabla `espacios_comunales`
--

CREATE TABLE `espacios_comunales` (
  `id_espacio` int(11) NOT NULL,
  `nombre_espacio` varchar(100) NOT NULL,
  `capacidad` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `espacios_comunales`
--

INSERT INTO `espacios_comunales` (`id_espacio`, `nombre_espacio`, `capacidad`) VALUES
(1, 'Salón Comunal', 50),
(2, 'Salón Comunal', 50),
(3, 'Cancha de Fútbol', 100),
(4, 'Plaza Central (Eventos)', 200),
(5, 'Sede Vecinal (Sala de Reuniones)', 20),
(6, 'Calle Principal (Cierre para Ferias)', 500);

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
-- Estructura de tabla para la tabla `estado_pago`
--

CREATE TABLE `estado_pago` (
  `id_estado_pago` int(11) NOT NULL,
  `nombre_estado_pago` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_pago`
--

INSERT INTO `estado_pago` (`id_estado_pago`, `nombre_estado_pago`) VALUES
(1, 'Pendiente de Pago'),
(2, 'Pagado'),
(3, 'Cancelado');

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
-- Estructura de tabla para la tabla `postulaciones`
--

CREATE TABLE `postulaciones` (
  `id_postulacion` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `id_usuario_postulante` int(11) NOT NULL,
  `fecha_postulacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `postulaciones`
--

INSERT INTO `postulaciones` (`id_postulacion`, `id_proyecto`, `id_usuario_postulante`, `fecha_postulacion`) VALUES
(1, 3, 7, '2025-11-04 01:22:12'),
(2, 4, 7, '2025-11-04 02:32:36'),
(3, 5, 7, '2025-11-04 22:57:54'),
(4, 6, 9, '2025-11-12 22:40:33');

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
  `permite_postulacion` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `titulo`, `descripcion`, `fecha_publicacion`, `fecha_inicio`, `fecha_fin`, `id_usuario_creador`, `id_estado`, `permite_postulacion`, `fecha_creacion`) VALUES
(1, 'Arreglos de luminaria', 'arreglara las luminaria de una plaza vieja y anticuada', '2025-10-29', '2025-10-19', '2025-12-10', 5, 3, 0, '2025-10-29 23:25:49'),
(2, 'Arreglos de luminaria', 'arreglara las luminaria de una plaza vieja y anticuada', '2025-10-29', '2025-10-19', '2025-12-10', 5, 3, 0, '2025-10-29 23:25:58'),
(3, 'nuevas luminarias', 'dgasgag', '2025-11-03', '2025-11-01', '2025-11-05', 1, 3, 1, '2025-11-04 01:21:33'),
(4, 'nuevas luminariasasdfasdf', 'afasf', '2025-11-03', '2025-11-18', '2025-11-12', 1, 3, 1, '2025-11-04 02:31:43'),
(5, 'nuevas luminariasasdfasfa', 'asfasfasf', '2025-11-04', '2025-11-03', '2025-11-08', 2, 3, 1, '2025-11-04 22:57:06'),
(6, 'PROYECTOS PARA EQUIPAMIENTO COMUNITARIO', '¿En qué consiste el Programa?\r\nEl Programa de Mejoramiento de Viviendas y Barrios (D.S.27), busca mejorar la calidad de vida de las familias que habitan en áreas o localidades urbanas de más de 5 mil habitantes.\r\n\r\nEste subsidio busca facilitar la vida en comunidad a través de obras de alta calidad que permitan solucionar déficits o recuperar lugares de encuentro para las familias.\r\nRequisitos para postular a los proyectos\r\nCertificado de Vigencia de Personas Jurídicas, otorgado por el Servicio de Registros Civil o la Municipalidad respectiva.\r\nDocumento, según formato Serviu, que justifique y acredite la pertinencia e impacto en la comunidad del proyecto en caso de realizarse.\r\nSi el proyecto se ubica en terreno municipal o en un bien de uso público contar con permiso municipal para intervenirlo y compromiso de la mantención de las respectivas obras.\r\nContar con cartas de apoyo de entidades públicas o privadas, con representación en el barrio, que avalen la necesidad y relevancia del proyecto.\r\nLa organización que postula debe presentar el documento donde se aprueba el proyecto por más de la mitad de los socios o asociados que la componen.\r\nEn el caso de proyectos de Construcción y/o Mejoramiento de Edificaciones Comunitarias, se debe presentar una Declaración Jurada en donde se acepta el uso de dicho equipamiento comunitario por otras organizaciones funcionales y/o territoriales del sector o barrio.\r\nPresentar la autorización del propietario, o de las entidades que corresponda para realizar las obras incluidas en el proyecto presentado, acreditando la propiedad mediante un Certificado de Dominio vigente. Si se trata de bienes nacionales, acreditar dicha calidad a través de un Certificado del DOM.\r\nPresentar nómina de las personas residentes del sector o barrio en que se localiza la intervención, en representación de su grupo familiar, según formato entregado por SERVIU.\r\nPresentar documento bancario que acredita el o los aportes adicionales al proyecto. En caso de un bien nacional, se deberá presentar Acta de Sesión del Concejo Municipal en que conste el compromiso de mantención de las respectivas obras.\r\nTodos los proyectos deberán presentar un Plan de Uso y Mantención, según formato entregado por el SERVIU.', '2025-11-12', '2025-11-18', '2025-11-22', 1, 3, 1, '2025-11-12 22:37:24');

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
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_espacio` int(11) NOT NULL,
  `id_usuario_reserva` int(11) NOT NULL,
  `titulo_evento` varchar(255) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `id_estado` int(11) NOT NULL DEFAULT 1,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_espacio`, `id_usuario_reserva`, `titulo_evento`, `fecha_inicio`, `fecha_fin`, `id_estado`, `fecha_solicitud`) VALUES
(1, 1, 7, 'cumpleaños', '2025-11-08 14:00:00', '2025-11-09 23:17:00', 3, '2025-11-06 06:18:10'),
(2, 3, 7, 'cumpleaños', '2025-11-08 03:28:00', '2025-11-09 03:28:00', 2, '2025-11-06 06:28:33'),
(3, 3, 2, 'cumpleaños', '2025-11-10 16:05:00', '2025-11-10 16:06:00', 3, '2025-11-07 19:06:09'),
(4, 3, 9, 'cumpleaños', '2025-11-13 19:41:00', '2025-11-14 21:43:00', 1, '2025-11-12 22:41:38');

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
  `monto_pagar` int(11) DEFAULT 1000,
  `id_estado_pago` int(11) NOT NULL DEFAULT 1,
  `motivo` text NOT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_certificado`
--

INSERT INTO `solicitud_certificado` (`id_solicitud`, `id_us`, `id_certi`, `id_estado`, `monto_pagar`, `id_estado_pago`, `motivo`, `fecha_solicitud`) VALUES
(1, 5, 3, 3, 1000, 1, 'para destruir el mundo y nada mas', '2025-10-29 22:16:15'),
(2, 5, 3, 3, 1000, 1, 'dksldfkdlñasdkalsñdkaslñdkaslñdas', '2025-10-29 22:16:38'),
(3, 7, 3, 3, 1000, 1, 'quiero mi certificado', '2025-11-04 02:29:07'),
(4, 7, 1, 3, 1000, 1, 'nesesito tener ese certificado para un tramite\r\n', '2025-11-04 02:51:47'),
(5, 7, 1, 3, 1000, 1, 'mmhhgv', '2025-11-04 03:28:22'),
(6, 7, 1, 3, 1000, 1, 'bblabalbalblablalb', '2025-11-04 22:54:12'),
(7, 1, 1, 3, 1000, 2, 'fwsefas', '2025-11-06 04:41:18'),
(8, 1, 1, 3, 1000, 2, 'vasdas', '2025-11-06 05:23:53'),
(9, 7, 1, 3, 1000, 1, 'dhjasdlka', '2025-11-07 20:29:28');

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
(8, 'Bob construye podran hacerlo si podemos', '2002-11-11', '20.999.444-5', 8491253, 'bob-construye@gmail.com', 'los alarifes', 234455, '123456789', 3, 13116, 14, 1, 7),
(9, 'Juan Valdez', '1997-02-07', '22.222.222-2', 123456789, 'donjuan@gmail.com', 'Av.san joaquin', 241, '123456789', 3, 13119, 22, 1, 16);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id_anuncio`),
  ADD KEY `fk_usuario_anuncio` (`id_usuario_creador`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`id_comuna`);

--
-- Indices de la tabla `espacios_comunales`
--
ALTER TABLE `espacios_comunales`
  ADD PRIMARY KEY (`id_espacio`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `estado_pago`
--
ALTER TABLE `estado_pago`
  ADD PRIMARY KEY (`id_estado_pago`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  ADD PRIMARY KEY (`id_postulacion`),
  ADD UNIQUE KEY `idx_unica_postulacion` (`id_proyecto`,`id_usuario_postulante`),
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `id_usuario_postulante` (`id_usuario_postulante`);

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
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_espacio` (`id_espacio`),
  ADD KEY `id_usuario_reserva` (`id_usuario_reserva`),
  ADD KEY `id_estado` (`id_estado`);

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
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `fk_solicitud_estado_pago` (`id_estado_pago`);

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
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id_anuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `id_comuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13427;

--
-- AUTO_INCREMENT de la tabla `espacios_comunales`
--
ALTER TABLE `espacios_comunales`
  MODIFY `id_espacio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estado_pago`
--
ALTER TABLE `estado_pago`
  MODIFY `id_estado_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  MODIFY `id_postulacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `fk_usuario_anuncio` FOREIGN KEY (`id_usuario_creador`) REFERENCES `usuarios` (`id_us`);

--
-- Filtros para la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  ADD CONSTRAINT `postulaciones_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`),
  ADD CONSTRAINT `postulaciones_ibfk_2` FOREIGN KEY (`id_usuario_postulante`) REFERENCES `usuarios` (`id_us`);

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`id_usuario_creador`) REFERENCES `usuarios` (`id_us`),
  ADD CONSTRAINT `proyectos_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_espacio`) REFERENCES `espacios_comunales` (`id_espacio`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_usuario_reserva`) REFERENCES `usuarios` (`id_us`),
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`);

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
  ADD CONSTRAINT `fk_solicitud_estado_pago` FOREIGN KEY (`id_estado_pago`) REFERENCES `estado_pago` (`id_estado_pago`),
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
