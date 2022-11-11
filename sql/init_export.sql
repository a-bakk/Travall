-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 08:21 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jegyfoglalas`
--

-- --------------------------------------------------------

--
-- Table structure for table `foglalas`
--

CREATE TABLE `foglalas` (
  `foglalas_id` int(11) NOT NULL,
  `email` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `l_ev` decimal(4,0) NOT NULL,
  `l_honap` decimal(2,0) NOT NULL,
  `l_nap` decimal(2,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `foglalas`
--

INSERT INTO `foglalas` (`foglalas_id`, `email`, `l_ev`, `l_honap`, `l_nap`) VALUES
(1, 'kbrandt@protonmail.com', '2022', '11', '28'),
(2, 'kbrandt@protonmail.com', '2022', '11', '28'),
(3, 'albertp24@citromail.hu', '2022', '11', '14'),
(4, 'elinawby@yahoo.com', '2022', '12', '1'),
(5, 'l_margot39@bouygtel.fr', '2022', '11', '22'),
(6, 'l_margot39@bouygtel.fr', '2022', '11', '24'),
(7, 'emayer452@mailbox.org', '2022', '12', '3'),
(8, 'bastig65@pm.me', '2022', '11', '4'),
(9, 'b_martina1972@freemail.hu', '2022', '11', '17'),
(10, 'djoseph@gmail.co.uk', '2022', '11', '19'),
(11, 'jakobsd12@gmail.com', '2022', '11', '23'),
(12, 'paulbonnet13@gmail.com', '2022', '11', '25');

-- --------------------------------------------------------

--
-- Table structure for table `jarat`
--

CREATE TABLE `jarat` (
  `jarat_id` int(11) NOT NULL,
  `tipus` varchar(6) COLLATE utf8_hungarian_ci NOT NULL,
  `szolgaltato` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `ev` decimal(12,0) NOT NULL,
  `honap` decimal(2,0) NOT NULL,
  `nap` decimal(2,0) NOT NULL,
  `honnan_varos_id` int(11) NOT NULL,
  `hova_varos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `jarat`
--

