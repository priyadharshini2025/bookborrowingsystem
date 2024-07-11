-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 08:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_borrower_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_list`
--

CREATE TABLE `tbl_book_list` (
  `tbl_book_list_id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `uploader_email` varchar(255) NOT NULL,
  `uploader_phone` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tbl_book_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_book_list`
--
INSERT INTO `tbl_book_list` (`tbl_book_list_id`, `book_title`, `book_author`, `uploader_email`, `uploader_phone`, `date_added`) VALUES
(1, 'Lean PHP', 'Lorem Ipsum', 'uploader1@example.com', '1234567890', '2023-11-15 23:58:22'),
(2, 'Introduction to JavaScript', 'John Doe', 'uploader2@example.com', '0987654321', '2023-11-15 23:58:37'),
(3, 'HTML & CSS: Design and Build Web Sites', 'Jane Doe', 'uploader3@example.com', '1122334455', '2023-11-15 23:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrowed_book`
--

CREATE TABLE `tbl_borrowed_book` (
  `tbl_borrowed_book_id` int(11) NOT NULL,
  `tbl_book_list_id` int(11) NOT NULL,
  `borrower_name` varchar(255) NOT NULL,
  `borrower_contact` varchar(255) NOT NULL,
  `borrower_email` varchar(255) NOT NULL,
  `date_borrowed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_return` datetime NOT NULL,
  PRIMARY KEY (`tbl_borrowed_book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_borrowed_book`
--

INSERT INTO `tbl_borrowed_book` (`tbl_borrowed_book_id`, `tbl_book_list_id`, `borrower_name`, `borrower_contact`, `borrower_email`, `date_borrowed`, `date_return`) VALUES
(1, 1, 'Lorem Doe', '091234456', 'borrower1@example.com', '2023-11-16 06:59:00', '2023-11-17 15:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_book_list`
--
ALTER TABLE `tbl_book_list`
  ADD PRIMARY KEY (`tbl_book_list_id`);

--
-- Indexes for table `tbl_borrowed_book`
--
ALTER TABLE `tbl_borrowed_book`
  ADD PRIMARY KEY (`tbl_borrowed_book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_book_list`
--
ALTER TABLE `tbl_book_list`
  MODIFY `tbl_book_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_borrowed_book`
--
ALTER TABLE `tbl_borrowed_book`
  MODIFY `tbl_borrowed_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
