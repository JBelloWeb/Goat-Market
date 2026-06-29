-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: goat_market
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrito` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL,
  `jugador_id` int(10) unsigned NOT NULL,
  `cantidad` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `fecha_agregado` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_usuario_jugador` (`usuario_id`,`jugador_id`),
  KEY `jugador_id` (`jugador_id`),
  CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`jugador_id`) REFERENCES `jugadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
INSERT INTO `carrito` VALUES (3,1,1,2,'2026-06-24 15:15:03'),(6,2,1,1,'2026-06-28 14:53:28');
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jugadores`
--

DROP TABLE IF EXISTS `jugadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jugadores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_apellido` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` smallint(5) unsigned NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pais_id` (`pais_id`),
  CONSTRAINT `pais_id` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jugadores`
--

LOCK TABLES `jugadores` WRITE;
/*!40000 ALTER TABLE `jugadores` DISABLE KEYS */;
INSERT INTO `jugadores` VALUES (1,'Lionel Messi','1987-06-24','Delantero y Capitán histórico de la Selección Argentina (Inter Miami).',25,'lionel-MESSI.png',1),(2,'Emiliano Martínez','1992-09-02','Arquero titular de la Selección Argentina, clave en múltiples títulos (Aston Villa).',28,'emiliano-MARTINEZ.png',1),(3,'Gerónimo Rulli','1992-05-20','Arquero suplente de la Selección Argentina (Olympique de Marseille).',8,'geronimo-RULLI.png',1),(4,'Juan Musso','1994-05-06','Arquero suplente de la Selección Argentina (Atlético de Madrid).',6,'juan-MUSSO.png',1),(5,'Gonzalo Montiel','1997-01-01','Defensor lateral derecho, autor del penal decisivo en Qatar 2022 (River Plate).',10,'gonzalo-MONTIEL.png',1),(6,'Nahuel Molina','1998-04-06','Defensor lateral derecho de la Selección Argentina (Atlético de Madrid).',22,'nahuel-MOLINA.png',1),(7,'Lisandro Martínez','1998-01-18','Defensor central zurdo con gran salida de balón (Manchester United).',50,'lisandro-MARTINEZ.png',1),(8,'Nicolás Otamendi','1988-02-12','Defensor central veterano y pilar defensivo (Benfica).',3,'nicolas-OTAMENDI.png',1),(10,'Cristian Romero','1998-04-27','Defensor central titular, apodado Cuti (Tottenham Hotspur).',55,'cristian-ROMERO.png',1),(11,'Facundo Medina','1999-05-28','Defensor central de la Selección Argentina (Olympique de Marseille).',18,'facundo-MEDINA.png',1),(12,'Nicolás Tagliafico','1992-08-31','Defensor lateral izquierdo de la Selección Argentina (Olympique Lyonnais).',10,'nicolas-TAGLIAFICO.png',1),(13,'Leandro Paredes','1994-06-29','Mediocampista central de gran pegada y distribución (River Plate).',12,'leandro-PAREDES.png',1),(14,'Rodrigo De Paul','1994-05-24','Mediocampista mixto, considerado el motor del equipo (Inter Miami).',35,'rodrigo-DE PAUL.png',1),(15,'Exequiel Palacios','1998-10-05','Mediocampista de la Selección Argentina (Bayer Leverkusen).',22,'exequiel-PALACIOS.png',1),(16,'Enzo Fernández','2001-01-17','Mediocampista central, Mejor Jugador Joven de Qatar 2022 (Chelsea).',75,'enzo-FERNANDEZ.png',1),(17,'Alexis Mac Allister','1998-12-24','Mediocampista creativo e inteligente en el posicionamiento (Liverpool).',65,'alexis-MAC ALLISTER.png',1),(18,'Giovani Lo Celso','1996-04-09','Mediocampista zurdo, muy técnico y asociativo (Real Betis).',18,'giovani-LO CELSO.png',1),(19,'Valentín Barco','2004-07-23','Joven mediocampista/lateral izquierdo de gran proyección (RC Strasbourg).',8,'valentin-BARCO.png',1),(20,'Julián Álvarez','2000-01-31','Delantero centro incansable en la presión y de gran capacidad goleadora (Atlético de Madrid).',75,'julian-ALVAREZ.png',1),(21,'Lautaro Martínez','1997-08-22','Delantero centro goleador de la Selección Argentina (Inter de Milán).',85,'lautaro-MARTINEZ.png',1),(22,'Thiago Almada','2001-04-26','Joven delantero campeón del mundo en 2022 (Atlético de Madrid).',30,'thiago-ALMADA.png',1),(23,'Nicolás Paz','2004-09-08','Joven mediocampista ofensivo/delantero de gran temporada (Como 1907).',20,'nico-PAZ.png',1),(24,'Nicolás González','1998-04-06','Delantero extremo izquierdo de gran despliegue físico (Atlético de Madrid).',30,'nico-GONZALEZ.png',1),(25,'Giuliano Simeone','2002-12-18','Joven delantero convocado al Mundial 2026 (Atlético de Madrid).',18,'giuliano-SIMEONE.png',1),(26,'José Manuel López','2000-12-06','Delantero centro, opción de ataque para Argentina en 2026 (Palmeiras).',10,'jose-manuel-LOPEZ.png',1),(27,'Vozinha','1986-06-03','Arquero veterano y líder de la Selección de Cabo Verde (Geronimo Mendes Furtado).',999,'vozinha.png',3),(28,'Cristiano Ronaldo','1985-02-05','Delantero estrella y uno de los máximos goleadores en la historia del fútbol mundial (Portugal).',15,'cristiano-RONALDO.png',5),(29,'Neymar Jr.','1992-02-05','Talentoso delantero y figura indiscutible de la Selección de Brasil.',25,'neymar-JR.png',2),(30,'Kylian Mbappé','1998-12-20','Extremo y delantero explosivo, principal figura de la Selección de Francia.',160,'kylian-MBAPPE.png',10),(31,'Vinícius Júnior','2000-07-12','Extremo izquierdo de gran habilidad y velocidad (Brasil).',200,'vinicius-JUNIOR.png',2),(32,'Jude Bellingham','2003-06-29','Mediocampista todoterreno y figura de la Selección de Inglaterra.',180,'jude-BELLINGHAM.png',8),(33,'Kevin De Bruyne','1991-06-28','Mediocampista de élite con una visión de juego excepcional (Bélgica).',45,'kevin-DE-BRUYNE.png',4);
/*!40000 ALTER TABLE `jugadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `estrellas` tinyint(4) NOT NULL,
  `color` varchar(8) NOT NULL DEFAULT '#666666',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_paises_nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'Argentina',3,'#6CACE4'),(2,'Brasil',5,'#fedf00'),(3,'Cabo_Verde',0,'#003da5'),(4,'Bélgica',0,'#c8102e'),(5,'Portugal',0,'#da291c'),(6,'Alemania',4,'#000000'),(7,'España',1,'#AA151B'),(8,'Inglaterra',1,'#ffffff'),(9,'Uruguay',2,'#55B5E5'),(10,'Francia',2,'#000091'),(11,'global',0,'#666666');
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_paises_before_delete`
BEFORE DELETE ON `paises`
FOR EACH ROW
BEGIN
  DECLARE global_id INT;
  SET global_id = (SELECT id FROM `paises` WHERE `nombre` = 'global' LIMIT 1);
  IF OLD.id <> global_id THEN
    UPDATE `jugadores` SET `pais_id` = global_id WHERE `pais_id` = OLD.id;
  END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `posicion_x_jugador`
--

DROP TABLE IF EXISTS `posicion_x_jugador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posicion_x_jugador` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `posicion_id` int(10) unsigned NOT NULL,
  `jugador_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_pxj` (`posicion_id`,`jugador_id`),
  KEY `idx_jugador_id` (`jugador_id`),
  CONSTRAINT `fk_pxj_jugador` FOREIGN KEY (`jugador_id`) REFERENCES `jugadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pxj_posicion` FOREIGN KEY (`posicion_id`) REFERENCES `posiciones` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posicion_x_jugador`
