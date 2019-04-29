-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: webtechproject
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB

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
-- Table structure for table `bet`
--

DROP TABLE IF EXISTS `bet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bet` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bidder_user_id` bigint(20) NOT NULL,
  `lot_id` bigint(20) NOT NULL,
  `bid_amount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bet_user_account_id_fk` (`bidder_user_id`),
  KEY `bet_lot_id_fk` (`lot_id`),
  CONSTRAINT `bet_lot_id_fk` FOREIGN KEY (`lot_id`) REFERENCES `lot` (`id`),
  CONSTRAINT `bet_user_account_id_fk` FOREIGN KEY (`bidder_user_id`) REFERENCES `user_account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bet`
--

LOCK TABLES `bet` WRITE;
/*!40000 ALTER TABLE `bet` DISABLE KEYS */;
/*!40000 ALTER TABLE `bet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lot`
--

DROP TABLE IF EXISTS `lot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lot` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image_url` text,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `duration` bigint(20) DEFAULT NULL,
  `finished_at` timestamp NULL DEFAULT NULL,
  `seller_user_id` bigint(20) DEFAULT NULL,
  `buyer_user_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lot_buyer_user_account_id_fk` (`buyer_user_id`),
  KEY `lot_seller_user_account_id_fk` (`seller_user_id`),
  CONSTRAINT `lot_buyer_user_account_id_fk` FOREIGN KEY (`buyer_user_id`) REFERENCES `user_account` (`id`),
  CONSTRAINT `lot_seller_user_account_id_fk` FOREIGN KEY (`seller_user_id`) REFERENCES `user_account` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lot`
--

LOCK TABLES `lot` WRITE;
/*!40000 ALTER TABLE `lot` DISABLE KEYS */;
INSERT INTO `lot` VALUES (1,'Lot One','https://via.placeholder.com/500x500/777/555?text=Lot+One','Lot 1 description','2019-04-28 19:30:46','created',NULL,600000,NULL,1,NULL),(2,'Lot Two','https://via.placeholder.com/500x500/777/555?text=Lot+Two','Lot 2 description','2019-04-28 19:34:11','created',NULL,600000,NULL,2,NULL),(3,'Lot Three','https://via.placeholder.com/500x500/777/555?text=Lot+Three','Lot 3 description','2019-04-28 19:34:12','created',NULL,600000,NULL,3,NULL),(4,'Lot Four','https://via.placeholder.com/500x500/777/555?text=Lot+Four','Lot 4 description','2019-04-28 19:34:13','created',NULL,600000,NULL,4,NULL),(5,'Lot Five','https://via.placeholder.com/500x500/777/555?text=Lot+Five','Lot 5 description','2019-04-28 19:34:14','created',NULL,600000,NULL,5,NULL),(6,'Lot Six','https://via.placeholder.com/500x500/777/555?text=Lot+Six','Lot 6 description','2019-04-28 19:34:15','created',NULL,600000,NULL,6,NULL),(7,'Lot Seven','https://via.placeholder.com/500x500/777/555?text=Lot+Seven','Lot 7 description','2019-04-28 19:34:16','created',NULL,600000,NULL,7,NULL),(8,'Lot Eight','https://via.placeholder.com/500x500/777/555?text=Lot+Eight','Lot 8 description','2019-04-28 19:34:17','created',NULL,600000,NULL,8,NULL);
/*!40000 ALTER TABLE `lot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_account`
--

DROP TABLE IF EXISTS `user_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_account` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_account_email_uindex` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_account`
--

LOCK TABLES `user_account` WRITE;
/*!40000 ALTER TABLE `user_account` DISABLE KEYS */;
INSERT INTO `user_account` VALUES (1,'one@a.a','123','User One',NULL),(2,'two@a.a','123','User Two',NULL),(3,'three@a.a','123','User Three',NULL),(4,'four@a.a','123','User Four',NULL),(5,'five@a.a','123','User Five',NULL),(6,'six@a.a','123','User Six',NULL),(7,'seven@a.a','123','User Seven',NULL),(8,'eight@a.a','123','User Eight',NULL),(9,'nine@a.a','123','User Nine',NULL),(10,'ten@a.a','123','User Ten',NULL);
/*!40000 ALTER TABLE `user_account` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-29 13:23:25
