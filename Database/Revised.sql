-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2015 at 07:29 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `details`
--

-- --------------------------------------------------------

--
-- Table structure for table `addpdrive`
--

CREATE TABLE IF NOT EXISTS `addpdrive` (
  `CompanyName` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `C/P` tinyint(1) NOT NULL DEFAULT '0',
  `PVenue` varchar(255) NOT NULL,
  `SSLC` float NOT NULL,
  `PU/Dip` float NOT NULL,
  `BE` float NOT NULL,
  `Backlogs` int(11) NOT NULL,
  `HofBacklogs` tinyint(1) NOT NULL,
  `DetainYears` int(11) NOT NULL,
  `ODetails` text,
  PRIMARY KEY (`CompanyName`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addpdrive`
--

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Tech Solutions', '2024-11-15', 1, 'Tech Solutions HQ, Bangalore', 75.0, 70.5, 65.0, 2, 1, 1, 'Knowledge of Python and Data Structures preferred.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Innovatech', '2024-12-05', 0, 'Innovatech Campus, Delhi', 80.0, 75.0, 70.0, 0, 0, 0, 'No history of backlogs allowed.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Global Soft', '2024-11-20', 1, 'Global Soft Office, Mumbai', 65.0, 60.0, 55.0, 1, 1, 1, 'Must have completed an internship in a related field.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Bright Vision', '2024-12-10', 1, 'Bright Vision Center, Chennai', 85.0, 80.0, 75.0, 0, 0, 0, 'Only candidates with outstanding leadership skills.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('CyberPath', '2024-12-20', 0, 'CyberPath Building, Hyderabad', 70.0, 65.0, 60.0, 3, 1, 2, 'Preference for cybersecurity certifications.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('NextGen Solutions', '2024-12-18', 1, 'NextGen Solutions, Bangalore', 68.0, 64.5, 63.0, 2, 1, 1, 'Strong problem-solving abilities required.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('TechWave', '2024-11-30', 0, 'TechWave Tower, Pune', 72.5, 70.0, 68.0, 0, 0, 0, 'Looking for candidates with software testing experience.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Infinitum', '2024-12-25', 1, 'Infinitum Office, Gurgaon', 75.0, 73.0, 70.0, 1, 0, 1, 'Candidates with prior work in AI and ML preferred.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Nexis Corp', '2024-12-22', 0, 'Nexis Corp, Noida', 60.0, 58.5, 55.0, 2, 1, 1, 'Open for all branches; willing to relocate.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Optimus Group', '2024-11-28', 1, 'Optimus Group, Ahmedabad', 78.0, 74.0, 72.0, 0, 0, 0, 'Emphasis on teamwork and critical thinking.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Tech Innovations', '2024-11-10', 1, 'Tech Innovations HQ, Mumbai', 78.0, 73.0, 70.0, 1, 0, 0, 'Looking for candidates with strong analytical skills and a passion for technology.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Smart Solutions', '2024-11-25', 0, 'Smart Solutions Campus, Bangalore', 82.0, 76.0, 74.0, 0, 0, 0, 'Candidates with prior internship experience preferred.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Innovative Minds', '2024-12-01', 1, 'Innovative Minds Office, Delhi', 85.0, 80.0, 78.0, 1, 1, 0, 'Seeking candidates with creativity and innovation in problem-solving.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Future Tech', '2024-12-15', 0, 'Future Tech Center, Chennai', 76.0, 72.0, 71.0, 2, 1, 1, 'Preference for candidates with knowledge in cloud computing.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Visionary Systems', '2024-12-30', 1, 'Visionary Systems, Pune', 79.0, 75.0, 74.0, 1, 0, 1, 'Looking for candidates with excellent communication skills.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Green Tech', '2025-01-05', 0, 'Green Tech HQ, Hyderabad', 80.0, 77.0, 76.0, 0, 0, 0, 'Candidates with an interest in sustainable technologies are encouraged to apply.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Elite Corp', '2025-01-10', 1, 'Elite Corp, Gurgaon', 84.0, 82.0, 80.0, 0, 0, 0, 'Candidates should have a strong understanding of software development principles.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Pinnacle Technologies', '2025-01-15', 1, 'Pinnacle Technologies, Noida', 75.0, 70.0, 68.0, 2, 1, 0, 'Open for all branches with relevant skill sets.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('Dynamic Solutions', '2025-01-20', 0, 'Dynamic Solutions Office, Ahmedabad', 77.0, 72.5, 70.0, 1, 1, 1, 'Looking for innovative thinkers and problem solvers.');

INSERT INTO addpdrive (CompanyName, Date, `C/P`, PVenue, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, ODetails) 
VALUES 
('NextGen Tech', '2025-01-25', 1, 'NextGen Tech, Kolkata', 81.0, 78.0, 76.0, 0, 0, 0, 'Candidates with experience in AI and machine learning will be preferred.');

-- --------------------------------------------------------

--
-- Table structure for table `basicdetails`
--

CREATE TABLE IF NOT EXISTS `basicdetails` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `USN` varchar(10) NOT NULL,
  `Mobile` bigint(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `Sem` int(11) NOT NULL,
  `Branch` varchar(15) NOT NULL,
  `SSLC` float NOT NULL,
  `PU/Dip` float NOT NULL,
  `BE` float NOT NULL,
  `Backlogs` int(11) NOT NULL,
  `HofBacklogs` tinyint(1) NOT NULL,
  `DetainYears` int(11) NOT NULL,
  `Approve` tinyint(1) NOT NULL DEFAULT '0',
  `ApprovalDate` date NOT NULL,
  PRIMARY KEY (`Id`,`USN`),
  UNIQUE KEY `USN` (`USN`,`Mobile`,`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `basicdetails`
--

INSERT INTO `basicdetails` (`Id`, `FirstName`, `LastName`, `USN`, `Mobile`, `Email`, `DOB`, `Sem`, `Branch`, `SSLC`, `PU/Dip`, `BE`, `Backlogs`, `HofBacklogs`, `DetainYears`, `Approve`, `ApprovalDate`) VALUES
(1, 'veda', 'kumar', '1cg13is400', 11111, 'v@gmil.comk', '2015-06-09', 1, 'ISE', 70, 70, 70, 0, 0, 0, 1, '0000-00-00'),
(2, 'vastala', 'hs', '1cg13cs400', 22222, 'vhs@gmil.com', '1996-03-08', 2, 'CSE', 75, 75, 70, 0, 0, 0, 1, '0000-00-00'),
(3, 'ragini', 'mn', '1cg12is001', 33333, 'r@gmail.com', '1991-01-28', 6, 'ISE', 55, 55, 55, 0, 0, 0, 1, '0000-00-00'),
(4, 'Punith', 'raj kumar', '1cg12cs002', 66666, 'p@gmail.com', '1991-02-13', 8, 'CSE', 85, 85, 85, 0, 0, 0, 0, '0000-00-00'),
(5, 'Manvith', 'kumar', '1cg12cv001', 7777, 'mk@gmail.com', '1998-05-31', 7, 'CVE', 99, 99, 99, 0, 0, 0, 0, '0000-00-00'),
(6, 'Harsha', 'M S', '1cg12ee001', 88888, 'h@gmail.com', '1999-01-04', 8, 'EEE', 99, 99, 99, 0, 0, 0, 0, '0000-00-00'),
(7, 'Tejaswini', 'T L', '1cg12cv002', 99999, 't@gmil.com', '1997-08-13', 4, 'CVE', 65, 65, 65, 0, 0, 0, 0, '0000-00-00'),
(8, 'Ashraf', 'Unissa', '1cg12ee005', 10000, 'au@gmail.com', '1992-10-23', 4, 'EEE', 55, 55, 55, 0, 0, 0, 0, '0000-00-00'),
(9, 'Roja', 'Bai', '1cg12is009', 20000, 'rb@gmail.com', '1997-04-28', 4, 'ISE', 66, 63, 62, 0, 0, 0, 1, '2015-07-23'),
(10, 'Yogesh', 'B L', '1cg12cs031', 40000, 'y@gmail.com', '2000-06-13', 5, 'CSE', 41, 45, 45, 0, 0, 0, 0, '0000-00-00'),
(11, 'rahul', 'khanna', '1cg13is401', 2147483647, 'rr@gmail.com', '2015-07-02', 4, 'ise', 77, 66, 77, 0, 0, 0, 1, '0000-00-00'),
(12, 'Vishruth', 'Harithsa', '1cg12is094', 9880796862, 'harithsa@aol.com', '1994-10-22', 6, 'ISE', 91, 70, 50, 5, 0, 1, 1, '2015-08-18'),
(13, 'Neil', 'Armstrong', '1cg12is000', 2147483647, 'armstrong@neil.com', '2015-07-23', 7, 'ISE', 100, 100, 100, 0, 0, 0, 1, '2015-07-23'),
(14, 'Vishruth', 'Harithsa', '1cg12is011', 9880796862, 'harithsa@aol.com', '2015-08-21', 6, 'ISE', 40, 70, 50, 5, 0, 1, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `updatedrive`
--

CREATE TABLE IF NOT EXISTS `updatedrive` (
  `USN` varchar(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Attendence` tinyint(1) NOT NULL DEFAULT '0',
  `WT` tinyint(1) NOT NULL DEFAULT '0',
  `GD` tinyint(1) NOT NULL DEFAULT '0',
  `Techical` tinyint(1) NOT NULL DEFAULT '0',
  `Placed` tinyint(1) NOT NULL DEFAULT '0',
  KEY `USN` (`USN`),
  KEY `CompanyName` (`CompanyName`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `updatedrive`
--

INSERT INTO `updatedrive` (`USN`, `Name`, `CompanyName`, `Date`, `Attendence`, `WT`, `GD`, `Techical`, `Placed`) VALUES
('1cg13is400', 'Veda', 'Haritha Tech', '2015-06-26', 1, 1, 1, 1, 1),
('1cg13cs400', 'Vastala', 'HP', '2013-08-19', 1, 1, 1, 1, 1),
('1cg12cs002', 'Punith', 'IBM', '2015-05-12', 1, 1, 1, 1, 1),
('1cg12cv001', 'Manvith', 'Infosis', '2015-01-10', 1, 1, 1, 1, 1),
('1cg12ee001', 'Harsha', 'Intel', '2013-09-08', 1, 1, 1, 1, 1),
('1cg12ee005', 'Ashraf', 'Microsoft company', '2014-12-09', 1, 1, 1, 1, 1),
('1cg12is009', 'Roja', 'Skype', '2014-06-10', 1, 1, 1, 1, 1),
('1cg12cs031', 'Yogesh', 'Tata Consultency Services', '2015-11-24', 1, 1, 1, 1, 1),
('1cg12is001', 'Ragini', 'VTECK', '2013-03-24', 1, 1, 1, 1, 1),
('1cg12cv002', 'Tesjaswini', 'WDS', '2014-09-30', 1, 1, 1, 1, 1),
('1cg12cs002', 'punith', 'yy', '2015-07-04', 1, 1, 1, 0, 0),
('1cg12is094', 'Vishruth Harithsa', 'Apple', '2015-07-23', 1, 1, 1, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `updatedrive`
--
ALTER TABLE `updatedrive`
  ADD CONSTRAINT `updatedrive_ibfk_1` FOREIGN KEY (`USN`) REFERENCES `basicdetails` (`USN`) ON DELETE CASCADE,
  ADD CONSTRAINT `updatedrive_ibfk_2` FOREIGN KEY (`CompanyName`, `Date`) REFERENCES `addpdrive` (`CompanyName`, `Date`) ON DELETE CASCADE;
--
-- Database: `placement`
--

-- --------------------------------------------------------

--
-- Table structure for table `hlogin`
--

CREATE TABLE IF NOT EXISTS `hlogin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Question` varchar(255) NOT NULL,
  `Answer` varchar(255) NOT NULL,
  `Branch` varchar(15) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Username` (`Username`,`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hlogin`
--

INSERT INTO `hlogin` (`Id`, `Name`, `Username`, `Password`, `Email`, `Question`, `Answer`, `Branch`) VALUES
(1, 'Nagaraj P', 'Nagaraj', '123456', 'fastnag@gmail.com', 'What is your fav spot?', 'Bangalore', 'ISE');

-- --------------------------------------------------------

--
-- Table structure for table `plogin`
--

CREATE TABLE IF NOT EXISTS `plogin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Question` varchar(255) NOT NULL,
  `Answer` varchar(255) NOT NULL,
  `Approve` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Username` (`Username`,`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `plogin`
--

INSERT INTO `plogin` (`Id`, `Name`, `Username`, `Password`, `Email`, `Question`, `Answer`) VALUES
(1, 'Rohini', 'rohini', 'rohini', 'rh@gmail.com', 'What is your fav spot?', 'mangalore');

-- --------------------------------------------------------

--
-- Table structure for table `prilogin`
--

CREATE TABLE IF NOT EXISTS `prilogin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Question` varchar(255) NOT NULL,
  `Answer` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Username` (`Username`,`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `prilogin`
--

INSERT INTO `prilogin` (`Id`, `Name`, `Username`, `Password`, `Email`, `Question`, `Answer`) VALUES
(1, 'Suresh', 'suresh', '123456', 'suresh@gmail.com', 'What is your fav spot?', 'madikeri');

-- --------------------------------------------------------

--
-- Table structure for table `slogin`
--

CREATE TABLE IF NOT EXISTS `slogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL,
  `USN` varchar(10) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Question` varchar(255) NOT NULL,
  `Answer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `USN` (`USN`,`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `slogin`
--

INSERT INTO `slogin` (`id`, `Name`, `USN`, `PASSWORD`, `Email`, `Question`, `Answer`) VALUES
(1, 'veda', '1cg13is401', '123', 'veda', 'What is your fav spot?', 'circket'),
(2, 'Veda', '1cg12is096', 'veda', 'v@gmil.com', 'what is your fav spot?', 'mysore'),
(3, 'rama', '1cg12cs001', 'rama', 'rama@gmail.com', 'What is your fav dish?', 'chicken'),
(4, 'Vishruth Harithsa', '1cg12is094', 'CUTESTAR22', 'har', 'What is your nickname?', ''),
(5, 'Armstrong', '1cg12is000', 'asdfg', 'armstrong@neil.com', 'What is your fav spot?', 'New York'),
(8, 'Harry', '1cg12is007', 'asdfg', 'asdfg@gmail.com', 'What is your fav spot?', 'Manali'),
(9, '', '', '', '', '', ''),
(10, 'Harithsa', '1cg12is009', 'qwerty', 'harithsa@aol.com', 'What is your nickname?', 'Gunda'),
(11, 'Vishruth Harithsa', '1cg12is011', 'qwerty', 'astroman225@gmail.com', 'What is your fav spot?', 'Manali');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- Create the applications table
CREATE TABLE IF NOT EXISTS `applications` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `company_name` VARCHAR(255),
    `usn` VARCHAR(10) NOT NULL,
    `first_name` VARCHAR(25) NOT NULL,
    `last_name` VARCHAR(25) NOT NULL,
    `applied_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`company_name`) REFERENCES `addpdrive`(`CompanyName`) ON DELETE CASCADE,
    FOREIGN KEY (`usn`) REFERENCES `basicdetails`(`USN`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `interviews` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `Name` VARCHAR(25) NOT NULL,  -- Foreign key from plogin table
    `USN` VARCHAR(10) NOT NULL,   -- Foreign key from basicdetails table
    `interview_at` DATETIME NOT NULL,  -- Date and time of interview
    `mode` ENUM('Online', 'Offline') NOT NULL,  -- Mode of interview
    `venue` VARCHAR(100),  -- Place of interview (optional for online)
    
    -- Foreign key constraints
    FOREIGN KEY (`Name`) REFERENCES `addpdrive`(`CompanyName`) ON DELETE CASCADE,
    FOREIGN KEY (`USN`) REFERENCES `basicdetails`(`USN`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
