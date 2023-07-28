-- MySQL dump 10.13  Distrib 5.7.43, for Win64 (x86_64)
--
-- Host: localhost    Database: e_ticket
-- ------------------------------------------------------
-- Server version	5.7.43-log

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
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` char(2) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Vinte','3 Nevada Parkway','Calgary','AB','315-252-7305'),(2,'Myworks','34267 Glendale Parkway','Huntington','WV','304-659-1170'),(3,'Yadel','096 Pawling Parkway','San Francisco','CA','415-144-6037');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_name` varchar(50) NOT NULL,
  `rental_rate` decimal(9,2) NOT NULL,
  PRIMARY KEY (`equipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
INSERT INTO `equipment` VALUES (101,'Ford F150',30.50),(102,'Toyota Tacoma',35.75),(103,'Ram 1500',25.00),(104,'Chevrolet Silverado',27.75),(105,'Nolan Larsen',27.50);
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_name` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`job_id`),
  KEY `FK_customer_id_idx` (`customer_id`),
  CONSTRAINT `job_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (101,'Develop Clean Code',2),(102,'Don\'t Repeat yourself',3),(103,'Keep it simple stupid',1),(104,'commit regularly',1),(105,'Test Test Test',2),(106,'document your code',3);
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`location_id`),
  KEY `fk_job_id_idx` (`job_id`),
  CONSTRAINT `location_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,101,'Stampede','101 somewhere nice'),(2,101,'Mountains','101 somewhere nicer'),(3,102,'Pizza Stand','102 somewhere nice'),(4,102,'Taco Stand','102 somewhere nicer'),(5,103,'Pizza Stand','103 somewhere nice'),(6,103,'Taco Stand','103 somewhere nicer'),(7,104,'Pizza Stand','104 somewhere nice'),(8,104,'Taco Stand','104 somewhere nicer'),(9,105,'Pizza Stand','105 somewhere nice'),(10,105,'Taco Stand','105 somewhere nicer'),(11,106,'Pizza Stand','106 somewhere nice'),(12,106,'Taco Stand','106 somewhere nicer');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) DEFAULT NULL,
  `position_name` varchar(50) NOT NULL,
  `hourly_rate` decimal(9,2) NOT NULL,
  `overtime_rate` decimal(9,2) NOT NULL,
  PRIMARY KEY (`position_id`),
  KEY `fk_staff_id_idx` (`staff_id`),
  CONSTRAINT `position_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (1,1,'Jr Dev',25.50,35.50),(2,1,'Dev',35.50,45.50),(3,1,'Sr Dev',45.00,55.00),(4,2,'Jr Dev',27.75,37.75),(5,2,'Dev',37.50,47.50),(6,2,'Sr Dev',47.50,57.50);
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(50) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'Fresh Focus Media'),(2,'Rook Connect');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `job_status` varchar(50) NOT NULL,
  `location_id` int(11) NOT NULL,
  `ordered_by` varchar(50) NOT NULL,
  `ticket_date` date NOT NULL,
  `area` varchar(50) NOT NULL,
  `work_description` varchar(2000) NOT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `fk_customer_id_idx` (`customer_id`),
  KEY `fk_job_id_idx` (`job_id`),
  KEY `fk_location_id_idx` (`location_id`),
  CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON UPDATE CASCADE,
  CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON UPDATE CASCADE,
  CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (1,3,101,'active',2,'tim','2021-01-18','area51','i did a lot of cool things'),(2,1,103,'Pending',5,'tim','2023-07-05','sdfsd','Work description...'),(3,1,103,'Pending',5,'tim','2023-07-05','sdfsd','Work description...'),(4,1,103,'Pending',5,'tim','2023-07-05','sdfsd','Work description...'),(5,1,103,'Pending',5,'tim','2023-07-05','sdfsd','Work description...'),(6,1,103,'Pending',5,'tim','2023-07-05','sdfsd','Work description...'),(7,1,103,'Pending',5,'tim','2023-07-05','sdfsd','Work description...'),(8,1,103,'Pending',5,'tim','2023-07-05','sdfsd','Work description...'),(9,1,103,'Pending',5,'tim','2023-07-05','sdfsd','Work description...'),(10,1,103,'Pending',5,'tim','2023-07-05','sdfsd','Work description...'),(11,1,103,'Active',5,'tim','2023-07-28','','');
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_equipment`
--

