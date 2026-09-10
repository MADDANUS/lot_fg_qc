-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2026 at 10:56 AM
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
-- Database: `qrcode_label`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_cavity`
--

CREATE TABLE `master_cavity` (
  `id` int(11) UNSIGNED NOT NULL,
  `cavity_name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_cavity`
--

INSERT INTO `master_cavity` (`id`, `cavity_name`, `created_at`, `updated_at`) VALUES
(1, 'Cavity 1', '2026-09-02 09:01:20', '2026-09-02 09:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `master_line`
--

CREATE TABLE `master_line` (
  `id` varchar(5) NOT NULL,
  `line_name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_line`
--

INSERT INTO `master_line` (`id`, `line_name`, `created_at`, `updated_at`) VALUES
('CG', 'S001', NULL, NULL),
('CH', 'S002', NULL, NULL),
('CI', 'S003', NULL, NULL),
('CJ', 'S004', NULL, NULL),
('EQ', 'A01', NULL, NULL),
('ER', 'A02', NULL, NULL),
('ES', 'A03', NULL, NULL),
('ET', 'A04', NULL, NULL),
('EU', 'A05', NULL, NULL),
('EV', 'A06', NULL, NULL),
('EW', 'A07', NULL, NULL),
('EX', 'A08', NULL, NULL),
('EY', 'A09', NULL, NULL),
('EZ', 'A10', NULL, NULL),
('FA', 'A11', NULL, NULL),
('FB', 'A12', NULL, NULL),
('FC', 'A13', NULL, NULL),
('FD', 'A14', NULL, NULL),
('FE', 'A15', NULL, NULL),
('FF', 'A16', NULL, NULL),
('FH', 'A17', NULL, NULL),
('FI', 'A18', NULL, NULL),
('FJ', 'A19', NULL, NULL),
('FK', 'A20', NULL, NULL),
('FL', 'A21', NULL, NULL),
('FM', 'A22', NULL, NULL),
('FN', 'A23', NULL, NULL),
('FO', 'A24', NULL, NULL),
('FP', 'A25', NULL, NULL),
('FQ', 'A26', NULL, NULL),
('FR', 'A27', NULL, NULL),
('FS', 'A28', NULL, NULL),
('FT', 'A29', NULL, NULL),
('FU', 'A30', NULL, NULL),
('FV', 'A31', NULL, NULL),
('FW', 'A32', NULL, NULL),
('FX', 'A33', NULL, NULL),
('FY', 'A34', NULL, NULL),
('FZ', 'A35', NULL, NULL),
('GA', 'A36', NULL, NULL),
('GB', 'A37', NULL, NULL),
('GC', 'A38', NULL, NULL),
('GD', 'A39', NULL, NULL),
('GE', 'A40', NULL, NULL),
('GF', 'A41', NULL, NULL),
('GG', 'A42', NULL, NULL),
('GH', 'A43', NULL, NULL),
('GI', 'A44', NULL, NULL),
('GJ', 'A45', NULL, NULL),
('GK', 'A46', NULL, NULL),
('GL', 'A47', NULL, NULL),
('GM', 'A48', NULL, NULL),
('GN', 'A49', NULL, NULL),
('GO', 'A50', NULL, NULL),
('GP', 'A51', NULL, NULL),
('GQ', 'A52', NULL, NULL),
('GR', 'A53', NULL, NULL),
('GS', 'B01', NULL, NULL),
('GT', 'B02', NULL, NULL),
('GU', 'B03', NULL, NULL),
('GV', 'B04', NULL, NULL),
('GW', 'B05', NULL, NULL),
('GX', 'B06', NULL, NULL),
('GY', 'B07', NULL, NULL),
('GZ', 'B08', NULL, NULL),
('HA', 'B09', NULL, NULL),
('HB', 'B10', NULL, NULL),
('HC', 'B11', NULL, NULL),
('HD', 'B12', NULL, NULL),
('HE', 'B13', NULL, NULL),
('HF', 'B14', NULL, NULL),
('HG', 'B15', NULL, NULL),
('HH', 'B16', NULL, NULL),
('HI', 'B17', NULL, NULL),
('HJ', 'B18', NULL, NULL),
('HK', 'B19', NULL, NULL),
('HL', 'B20', NULL, NULL),
('HM', 'B21', NULL, NULL),
('HN', 'B22', NULL, NULL),
('HO', 'B23', NULL, NULL),
('HP', 'B24', NULL, NULL),
('HQ', 'B25', NULL, NULL),
('HR', 'B26', NULL, NULL),
('HS', 'B27', NULL, NULL),
('HT', 'B28', NULL, NULL),
('HU', 'B29', NULL, NULL),
('HV', 'B30', NULL, NULL),
('HW', 'B31', NULL, NULL),
('HX', 'B32', NULL, NULL),
('HY', 'B33', NULL, NULL),
('HZ', 'B34', NULL, NULL),
('IA', 'B35', NULL, NULL),
('IB', 'B36', NULL, NULL),
('IC', 'B37', NULL, NULL),
('ID', 'B38', NULL, NULL),
('IE', 'B39', NULL, NULL),
('IF', 'B40', NULL, NULL),
('IG', 'B41', NULL, NULL),
('IH', 'B42', NULL, NULL),
('IJ', 'B43', NULL, NULL),
('IK', 'B44', NULL, NULL),
('IL', 'B45', NULL, NULL),
('IM', 'B46', NULL, NULL),
('IN', 'B47', NULL, NULL),
('IO', 'B48', NULL, NULL),
('IP', 'B49', NULL, NULL),
('IQ', 'B50', NULL, NULL),
('IR', 'B51', NULL, NULL),
('IS', 'B52', NULL, NULL),
('IT', 'B53', NULL, NULL),
('IU', 'B54', NULL, NULL),
('IV', 'B55', NULL, NULL),
('IW', 'B56', NULL, NULL),
('IX', 'B57', NULL, NULL),
('IY', 'B58', NULL, NULL),
('IZ', 'B59', NULL, NULL),
('JA', 'B60', NULL, NULL),
('JB', 'B61', NULL, NULL),
('JC', 'B62', NULL, NULL),
('JD', 'B63', NULL, NULL),
('JE', 'B64', NULL, NULL),
('JF', 'B65', NULL, NULL),
('JG', 'B66', NULL, NULL),
('JH', 'B67', NULL, NULL),
('JI', 'B68', NULL, NULL),
('JK', 'B69', NULL, NULL),
('JL', 'B70', NULL, NULL),
('JM', 'B71', NULL, NULL),
('JN', 'B72', NULL, NULL),
('JO', 'B73', NULL, NULL),
('JP', 'C01', NULL, NULL),
('JQ', 'C02', NULL, NULL),
('JR', 'C03', NULL, NULL),
('JS', 'C04', NULL, NULL),
('JT', 'C05', NULL, NULL),
('JU', 'C06', NULL, NULL),
('JV', 'C07', NULL, NULL),
('JW', 'C08', NULL, NULL),
('JX', 'C09', NULL, NULL),
('JY', 'C10', NULL, NULL),
('JZ', 'C11', NULL, NULL),
('KA', 'C12', NULL, NULL),
('KB', 'C13', NULL, NULL),
('KC', 'C14', NULL, NULL),
('KD', 'C15', NULL, NULL),
('KE', 'C16', NULL, NULL),
('KF', 'C17', NULL, NULL),
('KG', 'C18', NULL, NULL),
('KH', 'C19', NULL, NULL),
('KI', 'C20', NULL, NULL),
('KJ', 'C21', NULL, NULL),
('KK', 'C22', NULL, NULL),
('KL', 'C23', NULL, NULL),
('KM', 'C24', NULL, NULL),
('KN', 'C25', NULL, NULL),
('KO', 'C26', NULL, NULL),
('KP', 'C27', NULL, NULL),
('KQ', 'C28', NULL, NULL),
('KR', 'C29', NULL, NULL),
('KS', 'C30', NULL, NULL),
('KT', 'C31', NULL, NULL),
('KU', 'C32', NULL, NULL),
('KV', 'C33', NULL, NULL),
('KW', 'C34', NULL, NULL),
('KX', 'C35', NULL, NULL),
('KY', 'C36', NULL, NULL),
('KZ', 'C37', NULL, NULL),
('LA', 'C38', NULL, NULL),
('LB', 'D01', NULL, NULL),
('LC', 'D02', NULL, NULL),
('LD', 'D03', NULL, NULL),
('LE', 'D04', NULL, NULL),
('LF', 'D05', NULL, NULL),
('LG', 'D06', NULL, NULL),
('LH', 'D07', NULL, NULL),
('LI', 'D08', NULL, NULL),
('LJ', 'D09', NULL, NULL),
('LK', 'D10', NULL, NULL),
('LL', 'D11', NULL, NULL),
('LM', 'D12', NULL, NULL),
('LN', 'D13', NULL, NULL),
('LO', 'D14', NULL, NULL),
('LP', 'D15', NULL, NULL),
('LQ', 'D16', NULL, NULL),
('LR', 'D17', NULL, NULL),
('LS', 'D18', NULL, NULL),
('LT', 'D19', NULL, NULL),
('LU', 'D20', NULL, NULL),
('LV', 'D21', NULL, NULL),
('LW', 'D22', NULL, NULL),
('LX', 'D23', NULL, NULL),
('LY', 'D24', NULL, NULL),
('LZ', 'D25', NULL, NULL),
('MA', 'D26', NULL, NULL),
('MB', 'D27', NULL, NULL),
('MC', 'D28', NULL, NULL),
('MD', 'D29', NULL, NULL),
('ME', 'D30', NULL, NULL),
('MF', 'D31', NULL, NULL),
('MG', 'D32', NULL, NULL),
('MH', 'D33', NULL, NULL),
('MI', 'D34', NULL, NULL),
('MJ', 'D35', NULL, NULL),
('MK', 'D36', NULL, NULL),
('ML', 'C39', NULL, NULL),
('MM', 'A54', NULL, NULL),
('MN', 'D37', NULL, NULL),
('MO', 'D38', NULL, NULL),
('MP', 'D39', NULL, NULL),
('MQ', 'D40', NULL, NULL),
('MR', 'A57', NULL, NULL),
('MS', 'A58', NULL, NULL),
('MT', 'A54', NULL, NULL),
('MU', 'D49', NULL, NULL),
('MV', 'D42', NULL, NULL),
('MW', 'D41', NULL, NULL),
('MX', 'D48', NULL, NULL),
('MY', 'D47', NULL, NULL),
('MZ', 'D44', NULL, NULL),
('NA', 'D46', NULL, NULL),
('NB', 'D45', NULL, NULL),
('NC', 'D43', NULL, NULL),
('ND', 'D54', NULL, NULL),
('NE', 'D52', NULL, NULL),
('NF', 'D53', NULL, NULL),
('NG', 'D51', NULL, NULL),
('NH', 'D50', NULL, NULL),
('NI', 'S002', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_mold`
--

