-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2019 at 02:27 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data`
--

-- --------------------------------------------------------

--
-- Table structure for table `poster`
--

CREATE TABLE `poster` (
  `p_id` int(11) NOT NULL,
  `p_image` varchar(200) NOT NULL,
  `p_name` varchar(200) NOT NULL,
  `p_text` text NOT NULL,
  `p_uni_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poster`
--

INSERT INTO `poster` (`p_id`, `p_image`, `p_name`, `p_text`, `p_uni_id`) VALUES
(1, 'post1.jpg', 'Poster Title 1', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 617170153473524),
(2, 'post2.jpg', 'Poster Title 2', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 236324450742682),
(3, 'post3.jpg', 'Poster Title 3', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 847455276178333),
(4, 'post4.jpg', 'Poster Title 4', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 326134119269782),
(5, 'post5.jpg', 'Poster Title 5', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 609273468169791),
(6, 'post6.jpg', 'Poster Title 6', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 707901040811620),
(7, 'post7.jpg', 'Poster Title 7', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 449648399939070),
(8, 'post8.jpg', 'Poster Title 8', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 233370141348581),
(9, 'post9.jpg', 'Poster Title 9', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 729451734285121),
(10, 'post10.jpg', 'Poster Title 10', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 483321443763474),
(11, 'post11.jpg', 'Poster Title 11', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 994758050014835),
(12, 'post12.jpg', 'Poster Title 12', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 550470724832144);

-- --------------------------------------------------------

--
-- Table structure for table `rating_info`
--

CREATE TABLE `rating_info` (
  `r_id` int(11) NOT NULL,
  `r_u_id` bigint(20) NOT NULL,
  `r_p_id` bigint(20) NOT NULL,
  `r_u_choice` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating_info`
--

INSERT INTO `rating_info` (`r_id`, `r_u_id`, `r_p_id`, `r_u_choice`) VALUES
(19, 328759437979450, 617170153473524, 'Dislike'),
(20, 328759437979450, 236324450742682, 'Like'),
(21, 328759437979450, 609273468169791, 'Like'),
(22, 328759437979450, 449648399939070, 'Like'),
(23, 328759437979450, 550470724832144, 'Like'),
(24, 328759437979450, 847455276178333, 'Dislike'),
(25, 328759437979450, 707901040811620, 'Dislike'),
(26, 999761133054490, 617170153473524, 'Dislike'),
(27, 999761133054490, 236324450742682, 'Dislike'),
(28, 999761133054490, 326134119269782, 'Dislike'),
(29, 999761133054490, 449648399939070, 'Dislike'),
(30, 999761133054490, 233370141348581, 'Like'),
(31, 999761133054490, 729451734285121, 'Like'),
(32, 280479578480934, 617170153473524, 'Dislike'),
(33, 280479578480934, 236324450742682, 'Dislike'),
(34, 280479578480934, 847455276178333, 'Like'),
(35, 280479578480934, 609273468169791, 'Like'),
(36, 280479578480934, 707901040811620, 'Like'),
(37, 869287089555991, 617170153473524, 'Dislike'),
(38, 869287089555991, 236324450742682, 'Like'),
(39, 869287089555991, 847455276178333, 'Like'),
(40, 869287089555991, 609273468169791, 'Like'),
(41, 869287089555991, 550470724832144, 'Like'),
(42, 869287089555991, 729451734285121, 'Dislike'),
(43, 869287089555991, 707901040811620, 'Dislike');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_image` varchar(200) NOT NULL,
  `u_name` varchar(200) NOT NULL,
  `u_pass` varchar(200) NOT NULL,
  `u_uni_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_image`, `u_name`, `u_pass`, `u_uni_no`) VALUES
(1, 'user1.png', 'user1', '12345678', 328759437979450),
(2, 'user2.png', 'user2', '12345678', 185472960356631),
(3, 'user3.png', 'user3', '12345678', 385019877605097),
(4, 'user4.png', 'user4', '12345678', 127718463219333),
(5, 'user5.png', 'user5', '12345678', 999761133054490),
(6, 'user6.png', 'user6', '12345678', 422328655574284),
(7, 'user7.png', 'user7', '12345678', 822577585054926),
(8, 'user8.png', 'user8', '12345678', 280479578480934),
(9, 'user9.png', 'user9', '12345678', 698460598171496),
(10, 'user10.png', 'user10', '12345678', 869287089555991);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_uni_id` (`p_uni_id`);

--
-- Indexes for table `rating_info`
--
ALTER TABLE `rating_info`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `r_u_id` (`r_u_id`),
  ADD KEY `r_p_id` (`r_p_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_uni_no` (`u_uni_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `poster`
--
ALTER TABLE `poster`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rating_info`
--
ALTER TABLE `rating_info`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rating_info`
--
ALTER TABLE `rating_info`
  ADD CONSTRAINT `rating_info_ibfk_1` FOREIGN KEY (`r_u_id`) REFERENCES `user` (`u_uni_no`),
  ADD CONSTRAINT `rating_info_ibfk_2` FOREIGN KEY (`r_p_id`) REFERENCES `poster` (`p_uni_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
