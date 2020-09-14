-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mensajeria
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.38-MariaDB

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
-- Table structure for table `actividad`
--

DROP TABLE IF EXISTS `actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividad` (
  `actividad` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`actividad`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
INSERT INTO `actividad` VALUES (1,'Remesa / Deposito'),(2,'Retirar Guía'),(3,'Cambiar Cheque'),(4,'Retirar BL'),(5,'Pago Factura'),(6,'Entregar Documentos'),(7,'Retirar Documentos'),(9,'Otros'),(10,'Otros');
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `bitacora` int(11) NOT NULL,
  `solicitud` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` int(11) NOT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`bitacora`),
  KEY `fk_bitacora_solicitud1_idx` (`solicitud`),
  CONSTRAINT `fk_bitacora_solicitud1` FOREIGN KEY (`solicitud`) REFERENCES `solicitud` (`solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colaborador`
--

DROP TABLE IF EXISTS `colaborador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colaborador` (
  `idcolaborador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idcolaborador`)
) ENGINE=InnoDB AUTO_INCREMENT=1212 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colaborador`
--

LOCK TABLES `colaborador` WRITE;
/*!40000 ALTER TABLE `colaborador` DISABLE KEYS */;
INSERT INTO `colaborador` VALUES (2,'JONATHAN RIVERA'),(1211,'GABRIELA MARTINEZ');
/*!40000 ALTER TABLE `colaborador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_actividad`
--

DROP TABLE IF EXISTS `detalle_actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_actividad` (
  `iddetalle` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud` int(11) DEFAULT NULL,
  `actividad` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalle`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_actividad`
--

LOCK TABLES `detalle_actividad` WRITE;
/*!40000 ALTER TABLE `detalle_actividad` DISABLE KEYS */;
INSERT INTO `detalle_actividad` VALUES (1,1000,3),(2,1000,4),(3,19,3),(4,19,6),(5,13,6),(6,14,2),(7,15,2),(8,16,2),(9,17,2),(10,18,2),(11,19,3),(12,20,2),(13,22,3),(14,23,2),(15,24,2),(16,25,5),(17,26,5),(18,27,2);
/*!40000 ALTER TABLE `detalle_actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estatus`
--

DROP TABLE IF EXISTS `estatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estatus` (
  `estatus` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `mostrar` bit(1) DEFAULT b'0',
  PRIMARY KEY (`estatus`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estatus`
--

LOCK TABLES `estatus` WRITE;
/*!40000 ALTER TABLE `estatus` DISABLE KEYS */;
INSERT INTO `estatus` VALUES (1,'Solicitud','\0'),(2,'Aceptada','\0'),(3,'Rechazada','\0'),(4,'Asignada','\0'),(5,'En Ruta',''),(6,'Recolectado / Entregado','\0'),(7,'Asignado en Ruta',''),(8,'Finalizado','\0'),(9,'Ejecutado',''),(10,'No Ejecutado','');
/*!40000 ALTER TABLE `estatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajero`
--

DROP TABLE IF EXISTS `mensajero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensajero` (
  `mensajero` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`mensajero`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajero`
--

LOCK TABLES `mensajero` WRITE;
/*!40000 ALTER TABLE `mensajero` DISABLE KEYS */;
INSERT INTO `mensajero` VALUES (1,'GUSTAVO'),(2,'JONATHAN'),(3,'elmer elmer');
/*!40000 ALTER TABLE `mensajero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prioridad`
--

DROP TABLE IF EXISTS `prioridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prioridad` (
  `prioridad` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`prioridad`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prioridad`
--

LOCK TABLES `prioridad` WRITE;
/*!40000 ALTER TABLE `prioridad` DISABLE KEYS */;
INSERT INTO `prioridad` VALUES (1,'BAJA'),(2,'NORMAL'),(3,'ALTA '),(4,'EXPRESS');
/*!40000 ALTER TABLE `prioridad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso`
--

DROP TABLE IF EXISTS `proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso` (
  `idproceso` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idproceso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso`
--

LOCK TABLES `proceso` WRITE;
/*!40000 ALTER TABLE `proceso` DISABLE KEYS */;
INSERT INTO `proceso` VALUES (1,'ADUANA'),(2,'TRANSPORTE'),(3,'IMPORT'),(4,'EXPORT');
/*!40000 ALTER TABLE `proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ruta`
--

DROP TABLE IF EXISTS `ruta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ruta` (
  `idruta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idruta`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruta`
--

LOCK TABLES `ruta` WRITE;
/*!40000 ALTER TABLE `ruta` DISABLE KEYS */;
INSERT INTO `ruta` VALUES (1,'Ruta uno'),(2,'Ruta 2'),(3,'Ruta 3'),(4,'Ruta 4');
/*!40000 ALTER TABLE `ruta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud`
--

DROP TABLE IF EXISTS `solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud` (
  `solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` int(11) NOT NULL COMMENT 'id de usuario quien hace la solicitud',
  `actividad` int(11) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  `file_proceso_id` int(11) NOT NULL,
  `cobrada` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indica si el servicio es cobrado o no',
  `costo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `mensajero` int(11) DEFAULT NULL,
  `idruta` int(11) DEFAULT NULL,
  `fecha_solicitud` datetime DEFAULT NULL,
  `file` varchar(15) DEFAULT NULL,
  `cobrar` bit(1) DEFAULT b'0',
  `justificacion` varchar(120) DEFAULT NULL,
  `fecha_sugerida` date DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `documento` varchar(45) DEFAULT NULL,
  `consignado_a` varchar(100) DEFAULT NULL,
  `lugar` varchar(120) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `direccion` varchar(120) DEFAULT NULL,
  `idtipo` int(11) DEFAULT NULL,
  `idturno` int(11) DEFAULT NULL,
  `idzona` int(11) DEFAULT NULL,
  `hora_sugerida` time(1) DEFAULT NULL,
  `observaciones` varchar(120) DEFAULT NULL,
  `recibido_por` int(11) DEFAULT NULL,
  `fecha_recibido` datetime DEFAULT NULL,
  `aceptada` bit(1) DEFAULT NULL,
  `motivo_rechazo` varchar(100) DEFAULT NULL,
  `hora_entrega` time(1) DEFAULT NULL,
  `liquidada_por` int(11) DEFAULT NULL,
  `fecha_liquidada` datetime DEFAULT NULL,
  `hora_liquidada` time(1) DEFAULT NULL,
  `nota_ent_mensajero` varchar(100) DEFAULT NULL,
  `nota_liquidacion` varchar(100) DEFAULT NULL,
  `fecha_ent_mensajero` datetime DEFAULT NULL,
  `fecha_liquidacion` datetime DEFAULT NULL,
  `nota_estatus` varchar(100) DEFAULT NULL,
  `valor_comision` decimal(10,2) DEFAULT '0.00',
  `detalle` varchar(45) DEFAULT NULL,
  `aplica_comision` bit(1) DEFAULT b'0',
  `manifiesto` bit(1) DEFAULT b'0',
  `finalizado` bit(1) DEFAULT b'0',
  `idproceso` int(11) DEFAULT NULL,
  PRIMARY KEY (`solicitud`),
  KEY `fk_solicitud_actividad1_idx` (`actividad`),
  KEY `fk_solicitud_prioridad1_idx` (`prioridad`),
  KEY `fk_solicitud_estatus1_idx` (`estatus`),
  KEY `fk_solicitud_mensajero_idx` (`mensajero`),
  KEY `fk_ruta_idx` (`idruta`),
  KEY `fk_tipo_idx` (`idtipo`),
  KEY `fk_turno_idx` (`idturno`),
  KEY `idzona_idx` (`idzona`),
  CONSTRAINT `fk_ruta` FOREIGN KEY (`idruta`) REFERENCES `ruta` (`idruta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitud_actividad1` FOREIGN KEY (`actividad`) REFERENCES `actividad` (`actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitud_estatus1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`estatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitud_mensajero` FOREIGN KEY (`mensajero`) REFERENCES `mensajero` (`mensajero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitud_prioridad1` FOREIGN KEY (`prioridad`) REFERENCES `prioridad` (`prioridad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo` FOREIGN KEY (`idtipo`) REFERENCES `tipo` (`idtipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turno` FOREIGN KEY (`idturno`) REFERENCES `turno` (`idturno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idzona` FOREIGN KEY (`idzona`) REFERENCES `zona` (`idzona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud`
--

LOCK TABLES `solicitud` WRITE;
/*!40000 ALTER TABLE `solicitud` DISABLE KEYS */;
INSERT INTO `solicitud` VALUES (9,'2020-07-08 15:06:53',1211,4,3,5,0,1,0.00,3,NULL,NULL,'SV-2020-9990','',NULL,'2020-07-08','2020-07-10 00:00:00','abcd','SigmaQ','Aeropuerto','Elmer','7950 NW 77 ST STE 4, #SAL 50278',1,1,2,'11:06:00.0','NOTAS AQUI',1211,'2020-08-14 15:37:31','',NULL,'20:23:00.0',1211,'2020-07-29 00:00:00','20:41:00.0','observa','obs liquida','2020-07-29 03:09:57','2020-07-29 18:16:19','fdfd',3.00,'Con TRamitador','','\0','\0',77),(10,'2020-07-08 15:07:06',1184,6,3,10,0,0,0.00,2,NULL,NULL,'SV-2020-9991','\0','JUSTIFICADA...','2020-07-08','2020-07-13 00:00:00','abcd','Ferreteria EPA','Banco Cuscatlan','Juan','7950 NW 77 ST STE 4, #SAL 50278',1,2,3,'11:06:00.0','NOTAS AQUI',1211,'2020-07-13 21:00:10','','MOTIVO','23:50:00.0',1211,'2020-07-13 00:00:00','20:41:00.0',NULL,'ssss',NULL,'2020-08-01 19:02:08','dd',425.00,'con%20tramitador','','','\0',77),(13,'2020-07-15 21:39:00',1186,6,2,10,0,1,0.00,2,NULL,NULL,'SV-2020-9993','\0',NULL,'2020-07-15','1970-01-01 00:00:00','12563','GLOBARL CARGO','LUGAR','CONTACTO','7950 NW 77 ST STE 4, #SAL 50278',2,2,2,'17:36:00.0','NOTA',1211,NULL,'',NULL,'00:00:00.0',2,'2020-07-29 00:00:00','17:18:00.0','obs','obs','2020-07-29 03:14:59','2020-07-29 18:14:35','dd',425.00,NULL,'','','\0',78),(14,'2020-07-15 21:57:10',1188,2,1,5,0,1,0.00,2,NULL,NULL,'ddd','\0',NULL,'2020-07-23',NULL,'dsds','dsds','dsds','sdsds','dsds',2,1,2,'18:56:00.0','dsds',1211,NULL,'',NULL,NULL,1211,NULL,NULL,NULL,NULL,NULL,NULL,'u',0.00,'Con TRamitador','\0','','\0',80),(15,'2020-07-15 21:57:33',1189,2,1,5,0,1,0.00,3,NULL,NULL,'ddd','\0',NULL,'2020-07-23',NULL,'100','elmer','dsds','sdsds','dsds',2,1,2,'18:56:00.0','dsds',1211,NULL,'',NULL,NULL,1211,NULL,NULL,NULL,NULL,NULL,NULL,'fdfd',0.00,NULL,'\0','\0','\0',81),(16,'2020-07-15 21:57:48',1190,2,1,10,0,1,0.00,3,NULL,NULL,'ddd','\0',NULL,'2020-07-23',NULL,'100','elmer','dsds','sdsds','dsds',2,1,2,'18:56:00.0','dsds',1211,NULL,'',NULL,NULL,1211,NULL,NULL,NULL,NULL,NULL,NULL,'dd',0.00,'con%20tramitador','\0','','\0',81),(17,'2020-08-15 21:58:47',1184,2,1,10,0,1,0.00,2,NULL,NULL,'dddddddd','\0',NULL,'2020-07-23',NULL,'100','elmer','dsds','sdsds','dsds',2,1,2,'18:56:00.0','dsds',1211,NULL,'',NULL,NULL,1211,NULL,NULL,NULL,NULL,NULL,NULL,'fdfd',425.00,'Tramitadores','','\0','\0',81),(23,'2020-08-22 15:55:39',1188,2,2,5,0,1,0.00,3,NULL,NULL,'','\0',NULL,'2020-07-23','2020-07-22 00:00:00','100','elmer','fdfd','fdfd','fdfd',NULL,2,NULL,'00:00:00.0','dfd',1211,'2020-07-22 17:57:15','\0','rechazada','10:59:00.0',1211,'2020-07-22 00:00:00','14:00:00.0',NULL,'',NULL,'2020-08-12 17:13:07','en ruta',3.00,NULL,'','\0','',80),(24,'2020-08-22 16:42:48',1188,2,2,5,0,1,0.00,1,NULL,NULL,'','\0',NULL,'2020-07-22','2020-07-22 00:00:00','100','SIGMAQ','LUGAR','CONTACTO','DIRECCION',1,1,NULL,'23:51:00.0','NOTA',1211,'2020-08-01 21:17:20','\0','','14:16:00.0',1201,'2020-07-22 00:00:00','14:25:00.0',NULL,'liquidada',NULL,'2020-08-12 17:09:46','oactavo',3.00,'Con%20TRamitador','','\0','',78),(25,'2020-08-14 04:15:43',1211,5,4,10,0,1,0.00,3,NULL,NULL,'','\0',NULL,'2020-08-13',NULL,NULL,NULL,'LUGAR','CONTACTO','P.O.BOX 217, APIA, SAMOA',NULL,2,NULL,'01:14:00.0','notas',1211,'2020-08-14 15:37:47','\0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'dd',3.00,NULL,'','','\0',83),(26,'2020-08-14 04:42:13',1186,5,2,9,0,1,0.00,3,NULL,NULL,'','\0',NULL,'2020-08-14',NULL,NULL,NULL,'LUGAR','CONTACTO','7950 NW 77 ST STE 4, #SAL 50278',NULL,2,NULL,'22:44:00.0','dd',1211,'2020-08-14 15:40:40','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'dd',0.00,NULL,'\0','','\0',80),(27,'2020-08-17 01:09:40',1182,2,2,1,0,1,400.00,NULL,NULL,NULL,'','\0',NULL,'2020-08-16',NULL,'100','SIGMAQ','LUGAR','CONTACTO','P.O.BOX 217, APIA, SAMOA',NULL,2,NULL,'19:11:00.0','dddd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,NULL,'\0','\0','\0',77);
/*!40000 ALTER TABLE `solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (1,'VIAJE CORTO'),(2,'VIAJE LARGO'),(3,'VIAJE NORMAL');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turno`
--

DROP TABLE IF EXISTS `turno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turno` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turno`
--

LOCK TABLES `turno` WRITE;
/*!40000 ALTER TABLE `turno` DISABLE KEYS */;
INSERT INTO `turno` VALUES (1,' MAÑANA'),(2,'TARDE');
/*!40000 ALTER TABLE `turno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zona`
--

DROP TABLE IF EXISTS `zona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zona` (
  `idzona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idzona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zona`
--

LOCK TABLES `zona` WRITE;
/*!40000 ALTER TABLE `zona` DISABLE KEYS */;
INSERT INTO `zona` VALUES (1,'ZONA 1'),(2,'ZONA 2'),(3,'ZONA 3');
/*!40000 ALTER TABLE `zona` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-16 19:23:01
