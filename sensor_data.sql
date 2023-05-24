-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Mai 2023 um 14:57
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
-- Tabellenstruktur für Tabelle `sensor_data`
--

CREATE TABLE `sensor_data` (
  `bin_id` int(3) NOT NULL,
  `timestamp` date NOT NULL,
  `temperature` double NOT NULL,
  `fill_level` int(3) NOT NULL,
  `burns` tinyint(1) NOT NULL,
  `lid_open` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `sensor_data`
--

INSERT INTO `sensor_data` (`bin_id`, `timestamp`, `temperature`, `fill_level`, `burns`, `lid_open`) VALUES
(1, '2023-05-09', 20.6, 30, 0, 0),
(1, '2023-05-10', 45.6, 50, 0, 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD PRIMARY KEY (`bin_id`,`timestamp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
