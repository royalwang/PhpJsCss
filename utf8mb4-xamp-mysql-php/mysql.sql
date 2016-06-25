-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Cze 2016, 12:25
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `user`
--
CREATE DATABASE IF NOT EXISTS `user` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `user`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`user`) VALUES
('żźżźŻżźćżźćźóółłłńńęąśżź'),
('曾经在德国与奔驰、宝马比肩的豪华品牌&mdash;&mdash;BORGWARD（宝沃）在去年法兰克福车展宣告回归，在今年4月的北京车展上，其首款车型&mdash;&mdash;宝沃BX7正式上市。该车全系共有18款车型，售价16.98万-30.28万。'),
('曾经在德国与奔驰、宝马比肩的豪华品牌&mdash;&mdash;BORGWARD（宝沃）在去年法兰克福车展宣告回归，在今年4月的北京车展上，其首款车型&mdash;&mdash;宝沃BX7正式上市。该车全系共有18款车型，售价16.98万-30.28万。'),

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
