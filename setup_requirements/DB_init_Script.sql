DROP DATABASE IF EXISTS `e_ticket`;
CREATE DATABASE `e_ticket`; 
USE `e_ticket`;

SET NAMES utf8 ;
SET character_set_client = utf8mb4 ;

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL auto_increment,
  `customer_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` char(2) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ;
INSERT INTO `customer` VALUES (1,'Vinte','3 Nevada Parkway','Calgary','AB','315-252-7305');
INSERT INTO `customer` VALUES (2,'Myworks','34267 Glendale Parkway','Huntington','WV','304-659-1170');
INSERT INTO `customer` VALUES (3,'Yadel','096 Pawling Parkway','San Francisco','CA','415-144-6037');


CREATE TABLE `job` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
   `job_name` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`job_id`),
  INDEX `FK_customer_id_idx` (`customer_id`),
  FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ;
INSERT INTO `job` VALUES (101,'Develop Clean Code',2);
INSERT INTO `job` VALUES (102,'Don\'t Repeat yourself',3);
INSERT INTO `job` VALUES (103,'Keep it simple stupid',1);
INSERT INTO `job` VALUES (104,'commit regularly',1);
INSERT INTO `job` VALUES (105,'Test Test Test',2);
INSERT INTO `job` VALUES (106,'document your code',3);


CREATE TABLE `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `location_name` VARCHAR(50) NOT NULL,
  `address` VARCHAR(50),
  PRIMARY KEY (`location_id`),
  INDEX `fk_job_id_idx` (`job_id`),
  FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON UPDATE CASCADE
) ;
INSERT INTO `location` VALUES (1,101,"Stampede","101 somewhere nice");
INSERT INTO `location` VALUES (2,101,"Mountains","101 somewhere nicer");
INSERT INTO `location` VALUES (3,102,"Pizza Stand","102 somewhere nice");
INSERT INTO `location` VALUES (4,102,"Taco Stand","102 somewhere nicer");
INSERT INTO `location` VALUES (5,103,"Pizza Stand","103 somewhere nice");
INSERT INTO `location` VALUES (6,103,"Taco Stand","103 somewhere nicer");
INSERT INTO `location` VALUES (7,104,"Pizza Stand","104 somewhere nice");
INSERT INTO `location` VALUES (8,104,"Taco Stand","104 somewhere nicer");
INSERT INTO `location` VALUES (9,105,"Pizza Stand","105 somewhere nice");
INSERT INTO `location` VALUES (10,105,"Taco Stand","105 somewhere nicer");
INSERT INTO `location` VALUES (11,106,"Pizza Stand","106 somewhere nice");
INSERT INTO `location` VALUES (12,106,"Taco Stand","106 somewhere nicer");

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ;
INSERT INTO `staff` VALUES (1,"Fresh Focus Media");
INSERT INTO `staff` VALUES (2,"Rook Connect");

CREATE TABLE `position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` INT(11),
  `position_name` VARCHAR(50) NOT NULL,
  `hourly_rate` DECIMAL(9,2) NOT NULL,
  `overtime_rate` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`position_id`),
  INDEX `fk_staff_id_idx` (`staff_id`),
  FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ;
INSERT INTO `position` VALUES (1,1,"Jr Dev", 25.50,35.50);
INSERT INTO `position` VALUES (2,1,"Dev", 35.50,45.50);
INSERT INTO `position` VALUES (3,1,"Sr Dev", 45.00,55.00);
INSERT INTO `position` VALUES (4,2,"Jr Dev", 27.75,37.75);
INSERT INTO `position` VALUES (5,2,"Dev", 37.50,47.50);
INSERT INTO `position` VALUES (6,2,"Sr Dev", 47.50,57.50);

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_name` VARCHAR(50) NOT NULL,
  `rental_rate` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`equipment_id`)
) ;
INSERT INTO `equipment` VALUES (101,"Ford F150", 30.50);
INSERT INTO `equipment` VALUES (102,"Toyota Tacoma", 35.75);
INSERT INTO `equipment` VALUES (103,"Ram 1500", 25.00);
INSERT INTO `equipment` VALUES (104,"Chevrolet Silverado", 27.75);
INSERT INTO `equipment` VALUES (105,"Nolan Larsen", 27.50);


CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` INT(11) NOT	NULL,
  `job_id` INT(11) NOT NULL,
  `job_status` VARCHAR(50) NOT NULL,
  `location_id` INT(11) NOT NULL,
  `ordered_by` VARCHAR(50) NOT NULL,
  `ticket_date` DATE NOT NULL,
  `area` VARCHAR(50) NOT NULL,
  `work_description` VARCHAR(2000) NOT NULL,
  PRIMARY KEY (`ticket_id`),
  INDEX `fk_customer_id_idx` (`customer_id`),
  INDEX `fk_job_id_idx` (`job_id`),
  INDEX `fk_location_id_idx` (`location_id`),
  FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`)  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`)  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`)  ON UPDATE CASCADE ON DELETE RESTRICT
) ;
INSERT INTO `ticket` VALUES (1,3,101,"active",2,"tim","2021-01-18", "area51","i did a lot of cool things");

CREATE TABLE `ticket_labour` (
  `labour_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` INT(11) NOT NULL,
  `staff_id` INT(11) NOT NULL,
  `position_id` INT(11) NOT NULL,
  `regular_hours` DECIMAL(9,2) NOT NULL,
  `overtime_hours` DECIMAL(9,2) NOT NULL,
  `uom_staff` TINYINT NOT NULL,
  `regular_rate` DECIMAL(9,2) NOT NULL,
  `overtime_rate` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`labour_id`),
  INDEX `fk_ticket_id_idx` (`ticket_id`),
  INDEX `fk_staff_id_idx` (`staff_id`),
  INDEX `fk_position_id_idx` (`position_id`),
  FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`)  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`)  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`)  ON UPDATE CASCADE ON DELETE RESTRICT
) ;
INSERT INTO `ticket_labour` VALUES (1,1,2,6,8,3,1,27.5,37.5);

CREATE TABLE `ticket_equipment` (
  `equipment_rental_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` INT(11) NOT NULL,
  `equipment_id` INT(11) NOT NULL,
  `rental_qty` DECIMAL(9,2) NOT NULL,
  `uom_truck` TINYINT NOT NULL,
  `rental_rate` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`equipment_rental_id`),
  INDEX `fk_ticket_id_idx` (`ticket_id`),
  INDEX `fk_equipment_id_idx` (`equipment_id`),
  FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`)  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`)  ON UPDATE CASCADE ON DELETE RESTRICT
) ;
INSERT INTO `ticket_equipment` VALUES (1,1,101,2,8,27.5);

CREATE TABLE `ticket_misc` (
  `misc_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` INT(11) NOT NULL,
  `misc_description` VARCHAR(100) NOT NULL,
  `cost` DECIMAL(9,2) NOT NULL,
  `price` DECIMAL(9,2) NOT NULL,
  `misc_quantity` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`misc_id`),
  INDEX `fk_ticket_id_idx` (`ticket_id`),
  FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`)  ON UPDATE CASCADE ON DELETE RESTRICT
) ;
INSERT INTO `ticket_misc` VALUES (1,1,"something cool",20.5,30.5,8);
