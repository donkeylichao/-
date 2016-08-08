-- MySQL dump 10.13  Distrib 5.6.16, for Win32 (x86)
--
-- Host: localhost    Database: donkeyli
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albums` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '相册名称',
  `descript` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '相册描述',
  `user_id` int(11) NOT NULL COMMENT '上传或者创建相册的人id',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '相册的id',
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '照片的路径',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '分类名称',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '图片',
  `pid` int(11) NOT NULL COMMENT '父模块id',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` int(11) NOT NULL COMMENT '评论的资源id',
  `user_id` int(11) NOT NULL COMMENT '评论人的id',
  `pid` int(11) NOT NULL COMMENT '间接评论被评论者id',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '评论内容',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `h_photos`
--

DROP TABLE IF EXISTS `h_photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `house_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_photos`
--

LOCK TABLES `h_photos` WRITE;
/*!40000 ALTER TABLE `h_photos` DISABLE KEYS */;
/*!40000 ALTER TABLE `h_photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `houses`
--

DROP TABLE IF EXISTS `houses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `houses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '小区名称',
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '小区位置',
  `area` smallint(6) NOT NULL COMMENT '小区面积',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '户型',
  `price` int(11) NOT NULL COMMENT '价格',
  `h_type` tinyint(4) NOT NULL COMMENT '房子类型,出租或二手',
  `user_id` int(11) NOT NULL COMMENT '信息录入人',
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '封面图片',
  `introduction` text COLLATE utf8_unicode_ci NOT NULL COMMENT '备注',
  `recommend` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `univalence` int(11) DEFAULT NULL COMMENT '买卖单价',
  `tax_rate` decimal(8,2) DEFAULT NULL COMMENT '买卖税率',
  `taxes` int(11) DEFAULT NULL COMMENT '税费',
  `room_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '房子的楼号及楼层房间好',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `houses`
--

LOCK TABLES `houses` WRITE;
/*!40000 ALTER TABLE `houses` DISABLE KEYS */;
INSERT INTO `houses` VALUES (1,'群芳三园','北京市通州区梨园',90,'三室两厅',2000,1,1,'','地铁附近，交通便利',1,'2016-08-08 00:40:20','2016-08-08 02:23:56',NULL,NULL,NULL,'38楼3单元304'),(2,'桃花岛','北京市通州区梨园',90,'两室一厅',5000000,2,1,'','价格实惠，交通便利',1,'2016-08-08 01:29:11','2016-08-08 01:29:11',12000,0.05,20000,'3楼3单元202');
/*!40000 ALTER TABLE `houses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_07_27_094510_create_houses_table',1),('2016_07_27_101514_create_h_photos_table',1),('2016_07_28_030154_create_categories_table',1),('2016_07_28_042234_create_resources_table',1),('2016_07_28_043630_create_comments_table',1),('2016_07_28_044430_create_scans_table',1),('2016_07_28_094113_entrust_setup_tables',1),('2016_07_29_031518_create_notifications_table',1),('2016_08_01_093503_add_time_to_users_table',1),('2016_08_05_020951_create_posts_table',2),('2016_08_05_021010_create_albums_table',3),('2016_08_05_070954_add_type_to_permissions_table',4),('2016_08_08_030401_add_vote_to_houses_table',5),('2016_08_08_070303_add_room_name_to_houses_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户的id',
  `body` text COLLATE utf8_unicode_ci NOT NULL COMMENT '消息内容',
  `from_id` int(11) NOT NULL COMMENT '产生消息的用户',
  `is_read` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否被查看',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'admin.manager','管理员列表','显示所有管理员','2016-08-05 00:40:35','2016-08-05 00:40:35',2),(2,'admin.manager.create','添加管理员','创建新的后台管理员','2016-08-05 00:41:34','2016-08-05 00:41:34',2),(3,'admin.manager.edit','编辑后台管理员','修改后台管理员的信息','2016-08-05 00:42:46','2016-08-05 00:42:46',2),(4,'admin.manager.delete','删除管理员','删除后台的管理员','2016-08-05 00:43:34','2016-08-05 00:43:34',2),(5,'admin.user','用户列表','查看所有用户','2016-08-05 00:44:43','2016-08-05 00:44:43',2),(6,'admin.user.delete','删除用户','删除前台评论用户','2016-08-05 00:45:26','2016-08-05 00:45:26',2),(7,'admin.auth','权限列表','查看所有权限','2016-08-05 00:46:12','2016-08-05 00:46:12',3),(8,'admin.auth.create','添加权限','添加权限信息','2016-08-05 00:47:11','2016-08-05 00:47:11',3),(9,'admin.auth.edit','编辑权限','修改权限','2016-08-05 00:56:02','2016-08-05 00:56:02',3),(10,'admin.auth.delete','删除权限','删除权限','2016-08-05 00:56:32','2016-08-05 00:56:32',3);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '帖子名称或者板块名称',
  `content` text COLLATE utf8_unicode_ci COMMENT '帖子的内容',
  `user_id` int(11) NOT NULL COMMENT '创建人的id',
  `pid` int(11) NOT NULL COMMENT '板块的id',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '发布内容的用户id',
  `category_id` int(11) NOT NULL COMMENT '所属栏目id',
  `type_id` tinyint(4) NOT NULL COMMENT '类型图片，视频，音频，文字',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '内容',
  `cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '列表显示图片',
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文件上传路径',
  `duration` int(11) DEFAULT NULL COMMENT '时长',
  `size` double(8,2) DEFAULT NULL COMMENT '资源大小',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (10,12);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (4,'网站统计','网站统计','网站首页及相关权限','2016-08-07 18:20:47','2016-08-07 18:20:47'),(5,'用户管理','用户管理','用户管理的相关权限','2016-08-07 18:21:04','2016-08-07 18:21:04'),(6,'权限管理','权限管理','权限管理的相关权限','2016-08-07 18:21:38','2016-08-07 18:21:38'),(7,'房源管理','房源管理','房源管理的相关权限','2016-08-07 18:22:01','2016-08-07 18:22:01'),(8,'视屏管理','视屏管理','视屏管理的相关权限','2016-08-07 18:22:20','2016-08-07 18:22:20'),(9,'音频管理','音频管理','音频管理的相关权限','2016-08-07 18:22:45','2016-08-07 18:22:45'),(10,'图片管理','图片管理','图片管理的相关权限','2016-08-07 18:23:09','2016-08-07 18:23:09'),(11,'日记管理','日记管理','日记管理的相关权限','2016-08-07 18:23:48','2016-08-07 18:23:48'),(12,'评论管理','评论管理','评论管理的相关权限','2016-08-07 18:24:05','2016-08-07 18:24:05'),(13,'消息管理','消息管理','消息管理的相关权限','2016-08-07 18:24:27','2016-08-07 18:24:27'),(15,'个人中心','个人中心','个人中心的所有权限','2016-08-07 18:44:03','2016-08-07 18:44:03');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scans`
