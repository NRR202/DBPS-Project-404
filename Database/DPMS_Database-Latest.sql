-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2024 at 03:36 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbps_database`
--
CREATE DATABASE IF NOT EXISTS `dbps_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbps_database`;

-- --------------------------------------------------------

--
-- Table structure for table `conslutation_message_table`
--

CREATE TABLE `conslutation_message_table` (
  `references_num` int(11) NOT NULL,
  `from_user_name` varchar(255) NOT NULL,
  `to_user_name` varchar(255) NOT NULL,
  `message_from_user` text NOT NULL,
  `message_to_user` text DEFAULT NULL,
  `status_message` enum('Submitted','On-Going','Processing','Completed') NOT NULL,
  `datetime_sent` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conslutation_message_table`
--

INSERT INTO `conslutation_message_table` (`references_num`, `from_user_name`, `to_user_name`, `message_from_user`, `message_to_user`, `status_message`, `datetime_sent`) VALUES
(1089807625, 'Christine Lazaro', 'Jocelyn Tejada', 'Test 1 new text', NULL, 'Submitted', '2024-05-12 16:17:51'),
(1321617625, 'Christine Lazaro', 'Herliza Estrada', 'Testing of consultation\r\n', NULL, 'Submitted', '2024-05-12 16:38:52'),
(2147483647, 'Christine Lazaro', 'Teresita Ramos', 'Hello Ma\'am.', 'Hi ma\'am Christine.', 'Completed', '2024-05-12 16:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `credentials_account`
--

CREATE TABLE `credentials_account` (
  `username` varchar(255) NOT NULL,
  `pass_word` varchar(255) NOT NULL,
  `type_entity` enum('Student','Teacher','Parent','Administrator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credentials_account`
--

INSERT INTO `credentials_account` (`username`, `pass_word`, `type_entity`) VALUES
('2018-83801', 'joy', 'Teacher'),
('2019-02938', 'liza', 'Teacher'),
('2020-00590', 'neil', 'Student'),
('2020-73712', 'abbie', 'Teacher'),
('2022-00180', '1234', 'Student'),
('2022-00781', 'mau', 'Student'),
('2022-01227', 'john', 'Teacher'),
('2022-01236', 'romce', 'Student'),
('2022-06969', 'christine', 'Student'),
('2022-09744', 'ragnar', 'Student'),
('2022-09820', 'cating', 'Student'),
('2022-10345', 'pat', 'Student'),
('2022-12345', 'icko', 'Student'),
('2022-58302', 'pogi', 'Student'),
('2023-06462', 'jeremy', 'Teacher'),
('2023-12384', 'sam', 'Student'),
('2024-00001', 'sob_sob', 'Student'),
('2024-00002', '12345', 'Student'),
('2024-00923', 'sheryl', 'Student'),
('2024-10293', 'teresita', 'Teacher'),
('2024-90210', '12345', 'Student'),
('2024-98723', 'king', 'Teacher'),
('adira@gmail.com', 'christine', 'Parent'),
('Admin', 'Admin', 'Administrator'),
('neilramos@gmail.com', 'neilramos', 'Parent');

-- --------------------------------------------------------

--
-- Table structure for table `evaluationformtable`
--

CREATE TABLE `evaluationformtable` (
  `EvaluationForm_ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL,
  `Student_Name` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `course` varchar(30) NOT NULL,
  `section` varchar(10) NOT NULL,
  `year_level` varchar(30) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `question1` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question2` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question3` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question4` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question5` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question6` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question7` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question8` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question9` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question10` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question11` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question12` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question13` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question14` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question15` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question16` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question17` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question18` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question19` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `question20` enum('Observed','Good','Very Good','Excellent') NOT NULL,
  `Status_E` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluationformtable`
--

INSERT INTO `evaluationformtable` (`EvaluationForm_ID`, `Student_ID`, `Student_Name`, `feedback`, `course`, `section`, `year_level`, `teacher_name`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `question10`, `question11`, `question12`, `question13`, `question14`, `question15`, `question16`, `question17`, `question18`, `question19`, `question20`, `Status_E`) VALUES
(6, '2024-00001', 'Chloe Sobrevinas                                ', 'Test 1', 'BSIT', 'A         ', '1st year', 'Teresita Ramos', 'Observed', 'Good', 'Good', 'Excellent', 'Very Good', 'Good', 'Excellent', 'Good', 'Very Good', 'Very Good', 'Observed', 'Excellent', 'Good', 'Very Good', 'Very Good', 'Good', 'Good', 'Good', 'Good', 'Very Good', 1),
(10, '2024-00002', 'Paulo Villarin                                ', 'Good Job Nak.:3', 'BSIT', 'A         ', '1st year', 'Teresita Ramos', 'Excellent', 'Very Good', 'Excellent', 'Excellent', 'Excellent', 'Very Good', 'Good', 'Good', 'Very Good', 'Very Good', 'Good', 'Very Good', 'Very Good', 'Very Good', 'Very Good', 'Good', 'Good', 'Good', 'Good', 'Good', 1),
(16, '2022-00781', 'Maureen Nipas                                    ', 'Good Job!!!', 'BSCS', 'B         ', '2nd year', 'Teresita Ramos', 'Very Good', 'Very Good', 'Very Good', 'Very Good', 'Good', 'Excellent', 'Very Good', 'Very Good', 'Excellent', 'Very Good', 'Excellent', 'Very Good', 'Good', 'Very Good', 'Observed', 'Very Good', 'Good', 'Excellent', 'Excellent', 'Excellent', 1),
(26, '2022-00180', 'Neil Raphael Ramos                                    ', 'GoodLuck.', 'BSIT', 'A         ', '1st year', 'Teresita Ramos', 'Excellent', 'Excellent', 'Good', 'Good', 'Excellent', 'Very Good', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 1),
(28, '2022-00180', 'Neil Raphael Ramos                                    ', 'Good Job Neil. Keep it up.', 'BSIT', 'A         ', '1st year', 'Jeremy Agapito', 'Excellent', 'Excellent', 'Very Good', 'Excellent', 'Very Good', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Very Good', 'Good', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parent_info`
--

CREATE TABLE `parent_info` (
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gender` enum('M','F','O') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent_info`
--

INSERT INTO `parent_info` (`firstname`, `lastname`, `student_name`, `username`, `gender`) VALUES
('Christine', 'Lazaro', 'Neil Raphael Ramos', 'adira@gmail.com', 'F'),
('Neil', 'Ramos', 'Neil Raphael Ramos', 'neilramos@gmail.com', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `course` varchar(100) NOT NULL,
  `section` enum('A','B','C','D') NOT NULL,
  `year_level` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gender` enum('M','F','O') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`firstname`, `lastname`, `course`, `section`, `year_level`, `username`, `gender`) VALUES
('Neil Gabriel', 'Ramos', 'BSCPE', 'C', '3rd year', '2020-00590', 'M'),
('Neil Raphael', 'Ramos', 'BSIT', 'A', '1st year', '2022-00180', 'M'),
('Maureen', 'Nipas', 'BSCS', 'B', '2nd year', '2022-00781', 'F'),
('Romce Angelo', 'Canete', 'BSCS', 'C', '3rd year', '2022-01236', 'M'),
('Christine', 'Lazaro', 'BSIT', 'C', '2nd year', '2022-06969', 'F'),
('Reiner de', 'Guzman', 'BSIT', 'A', '1st year', '2022-09744', 'M'),
('Geyl', 'Cating', 'BSIT', 'A', '2nd year', '2022-09820', 'F'),
('Patricia', 'Polintan', 'BSIT', 'B', '2nd year', '2022-10345', 'F'),
('Icko', 'Mendoza', 'BSIT', 'A', '2nd year', '2022-12345', 'M'),
('Rowell', 'Cruz', 'BSIT', 'A', '2nd year', '2022-58302', 'M'),
('Samantha', 'Patulot', 'BSCPE', 'D', '2nd year', '2023-12384', 'F'),
('Chloe', 'Sobrevinas', 'BSIT', 'A', '1st year', '2024-00001', 'F'),
('Paulo', 'Villarin', 'BSIT', 'A', '1st year', '2024-00002', 'M'),
('Sheryl', 'Burgos', 'BSCS', 'B', '4th year', '2024-00923', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE `teacher_info` (
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `course_handle` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gender` enum('M','F','O') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`firstname`, `lastname`, `course_handle`, `username`, `gender`) VALUES
('Jocelyn', 'Tejada', 'BSCS', '2018-83801', 'F'),
('Herliza', 'Estrada', 'BSIT', '2019-02938', 'F'),
('Abbie', 'Cassala', 'BSIT', '2020-73712', 'F'),
('Oswald', 'Yap', 'BSIT', '2022-01227', 'M'),
('Jeremy', 'Agapito', 'BSIT', '2023-06462', 'M'),
('Teresita', 'Ramos', 'BSIT', '2024-10293', 'F'),
('King', 'Olgado', 'BSIT', '2024-98723', 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conslutation_message_table`
--
ALTER TABLE `conslutation_message_table`
  ADD UNIQUE KEY `references_num` (`references_num`) USING BTREE;

--
-- Indexes for table `credentials_account`
--
ALTER TABLE `credentials_account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `evaluationformtable`
--
ALTER TABLE `evaluationformtable`
  ADD PRIMARY KEY (`EvaluationForm_ID`);

--
-- Indexes for table `parent_info`
--
ALTER TABLE `parent_info`
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluationformtable`
--
ALTER TABLE `evaluationformtable`
  MODIFY `EvaluationForm_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evaluationformtable`
--
ALTER TABLE `evaluationformtable`
  ADD CONSTRAINT `evaluationformtable_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `credentials_account` (`username`);

--
-- Constraints for table `parent_info`
--
ALTER TABLE `parent_info`
  ADD CONSTRAINT `parent_info_ibfk_1` FOREIGN KEY (`username`) REFERENCES `credentials_account` (`username`);

--
-- Constraints for table `student_info`
--
ALTER TABLE `student_info`
  ADD CONSTRAINT `student_info_ibfk_1` FOREIGN KEY (`username`) REFERENCES `credentials_account` (`username`);

--
-- Constraints for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD CONSTRAINT `teacher_info_ibfk_1` FOREIGN KEY (`username`) REFERENCES `credentials_account` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
