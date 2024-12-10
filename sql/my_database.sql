-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: my_database
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `my_shop`
--

DROP TABLE IF EXISTS `my_shop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_shop` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_shop`
--

LOCK TABLES `my_shop` WRITE;
/*!40000 ALTER TABLE `my_shop` DISABLE KEYS */;
INSERT INTO `my_shop` VALUES (1,'qwe','qwe','qwe','qwe@qwe.qwe','$2y$10$yAFBQM4hnTdokObUR86XHu9zcqL06rhhUe7t6/idMXiu/2iIoxQyu'),(2,'presducoer','мяу','мур','b888tb@gmail.com','$2y$10$Ua/oAE5uEzxCt67nJhwob.6P3wcOvRqXh5HVZizoZwYuP9P69UFT.'),(3,'admin','admin','admin','admin@admin.com','$2y$10$qZa72yLcQve4U0JB3KxcuOQ0jSsJ.KSW63NptGWZ6SG4jjiCvbUZC');
/*!40000 ALTER TABLE `my_shop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `article` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(50) NOT NULL,
  `shape` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Корабль из звёздных войн','1',250.00,'Чёрный','Квадрат','military','Нашивка на липучке, с изображением корабля из фильма \"Звёздные войны\"','uploads/nashivka-korabl-iz-star-wars.webp'),(2,'Лисичка','2',400.00,'Оранжевый','Квадрат','funny','Нашивка на липучке \r\nИзображена мордочка лисички','uploads/nashivka-lisichka.webp'),(3,'Сокол \"2000\"','3',250.00,'Чёрный','Квадрат','funny','Нашивка с изображением космического корабля из фильма \"Звёздные войны\"','uploads/nashivka-korabl-iz-star-wars.webp'),(4,'Пиратская нашивка','4',355.00,'Жёлтый','Квадрат','funny','Нашивка с изображением черепа и двух мечей на фоне камуфляжа ','uploads/nashivka-piratskaya.webp'),(5,'Заяц-Киборг','5',500.00,'Белый','Квадрат','funny','Нашивка с белым зайцем-киборгом','uploads/nashivka-zayac-kiborg.webp'),(7,'Флаг России','84',1000.00,'Белый','Квадрат','flags','Флаг России с надписью RUSSIA','uploads/voennaya-nashivka-rossiya.webp'),(8,'Флаг Казахстана','85',300.00,'Синий','Прямоугольник','flags','Нашивка с изображением флага Республики Казахстан','uploads/nashivka-flag-kazakhstana.webp'),(9,'йцу','фыв',123.00,'Белый','Квадрат','flags','фывфы','uploads/nashivka-flag-kazakhstana.webp');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-08 17:29:29
