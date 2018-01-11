SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `freeemail` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `freeemail`;

DROP TABLE IF EXISTS `email_template`;
CREATE TABLE IF NOT EXISTS `email_template` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `uid` bigint(22) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Email template',
  `html` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pass` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(1) NOT NULL DEFAULT '1',
  `ban` int(1) NOT NULL DEFAULT '0',
  `ip` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `code` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `email`, `pass`, `username`, `time`, `active`, `ban`, `ip`, `code`) VALUES
(11, 'hi@domain.com', '123456rwerwer25c69271dd89wfwe98r8ew', 'Username', '2017-12-23 16:48:18', 1, 0, '::1', '0');
COMMIT;
