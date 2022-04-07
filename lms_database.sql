-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2022 at 09:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `acceptanceOfStudyLeave`
--

CREATE TABLE `acceptanceOfStudyLeave` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `returnService` varchar(255) NOT NULL,
  `leaveFrom` datetime NOT NULL,
  `nameOfRecipint` varchar(255) NOT NULL,
  `permanentHomeAdd` text NOT NULL,
  `signature` varchar(255) NOT NULL,
  `signatureDate` datetime NOT NULL,
  `nameOfGuarantor` varchar(255) NOT NULL,
  `guarantorAddress` text NOT NULL,
  `guarantorOccupation` varchar(255) NOT NULL,
  `guarantorSignature` varchar(255) NOT NULL,
  `guarantorSignatureDate` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activeLeaves`
--

CREATE TABLE `activeLeaves` (
  `id` int(11) NOT NULL,
  `typeOfLeave` varchar(255) NOT NULL,
  `file_no` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dateOfProceedingOnLeave` date NOT NULL,
  `dateReturningToDuty` date NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `approved` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activeLeaves`
--

INSERT INTO `activeLeaves` (`id`, `typeOfLeave`, `file_no`, `user_id`, `dateOfProceedingOnLeave`, `dateReturningToDuty`, `deleted`, `approved`) VALUES
(1, 'Annual Leave', 'GOU/SS/005', 8, '2022-04-07', '2023-04-21', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `adminSignatures`
--

CREATE TABLE `adminSignatures` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminSignatures`
--

