-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 22, 2023 at 04:32 PM
-- Server version: 10.9.4-MariaDB-1:10.9.4+maria~ubu2204
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(255) NOT NULL,
  `title` varchar(900) NOT NULL,
  `author` varchar(900) DEFAULT NULL,
  `description` varchar(9000) DEFAULT NULL,
  `availability` tinyint(1) NOT NULL,
  `lendingDate` date DEFAULT NULL,
  `returnDate` date DEFAULT NULL,
  `genre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `description`, `availability`, `lendingDate`, `returnDate`, `genre`) VALUES
(1, 'How useful php is', 'The Author', 'This books makes you understand that struggling for months on php is not that useful since they programmed an AI that can do many things better than you ever will', 1, NULL, NULL, 'Study Material'),
(2, 'Guinness is good for you', 'Beer Company', 'Guinnes is a great beer and it is good for you: not only it has a lower alcohol percentage than the average beer, it is also rich in vitamins and iron which are good for you.', 1, NULL, NULL, 'Food & Drinks'),
(3, 'HTML & CSS', 'Jon Duckett', 'HTML and Css basic knowledge which will help you build a website in early 90\'s style because if you don\'t use Javascript, well good luck getting a job.', 1, NULL, NULL, 'Study Material');

-- --------------------------------------------------------

--
-- Table structure for table `book_user`
--

CREATE TABLE `book_user` (
  `user_id` int(255) NOT NULL,
  `book_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `email` varchar(500) NOT NULL,
  `balance` float(30,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `balance`) VALUES
(1, 'Mario', '$2y$10$G4tYXYzcrBf1HpNflpKQuO3Y55qRHXca/8Jm8PryC/J0jEoku6YJO', 'supermario@gmail.com', 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_user`
--
ALTER TABLE `book_user`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
