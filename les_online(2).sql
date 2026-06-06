-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2026 at 03:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `les_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id_exam` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `tipe_ujian` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_scores`
--

CREATE TABLE `exam_scores` (
  `id_nilai_ujian` int(11) NOT NULL,
  `id_exam` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `tanggal_pengerjaan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenjang`
--

CREATE TABLE `jenjang` (
  `id_jenjang` int(11) NOT NULL,
  `nama_jenjang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jenjang`
--

INSERT INTO `jenjang` (`id_jenjang`, `nama_jenjang`) VALUES
(1, 'SD'),
(2, 'SMP'),
(3, 'SMA');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_major` int(11) NOT NULL,
  `id_university` int(11) DEFAULT NULL,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  `target_nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_major`, `id_university`, `nama_jurusan`, `target_nilai`) VALUES
(1, 1, 'Kedokteran', 748),
(2, 1, 'Ilmu Komputer', 730),
(3, 1, 'Ilmu Hukum', 715),
(4, 1, 'Psikologi', 710),
(5, 1, 'Ilmu Komunikasi', 705),
(6, 1, 'Sastra Inggris', 680),
(7, 2, 'STEI - Komputasi', 740),
(8, 2, 'FTMD - Kedirgantaraan', 725),
(9, 2, 'SITH - Sains', 690),
(10, 2, 'FITB', 700),
(11, 2, 'FTI - Kampus Jatinangor', 710),
(12, 2, 'FSRD', 695),
(13, 3, 'Kedokteran', 742),
(14, 3, 'Teknologi Informasi', 725),
(15, 3, 'Akuntansi', 718),
(16, 3, 'Manajemen', 712),
(17, 3, 'Farmasi', 705),
(18, 3, 'Teknik Sipil', 698),
(19, 4, 'Kedokteran', 735),
(20, 4, 'Kedokteran Gigi', 715),
(21, 4, 'Kesehatan Masyarakat', 685),
(22, 4, 'Hubungan Internasional', 700),
(23, 4, 'Ilmu Politik', 670),
(24, 5, 'Teknik Informatika', 728),
(25, 5, 'Sistem Informasi', 715),
(26, 5, 'Teknik Elektro', 705),
(27, 5, 'Teknik Mesin', 695),
(28, 5, 'Teknik Perkapalan', 675),
(29, 5, 'Arsitektur', 710),
(30, 6, 'Pendidikan Dokter', 730),
(31, 6, 'Ilmu Komunikasi', 710),
(32, 6, 'Hubungan Internasional', 705),
(33, 6, 'Farmasi', 695),
(34, 6, 'Teknik Geologi', 680);

-- --------------------------------------------------------

--
-- Table structure for table `paket_pembelajaran`
--

