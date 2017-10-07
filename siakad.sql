-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2017 at 03:25 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bukti_pembayaran`
--

CREATE TABLE `bukti_pembayaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_registrasi` int(10) UNSIGNED NOT NULL,
  `tanggal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` bigint(20) NOT NULL,
  `pemilik_norek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukti_pembayaran`
--

INSERT INTO `bukti_pembayaran` (`id`, `id_registrasi`, `tanggal`, `bank`, `jumlah`, `pemilik_norek`) VALUES
(2, 3, '2017-09-30', 'Mandiri', 2147483647, 'sdasdadsad');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `config` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`config`, `value`) VALUES
('status_reg', 'Tidak Aktif'),
('tahun_ajar', '1516/2');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `kode_dosen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dosen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`kode_dosen`, `nama_dosen`, `fakultas`, `status`, `username`, `password`) VALUES
('AAA', 'Alan Ardi A', 'Informatika', 'Tetap', 'aaa', 'aaa'),
('ABC', 'Adi budi Cantika', 'Manajemen', 'Tetap', 'abc', 'abc'),
('ARK', 'Artur Rudi', 'Manjemen', 'Tetap', 'ark', 'ark'),
('REZ', 'Reza Aditama', 'Industri Kreatif', 'Tetap', 'rez', 'rez'),
('ZZZ', 'Zulaiha', 'Informatika', 'Tetap', 'zzz', 'zzz');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_dosen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_matkul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `kode_dosen`, `kode_matkul`, `kode_kelas`, `hari`, `jam`, `ruangan`, `semester`) VALUES
(2, 'AAA', 'PBO', 'IF-39-10', 'Selasa', '09.30 - 12.30', 'E302', '1516/2'),
(3, 'REZ', 'PBO', 'IF-39-10', 'Selasa', '12.30 - 15.30', 'B105', '1516/2'),
(4, 'AAA', 'DAP', 'DS-39-04', 'Senin', '09.30 - 12.30', 'E301', '1617/2'),
(5, 'ABC', 'DAP', 'IF-39-10', 'Senin', '06.30 - 09.30', 'E302', '1516/2'),
(6, 'ZZZ', 'PBO', 'IF-39-10', 'Senin', '15.30 - 18.30', 'E301', '1516/2'),
(7, 'REZ', 'DAP', 'IF-39-10', 'Jumat', '09.30 - 12.30', 'A307', '1516/2');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doswal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `fakultas`, `prodi`, `doswal`) VALUES
('DS-39-04', 'Industri Kreatif', 'S1 Desain Komunikasi Visual', 'REZ'),
('IF-39-10', 'Informatika', 'S1 Teknik Informatika', 'AAA'),
('MB-40-09', 'Manajemen', 'S1 Manajemen', 'ZZZ');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(11) NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_masuk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `fakultas`, `prodi`, `kelas`, `tahun_masuk`, `username`, `password`) VALUES
(111, 'Adam Budi', 'Informatika', 'S1 Teknik Informatika', 'IF-39-10', '2015', '111', '111'),
(222, 'Rahayu', 'Informatika', 'S1 Teknik Informatika', 'MB-40-09', '2014', '222', '222');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `kode_matkul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_matkul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks` int(11) NOT NULL,
  `fakultas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`kode_matkul`, `nama_matkul`, `sks`, `fakultas`) VALUES
('DAP', 'Dasar Algoritma dan Pemograman', 3, 'Informatika'),
('MPB', 'Manajemen Pemasaran Bisnis', 2, 'Manajemen'),
('NIR', 'Nirmana', 4, 'Industri Kreatif'),
('PBO', 'Pemograman Berorientasi Objek', 3, 'Informatika'),
('STD', 'Struktur Data', 3, 'Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_09_27_020734_create_dosen_table', 1),
(4, '2017_09_27_022034_create_matkul_table', 1),
(5, '2017_09_27_022307_create_admin_table', 1),
(6, '2017_09_27_022404_create_mahasiswa_table', 1),
(7, '2017_09_27_022548_create_paycheck_table', 1),
(8, '2017_09_27_022718_create_config_table', 1),
(9, '2017_09_27_023616_create_kelas_table', 1),
(10, '2017_09_27_023737_create_jadwal_table', 1),
(11, '2017_09_27_024431_create_registrasi_table', 1),
(12, '2017_09_27_025043_create_nilai_table', 1),
(13, '2017_09_27_025310_create_reg_matkul_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jadwal` int(10) UNSIGNED NOT NULL,
  `nim` int(11) NOT NULL,
  `kuis` int(11) NOT NULL,
  `uts` int(11) NOT NULL,
  `uas` int(11) NOT NULL,
  `indeks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paycheck`
