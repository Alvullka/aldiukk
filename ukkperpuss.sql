-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2025 at 11:35 AM
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
-- Database: `ukkperpuss`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kode_buku` int(11) NOT NULL,
  `no_buku` int(11) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `jumlah_halaman` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar_buku` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kode_buku`, `no_buku`, `judul_buku`, `tahun_terbit`, `penulis`, `penerbit`, `jumlah_halaman`, `harga`, `gambar_buku`, `stok`) VALUES
(123, 16, 'al', 2008, 'mufiz', 'jian', 50, 20000, 'uploads/682eeee6f243e_buku mtk.png', 12),
(132, 133, 'al', 2008, 'mufiz', 'yayay', 17, 12333, 'uploads/682eea0e02590_buku mtk.png', 12),
(675, 44, 'musyati', 0, 'aldino', 'jian', 120, 12000, 'uploads/682edacf561d1_buku mtk.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `id` int(11) NOT NULL,
  `nama_peminjam` varchar(70) NOT NULL,
  `no_buku` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`id`, `nama_peminjam`, `no_buku`, `tanggal_pinjam`, `tanggal_kembali`, `stok`) VALUES
(1, 'aku', 44, '2025-05-22', '2025-05-22', 0),
(2, 'aku', 44, '2025-05-22', '2025-05-22', 0),
(3, 'aku', 133, '2025-05-22', '2025-05-22', 0),
(4, 'w', 133, '2025-05-22', '2025-05-22', 0),
(5, 'aku', 16, '2025-05-22', '2025-05-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('superadmin','admin','user','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'superadmin', 'superadmin', 'superadmin'),
(2, 'admin', 'admin', 'admin'),
(3, 'user', 'user', 'user'),
(4, 'user', 'yayay', 'user'),
(5, 'joko', 'aldi', 'user'),
(6, 'aldino', 'keke', 'superadmin'),
(7, 'aldino', 'yayay', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kode_buku`);

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