CREATE TABLE `paket_pembelajaran` (
  `id_paket` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenjang` enum('SD','SMP','SMA','Umum') DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `masa_aktif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_pembelajaran`
--

INSERT INTO `paket_pembelajaran` (`id_paket`, `nama`, `jenjang`, `harga`, `masa_aktif`) VALUES
(1, 'Sukses UN Matematika SD', 'SD', 150000.00, 30),
(2, 'Master English Grammar', 'SMP', 250000.00, 60),
(3, 'Intensif Fisika Kuantum', 'SMA', 450000.00, 90),
(4, 'Persiapan UTBK SBMPTN', 'SMA', 600000.00, 180);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_voucher` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','berhasil','gagal') DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `id_university` int(11) NOT NULL,
  `nama_ptn` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id_university`, `nama_ptn`, `lokasi`) VALUES
(1, 'Universitas Indonesia (UI)', 'Depok'),
(2, 'Institut Teknologi Bandung (ITB)', 'Bandung'),
(3, 'Universitas Gadjah Mada (UGM)', 'Yogyakarta'),
(4, 'Universitas Airlangga (UNAIR)', 'Surabaya'),
(5, 'Institut Teknologi Sepuluh Nopember (ITS)', 'Surabaya'),
(6, 'Universitas Padjadjaran (UNPAD)', 'Sumedang'),
(7, 'Universitas Diponegoro (UNDIP)', 'Semarang'),
(8, 'Universitas Brawijaya (UB)', 'Malang'),
(9, 'Universitas Hasanuddin (UNHAS)', 'Makassar'),
(10, 'Universitas Sebelas Maret (UNS)', 'Surakarta'),
(11, 'Universitas Pendidikan Indonesia (UPI)', 'Bandung'),
(12, 'Universitas Negeri Jakarta (UNJ)', 'Jakarta'),
(13, 'Universitas Negeri Yogyakarta (UNY)', 'Yogyakarta'),
(14, 'Universitas Negeri Malang (UM)', 'Malang'),
(15, 'Universitas Andalas (UNAND)', 'Padang'),
(16, 'Universitas Sumatera Utara (USU)', 'Medan'),
(17, 'Universitas Sriwijaya (UNSRI)', 'Palembang'),
(18, 'Universitas Syiah Kuala (USK)', 'Banda Aceh'),
(19, 'Universitas Udayana (UNUD)', 'Denpasar'),
(20, 'Universitas Mulawarman (UNMUL)', 'Samarinda'),
(21, 'Universitas Jenderal Soedirman (UNSOED)', 'Purwokerto'),
(22, 'Universitas Negeri Semarang (UNNES)', 'Semarang'),
(23, 'Universitas Negeri Surabaya (UNESA)', 'Surabaya'),
(24, 'Universitas Jember (UNEJ)', 'Jember'),
(25, 'Universitas Tanjungpura (UNTAN)', 'Pontianak'),
(26, 'Universitas Lambung Mangkurat (ULM)', 'Banjarmasin'),
(27, 'Universitas Mataram (UNRAM)', 'Mataram'),
(28, 'Universitas Pattimura (UNPATTI)', 'Ambon'),
(29, 'Universitas Sam Ratulangi (UNSRAT)', 'Manado'),
(30, 'Universitas Tadulako (UNTAD)', 'Palu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','guru','siswa','orang tua') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_jenjang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `role`, `created_at`, `id_jenjang`) VALUES
(1, 'Alice Administrator', 'alice.admin@lesonline.com', '$2y$12$c5a33vxpMJ2HxQnewAFmx.YiAoP3KPdgGegmP7UpIcVRtXdI0MesK', 'admin', '2026-05-05 03:36:34', NULL),
(2, 'Bob Superuser', 'bob.admin@lesonline.com', '$2y$12$O5uWVUq783JZlEPGcq7jeu1gOG7HQEx9V40FVteTXcoKo2ow2U/aO', 'admin', '2026-05-05 03:36:34', NULL),
(3, 'Chandra Ops', 'chandra.admin@lesonline.com', '$2y$12$Nei8fHBR1pIsLbM2EaCmjunn3kYnGrcDIZdSx/xNe85/gal8NHnTG', 'admin', '2026-05-05 03:36:34', NULL),
(4, 'Dina Manager', 'dina.admin@lesonline.com', '$2y$12$AEZYJZjlrmWgBu1NewMs0u7spEuxFOpJ3pWmY3lMeSIUDgtl10TBq', 'admin', '2026-05-05 03:36:34', NULL),
(5, 'Eko Staff', 'eko.admin@lesonline.com', '$2y$12$Sut6A9XwLKhQfEp.s0OxX.K005ZqNCCBnae6oEG8h3sClmu.WjWq.', 'admin', '2026-05-05 03:36:34', NULL),
(6, 'Bambang Sudarmadji', 'bambang.guru@lesonline.com', '$2y$12$RPhn1rRmxcnsEmYzR7uf5.fdculnCYu5hxQfGuKI2ND8Fu/WCp.Ci', 'guru', '2026-05-05 03:36:34', NULL),
(7, 'Sri Wahyuni', 'sri.guru@lesonline.com', '$2y$12$ibdVeO74NgYsHZ6A3/kRve/RwHobi0QhjhlUuwR.iSvVM4gewGCyW', 'guru', '2026-05-05 03:36:34', NULL),
(8, 'Budi Santoso', 'budi.guru@lesonline.com', '$2y$12$3xZDrn6RAzODJMX3Id8lTevacdErj1pzX1.7yq7z8G32Wu4.CM.aK', 'guru', '2026-05-05 03:36:34', NULL),
(9, 'Dewi Lestari', 'dewi.guru@lesonline.com', '$2y$12$X8kc85mrjoZdVNSK21aRVeEtBb8PsWkYcWwzFga3Gln6t7dc.HeDi', 'guru', '2026-05-05 03:36:34', NULL),
(10, 'Fajar Nugraha', 'fajar.guru@lesonline.com', '$2y$12$/tE9SJmFJVl1ydE4nGFTLe6RIaHyndKH.dEisVjGUCcfDLDe/PRpC', 'guru', '2026-05-05 03:36:34', NULL),
(11, 'Gani Pratama', 'gani.siswa@email.com', '$2y$12$12X7pZT3XZb.XyQK3gcyWuskZ59kH3eq0mIEVgzwDDyWMLBeC10nm', 'siswa', '2026-05-05 03:36:34', NULL),
(12, 'Hana Zaskia', 'hana.siswa@email.com', '$2y$12$Yt5Cxvplr.Uj0s5bTtRXGuhGBaLL3pUXRfMqA3qfVE5ShBAltalnK', 'siswa', '2026-05-05 03:36:34', NULL),
(13, 'Indra Wijaya', 'indra.siswa@email.com', '$2y$12$Qy.tOA6H86lUWe0.c6Shl.12W0SsbpEQetN3Oo2qB.wqfvTWicjMm', 'siswa', '2026-05-05 03:36:34', NULL),
(14, 'Jihan Putri', 'jihan.siswa@email.com', '$2y$12$yBES73eGddABn0nsE0ProeNYDBW9ifsA6abFYYr6XgGomxXr40EG.', 'siswa', '2026-05-05 03:36:34', NULL),
(15, 'Kevin Sanjaya', 'kevin.siswa@email.com', '$2y$12$NYJl5xxsSQLFsdxd3zMZyOT/gz7yhORjAkTeLF4/CxEK1tTuwLD8q', 'siswa', '2026-05-05 03:36:34', NULL),
(16, 'Lestari Mama', 'lestari.ortu@email.com', '$2y$12$wYCJjfU42336irvG6h6pi.bSgLwCHvD0Q/E/jMBTdnoacgJ.laA7.', 'orang tua', '2026-05-05 03:36:34', NULL),
(17, 'Mulyono Papa', 'mulyono.ortu@email.com', '$2y$12$2qStjUcsYORJf7gqUDRsV.CpZJFdfdzaoArN6tTLVIYkZm8zJNJPW', 'orang tua', '2026-05-05 03:36:34', NULL),
(18, 'Nina Bunda', 'nina.ortu@email.com', '$2y$12$RRYuJeBmPmzng5hoJbrgX.mG2/KSRu/pVbr2Lf5y.cEJE3qKS6F6m', 'orang tua', '2026-05-05 03:36:34', NULL),
(19, 'Oman Ayah', 'oman.ortu@email.com', '$2y$12$tqv1SOp4BmPkZAkAaMkQLu0uqh3Cbp2kn9PhVdehqJDcvTDS3q4EG', 'orang tua', '2026-05-05 03:36:34', NULL),
(20, 'Puji Ibu', 'puji.ortu@email.com', '$2y$12$eA0zwomF2luDoKWF1ZJLFuSoOXZKSXairFj62YLM5UVilXSX/lu1C', 'orang tua', '2026-05-05 03:36:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id_videos` int(11) NOT NULL,
  `id_paket` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` int(11) NOT NULL,
  `kode_voucher` varchar(50) DEFAULT NULL,
  `potongan` decimal(10,2) DEFAULT NULL,
  `tanggal_berakhir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id_voucher`, `kode_voucher`, `potongan`, `tanggal_berakhir`) VALUES
(1, 'PINTARMTK', 25000.00, '2026-12-31'),
(2, 'SIAPUTBK', 75000.00, '2026-06-30'),
(3, 'JUARAKELAS', 40000.00, '2026-05-20'),
(4, 'DISKONMABA', 100000.00, '2026-08-15'),
(5, 'LESHEMAT', 15000.00, '2026-12-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id_exam`);

