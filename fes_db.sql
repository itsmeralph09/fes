-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 03, 2023 at 12:53 PM
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
-- Database: `fes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acad_yr_tbl`
--

CREATE TABLE `acad_yr_tbl` (
  `acad_id` int(11) NOT NULL,
  `year_start` year(4) NOT NULL,
  `year_end` year(4) NOT NULL,
  `semester` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_yr_tbl`
--

INSERT INTO `acad_yr_tbl` (`acad_id`, `year_start`, `year_end`, `semester`, `status`) VALUES
(1, '2023', '2024', 1, 'closed'),
(2, '2023', '2024', 2, 'started'),
(3, '2023', '2024', 3, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `ext_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `school_id`, `first_name`, `middle_name`, `last_name`, `ext_name`, `email`, `date_created`) VALUES
(5, 'admin@gmail.com', 'Admin', '', 'User', '', 'admin@gmail.com', '2023-07-30 11:55:23'),
(7, 'admin2', 'Adminis', '', 'Traitor', '', 'admin2@gmail.com', '2023-07-30 12:13:54');

-- --------------------------------------------------------

--
-- Table structure for table `class_tbl`
--

CREATE TABLE `class_tbl` (
  `class_id` int(11) NOT NULL,
  `program_code` varchar(20) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `level` int(2) NOT NULL,
  `section` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_tbl`
--

INSERT INTO `class_tbl` (`class_id`, `program_code`, `program_name`, `level`, `section`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology', 1, 'A'),
(2, 'BSCS', 'Bachelor of Science in Computer Sciene', 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_tbl`
--

CREATE TABLE `faculty_tbl` (
  `faculty_id` int(11) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `ext_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_tbl`
--

INSERT INTO `faculty_tbl` (`faculty_id`, `school_id`, `first_name`, `middle_name`, `last_name`, `ext_name`, `email`, `date_created`) VALUES
(1, '20-00239', 'Maria Theresa', '', 'Bayani', '', 'mariatheresabayani@pcb.edu.ph', '2023-07-30 12:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `ext_name` varchar(20) NOT NULL,
  `class_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `school_id`, `first_name`, `middle_name`, `last_name`, `ext_name`, `class_id`, `email`, `date_created`) VALUES
(1, '20-00237', 'Ralph', 'Docutin', 'Custodio', '', 1, 'ralphenigamtic@gmail.com', '2023-07-17 19:47:19'),
(4, '20-00240', 'Mikhaela Phoenix', 'Pangilinan', 'Marticion', '', 1, 'mikhaelaphoenixmarticion@pcb.edu.ph', '2023-07-30 12:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `school_id` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `school_id`, `password`, `role`, `status`) VALUES
(2, '20-00237', '$2y$10$p/KZNtgn50uPlG4IKCiAvOv.tQdOYHQf7rVMRiDnHBXf44UBe8tim', 'student', 'active'),
(3, 'admin@gmail.com', '$2y$10$uqaCsHd7UFKGUklmwtsM0OP1hCVFE6GRIteEaZyWOExtOIboFG5XW', 'admin', 'active'),
(4, '20-00239', '$2y$10$h9.mA5IbxcZBP7rDditzo.IaPFw18BTsV9D5fMKWRdB4sHp7GPnI2', 'faculty', 'active'),
(5, 'admin2', '$2y$10$NgyB5lOBblg2vEemBP2O2OnYffHCCAF04hRNdu4rpMR6nXnFhwAlq', 'faculty', 'active'),
(6, '20-00240', '$2y$10$oIFk3jQIwnOR/LomANn4B.uKNEXqeXP9aIH3WgoyL/sHppblj4VU.', 'faculty', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acad_yr_tbl`
--
ALTER TABLE `acad_yr_tbl`
  ADD PRIMARY KEY (`acad_id`);

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `class_tbl`
--
ALTER TABLE `class_tbl`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acad_yr_tbl`
--
ALTER TABLE `acad_yr_tbl`
  MODIFY `acad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class_tbl`
--
ALTER TABLE `class_tbl`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
