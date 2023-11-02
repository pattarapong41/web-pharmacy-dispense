-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: 02 พ.ย. 2023 เมื่อ 02:27 PM
-- เวอร์ชันของเซิร์ฟเวอร์: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration_system`
--
CREATE DATABASE IF NOT EXISTS `registration_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `registration_system`;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `users_db`
--

CREATE TABLE `users_db` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) DEFAULT NULL,
  `ph_id` varchar(15) DEFAULT NULL,
  `first_name` varchar(225) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  `job_ad` varchar(225) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_num` varchar(13) NOT NULL,
  `password` varchar(100) NOT NULL,
  `urole` varchar(90) NOT NULL DEFAULT 'user',
  `verify_token` varchar(191) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `users_db`
--

INSERT INTO `users_db` (`id`, `user_id`, `ph_id`, `first_name`, `last_name`, `job_ad`, `tel`, `email`, `id_num`, `password`, `urole`, `verify_token`, `create_at`) VALUES
(14, 'Su_chao771', '62100', 'suchao', 'nudnum', 'sut hospital', '0827663012', 'suchao43@gmail.com', '1357210686882', 'QXpMjmu', 'user', '', '2023-10-11 07:02:19'),
(18, 'nata_za22', '73199', 'nata', 'pongsiri', 'bkhospital', '0991427765', 'nata.g@gmail.com', '1347710685414', 'LjD7WJb', 'user', '', '2023-10-11 07:02:19'),
(19, 'jo_za224', '40695', 'manunn', 'songsan', 'kyocera inc.', '0866128860', 'm.n12@gmail.com', '8888084401635', 'manan2543', 'user', '', '2023-10-11 07:02:19'),
(20, 'nongnat1011', '66790', 'Tanat', 'Tevanit', 'betime solution inc.', '0859763210', 'tanatkung.g12@gmail.com', '8452264016096', '5pLEc4q', 'user', '', '2023-10-11 07:02:19'),
(22, 'kao43_10', '31956', 'charyut', 'intarapanit', 'kyocera inc.', '0874612250', 'chayut43@hotmail.com', '6484438088971', 'ntfNVkJ', 'user', '', '2023-10-11 07:02:19'),
(48, 'bskt2000', NULL, 'Pattarapong', 'Suwanta', 'Daisin inc.', '0883120536', 'yuriredcommonder@gmail.com', '9999084401636', 'guboss53331', 'admin', '', '2023-10-27 02:09:08'),
(53, 'user129', 'สท.113', 'Pattarapong', 'Suwanta', 'sut hospital', '0922837053', 'b6121822boss@gmail.com', '1309902745224', 'wvlfUef', 'user', 'f2b3795f607cf6cf53f2a1b7da8d4ab2', '2023-10-31 13:14:44');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `users_dispense`
--

CREATE TABLE `users_dispense` (
  `id` int(11) NOT NULL,
  `id_num` varchar(20) NOT NULL,
  `firstn_lastn` varchar(255) NOT NULL,
  `ph_name` varchar(255) NOT NULL,
  `num_pills` varchar(15) NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `ex_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `users_dispense`
--

INSERT INTO `users_dispense` (`id`, `id_num`, `firstn_lastn`, `ph_name`, `num_pills`, `org_name`, `ex_date`) VALUES
(26, '1347710685414', 'nata  pongsiri', 'Bromocriptine ', '4 ', 'wewet clinic', '2022-11-24'),
(27, '1347710685414', 'nata  pongsiri', 'Carvedilol ', '5 ', 'wewet clinic', '2022-12-08'),
(28, '1357210686882', 'suchao nudnum', 'Bromocriptine ', '2 ', 'wewet clinic', '2022-07-15'),
(29, '1357210686882', 'suchao nudnum', 'parasettamon', '3 ', 'korat clinic', '2023-06-02'),
(34, '8888084401635', 'manun songsan', 'Bromocriptine ', '4', 'wewet clinic', '2022-09-08'),
(37, '8888084401635', 'manun songsan', 'Bromocriptine ', '8 ', 'kanya clinic', '2023-09-12'),
(40, '8452264016096', 'Tanat Tevanit', 'Amikacin', '5', 'kanya clinic', '2022-10-13'),
(43, '8452264016096', 'Tanat Tevanit', 'Amantadine ', '8', 'korat clinic', '2023-06-05'),
(44, '8452264016096', 'Tanat Tevanit', 'parasettamon', '3', 'korat clinic', '2023-04-21'),
(45, '1347710685414', 'nata pongsiri', 'Amikacin ', '6', 'kanya clinic', '2023-09-08'),
(47, '8452264016096', 'Tanat Tevanit', 'Amantadine', '9', 'korat clinic', '2023-09-08'),
(48, '8452264016096', 'Tanat Tevanit', 'Bromocriptine ', '4', 'wewet clinic', '2023-03-08'),
(49, '8452264016096', 'Tanat Tevanit', 'Amikacin ', '2', 'wewet clinic', '2023-02-02'),
(50, '6484438088971', 'chayut intarapanit', 'Amikacin ', '8', 'kanya clinic', '2023-09-30'),
(52, '6484438088971', 'chayut intarapanit', 'Bromocriptine ', '2', 'wewet clinic', '2023-07-05'),
(53, '6484438088971', 'chayut intarapanit', 'Beta Blockers', '4', 'korat clinic', '2023-10-02'),
(54, '6484438088971', 'chayut intarapanit', 'Bromocriptine ', '6', 'wewet clinic', '2023-09-14'),
(55, '6484438088971', 'chayut intarapanit', 'parasettamon', '7', 'aom clinic', '2023-04-24'),
(59, '2698617982854', 'tosapon intirat', 'Beta Blockers', '11', 'wewet clinic', '2023-10-04'),
(60, '8888084401635', 'manun songsan', 'sarah', '4', 'yothee clinic', '2023-06-02'),
(61, '7591197940254', 'Thammarat Ponthaisong', 'Citiezen', '14', 'kanya clinic', '2023-10-13'),
(62, '7591197940254', 'Thammarat Ponthaisong', 'Dicrofinac', '12', 'yothee clinic', '2023-06-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_db`
--
ALTER TABLE `users_db`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_dispense`
--
ALTER TABLE `users_dispense`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_db`
--
ALTER TABLE `users_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users_dispense`
--
ALTER TABLE `users_dispense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
