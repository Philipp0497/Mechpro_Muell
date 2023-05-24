-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Mai 2023 um 14:55
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `testdb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rubbish_bin`
--

CREATE TABLE `rubbish_bin` (
  `bin_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `bin_size` int(3) NOT NULL,
  `bin_adress` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `rubbish_bin`
--

INSERT INTO `rubbish_bin` (`bin_id`, `user_id`, `bin_size`, `bin_adress`) VALUES
(1, 1, 60, '73033 Göppingen, Janstrasse 1'),
(2, 1, 120, '72345 Göppingen, Teststrasse 2'),
(3, 1, 120, '72345 Göppingen, Teststrasse 5');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `rubbish_bin`
--
ALTER TABLE `rubbish_bin`
  ADD PRIMARY KEY (`bin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
