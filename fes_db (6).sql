-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 09:05 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

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
  `status` varchar(50) NOT NULL,
  `is_default` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acad_yr_tbl`
--

INSERT INTO `acad_yr_tbl` (`acad_id`, `year_start`, `year_end`, `semester`, `status`, `is_default`) VALUES
(1, 2023, 2024, 1, 'closed', 'no'),
(2, 2023, 2024, 2, 'closed', 'no'),
(3, 2023, 2024, 3, 'started', 'yes');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `school_id`, `first_name`, `middle_name`, `last_name`, `ext_name`, `email`, `date_created`) VALUES
(5, 'admin@gmail.com', 'Admin', '', 'User', '', 'admin@gmail.com', '2023-07-30 11:55:23');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_tbl`
--

INSERT INTO `class_tbl` (`class_id`, `program_code`, `program_name`, `level`, `section`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology', 1, 'A'),
(2, 'BSCS', 'Bachelor of Science in Computer Sciene', 1, 'A'),
(3, 'ACT', 'Associate in Computer Technology', 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_tbl`
--

INSERT INTO `course_tbl` (`course_id`, `course_code`, `course_name`) VALUES
(4, 'ITE1', 'Data Warehousing 1'),
(5, 'ITE2', 'Security Issues and Principles 1');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_tbl`
--

CREATE TABLE `criteria_tbl` (
  `criteria_id` int(11) NOT NULL,
  `criteria` varchar(100) NOT NULL,
  `criteria_order` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `criteria_tbl`
--

INSERT INTO `criteria_tbl` (`criteria_id`, `criteria`, `criteria_order`) VALUES
(1, 'Attendance', 1),
(9, 'Mastery', 0),
(10, 'Understanding', 0);

-- --------------------------------------------------------

--
-- Table structure for table `eval_answer_tbl`
--

CREATE TABLE `eval_answer_tbl` (
  `answer_id` int(11) NOT NULL,
  `eval_id` varchar(30) NOT NULL,
  `question_id` int(11) NOT NULL,
  `score` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eval_answer_tbl`
--

INSERT INTO `eval_answer_tbl` (`answer_id`, `eval_id`, `question_id`, `score`) VALUES
(181, 'eval_id_1_1696154627', 171, 2),
(182, 'eval_id_1_1696154627', 188, 4),
(183, 'eval_id_1_1696154627', 186, 4),
(184, 'eval_id_1_1696154627', 189, 4),
(185, 'eval_id_1_1696154627', 190, 4),
(186, 'eval_id_1_1696154627', 191, 4),
(187, 'eval_id_5_1696230361', 171, 4),
(188, 'eval_id_5_1696230361', 188, 4),
(189, 'eval_id_5_1696230361', 186, 4),
(190, 'eval_id_5_1696230361', 189, 4),
(191, 'eval_id_5_1696230361', 190, 4),
(192, 'eval_id_5_1696230361', 191, 4);

-- --------------------------------------------------------

--
-- Table structure for table `eval_tbl`
--

CREATE TABLE `eval_tbl` (
  `eval_id` varchar(30) NOT NULL,
  `acad_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `department` varchar(10) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `date_taken` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eval_tbl`
--

INSERT INTO `eval_tbl` (`eval_id`, `acad_id`, `student_id`, `course_id`, `faculty_id`, `class_id`, `department`, `comments`, `date_taken`) VALUES
('eval_id_1_1696154627', 3, 1, 4, 1, 2, 'ics', 'test', '2023-10-01 18:04:34'),
('eval_id_5_1696230361', 3, 5, 4, 1, 1, 'ics', 'test2', '2023-10-02 15:06:12');

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
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_tbl`
--

INSERT INTO `faculty_tbl` (`faculty_id`, `school_id`, `first_name`, `middle_name`, `last_name`, `ext_name`, `email`, `date_created`, `department`) VALUES
(1, '20-00239', 'Maria Theresa', '', 'Bayani', '', 'mariatheresabayani@pcb.edu.ph', '2023-07-30 12:09:20', 'ics');

-- --------------------------------------------------------

--
-- Table structure for table `question_tbl`
--

CREATE TABLE `question_tbl` (
  `question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `acad_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_tbl`
--

INSERT INTO `question_tbl` (`question_id`, `question`, `acad_id`, `criteria_id`) VALUES
(171, 'Attendance 1', 3, 1),
(172, 'test questions 1', 1, 1),
(173, 'test questions 1', 1, 1),
(174, 'test questions 1', 2, 1),
(175, 'test questions 1', 2, 1),
(178, 'test questions 1', 1, 1),
(179, 'test questions 1', 1, 1),
(184, 'test questions 1', 2, 1),
(185, 'test questions 1', 2, 1),
(186, 'Mastery 1', 3, 9),
(187, 'anong english ng aso', 1, 9),
(188, 'Attendance 2', 3, 1),
(189, 'Mastery 2', 3, 9),
(190, 'Understanding Test 1', 3, 10),
(191, 'Understanding Test 2', 3, 10);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `school_id`, `first_name`, `middle_name`, `last_name`, `ext_name`, `class_id`, `email`, `date_created`) VALUES
(1, '20-00237', 'Ralph', 'Docutin', 'Custodio', '', 2, 'ralphenigamtic@gmail.com', '2023-07-17 19:47:19'),
(5, '20-00240', 'Mikhaela Phoenix', 'Pangilinan', 'Marticion', '', 1, 'mikhaelaphoenixmarticion@pcb.edu.ph', '2023-10-01 13:22:05');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `school_id`, `password`, `role`, `status`) VALUES
(2, '20-00237', '$2y$10$p/KZNtgn50uPlG4IKCiAvOv.tQdOYHQf7rVMRiDnHBXf44UBe8tim', 'student', 'active'),
(3, 'admin@gmail.com', '$2y$10$uqaCsHd7UFKGUklmwtsM0OP1hCVFE6GRIteEaZyWOExtOIboFG5XW', 'admin', 'active'),
(4, '20-00239', '$2y$10$h9.mA5IbxcZBP7rDditzo.IaPFw18BTsV9D5fMKWRdB4sHp7GPnI2', 'faculty', 'active'),
(8, '20-00240', '$2y$10$LzkxaYaGJuZ.MpJfZshT7O7zaq1Zb728Fw3U.867M8QSNYsKm4xEu', 'student', 'active');

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
-- Indexes for table `course_tbl`
--
ALTER TABLE `course_tbl`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `criteria_tbl`
--
ALTER TABLE `criteria_tbl`
  ADD PRIMARY KEY (`criteria_id`);

--
-- Indexes for table `eval_answer_tbl`
--
ALTER TABLE `eval_answer_tbl`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `eval_tbl`
--
ALTER TABLE `eval_tbl`
  ADD PRIMARY KEY (`eval_id`);

--
-- Indexes for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `question_tbl`
--
ALTER TABLE `question_tbl`
  ADD PRIMARY KEY (`question_id`);

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
  MODIFY `acad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class_tbl`
--
ALTER TABLE `class_tbl`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_tbl`
--
ALTER TABLE `course_tbl`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `criteria_tbl`
--
ALTER TABLE `criteria_tbl`
  MODIFY `criteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `eval_answer_tbl`
--
ALTER TABLE `eval_answer_tbl`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question_tbl`
--
ALTER TABLE `question_tbl`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