CREATE TABLE `master_mold` (
  `id` int(11) UNSIGNED NOT NULL,
  `mold_name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_mold`
--

INSERT INTO `master_mold` (`id`, `mold_name`, `created_at`, `updated_at`) VALUES
(1, 'Mold 1', '2026-09-02 09:01:05', '2026-09-02 09:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `master_shift`
--

CREATE TABLE `master_shift` (
  `id` int(11) UNSIGNED NOT NULL,
  `shift_name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_shift`
--

INSERT INTO `master_shift` (`id`, `shift_name`, `created_at`, `updated_at`) VALUES
(1, 'Shift 1', NULL, NULL),
(2, 'Shift 2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-01-01-000001', 'App\\Database\\Migrations\\CreateMasterShift', 'default', 'App', 1788336281, 1),
(2, '2024-01-01-000002', 'App\\Database\\Migrations\\CreateMasterLine', 'default', 'App', 1788336281, 1),
(3, '2024-01-01-000003', 'App\\Database\\Migrations\\CreateMasterMold', 'default', 'App', 1788336281, 1),
(4, '2024-01-01-000004', 'App\\Database\\Migrations\\CreateMasterCavity', 'default', 'App', 1788336281, 1),
(5, '2024-01-01-000005', 'App\\Database\\Migrations\\CreatePrintLabelHeader', 'default', 'App', 1788336281, 1),
(6, '2024-01-01-000006', 'App\\Database\\Migrations\\CreatePrintLabelItems', 'default', 'App', 1788336281, 1),
(7, '2024-01-01-000007', 'App\\Database\\Migrations\\AddRefNoToPrintLabelItems', 'default', 'App', 1788336282, 1),
(8, '2026-09-10-063106', 'App\\Database\\Migrations\\AddDieDwgToOmronOuter', 'default', 'App', 1789021932, 2),
(9, '2026-09-10-081007', 'App\\Database\\Migrations\\CreateMitsubaLabelsTable', 'default', 'App', 1789027857, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mitsuba_labels`
--

CREATE TABLE `mitsuba_labels` (
  `id` int(11) UNSIGNED NOT NULL,
  `doc_number` varchar(50) DEFAULT NULL,
  `item_code` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `lotno` varchar(100) DEFAULT NULL,
  `machine` varchar(100) DEFAULT NULL,
  `operator` varchar(100) DEFAULT NULL,
  `is_printed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mitsuba_labels`
--

INSERT INTO `mitsuba_labels` (`id`, `doc_number`, `item_code`, `description`, `quantity`, `lotno`, `machine`, `operator`, `is_printed`, `created_at`) VALUES
(1, '226506645', 'A4029-194-02-000', 'VALVE SEAT', 2100, '26907A37Q10', '', '939', 1, '2026-09-10 08:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `omron_inner_labels`
--

CREATE TABLE `omron_inner_labels` (
  `id` int(11) NOT NULL,
  `doc_number` varchar(50) NOT NULL,
  `doc_date` date DEFAULT NULL,
  `item_code` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `standard_pack` int(11) DEFAULT 0,
  `lotno` varchar(100) DEFAULT NULL,
  `whs_code` varchar(20) DEFAULT NULL,
  `back_no` varchar(50) DEFAULT NULL,
  `operator` varchar(100) DEFAULT NULL,
  `production_date` date DEFAULT NULL,
  `machine` varchar(50) DEFAULT NULL,
  `notification` varchar(100) DEFAULT NULL,
  `user_initial` varchar(10) NOT NULL DEFAULT '',
  `job_order` varchar(50) DEFAULT NULL,
  `shift_id` varchar(10) DEFAULT NULL,
  `cavity` varchar(50) DEFAULT NULL,
  `shift` varchar(50) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `is_printed` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `omron_inner_labels`
--

INSERT INTO `omron_inner_labels` (`id`, `doc_number`, `doc_date`, `item_code`, `description`, `quantity`, `standard_pack`, `lotno`, `whs_code`, `back_no`, `operator`, `production_date`, `machine`, `notification`, `user_initial`, `job_order`, `shift_id`, `cavity`, `shift`, `remark`, `is_printed`, `created_at`) VALUES
(9, '126549706', '2026-09-08', '2244034-3C', 'INSERT METAL A Z-15G-B', 11000, 1000, '26907B57Q10', 'WHFGL', 'F0511', '16', NULL, 'B57', 'RE-DELIVERY', '123', NULL, NULL, '', '', '', 1, '2026-09-10 07:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `omron_outer_labels`
--

CREATE TABLE `omron_outer_labels` (
  `id` int(11) NOT NULL,
  `doc_number` varchar(50) NOT NULL,
  `doc_date` date DEFAULT NULL,
  `item_code` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `standard_pack` int(11) DEFAULT 0,
  `lotno` varchar(100) DEFAULT NULL,
  `whs_code` varchar(20) DEFAULT NULL,
  `back_no` varchar(50) DEFAULT NULL,
  `operator` varchar(100) DEFAULT NULL,
  `production_date` date DEFAULT NULL,
  `machine` varchar(50) DEFAULT NULL,
  `notification` varchar(100) DEFAULT NULL,
  `user_initial` varchar(10) DEFAULT NULL,
  `job_order` varchar(50) DEFAULT NULL,
  `shift_id` varchar(10) DEFAULT NULL,
  `cavity` varchar(50) DEFAULT NULL,
  `shift` varchar(50) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `is_printed` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `die_no` varchar(50) DEFAULT NULL,
  `dwg_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `omron_outer_labels`
--

INSERT INTO `omron_outer_labels` (`id`, `doc_number`, `doc_date`, `item_code`, `description`, `quantity`, `standard_pack`, `lotno`, `whs_code`, `back_no`, `operator`, `production_date`, `machine`, `notification`, `user_initial`, `job_order`, `shift_id`, `cavity`, `shift`, `remark`, `is_printed`, `created_at`, `die_no`, `dwg_no`) VALUES
(6, '126549706', '2026-09-08', '2244034-3', 'INSERT METAL A Z-15G-B', 11000, 10000, '26907B57Q10', '', '', '', '2026-09-07', 'B57', 'RE-DELIVERY', '', NULL, NULL, '-', '1', '', 1, '2026-09-10 07:09:05', '-', ''),
(7, '126549706', '2026-09-08', '2244034-3', 'INSERT METAL A Z-15G-B', 20000, 10000, '26907B57Q10', '', '', '', NULL, 'B57', 'RE-DELIVERY', '', NULL, NULL, '-', '1', '', 1, '2026-09-10 07:26:40', '-', '');

-- --------------------------------------------------------

--
-- Table structure for table `print_label_header`
--

CREATE TABLE `print_label_header` (
  `id` int(11) UNSIGNED NOT NULL,
  `doc_number` varchar(50) NOT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `product_name` enum('IJP','BS') NOT NULL,
  `date_mode` enum('production_date','job_order') NOT NULL,
  `production_date` date DEFAULT NULL,
  `job_order` varchar(20) DEFAULT NULL,
  `shift_id` int(11) UNSIGNED DEFAULT NULL,
  `line_mode` enum('line','mold_cavity') NOT NULL,
  `line_id` varchar(5) DEFAULT NULL,
  `mold_id` int(11) UNSIGNED DEFAULT NULL,
  `cavity_id` int(11) UNSIGNED DEFAULT NULL,
  `from_series` varchar(4) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `user_initial` varchar(3) NOT NULL,
  `lot_guarantee` tinyint(1) NOT NULL DEFAULT 0,
  `lot_sa` tinyint(1) NOT NULL DEFAULT 0,
  `flag_4m` tinyint(1) NOT NULL DEFAULT 0,
  `size_mode` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `print_label_header`
--

INSERT INTO `print_label_header` (`id`, `doc_number`, `customer`, `product_name`, `date_mode`, `production_date`, `job_order`, `shift_id`, `line_mode`, `line_id`, `mold_id`, `cavity_id`, `from_series`, `remark`, `user_initial`, `lot_guarantee`, `lot_sa`, `flag_4m`, `size_mode`, `created_at`, `updated_at`) VALUES
(1, 'dummy123', 'PT. BENGKEL MAJU', 'IJP', 'production_date', '2026-09-02', NULL, 1, 'line', 'CG', NULL, NULL, '1233', 'oke', '12W', 1, 0, 0, '', '2026-09-02 09:23:21', '2026-09-02 09:23:21'),
(2, 'dummy123', 'PT. BENGKEL MAJU', 'IJP', 'production_date', '2026-09-02', NULL, 1, 'line', 'CG', NULL, NULL, '1222', '21e3', 'QW2', 1, 0, 0, 'Medium/Epson', '2026-09-02 09:28:40', '2026-09-02 09:28:40'),
(3, 'dummy123', 'PT. BENGKEL MAJU', 'IJP', 'production_date', '2026-09-02', NULL, 1, 'line', 'CG', NULL, NULL, '1234', '123', '12D', 1, 0, 0, '', '2026-09-02 09:33:42', '2026-09-02 09:33:42'),
(4, 'dummy123', 'PT. BENGKEL MAJU', 'IJP', 'production_date', '2026-09-02', NULL, 1, 'line', 'CG', NULL, NULL, '1234', '123', '12D', 1, 0, 0, 'Large', '2026-09-02 09:34:36', '2026-09-02 09:34:36'),
(5, 'dummy123', 'PT. BENGKEL MAJU', 'IJP', 'production_date', '2026-09-02', NULL, 1, 'line', 'CH', NULL, NULL, '1234', 'okeji', 'AW2', 1, 0, 0, '', '2026-09-02 09:40:35', '2026-09-02 09:40:35'),
(6, 'dummy123', 'PT. BENGKEL MAJU', 'IJP', 'production_date', '2026-09-02', NULL, 1, 'line', 'CH', NULL, NULL, '1234', 'okeji', 'AW2', 1, 0, 0, '', '2026-09-02 09:43:30', '2026-09-02 09:43:30'),
(7, 'dummy123', 'PT. BENGKEL MAJU', 'IJP', 'production_date', '2026-09-02', NULL, 1, 'line', 'CH', NULL, NULL, '1234', 'okeji', 'AW2', 1, 0, 0, '', '2026-09-02 09:47:03', '2026-09-02 09:47:03'),
(8, 'dummy123', 'PT. BENGKEL MAJU', 'IJP', 'production_date', '2026-09-02', NULL, 1, 'line', 'CH', NULL, NULL, '1234', 'okeji', 'AW2', 1, 0, 0, '', '2026-09-02 10:01:20', '2026-09-02 10:01:20'),
(9, 'dummy123', 'PT. BENGKEL MAJU', 'IJP', 'production_date', '2026-09-02', NULL, 1, 'line', 'CH', NULL, NULL, '1234', 'okeji', 'AW2', 1, 0, 0, '', '2026-09-02 10:12:43', '2026-09-02 10:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `print_label_items`
--

CREATE TABLE `print_label_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `header_id` int(11) UNSIGNED NOT NULL,
  `item_code` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `lotno` varchar(50) DEFAULT NULL,
  `warehouse` varchar(50) DEFAULT NULL,
  `back_no` varchar(50) DEFAULT NULL,
  `standard_pack` varchar(50) DEFAULT NULL,
  `operator` varchar(100) DEFAULT NULL,
  `ref_no` varchar(16) DEFAULT NULL,
  `lot_no_combined` varchar(30) DEFAULT NULL,
  `lot_sequence` tinyint(3) UNSIGNED DEFAULT 1,
  `lot_qty` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `print_label_items`
--

INSERT INTO `print_label_items` (`id`, `header_id`, `item_code`, `description`, `quantity`, `lotno`, `warehouse`, `back_no`, `standard_pack`, `operator`, `ref_no`, `lot_no_combined`, `lot_sequence`, `lot_qty`, `created_at`, `updated_at`) VALUES
(1, 1, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'P1JRIGBVI8CGURV0', '015269021CG1233', 1, 500, '2026-09-02 09:23:21', '2026-09-02 09:23:21'),
(2, 1, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'AYU28FKR6O0FJWTL', '015269021CG1233', 2, 500, '2026-09-02 09:23:21', '2026-09-02 09:23:21'),
(3, 1, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', '9ATXYW3SJR35IGD7', '015269021CG1233', 3, 500, '2026-09-02 09:23:21', '2026-09-02 09:23:21'),
(4, 1, 'ITEM-002-XYZ', 'Plastik Cover Mesin Kiri', '750', 'LOT-24-002', 'WH-A2', 'BN-98', '500', 'Budi', 'X57A8MMSXEX0Z91B', '015269021CG1233', 1, 750, '2026-09-02 09:23:21', '2026-09-02 09:23:21'),
(5, 2, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'XGXJZAFCMPW3Y3OO', '015269021CG1222', 1, 500, '2026-09-02 09:28:40', '2026-09-02 09:28:40'),
(6, 2, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'IIGGQB7NNZGLJSJG', '015269021CG1222', 2, 500, '2026-09-02 09:28:40', '2026-09-02 09:28:40'),
(7, 2, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'RDX5GW1T3GZABVLH', '015269021CG1222', 3, 500, '2026-09-02 09:28:40', '2026-09-02 09:28:40'),
(8, 2, 'ITEM-002-XYZ', 'Plastik Cover Mesin Kiri', '750', 'LOT-24-002', 'WH-A2', 'BN-98', '500', 'Budi', '8E5K9D14SJA74GMB', '015269021CG1222', 1, 750, '2026-09-02 09:28:40', '2026-09-02 09:28:40'),
(9, 3, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', '1KOFL5YMN3HGOE26', '015269021CG1234', 1, 500, '2026-09-02 09:33:42', '2026-09-02 09:33:42'),
(10, 3, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', '5FF3P4W8UJSSY3EV', '015269021CG1234', 2, 500, '2026-09-02 09:33:42', '2026-09-02 09:33:42'),
(11, 3, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'V2EQ1DUZQXDQYMBV', '015269021CG1234', 3, 500, '2026-09-02 09:33:42', '2026-09-02 09:33:42'),
(12, 3, 'ITEM-002-XYZ', 'Plastik Cover Mesin Kiri', '750', 'LOT-24-002', 'WH-A2', 'BN-98', '500', 'Budi', '6DZVBSQGYRSZ6NE0', '015269021CG1234', 1, 750, '2026-09-02 09:33:42', '2026-09-02 09:33:42'),
(13, 4, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'K4F014TRLE9FJB55', '015269021CG1234', 1, 500, '2026-09-02 09:34:36', '2026-09-02 09:34:36'),
(14, 4, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'QP5RWC0C1PQO0CM1', '015269021CG1234', 2, 500, '2026-09-02 09:34:36', '2026-09-02 09:34:36'),
(15, 4, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', '3OKD51D5MKJYRMZK', '015269021CG1234', 3, 500, '2026-09-02 09:34:36', '2026-09-02 09:34:36'),
(16, 4, 'ITEM-002-XYZ', 'Plastik Cover Mesin Kiri', '750', 'LOT-24-002', 'WH-A2', 'BN-98', '500', 'Budi', 'F2FDU31WNQIC5PHP', '015269021CG1234', 1, 750, '2026-09-02 09:34:36', '2026-09-02 09:34:36'),
(17, 5, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'TLZ5C0FVYPTZOVD8', '015269021CH1234', 1, 500, '2026-09-02 09:40:35', '2026-09-02 09:40:35'),
(18, 5, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'T0JFRU462OYNWK9I', '015269021CH1234', 2, 500, '2026-09-02 09:40:35', '2026-09-02 09:40:35'),
(19, 5, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'FY2LSY3OXBM4UR4K', '015269021CH1234', 3, 500, '2026-09-02 09:40:35', '2026-09-02 09:40:35'),
(20, 5, 'ITEM-002-XYZ', 'Plastik Cover Mesin Kiri', '750', 'LOT-24-002', 'WH-A2', 'BN-98', '500', 'Budi', '08G3DLYM50668L50', '015269021CH1234', 1, 750, '2026-09-02 09:40:35', '2026-09-02 09:40:35'),
(21, 6, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'IYQ31HFYL6A4JO8E', '015269021CH1234', 1, 500, '2026-09-02 09:43:30', '2026-09-02 09:43:30'),
(22, 6, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', '5T53SY0IL9Y4R2TB', '015269021CH1234', 2, 500, '2026-09-02 09:43:30', '2026-09-02 09:43:30'),
(23, 6, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', '9JEG8GHMT359O0FQ', '015269021CH1234', 3, 500, '2026-09-02 09:43:30', '2026-09-02 09:43:30'),
(24, 6, 'ITEM-002-XYZ', 'Plastik Cover Mesin Kiri', '750', 'LOT-24-002', 'WH-A2', 'BN-98', '500', 'Budi', 'C4BKBA0HP0YZGR4P', '015269021CH1234', 1, 750, '2026-09-02 09:43:30', '2026-09-02 09:43:30'),
(25, 7, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', '91Y8JT9UJ7RSPD5W', '015269021CH1234', 1, 500, '2026-09-02 09:47:03', '2026-09-02 09:47:03'),
(26, 7, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'IMGB0OWZB3PC2155', '015269021CH1234', 2, 500, '2026-09-02 09:47:03', '2026-09-02 09:47:03'),
(27, 7, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'I7CT6TC3ZXPOL1OB', '015269021CH1234', 3, 500, '2026-09-02 09:47:03', '2026-09-02 09:47:03'),
(28, 7, 'ITEM-002-XYZ', 'Plastik Cover Mesin Kiri', '750', 'LOT-24-002', 'WH-A2', 'BN-98', '500', 'Budi', '0LOPI5Z7T4FMMD0L', '015269021CH1234', 1, 750, '2026-09-02 09:47:03', '2026-09-02 09:47:03'),
(29, 8, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'M8ZXLTKFSNZOYR2M', '015269021CH1234', 1, 500, '2026-09-02 10:01:20', '2026-09-02 10:01:20'),
(30, 8, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'PDENDD1WPNO79O67', '015269021CH1234', 2, 500, '2026-09-02 10:01:20', '2026-09-02 10:01:20'),
(31, 8, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', '2CZCS637NQ92S0KS', '015269021CH1234', 3, 500, '2026-09-02 10:01:20', '2026-09-02 10:01:20'),
(32, 8, 'ITEM-002-XYZ', 'Plastik Cover Mesin Kiri', '750', 'LOT-24-002', 'WH-A2', 'BN-98', '500', 'Budi', '7IDB0W92UNM2TAK4', '015269021CH1234', 1, 750, '2026-09-02 10:01:20', '2026-09-02 10:01:20'),
(33, 9, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'FIYZTBLRIP5UDJKN', '015269021CH1234', 1, 500, '2026-09-02 10:12:43', '2026-09-02 10:12:43'),
(34, 9, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'U5A2MC2TFUZAYWI6', '015269021CH1234', 2, 500, '2026-09-02 10:12:43', '2026-09-02 10:12:43'),
(35, 9, 'ITEM-001-XYZ', 'Plastik Cover Mesin Kanan', '1500', 'LOT-24-001', 'WH-A1', 'BN-99', '500', 'Budi', 'B1D3QV99V9Z34W6J', '015269021CH1234', 3, 500, '2026-09-02 10:12:43', '2026-09-02 10:12:43'),
(36, 9, 'ITEM-002-XYZ', 'Plastik Cover Mesin Kiri', '750', 'LOT-24-002', 'WH-A2', 'BN-98', '500', 'Budi', 'JCT5ZF2E0AOAAGNC', '015269021CH1234', 1, 750, '2026-09-02 10:12:43', '2026-09-02 10:12:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_cavity`
--
ALTER TABLE `master_cavity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_line`
--
ALTER TABLE `master_line`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_mold`
--
ALTER TABLE `master_mold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_shift`
--
ALTER TABLE `master_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitsuba_labels`
--
ALTER TABLE `mitsuba_labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `omron_inner_labels`
--
ALTER TABLE `omron_inner_labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `omron_outer_labels`
--
ALTER TABLE `omron_outer_labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `print_label_header`
--
ALTER TABLE `print_label_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_number` (`doc_number`);

--
-- Indexes for table `print_label_items`
--
ALTER TABLE `print_label_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `header_id` (`header_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_cavity`
--
ALTER TABLE `master_cavity`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_mold`
--
ALTER TABLE `master_mold`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_shift`
--
ALTER TABLE `master_shift`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mitsuba_labels`
--
ALTER TABLE `mitsuba_labels`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `omron_inner_labels`
--
ALTER TABLE `omron_inner_labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `omron_outer_labels`
--
ALTER TABLE `omron_outer_labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `print_label_header`
--
ALTER TABLE `print_label_header`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `print_label_items`
--
ALTER TABLE `print_label_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `print_label_items`
--
ALTER TABLE `print_label_items`
  ADD CONSTRAINT `print_label_items_header_id_foreign` FOREIGN KEY (`header_id`) REFERENCES `print_label_header` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
