-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: laravel10
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Table structure for table `admin_api`
--

DROP TABLE IF EXISTS `admin_api`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_api` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `api_name` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '接口名称',
  `api_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'api' COMMENT '类型(目录 dir 接口 api)',
  `api_path` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '接口路径',
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '接口请求方式',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `create_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `delete_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='后台接口表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_api`
--

LOCK TABLES `admin_api` WRITE;
/*!40000 ALTER TABLE `admin_api` DISABLE KEYS */;
INSERT INTO `admin_api` VALUES (1,4,'接口管理','dir',NULL,NULL,0,1,NULL,'lorenwe',NULL,'2024-05-08 23:53:03',0),(2,1,'接口列表','api','/admin/api/list','POST',0,1,NULL,NULL,NULL,NULL,0),(3,1,'接口新增','api','/admin/api/add','POST',1,1,'lorenwe','lorenwe','2024-05-08 22:51:48','2024-05-09 00:15:31',0),(4,0,'系统设置','dir',NULL,NULL,1,1,'lorenwe','lorenwe','2024-05-08 23:52:51','2024-05-23 09:46:30',0),(5,1,'接口编辑','api','/admin/api/edit','POST',1,1,'lorenwe','lorenwe','2024-05-08 23:54:05','2024-05-09 00:15:22',0),(6,1,'接口删除','api','/admin/api/del','POST',1,1,'lorenwe','lorenwe','2024-05-08 23:54:30','2024-05-09 00:15:13',0),(7,4,'菜单管理','dir',NULL,NULL,1,1,'lorenwe',NULL,'2024-05-09 00:06:38','2024-05-09 00:06:38',0),(8,4,'国际化','dir',NULL,NULL,1,1,'lorenwe',NULL,'2024-05-09 00:06:49','2024-05-09 00:06:49',0),(9,4,'角色管理','dir',NULL,NULL,1,1,'lorenwe',NULL,'2024-05-09 00:07:05','2024-05-09 00:07:05',0),(10,4,'后台用户管理','dir',NULL,NULL,1,1,'lorenwe','lorenwe','2024-05-09 00:07:19','2024-05-09 00:17:05',0),(11,7,'菜单添加','api','/menu/add','POST',1,1,'lorenwe',NULL,'2024-05-09 00:07:59','2024-05-09 00:07:59',0),(12,7,'菜单编辑','api','/menu/edit','POST',1,1,'lorenwe',NULL,'2024-05-09 00:08:22','2024-05-09 00:08:22',0),(13,7,'菜单删除','api','/menu/del','POST',1,1,'lorenwe',NULL,'2024-05-09 00:08:43','2024-05-09 00:08:43',0),(14,7,'菜单列表','api','/menu/list','POST',1,1,'lorenwe','lorenwe','2024-05-09 00:09:04','2024-05-23 06:33:36',0),(15,8,'国际化列表','api','/language/list','POST',1,1,'lorenwe',NULL,'2024-05-09 00:09:55','2024-05-09 00:09:55',0),(16,8,'国际化添加','api','/language/add','POST',1,1,'lorenwe',NULL,'2024-05-09 00:10:16','2024-05-09 00:10:16',0),(17,8,'国际化编辑','api','/language/edit','POST',1,1,'lorenwe',NULL,'2024-05-09 00:10:35','2024-05-09 00:10:35',0),(18,8,'国际化删除','api','/language/del','POST',1,1,'lorenwe',NULL,'2024-05-09 00:10:52','2024-05-09 00:10:52',0),(19,9,'角色列表','api','/role/list','POST',1,1,'lorenwe',NULL,'2024-05-09 00:11:44','2024-05-09 00:11:44',0),(20,9,'角色添加','api','/role/add','POST',1,1,'lorenwe',NULL,'2024-05-09 00:12:02','2024-05-09 00:12:02',0),(21,9,'角色编辑','api','/role/edit','POST',1,1,'lorenwe',NULL,'2024-05-09 00:12:19','2024-05-09 00:12:19',0),(22,9,'角色删除','api','/role/del','POST',1,1,'lorenwe',NULL,'2024-05-09 00:12:39','2024-05-09 00:12:39',0),(23,9,'角色状态修改','api','/role/state','POST',1,1,'lorenwe','lorenwe','2024-05-09 00:13:12','2024-05-09 00:13:17',0),(24,0,'公共接口','dir',NULL,NULL,1,1,'lorenwe',NULL,'2024-05-09 00:13:46','2024-05-09 00:13:46',0),(25,24,'后台用户菜单','api','/admin/user/menu','POST',1,1,'lorenwe','lorenwe','2024-05-09 00:14:09','2024-05-23 06:38:17',0),(26,1,'接口状态修改','api','/admin/api/state','POST',1,1,'lorenwe',NULL,'2024-05-09 00:14:59','2024-05-09 00:14:59',0),(28,10,'后台用户列表','api','/admin/user/list','POST',1,1,'lorenwe','lorenwe','2024-05-09 00:17:26','2024-05-09 18:39:21',0),(29,10,'后台用户添加','api','/admin/user/add','POST',1,1,'lorenwe',NULL,'2024-05-09 00:17:55','2024-05-09 00:17:55',0),(30,10,'后台用户编辑','api','/admin/user/edit','POST',1,1,'lorenwe',NULL,'2024-05-09 00:18:16','2024-05-09 00:18:16',0),(31,10,'后台用户删除','api','/admin/user/del','POST',1,1,'lorenwe',NULL,'2024-05-09 00:18:36','2024-05-09 00:18:36',0),(32,10,'后台用户状态修改','api','/admin/user/state','POST',1,1,'lorenwe',NULL,'2024-05-09 00:19:07','2024-05-09 00:19:07',0),(33,24,'后台用户头像上传','api','/admin/user/avatar','POST',1,1,'lorenwe','lorenwe','2024-05-09 00:19:48','2024-05-23 03:34:48',0),(37,24,'后台用户权限标识','api','/admin/user/permissions','POST',1,1,'lorenwe',NULL,'2024-05-23 06:35:44','2024-05-23 06:35:44',0),(38,24,'后台用户信息','api','/admin/user/info','POST',1,1,'lorenwe',NULL,'2024-05-23 06:38:55','2024-05-23 06:38:55',0),(39,24,'后台用户验证密码','api','/check/pwd','POST',1,1,'lorenwe',NULL,'2024-05-23 06:40:15','2024-05-23 06:40:15',0),(40,24,'退出登录','api','/logout','POST',1,1,'lorenwe',NULL,'2024-05-23 06:40:34','2024-05-23 06:40:34',0);
/*!40000 ALTER TABLE `admin_api` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_casbin_rules`
--

DROP TABLE IF EXISTS `admin_casbin_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_casbin_rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ptype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v0` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_casbin_rules`
--

LOCK TABLES `admin_casbin_rules` WRITE;
/*!40000 ALTER TABLE `admin_casbin_rules` DISABLE KEYS */;
INSERT INTO `admin_casbin_rules` VALUES (85,'p','roles_11','/admin/user/menu','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(86,'p','roles_11','/admin/user/avatar','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(87,'p','roles_11','/admin/user/permissions','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(88,'p','roles_11','/admin/user/info','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(89,'p','roles_11','/check/pwd','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(90,'p','roles_11','/logout','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(91,'p','roles_11','/admin/api/list','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(92,'p','roles_11','/admin/api/add','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(93,'p','roles_11','/admin/api/edit','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(94,'p','roles_11','/admin/api/del','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(95,'p','roles_11','/menu/add','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(96,'p','roles_11','/menu/edit','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(97,'p','roles_11','/menu/del','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(98,'p','roles_11','/menu/list','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(99,'p','roles_11','/language/list','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(100,'p','roles_11','/language/add','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(101,'p','roles_11','/language/edit','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(102,'p','roles_11','/language/del','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(103,'p','roles_11','/role/list','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(104,'p','roles_11','/role/add','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(105,'p','roles_11','/role/edit','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(106,'p','roles_11','/role/del','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(107,'p','roles_11','/role/state','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(108,'p','roles_11','/admin/api/state','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(109,'p','roles_11','/admin/user/list','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(110,'p','roles_11','/admin/user/add','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(111,'p','roles_11','/admin/user/edit','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(112,'p','roles_11','/admin/user/del','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(113,'p','roles_11','/admin/user/state','POST',NULL,NULL,NULL,'2024-05-23 09:38:55','2024-05-23 09:38:55'),(177,'p','roles_9','/admin/user/menu','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(178,'p','roles_9','/admin/user/avatar','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(179,'p','roles_9','/admin/user/permissions','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(180,'p','roles_9','/admin/user/info','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(181,'p','roles_9','/check/pwd','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(182,'p','roles_9','/logout','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(183,'p','roles_9','/menu/add','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(184,'p','roles_9','/menu/edit','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(185,'p','roles_9','/menu/del','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(186,'p','roles_9','/menu/list','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(187,'p','roles_9','/language/list','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(188,'p','roles_9','/role/list','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(189,'p','roles_9','/role/add','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(190,'p','roles_9','/role/edit','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14'),(191,'p','roles_9','/role/del','POST',NULL,NULL,NULL,'2024-05-24 03:10:14','2024-05-24 03:10:14');
/*!40000 ALTER TABLE `admin_casbin_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role`
--

DROP TABLE IF EXISTS `admin_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
  `role_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `describe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '描述',
  `create_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `delete_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role`
--

LOCK TABLES `admin_role` WRITE;
/*!40000 ALTER TABLE `admin_role` DISABLE KEYS */;
INSERT INTO `admin_role` VALUES (9,'测试权限','test_access',1,1,'测试权限功能专用','lorenwe','lorenwe','2024-04-29 22:40:52','2024-05-23 07:54:00',0),(11,'超级管理员','super_admin',0,1,'超级管理员拥有系统所有权限','lorenwe','lorenwe','2024-04-29 23:42:55','2024-05-24 02:42:18',0);
/*!40000 ALTER TABLE `admin_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_menu`
--

DROP TABLE IF EXISTS `admin_role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_role_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned NOT NULL COMMENT '角色id',
  `menu_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '前端权限',
  `menu_all_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '前端权限(包含父级id)',
  `api_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '接口权限',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='角色菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,11,'1,8,13,20,24,28,9,10,11,12,14,15,16,17,21,22,23,36,25,26,27,35,29,30,31,33,34,32','1,8,13,20,24,28,9,10,11,12,14,15,16,17,21,22,23,36,25,26,27,35,29,30,31,33,34,32','25,33,37,38,39,40,2,3,3,5,6,11,11,12,13,14,14,15,16,16,17,18,19,20,21,22,23,26,28,29,30,31,32'),(2,1,'8,9,10,11,12','1,8,9,10,11,12',''),(3,9,'21,22,23,32,8,9,10,11,12','1,20,21,22,23,32,8,9,10,11,12','25,33,37,38,39,40,11,11,12,13,14,14,15,19,20,21,22');
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '昵称',
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '角色表id',
  `role_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '角色名称',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `age` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '年龄',
  `city` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '城市',
  `address` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '地址',
  `motto` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '座右铭',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机号',
  `sex` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '性别',
  `tags` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '标签',
  `login_last_ip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最后登录IP',
  `login_last_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `login_num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `delete_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'lorenwe','http://127.0.0.1:8000/uploads/avatar/20240513090542-3984.png','lorenwe','$2y$12$9FtN4tFIHIfjJIKyaqrWy.wkuehsOgduvzSS/vx7gxvxr2oczhkmS','ZcSiq33ZyP',11,'超级管理员',99,1,1,'14,1404,140406','详细地址12312','座右铭','18702530686','1','详细地址,详细,1231231',NULL,NULL,0,'2024-04-14 23:26:14','2024-05-23 09:46:19',0),(2,NULL,'http://127.0.0.1:8000/uploads/avatar/20240508091922-3625.png','test','$2y$12$VHNe2h9QTWMgnds1BWnck.G1hUj6Mu2cxAHU5xxJ38JojLeIMdFbq',NULL,1,'管理员',20,1,18,'12,1201,120103','qweqwrwqrwq','sadwadwq','18702530686','1','sda',NULL,NULL,0,'2024-05-08 01:21:50','2024-05-23 07:54:47',1716450887),(3,NULL,'http://127.0.0.1:8000/uploads/avatar/20240513081424-5560.png','lorenwe2','$2y$12$L3uWT2rjLmnoT0CeTTlMvuFdJ7SKtz2rnyqTBJ4ZUrPVPqwsg7C0u',NULL,9,'测试权限',1,1,18,'32,3202,320205','safsadsa','asdas','18702530686','1','sad,xzcs',NULL,NULL,0,'2024-05-13 00:14:38','2024-05-23 07:55:15',0);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `language` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `name` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `zh-CN` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '中文',
  `en-US` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '英文',
  `ja-JP` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '日文',
  `zh-TW` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '繁体',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `create_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `delete_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='语言表（国际化）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language`
--

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES (10,0,0,'components',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-16 01:25:08','2024-04-16 01:25:08',0),(11,10,0,'UploadImage',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-16 01:26:08','2024-04-16 01:26:08',0),(12,11,0,'accept','只能上传 {type} 文件！','Only {type} files can be uploaded!','{type}ファイルのみアップロードできます!','只能上傳 {type} 文件！',NULL,'lorenwe',NULL,'2024-04-16 01:27:29','2024-04-16 01:27:29',0),(13,11,0,'maxSize','图片大小限制在{size}MB以内!','Image size is limited to {size}MB!','画像サイズは{size}MBに制限します!','圖片大小限製在{size}MB以內!',NULL,'lorenwe',NULL,'2024-04-16 01:29:00','2024-04-16 01:29:00',0),(14,10,0,'BasicLayout',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-16 01:30:46','2024-04-16 01:30:46',0),(15,14,0,'ActionButtons',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-16 01:32:05','2024-04-16 01:32:05',0),(16,15,0,'document','文档','Document','ドキュメント','文檔',NULL,'lorenwe',NULL,'2024-04-16 01:33:43','2024-04-16 01:33:43',0),(17,15,0,'github-issues','Github Issues','Github Issues','Github Issuesです','Github Issues',NULL,'lorenwe',NULL,'2024-04-16 01:34:46','2024-04-16 01:34:46',0),(18,15,0,'refresh','刷新页面','Refresh page','刷新页面','刷新頁面',NULL,'lorenwe',NULL,'2024-04-16 01:36:07','2024-04-16 01:36:07',0),(19,14,0,'Logout','退出登录','Log out','ログアウトします','退出登錄',NULL,'lorenwe',NULL,'2024-04-16 01:38:23','2024-04-16 01:38:23',0),(20,14,0,'LockScreen','锁定屏幕','Lock screen','ロック画面です','鎖定屏幕',NULL,'lorenwe',NULL,'2024-04-16 01:39:32','2024-04-16 01:39:32',0),(21,20,0,'error','密码错误','Password Error','パスワードの誤りです','密碼錯誤',NULL,'lorenwe',NULL,'2024-04-16 01:41:12','2024-04-16 01:41:12',0),(22,20,0,'access-system','进入系统','Access System','システムに入ります','進入系統',NULL,'lorenwe',NULL,'2024-04-16 01:42:32','2024-04-16 01:42:32',0),(23,20,0,'password','锁屏密码','Screen lock password','スクリーンロックのパスワードです','鎖屏密碼',NULL,'lorenwe',NULL,'2024-04-16 01:43:51','2024-04-16 01:43:51',0),(24,14,0,'LockSleep',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-16 01:45:33','2024-04-16 01:45:33',0),(25,24,0,'title','长时间未操作,屏幕已锁定','If no operation is performed for a long time, the screen is locked','長時間操作しておらず、画面がロックされています','長時間未操作,屏幕已鎖定',NULL,'lorenwe',NULL,'2024-04-16 01:46:43','2024-04-16 01:46:43',0),(26,24,0,'password','密码','Password','パスワード','密碼',NULL,'lorenwe',NULL,'2024-04-16 01:48:10','2024-04-16 01:48:10',0),(27,26,0,'error','密码不正确，请重新输入!','Password is incorrect, please re-enter!','パスワードが正しくありません。入力し直してください。','密碼不正確，請重新輸入!',NULL,'lorenwe',NULL,'2024-04-16 01:49:48','2024-04-16 01:49:48',0),(28,26,0,'placeholder','请输入用户密码','Please enter the user password','パスワードの入力をお願いします','請輸入用戶密碼',NULL,'lorenwe',NULL,'2024-04-16 01:50:37','2024-04-16 01:50:37',0),(29,14,0,'ExitFullScreen','退出全屏','ExitFullScreen','全画面から退出します','退出全屏',NULL,'lorenwe',NULL,'2024-04-16 01:53:04','2024-04-16 01:53:04',0),(30,14,0,'FullScreen','全屏','FullScreen','全般','全屏',NULL,'lorenwe',NULL,'2024-04-16 01:54:06','2024-04-16 01:54:06',0),(31,10,0,'TabsLayout',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-16 01:55:35','2024-04-16 01:55:35',0),(32,31,0,'close','至少要保留一个窗口','Keep at least one window','少なくとも1つは窓口を確保する','至少要保留一個窗口',NULL,'lorenwe',NULL,'2024-04-16 01:58:03','2024-04-16 01:58:03',0),(33,31,0,'right','关闭右侧','Close the Right','右側を閉じる','關閉右側',NULL,'lorenwe',NULL,'2024-04-16 01:59:19','2024-04-16 01:59:19',0),(34,31,0,'left','关闭左侧','Close the Left','左側を閉じる','關閉左側',NULL,'lorenwe',NULL,'2024-04-16 01:59:56','2024-04-16 01:59:56',0),(35,31,0,'others','关闭其它','Close the Other','その他を閉じる','關閉其它',NULL,'lorenwe',NULL,'2024-04-16 02:00:47','2024-04-16 02:00:47',0),(36,31,0,'refresh','重新加载','Refresh','再ロードします','重新加載',NULL,'lorenwe',NULL,'2024-04-16 02:01:56','2024-04-16 02:01:56',0),(37,10,0,'StrengthMeter',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-16 18:02:15','2024-04-16 18:02:15',0),(38,37,0,'very-strong','非常强','Very Strong','とても強いです','非常強',NULL,'lorenwe',NULL,'2024-04-16 18:04:06','2024-04-16 18:04:06',0),(39,37,0,'strong','强','Strong','ベスト','強',NULL,'lorenwe',NULL,'2024-04-16 18:05:14','2024-04-16 18:05:14',0),(40,37,0,'general','一般','General','一般','一般',NULL,'lorenwe',NULL,'2024-04-16 18:06:27','2024-04-16 18:06:27',0),(41,37,0,'weak','弱','weak','弱い','弱',NULL,'lorenwe',NULL,'2024-04-16 18:07:26','2024-04-16 18:07:26',0),(42,37,0,'very-weak','非常弱','Very Weak','とても弱いです','非常弱',NULL,'lorenwe',NULL,'2024-04-16 18:08:38','2024-04-16 18:08:38',0),(43,0,0,'menu',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-16 18:11:31','2024-04-16 18:11:31',0),(44,43,0,'system','系统设置','System Settings','システム設定','系統設置',NULL,'lorenwe',NULL,'2024-04-16 18:12:48','2024-04-16 18:12:48',0),(45,44,0,'menu-management','菜单管理','Menu Management','メニュー管理','菜單管理',NULL,'lorenwe',NULL,'2024-04-16 18:15:05','2024-04-16 18:15:05',0),(46,45,0,'add','新建','New','新築','新建',NULL,'lorenwe',NULL,'2024-04-16 18:16:08','2024-04-16 18:16:08',0),(47,45,0,'delete','删除','Delete','削除','刪除',NULL,'lorenwe',NULL,'2024-04-16 18:17:09','2024-04-16 18:17:09',0),(48,45,0,'edit','编辑','Edit','編集','編輯',NULL,'lorenwe',NULL,'2024-04-16 18:17:55','2024-04-16 18:17:55',0),(49,45,0,'add-child','添加子级','Add  Child','サブレベルを追加する','添加子級',NULL,'lorenwe',NULL,'2024-04-16 18:18:43','2024-04-16 18:18:43',0),(50,44,0,'internationalization','国际化','Internationalization','国際化','國際化',NULL,'lorenwe',NULL,'2024-04-16 18:20:04','2024-04-16 18:20:04',0),(51,50,0,'add','新建','New','新築','新建',NULL,'lorenwe',NULL,'2024-04-16 18:21:26','2024-04-16 18:21:26',0),(52,50,0,'delete','删除','Delete','削除','刪除',NULL,'lorenwe',NULL,'2024-04-16 18:22:00','2024-04-16 18:22:00',0),(53,50,0,'edit','编辑','Edit','編集','編輯',NULL,'lorenwe',NULL,'2024-04-16 18:22:40','2024-04-16 18:22:40',0),(54,50,0,'add-child','添加子级','Add Child','サブレベルを追加する','添加子级',NULL,'lorenwe',NULL,'2024-04-16 18:23:29','2024-04-16 18:23:29',0),(55,43,0,'dashboard','指示面板','Dashboard','指示パネル','指示面板',NULL,'lorenwe','lorenwe','2024-04-17 19:52:51','2024-04-17 19:53:53',0),(56,0,0,'global',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-17 23:43:32','2024-04-17 23:43:32',0),(57,56,0,'popconfirm',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-17 23:44:12','2024-04-17 23:44:12',0),(58,57,0,'title','确认执行此操作吗?','Bulletin confirm this operation?','公告はこの操作の実行を確認しますか?','確認執行此操作嗎?',NULL,'lorenwe',NULL,'2024-04-17 23:45:41','2024-04-17 23:45:41',0),(59,56,0,'flag',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-17 23:46:36','2024-04-17 23:46:36',0),(60,59,0,'no','否','No','いいえ','否',NULL,'lorenwe',NULL,'2024-04-17 23:47:39','2024-04-17 23:47:39',0),(61,59,0,'yes','是','Yes','そうです','是',NULL,'lorenwe',NULL,'2024-04-17 23:48:13','2024-04-17 23:48:13',0),(62,56,0,'button',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-17 23:49:19','2024-04-17 23:49:19',0),(63,62,0,'modify','修改','Modify','修正','修改',NULL,'lorenwe',NULL,'2024-04-17 23:50:36','2024-04-17 23:50:36',0),(64,62,0,'submit','提交','Submit','提出','提交',NULL,'lorenwe',NULL,'2024-04-17 23:51:28','2024-04-17 23:51:28',0),(65,62,0,'confirm','确认','Confirm','确认','確認',NULL,'lorenwe',NULL,'2024-04-17 23:52:19','2024-04-17 23:52:19',0),(66,56,0,'warm-tips','温馨提示','Warm Tips','暖かい ヒントです','溫馨提示',NULL,'lorenwe',NULL,'2024-04-17 23:53:46','2024-04-17 23:53:46',0),(67,56,0,'status','状态','Status','状态','狀態',NULL,'lorenwe',NULL,'2024-04-17 23:54:49','2024-04-17 23:54:49',0),(68,67,0,'disable','禁用','Disable','無効です','禁用',NULL,'lorenwe',NULL,'2024-04-17 23:55:51','2024-04-17 23:55:51',0),(69,67,0,'normal','正常','Normal','正常です','正常',NULL,'lorenwe',NULL,'2024-04-17 23:56:25','2024-04-17 23:56:25',0),(70,56,0,'form',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-17 23:57:08','2024-04-17 23:57:08',0),(71,70,0,'leader','负责人','Leader','責任者','負責人',NULL,'lorenwe',NULL,'2024-04-18 00:00:15','2024-04-18 00:00:15',0),(72,70,0,'placeholder','请输入','Please enter','入力してください','請輸入',NULL,'lorenwe',NULL,'2024-04-18 00:01:35','2024-04-18 00:01:35',0),(73,72,0,'upload','请上传','Please upload','アップロードお願いします','請上傳',NULL,'lorenwe',NULL,'2024-04-18 00:03:00','2024-04-18 00:03:00',0),(74,72,0,'seleted','请选择','Please Selected','選んでください','請選擇',NULL,'lorenwe',NULL,'2024-04-18 00:04:01','2024-04-18 00:04:01',0),(75,70,0,'parent_id','父级','Parent','父級','父級',NULL,'lorenwe',NULL,'2024-04-18 00:05:47','2024-04-18 00:05:47',0),(76,75,0,'tooltip','不选默认为顶级','Do not select the default as top-level','デフォルトをトップに選ばない','不選默認為頂級',NULL,'lorenwe',NULL,'2024-04-18 00:06:48','2024-04-18 00:06:48',0),(77,56,0,'message',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-18 00:07:49','2024-04-18 00:07:49',0),(78,77,0,'delete',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-18 00:08:14','2024-04-18 00:08:14',0),(79,78,0,'content','删除后无法恢复，请谨慎操作','The deletion cannot be restored. Exercise caution when performing this operation','削除しても元に戻りませんので、ご注意ください','刪除後無法恢復，請謹慎操作',NULL,'lorenwe',NULL,'2024-04-18 00:09:28','2024-04-18 00:09:28',0),(80,78,0,'title','您确认要删除这条数据吗？','Are you sure you want to delete this data?','このデータを削除することをご確認いただけますか?','您確認要刪除這條數據嗎？',NULL,'lorenwe',NULL,'2024-04-18 00:10:45','2024-04-18 00:10:45',0),(81,56,0,'table',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-18 00:12:00','2024-04-18 00:12:00',0),(82,81,0,'sort','排序','Sort','序列','排序',NULL,'lorenwe',NULL,'2024-04-18 00:13:27','2024-04-18 00:13:27',0),(83,82,0,'tooltip','排序越大，位置越靠前','The larger the order, the higher the position','順位が大きいほど上位に位置する','排序越大，位置越靠前',NULL,'lorenwe',NULL,'2024-04-18 00:14:43','2024-04-18 00:14:43',0),(84,81,0,'describe','描述','describe','描写','描述',NULL,'lorenwe',NULL,'2024-04-18 00:16:10','2024-04-18 00:16:10',0),(85,81,0,'created_time','创建时间','Creation time','作成時間','創建時間',NULL,'lorenwe',NULL,'2024-04-18 00:17:55','2024-04-18 00:17:55',0),(86,81,0,'operation','操作','operation','操作','操作',NULL,'lorenwe',NULL,'2024-04-18 00:18:35','2024-04-18 00:18:35',0),(87,0,0,'pages',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-18 00:19:37','2024-04-18 00:19:37',0),(88,87,0,'system',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-18 00:22:47','2024-04-18 00:22:47',0),(89,88,0,'internationalization','国际化','Internationalization','国際化','國際化',NULL,'lorenwe',NULL,'2024-04-18 00:24:08','2024-04-18 00:24:08',0),(90,89,0,'title','语言','language','言語','語言',NULL,'lorenwe',NULL,'2024-04-18 00:25:35','2024-04-18 00:25:35',0),(91,89,0,'name','国际化字段','Internationalization field','国際化フィールド','國際化字段',NULL,'lorenwe',NULL,'2024-04-18 00:43:08','2024-04-18 00:43:08',0),(92,89,0,'zh-CN','中文','Chinese','中文','中文',NULL,'lorenwe',NULL,'2024-04-18 00:44:08','2024-04-18 00:44:08',0),(93,89,0,'en-US','英文','English','英文','英文',NULL,'lorenwe',NULL,'2024-04-18 00:44:35','2024-04-18 00:44:35',0),(94,89,0,'ja-JP','日文','Japanese','日本语','日文',NULL,'lorenwe',NULL,'2024-04-18 00:45:08','2024-04-18 00:45:08',0),(95,89,0,'zh-TW','繁体中文','Traditional Chinese','繁体中国語','繁體中文',NULL,'lorenwe',NULL,'2024-04-18 00:45:57','2024-04-18 00:45:57',0),(101,88,1,'menu-management','菜单管理','Menu Maganement','メニュー管理','菜單管理',NULL,'lorenwe',NULL,'2024-04-22 23:12:45','2024-04-22 23:12:45',0),(102,101,1,'route-config','路由配置','Route Configuration','ルーティング配置です','路由配置',NULL,'lorenwe',NULL,'2024-04-22 23:14:17','2024-04-22 23:14:17',0),(103,101,1,'basic-info','基本信息','Basic Information','基本情報です','基本信息',NULL,'lorenwe',NULL,'2024-04-22 23:15:09','2024-04-22 23:15:09',0),(104,101,1,'access','菜单权限','Menu Permissions','メニュー けんげん 権限','菜單權限',NULL,'lorenwe',NULL,'2024-04-22 23:15:58','2024-04-22 23:15:58',0),(105,101,1,'headerTheme','顶部菜单主题','Top menu Theme','トップメニューテーマ','頂部菜單主題',NULL,'lorenwe',NULL,'2024-04-22 23:16:48','2024-04-22 23:16:48',0),(106,101,1,'navTheme','菜单主题','Menu Theme','メニューテーマ','菜單主題',NULL,'lorenwe',NULL,'2024-04-22 23:17:35','2024-04-22 23:17:35',0),(107,106,1,'light','亮色风格','Light','明るい色のスタイルです','亮色風格',NULL,'lorenwe',NULL,'2024-04-22 23:18:39','2024-04-22 23:18:39',0),(108,106,1,'dark','暗黑风格','Dark','ダークスタイルです','暗黑風格',NULL,'lorenwe',NULL,'2024-04-22 23:19:21','2024-04-22 23:19:21',0),(109,101,1,'fixSiderbar','固定菜单','Fixed menu','定番メニュー','固定菜單',NULL,'lorenwe',NULL,'2024-04-22 23:20:23','2024-04-22 23:20:23',0),(110,101,1,'fixedHeader','固定顶栏','Fixed the top bar','トップバーを固定する','固定頂欄',NULL,'lorenwe',NULL,'2024-04-22 23:21:07','2024-04-22 23:21:07',0),(111,101,1,'flatMenu','子项往上提','The subterms go up','子項を上にあげる','子項往上提',NULL,'lorenwe',NULL,'2024-04-22 23:22:12','2024-04-22 23:22:12',0),(112,101,1,'menuHeaderRender','显示菜单顶栏','Display the top bar of the menu','メニュートップを表示する','顯示菜單頂欄',NULL,'lorenwe',NULL,'2024-04-22 23:22:56','2024-04-22 23:22:56',0),(113,101,1,'menuRender','显示菜单','According to the menu','メニューを表示する','顯示菜單',NULL,'lorenwe',NULL,'2024-04-22 23:23:43','2024-04-22 23:23:43',0),(114,101,1,'footerRender','显示页脚','According to the footer','ページフットを表示する','顯示頁腳',NULL,'lorenwe',NULL,'2024-04-22 23:24:26','2024-04-22 23:24:26',0),(115,101,1,'headerRender','显示顶栏','According to the top bar','トップバーを表示する','顯示頂欄',NULL,'lorenwe',NULL,'2024-04-22 23:25:17','2024-04-22 23:25:17',0),(116,101,1,'hideInBreadcrumb','在面包屑中隐藏','Hide in the bread crumbs','パン屑の中に隠す','在面包屑中隱藏',NULL,'lorenwe',NULL,'2024-04-22 23:26:12','2024-04-22 23:26:12',0),(117,101,1,'hideInMenu','隐藏菜单','Hidden Menu','隠しメニュー','隱藏菜單',NULL,'lorenwe',NULL,'2024-04-22 23:26:54','2024-04-22 23:26:54',0),(118,101,1,'hideChildrenInMenu','隐藏子路由','Hide subroutes','子路を隠す','隱藏子路由',NULL,'lorenwe',NULL,'2024-04-22 23:27:34','2024-04-22 23:27:34',0),(119,101,1,'layout','显示layout布局','Display Layout','レイアウト表示','顯示layout布局',NULL,'lorenwe',NULL,'2024-04-22 23:28:17','2024-04-22 23:28:17',0),(120,119,1,'mix','混合菜单','Mix','ミックスメニュー','混合菜單',NULL,'lorenwe',NULL,'2024-04-22 23:29:01','2024-04-22 23:29:01',0),(121,119,1,'top','顶部菜单','Top','トップメニュー','頂部菜單',NULL,'lorenwe',NULL,'2024-04-22 23:29:37','2024-04-22 23:29:37',0),(122,119,1,'side','侧边菜单','Side','サイドメニュー','側邊菜單',NULL,'lorenwe',NULL,'2024-04-22 23:30:14','2024-04-22 23:30:14',0),(123,119,1,'tooltip','导航菜单的位置,side 为正常模式，top菜单显示在顶部，mix 两种兼有','The location of the navigation menu,side is the normal mode, the top menu is displayed on the top, and MIX has both','ナビゲーションメニューの位置は、sideがノーマルモード、topメニューが上部に表示され、mixの2種類を兼ねている','導航菜單的位置,side 為正常模式，top菜單顯示在頂部，mix 兩種兼有',NULL,'lorenwe',NULL,'2024-04-22 23:32:55','2024-04-22 23:32:55',0),(124,101,1,'permission','权限标识','Permission Identify','権限表示','權限標識',NULL,'lorenwe',NULL,'2024-04-22 23:33:55','2024-04-22 23:33:55',0),(125,124,1,'tooltip','权限标识是唯一的，用于做路由的权限管理','The permission identifier is unique and is used for routing permission management','ルーティングの権限管理をするための権限識別子は一意である','權限標識是唯一的，用於做路由的權限管理',NULL,'lorenwe',NULL,'2024-04-22 23:34:49','2024-04-22 23:34:49',0),(126,101,1,'target','窗口打开方式','Window opening mode','ウィンドウの開き方','窗口打開方式',NULL,'lorenwe',NULL,'2024-04-22 23:35:40','2024-04-22 23:35:40',0),(127,126,1,'tooltip','只在路劲为 URL 时生效','This parameter is valid only when the road jin is a URL','ロードパワーがURLの場合のみ有効','只在路勁為 URL 時生效',NULL,'lorenwe',NULL,'2024-04-22 23:36:20','2024-04-22 23:36:20',0),(128,101,1,'icon','图标','Icon','アイコン','圖標',NULL,'lorenwe',NULL,'2024-04-22 23:37:26','2024-04-22 23:37:26',0),(129,128,1,'tooltip','请填写 IconFont 阿里图标矢量库的名称','Please fill in the name of IconFont Ali icon vector library','IconFontアリアイコンベクターライブラリの名前を記入してください','請填寫 IconFont 阿裏圖標矢量庫的名稱',NULL,'lorenwe',NULL,'2024-04-22 23:38:14','2024-04-22 23:38:14',0),(130,101,1,'redirect','重定向','Redirect','リダイレクト','重定向',NULL,'lorenwe',NULL,'2024-04-22 23:39:00','2024-04-22 23:39:00',0),(131,101,1,'component','组件路径','Component','コンポーネントパス','組件路徑',NULL,'lorenwe',NULL,'2024-04-22 23:39:50','2024-04-22 23:39:50',0),(132,101,1,'path','路由地址','Route Path','経路アドレス','路由地址',NULL,'lorenwe',NULL,'2024-04-22 23:40:39','2024-04-22 23:40:39',0),(133,101,1,'menu_type','菜单类型','Menu Type','メニュータイプ','菜單類型',NULL,'lorenwe',NULL,'2024-04-22 23:41:25','2024-04-22 23:41:25',0),(134,133,1,'button','按钮','Button','ボタンです','按鈕',NULL,'lorenwe',NULL,'2024-04-22 23:42:05','2024-04-22 23:42:05',0),(135,133,1,'menu','菜单','Menu','メニューです','菜單',NULL,'lorenwe',NULL,'2024-04-22 23:42:50','2024-04-22 23:42:50',0),(136,133,1,'dir','目录','Directory','リスト','目錄',NULL,'lorenwe',NULL,'2024-04-22 23:43:27','2024-04-22 23:43:27',0),(137,101,1,'title','菜单','Menu','メニュー','菜單',NULL,'lorenwe',NULL,'2024-04-22 23:44:24','2024-04-22 23:44:24',0),(138,101,1,'name','菜单名称','Menu Name','メニュー名','菜單名稱',NULL,'lorenwe',NULL,'2024-04-22 23:45:05','2024-04-22 23:45:05',0),(139,138,1,'tooltip','请选择国际化绑定的字段','Select fields for internationalized binding','国際化バインディングのフィールドを選んでください','請選擇國際化綁定的字段',NULL,'lorenwe',NULL,'2024-04-22 23:46:00','2024-04-22 23:46:00',0),(140,44,1,'role-management','角色管理','Role Management','役割管理','角色管理',NULL,'lorenwe',NULL,'2024-04-26 01:49:56','2024-04-26 01:49:56',0),(141,140,1,'add','新建','New','新築','新建',NULL,'lorenwe',NULL,'2024-04-26 01:50:36','2024-04-26 01:50:36',0),(142,140,1,'edit','编辑','Edit','編集','編輯',NULL,'lorenwe',NULL,'2024-04-26 01:51:10','2024-04-26 01:51:10',0),(143,140,1,'delete','删除','Delete','削除','刪除',NULL,'lorenwe',NULL,'2024-04-26 01:51:41','2024-04-26 01:51:41',0),(144,88,1,'role-management','角色管理','Role Management','役割管理','角色管理',NULL,'lorenwe','lorenwe','2024-04-28 00:51:58','2024-04-28 00:52:57',0),(145,144,1,'role_name','角色名称','Role Name','役名','角色名稱',NULL,'lorenwe',NULL,'2024-04-28 00:54:18','2024-04-28 00:54:18',0),(146,145,1,'validator','角色名称的长度在2-36个字符','The character name can be 2-36 characters long','役名の長さは2 ~ 36文字','角色名稱的長度在2-36個字符',NULL,'lorenwe',NULL,'2024-04-28 00:56:06','2024-04-28 00:56:06',0),(147,144,1,'role_code','角色编码','Role Code','キャラクターコード','角色編碼',NULL,'lorenwe',NULL,'2024-04-28 00:57:01','2024-04-28 00:57:01',0),(148,144,1,'title','角色','Role','役','角色',NULL,'lorenwe',NULL,'2024-04-28 00:57:46','2024-04-28 00:57:46',0),(149,144,1,'menu_permission','菜单权限','Menu Permissions','メニュー権限','菜單權限',NULL,'lorenwe',NULL,'2024-04-28 19:56:57','2024-04-28 19:56:57',0),(150,44,1,'user-management','用户管理','User Management','ユーザー管理','用戶管理',NULL,'lorenwe',NULL,'2024-04-30 00:16:35','2024-04-30 00:16:35',0),(151,150,1,'add','新建','New','新築','新建',NULL,'lorenwe',NULL,'2024-04-30 00:17:15','2024-04-30 00:17:15',0),(152,150,1,'edit','编辑','Edit','編集','編輯',NULL,'lorenwe',NULL,'2024-04-30 00:18:07','2024-04-30 00:18:07',0),(153,150,1,'delete','删除','Delete','削除','刪除',NULL,'lorenwe',NULL,'2024-04-30 00:18:36','2024-04-30 00:18:36',0),(154,88,1,'user-management','用户管理','User Management','ユーザー管理','用戶管理',NULL,'lorenwe',NULL,'2024-04-30 00:20:18','2024-04-30 00:20:18',0),(155,154,1,'avatar','头像','Avatar','顔','頭像',NULL,'lorenwe','lorenwe','2024-04-30 00:21:21','2024-05-07 18:33:13',0),(156,154,1,'tags','人物标签','Figure Labels','人物タグ','人物標簽',NULL,'lorenwe',NULL,'2024-04-30 00:22:03','2024-04-30 00:22:03',0),(157,154,1,'confirm-password','确认密码','Confirm Password','パスワードを確認する','確認密碼',NULL,'lorenwe',NULL,'2024-04-30 00:23:00','2024-04-30 00:23:00',0),(158,157,1,'rules','两次密码输入不一致！','The two passwords are not the same!','パスワードの入力が2回一致しません!','兩次密碼輸入不一致！',NULL,'lorenwe',NULL,'2024-04-30 00:23:51','2024-04-30 00:23:51',0),(159,154,1,'password','密码','Password','パスワード','密碼',NULL,'lorenwe',NULL,'2024-04-30 00:24:34','2024-04-30 00:24:34',0),(160,159,1,'rules','6-12位字符的密码','A password of 6 to 12 characters','6桁から12桁のパスワードです','6-12位字符的密碼',NULL,'lorenwe',NULL,'2024-04-30 00:25:24','2024-04-30 00:25:24',0),(161,154,1,'address','详细地址','Detailed Address','詳しい住所','詳細地址',NULL,'lorenwe',NULL,'2024-04-30 00:26:49','2024-04-30 00:26:49',0),(162,154,1,'city','所属城市','City','所属する都市','所屬城市',NULL,'lorenwe',NULL,'2024-04-30 00:27:28','2024-04-30 00:27:28',0),(163,154,1,'sex','性别','Sex','性别','性别',NULL,'lorenwe',NULL,'2024-04-30 00:28:12','2024-04-30 00:28:12',0),(164,163,1,'secret','保密','Secret','秘密','保密',NULL,'lorenwe',NULL,'2024-04-30 00:28:41','2024-04-30 00:28:41',0),(165,163,1,'female','女','Female','女','女',NULL,'lorenwe',NULL,'2024-04-30 00:29:06','2024-04-30 00:29:06',0),(166,163,1,'male','男','Male','男','男',NULL,'lorenwe',NULL,'2024-04-30 00:29:32','2024-04-30 00:29:32',0),(167,154,1,'age','年龄','Age','年齢','年齡',NULL,'lorenwe',NULL,'2024-04-30 00:30:31','2024-04-30 00:30:31',0),(168,154,1,'steps-form',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-04-30 00:31:14','2024-04-30 00:31:14',0),(169,168,1,'set-avatar','设置头像','Set Avatar','プロフィール画像を設定します','設置頭像',NULL,'lorenwe',NULL,'2024-04-30 00:32:10','2024-04-30 00:32:10',0),(170,169,1,'message','请上传头像','Please upload photo','画像のアップロードをお願いします','請上傳頭像',NULL,'lorenwe',NULL,'2024-04-30 00:32:57','2024-04-30 00:32:57',0),(171,168,1,'set-password','设置密码','Set Password','パスワードを設定する','設置密碼',NULL,'lorenwe',NULL,'2024-04-30 00:33:54','2024-04-30 00:33:54',0),(172,168,1,'personal-information','个人信息','Personal Information','個人情報','個人信息',NULL,'lorenwe',NULL,'2024-04-30 00:34:48','2024-04-30 00:34:48',0),(173,168,1,'user-information','用户信息','User Information','ユーザー情報','用戶信息',NULL,'lorenwe',NULL,'2024-04-30 00:35:45','2024-04-30 00:35:45',0),(174,154,1,'phone','手机号码','Mobile Phone','携帯電話の番号','手機號碼',NULL,'lorenwe',NULL,'2024-04-30 01:09:58','2024-04-30 01:09:58',0),(175,174,1,'rules','手机号码格式不正确！','The format of mobile phone number is incorrect!','携帯の番号のフォーマットが正しくありません!','手機號碼格式不正確！',NULL,'lorenwe',NULL,'2024-04-30 01:10:43','2024-04-30 01:10:43',0),(176,154,1,'role_id','所属角色','Subordinate Role','所属するキャラクター','所屬角色',NULL,'lorenwe',NULL,'2024-04-30 01:11:27','2024-04-30 01:11:27',0),(177,154,1,'username','用户名','User Name','ユーザー名','用户名',NULL,'lorenwe','lorenwe','2024-04-30 01:12:44','2024-05-07 18:34:38',0),(178,177,1,'rules','用户名由4到16位（字母，数字，下划线，减号）组成','The user name contains 4 to 16 characters (letters, digits, underscores, and hyphens)','ユーザー名は4 ~ 16桁(アルファベット、数字、アンダーライン、マイナス)からなる','用戶名由4到16位（字母，數字，下劃線，減號）組成',NULL,'lorenwe',NULL,'2024-04-30 01:13:29','2024-04-30 01:13:29',0),(179,154,1,'title','用户','User','ユーザー','用戶',NULL,'lorenwe',NULL,'2024-05-06 23:01:19','2024-05-06 23:01:19',0),(180,154,1,'motto','座右铭','Motto','座右の銘','座右銘',NULL,'lorenwe',NULL,'2024-05-06 23:06:00','2024-05-06 23:06:00',0),(181,154,1,'nickname','昵称','Nickname','ニックネーム','昵稱',NULL,'lorenwe',NULL,'2024-05-07 18:32:30','2024-05-07 18:32:30',0),(182,88,1,'api-management','接口管理','Interface Management','インタフェース管理','介面管理',NULL,'lorenwe','lorenwe','2024-05-08 01:34:27','2024-05-08 01:34:46',0),(183,44,1,'api-management','接口管理','Interface Management','インタフェース管理','介面管理',NULL,'lorenwe',NULL,'2024-05-08 01:35:52','2024-05-08 01:35:52',0),(184,183,1,'add','新建','New','新築','新建',NULL,'lorenwe','lorenwe','2024-05-08 01:36:17','2024-05-08 01:36:47',0),(185,183,1,'edit','编辑','Edit','編集','編輯',NULL,'lorenwe',NULL,'2024-05-08 01:37:35','2024-05-08 01:37:35',0),(186,183,1,'delete','删除','Delete','削除','刪除',NULL,'lorenwe',NULL,'2024-05-08 01:38:16','2024-05-08 01:38:16',0),(187,182,1,'api_name','接口名称',NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-05-08 22:18:24','2024-05-08 22:18:24',0),(188,182,1,'api_type','接口类型',NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-05-08 22:18:42','2024-05-08 22:18:42',0),(189,188,1,'dir','目录',NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-05-08 22:19:20','2024-05-08 22:19:20',0),(190,188,1,'api','接口',NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-05-08 22:19:37','2024-05-08 22:19:37',0),(191,182,1,'api_path','接口地址',NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-05-08 22:20:05','2024-05-08 22:20:05',0),(192,182,1,'method','请求方式',NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-05-08 22:20:39','2024-05-08 22:20:39',0),(193,183,1,'add-child','添加子级','Add Child','サブレベルを追加する','添加子級',NULL,'lorenwe',NULL,'2024-05-08 22:22:40','2024-05-08 22:22:40',0),(194,182,1,'title','接口',NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-05-08 22:49:48','2024-05-08 22:49:48',0),(195,56,1,'api_type',NULL,NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-05-09 18:16:15','2024-05-09 18:16:15',0),(196,195,1,'dir','目录',NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-05-09 18:16:35','2024-05-09 18:16:35',0),(197,195,1,'api','接口',NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-05-09 18:16:57','2024-05-09 18:16:57',0),(198,14,1,'PersonalCenter','用户中心',NULL,NULL,NULL,NULL,'lorenwe',NULL,'2024-05-09 23:41:14','2024-05-09 23:41:14',0),(199,183,1,'edit-state','修改状态','Modify State','ステータスの変更','修改狀態',NULL,'lorenwe',NULL,'2024-05-23 06:53:38','2024-05-23 06:53:38',0),(200,150,1,'edit-state','修改状态','Modify State','ステータスの変更','修改狀態',NULL,'lorenwe',NULL,'2024-05-23 07:14:19','2024-05-23 07:14:19',0),(201,140,1,'edit-state','修改状态','Modify State','ステータスの変更','修改狀態',NULL,'lorenwe',NULL,'2024-05-23 07:15:15','2024-05-23 07:15:15',0),(202,101,1,'dependent-api','依赖接口','Dependency Interface','依存インタフェース','依賴介面',NULL,'lorenwe',NULL,'2024-05-24 03:57:56','2024-05-24 03:57:56',0),(203,56,1,'announcement','活动公告','Event announcement','イベント告知です','活動公告',NULL,'lorenwe',NULL,'2024-05-24 07:04:30','2024-05-24 07:04:30',0),(204,203,1,'type','类型','Type','タイプです','類型',NULL,'lorenwe',NULL,'2024-05-24 07:05:17','2024-05-24 07:05:17',0),(205,204,1,'notification','通知','Notification','お知らせします','通知',NULL,'lorenwe',NULL,'2024-05-24 07:06:01','2024-05-24 07:06:01',0),(206,204,1,'message','消息','Message','メッセージです','消息',NULL,'lorenwe',NULL,'2024-05-24 07:06:41','2024-05-24 07:06:41',0),(207,204,1,'activity','活动','Activity','イベントです','活動',NULL,'lorenwe',NULL,'2024-05-24 07:07:23','2024-05-24 07:07:23',0),(208,204,1,'announcement','公告','Announcement','公告します','公告',NULL,'lorenwe',NULL,'2024-05-24 07:08:18','2024-05-24 07:08:18',0);
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '菜单名称,保存语言表id',
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `menu_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单类型',
  `menu_api` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单依赖接口',
  `component` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '组件路径',
  `path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '路由地址',
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图标',
  `permission` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限标识',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `redirect` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '重定向',
  `target` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '窗口打开方式',
  `layout` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'layout布局',
  `navTheme` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单主题',
  `headerTheme` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '顶部菜单主题',
  `fixSiderbar` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否固定导航',
  `fixedHeader` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否固定header到顶部',
  `flatMenu` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '隐藏自己,并且将子节点提升到与自己平级',
  `hideInMenu` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '隐藏菜单',
  `hideChildrenInMenu` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '隐藏子菜单',
  `hideInBreadcrumb` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '在面包屑中隐藏',
  `menuRender` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '显示菜单',
  `menuHeaderRender` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '显示菜单顶栏',
  `headerRender` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '显示顶栏',
  `footerRender` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '显示页脚',
  `create_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `delete_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_unique` (`permission`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,44,0,'dir',NULL,NULL,'/system','icon-setting','system',0,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-22 19:50:20','2024-05-12 19:44:30',0),(2,44,1,'menu',NULL,NULL,'/system',NULL,NULL,10,1,'/system/user-management','_blank','side','light','light',1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-23 00:31:00','2024-04-25 19:20:14',0),(8,45,1,'menu','14,15','./System/MenuManagement','/system/menu-management','icon-menu','system:menu-management',1,1,NULL,'_blank','side','light','light',1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-22 22:27:28','2024-05-24 03:10:06',0),(9,46,8,'button','11',NULL,NULL,NULL,'system:menu-management:add',0,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-22 22:31:41','2024-05-23 07:45:25',0),(10,47,8,'button','13',NULL,NULL,NULL,'system:menu-management:delete',0,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-22 22:33:29','2024-05-23 07:45:42',0),(11,48,8,'button','12',NULL,NULL,NULL,'system:menu-management:edit',0,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-22 22:34:13','2024-05-23 07:46:08',0),(12,49,8,'button','11',NULL,NULL,NULL,'system:menu-management:add-child',0,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-22 22:34:57','2024-05-23 07:46:29',0),(13,50,1,'menu','15','./System/Internationalization','/system/internationalization','icon-earth','system:internationalization',0,1,NULL,'_blank','side','light','light',1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-22 22:40:03','2024-05-23 07:47:04',0),(14,51,13,'button','16',NULL,NULL,NULL,'system:internationalization:add',0,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-22 22:41:38','2024-05-23 07:47:25',0),(15,52,13,'button','18',NULL,NULL,NULL,'system:internationalization:delete',0,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-22 22:42:46','2024-05-23 07:47:43',0),(16,53,13,'button','17',NULL,NULL,NULL,'system:internationalization:edit',0,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-22 22:43:19','2024-05-23 07:47:53',0),(17,54,13,'button','16',NULL,NULL,NULL,'system:internationalization:add-child',0,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-22 22:44:11','2024-05-23 07:48:10',0),(19,46,1,'button',NULL,NULL,NULL,NULL,'asd',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-25 19:25:10','2024-04-25 19:48:39',1714103319),(20,140,1,'menu','19,14','./System/RoleManagement','/system/role-management','icon-user','system:role-management',1,1,NULL,'_blank','side','light','light',1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-26 01:55:34','2024-05-23 09:38:35',0),(21,141,20,'button','20',NULL,NULL,NULL,'system:role-management:add',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-26 01:57:43','2024-05-23 07:48:48',0),(22,142,20,'button','21',NULL,NULL,NULL,'system:role-management:edit',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-26 01:58:15','2024-05-23 07:49:02',0),(23,143,20,'button','22',NULL,NULL,NULL,'system:role-management:delete',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-04-26 01:58:35','2024-05-23 07:49:12',0),(24,150,1,'menu','28','./System/UserManagement','/system/user-management','icon-user','system:user-management',1,1,NULL,'_blank','side','light','light',1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-06 00:44:16','2024-05-23 07:49:39',0),(25,151,24,'button','29',NULL,NULL,NULL,'system:user-management:add',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-06 00:45:11','2024-05-23 07:49:53',0),(26,152,24,'button','30',NULL,NULL,NULL,'system:user-management:edit',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-06 00:45:39','2024-05-23 07:50:05',0),(27,153,24,'button','31',NULL,NULL,NULL,'system:user-management:delete',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-06 00:46:16','2024-05-23 07:50:21',0),(28,183,1,'menu','2','./System/ApiManagement','/system/api-management','icon-api','system:api-management',1,1,NULL,'_blank','side','light','light',1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-08 01:43:34','2024-05-23 06:55:47',0),(29,184,28,'button','3',NULL,NULL,NULL,'system:api-management:add',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-08 01:45:41','2024-05-23 06:43:26',0),(30,185,28,'button','5',NULL,NULL,NULL,'system:api-management:edit',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-08 01:46:17','2024-05-23 06:43:35',0),(31,186,28,'button','6',NULL,NULL,NULL,'system:api-management:delete',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-08 01:46:56','2024-05-23 06:43:53',0),(32,55,0,'dir','',NULL,'/dashboard','icon-home-fill','dashboard',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-12 19:46:33','2024-05-23 09:26:24',0),(33,193,28,'button','3',NULL,NULL,NULL,'system:api-management:add-child',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-13 18:35:51','2024-05-23 06:44:27',0),(34,199,28,'button','26',NULL,NULL,NULL,'system:api-management:edit-state',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-23 06:55:28','2024-05-23 06:56:13',0),(35,200,24,'button','32',NULL,NULL,NULL,'system:user-management:edit-state',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-23 07:17:30','2024-05-23 07:17:50',0),(36,201,20,'button','23',NULL,NULL,NULL,'system:role-management:edit-state',1,1,NULL,NULL,NULL,NULL,NULL,1,1,0,0,0,0,1,1,1,1,'lorenwe','lorenwe','2024-05-23 07:41:28','2024-05-23 07:42:08',0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2019_03_01_000000_create_rules_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

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

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
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

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'laravel10'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-22 10:53:01
