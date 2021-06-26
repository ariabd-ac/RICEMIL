-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2021 at 09:39 PM
-- Server version: 5.7.34-log
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_indri_ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `Id_barang` int(11) NOT NULL,
  `Nama_barang` varchar(40) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `harga` double NOT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`Id_barang`, `Nama_barang`, `stock`, `harga`, `gambar`) VALUES
(3, 'Sabun', -4, 20000, '68796579_2433907643333859_4463231603417546752_n.jpg'),
(4, 'henbody', 2147483627, 12323, 'gbr.png'),
(5, 'nnnn', 16, 9999, 'b-parakankidang1.jpeg'),
(6, 'Test barang', NULL, 5000, '085220733720-16191440719251806262855064103899.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_stock`
--

CREATE TABLE `tb_data_stock` (
  `Id_stock` int(11) NOT NULL,
  `Id_barang` varchar(20) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `Id_laporan` int(11) NOT NULL,
  `Kategori` varchar(20) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_masuk`
--

CREATE TABLE `tb_order_masuk` (
  `Id_order` int(11) NOT NULL,
  `diskon` double NOT NULL,
  `subtotal` double NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `total` double DEFAULT NULL,
  `is_approve` tinyint(1) DEFAULT NULL,
  `order_by` varchar(20) DEFAULT NULL,
  `metode_bayar` varchar(20) DEFAULT NULL,
  `struk_gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_order_masuk`
--

INSERT INTO `tb_order_masuk` (`Id_order`, `diskon`, `subtotal`, `date`, `total`, `is_approve`, `order_by`, `metode_bayar`, `struk_gambar`) VALUES
(16, 6969, 76969, '2021-06-27 01:34:42', 70000, 1, '1326851081', '2', '085220733720-16191440719251806262855064103899.jpg'),
(17, 4646, 34646, '2021-06-27 01:56:24', 30000, 1, '1326851081', '2', 'img-75000.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_masuk_detail`
--

CREATE TABLE `tb_order_masuk_detail` (
  `id_detail` int(11) NOT NULL,
  `id_order_masuk` varchar(40) NOT NULL,
  `id_item` varchar(40) NOT NULL,
  `harga` double NOT NULL,
  `qty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order_masuk_detail`
--

INSERT INTO `tb_order_masuk_detail` (`id_detail`, `id_order_masuk`, `id_item`, `harga`, `qty`) VALUES
(27, '16', '3', 20000, 2),
(28, '16', '4', 12323, 3),
(29, '17', '4', 12323, 2),
(30, '17', '6', 5000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `alamat` date DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengadaan_stock`
--

CREATE TABLE `tb_pengadaan_stock` (
  `Id` int(11) NOT NULL,
  `Nama_barang` varchar(40) DEFAULT NULL,
  `Jumlah` varchar(20) DEFAULT NULL,
  `Harga` varchar(20) DEFAULT NULL,
  `is_approve` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengadaan_stock`
--

INSERT INTO `tb_pengadaan_stock` (`Id`, `Nama_barang`, `Jumlah`, `Harga`, `is_approve`) VALUES
(1, '3', '5', '20000', 0),
(3, '3', '10', '20', 1),
(4, '5', '20', '10000', NULL),
(5, '3', '90', '30000', 1),
(6, '4', '10', '2000', NULL),
(7, '4', '10', '2000', NULL),
(8, '4', '1', '1000', NULL),
(9, '3', '1', '1000', 1),
(10, '3', '10', '1000', 0),
(11, '3', '1', '10', NULL),
(12, '3', '10', '1', NULL),
(13, '3', '1', '10', NULL),
(14, '3', '10', '1', NULL),
(15, '5', '10', '1', NULL),
(16, '3', '10', '1', NULL),
(17, '4', '1', '1', NULL),
(18, '5', '10', '1', NULL),
(19, '3', '1', '1', NULL),
(20, '3', '1', '1', NULL),
(21, '5', '1', '1', NULL),
(22, '4', '1', '1', NULL),
(23, '5', '1', '1', NULL),
(24, '5', '1', '1', NULL),
(25, '5', '1', '1', NULL),
(26, '5', '1', '1', NULL),
(27, '3', '1', '1', NULL),
(28, '5', '1', '1', NULL),
(29, '4', '1', '1', NULL),
(30, '3', '1', '1', NULL),
(31, '4', '1', '1', NULL),
(32, '4', '1', '1', NULL),
(33, '5', '1', '1', NULL),
(34, '3', '1', '1', NULL),
(35, '4', '1', '1', NULL),
(36, '4', '1', '1', NULL),
(37, '4', '1', '1', NULL),
(38, '5', '1', '1', NULL),
(39, '5', '1', '1', NULL),
(40, '5', '1', '1', NULL),
(41, '3', '2', '2', NULL),
(42, '5', '1', '1', NULL),
(43, '4', '1', '1000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengiriman_produk`
--

CREATE TABLE `tb_pengiriman_produk` (
  `Id_pengirimnan` int(11) NOT NULL,
  `Id_barang` varchar(20) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `tgl_pengiriman` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rf_metodebayar`
--

CREATE TABLE `tb_rf_metodebayar` (
  `id` int(11) NOT NULL,
  `descr` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_rf_metodebayar`
--

INSERT INTO `tb_rf_metodebayar` (`id`, `descr`) VALUES
(1, 'COD'),
(2, 'Upload Bukti Pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id` varchar(40) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `Id_transaksi` int(11) NOT NULL,
  `Id_pelanggan` varchar(20) DEFAULT NULL,
  `Tanggal_transaksi` datetime DEFAULT CURRENT_TIMESTAMP,
  `diskon` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `Total_bayar` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `order_by` varchar(40) DEFAULT NULL,
  `metode_bayar` varchar(40) DEFAULT NULL,
  `struk_gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`Id_transaksi`, `Id_pelanggan`, `Tanggal_transaksi`, `diskon`, `subtotal`, `Total_bayar`, `status`, `order_by`, `metode_bayar`, `struk_gambar`) VALUES
(11, '1326851081', '2021-06-27 01:36:20', 6969, 76969, '70000', '4', '1326851081', '2', '085220733720-16191440719251806262855064103899.jpg'),
(12, '1326851081', '2021-06-27 01:57:51', 4646, 34646, '30000', '12', '1326851081', '2', 'img-75000.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_detail`
--

CREATE TABLE `tb_transaksi_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` varchar(40) NOT NULL,
  `id_item` varchar(40) NOT NULL,
  `harga` double NOT NULL,
  `qty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_detail`
--

INSERT INTO `tb_transaksi_detail` (`id_detail`, `id_transaksi`, `id_item`, `harga`, `qty`) VALUES
(7, '11', '3', 20000, 2),
(8, '11', '4', 12323, 3),
(9, '12', '4', 12323, 2),
(10, '12', '6', 5000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `username`, `fname`, `lname`, `email`, `phone`, `password`, `alamat`, `level`) VALUES
(4, 340493864, 'admin', 'admin', 'admin', 'admin@admin.com', '083113729917', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin'),
(5, 727116763, 'gudang', 'gudang', 'gudang', 'gudang@gmail.com', '', '202446dd1d6028084426867365b0c7a1', 'Gudang', 'gudang'),
(6, 1326851081, 'reseller', 'reseller', 'reseller', 'reseller@gmail.com', '', '9efc4ac970619de711752d818c29884a', 'reseller', 'reseller'),
(7, 336577275, 'supplier', 'supplier', 'supplier', 'admin@gmail.com', '087888187620', '99b0e8da24e29e4ccb5d7d76e677c2ac', 'supplier', 'supplier'),
(9, 1445894491, 'kasir', 'kasir', '123', 'kasir123@gmail.com', '082113779918', 'c7911af3adbd12a035b289556d96470a', 'kasir', 'kasir'),
(10, 971221366, 'supplier2', 'supplier2', '2', 'supplier2@gmail.com', '083113729917', '99b0e8da24e29e4ccb5d7d76e677c2ac', 'supplier', 'supplier'),
(11, 912680155, 'supplier3', 'supplier3', '3', 'supplier3@gmail.com', '085156843174', '99b0e8da24e29e4ccb5d7d76e677c2ac', 'supplier', 'supplier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`Id_barang`);

--
-- Indexes for table `tb_data_stock`
--
ALTER TABLE `tb_data_stock`
  ADD PRIMARY KEY (`Id_stock`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`Id_laporan`);

--
-- Indexes for table `tb_order_masuk`
--
ALTER TABLE `tb_order_masuk`
  ADD PRIMARY KEY (`Id_order`);

--
-- Indexes for table `tb_order_masuk_detail`
--
ALTER TABLE `tb_order_masuk_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengadaan_stock`
--
ALTER TABLE `tb_pengadaan_stock`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tb_pengiriman_produk`
--
ALTER TABLE `tb_pengiriman_produk`
  ADD PRIMARY KEY (`Id_pengirimnan`);

--
-- Indexes for table `tb_rf_metodebayar`
--
ALTER TABLE `tb_rf_metodebayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`Id_transaksi`);

--
-- Indexes for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `Id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_data_stock`
--
ALTER TABLE `tb_data_stock`
  MODIFY `Id_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `Id_laporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_order_masuk`
--
ALTER TABLE `tb_order_masuk`
  MODIFY `Id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_order_masuk_detail`
--
ALTER TABLE `tb_order_masuk_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengadaan_stock`
--
ALTER TABLE `tb_pengadaan_stock`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tb_pengiriman_produk`
--
ALTER TABLE `tb_pengiriman_produk`
  MODIFY `Id_pengirimnan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rf_metodebayar`
--
ALTER TABLE `tb_rf_metodebayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `Id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
