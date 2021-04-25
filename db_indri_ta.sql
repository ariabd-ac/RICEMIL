-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Apr 2021 pada 09.35
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `Id_barang` int(11) NOT NULL,
  `Nama_barang` varchar(40) NOT NULL,
  `stock` int(11) NOT NULL,
  `harga` double NOT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`Id_barang`, `Nama_barang`, `stock`, `harga`, `gambar`) VALUES
(3, 'Sabun', 3, 20000, '68796579_2433907643333859_4463231603417546752_n.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data_stock`
--

CREATE TABLE `tb_data_stock` (
  `Id_stock` int(11) NOT NULL,
  `Id_barang` varchar(20) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `Id_laporan` int(11) NOT NULL,
  `Kategori` varchar(20) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order_masuk`
--

CREATE TABLE `tb_order_masuk` (
  `Id_order` int(11) NOT NULL,
  `Id_barang` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date` date DEFAULT curdate(),
  `total` double DEFAULT NULL,
  `is_approve` tinyint(1) DEFAULT NULL,
  `order_by` varchar(20) DEFAULT NULL,
  `metode_bayar` varchar(20) DEFAULT NULL,
  `struk_gambar` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_order_masuk`
--

INSERT INTO `tb_order_masuk` (`Id_order`, `Id_barang`, `qty`, `date`, `total`, `is_approve`, `order_by`, `metode_bayar`, `struk_gambar`) VALUES
(1, '3', 2, '2021-04-24', 40000, 1, '1326851081', '2', 'bg.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `alamat` date DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengadaan_stock`
--

CREATE TABLE `tb_pengadaan_stock` (
  `Id_barang` int(11) NOT NULL,
  `Nama_barang` varchar(40) DEFAULT NULL,
  `Jumlah` varchar(20) DEFAULT NULL,
  `Harga` varchar(20) DEFAULT NULL,
  `Total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengadaan_stock`
--

INSERT INTO `tb_pengadaan_stock` (`Id_barang`, `Nama_barang`, `Jumlah`, `Harga`, `Total`) VALUES
(1, '3', '5', '20000', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengiriman_produk`
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
-- Struktur dari tabel `tb_rf_metodebayar`
--

CREATE TABLE `tb_rf_metodebayar` (
  `id` int(11) NOT NULL,
  `descr` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id` varchar(40) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `delete_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `Id_transaksi` int(11) NOT NULL,
  `Id_pelanggan` varchar(20) DEFAULT NULL,
  `Tanggal_transaksi` date DEFAULT NULL,
  `id_barang` varchar(20) DEFAULT NULL,
  `Harga` varchar(20) DEFAULT NULL,
  `Jumlah_pesanan` varchar(20) DEFAULT NULL,
  `Total_bayar` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`Id_transaksi`, `Id_pelanggan`, `Tanggal_transaksi`, `id_barang`, `Harga`, `Jumlah_pesanan`, `Total_bayar`, `status`) VALUES
(1, '1326851081', '2021-04-24', '3', '20000', '2', '40000', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `username`, `fname`, `lname`, `email`, `password`, `alamat`, `level`) VALUES
(4, 340493864, 'admin', 'admin', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin'),
(5, 727116763, 'gudang', 'gudang', 'gudang', 'gudang@gmail.com', '202446dd1d6028084426867365b0c7a1', 'Gudang', 'gudang'),
(6, 1326851081, 'reseller', 'reseller', 'reseller', 'reseller@gmail.com', '9efc4ac970619de711752d818c29884a', 'reseller', 'reseller'),
(7, 336577275, 'supplier', 'supplier', 'supplier', 'admin@gmail.com', '99b0e8da24e29e4ccb5d7d76e677c2ac', 'supplier', 'supplier');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`Id_barang`);

--
-- Indeks untuk tabel `tb_data_stock`
--
ALTER TABLE `tb_data_stock`
  ADD PRIMARY KEY (`Id_stock`);

--
-- Indeks untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`Id_laporan`);

--
-- Indeks untuk tabel `tb_order_masuk`
--
ALTER TABLE `tb_order_masuk`
  ADD PRIMARY KEY (`Id_order`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pengadaan_stock`
--
ALTER TABLE `tb_pengadaan_stock`
  ADD PRIMARY KEY (`Id_barang`);

--
-- Indeks untuk tabel `tb_pengiriman_produk`
--
ALTER TABLE `tb_pengiriman_produk`
  ADD PRIMARY KEY (`Id_pengirimnan`);

--
-- Indeks untuk tabel `tb_rf_metodebayar`
--
ALTER TABLE `tb_rf_metodebayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`Id_transaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `Id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_data_stock`
--
ALTER TABLE `tb_data_stock`
  MODIFY `Id_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `Id_laporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_order_masuk`
--
ALTER TABLE `tb_order_masuk`
  MODIFY `Id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pengadaan_stock`
--
ALTER TABLE `tb_pengadaan_stock`
  MODIFY `Id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pengiriman_produk`
--
ALTER TABLE `tb_pengiriman_produk`
  MODIFY `Id_pengirimnan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_rf_metodebayar`
--
ALTER TABLE `tb_rf_metodebayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `Id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
