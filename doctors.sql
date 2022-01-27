-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Jan 2022 um 20:39
-- Server-Version: 10.4.22-MariaDB
-- PHP-Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `doctors`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `Patient_Id` int(11) NOT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Date` date NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `images`
--

INSERT INTO `images` (`id`, `Patient_Id`, `Image`, `Location`, `Date`, `Description`) VALUES
(69, 41, 'heart.jpg', 'Heart', '2022-01-05', 'Looks fine and there are no major problems.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `Firstname` varchar(250) NOT NULL,
  `Lastname` varchar(250) NOT NULL,
  `DOB` date NOT NULL,
  `Age` int(3) NOT NULL,
  `Sex` varchar(15) NOT NULL,
  `Doctor_ID` int(250) NOT NULL,
  `Notes` text DEFAULT NULL,
  `Profile_image` varchar(250) DEFAULT NULL,
  `Consent` varchar(3) DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `patient`
--

INSERT INTO `patient` (`id`, `Firstname`, `Lastname`, `DOB`, `Age`, `Sex`, `Doctor_ID`, `Notes`, `Profile_image`, `Consent`, `Date`) VALUES
(41, 'Jigender', 'Bhaji', '1999-03-24', 22, 'Male', 50, 'The patient is not healthy', 'safariboy.png', 'No', '2021-12-30 14:29:19'),
(47, 'Baki', 'Steeve', '1999-10-29', 22, 'Male', 50, 'The patient looks healthy ', 'schoolboy.png', 'Yes', '2022-01-26 19:26:09'),
(48, 'Steve', 'Philander', '1999-10-20', 23, 'Male', 50, 'The patient is healthy and doesn\'t suffer from any symptoms', 'schoolboy.png', 'Yes', '2022-01-27 18:16:49'),
(50, 'Baki', 'Manny', '2022-01-12', 22, 'Male', 0, 'Healthy', 'profile.jpg', 'Yes', '2022-01-27 19:12:17');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `register`
--

CREATE TABLE `register` (
  `ID` int(11) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Emailid` varchar(300) NOT NULL,
  `DOB` date NOT NULL,
  `Password` varchar(300) NOT NULL,
  `Hash` varchar(300) NOT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `register`
--

INSERT INTO `register` (`ID`, `Username`, `Emailid`, `DOB`, `Password`, `Hash`, `Active`) VALUES
(50, 'Aswath', 'csk.aswath@gmail.com', '2021-12-01', '$2y$10$jQDnnWX1K.9sPoKyRxr3CeW4rXf5LuAJlQm3/DinrzJcU4BRgEp6a', '$2y$10$Zvh4SDZv75j2m59Zv2nJEO/pQbIMyrE08JLsHE646hyMIE93A9TQu', 1),
(63, 'Strange', 'c.aswath99@gmail.com', '2022-01-15', '$2y$10$NOxxhCEpxVOGF9z31l46xuEXepctEw7HaVOGaBRb1OtuRPn9hs4pm', '362e80d4df43b03ae6d3f8540cd63626', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`,`Date`);

--
-- Indizes für die Tabelle `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Emailid` (`Emailid`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT für Tabelle `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT für Tabelle `register`
--
ALTER TABLE `register`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