INSERT INTO `jarat` (`jarat_id`, `tipus`, `szolgaltato`, `ev`, `honap`, `nap`, `honnan_varos_id`, `hova_varos_id`) VALUES
(1, 'repülő', 'Wizz Air', '2022', '12', '3', 1, 12),
(2, 'repülő', 'Wizz Air', '2022', '12', '8', 2, 20),
(3, 'repülő', 'Wizz Air', '2022', '12', '20', 10, 33),
(4, 'repülő', 'Wizz Air', '2022', '12', '29', 8, 17),
(5, 'repülő', 'Lufthansa', '2022', '12', '2', 31, 41),
(6, 'repülő', 'Lufthansa', '2022', '12', '17', 14, 35),
(7, 'repülő', 'Lufthansa', '2022', '12', '8', 39, 40),
(8, 'repülő', 'Air France', '2022', '12', '24', 20, 44),
(9, 'repülő', 'Air France', '2022', '12', '29', 42, 18),
(10, 'repülő', 'Air France', '2022', '12', '30', 38, 17),
(11, 'repülő', 'Ryan Air', '2022', '12', '3', 9, 36),
(12, 'repülő', 'Ryan Air', '2022', '12', '9', 24, 45),
(13, 'repülő', 'Austrian Airlines', '2022', '12', '15', 8, 11),
(14, 'repülő', 'KLM Royal Dutch Airlines', '2022', '12', '26', 22, 24),
(15, 'repülő', 'British Airways', '2022', '12', '30', 36, 16),
(16, 'repülő', 'Austrian Airlines', '2022', '12', '5', 1, 8),
(17, 'repülő', 'Austrian Airlines', '2022', '12', '12', 1, 8),
(18, 'repülő', 'Austrian Airlines', '2022', '12', '19', 1, 8),
(19, 'repülő', 'Eurowings', '2022', '12', '15', 30, 1),
(20, 'repülő', 'Eurowings', '2022', '12', '19', 1, 32),
(21, 'repülő', 'Swiss Airlines', '2022', '12', '28', 1, 38),
(22, 'vonat', 'MÁV Magyar Államvasutak', '2022', '12', '3', 3, 2),
(23, 'vonat', 'MÁV Magyar Államvasutak', '2022', '12', '6', 4, 5),
(24, 'vonat', 'MÁV Magyar Államvasutak', '2022', '12', '17', 7, 4),
(25, 'vonat', 'MÁV Magyar Államvasutak', '2022', '12', '27', 1, 8),
(26, 'vonat', 'ÖBB Österreichische Bundesbahnen', '2022', '12', '17', 9, 29),
(27, 'vonat', 'ÖBB Österreichische Bundesbahnen', '2022', '12', '28', 11, 12),
(28, 'vonat', 'Eurostar', '2022', '12', '15', 24, 30),
(29, 'busz', 'Flixbus', '2022', '12', '1', 27, 14),
(30, 'busz', 'Flixbus', '2022', '12', '4', 15, 20),
(31, 'busz', 'National Express', '2022', '12', '18', 35, 36),
(32, 'busz', 'Eurolines', '2022', '12', '27', 23, 32),
(33, 'busz', 'Volánbusz', '2022', '12', '4', 2, 7),
(34, 'busz', 'Volánbusz', '2022', '12', '13', 3, 1),
(35, 'busz', 'Volánbusz', '2022', '12', '19', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `jegy`
--

CREATE TABLE `jegy` (
  `jegy_id` int(11) NOT NULL,
  `ar` float NOT NULL,
  `h_resz` char(1) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `h_szekszam` decimal(4,0) DEFAULT NULL,
  `jarat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `jegy`
--

INSERT INTO `jegy` (`jegy_id`, `ar`, `h_resz`, `h_szekszam`, `jarat_id`) VALUES
(1, 59.2, 'F', '7', 1),
(2, 60.8, 'H', '3', 1),
(3, 59.7, 'B', '5', 1),
(4, 169.99, 'L', '2', 5),
(5, 278.13, 'C', '4', 9),
(6, 97.4, 'K', '1', 13),
(7, 97.4, 'K', '2', 13),
(8, 572.1, 'D', '6', 15),
(9, 3.4, 'A', '27', 23),
(10, 3.6, 'B', '11', 23),
(11, 7.2, 'C', '56', 24),
(12, 7.9, 'A', '32', 24),
(13, 23.98, 'F', '21', 26),
(14, 24.12, 'F', '46', 26),
(15, 36.49, NULL, NULL, 29),
(16, 37.14, NULL, NULL, 29),
(17, 29.12, NULL, NULL, 31),
(18, 6, NULL, NULL, 34),
(19, 6, NULL, NULL, 34),
(20, 7.14, NULL, NULL, 35),
(21, 8.12, NULL, NULL, 33),
(22, 65.99, 'C', '6', 16),
(23, 109.99, 'A', '2', 17),
(24, 34.28, 'H', '5', 18),
(25, 55.99, 'L', '4', 19),
(26, 230.18, 'E', '2', 20),
(27, 72.99, 'G', '6', 21);

-- --------------------------------------------------------

--
-- Table structure for table `tartalmaz`
--

CREATE TABLE `tartalmaz` (
  `foglalas_id` int(11) NOT NULL,
  `jarat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `tartalmaz`
--

INSERT INTO `tartalmaz` (`foglalas_id`, `jarat_id`) VALUES
(1, 1),
(2, 3),
(3, 5),
(4, 9),
(4, 17),
(5, 13),
(6, 18),
(7, 20),
(8, 23),
(9, 25),
(10, 28),
(11, 29),
(12, 27);

-- --------------------------------------------------------

--
-- Table structure for table `ugyfel`
--

CREATE TABLE `ugyfel` (
  `email` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `vezeteknev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `keresztnev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `telefonszam` varchar(20) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `ugyfel`
--

INSERT INTO `ugyfel` (`email`, `vezeteknev`, `keresztnev`, `telefonszam`) VALUES
('albertp24@citromail.hu', 'Pintér', 'Albert', '+3655832005'),
('b_martina1972@freemail.hu', 'Bakos', 'Martina', '+3655135914'),
('bastig65@pm.me', 'Gauthier', 'Bastien', '+33935559978'),
('djoseph@gmail.co.uk', 'Doyle', 'Joseph', '1074586'),
('elinawby@yahoo.com', 'Winter', 'Elina', '+436609741144'),
('emayer452@mailbox.org', 'Mayer', 'Ella', '+4930066803607'),
('jakobsd12@gmail.com', 'Schmidt', 'Jakob', '+436600436863'),
('kbrandt@protonmail.com', 'Brandt', 'Käthe', '+4930809055802'),
('l_margot39@bouygtel.fr', 'Lemaire', 'Margot', '+33938917095'),
('paulbonnet13@gmail.com', 'Bonnet', 'Paul', '+33937151515');

-- --------------------------------------------------------

--
-- Table structure for table `varos`
--

CREATE TABLE `varos` (
  `varos_id` int(11) NOT NULL,
  `varosnev` varchar(85) COLLATE utf8_hungarian_ci NOT NULL,
  `iranyitoszam` varchar(10) COLLATE utf8_hungarian_ci NOT NULL,
  `orszag` varchar(56) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `varos`
--

INSERT INTO `varos` (`varos_id`, `varosnev`, `iranyitoszam`, `orszag`) VALUES
(1, 'Budapest', '1007', 'Hungary'),
(2, 'Debrecen', '4000', 'Hungary'),
(3, 'Szeged', '6700', 'Hungary'),
(4, 'Győr', '9000', 'Hungary'),
(5, 'Szombathely', '9700', 'Hungary'),
(6, 'Kecskemét', '6000', 'Hungary'),
(7, 'Miskolc', '3500', 'Hungary'),
(8, 'Vienna', '1010', 'Austria'),
(9, 'Graz', '8010', 'Austria'),
(10, 'Salzburg', '5020', 'Austria'),
(11, 'Klagenfurt am Wörthersee', '9020', 'Austria'),
(12, 'Innsbruck', '6020', 'Austria'),
(13, 'Linz', '4020', 'Austria'),
(14, 'Zürich', '5000', 'Switzerland'),
(15, 'Bern', '3000', 'Switzerland'),
(16, 'Geneva', '1200', 'Switzerland'),
(17, 'Paris', '75000', 'France'),
(18, 'Lyon', '69000', 'France'),
(19, 'Toulouse', '39230', 'France'),
(20, 'Montpellier', '34000', 'France'),
(21, 'Lille', '59000', 'France'),
(22, 'Bordeaux', '33000', 'France'),
(23, 'Madrid', '28001', 'Spain'),
(24, 'Barcelona', '08001', 'Spain'),
(25, 'Valencia', '46001', 'Spain'),
(26, 'Sevilla', '41001', 'Spain'),
(27, 'Zaragoza', '50001', 'Spain'),
(28, 'Hamburg', '20038', 'Germany'),
(29, 'Munich', '80331', 'Germany'),
(30, 'Cologne', '50667', 'Germany'),
(31, 'Frankfurt', '60306', 'Germany'),
(32, 'Stuttgart', '70173', 'Germany'),
(33, 'London', 'EC1A', 'United Kingdom'),
(34, 'Birmingham', 'B1', 'United Kingdom'),
(35, 'Manchester', 'M1', 'United Kingdom'),
(36, 'Glasgow', 'G1', 'United Kingdom'),
(37, 'Leeds', 'LS1', 'United Kingdom'),
(38, 'Tokyo', '103-8686', 'Japan'),
(39, 'Berlin', '10115', 'Germany'),
(40, 'Rio de Janeiro', '20000-000', 'Brazil'),
(41, 'Denver', '80014', 'United States'),
(42, 'Helsinki', '00100', 'Finland'),
(43, 'Nairobi', '00521', 'Kenya'),
(44, 'Bogotá', '110110', 'Colombia'),
(45, 'Palermo', '90121', 'Italy'),
(46, 'Marseille', '13000', 'France');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foglalas`
--
ALTER TABLE `foglalas`
  ADD PRIMARY KEY (`foglalas_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `jarat`
--
ALTER TABLE `jarat`
  ADD PRIMARY KEY (`jarat_id`),
  ADD KEY `honnan_varos_id` (`honnan_varos_id`),
  ADD KEY `hova_varos_id` (`hova_varos_id`);

--
-- Indexes for table `jegy`
--
ALTER TABLE `jegy`
  ADD PRIMARY KEY (`jegy_id`),
  ADD KEY `jarat_id` (`jarat_id`);

--
-- Indexes for table `tartalmaz`
--
ALTER TABLE `tartalmaz`
  ADD PRIMARY KEY (`foglalas_id`,`jarat_id`),
  ADD KEY `jarat_id` (`jarat_id`);

--
-- Indexes for table `ugyfel`
--
ALTER TABLE `ugyfel`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `varos`
--
ALTER TABLE `varos`
  ADD PRIMARY KEY (`varos_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foglalas`
--
ALTER TABLE `foglalas`
  MODIFY `foglalas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jarat`
--
ALTER TABLE `jarat`
  MODIFY `jarat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `jegy`
--
ALTER TABLE `jegy`
  MODIFY `jegy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `varos`
--
ALTER TABLE `varos`
  MODIFY `varos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foglalas`
--
ALTER TABLE `foglalas`
  ADD CONSTRAINT `foglalas_ibfk_1` FOREIGN KEY (`email`) REFERENCES `ugyfel` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jarat`
--
ALTER TABLE `jarat`
  ADD CONSTRAINT `jarat_ibfk_1` FOREIGN KEY (`honnan_varos_id`) REFERENCES `varos` (`varos_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jarat_ibfk_2` FOREIGN KEY (`hova_varos_id`) REFERENCES `varos` (`varos_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jegy`
--
ALTER TABLE `jegy`
  ADD CONSTRAINT `jegy_ibfk_1` FOREIGN KEY (`jarat_id`) REFERENCES `jarat` (`jarat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tartalmaz`
--
ALTER TABLE `tartalmaz`
  ADD CONSTRAINT `tartalmaz_ibfk_1` FOREIGN KEY (`foglalas_id`) REFERENCES `foglalas` (`foglalas_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tartalmaz_ibfk_2` FOREIGN KEY (`jarat_id`) REFERENCES `jarat` (`jarat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
