-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 06:41 PM
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
-- Database: `librarysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Name` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Name`, `Username`, `Password`) VALUES
('Arko', 'arkokundu@#1234', '1a1dc91c907325c69271ddf0c944bc72'),
('Swastik', 'kookaswas@#1234', '1a1dc91c907325c69271ddf0c944bc72');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `AccNo` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Publisher` varchar(50) NOT NULL,
  `Edition` varchar(5) NOT NULL,
  `Branch` varchar(5) NOT NULL,
  `Year` varchar(5) NOT NULL,
  `Sem` varchar(5) NOT NULL,
  `Status` enum('Available','Demanded','Borrowed','Read Only') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`AccNo`, `Title`, `Author`, `Publisher`, `Edition`, `Branch`, `Year`, `Sem`, `Status`) VALUES
(69, 'Operating Systems', 'P. Naskar', 'P.N. Printers Pvt. Ltd.', '3rd', 'DCST', '2nd', '4th', 'Available'),
(2808, 'Higher Engineering Mathematics', 'B. S. Grewal', 'Khanna Publishers', '8th', 'DCST', '1st', '2nd', 'Available'),
(3381, 'Engineering Drawing', 'ND Bhatt', 'Charotkar Publishing House', '53rd', 'DCST', '1st', '1st', 'Available'),
(4390, 'Programming in C', 'E. Balaguruswamy', 'Tata McGraw Hill', '4th', 'DCST', '2nd', '3rd', 'Available'),
(4490, 'Concepts of Physics', 'HC Verma', 'Bharti Bhawan', '3rd', 'DCST', '1st', '1st', 'Available'),
(5501, 'Data Structures Using C', 'Reema Thareja', 'Oxford', '3rd', 'DCST', '2nd', '3rd', 'Available'),
(5589, 'Concepts of Physics', 'HC Verma', 'Bharti Bhawan', '3rd', 'DCST', '1st', '2nd', 'Available'),
(5618, 'Core Java', 'Horstmann', 'Pearson', '3rd', 'DCST', '2nd', '4th', 'Available'),
(6666, 'Engineering Chemistry', 'Agarwal & Sikha', 'Cambridge University Press', '4th', 'DCST', '1st', '1st', 'Available'),
(6692, 'Engineering Mathematics', 'A. Sarkar', 'Naba Publication', '6th', 'DCST', '1st', '1st', 'Available'),
(6705, 'Computer Fundamentals', 'Goel', 'Pearson', '6th', 'DCST', '1st', '2nd', 'Available'),
(6824, 'Core Python Programming', 'Wesley', 'Tata McGraw Hill', '4th', 'DCST', '2nd', '3rd', 'Available'),
(7077, 'Operating System Concepts', 'Silberschatz, Galvin', 'Addison-Wesley', '5th', 'DCST', '2nd', '4th', 'Available'),
(7402, 'Higher Engineering Mathematics', 'B. S. Grewal', 'Khanna Publishers', '11th', 'DCST', '1st', '1st', 'Available'),
(7404, 'Fundamentals of Database System', 'Elmasri, Navathe', 'Pearson', '3rd', 'DCST', '2nd', '4th', 'Available'),
(7750, 'Introduction to Algorithms', 'Thomas Cormen', 'MIT Press', '4th', 'DCST', '2nd', '3rd', 'Available'),
(7909, 'Computer Networking', 'Kurose, Ross', 'Pearson', '5th', 'DCST', '2nd', '4th', 'Available'),
(7963, 'Computer Organization', 'Carl Hamacher', 'Tata Mc Graw Hill', '9th', 'DCST', '2nd', '3rd', 'Available'),
(7977, 'Basic Electricals and Electronics', 'S. K. Bhattacharya', 'Pearson', '6th', 'DCST', '1st', '2nd', 'Available'),
(8695, 'Database Concept and System', 'Evan Bayross', 'SPD', '6th', 'DCST', '2nd', '4th', 'Available'),
(8824, 'Java The Complete Reference', 'Herber Schildt', 'Tata McGraw Hill', '5th', 'DCST', '2nd', '4th', 'Available'),
(8891, 'Programming in C', 'Reema Thareja', 'Oxford', '6th', 'DCST', '2nd', '3rd', 'Available'),
(9341, 'Data Communication and Networking ', 'Forouzan', 'Tata McGraw Hill', '5th', 'DCST', '2nd', '4th', 'Available'),
(9391, 'Fundamental of Software Engineering', 'Rajib Mall', 'PHI Learning Private Limited', '4th', 'DCST', '2nd', '4th', 'Available'),
(9999, '3500+ JELET', 'A. Sarkar', 'Naba Publication', '1st', 'DCST', '6th', '2nd', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed`
--

CREATE TABLE `borrowed` (
  `BorrowID` int(11) NOT NULL,
  `LibID` varchar(50) NOT NULL,
  `AccNo` int(11) NOT NULL,
  `BorrDt` datetime NOT NULL DEFAULT current_timestamp(),
  `Group` varchar(5) NOT NULL,
  `Check_Status` enum('Yet to be borrowed','Borrowed','Return Approval') NOT NULL DEFAULT 'Yet to be borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demand`
--

CREATE TABLE `demand` (
  `DemandID` int(11) NOT NULL,
  `DemandDate` datetime DEFAULT current_timestamp(),
  `AccNo` int(11) NOT NULL,
  `StdID` varchar(50) NOT NULL,
  `Check_Status` enum('Yet to be verified','Verified') NOT NULL DEFAULT 'Yet to be verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_no` int(3) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_no`, `dept_name`, `dept_id`) VALUES
(1, 'Department of Computer Science & Technology', 'DCST'),
(2, 'Department of Civil Engineering', 'DCE'),
(3, 'Department of Mechanical Engineering', 'DME'),
(4, 'Department of Electrical Engineering', 'DEE');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `group_no` int(5) NOT NULL,
  `group_name` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_no`, `group_name`) VALUES
(3, 'B2'),
(1, 'C'),
(12, 'E'),
(8, 'G1'),
(9, 'J'),
(4, 'K'),
(2, 'M'),
(5, 'M1'),
(11, 'N'),
(6, 'P'),
(7, 'Q'),
(10, 'X');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Card_No` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Course` varchar(4) NOT NULL,
  `Year` varchar(5) NOT NULL,
  `RegNumber` varchar(12) NOT NULL,
  `Roll` varchar(10) NOT NULL,
  `Number` int(11) NOT NULL,
  `Group` varchar(5) NOT NULL,
  `Date` date NOT NULL,
  `Password` varchar(100) NOT NULL DEFAULT 'password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`Card_No`, `Name`, `Course`, `Year`, `RegNumber`, `Roll`, `Number`, `Group`, `Date`, `Password`) VALUES
('0/CE/C/001', 'Anik Das', 'DCE', '3rd', '', '', 0, 'C', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CE/C/002', 'Rina Chowdhury', 'DCE', '3rd', '', '', 10005511, 'C', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CE/C/003', 'Dhrubyajoti Patra', 'DCE', '3rd', '', '', 10005497, 'C', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CE/C/004', 'Bimal Pramanik', 'DCE', '3rd', '', '', 0, 'C', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CE/C/005', 'Bitan Sarkar', 'DCE', '3rd', '', '', 10005495, 'C', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CE/M/018', 'Riya Debnath', 'DCE', '3rd', '', '', 10005513, 'M', '2022-03-16', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CE/M/019', 'Tamojit Neogi', 'DCE', '3rd', '', '', 10005535, 'M', '2022-03-16', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CE/M/020', 'Samihan Kadir', 'DCE', '3rd', '', '', 10005518, 'M', '2022-03-16', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CE/M/021', 'Suvasundar Das', 'DCE', '3rd', '', '', 10005534, 'M', '2022-03-16', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CE/M/022', 'Joydeep Dey', 'DCE', '3rd', '', '', 10005502, 'M', '2022-03-16', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/B2/105', 'Shuvankar Dhara', 'DCST', '3rd', '', 'DCTSCSTS5', 10005568, 'B2', '2022-04-19', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/B2/106', 'Tanmoy Bose', 'DCST', '3rd', '', 'DCTSCSTS5', 10005589, 'B2', '2022-04-19', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/B2/107', 'Suranjan Das', 'DCST', '3rd', '', 'DCTSCSTS5', 10005583, 'B2', '2022-04-19', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/B2/108', 'Subhajit Mondal', 'DCST', '3rd', '', 'DCTSCSTS5', 0, 'B2', '2022-04-19', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/B2/109', 'Swastik Sarkar', 'DCST', '3rd', '', 'DCTSCSTS5', 10005586, 'B2', '2022-02-02', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/B2/110', 'Arko Kundu', 'DCST', '3rd', '', 'DCTSCSTS5', 10005544, 'B2', '2022-04-19', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/K/012', 'Sayan Pramanik', 'DCST', '3rd', '', 'DCTSCSTS5', 10005565, 'K', '2022-03-15', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/K/013', 'Swarnali Pramanik', 'DCST', '3rd', '', 'DCTSCSTS5', 10005585, 'K', '2022-03-15', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/K/014', 'Suman Das', 'DCST', '3rd', '', 'DCTSCSTS5', 10005581, 'K', '2022-03-15', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/K/015', 'Purnendu Naskar', 'DCST', '3rd', '', 'DCTSCSTS5', 10005558, 'K', '2022-03-15', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/K/016', 'Dipayan Paul', 'DCST', '3rd', '', 'DCTSCSTS5', 10005553, 'K', '2022-03-15', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/K/017', 'Arnab Dalui', 'DCST', '3rd', '', 'DCTSCSTS5', 10005545, 'K', '2022-03-15', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/M1/087', 'Rishav Saha', 'DCST', '3rd', '', 'DCTSCSTS5', 10005567, 'M1', '2022-04-20', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/P/023', 'Ankita Das', 'DCST', '3rd', '', 'DCTSCSTS5', 10005542, 'P', '2022-03-21', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/P/024', 'Anushka Dutta', 'DCST', '3rd', '', 'DCTSCSTS5', 10005543, 'P', '2022-03-21', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/P/025', 'Tanaya Kanrar', 'DCST', '3rd', '', 'DCTSCSTS5', 10005587, 'P', '2022-03-21', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/P/026', 'Souvik Harh', 'DCST', '3rd', '', 'DCTSCSTS5', 10005577, 'P', '2022-03-21', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/P/027', 'Shampa Das', 'DCST', '3rd', '', 'DCTSCSTS5', 10005567, 'P', '2022-03-21', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/P/086', 'Anirudha Bag', 'DCST', '3rd', '', 'DCTSCSTS5', 10005540, 'P', '2022-03-29', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/Q/028', 'Subhankar Majumdar', 'DCST', '3rd', '', 'DCTSCSTS5', 10005574, 'Q', '2022-03-21', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/Q/029', 'Dip Kumar Bargi', 'DCST', '3rd', '', 'DCTSCSTS5', 10005552, 'Q', '2022-03-21', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/Q/030', 'Sagar Sarkar', 'DCST', '3rd', '', 'DCTSCSTS5', 10005563, 'Q', '2022-03-21', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/Q/031', 'Rajarshi Ghosh', 'DCST', '3rd', '', 'DCTSCSTS5', 10005559, 'Q', '2022-03-21', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/CS/Q/032', 'Airshwita Saha', 'DCST', '3rd', '', 'DCTSCSTS5', 0, 'Q', '2022-03-21', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/EE/G1/072', 'Debangshu Samanta', 'DEE', '3rd', '', '', 10005601, 'G1', '2022-03-29', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/EE/G1/073', 'Pralay Ghosh', 'DEE', '3rd', '', '', 10005614, 'G1', '2022-03-29', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/EE/G1/074', 'Koushik Mallick', 'DEE', '3rd', '', '', 10005605, 'G1', '2022-03-29', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/EE/G1/075', 'Amal Khanna', 'DEE', '3rd', '', '', 0, 'G1', '2022-03-29', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/EE/G1/076', 'Souvick Das', 'DEE', '3rd', '', '', 10005629, 'G1', '2022-03-29', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/EE/J/007', 'Debjit Ray', 'DEE', '3rd', '', '', 10005602, 'J', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/EE/J/008', 'Chirosri Biswas', 'DEE', '3rd', '', '', 10005600, 'J', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/EE/J/009', 'Bidisha Roy', 'DEE', '3rd', '', '', 10005599, 'J', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/EE/J/010', 'Ananya Mondal', 'DEE', '3rd', '', '', 10005593, 'J', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/EE/J/011', 'Sudip Sarkar', 'DEE', '3rd', '', '', 10005635, 'J', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/ME/X/051', 'Puspendu Paul', 'DME', '3rd', '', '', 10005666, 'X', '2022-03-26', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/ME/X/052', 'Kuntal Kundu', 'DME', '3rd', '', '', 10005666, 'X', '2022-03-26', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/ME/X/053', 'Purna Shankar Mondal', 'DME', '3rd', '', '', 10005666, 'X', '2022-03-26', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/ME/X/054', 'Subham Mondal', 'DME', '3rd', '', '', 10005666, 'X', '2022-03-26', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/ME/X/055', 'Pramito Bhowmick', 'DME', '3rd', '', '', 10005666, 'X', '2022-03-26', '5f4dcc3b5aa765d61d8327deb882cf99'),
('0/ME/X/056', 'Barnali Sarkar', 'DME', '3rd', '', '', 10005666, 'X', '2022-03-26', '5f4dcc3b5aa765d61d8327deb882cf99'),
('1/CE/C/006', 'Risibha Raj Gupta', 'DCE', '3rd', '', '', 10005512, 'C', '2022-07-13', '5f4dcc3b5aa765d61d8327deb882cf99'),
('1/CE/N/005', 'Sunny Deo Ram', 'DCE', '2nd', '', '', 48, 'N', '2022-03-16', '5f4dcc3b5aa765d61d8327deb882cf99'),
('1/CE/N/006', 'Vijayanand Kumar', 'DCE', '2nd', '', '', 52, 'N', '2022-03-16', '5f4dcc3b5aa765d61d8327deb882cf99'),
('1/CE/N/007', 'Snneha Shaw', 'DCE', '2nd', '', '', 59, 'N', '2022-03-16', '5f4dcc3b5aa765d61d8327deb882cf99'),
('1/CE/N/008', 'Shant Shaw', 'DCE', '2nd', '', '', 37, 'M', '2022-03-16', '5f4dcc3b5aa765d61d8327deb882cf99'),
('1/CS/E/001', ' Ayush Prakash', 'DCST', '2nd', '', 'DCTSCSTS3', 64, 'E', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('1/CS/E/002', ' Shivam Viswakarma', 'DCST', '2nd', '', 'DCTSCSTS3', 38, 'E', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('1/CS/E/003', 'Shoaib Ahmed Quaraishi', 'DCST', '2nd', '', 'DCTSCSTS3', 33, 'E', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99'),
('1/CS/E/004', 'Md. Daneyal', 'DCST', '2nd', '', 'DCTSCSTS3', 55, 'E', '2022-03-14', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `year_no` int(1) NOT NULL,
  `year_name` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`year_no`, `year_name`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`AccNo`);

--
-- Indexes for table `borrowed`
--
ALTER TABLE `borrowed`
  ADD PRIMARY KEY (`BorrowID`),
  ADD UNIQUE KEY `AccNo_2` (`AccNo`),
  ADD KEY `LibID` (`LibID`),
  ADD KEY `AccNo` (`AccNo`);

--
-- Indexes for table `demand`
--
ALTER TABLE `demand`
  ADD PRIMARY KEY (`DemandID`),
  ADD UNIQUE KEY `AccNo` (`AccNo`),
  ADD KEY `StdID` (`StdID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_no`),
  ADD UNIQUE KEY `dept_id` (`dept_id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`group_no`),
  ADD UNIQUE KEY `group_name` (`group_name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Card_No`),
  ADD KEY `Course` (`Course`),
  ADD KEY `Group` (`Group`),
  ADD KEY `Year` (`Year`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`year_no`),
  ADD UNIQUE KEY `year_name` (`year_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowed`
--
ALTER TABLE `borrowed`
  MODIFY `BorrowID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `demand`
--
ALTER TABLE `demand`
  MODIFY `DemandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `group_no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed`
--
ALTER TABLE `borrowed`
  ADD CONSTRAINT `borrowed_ibfk_1` FOREIGN KEY (`AccNo`) REFERENCES `books` (`AccNo`),
  ADD CONSTRAINT `borrowed_ibfk_2` FOREIGN KEY (`LibID`) REFERENCES `students` (`Card_No`);

--
-- Constraints for table `demand`
--
ALTER TABLE `demand`
  ADD CONSTRAINT `demand_ibfk_1` FOREIGN KEY (`AccNo`) REFERENCES `books` (`AccNo`),
  ADD CONSTRAINT `demand_ibfk_2` FOREIGN KEY (`StdID`) REFERENCES `students` (`Card_No`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`Course`) REFERENCES `department` (`dept_id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`Group`) REFERENCES `group` (`group_name`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`Year`) REFERENCES `year` (`year_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
