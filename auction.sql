-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2017 at 06:56 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderId` int(11) NOT NULL,
  `BuyerUsr` varchar(30) NOT NULL,
  `SellerUsr` varchar(30) NOT NULL,
  `Amount` float NOT NULL,
  `Address` varchar(100) NOT NULL,
  `productId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderId`, `BuyerUsr`, `SellerUsr`, `Amount`, `Address`, `productId`, `Quantity`, `status`) VALUES
(1, 'Tanay', 'Udai', 70, 'Parbatia Main Road, Balugada Turning, Near Esi Dispensary', 6, 3, 1),
(2, 'Tanay', 'Udai', 700, 'Parbatia Main Road, Balugada Turning, Near Esi Dispensary', 3, 2, 1),
(3, 'Tanay', 'Rahul', 175001, 'Parbatia Main Road, Balugada Turning, Near Esi Dispensary', 7, 1, 0),
(4, 'Tanay', 'Rahul', 2500, 'Parbatia Main Road, Balugada Turning, Near Esi Dispensary', 9, 1, 0),
(5, 'Ankit', 'Rahul', 3500, 'vit bOYS hOSTEL', 9, 1, 1),
(6, 'Ankit', 'Udai', 1500, 'abc', 3, 3, 0),
(7, 'Tanay', 'Udai', 1700, 'Kings Palace', 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(30) NOT NULL,
  `maxbid` float NOT NULL,
  `minbid` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `sellerUsr` varchar(30) NOT NULL,
  `descp` varchar(150) NOT NULL,
  `currBid` float NOT NULL,
  `expiry` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productName`, `maxbid`, `minbid`, `quantity`, `sellerUsr`, `descp`, `currBid`, `expiry`) VALUES
(1, 'Regal Imported Soap', 750, 500, 20, 'Udai', 'Premium Soap imported from USA. Each Box contains 2 bricks.', 0, '2017-10-28'),
(3, 'Scented Candles', 3800, 2100, 34, 'Udai', 'Set of 10 scented candles. Scented rose', 0, '2018-12-31'),
(4, 'Apple Wireless Keyboard ', 13000, 8000, 4, 'Rahul', 'Imported Apple Wireless Keyboard with touch bar', 0, '2017-10-31'),
(6, 'Super Slime', 310, 120, 6, 'Udai', 'Super Slime with infinite life', 0, '2017-10-30'),
(7, 'Dell XPS 13 2017', 230000, 175000, 3, 'Rahul', 'Latest version of the XPS 13 Series. Imported from USA', 175001, '2017-12-27'),
(8, 'Death Note Notebook', 600, 350, 7, 'Rahul', 'Official Death Note Merchandise. Has 120 Pages.', 0, '2017-11-17'),
(9, 'Magnet Perfume', 13500, 10000, 3, 'Rahul', 'Synthetic perfume imported form France', 0, '2017-11-04'),
(10, 'Tanishq Gold Watch', 200000, 75000, 1, 'Rahul', '22K gold watch with hall mark. ', 0, '2017-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `pass` varchar(15) DEFAULT NULL,
  `first_name` varchar(10) DEFAULT NULL,
  `last_name` varchar(10) DEFAULT NULL,
  `dob` varchar(8) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pass`, `first_name`, `last_name`, `dob`, `role`, `email`) VALUES
('Ankit', '5', 'Ankit', 'Jain', '27/12/98', 'buyer', 'ankitjain@gmail.com'),
('Rahul', '4', 'Rahul', 'Kelkar', '29/02/98', 'seller', 'rahulanoop@gmail.com'),
('Sparsh', '3', 'Sparsh', 'Agarwal', '27/11/97', 'svp', 'sparshagarwal100@gmail.com'),
('Tanay', '1', 'Tanay', 'Agarwal', '26/12/97', 'buyer', 'tanay1up@gmail.com'),
('Udai', '2', 'udai', 'Agarwal', '07/01/97', 'seller', 'udaiag@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `productId` (`productId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
