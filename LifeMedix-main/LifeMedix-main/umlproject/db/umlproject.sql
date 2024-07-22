-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 04:38 PM
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
-- Database: `umlproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `AppointmentID` int(11) NOT NULL,
  `PatientID` varchar(20) DEFAULT NULL,
  `PatientFullName` varchar(30) NOT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `AppointmentDate` datetime DEFAULT NULL,
  `Notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`AppointmentID`, `PatientID`, `PatientFullName`, `DoctorID`, `AppointmentDate`, `Notes`) VALUES
(8, '654e520914762', 'Pawan', 1, '2023-11-15 22:58:00', 'none'),
(11, '654e520914762', 'Kushvanth', 1, '2023-11-16 14:09:00', 'Bone pain'),
(12, '654e520914762', 'Pavan ARIPAKA', 1, '2023-11-23 12:59:00', 'Fever'),
(13, '654e520914762', 'Kushvanth', 1, '2023-11-08 13:20:00', 'Fever');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `DoctorID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Specialization` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Available` int(1) NOT NULL DEFAULT 1,
  `Location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`DoctorID`, `FirstName`, `LastName`, `Specialization`, `Email`, `PhoneNumber`, `Available`, `Location`) VALUES
(1, 'Rajesh', 'Gupta', 'Orthopedic Surgeon', 'gupta@gmail.com', '2134235235', 1, 'Pendurthi,Visakhapat'),
(2, 'John', 'Smith', 'Orthopedic Surgeon', 'john.smith@example.com', '123-456-7890', 1, 'City Hospital'),
(3, 'Emily', 'Johnson', 'Pediatrician', 'emily.johnson@example.com', '987-654-3210', 1, 'County Clinic'),
(4, 'Michael', 'Garcia', 'Cardiologist', 'michael.garcia@example.com', '456-789-0123', 1, 'Metro Health'),
(5, 'Sarah', 'Lee', 'Dermatologist', 'sarah.lee@example.com', '789-012-3456', 1, 'Coastal Clinic'),
(6, 'David', 'Rodriguez', 'Neurologist', 'david.rodriguez@example.com', '567-890-1234', 1, 'Summit Hospital'),
(7, 'Olivia', 'Martinez', 'Gastroenterologist', 'olivia.martinez@example.com', '321-654-0987', 1, 'Central Clinic'),
(8, 'William', 'Brown', 'Ophthalmologist', 'william.brown@example.com', '234-567-8901', 1, 'City Eye Center'),
(9, 'Sophia', 'Wilson', 'Psychiatrist', 'sophia.wilson@example.com', '111-222-3333', 1, 'Serenity Clinic'),
(10, 'Aiden', 'Thompson', 'Endocrinologist', 'aiden.thompson@example.com', '999-888-7777', 1, 'Harmony Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientID` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `Patientname` varchar(40) NOT NULL,
  `Allergies` varchar(100) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Age` int(5) NOT NULL,
  `Updated` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PatientID`, `username`, `Patientname`, `Allergies`, `Gender`, `Age`, `Updated`) VALUES
('654e520914762', 'Kushvanth03', 'Ch Pawan', 'none', 'male', 20, 1),
('6551d22c122d3', 'Kushvanth12', 'Ch Pawan', 'None', 'male', 20, 1),
('65772a1ab0563', 'Hemanth', 'Ch Pawan', 'none', 'male', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phonenumber` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`username`, `email`, `password`, `phonenumber`) VALUES
('Hemanth', 'abdul@gmail.com', '1234', '1897984546'),
('Kushvanth03', 'bandaru@gmail.com', '12345678', ''),
('Kushvanth12', 'snpawan1107@gmail.com', 'kush', '1234567890');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `DoctorID` (`DoctorID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`DoctorID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PatientID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_phone` (`phonenumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`DoctorID`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userdata` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