--

LOCK TABLES `posicion_x_jugador` WRITE;
/*!40000 ALTER TABLE `posicion_x_jugador` DISABLE KEYS */;
INSERT INTO `posicion_x_jugador` VALUES (1,1,2),(2,1,3),(3,1,4),(4,1,27),(5,2,5),(6,2,6),(7,2,7),(8,2,8),(10,2,10),(11,2,11),(12,2,12),(13,3,13),(14,3,14),(15,3,15),(16,3,16),(17,3,17),(18,3,18),(19,3,19),(20,3,23),(21,3,32),(22,3,33),(23,4,1),(24,4,20),(25,4,21),(26,4,22),(27,4,24),(28,4,25),(29,4,26),(30,4,28),(31,4,29),(32,4,30),(33,4,31);
/*!40000 ALTER TABLE `posicion_x_jugador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posiciones`
--

DROP TABLE IF EXISTS `posiciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posiciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `posicion` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posicion` (`posicion`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posiciones`
--

LOCK TABLES `posiciones` WRITE;
/*!40000 ALTER TABLE `posiciones` DISABLE KEYS */;
INSERT INTO `posiciones` VALUES (1,'ARQUERO'),(2,'DEFENSOR'),(14,'DEFENSOR CENTRAL'),(3,'DELANTERO'),(22,'DELANTERO CENTRO'),(20,'EXTREMO DERECHO'),(21,'EXTREMO IZQUIERDO'),(13,'global'),(15,'LATERAL DERECHO'),(16,'LATERAL IZQUIERDO'),(4,'MEDIOCAMPISTA'),(18,'MEDIOCAMPISTA CENTRAL'),(17,'MEDIOCAMPISTA DEFENSIVO'),(19,'MEDIOCAMPISTA OFENSIVO');
/*!40000 ALTER TABLE `posiciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_posiciones_before_delete`
BEFORE DELETE ON `posiciones`
FOR EACH ROW
BEGIN
  DECLARE global_id INT;
  SET global_id = (SELECT id FROM `posiciones` WHERE `posicion` = 'global' LIMIT 1);
  IF OLD.id <> global_id THEN
    UPDATE `posicion_x_jugador` SET `posicion_id` = global_id WHERE `posicion_id` = OLD.id;
  END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `es_administrador` tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Juani','$2y$10$EHqN7BQluzCaURR/WTO70OUn1b4YS5Cxvs2fBkFw38mllIQo1pzGS',0),(2,'Ale','$2y$10$EHqN7BQluzCaURR/WTO70OUn1b4YS5Cxvs2fBkFw38mllIQo1pzGS',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-29  1:40:56
