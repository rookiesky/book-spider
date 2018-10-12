# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.21)
# Database: books
# Generation Time: 2018-10-12 12:57:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table book_contents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `book_contents`;

CREATE TABLE `book_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(145) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`),
  KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table book_sort
# ------------------------------------------------------------

DROP TABLE IF EXISTS `book_sort`;

CREATE TABLE `book_sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `alias` varchar(145) DEFAULT 'null' COMMENT '别名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table books
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `thumb` varchar(191) DEFAULT 'null',
  `summary` text,
  `created_at` timestamp NOT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '状态，1：上架，2：下架',
  `click` int(11) DEFAULT '0',
  `sort_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `spider_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  KEY `title` (`title`),
  KEY `sort_id` (`sort_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table spider_book_error
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spider_book_error`;

CREATE TABLE `spider_book_error` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(190) NOT NULL DEFAULT '',
  `error` tinytext,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table spider_link_error
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spider_link_error`;

CREATE TABLE `spider_link_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(145) NOT NULL,
  `link` varchar(191) NOT NULL,
  `book_id` int(11) NOT NULL,
  `error` text,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table spider_links
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spider_links`;

CREATE TABLE `spider_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(145) NOT NULL,
  `link` varchar(191) NOT NULL,
  `book_id` int(11) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