INSERT INTO `adminSignatures` (`id`, `admin_id`, `signature`, `dateCreated`) VALUES
(1, 9, 'whatsapp-image-2021-04-09-at-2.01.03-pm-2553.jpeg', '2021-04-09 13:41:19'),
(2, 8, 'whatsapp-image-2021-04-09-at-2.01.03-pm-7270.jpeg', '2021-04-09 16:57:39'),
(3, 7, 'whatsapp-image-2020-11-23-at-12.56.09-pm-6410.jpeg', '2021-04-13 15:02:06'),
(4, 25, 'staff-6568-4066.jpeg', '2022-04-07 18:43:56'),
(5, 26, 'signature-674-2726.jpeg', '2022-04-07 19:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `AnnaulleaveAdvice`
--

CREATE TABLE `AnnaulleaveAdvice` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `leaveDays` varchar(30) NOT NULL,
  `leaveFrom` datetime NOT NULL,
  `leaveTo` datetime NOT NULL,
  `resumeDutyOn` datetime NOT NULL,
  `leaveAddress` text NOT NULL,
  `personel_registrarSignature` varchar(255) DEFAULT NULL,
  `personel_DateSignature` datetime DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `annaulLeaveRequest`
--

CREATE TABLE `annaulLeaveRequest` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `file_no` varchar(30) NOT NULL,
  `department` varchar(50) NOT NULL,
  `salary_grade_level` varchar(100) NOT NULL,
  `rank` varchar(50) NOT NULL,
  `typeOfEmployment` varchar(20) NOT NULL,
  `dateOfARofDuty` date NOT NULL,
  `dateOfProceedingOnLeave` date NOT NULL,
  `dateReturningToDuty` date NOT NULL,
  `phoneNo` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `signatureOfEmployee` varchar(255) NOT NULL,
  `signatureDate` datetime NOT NULL DEFAULT current_timestamp(),
  `recommendationOfHOD` text DEFAULT NULL,
  `HodSignature` varchar(255) DEFAULT NULL,
  `HodDateSigned` timestamp NULL DEFAULT NULL,
  `personel_approvedFrom` date DEFAULT NULL,
  `personel_approvedTo` date DEFAULT NULL,
  `personel_registrarSignature` varchar(255) DEFAULT NULL,
  `personel_DateSignature` date DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `pending` tinyint(4) NOT NULL DEFAULT 0,
  `approved` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `annaulLeaveRequest`
--

INSERT INTO `annaulLeaveRequest` (`id`, `full_name`, `file_no`, `department`, `salary_grade_level`, `rank`, `typeOfEmployment`, `dateOfARofDuty`, `dateOfProceedingOnLeave`, `dateReturningToDuty`, `phoneNo`, `address`, `signatureOfEmployee`, `signatureDate`, `recommendationOfHOD`, `HodSignature`, `HodDateSigned`, `personel_approvedFrom`, `personel_approvedTo`, `personel_registrarSignature`, `personel_DateSignature`, `deleted`, `pending`, `approved`) VALUES
(1, 'Mary Blessing Employee', 'GOU/SS/005', 'Computer Science', '16', 'Chief Lecturer', 'permanent', '2022-04-07', '2022-04-30', '2023-04-30', '08027837444', 'Lagos state nigeria', 'signature-7680-1800.jpeg', '2022-04-07 19:32:48', 'The employee is of good character', 'staff-6568-4066.jpeg', '2022-04-06 23:00:00', '2022-04-07', '2023-04-21', 'signature-674-2726.jpeg', '2022-04-07', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Assump_Resump_Duty_Certi`
--

CREATE TABLE `Assump_Resump_Duty_Certi` (
  `id` int(11) NOT NULL,
  `file_no` varchar(30) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `level_type` varchar(50) NOT NULL,
  `empSignature` varchar(255) NOT NULL,
  `empSignatureDate` varchar(255) NOT NULL,
  `dutyDate` datetime NOT NULL,
  `hodSignature` varchar(255) DEFAULT NULL,
  `hodName` varchar(100) DEFAULT NULL,
  `hodDateSigned` datetime DEFAULT NULL,
  `personel_comment` text DEFAULT NULL,
  `personel_signature` varchar(255) DEFAULT NULL,
  `personel_dateSigned` datetime DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `casaulLeave`
--

CREATE TABLE `casaulLeave` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `letterOfLeave` text NOT NULL,
  `date` date NOT NULL,
  `approved` int(11) NOT NULL DEFAULT 0,
  `pending` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `deleted`) VALUES
(1, 'Annual Leave', 0),
(2, 'Medical Leave', 0),
(3, 'Maternity Leave', 0),
(4, 'Study Leave', 0),
(5, 'Casual Leave', 0),
(6, 'Hajj or Umrah Leave', 1),
(7, 'Sabbatical Leave', 0),
(8, 'Administrative leave', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `deleted`) VALUES
(30, 'Burser', 0),
(31, 'Works & Services', 0),
(32, 'Exams & Recored', 0),
(33, 'Student Affairs', 0),
(34, 'EDC', 0),
(35, 'ICT Directorate', 0),
(36, 'Personnel Department', 0),
(37, 'Medical', 0),
(38, 'Computer Science', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `replied` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `subject`, `feedback`, `dateCreated`, `replied`, `deleted`) VALUES
(1, 4, 'Testing feedback', 'Developer testing feedback module', '2021-04-22 10:56:50', 0, 0),
(2, 1, 'Good morning developer', 'Good morning developer how was your night, how is your gal friend and wife', '2021-04-23 07:56:21', 1, 0),
(4, 1, 'New feedback', 'It seems you made mistake on your code sir', '2021-04-23 08:03:46', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fileNos`
--

CREATE TABLE `fileNos` (
  `id` int(11) NOT NULL,
  `fileNo` varchar(30) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fileNos`
--

INSERT INTO `fileNos` (`id`, `fileNo`, `deleted`) VALUES
(1, 'GOU/SS/001', 0),
(2, 'GOU/SS/002', 0),
(3, 'GOU/SS/003', 0),
(4, 'GOU/SS/004', 0),
(5, 'GOU/SS/005', 0),
(6, 'GOU/SS/006', 0),
(7, 'GOU/SS/007', 0),
(8, 'GOU/SS/008', 0),
(9, 'GOU/SS/009', 0),
(10, 'GOU/SS/010', 0),
(11, 'GOU/SS/011', 0),
(12, 'GOU/SS/012', 0),
(13, 'GOU/SS/013', 0),
(14, 'GOU/SS/014', 0),
(15, 'GOU/SS/015', 0),
(16, 'GOU/SS/016', 0),
(17, 'GOU/SS/017', 0),
(18, 'GOU/SS/018', 0),
(19, 'GOU/SS/019', 0),
(20, 'GOU/SS/020', 0),
(21, 'GOU/JS/001', 0),
(22, 'GOU/JS/002', 0),
(23, 'GOU/JS/003', 0),
(24, 'GOU/JS/004', 0),
(25, 'GOU/JS/005', 0),
(26, 'GOU/JS/006', 0),
(27, 'GOU/JS/007', 0),
(28, 'GOU/JS/008', 0),
(29, 'GOU/JS/009', 0),
(30, 'GOU/JS/010', 0),
(31, 'GOU/JS/011', 0),
(32, 'GOU/JS/012', 0),
(33, 'GOU/JS/013', 0),
(34, 'GOU/JS/014', 0),
(35, 'GOU/JS/015', 0),
(36, 'GOU/JS/016', 0),
(37, 'GOU/JS/017', 0),
(38, 'GOU/JS/018', 0),
(39, 'GOU/JS/019', 0),
(40, 'GOU/JS/020', 0);

-- --------------------------------------------------------

--
-- Table structure for table `leaveRequestCount`
--

CREATE TABLE `leaveRequestCount` (
  `id` int(11) NOT NULL,
  `countRequest` bigint(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `maternityLeave`
--

CREATE TABLE `maternityLeave` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `leaveFrom` date NOT NULL,
  `dueToDeliver` date NOT NULL,
  `medicalOfficerSignature` varchar(255) DEFAULT NULL,
  `medicalOfficer_DateSignature` date DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `pending` int(11) NOT NULL DEFAULT 0,
  `approved` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicalLeave`
--

CREATE TABLE `medicalLeave` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `leaveFrom` datetime NOT NULL,
  `medicalOfficerSignature` varchar(255) DEFAULT NULL,
  `medicalOfficer_DateSignature` datetime DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `pending` int(11) NOT NULL DEFAULT 0,
  `approved` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `monitorHead`
--

CREATE TABLE `monitorHead` (
  `id` int(11) NOT NULL,
  `super_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `otp_table`
--

CREATE TABLE `otp_table` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(32) DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pwdReset`
--

CREATE TABLE `pwdReset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` text NOT NULL,
  `pwdResetExpires` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sabaticalLeave`
--

CREATE TABLE `sabaticalLeave` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `file_no` varchar(30) NOT NULL,
  `department` varchar(50) NOT NULL,
  `grade_level` varchar(100) NOT NULL,
  `rank` varchar(50) NOT NULL,
  `typeOfEmployment` varchar(20) NOT NULL,
  `dateOfProceedingOnLeave` date NOT NULL,
  `dateReturningToDuty` date NOT NULL,
  `expirationDate` date NOT NULL,
  `phoneNo` varchar(15) NOT NULL,
  `organisation` varchar(255) NOT NULL,
  `signatureOfBeneficiary` varchar(255) NOT NULL,
  `BeneficiarySignatureDate` datetime NOT NULL DEFAULT current_timestamp(),
  `address` text DEFAULT NULL,
  `personel_approvedFrom` datetime DEFAULT NULL,
  `personel_approvedTo` datetime DEFAULT NULL,
  `personel_registrarSignature` varchar(255) DEFAULT NULL,
  `personel_DateSignature` datetime DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `pending` int(11) NOT NULL DEFAULT 0,
  `approved` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schoolsTable`
--

CREATE TABLE `schoolsTable` (
  `id` int(11) NOT NULL,
  `school` text NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schoolsTable`
--

INSERT INTO `schoolsTable` (`id`, `school`, `deleted`) VALUES
(1, 'School of Business Studies', 0),
(2, 'School of Engineering', 0),
(3, 'School of Environmental Studies', 0),
(4, 'School of General & Admin Studies', 0),
(5, 'School of Technology', 0);

-- --------------------------------------------------------

--
-- Table structure for table `signatures`
--

CREATE TABLE `signatures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `empSignature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signatures`
--

INSERT INTO `signatures` (`id`, `user_id`, `empSignature`) VALUES
(1, 8, 'signature-7680-1800.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state` varchar(50) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`, `deleted`) VALUES
(1, 'Abia ', 0),
(2, 'Abuja ', 0),
(3, 'Adamawa ', 0),
(4, 'Akwa Ibom ', 0),
(5, 'Anambra ', 0),
(6, 'Bauchi ', 0),
(7, 'Bayelsa ', 0),
(8, 'Benue ', 0),
(9, 'Borno ', 0),
(10, 'Cross River ', 0),
(11, 'Delta ', 0),
(12, 'Ebonyi ', 0),
(13, 'Edo ', 0),
(14, 'Ekiti ', 0),
(15, 'Enugu ', 0),
(16, 'Gombe ', 0),
(17, 'Imo ', 0),
(18, 'Jigawa ', 0),
(19, 'Kaduna ', 0),
(20, 'Kano ', 0),
(21, 'Katsina ', 0),
(22, 'Kebbi ', 0),
(23, 'Kogi ', 0),
(24, 'Kwara ', 0),
(25, 'Lagos ', 0),
(26, 'Nasarawa ', 0),
(27, 'Niger ', 0),
(28, 'Ogun ', 0),
(29, 'Ondo ', 0),
(30, 'Osun ', 0),
(31, 'Oyo ', 0),
(32, 'Plateau ', 0),
(33, 'Rivers ', 0),
(34, 'Sokoto ', 0),
(35, 'Taraba ', 0),
(36, 'Yobe ', 0),
(37, 'Zamfara ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_session`
--

CREATE TABLE `student_session` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `superusers`
--

CREATE TABLE `superusers` (
  `id` int(11) NOT NULL,
  `sudo_full_name` varchar(255) NOT NULL,
  `sudo_fileNo` varchar(30) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `sudo_department` varchar(100) NOT NULL,
  `sudo_username` varchar(50) DEFAULT NULL,
  `sudo_email` varchar(255) NOT NULL,
  `sudo_phoneNo` varchar(15) NOT NULL,
  `sudo_password` varchar(255) NOT NULL,
  `sudo_permission` varchar(30) NOT NULL,
  `sudo_dateAdded` timestamp NOT NULL DEFAULT current_timestamp(),
  `sudo_lastLogin` timestamp NOT NULL DEFAULT current_timestamp(),
  `sudo_verified` tinyint(4) NOT NULL DEFAULT 0,
  `sudo_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `suspended` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superusers`
--

INSERT INTO `superusers` (`id`, `sudo_full_name`, `sudo_fileNo`, `profile_pic`, `sudo_department`, `sudo_username`, `sudo_email`, `sudo_phoneNo`, `sudo_password`, `sudo_permission`, `sudo_dateAdded`, `sudo_lastLogin`, `sudo_verified`, `sudo_deleted`, `suspended`) VALUES
(10, 'Developer Mike', 'GOU/SS/006', 'profile/default.png', 'ICT Directorate', 'Developer-6748', 'mike@gmail.com', '08107972756', '$2y$10$yJA1I2Db.6/4M5gdlQ0lkOUDecb4iFpLl3ko8rsC9E3OwU2OyyYwi', 'Medical,HR,HOD,Superuser', '2021-05-11 11:43:49', '2022-04-07 19:14:23', 0, 0, 0),
(25, 'Mary HOD', 'GOU/SS/020', 'default.png', 'Computer Science', 'Mary-5850', 'uzbgraphixsite@gmail.com', '08108938483', '$2y$10$OqBBFk3z6wNRz5QDw6IPFel72ioUcXPEgBpxYgmYVLdih8qdLeSc.', 'HOD', '2022-04-07 18:39:17', '2022-04-07 19:03:28', 1, 0, 0),
(26, 'Mary HR', 'GOU/SS/016', 'default.png', 'Personnel Department', 'Mary-2773', 'ucodetut@gmail.com', '09084740484', '$2y$10$WFPA30K9WNJT.IGLgmn5BebnY3cW2b.Z0s5Kz5Ell/ZEI6ElN6NnK', 'HR', '2022-04-07 19:06:27', '2022-04-07 19:09:10', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `super_profile`
--

CREATE TABLE `super_profile` (
  `id` int(11) NOT NULL,
  `sudo_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `super_profile`
--

INSERT INTO `super_profile` (`id`, `sudo_id`, `status`) VALUES
(6, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `super_session`
--

CREATE TABLE `super_session` (
  `id` int(11) NOT NULL,
  `sudo_id` int(11) NOT NULL,
  `sudo_hash` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `department` text NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `state` varchar(100) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `fileNo` varchar(50) NOT NULL,
  `typeOfEmploy` varchar(30) NOT NULL,
  `permission` varchar(20) NOT NULL,
  `dateJoined` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastLogin` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified` int(11) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `updated` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `passport`, `department`, `full_name`, `email`, `password`, `gender`, `state`, `phone_number`, `fileNo`, `typeOfEmploy`, `permission`, `dateJoined`, `lastLogin`, `verified`, `deleted`, `updated`) VALUES
(7, 'default.png', 'Computer Science', 'Mary Blessing', 'blqck48@gmail.com', '$2y$10$WVsSXlpLNCrSuOBPkYUYtOEtNoW4pvNBpQun.BgKh.NcLa4DmIKbm', 'female', 'Delta', '08107972754', 'GOU/SS/003', 'permanent', 'employeePerm', '2022-04-06 22:26:53', '2022-04-07 12:49:26', 0, 0, 0),
(8, 'myxj_20190920081018_fast-p0vxuwbnaawf8fs6teiwu3t67bd2xq71gm8nq45pyw-1584-4126.jpg', 'Computer Science', 'Mary Blessing Employee', 'ucodetut@gmail.com', '$2y$10$48/g3dF/PHHTltmEQVWHR.T/x90gx0zuvlvrG2TbsF8CjkzzT51VS', 'female', 'Delta', '08027837444', 'GOU/SS/005', 'permanent', 'employeePerm', '2022-04-07 18:18:26', '2022-04-07 19:14:23', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `verifyAdmin`
--

CREATE TABLE `verifyAdmin` (
  `id` int(11) NOT NULL,
  `sudo_email` varchar(255) NOT NULL,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verifyAdmin`
--

INSERT INTO `verifyAdmin` (`id`, `sudo_email`, `token`) VALUES
(6, 'ucodetut@gmail.com', '4902a04f413c43cc9aa9bc13dd25999c');

-- --------------------------------------------------------

--
-- Table structure for table `verifyEmail`
--

CREATE TABLE `verifyEmail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `dataVerified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acceptanceOfStudyLeave`
--
ALTER TABLE `acceptanceOfStudyLeave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activeLeaves`
--
ALTER TABLE `activeLeaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminSignatures`
--
ALTER TABLE `adminSignatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `AnnaulleaveAdvice`
--
ALTER TABLE `AnnaulleaveAdvice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `annaulLeaveRequest`
--
ALTER TABLE `annaulLeaveRequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Assump_Resump_Duty_Certi`
--
ALTER TABLE `Assump_Resump_Duty_Certi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `casaulLeave`
--
ALTER TABLE `casaulLeave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fileNos`
--
ALTER TABLE `fileNos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maternityLeave`
--
ALTER TABLE `maternityLeave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicalLeave`
--
ALTER TABLE `medicalLeave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitorHead`
--
ALTER TABLE `monitorHead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_table`
--
ALTER TABLE `otp_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdReset`
--
ALTER TABLE `pwdReset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sabaticalLeave`
--
ALTER TABLE `sabaticalLeave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schoolsTable`
--
ALTER TABLE `schoolsTable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_session`
--
ALTER TABLE `student_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superusers`
--
ALTER TABLE `superusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sudo_fileNo` (`sudo_fileNo`),
  ADD UNIQUE KEY `sudo_email` (`sudo_email`),
  ADD UNIQUE KEY `sudo_phoneNo` (`sudo_phoneNo`),
  ADD UNIQUE KEY `sudo_username` (`sudo_username`);

--
-- Indexes for table `super_profile`
--
ALTER TABLE `super_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_session`
--
ALTER TABLE `super_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `verifyAdmin`
--
ALTER TABLE `verifyAdmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifyEmail`
--
ALTER TABLE `verifyEmail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acceptanceOfStudyLeave`
--
ALTER TABLE `acceptanceOfStudyLeave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activeLeaves`
--
ALTER TABLE `activeLeaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adminSignatures`
--
ALTER TABLE `adminSignatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `AnnaulleaveAdvice`
--
ALTER TABLE `AnnaulleaveAdvice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `annaulLeaveRequest`
--
ALTER TABLE `annaulLeaveRequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Assump_Resump_Duty_Certi`
--
ALTER TABLE `Assump_Resump_Duty_Certi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `casaulLeave`
--
ALTER TABLE `casaulLeave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fileNos`
--
ALTER TABLE `fileNos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `maternityLeave`
--
ALTER TABLE `maternityLeave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicalLeave`
--
ALTER TABLE `medicalLeave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monitorHead`
--
ALTER TABLE `monitorHead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_table`
--
ALTER TABLE `otp_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pwdReset`
--
ALTER TABLE `pwdReset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sabaticalLeave`
--
ALTER TABLE `sabaticalLeave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schoolsTable`
--
ALTER TABLE `schoolsTable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `signatures`
--
ALTER TABLE `signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `student_session`
--
ALTER TABLE `student_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superusers`
--
ALTER TABLE `superusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `super_profile`
--
ALTER TABLE `super_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `super_session`
--
ALTER TABLE `super_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `verifyAdmin`
--
ALTER TABLE `verifyAdmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `verifyEmail`
--
ALTER TABLE `verifyEmail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
