-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: rym_admin
-- ------------------------------------------------------
-- Server version	5.6.25

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
-- Table structure for table `accesorio_tipo_media`
--

DROP TABLE IF EXISTS `accesorio_tipo_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_tipo_media` (
  `tip_med_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_med_nombre` varchar(45) NOT NULL,
  `tip_med_fecha` datetime DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`tip_med_id`),
  KEY `fk_accesorio_tipo_media_estado1_idx` (`est_id`),
  CONSTRAINT `fk_accesorio_tipo_media_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_tipo_media`
--

LOCK TABLES `accesorio_tipo_media` WRITE;
/*!40000 ALTER TABLE `accesorio_tipo_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `accesorio_tipo_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accesorio_tipo_publicacion`
--

DROP TABLE IF EXISTS `accesorio_tipo_publicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_tipo_publicacion` (
  `tip_pub_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_pub_nombre` varchar(45) NOT NULL,
  `tip_pub_fecha` datetime DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`tip_pub_id`),
  KEY `fk_accesorio_tipo_noticia_estado1_idx` (`est_id`),
  CONSTRAINT `fk_accesorio_tipo_noticia_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_tipo_publicacion`
--

LOCK TABLES `accesorio_tipo_publicacion` WRITE;
/*!40000 ALTER TABLE `accesorio_tipo_publicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `accesorio_tipo_publicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accesorio_tipo_usuario`
--

DROP TABLE IF EXISTS `accesorio_tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_tipo_usuario` (
  `tip_usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_usu_nombre` varchar(45) NOT NULL,
  `tip_usu_fecha_creacion` datetime NOT NULL,
  `tip_usu_fecha_edicion` datetime DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`tip_usu_id`),
  KEY `fk_accesorio_tipo_usuario_estado1_idx` (`est_id`),
  CONSTRAINT `fk_accesorio_tipo_usuario_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_tipo_usuario`
--

LOCK TABLES `accesorio_tipo_usuario` WRITE;
/*!40000 ALTER TABLE `accesorio_tipo_usuario` DISABLE KEYS */;
INSERT INTO `accesorio_tipo_usuario` VALUES (1,'Locutor','2015-09-26 19:14:27','2015-09-26 19:25:58',1,2),(2,'Creador Contenido','2015-09-26 19:25:23','2015-09-26 19:26:02',1,2);
/*!40000 ALTER TABLE `accesorio_tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nombre` varchar(45) NOT NULL,
  `cat_slug` varchar(45) DEFAULT NULL,
  `cat_fecha_creacion` datetime NOT NULL,
  `cat_fecha_edicion` datetime DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  `tip_pub_id` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`),
  KEY `fk_noticia_categoria_estado1_idx` (`est_id`),
  KEY `fk_categoria_accesorio_tipo_publicacion1_idx` (`tip_pub_id`),
  CONSTRAINT `fk_categoria_accesorio_tipo_publicacion1` FOREIGN KEY (`tip_pub_id`) REFERENCES `accesorio_tipo_publicacion` (`tip_pub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_noticia_categoria_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edicion_publicacion`
--

DROP TABLE IF EXISTS `edicion_publicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edicion_publicacion` (
  `edi_pub_id` int(11) NOT NULL AUTO_INCREMENT,
  `edi_pub_fecha` datetime NOT NULL,
  `edi_pub_ip` varchar(60) NOT NULL,
  `pub_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  PRIMARY KEY (`edi_pub_id`),
  KEY `fk_edicion_publicacion_publicacion1_idx` (`pub_id`),
  KEY `fk_edicion_publicacion_usuario1_idx` (`usu_id`),
  CONSTRAINT `fk_edicion_publicacion_publicacion1` FOREIGN KEY (`pub_id`) REFERENCES `publicacion` (`pub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_edicion_publicacion_usuario1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edicion_publicacion`
--

LOCK TABLES `edicion_publicacion` WRITE;
/*!40000 ALTER TABLE `edicion_publicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `edicion_publicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_nombre` varchar(45) NOT NULL,
  `est_uso` int(11) NOT NULL,
  PRIMARY KEY (`est_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Activo',1),(2,'Inactivo',1);
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_acceso_historial`
--

DROP TABLE IF EXISTS `log_acceso_historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_acceso_historial` (
  `log_acc_his_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_acc_his_fecha` datetime NOT NULL,
  `mod_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  PRIMARY KEY (`log_acc_his_id`),
  KEY `fk_eys_log_acceso_historial_modulo1_idx` (`mod_id`),
  KEY `fk_eys_log_acceso_historial_usuario1_idx` (`usu_id`),
  CONSTRAINT `fk_eys_log_acceso_historial_modulo1` FOREIGN KEY (`mod_id`) REFERENCES `modulo` (`mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_acceso_historial_usuario1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_acceso_historial`
--

LOCK TABLES `log_acceso_historial` WRITE;
/*!40000 ALTER TABLE `log_acceso_historial` DISABLE KEYS */;
INSERT INTO `log_acceso_historial` VALUES (1,'2015-09-27 02:07:22',3,1),(2,'2015-09-27 02:07:25',3,1),(3,'2015-09-27 02:07:41',3,1),(4,'2015-09-27 02:11:11',3,1),(5,'2015-09-27 02:11:17',3,1),(6,'2015-09-27 02:12:33',3,1),(7,'2015-09-27 02:12:38',3,1),(8,'2015-09-27 02:12:40',3,1),(9,'2015-09-27 02:12:44',3,1),(10,'2015-09-27 02:13:15',3,1),(11,'2015-09-27 02:13:15',3,1),(12,'2015-09-27 02:13:22',3,1),(13,'2015-09-27 02:13:58',3,1),(14,'2015-09-27 02:14:27',3,1),(15,'2015-09-27 02:15:15',3,1),(16,'2015-09-27 02:15:23',3,1),(17,'2015-09-27 02:15:23',3,1),(18,'2015-09-27 02:15:38',3,1),(19,'2015-09-27 02:16:46',3,1),(20,'2015-09-27 02:16:48',3,1),(21,'2015-09-27 02:16:50',3,1),(22,'2015-09-27 02:17:50',3,1),(23,'2015-09-27 02:18:58',3,1),(24,'2015-09-27 02:19:30',3,1),(25,'2015-09-27 02:20:34',3,1),(26,'2015-09-27 02:20:38',3,1),(27,'2015-09-27 02:20:57',3,1),(28,'2015-09-27 02:22:12',3,1),(29,'2015-09-27 02:22:15',3,1),(30,'2015-09-27 02:22:48',3,1),(31,'2015-09-27 02:23:27',3,1),(32,'2015-09-27 02:23:30',3,1),(33,'2015-09-27 02:23:32',3,1),(34,'2015-09-27 02:24:20',3,1),(35,'2015-09-27 02:24:28',3,1),(36,'2015-09-27 02:24:44',3,1),(37,'2015-09-27 02:24:47',3,1),(38,'2015-09-27 02:24:55',3,1),(39,'2015-09-27 02:24:57',3,1),(40,'2015-09-27 02:25:03',3,1),(41,'2015-09-27 02:25:14',3,1),(42,'2015-09-27 02:25:23',3,1),(43,'2015-09-27 02:25:26',3,1),(44,'2015-09-27 02:25:35',3,1),(45,'2015-09-27 02:25:37',3,1),(46,'2015-09-27 02:25:50',3,1),(47,'2015-09-27 02:25:53',3,1),(48,'2015-09-27 02:25:58',3,1),(49,'2015-09-27 02:26:00',3,1),(50,'2015-09-27 02:26:02',3,1),(51,'2015-09-27 02:26:12',3,1),(52,'2015-09-27 02:26:14',3,1);
/*!40000 ALTER TABLE `log_acceso_historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_nombre` varchar(45) NOT NULL,
  `mod_clase_icono` varchar(20) DEFAULT NULL,
  `mod_dependencia` int(11) NOT NULL,
  `mod_url` varchar(100) DEFAULT NULL,
  `mod_tipo` int(11) DEFAULT NULL,
  `mod_orden` varchar(45) DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`mod_id`),
  KEY `fk_modulo_estado1_idx` (`est_id`),
  CONSTRAINT `fk_modulo_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` VALUES (1,'Gestión Usuarios','fa-users',0,'users',NULL,NULL,1),(2,'Usuarios','fa-users',1,'usuario',NULL,NULL,1),(3,'Tipo Usuarios','fa-group',1,'tipousuario',NULL,NULL,1);
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo_acceso`
--

DROP TABLE IF EXISTS `modulo_acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo_acceso` (
  `mod_id` int(11) NOT NULL,
  `usu_rol_id` int(11) NOT NULL,
  PRIMARY KEY (`mod_id`,`usu_rol_id`),
  KEY `fk_modulo_has_usuario_rol_usuario_rol1_idx` (`usu_rol_id`),
  KEY `fk_modulo_has_usuario_rol_modulo1_idx` (`mod_id`),
  CONSTRAINT `fk_modulo_has_usuario_rol_modulo1` FOREIGN KEY (`mod_id`) REFERENCES `modulo` (`mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_modulo_has_usuario_rol_usuario_rol1` FOREIGN KEY (`usu_rol_id`) REFERENCES `usuario_rol` (`usu_rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo_acceso`
--

LOCK TABLES `modulo_acceso` WRITE;
/*!40000 ALTER TABLE `modulo_acceso` DISABLE KEYS */;
INSERT INTO `modulo_acceso` VALUES (2,1),(3,1);
/*!40000 ALTER TABLE `modulo_acceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicacion`
--

DROP TABLE IF EXISTS `publicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicacion` (
  `pub_id` int(11) NOT NULL AUTO_INCREMENT,
  `pub_slug` varchar(30) DEFAULT NULL,
  `pub_nombre` varchar(50) NOT NULL,
  `pub_contenido` text NOT NULL,
  `pub_multimedia` text NOT NULL,
  `pub_fecha_publicacion` datetime NOT NULL,
  `pub_fecha_creacion` datetime DEFAULT NULL,
  `pub_fecha_edicion` datetime DEFAULT NULL,
  `pub_extracto` varchar(140) DEFAULT NULL,
  `usu_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL,
  `tip_med_id` int(11) NOT NULL,
  PRIMARY KEY (`pub_id`),
  KEY `fk_noticias_usuario1_idx` (`usu_id`),
  KEY `fk_noticias_estado1_idx` (`est_id`),
  KEY `fk_publicacion_accesorio_tipo_media1_idx` (`tip_med_id`),
  CONSTRAINT `fk_noticias_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_noticias_usuario1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_publicacion_accesorio_tipo_media1` FOREIGN KEY (`tip_med_id`) REFERENCES `accesorio_tipo_media` (`tip_med_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacion`
--

LOCK TABLES `publicacion` WRITE;
/*!40000 ALTER TABLE `publicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `publicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicacion_tag`
--

DROP TABLE IF EXISTS `publicacion_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicacion_tag` (
  `pub_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`pub_id`,`tag_id`),
  KEY `fk_publicacion_has_tag_tag1_idx` (`tag_id`),
  KEY `fk_publicacion_has_tag_publicacion1_idx` (`pub_id`),
  CONSTRAINT `fk_publicacion_has_tag_publicacion1` FOREIGN KEY (`pub_id`) REFERENCES `publicacion` (`pub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_publicacion_has_tag_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacion_tag`
--

LOCK TABLES `publicacion_tag` WRITE;
/*!40000 ALTER TABLE `publicacion_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `publicacion_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranking_publicacion`
--

DROP TABLE IF EXISTS `ranking_publicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ranking_publicacion` (
  `ran_pub_id` int(11) NOT NULL AUTO_INCREMENT,
  `ran_pub_fecha` datetime NOT NULL,
  `ran_pub_ip` varchar(60) NOT NULL,
  `ran_pub_puntos` varchar(45) NOT NULL,
  `pub_id` int(11) NOT NULL,
  PRIMARY KEY (`ran_pub_id`),
  KEY `fk_ranking_publicacion_publicacion1_idx` (`pub_id`),
  CONSTRAINT `fk_ranking_publicacion_publicacion1` FOREIGN KEY (`pub_id`) REFERENCES `publicacion` (`pub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranking_publicacion`
--

LOCK TABLES `ranking_publicacion` WRITE;
/*!40000 ALTER TABLE `ranking_publicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `ranking_publicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_nombre` varchar(45) NOT NULL,
  `tag_slug` varchar(45) DEFAULT NULL,
  `tag_fecha_creacion` datetime NOT NULL,
  `tag_fecha_edicion` datetime DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`),
  KEY `fk_tag_estado1_idx` (`est_id`),
  CONSTRAINT `fk_tag_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `usu_id` int(11) NOT NULL,
  `tip_usu_id` int(11) NOT NULL,
  PRIMARY KEY (`usu_id`,`tip_usu_id`),
  KEY `fk_usuario_has_accesorio_tipo_usuario_accesorio_tipo_usuari_idx` (`tip_usu_id`),
  KEY `fk_usuario_has_accesorio_tipo_usuario_usuario1_idx` (`usu_id`),
  CONSTRAINT `fk_usuario_has_accesorio_tipo_usuario_accesorio_tipo_usuario1` FOREIGN KEY (`tip_usu_id`) REFERENCES `accesorio_tipo_usuario` (`tip_usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_accesorio_tipo_usuario_usuario1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_slug` varchar(45) DEFAULT NULL,
  `usu_nombre` varchar(45) NOT NULL,
  `usu_apellido` varchar(45) NOT NULL,
  `usu_username` varchar(20) NOT NULL,
  `usu_correo` varchar(100) NOT NULL,
  `usu_telefono` varchar(45) DEFAULT NULL,
  `usu_celular` varchar(45) DEFAULT NULL,
  `usu_foto` text,
  `usu_bio` text,
  `usu_fecha_creacion` datetime NOT NULL,
  `usu_contrasena` varchar(32) DEFAULT NULL,
  `usu_rol_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`usu_id`),
  KEY `fk_usuario_usuario_rol1_idx` (`usu_rol_id`),
  KEY `fk_usuario_estado1_idx` (`est_id`),
  CONSTRAINT `fk_usuario_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_usuario_rol1` FOREIGN KEY (`usu_rol_id`) REFERENCES `usuario_rol` (`usu_rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','admin','admin','admin','admin@g.com',NULL,NULL,'profile_admin.jpg',NULL,'0000-00-00 00:00:00','81dc9bdb52d04dc20036dbd8313ed055',1,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_rol`
--

DROP TABLE IF EXISTS `usuario_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_rol` (
  `usu_rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_rol_nombre` varchar(45) NOT NULL,
  `usu_fecha_creacion` datetime NOT NULL,
  `usu_fecha_edicion` datetime DEFAULT NULL,
  PRIMARY KEY (`usu_rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_rol`
--

LOCK TABLES `usuario_rol` WRITE;
/*!40000 ALTER TABLE `usuario_rol` DISABLE KEYS */;
INSERT INTO `usuario_rol` VALUES (1,'SuperAdministrador','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `usuario_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visita_categoria`
--

DROP TABLE IF EXISTS `visita_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visita_categoria` (
  `vis_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `vis_cat_fecha` datetime NOT NULL,
  `vis_cat_ip` varchar(60) NOT NULL,
  `categoria_cat_id` int(11) NOT NULL,
  PRIMARY KEY (`vis_cat_id`),
  KEY `fk_visita_categoria_categoria1_idx` (`categoria_cat_id`),
  CONSTRAINT `fk_visita_categoria_categoria1` FOREIGN KEY (`categoria_cat_id`) REFERENCES `categoria` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visita_categoria`
--

LOCK TABLES `visita_categoria` WRITE;
/*!40000 ALTER TABLE `visita_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `visita_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visita_publicacion`
--

DROP TABLE IF EXISTS `visita_publicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visita_publicacion` (
  `vis_pub_id` int(11) NOT NULL AUTO_INCREMENT,
  `vis_pub_fecha` datetime NOT NULL,
  `vis_pub_ip` varchar(50) NOT NULL,
  `pub_id` int(11) NOT NULL,
  PRIMARY KEY (`vis_pub_id`),
  KEY `fk_visita_publicacion_publicacion1_idx` (`pub_id`),
  CONSTRAINT `fk_visita_publicacion_publicacion1` FOREIGN KEY (`pub_id`) REFERENCES `publicacion` (`pub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visita_publicacion`
--

LOCK TABLES `visita_publicacion` WRITE;
/*!40000 ALTER TABLE `visita_publicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `visita_publicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visita_tag`
--

DROP TABLE IF EXISTS `visita_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visita_tag` (
  `vis_tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `vis_tag_fecha` datetime NOT NULL,
  `vis_tag_ip` varchar(60) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`vis_tag_id`),
  KEY `fk_visita_tag_tag1_idx` (`tag_id`),
  CONSTRAINT `fk_visita_tag_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visita_tag`
--

LOCK TABLES `visita_tag` WRITE;
/*!40000 ALTER TABLE `visita_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `visita_tag` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-26 19:27:53
