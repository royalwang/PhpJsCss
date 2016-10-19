SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8';

CREATE DATABASE IF NOT EXISTS `NAMEDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `NAMEDB`;

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dofb` int(21) NOT NULL DEFAULT '1',
  `sex` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` text COLLATE utf8mb4_unicode_ci,
  `active` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `vip` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `adres` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `www` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branza` int(21) NOT NULL DEFAULT '0',
  `lubisz` int(21) NOT NULL DEFAULT '0',
  `lubia` int(21) NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user` (`user`);

ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;


#DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `adminid` int(21) DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(100) DEFAULT NULL,
  `active` char(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