DROP TABLE IF EXISTS `ticket_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_equipment` (
  `equipment_rental_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `rental_qty` decimal(9,2) NOT NULL,
  `uom_truck` tinyint(4) NOT NULL,
  `rental_rate` decimal(9,2) NOT NULL,
  PRIMARY KEY (`equipment_rental_id`),
  KEY `fk_ticket_id_idx` (`ticket_id`),
  KEY `fk_equipment_id_idx` (`equipment_id`),
  CONSTRAINT `ticket_equipment_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`) ON UPDATE CASCADE,
  CONSTRAINT `ticket_equipment_ibfk_2` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_equipment`
--

LOCK TABLES `ticket_equipment` WRITE;
/*!40000 ALTER TABLE `ticket_equipment` DISABLE KEYS */;
INSERT INTO `ticket_equipment` VALUES (1,1,101,2.00,8,27.50),(3,2,102,1.00,1,35.75),(4,3,102,1.00,1,35.75),(5,6,102,1.00,1,35.75),(6,7,102,1.00,1,35.75),(7,8,102,1.00,1,35.75),(8,9,102,1.00,1,35.75),(9,10,102,1.00,1,35.75);
/*!40000 ALTER TABLE `ticket_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_labour`
--

DROP TABLE IF EXISTS `ticket_labour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_labour` (
  `labour_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `regular_hours` decimal(9,2) NOT NULL,
  `overtime_hours` decimal(9,2) NOT NULL,
  `uom_staff` tinyint(4) NOT NULL,
  `regular_rate` decimal(9,2) NOT NULL,
  `overtime_rate` decimal(9,2) NOT NULL,
  PRIMARY KEY (`labour_id`),
  KEY `fk_ticket_id_idx` (`ticket_id`),
  KEY `fk_staff_id_idx` (`staff_id`),
  KEY `fk_position_id_idx` (`position_id`),
  CONSTRAINT `ticket_labour_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`) ON UPDATE CASCADE,
  CONSTRAINT `ticket_labour_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON UPDATE CASCADE,
  CONSTRAINT `ticket_labour_ibfk_3` FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_labour`
--

LOCK TABLES `ticket_labour` WRITE;
/*!40000 ALTER TABLE `ticket_labour` DISABLE KEYS */;
INSERT INTO `ticket_labour` VALUES (1,1,2,6,8.00,3.00,1,27.50,37.50),(3,2,2,4,1.00,1.00,1,27.75,37.75),(4,3,2,4,1.00,1.00,1,27.75,37.75),(5,6,2,4,1.00,1.00,1,27.75,37.75),(6,7,2,4,1.00,1.00,1,27.75,37.75),(7,8,2,4,1.00,1.00,1,27.75,37.75),(8,9,2,4,1.00,1.00,1,27.75,37.75),(9,10,2,4,1.00,1.00,1,27.75,37.75);
/*!40000 ALTER TABLE `ticket_labour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_misc`
--

DROP TABLE IF EXISTS `ticket_misc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_misc` (
  `misc_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `misc_description` varchar(100) NOT NULL,
  `cost` decimal(9,2) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `misc_quantity` decimal(9,2) NOT NULL,
  PRIMARY KEY (`misc_id`),
  KEY `fk_ticket_id_idx` (`ticket_id`),
  CONSTRAINT `ticket_misc_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_misc`
--

LOCK TABLES `ticket_misc` WRITE;
/*!40000 ALTER TABLE `ticket_misc` DISABLE KEYS */;
INSERT INTO `ticket_misc` VALUES (1,1,'something cool',20.50,30.50,8.00),(3,2,'Lets see if chrome is any better.',1.00,1.00,1.00),(4,3,'Lets see if chrome is any better.',1.00,1.00,1.00),(5,6,'Lets see if chrome is any better.',1.00,1.00,1.00),(6,7,'Lets see if chrome is any better.',1.00,1.00,1.00),(7,8,'Lets see if chrome is any better.',1.00,1.00,1.00),(8,9,'Lets see if chrome is any better.',1.00,1.00,1.00),(9,10,'Lets see if chrome is any better.',1.00,1.00,1.00),(20,11,'',0.00,0.00,0.00);
/*!40000 ALTER TABLE `ticket_misc` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-28  4:00:26