--
-- Indexes for table `exam_scores`
--
ALTER TABLE `exam_scores`
  ADD PRIMARY KEY (`id_nilai_ujian`),
  ADD KEY `id_exam` (`id_exam`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`id_jenjang`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_major`),
  ADD KEY `id_university` (`id_university`);

--
-- Indexes for table `paket_pembelajaran`
--
ALTER TABLE `paket_pembelajaran`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_voucher` (`id_voucher`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`id_university`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_user_jenjang` (`id_jenjang`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id_videos`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`),
  ADD UNIQUE KEY `kode_voucher` (`kode_voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id_exam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_scores`
--
ALTER TABLE `exam_scores`
  MODIFY `id_nilai_ujian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `id_jenjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_major` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `paket_pembelajaran`
--
ALTER TABLE `paket_pembelajaran`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `id_university` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id_videos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_scores`
--
ALTER TABLE `exam_scores`
  ADD CONSTRAINT `exam_scores_ibfk_1` FOREIGN KEY (`id_exam`) REFERENCES `exam` (`id_exam`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_scores_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`id_university`) REFERENCES `university` (`id_university`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_voucher`) REFERENCES `voucher` (`id_voucher`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_jenjang` FOREIGN KEY (`id_jenjang`) REFERENCES `jenjang` (`id_jenjang`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket_pembelajaran` (`id_paket`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
