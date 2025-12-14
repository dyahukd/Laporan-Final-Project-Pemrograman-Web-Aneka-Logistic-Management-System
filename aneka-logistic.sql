-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2025 at 04:29 PM
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
-- Database: `aneka-logistic`
--

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id` int(11) NOT NULL,
  `kota_asal` varchar(100) NOT NULL,
  `kota_tujuan` varchar(100) NOT NULL,
  `wilayah` enum('Jawa','Bali','Kalimantan') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id`, `kota_asal`, `kota_tujuan`, `wilayah`, `created_at`) VALUES
(1, 'Surabaya', 'Jakarta', 'Jawa', '2025-12-14 09:12:01'),
(2, 'Surabaya', 'Balikpapan', 'Kalimantan', '2025-12-14 09:12:01'),
(3, 'Surabaya', 'Denpasar', 'Bali', '2025-12-14 09:12:01'),
(4, 'Surabaya', 'Malang', 'Jawa', '2025-12-14 09:12:01'),
(5, 'Surabaya', 'Pandaan', 'Jawa', '2025-12-14 09:12:01'),
(6, 'Surabaya', 'Banjar', 'Kalimantan', '2025-12-14 09:12:01'),
(8, 'Surabaya', 'Pandaan', 'Jawa', '2025-12-14 09:35:31'),
(9, 'Jakarta', 'Surabaya', 'Jawa', '2025-12-14 09:39:54'),
(10, 'Jakarta', 'Balikpapan', 'Kalimantan', '2025-12-14 09:40:15'),
(11, 'Denpasar', 'Balikpapan', 'Kalimantan', '2025-12-14 09:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` int(11) NOT NULL,
  `resi` varchar(50) DEFAULT NULL,
  `sender_name` varchar(100) DEFAULT NULL,
  `sender_phone` varchar(20) DEFAULT NULL,
  `receiver_name` varchar(100) DEFAULT NULL,
  `receiver_phone` varchar(20) DEFAULT NULL,
  `origin` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `cost` decimal(12,2) DEFAULT NULL,
  `payment_status` enum('UNPAID','PAID') DEFAULT 'UNPAID',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `paid_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `resi`, `sender_name`, `sender_phone`, `receiver_name`, `receiver_phone`, `origin`, `destination`, `weight`, `cost`, `payment_status`, `created_at`, `paid_at`) VALUES
(1, 'MPI-251214-225749', 'andi', '081122536126', 'raja', '089253646377', 'Balikpapan', 'Denpasar', 5000.00, 10000000.00, 'UNPAID', '2025-12-14 04:30:55', NULL),
(2, 'MPI-251214-720784', 'andi', '081122536126', 'raja', '089253646377', 'Balikpapan', 'Denpasar', 5000.00, 10000000.00, 'UNPAID', '2025-12-14 04:33:52', NULL),
(3, 'MPI-251214-731568', 'andi', '081122536126', 'raja', '089253646377', 'Balikpapan', 'Denpasar', 5000.00, 10000000.00, 'UNPAID', '2025-12-14 04:33:58', NULL),
(4, 'MPI-251214-109702', 'andi', '081122536126', 'raja', '089253646377', 'Balikpapan', 'Denpasar', 5000.00, 10000000.00, 'UNPAID', '2025-12-14 04:35:44', NULL),
(5, 'MPI-251214-560737', 'andi', '081122536126', 'raja', '089253646377', 'Balikpapan', 'Denpasar', 5000.00, 10000000.00, 'PAID', '2025-12-14 04:39:31', '2025-12-14 18:20:54'),
(6, 'MPI-251214-711393', 'andi', '081122536126', 'raja', '089253646377', 'Balikpapan', 'Denpasar', 5000.00, 10000000.00, 'PAID', '2025-12-14 04:41:35', '2025-12-14 12:00:31'),
(7, 'MPI-251214-820648', 'Tatang', '087363647274', 'Dudung', '0836466262786', 'Surabaya', 'Jakarta', 10000.00, 15000000.00, 'PAID', '2025-12-14 04:44:34', '2025-12-14 12:00:22'),
(8, 'MPI-20251214-490283', 'shifa', '087876278877', 'dyahuhkd', '0876543456787', 'Surabaya', 'Balikpapan', 100.00, 550000.00, 'PAID', '2025-12-14 11:49:29', '2025-12-14 18:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_tracking`
--

CREATE TABLE `shipment_tracking` (
  `id` int(11) NOT NULL,
  `shipment_id` int(11) NOT NULL,
  `status` enum('Pickup','Gudang Asal','Transit','Gudang Tujuan','On Delivery','Delivered') NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipment_tracking`
--

INSERT INTO `shipment_tracking` (`id`, `shipment_id`, `status`, `lokasi`, `keterangan`, `created_at`) VALUES
(1, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:09:17'),
(2, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:09:19'),
(3, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:09:20'),
(4, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:09:21'),
(5, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:09:21'),
(6, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:09:21'),
(7, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:09:21'),
(8, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:09:22'),
(9, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:09:25'),
(10, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:09:25'),
(11, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:11:16'),
(12, 8, 'Gudang Tujuan', 'Gudang Surabaya', 'Transit di gudang aneka margomulyo', '2025-12-14 19:11:17'),
(13, 7, 'Gudang Asal', 'Jakarta', 'Akan dikirim beberapa saat lagi', '2025-12-14 19:11:53'),
(14, 7, 'Gudang Asal', 'Jakarta', 'Akan dikirim beberapa saat lagi', '2025-12-14 19:11:55'),
(15, 7, 'Pickup', '', '', '2025-12-14 19:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `id` int(11) NOT NULL,
  `rute_id` int(11) NOT NULL,
  `tarif_per_kg` decimal(12,2) NOT NULL,
  `minimal_kg` decimal(10,2) DEFAULT 1.00,
  `estimasi_hari` varchar(20) DEFAULT '2-3 hari',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id`, `rute_id`, `tarif_per_kg`, `minimal_kg`, `estimasi_hari`, `created_at`) VALUES
(1, 6, 5000.00, 100.00, '3 - 4 hari', '2025-12-14 09:12:59'),
(2, 5, 500.00, 100.00, '1 hari', '2025-12-14 09:13:26'),
(3, 4, 2000.00, 100.00, '1 - 2 hari', '2025-12-14 09:14:00'),
(4, 3, 4000.00, 100.00, '2-3 hari', '2025-12-14 09:14:20'),
(5, 2, 5500.00, 100.00, '3 - 4 hari', '2025-12-14 09:14:48'),
(6, 1, 4500.00, 100.00, '2-3 hari', '2025-12-14 09:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `tracking_pengiriman`
--

CREATE TABLE `tracking_pengiriman` (
  `id` int(11) NOT NULL,
  `shipment_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('superadmin','admin','customer') DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `is_active`) VALUES
(1, 'Admin CS Sub', 'admin@anekalogistic.com', '$2y$10$0u536NmU8YGpmkJAWzft.OkQg88jbSOofvlxdZ0QRdk.S2iMqm7tW', 'admin', 1),
(2, 'Super Admin', 'superadmin@anekalogistic.com', '$2y$10$iGkU7l.PLHOmMZsAfuYeh.vHBKyg1YwhAtwwVdvlXcNwCSxX9tj9e', 'superadmin', 1),
(3, 'Shifa', 'shifa@gmail.com', '$2y$10$h2FeamZzuS6v7DbxFmFTbOLVHEpb/SpQYzeD6uQPYn1vKpawvuWae', 'customer', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resi` (`resi`);

--
-- Indexes for table `shipment_tracking`
--
ALTER TABLE `shipment_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rute_id` (`rute_id`);

--
-- Indexes for table `tracking_pengiriman`
--
ALTER TABLE `tracking_pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shipment_tracking`
--
ALTER TABLE `shipment_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tracking_pengiriman`
--
ALTER TABLE `tracking_pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `tarif_ibfk_1` FOREIGN KEY (`rute_id`) REFERENCES `rute` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
