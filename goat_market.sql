-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 29, 2026 at 04:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goat_market`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrito`
--

CREATE TABLE `carrito` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `jugador_id` int(10) UNSIGNED NOT NULL,
  `cantidad` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `fecha_agregado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carrito`
--

INSERT INTO `carrito` (`id`, `usuario_id`, `jugador_id`, `cantidad`, `fecha_agregado`) VALUES
(3, 1, 1, 2, '2026-06-24 15:15:03'),
(6, 2, 1, 1, '2026-06-28 14:53:28'),
(7, 2, 2, 1, '2026-06-29 10:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `jugadores`
--

CREATE TABLE `jugadores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_apellido` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` smallint(5) UNSIGNED NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jugadores`
--

INSERT INTO `jugadores` (`id`, `nombre_apellido`, `fecha_nacimiento`, `descripcion`, `precio`, `imagen`, `pais_id`) VALUES
(1, 'Lionel Messi', '1987-06-24', 'Delantero y Capitán histórico de la Selección Argentina (Inter Miami).', 25, '178274030296.png', 1),
(2, 'Emiliano Martínez', '1992-09-02', 'Arquero titular de la Selección Argentina, clave en múltiples títulos (Aston Villa).', 28, 'emiliano-MARTINEZ.png', 1),
(3, 'Gerónimo Rulli', '1992-05-20', 'Arquero suplente de la Selección Argentina (Olympique de Marseille).', 8, 'geronimo-RULLI.png', 1),
(4, 'Juan Musso', '1994-05-06', 'Arquero suplente de la Selección Argentina (Atlético de Madrid).', 6, 'juan-MUSSO.png', 1),
(5, 'Gonzalo Montiel', '1997-01-01', 'Defensor lateral derecho, autor del penal decisivo en Qatar 2022 (River Plate).', 10, 'gonzalo-MONTIEL.png', 1),
(6, 'Nahuel Molina', '1998-04-06', 'Defensor lateral derecho de la Selección Argentina (Atlético de Madrid).', 22, 'nahuel-MOLINA.png', 1),
(7, 'Lisandro Martínez', '1998-01-18', 'Defensor central zurdo con gran salida de balón (Manchester United).', 50, 'lisandro-MARTINEZ.png', 1),
(8, 'Nicolás Otamendi', '1988-02-12', 'Defensor central veterano y pilar defensivo (Benfica).', 3, 'nicolas-OTAMENDI.png', 1),
(10, 'Cristian Romero', '1998-04-27', 'Defensor central titular, apodado Cuti (Tottenham Hotspur).', 55, 'cristian-ROMERO.png', 1),
(11, 'Facundo Medina', '1999-05-28', 'Defensor central de la Selección Argentina (Olympique de Marseille).', 18, 'facundo-MEDINA.png', 1),
(12, 'Nicolás Tagliafico', '1992-08-31', 'Defensor lateral izquierdo de la Selección Argentina (Olympique Lyonnais).', 10, 'nicolas-TAGLIAFICO.png', 1),
(13, 'Leandro Paredes', '1994-06-29', 'Mediocampista central de gran pegada y distribución (River Plate).', 12, 'leandro-PAREDES.png', 1),
(14, 'Rodrigo De Paul', '1994-05-24', 'Mediocampista mixto, considerado el motor del equipo (Inter Miami).', 35, 'rodrigo-DE PAUL.png', 1),
(15, 'Exequiel Palacios', '1998-10-05', 'Mediocampista de la Selección Argentina (Bayer Leverkusen).', 22, 'exequiel-PALACIOS.png', 1),
(16, 'Enzo Fernández', '2001-01-17', 'Mediocampista central, Mejor Jugador Joven de Qatar 2022 (Chelsea).', 75, 'enzo-FERNANDEZ.png', 1),
(17, 'Alexis Mac Allister', '1998-12-24', 'Mediocampista creativo e inteligente en el posicionamiento (Liverpool).', 65, 'alexis-MAC ALLISTER.png', 1),
(18, 'Giovani Lo Celso', '1996-04-09', 'Mediocampista zurdo, muy técnico y asociativo (Real Betis).', 18, 'giovani-LO CELSO.png', 1),
(19, 'Valentín Barco', '2004-07-23', 'Joven mediocampista/lateral izquierdo de gran proyección (RC Strasbourg).', 8, 'valentin-BARCO.png', 1),
(20, 'Julián Álvarez', '2000-01-31', 'Delantero centro incansable en la presión y de gran capacidad goleadora (Atlético de Madrid).', 75, 'julian-ALVAREZ.png', 1),
(21, 'Lautaro Martínez', '1997-08-22', 'Delantero centro goleador de la Selección Argentina (Inter de Milán).', 85, 'lautaro-MARTINEZ.png', 1),
(22, 'Thiago Almada', '2001-04-26', 'Joven delantero campeón del mundo en 2022 (Atlético de Madrid).', 30, 'thiago-ALMADA.png', 1),
(23, 'Nicolás Paz', '2004-09-08', 'Joven mediocampista ofensivo/delantero de gran temporada (Como 1907).', 20, 'nico-PAZ.png', 1),
(24, 'Nicolás González', '1998-04-06', 'Delantero extremo izquierdo de gran despliegue físico (Atlético de Madrid).', 30, 'nico-GONZALEZ.png', 1),
(25, 'Giuliano Simeone', '2002-12-18', 'Joven delantero convocado al Mundial 2026 (Atlético de Madrid).', 18, 'giuliano-SIMEONE.png', 1),
(26, 'José Manuel López', '2000-12-06', 'Delantero centro, opción de ataque para Argentina en 2026 (Palmeiras).', 10, 'jose-manuel-LOPEZ.png', 1),
(27, 'Vozinha', '1986-06-03', 'Arquero veterano y líder de la Selección de Cabo Verde (Geronimo Mendes Furtado).', 999, 'vozinha.png', 3),
(28, 'Cristiano Ronaldo', '1985-02-05', 'Delantero estrella y uno de los máximos goleadores en la historia del fútbol mundial (Portugal).', 15, 'cristiano-RONALDO.png', 12),
(29, 'Neymar Jr.', '1992-02-05', 'Talentoso delantero y figura indiscutible de la Selección de Brasil.', 25, 'neymar-JR.png', 2),
(30, 'Kylian Mbappé', '1998-12-20', 'Extremo y delantero explosivo, principal figura de la Selección de Francia.', 160, 'kylian-MBAPPE.png', 10),
(31, 'Vinícius Júnior', '2000-07-12', 'Extremo izquierdo de gran habilidad y velocidad (Brasil).', 200, 'vinicius-JUNIOR.png', 2),
(32, 'Jude Bellingham', '2003-06-29', 'Mediocampista todoterreno y figura de la Selección de Inglaterra.', 180, 'jude-BELLINGHAM.png', 8),
(33, 'Kevin De Bruyne', '1991-06-28', 'Mediocampista de élite con una visión de juego excepcional (Bélgica).', 45, 'kevin-DE-BRUYNE.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estrellas` tinyint(4) NOT NULL,
  `color` varchar(8) NOT NULL DEFAULT '#666666'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `paises`
--

INSERT INTO `paises` (`id`, `nombre`, `estrellas`, `color`) VALUES
(1, 'Argentina', 3, '#6CACE4'),
(2, 'Brasil', 5, '#fedf00'),
(3, 'Cabo_Verde', 0, '#003da5'),
(4, 'Bélgica', 0, '#c8102e'),
(6, 'Alemania', 4, '#000000'),
(7, 'España', 1, '#AA151B'),
(8, 'Inglaterra', 1, '#ffffff'),
(9, 'Uruguay', 2, '#55B5E5'),
(10, 'Francia', 2, '#000091'),
(11, 'global', 0, '#666666'),
(12, 'Portugal', 0, '#da291c');

--
-- Triggers `paises`
--
DELIMITER $$
CREATE TRIGGER `trg_paises_before_delete` BEFORE DELETE ON `paises` FOR EACH ROW BEGIN
  DECLARE global_id INT;
  SET global_id = (SELECT id FROM `paises` WHERE `nombre` = 'global' LIMIT 1);
  IF OLD.id <> global_id THEN
    UPDATE `jugadores` SET `pais_id` = global_id WHERE `pais_id` = OLD.id;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `posiciones`
--

CREATE TABLE `posiciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `posicion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posiciones`
--

INSERT INTO `posiciones` (`id`, `posicion`) VALUES
(1, 'ARQUERO'),
(2, 'DEFENSOR'),
(14, 'DEFENSOR CENTRAL'),
(3, 'DELANTERO'),
(22, 'DELANTERO CENTRO'),
(20, 'EXTREMO DERECHO'),
(21, 'EXTREMO IZQUIERDO'),
(13, 'global'),
(15, 'LATERAL DERECHO'),
(16, 'LATERAL IZQUIERDO'),
(4, 'MEDIOCAMPISTA'),
(18, 'MEDIOCAMPISTA CENTRAL'),
(17, 'MEDIOCAMPISTA DEFENSIVO'),
(19, 'MEDIOCAMPISTA OFENSIVO');

--
-- Triggers `posiciones`
--
DELIMITER $$
CREATE TRIGGER `trg_posiciones_before_delete` BEFORE DELETE ON `posiciones` FOR EACH ROW BEGIN
  DECLARE global_id INT;
  SET global_id = (SELECT id FROM `posiciones` WHERE `posicion` = 'global' LIMIT 1);
  IF OLD.id <> global_id THEN
    UPDATE `posicion_x_jugador` SET `posicion_id` = global_id WHERE `posicion_id` = OLD.id;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `posicion_x_jugador`
--

CREATE TABLE `posicion_x_jugador` (
  `id` int(10) UNSIGNED NOT NULL,
  `posicion_id` int(10) UNSIGNED NOT NULL,
  `jugador_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posicion_x_jugador`
--

INSERT INTO `posicion_x_jugador` (`id`, `posicion_id`, `jugador_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 1, 27),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(10, 2, 10),
(11, 2, 11),
(12, 2, 12),
(13, 3, 13),
(14, 3, 14),
(15, 3, 15),
(16, 3, 16),
(17, 3, 17),
(18, 3, 18),
(19, 3, 19),
(20, 3, 23),
(21, 3, 32),
(22, 3, 33),
(40, 4, 1),
(24, 4, 20),
(25, 4, 21),
(26, 4, 22),
(27, 4, 24),
(28, 4, 25),
(29, 4, 26),
(39, 4, 28),
(31, 4, 29),
(32, 4, 30),
(33, 4, 31);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `es_administrador` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contraseña`, `es_administrador`) VALUES
(1, 'Juani', '$2y$10$EHqN7BQluzCaURR/WTO70OUn1b4YS5Cxvs2fBkFw38mllIQo1pzGS', 0),
(2, 'Ale', '$2y$10$EHqN7BQluzCaURR/WTO70OUn1b4YS5Cxvs2fBkFw38mllIQo1pzGS', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_usuario_jugador` (`usuario_id`,`jugador_id`),
  ADD KEY `jugador_id` (`jugador_id`);

--
-- Indexes for table `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pais_id` (`pais_id`);

--
-- Indexes for table `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_paises_nombre` (`nombre`);

--
-- Indexes for table `posiciones`
--
ALTER TABLE `posiciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posicion` (`posicion`);

--
-- Indexes for table `posicion_x_jugador`
--
ALTER TABLE `posicion_x_jugador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_pxj` (`posicion_id`,`jugador_id`),
  ADD KEY `idx_jugador_id` (`jugador_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posiciones`
--
ALTER TABLE `posiciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `posicion_x_jugador`
--
ALTER TABLE `posicion_x_jugador`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`jugador_id`) REFERENCES `jugadores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `pais_id` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `posicion_x_jugador`
--
ALTER TABLE `posicion_x_jugador`
  ADD CONSTRAINT `fk_pxj_jugador` FOREIGN KEY (`jugador_id`) REFERENCES `jugadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pxj_posicion` FOREIGN KEY (`posicion_id`) REFERENCES `posiciones` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
