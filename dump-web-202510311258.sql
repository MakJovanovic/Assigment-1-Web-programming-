-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: web
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_customerscarts` (`customer_id`),
  KEY `fk_orderscarts` (`order_id`),
  CONSTRAINT `fk_customerscarts` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_orderscarts` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,1,1,1,'2025-10-31 11:52:47'),(2,1,2,0,'2025-10-31 11:52:47');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (3,'Gear','Professional goalkeeper equipment.'),(4,'Accessoris','Goalkeeping accessories and protective gear.');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_userscustomers` (`user_id`),
  CONSTRAINT `fk_userscustomers` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,1,'Marko','Tomic',62099999,'marko@example.com'),(2,2,'Marko','Tomic',62099999,'marko@example.com'),(3,3,'Marko','Tomic',62099999,'marko@example.com'),(4,4,'Marko','Tomic',62099999,'marko@example.com'),(5,2,'Mak','Jovanovic',62055555,'mak@example.com');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ordersorder_items` (`order_id`),
  KEY `fk_productsorder_items` (`product_id`),
  CONSTRAINT `fk_ordersorder_items` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productsorder_items` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (19,1,18,2,19.99),(20,1,19,1,59.99),(21,2,22,1,79.99),(22,1,23,2,19.99),(23,1,24,1,59.99),(24,2,27,1,79.99),(25,1,28,2,19.99),(26,1,29,1,59.99),(27,2,32,1,79.99),(28,1,33,2,19.99),(29,1,34,1,59.99),(30,2,37,1,79.99),(34,1,18,2,19.99),(35,1,19,1,59.99),(36,2,22,1,79.99),(37,1,23,2,19.99),(38,1,24,1,59.99),(39,2,27,1,79.99),(40,1,28,2,19.99),(41,1,29,1,59.99),(42,2,32,1,79.99),(43,1,33,2,19.99),(44,1,34,1,59.99),(45,2,37,1,79.99);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'Ferhadija 10','2025-10-30 23:38:45',1499.99),(2,'Zmaja od Bosne 25','2025-10-31 11:47:18',179.97),(3,'Ferhadija 10','2025-10-31 11:47:18',99.99);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `name` varchar(10) NOT NULL,
  `desctription` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_property_user` (`customer_id`),
  KEY `fk_property_products` (`category_id`),
  CONSTRAINT `fk_property_products` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_property_user` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (18,1,3,'Balaclava','A balaclava, also known as a balaclava helmet or Bally, is a form of cloth headgear designed to expose only part of the face.',19.99,15),(19,1,3,'Dres','This goalkeeper jersey is made from high-quality breathable fabric for comfort and movement.',59.99,10),(20,1,4,'Socks','Comfortable and durable football socks for all your training and match needs.',19.99,25),(21,1,4,'Boots','High-performance football boots designed for maximum agility and comfort.',99.99,8),(22,1,3,'Gloves','Durable and comfortable goalkeeper gloves for optimal grip in any weather condition.',79.99,12),(23,1,3,'Balaclava','A balaclava, also known as a balaclava helmet or Bally, is a form of cloth headgear designed to expose only part of the face.',19.99,15),(24,1,3,'Dres','This goalkeeper jersey is made from high-quality breathable fabric for comfort and movement.',59.99,10),(25,1,4,'Socks','Comfortable and durable football socks for all your training and match needs.',19.99,25),(26,1,4,'Boots','High-performance football boots designed for maximum agility and comfort.',99.99,8),(27,1,3,'Gloves','Durable and comfortable goalkeeper gloves for optimal grip in any weather condition.',79.99,12),(28,1,3,'Balaclava','A balaclava, also known as a balaclava helmet or Bally, is a form of cloth headgear designed to expose only part of the face.',19.99,15),(29,1,3,'Dres','This goalkeeper jersey is made from high-quality breathable fabric for comfort and movement.',59.99,10),(30,1,4,'Socks','Comfortable and durable football socks for all your training and match needs.',19.99,25),(31,1,4,'Boots','High-performance football boots designed for maximum agility and comfort.',99.99,8),(32,1,3,'Gloves','Durable and comfortable goalkeeper gloves for optimal grip in any weather condition.',79.99,12),(33,1,3,'Balaclava','A balaclava, also known as a balaclava helmet or Bally, is a form of cloth headgear designed to expose only part of the face.',19.99,15),(34,1,3,'Dres','This goalkeeper jersey is made from high-quality breathable fabric for comfort and movement.',59.99,10),(35,1,4,'Socks','Comfortable and durable football socks for all your training and match needs.',19.99,25),(36,1,4,'Boots','High-performance football boots designed for maximum agility and comfort.',99.99,8),(37,1,3,'Gloves','Durable and comfortable goalkeeper gloves for optimal grip in any weather condition.',79.99,12);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `enum` enum('admin','customer') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mak_update','$2y$10$O3HF1czp','mak_new@example.com','admin'),(2,'mak_update','$2y$10$5XOFn3jp','mak_new@example.com','admin'),(3,'mak_update','$2y$10$83YJ7Ov2','mak_new@example.com','admin'),(4,'mak_update','$2y$10$zhiZgEoY','mak_new@example.com','admin'),(5,'admin','admin123','admin@example.com','admin'),(6,'mak','12345','mak@example.com','customer');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'web'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-31 12:58:07
