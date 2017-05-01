-- MySQL dump 10.15  Distrib 10.0.28-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.0.28-MariaDB

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
-- Table structure for table `centro_integral`
--

DROP TABLE IF EXISTS `centro_integral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centro_integral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operarios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centro_integral`
--

/*!40000 ALTER TABLE `centro_integral` DISABLE KEYS */;
INSERT INTO `centro_integral` VALUES (1,'3','Saavedra 539'),(2,'3','Avenida Sarmiento 1523'),(3,'3','Toledo 390'),(4,'3','Avenida J. B. Alberdi 1000'),(5,'3','López y Planes 656'),(6,'3','Avenida Vélez Sarfield 900');
/*!40000 ALTER TABLE `centro_integral` ENABLE KEYS */;

--
-- Table structure for table `flota`
--

DROP TABLE IF EXISTS `flota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehiculo_id` int(11) NOT NULL,
  `tipolavado_id` int(11) NOT NULL,
  `centrointegral_id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `periodicidad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_93CD5C6A25F7D575` (`vehiculo_id`),
  KEY `IDX_93CD5C6A62FDCA86` (`tipolavado_id`),
  KEY `IDX_93CD5C6AE3C28265` (`centrointegral_id`),
  KEY `IDX_93CD5C6AE899029B` (`plan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flota`
--

/*!40000 ALTER TABLE `flota` DISABLE KEYS */;
INSERT INTO `flota` VALUES (1,1,1,1,1,3,'1 vez por semana'),(2,4,1,2,1,2,'3 veces por semana'),(4,4,3,1,2,3,'1 vez por semana'),(6,3,3,6,3,3,'unavezporsemana'),(7,2,1,1,4,3,'dosvecesporsemana'),(8,4,4,2,4,2,'unavezporsemana'),(9,1,3,1,4,2,'unavezporsemana'),(10,1,1,1,4,2,'dosvecesporsemana'),(11,2,2,4,5,2,'3 veces por semana'),(12,4,1,1,5,1,'1 vez por semana'),(13,2,4,2,6,3,'2 veces por semana'),(14,2,2,2,7,2,'1 vez por semana'),(15,1,1,6,7,3,'2 veces por semana'),(16,3,4,5,8,5,'3 veces por semana'),(17,3,4,5,9,25,'2 veces por semana'),(18,3,3,1,10,3,'1 vez por semana'),(19,1,1,1,11,15,'1 vez por semana'),(20,2,4,3,12,5,'2 veces por semana'),(21,4,1,3,12,6,'2 veces por semana'),(22,4,1,5,12,1,'3 veces por semana'),(23,1,1,4,12,4,'1 vez por semana');
/*!40000 ALTER TABLE `flota` ENABLE KEYS */;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (1,'gabriel','gabriel','gabriel.hruza@gmail.com','gabriel.hruza@gmail.com',1,'chp4nr7mm6g4sgsw44cgs088004k8so','$2y$13$Lhh7ApqLh2vUPYeCrDtcyuPHSojcxAOS2t/qMpxEajKXEJ4aBNpOy','2017-04-25 01:15:38',0,0,NULL,NULL,NULL,'a:1:{i:0;s:15:\"ROLE_PARTICULAR\";}',0,NULL,'Hruza','Gabriel','23-33333333-3','sadadf asdfasfd','34545454545454','masculino','particular'),(2,'Gerardo Gómez','gerardo gómez','gerardogomez@gmail.com','gerardogomez@gmail.com',1,'idppg2oukdko0w0c4o40ws4oo084o40','$2y$13$yPmHbV6QjaeZ90ICglrck.MnSqNxqUgwpzLrx8itx8Pg6QHyUAx8a','2016-06-22 20:34:13',0,0,NULL,NULL,NULL,'a:1:{i:0;s:15:\"ROLE_PARTICULAR\";}',0,NULL,'Gómez','Gerardo Saúl','34-90443322-9','Rivadavia 1345','30392920202','masculino','particular'),(3,'Corporativo','corporativo','corporativo@gmail.com','corporativo@gmail.com',1,'31jpzcmaimyoo4wggg0woccg0wsgg8k','$2y$13$edLubIr9xpFQZ1b1Lt/A8uBuwwmDoeWL8XL0mh.GysDaL05/i4A3W','2017-04-11 13:54:37',0,0,NULL,NULL,NULL,'a:2:{i:0;s:15:\"ROLE_PARTICULAR\";i:1;s:16:\"ROLE_CORPORATIVO\";}',0,NULL,'Corporativo SA','Corporativo SA','30-45939292-9','López y Planes 549','320202020202',NULL,'corporativo');
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;

--
-- Table structure for table `operario`
--

DROP TABLE IF EXISTS `operario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `centrointegral` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operario`
--

/*!40000 ALTER TABLE `operario` DISABLE KEYS */;
/*!40000 ALTER TABLE `operario` ENABLE KEYS */;

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `estado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `monto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DD5A5B7DA76ED395` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan`
--

/*!40000 ALTER TABLE `plan` DISABLE KEYS */;
INSERT INTO `plan` VALUES (1,3,'aprobado',4400),(2,3,'enviado',3600),(3,3,'enviado',3900),(4,3,'enviado',7900),(5,3,'enviado',2600),(6,3,'enviado',2100),(7,3,'enviado',4000),(8,3,'enviado',4500),(9,3,'enviado',22500),(10,3,'enviado',3900),(11,3,'enviado',12000),(12,3,'enviado',13700);
/*!40000 ALTER TABLE `plan` ENABLE KEYS */;

--
-- Table structure for table `tipolavado`
--

DROP TABLE IF EXISTS `tipolavado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipolavado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `precio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3DFFCA163A909126` (`nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipolavado`
--

/*!40000 ALTER TABLE `tipolavado` DISABLE KEYS */;
INSERT INTO `tipolavado` VALUES (1,'Completo','<ul>\r\n<li>Lavado de Asientos</li>\r\n<li>Lavado de Alfombras</li>\r\n<li>Lavado de Puertas</li>\r\n<li>Lavado de Techo</li>\r\n<li>Lavado de Cinturones de Seguridad</li>\r\n<li>Lavado de Tablero, Timón y Consola</li>\r\n<li>Lavado de Maletera</li>\r\n<li>Aplicación de Silicona a todo el Interior</li>\r\n<li>Lavado de Chasis (parte baja del vehículo)</li>\r\n<li>Lavado de Motor</li>\r\n<li>Aplicación de Silicona Especial al Motor</li>\r\n<li>Lavado de Carrocería</li>\r\n<li>Aplicación de Silicona a todos los Jebes</li>\r\n<li>Aplicación de Silicona especial a las Llantas</li>\r\n<li>Encerado de Carrocería (cera 3M)</li>\r\n<li>Perfumado de Salón</li>\r\n</ul>','600'),(2,'Interior','<ul>\r\n<li>Lavado de Asientos</li>\r\n<li>Lavado de Alfombras</li>\r\n<li>Lavado de Puertas</li>\r\n<li>Lavado de Techo</li>\r\n<li>Lavado de Cinturones de Seguridad</li>\r\n<li>Lavado de Tablero, Timón y Consola</li>\r\n<li>Lavado de Maletera</li>\r\n<li>Aplicación de Silicona a todo el Interior</li>\r\n<li>Perfumado de Salón</li>\r\n</ul>','500'),(3,'Ejecutivo','<ul>\r\n<li>Aspirado de Asientos</li>\r\n<li>Aspirado de Alfombras</li>\r\n<li>Lavado de Puertas</li>\r\n<li>Lavado de Techo</li>\r\n<li>Lavado de Cinturones de Seguridad</li>\r\n<li>Lavado de Tablero, Timón y Consola</li>\r\n<li>Lavado de Maletera</li>\r\n<li>Aplicación de Silicona a todo el Interior</li>\r\n<li>Lavado de Chasis (parte baja del vehículo)</li>\r\n<li>Lavado de Motor</li>\r\n<li>Aplicación de Silicona Especial al Motor</li>\r\n<li>Lavado de Carrocería</li>\r\n<li>Aplicación de Silicona a todos los Jebes</li>\r\n<li>Aplicación de Silicona especial a las Llantas</li>\r\n<li>Encerado de Carrocería (cera 3M)</li>\r\n<li>Perfumado de Salón</li>\r\n</ul>','800'),(4,'Económico','<ul>\r\n<li>Aspirado de Asientos</li>\r\n<li>Aspirado de Alfombras</li>\r\n<li>Aspirado de Maletera</li>\r\n<li>Limpieza de Puertas y Tablero</li>\r\n<li>Aplicación de Silicona a todo el Interior</li>\r\n<li>Lavado de Chasis (parte baja del vehículo)</li>\r\n<li>Lavado de Motor</li>\r\n<li>Aplicación de Silicona Especial al Motor</li>\r\n<li>Lavado de Carrocería</li>\r\n<li>Aplicación de Silicona especial a las Llantas</li>\r\n<li>Perfumado de Salón</li>\r\n</ul>','400'),(5,'Expreso','<ul>\r\n<li>Aspirado de Asientos</li>\r\n<li>Aspirado de Alfombras</li>\r\n<li>Limpieza de Puertas y Tablero</li>\r\n<li>Aplicación de Silicona al Tablero</li>\r\n<li>Lavado de Carrocería</li>\r\n<li>Aplicación de Silicona especial a las Llantas</li>\r\n</ul>','200');
/*!40000 ALTER TABLE `tipolavado` ENABLE KEYS */;

--
-- Table structure for table `turno_par`
--

DROP TABLE IF EXISTS `turno_par`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turno_par` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehiculo_id` int(11) NOT NULL,
  `tipolavado_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `centrointegral_id` int(11) NOT NULL,
  `operario_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `monto` int(11) NOT NULL,
  `fechahoracierre` datetime DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `movil` tinyint(1) NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `patente` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F8EF6B6525F7D575` (`vehiculo_id`),
  KEY `IDX_F8EF6B6562FDCA86` (`tipolavado_id`),
  KEY `IDX_F8EF6B65A76ED395` (`user_id`),
  KEY `IDX_F8EF6B65E3C28265` (`centrointegral_id`),
  KEY `IDX_F8EF6B65A32F015C` (`operario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turno_par`
--

/*!40000 ALTER TABLE `turno_par` DISABLE KEYS */;
INSERT INTO `turno_par` VALUES (1,1,1,3,2,NULL,'2016-06-22','20:00:00',800,NULL,'reservado',0,NULL,'www000'),(2,2,3,3,3,NULL,'2016-06-22','14:00:00',1100,NULL,'reservado',0,NULL,'rty934'),(3,2,2,2,4,NULL,'2016-06-22','14:00:00',800,NULL,'reservado',1,'Avenida Edison 1430','trr456'),(4,2,1,2,6,NULL,'2016-06-22','18:00:00',900,NULL,'cancelado',0,NULL,'sss123'),(5,2,5,2,2,NULL,'2016-06-22','16:00:00',500,NULL,'reservado',1,'Avenida Edison 1430','aaa123'),(6,2,3,2,5,NULL,'2016-06-22','12:00:00',1100,NULL,'reservado',1,'Avenida Chaco 980','www000'),(7,2,2,2,2,NULL,'2016-06-22','16:00:00',800,NULL,'reservado',0,NULL,'ddd222'),(8,2,2,2,2,NULL,'2016-06-22','16:00:00',800,NULL,'reservado',0,NULL,'ddd222'),(9,2,2,2,6,NULL,'2016-06-22','16:00:00',800,NULL,'reservado',0,NULL,'ddd222'),(10,2,3,3,2,NULL,'2016-06-24','17:00:00',1100,NULL,'cancelado',0,NULL,'www000'),(11,2,1,2,1,NULL,'2016-06-30','14:00:00',900,NULL,'reservado',1,'Avenida Edison 1430','www000'),(12,2,5,2,2,NULL,'2016-06-30','18:00:00',500,NULL,'reservado',1,'Avenida Edison 1430','www000'),(13,2,3,1,2,NULL,'2016-06-30','17:00:00',1100,NULL,'reservado',1,'Avenida Edison 1430','sss123'),(14,2,4,1,2,NULL,'2016-06-23','18:00:00',700,NULL,'reservado',1,'Avenida Chaco 980','www000'),(15,1,1,3,2,NULL,'2016-06-20','08:00:00',800,NULL,'reservado',1,'Avenida Chaco 980','www000'),(16,2,1,3,1,NULL,'2016-02-09','17:00:00',900,NULL,'reservado',0,NULL,'sss123'),(17,1,3,3,1,NULL,'2016-04-13','18:00:00',1000,NULL,'reservado',0,NULL,'aaa123'),(18,3,2,3,1,NULL,'2016-04-20','18:00:00',1000,NULL,'reservado',0,NULL,'aaa123'),(19,3,1,3,1,NULL,'2015-03-11','19:00:00',1100,NULL,'realizado',0,NULL,'rty934'),(20,1,1,3,1,NULL,'2015-06-02','17:00:00',800,NULL,'realizado',0,NULL,'sss123'),(21,4,3,3,2,NULL,'2015-09-16','17:00:00',1200,NULL,'realizado',0,NULL,'www000'),(22,4,4,3,3,NULL,'2015-01-15','18:00:00',800,NULL,'realizado',0,NULL,'www000'),(23,1,3,3,1,NULL,'2016-06-23','11:00:00',1000,NULL,'reservado',0,NULL,'www000'),(24,2,2,3,1,NULL,'2016-06-24','11:00:00',800,NULL,'cancelado',0,NULL,'www000'),(25,1,2,3,2,NULL,'2016-06-30','13:00:00',700,NULL,'reservado',0,NULL,'www000'),(26,3,2,3,1,NULL,'2016-06-25','16:00:00',1000,NULL,'reservado',0,NULL,'www000'),(27,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'reservado',1,'Salta 456','sss123'),(28,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'cancelado',1,'Salta 456','sss123'),(29,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'reservado',1,'Salta 456','sss123'),(30,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'reservado',1,'Salta 456','sss123'),(31,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'reservado',1,'Salta 456','sss123'),(32,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'reservado',1,'Salta 456','sss123'),(33,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'reservado',1,'Salta 456','sss123'),(34,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'reservado',1,'Salta 456','sss123'),(35,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'reservado',1,'Salta 456','sss123'),(36,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'reservado',1,'Salta 456','sss123'),(37,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'reservado',1,'Salta 456','sss123'),(38,1,2,1,3,NULL,'2016-07-20','18:00:00',700,NULL,'reservado',1,'Salta 456','sss123'),(39,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(40,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(41,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(42,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(43,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(44,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(45,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(46,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(47,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(48,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(49,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(50,3,1,1,1,NULL,'2016-07-21','18:00:00',1100,NULL,'reservado',0,NULL,'sss123'),(51,1,2,1,1,NULL,'2016-06-22','18:00:00',700,NULL,'reservado',0,NULL,'sss123'),(52,1,2,1,1,NULL,'2016-06-22','18:00:00',700,NULL,'reservado',0,NULL,'sss123'),(53,1,2,1,1,NULL,'2016-06-22','18:00:00',700,NULL,'reservado',0,NULL,'sss123'),(54,1,1,3,1,NULL,'2016-08-17','15:00:00',800,NULL,'cancelado',0,NULL,'sss123'),(55,1,1,3,1,NULL,'2016-08-17','15:00:00',800,NULL,'reservado',0,NULL,'sss123'),(56,1,1,3,1,NULL,'2016-08-17','15:00:00',800,NULL,'reservado',0,NULL,'sss123'),(57,1,1,3,1,NULL,'2016-08-17','15:00:00',800,NULL,'reservado',0,NULL,'sss123'),(58,1,1,3,1,NULL,'2016-08-17','15:00:00',800,NULL,'reservado',0,NULL,'sss123'),(59,1,1,3,1,NULL,'2016-08-17','15:00:00',800,NULL,'reservado',0,NULL,'sss123'),(60,1,1,3,1,NULL,'2016-08-17','15:00:00',800,NULL,'reservado',0,NULL,'sss123'),(61,2,1,3,1,NULL,'2016-08-17','17:00:00',900,NULL,'reservado',0,NULL,'sss123'),(62,4,1,3,2,NULL,'2016-08-18','15:00:00',1000,NULL,'reservado',0,NULL,'sss123'),(63,4,1,3,2,NULL,'2016-08-18','15:00:00',1000,NULL,'reservado',0,NULL,'sss123'),(64,4,1,3,2,NULL,'2016-08-18','15:00:00',1000,NULL,'reservado',0,NULL,'sss123'),(65,4,1,3,2,NULL,'2016-08-18','15:00:00',1000,NULL,'reservado',0,NULL,'sss123'),(66,4,1,3,2,NULL,'2016-08-18','15:00:00',1000,NULL,'reservado',0,NULL,'sss123'),(67,1,2,1,2,NULL,'2016-08-19','14:00:00',700,NULL,'cancelado',0,NULL,'sss123'),(68,1,2,1,2,NULL,'2016-08-19','14:00:00',700,NULL,'reservado',0,NULL,'sss123'),(69,1,1,1,1,NULL,'2016-09-14','15:00:00',800,NULL,'reservado',0,NULL,'sss123'),(70,2,1,1,2,NULL,'2016-09-29','13:00:00',900,NULL,'reservado',1,'asdfsdaf asdf sfsdf','sss123'),(71,3,1,1,2,NULL,'2016-11-16','17:00:00',1100,NULL,'reservado',1,'avenida siempre viva 1245','sss123'),(72,4,3,1,2,NULL,'2016-11-26','19:00:00',1200,NULL,'reservado',1,'356565','sss123'),(73,3,2,1,3,NULL,'2016-11-16','17:00:00',1000,NULL,'reservado',0,NULL,'sss123'),(74,2,4,3,4,NULL,'2016-11-23','17:00:00',700,NULL,'reservado',1,'hhfgjj nkl 678','hhh666'),(75,2,2,3,3,NULL,'2016-12-14','18:00:00',800,NULL,'reservado',0,NULL,'sss123'),(76,2,2,1,4,NULL,'2017-02-08','13:00:00',800,NULL,'cancelado',0,NULL,'sss123'),(77,3,1,1,3,NULL,'2017-02-15','17:00:00',1100,NULL,'reservado',1,'ddddd ggf','sss123'),(78,2,4,1,4,NULL,'2017-02-23','14:00:00',700,NULL,'cancelado',1,'ddddd ggf','sss123'),(79,1,1,1,1,NULL,'2017-04-28','18:00:00',800,NULL,'cancelado',0,NULL,'sss123'),(80,1,3,1,2,NULL,'2017-04-30','16:00:00',1000,NULL,'reservado',0,NULL,'sss123');
/*!40000 ALTER TABLE `turno_par` ENABLE KEYS */;

--
-- Table structure for table `vehiculo`
--

DROP TABLE IF EXISTS `vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `precio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C9FA16033A909126` (`nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculo`
--

/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
INSERT INTO `vehiculo` VALUES (1,'Automóvil','asd','200'),(2,'Pick-up','asd','300'),(3,'Camión','sas','500'),(4,'Furgón','asd','400');
/*!40000 ALTER TABLE `vehiculo` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-01 13:49:34
