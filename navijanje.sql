-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Okt 21, 2022 at 02:18 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `navijanje`
--

-- --------------------------------------------------------

--
-- Table structure for table `navijac`
--

CREATE TABLE `navijac` (
  `navijacID` int(11) NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `kategorijaClanstvaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navijac`
--

INSERT INTO `navijac` (`navijacID`, `ime`, `prezime`, `kategorijaClanstvaID`) VALUES
(11, 'Petar', 'Pekic', 2),
(12, 'Boka', 'Micic', 2),
(14, 'Sasa', 'Satke', 1),
(16, 'Laki', 'Ris', 3),
(20, 'Dragan', 'Gaganovic', 1),
(21, 'Marko', 'Markovic', 2),
(31, 'Steki', 'Patic', 2),
(32, 'Mile', 'Regic', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategorijaclanstva`
--

CREATE TABLE `kategorijaClanstva` (
  `kategorijaClanstvaID` int(11) NOT NULL,
  `nazivKategorije` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorijaclanstva`
--

INSERT INTO `kategorijaClanstva` (`kategorijaClanstvaID`, `nazivKategorije`) VALUES
(1, 'premijum navijac'),
(2, 'silver navijac'),
(3, 'pocetnik navijac');

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `idTima` int(11) NOT NULL,
  `imeTima` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `vlasnikID` int(11) NOT NULL,
  `statusID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`idTima`, `imeTima`, `vlasnikID`, `statusID`) VALUES
(20, 'Barsa', 1, 1),
(21, 'Regeton FC', 1, 1),
(23, 'Beton', 2, 1),
(24, 'Vani fc', 3, 2),
(25, 'Fc BG', 3, 2),
(26, 'Morava 111', 4, 1),
(27, 'Conmigo fc', 4, 1),
(28, 'OFK levo', 4, 1),
(47, 'OFK desno', 10, 6),
(49, 'Fk skola', 10, 1),
(61, 'ofk patke', 1, 1),
(69, 'Alexender veliki fc', 1, 1),
(71, 'Espagnia', 9, 5),
(72, 'Guandi', 11, 7),
(73, 'Sasa fc', 12, 1),
(75, 'Kokakola fc', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `vlasnik`
--

CREATE TABLE `vlasnik` (
  `vlasnikID` int(11) NOT NULL,
  `imeVlasnika` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezimeVlasnika` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zemljaPorekla` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vlasnik`
--

INSERT INTO `vlasnik` (`vlasnikID`, `imeVlasnika`, `prezimeVlasnika`, `zemljaPorekla`) VALUES
(1, 'Mitar', 'Miric', 'Srbija'),
(2, 'Miki', 'Kotrljanovic', 'Srbija'),
(3, 'Zorana', 'Zoranovic', 'Srbija'),
(4, 'Ermano', 'Petric', 'Srbija'),
(9, 'Laza', 'Lizard', 'Srbija'),
(10, 'Danny', 'Kiss', 'Engleska'),
(11, 'Johan', 'King', 'SAD'),
(12, 'Laza', 'Lazo', 'Litvanija');

-- --------------------------------------------------------

--
-- Table structure for table `navijaza`
--

CREATE TABLE `navijaza` (
  `navijacID` int(11) NOT NULL,
  `idTima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navijaza`
--

INSERT INTO `navijaza` (`navijacID`, `idTima`) VALUES
(11, 21),
(11, 25),
(11, 28),
(12, 23),
(14, 20),
(14, 24),
(14, 69),
(16, 26),
(16, 49),
(20, 25),
(20, 28);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `statusID` int(11) NOT NULL,
  `imeStatusa` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusID`, `imeStatusa`) VALUES
(1, 'Gradski'),
(2, 'Inostrani'),
(5, 'Seoski'),
(6, 'Privatni'),
(7, 'Metropolski'),
(8, 'Varoski');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `navijac`
--
ALTER TABLE `navijac`
  ADD PRIMARY KEY (`navijacID`),
  ADD KEY `kategorijaClanstvaID` (`kategorijaClanstvaID`);

--
-- Indexes for table `kategorijaclanstva`
--
ALTER TABLE `kategorijaClanstva`
  ADD PRIMARY KEY (`kategorijaClanstvaID`);

--
-- Indexes for table `tim`
--


ALTER TABLE `tim`
  ADD PRIMARY KEY (`idTima`),
  ADD KEY `vlasnikID` (`vlasnikID`),
  ADD KEY `statusID` (`statusID`);

--
-- Indexes for table `vlasnik`
--
ALTER TABLE `vlasnik`
  ADD PRIMARY KEY (`vlasnikID`);

--
-- Indexes for table `navijaza`
--
ALTER TABLE `navijaza`
  ADD PRIMARY KEY (`navijacID`,`idTima`),
  ADD KEY `idTima` (`idTima`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `navijac`
--
ALTER TABLE `navijac`
  MODIFY `navijacID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kategorijaclanstva`
--
ALTER TABLE `kategorijaClanstva`
  MODIFY `kategorijaClanstvaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `IDtima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `vlasnik`
--
ALTER TABLE `vlasnik`
  MODIFY `vlasnikID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `navijac`
--
ALTER TABLE `navijac`
  ADD CONSTRAINT `navijac_ibfk_1` FOREIGN KEY (`kategorijaClanstvaID`) REFERENCES `kategorijaClanstva` (`kategorijaClanstvaID`);

--
-- Constraints for table `tim`
--
ALTER TABLE `tim`
  ADD CONSTRAINT `tim_ibfk_1` FOREIGN KEY (`vlasnikID`) REFERENCES `vlasnik` (`vlasnikID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tim_ibfk_2` FOREIGN KEY (`statusID`) REFERENCES `status` (`statusID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `navijaza`
--
ALTER TABLE `navijaza`
  ADD CONSTRAINT `navijaza_ibfk_1` FOREIGN KEY (`navijacID`) REFERENCES `navijac` (`navijacID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `navijaza_ibfk_2` FOREIGN KEY (`IDtima`) REFERENCES `tim` (`IDtima`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
