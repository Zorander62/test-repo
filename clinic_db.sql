-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 02:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `time` varchar(255) DEFAULT NULL,
  `service_id` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `special_request` text DEFAULT NULL,
  `status` enum('scheduled','completed','canceled') DEFAULT 'scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `patient_id`, `doctor_id`, `doctor_name`, `appointment_date`, `time`, `service_id`, `service`, `special_request`, `status`, `created_at`) VALUES
(3, 3, 15, 'Zed Doc', '2024-11-06', '00:20', '1', 'Consultation', 'Extra Details', 'completed', '2024-10-26 14:33:32'),
(4, 4, 0, NULL, '2024-10-26', NULL, NULL, NULL, NULL, 'scheduled', '2024-10-26 15:36:34'),
(5, 2, 15, 'Zed Doc', '2024-11-07', '00:45', '2', 'Blood Test', 'Details', 'scheduled', '2024-11-06 07:45:58'),
(7, 2, 15, 'Zed Doc', '2024-11-16', '01:57', '9', 'Lab Test', NULL, 'scheduled', '2024-11-07 09:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_history`
--

CREATE TABLE `appointment_history` (
  `history_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `status` enum('scheduled','completed','canceled') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billing_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(64,2) NOT NULL,
  `status` enum('paid','pending') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billing_id`, `patient_id`, `doctor_id`, `total_amount`, `paid_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '15', 270.00, 200.00, 'pending', '2024-11-06 08:42:52', '2024-11-06 19:27:20'),
(3, 0, '0', 9.00, 0.00, 'pending', '2024-11-06 21:47:06', '2024-11-06 21:47:06'),
(4, 0, '0', 9.00, 0.00, 'pending', '2024-11-06 21:48:19', '2024-11-06 21:48:19'),
(5, 0, '0', 9.00, 0.00, 'pending', '2024-11-06 21:50:18', '2024-11-06 21:50:18'),
(6, 2, '15', 20.00, 0.00, 'pending', '2024-11-06 21:59:24', '2024-11-06 21:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `bill_services`
--

CREATE TABLE `bill_services` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_services`
--

INSERT INTO `bill_services` (`id`, `bill_id`, `service_id`, `service_name`, `price`) VALUES
(1, 1, 1, 'Consultation', 50.00),
(2, 1, 2, 'Blood Test', 20.00),
(3, 1, 9, 'Lab Test', 50.00),
(4, 1, 10, 'Health Checkup', 150.00),
(5, 4, 5, 'Metformin', 9.00),
(6, 5, 6, 'Atorvastatin', 9.00),
(7, 6, 7, 'Omeprazole', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `dispensed_medications`
--

CREATE TABLE `dispensed_medications` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `medication_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `dispensed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dispensed_medications`
--

INSERT INTO `dispensed_medications` (`id`, `prescription_id`, `medication_id`, `quantity`, `total_amount`, `dispensed_at`) VALUES
(1, 7, 4, 5, 9.00, '2024-11-07 07:02:09'),
(2, 7, 4, 10, 9.00, '2024-11-07 07:12:06');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `user_id`, `name`, `email`, `specialty`, `phone_number`) VALUES
(15, 0, 'Zed Doc', 'zeddoc@test.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_providers`
--

CREATE TABLE `insurance_providers` (
  `provider_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_info` text DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `supplier_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_tests`
--

CREATE TABLE `lab_tests` (
  `test_id` int(11) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `document` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `history_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `condition_details` varchar(100) NOT NULL,
  `treatment` varchar(100) DEFAULT NULL,
  `date_diagnosed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `record_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`record_id`, `patient_id`, `doctor_id`, `reason`, `description`, `date`, `created_at`, `updated_at`) VALUES
(1, 2, 15, 'Lab Test', 'Test Details', '2024-11-18', '2024-11-18 00:33:24', '2024-11-18 00:33:24'),
(2, 2, 15, 'Lab Test Two', 'Other Comments', '2024-11-18', '2024-11-18 08:53:09', '2024-11-18 08:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `medication_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL,
  `batch_number` varchar(255) DEFAULT NULL,
  `expiration_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `low_stock_threshold` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`medication_id`, `name`, `price`, `description`, `stock_quantity`, `batch_number`, `expiration_date`, `created_at`, `updated_at`, `low_stock_threshold`) VALUES
(1, 'Ibuprofen', 10.00, 'Pain reliever and anti-inflammatory', 200, '75475447', '2025-11-07', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(2, 'Paracetamol', 8.00, 'Pain reliever and fever reducer', 150, '5576747', '2026-11-07', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(3, 'Amoxicillin', 15.00, 'Antibiotic for bacterial infections', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(4, 'Aspirin', 9.00, 'Pain reliever and blood thinner', 85, '548747', '2026-10-07', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(5, 'Metformin', 12.50, 'Used for treating type 2 diabetes', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(6, 'Atorvastatin', 20.00, 'Cholesterol-lowering medication', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(7, 'Omeprazole', 18.00, 'Used for acid reflux and heartburn', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(8, 'Losartan', 22.00, 'Used to treat high blood pressure', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(9, 'Lisinopril', 16.50, 'ACE inhibitor for high blood pressure', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(10, 'Azithromycin', 25.00, 'Antibiotic for bacterial infections', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(11, 'Albuterol', 14.00, 'Bronchodilator for asthma', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(12, 'Simvastatin', 19.00, 'Cholesterol-lowering medication', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(13, 'Ciprofloxacin', 21.00, 'Antibiotic for bacterial infections', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(14, 'Hydrochlorothiazide', 10.50, 'Diuretic for high blood pressure', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(15, 'Clopidogrel', 24.00, 'Blood thinner for heart disease', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(16, 'Gabapentin', 30.00, 'Used for nerve pain and seizures', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(17, 'Prednisone', 12.00, 'Steroid for inflammation', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(18, 'Fluoxetine', 23.00, 'Antidepressant for mood disorders', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(19, 'Levothyroxine', 11.00, 'Thyroid hormone replacement', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(20, 'Amlodipine', 18.00, 'Calcium channel blocker for hypertension', 0, NULL, '0000-00-00', '2024-11-06 23:09:46', '2024-11-06 23:09:46', 10),
(21, 'Surdres', 60.00, 'Headache and pain reliefer', 50, '657784574584', '2026-10-07', '2024-11-06 23:49:25', '2024-11-06 23:49:25', 10),
(22, 'Anacin', 200.00, 'Acute Headache, Toothache and pain reliefer', 100, '78855444', '2024-11-07', '2024-11-06 23:53:14', '2024-11-06 23:53:14', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `blood_type` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `insurance_provider` varchar(255) DEFAULT NULL,
  `insurance_policy_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `user_id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `age`, `phone_number`, `email`, `blood_type`, `address`, `city`, `country`, `insurance_provider`, `insurance_policy_number`) VALUES
(2, 4, 'Collins', 'Mina', '1995-10-26', NULL, NULL, '08164528072', 'webworksofficial1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 5, 'Destiny', 'Mark', '2024-10-26', 'Male', NULL, '09150808546', 'nimbleshop375@gmail.com', NULL, '40 Enugu Road', 'Enugu', 'Nigeria', NULL, NULL),
(5, 18, 'Eazybill', 'web technology', '2005-05-20', 'Male', NULL, '08108353458', 'eazybilltech@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 19, 'Donald', 'Mobi', '2024-11-30', 'Male', NULL, '09150808546', 'mobidonald863@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_insurance`
--

CREATE TABLE `patient_insurance` (
  `patient_insurance_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `policy_number` varchar(100) NOT NULL,
  `coverage_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `medicine_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescription_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `medication_id` varchar(100) NOT NULL,
  `dosage` varchar(50) NOT NULL,
  `frequency` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `instructions` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`prescription_id`, `patient_id`, `doctor_id`, `medication_id`, `dosage`, `frequency`, `start_date`, `end_date`, `instructions`, `status`, `created_at`, `updated_at`) VALUES
(6, 3, 15, '4', '2', '2x3', '2024-11-06', '2024-11-17', 'Details', 'pending', '2024-11-06 21:50:18', '2024-11-06 22:33:32'),
(7, 2, 15, '4', '4', '2x3', '2024-11-06', '2024-11-09', 'Prescription Date Styles lovely', 'completed', '2024-11-06 21:59:23', '2024-11-07 07:12:06');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_items`
--

CREATE TABLE `prescription_items` (
  `item_id` int(11) NOT NULL,
  `prescription_id` int(11) DEFAULT NULL,
  `medication_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `dosage` varchar(255) DEFAULT NULL,
  `instructions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription_items`
--

INSERT INTO `prescription_items` (`item_id`, `prescription_id`, `medication_id`, `quantity`, `dosage`, `instructions`) VALUES
(3, 7, 2, NULL, NULL, NULL),
(4, 7, 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reception`
--

CREATE TABLE `reception` (
  `reception_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `sample_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `result_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `sale_date` date NOT NULL,
  `status` enum('paid','pending') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `sale_item_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `medication_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE `samples` (
  `sample_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `sample_type` varchar(100) DEFAULT NULL,
  `date_collected` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `samples`
--

INSERT INTO `samples` (`sample_id`, `patient_id`, `test_id`, `sample_type`, `date_collected`) VALUES
(1, 2, 1, 'Normal Test', '2024-11-07 08:30:00'),
(2, 3, 2, 'Other Type', '2024-11-07 08:40:46'),
(3, 2, 1, 'New Lab Test Result', '2024-11-18 12:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ServiceID` int(11) NOT NULL,
  `ServiceName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ServiceID`, `ServiceName`, `Description`, `Price`) VALUES
(1, 'Consultation', 'Initial consultation with a doctor', 50.00),
(2, 'Blood Test', 'Basic blood test', 20.00),
(3, 'X-Ray', 'Basic X-ray service', 30.00),
(4, 'Dental Cleaning', 'Teeth cleaning and polishing', 75.00),
(5, 'Vaccination', 'Flu vaccination', 40.00),
(6, 'ECG', 'Electrocardiogram', 25.00),
(7, 'Ultrasound', 'Basic ultrasound scan', 100.00),
(8, 'Surgical Procedure', 'Minor surgical procedure', 200.00),
(9, 'Lab Test', 'Comprehensive lab test', 50.00),
(10, 'Health Checkup', 'Comprehensive health checkup', 150.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `test_type` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `test_name`, `description`, `test_type`, `price`) VALUES
(1, 'Xray', 'Description', NULL, NULL),
(2, 'Xray', 'Description and details', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_results`
--

CREATE TABLE `test_results` (
  `result_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `result` text NOT NULL,
  `test_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('patient','admin','doctor','laboratory','pharmacy','receptionist') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(4, NULL, 'webworksofficial1@gmail.com', '$2y$10$4suWg5gGZEmN0u.hvPS8HeJgDdvPBDtjWcgr61QIw8g/CFjA5WnNm', 'webworksofficial1@gmail.com', 'patient', '2024-10-26 14:27:29'),
(5, NULL, 'nimbleshop375@gmail.com', '$2y$10$SC3hNDmCDf6Usm5XXPEX/OUAJ8xco8OGLGcZpQOKD3buQNKgNyQfe', 'nimbleshop375@gmail.com', 'patient', '2024-10-26 14:33:31'),
(6, NULL, 'pcolman128@gmail.com', '$2y$10$9iUcj6AoF1sPayg9badC0.Xu.j03n85Hw2iV0hBalblS1UhcCxajW', 'pcolman128@gmail.com', 'patient', '2024-10-26 15:36:32'),
(9, 'Admin ', 'buike@gmail.com', '$2y$10$4suWg5gGZEmN0u.hvPS8HeJgDdvPBDtjWcgr61QIw8g/CFjA5WnNm', 'buike@gmail.com', 'admin', '2024-10-26 14:27:29'),
(11, 'Anita Thona C', 'Rep@test.com', '$2y$10$wztmDOR0Ss/yPheNp1Zxau/fdDE74Jg2UxYPU.zrripXHMyI0rPrq', 'Rep@test.com', 'receptionist', '2024-11-05 08:56:27'),
(15, 'Zed Doc', 'zeddoc@test.com', '$2y$10$X/N1XPaY0K7B4OUXC2D37.qOPXfPnJkZEI.AiJFBNCv6yPNulDfqO', 'zeddoc@test.com', 'doctor', '2024-11-06 06:21:41'),
(16, 'Lab Expert', 'lab@gmail.com', '$2y$10$PABueaVYgIVS.LvMUoy8teQ.nUG8sV2JdF2YI/7q2dYHeJ8JgNR2a', 'lab@gmail.com', 'laboratory', '2024-11-06 11:34:32'),
(17, 'Zed Pharmacy', 'pharmacy@gmail.com', '$2y$10$XDOIbLMUZMzzeBeBqxR3oe9EIc4oT6Irn8HudBVUH.DdIhSuzl/G6', 'pharmacy@gmail.com', 'pharmacy', '2024-11-06 11:38:36'),
(18, NULL, 'eazybilltech@gmail.com', '$2y$10$b1zArZ17TKKJ1AZr.bN/JuJqI1Fyz9X/UloXsEfxfT2G5fbeHRGjm', 'eazybilltech@gmail.com', 'patient', '2024-11-17 14:32:52'),
(19, NULL, 'mobidonald863@gmail.com', '$2y$10$ETRLAwk2V3hBzxzBT/dF8.It3oYZzF91VuMcancvoDtcPsXacnSai', 'mobidonald863@gmail.com', 'patient', '2024-11-17 14:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_role_assignments`
--

CREATE TABLE `user_role_assignments` (
  `assignment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vitals`
--

CREATE TABLE `vitals` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `blood_pressure` varchar(50) DEFAULT NULL,
  `heart_rate` int(11) DEFAULT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `respiratory_rate` int(11) DEFAULT NULL,
  `oxygen_saturation` decimal(5,2) DEFAULT NULL,
  `pulse_oximetry` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vitals`
--

INSERT INTO `vitals` (`id`, `patient_id`, `blood_pressure`, `heart_rate`, `temperature`, `weight`, `height`, `respiratory_rate`, `oxygen_saturation`, `pulse_oximetry`, `created_at`, `updated_at`) VALUES
(1, 2, '78', 67, 57.00, 90.00, 5.70, 78, 76.00, 98.00, '2024-11-18 13:52:58', '2024-11-18 13:52:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `appointment_history`
--
ALTER TABLE `appointment_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `bill_services`
--
ALTER TABLE `bill_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispensed_medications`
--
ALTER TABLE `dispensed_medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_id` (`prescription_id`),
  ADD KEY `medication_id` (`medication_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `insurance_providers`
--
ALTER TABLE `insurance_providers`
  ADD PRIMARY KEY (`provider_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `lab_tests`
--
ALTER TABLE `lab_tests`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`medication_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `patient_insurance`
--
ALTER TABLE `patient_insurance`
  ADD PRIMARY KEY (`patient_insurance_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `prescription_items`
--
ALTER TABLE `prescription_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `reception`
--
ALTER TABLE `reception`
  ADD PRIMARY KEY (`reception_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`sale_item_id`);

--
-- Indexes for table `samples`
--
ALTER TABLE `samples`
  ADD PRIMARY KEY (`sample_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `user_role_assignments`
--
ALTER TABLE `user_role_assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `vitals`
--
ALTER TABLE `vitals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `appointment_history`
--
ALTER TABLE `appointment_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bill_services`
--
ALTER TABLE `bill_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dispensed_medications`
--
ALTER TABLE `dispensed_medications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance_providers`
--
ALTER TABLE `insurance_providers`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_tests`
--
ALTER TABLE `lab_tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `medication_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient_insurance`
--
ALTER TABLE `patient_insurance`
  MODIFY `patient_insurance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prescription_items`
--
ALTER TABLE `prescription_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reception`
--
ALTER TABLE `reception`
  MODIFY `reception_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `sale_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `samples`
--
ALTER TABLE `samples`
  MODIFY `sample_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role_assignments`
--
ALTER TABLE `user_role_assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vitals`
--
ALTER TABLE `vitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_history`
--
ALTER TABLE `appointment_history`
  ADD CONSTRAINT `appointment_history_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`);

--
-- Constraints for table `dispensed_medications`
--
ALTER TABLE `dispensed_medications`
  ADD CONSTRAINT `dispensed_medications_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`prescription_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dispensed_medications_ibfk_2` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`medication_id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);

--
-- Constraints for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD CONSTRAINT `medical_history_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `medical_records_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medical_records_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `patient_insurance`
--
ALTER TABLE `patient_insurance`
  ADD CONSTRAINT `patient_insurance_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `patient_insurance_ibfk_2` FOREIGN KEY (`provider_id`) REFERENCES `insurance_providers` (`provider_id`);

--
-- Constraints for table `reception`
--
ALTER TABLE `reception`
  ADD CONSTRAINT `reception_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `test_results`
--
ALTER TABLE `test_results`
  ADD CONSTRAINT `test_results_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_role_assignments`
--
ALTER TABLE `user_role_assignments`
  ADD CONSTRAINT `user_role_assignments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_role_assignments_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
