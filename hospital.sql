-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 11:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `type` enum('doctor','patient','pharmacist') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`id`, `name`, `email`, `password`, `phone_number`, `type`) VALUES
(213, 'sozan', 'sozanwaleed8@gmail.com', '$2y$10$31wqCF27eh7tslw5xXHyoOWwxdV/dueOgqgoQqgyu4xrLzpaSBHZS', '111111111', 'doctor'),
(215, 'alaa', 'alaa@gmail.com', '$2y$10$YpwLKuBwDhbC7gpFO6o43OvmnbrQL2Ph0sWJtnbxbRMa.OHBWz25q', '05987563', 'patient'),
(216, 'ahmed', 'ah@gmail.com', '$2y$10$fgERHyS6jU8.a92jsqXkluwlXbWLPXgomXa3dHhLEbAU5QvSQNmPC', '059876868', 'pharmacist'),
(217, 'omar ', 'o@gmail.com', '$2y$10$fL5y5gdbxaIaAo2W.ROMdOF6Cz5n1C.Yche1gGLzymbGzgRGj1Wwu', '0598747411', 'patient'),
(218, 'amal', 'amal@gmail.com', '$2y$10$PX2qUPrrRa0Plh26c11JPewcPI2Q9PRK24EmjfEB4eDqgJ7dICj8e', '05985236', 'doctor'),
(220, 'Mohammed', 'm@gmail.com', '$2y$10$Atogevxu3LwhYsuPIz/XSeafo1uPrayCJEEBTIlKa3xLzA6GYZ0RG', '05987563', 'patient'),
(221, 'Zain', 'z@gmail.com', '$2y$10$fVcYb2KIYAaANJF0eSJS.ex5ft08g4oDJhnQwIWcpsgByh21ZawUy', '05955222', 'patient');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `actor_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `email`, `password`, `phone_number`, `actor_id`) VALUES
(37, 'sozan', 'sozanwaleed8@gmail.com', '$2y$10$31wqCF27eh7tslw5xXHyoOWwxdV/dueOgqgoQqgyu4xrLzpaSBHZS', '111111111', 213),
(38, 'amal', 'amal@gmail.com', '$2y$10$PX2qUPrrRa0Plh26c11JPewcPI2Q9PRK24EmjfEB4eDqgJ7dICj8e', '05985236', 218);

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `dosage` double NOT NULL,
  `productionDate` date NOT NULL,
  `expiryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `dosage`, `productionDate`, `expiryDate`) VALUES
(26, 'acamol', 1234, '2000-12-12', '2000-12-14'),
(27, 'panadol', 1288, '7777-07-07', '8888-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `patientdoctor`
--

CREATE TABLE `patientdoctor` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `doctor_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientdoctor`
--

INSERT INTO `patientdoctor` (`id`, `patient_id`, `doctor_id`) VALUES
(30, 92, 37),
(31, 93, 37),
(33, 95, 38),
(34, 96, 38);

-- --------------------------------------------------------

--
-- Table structure for table `patientdrug`
--

CREATE TABLE `patientdrug` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `drug_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientdrug`
--

INSERT INTO `patientdrug` (`id`, `patient_id`, `drug_id`) VALUES
(48, 92, 26),
(49, 93, 27),
(52, 95, 26),
(55, 92, 27),
(56, 93, 26),
(57, 95, 27),
(59, 96, 26),
(60, 96, 27);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `problem` text DEFAULT NULL,
  `entranceDate` date DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL,
  `actor_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `email`, `password`, `age`, `gender`, `problem`, `entranceDate`, `phone_number`, `actor_id`) VALUES
(92, 'alaa', 'alaa@gmail.com', '$2y$10$YpwLKuBwDhbC7gpFO6o43OvmnbrQL2Ph0sWJtnbxbRMa.OHBWz25q', 30, 'Female', 'sssss', '1111-11-11', '05987563', 215),
(93, 'omar ', 'o@gmail.com', '$2y$10$fL5y5gdbxaIaAo2W.ROMdOF6Cz5n1C.Yche1gGLzymbGzgRGj1Wwu', 40, 'Male', 'sick', '4444-04-04', '0598747411', 217),
(95, 'Mohammed', 'm@gmail.com', '$2y$10$Atogevxu3LwhYsuPIz/XSeafo1uPrayCJEEBTIlKa3xLzA6GYZ0RG', 23, 'Male', 'fffffffff', '1111-11-11', '05987563', 220),
(96, 'Zain', 'z@gmail.com', '$2y$10$fVcYb2KIYAaANJF0eSJS.ex5ft08g4oDJhnQwIWcpsgByh21ZawUy', 42, 'Male', 'xxxxx', '1111-11-11', '05955222', 221);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacists`
--

CREATE TABLE `pharmacists` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `actor_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacists`
--

INSERT INTO `pharmacists` (`id`, `name`, `email`, `password`, `phone_number`, `actor_id`) VALUES
(9, 'ahmed', 'ah@gmail.com', '$2y$10$fgERHyS6jU8.a92jsqXkluwlXbWLPXgomXa3dHhLEbAU5QvSQNmPC', '059876868', 216);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk` (`actor_id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patientdoctor`
--
ALTER TABLE `patientdoctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `patientdrug`
--
ALTER TABLE `patientdrug`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `drug_id` (`drug_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `k` (`actor_id`);

--
-- Indexes for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `f` (`actor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `patientdoctor`
--
ALTER TABLE `patientdoctor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `patientdrug`
--
ALTER TABLE `patientdrug`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `pharmacists`
--
ALTER TABLE `pharmacists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `fk` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patientdoctor`
--
ALTER TABLE `patientdoctor`
  ADD CONSTRAINT `patientdoctor_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `patientdoctor_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `patientdrug`
--
ALTER TABLE `patientdrug`
  ADD CONSTRAINT `patientdrug_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `patientdrug_ibfk_2` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `k` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD CONSTRAINT `f` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
