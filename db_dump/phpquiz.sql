-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: phpquiz
-- ------------------------------------------------------
-- Server version	5.7.20

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
-- Table structure for table `choices`
--

DROP TABLE IF EXISTS `choices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `choices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(100) DEFAULT NULL,
  `is_answer` tinyint(4) DEFAULT '0',
  `question_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `choices`
--

LOCK TABLES `choices` WRITE;
/*!40000 ALTER TABLE `choices` DISABLE KEYS */;
INSERT INTO `choices` VALUES (7,'Person Home Page',0,1),(8,'Hypertext Preprocessor',1,1),(9,'Pretext Hypertext Processor',0,1),(10,'Preprocessor Home Page',0,1),(11,'.html',0,2),(12,'.xml',0,2),(13,'.php',1,2),(14,'.ph',0,2),(15,'< php >',0,3),(16,'< ? php ?>',0,3),(17,'<? ?>',1,3),(18,'<?php ?>',1,3),(19,'Notepad,Notepad++,Adobe Dreamweaver,PDT',1,4),(20,'Adobe Photoshop',0,4),(21,'Gimp',0,4),(22,'Paint',0,4),(23,'Adobe Dreamweaver',0,5),(24,'PHP,Apache,IIS',1,5),(25,'Mysql',0,5),(26,'Phpstorm',0,5),(27,'PHP 4',0,6),(28,'PHP 5',1,6),(29,'PHP 5.3',0,6),(30,'PHP 6',0,6),(31,'/?',0,7),(32,'//,#,/* */',1,7),(33,'/*?',0,7),(34,'#?',0,7),(35,'int $num = 111;',0,8),(36,'int mum = 111;',0,8),(37,'$num = 111;',1,8),(38,'111 = $num;',1,8);
/*!40000 ALTER TABLE `choices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(200) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,'What does PHP stand for?',1),(2,'PHP files have a default file extension of_______',2),(3,'A PHP script should start with ___ and end with ___',3),(4,'Which of the following is/are a PHP code editor?',4),(5,'Which of the following must be installed on your computer so as to run PHP script?',1),(6,'Which version of PHP introduced Try/catch Exception?',2),(7,'We can use ___ to comment a single line?',3),(8,'Which of the following php statement/statements will store 111 in variable num?',4);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `total_questions` int(11) DEFAULT NULL,
  `total_answered` int(11) DEFAULT NULL,
  `total_correct` int(11) DEFAULT NULL,
  `quiz_started_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `quiz_finished_at` datetime DEFAULT NULL,
  `test_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` VALUES (1,1,'ramani',2,3,0,'2019-02-09 16:32:26','2019-02-09 18:28:56',NULL),(2,1,'ramani',2,7,0,'2019-02-09 16:43:33','2019-02-09 18:28:02',NULL),(3,1,'ramani',2,1,0,'2019-02-09 17:07:58',NULL,NULL),(4,1,'ramani',2,4,0,'2019-02-09 17:09:49','2019-02-09 18:26:12',NULL),(5,1,'ramani',2,0,0,'2019-02-09 17:10:12',NULL,NULL),(6,1,'ramani',2,0,0,'2019-02-09 17:10:23',NULL,NULL),(7,2,'sdfsdf',2,0,0,'2019-02-09 17:19:33',NULL,NULL),(8,4,'sdfsdfs',2,0,0,'2019-02-09 17:21:19',NULL,NULL),(9,3,'sdfsdfs',2,0,0,'2019-02-09 17:24:16',NULL,NULL),(10,3,'sdfsf',2,0,0,'2019-02-09 17:24:29',NULL,NULL),(11,2,'dsfsdf',2,0,0,'2019-02-09 17:25:23',NULL,NULL),(12,3,'sdfsdf',2,0,0,'2019-02-09 17:25:44',NULL,NULL),(13,2,'test',2,0,0,'2019-02-09 17:26:53',NULL,NULL),(14,2,'sdfsdf',2,0,0,'2019-02-09 17:28:21',NULL,NULL),(15,3,'sdfs',2,0,0,'2019-02-09 17:28:42',NULL,NULL),(16,1,'sdfsfs',2,0,0,'2019-02-09 17:29:26',NULL,NULL),(17,2,'ramani Chandran',2,0,0,'2019-02-09 17:32:40',NULL,NULL),(18,3,'ramani Chandran',2,0,0,'2019-02-09 17:33:17',NULL,NULL),(19,3,'sdfsdfs',2,0,0,'2019-02-09 17:36:27',NULL,NULL),(20,2,'fsdfs',2,0,0,'2019-02-09 17:36:51',NULL,NULL),(21,3,'dasda',2,0,0,'2019-02-09 17:41:22',NULL,NULL),(22,3,'dasd',2,0,0,'2019-02-09 17:42:05',NULL,NULL),(23,2,'fsdf',2,0,0,'2019-02-09 17:43:41',NULL,NULL),(24,3,'fsdf',2,0,0,'2019-02-09 17:44:32',NULL,NULL),(25,4,'sdf',2,0,0,'2019-02-09 17:46:18',NULL,NULL),(26,4,'sdfsdf',2,0,0,'2019-02-09 17:46:45',NULL,NULL),(27,3,'test',2,0,0,'2019-02-09 17:47:06',NULL,NULL),(28,2,'sdfsd',2,0,0,'2019-02-09 17:48:59',NULL,NULL),(29,2,'sdfsf',2,0,0,'2019-02-09 17:50:54',NULL,NULL),(30,2,'fsdfsdf',2,0,0,'2019-02-09 17:51:59',NULL,NULL),(31,1,'sdfsd',2,0,0,'2019-02-09 17:53:40',NULL,NULL),(32,2,'fsfsd',2,0,0,'2019-02-09 17:54:26',NULL,NULL),(33,2,'ramani Chandran',2,0,0,'2019-02-09 17:58:18',NULL,NULL),(34,3,'ramani Chandran',2,0,0,'2019-02-09 17:59:17',NULL,NULL),(35,2,'sdfs',2,0,0,'2019-02-09 18:00:36',NULL,NULL),(36,2,'ramani Chandran',2,0,0,'2019-02-09 18:01:50',NULL,NULL),(37,2,'sdffsd',2,0,0,'2019-02-09 18:02:59',NULL,NULL),(38,2,'sdfs',2,0,0,'2019-02-09 18:03:20',NULL,NULL),(39,2,'ramani Chandran',2,0,0,'2019-02-09 18:04:01',NULL,NULL),(40,3,'ramani Chandran',2,0,0,'2019-02-09 18:05:11',NULL,NULL),(41,2,'test',2,0,0,'2019-02-09 18:05:44',NULL,NULL),(42,3,'sdfsdf',2,0,0,'2019-02-09 18:06:28',NULL,NULL),(43,3,'test',2,0,0,'2019-02-09 18:07:36',NULL,NULL),(44,3,'sdfsdf',2,0,0,'2019-02-09 18:08:23',NULL,NULL),(45,3,'fsdfs',2,0,0,'2019-02-09 18:10:12',NULL,NULL),(46,4,'sdfsdf',2,0,0,'2019-02-09 18:11:27',NULL,NULL),(47,2,'ramani Chandran',2,0,0,'2019-02-09 18:13:07',NULL,NULL),(48,3,'sdfsdf',2,0,0,'2019-02-09 18:13:35',NULL,NULL),(49,3,'sdfsdf',2,0,0,'2019-02-09 18:14:45',NULL,NULL),(50,2,'sdfsdf',2,0,0,'2019-02-09 18:15:38',NULL,NULL),(51,2,'sdfs',2,0,0,'2019-02-09 18:16:29',NULL,NULL),(52,2,'ramani Chandran',2,0,0,'2019-02-09 18:21:01',NULL,NULL),(53,2,'ramani Chandran',2,0,0,'2019-02-09 18:21:55',NULL,NULL),(54,3,'dsfsdf',2,0,0,'2019-02-09 18:24:10',NULL,NULL),(55,4,'dfsdf',2,0,0,'2019-02-09 18:26:05',NULL,NULL),(56,1,'dsfsdf',2,0,0,'2019-02-09 18:26:18',NULL,NULL),(57,2,'dsfsf',2,0,0,'2019-02-09 18:26:54',NULL,NULL),(58,1,'sdfsdf',2,0,0,'2019-02-09 18:27:03',NULL,NULL),(59,2,'ramani Chandran',2,0,0,'2019-02-09 18:27:38',NULL,NULL),(60,1,'ramani Chandran',2,1,0,'2019-02-09 18:28:53',NULL,NULL),(61,2,'ramani Chandran',2,0,0,'2019-02-09 18:29:49',NULL,NULL),(62,4,'dsfsdf',2,0,0,'2019-02-09 18:31:18',NULL,NULL),(63,2,'ramani Chandran',2,2,0,'2019-02-09 18:33:13','2019-02-09 18:34:21',NULL),(64,2,'ramani Chandran',2,1,0,'2019-02-09 18:34:11',NULL,NULL),(65,3,'ramani Chandran',2,1,0,'2019-02-09 18:34:47',NULL,NULL),(66,3,'ramani Chandran',2,2,2,'2019-02-09 18:35:07','2019-02-09 18:35:51',NULL),(67,1,'ramani Chandran',2,2,1,'2019-02-09 18:35:46','2019-02-09 18:37:15',NULL),(68,2,'ramani Chandran',2,2,1,'2019-02-09 18:37:11','2019-02-09 18:42:49',NULL),(69,2,'sdfsdf',2,2,0,'2019-02-09 18:42:43','2019-02-09 18:43:19',NULL),(70,2,'ramani Chandran',2,2,2,'2019-02-09 18:43:14','2019-02-09 18:50:48',NULL),(71,2,'ramani Chandran',2,2,1,'2019-02-09 18:50:43','2019-02-09 18:51:09',NULL),(72,2,'ramani Chandran',2,2,1,'2019-02-09 18:51:02','2019-02-09 18:56:28',NULL),(73,2,'ramani Chandran',2,0,0,'2019-02-09 19:00:25',NULL,'Test 2'),(74,2,'ramani Chandran',2,0,0,'2019-02-09 19:03:43',NULL,'Test 2'),(75,1,'ramani Chandran',2,0,0,'2019-02-09 19:04:13',NULL,'Test 1'),(76,2,'ramani Chandran',2,2,1,'2019-02-09 19:04:57','2019-02-09 19:05:01','Test 2'),(77,1,'ramani Chandran',2,2,2,'2019-02-09 19:06:23','2019-02-09 19:06:31','Test 1');
/*!40000 ALTER TABLE `results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (1,'Test 1'),(2,'Test 2'),(3,'Test 3'),(4,'Test 4');
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-09 19:07:19
