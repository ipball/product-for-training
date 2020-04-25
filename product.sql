-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table product.authors
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL COMMENT '1=administrator, 2=user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table product.authors: ~3 rows (approximately)
DELETE FROM `authors`;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` (`id`, `name`, `username`, `password`, `role`) VALUES
	(1, 'Tawatsak Tangeaim333', 'tawatsak', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2),
	(2, 'Wishada Yaring', 'wishada1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2),
	(3, 'Admin@local', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;

-- Dumping structure for table product.blogs
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `cover_image` varchar(250) DEFAULT NULL,
  `cover_alt` varchar(250) DEFAULT NULL,
  `cover_title` varchar(250) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table product.blogs: ~2 rows (approximately)
DELETE FROM `blogs`;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` (`id`, `name`, `detail`, `cover_image`, `cover_alt`, `cover_title`, `author_id`, `created_at`) VALUES
	(19, 'testt', 's', NULL, NULL, NULL, 2, '2020-04-22 20:15:55'),
	(23, 'tteetet', '', NULL, NULL, NULL, 2, '2020-04-22 20:16:08'),
	(24, 'testest', 'dfdfdfdf', NULL, NULL, NULL, 2, '2020-04-22 20:40:36'),
	(25, 'test111111', '', NULL, NULL, NULL, 2, '2020-04-23 23:19:33'),
	(26, 'aaaaaa', 'test', '643x256x2.jpg', '2222', '1111', 2, '2020-04-25 20:25:57');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;

-- Dumping structure for table product.gallerys
CREATE TABLE IF NOT EXISTS `gallerys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `path_name` varchar(250) DEFAULT NULL,
  `title_name` varchar(250) DEFAULT NULL,
  `alt_name` varchar(250) DEFAULT NULL,
  `blog_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table product.gallerys: ~0 rows (approximately)
DELETE FROM `gallerys`;
/*!40000 ALTER TABLE `gallerys` DISABLE KEYS */;
INSERT INTO `gallerys` (`id`, `ordering`, `path_name`, `title_name`, `alt_name`, `blog_id`) VALUES
	(9, 1, '20160910-ji-glacier-national-park-_dsf0631_web.jpg', 'ttttttt1', 'aaaaa1', 26),
	(10, 2, 'entertainment-wide-hq-misc-photography-644041.jpg', 't2', 'a12222', 26);
/*!40000 ALTER TABLE `gallerys` ENABLE KEYS */;

-- Dumping structure for table product.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table product.menus: ~2 rows (approximately)
DELETE FROM `menus`;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`name`, `description`) VALUES
	('author', 'Author'),
	('blog', 'Blog'),
	('customer', 'Customer');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping structure for table product.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `menu_name` varchar(50) NOT NULL,
  `author_id` int(11) NOT NULL,
  `visible` tinyint(4) DEFAULT NULL COMMENT '0=none, 1=visible',
  `is_view` tinyint(4) DEFAULT NULL COMMENT '0=none, 1=enable',
  `is_create` tinyint(4) DEFAULT NULL COMMENT '0=none, 1=enable',
  `is_update` tinyint(4) DEFAULT NULL COMMENT '0=none, 1=enable',
  `is_delete` tinyint(4) DEFAULT NULL COMMENT '0=none, 1=enable',
  PRIMARY KEY (`menu_name`,`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table product.permissions: ~9 rows (approximately)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`menu_name`, `author_id`, `visible`, `is_view`, `is_create`, `is_update`, `is_delete`) VALUES
	('author', 1, 1, 1, NULL, NULL, NULL),
	('author', 2, 1, 1, 1, 1, 1),
	('author', 3, 1, 1, 1, 1, 1),
	('blog', 1, 1, 1, 1, NULL, NULL),
	('blog', 2, 1, 1, 1, 1, 1),
	('blog', 3, 1, 1, 1, 1, 1),
	('customer', 1, 1, NULL, NULL, NULL, NULL),
	('customer', 2, 1, NULL, NULL, NULL, NULL),
	('customer', 3, 1, 1, 1, 1, 1);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
