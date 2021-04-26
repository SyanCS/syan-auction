-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: auction_syan
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Table structure for table `auction_items`
--

DROP TABLE IF EXISTS `auction_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auction_items` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `descr` text,
  `image` varchar(255) NOT NULL,
  `minimum_bid` decimal(16,2) NOT NULL,
  `ending` datetime NOT NULL,
  `status` enum('ACTIVE','EXPIRED') NOT NULL DEFAULT 'ACTIVE',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auction_items`
--

LOCK TABLES `auction_items` WRITE;
/*!40000 ALTER TABLE `auction_items` DISABLE KEYS */;
INSERT INTO `auction_items` VALUES (4,'Lion Painting','Lion Painting made by artist X','4.jpg',2500.00,'2021-05-01 00:00:00','ACTIVE','2021-04-25 02:49:38','2021-04-25 02:42:50'),(5,'Elvis Old Car','Car used by Elvis Presley himself','5.jpg',300000.00,'2021-05-01 00:00:00','ACTIVE','2021-04-25 02:49:18','2021-04-25 02:49:18'),(6,'Mysterious Container','Antique store locked container','6.jpg',250.00,'2021-05-01 00:00:00','ACTIVE','2021-04-25 02:49:19','2021-04-25 02:49:19'),(7,'Elvis other Car','bla bla bla bla','5.jpg',500000.00,'2021-04-20 00:00:00','EXPIRED','2021-04-26 18:40:10','2021-04-26 18:37:29'),(13,'Mysterious Container','bla bla bla bla','6.jpg',250.00,'2021-06-01 00:00:00','ACTIVE','2021-04-26 22:12:42','2021-04-26 22:12:42'),(14,'Mysterious Container2','bla bla bla bla','6.jpg',250.00,'2021-05-02 00:00:00','ACTIVE','2021-04-26 22:12:42','2021-04-26 22:12:42'),(15,'Mysterious Container3','bla bla bla bla','6.jpg',250.00,'2021-04-28 00:00:00','ACTIVE','2021-04-26 22:12:42','2021-04-26 22:12:42'),(16,'Mysterious Container4','bla bla bla bla','6.jpg',250.00,'2021-04-30 00:00:00','ACTIVE','2021-04-26 22:12:42','2021-04-26 22:12:42'),(17,'Mysterious Container5','bla bla bla bla','6.jpg',250.00,'2021-05-01 00:00:00','ACTIVE','2021-04-26 22:12:42','2021-04-26 22:12:42'),(18,'Mysterious Container6','bla bla bla bla','6.jpg',250.00,'2021-04-20 00:00:00','EXPIRED','2021-04-26 22:12:42','2021-04-26 22:12:42'),(19,'Mysterious Container7','bla bla bla bla','6.jpg',250.00,'2021-04-20 00:00:00','EXPIRED','2021-04-26 22:12:42','2021-04-26 22:12:42');
/*!40000 ALTER TABLE `auction_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auto_bids`
--

DROP TABLE IF EXISTS `auto_bids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auto_bids` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(6) unsigned NOT NULL,
  `amount` decimal(15,2) unsigned NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auto_bids_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auto_bids`
--

LOCK TABLES `auto_bids` WRITE;
/*!40000 ALTER TABLE `auto_bids` DISABLE KEYS */;
INSERT INTO `auto_bids` VALUES (3,1,100000.00,'2021-04-26 05:01:00'),(5,2,6000.00,'2021-04-26 20:56:20'),(6,3,4000.00,'2021-04-26 22:13:13');
/*!40000 ALTER TABLE `auto_bids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auto_bids_items`
--

DROP TABLE IF EXISTS `auto_bids_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auto_bids_items` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(6) unsigned NOT NULL,
  `item_id` int(6) unsigned NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `auto_bids_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `auto_bids_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `auction_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auto_bids_items`
--

LOCK TABLES `auto_bids_items` WRITE;
/*!40000 ALTER TABLE `auto_bids_items` DISABLE KEYS */;
INSERT INTO `auto_bids_items` VALUES (5,1,4,'2021-04-26 06:38:19');
/*!40000 ALTER TABLE `auto_bids_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bids`
--

DROP TABLE IF EXISTS `bids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bids` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(6) unsigned NOT NULL,
  `item_id` int(6) unsigned NOT NULL,
  `amount` decimal(15,2) unsigned NOT NULL,
  `auto_bid` tinyint(1) DEFAULT '0',
  `current_bid` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `bids_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `bids_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `auction_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bids`
--

LOCK TABLES `bids` WRITE;
/*!40000 ALTER TABLE `bids` DISABLE KEYS */;
INSERT INTO `bids` VALUES (2,1,4,5000.00,1,0,'2021-04-26 03:50:47'),(3,1,5,3000.00,1,1,'2021-04-26 20:24:26'),(4,2,6,1000.00,1,1,'2021-04-26 20:57:57'),(5,3,4,6000.00,0,0,'2021-04-26 21:16:32'),(6,1,4,6001.00,1,0,'2021-04-26 21:27:28'),(8,2,4,8000.00,0,0,'2021-04-26 21:39:36'),(9,1,4,8001.00,1,0,'2021-04-26 21:39:36'),(10,2,4,15000.00,0,0,'2021-04-26 21:45:35'),(11,1,4,15001.00,1,0,'2021-04-26 21:45:35'),(12,2,4,200000.00,0,1,'2021-04-26 21:45:50');
/*!40000 ALTER TABLE `bids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin','$2y$10$4TSbhcqPxhGNnd2Cm9flU.qDILak15uF.4TLOoV0nc1GPxt50UPYC',1,'2021-04-26 18:48:43','2021-04-18 00:24:48'),(2,'User 1','user1','$2y$10$4TSbhcqPxhGNnd2Cm9flU.qDILak15uF.4TLOoV0nc1GPxt50UPYC',0,'2021-04-26 20:56:00','2021-04-25 00:47:36'),(3,'User 2','user2','$2y$10$4TSbhcqPxhGNnd2Cm9flU.qDILak15uF.4TLOoV0nc1GPxt50UPYC',0,'2021-04-26 20:56:00','2021-04-25 00:47:36');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_wallets`
--

DROP TABLE IF EXISTS `users_wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_wallets` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(6) unsigned NOT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `users_wallets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_wallets`
--

LOCK TABLES `users_wallets` WRITE;
/*!40000 ALTER TABLE `users_wallets` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-26 19:28:32
