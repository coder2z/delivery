-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: delivery
-- ------------------------------------------------------
-- Server version	5.7.19-log

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
-- Table structure for table `borrow`
--

DROP TABLE IF EXISTS `borrow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver` varchar(50) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `tel` char(11) DEFAULT NULL,
  `goods` varchar(100) DEFAULT NULL,
  `number` char(50) DEFAULT '00000000000',
  `order_time` date DEFAULT NULL,
  `status` int(1) unsigned zerofill DEFAULT '0',
  `rangs_id` char(50) DEFAULT NULL,
  `sale` char(50) DEFAULT NULL,
  `specifications` varchar(100) DEFAULT '0',
  `enddate` int(10) DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `weight` char(10) DEFAULT NULL,
  `status_special` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrow`
--

LOCK TABLES `borrow` WRITE;
/*!40000 ALTER TABLE `borrow` DISABLE KEYS */;
INSERT INTO `borrow` VALUES (32,'张三','四川省成都市XXX','18281625875','板蓝根颗粒','100','2019-04-17',1,'23','25000','10g*20袋/包',3,22,'50',1),(33,'李四','123','18281625875','板蓝根颗粒','100','2019-04-17',1,'22','4000','10',2,22,'10',0),(34,'王麻子','香港','15281600000','测试药品','100','2019-04-17',1,'32','30000','10',5,22,'10',0),(35,'唐力','广东省','18281626725','板蓝根颗粒','10','2019-04-24',1,'19','20000','10g*20包/袋',5,28,'20',0),(36,'王某','成都市','11111111111','板蓝根颗粒','4','2019-05-28',1,'23','4000','10g*20袋/包',2,22,'20',0),(37,'唐某','成都市','12222222222','板蓝根颗粒','25','2019-05-28',1,'23','25000','10g*20袋/包',3,22,'20',0),(38,'陈某','重庆市','13333333333','板蓝根颗粒','30','2019-05-28',1,'22','30000','10g*20袋/包',5,22,'20',0);
/*!40000 ALTER TABLE `borrow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `contacts` varchar(100) DEFAULT NULL,
  `tel` char(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'A公司2','张三2','15281601231','四川成都'),(45,'admin测试公司','admin','15281604123','四川成都');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nexus`
--

DROP TABLE IF EXISTS `nexus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nexus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ranges_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nexus`
--

LOCK TABLES `nexus` WRITE;
/*!40000 ALTER TABLE `nexus` DISABLE KEYS */;
INSERT INTO `nexus` VALUES (120,34,1),(121,33,1),(122,32,1),(123,31,1),(124,30,1),(125,29,1),(126,28,1),(127,27,1),(128,26,1),(129,25,1),(130,24,1),(131,23,1),(132,22,1),(133,21,1),(134,20,1),(135,19,1),(136,18,1),(137,17,1),(138,16,1),(139,15,1),(140,14,1),(141,13,1),(142,12,1),(143,11,1),(144,10,1),(145,9,1),(146,8,1),(147,7,1),(148,6,1),(149,5,1),(150,4,1),(151,3,1),(152,2,1),(153,1,1);
/*!40000 ALTER TABLE `nexus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profession`
--

DROP TABLE IF EXISTS `profession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profession` (
  `id` int(5) NOT NULL,
  `profession` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profession`
--

LOCK TABLES `profession` WRITE;
/*!40000 ALTER TABLE `profession` DISABLE KEYS */;
INSERT INTO `profession` VALUES (0,'销售员'),(1,'发运科');
/*!40000 ALTER TABLE `profession` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranges`
--

DROP TABLE IF EXISTS `ranges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ranges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranges`
--

LOCK TABLES `ranges` WRITE;
/*!40000 ALTER TABLE `ranges` DISABLE KEYS */;
INSERT INTO `ranges` VALUES (1,'北京市'),(2,'天津市'),(3,'河北省'),(4,'山西省'),(5,'内蒙古自治区'),(6,'辽宁省'),(7,'吉林省'),(8,'黑龙江省'),(9,'上海市'),(10,'江苏省'),(11,'浙江省'),(12,'安徽省'),(13,'福建省'),(14,'江西省'),(15,'山东省'),(16,'河南省'),(17,'湖北省'),(18,'湖南省'),(19,'广东省'),(20,'广西壮族自治区'),(21,'海南省'),(22,'重庆市'),(23,'四川省'),(24,'贵州省'),(25,'云南省'),(26,'西藏自治区'),(27,'陕西省'),(28,'甘肃省'),(29,'青海省'),(30,'宁夏回族自治区'),(31,'新疆维吾尔自治区'),(32,'香港'),(33,'澳门'),(34,'台湾');
/*!40000 ALTER TABLE `ranges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `tel` char(111) NOT NULL,
  `number` char(181) NOT NULL,
  `token` int(5) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `check` int(1) unsigned zerofill DEFAULT '0',
  `remember_token` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (22,'超级管理员','15200000001','510723000000004400',2,'$2y$10$JZTf/4l/ZtyoAMs0v/uEE.GbBnIOAngy9ZKDlA1rWVR42hzFX6e4O',1,'eLR5758fbekxpe79n8Xk2ASPN0RvSHVfSGXCvNZKZURj55R8UC8l7sfAMwAr'),(28,'销售人员','15200000000','510723000000004444',0,'$2y$10$ZtbTaSsOQOaKrKLkfVAiVeT6yDjrJ69ajWLZTh8bwhgxM7T4/4QWW',1,'iwZ5btalyIXZo2G2InHKfW26512OsptaMe3kVV3J4xSwStCySoEZqgTr9sBN'),(31,'田生','18281625983','510322199611150000',1,'$2y$10$hJXfr4dNSklBhyizry4scu7VK5FMKpG0u5KVoTLq9rUwlBJnazUwm',1,'4ohWEzDs2fvvQLvqmV9n6ez5eUtvtamVcCciGI3Zal8yTApix5sbHsBgbOlC'),(32,'test','15281605511','510723000000004412',2,'$2y$10$J4d1yP.0cFt8yyP3AqavseTrSRlNK3A0f3OtJHV8WO1oB3HXagtyC',1,'0'),(33,'唐','18281626983','511322199611157777',1,'$2y$10$.c35qHEeUhnyRkphOLa/S.RuSfOAyWNcULk3E0fArZOAGaNavcym2',1,'0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-06 12:14:16
