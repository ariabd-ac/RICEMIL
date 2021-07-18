-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2021 at 01:35 AM
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
  `harga_beli` double NOT NULL,
  `harga` double NOT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`Id_barang`, `Nama_barang`, `stock`, `harga_beli`, `harga`, `gambar`) VALUES
(3, 'Beras Bulog', 108, 15000, 230000, 'IMG-20200129-WA0013.jpg'),
(4, 'Beras Pandan', 21, 20000, 240000, 'gbr.png'),
(5, 'Beras Sin-chan', 16, 0, 250000, 'b-parakankidang1.jpeg'),
(6, 'Beras apakarepe', NULL, 0, 210000, 'IMG-20200129-WA0012.jpg');

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
-- Table structure for table `tb_harga_supplier`
--

CREATE TABLE `tb_harga_supplier` (
  `id` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_harga_supplier`
--

INSERT INTO `tb_harga_supplier` (`id`, `id_supplier`, `id_item`, `harga`) VALUES
(1, 1, 2, 2000),
(2, 336577275, 3, 40000),
(3, 336577275, 4, 30000),
(4, 971221366, 4, 50000);

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
  `tanggal_transaksi` datetime DEFAULT CURRENT_TIMESTAMP,
  `Total` double DEFAULT NULL,
  `is_approve` tinyint(1) DEFAULT NULL,
  `supplier_nohp` varchar(40) NOT NULL,
  `no_po` varchar(20) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengadaan_stock`
--

INSERT INTO `tb_pengadaan_stock` (`Id`, `tanggal_transaksi`, `Total`, `is_approve`, `supplier_nohp`, `no_po`, `status`) VALUES
(62, '2021-07-17 02:22:03', 100000, 1, '087888187620', 'PO20210718-2324', 3),
(63, '2021-07-19 04:25:02', 350000, 1, '087888187620', 'PO20210718-2325', 3),
(64, '2021-07-19 04:48:57', 0, NULL, '087847274085', 'PO20210718-2348', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengadaan_stock_detail`
--

CREATE TABLE `tb_pengadaan_stock_detail` (
  `id` int(11) NOT NULL,
  `id_pengadaan_stock` int(11) NOT NULL,
  `id_item` varchar(40) NOT NULL,
  `harga` double NOT NULL,
  `qty` int(11) NOT NULL,
  `appproved_by` varchar(40) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `is_rejected` tinyint(2) DEFAULT NULL,
  `qty_rejected` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengadaan_stock_detail`
--

INSERT INTO `tb_pengadaan_stock_detail` (`id`, `id_pengadaan_stock`, `id_item`, `harga`, `qty`, `appproved_by`, `status`, `is_rejected`, `qty_rejected`) VALUES
(55, 62, '4', 30000, 2, '336577275', NULL, 1, 1),
(56, 62, '3', 40000, 5, '336577275', NULL, NULL, NULL),
(57, 63, '3', 40000, 5, '336577275', NULL, 1, 1),
(58, 63, '4', 30000, 5, NULL, NULL, NULL, NULL),
(59, 64, '4', 30000, 5, NULL, NULL, NULL, NULL);

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
(18, '1', '2021-07-14 07:49:52', 600, 37600, NULL, '4', NULL, NULL, NULL),
(19, NULL, '2021-07-14 07:51:53', 0, 20000, NULL, '4', NULL, NULL, NULL),
(20, NULL, '2021-07-14 07:51:56', 0, 20000, NULL, '4', NULL, NULL, NULL),
(21, NULL, '2021-07-14 07:55:35', 0, 30000, NULL, '4', NULL, NULL, NULL),
(22, NULL, '2021-07-16 09:51:06', 400, 28400, NULL, '4', NULL, NULL, NULL),
(23, NULL, '2021-07-16 09:53:56', 200, 19200, NULL, '4', NULL, NULL, NULL);

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
(20, '18', '3', 9200, 2),
(21, '18', '4', 9600, 2),
(22, '19', '5', 10000, 2),
(23, '20', '5', 10000, 2),
(24, '21', '5', 10000, 3),
(25, '22', '3', 9200, 1),
(26, '22', '4', 9600, 2),
(27, '23', '3', 9200, 1),
(28, '23', '5', 10000, 1);

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
(10, 971221366, 'supplier2', 'supplier2', '2', 'supplier2@gmail.com', '087847274085', '99b0e8da24e29e4ccb5d7d76e677c2ac', 'supplier', 'supplier'),
(11, 912680155, 'supplier3', 'supplier3', '3', 'supplier3@gmail.com', '085156843174', '99b0e8da24e29e4ccb5d7d76e677c2ac', 'supplier', 'supplier'),
(12, 1469616296, 'indri', 'Indri', 'Simalakama', 'indrisimalakama@gmail.com', '083241961774', '71f7be7b8496f7ece8454b1bcdcd2162', 'Lemah Duwur Tegal', 'gudang');

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
-- Indexes for table `tb_harga_supplier`
--
ALTER TABLE `tb_harga_supplier`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tb_pengadaan_stock_detail`
--
ALTER TABLE `tb_pengadaan_stock_detail`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tb_harga_supplier`
--
ALTER TABLE `tb_harga_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `Id_laporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_order_masuk`
--
ALTER TABLE `tb_order_masuk`
  MODIFY `Id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_order_masuk_detail`
--
ALTER TABLE `tb_order_masuk_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengadaan_stock`
--
ALTER TABLE `tb_pengadaan_stock`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tb_pengadaan_stock_detail`
--
ALTER TABLE `tb_pengadaan_stock_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
  MODIFY `Id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
