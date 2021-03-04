-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2017 at 11:00 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jude`
--

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `id` int(11) NOT NULL,
  `question_number` int(11) NOT NULL,
  `correct_answer` tinyint(1) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `sub_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`id`, `question_number`, `correct_answer`, `text`, `sub_id`) VALUES
(1, 1, 0, 'For work.', 1),
(2, 1, 1, 'So I can communicate when I travel.', 1),
(3, 1, 0, 'I love learning new languages.', 1),
(4, 1, 0, 'Because I’d like to immigrate to the U.S.', 1),
(5, 2, 1, 'I took classes for three years.', 1),
(6, 2, 0, 'I did an intensive course.', 1),
(7, 2, 0, 'I’ve been studying on my own.', 1),
(8, 2, 0, 'My girlfriend taught me.', 1),
(9, 3, 0, 'collision between fast neutrons and nitrogen nuclei present in the atmosphere', 3),
(10, 3, 1, 'action of ultraviolet light from the sun on atmospheric oxygen', 3),
(11, 3, 0, 'action of solar radiations particularly cosmic rays on carbon dioxide present in the atmosphere', 3),
(12, 3, 0, 'lightning discharge in atmosphere', 3),
(13, 4, 1, 'work done in rolling is more than in lifting', 3),
(14, 4, 0, 'work done in lifting the stone is equal to rolling it', 3),
(15, 4, 0, 'work done in both is same but the rate of doing work is less in rolling', 3),
(16, 4, 0, 'work done in rolling a stone is less than in lifting it', 3);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_number` int(11) NOT NULL,
  `text` text NOT NULL,
  `sub_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_number`, `text`, `sub_id`) VALUES
(1, ' WHY ARE YOU STUDYING ENGLISH?', 1),
(2, 'WHERE/HOW DID YOU LEARN ENGLISH?', 1),
(3, '	\r\nRadiocarbon is produced in the atmosphere as a result of', 3),
(4, '		\r\nIt is easier to roll a stone up a sloping road than to lift it vertical upwards because', 3);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `dateofbirth` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `first_subject` varchar(100) NOT NULL,
  `second_subject` varchar(100) NOT NULL,
  `third_subject` varchar(100) NOT NULL,
  `fourth_subject` varchar(100) NOT NULL,
  `reg_number` varchar(100) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `firstname`, `surname`, `gender`, `dateofbirth`, `email`, `course`, `first_subject`, `second_subject`, `third_subject`, `fourth_subject`, `reg_number`, `registration_date`) VALUES
(11, 'micheal', 'shaibu', 'Male', '2017-11-09', 'micheal@yahoo.com', 'Mass Communication', 'English Language', 'English Language', 'Government', 'Chemistry', 'NUB1792017', '2017-11-02 13:20:56'),
(12, 'godwin', 'shaibu', 'Male', '2017-11-03', 'kelvin@yahoo.com', 'Computer Science', 'Physics', 'Biology', 'Government', 'English Language', 'NUB5072017', '2017-11-02 13:27:34'),
(15, 'charity', 'nnajifor', 'Male', '2017-11-10', 'kelvinmicheal06@gmail.com', 'Mass Communication', '', '', '', '', '', '2017-11-02 14:46:50'),
(16, 'micheal', 'shaibu', 'Male', '2017-11-10', 'kelvinmicheal06@yahoo.com', 'Marketing', 'Mathematics', 'English Language', 'Government', 'Government', 'NUB6902017', '2017-11-02 14:50:59'),
(17, 'love', 'lujan', 'Male', '2017-11-09', 'love@yahoo.com', 'Mass Communication', 'English Language', 'Mathematics', 'Agric', 'Agric', 'NUB7432017', '2017-11-02 15:05:45'),
(18, 'mumu', 'love', 'Male', '2017-11-04', 'okayelove@yahoo.com', 'Mass Communication', 'English Language', 'Chemistry', 'Agric', 'Government', 'NUB1732017', '2017-11-03 14:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_id`, `sub_name`) VALUES
(1, 'English Language'),
(2, 'Mathematics'),
(3, 'Physics'),
(4, 'Chemistry'),
(5, 'Biology'),
(6, 'Government'),
(7, 'Commerce'),
(8, 'Economics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
