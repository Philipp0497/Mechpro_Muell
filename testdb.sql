-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Mai 2023 um 16:56
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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_data`
--

CREATE TABLE `user_data` (
  `user_id` int(3) NOT NULL,
  `user_password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user_data`
--

INSERT INTO `user_data` (`user_id`, `user_password`) VALUES
(1, '1234567890'),
(2, '2345678901');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `rubbish_bin`
--
ALTER TABLE `rubbish_bin`
  ADD PRIMARY KEY (`bin_id`);

--
-- Indizes für die Tabelle `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD PRIMARY KEY (`bin_id`,`timestamp`);

--
-- Indizes für die Tabelle `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
