-- Database: `details`

-- Table structure for table `addpdrive`
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
  PRIMARY KEY (`CompanyName`, `Date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `addpdrive`
INSERT INTO `addpdrive` (`CompanyName`, `Date`, `C/P`, `PVenue`, `SSLC`, `PU/Dip`, `BE`, `Backlogs`, `HofBacklogs`, `DetainYears`, `ODetails`) VALUES
('Apple', '2015-07-23', 0, 'RVCE', 98, 98, 90, 0, 0, 0, 'Welcome to Apple'),
('Haritha Tech', '2015-06-26', 1, 'SIT', 60, 65, 65, 0, 0, 0, '0'),
('HP', '2013-08-19', 1, 'SSIT', 70, 75, 75, 0, 0, 0, '0'),
('IBM', '2015-05-12', 0, 'CIT College', 60, 65, 65, 0, 0, 0, '0'),
('Infosis', '2015-01-10', 0, 'CIT College', 60, 60, 60, 0, 0, 0, '0'),
('Intel', '2013-09-08', 0, 'CIT', 60, 65, 65, 0, 0, 0, '0'),
('Microsoft company', '2014-12-09', 0, 'CIT', 60, 65, 65, 0, 0, 0, '0'),
('Skype', '2014-06-10', 1, 'SIT College', 75, 75, 75, 0, 0, 0, '0'),
('Tata Consultancy Services', '2015-11-24', 1, 'AIE', 65, 70, 75, 0, 0, 0, '0'),
('VTECK', '2013-03-24', 0, 'CIT College', 60, 60, 65, 0, 0, 0, '0'),
('WDS', '2014-09-30', 1, 'KIT', 65, 65, 65, 0, 0, 0, '0'),
('yy', '2015-07-04', 0, '', 45, 55, 55, 8, 1, 2, '');

-- Table structure for table `basicdetails`
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
  PRIMARY KEY (`Id`, `USN`),
  UNIQUE KEY `USN` (`USN`, `Mobile`, `Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=15;

-- Dumping data for table `basicdetails`
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
(14, 'Vishruth', 'Harithsa', '1cg12is011', 9880796862, 'harithsa@aol.com', '1994-10-22', 6, 'ISE', 91, 70, 50, 5, 0, 1, 1, '2015-08-18');

-- Table structure for table `query`
CREATE TABLE IF NOT EXISTS `query` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Qtitle` varchar(100) NOT NULL,
  `Qdetails` varchar(255) NOT NULL,
  `Rsolution` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `query`
INSERT INTO `query` (`Id`, `Qtitle`, `Qdetails`, `Rsolution`, `Date`) VALUES
(1, 'HOD details', 'View all HOD details', 'Showing HOD details', '2015-07-23'),
(2, 'Placement drive', 'Schedule placement drive', 'Scheduling drive', '2015-07-22'),
(3, 'Company queries', 'View queries of company', 'Showing company queries', '2015-07-21'),
(4, 'HOD', 'View HOD', 'Details of HOD', '2015-07-21'),
(5, 'Students', 'View students', 'Students details', '2015-07-21');

-- Table structure for table `companies`
CREATE TABLE IF NOT EXISTS `companies` (
  `CompanyId` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(100) NOT NULL,
  `ContactPerson` varchar(50) NOT NULL,
  `ContactEmail` varchar(100) NOT NULL,
  `ContactNumber` bigint(15) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Website` varchar(100) NOT NULL,
  PRIMARY KEY (`CompanyId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `companies`
INSERT INTO `companies` (`CompanyId`, `CompanyName`, `ContactPerson`, `ContactEmail`, `ContactNumber`, `Address`, `Website`) VALUES
(1, 'Tesla', 'Elon Musk', 'elon@tesla.com', 9876543210, 'Palo Alto, CA', 'www.tesla.com'),
(2, 'Google', 'Sundar Pichai', 'sundar@google.com', 9876543211, 'Mountain View, CA', 'www.google.com'),
(3, 'Facebook', 'Mark Zuckerberg', 'mark@facebook.com', 9876543212, 'Menlo Park, CA', 'www.facebook.com');

-- Table structure for table `branchdetails`
CREATE TABLE IF NOT EXISTS `branchdetails` (
  `BranchId` int(11) NOT NULL AUTO_INCREMENT,
  `BranchName` varchar(100) NOT NULL,
  PRIMARY KEY (`BranchId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `branchdetails`
INSERT INTO `branchdetails` (`BranchId`, `BranchName`) VALUES
(1, 'CSE'),
(2, 'ISE'),
(3, 'EEE'),
(4, 'CVE');

-- Table structure for table `User`
CREATE TABLE IF NOT EXISTS `User` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `User`
INSERT INTO `User` (`Id`, `Username`, `Password`) VALUES
(1, 'admin', 'admin123'),
(2, 'user', 'user123');

-- Table structure for table `notification`
CREATE TABLE IF NOT EXISTS `notification` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Notification` varchar(255) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `notification`
INSERT INTO `notification` (`Id`, `Notification`, `UserId`, `Date`) VALUES
(1, 'Placement drive scheduled', 1, '2015-07-23'),
(2, 'New company added', 2, '2015-07-22');
