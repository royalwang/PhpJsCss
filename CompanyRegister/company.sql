-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Maj 2017, 19:37
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sms`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `login` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `pass` varchar(32) NOT NULL DEFAULT '',
  `firstname` varchar(250) NOT NULL DEFAULT '',
  `lastname` varchar(250) NOT NULL DEFAULT '',
  `name` varchar(250) NOT NULL DEFAULT '',
  `nip` varchar(250) NOT NULL DEFAULT '',
  `address` varchar(250) NOT NULL DEFAULT '',
  `zip` varchar(250) NOT NULL DEFAULT '',
  `city` varchar(250) NOT NULL,
  `country` varchar(3) NOT NULL DEFAULT '',
  `www` varchar(250) NOT NULL DEFAULT '',
  `mobile` char(9) NOT NULL DEFAULT '000000000',
  `prefix` int(11) NOT NULL DEFAULT '48',
  `typfirmy` int(11) NOT NULL DEFAULT '0',
  `onlyprefix` int(11) NOT NULL DEFAULT '48',
  `time` bigint(22) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `code` varchar(250) NOT NULL DEFAULT '',
  `ip` varchar(250) NOT NULL DEFAULT '',
  `limit_email_free` int(11) NOT NULL DEFAULT '100',
  `limit_email` int(11) NOT NULL DEFAULT '10000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
