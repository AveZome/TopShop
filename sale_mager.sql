-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.16 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных sale_manager
DROP DATABASE IF EXISTS `sale_manager`;
CREATE DATABASE IF NOT EXISTS `sale_manager` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sale_manager`;

-- Дамп структуры для таблица sale_manager.access
DROP TABLE IF EXISTS `access`;
CREATE TABLE IF NOT EXISTS `access` (
  `property_id` smallint(6) unsigned NOT NULL,
  `category_id` smallint(6) unsigned NOT NULL,
  PRIMARY KEY (`property_id`),
  KEY `access_category_id` (`category_id`),
  CONSTRAINT `access_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `access_property_id` FOREIGN KEY (`property_id`) REFERENCES `property` (`id_property`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы sale_manager.access: ~15 rows (приблизительно)
DELETE FROM `access`;
/*!40000 ALTER TABLE `access` DISABLE KEYS */;
INSERT INTO `access` (`property_id`, `category_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 2),
	(8, 2),
	(9, 2),
	(10, 2),
	(11, 2),
	(12, 2),
	(13, 3),
	(14, 3),
	(15, 3);
/*!40000 ALTER TABLE `access` ENABLE KEYS */;

-- Дамп структуры для таблица sale_manager.binding
DROP TABLE IF EXISTS `binding`;
CREATE TABLE IF NOT EXISTS `binding` (
  `product_id` smallint(6) unsigned NOT NULL,
  `property_id` smallint(6) unsigned NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`product_id`,`property_id`),
  KEY `property_id` (`property_id`),
  CONSTRAINT `binding_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `binding_property_id` FOREIGN KEY (`property_id`) REFERENCES `property` (`id_property`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы sale_manager.binding: ~6 rows (приблизительно)
DELETE FROM `binding`;
/*!40000 ALTER TABLE `binding` DISABLE KEYS */;
INSERT INTO `binding` (`product_id`, `property_id`, `value`) VALUES
	(1, 1, '2005'),
	(1, 2, '333'),
	(1, 3, 'grey'),
	(1, 4, '5'),
	(1, 5, 'petrol'),
	(1, 6, '2');
/*!40000 ALTER TABLE `binding` ENABLE KEYS */;

-- Дамп структуры для таблица sale_manager.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы sale_manager.category: ~3 rows (приблизительно)
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'Car'),
	(2, 'Notebook'),
	(3, 'Apartment');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица sale_manager.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id_product` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` double NOT NULL DEFAULT '1',
  `category_id` smallint(6) unsigned NOT NULL,
  PRIMARY KEY (`id_product`),
  KEY `product_category_id` (`category_id`),
  CONSTRAINT `product_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы sale_manager.product: ~9 rows (приблизительно)
DELETE FROM `product`;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id_product`, `name`, `price`, `category_id`) VALUES
	(1, 'Audi', 2500, 1),
	(2, 'Very good apartment', 25000, 3),
	(3, 'Dell Inspiron 1455Z', 700, 2),
	(4, 'Opel Astra', 2000, 1),
	(5, 'Dacia Logan', 4300, 1),
	(6, 'Asus Notebook Horeball', 900, 2),
	(7, '4 rooms in the house', 30000, 3),
	(8, '3 rooms in center of the city', 27000, 3),
	(9, 'Acer Notebook Pro', 777, 2),
	(10, 'Bentley', 20000, 1),
	(11, 'Mitsubishi Lancer', 30000, 1),
	(12, 'Ford Fiesta', 12000, 1),
	(13, 'Lada Calina', 1500, 1),
	(14, 'SuperCar', 54654654, 1),
	(15, 'MY', 1, 1),
	(16, 'asd', 1, 1),
	(17, 'asd', 1, 1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Дамп структуры для таблица sale_manager.property
DROP TABLE IF EXISTS `property`;
CREATE TABLE IF NOT EXISTS `property` (
  `id_property` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_property`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы sale_manager.property: ~15 rows (приблизительно)
DELETE FROM `property`;
/*!40000 ALTER TABLE `property` DISABLE KEYS */;
INSERT INTO `property` (`id_property`, `name`) VALUES
	(1, 'year'),
	(2, 'mileage'),
	(3, 'color'),
	(4, 'engine_capacity'),
	(5, 'fuel'),
	(6, 'consumption_per100km'),
	(7, 'vendor'),
	(8, 'screen_size'),
	(9, 'screen_resolution'),
	(10, 'ram'),
	(11, 'hard'),
	(12, 'video'),
	(13, 'area'),
	(14, 'number_floors'),
	(15, 'floor');
/*!40000 ALTER TABLE `property` ENABLE KEYS */;

-- Дамп структуры для таблица sale_manager.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы sale_manager.user: ~2 rows (приблизительно)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `name`, `email`, `password`, `role`) VALUES
	(1, 'Alexei Elistratov', 'alecsei.elistratov@gmail.com', '123456789', 'admin'),
	(3, 'Marina Cernatinschi', 'marina.cernatinschi@gmail.com', '123456', 'user');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
