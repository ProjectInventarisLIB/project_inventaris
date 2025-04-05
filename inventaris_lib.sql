-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Apr 2025 pada 10.56
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
-- Database: `inventaris_lib`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `ID_admin` varchar(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `sandi_admin` varchar(255) NOT NULL,
  `ID_super_admin` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`ID_admin`, `nama_admin`, `email_admin`, `sandi_admin`, `ID_super_admin`) VALUES
('a01', 'Admin', 'admin@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'sa01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_utama`
--

CREATE TABLE `admin_utama` (
  `ID_admin_utama` varchar(11) NOT NULL,
  `nama_admin_utama` varchar(50) NOT NULL,
  `email_admin_utama` varchar(255) NOT NULL,
  `sandi_admin_utama` varchar(255) NOT NULL,
  `ID_admin` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_utama`
--

INSERT INTO `admin_utama` (`ID_admin_utama`, `nama_admin_utama`, `email_admin_utama`, `sandi_admin_utama`, `ID_admin`) VALUES
('sa01', 'Admin Utama', 'superadmin@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'a01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `ID_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_barang` varchar(255) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `ukuran` varchar(30) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `dana_final` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`ID_barang`, `nama_barang`, `jumlah_barang`, `satuan`, `ukuran`, `gambar`, `tanggal`, `dana_final`) VALUES
('25BRG001', 'Kertas HVS ', '10', 'rim', 'A4 75 gsm', 'hvs.jpg', '2025-04-12', 432000),
('25BRG002', 'Baut & Mur ', '11', 'pc', 'M19 x 50mm Baja A325', 'baut.jpg', '2025-04-07', 143286),
('25BRG003', 'Solar', '9980', 'liter', 'cair', 'default_barang.jpg', '2025-04-04', 230000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_pengadaan`
--

CREATE TABLE `barang_pengadaan` (
  `ID_barang` varchar(11) NOT NULL,
  `no_surat` varchar(250) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `deskripsi` varchar(300) NOT NULL,
  `jumlah_diperlukan` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `dana_final` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_pengadaan`
--

INSERT INTO `barang_pengadaan` (`ID_barang`, `no_surat`, `tanggal`, `nama_barang`, `deskripsi`, `jumlah_diperlukan`, `satuan`, `dana_final`) VALUES
('BRGPGDN001', '002/LIB-Ajukan/IV/2025', '2025-04-12', 'Tali Tambang ', '50 Mm', 3, 'meter', 300000),
('BRGPGDN002', '005/LIB-Ajukan/IV/2025', '2025-04-05', 'Kipas Angin', 'Cosmos 16-XDC', 1, 'pcs', 213000),
('BRGPGDN003', '006/LIB-Ajukan/IV/2025', '2025-04-05', 'Amplop Coklat', ' Super Kabinet', 1, 'pack', 87000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_pengambilan`
--

CREATE TABLE `barang_pengambilan` (
  `ID_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_diambil` int(11) NOT NULL,
  `no_surat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_pengambilan`
--

INSERT INTO `barang_pengambilan` (`ID_barang`, `nama_barang`, `tanggal`, `jumlah_diambil`, `no_surat`) VALUES
('25BRG003', 'Solar', '2025-04-12', 20, '003/LIB-Ambil/IV/2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staf`
--

CREATE TABLE `staf` (
  `ID_staf` varchar(11) NOT NULL,
  `email_staf` varchar(255) NOT NULL,
  `sandi_staf` varchar(255) NOT NULL,
  `nama_staf` varchar(30) NOT NULL,
  `anggaran` int(30) NOT NULL,
  `pengeluaran_anggaran` int(30) NOT NULL,
  `periode_anggaran` varchar(100) NOT NULL,
  `ID_admin` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `staf`
--

INSERT INTO `staf` (`ID_staf`, `email_staf`, `sandi_staf`, `nama_staf`, `anggaran`, `pengeluaran_anggaran`, `periode_anggaran`, `ID_admin`) VALUES
('s01', 'stafgudang@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Staf Gudang', 80000000, 300000, '2024/2025', 'a01'),
('s02', 'stafitsupport@gmail.com', '7b569eacfdec67064506c43b931fed2e9ee6edf9e9c1240005f9ad1e0fc37cc9', 'Staf IT Support', 9000000, 0, '2024/2025', 'a01'),
('s03', 'stafkeuangan@gmail.com', '35a9e381b1a27567549b5f8a6f783c167ebf809f1c4d6a9e367240484d8ce281', 'Staf Keuangan', 600000, 300000, '2024/2025', 'a01'),
('s04', 'stafoperasional@gmail.com', 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae', 'Staf Operasional', 10000000, 0, '2024/2025', 'a01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_pengadaan`
--

CREATE TABLE `surat_pengadaan` (
  `no_surat` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `deskripsi` varchar(300) NOT NULL,
  `tujuan` varchar(300) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `anggaran` int(11) NOT NULL,
  `link_surat` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `ID_staf` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_pengadaan`
--

INSERT INTO `surat_pengadaan` (`no_surat`, `tanggal`, `nama_barang`, `deskripsi`, `tujuan`, `jumlah`, `satuan`, `anggaran`, `link_surat`, `status`, `ID_staf`) VALUES
('001/LIB-Ajukan/IV/2025', '2025-04-11', 'Jangkar Kapal', '50 kg', 'menambatkan kapal', 1, 'pcs', 750000, '/project_inventaris/upload/surat_pengadaan/surat_1743831403.pdf', 'Diproses', 's01'),
('002/LIB-Ajukan/IV/2025', '2025-04-12', 'Tali Tambang ', '50 Mm', 'mengikat dan mengamankan kapal', 3, 'meter', 290000, '/project_inventaris/upload/surat_pengadaan/surat_1743831552.pdf', 'Selesai', 's01'),
('003/LIB-Ajukan/IV/2025', '2025-04-11', 'smarthband', 'huawei', 'smarthband saya rusak', 1, 'pcs', 500000, '/project_inventaris/upload/surat_pengadaan/surat_1743831920.pdf', 'Ditolak', 's03'),
('004/LIB-Ajukan/IV/2025', '2025-04-11', 'Stapler Besar', 'HD-30', 'mempermudah pembukuan', 1, 'pcs', 27000, '/project_inventaris/upload/surat_pengadaan/surat_1743832064.pdf', 'Disetujui', 's03'),
('005/LIB-Ajukan/IV/2025', '2025-04-12', 'Kipas Angin', 'Cosmos 16-XDC', 'pendingin udara kantor', 1, 'pcs', 213000, '/project_inventaris/upload/surat_pengadaan/surat_1743832186.pdf', 'Selesai', 's03'),
('006/LIB-Ajukan/IV/2025', '2025-04-11', 'Amplop Coklat', ' Super Kabinet', 'membungkus surat penting', 1, 'pack', 27000, '/project_inventaris/upload/surat_pengadaan/surat_1743835644.pdf', 'Selesai', 's03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_pengambilan`
--

CREATE TABLE `surat_pengambilan` (
  `no_surat` varchar(250) NOT NULL,
  `tanggal` date NOT NULL,
  `ID_barang` varchar(250) NOT NULL,
  `nama_barang` varchar(400) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tujuan` varchar(300) NOT NULL,
  `link_surat` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `ID_staf` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_pengambilan`
--

INSERT INTO `surat_pengambilan` (`no_surat`, `tanggal`, `ID_barang`, `nama_barang`, `jumlah`, `tujuan`, `link_surat`, `status`, `ID_staf`) VALUES
('001/LIB-Ambil/IV/2025', '2025-04-12', '25BRG001', 'Kertas HVS ', 1, 'pendataan seluruh penyuratan', '/project_inventaris/upload/surat_pengambilan/pengambilan_1743830885.pdf', 'Diproses', 's01'),
('002/LIB-Ambil/IV/2025', '2025-04-05', '25BRG002', 'Baut & Mur ', 4, 'mengikat berbagai komponen kapal, seperti tali, rantai, dan peralatan lainnya', '/project_inventaris/upload/surat_pengambilan/pengambilan_1743830915.pdf', 'Diproses', 's01'),
('003/LIB-Ambil/IV/2025', '2025-04-05', '25BRG003', 'Solar', 20, 'bahan bakar kapal tongkang', '/project_inventaris/upload/surat_pengambilan/pengambilan_1743831056.pdf', 'Selesai', 's01'),
('004/LIB-Ambil/IV/2025', '2025-04-10', '25BRG002', 'Baut & Mur ', 1, 'perbaikan kapal', '/project_inventaris/upload/surat_pengambilan/pengambilan_1743831773.pdf', 'Diproses', 's03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