--

CREATE TABLE `paycheck` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paycheck`
--

INSERT INTO `paycheck` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Payment Checker', 'paycheck', 'paycheck');

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` int(11) NOT NULL,
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagihan` bigint(20) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`id`, `nim`, `semester`, `tagihan`, `status`) VALUES
(1, 111, '1516/1', 4500000, 'Lunas'),
(3, 111, '1516/2', 5000000, 'Lunas'),
(6, 222, '1617/2', 8500000, 'Lunas'),
(7, 111, '1617/2', 80000000, 'Belum Lunas'),
(8, 222, '1617/1', 45000000, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `reg_matkul`
--

CREATE TABLE `reg_matkul` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` int(11) NOT NULL,
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reg_matkul_jadwal`
--

CREATE TABLE `reg_matkul_jadwal` (
  `id_reg_matkul` int(10) UNSIGNED NOT NULL,
  `id_jadwal` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fakhri Fauzan', 'fazan697@gmail.com', '$2y$10$SkMnH9.WLJOSrZiXoECciexJsHn3XOzQnmkQvUjYPijG6vl9wZprO', NULL, '2017-09-26 21:03:26', '2017-09-26 21:03:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username_unique` (`username`);

--
-- Indexes for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bukti_pembayaran_id_registrasi_foreign` (`id_registrasi`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`config`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`kode_dosen`),
  ADD UNIQUE KEY `dosen_username_unique` (`username`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_kode_dosen_foreign` (`kode_dosen`),
  ADD KEY `jadwal_kode_matkul_foreign` (`kode_matkul`),
  ADD KEY `jadwal_kode_kelas_foreign` (`kode_kelas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kode_kelas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD UNIQUE KEY `mahasiswa_username_unique` (`username`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`kode_matkul`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_id_jadwal_foreign` (`id_jadwal`),
  ADD KEY `nilai_nim_foreign` (`nim`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paycheck`
--
ALTER TABLE `paycheck`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paycheck_username_unique` (`username`);

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registrasi_nim_foreign` (`nim`);

--
-- Indexes for table `reg_matkul`
--
ALTER TABLE `reg_matkul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reg_matkul_nim_foreign` (`nim`);

--
-- Indexes for table `reg_matkul_jadwal`
--
ALTER TABLE `reg_matkul_jadwal`
  ADD PRIMARY KEY (`id_reg_matkul`,`id_jadwal`),
  ADD KEY `reg_matkul_jadwal_id_jadwal_foreign` (`id_jadwal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paycheck`
--
ALTER TABLE `paycheck`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `reg_matkul`
--
ALTER TABLE `reg_matkul`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD CONSTRAINT `bukti_pembayaran_id_registrasi_foreign` FOREIGN KEY (`id_registrasi`) REFERENCES `registrasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_kode_dosen_foreign` FOREIGN KEY (`kode_dosen`) REFERENCES `dosen` (`kode_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_kode_kelas_foreign` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_kode_matkul_foreign` FOREIGN KEY (`kode_matkul`) REFERENCES `matkul` (`kode_matkul`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD CONSTRAINT `registrasi_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reg_matkul`
--
ALTER TABLE `reg_matkul`
  ADD CONSTRAINT `reg_matkul_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reg_matkul_jadwal`
--
ALTER TABLE `reg_matkul_jadwal`
  ADD CONSTRAINT `reg_matkul_jadwal_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reg_matkul_jadwal_id_reg_matkul_foreign` FOREIGN KEY (`id_reg_matkul`) REFERENCES `reg_matkul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
