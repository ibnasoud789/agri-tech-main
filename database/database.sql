-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Apr 13, 2024 at 11:12 AM
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
-- Database: `practise2`
--

-- --------------------------------------------------------

--
-- Table structure for table `advising`
--

CREATE TABLE `advising` (
  `Advise_ID` int(5) NOT NULL,
  `Advisor_ID` varchar(7) NOT NULL,
  `Farmer_ID` varchar(7) NOT NULL,
  `Problem_statement` varchar(1000) NOT NULL,
  `Solution` varchar(200) NOT NULL,
  `Problem_issue_date` date NOT NULL,
  `Solution_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advising`
--

INSERT INTO `advising` (`Advise_ID`, `Advisor_ID`, `Farmer_ID`, `Problem_statement`, `Solution`, `Problem_issue_date`, `Solution_date`) VALUES
(2, '1000045', '1000017', 'Problem controlling pests even after applying pesticides.', 'Use Antropine', '2024-04-03', '2024-04-11'),
(3, '1000043', '1000012', 'dsff', 'sdgoijditjr', '2024-04-11', '2024-04-11'),
(4, '1000042', '1000018', 'As a farmer looking to adopt precision farming techniques, I am curious about the potential benefits and challenges associated with implementing precision agriculture on my farm. Could you provide some insights into how precision farming technologies, such as GPS-guided machinery, drones, and sensors, can improve crop management practices?', 'Precision farming offers numerous benefits that can significantly enhance crop management practices and overall farm productivity. By utilizing advanced technologies such as GPS-guided machinery, dron', '2024-04-11', '2024-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `advising_application`
--

CREATE TABLE `advising_application` (
  `Farmer_ID` varchar(7) NOT NULL,
  `Farmer_Name` varchar(20) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Problem_statement` varchar(1000) NOT NULL,
  `Problem_issue_date` date DEFAULT NULL,
  `Solution_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advising_application`
--

INSERT INTO `advising_application` (`Farmer_ID`, `Farmer_Name`, `Category`, `Problem_statement`, `Problem_issue_date`, `Solution_status`) VALUES
('1000017', 'Abul  Rahman', 'Pest Control', 'Problem controlling pests even after applying pesticides.', NULL, 'Given'),
('1000012', 'Rohim  Mia', 'Soil Health Management', 'dsff', '2024-04-11', 'Given'),
('1000012', 'Rohim  Mia', 'Agronomy', 'I am facing a significant challenge with soil erosion on my farm. Despite my efforts to implement conservation practices like contour plowing and cover cropping, erosion continues to be a persistent issue, especially during heavy rainstorms.', '2024-04-11', 'Pending'),
('1000018', 'Abid  Rahman', 'Precision Farming', 'As a farmer looking to adopt precision farming techniques, I am curious about the potential benefits and challenges associated with implementing precision agriculture on my farm. Could you provide some insights into how precision farming technologies, such as GPS-guided machinery, drones, and sensors, can improve crop management practices?', '2024-04-11', 'Given'),
('1000005', 'Kashem  Ali', 'Pest Control', 'Facing problem controlling pests. It is causing much problem to my crops.', '2024-04-13', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

CREATE TABLE `advisor` (
  `Advisor ID` varchar(7) NOT NULL,
  `fname` tinytext NOT NULL,
  `mname` tinytext NOT NULL,
  `lname` tinytext NOT NULL,
  `Expertise` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`Advisor ID`, `fname`, `mname`, `lname`, `Expertise`) VALUES
('1000009', 'Mohammad', 'Hisham', 'Uddin', 'Agronomoy'),
('1000041', 'Tarek', '', 'Aziz', 'Crop Rotation'),
('1000042', 'Anwarul', 'Alam', 'Buiyan', 'Precision Farming'),
('1000043', 'Habib', 'M.', 'Ahsan', 'Soil Health Management'),
('1000044', 'Sakib', 'Al ', 'Hasan', 'Cash Flow Management'),
('1000045', 'Tamim', 'Iqbal', 'Khan', 'Pest Control');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_cropname_t`
--

CREATE TABLE `farmer_cropname_t` (
  `Farmer_ID` varchar(7) NOT NULL,
  `Cropname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_cropname_t`
--

INSERT INTO `farmer_cropname_t` (`Farmer_ID`, `Cropname`) VALUES
('1000005', 'Soyabean'),
('1000005', 'Sugarcane'),
('1000005', 'Tea'),
('1000012', 'Jute'),
('1000013', 'Paddy'),
('1000014', 'Potato'),
('1000015', 'Maize'),
('1000016', 'Barly'),
('1000017', 'Oats'),
('1000018', 'Cucumber'),
('1000019', 'Pulse'),
('1000020', 'Jute'),
('1000020', 'Soyabean');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_t`
--

CREATE TABLE `farmer_t` (
  `Farmer_ID` varchar(7) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `landsize` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_t`
--

INSERT INTO `farmer_t` (`Farmer_ID`, `fname`, `mname`, `lname`, `landsize`) VALUES
('1000005', 'Kashem', '', 'Ali', '230 sq m'),
('1000012', 'Rohim', '', 'Mia', '87 sq m'),
('1000013', 'Jobbar', '', '', '298 sq m'),
('1000014', 'Shannu', '', 'Roiz', '350 sq m'),
('1000015', 'Abdul', 'Alim', 'Khan', '200sq m'),
('1000016', 'Abul', 'Abid', 'Rahman', '354 sq m'),
('1000017', 'Abul', '', 'Rahman', '230'),
('1000018', 'Abid', '', 'Rahman', '500 sq m'),
('1000019', 'Abdul', '', 'Khan', '200sq m'),
('1000020', 'Rohmot', '', 'Khan', '526 sq m');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_t`
--

CREATE TABLE `feedback_t` (
  `user_ID` varchar(7) NOT NULL,
  `feedback_number` varchar(5) NOT NULL,
  `rating` int(2) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_t`
--

INSERT INTO `feedback_t` (`user_ID`, `feedback_number`, `rating`, `comment`) VALUES
('1000001', '1', 5, 'Service was top-notch'),
('1000002', '2', 2, 'Slow processing of loan'),
('1000003', '3', 9, 'Really helpful for farmers'),
('1000004', '4', 5, 'Hoping for improvement'),
('1000005', '5', 5, 'Focus on user experience'),
('1000006', '6', 4, 'Avoid irrelevant information'),
('1000007', '7', 8, 'Excellent service'),
('1000008', '8', 7, 'Hoping for the best'),
('1000009', '9', 4, 'Need to improve the loan processing time'),
('1000010', '10', 2, 'Not satisfied');

-- --------------------------------------------------------

--
-- Table structure for table `financial_service_provider_t`
--

CREATE TABLE `financial_service_provider_t` (
  `FSPid` varchar(7) NOT NULL,
  `name` varchar(100) NOT NULL,
  `L?` tinytext NOT NULL,
  `IP?` tinytext NOT NULL,
  `G?` tinytext NOT NULL,
  `I?` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `financial_service_provider_t`
--

INSERT INTO `financial_service_provider_t` (`FSPid`, `name`, `L?`, `IP?`, `G?`, `I?`) VALUES
('1000001', 'Atik Foundation', 'NO', 'NO', 'YES', 'NO'),
('1000002', 'Suvro Wellfare', 'NO', 'NO', 'YES', 'NO'),
('1000003', 'National Agriculture Foundation', 'NO', 'NO', 'YES', 'NO'),
('1000004', 'Khudro Bebsha', 'NO', 'NO', 'YES', 'NO'),
('1000006', 'Agriculture Ministry', 'NO', 'NO', 'YES', 'NO'),
('1000007', 'Horizon Europe', 'NO', 'NO', 'YES', 'NO'),
('1000008', 'Egiye Jabe Bangladesh', 'NO', 'NO', 'YES', 'NO'),
('1000010', 'Krishi Shohayika', 'NO', 'NO', 'YES', 'NO'),
('1000011', 'Amra Korbo Joy', 'NO', 'NO', 'YES', 'NO'),
('1000021', 'Agrani Bank', 'YES', 'NO', 'NO', 'YES'),
('1000022', 'Fatima Ahmed Foundation', 'NO', 'NO', 'NO', 'YES'),
('1000023', 'Sonali Bank', 'YES', 'YES', 'NO', 'NO'),
('1000024', 'Rajshahi Krishi Unnoyon Bank', 'YES', 'YES', 'NO', 'NO'),
('1000025', 'Nasir Uddin Ahmed', 'NO', 'NO', 'NO', 'YES'),
('1000026', 'Green Delta Insurance Limited', 'NO', 'YES', 'NO', 'YES'),
('1000027', 'Bank Asia', 'YES', 'NO', 'NO', 'NO'),
('1000028', 'City Bank', 'YES', 'YES', 'NO', 'NO'),
('1000029', 'BDBL', 'YES', 'NO', 'YES', 'YES'),
('1000030', 'Krishok Kollan Porishod', 'NO', 'NO', 'NO', 'YES'),
('1000031', 'Prime Insurance Company Limited', 'NO', 'YES', 'NO', 'NO'),
('1000032', 'Pubali Bank Limited', 'YES', 'NO', 'YES', 'NO'),
('1000033', 'Islami Bank Limited', 'YES', 'NO', 'NO', 'NO'),
('1000034', 'Grameen Bank', 'YES', 'NO', 'YES', 'NO'),
('1000035', 'Khan Krishi Foundation', 'NO', 'YES', 'NO', 'YES'),
('1000036', 'COSME Program', 'NO', 'NO', 'YES', 'NO'),
('1000037', 'MetLife Bangladesh', 'NO', 'YES', 'NO', 'NO'),
('1000038', 'Next Bangladesh', 'YES', 'NO', 'NO', 'YES'),
('1000039', 'SBAC Bank', 'YES', 'NO', 'YES', 'YES'),
('1000040', 'Amader Krishok', 'NO', 'NO', 'YES', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `grant_provider_t`
--

CREATE TABLE `grant_provider_t` (
  `Grant_provider_ID` varchar(7) NOT NULL,
  `Eligibility_criteria` tinytext NOT NULL,
  `Minimum_amount` decimal(10,0) NOT NULL,
  `Maximum_amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grant_provider_t`
--

INSERT INTO `grant_provider_t` (`Grant_provider_ID`, `Eligibility_criteria`, `Minimum_amount`, `Maximum_amount`) VALUES
('1000001', 'Crops damaged by excessive rain.', 10000, 1000000),
('1000002', 'Crops damaged by drought.', 15000, 1100000),
('1000003', 'Crops damaged by floods.', 11000, 2100000),
('1000004', 'Crops damaged by  heatwaves.', 14000, 2000000),
('1000006', 'Crops damaged by excessive rainfall.', 15000, 1500000),
('1000007', 'Crops damaged by herbicide drift.', 16000, 1600000),
('1000008', 'Crops damaged by  diseases.', 20000, 1200000),
('1000010', 'Crops damaged by frost.', 19000, 1100000),
('1000011', 'Crops damaged by pests.', 22000, 1900000),
('1000029', 'Crops damaged by drought.', 19000, 1500000),
('1000032', 'Crops damaged by frost.', 12000, 1100000),
('1000034', 'Crops damaged by pests.', 13000, 1200000),
('1000036', 'Crops damaged by drought.', 15000, 1500000),
('1000039', 'Crops damaged by frost.', 18000, 1400000),
('1000040', 'Crops damaged by drought.', 17000, 1800000);

-- --------------------------------------------------------

--
-- Table structure for table `grant_provider_target_t`
--

CREATE TABLE `grant_provider_target_t` (
  `Grant_provider_ID` varchar(7) NOT NULL,
  `Target_beneficiaries` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grant_provider_target_t`
--

INSERT INTO `grant_provider_target_t` (`Grant_provider_ID`, `Target_beneficiaries`) VALUES
('1000001', 'Smallholder Farmers'),
('1000002', 'Smallholder Farmers'),
('1000003', 'Smallholder Farmers'),
('1000004', 'Smallholder Farmers'),
('1000006', 'Smallholder Farmers'),
('1000007', 'Smallholder Farmers'),
('1000008', 'Smallholder Farmers'),
('1000010', 'Smallholder Farmers'),
('1000011', 'Smallholder Farmers'),
('1000029', 'Smallholder Farmers'),
('1000032', 'Smallholder Farmers'),
('1000034', 'Smallholder Farmers'),
('1000036', 'Smallholder Farmers'),
('1000039', 'Smallholder Farmers'),
('1000040', 'Smallholder Farmers');

-- --------------------------------------------------------

--
-- Table structure for table `grant_t`
--

CREATE TABLE `grant_t` (
  `Grant_provider_ID` varchar(7) NOT NULL,
  `Grant_ID` int(5) NOT NULL,
  `Grant_amount` decimal(10,0) NOT NULL,
  `Receiving_date` varchar(255) DEFAULT NULL,
  `Farmer_id` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grant_t`
--

INSERT INTO `grant_t` (`Grant_provider_ID`, `Grant_ID`, `Grant_amount`, `Receiving_date`, `Farmer_id`) VALUES
('1000001', 1, 80000, '2024-02-29', '1000012'),
('1000004', 2, 50000, '2024-01-29', '1000013'),
('1000003', 3, 55000, '2024-02-28', '1000014'),
('1000006', 4, 60000, '2024-01-19', '1000015'),
('1000010', 5, 72000, '2024-02-10', '1000016'),
('1000011', 6, 75000, '2024-02-20', '1000017'),
('1000029', 7, 50000, '2024-02-25', '1000018'),
('1000006', 8, 200000, '2024-04-01', '1000012'),
('1000007', 9, 100000, '2023-04-01', '1000005'),
('1000034', 10, 125000, '2024-04-01', '1000005');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_application`
--

CREATE TABLE `insurance_application` (
  `farmer_id` int(7) NOT NULL,
  `farmer_name` varchar(30) NOT NULL,
  `policy` varchar(50) NOT NULL,
  `preferred_provider` varchar(50) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance_application`
--

INSERT INTO `insurance_application` (`farmer_id`, `farmer_name`, `policy`, `preferred_provider`, `duration`, `status`) VALUES
(1000012, 'Rohim  Mia', 'Crop Revenue Insurance', 'Rajshahi Krishi Unnoyon Bank', '3 Year', 'Approved'),
(1000014, 'Shannu  Roiz', 'Area-Based Crop Insurance', 'Green Delta Insurance Limited', '4 Year', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_provider_t`
--

CREATE TABLE `insurance_provider_t` (
  `insurance_provider_id` varchar(7) NOT NULL,
  `premium_rate` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance_provider_t`
--

INSERT INTO `insurance_provider_t` (`insurance_provider_id`, `premium_rate`) VALUES
('1000023', 4.00),
('1000024', 5.00),
('1000026', 3.00),
('1000028', 2.00),
('1000029', 5.00),
('1000030', 2.00),
('1000031', 3.00),
('1000035', 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `insurance_t`
--

CREATE TABLE `insurance_t` (
  `farmer_id` varchar(7) NOT NULL,
  `insurance_id` int(5) NOT NULL,
  `policy_type` varchar(20) NOT NULL,
  `effective_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `coverage_amount` int(7) NOT NULL,
  `premium_amount` int(4) NOT NULL,
  `policy_period` varchar(100) NOT NULL,
  `payment_frequency` varchar(100) NOT NULL,
  `insurance_provider_id` varchar(7) NOT NULL,
  `insurance_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance_t`
--

INSERT INTO `insurance_t` (`farmer_id`, `insurance_id`, `policy_type`, `effective_date`, `end_date`, `coverage_amount`, `premium_amount`, `policy_period`, `payment_frequency`, `insurance_provider_id`, `insurance_status`) VALUES
('1000005', 1, 'Revenue-Based Policy', '2023-03-03', '2024-03-03', 150000, 4000, '1 year', 'Monthly', '1000023', 'Finished'),
('1000012', 2, 'Revenue-Based Policy', '2021-03-01', '2023-03-01', 280000, 5000, '2 year', 'Weekly', '1000026', 'Finished'),
('1000013', 3, 'Revenue-Based Policy', '2022-04-01', '2024-04-01', 280000, 2500, '2 year', 'Weekly', '1000023', 'Finished'),
('1000014', 4, 'Area-Based Policy', '2022-03-03', '2024-03-03', 240000, 5000, '2 year', 'Monthly', '1000029', 'Finished'),
('1000015', 5, 'Yield-Based Policy', '2023-07-17', '2026-07-17', 340000, 6000, '3 year', 'Monthly', '1000026', 'Ongoing'),
('1000016', 6, 'Revenue-Based Policy', '2024-01-21', '2027-01-21', 360000, 6000, '3 year', 'Monthly', '1000028', 'Ongoing'),
('1000017', 7, 'Area-Based Policy', '2023-04-13', '2027-04-13', 275000, 4000, '4 year', 'Weekly', '1000031', 'Ongoing'),
('1000018', 8, 'Yield-Based Policy', '2024-02-14', '2026-02-04', 480000, 6000, '2 year', 'Monthly', '1000031', 'Ongoing'),
('1000019', 9, 'Area-Based Policy', '2023-11-25', '2026-11-25', 500000, 6000, '3 year', 'Weekly', '1000035', 'Ongoing'),
('1000020', 10, 'Revenue-Based Policy', '2023-05-13', '2025-05-13', 290000, 4000, '2 year', 'Monthly', '1000035', 'Ongoing'),
('1000005', 11, 'Crop Yield Insurance', '2024-04-13', '2028-04-13', 300000, 5000, '4 Year', 'Monthly', '1000031', 'Ongoing'),
('1000014', 13, 'Area-Based Crop Insu', '2024-04-13', '2028-04-13', 300000, 8000, '4 Year', 'Monthly', '1000026', 'Ongoing'),
('1000012', 14, 'Crop Revenue Insuran', '2024-04-13', '2027-04-13', 300000, 8000, '3 Year', 'Monthly', '1000024', 'Ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `investment_application_t`
--

CREATE TABLE `investment_application_t` (
  `Farmer_ID` varchar(7) NOT NULL,
  `investment_amount` varchar(10) NOT NULL,
  `Duration` varchar(20) NOT NULL,
  `preferred_investor` varchar(50) NOT NULL,
  `farmer_name` varchar(50) DEFAULT NULL,
  `Verdict` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investment_application_t`
--

INSERT INTO `investment_application_t` (`Farmer_ID`, `investment_amount`, `Duration`, `preferred_investor`, `farmer_name`, `Verdict`) VALUES
('1000012', '200000', '1 year', 'Khan Krishi Foundation', 'Rohim  Mia', 'Approved'),
('1000013', '100000', '1 year', 'Agrani Bank', 'Jobbar  ', 'Approved'),
('1000013', '100000', '1 year', 'Agrani Bank', 'Jobbar  ', 'Declined'),
('1000017', '200000', '1 year', 'Green Delta Insurance Limited', 'Abul  Rahman', 'Approved'),
('1000019', '150000', '1 year', 'Khan Krishi Foundation', 'Abdul  Khan', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `investment_t`
--

CREATE TABLE `investment_t` (
  `Farmer_ID` varchar(7) NOT NULL,
  `Investor_ID` varchar(7) NOT NULL,
  `Investment_ID` int(5) NOT NULL,
  `Amount` int(10) NOT NULL,
  `Profit_share_rate` decimal(10,0) NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date NOT NULL,
  `investment_status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investment_t`
--

INSERT INTO `investment_t` (`Farmer_ID`, `Investor_ID`, `Investment_ID`, `Amount`, `Profit_share_rate`, `Start_date`, `End_date`, `investment_status`) VALUES
('1000005', '1000021', 1, 50000, 30, '2023-09-01', '2024-12-11', 'Ongoing '),
('1000012', '1000022', 2, 350000, 30, '2023-07-01', '2024-03-28', 'Finished'),
('1000013', '1000025', 3, 45000, 35, '2023-05-01', '2024-02-13', 'Finished'),
('1000014', '1000026', 4, 55000, 40, '2023-10-01', '2024-12-02', 'Ongoing '),
('1000017', '1000035', 7, 200000, 20, '2023-05-01', '2023-09-01', 'Finished'),
('1000018', '1000038', 8, 500000, 45, '2023-07-01', '2024-07-03', 'Ongoing'),
('1000019', '1000039', 9, 250000, 50, '2023-04-01', '2023-09-01', 'Finished'),
('1000020', '1000040', 10, 500000, 40, '2023-08-01', '2024-08-15', 'Ongoing'),
('1000016', '1000022', 11, 40000, 25, '2023-07-01', '2024-02-01', 'Finished'),
('1000013', '1000026', 12, 100000, 30, '2023-10-01', '2024-04-10', 'Finished'),
('1000017', '1000026', 20, 200000, 40, '2024-04-11', '2025-04-11', 'Ongoing'),
('1000012', '1000035', 21, 200000, 50, '2024-04-12', '2025-04-01', 'Ongoing'),
('1000019', '1000035', 22, 150000, 50, '2024-04-12', '2025-04-04', 'Ongoing'),
('1000013', '1000021', 26, 100000, 50, '2024-04-12', '2025-04-11', 'Ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `investor_t`
--

CREATE TABLE `investor_t` (
  `Investor_ID` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investor_t`
--

INSERT INTO `investor_t` (`Investor_ID`) VALUES
('1000021'),
('1000022'),
('1000025'),
('1000026'),
('1000029'),
('1000030'),
('1000035'),
('1000038'),
('1000039'),
('1000040');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `Loan_ID` int(5) NOT NULL,
  `receiving_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `interest_rate` decimal(10,0) NOT NULL,
  `return_date` date NOT NULL,
  `Farmer_ID` varchar(7) NOT NULL,
  `Loan_Provider_ID` varchar(7) NOT NULL,
  `loan_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`Loan_ID`, `receiving_date`, `amount`, `interest_rate`, `return_date`, `Farmer_ID`, `Loan_Provider_ID`, `loan_status`) VALUES
(1, '2022-10-10', 200000, 3, '2023-10-10', '1000005', '1000028', 'Repaid'),
(2, '2022-11-10', 350000, 5, '2023-11-10', '1000016', '1000034', 'Repaid'),
(3, '2022-11-28', 300000, 5, '2023-10-10', '1000018', '1000032', 'Repaid'),
(4, '2022-12-05', 40000, 1, '2023-12-10', '1000020', '1000039', 'Repaid'),
(5, '2023-01-01', 300000, 4, '2023-12-10', '1000014', '1000028', 'Repaid'),
(6, '2023-02-01', 100000, 3, '2023-12-10', '1000012', '1000033', 'Repaid'),
(7, '2023-03-01', 250000, 5, '2024-03-10', '1000012', '1000029', 'Repaid'),
(8, '2023-04-01', 200000, 5, '2024-04-01', '1000005', '1000028', 'Repaid'),
(10, '2023-07-01', 300000, 5, '2024-07-10', '1000016', '1000021', 'Ongoing'),
(12, '2023-12-01', 200000, 4, '2024-12-10', '1000018', '1000021', 'Ongoing'),
(16, '2024-04-10', 240000, 5, '2025-04-10', '1000020', '1000028', 'Ongoing'),
(17, '2024-04-10', 300000, 5, '2024-12-18', '1000013', '1000024', 'Ongoing'),
(18, '2024-04-10', 100000, 5, '2025-04-10', '1000015', '1000032', 'Ongoing'),
(22, '2024-04-10', 100000, 5, '2024-12-10', '1000012', '1000027', 'Ongoing'),
(23, '2024-04-10', 200000, 5, '2025-04-10', '1000014', '1000023', 'Ongoing'),
(24, '2024-04-10', 250000, 5, '2025-04-10', '1000017', '1000029', 'Ongoing'),
(25, '2024-04-11', 100000, 5, '2025-04-11', '1000019', '1000032', 'Ongoing'),
(26, '2024-04-12', 100000, 5, '2025-04-02', '1000005', '1000027', 'Ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `loan_application_t`
--

CREATE TABLE `loan_application_t` (
  `farmer_id` varchar(7) NOT NULL,
  `loan_amount` varchar(10) NOT NULL,
  `preferred_bank` varchar(50) NOT NULL,
  `farmer_name` varchar(50) DEFAULT NULL,
  `Verdict` varchar(50) NOT NULL,
  `duration` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_application_t`
--

INSERT INTO `loan_application_t` (`farmer_id`, `loan_amount`, `preferred_bank`, `farmer_name`, `Verdict`, `duration`) VALUES
('1000014', '200000', 'Sonali Bank', 'Shannu  Roiz', 'Approved', '1year'),
('1000017', '250000', 'Islami Bank Limited', 'Abul  Rahman', 'Approved', '1 year'),
('1000017', '250000', 'Islami Bank Limited', 'Abul  Rahman', 'Approved', '1 year'),
('1000017', '250000', 'BDBL', 'Abul  Rahman', 'Approved', '1 year'),
('1000019', '100000', 'Pubali Bank Limited', 'Abdul  Khan', 'Approved', '1 year'),
('1000005', '100000', 'Bank Asia', 'Kashem  Ali', 'Approved', '1 year'),
('1000005', '100000', 'Bank Asia', 'Kashem  Ali', 'Approved', '1 year'),
('1000005', '20000', 'Pubali Bank Limited', 'Kashem  Ali', 'Pending', '6 months');

-- --------------------------------------------------------

--
-- Table structure for table `loan_provider`
--

CREATE TABLE `loan_provider` (
  `LoanProvider_ID` varchar(7) NOT NULL,
  `eligibility_criteria` text NOT NULL,
  `repayment_period` datetime NOT NULL,
  `application_fee` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_provider`
--

INSERT INTO `loan_provider` (`LoanProvider_ID`, `eligibility_criteria`, `repayment_period`, `application_fee`) VALUES
('1000021', 'Legal Requirements', '2023-12-10 00:00:00', '300'),
('1000023', 'Business Plan', '2024-02-10 00:00:00', '300'),
('1000024', 'Farm Ownership or Tenure', '2024-03-05 00:00:00', '300'),
('1000027', 'Purpose of Loan', '2024-03-10 00:00:00', '300'),
('1000028', 'Income and Financial Statement', '2024-03-06 00:00:00', '300'),
('1000029', 'Insurance', '2024-03-07 00:00:00', '300'),
('1000032', 'Income and Financial Statement', '2024-03-16 00:00:00', '300'),
('1000033', 'Business Plan', '2024-03-11 00:00:00', '300'),
('1000034', 'Collateral', '2024-03-16 00:00:00', '300'),
('1000038', 'Legal Requirements', '2024-03-12 00:00:00', '300'),
('1000039', 'Collateral', '2024-03-16 00:00:00', '300');

-- --------------------------------------------------------

--
-- Table structure for table `loan_provider_loan_type`
--

CREATE TABLE `loan_provider_loan_type` (
  `LoanProvider_ID` varchar(7) NOT NULL,
  `loan_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_provider_loan_type`
--

INSERT INTO `loan_provider_loan_type` (`LoanProvider_ID`, `loan_type`) VALUES
('1000021', 'croploan'),
('1000021', 'Microloan'),
('1000023', 'Equipment'),
('1000024', 'Agribusiness'),
('1000024', 'Real Estate Loan'),
('1000027', 'Seasonal'),
('1000028', 'Microloan'),
('1000029', 'croploan'),
('1000029', 'Disaster Assistance Loan'),
('1000032', 'Government-Sponsored Loan'),
('1000033', 'Seasonal'),
('1000034', 'Microloan'),
('1000038', 'croploan'),
('1000038', 'Disaster Assistance Loan'),
('1000038', 'Government-Sponsored Loan');

-- --------------------------------------------------------

--
-- Table structure for table `login_t`
--

CREATE TABLE `login_t` (
  `ID` varchar(7) NOT NULL,
  `Password` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_t`
--

INSERT INTO `login_t` (`ID`, `Password`) VALUES
('1000001', '12345678'),
('1000002', '12345678'),
('1000003', '12345678'),
('1000004', '12345678'),
('1000005', '12345678'),
('1000006', '12345678'),
('1000007', '12345678'),
('1000008', '12345678'),
('1000009', '12345678'),
('1000010', '12345678'),
('1000011', '12345678'),
('1000012', '12345678'),
('1000013', '12345678'),
('1000014', '12345678'),
('1000015', '12345678'),
('1000016', '12345678'),
('1000017', '12345678'),
('1000018', '12345678'),
('1000019', '12345678'),
('1000020', '12345678'),
('1000021', '12345678'),
('1000022', '12345678'),
('1000023', '12345678'),
('1000024', '12345678'),
('1000025', '12345678'),
('1000026', '12345678'),
('1000027', '12345678'),
('1000028', '12345678'),
('1000029', '12345678'),
('1000030', '12345678'),
('1000031', '12345678'),
('1000032', '12345678'),
('1000033', '12345678'),
('1000034', '12345678'),
('1000035', '12345678'),
('1000036', '12345678'),
('1000037', '12345678'),
('1000038', '12345678'),
('1000039', '12345678'),
('1000040', '12345678'),
('1000041', '12345678'),
('1000042', '12345678'),
('1000043', '12345678'),
('1000044', '12345678'),
('1000045', '12345678'),
('1000046', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` varchar(7) NOT NULL,
  `Area` tinytext NOT NULL,
  `city` tinytext NOT NULL,
  `postcode` int(4) NOT NULL,
  `contact_number` tinytext NOT NULL,
  `user_type` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `Area`, `city`, `postcode`, `contact_number`, `user_type`) VALUES
('1000001', 'Road no 6', 'Dhaka', 1205, '171517211', 'Financial Service Provider'),
('1000002', 'Road no 1', 'Dhaka', 1205, '171517221', 'Financial Service Provider'),
('1000003', 'Road no 9', 'Dhaka', 1205, '171517211', 'Financial Service Provider'),
('1000004', 'Road no 5', 'Dhaka', 1205, '171517211', 'Financial Service Provider'),
('1000005', 'Lalakhal', 'Madaripur', 3105, '171517520', 'Farmer'),
('1000006', 'Rampura', 'Dhaka', 1202, '171512221', 'Financial Service Provider'),
('1000007', 'Progoti Shoroni', 'Dhaka', 1255, '171517288', 'Financial Service Provider'),
('1000008', 'Cantonment', 'Dhaka', 1555, '1222172111', 'Financial Service Provider'),
('1000009', 'Basundhora ', 'Dhaka', 1205, '171555211', 'Advisor'),
('1000010', 'Jatrabari', 'Dhaka', 1655, '2147483647', 'Financial Service Provider'),
('1000011', 'Kuril', 'Dhaka', 1552, '1222152111', 'Financial Service Provider'),
('1000012', 'Ramchandrapur', 'Rangpur', 2500, '178617211', 'Farmer'),
('1000013', 'Lakhabazar', 'Rajshahi', 2580, '168817211', 'Farmer'),
('1000014', 'Debidwar', 'Cumilla', 3500, '01957153596', 'Farmer'),
('1000015', 'Madhopur', 'Habiganj', 2100, '188817256', 'Farmer'),
('1000016', 'Mohonpur', 'Rajshahi', 2581, '178817289', 'Farmer'),
('1000017', 'Lamabazar', 'Noakhali', 2352, '01957153596', 'Farmer'),
('1000018', 'Shuagazi', 'Cumilla', 3505, '169817211', 'Farmer'),
('1000019', 'Savar', 'Dhaka', 1260, '138417211', 'Farmer'),
('1000020', 'Signboard', 'Narayanganj', 1304, '192017252', 'Farmer'),
('1000021', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000022', 'Malik road', 'Dhaka', 1180, '192017252', 'Financial Service Provider'),
('1000023', 'Millat road', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000024', 'Jurain', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000025', 'Setabgonj', 'Dinajpur', 1170, '192017252', 'Financial Service Provider'),
('1000026', 'Birol', 'Dinajpur', 1170, '192017252', 'Financial Service Provider'),
('1000027', 'Square town', 'Feni', 1170, '192017252', 'Financial Service Provider'),
('1000028', 'Junction Road', 'Khulna', 1170, '192017252', 'Financial Service Provider'),
('1000029', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000030', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000031', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000032', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000033', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000034', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000035', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000036', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000037', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000038', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000039', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000040', 'Rankin street', 'Dhaka', 1170, '192017252', 'Financial Service Provider'),
('1000041', 'Mirhajirbag', 'Jatrabari', 1204, '01934559433', 'Advisor'),
('1000042', 'Jigatola', 'Dhanmondi', 1206, '01928374387', 'Advisor'),
('1000043', 'Setabgonj', 'Dinajpur', 5203, '01932847485', 'Advisor'),
('1000044', 'Mohammadpur', 'Dhaka', 1204, '01934543433', 'Advisor'),
('1000045', 'Azimpur', 'Dhaka', 1206, '01738344727', 'Advisor'),
('1000046', 'Jatrabari', 'Dhaka', 1204, '01957153596', 'Admin'),
('1000047', 'Muladi', 'Barishal', 3507, '01705444346', 'Farmer'),
('1000048', 'Daudkandi', 'Comilla', 2094, '01515734688', 'Farmer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advising`
--
ALTER TABLE `advising`
  ADD PRIMARY KEY (`Advise_ID`),
  ADD KEY `add_fk01` (`Advisor_ID`),
  ADD KEY `add_fk02` (`Farmer_ID`);

--
-- Indexes for table `advisor`
--
ALTER TABLE `advisor`
  ADD PRIMARY KEY (`Advisor ID`);

--
-- Indexes for table `farmer_cropname_t`
--
ALTER TABLE `farmer_cropname_t`
  ADD PRIMARY KEY (`Farmer_ID`,`Cropname`);

--
-- Indexes for table `farmer_t`
--
ALTER TABLE `farmer_t`
  ADD PRIMARY KEY (`Farmer_ID`);

--
-- Indexes for table `feedback_t`
--
ALTER TABLE `feedback_t`
  ADD PRIMARY KEY (`user_ID`,`feedback_number`);

--
-- Indexes for table `financial_service_provider_t`
--
ALTER TABLE `financial_service_provider_t`
  ADD PRIMARY KEY (`FSPid`);

--
-- Indexes for table `grant_provider_t`
--
ALTER TABLE `grant_provider_t`
  ADD PRIMARY KEY (`Grant_provider_ID`);

--
-- Indexes for table `grant_provider_target_t`
--
ALTER TABLE `grant_provider_target_t`
  ADD PRIMARY KEY (`Grant_provider_ID`,`Target_beneficiaries`);

--
-- Indexes for table `grant_t`
--
ALTER TABLE `grant_t`
  ADD PRIMARY KEY (`Grant_ID`),
  ADD KEY `g_fk01` (`Grant_provider_ID`),
  ADD KEY `gg_fk01` (`Farmer_id`);

--
-- Indexes for table `insurance_application`
--
ALTER TABLE `insurance_application`
  ADD PRIMARY KEY (`farmer_id`,`status`);

--
-- Indexes for table `insurance_provider_t`
--
ALTER TABLE `insurance_provider_t`
  ADD PRIMARY KEY (`insurance_provider_id`);

--
-- Indexes for table `insurance_t`
--
ALTER TABLE `insurance_t`
  ADD PRIMARY KEY (`insurance_id`),
  ADD KEY `i_fk01` (`farmer_id`),
  ADD KEY `i_fk02` (`insurance_provider_id`);

--
-- Indexes for table `investment_application_t`
--
ALTER TABLE `investment_application_t`
  ADD PRIMARY KEY (`Farmer_ID`,`Verdict`);

--
-- Indexes for table `investment_t`
--
ALTER TABLE `investment_t`
  ADD PRIMARY KEY (`Investment_ID`),
  ADD KEY `iv_fk01` (`Farmer_ID`),
  ADD KEY `iv_fk02` (`Investor_ID`);

--
-- Indexes for table `investor_t`
--
ALTER TABLE `investor_t`
  ADD PRIMARY KEY (`Investor_ID`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`Loan_ID`),
  ADD KEY `l_fk01` (`Farmer_ID`),
  ADD KEY `l_fk02` (`Loan_Provider_ID`);

--
-- Indexes for table `loan_provider`
--
ALTER TABLE `loan_provider`
  ADD PRIMARY KEY (`LoanProvider_ID`);

--
-- Indexes for table `loan_provider_loan_type`
--
ALTER TABLE `loan_provider_loan_type`
  ADD PRIMARY KEY (`LoanProvider_ID`,`loan_type`);

--
-- Indexes for table `login_t`
--
ALTER TABLE `login_t`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advising`
--
ALTER TABLE `advising`
  MODIFY `Advise_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grant_t`
--
ALTER TABLE `grant_t`
  MODIFY `Grant_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `insurance_t`
--
ALTER TABLE `insurance_t`
  MODIFY `insurance_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `investment_t`
--
ALTER TABLE `investment_t`
  MODIFY `Investment_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `Loan_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advising`
--
ALTER TABLE `advising`
  ADD CONSTRAINT `add_fk01` FOREIGN KEY (`Advisor_ID`) REFERENCES `advisor` (`Advisor ID`),
  ADD CONSTRAINT `add_fk02` FOREIGN KEY (`Farmer_ID`) REFERENCES `farmer_t` (`Farmer_ID`);

--
-- Constraints for table `advisor`
--
ALTER TABLE `advisor`
  ADD CONSTRAINT `ad_fk01` FOREIGN KEY (`Advisor ID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `farmer_cropname_t`
--
ALTER TABLE `farmer_cropname_t`
  ADD CONSTRAINT `fc_fk01` FOREIGN KEY (`Farmer_ID`) REFERENCES `farmer_t` (`Farmer_ID`);

--
-- Constraints for table `farmer_t`
--
ALTER TABLE `farmer_t`
  ADD CONSTRAINT `f_fk01` FOREIGN KEY (`Farmer_ID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `financial_service_provider_t`
--
ALTER TABLE `financial_service_provider_t`
  ADD CONSTRAINT `fsp_fk01` FOREIGN KEY (`FSPid`) REFERENCES `user` (`userID`);

--
-- Constraints for table `grant_provider_t`
--
ALTER TABLE `grant_provider_t`
  ADD CONSTRAINT `gp_fk01` FOREIGN KEY (`Grant_provider_ID`) REFERENCES `financial_service_provider_t` (`FSPid`);

--
-- Constraints for table `grant_provider_target_t`
--
ALTER TABLE `grant_provider_target_t`
  ADD CONSTRAINT `gpt_fk01` FOREIGN KEY (`Grant_provider_ID`) REFERENCES `grant_provider_t` (`Grant_provider_ID`);

--
-- Constraints for table `grant_t`
--
ALTER TABLE `grant_t`
  ADD CONSTRAINT `g_fk01` FOREIGN KEY (`Grant_provider_ID`) REFERENCES `grant_provider_t` (`Grant_provider_ID`),
  ADD CONSTRAINT `gg_fk01` FOREIGN KEY (`Farmer_id`) REFERENCES `farmer_t` (`Farmer_ID`);

--
-- Constraints for table `insurance_provider_t`
--
ALTER TABLE `insurance_provider_t`
  ADD CONSTRAINT `ip_fk01` FOREIGN KEY (`insurance_provider_id`) REFERENCES `financial_service_provider_t` (`FSPid`);

--
-- Constraints for table `insurance_t`
--
ALTER TABLE `insurance_t`
  ADD CONSTRAINT `i_fk01` FOREIGN KEY (`farmer_id`) REFERENCES `farmer_t` (`Farmer_ID`),
  ADD CONSTRAINT `i_fk02` FOREIGN KEY (`insurance_provider_id`) REFERENCES `insurance_provider_t` (`insurance_provider_id`);

--
-- Constraints for table `investment_t`
--
ALTER TABLE `investment_t`
  ADD CONSTRAINT `iv_fk01` FOREIGN KEY (`Farmer_ID`) REFERENCES `farmer_t` (`Farmer_ID`),
  ADD CONSTRAINT `iv_fk02` FOREIGN KEY (`Investor_ID`) REFERENCES `investor_t` (`Investor_ID`);

--
-- Constraints for table `investor_t`
--
ALTER TABLE `investor_t`
  ADD CONSTRAINT `inv_fk01` FOREIGN KEY (`Investor_ID`) REFERENCES `financial_service_provider_t` (`FSPid`);

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `l_fk01` FOREIGN KEY (`Farmer_ID`) REFERENCES `farmer_t` (`Farmer_ID`),
  ADD CONSTRAINT `l_fk02` FOREIGN KEY (`Loan_Provider_ID`) REFERENCES `loan_provider` (`LoanProvider_ID`);

--
-- Constraints for table `loan_provider_loan_type`
--
ALTER TABLE `loan_provider_loan_type`
  ADD CONSTRAINT `lp_fk01` FOREIGN KEY (`LoanProvider_ID`) REFERENCES `loan_provider` (`LoanProvider_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
