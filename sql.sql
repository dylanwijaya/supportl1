-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2021 at 05:23 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `gamas`
--

CREATE TABLE `gamas` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `duration` varchar(255) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `escalation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gamas`
--

INSERT INTO `gamas` (`id`, `brand`, `product`, `start`, `end`, `duration`, `problem`, `escalation`) VALUES
(1, 'NEO', 'NEO Cloud', '2021-01-16 20:15:00', '2021-01-16 22:18:00', '00 hari 02 jam 03 menit', 'Kendala pada beberapa host di region WJV', 32141),
(2, 'GIO', 'GIO Private', '2021-01-16 20:16:00', '2021-01-16 23:16:00', '00 hari 03 jam 00 menit', 'Kendala Upstream', 312321);

-- --------------------------------------------------------

--
-- Table structure for table `handover`
--

CREATE TABLE `handover` (
  `id` int(11) NOT NULL,
  `no_ticket` int(10) NOT NULL,
  `department` varchar(200) NOT NULL,
  `product` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `last_update` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `priority` varchar(200) NOT NULL,
  `logs_agent` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `handover`
--

INSERT INTO `handover` (`id`, `no_ticket`, `department`, `product`, `description`, `last_update`, `status`, `priority`, `logs_agent`, `date`) VALUES
(14, 1234, 'NEO', 'NEO Cloud', 'Penambahan Storage Instance AB09', 'Sedang diproses L1', 'On Progress', 'Medium', 'admin', '2021-01-20'),
(15, 1111, 'GIO', 'GIO Private', 'Add vm di vcenter', 'sedang dikoordinasikan dengan tim sysops', 'on progress', 'Medium', 'admin', '2021-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `list_vip`
--

CREATE TABLE `list_vip` (
  `id` int(11) NOT NULL,
  `company` varchar(256) NOT NULL,
  `product` varchar(256) NOT NULL,
  `account` varchar(256) NOT NULL,
  `customer` varchar(256) NOT NULL,
  `sales` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone` bigint(200) NOT NULL,
  `agent` varchar(256) NOT NULL,
  `logs_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_vip`
--

INSERT INTO `list_vip` (`id`, `company`, `product`, `account`, `customer`, `sales`, `email`, `phone`, `agent`, `logs_date`) VALUES
(1, 'GIO', 'Gio Public', 'AA00032', 'Suherman', 'Aisyah', 'suherman@private.com', 81381083, 'Dylan', '2021-01-19'),
(2, 'NEO', 'NEO Cloud', 'dylan@dulan.com', 'Dylan', 'Putri', 'dylan@biznetgio.com', 81381080167, 'Dylan', '2021-01-19'),
(4, 'Biznet Gio Nusantara', 'GIO', 'dsa', 'dsadas', 'Zuma', 'dylan@biznetgio.com', 2147483647, 'Dylan', '2021-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `manage_support`
--

CREATE TABLE `manage_support` (
  `id` int(11) NOT NULL,
  `no_ticket` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `sow` text NOT NULL,
  `agent` varchar(255) NOT NULL,
  `sales` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `finish` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `logs_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_support`
--

INSERT INTO `manage_support` (`id`, `no_ticket`, `company`, `product`, `invoice`, `price`, `sow`, `agent`, `sales`, `start`, `finish`, `status`, `logs_date`) VALUES
(1, 3213, 'Biznet Gio Nusantara', 'NEO virtual Compute', 'NEO-31237893', 500000, '1. Instalasi Plesk\r\n2. Konfigurasi Email\r\n3. Pointing Domain', 'admin', 'Aisyah', '2021-01-15', '2021-01-16', 'On Hold', '2021-01-20'),
(2, 43213, 'Biznet Gio ', 'GIO Public 1', 'GIO-132678311', 2000000, '1. Pembuatan VM\r\n2. Setting firewall', 'admin', 'Zuma', '2021-01-16', '2021-01-18', 'On Hold', '2021-01-20'),
(4, 31274, 'GoTravelly', 'NEO virtual Compute', 'NEO-312321312', 5000000, '1. Create instance\r\n2. Install cPanel\r\n3. Mounting volume\r\n4. Migrasi data\r\n5. Pointing\r\n6. Backup', 'admin', 'Aisyah', '2021-01-16', '2021-01-23', 'On Progress', '2021-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `rfo`
--

CREATE TABLE `rfo` (
  `id` int(11) NOT NULL,
  `no_ticket` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `incident` date NOT NULL,
  `file` varchar(100) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `logs_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rfo`
--

INSERT INTO `rfo` (`id`, `no_ticket`, `product`, `account`, `company`, `subject`, `incident`, `file`, `agent`, `logs_date`) VALUES
(9, 321, 'NEO', 'gfds', 'Biznet Gio ', 'Attachment 15 MB', '2021-01-22', '1508166924464.jpg', 'Dylan', '2021-01-21'),
(10, 32145, 'GIO Cloud', '321322', 'GOOOOO', 'HaloHalo Gio', '2021-01-30', 'a.docx', 'Dylan', '2021-01-21'),
(11, 3214, 'GIO Backup', '312321', 'Hatfield', 'Cerita Mail Kundang', '2021-01-24', 'a.docx', 'Dylan', '2021-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `name`) VALUES
(1, 'admin', '$2y$10$4Cc.OwAm8VpQYsGkheOOoOwlFlsrfkkw7dMct1CqA9lPgY/M0.nZW', 'admin'),
(2, 'Dylan', '$2y$10$xT8/hDFcd3umYY6BpllgsuQmeZzuRp49dnkwjkKfWT69sT6VfnIu6', 'Dylan'),
(3, 'imonk', '$2y$10$iyR7NGAWA1XSBxXXeYuz8OF9SGOeTIYtyfFJ0Wa8evkxGe5.VeVj6', 'imonk'),
(4, 'ajeng', '$2y$10$d9/jzBMm5wknPrDO/UHSq.mFTgopp/pzZVcXH53DRoIUxqrmifUcq', 'ajeng');

-- --------------------------------------------------------

--
-- Table structure for table `upsale`
--

CREATE TABLE `upsale` (
  `id` int(11) NOT NULL,
  `no_ticket` int(10) NOT NULL,
  `product` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL,
  `kebutuhan` varchar(200) NOT NULL,
  `agent` varchar(200) NOT NULL,
  `sales` varchar(200) NOT NULL,
  `tgl_fu` date NOT NULL,
  `channel` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upsale`
--

INSERT INTO `upsale` (`id`, `no_ticket`, `product`, `company`, `kebutuhan`, `agent`, `sales`, `tgl_fu`, `channel`) VALUES
(8, 1231, 'Private', 'Supra', 'VM', 'Dylan', 'Aisyah', '2020-01-01', 'Ticket'),
(9, 12311, 'Gio Public V2', 'Alto', 'Penambahan Storage Sebesar 200GB', 'Syarif', 'Aisyah', '2021-01-08', 'Live Chat'),
(10, 32133, 'NEO Dedicated', 'GoTravelly', 'Upgrade Instance', 'Asep', 'Sheila', '2021-01-09', 'Ticket'),
(11, 4444, 'GIO Private', 'Maju Mundur', '30 GIO Private', 'Robby', 'Zuma', '2021-01-01', 'Ticket'),
(12, 321312, 'NEO Cloud', 'Rinnai', 'Penambahan kompor', 'Ajeng', 'Zuma', '2020-01-12', 'Live Chat'),
(13, 123123, 'GIO Cloud', 'Ketan', 'Nambah sambel', 'Dylan', 'Zuma', '2021-01-12', 'Live Chat'),
(14, 392833, 'NEO Cloud', 'PT Genteng Warga Setempat', '- Ram 30 GB- HDD 60 GB- SSD 200 GB- CPU 40- Os Windows', 'admin', 'Aisyah', '2021-01-12', 'Ticket'),
(15, 565, 'NEO', 'dasdsadsadsa', 'dsadsa', 'Dylan', 'dsadsa', '2020-01-01', 'dsadas'),
(16, 31, 'dasd', 'dsad', 'dasda', 'Dylan', 'dasd', '2020-01-01', 'dasd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gamas`
--
ALTER TABLE `gamas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `handover`
--
ALTER TABLE `handover`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_vip`
--
ALTER TABLE `list_vip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_support`
--
ALTER TABLE `manage_support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rfo`
--
ALTER TABLE `rfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upsale`
--
ALTER TABLE `upsale`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gamas`
--
ALTER TABLE `gamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `handover`
--
ALTER TABLE `handover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `list_vip`
--
ALTER TABLE `list_vip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `manage_support`
--
ALTER TABLE `manage_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rfo`
--
ALTER TABLE `rfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `upsale`
--
ALTER TABLE `upsale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
