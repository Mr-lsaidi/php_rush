-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Jan 13, 2019 at 05:24 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ft_minishop`
--



-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `c_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `c_name`) VALUES
(1, 'Electronic'),
(2, 'Accessoire'),
(5, 'Pet supplies'),
(7, 'Women\'s Fashion');

-- --------------------------------------------------------

--
-- Table structure for table `categorie_product`
--

CREATE TABLE `categorie_product` (
  `it_detail` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `id_c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie_product`
--

INSERT INTO `categorie_product` (`it_detail`, `id_p`, `id_c`) VALUES
(5, 13, 1),
(6, 14, 2),
(7, 15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(18,2) DEFAULT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(2, 'OutdoorMaster OTG Skii', '15.00', 'https://images-na.ssl-images-amazon.com/images/I/51SOqso6W5L._AC_UL130_.jpg'),
(3, 'Furniture Repair Kit ', '10.00', 'https://images-na.ssl-images-amazon.com/images/I/51pQevfw%2BFL._AC_UL130_.jpg'),
(4, 'Westcott 8', '9.00', 'https://images-na.ssl-images-amazon.com/images/I/51xzPFWgvrL.__AC_SY400_.jpg'),
(5, 'Apple iPad Air A1474', '172.00', 'https://images-na.ssl-images-amazon.com/images/I/51I9uXVLVcL._AC_SY400_.jpg'),
(6, 'YI 2.7\" Screen Full HD', '50.00', 'https://images-na.ssl-images-amazon.com/images/I/41fmSOjqSrL._AC_UL130_.jpg'),
(13, 'The Legend of Zelda', '62.49', 'https://images-na.ssl-images-amazon.com/images/I/51Ox7m6-OIL._AC_SY400_.jpg'),
(14, 'Funturbo Nintendo Switch Stand', '55.12', 'https://images-na.ssl-images-amazon.com/images/I/41NEx5lRMrL._AC_SR320,320_.jpg'),
(15, 'Joycon Cover Protector', '8.89', 'https://images-na.ssl-images-amazon.com/images/I/51LQ1q9PlbL._AC_SR320,320_.jpg'),
(16, ' Earth Rated Dog Poop Bags', '11.99', 'https://images-na.ssl-images-amazon.com/images/I/41OywtuUK6L._AC_US320_FMwebp_QL65_.jpg'),
(17, 'Heigh heels', '154.12', 'https://images-na.ssl-images-amazon.com/images/G/01/gno/SiteDirectory/SD_exports_WomensFashion1x._CB470926956_.png');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `p_id`, `u_id`, `date_time`) VALUES
(23, 2, 8, '2019-01-13 16:28:19'),
(24, 3, 8, '2019-01-13 16:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `prevelige` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `prevelige`) VALUES
(8, 'karimstm', '66830349c857e55f3275caf675410fa4734313220b579543e2562126d7dd72da69a3122877f9972a20e909dd0460b59be27466a09852556800c5767b9c7fa0d1', 'admin'),
(11, 'lsaidi', '344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f', 'admin'),
(12, 'user', '74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_baskit` (`p_id`),
  ADD KEY `basket_ibfk_1` (`u_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorie_product`
--
ALTER TABLE `categorie_product`
  ADD PRIMARY KEY (`it_detail`),
  ADD KEY `id_c` (`id_c`),
  ADD KEY `categorie_product_ibfk_1` (`id_p`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_pur` (`p_id`),
  ADD KEY `purchase_ibfk_2` (`u_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categorie_product`
--
ALTER TABLE `categorie_product`
  MODIFY `it_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product_baskit` FOREIGN KEY (`p_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categorie_product`
--
ALTER TABLE `categorie_product`
  ADD CONSTRAINT `categorie_product_ibfk_1` FOREIGN KEY (`id_p`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categorie_product_ibfk_2` FOREIGN KEY (`id_c`) REFERENCES `categories` (`id`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `fk_product_pur` FOREIGN KEY (`p_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
