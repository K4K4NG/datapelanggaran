-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 08:53 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggaran`
--

CREATE TABLE `data_pelanggaran` (
  `id` int(11) NOT NULL,
  `nama_pelanggaran` varchar(50) NOT NULL,
  `point_pelanggaran` int(20) NOT NULL,
  `kategori_pelanggaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pelanggaran`
--

INSERT INTO `data_pelanggaran` (`id`, `nama_pelanggaran`, `point_pelanggaran`, `kategori_pelanggaran`) VALUES
(1, 'Bolos sekolah', 20, 'Sedang'),
(2, 'Meroko di area sekolah', 20, 'Sedang'),
(3, 'Merusak Fasilitas', 20, 'Sedang'),
(4, 'Mabuk di area sekolah', 50, 'Berat'),
(5, 'Tauran', 100, 'Berat'),
(6, 'pembantaian siswa', 100, 'Berat');

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id` int(11) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `kelas_siswa` varchar(200) NOT NULL,
  `pelanggaran_siswa` varchar(200) NOT NULL,
  `point_siswa` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`id`, `nama_siswa`, `kelas_siswa`, `pelanggaran_siswa`, `point_siswa`) VALUES
(3, 'herlan Aguszz lope ya', 'XI oracle', 'a', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ddatas`
-- (See below for the actual view)
--
CREATE TABLE `ddatas` (
`id` int(11)
,`nama_siswa` varchar(50)
,`kelas_siswa` varchar(50)
,`nama_pelanggaran` varchar(50)
,`point_pelanggaran` int(20)
,`kategori_pelanggaran` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `macam_kelas`
--

CREATE TABLE `macam_kelas` (
  `id` int(11) NOT NULL,
  `kelas_kelas` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `macam_kelas`
--

INSERT INTO `macam_kelas` (`id`, `kelas_kelas`) VALUES
(1, 'XI Oracle'),
(2, 'X Oracle'),
(3, 'XII Oracle'),
(4, 'X TKJ'),
(5, 'XI TKJ'),
(6, 'XII TKJ'),
(7, 'X PPLG'),
(8, 'XI PPLG'),
(9, 'XII PPLG');

-- --------------------------------------------------------

--
-- Table structure for table `macam_pelangaaran`
--

CREATE TABLE `macam_pelangaaran` (
  `id` int(11) NOT NULL,
  `pelanggaran` varchar(200) NOT NULL,
  `point` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `macam_pelangaaran`
--

INSERT INTO `macam_pelangaaran` (`id`, `pelanggaran`, `point`) VALUES
(1, 'Bolos sekolah\r\n', 20),
(2, 'Meroko di area sekolah', 20),
(3, 'Merusak Fasilitas\r\n', 20),
(4, 'Mabuk di area sekolah\r\n', 50),
(5, 'Tauran\r\n', 100);

-- --------------------------------------------------------

--
-- Table structure for table `peraturan_smkn`
--

CREATE TABLE `peraturan_smkn` (
  `id` int(11) NOT NULL,
  `kode_peraturan` int(60) NOT NULL,
  `peraturan_sekolah` varchar(200) NOT NULL,
  `deskripsi_peraturan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peraturan_smkn`
--

INSERT INTO `peraturan_smkn` (`id`, `kode_peraturan`, `peraturan_sekolah`, `deskripsi_peraturan`) VALUES
(1, 11222323, 'Dilarang Bolos Sekolah', 'Jika dilakukan maka akan di kenakan sangsi berupa point pelanggaran yang dilakukan');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_siswi`
--

CREATE TABLE `siswa_siswi` (
  `id` int(11) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `kelas_siswa` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa_siswi`
--

INSERT INTO `siswa_siswi` (`id`, `nama_siswa`, `kelas_siswa`, `jenis_kelamin`) VALUES
(1, 'Herlan Ardiansyah', 'XI Oracle', 'Laki Laki'),
(2, 'Muhammad Farid', 'XI Oracle', 'Laki Laki'),
(3, 'Muhammad Kasyaf', 'XI Oracle', 'Laki Laki'),
(4, 'Muhammad Aflah', 'XI Oracle', 'Laki Laki'),
(5, 'Muhammad Ariq', 'XI Oracle', 'Laki Laki'),
(6, 'Muhammad hanafi', 'XI Oracle', 'Laki Laki');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_smkn`
--

CREATE TABLE `siswa_smkn` (
  `id` int(11) NOT NULL,
  `nisn_siswa` int(20) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `kelas_siswa` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa_smkn`
--

INSERT INTO `siswa_smkn` (`id`, `nisn_siswa`, `nama_siswa`, `kelas_siswa`, `jenis_kelamin`) VALUES
(1, 1123448, 'Herlan Ardiansyah', 'XI Oracle', 'Laki Laki'),
(2, 2211345, 'Muhammad Aflah', 'XI Oracle', 'Laki Laki'),
(3, 1123477, 'Muhammad Farid', 'XI Oracle', 'Laki Laki'),
(4, 4432345, 'Muhammad Kasyaf', 'XI Oracle', 'Laki Laki'),
(5, 6612321, 'Muhammad Ariq', 'XI Oracle', 'Laki Laki'),
(6, 1991726, 'Desta Julpaesal', 'XI Oracle', 'Laki Laki'),
(7, 12827172, 'Muhammad Hanafi', 'XI Oracle', 'Laki Laki'),
(8, 9918271, 'Muhammad Firdaus', 'X PPLG', 'Laki Laki');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'OA12AGS', 'OA12AGS');

-- --------------------------------------------------------

--
-- Structure for view `ddatas`
--
DROP TABLE IF EXISTS `ddatas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ddatas`  AS SELECT `siswa_siswi`.`id` AS `id`, `siswa_siswi`.`nama_siswa` AS `nama_siswa`, `siswa_siswi`.`kelas_siswa` AS `kelas_siswa`, `data_pelanggaran`.`nama_pelanggaran` AS `nama_pelanggaran`, `data_pelanggaran`.`point_pelanggaran` AS `point_pelanggaran`, `data_pelanggaran`.`kategori_pelanggaran` AS `kategori_pelanggaran` FROM (`siswa_siswi` left join `data_pelanggaran` on(`siswa_siswi`.`id` = `data_pelanggaran`.`id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_pelanggaran`
--
ALTER TABLE `data_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `macam_kelas`
--
ALTER TABLE `macam_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `macam_pelangaaran`
--
ALTER TABLE `macam_pelangaaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peraturan_smkn`
--
ALTER TABLE `peraturan_smkn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa_siswi`
--
ALTER TABLE `siswa_siswi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa_smkn`
--
ALTER TABLE `siswa_smkn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pelanggaran`
--
ALTER TABLE `data_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `macam_kelas`
--
ALTER TABLE `macam_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `macam_pelangaaran`
--
ALTER TABLE `macam_pelangaaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peraturan_smkn`
--
ALTER TABLE `peraturan_smkn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa_siswi`
--
ALTER TABLE `siswa_siswi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `siswa_smkn`
--
ALTER TABLE `siswa_smkn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
