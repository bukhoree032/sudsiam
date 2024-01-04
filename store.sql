-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: store
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carousel`
--

DROP TABLE IF EXISTS `carousel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carousel` (
  `carousel_id` int(10) NOT NULL AUTO_INCREMENT,
  `carousel_pic_sort` varchar(255) NOT NULL,
  `carousel_pic_path` varchar(255) NOT NULL,
  PRIMARY KEY (`carousel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carousel`
--

LOCK TABLES `carousel` WRITE;
/*!40000 ALTER TABLE `carousel` DISABLE KEYS */;
INSERT INTO `carousel` VALUES (4,'1.1','4ade97bc46381526e88578567899_p0.png');
/*!40000 ALTER TABLE `carousel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `pay_id` int(10) NOT NULL AUTO_INCREMENT,
  `pay_name` varchar(100) NOT NULL,
  `pay_email` varchar(100) NOT NULL,
  `pay_Phone` varchar(100) NOT NULL,
  `pay_price` int(11) NOT NULL,
  `pay_date` varchar(50) NOT NULL,
  `delivery_date` varchar(50) DEFAULT NULL,
  `pay_time` varchar(50) NOT NULL,
  `delivery_time` varchar(50) NOT NULL,
  `pay_note` varchar(100) NOT NULL,
  `pay_pic` varchar(255) NOT NULL,
  `bill_trx` varchar(255) NOT NULL,
  `pay_ems` varchar(50) NOT NULL,
  `pay_id_ems` varchar(50) DEFAULT NULL,
  `pay_status` varchar(50) NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (34,'test test','test@test.com','1231231231',1140,'2022-05-13',NULL,'17:27','','a','737cab8179f5676225617856s7899_p0.png','63cefd','ยังไม่มีการจัดส่งสินค้า',NULL,'ยืนยันสินค้าเรียบร้อย');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(255) NOT NULL,
  `product_name` text NOT NULL,
  `product_detail` text DEFAULT NULL,
  `product_alldetail` text DEFAULT NULL,
  `product_price` text NOT NULL,
  `product_status` text NOT NULL,
  `product_type_id` text NOT NULL,
  `product_created` datetime NOT NULL,
  `product_editdate` datetime DEFAULT NULL,
  `product_quantity` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (15,'P0001','สินค้าจำลอง','สินค้าจำลอง','สินค้าจำลอง','150','on','10','2022-05-09 05:21:09','2022-05-13 16:57:16',13),(16,'P0002','สินค้าจำลอง','สินค้าจำลอง','สินค้าจำลอง','990','on','10','2022-05-10 04:39:04','2022-05-10 04:39:04',195),(17,'P0003','สินค้าจำลอง','สินค้าจำลอง','สินค้าจำลอง','990','on','10','2022-05-10 04:39:16','2022-05-10 04:39:16',198),(18,'P0004','สินค้าจำลอง','สินค้าจำลอง','สินค้าจำลอง','990','on','10','2022-05-10 04:39:41','2022-05-10 04:39:41',200),(19,'P0005','สินค้าจำลอง','สินค้าจำลอง','สินค้าจำลอง','990','on','10','2022-05-10 04:39:54','2022-05-10 04:39:54',200);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_pic`
--

DROP TABLE IF EXISTS `product_pic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_pic` (
  `product_pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_pic_sort` double NOT NULL,
  `product_pic_path` text NOT NULL,
  PRIMARY KEY (`product_pic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_pic`
--

LOCK TABLES `product_pic` WRITE;
/*!40000 ALTER TABLE `product_pic` DISABLE KEYS */;
INSERT INTO `product_pic` VALUES (39,15,1.1,'666ec8f271ba15e4f29a7856s7899_p0.png'),(40,15,1.2,'a047ac40992f112a5b887856s7899_p0.png'),(41,15,1.3,'3ae68684e7c9e7ea93d87856s7899_p0.png'),(42,16,1.1,'48b4ac41adbb1466ba057856s7899_p0.png'),(43,17,1.1,'8d17f5ece600e6c625d87856s7899_p0.png'),(44,18,1.1,'3d549dee95d387d289e37856s7899_p0.png'),(45,19,1.1,'c44a07f065f119c09c337856s7899_p0.png');
/*!40000 ALTER TABLE `product_pic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_type`
--

DROP TABLE IF EXISTS `product_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_type` (
  `product_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_sort` double NOT NULL,
  `product_type_name` text NOT NULL,
  PRIMARY KEY (`product_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_type`
--

LOCK TABLES `product_type` WRITE;
/*!40000 ALTER TABLE `product_type` DISABLE KEYS */;
INSERT INTO `product_type` VALUES (10,1.1,'สินค้าจำลอง1');
/*!40000 ALTER TABLE `product_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record`
--

DROP TABLE IF EXISTS `record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `record` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `bill_trx` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `counts` int(11) NOT NULL,
  `price` text NOT NULL,
  `record_status` varchar(50) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `record`
--

LOCK TABLES `record` WRITE;
/*!40000 ALTER TABLE `record` DISABLE KEYS */;
INSERT INTO `record` VALUES (85,15,9,'4dbc4c','2022-05-13 17:26:24',1,'150','ยังไม่ได้แจ้งชำระเงิน'),(86,16,9,'4dbc4c','2022-05-13 17:26:24',1,'990','ยังไม่ได้แจ้งชำระเงิน'),(87,15,9,'63cefd','2022-05-13 17:26:55',1,'150','แจ้งการชำระเงินเรียบร้อย'),(88,16,9,'63cefd','2022-05-13 17:26:55',1,'990','แจ้งการชำระเงินเรียบร้อย');
/*!40000 ALTER TABLE `record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(50) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'admin','admin','admin@admin.com','$2y$10$C3Oy7txLWAqFkdypuNZMMO9h3QeTtupyJr3AUsyjYikF9YKneLR2u','admin','2022-04-19 20:00:13','0','','เปิดใช้งาน'),(9,'test','test','test@test.com','$2y$10$NTVu3qjl9BdVSXD4Rk31uepxChcLtu5mfM.3GEDpLzMENJYbYlUfO','user','2022-05-13 08:51:02','1231231231','ชาย','เปิดใช้งาน');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersadress`
--

DROP TABLE IF EXISTS `usersadress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usersadress` (
  `usera_id` int(10) NOT NULL AUTO_INCREMENT,
  `id` int(10) NOT NULL,
  `user_adress` varchar(255) NOT NULL,
  `user_province` varchar(255) NOT NULL,
  `user_postal_code` int(10) NOT NULL,
  `user_district` varchar(255) NOT NULL,
  `user_parish` varchar(255) NOT NULL,
  `order_express` varchar(50) NOT NULL,
  PRIMARY KEY (`usera_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersadress`
--

LOCK TABLES `usersadress` WRITE;
/*!40000 ALTER TABLE `usersadress` DISABLE KEYS */;
INSERT INTO `usersadress` VALUES (16,9,'123','qwe',1234,'qwe','qwe','ไปรษณีย์ไทย');
/*!40000 ALTER TABLE `usersadress` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-13 17:46:10
