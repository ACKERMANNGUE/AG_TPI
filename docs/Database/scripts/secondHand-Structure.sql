-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: schema_secondhand
-- ------------------------------------------------------
-- Server version	8.0.15

CREATE SCHEMA  "schema_secondhand";
USE schema_secondhand;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ads` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(20) NOT NULL,
  `DESCRIPTION` mediumtext,
  `GENDERS_CODE` int(11) NOT NULL,
  `SIZES_CODE` int(11) NOT NULL,
  `BRANDS_CODE` int(11) NOT NULL,
  `MODELS_CODE` int(11) NOT NULL,
  `STATES_CODE` int(11) NOT NULL,
  `PRICE` float NOT NULL,
  `DATE_POSTING` datetime DEFAULT NULL,
  `users_NICKNAME` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_ADS_GENDERS1_idx` (`GENDERS_CODE`),
  KEY `fk_ADS_SIZES1_idx` (`SIZES_CODE`),
  KEY `fk_ADS_BRANDS1_idx` (`BRANDS_CODE`),
  KEY `fk_ADS_MODELS1_idx` (`MODELS_CODE`),
  KEY `fk_ADS_STATES1_idx` (`STATES_CODE`),
  KEY `fk_ads_users1_idx` (`users_NICKNAME`),
  CONSTRAINT `fk_ADS_BRANDS1` FOREIGN KEY (`BRANDS_CODE`) REFERENCES `brands` (`CODE`),
  CONSTRAINT `fk_ADS_GENDERS1` FOREIGN KEY (`GENDERS_CODE`) REFERENCES `genders` (`CODE`),
  CONSTRAINT `fk_ADS_MODELS1` FOREIGN KEY (`MODELS_CODE`) REFERENCES `models` (`CODE`),
  CONSTRAINT `fk_ADS_SIZES1` FOREIGN KEY (`SIZES_CODE`) REFERENCES `sizes` (`CODE`),
  CONSTRAINT `fk_ADS_STATES1` FOREIGN KEY (`STATES_CODE`) REFERENCES `states` (`CODE`),
  CONSTRAINT `fk_ads_users1` FOREIGN KEY (`users_NICKNAME`) REFERENCES `users` (`NICKNAME`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `brands` (
  `CODE` int(11) NOT NULL,
  `LABEL` varchar(30) NOT NULL,
  PRIMARY KEY (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `countries` (
  `ISOCODE` varchar(2) NOT NULL,
  `LABEL` varchar(60) NOT NULL,
  PRIMARY KEY (`ISOCODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `genders`
--

DROP TABLE IF EXISTS `genders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `genders` (
  `CODE` int(11) NOT NULL,
  `LABEL` varchar(8) NOT NULL,
  PRIMARY KEY (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `models` (
  `CODE` int(11) NOT NULL,
  `LABEL` varchar(25) NOT NULL,
  PRIMARY KEY (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `pictures` (
  `ADS_ID` int(11) NOT NULL,
  `INDEX_IMG` int(11) NOT NULL,
  `IMAGE` longtext NOT NULL,
  PRIMARY KEY (`ADS_ID`,`INDEX_IMG`),
  CONSTRAINT `FK_ads_idAD2` FOREIGN KEY (`ADS_ID`) REFERENCES `ads` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `roles` (
  `CODE` int(11) NOT NULL,
  `LABEL` varchar(25) NOT NULL,
  PRIMARY KEY (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sizes` (
  `CODE` int(11) NOT NULL,
  `LABEL` varchar(3) NOT NULL,
  PRIMARY KEY (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `states` (
  `CODE` int(11) NOT NULL,
  `LABEL` varchar(25) NOT NULL,
  PRIMARY KEY (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `status` (
  `CODE` int(11) NOT NULL,
  `LABEL` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `EMAIL` varchar(254) NOT NULL,
  `NICKNAME` varchar(20) NOT NULL,
  `FIRSTNAME` varchar(20) DEFAULT NULL,
  `LASTNAME` varchar(20) DEFAULT NULL,
  `PSWD` varchar(40) NOT NULL,
  `PHONE` varchar(10) DEFAULT NULL,
  `COUNTRIES_ISOCODE` varchar(2) NOT NULL,
  `ROLES_CODE` int(11) NOT NULL,
  `TOKEN_VALIDATION` varchar(32) DEFAULT NULL,
  `TOKEN_EXPIRATION_DATE` datetime DEFAULT NULL,
  `status_CODE` int(11) NOT NULL,
  PRIMARY KEY (`NICKNAME`),
  UNIQUE KEY `NICKNAME_UNIQUE` (`NICKNAME`),
  KEY `fk_USERS_COUNTRIES_idx` (`COUNTRIES_ISOCODE`),
  KEY `fk_USERS_ROLES1_idx` (`ROLES_CODE`),
  KEY `fk_users_status1_idx` (`status_CODE`),
  CONSTRAINT `fk_USERS_COUNTRIES` FOREIGN KEY (`COUNTRIES_ISOCODE`) REFERENCES `countries` (`ISOCODE`),
  CONSTRAINT `fk_USERS_ROLES1` FOREIGN KEY (`ROLES_CODE`) REFERENCES `roles` (`CODE`),
  CONSTRAINT `fk_users_status1` FOREIGN KEY (`status_CODE`) REFERENCES `status` (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-20 15:14:41
