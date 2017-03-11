-- set timezone
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- set charset utf8 mysql_query()
SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8';

-- create database
CREATE DATABASE IF NOT EXISTS `subscribe` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `subscribe`;

-- create user
GRANT ALL ON *.* TO 'subscribe'@'localhost' IDENTIFIED BY 'password';
GRANT ALL ON *.* TO 'subscribe'@'127.0.0.1' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;

-- disable remote root
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
FLUSH PRIVILEGES;

-- create table
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) DEFAULT NULL,
  `nick` varchar(50) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `www` varchar(250) DEFAULT NULL,
  `about` text,
  `ip` varchar(100) DEFAULT NULL,
  `time` bigint(22) DEFAULT '0',
  `active` char(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `accountid` (`accountid`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `sub`;
CREATE TABLE IF NOT EXISTS `sub` (    
  `uid` bigint(20) NOT NULL,
  `pid` bigint(20) NOT NULL,
  `price` decimal(50,2) NOT NULL DEFAULT 0.00,
  `ask` decimal(50,6) NOT NULL DEFAULT 0,
  `time` bigint(22) DEFAULT '0',
  `active` char(1) DEFAULT '1',  
  `usubsc` varchar(250) DEFAULT NULL,
  `usubsc2` varchar(250) DEFAULT NULL,
  UNIQUE KEY `usubsc` (`uid`,`lid`),
  UNIQUE KEY `usubsc2` (`uid`,`lid`,`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
