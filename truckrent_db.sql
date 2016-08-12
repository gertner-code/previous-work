-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2016 at 08:16 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `truckrent.db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `streetaddress` varchar(30) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` set('AL','AK','AZ','AR','CA','CO','CT','DE','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY') NOT NULL,
  `zip` varchar(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `company` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `firstname`, `lastname`, `birthdate`, `streetaddress`, `city`, `state`, `zip`, `email`, `company`) VALUES
(2, 'John', 'smith', '1989-05-14', '13 friday road', 'Miketown', 'CA', '08240', 'john@abc.com', NULL),
(21, 'James', 'Matthew', '1991-05-20', '220 B street', 'New York', 'NY', '08212', 'jmatt@square.com', 'Extreme Fun '),
(22, 'Garth', 'Dodson', '1987-06-12', '1515 anonymous lane', 'Bergenfield', 'NJ', '07010', 'garth@amail.com', 'Mel''s movers'),
(23, 'Mallory', 'Cash', '1977-11-19', '57 Doloremque street', 'laborum', 'NY', '14866', 'cyfyripil@gmail.com', 'Odom and Powell Traders'),
(24, 'Oren', 'Knapp', '1976-06-19', '2023  Architect St', 'Dolorum', 'MS', '83736', 'ruqajusu@yahoo.com', 'Larsen Sloan Associates'),
(25, 'Dustin', 'Joyner', '1990-07-01', '437 Commander boulevard', 'Middleton', 'WA', '39784', 'becedad@yahoo.com', NULL),
(26, 'Driscoll', 'Jarvis', '1983-04-23', '70 Anthem lane', 'Provident', 'MS', '13966', 'sinosyfefe@gmail.com', 'Larsen Sloan Associates'),
(27, 'Warren', 'Chapman', '2010-04-17', '73 Estern lane', 'Provident', 'MS', '60113', 'fosavyqut@yahoo.com', 'Harrington Bass Associates'),
(29, 'Noel', 'Hansen', '1985-05-25', '583 Korning street', 'Springfield', 'MS', '86643', 'kypow@hotmail.com', 'Larsen Sloan Associates');

-- --------------------------------------------------------

--
-- Stand-in structure for view `display`
--
CREATE TABLE `display` (
`rentalId` int(11)
,`customerId` int(11)
,`startdate` date
,`enddate` date
,`cost` float
,`firstname` varchar(20)
,`lastname` varchar(20)
,`email` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `size` set('van','12','16','22','26') NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`size`, `price`) VALUES
('van', 75),
('12', 100),
('16', 130),
('22', 175),
('26', 225);

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `rentalId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `vehicleId` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`rentalId`, `customerId`, `vehicleId`, `startdate`, `enddate`, `cost`) VALUES
(21, 21, 118, '2016-08-25', '2016-08-27', 300),
(22, 21, 112, '2016-10-01', '2016-10-04', 400),
(23, 2, 125, '2016-08-14', '2016-08-17', 743.33),
(24, 22, 117, '2016-08-21', '2016-08-24', 372),
(25, 22, 102, '2016-11-07', '2016-11-12', 450),
(26, 23, 140, '2016-11-08', '2016-11-10', 675),
(27, 24, 120, '2016-12-12', '2016-12-18', 910),
(28, 25, 120, '2016-12-12', '2016-12-18', 910),
(29, 26, 112, '2017-01-23', '2017-02-01', 1000),
(30, 27, 113, '2017-01-03', '2017-01-07', 500),
(31, 25, 124, '2016-09-03', '2016-09-07', 650),
(33, 29, 100, '2016-09-03', '2016-09-13', 825);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicleId` int(11) NOT NULL,
  `size` set('van','12','16','22','26') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicleId`, `size`) VALUES
(100, 'van'),
(101, 'van'),
(102, 'van'),
(103, 'van'),
(104, 'van'),
(105, 'van'),
(106, 'van'),
(107, 'van'),
(108, 'van'),
(110, '12'),
(111, '12'),
(112, '12'),
(113, '12'),
(114, '12'),
(115, '12'),
(116, '12'),
(117, '12'),
(118, '12'),
(119, '12'),
(120, '16'),
(121, '16'),
(122, '16'),
(123, '16'),
(124, '16'),
(125, '16'),
(126, '16'),
(130, '22'),
(131, '22'),
(132, '22'),
(133, '22'),
(134, '22'),
(140, '26'),
(141, '26'),
(142, '26');

-- --------------------------------------------------------

--
-- Structure for view `display`
--
DROP TABLE IF EXISTS `display`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `display`  AS  select `rental`.`rentalId` AS `rentalId`,`rental`.`customerId` AS `customerId`,`rental`.`startdate` AS `startdate`,`rental`.`enddate` AS `enddate`,`rental`.`cost` AS `cost`,`customer`.`firstname` AS `firstname`,`customer`.`lastname` AS `lastname`,`customer`.`email` AS `email` from (`rental` join `customer` on((`rental`.`customerId` = `customer`.`customerId`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD UNIQUE KEY `firstname` (`firstname`,`lastname`,`email`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`size`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`rentalId`),
  ADD KEY `customerId` (`customerId`,`vehicleId`),
  ADD KEY `vehicleId` (`vehicleId`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicleId`),
  ADD UNIQUE KEY `vehicleId` (`vehicleId`),
  ADD KEY `vehicleId_2` (`vehicleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `rentalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE,
  ADD CONSTRAINT `rental_ibfk_2` FOREIGN KEY (`vehicleId`) REFERENCES `vehicles` (`vehicleId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
