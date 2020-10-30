CREATE DATABASE  IF NOT EXISTS `laravelapi` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `laravelapi`;
-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: db-mysql-nyc1-41536-do-user-8217151-0.a.db.ondigitalocean.com    Database: laravelapi
-- ------------------------------------------------------
-- Server version	8.0.20

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED='24d4d1af-16fa-11eb-aee6-bef6f7aaa2ea:1-671';

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` double(13,2) NOT NULL DEFAULT '0.00',
  `remark` text COLLATE utf8mb4_unicode_ci,
  `image_url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_sku_index` (`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'9798876390578','In officiis est.',90,321.59,'Ipsa praesentium perspiciatis non maxime.','https://lorempixel.com/640/480/food/?85226','2020-10-30 02:32:19','2020-10-30 02:32:19'),(2,'9791530555801','Voluptas iste quibusdam.',17,64.48,'Dolor molestiae dolor velit sapiente qui.','https://lorempixel.com/640/480/food/?39174','2020-10-30 02:32:19','2020-10-30 02:32:19'),(3,'9791711286142','Sit quo et.',80,564.33,'Pariatur soluta maiores vitae architecto ut.','https://lorempixel.com/640/480/food/?94241','2020-10-30 02:32:19','2020-10-30 02:32:19'),(4,'9786950066440','Unde sunt vel.',96,121.19,'Culpa ipsum odio consequatur ducimus dicta laboriosam.','https://lorempixel.com/640/480/food/?48032','2020-10-30 02:32:19','2020-10-30 02:32:19'),(5,'9794355923329','Tenetur ut recusandae provident.',89,680.18,'Beatae rerum itaque libero debitis dolorem debitis officiis.','https://lorempixel.com/640/480/food/?62747','2020-10-30 02:32:19','2020-10-30 02:32:19'),(6,'9789910086281','Ut eos harum omnis.',46,177.27,'Et dolorum aliquam ducimus ipsa labore.','https://lorempixel.com/640/480/food/?91734','2020-10-30 02:32:19','2020-10-30 02:32:19'),(7,'9791452340844','Sint accusamus at ullam.',89,711.80,'Qui illo esse quae sed ut quibusdam ea.','https://lorempixel.com/640/480/food/?97695','2020-10-30 02:32:19','2020-10-30 02:32:19'),(8,'9796178121340','Ut aliquam eveniet.',37,957.57,'Omnis at consequatur ipsam amet.','https://lorempixel.com/640/480/food/?10716','2020-10-30 02:32:19','2020-10-30 02:32:19'),(9,'9799072501157','Occaecati magnam ratione.',73,247.94,'Et ut quisquam odit nihil repellat perspiciatis.','https://lorempixel.com/640/480/food/?40367','2020-10-30 02:32:19','2020-10-30 02:32:19'),(10,'9796424529340','Ut ullam ipsa perspiciatis.',54,511.39,'Natus est autem delectus voluptate voluptatum.','https://lorempixel.com/640/480/food/?48283','2020-10-30 02:32:19','2020-10-30 02:32:19'),(11,'9793258735879','Qui rerum aut.',56,386.53,'Omnis adipisci vitae eos fugit consectetur.','https://lorempixel.com/640/480/food/?82534','2020-10-30 02:32:19','2020-10-30 02:32:19'),(12,'9796577629331','Molestias maiores nulla omnis quisquam.',16,562.49,'Aspernatur veritatis rerum autem vero dolorum qui et.','https://lorempixel.com/640/480/food/?72326','2020-10-30 02:32:19','2020-10-30 02:32:19'),(13,'9797668162218','Asperiores provident.',19,66.92,'Voluptates sunt nisi rerum non illo.','https://lorempixel.com/640/480/food/?70906','2020-10-30 02:32:19','2020-10-30 02:32:19'),(14,'9786454450981','Adipisci sit et.',49,268.87,'Porro et perspiciatis veritatis praesentium culpa.','https://lorempixel.com/640/480/food/?60073','2020-10-30 02:32:19','2020-10-30 02:32:19'),(15,'9794332415380','Eum sequi quae nesciunt.',98,557.50,'Dolorum tempore asperiores neque sequi ipsam eum.','https://lorempixel.com/640/480/food/?27313','2020-10-30 02:32:19','2020-10-30 02:32:19'),(16,'9797709834951','Reiciendis illo.',96,850.39,'Aut voluptas dignissimos voluptates.','https://lorempixel.com/640/480/food/?94386','2020-10-30 02:32:19','2020-10-30 02:32:19'),(17,'9791599788356','Architecto qui quia quos.',17,103.60,'Reiciendis aliquam provident voluptatem laudantium eligendi earum.','https://lorempixel.com/640/480/food/?74295','2020-10-30 02:32:19','2020-10-30 02:32:19'),(18,'9783847202530','Odio nisi quis sed totam.',99,283.77,'Est quisquam facilis a ea.','https://lorempixel.com/640/480/food/?52982','2020-10-30 02:32:19','2020-10-30 02:32:19'),(19,'9780790974699','Temporibus voluptatum.',53,559.58,'Voluptatibus velit voluptatibus fuga vel aut.','https://lorempixel.com/640/480/food/?43544','2020-10-30 02:32:19','2020-10-30 02:32:19'),(20,'9791788892802','Adipisci odit autem suscipit omnis.',18,452.07,'Qui sequi est amet tempore.','https://lorempixel.com/640/480/food/?10574','2020-10-30 02:32:19','2020-10-30 02:32:19'),(21,'9795380727333','Molestiae voluptas non incidunt.',94,910.14,'Ipsum et vitae voluptatem maxime corrupti voluptatum quas.','https://lorempixel.com/640/480/food/?92859','2020-10-30 02:32:19','2020-10-30 02:32:19'),(22,'9782228648769','Dolores molestias iure.',21,615.62,'Dicta vel deleniti consequatur quis itaque.','https://lorempixel.com/640/480/food/?79625','2020-10-30 02:32:19','2020-10-30 02:32:19'),(23,'9796944856940','Alias voluptatem vitae.',51,586.72,'Voluptas dolor in et consequatur velit.','https://lorempixel.com/640/480/food/?19680','2020-10-30 02:32:19','2020-10-30 02:32:19'),(24,'9799606381743','Reiciendis doloremque excepturi et.',18,62.01,'Dolorem fuga et nobis libero animi provident.','https://lorempixel.com/640/480/food/?17631','2020-10-30 02:32:19','2020-10-30 02:32:19'),(25,'9783184604356','Hic nihil ad.',17,501.09,'Non et eaque asperiores esse et deleniti ut.','https://lorempixel.com/640/480/food/?54767','2020-10-30 02:32:19','2020-10-30 02:32:19');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(6,'2016_06_01_000004_create_oauth_clients_table',1),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(8,'2019_08_19_000000_create_failed_jobs_table',1),(9,'2020_10_23_041154_create_articles_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('22dcae3275abf71e4174f20cd4c64254e6cf97d11430593bdc3f80987c594b14061822c220bd61f4',11,1,'Personal Access Token','[]',1,'2020-10-30 02:33:46','2020-10-30 02:33:46','2020-10-30 04:33:46');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Alvaro\'s Api Personal Access Client','yrB1RwV78WLgSjglK2Zte9tFBMduBsJ8h1YHELWq',NULL,'http://localhost',1,0,0,'2020-10-30 02:33:09','2020-10-30 02:33:09'),(2,NULL,'Alvaro\'s Api Password Grant Client','wwqe20lX2Xv3u7fllxG0EHCQ2r00VxFB80OtKtlA','users','http://localhost',0,1,0,'2020-10-30 02:33:09','2020-10-30 02:33:09');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2020-10-30 02:33:09','2020-10-30 02:33:09');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mr. Gardner Jones','elwyn41','nrussel@example.org','2020-10-30 02:32:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','2557-1103','1977-10-17','2QVHPapUb8','2020-10-30 02:32:19','2020-10-30 02:32:19'),(2,'Shyanne Kautzer','santos.von','raynor.emilie@example.org','2020-10-30 02:32:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','2899-6932','2004-02-16','po9OCihivk','2020-10-30 02:32:19','2020-10-30 02:32:19'),(3,'Ansel Fay','hborer','delphine12@example.org','2020-10-30 02:32:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','2541-6523','2016-12-31','3L14cEDrFh','2020-10-30 02:32:19','2020-10-30 02:32:19'),(4,'Dereck Howell','ronny.larkin','marley23@example.net','2020-10-30 02:32:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','2397-1489','1983-04-14','CKFYC9225a','2020-10-30 02:32:19','2020-10-30 02:32:19'),(5,'Dr. Augusta Borer','rtorp','laverna39@example.org','2020-10-30 02:32:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','2835-8340','1997-08-15','7WMMlp5nBp','2020-10-30 02:32:19','2020-10-30 02:32:19'),(6,'Mable Schinner PhD','mueller.juliana','carrie94@example.org','2020-10-30 02:32:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','2264-6763','1983-08-30','9KBEoPBUgb','2020-10-30 02:32:19','2020-10-30 02:32:19'),(7,'Ervin Ankunding','boris.hill','harvey.mckayla@example.com','2020-10-30 02:32:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','2550-8217','2012-06-18','aPXl1QBo2Y','2020-10-30 02:32:19','2020-10-30 02:32:19'),(8,'Florine Lubowitz','noemi17','albertha.kuphal@example.com','2020-10-30 02:32:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','2628-7800','2017-07-17','Vtbcxw7TNL','2020-10-30 02:32:19','2020-10-30 02:32:19'),(9,'Mrs. Gregoria Muller I','chet.quigley','major97@example.com','2020-10-30 02:32:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','2862-9811','1989-03-01','jVWCcde7OE','2020-10-30 02:32:19','2020-10-30 02:32:19'),(10,'Joanne Heaney PhD','angelica19','loraine52@example.org','2020-10-30 02:32:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','2492-6683','1991-06-29','OFz58SpvxS','2020-10-30 02:32:19','2020-10-30 02:32:19'),(11,'Alvaro García','alvarogarcia1010','alvarogarcia1010@gmail.com',NULL,'$2y$10$nH5LqPg.nHs8te8audQ1nu6XrWtehdipDUKV8birjhAd1L32SXgUy','2335-5858','1998-09-10',NULL,'2020-10-30 02:33:46','2020-10-30 02:33:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-30 10:46:48
