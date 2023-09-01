/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agentcode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` char(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `commrate` decimal(8,2) NOT NULL DEFAULT '0.00',
  `areas_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agents_areas_id_foreign` (`areas_id`),
  CONSTRAINT `agents_areas_id_foreign` FOREIGN KEY (`areas_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `arcns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arcns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `companyid` int DEFAULT NULL,
  `arcnid` char(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `cncode` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `cndate` date DEFAULT NULL,
  `customers_id` bigint unsigned DEFAULT NULL,
  `customername` char(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` char(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `reason` char(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referenceno` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agents_id` bigint unsigned DEFAULT NULL,
  `currencies_id` bigint unsigned DEFAULT NULL,
  `totalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `nettotalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `arcns_customers_id_foreign` (`customers_id`),
  KEY `arcns_agents_id_foreign` (`agents_id`),
  KEY `arcns_currencies_id_foreign` (`currencies_id`),
  KEY `arcns_companyid_index` (`companyid`),
  KEY `arcns_arcnid_index` (`arcnid`),
  CONSTRAINT `arcns_agents_id_foreign` FOREIGN KEY (`agents_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `arcns_currencies_id_foreign` FOREIGN KEY (`currencies_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `arcns_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `areas_id` bigint unsigned DEFAULT NULL,
  `areacode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `auc_cod` char(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `isactive` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `seq` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `areas_areas_id_foreign` (`areas_id`),
  CONSTRAINT `areas_areas_id_foreign` FOREIGN KEY (`areas_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `armatches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `armatches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `artype` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `artranid` int DEFAULT NULL,
  `arcode` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `payfortype` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `payforid` int DEFAULT NULL,
  `payforcode` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `arpos` int NOT NULL DEFAULT '1',
  `description` char(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `amount` decimal(11,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `authlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `authlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint unsigned DEFAULT NULL,
  `requestauthdesc` char(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `requestbyid` int DEFAULT NULL,
  `authorizedbyid` int DEFAULT NULL,
  `status` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `authlists_permission_id_foreign` (`permission_id`),
  CONSTRAINT `authlists_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bankdocs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bankdocs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bankdoc` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankdoc_date` date DEFAULT NULL,
  `banks_id` bigint unsigned DEFAULT NULL,
  `receiptdetails` json DEFAULT NULL,
  `remark` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companyid` int DEFAULT NULL,
  `totalamount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bankdocs_banks_id_foreign` (`banks_id`),
  CONSTRAINT `bankdocs_banks_id_foreign` FOREIGN KEY (`banks_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `category_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_versions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_categories_id` bigint unsigned DEFAULT NULL,
  `version` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version_desc` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_versions_customer_categories_id_foreign` (`customer_categories_id`),
  CONSTRAINT `category_versions_customer_categories_id_foreign` FOREIGN KEY (`customer_categories_id`) REFERENCES `customer_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `company_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `companycode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companyname` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registrationno` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registrationno2` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gstno` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address3` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address4` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `areas_id` bigint unsigned DEFAULT NULL,
  `zipcode` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactperson` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactperson2` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneno1` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneno2` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banks_id` bigint unsigned NOT NULL,
  `banks_id2` bigint unsigned NOT NULL,
  `bankacc1` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankacc2` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `companyltrheader` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `companyltrfooter` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_default` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_settings_areas_id_foreign` (`areas_id`),
  KEY `company_settings_banks_id_foreign` (`banks_id`),
  KEY `company_settings_banks_id2_foreign` (`banks_id2`),
  CONSTRAINT `company_settings_areas_id_foreign` FOREIGN KEY (`areas_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `company_settings_banks_id2_foreign` FOREIGN KEY (`banks_id2`) REFERENCES `banks` (`id`),
  CONSTRAINT `company_settings_banks_id_foreign` FOREIGN KEY (`banks_id`) REFERENCES `banks` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `currencies_id` bigint unsigned DEFAULT NULL,
  `currencycode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sign` char(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `currencies_currencies_id_foreign` (`currencies_id`),
  CONSTRAINT `currencies_currencies_id_foreign` FOREIGN KEY (`currencies_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_categories_id` bigint unsigned DEFAULT NULL,
  `categorycode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lastrunno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b_rmk` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `b_mobapp` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `b_adrmk` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `stockcatgid` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_categories_customer_categories_id_foreign` (`customer_categories_id`),
  KEY `customer_categories_categorycode_index` (`categorycode`),
  CONSTRAINT `customer_categories_customer_categories_id_foreign` FOREIGN KEY (`customer_categories_id`) REFERENCES `customer_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `groupcode` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_categories_id` bigint unsigned DEFAULT NULL,
  `companyid` int NOT NULL,
  `foldername` char(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `exp_dat` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `cfgpassword` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `agents_id` bigint unsigned DEFAULT NULL,
  `cfgfile` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soft_lic` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_groups_customer_categories_id_foreign` (`customer_categories_id`),
  KEY `customer_groups_agents_id_foreign` (`agents_id`),
  KEY `customer_groups_groupcode_index` (`groupcode`),
  KEY `customer_groups_companyid_index` (`companyid`),
  CONSTRAINT `customer_groups_agents_id_foreign` FOREIGN KEY (`agents_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customer_groups_customer_categories_id_foreign` FOREIGN KEY (`customer_categories_id`) REFERENCES `customer_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_groups_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_groups_customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_groups_id` bigint unsigned NOT NULL,
  `customers_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_groups_customers_customer_groups_id_foreign` (`customer_groups_id`),
  KEY `customer_groups_customers_customers_id_foreign` (`customers_id`),
  CONSTRAINT `customer_groups_customers_customer_groups_id_foreign` FOREIGN KEY (`customer_groups_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_groups_customers_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_pkpbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_pkpbs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customers_id` bigint unsigned DEFAULT NULL,
  `serviceid` int DEFAULT NULL,
  `nam` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ic_no` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pho_no` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suhu` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_pkpbs_customers_id_foreign` (`customers_id`),
  CONSTRAINT `customer_pkpbs_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_pwspgapps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_pwspgapps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint unsigned DEFAULT NULL,
  `customers_id` bigint unsigned DEFAULT NULL,
  `apiurl` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_secret` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_token` char(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_dt` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_pwspgapps_users_id_foreign` (`users_id`),
  KEY `customer_pwspgapps_customers_id_foreign` (`customers_id`),
  CONSTRAINT `customer_pwspgapps_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customer_pwspgapps_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customers_id` bigint unsigned DEFAULT NULL,
  `customer_categories_id` bigint unsigned DEFAULT NULL,
  `contract_typ` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `inc_hw` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `pay_before` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `service_date` datetime NOT NULL,
  `soft_license` int NOT NULL DEFAULT '0',
  `pos_license` int NOT NULL DEFAULT '0',
  `active` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `serial_no` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_dat` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cfgpassword` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agents_id` bigint unsigned DEFAULT NULL,
  `cfgfile` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vpnaddress` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rmk` char(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_services_customers_id_foreign` (`customers_id`),
  KEY `customer_services_customer_categories_id_foreign` (`customer_categories_id`),
  KEY `customer_services_agents_id_foreign` (`agents_id`),
  CONSTRAINT `customer_services_agents_id_foreign` FOREIGN KEY (`agents_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customer_services_customer_categories_id_foreign` FOREIGN KEY (`customer_categories_id`) REFERENCES `customer_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customer_services_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_total_pay_apps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_total_pay_apps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customers_id` bigint unsigned DEFAULT NULL,
  `customer_services_id` bigint unsigned DEFAULT NULL,
  `shopname` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactno` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apiurl` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tapiurl` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_secret` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `renew_red` int NOT NULL DEFAULT '0',
  `b_reduce_principle` int NOT NULL DEFAULT '0',
  `b_acpt_op` int DEFAULT '0',
  `b_dealforyou` int DEFAULT '0',
  `b_locate` int DEFAULT '0',
  `b_getgprc` int DEFAULT '0',
  `b_floating` int DEFAULT '0',
  `b_payslip` int DEFAULT '0',
  `b_productimage` int DEFAULT '0',
  `b_refer` int DEFAULT '0',
  `merchant_code` char(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_key` char(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `qrpdfurl` char(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chrg_amt` decimal(11,2) DEFAULT NULL,
  `cust_chrg_amt` decimal(11,2) DEFAULT NULL,
  `slogan` char(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_address` text COLLATE utf8mb4_unicode_ci,
  `latitude` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_total_pay_apps_customers_id_foreign` (`customers_id`),
  KEY `customer_total_pay_apps_customer_services_id_foreign` (`customer_services_id`),
  CONSTRAINT `customer_total_pay_apps_customer_services_id_foreign` FOREIGN KEY (`customer_services_id`) REFERENCES `customer_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customer_total_pay_apps_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customers_id` bigint unsigned DEFAULT NULL,
  `companycode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `companyname` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `registrationno` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `registrationno2` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address1` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address2` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address3` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address4` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `contactperson` char(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phoneno1` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phoneno2` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `faxno1` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `faxno2` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email2` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email3` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homepage` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `businessnature` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_categories_id` bigint unsigned DEFAULT NULL,
  `areas_id` bigint unsigned DEFAULT NULL,
  `sales_people_id` bigint unsigned DEFAULT NULL,
  `currencies_id` bigint unsigned DEFAULT NULL,
  `terms_id` bigint unsigned DEFAULT NULL,
  `creditlimit` decimal(19,2) NOT NULL DEFAULT '0.00',
  `currentbalance` int NOT NULL DEFAULT '0',
  `startdate` date DEFAULT NULL,
  `status` char(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `gstregno` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `zipcode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `shortname` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foldername` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bandar` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b_aiservice` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `serviceremarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_customers_id_foreign` (`customers_id`),
  KEY `customers_customer_categories_id_foreign` (`customer_categories_id`),
  KEY `customers_areas_id_foreign` (`areas_id`),
  KEY `customers_sales_people_id_foreign` (`sales_people_id`),
  KEY `customers_currencies_id_foreign` (`currencies_id`),
  KEY `customers_terms_id_foreign` (`terms_id`),
  CONSTRAINT `customers_areas_id_foreign` FOREIGN KEY (`areas_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customers_currencies_id_foreign` FOREIGN KEY (`currencies_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customers_customer_categories_id_foreign` FOREIGN KEY (`customer_categories_id`) REFERENCES `customer_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customers_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customers_sales_people_id_foreign` FOREIGN KEY (`sales_people_id`) REFERENCES `sales_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customers_terms_id_foreign` FOREIGN KEY (`terms_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `evaluation_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluation_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `evaluation_id` int NOT NULL,
  `form_title` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_rating` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `seq` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `evaluation_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluation_forms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `form_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
DROP TABLE IF EXISTS `good_receives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `good_receives` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchaseorderid` char(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warrantyid` int unsigned DEFAULT NULL,
  `stocks_id` bigint unsigned DEFAULT NULL,
  `20` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sup_inv_dat` date DEFAULT NULL,
  `rcv_qty` int unsigned NOT NULL DEFAULT '0',
  `rcv_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `good_receives_stocks_id_foreign` (`stocks_id`),
  KEY `good_receives_purchaseorderid_index` (`purchaseorderid`),
  KEY `good_receives_warrantyid_index` (`warrantyid`),
  CONSTRAINT `good_receives_stocks_id_foreign` FOREIGN KEY (`stocks_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `gstrates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gstrates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rate` int DEFAULT NULL,
  `status` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `effectivedate_from` date NOT NULL,
  `effectivedate_to` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `hardware_loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hardware_loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jobno` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stocks_id` bigint unsigned DEFAULT NULL,
  `stockname` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comp_cod` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorycode` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hardware_loans_stocks_id_foreign` (`stocks_id`),
  CONSTRAINT `hardware_loans_stocks_id_foreign` FOREIGN KEY (`stocks_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `leave_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leave_forms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `doc_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffid` int DEFAULT NULL,
  `staff_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_typ` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_duration` decimal(10,2) NOT NULL,
  `leave_dat_frm` date DEFAULT NULL,
  `leave_dat_to` date DEFAULT NULL,
  `leave_reason` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applied_dat` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '2' COMMENT '1=approved,2=pending,0=reject',
  `approved_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_dat` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applied_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_forms_staffid_index` (`staffid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `payment_vouchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_vouchers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `companyid` int DEFAULT NULL,
  `paymentcode` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `paymentdate` date DEFAULT NULL,
  `supplierid` int DEFAULT NULL,
  `suppliername` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `referenceno` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referencedate` date DEFAULT NULL,
  `currencies_id` bigint unsigned DEFAULT NULL,
  `amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `description` json DEFAULT NULL,
  `sup_inv_no` json DEFAULT NULL,
  `sup_inv_dat` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_vouchers_currencies_id_foreign` (`currencies_id`),
  KEY `payment_vouchers_companyid_index` (`companyid`),
  KEY `payment_vouchers_paymentcode_index` (`paymentcode`),
  KEY `payment_vouchers_supplierid_index` (`supplierid`),
  CONSTRAINT `payment_vouchers_currencies_id_foreign` FOREIGN KEY (`currencies_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `print_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `print_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `printfile` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startprint` date DEFAULT NULL,
  `endprint` date DEFAULT NULL,
  `printcmd` char(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `purchase_order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_order_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchaseorderid` int DEFAULT NULL,
  `stocks_id` bigint unsigned DEFAULT NULL,
  `pos` int NOT NULL DEFAULT '0',
  `qty` int NOT NULL DEFAULT '0',
  `uomid` int DEFAULT NULL,
  `unitprice` decimal(11,2) DEFAULT NULL,
  `description` char(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `referenceno` char(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `note` text COLLATE utf8mb4_unicode_ci,
  `amount` decimal(11,2) DEFAULT NULL,
  `discount` decimal(11,2) DEFAULT NULL,
  `subamount` decimal(11,2) DEFAULT NULL,
  `taxrate` decimal(11,2) DEFAULT NULL,
  `taxamount` decimal(11,2) DEFAULT NULL,
  `netamount` decimal(11,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_order_details_stocks_id_foreign` (`stocks_id`),
  KEY `purchase_order_details_purchaseorderid_index` (`purchaseorderid`),
  CONSTRAINT `purchase_order_details_stocks_id_foreign` FOREIGN KEY (`stocks_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `purchase_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchaseorderid` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchaseordercode` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `purchaseorderdate` date DEFAULT NULL,
  `supplierid` int DEFAULT NULL,
  `suppliername` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `attention` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fax` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `referenceno` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_id` bigint unsigned DEFAULT NULL,
  `title` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duedate` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address2` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address3` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address4` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deliveraddress1` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deliveraddress2` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deliveraddress3` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deliveraddress4` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `delivercontact` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deliverphone` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deliverfax` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `currencies_id` bigint unsigned DEFAULT NULL,
  `totalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `subtotalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `taxtotalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `nettotalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `roundingadjustment` decimal(11,2) NOT NULL DEFAULT '0.00',
  `iscancelled` tinyint(1) NOT NULL DEFAULT '0',
  `isclosed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_orders_terms_id_foreign` (`terms_id`),
  KEY `purchase_orders_currencies_id_foreign` (`currencies_id`),
  KEY `purchase_orders_purchaseorderid_index` (`purchaseorderid`),
  KEY `purchase_orders_purchaseordercode_index` (`purchaseordercode`),
  KEY `purchase_orders_supplierid_index` (`supplierid`),
  CONSTRAINT `purchase_orders_currencies_id_foreign` FOREIGN KEY (`currencies_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchase_orders_terms_id_foreign` FOREIGN KEY (`terms_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receipts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `companyid` int DEFAULT NULL,
  `receiptid` char(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `receiptcode` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `receiptdate` date DEFAULT NULL,
  `customers_id` bigint unsigned DEFAULT NULL,
  `customername` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `banks_id` bigint unsigned DEFAULT NULL,
  `referenceno` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agents_id` bigint unsigned DEFAULT NULL,
  `currencies_id` bigint unsigned DEFAULT NULL,
  `bankcharges` decimal(11,2) NOT NULL DEFAULT '0.00',
  `totalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `nettotalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `bankdoc_id` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receipts_customers_id_foreign` (`customers_id`),
  KEY `receipts_banks_id_foreign` (`banks_id`),
  KEY `receipts_agents_id_foreign` (`agents_id`),
  KEY `receipts_currencies_id_foreign` (`currencies_id`),
  KEY `receipts_companyid_index` (`companyid`),
  CONSTRAINT `receipts_agents_id_foreign` FOREIGN KEY (`agents_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `receipts_banks_id_foreign` FOREIGN KEY (`banks_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `receipts_currencies_id_foreign` FOREIGN KEY (`currencies_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `receipts_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sales_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales_invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `companyid` int DEFAULT NULL,
  `salesinvoiceid` char(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `salesinvoicecode` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `salesinvoicedate` date DEFAULT NULL,
  `customers_id` bigint unsigned DEFAULT NULL,
  `customername` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `attention` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fax` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address1` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address2` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address3` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address4` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `referenceno` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agents_id` bigint unsigned DEFAULT NULL,
  `docontact` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `dophone` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `dofax` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `doaddress1` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `doaddress2` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `doaddress3` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `doaddress4` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `doregistationno` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `dogstregno` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `dophone2` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `doemail` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `doremark` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `areas_id` bigint unsigned DEFAULT NULL,
  `terms_id` bigint unsigned DEFAULT NULL,
  `currencies_id` bigint unsigned DEFAULT NULL,
  `totalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `discountamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `subtotalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `taxtotalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `nettotalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `roundingadjustment` decimal(11,2) NOT NULL DEFAULT '0.00',
  `sales_note` text COLLATE utf8mb4_unicode_ci,
  `cancelled_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_invoices_customers_id_foreign` (`customers_id`),
  KEY `sales_invoices_agents_id_foreign` (`agents_id`),
  KEY `sales_invoices_areas_id_foreign` (`areas_id`),
  KEY `sales_invoices_terms_id_foreign` (`terms_id`),
  KEY `sales_invoices_currencies_id_foreign` (`currencies_id`),
  KEY `sales_invoices_companyid_index` (`companyid`),
  CONSTRAINT `sales_invoices_agents_id_foreign` FOREIGN KEY (`agents_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_invoices_areas_id_foreign` FOREIGN KEY (`areas_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_invoices_currencies_id_foreign` FOREIGN KEY (`currencies_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_invoices_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_invoices_terms_id_foreign` FOREIGN KEY (`terms_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sales_invoices_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales_invoices_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoiceid` int DEFAULT NULL,
  `stocks_id` bigint unsigned DEFAULT NULL,
  `pos` int NOT NULL DEFAULT '0',
  `qty` int NOT NULL DEFAULT '0',
  `uomid` int DEFAULT NULL,
  `unitprice` decimal(11,2) DEFAULT NULL,
  `description` char(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `referenceno` char(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `note` text COLLATE utf8mb4_unicode_ci,
  `amount` decimal(11,2) DEFAULT NULL,
  `discount` decimal(11,2) DEFAULT NULL,
  `subamount` decimal(11,2) DEFAULT NULL,
  `taxrate` decimal(11,2) DEFAULT NULL,
  `taxamount` decimal(11,2) DEFAULT NULL,
  `netamount` decimal(11,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_invoices_details_stocks_id_foreign` (`stocks_id`),
  CONSTRAINT `sales_invoices_details_stocks_id_foreign` FOREIGN KEY (`stocks_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sales_people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales_people` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `salespersonid` char(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `staffcode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `idno` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `datejoined` date DEFAULT NULL,
  `dateleft` date DEFAULT NULL,
  `mobileno` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_people_salespersonid_index` (`salespersonid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `service_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jobno` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `service_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_rates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` json DEFAULT NULL,
  `rate` int DEFAULT NULL,
  `status` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `effectivedate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `service_trainings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_trainings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jobno` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `com_cod` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_categories_categorycode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `batch` tinyint NOT NULL DEFAULT '1',
  `seq` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_trainings_customer_categories_categorycode_unique` (`customer_categories_categorycode`),
  CONSTRAINT `service_trainings_customer_categories_categorycode_foreign` FOREIGN KEY (`customer_categories_categorycode`) REFERENCES `customer_categories` (`categorycode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `software_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `software_services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_no` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companycode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customertype` tinyint NOT NULL DEFAULT '1' COMMENT '1=customer,2=customer group',
  `phoneno1` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactperson` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_categories_categorycode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `servicedate` date NOT NULL,
  `solutioncode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complain_problem` longtext COLLATE utf8mb4_unicode_ci,
  `service_solution` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL,
  `assigned_user` json DEFAULT NULL,
  `close_date` date DEFAULT NULL,
  `signature` text COLLATE utf8mb4_unicode_ci,
  `closed_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` date DEFAULT NULL,
  `solution_save` tinyint NOT NULL DEFAULT '2' COMMENT '1=saved,2=pending,3=cancel',
  `form_type` tinyint NOT NULL DEFAULT '2' COMMENT '1=software,2=hardware',
  `servicetype` tinyint NOT NULL DEFAULT '2' COMMENT '1=service,2=installation',
  `servicetype_rmk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `software_services_customer_categories_categorycode_unique` (`customer_categories_categorycode`),
  KEY `software_services_status_index` (`status`),
  CONSTRAINT `software_services_customer_categories_categorycode_foreign` FOREIGN KEY (`customer_categories_categorycode`) REFERENCES `customer_categories` (`categorycode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `solution_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solution_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `solutioncode` char(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `problem_description` longtext COLLATE utf8mb4_unicode_ci,
  `problem_solution` longtext COLLATE utf8mb4_unicode_ci,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `staffcode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` char(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comp_id` int NOT NULL DEFAULT '1',
  `commrate` decimal(8,2) NOT NULL DEFAULT '0.00',
  `designation` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_join` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_review` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `staffs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `staffcode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp_id` tinyint NOT NULL DEFAULT '1',
  `commrate` decimal(8,2) NOT NULL DEFAULT '0.00',
  `designation` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_join` date DEFAULT NULL,
  `last_review` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `stock_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stockid` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorycode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` char(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `isshowdb` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isactive` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_categories_stockid_index` (`stockid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `stock_serials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_serials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `good_receives_id` bigint unsigned DEFAULT NULL,
  `replacetoid` int unsigned DEFAULT NULL,
  `serial_no` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_at` date DEFAULT NULL,
  `rmk` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_serials_good_receives_id_foreign` (`good_receives_id`),
  KEY `stock_serials_replacetoid_index` (`replacetoid`),
  CONSTRAINT `stock_serials_good_receives_id_foreign` FOREIGN KEY (`good_receives_id`) REFERENCES `good_receives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stockid` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stockcode` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `stockname` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` char(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `stock_categories_id` bigint unsigned DEFAULT NULL,
  `sellingprice` decimal(11,2) NOT NULL DEFAULT '0.00',
  `purchaseprice` decimal(11,2) NOT NULL DEFAULT '0.00',
  `lastsellingprice` decimal(11,2) NOT NULL DEFAULT '0.00',
  `lastpurchaseprice` decimal(11,2) NOT NULL DEFAULT '0.00',
  `stockspec` text COLLATE utf8mb4_unicode_ci,
  `customer_categories_id` bigint unsigned DEFAULT NULL,
  `seq` int NOT NULL DEFAULT '0',
  `b_serial` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `alw_pls` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `min_order_qty` int DEFAULT '0',
  `min_lvl_qty` int DEFAULT '0',
  `opening_year` int DEFAULT '0',
  `opening_year_qty` int DEFAULT '0',
  `auto_send_purchase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `loan_flag` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stocks_stock_categories_id_foreign` (`stock_categories_id`),
  KEY `stocks_customer_categories_id_foreign` (`customer_categories_id`),
  KEY `stocks_stockid_index` (`stockid`),
  CONSTRAINT `stocks_customer_categories_id_foreign` FOREIGN KEY (`customer_categories_id`) REFERENCES `customer_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stocks_stock_categories_id_foreign` FOREIGN KEY (`stock_categories_id`) REFERENCES `stock_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplierid` char(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `companycode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `companyname` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `companyname2` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `registrationno` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `registrationno2` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address1` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address2` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address3` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address4` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `contactperson` char(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phoneno1` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phoneno2` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `faxno1` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `faxno2` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email2` char(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `homepage` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `businessnature` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `creditlimit` decimal(19,2) NOT NULL DEFAULT '0.00',
  `currentbalance` int NOT NULL DEFAULT '0',
  `startdate` date DEFAULT NULL,
  `status` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `gstregno` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `zipcode` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `bandar` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `areas_id` bigint unsigned DEFAULT NULL,
  `currencies_id` bigint unsigned DEFAULT NULL,
  `terms_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `suppliers_areas_id_foreign` (`areas_id`),
  KEY `suppliers_currencies_id_foreign` (`currencies_id`),
  KEY `suppliers_terms_id_foreign` (`terms_id`),
  KEY `suppliers_supplierid_index` (`supplierid`),
  CONSTRAINT `suppliers_areas_id_foreign` FOREIGN KEY (`areas_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `suppliers_currencies_id_foreign` FOREIGN KEY (`currencies_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `suppliers_terms_id_foreign` FOREIGN KEY (`terms_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `system_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jobrefreshtime` int NOT NULL DEFAULT '0',
  `jobnotifyday` int NOT NULL DEFAULT '0',
  `srvchgsendnotify` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailsender` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoiceprinter` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poprinter` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiptprinter` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentprinter` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creditnoteprinter` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stickerprinter` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reportprinter` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allinvdvylh` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `allcnlh` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `softwareservicerefreshtime` int NOT NULL DEFAULT '0',
  `uploadfilelimit` int NOT NULL DEFAULT '0',
  `sms_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_active` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_year` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_photo_limit` int NOT NULL DEFAULT '3',
  `allow_gst` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `gst_calculate_total` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `paginate_page` int NOT NULL DEFAULT '15',
  `loan_notify_day` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ta_sales_receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ta_sales_receipts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `companyid` int NOT NULL DEFAULT '1',
  `salesinvoicecode` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiptcode` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salesinvoicedate` date DEFAULT NULL,
  `receiptdate` date DEFAULT NULL,
  `customername` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nettotalamount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `bankdocs_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ta_sales_receipts_bankdocs_id_foreign` (`bankdocs_id`),
  KEY `ta_sales_receipts_companyid_index` (`companyid`),
  CONSTRAINT `ta_sales_receipts_bankdocs_id_foreign` FOREIGN KEY (`bankdocs_id`) REFERENCES `bankdocs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `terms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `terms_id` bigint unsigned DEFAULT NULL,
  `term` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `termdays` int NOT NULL DEFAULT '0',
  `description` char(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `terms_terms_id_foreign` (`terms_id`),
  CONSTRAINT `terms_terms_id_foreign` FOREIGN KEY (`terms_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `test_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `doc_no` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_dat` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_cod` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_no` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_dat` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `desc` text COLLATE utf8mb4_unicode_ci,
  `sup_inv_no` text COLLATE utf8mb4_unicode_ci,
  `sup_inv_dat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_payments_doc_no_index` (`doc_no`),
  KEY `test_payments_doc_dat_index` (`doc_dat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `training_detail_extras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `training_detail_extras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `detail_id` int NOT NULL,
  `particular` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special` int NOT NULL DEFAULT '0',
  `space_lvl` int NOT NULL DEFAULT '0',
  `input_flag` int NOT NULL DEFAULT '0',
  `seq` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `training_form_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `training_form_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `trainingid` int NOT NULL,
  `no` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `particular` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special` int NOT NULL DEFAULT '0',
  `space_lvl` int NOT NULL DEFAULT '0',
  `input_flag` int NOT NULL DEFAULT '0',
  `seq` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `training_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `training_forms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `systemcod` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_title` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `uoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uoms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uomid` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uomcode` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isactive` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stocks_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uoms_stocks_id_foreign` (`stocks_id`),
  KEY `uoms_uomid_index` (`uomid`),
  CONSTRAINT `uoms_stocks_id_foreign` FOREIGN KEY (`stocks_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` VALUES (3,'2014_10_12_100000_create_password_resets_table',1);
INSERT INTO `migrations` VALUES (4,'2016_06_01_000001_create_oauth_auth_codes_table',1);
INSERT INTO `migrations` VALUES (5,'2016_06_01_000002_create_oauth_access_tokens_table',1);
INSERT INTO `migrations` VALUES (6,'2016_06_01_000003_create_oauth_refresh_tokens_table',1);
INSERT INTO `migrations` VALUES (7,'2016_06_01_000004_create_oauth_clients_table',1);
INSERT INTO `migrations` VALUES (8,'2016_06_01_000005_create_oauth_personal_access_clients_table',1);
INSERT INTO `migrations` VALUES (9,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` VALUES (10,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` VALUES (11,'2023_07_11_043908_create_sessions_table',1);
INSERT INTO `migrations` VALUES (12,'2023_07_11_044213_create_currencies_table',1);
INSERT INTO `migrations` VALUES (13,'2023_07_11_044217_create_sales_people_table',1);
INSERT INTO `migrations` VALUES (14,'2023_07_11_044219_create_terms_table',1);
INSERT INTO `migrations` VALUES (15,'2023_07_11_044221_create_areas_table',1);
INSERT INTO `migrations` VALUES (16,'2023_07_11_044225_create_customer_categories_table',1);
INSERT INTO `migrations` VALUES (17,'2023_07_11_044229_create_customers_table',1);
INSERT INTO `migrations` VALUES (18,'2023_07_11_050606_create_suppliers_table',1);
INSERT INTO `migrations` VALUES (19,'2023_07_11_051646_create_agents_table',1);
INSERT INTO `migrations` VALUES (20,'2023_07_11_053526_create_staff_table',1);
INSERT INTO `migrations` VALUES (21,'2023_07_11_061338_create_stock_categories_table',1);
INSERT INTO `migrations` VALUES (22,'2023_07_11_062244_create_stocks_table',1);
INSERT INTO `migrations` VALUES (23,'2023_07_11_065623_create_permission_tables',1);
INSERT INTO `migrations` VALUES (24,'2023_07_11_092003_create_sales_invoices_table',1);
INSERT INTO `migrations` VALUES (25,'2023_07_11_100849_create_sales_invoices_details_table',1);
INSERT INTO `migrations` VALUES (26,'2023_07_11_102134_create_arcns_table',1);
INSERT INTO `migrations` VALUES (27,'2023_07_11_103020_create_banks_table',1);
INSERT INTO `migrations` VALUES (28,'2023_07_11_103121_create_receipts_table',1);
INSERT INTO `migrations` VALUES (29,'2023_07_11_105310_create_purchase_orders_table',1);
INSERT INTO `migrations` VALUES (30,'2023_07_11_111435_create_purchase_order_details_table',1);
INSERT INTO `migrations` VALUES (31,'2023_07_11_112332_create_uoms_table',1);
INSERT INTO `migrations` VALUES (32,'2023_07_11_113941_create_armatches_table',1);
INSERT INTO `migrations` VALUES (33,'2023_07_11_114138_create_payment_vouchers_table',1);
INSERT INTO `migrations` VALUES (34,'2023_07_13_045319_create_authlists_table',1);
INSERT INTO `migrations` VALUES (35,'2023_07_13_050554_create_bankdocs_table',1);
INSERT INTO `migrations` VALUES (36,'2023_07_13_053004_create_category_versions_table',1);
INSERT INTO `migrations` VALUES (37,'2023_07_13_055017_create_company_settings_table',1);
INSERT INTO `migrations` VALUES (38,'2023_07_13_064417_create_customer_groups_table',1);
INSERT INTO `migrations` VALUES (39,'2023_07_13_073238_create_customer_groups_customers_table',1);
INSERT INTO `migrations` VALUES (40,'2023_07_13_073957_create_customer_pkpbs_table',1);
INSERT INTO `migrations` VALUES (41,'2023_07_13_074724_create_customer_pwspgapps_table',1);
INSERT INTO `migrations` VALUES (42,'2023_07_13_082408_create_customer_services_table',1);
INSERT INTO `migrations` VALUES (43,'2023_07_13_094956_create_customer_total_pay_apps_table',1);
INSERT INTO `migrations` VALUES (44,'2023_07_13_100948_create_estks_table',1);
INSERT INTO `migrations` VALUES (45,'2023_07_13_101133_create_evaluation_details_table',1);
INSERT INTO `migrations` VALUES (46,'2023_07_13_101741_create_evaluation_forms_table',1);
INSERT INTO `migrations` VALUES (47,'2023_07_13_102015_create_good_receives_table',1);
INSERT INTO `migrations` VALUES (48,'2023_07_13_105928_create_gstrates_table',1);
INSERT INTO `migrations` VALUES (49,'2023_07_13_110407_create_hardware_loans_table',1);
INSERT INTO `migrations` VALUES (50,'2023_07_13_111551_create_leave_forms_table',1);
INSERT INTO `migrations` VALUES (51,'2023_07_13_113936_create_print_logs_table',1);
INSERT INTO `migrations` VALUES (52,'2023_07_13_121631_create_service_logs_table',1);
INSERT INTO `migrations` VALUES (53,'2023_07_13_121944_create_service_rates_table',1);
INSERT INTO `migrations` VALUES (54,'2023_07_14_051034_create_service_trainings_table',1);
INSERT INTO `migrations` VALUES (55,'2023_07_14_061446_create_software_services_table',1);
INSERT INTO `migrations` VALUES (56,'2023_07_14_063102_create_solution_profiles_table',1);
INSERT INTO `migrations` VALUES (57,'2023_07_14_063549_create_staffs_table',1);
INSERT INTO `migrations` VALUES (58,'2023_07_14_084851_create_stock_serials_table',2);
INSERT INTO `migrations` VALUES (59,'2023_07_14_092149_create_system_settings_table',3);
INSERT INTO `migrations` VALUES (60,'2023_07_14_093547_create_ta_sales_receipts_table',4);
INSERT INTO `migrations` VALUES (61,'2023_07_14_101713_create_test_payments_table',5);
INSERT INTO `migrations` VALUES (62,'2023_07_14_102616_create_training_detail_extras_table',6);
INSERT INTO `migrations` VALUES (63,'2023_07_14_102911_create_training_forms_table',7);
INSERT INTO `migrations` VALUES (64,'2023_07_14_103144_create_training_form_details_table',8);
