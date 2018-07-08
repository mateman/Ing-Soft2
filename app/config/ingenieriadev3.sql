-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: ingenieriadev
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `id_viaje` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `pregunta` text,
  `respuesta` text,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `consulta_fk1` (`id_viaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasajero`
--

DROP TABLE IF EXISTS `pasajero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pasajero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `viaje_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `calificacion_pasajero` int(11) NOT NULL,
  `calificacion_conductor` int(11) NOT NULL,
  `comentario_conductor` text,
  `comentario_pasajero` text,
  `flagcalificacion_conductor` bit(1) DEFAULT b'0',
  `flagcalificacion_pasajero` bit(1) DEFAULT b'0',
  `borrado_logico` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pasajero_fk0` (`usuario_id`),
  KEY `pasajero_fk1` (`viaje_id`),
  CONSTRAINT `pasajero_fk0` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `pasajero_fk1` FOREIGN KEY (`viaje_id`) REFERENCES `viaje` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasajero`
--

LOCK TABLES `pasajero` WRITE;
/*!40000 ALTER TABLE `pasajero` DISABLE KEYS */;
INSERT INTO `pasajero` VALUES (1,2,300,1,0,0,NULL,NULL,'\0','\0',0),(2,2,296,2,0,0,NULL,NULL,'\0','\0',0),(3,2,299,1,-1,1,'<p>otro mas</p>','<p>mal compa&ntilde;ero</p>','','',0),(4,2,301,1,0,0,NULL,NULL,'\0','\0',0),(5,3,301,1,0,0,NULL,NULL,'\0','\0',0),(6,3,296,0,0,0,NULL,NULL,'\0','\0',0);
/*!40000 ALTER TABLE `pasajero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `contrasena` varchar(200) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `fechanac` date NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `nombreusuario` varchar(50) NOT NULL,
  `ciudad` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tienevehiculo` tinyint(1) NOT NULL,
  `foto_contenido` longblob,
  `foto_tipo` varchar(5) DEFAULT NULL,
  `imagen_url` varchar(250) NOT NULL,
  `borrado_logico` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('12345','Buenos Aires','2017-09-14','Raverta','223455555','Claudio Marco','claudiorav','La Plata','claudioraverta@hotmail.com',1,1,'','','1',0),('cdr','CABA','1975-07-14','Cuyeu','1159232277','Pablo Adolfo','mateman','Almagro','mateman@localhost',2,0,NULL,NULL,'avatar.png',0),('qwer1234','Tierra del Fuego','1982-04-02','Argentinas','151234','Malvinas','malvina','puerto argentino','malvina@localhost',3,0,NULL,NULL,'avatar.png',0),('qwer1234','El tigre','2000-02-12','Nuevo','123','Nuevi','nuevo','alameda','nuevo@nuevo',4,0,NULL,NULL,'avatar.png',0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiculo`
--

DROP TABLE IF EXISTS `vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patente` varchar(20) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `asientosdisp` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `borrado_logico` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `vehiculo_fk0` (`usuario_id`),
  CONSTRAINT `vehiculo_fk0` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculo`
--

LOCK TABLES `vehiculo` WRITE;
/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
INSERT INTO `vehiculo` VALUES (15,'ABC123','Ferrari',2,1,'Testarossa',0),(16,'avf808','vw',4,2,'1996',0);
/*!40000 ALTER TABLE `vehiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `viaje`
--

DROP TABLE IF EXISTS `viaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `costo` int(11) NOT NULL,
  `origen` varchar(40) NOT NULL,
  `destino` varchar(40) NOT NULL,
  `tipo_viaje` varchar(20) NOT NULL,
  `horasalida` datetime NOT NULL,
  `horallegada` datetime NOT NULL,
  `auto_id` int(11) NOT NULL,
  `conductor_id` int(11) NOT NULL,
  `borrado_logico` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=303 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `viaje`
--

LOCK TABLES `viaje` WRITE;
/*!40000 ALTER TABLE `viaje` DISABLE KEYS */;
INSERT INTO `viaje` VALUES (296,'prohibido fumar porro',5000,'Bariloche','Buenos Aires','3','2018-07-10 01:00:00','2018-07-10 10:00:00',15,1,0),(297,'',5000,'La Plata','Buenos Aires','3','2018-06-15 10:00:00','2018-06-15 11:11:00',15,1,0),(298,'',5000,'La Plata','Buenos Aires','3','2018-06-16 10:00:00','2018-06-16 11:11:00',15,1,0),(299,'',5000,'La Plata','Buenos Aires','3','2018-06-17 10:00:00','2018-06-17 11:11:00',15,1,0),(300,'',1234,'la plata','Azul','1','2018-12-11 12:12:00','2018-12-11 13:45:00',15,1,0),(301,'solapamiento',1234,'algo','otro','1','2018-07-10 11:30:00','2018-07-10 12:30:00',15,1,0),(302,'prueba',234,'CABA','Azul','1','2018-07-20 11:00:00','2018-07-20 23:00:00',16,2,0);
/*!40000 ALTER TABLE `viaje` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-07 23:00:21
