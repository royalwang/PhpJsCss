# create table example
# Use utf8mb4_unicode_ci or utf8_general_ci

DROP TABLE IF EXISTS `sendque`;
CREATE TABLE IF NOT EXISTS `sendque` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `campid` int(21) NOT NULL,
  `listaid` int(21) NOT NULL,
  `templateid` int(21) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unsubscribe` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `sendtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sendcount` tinyint(10) DEFAULT '0',
  `price` decimal(10,2),
  `lat` float(10,6),
  `lng` float(10,6),
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `unique` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adminid` int(21) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `unique` (`campid`,`email`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
