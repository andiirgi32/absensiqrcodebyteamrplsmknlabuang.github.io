-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Mar 2024 pada 10.31
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id`, `nis`, `tanggal`, `waktu`, `keterangan`) VALUES
(112, 220170, '2024-02-28', '13:05:21', ''),
(113, 210187, '2024-02-29', '06:56:05', 'Tepat Waktu'),
(114, 210389, '2024-02-27', '13:10:04', ''),
(115, 520901, '2024-02-29', '13:55:40', ''),
(117, 210188, '2024-02-29', '22:58:38', 'Terlambat'),
(118, 210200, '2024-02-29', '02:22:12', 'Absen Cepat'),
(120, 520901, '2024-03-01', '02:26:57', 'Absen Cepat'),
(123, 210187, '2024-03-01', '07:26:40', 'Tepat Waktu'),
(124, 210188, '2024-03-01', '07:27:19', 'Tepat Waktu'),
(125, 210200, '2024-03-01', '07:27:55', 'Tepat Waktu'),
(129, 210193, '2024-03-01', '13:25:37', 'Terlambat'),
(130, 123456, '2024-03-01', '13:31:01', 'Terlambat'),
(131, 210389, '2024-03-01', '22:38:31', 'Terlambat'),
(132, 210187, '2024-03-02', '06:30:32', 'Tepat Waktu'),
(133, 210205, '2024-03-02', '06:30:46', 'Tepat Waktu'),
(134, 210389, '2024-03-02', '06:30:56', 'Tepat Waktu'),
(135, 210193, '2024-03-02', '08:08:29', 'Terlambat'),
(136, 210200, '2024-03-02', '08:08:40', 'Terlambat'),
(137, 210188, '2024-03-02', '08:08:56', 'Terlambat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `jurusanid` int(11) NOT NULL,
  `namajurusan` varchar(255) NOT NULL,
  `kepanjangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`jurusanid`, `namajurusan`, `kepanjangan`) VALUES
(1, 'RPL', 'Rekayasa Perangkat Lunak'),
(2, 'TKJ', 'Teknik Komputer dan Jaringan'),
(4, 'PPLG', 'Pemrograman Perangkat Lunak dan Gim'),
(5, 'TAV', 'Teknik Audio dan Video'),
(6, 'PPLG', 'Pengembangan Perangkat Lunak dan Gim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `kelasid` int(11) NOT NULL,
  `namakelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kelasid`, `namakelas`) VALUES
(1, 'XII RPL'),
(3, 'XI RPL'),
(4, 'XII TJKT A'),
(5, 'XII TAV'),
(10, 'XII DKV'),
(11, 'X PPLG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `idsiswa` int(11) NOT NULL,
  `nis` int(33) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `fotosiswa` varchar(255) NOT NULL,
  `kelasid` int(11) NOT NULL,
  `jurusanid` int(11) NOT NULL,
  `jk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`idsiswa`, `nis`, `nama`, `fotosiswa`, `kelasid`, `jurusanid`, `jk`) VALUES
(15, 210187, 'A. Irgi Irwan. A', '1315121202_irgi.png', 1, 1, 'Laki-Laki'),
(16, 210389, 'Abdul Wahab S.T', '1613735594_Gambar WhatsApp 2024-02-28 pukul 14.48.52_2ae08e11.jpg', 4, 2, 'Laki-Laki'),
(17, 210200, 'Nurul Asya Azzahra', '2058467753_IMG_6109.png', 1, 1, 'Perempuan'),
(18, 220170, 'Taufik', '397188041_Gambar WhatsApp 2024-02-24 pukul 16.16.03_91c5d344.jpg', 3, 1, 'Laki-Laki'),
(19, 520901, 'Dian Bahari', '51459794_Gambar WhatsApp 2024-02-28 pukul 16.23.08_ee6f6d10.jpg', 3, 1, 'Perempuan'),
(20, 210188, 'Adham Zaquan Kamaruddin', '1916202020_Gambar WhatsApp 2024-02-29 pukul 09.11.42_c1dd789c.jpg', 1, 1, 'Laki-Laki'),
(21, 210205, 'Taufik', '2115226298_sdfsdfsf.png', 1, 1, 'Laki-Laki'),
(22, 210193, 'Depri', '457368012_SDGSDGGGG.png', 1, 1, 'Laki-Laki'),
(23, 210199, 'Nurmayanti', '138751257_IMG-20230705-WA0053.jpg', 1, 1, 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `kelasid` int(11) NOT NULL,
  `jurusanid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `namalengkap`, `alamat`, `foto`, `role`, `kelasid`, `jurusanid`) VALUES
(24, 'user1', '1', 'user1@gmail.com', 'Luke', '...', '559469516_1666609731515.jpg', 'Admin', 0, 0),
(32, 'darwis', '123', 'darwis@gmail.com', 'Darwis, S.S., M. Pd.', '...', '2042838593_4636.jpg', 'Kepala Sekolah', 0, 0),
(33, 'wahab', '123', 'wahab@gmail.com', 'Abdul Wahab S.T', 'Desa Suruang', '1406930735_Gambar WhatsApp 2024-02-28 pukul 14.48.52_2ae08e11.jpg', 'Wali Kelas', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`jurusanid`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelasid`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`idsiswa`),
  ADD KEY `jurusanid` (`jurusanid`),
  ADD KEY `kelasid` (`kelasid`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `kelasid` (`kelasid`,`jurusanid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `jurusanid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelasid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `idsiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`jurusanid`) REFERENCES `jurusan` (`jurusanid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kelasid`) REFERENCES `kelas` (`kelasid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
