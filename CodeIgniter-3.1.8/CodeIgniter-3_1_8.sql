-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2018 at 11:45 AM
-- Server version: 5.7.22-0ubuntu18.04.1
-- PHP Version: 7.2.5-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CodeIgniter-3.1.8`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(155) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(155) NOT NULL,
  `activation_key` varchar(255) NOT NULL,
  `active_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `password`, `email`, `ip_address`, `activation_key`, `active_status`) VALUES
(20, 'naveen', '15fc4a53992beba40ae91e5244e79dff', 'nmohanan@suyati.com', '127.0.0.1', 'd533515af7f2ff057db31f35aab4899d53bca4fa', 1),
(21, 'naveen', '15fc4a53992beba40ae91e5244e79dff', 'nmohanan+1@suyati.com', '127.0.0.1', '9f7e8b7f7bb1ab9ec15fc2385f6bf4cc8d9bc84e', 1),
(22, 'nav', '15fc4a53992beba40ae91e5244e79dff', 'naveen.bos@gmail.com', '127.0.0.1', '29a3cfe1cabe81aa917fd1bbb4c968aae9126843', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
