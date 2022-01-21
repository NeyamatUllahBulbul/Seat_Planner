-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 04:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seat_planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `dept_id` int(11) NOT NULL,
  `co_ordinator` varchar(200) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `name`, `details`, `dept_id`, `co_ordinator`, `status`) VALUES
(2, 'CSE100', '', 2, 'Samad', 'Active'),
(3, 'EEE115', '', 3, 'Noman', 'Active'),
(4, 'IT', '', 2, 'Kamal', 'Active'),
(5, 'Phermacy', 'dcbdcndck', 2, 'cjjc', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `head` varchar(100) NOT NULL,
  `slug` varchar(5) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `details`, `head`, `slug`, `status`) VALUES
(2, 'Computer Engineering', 'Students study computer', 'Miraj Hossain', 'CSE', 'Active'),
(3, 'Electric and Electronic Engineering', '', 'Shiba', 'EEE', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `seat_plans`
--

CREATE TABLE `seat_plans` (
  `id` int(11) NOT NULL,
  `first_batch` int(11) NOT NULL,
  `first_subject` varchar(100) NOT NULL,
  `second_batch` int(11) NOT NULL,
  `second_subject` varchar(100) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `room_no` varchar(100) NOT NULL,
  `seat` int(11) NOT NULL,
  `column_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seat_plans`
--

INSERT INTO `seat_plans` (`id`, `first_batch`, `first_subject`, `second_batch`, `second_subject`, `exam_name`, `date`, `time`, `room_no`, `seat`, `column_number`) VALUES
(1, 2, 'Computing', 3, 'Electric', 'Mid term Examination-2021', '2021-08-09', '20:00:00', '305', 60, 4),
(14, 3, 'Electronics', 4, 'Analysis and design', 'Mid-term Examination 2021', '2021-08-16', '19:01:00', '305', 60, 2),
(15, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(16, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(17, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(18, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(19, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(20, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(21, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(22, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(23, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(24, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(25, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(26, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(27, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-08-19', '20:26:00', '305', 60, 4),
(28, 3, 'Computing', 3, 'Networking', 'Mid term Examination-2021', '2021-09-10', '23:21:00', '308', 100, 3),
(29, 3, 'Computing', 3, 'Networking', 'Mid term Examination-2021', '2021-09-10', '23:21:00', '308', 100, 3),
(30, 2, 'Computing', 3, 'Electronic', 'Mid-term Examination 2021', '2021-10-21', '21:38:00', '305', 70, 4),
(31, 2, 'Computing', 3, 'Electric', 'Mid term Examination-2021', '2022-01-08', '20:53:00', '305', 20, 2),
(32, 2, 'Computing', 3, 'Electric', 'Mid term Examination-2021', '2022-01-15', '20:55:00', '305', 100, 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `guardian_name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `date_of_birth` date NOT NULL,
  `student_id` varchar(6) NOT NULL,
  `student_email` varchar(30) NOT NULL,
  `batch_id` varchar(10) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `guardian_name`, `phone`, `date_of_birth`, `student_id`, `student_email`, `batch_id`, `status`) VALUES
(2, 'Neyamat', 'Mofazzal', '01772769904', '0000-00-00', '100855', '100855@sub.ac', '2', 'Active'),
(3, 'Neyamat', 'Mofazzal', '01772769904', '0000-00-00', '100856', '100856@sub.ac', '2', 'Active'),
(4, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100857', '100857@sub.ac', '2', 'Active'),
(5, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100858', '100858@sub.ac', '2', 'Active'),
(6, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100859', '100859@sub.ac', '2', 'Active'),
(7, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100860', '100860@sub.ac', '2', 'Active'),
(8, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100861', '100861@sub.ac', '2', 'Active'),
(9, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100862', '100862@sub.ac', '2', 'Active'),
(10, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100863', '100863@sub.ac', '2', 'Active'),
(11, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100864', '100864@sub.ac', '2', 'Active'),
(12, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100865', '100865@sub.ac', '2', 'Active'),
(13, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100866', '100866@sub.ac', '2', 'Active'),
(14, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100867', '100868@sub.ac', '2', 'Active'),
(15, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100869', '100869@sub.ac', '2', 'Active'),
(16, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100870', '100870@sub.ac', '2', 'Active'),
(17, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100871', '100871@sub.ac', '2', 'Active'),
(18, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100872', '100872@sub.ac', '2', 'Active'),
(19, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100873', '100873@sub.ac', '2', 'Active'),
(20, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100874', '100874@sub.ac', '2', 'Active'),
(21, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100875', '100875@sub.ac', '2', 'Active'),
(22, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100876', '100876@sub.ac', '2', 'Active'),
(23, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100877', '100877@sub.ac', '2', 'Active'),
(24, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100878', '100878@sub.ac', '2', 'Active'),
(25, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100879', '100879@sub.ac', '2', 'Active'),
(26, 'Neyamat', 'Mofazzal', '01772769904', '1998-06-05', '100880', '100880@sub.ac', '2', 'Active'),
(27, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100650', '100650@sub.ac', '3', 'Active'),
(28, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100651', '10051@sub.ac', '3', 'Active'),
(29, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100652', '100652@sub.ac', '3', 'Active'),
(30, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100653', '100653@sub.ac', '3', 'Active'),
(31, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100654', '100654@sub.ac', '3', 'Active'),
(32, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100655', '100655@sub.ac', '3', 'Active'),
(33, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100656', '100656@sub.ac', '3', 'Active'),
(34, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100657', '100657@sub.ac', '3', 'Active'),
(35, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100658', '100658@sub.ac', '3', 'Active'),
(36, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100659', '100659@sub.ac', '3', 'Active'),
(37, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100660', '100660@sub.ac', '3', 'Active'),
(38, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100661', '100661@sub.ac', '3', 'Active'),
(39, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100662', '100662@sub.ac', '3', 'Active'),
(40, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100663', '100663@sub.ac', '3', 'Active'),
(41, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100664', '100664@sub.ac', '3', 'Active'),
(42, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100665', '100665@sub.ac', '3', 'Active'),
(43, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100666', '100666@sub.ac', '3', 'Active'),
(44, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100667', '100667@sub.ac', '3', 'Active'),
(45, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100668', '100668@sub.ac', '3', 'Active'),
(46, 'Miraj', 'Mujibur Rahman', '01772768804', '1998-06-05', '100669', '100669@sub.ac', '3', 'Active'),
(47, 'Roman', 'Jamal', '01884620196', '2021-08-16', '100785', '100785@sub.ac', '4', 'Active'),
(48, 'jawad', 'joynal', '01554142545', '2021-08-16', '100786', '100786@sub.ac', '4', 'Active'),
(49, 'jawad', 'joynal', '01554142545', '2021-08-16', '100787', '100787@sub.ac', '4', 'Active'),
(50, 'jawad', 'joynal', '01554142545', '2021-08-16', '100788', '100788@sub.ac', '4', 'Active'),
(51, 'jawad', 'joynal', '01554142545', '2021-08-16', '100789', '100789@sub.ac', '4', 'Active'),
(52, 'jawad', 'joynal', '01554142545', '2021-08-16', '100790', '100790@sub.ac', '4', 'Active'),
(53, 'jawad', 'joynal', '01554142545', '2021-08-16', '100791', '100791@sub.ac', '4', 'Active'),
(54, 'jawad', 'joynal', '01554142545', '2021-08-16', '100792', '100792@sub.ac', '4', 'Active'),
(55, 'jawad', 'joynal', '01554142545', '2021-08-16', '100793', '100793@sub.ac', '4', 'Active'),
(56, 'jawad', 'joynal', '01554142545', '2021-08-16', '100794', '100794@sub.ac', '4', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `status`) VALUES
(1, 'Admin', 'admin', 'admin@admin.com', '5a05254570cc97ac9582ad7c5877f1ad', 'Active');

CREATE TABLE `semesters` (
     `id` int(11) NOT NULL,
     `name` varchar(255) NOT NULL,
     `start_date` date DEFAULT NULL,
     `end_date` date DEFAULT NULL,
     `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`, `start_date`, `end_date`, `status`) VALUES
(2, 'Summer', '0000-00-00', '0000-00-00', 'Active');
--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `credit`) VALUES
(2, 'Agile Development', 4);

--
--
-- Table structure for table `exam_routine`
--

CREATE TABLE `exam_routine` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `semister_id` int(11) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_routine`
--

INSERT INTO `exam_routine` (`id`, `batch_id`, `semister_id`, `photo`) VALUES
(3, 4, 2, 'images/routine/android.PNG');

CREATE TABLE `assigned_batch_subjects` (
   `id` int(11) NOT NULL,
   `batch_id` int(11) NOT NULL,
   `semister_id` int(11) NOT NULL,
   `subjects_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--
--
--
-- Indexes for table `exam_routine`
--
ALTER TABLE `exam_routine`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `assigned_batch_subjects`
    ADD PRIMARY KEY (`id`);
--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seat_plans`
--
ALTER TABLE `seat_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--
--
ALTER TABLE `assigned_batch_subjects`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `exam_routine`
--
ALTER TABLE `exam_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seat_plans`
--
ALTER TABLE `seat_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
