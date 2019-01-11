-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 16, 2018 at 09:22 PM
-- Server version: 10.1.34-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.1.24-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia-web`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_jurnal` int(30) NOT NULL,
  `no_ref` int(10) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nominal` int(30) NOT NULL,
  `jenis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_jurnal`, `no_ref`, `tanggal`, `keterangan`, `nominal`, `jenis`) VALUES
(1, 111, '10/02/2018', 'kas', 80000000, 'debit'),
(2, 311, '10/02/2018', 'Modal', 80000000, 'kredit'),
(3, 111, '10/03/2018', 'kas', 75000000, 'debit'),
(4, 311, '10/03/2018', 'modal', 75000000, 'kredit'),
(5, 112, '10/05/2018', 'Peralatan', 35000000, 'debit'),
(6, 113, '10/05/2018', 'tanah, property', 115000000, 'debit'),
(7, 311, '10/05/2018', 'modal', 150000000, 'kredit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_jurnal` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
