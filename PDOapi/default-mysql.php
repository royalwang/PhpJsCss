-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Cze 2017, 22:44
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sun`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakt_messages`
--

CREATE TABLE `kontakt_messages` (
  `id` bigint(20) NOT NULL,
  `imie` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `mobile` varchar(250) NOT NULL DEFAULT '',
  `opis` text NOT NULL,
  `time` bigint(20) NOT NULL DEFAULT '0',
  `active` tinyint(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `kontakt_messages`
--

INSERT INTO `kontakt_messages` (`id`, `imie`, `email`, `mobile`, `opis`, `time`, `active`) VALUES
(11, 'Bax', 'email@email.com', '+48000666999', 'Hello from kontakt form', 1497904998, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `kontakt_messages`
--
ALTER TABLE `kontakt_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `kontakt_messages`
--
ALTER TABLE `kontakt_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
