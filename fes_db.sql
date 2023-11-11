-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 11, 2023 at 03:17 AM
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
  `status` varchar(50) NOT NULL,
  `is_default` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_yr_tbl`
--

INSERT INTO `acad_yr_tbl` (`acad_id`, `year_start`, `year_end`, `semester`, `status`, `is_default`) VALUES
(1, '2023', '2024', 1, 'closed', 'no'),
(2, '2023', '2024', 2, 'closed', 'no'),
(3, '2023', '2024', 3, 'started', 'yes'),
(19, '2024', '2025', 1, 'pending', 'no'),
(20, '2024', '2025', 2, 'pending', 'no'),
(21, '2024', '2025', 3, 'pending', 'no');

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
(5, 'admin@gmail.com', 'Admin', '', 'User', '', 'admin@gmail.com', '2023-07-30 11:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `class_tbl`
--

CREATE TABLE `class_tbl` (
  `class_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `program_code` varchar(20) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `level` int(2) NOT NULL,
  `section` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_tbl`
--

INSERT INTO `class_tbl` (`class_id`, `program_id`, `program_code`, `program_name`, `level`, `section`) VALUES
(7, 6, 'BEED', 'Bachelor Of Science In Elementary Education', 1, 'A'),
(8, 5, 'BSIT', 'Bachelor Of Science In Information Technology', 2, 'A'),
(9, 5, 'BSIT', 'Bachelor Of Science In Information Technology', 1, 'A'),
(10, 8, 'BSIS', 'Bachelor Of Science In Information System', 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_tbl`
--

INSERT INTO `course_tbl` (`course_id`, `course_code`, `course_name`) VALUES
(4, 'ITE1', 'Data Warehousing 1'),
(5, 'ITE2', 'Security Issues and Principles 1'),
(6, 'ITO103', 'System Administration and Maintenance'),
(7, 'ITO110', 'Capstone B');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_tbl`
--

CREATE TABLE `criteria_tbl` (
  `criteria_id` int(11) NOT NULL,
  `criteria` varchar(100) NOT NULL,
  `criteria_order` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criteria_tbl`
--

