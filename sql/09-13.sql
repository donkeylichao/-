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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'视频','',0,NULL,'2016-08-09 22:28:04','2016-08-10 00:47:49'),(2,'音频','',0,NULL,'2016-08-09 22:28:53','2016-08-10 00:48:32'),(3,'图片','',0,NULL,'2016-08-09 22:29:05','2016-08-10 00:48:36'),(4,'gits','',0,NULL,'2016-08-09 22:29:17','2016-09-13 02:18:39'),(5,'吉他弹唱','',1,NULL,'2016-08-09 22:36:19','2016-08-10 00:37:38'),(6,'古典','',2,NULL,'2016-08-18 19:42:19','2016-09-05 23:48:56'),(7,'搞笑','',1,NULL,'2016-09-05 23:49:08','2016-09-05 23:49:08'),(8,'pdf文档','',0,NULL,'2016-09-12 18:05:11','2016-09-12 18:05:11');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,21,1,0,'<img src=/uploads/emojis/1473054913.gif/>你好怂啊，***','2016-09-08 20:57:20','2016-09-08 20:57:20'),(2,21,1,1,'<img src=/uploads/emojis/1473054937.gif/>你是傻*','2016-09-08 20:57:43','2016-09-08 20:57:43'),(3,21,1,0,'<img src=/uploads/emojis/1473057591.gif/>试试看好用不好用','2016-09-08 21:14:14','2016-09-08 21:14:14'),(4,21,1,0,'<img src=/uploads/emojis/1473057457.gif/>好像不太好用','2016-09-08 21:16:44','2016-09-08 21:16:44'),(5,21,1,0,'<img src=/uploads/emojis/1473056878.gif/>挺好用','2016-09-08 23:24:14','2016-09-08 23:24:14'),(6,21,1,1,'你好<img src=/uploads/emojis/1473057156.gif/><img src=/uploads/emojis/1473056902.gif/>','2016-09-08 23:25:05','2016-09-08 23:25:05'),(7,21,1,1,'<img src=/uploads/emojis/1473057081.gif/>你好摸摸你','2016-09-08 23:25:51','2016-09-08 23:25:51'),(8,21,1,0,'<img src=/uploads/emojis/1473055066.gif/>','2016-09-08 23:42:20','2016-09-08 23:42:20');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emojis`
--

DROP TABLE IF EXISTS `emojis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emojis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '表情名称',
  `mark` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '表情标记',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '图片路径',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emojis`
--

LOCK TABLES `emojis` WRITE;
/*!40000 ALTER TABLE `emojis` DISABLE KEYS */;
INSERT INTO `emojis` VALUES (1,'呲牙','[/呲牙]','/uploads/emojis/1473054682.gif','2016-09-04 21:51:22','2016-09-04 21:51:22'),(2,'白眼','[/白眼]','/uploads/emojis/1473054862.gif','2016-09-04 21:54:22','2016-09-04 21:54:22'),(3,'闭嘴','[/闭嘴]','/uploads/emojis/1473054890.gif','2016-09-04 21:54:50','2016-09-04 21:54:50'),(4,'擦汗','[/擦汗]','/uploads/emojis/1473054913.gif','2016-09-04 21:55:13','2016-09-04 21:55:13'),(5,'菜刀','[/菜刀]','/uploads/emojis/1473054937.gif','2016-09-04 21:55:37','2016-09-04 21:55:37'),(6,'差劲','[/差劲]','/uploads/emojis/1473054973.gif','2016-09-04 21:56:13','2016-09-04 21:56:13'),(7,'cheer','[/cheer]','/uploads/emojis/1473054996.gif','2016-09-04 21:56:36','2016-09-04 21:56:36'),(8,'虫','[/虫]','/uploads/emojis/1473055024.gif','2016-09-04 21:57:04','2016-09-04 21:57:04'),(9,'打','[/打]','/uploads/emojis/1473055045.gif','2016-09-04 21:57:25','2016-09-04 21:57:25'),(10,'大便','[/大便]','/uploads/emojis/1473055066.gif','2016-09-04 21:57:46','2016-09-04 21:57:46'),(11,'大兵','[/大兵]','/uploads/emojis/1473055094.gif','2016-09-04 21:58:14','2016-09-04 21:58:14'),(12,'大叫','[/大叫]','/uploads/emojis/1473055212.gif','2016-09-04 22:00:12','2016-09-04 22:00:12'),(13,'大哭','[/大哭]','/uploads/emojis/1473055261.gif','2016-09-04 22:01:01','2016-09-04 22:01:01'),(14,'蛋糕','[/蛋糕]','/uploads/emojis/1473055283.gif','2016-09-04 22:01:23','2016-09-04 22:01:23'),(15,'大怒','[/大怒]','/uploads/emojis/1473055317.gif','2016-09-04 22:01:57','2016-09-04 22:01:57'),(16,'刀','[/刀]','/uploads/emojis/1473055342.gif','2016-09-04 22:02:22','2016-09-04 22:16:19'),(17,'得意','[/得意]','/uploads/emojis/1473056236.gif','2016-09-04 22:17:16','2016-09-04 22:17:16'),(18,'凋谢','[/凋谢]','/uploads/emojis/1473056263.gif','2016-09-04 22:17:43','2016-09-04 22:17:43'),(19,'饥饿','[/饥饿]','/uploads/emojis/1473056309.gif','2016-09-04 22:18:29','2016-09-04 22:18:29'),(20,'发呆','[/发呆]','/uploads/emojis/1473056338.gif','2016-09-04 22:18:58','2016-09-04 22:18:58'),(21,'发抖','[/发抖]','/uploads/emojis/1473056380.gif','2016-09-04 22:19:40','2016-09-04 22:19:40'),(22,'饭','[/饭]','/uploads/emojis/1473056411.gif','2016-09-04 22:20:11','2016-09-04 22:20:11'),(23,'飞吻','[/飞吻]','/uploads/emojis/1473056431.gif','2016-09-04 22:20:31','2016-09-04 22:20:31'),(24,'奋斗','[/奋斗]','/uploads/emojis/1473056455.gif','2016-09-04 22:20:55','2016-09-04 22:20:55'),(26,'尴尬','[/尴尬]','/uploads/emojis/1473056841.gif','2016-09-04 22:27:21','2016-09-04 22:27:21'),(27,'勾引','[/勾引]','/uploads/emojis/1473056878.gif','2016-09-04 22:27:58','2016-09-04 22:27:58'),(28,'鼓掌','[/鼓掌]','/uploads/emojis/1473056902.gif','2016-09-04 22:28:22','2016-09-04 22:28:22'),(29,'哈哈','[/哈哈]','/uploads/emojis/1473056922.gif','2016-09-04 22:28:42','2016-09-04 22:28:42'),(30,'害羞','[/害羞]','/uploads/emojis/1473056945.gif','2016-09-04 22:29:05','2016-09-04 22:29:05'),(31,'哈欠','[/哈欠]','/uploads/emojis/1473056969.gif','2016-09-04 22:29:29','2016-09-04 22:29:29'),(32,'花','[/花]','/uploads/emojis/1473056987.gif','2016-09-04 22:29:47','2016-09-04 22:29:47'),(33,'坏笑','[/坏笑]','/uploads/emojis/1473057007.gif','2016-09-04 22:30:07','2016-09-04 22:30:07'),(34,'惊恐','[/惊恐]','/uploads/emojis/1473057038.gif','2016-09-04 22:30:38','2016-09-04 22:30:38'),(35,'惊讶','[/惊讶]','/uploads/emojis/1473057055.gif','2016-09-04 22:30:55','2016-09-04 22:30:55'),(36,'咖啡','[/咖啡]','/uploads/emojis/1473057081.gif','2016-09-04 22:31:21','2016-09-04 22:31:21'),(37,'可爱','[/可爱]','/uploads/emojis/1473057098.gif','2016-09-04 22:31:38','2016-09-04 22:31:38'),(38,'可怜','[/可怜]','/uploads/emojis/1473057124.gif','2016-09-04 22:32:04','2016-09-04 22:32:04'),(39,'回头','[/回头]','/uploads/emojis/1473057156.gif','2016-09-04 22:32:36','2016-09-04 22:32:36'),(40,'磕头','[/磕头]','/uploads/emojis/1473057182.gif','2016-09-04 22:33:02','2016-09-04 23:36:27'),(41,'kiss','[/kiss]','/uploads/emojis/1473057210.gif','2016-09-04 22:33:30','2016-09-04 22:33:30'),(42,'酷','[/酷]','/uploads/emojis/1473057237.gif','2016-09-04 22:33:57','2016-09-04 22:33:57'),(43,'冷汗','[/冷汗]','/uploads/emojis/1473057273.gif','2016-09-04 22:34:34','2016-09-04 22:34:34'),(44,'流汗','[/流汗]','/uploads/emojis/1473057290.gif','2016-09-04 22:34:50','2016-09-04 22:34:50'),(45,'流泪','[/流泪]','/uploads/emojis/1473057323.gif','2016-09-04 22:35:23','2016-09-04 22:35:23'),(46,'佩服','[/佩服]','/uploads/emojis/1473057352.gif','2016-09-04 22:35:52','2016-09-04 22:35:52'),(47,'ok','[/ok]','/uploads/emojis/1473057368.gif','2016-09-04 22:36:08','2016-09-04 22:36:08'),(48,'强','[/强]','/uploads/emojis/1473057407.gif','2016-09-04 22:36:47','2016-09-04 22:36:47'),(49,'亲亲','[/亲亲]','/uploads/emojis/1473057432.gif','2016-09-04 22:37:12','2016-09-04 22:37:12'),(50,'色','[/色]','/uploads/emojis/1473057457.gif','2016-09-04 22:37:37','2016-09-04 22:37:37'),(51,'偷笑','[/偷笑]','/uploads/emojis/1473057495.gif','2016-09-04 22:38:15','2016-09-04 22:38:15'),(52,'吐','[/吐]','/uploads/emojis/1473057517.gif','2016-09-04 22:38:37','2016-09-04 22:38:37'),(53,'挖鼻','[/挖鼻]','/uploads/emojis/1473057553.gif','2016-09-04 22:39:13','2016-09-04 22:39:13'),(54,'阴险','[/阴险]','/uploads/emojis/1473057591.gif','2016-09-04 22:39:51','2016-09-04 22:39:51'),(55,'右哼哼','[/右哼哼]','/uploads/emojis/1473057624.gif','2016-09-04 22:40:24','2016-09-04 22:40:24'),(56,'左哼哼','[/左哼哼]','/uploads/emojis/1473057643.gif','2016-09-04 22:40:43','2016-09-04 22:40:43'),(57,'晕','[/晕]','/uploads/emojis/1473057666.gif','2016-09-04 22:41:06','2016-09-04 22:41:06'),(58,'再见','[/再见]','/uploads/emojis/1473057683.gif','2016-09-04 22:41:23','2016-09-04 22:41:23'),(59,'抓狂','[/抓狂]','/uploads/emojis/1473057708.gif','2016-09-04 22:41:49','2016-09-04 22:41:49'),(60,'握手','[/握手]','/uploads/emojis/1473057740.gif','2016-09-04 22:42:20','2016-09-04 22:42:20'),(61,'献吻','[/献吻]','/uploads/emojis/1473057834.gif','2016-09-04 22:43:54','2016-09-04 22:43:54');
/*!40000 ALTER TABLE `emojis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favour_counts`
--

DROP TABLE IF EXISTS `favour_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favour_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL COMMENT '评论id',
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '点过赞或踩过的ip',
  `choices` enum('0','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '1是赞0是踩',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favour_counts`
--

LOCK TABLES `favour_counts` WRITE;
/*!40000 ALTER TABLE `favour_counts` DISABLE KEYS */;
INSERT INTO `favour_counts` VALUES (1,8,'127.0.0.1','1','2016-09-09 02:41:52','2016-09-09 02:41:52');
/*!40000 ALTER TABLE `favour_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favours`
--

DROP TABLE IF EXISTS `favours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favours` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL COMMENT '评论的id',
  `favours` int(11) NOT NULL DEFAULT '0' COMMENT '点赞的数量',
  `treads` int(11) NOT NULL DEFAULT '0' COMMENT '踩得数量',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favours`
--

LOCK TABLES `favours` WRITE;
/*!40000 ALTER TABLE `favours` DISABLE KEYS */;
/*!40000 ALTER TABLE `favours` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_photos`
--

LOCK TABLES `h_photos` WRITE;
/*!40000 ALTER TABLE `h_photos` DISABLE KEYS */;
INSERT INTO `h_photos` VALUES (13,1,'/uploads/rooms/2016-08-10/1470793737Zn5MVb.png','2016-08-09 17:48:57','2016-08-09 17:48:57'),(14,1,'/uploads/rooms/2016-08-10/14707990975C1VDQ.jpeg','2016-08-09 19:18:17','2016-08-09 19:18:17'),(15,1,'/uploads/rooms/2016-08-15/14712504586EU64j.jpeg','2016-08-15 00:40:58','2016-08-15 00:40:58'),(16,2,'/uploads/rooms/2016-09-06/1473124062Tnjgmx.jpeg','2016-09-05 17:07:42','2016-09-05 17:07:42'),(17,3,'/uploads/rooms/2016-09-06/1473134951zsaZCf.jpeg','2016-09-05 20:09:11','2016-09-05 20:09:11'),(18,3,'/uploads/rooms/2016-09-06/1473134951tD4gNv.jpeg','2016-09-05 20:09:11','2016-09-05 20:09:11'),(19,3,'/uploads/rooms/2016-09-06/1473134951EmkePk.jpeg','2016-09-05 20:09:11','2016-09-05 20:09:11'),(20,3,'/uploads/rooms/2016-09-06/14731349510rdDar.jpeg','2016-09-05 20:09:11','2016-09-05 20:09:11');
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
  `position_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '地图路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `houses`
--

LOCK TABLES `houses` WRITE;
/*!40000 ALTER TABLE `houses` DISABLE KEYS */;
INSERT INTO `houses` VALUES (1,'群芳三园','北京市通州区梨园',90,'三室两厅',2000,1,1,'','地铁附近，交通便利，升值好',0,'2016-08-08 00:40:20','2016-09-05 20:35:03',NULL,NULL,NULL,'38楼3单元304','http://yuntu.amap.com/share/bMFBVf'),(2,'桃花岛','北京市通州区梨园',90,'两室一厅',5000000,2,1,'','价格实惠，交通便利，升值少',1,'2016-08-08 01:29:11','2016-09-05 19:41:44',12000,0.05,20000,'3楼3单元202','http://yuntu.amap.com/share/bMFBVf'),(3,'桃花岛','北京市 通州区 梨园',120,'三室两厅',3200,1,1,'','临近地铁，交通便利，升值好',1,'2016-09-05 20:06:24','2016-09-05 20:46:34',NULL,NULL,NULL,'21楼2单元202','http://yuntu.amap.com/share/bMFBVf');
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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_07_27_094510_create_houses_table',1),('2016_07_27_101514_create_h_photos_table',1),('2016_07_28_030154_create_categories_table',1),('2016_07_28_042234_create_resources_table',1),('2016_07_28_043630_create_comments_table',1),('2016_07_28_044430_create_scans_table',1),('2016_07_28_094113_entrust_setup_tables',1),('2016_07_29_031518_create_notifications_table',1),('2016_08_01_093503_add_time_to_users_table',1),('2016_08_05_020951_create_posts_table',2),('2016_08_05_021010_create_albums_table',3),('2016_08_05_070954_add_type_to_permissions_table',4),('2016_08_08_030401_add_vote_to_houses_table',5),('2016_08_08_070303_add_room_name_to_houses_table',6),('2016_08_16_011544_add_author_to_resources_table',7),('2016_08_16_025243_modify_notifications_table',8),('2016_08_16_045007_modify_resources_table',9),('2016_08_16_064729_modify_notifications_table',10),('2016_09_05_045529_create_emojis_table',11),('2016_09_06_030845_add_position_url_to_hoses_tables',12),('2016_09_09_083009_create_favours_table',13),('2016_09_09_084737_create_favour_counts_table',13),('2016_09_13_070453_create_pdfs_table',14);
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
  `is_read` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否被查看',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `resource_id` int(11) DEFAULT NULL COMMENT '视频，音频id',
  `album_id` int(11) DEFAULT NULL COMMENT '相册的id',
  `type` tinyint(4) NOT NULL COMMENT '资源类型',
  `modify_type` int(11) NOT NULL COMMENT '操作类型,添加为1，编辑2，删除3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,1,'更新了音频《marry you》',0,'2016-08-19 00:40:02','2016-08-19 00:40:02',19,0,2,2),(2,1,'删除了音频《演员》',0,'2016-08-19 01:51:21','2016-08-19 01:51:21',20,0,2,3);
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
-- Table structure for table `pdfs`
--

DROP TABLE IF EXISTS `pdfs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pdfs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '上传文件标题',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文件保存路径',
  `user_id` int(11) NOT NULL COMMENT '上传的用户',
  `pid` int(11) NOT NULL COMMENT '板块的id',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pdfs`
--

LOCK TABLES `pdfs` WRITE;
/*!40000 ALTER TABLE `pdfs` DISABLE KEYS */;
INSERT INTO `pdfs` VALUES (1,'git','',0,0,NULL,'2016-09-13 01:50:04','2016-09-13 01:50:04'),(2,'git','',0,0,NULL,'2016-09-13 01:50:30','2016-09-13 01:50:30');
/*!40000 ALTER TABLE `pdfs` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'php',NULL,0,0,NULL,'2016-09-12 19:11:53','2016-09-12 19:11:53'),(2,'linux',NULL,0,0,NULL,'2016-09-12 19:12:12','2016-09-12 19:12:12'),(4,'git',NULL,0,0,NULL,'2016-09-12 19:12:43','2016-09-13 02:26:49'),(5,'常用的git命令','<p>git status //查看本地仓库状态</p><p>git log //查看提交记录</p><p>git add -A //添加所有编辑</p><p>git commit -am “name” //提交添加内容</p><p>git pull //同步远端仓库</p><p>git push //发布本地仓库</p><p><img class=\"fr-fin\" data-fr-image-preview=\"false\" alt=\"Image title\" src=\"http://i.froala.com/download/16195e8da3f75d6f977ecc2f0d303df6153429fe.jpg?1473745553\" width=\"300\"></p><p><br></p>',1,4,NULL,'2016-09-12 20:44:02','2016-09-13 00:12:05');
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
  `size` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '作者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
INSERT INTO `resources` VALUES (16,1,5,1,'狮子座','啦啦啦','/uploads/videos/2016-08-16/1471338192oxa6ui.jpg','/uploads/videos/2016-08-16/1471337937Di3EhU.m4v',129,33050773,'2016-08-16 00:59:02','2016-08-18 01:32:40','2016-08-18 01:32:40','杨利超嘿嘿'),(17,1,5,1,'哈哈','哈哈','/uploads/videos/2016-08-18/1471483875rYF6ZX.jpeg','/uploads/videos/2016-08-18/14714838690FdJey.m4v',129,33050773,'2016-08-17 17:31:15','2016-08-17 17:31:15',NULL,'杨利超'),(18,1,5,1,'leo','哈哈','/uploads/videos/2016-08-18/1471490395y7olcs.jpeg','/uploads/videos/2016-08-18/1471490387m1jLJa.mp4',130,11476090,'2016-08-17 19:19:55','2016-08-17 19:19:55',NULL,'嘿嘿'),(19,1,6,2,'marry you','英文歌','/uploads/musics/2016-08-19/1471596002ZXrsaQ.jpg','/uploads/musics/2016-08-19/1471578877vZY039.mp3',230,3681781,'2016-08-18 20:03:19','2016-08-19 01:49:37',NULL,'Bruno Mars'),(20,1,6,2,'演员','薛之谦','/uploads/musics/2016-08-19/1471579921hh5Wyx.jpg','/uploads/musics/2016-08-19/1471579887cdwMyv.mp3',261,4179360,'2016-08-18 20:12:01','2016-08-19 01:51:20','2016-08-19 01:51:20','薛之谦'),(21,1,5,1,'哈哈','嘿嘿','/uploads/videos/2016-08-19/14715799858YIiWu.png','/uploads/videos/2016-08-19/1471579968Crr5am.mp4',130,11476090,'2016-08-18 20:13:05','2016-08-18 20:13:05',NULL,'哎');
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
INSERT INTO `users` VALUES (1,'admin','529755212@qq.com','$2y$10$J5lSCuwSYexJpK6owjpWQuf/N/3L5TSXBndBuWuqa1mkqUAyr9NEC','qCVDEOobZK11IIpYHe0VKbT6Jk1oE7WRXZYqti9PmgmUO7Mbd7CUz7VaCeWf',NULL,0,NULL,NULL,NULL,NULL,NULL,'::1',1,'0000-00-00 00:00:00','2016-09-12 18:04:32',1473732272),(2,'杨利超','943148389@qq.com','$2y$10$Qcn5bdO9sCuINl5VC/ShF.fJfRmvridepAigmikEntE8yl5fWTu.i','norcVYOcJAb0yHKhraKj5SDrkMOM5zVLFLMvkgp0z5EUq8ye9wBoR3s14IKC','',0,'',NULL,NULL,NULL,NULL,'::1',1,'2016-08-04 00:28:29','2016-08-04 22:16:36',1470377796),(3,'张三','529755211@qq.com','$2y$10$BdqpAj.M6LIr9DxBTmpkm.qc0KHXGtjKTG1Hg0nyBmbyf6dP8dIlS',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 00:29:45','2016-08-04 18:37:50',0),(4,'张三','529755213@qq.com','$2y$10$R1OcsylHHNztYMiv4p.CHux4xxLDLMIinkulYIS60VHHLMDWKS47G',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 00:34:02','2016-08-04 00:34:02',0),(5,'张三丰','97654321@qq.com','$2y$10$JtfLUMVz/DwMo3rLevIbpOAxlPCywFRftOdOkJ2emWStIkHGjqy4K',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:40:51','2016-08-04 19:41:08',0),(6,'李四','123@163.com','$2y$10$/shEOniHMDLPFlIIgVkA0uZwl0f31vvbQVC2M14zONbSPR9J4SwFW',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:49:35','2016-08-04 19:49:35',0),(7,'王五','1234@163.com','$2y$10$b0GvL0BLutSEs.51pxr70ePzPORutlrRue9tH2aQ0U1kLFpAvQUHK',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:49:57','2016-08-04 19:49:57',0),(8,'赵六','12345@163.com','$2y$10$iVOvaQTn5t7FwHY4QOncD.hShRkMuOghDKTHioR/VPJgwmceBtveq',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:50:23','2016-08-04 19:50:23',0),(9,'王三','123456@163.com','$2y$10$DBxiXzrdFd44NAJFh6TjSO4EuOjO0A6xx2alfu5awGfoPBnRPWR6m',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:50:52','2016-08-04 19:50:52',0),(10,'张三','65443@qq.com','$2y$10$4u9DF/KE/04AotNIw8HgkuvkYdwqOLg/KXI78l.jiJRYtaVHmjYR6',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,1,'2016-08-04 19:55:48','2016-08-07 18:48:22',0),(12,'哈哈','234234@qq.com','$2y$10$xlp47Wh4HIwrZO21OAw0LeIOJj7sEd6KCfoUpec8f0pVY0.MnuA1i',NULL,'',0,'',NULL,NULL,NULL,NULL,NULL,0,'2016-08-04 20:25:34','2016-08-04 20:25:34',0);
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

-- Dump completed on 2016-09-13 18:27:43