--

DROP TABLE IF EXISTS `scans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` int(11) NOT NULL COMMENT '资源的id',
  `ip` char(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '浏览人的ip',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scans`
--

LOCK TABLES `scans` WRITE;
/*!40000 ALTER TABLE `scans` DISABLE KEYS */;
/*!40000 ALTER TABLE `scans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT '0',
  `real_name` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `headimg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com` char(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '三方登陆类型',
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `openid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_ip` char(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是管理员',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login_time` int(11) NOT NULL COMMENT '上一次登陆的时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','529755212@qq.com','$2y$10$J5lSCuwSYexJpK6owjpWQuf/N/3L5TSXBndBuWuqa1mkqUAyr9NEC','frVEDr3AwTBuGdZM4PyuX60lwhpPqCSs4qdgL9lXBZddkNghTYtJPv7oQTka',NULL,0,NULL,NULL,NULL,NULL,NULL,'::1',1,'0000-00-00 00:00:00','2016-08-07 17:18:24',1470619103),(2,'杨利超','943148389@qq.com','$2y$10$Qcn5bdO9sCuINl5VC/ShF.fJfRmvridepAigmikEntE8yl5fWTu.i','norcVYOcJAb0yHKhraKj5SDrkMOM5zVLFLMvkgp0z5EUq8ye9wBoR3s14IKC','',0,'',NULL,NULL,NULL,NULL,'::1',1,'2016-08-04 00:28:29','2016-08-04 22:16:36',1470377796),(3,'张三','529755211@qq.com','$2y$10$BdqpAj.M6LIr9DxBTmpkm.qc0KHXGtjKTG1Hg0nyBmbyf6dP8dIlS',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 00:29:45','2016-08-04 18:37:50',0),(4,'张三','529755213@qq.com','$2y$10$R1OcsylHHNztYMiv4p.CHux4xxLDLMIinkulYIS60VHHLMDWKS47G',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 00:34:02','2016-08-04 00:34:02',0),(5,'张三丰','97654321@qq.com','$2y$10$JtfLUMVz/DwMo3rLevIbpOAxlPCywFRftOdOkJ2emWStIkHGjqy4K',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:40:51','2016-08-04 19:41:08',0),(6,'李四','123@163.com','$2y$10$/shEOniHMDLPFlIIgVkA0uZwl0f31vvbQVC2M14zONbSPR9J4SwFW',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:49:35','2016-08-04 19:49:35',0),(7,'王五','1234@163.com','$2y$10$b0GvL0BLutSEs.51pxr70ePzPORutlrRue9tH2aQ0U1kLFpAvQUHK',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:49:57','2016-08-04 19:49:57',0),(8,'赵六','12345@163.com','$2y$10$iVOvaQTn5t7FwHY4QOncD.hShRkMuOghDKTHioR/VPJgwmceBtveq',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:50:23','2016-08-04 19:50:23',0),(9,'王三','123456@163.com','$2y$10$DBxiXzrdFd44NAJFh6TjSO4EuOjO0A6xx2alfu5awGfoPBnRPWR6m',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:50:52','2016-08-04 19:50:52',0),(10,'张三','65443@qq.com','$2y$10$4u9DF/KE/04AotNIw8HgkuvkYdwqOLg/KXI78l.jiJRYtaVHmjYR6',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:55:48','2016-08-07 18:48:22',0),(12,'哈哈','234234@qq.com','$2y$10$xlp47Wh4HIwrZO21OAw0LeIOJj7sEd6KCfoUpec8f0pVY0.MnuA1i',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,0,'2016-08-04 20:25:34','2016-08-04 20:25:34',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-08 18:24:48