INSERT INTO `criteria_tbl` (`criteria_id`, `criteria`, `criteria_order`) VALUES
(1, 'Attendance', 1),
(9, 'Mastery', 0),
(10, 'Understanding', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department_tbl`
--

CREATE TABLE `department_tbl` (
  `department_id` int(11) NOT NULL,
  `department_code` varchar(20) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_tbl`
--

INSERT INTO `department_tbl` (`department_id`, `department_code`, `department_name`) VALUES
(1, 'ics', 'institute of computing studies'),
(2, 'ied', 'institute of education');

-- --------------------------------------------------------

--
-- Table structure for table `eval_answer_tbl`
--

CREATE TABLE `eval_answer_tbl` (
  `answer_id` int(11) NOT NULL,
  `eval_id` varchar(30) NOT NULL,
  `question_id` int(11) NOT NULL,
  `score` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eval_answer_tbl`
--

INSERT INTO `eval_answer_tbl` (`answer_id`, `eval_id`, `question_id`, `score`) VALUES
(217, 'eval_id_1_1697051167', 171, 4),
(218, 'eval_id_1_1697051167', 188, 4),
(219, 'eval_id_1_1697051167', 186, 4),
(220, 'eval_id_1_1697051167', 189, 4),
(221, 'eval_id_1_1697051167', 190, 4),
(222, 'eval_id_1_1697051167', 191, 4),
(223, 'eval_id_1_1697051343', 171, 1),
(224, 'eval_id_1_1697051343', 188, 1),
(225, 'eval_id_1_1697051343', 186, 1),
(226, 'eval_id_1_1697051343', 189, 1),
(227, 'eval_id_1_1697051343', 190, 1),
(228, 'eval_id_1_1697051343', 191, 1),
(229, 'eval_id_5_1697053144', 171, 4),
(230, 'eval_id_5_1697053144', 188, 4),
(231, 'eval_id_5_1697053144', 186, 4),
(232, 'eval_id_5_1697053144', 189, 4),
(233, 'eval_id_5_1697053144', 190, 4),
(234, 'eval_id_5_1697053144', 191, 4);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eval_tbl`
--

INSERT INTO `eval_tbl` (`eval_id`, `acad_id`, `student_id`, `course_id`, `faculty_id`, `class_id`, `department`, `comments`, `date_taken`) VALUES
('eval_id_1_1697051167', 3, 1, 4, 1, 10, 'ics', 'test', '2023-10-12 03:06:18'),
('eval_id_1_1697051343', 3, 1, 5, 1, 10, 'ics', 'test', '2023-10-12 03:18:50'),
('eval_id_5_1697053144', 3, 5, 4, 1, 9, 'ics', 'test', '2023-10-12 03:39:12');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_tbl`
--

INSERT INTO `faculty_tbl` (`faculty_id`, `school_id`, `first_name`, `middle_name`, `last_name`, `ext_name`, `email`, `date_created`, `department`) VALUES
(1, '20-00239', 'Maria Theresa', '', 'Bayani', '', 'mariatheresabayani@pcb.edu.ph', '2023-07-30 12:09:20', 'ics'),
(3, '20-00238', 'Mark Anthony', '', 'Gantang', '', 'markanthonygantang@pcb.edu.ph', '2023-10-06 09:09:55', 'ied'),
(4, '20-00240', 'Mary Queen', '', 'Acera', '', 'maryqueenacera@pcb.edu.ph', '2023-10-06 10:16:09', 'ics');

-- --------------------------------------------------------

--
-- Table structure for table `program_tbl`
--

CREATE TABLE `program_tbl` (
  `program_id` int(11) NOT NULL,
  `program_code` varchar(20) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_tbl`
--

INSERT INTO `program_tbl` (`program_id`, `program_code`, `program_name`, `department_id`) VALUES
(5, 'BSIT', 'Bachelor Of Science In Information Technology', 1),
(6, 'BEED', 'Bachelor Of Science In Elementary Education', 2),
(7, 'BSCS', 'Bachelor Of Science In Computer Science', 1),
(8, 'BSIS', 'Bachelor Of Science In Information System', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_tbl`
--

CREATE TABLE `question_tbl` (
  `question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `acad_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_tbl`
--

INSERT INTO `question_tbl` (`question_id`, `question`, `acad_id`, `criteria_id`) VALUES
(171, 'Attendance 1', 3, 1),
(172, 'test questions 1', 1, 1),
(173, 'test questions 1', 1, 1),
(174, 'test questions 1', 2, 1),
(175, 'test questions 1', 2, 1),
(184, 'test questions 1', 2, 1),
(186, 'Mastery 1', 3, 9),
(188, 'Attendance 2', 3, 1),
(189, 'Mastery 2', 3, 9),
(190, 'Understanding Test 1', 3, 10),
(191, 'Understanding Test 2', 3, 10),
(192, 'Attendance 1', 19, 1),
(193, 'Attendance 2', 19, 1),
(194, 'Mastery 1', 19, 9),
(195, 'Mastery 2', 19, 9),
(196, 'Understanding Test 1', 19, 10),
(197, 'Understanding Test 2', 19, 10);

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
(1, '20-00237', 'Ralph', 'Docutin', 'Custodio', '', 10, 'ralphenigmatic@gmail.com', '2023-07-17 19:47:19'),
(5, '20-00236', 'Mikhaela Phoenix', 'Pangilinan', 'Marticion', '', 9, 'mikhaelaphoenixmarticion@pcb.edu.ph', '2023-10-01 13:22:05'),
(8, '20-00235', 'Abigail', 'Magno', 'Malveda', '', 8, 'abigailmalveda@pcb.edu.ph', '2023-10-07 11:11:30');

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
(8, '20-00236', '$2y$10$LzkxaYaGJuZ.MpJfZshT7O7zaq1Zb728Fw3U.867M8QSNYsKm4xEu', 'student', 'active'),
(11, '20-00238', '$2y$10$KaMSO5uQ33LvS3RqR3.Zhefnpog4IE9OtaiGQFv9YT4rjex1Dz5NO', 'faculty', 'active'),
(12, '20-00240', '$2y$10$XMs4NE8ZqdZGK0bJAg3wTeW6JrIWDNUIZ5qyWFr99QUqP0mOjR9/C', 'faculty', 'active'),
(13, '20-00235', '$2y$10$H1VA1o/ykKRdC5KeaCfOgeXpzFF5rZfD/f4wWGQRtA98OZYS2ez4u', 'student', 'active');

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
-- Indexes for table `department_tbl`
--
ALTER TABLE `department_tbl`
  ADD PRIMARY KEY (`department_id`);

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
-- Indexes for table `program_tbl`
--
ALTER TABLE `program_tbl`
  ADD PRIMARY KEY (`program_id`);

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
  MODIFY `acad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class_tbl`
--
ALTER TABLE `class_tbl`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_tbl`
--
ALTER TABLE `course_tbl`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `criteria_tbl`
--
ALTER TABLE `criteria_tbl`
  MODIFY `criteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `department_tbl`
--
ALTER TABLE `department_tbl`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `eval_answer_tbl`
--
ALTER TABLE `eval_answer_tbl`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `program_tbl`
--
ALTER TABLE `program_tbl`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `question_tbl`
--
ALTER TABLE `question_tbl`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
