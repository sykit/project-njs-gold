-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 25 Nov 2023 pada 05.09
-- Versi server: 8.0.35-0ubuntu0.20.04.1
-- Versi PHP: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_scm_njs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity`
--

CREATE TABLE `activity` (
  `activity_id` int NOT NULL,
  `activity_name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `activity_code` varchar(64) NOT NULL,
  `activity_category` int NOT NULL COMMENT '1.administration, 2.product_catalog, 3.scm',
  `routes` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `activity`
--

INSERT INTO `activity` (`activity_id`, `activity_name`, `activity_code`, `activity_category`, `routes`) VALUES
(1, 'Surat Order Marketing', 'som', 3, 'manage/som'),
(2, 'Product Listing', 'pl', 2, 'manage/product/list'),
(3, 'Product Category Management', 'pcategm', 2, 'manage/product/category'),
(4, 'Product Sub Category Management', 'pscm', 2, 'manage/product/subcategory'),
(5, 'Product Catalog Management', 'pcatam', 2, 'manage/product'),
(6, 'User Management', 'um', 1, 'manage/users'),
(7, 'Functional Group', 'fg', 1, '/manage/fgroup');

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_chain`
--

CREATE TABLE `activity_chain` (
  `activity_id` int NOT NULL,
  `prev_activity` int DEFAULT '0',
  `next_activity` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `activity_chain`
--

INSERT INTO `activity_chain` (`activity_id`, `prev_activity`, `next_activity`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 0, 0),
(4, 0, 0),
(5, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_group`
--

CREATE TABLE `activity_group` (
  `activity_group_id` int NOT NULL,
  `group_name` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `activity_group`
--

INSERT INTO `activity_group` (`activity_group_id`, `group_name`) VALUES
(1, 'Procurement'),
(2, 'Production'),
(3, 'Distribution'),
(4, 'Dealer Sales & Consigment'),
(5, 'Retail & Corporate Sales'),
(6, 'Other Transaction');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cluster`
--

CREATE TABLE `cluster` (
  `cluster_id` int NOT NULL,
  `sales_area_id` int DEFAULT NULL,
  `cluster_name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cluster`
--

INSERT INTO `cluster` (`cluster_id`, `sales_area_id`, `cluster_name`) VALUES
(1, 1, 'Bali'),
(2, 2, 'Yogyakarta'),
(3, 3, 'Bogor'),
(4, 3, 'Cikarang'),
(5, 3, 'Jakarta'),
(6, 3, 'Tangerang'),
(7, 4, 'Bandung'),
(8, 4, 'Cirebon'),
(9, 4, 'Kuningan'),
(10, 4, 'Subang'),
(11, 4, 'Sukabumi'),
(12, 4, 'Tasikmalaya'),
(13, 4, 'Garut'),
(14, 3, 'Depok'),
(15, 5, 'Boyolali'),
(16, 5, 'Jepara'),
(17, 5, 'Klaten'),
(18, 5, 'Kudus'),
(19, 5, 'Magelang'),
(20, 5, 'Pemalang'),
(21, 5, 'Purwokerto'),
(22, 5, 'Purworejo'),
(23, 5, 'Semarang'),
(24, 5, 'Solo'),
(25, 5, 'Tegal'),
(26, 5, 'Weleri'),
(27, 6, 'Banyuwangi'),
(28, 6, 'Blitar'),
(29, 6, 'Bojonegoro'),
(30, 6, 'Genteng'),
(31, 6, 'Jember'),
(32, 6, 'Kediri'),
(33, 6, 'Madiun'),
(34, 6, 'Nganjuk'),
(35, 6, 'Pamekasan'),
(36, 6, 'Probolinggo'),
(37, 6, 'Surabaya'),
(38, 7, 'Balikpapan'),
(39, 7, 'Banjarmasin'),
(40, 7, 'Pontianak'),
(41, 7, 'Samarinda'),
(42, 7, 'Tarakan'),
(43, 8, 'Mataram'),
(44, 8, 'NTB'),
(45, 9, 'Bangkalan'),
(46, 9, 'Pamekasan'),
(47, 9, 'Sampang'),
(48, 10, 'Makassar'),
(49, 10, 'Pare-pare'),
(50, 11, 'Batam'),
(51, 11, 'Lampung'),
(52, 11, 'Medan'),
(53, 11, 'Pekanbaru'),
(54, 12, 'Head Office');

-- --------------------------------------------------------

--
-- Struktur dari tabel `company`
--

CREATE TABLE `company` (
  `company_id` int NOT NULL,
  `company_type_id` int NOT NULL,
  `sales_area_id` int DEFAULT NULL,
  `cluster_id` int DEFAULT NULL,
  `company_name` varchar(64) NOT NULL,
  `company_code` varchar(12) NOT NULL,
  `is_internal` char(1) NOT NULL,
  `root_parent` int DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `company_address` text,
  `company_country` int DEFAULT NULL,
  `company_province` int DEFAULT NULL,
  `company_city` int DEFAULT NULL,
  `company_zipcode` text,
  `company_phone` text,
  `company_email` text,
  `company_owner_name` text,
  `company_owner_phone` text,
  `longitude` text,
  `latitude` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `company`
--

INSERT INTO `company` (`company_id`, `company_type_id`, `sales_area_id`, `cluster_id`, `company_name`, `company_code`, `is_internal`, `root_parent`, `parent`, `company_address`, `company_country`, `company_province`, `company_city`, `company_zipcode`, `company_phone`, `company_email`, `company_owner_name`, `company_owner_phone`, `longitude`, `latitude`) VALUES
(1, 1, 12, 54, 'PT Nafiri Jaffa Sentosa', 'NJS', '1', 0, 0, ' Jl. Berbek Industri II No.14, Berbek Industri, Berbek, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 3, 1, 1, 'Nyoman', 'NYO', '0', 1, 0, 'Jl. Hasanudin 49A , Denpasar ( Toko Nyoman Jewelery)', NULL, NULL, NULL, NULL, '081338424608', NULL, 'Ko Nyoman', NULL, NULL, NULL),
(3, 2, 1, 1, 'Melati', 'MLT', '0', 1, 0, 'Jl. Hasanudin No 49 & 61 Denpaasar', NULL, NULL, NULL, NULL, '08113977786', NULL, 'Jessica', NULL, NULL, NULL),
(4, 3, 3, 3, 'Amen Bogor								', 'AMB', '0', 1, 0, 'Jl.Dr.Semeru No. 18 ( Belakang Ruko Bee Laundry, Bogor Tengah) Bogor 16112             ', NULL, NULL, NULL, NULL, '085959998081	', NULL, 'Ce Ika							', NULL, NULL, NULL),
(5, 4, 3, 4, 'Subur Subaru 						', 'SBC', '0', 1, 0, 'Tk Mas Subaru Sentra Grosir Cikarang Lt.Ground Zona Biru No.35-37 (Dpn Resto Aw)       ', NULL, NULL, NULL, NULL, '081210999837	', NULL, 'Ko Yoko						', NULL, NULL, NULL),
(6, 3, 3, 5, 'Roberto									', 'RRJ', '0', 1, 0, 'Pluit Karang Indah 2, Blok V8 Utara No: 71, Jakarta Utara                              ', NULL, NULL, NULL, NULL, '08129678878	', NULL, 'Ko Roberto					', NULL, NULL, NULL),
(7, 2, 3, 5, 'Bintang Mas							', 'BMJ', '0', 1, 0, 'Jl. Kayu Putih Tengah 1A No. 19 Jakarta Timur                                          ', NULL, NULL, NULL, NULL, '081586762781	', NULL, 'Ce Ling Ling				', NULL, NULL, NULL),
(8, 2, 3, 5, 'De Gold									', 'DEJ', '0', 1, 0, 'Green Ville Blok Al No. 17 Jakarta Barat                                               ', NULL, NULL, NULL, NULL, '081586420850	', NULL, 'Ibu Esther					', NULL, NULL, NULL),
(9, 3, 3, 5, 'Ko Gery 									', 'GRJ', '0', 1, 0, 'Jln. Janur Kuning 8, Blok Wn 2, No: 10, Kelapa Gading-Jakarta Utara 14240              ', NULL, NULL, NULL, NULL, '0817243761		', NULL, 'Ko Gery						', NULL, NULL, NULL),
(10, 3, 3, 5, 'Suk Muin									', 'MUJ', '0', 1, 0, 'Jl Kebon Jeruk Ii 19 Rt 003/02, Taman Sari, West Jakarta                               ', NULL, NULL, NULL, NULL, '085777379999	', NULL, 'Suk Muin						', NULL, NULL, NULL),
(11, 3, 3, 5, 'Asun											', 'ASJ', '0', 1, 0, 'Jl. Dr. Susilo 3 No. 41, Grogol, Jakarta Barat.                                        ', NULL, NULL, NULL, NULL, '0816792828		', NULL, 'Ko Asun						', NULL, NULL, NULL),
(12, 3, 3, 5, 'Alung										', 'APJ', '0', 1, 0, 'Jl. Katamaran Indah 11, Kapuk Muara, Penjaringan, Jakut. (Pik)                         ', NULL, NULL, NULL, NULL, '08161114468	', NULL, 'Ko Alung						', NULL, NULL, NULL),
(13, 3, 3, 5, 'Ajan											', 'AJJ', '0', 1, 0, 'Jl. Mardani Raya Gg R No 19R, Rt13 Rw 05, Johar Baru, Jakarta.                         ', NULL, NULL, NULL, NULL, '081291673917	', NULL, 'Ci Ajan						', NULL, NULL, NULL),
(14, 3, 3, 5, 'Luxury Serpong						', 'LXS', '0', 1, 0, 'Jl. Kresek Raya Perum. Green Puri Blok 2 No 16. Semanan. Kalideres. Jakarta Barat 11850', NULL, NULL, NULL, NULL, '081295953988	', NULL, 'Andri							', NULL, NULL, NULL),
(15, 3, 4, 11, 'Anugrah Sukabumi					', 'ANS', '0', 1, 0, 'Perum. Royal Kabandungan, Sukabumi					                                           ', NULL, NULL, NULL, NULL, '082114203799	', NULL, 'Ko Alung						', NULL, NULL, NULL),
(16, 3, 3, 6, 'Sri Rejeki Handal				', 'SRH', '0', 1, 0, 'Jl. Daan Mogot Km 21 Perum Batu Ceper Permai Blok O No.13 Tangerang                    ', NULL, NULL, NULL, NULL, '081618 50888	', NULL, 'Ko Amri						', NULL, NULL, NULL),
(17, 4, 3, 6, 'Permata Cikupa						', 'PTC', '0', 1, 0, 'Perum Citra Raya, Cluster Taman Raya Blok M12/17                                       ', NULL, NULL, NULL, NULL, '081911 019368', NULL, 'Mbak Yani					', NULL, NULL, NULL),
(18, 3, 2, 2, 'Bintang Sembilan Wonosari', 'BSW', '0', 1, 0, 'Jl. Brigjend Katamso No. 61 Wonosari Diy                                               ', NULL, NULL, NULL, NULL, '085728829999	', NULL, 'Mba Dina/Pak Faizal', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `company_type`
--

CREATE TABLE `company_type` (
  `company_type_id` bigint NOT NULL,
  `company_type_name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `Is_internal` varchar(1) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `company_type`
--

INSERT INTO `company_type` (`company_type_id`, `company_type_name`, `Is_internal`) VALUES
(1, 'PT NJS', '1'),
(2, 'Wholesaler', '0'),
(3, 'Second WS', '0'),
(4, 'Toko', '0'),
(5, 'Toko Mas', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `functional_group`
--

CREATE TABLE `functional_group` (
  `func_group_id` bigint NOT NULL,
  `func_group_name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` varchar(64) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `functional_group`
--

INSERT INTO `functional_group` (`func_group_id`, `func_group_name`, `created_at`) VALUES
(1, 'Administrator', '2023:11:05'),
(2, 'Presiden Direktur', '2023:11:05'),
(3, 'General Manager', '2023:11:05'),
(4, 'Manager Accounting', '2023:11:05'),
(5, 'Manager Marketing', '2023:11:05'),
(6, 'Manager Produksi', '2023:11:05'),
(7, 'Manager HRD', '2023:11:05'),
(8, 'Manager GA', '2023:11:05'),
(9, 'Asisten Manager Accounting', '2023:11:05'),
(10, 'Supervisor Keuangan', '2023:11:05'),
(11, 'Supervisor Marketing', '2023:11:05'),
(12, 'Supervisor Produksi', '2023:11:05'),
(13, 'Supervisor CMC', '2023:11:05'),
(14, 'Kabag CMC', '2023:11:05'),
(15, 'Kabag MTC', '2023:11:05'),
(16, 'Kabag Design', '2023:11:05'),
(17, 'Kabag Produksi', '2023:11:05'),
(18, 'Auditor', '2023:11:05'),
(19, 'Staff Accounting', '2023:11:05'),
(20, 'Staff Marketing', '2023:11:05'),
(21, 'Staff Produksi', '2023:11:05'),
(22, 'Staff Design', '2023:11:05'),
(23, 'Staff CMC', '2023:11:05'),
(24, 'Staff MTC', '2023:11:05'),
(25, 'Admin NJS', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_activity_map_detail`
--

CREATE TABLE `group_activity_map_detail` (
  `group_dtl_id` int NOT NULL,
  `group_hdr_id` int DEFAULT NULL,
  `func_group_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `group_activity_map_detail`
--

INSERT INTO `group_activity_map_detail` (`group_dtl_id`, `group_hdr_id`, `func_group_id`) VALUES
(1, 1, 20),
(2, 1, 11),
(3, 2, 1),
(4, 2, 2),
(5, 2, 3),
(6, 2, 4),
(7, 2, 5),
(8, 2, 6),
(9, 2, 7),
(10, 2, 8),
(11, 2, 9),
(12, 2, 10),
(13, 2, 11),
(14, 2, 12),
(15, 2, 13),
(16, 2, 14),
(17, 2, 15),
(18, 2, 16),
(19, 2, 17),
(20, 2, 18),
(21, 2, 19),
(22, 2, 20),
(23, 2, 21),
(24, 2, 22),
(25, 2, 23),
(26, 2, 24),
(27, 2, 25),
(28, 3, 1),
(29, 3, 25),
(30, 4, 1),
(31, 4, 25),
(32, 5, 1),
(33, 5, 25),
(34, 6, 1),
(35, 6, 25),
(36, 7, 1),
(37, 7, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_act_map_header`
--

CREATE TABLE `group_act_map_header` (
  `group_hdr_id` int NOT NULL,
  `activity_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `group_act_map_header`
--

INSERT INTO `group_act_map_header` (`group_hdr_id`, `activity_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` bigint NOT NULL,
  `product_category_name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` varchar(32) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `product_category_name`, `image`, `created_at`) VALUES
(1, 'Cincin', '008e26060b0727ada882ca4f552d62cb.jpg', ''),
(2, 'Anting', '66b2c1da29b8675446bdfca8017678b5.jpg', ''),
(3, 'Gelang', 'bec88e4e7bf4670674fee59d3a909fc3.jpg', ''),
(4, 'Giwang', 'bcdd3648bfada4a2f85ac1f2ce55b099.jpg', ''),
(5, 'Liontin', '39974c4abf9e82d1406c19d945ea5cfa.png', ''),
(6, 'Mainan Gelang', 'f49dc8e08b3f4d0092376e2c55e6b375.jpg', ''),
(7, 'Set', '8134051ddb019e2ba5fe745d801ee130.jpg', ''),
(10, 'Kalung', 'edf5e6ef486bab37d6450f09d33f366d.JPG', '2023-11-16 14:36:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_class`
--

CREATE TABLE `product_class` (
  `product_class_id` bigint NOT NULL,
  `product_class_name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `product_class_code` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `product_category_id` bigint NOT NULL,
  `prd_sub_cat_id` bigint NOT NULL,
  `prd_rate_id` bigint NOT NULL,
  `sepuh_id` int NOT NULL,
  `image` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(32) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_class`
--

INSERT INTO `product_class` (`product_class_id`, `product_class_name`, `product_class_code`, `product_category_id`, `prd_sub_cat_id`, `prd_rate_id`, `sepuh_id`, `image`, `created_at`, `updated_at`) VALUES
(39, 'CCS00857', 'CCS00857', 1, 1, 4, 33, 'c6a66748b7a0b1e02220f5228252cfd4.jpg', '2023-11-11 21:52:24', '2023-11-20 11:39:19'),
(41, 'CCS00860', 'CCS00860', 1, 1, 7, 0, 'CCS00860.jpg', '%2023-%11-%13 %17:%36:%03', '2023-11-16 09:33:21'),
(42, 'CCS00861', 'CCS00861', 1, 1, 6, 0, 'CCS00861.jpg', '%2023-%11-%13 %17:%40:%45', '2023-11-16 11:08:42'),
(43, 'CCS00863', 'CCS00863', 1, 1, 11, 0, 'CCS00863.jpg', '%2023-%11-%13 %17:%43:%03', '2023-11-16 09:33:36'),
(44, 'CCS00859', 'CCS00859', 1, 1, 6, 0, 'CCS00859.jpg', '%2023-%11-%13 %20:%34:%27', '2023-11-16 09:33:15'),
(45, 'CCS00865', 'CCS00865', 1, 1, 2, 0, 'CCS00865.jpg', '%2023-%11-%13 %20:%54:%04', '2023-11-16 11:09:34'),
(46, 'AKS00065', 'AKS00065', 2, 5, 12, 0, '68f8f8bf5628ca8da5f3a02dae7018a0.jpg', '%2023-%11-%13 %21:%01:%18', '2023-11-16 11:12:06'),
(47, 'AKS00066', 'AKS00066', 2, 5, 11, 0, 'AKS00066.jpg', '%2023-%11-%13 %21:%02:%41', '2023-11-16 11:12:14'),
(48, 'AKS00067', 'AKS00067', 2, 5, 7, 0, 'AKS00067.jpg', '%2023-%11-%13 %21:%08:%48', '2023-11-15 22:32:31'),
(49, 'AKS00068', 'AKS00068', 2, 5, 10, 0, 'AKS00068.jpg', '%2023-%11-%13 %21:%10:%09', '2023-11-16 09:32:59'),
(50, 'AKS00072', 'AKS00072', 2, 5, 6, 0, 'AKS00072.jpg', '%2023-%11-%13 %21:%15:%41', '2023-11-16 09:33:06'),
(51, 'ACA00001', 'ACA00001', 2, 6, 4, 0, 'ACA00001.jpg', '%2023-%11-%16 %15:%03:%51', '%2023-%11-%16 %15:%03:%51'),
(52, 'ACA00004', 'ACA00004', 2, 6, 4, 0, 'ACA00004.jpg', '%2023-%11-%16 %15:%05:%08', '%2023-%11-%16 %15:%05:%08'),
(53, 'ACA00006', 'ACA00006', 2, 6, 4, 0, 'ACA00006.jpg', '%2023-%11-%16 %15:%06:%36', '%2023-%11-%16 %15:%06:%36'),
(54, 'ACA00009', 'ACA00009', 2, 6, 4, 0, 'ACA00009.jpg', '%2023-%11-%16 %15:%07:%22', '%2023-%11-%16 %15:%07:%22'),
(55, 'ACA00010', 'ACA00010', 2, 6, 4, 0, 'ACA00010.jpg', '%2023-%11-%16 %15:%09:%19', '%2023-%11-%16 %15:%09:%19'),
(56, 'ACA00011', 'ACA00011', 2, 6, 4, 0, 'ACA00011.jpg', '%2023-%11-%16 %15:%10:%03', '%2023-%11-%16 %15:%10:%03'),
(57, 'ACA00012', 'ACA00012', 2, 6, 4, 0, 'ACA00012.jpg', '%2023-%11-%16 %15:%11:%00', '%2023-%11-%16 %15:%11:%00'),
(58, 'ACA00013', 'ACA00013', 2, 6, 4, 0, 'ACA00013.jpg', '%2023-%11-%16 %15:%11:%40', '2023-11-16 15:12:28'),
(59, 'ACE00004', 'ACE00004', 2, 6, 4, 0, 'ACE00004.jpg', '%2023-%11-%16 %15:%16:%01', '%2023-%11-%16 %15:%16:%01'),
(60, 'ACE00005', 'ACE00005', 2, 6, 4, 0, 'ACE00005.jpg', '%2023-%11-%16 %15:%16:%45', '%2023-%11-%16 %15:%16:%45'),
(61, 'ACE00006', 'ACE00006', 2, 6, 4, 0, 'ACE00006.jpg', '%2023-%11-%16 %15:%17:%39', '%2023-%11-%16 %15:%17:%39'),
(62, 'ACE00009', 'ACE00009', 2, 6, 4, 0, 'ACE00009.jpg', '%2023-%11-%16 %15:%19:%19', '%2023-%11-%16 %15:%19:%19'),
(63, 'ACE00011', 'ACE00011', 2, 6, 4, 0, 'ACE00011.jpg', '%2023-%11-%16 %15:%20:%10', '%2023-%11-%16 %15:%20:%10'),
(64, 'ACE00012', 'ACE00012', 2, 6, 4, 0, 'ACE00012.jpg', '%2023-%11-%16 %15:%20:%48', '%2023-%11-%16 %15:%20:%48'),
(65, 'ACE00014', 'ACE00014', 2, 6, 4, 0, 'ACE00014.jpg', '%2023-%11-%16 %15:%21:%43', '%2023-%11-%16 %15:%21:%43'),
(66, 'ACE00016', 'ACE00016', 2, 6, 4, 0, 'ACE00016.jpg', '%2023-%11-%16 %15:%24:%33', '%2023-%11-%16 %15:%24:%33'),
(68, 'ACE00017', 'ACE00017', 2, 6, 4, 0, 'ACE00017.jpg', '%2023-%11-%16 %15:%26:%10', '%2023-%11-%16 %15:%26:%10'),
(69, 'ACE00018', 'ACE00018', 2, 6, 4, 0, 'ACE00018.jpg', '%2023-%11-%16 %15:%26:%40', '%2023-%11-%16 %15:%26:%40'),
(70, 'ACE00019', 'ACE00019', 2, 6, 4, 0, 'ACE00019.jpg', '%2023-%11-%16 %15:%29:%03', '%2023-%11-%16 %15:%29:%03'),
(71, 'ACE00020', 'ACE00020', 2, 6, 4, 0, 'ACE00020.jpg', '%2023-%11-%16 %15:%29:%49', '%2023-%11-%16 %15:%29:%49'),
(72, 'AKE00005', 'AKE00005', 2, 6, 4, 0, 'AKE00005.jpg', '%2023-%11-%16 %15:%31:%57', '%2023-%11-%16 %15:%31:%57'),
(73, 'AKE00006', 'AKE00006', 2, 6, 4, 0, 'AKE00006.jpg', '%2023-%11-%16 %15:%32:%28', '%2023-%11-%16 %15:%32:%28'),
(74, 'AKE00007', 'AKE00007', 2, 6, 4, 0, 'AKE00007.jpg', '%2023-%11-%16 %15:%33:%01', '%2023-%11-%16 %15:%33:%01'),
(75, 'CPB00008', 'CPB00008', 1, 3, 4, 0, 'CPB00008.jpg', '%2023-%11-%16 %15:%56:%26', '%2023-%11-%16 %15:%56:%26'),
(76, 'CK00001', 'CK00001', 1, 4, 7, 0, 'CK00001.jpg', '%2023-%11-%18 %14:%41:%08', '%2023-%11-%18 %14:%41:%08'),
(77, 'CK00002', 'CK00002', 1, 4, 7, 0, 'ec151e498f1dc3f1dba718a368964c7b.jpg', '%2023-%11-%18 %14:%42:%35', '%2023-%11-%18 %14:%42:%35'),
(78, 'CK00003', 'CK00003', 1, 4, 7, 0, 'CK00003.jpg', '%2023-%11-%18 %14:%43:%57', '%2023-%11-%18 %14:%43:%57'),
(79, 'CK00004', 'CK00004', 1, 4, 7, 0, '1888c5c28f97d2f46fc41b329b57014c.jpg', '%2023-%11-%18 %14:%45:%07', '%2023-%11-%18 %14:%45:%07'),
(80, 'CK00005', 'CK00005', 1, 4, 7, 0, '5881986551d455c62ec3963d77930df3.jpg', '%2023-%11-%18 %14:%45:%50', '%2023-%11-%18 %14:%45:%50'),
(81, 'CK00006', 'CK00006', 1, 4, 7, 0, '9bc55fe7ec33858e6803b7d8098f7fbb.jpg', '%2023-%11-%18 %14:%46:%55', '%2023-%11-%18 %14:%46:%55'),
(82, 'CK00007', 'CK00007', 1, 4, 7, 0, '950c67d6b21f65fbbab5872bbcebb3c1.jpg', '%2023-%11-%18 %14:%47:%54', '%2023-%11-%18 %14:%47:%54'),
(83, 'CK00008', 'CK00008', 1, 4, 7, 0, '5ba83ba5b022f45494bb31df25c441ef.jpg', '%2023-%11-%18 %14:%49:%26', '%2023-%11-%18 %14:%49:%26'),
(84, 'CK00009', 'CK00009', 1, 4, 4, 0, 'CK00009.jpg', '%2023-%11-%18 %20:%53:%26', '%2023-%11-%18 %20:%53:%26'),
(85, 'CK00010', 'CK00010', 1, 4, 4, 0, 'CK00010.jpg', '%2023-%11-%18 %20:%54:%03', '%2023-%11-%18 %20:%54:%03'),
(86, 'CK00011', 'CK00011', 1, 4, 4, 0, 'CK00011.jpg', '%2023-%11-%18 %20:%54:%40', '%2023-%11-%18 %20:%54:%40'),
(87, 'CK00012', 'CK00012', 1, 4, 4, 0, 'CK00012.jpg', '%2023-%11-%18 %20:%57:%35', '%2023-%11-%18 %20:%57:%35'),
(88, 'CK00013', 'CK00013', 1, 4, 4, 0, 'CK00013.jpg', '%2023-%11-%18 %20:%59:%57', '%2023-%11-%18 %20:%59:%57'),
(89, 'CK00015', 'CK00015', 1, 4, 4, 0, 'CK00015.jpg', '%2023-%11-%18 %21:%00:%31', '%2023-%11-%18 %21:%00:%31'),
(90, 'CK00016', 'CK00016', 1, 4, 4, 0, 'CK00016.jpg', '%2023-%11-%18 %21:%01:%39', '%2023-%11-%18 %21:%01:%39'),
(91, 'CK00017', 'CK00017', 1, 4, 4, 0, 'CK00017.jpg', '%2023-%11-%18 %21:%03:%16', '%2023-%11-%18 %21:%03:%16'),
(92, 'CK00018', 'CK00018', 1, 4, 4, 0, 'CK00018.jpg', '%2023-%11-%18 %21:%04:%07', '%2023-%11-%18 %21:%04:%07'),
(93, 'CK00019', 'CK00019', 1, 4, 4, 0, 'CK00019.jpg', '%2023-%11-%18 %21:%05:%19', '%2023-%11-%18 %21:%05:%19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_class_detail`
--

CREATE TABLE `product_class_detail` (
  `prd_class_detail_id` bigint NOT NULL,
  `product_class_id` int DEFAULT NULL,
  `prd_class_rate_id2` bigint DEFAULT NULL,
  `prd_class_rate_id3` bigint DEFAULT NULL,
  `prd_class_rate_id4` bigint DEFAULT NULL,
  `prd_class_rate_id5` bigint DEFAULT NULL,
  `prd_class_rate_id6` bigint DEFAULT NULL,
  `prd_class_rate_id7` bigint DEFAULT NULL,
  `prd_class_rate_id8` bigint DEFAULT NULL,
  `prd_class_rate_id9` bigint DEFAULT NULL,
  `prd_class_rate_id10` bigint DEFAULT NULL,
  `prd_class_rate_id11` bigint DEFAULT NULL,
  `prd_class_rate_id12` bigint DEFAULT NULL,
  `prd_class_weight1` double DEFAULT NULL,
  `prd_class_weight2` double DEFAULT NULL,
  `prd_class_weight3` double DEFAULT NULL,
  `prd_class_weight4` double DEFAULT NULL,
  `prd_class_weight5` double DEFAULT NULL,
  `prd_class_weight6` double DEFAULT NULL,
  `prd_class_weight7` double DEFAULT NULL,
  `prd_class_weight8` double DEFAULT NULL,
  `prd_class_weight9` double DEFAULT NULL,
  `prd_class_weight10` double DEFAULT NULL,
  `prd_class_weight11` double DEFAULT NULL,
  `prd_class_weight12` double DEFAULT NULL,
  `ring_size_id1` int NOT NULL,
  `ring_size_id2` int NOT NULL,
  `ring_size_id3` int NOT NULL,
  `ring_size_id4` int NOT NULL,
  `ring_size_id5` int NOT NULL,
  `ring_size_id6` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_class_detail`
--

INSERT INTO `product_class_detail` (`prd_class_detail_id`, `product_class_id`, `prd_class_rate_id2`, `prd_class_rate_id3`, `prd_class_rate_id4`, `prd_class_rate_id5`, `prd_class_rate_id6`, `prd_class_rate_id7`, `prd_class_rate_id8`, `prd_class_rate_id9`, `prd_class_rate_id10`, `prd_class_rate_id11`, `prd_class_rate_id12`, `prd_class_weight1`, `prd_class_weight2`, `prd_class_weight3`, `prd_class_weight4`, `prd_class_weight5`, `prd_class_weight6`, `prd_class_weight7`, `prd_class_weight8`, `prd_class_weight9`, `prd_class_weight10`, `prd_class_weight11`, `prd_class_weight12`, `ring_size_id1`, `ring_size_id2`, `ring_size_id3`, `ring_size_id4`, `ring_size_id5`, `ring_size_id6`) VALUES
(1, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0),
(2, 36, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.02, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 37, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.04, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 38, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1.37, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 39, 2, 6, 7, 8, 11, 0, 0, 0, 0, 0, 0, 1, 0.91, 1.05, 1.3, 1.4, 1.5, 0, 0, 0, 0, 0, 0, 6, 8, 11, 13, 0, 0),
(6, 40, 12, 12, 12, 0, 0, 0, 0, 0, 0, 0, 0, 12, 0.02, 0.01, 0.02, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 41, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.47, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 42, 12, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.6, 10, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 43, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.46, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 44, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.37, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 45, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.37, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 46, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 47, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 48, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 49, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.92, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.91, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 51, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.03, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 52, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.52, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(19, 53, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.89, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 54, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.55, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 55, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(22, 56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.43, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, 57, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.99, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.46, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(26, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.41, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, 61, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2.33, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(28, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(29, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(30, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(31, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(32, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.54, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(33, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.54, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(34, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(35, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(36, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(37, 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(38, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.98, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(39, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.54, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(40, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2.18, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(41, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.37, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(42, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5.79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(43, 77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7.46, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(44, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.31, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(45, 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5.79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(46, 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5.74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(47, 81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(48, 82, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5.7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(49, 83, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(50, 84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(51, 85, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2.26, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(52, 86, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3.27, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(53, 87, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3.29, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(54, 88, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3.63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(55, 89, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(56, 90, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2.48, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(57, 91, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3.92, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(58, 92, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.86, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(59, 93, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.03, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(60, 94, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_rate`
--

CREATE TABLE `product_rate` (
  `prd_rate_id` bigint NOT NULL,
  `prd_rate_code` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `prd_rate_name` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `prd_rate_des` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `prd_rate_percentage` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_rate`
--

INSERT INTO `product_rate` (`prd_rate_id`, `prd_rate_code`, `prd_rate_name`, `prd_rate_des`, `prd_rate_percentage`) VALUES
(1, '', '250', '', 30),
(2, '6K', '300', '', 35),
(3, '8K', '375P', '', 46),
(4, '8K', '375K', '', 44),
(5, '9K', '420', '', 48),
(6, '10K', '450', '', 52),
(7, '16K', '700', '', 76),
(8, '17K', '750P', '', 83),
(9, '17K', '750K', '', 81),
(10, '17K', '750R', '', 81),
(11, '20K', '875', '', 94),
(12, '22K', '917', '', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_sub_category`
--

CREATE TABLE `product_sub_category` (
  `prd_sub_cat_id` bigint NOT NULL,
  `product_category_id` bigint NOT NULL,
  `prd_sub_cat_name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_sub_category`
--

INSERT INTO `product_sub_category` (`prd_sub_cat_id`, `product_category_id`, `prd_sub_cat_name`, `image`) VALUES
(1, 1, 'Cincin Cor', 'ce2c876eebfc3b1094c28bf657367cc8.JPG'),
(3, 1, 'Cincin Plat', 'a97c78c7ec52e0ad4c12e50bdb027dd8.JPG'),
(4, 1, 'Cincin Kawin', 'fe0a21d771ef40666ae20ed99e4aeea4.JPG'),
(5, 2, 'Anting Cor dan Klep', '26424bb9687bcb7355aff5a3c026a3f6.JPG'),
(6, 2, 'Anting Anak dan Enamels', '2f9dc53e4cca17a3490d1f743487d909.JPG'),
(9, 1, 'Cincin Anak dan Enamel', '5edc01e67d4649362ee8c3bab9ce6bc7.JPG'),
(10, 1, 'Cincin Eropa', '18179314ef38ecb7dbc7dd29bce9ae16.JPG'),
(11, 3, 'Gelang Bangle', '15a8c81de850e86b28b4ac282288364d.JPG'),
(12, 3, 'Gelang Bangkok Anak', 'fb766bb29d9aa1973a1da2dbbef8cb60.JPG'),
(13, 3, 'Gelang Bangkok', '1a0511958c6da057a283556fe9958974.JPG'),
(14, 3, 'Gelang Keroncong', 'b6e37f9e924dff806453b492cbba78e1.JPG'),
(15, 3, 'Gelang Shogun', '2ba778479701439b5660a8d75af3e536.JPG'),
(16, 3, 'Gelang Plat', '339860593717e00bdc91884ee2637151.JPG'),
(17, 3, 'Gelang Turkey and Rolex', '0b6303f7b2257cd93ece73b616dcc4c0.JPG'),
(18, 3, 'Gelang Lemas and Rantai', '848a5ff665d898d27bbc55d7ecc0bae6.JPG'),
(19, 3, 'Gelang Plat Anak', 'f0e09211137603af9ad9da8104002222.JPG'),
(20, 4, 'Giwang', '0b200ae0835ab1ec35de40d1c4e157bb.JPG'),
(21, 10, 'Kalung', 'a803b912a3df56df480b3cdb975c20ec.JPG'),
(22, 5, 'Liontin', '1ed58f885e13d3b026770d2687c0a264.JPG'),
(23, 5, 'Liontin Anak dan Enamel', 'ee0b0f19a0e3607ffec622072cbc1c44.JPG'),
(24, 6, 'Mainan Gelang', '9a90b6196b7397e4fd5a3c6c2ee4cbd2.JPG'),
(25, 7, 'Set Anting dan Giwang', 'b3b4a81d18b733a382a18becf1b62865.JPG'),
(26, 7, 'Set Cincin', '85db60186220722e33b0d24671eb0a1f.JPG'),
(27, 7, 'Set Gelang', '869799fc60612bb5700ab4ead44eeab3.JPG'),
(28, 7, 'Set Kalung', 'c62ff35feefbccda827e7c985d590e5a.JPG'),
(29, 7, 'Set Liontin', 'de24447c47770f66e8e43a32f3434a46.JPG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ring_size_reference`
--

CREATE TABLE `ring_size_reference` (
  `ring_size_id` int NOT NULL,
  `size` decimal(10,1) DEFAULT NULL,
  `lingkar` decimal(10,2) DEFAULT NULL,
  `diameter` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ring_size_reference`
--

INSERT INTO `ring_size_reference` (`ring_size_id`, `size`, `lingkar`, `diameter`) VALUES
(1, '5.5', '44.00', '14.10'),
(2, '6.5', '45.20', '14.50'),
(3, '8.0', '46.50', '14.90'),
(4, '10.0', '49.00', '15.70'),
(5, '11.0', '50.30', '16.00'),
(6, '12.5', '51.70', '16.50'),
(7, '13.5', '53.10', '17.00'),
(8, '14.5', '54.30', '17.30'),
(9, '15.5', '55.60', '17.50'),
(10, '17.0', '57.20', '18.10'),
(11, '18.0', '58.40', '18.50'),
(12, '19.5', '59.70', '18.90'),
(13, '20.5', '60.90', '19.50'),
(14, '22.0', '62.20', '19.80'),
(15, '23.0', '63.50', '20.50'),
(16, '24.0', '64.70', '20.60'),
(17, '25.5', '66.00', '21.00'),
(18, '27.0', '67.20', '21.40'),
(19, '28.0', '68.50', '22.00'),
(20, '29.0', '69.70', '22.20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_area`
--

CREATE TABLE `sales_area` (
  `sales_area_id` int NOT NULL,
  `sales_area_name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sales_area`
--

INSERT INTO `sales_area` (`sales_area_id`, `sales_area_name`) VALUES
(1, 'Bali'),
(2, 'DIY'),
(3, 'Jabodetabek'),
(4, 'Jawa Barat'),
(5, 'Jawa Tengah'),
(6, 'Jawa Timur'),
(7, 'Kalimantan'),
(8, 'Lombok'),
(9, 'Madura'),
(10, 'Sulawesi'),
(11, 'Sumatera'),
(12, 'Head Office');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sepuh`
--

CREATE TABLE `sepuh` (
  `sepuh_id` int NOT NULL,
  `sepuh_code` varchar(32) NOT NULL,
  `sepuh_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sepuh`
--

INSERT INTO `sepuh` (`sepuh_id`, `sepuh_code`, `sepuh_name`) VALUES
(1, '1K', 'SEPUH KUNING + CAT ENAMEL'),
(2, '1M', 'SEPUH MERAH'),
(3, '1M+CE', 'SEPUH MERAH + CAT ENAMEL'),
(4, '1P', 'SEPUH PUTIH'),
(5, '1P+CE', 'SEPUHAN PUTIH + CAT ENAMEL'),
(6, '1R', 'SEPUH ROSE GOLD'),
(7, '1R+CE', 'SEPUH ROSE GOLD + CAT ENAMEL'),
(8, '1X', 'SEPUH MERAH BARU'),
(9, '1X+CE', 'SEPUH MERAH BARU + CAT ENAMEL'),
(10, '2HP', 'SEPUH HITAM DAN PUTIH'),
(11, '2KH', 'SEPUH KUNING DAN HITAM'),
(12, '2KH+CE', 'SEPUH KUNING DAN HITAM + CAT ENAMEL'),
(13, '2KP', 'SEPUH KUNING DAN PUTIH'),
(14, '2KP+CE', 'SEPUH KUNING DAN PUTIH + ENAMEL'),
(15, '2KR', 'SEPUH KUNING DAN ROSE GOLD'),
(16, '2M+CE', 'SEPUH MERAH + CAT ENAMEL'),
(17, '2MH', 'SEPUH MERAH, HITAM'),
(18, '2MH+CE', 'SEPUH MERAH, HITAM + CAT ENAMEL'),
(19, '2MK', 'SEPUH MERAH DAN KUNING'),
(20, '2MP', 'SEPUH MERAH DAN PUTIH'),
(21, '2MP+CE', 'SEPUH MERAH, PUTIH DAN CAT ENAMEL'),
(22, '2MR', 'SEPUH MERAH, ROSE GOLD'),
(23, '2P+ROSE GOLD', 'SEPUH PUTIH DAN ROSE GOLD'),
(24, '2PH', 'SEPUH PUTIH DAN HITAM'),
(25, '2PK', 'SEPUH PUTIH DAN KUNING'),
(26, '2PM', 'SEPUH PUTIH DAN MERAH'),
(27, '2PR', 'SEPUH PUTIH DAN ROSE GOLD'),
(28, '2RH', 'SEPUH ROSE GOLD DAN HITAM'),
(29, '2RP', 'SEPUH ROSE GOLD DAN PUTIH'),
(30, '2RP+CE', 'SEPUH ROSE GOLD, PUTIH + CAT ENAMEL'),
(31, '2XH', 'SEPUH MERAH BARU DAN HITAM'),
(32, '2XK', 'SEPUH MERAH BARU DAN KUNING'),
(33, '2XP', 'SEPUH MERAH BARU DAN PUTIH'),
(34, '2XP+CE', 'SEPUH MERAH BARU, PUTIH + CAT ENAMEL'),
(35, '3KPH', 'SEPUH KUNING, PUTIH, HITAM'),
(36, '3KPR', 'SEPUH KUNING, PUTIH, ROSE GOLD'),
(37, '3KPR', 'SEPUH KUNING, PUTIH, ROSE GOLD'),
(38, '3MHP', 'SEPUH MERAH, HITAM, PUTIH'),
(39, '3MPH', 'SEPUH MERAH, PUTIH, HITAM'),
(40, '3MPH+CE', 'SEPUH MERAH, PUTIH, HITAM + CAT ENAMEL'),
(41, '3MPK', 'SEPUH MERAH, PUTIH, KUNING'),
(42, '3MPR', 'SEPUH MERAH, PUTIH, ROSE GOLD'),
(43, '3PKR', 'SEPUH PUTIH, KUNING, ROSE GOLD'),
(44, '3PRK', 'SEPUH PUTIH, ROSE GOLD, KUNING'),
(45, '3RPK', 'SEPUH ROSE GOLD, PUTIH, DAN KUNING'),
(46, '3RPX', 'SEPUH ROSE GOLD, PUTIH, MERAH BARU'),
(47, '3XHP', 'SEPUH MERAH BARU, HITAM, PUTIH'),
(48, '3XPH', 'SEPUH MERAH BARU, PUTIH, HITAM'),
(49, '3XPH+CE', 'SEPUH MERAH BARU, PUTIH, DAN HITAM + CAT ENAMEL'),
(50, '3XPK', 'SEPUH MERAH BARU, PUTIH, DAM KUNING'),
(51, '3XPK+CE', 'SEPUH MERAH BARU, PUTIH, DAN KUNING + CAT ENAMEL'),
(52, '3XPR', 'SEPUH MERAH BARU, PUTIH, DAN ROSE GOLD'),
(53, '3XPR+CE', 'SEPUH MERAH BARU, PUTIH, DAN ROSE GOLD + CAT ENAMEL'),
(54, '4KMPR', 'SEPUH KUNING, MERAH, PUTIH, DAN ROSE GOLD'),
(55, '4MKPR', 'SEPUH MERAH, KUNING, PUTIH, DAN ROSE GOLD'),
(56, '4MPKH', 'SEPUH MERAH, PUTIH, KUNING, DAN HITAM'),
(57, '4MPKR', 'SEPUH MERAH, PUTIH, KUNING, DAN ROSE GOLD'),
(58, '4MPRK', 'SEPUH MERAH, PUTIH, ROSE GOLD, DAN KUNING'),
(59, '4MRPK', 'SEPUHAN MERAH, ROSE GOLD, PUTIH, DAN KUNING'),
(60, '4RMPK', 'SEPUH ROSE GOLD, MERAH, PUTIH, DAN KUNING'),
(61, '4XKPR', 'SEPUH MERAH BARU, KUNING, PUTIH, DAN ROSE GOLD'),
(62, '4XPKR', 'SEPUH MERAH BARU, PUTIH, KUNING, DAN ROSE GOLD'),
(63, '4XPRK', 'SEPUH MERAH BARU, PUTIH, ROSE GOLD, DAN KUNING');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_detail`
--

CREATE TABLE `trans_detail` (
  `td_id` bigint NOT NULL,
  `th_id` bigint DEFAULT NULL,
  `product_catagory_id` int DEFAULT NULL,
  `product_sub_category_id` int DEFAULT NULL,
  `product_class_id` int DEFAULT NULL,
  `sepuh_id` int DEFAULT NULL,
  `size_id` int DEFAULT NULL,
  `bentuk_id` int DEFAULT NULL,
  `n1` int DEFAULT NULL,
  `n2` int DEFAULT NULL,
  `n3` int DEFAULT NULL,
  `n4` int DEFAULT NULL,
  `n5` int DEFAULT NULL,
  `n6` int DEFAULT NULL,
  `n7` int DEFAULT NULL,
  `notes` varchar(64) DEFAULT NULL,
  `s1` varchar(64) DEFAULT NULL,
  `s2` varchar(64) DEFAULT NULL,
  `s3` varchar(64) DEFAULT NULL,
  `s4` varchar(64) DEFAULT NULL,
  `s5` varchar(64) DEFAULT NULL,
  `s6` varchar(64) DEFAULT NULL,
  `s7` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trans_detail`
--

INSERT INTO `trans_detail` (`td_id`, `th_id`, `product_catagory_id`, `product_sub_category_id`, `product_class_id`, `sepuh_id`, `size_id`, `bentuk_id`, `n1`, `n2`, `n3`, `n4`, `n5`, `n6`, `n7`, `notes`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`, `s7`) VALUES
(1, 1, 1, 1, 39, 33, 11, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, 'permintaan ko yoko minta cepat', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 1, 1, 52, 33, 13, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 1, 1, 41, 0, 12, 0, 50, NULL, NULL, NULL, NULL, NULL, NULL, 'minta dipercepat guys', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 1, 1, 41, 33, 12, 0, 30, NULL, NULL, NULL, NULL, NULL, NULL, 'Permintaan ko Yoko dipercepat', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_header`
--

CREATE TABLE `trans_header` (
  `th_id` bigint NOT NULL,
  `activity_id` int DEFAULT NULL,
  `trans_code` varchar(64) DEFAULT NULL,
  `trans_date` datetime DEFAULT NULL,
  `trans_status_id` int DEFAULT NULL,
  `trans_loc` int DEFAULT NULL,
  `trans_loc2` int DEFAULT NULL,
  `ref_doc` int DEFAULT NULL,
  `ref_doc2` int DEFAULT NULL,
  `next_pic` int DEFAULT NULL,
  `next_loc` int DEFAULT NULL,
  `date_expected` datetime DEFAULT NULL,
  `date_result` datetime DEFAULT NULL,
  `notes` varchar(64) DEFAULT NULL,
  `s1` varchar(64) DEFAULT NULL,
  `s2` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `s3` varchar(64) DEFAULT NULL,
  `s4` varchar(64) DEFAULT NULL,
  `s5` varchar(64) DEFAULT NULL,
  `s6` varchar(64) DEFAULT NULL,
  `s7` varchar(64) DEFAULT NULL,
  `n1` int DEFAULT NULL,
  `n2` int DEFAULT NULL,
  `n3` int DEFAULT NULL,
  `n4` int DEFAULT NULL,
  `n5` int DEFAULT NULL,
  `n6` int DEFAULT NULL,
  `n7` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trans_header`
--

INSERT INTO `trans_header` (`th_id`, `activity_id`, `trans_code`, `trans_date`, `trans_status_id`, `trans_loc`, `trans_loc2`, `ref_doc`, `ref_doc2`, `next_pic`, `next_loc`, `date_expected`, `date_result`, `notes`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`, `s7`, `n1`, `n2`, `n3`, `n4`, `n5`, `n6`, `n7`) VALUES
(1, 1, 'SOM-11/21/23-1', '2023-11-21 21:40:12', 1, 1, 5, NULL, NULL, 0, 0, NULL, NULL, 'Permintaan Ko Yoko di cikarang', 'Ko Yoko', 'Tk Mas Subaru Sentra Grosir Cikarang Lt.Ground Zona Biru No.35-37 (Dpn Resto Aw)', NULL, NULL, NULL, NULL, NULL, 4, 26, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'SOM-11/24/23-1', '2023-11-24 18:01:13', 1, 1, 7, NULL, NULL, 0, 0, '2023-11-30 18:01:13', NULL, 'Pemesanan untuk Bintang Mas', 'Ce Ling Ling', 'Jl. Kayu Putih Tengah 1A No. 19 Jakarta Timur  ', NULL, NULL, NULL, NULL, NULL, 7, 26, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'SOM-11/24/23-2', '2023-11-24 09:47:48', 2, 1, 7, NULL, NULL, 11, 1, '2024-01-15 09:47:48', NULL, 'Permintaan dari ko Yoko', 'Ko Yoko', 'Tk Mas Subaru Sentra Grosir Cikarang Lt.Ground Zona Biru No.35-37 (Dpn Resto Aw)', NULL, NULL, NULL, NULL, NULL, 7, 26, 11, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_pic_detail`
--

CREATE TABLE `trans_pic_detail` (
  `trans_pic_id` bigint NOT NULL,
  `th_id` bigint NOT NULL,
  `pic1` int DEFAULT NULL,
  `pic2` int DEFAULT NULL,
  `pic3` int DEFAULT NULL,
  `pic4` int DEFAULT NULL,
  `pic5` int DEFAULT NULL,
  `pic6` int DEFAULT NULL,
  `pic7` int DEFAULT NULL,
  `pic8` int DEFAULT NULL,
  `date_submit1` datetime DEFAULT NULL,
  `date_submit2` datetime DEFAULT NULL,
  `date_submit3` datetime DEFAULT NULL,
  `date_submit4` datetime DEFAULT NULL,
  `date_submit5` datetime DEFAULT NULL,
  `date_submit6` datetime DEFAULT NULL,
  `date_submit7` datetime DEFAULT NULL,
  `date_submit8` datetime DEFAULT NULL,
  `s1` varchar(64) DEFAULT NULL,
  `s2` varchar(64) DEFAULT NULL,
  `s3` varchar(64) DEFAULT NULL,
  `s4` varchar(64) DEFAULT NULL,
  `s5` varchar(64) DEFAULT NULL,
  `s6` varchar(64) DEFAULT NULL,
  `s7` varchar(64) DEFAULT NULL,
  `s8` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trans_pic_detail`
--

INSERT INTO `trans_pic_detail` (`trans_pic_id`, `th_id`, `pic1`, `pic2`, `pic3`, `pic4`, `pic5`, `pic6`, `pic7`, `pic8`, `date_submit1`, `date_submit2`, `date_submit3`, `date_submit4`, `date_submit5`, `date_submit6`, `date_submit7`, `date_submit8`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`, `s7`, `s8`) VALUES
(1, 1, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 26, 11, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-24 09:47:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_status`
--

CREATE TABLE `trans_status` (
  `trans_status_id` int NOT NULL,
  `trans_status_name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trans_status`
--

INSERT INTO `trans_status` (`trans_status_id`, `trans_status_name`) VALUES
(1, 'New Transaction'),
(2, 'Verification Required'),
(3, 'Approval Required'),
(4, 'Delivery Required'),
(5, 'Completed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` bigint NOT NULL,
  `company_id` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `func_group_id` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_date` varchar(32) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `company_id`, `username`, `password`, `surname`, `email`, `func_group_id`, `created_date`, `updated_date`) VALUES
(17, '1', 'ridwanzal', '0092bef6aba8ac4d71d32555ae1b415269d0153a', 'M Ridwan Zalbina', 'zalbinaridwan@gmail.com', '1', '', ''),
(18, '1', 'gatotkaca', '0092bef6aba8ac4d71d32555ae1b415269d0153a', 'Gatot Kaca', 'gatotkaca@njsgold.co.id', '1', '', ''),
(19, '1', 'Admin NJS', '65da65390b56ca4072659255475ff36fb81a3cd3', 'Admin NJS', 'admin@njsgold.co.id', '25', '', ''),
(20, '1', 'Naomi', '65da65390b56ca4072659255475ff36fb81a3cd3', 'Naomi Julia Soegianto', 'naomi.jsoegianto@njsgold.co.id', '2', '', ''),
(21, '1', 'Noah', '65da65390b56ca4072659255475ff36fb81a3cd3', 'Timothy Noah', 'timothy.noah@njsgold.co.id', '3', '', ''),
(22, '1', 'Karen', '65da65390b56ca4072659255475ff36fb81a3cd3', 'Keren Hapukh Setiabudi', 'karenhapukh@njsgold.co.id', '3', '', ''),
(23, '1', 'Yuda', '65da65390b56ca4072659255475ff36fb81a3cd3', 'Yuda Indrawan', 'yuda.indrawan@njsgold.co.id', '5', '', ''),
(24, '1', 'Laoni', '65da65390b56ca4072659255475ff36fb81a3cd3', 'Laoni Sindu Christanto', 'laoni.sindu@njsgold.co.id', '20', '', ''),
(25, '1', 'Harun', '65da65390b56ca4072659255475ff36fb81a3cd3', 'Harun Christian Bentro', 'harun.christian@njsgold.co.id', '20', '', ''),
(26, '1', 'Dyon', '65da65390b56ca4072659255475ff36fb81a3cd3', 'Dyon Agatha Kemilau C', 'dyon.kemilau@njsgold.co.id', '20', '', ''),
(27, '1', 'Angly', '65da65390b56ca4072659255475ff36fb81a3cd3', 'Angly Reidy Rumondor', 'angly.reidy@njsgold.co.id', '20', '', ''),
(28, '1', 'Ananda', '65da65390b56ca4072659255475ff36fb81a3cd3', 'Ananda Yudi Santoso', 'ananda.yudi@njsgold.co.id', '20', '', ''),
(29, '1', 'Areta', '65da65390b56ca4072659255475ff36fb81a3cd3', 'Areta Retno Dewi K', 'areta.retno@njsgold.co.id', '11', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_activity`
--

CREATE TABLE `user_activity` (
  `id_user_activity` int NOT NULL,
  `user_id` int NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `activity` enum('login','registration','logout') COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address_visitor` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `browser_type` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `os` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_activity`
--

INSERT INTO `user_activity` (`id_user_activity`, `user_id`, `email`, `activity`, `ip_address_visitor`, `browser_type`, `os`, `date_created`, `time_created`) VALUES
(1, 1, '', 'login', '::1', 'Google Chrome', 'linux', '2023-07-29', '19:00:05'),
(2, 1, '', 'login', '::1', 'Google Chrome', 'linux', '2023-07-29', '19:02:01'),
(3, 1, '', 'login', '::1', 'Google Chrome', 'linux', '2023-07-29', '19:02:17'),
(4, 1, '', 'login', '::1', 'Google Chrome', 'linux', '2023-07-29', '19:02:45'),
(5, 1, '', 'login', '::1', 'Google Chrome', 'linux', '2023-07-29', '19:03:33'),
(6, 1, '', 'login', '::1', 'Google Chrome', 'linux', '2023-07-29', '19:04:30'),
(7, 1, '', 'login', '::1', 'Google Chrome', 'windows', '2023-08-01', '13:35:31'),
(8, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-01', '23:07:10'),
(9, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-01', '23:07:19'),
(10, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-01', '23:09:24'),
(11, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-02', '06:48:52'),
(12, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-02', '08:31:19'),
(13, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-03', '15:55:33'),
(14, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-04', '14:30:46'),
(15, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-04', '23:17:25'),
(16, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-04', '23:17:39'),
(17, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-04', '23:22:06'),
(18, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-04', '23:22:17'),
(19, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-07', '13:59:02'),
(20, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-07', '13:59:29'),
(21, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-07', '14:00:06'),
(22, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-07', '15:07:03'),
(23, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-07', '22:48:38'),
(24, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '00:04:40'),
(25, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '01:25:11'),
(26, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '01:29:56'),
(27, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '02:15:43'),
(28, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '02:20:27'),
(29, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '02:20:34'),
(30, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '02:22:38'),
(31, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '02:22:52'),
(32, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '02:23:19'),
(33, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '02:25:25'),
(34, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '02:36:26'),
(35, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '11:41:06'),
(36, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '11:56:09'),
(37, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '12:01:29'),
(38, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '12:04:08'),
(39, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '12:06:04'),
(40, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '12:06:21'),
(41, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-08', '12:06:26'),
(42, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-09', '07:15:05'),
(43, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-10', '08:48:59'),
(44, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-10', '08:54:09'),
(45, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-10', '12:21:09'),
(46, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-10', '12:21:46'),
(47, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '06:55:59'),
(48, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '07:37:04'),
(49, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '09:15:10'),
(50, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '09:41:31'),
(51, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '13:45:32'),
(52, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '13:57:43'),
(53, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '13:58:25'),
(54, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '14:00:38'),
(55, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '14:10:53'),
(56, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '22:04:10'),
(57, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '22:04:53'),
(58, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '22:18:58'),
(59, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '22:33:51'),
(60, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-11', '22:33:57'),
(61, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '07:57:43'),
(62, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '07:58:28'),
(63, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '08:46:33'),
(64, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '08:47:28'),
(65, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '08:47:36'),
(66, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '08:48:52'),
(67, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '08:53:48'),
(68, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '08:57:30'),
(69, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '09:04:58'),
(70, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '09:05:06'),
(71, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '09:06:28'),
(72, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '09:10:11'),
(73, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '09:11:05'),
(74, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '09:15:25'),
(75, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-12', '15:47:16'),
(76, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-13', '22:21:34'),
(77, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-15', '23:36:52'),
(78, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-15', '23:38:26'),
(79, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-16', '00:27:11'),
(80, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-16', '00:29:20'),
(81, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-16', '00:32:20'),
(82, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-16', '00:32:35'),
(83, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-16', '06:45:22'),
(84, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-16', '12:44:29'),
(85, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-17', '00:41:57'),
(86, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-17', '03:39:11'),
(87, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-17', '10:02:09'),
(88, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '03:17:29'),
(89, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '10:25:56'),
(90, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '10:27:18'),
(91, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '11:16:00'),
(92, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '11:20:27'),
(93, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '11:20:43'),
(94, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '11:21:17'),
(95, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '11:26:17'),
(96, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '11:27:23'),
(97, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '11:33:43'),
(98, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '21:24:51'),
(99, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-19', '21:24:59'),
(100, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-20', '06:25:48'),
(101, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-20', '06:26:02'),
(102, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-21', '07:54:42'),
(103, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-21', '07:57:00'),
(104, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-21', '16:48:00'),
(105, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-21', '16:48:07'),
(106, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-21', '22:59:42'),
(107, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-21', '23:15:01'),
(108, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '13:47:41'),
(109, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '13:49:30'),
(110, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '14:25:20'),
(111, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '15:04:31'),
(112, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '15:05:26'),
(113, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '18:43:22'),
(114, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '21:01:12'),
(115, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '21:03:01'),
(116, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '21:06:00'),
(117, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '21:10:28'),
(118, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '21:28:53'),
(119, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-22', '21:30:59'),
(120, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-23', '06:17:43'),
(121, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-23', '07:36:10'),
(122, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-23', '07:36:56'),
(123, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-23', '14:49:54'),
(124, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-24', '14:20:22'),
(125, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-24', '20:51:22'),
(126, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-08-24', '22:24:27'),
(127, 3, '', 'login', '', 'Apple Safari', 'mac', '2023-08-24', '22:27:26'),
(128, 3, '', 'login', '', 'Google Chrome', 'linux', '2023-08-25', '08:24:17'),
(129, 2, '', 'login', '', 'Google Chrome', 'mac', '2023-08-25', '09:14:16'),
(130, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-25', '09:25:26'),
(131, 3, '', 'login', '', 'Google Chrome', 'linux', '2023-08-25', '09:45:47'),
(132, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-25', '20:24:38'),
(133, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-25', '20:24:51'),
(134, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-25', '20:25:04'),
(135, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-25', '20:25:14'),
(136, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-26', '09:25:03'),
(137, 3, '', 'login', '', 'Google Chrome', 'linux', '2023-08-26', '16:11:28'),
(138, 1, '', 'login', '', 'Google Chrome', 'windows', '2023-08-26', '23:19:32'),
(139, 2, '', 'login', '', 'Google Chrome', 'linux', '2023-08-27', '05:44:41'),
(140, 3, '', 'login', '', 'Google Chrome', 'windows', '2023-08-27', '09:53:53'),
(141, 2, '', 'login', '', 'Google Chrome', 'linux', '2023-08-28', '12:55:13'),
(142, 3, '', 'login', '', 'Google Chrome', 'linux', '2023-08-28', '12:55:36'),
(143, 3, '', 'login', '', 'Google Chrome', 'linux', '2023-08-29', '16:45:45'),
(144, 2, '', 'login', '', 'Google Chrome', 'linux', '2023-08-30', '09:51:22'),
(145, 2, '', 'login', '', 'Google Chrome', 'linux', '2023-09-28', '15:00:42'),
(146, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:06:46'),
(147, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:07:48'),
(148, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:15:39'),
(149, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:22:50'),
(150, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:24:17'),
(151, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:27:57'),
(152, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:28:09'),
(153, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:32:39'),
(154, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:36:48'),
(155, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:37:18'),
(156, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:42:28'),
(157, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:43:49'),
(158, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:43:54'),
(159, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '16:48:20'),
(160, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '17:06:21'),
(161, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '17:06:26'),
(162, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '17:15:45'),
(163, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '17:15:52'),
(164, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-30', '17:16:41'),
(165, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '17:44:15'),
(166, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '19:49:25'),
(167, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:33:36'),
(168, 2, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:34:09'),
(169, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:45:08'),
(170, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:45:29'),
(171, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:46:40'),
(172, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:48:45'),
(173, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:49:02'),
(174, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:49:04'),
(175, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:49:11'),
(176, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:49:35'),
(177, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:49:48'),
(178, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:49:49'),
(179, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:49:49'),
(180, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:50:08'),
(181, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:51:09'),
(182, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:51:13'),
(183, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:51:31'),
(184, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-10-31', '21:51:38'),
(185, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-01', '11:24:38'),
(186, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-01', '12:02:13'),
(187, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-01', '13:14:51'),
(188, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-01', '18:10:33'),
(189, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-01', '21:39:29'),
(190, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-01', '22:11:41'),
(191, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-01', '22:19:39'),
(192, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-02', '06:32:32'),
(193, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-02', '08:35:53'),
(194, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-02', '13:44:00'),
(195, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-02', '13:45:54'),
(196, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-02', '18:53:17'),
(197, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-02', '20:17:18'),
(198, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-03', '21:10:42'),
(199, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-03', '21:47:55'),
(200, 18, '', 'login', '', 'Google Chrome', 'windows', '2023-11-03', '21:48:43'),
(201, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-04', '22:03:14'),
(202, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-05', '06:40:38'),
(203, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-05', '19:16:37'),
(204, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-06', '06:12:54'),
(205, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-06', '11:49:24'),
(206, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-06', '15:31:51'),
(207, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-06', '15:32:22'),
(208, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-06', '16:22:56'),
(209, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-06', '17:27:05'),
(210, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-07', '06:59:24'),
(211, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-07', '10:31:48'),
(212, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-07', '12:20:54'),
(213, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-07', '16:55:03'),
(214, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-07', '17:27:33'),
(215, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-07', '17:27:55'),
(216, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-07', '21:16:36'),
(217, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-07', '21:16:42'),
(218, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-07', '21:32:31'),
(219, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-07', '21:40:15'),
(220, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-07', '22:46:55'),
(221, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-08', '10:49:52'),
(222, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-08', '10:49:56'),
(223, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-08', '13:39:58'),
(224, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-09', '08:09:22'),
(225, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-09', '17:05:51'),
(226, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-09', '17:18:52'),
(227, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-09', '17:19:45'),
(228, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-09', '17:19:52'),
(229, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-09', '17:34:42'),
(230, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-10', '11:25:21'),
(231, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-10', '17:27:42'),
(232, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-11', '10:07:33'),
(233, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-11', '21:44:58'),
(234, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-11', '21:49:38'),
(235, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-11', '21:50:43'),
(236, 18, '', 'login', '', 'Google Chrome', 'linux', '2023-11-11', '21:55:37'),
(237, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-11', '21:55:56'),
(238, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-12', '10:05:46'),
(239, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '11:40:35'),
(240, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '11:51:02'),
(241, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-13', '12:52:10'),
(242, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '13:41:55'),
(243, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '13:48:19'),
(244, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-13', '13:50:28'),
(245, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '14:22:24'),
(246, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '14:37:09'),
(247, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '16:06:17'),
(248, 17, '', 'login', '', 'Google Chrome', 'linux', '2023-11-13', '16:43:33'),
(249, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '16:50:43'),
(250, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '17:12:15'),
(251, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '17:16:10'),
(252, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '17:19:08'),
(253, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-13', '19:40:47'),
(254, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '19:54:31'),
(255, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '20:12:00'),
(256, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '20:16:19'),
(257, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '21:12:02'),
(258, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-13', '21:14:09'),
(259, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-14', '14:40:36'),
(260, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-14', '20:45:37'),
(261, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-15', '09:02:03'),
(262, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-15', '10:45:33'),
(263, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-15', '11:35:52'),
(264, 17, '', 'login', '', 'Google Chrome', 'mac', '2023-11-15', '17:23:21'),
(265, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-15', '22:26:20'),
(266, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-16', '05:18:19'),
(267, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-16', '07:09:31'),
(268, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-16', '07:21:39'),
(269, 17, '', 'login', '', 'Google Chrome', 'mac', '2023-11-16', '08:20:35'),
(270, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-16', '08:44:16'),
(271, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-16', '09:15:10'),
(272, 19, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-16', '12:14:19'),
(273, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-16', '14:11:12'),
(274, 19, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-16', '14:24:52'),
(275, 17, '', 'login', '', 'Apple Safari', 'mac', '2023-11-16', '16:08:03'),
(276, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-16', '18:54:53'),
(277, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-16', '19:24:50'),
(278, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-16', '19:32:17'),
(279, 17, '', 'login', '', 'Google Chrome', 'linux', '2023-11-16', '19:38:30'),
(280, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-16', '20:00:08'),
(281, 19, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-16', '20:09:10'),
(282, 17, '', 'login', '', 'Google Chrome', 'linux', '2023-11-16', '20:41:01'),
(283, 19, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-16', '21:02:36'),
(284, 19, '', 'login', '', 'Google Chrome', 'linux', '2023-11-17', '06:53:19'),
(285, 17, '', 'login', '', 'Google Chrome', 'mac', '2023-11-17', '07:27:14'),
(286, 17, '', 'login', '', 'Google Chrome', 'linux', '2023-11-17', '08:32:21'),
(287, 20, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-17', '10:58:15'),
(288, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-17', '11:00:43'),
(289, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-18', '00:15:56'),
(290, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-18', '00:33:25'),
(291, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-18', '07:56:48'),
(292, 19, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-18', '08:35:01'),
(293, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-18', '11:35:19'),
(294, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-18', '14:28:49'),
(295, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-18', '16:53:27'),
(296, 17, '', 'login', '', 'Google Chrome', 'linux', '2023-11-18', '17:23:50'),
(297, 19, '', 'login', '', 'Apple Safari', 'mac', '2023-11-18', '17:58:11'),
(298, 29, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-18', '20:30:14'),
(299, 29, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-18', '20:31:56'),
(300, 23, '', 'login', '', 'Google Chrome', 'windows', '2023-11-19', '10:42:51'),
(301, 23, '', 'login', '', 'Google Chrome', 'windows', '2023-11-19', '15:10:34'),
(302, 23, '', 'login', '', 'Google Chrome', 'windows', '2023-11-19', '15:16:01'),
(303, 20, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-19', '16:33:16'),
(304, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-19', '16:38:58'),
(305, 19, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-20', '08:05:57'),
(306, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-20', '08:06:20'),
(307, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-20', '08:07:38'),
(308, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-20', '11:24:04'),
(309, 19, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-20', '11:26:40'),
(310, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-20', '11:30:57'),
(311, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-20', '14:24:48'),
(312, 23, '', 'login', '', 'Google Chrome', 'windows', '2023-11-20', '21:00:22'),
(313, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-20', '21:00:34'),
(314, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-20', '21:01:14'),
(315, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-20', '21:10:53'),
(316, 23, '', 'login', '', 'Google Chrome', 'windows', '2023-11-20', '21:15:55'),
(317, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-21', '07:58:35'),
(318, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '10:35:55'),
(319, 19, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '16:10:29'),
(320, 29, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '16:10:58'),
(321, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '16:14:26'),
(322, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '16:50:26'),
(323, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '17:16:03'),
(324, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '17:43:28'),
(325, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-21', '18:40:30'),
(326, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-21', '19:27:13'),
(327, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '20:08:34'),
(328, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '20:22:35'),
(329, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '20:34:16'),
(330, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-21', '20:36:35'),
(331, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '21:05:07'),
(332, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '21:51:33'),
(333, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-21', '22:05:02'),
(334, 18, '', 'login', '', 'Google Chrome', 'linux', '2023-11-22', '03:36:53'),
(335, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-22', '03:37:51'),
(336, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-22', '03:46:37'),
(337, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-22', '03:47:12'),
(338, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-22', '03:48:16'),
(339, 19, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-22', '03:50:54'),
(340, 18, '', 'login', '', 'Google Chrome', 'windows', '2023-11-22', '03:53:30'),
(341, 19, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-22', '03:54:18'),
(342, 29, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-22', '03:55:58'),
(343, 19, '', 'login', '', 'Google Chrome', 'windows', '2023-11-22', '03:59:57'),
(344, 17, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-22', '04:02:58'),
(345, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-22', '04:03:19'),
(346, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-22', '11:08:04'),
(347, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-22', '11:09:39'),
(348, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-22', '11:47:50'),
(349, 17, '', 'login', '', 'Google Chrome', 'mac', '2023-11-22', '13:11:56'),
(350, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-22', '19:00:32'),
(351, 17, '', 'login', '', 'Google Chrome', 'windows', '2023-11-22', '19:06:23'),
(352, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-22', '22:39:55'),
(353, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-23', '08:14:18'),
(354, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-23', '08:16:39'),
(355, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-24', '08:52:02'),
(356, 23, '', 'login', '', 'Google Chrome', 'windows', '2023-11-24', '21:27:28'),
(357, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-25', '07:16:36'),
(358, 26, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-25', '10:32:01'),
(359, 23, '', 'login', '', 'Google Chrome', 'windows', '2023-11-25', '11:34:43'),
(360, 26, '', 'login', '', 'Google Chrome', 'windows', '2023-11-25', '11:35:10'),
(361, 18, '', 'login', '', 'Mozilla Firefox', 'windows', '2023-11-25', '11:49:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `workflow`
--

CREATE TABLE `workflow` (
  `activity_id` int NOT NULL,
  `workflow_qty` int DEFAULT '0',
  `pic1` int DEFAULT '0',
  `pic2` int DEFAULT '0',
  `pic3` int DEFAULT '0',
  `pic4` int DEFAULT '0',
  `pic5` int DEFAULT '0',
  `pic6` int DEFAULT '0',
  `pic7` int DEFAULT '0',
  `pic8` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `workflow`
--

INSERT INTO `workflow` (`activity_id`, `workflow_qty`, `pic1`, `pic2`, `pic3`, `pic4`, `pic5`, `pic6`, `pic7`, `pic8`) VALUES
(1, 2, 20, 11, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indeks untuk tabel `activity_group`
--
ALTER TABLE `activity_group`
  ADD PRIMARY KEY (`activity_group_id`);

--
-- Indeks untuk tabel `cluster`
--
ALTER TABLE `cluster`
  ADD PRIMARY KEY (`cluster_id`),
  ADD KEY `fk_sales_area` (`sales_area_id`);

--
-- Indeks untuk tabel `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indeks untuk tabel `company_type`
--
ALTER TABLE `company_type`
  ADD PRIMARY KEY (`company_type_id`);

--
-- Indeks untuk tabel `functional_group`
--
ALTER TABLE `functional_group`
  ADD PRIMARY KEY (`func_group_id`);

--
-- Indeks untuk tabel `group_activity_map_detail`
--
ALTER TABLE `group_activity_map_detail`
  ADD PRIMARY KEY (`group_dtl_id`),
  ADD KEY `fk_group_hdr2` (`group_hdr_id`),
  ADD KEY `fk_func_group2` (`func_group_id`);

--
-- Indeks untuk tabel `group_act_map_header`
--
ALTER TABLE `group_act_map_header`
  ADD PRIMARY KEY (`group_hdr_id`),
  ADD KEY `fk_activity2` (`activity_id`);

--
-- Indeks untuk tabel `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indeks untuk tabel `product_class`
--
ALTER TABLE `product_class`
  ADD PRIMARY KEY (`product_class_id`),
  ADD UNIQUE KEY `product_class_code_2` (`product_class_code`),
  ADD KEY `product_class_code` (`product_class_code`);

--
-- Indeks untuk tabel `product_class_detail`
--
ALTER TABLE `product_class_detail`
  ADD PRIMARY KEY (`prd_class_detail_id`),
  ADD KEY `prd_class_detail_id` (`prd_class_detail_id`,`product_class_id`),
  ADD KEY `product_class_id` (`product_class_id`);

--
-- Indeks untuk tabel `product_rate`
--
ALTER TABLE `product_rate`
  ADD PRIMARY KEY (`prd_rate_id`);

--
-- Indeks untuk tabel `product_sub_category`
--
ALTER TABLE `product_sub_category`
  ADD PRIMARY KEY (`prd_sub_cat_id`);

--
-- Indeks untuk tabel `ring_size_reference`
--
ALTER TABLE `ring_size_reference`
  ADD PRIMARY KEY (`ring_size_id`);

--
-- Indeks untuk tabel `sales_area`
--
ALTER TABLE `sales_area`
  ADD PRIMARY KEY (`sales_area_id`);

--
-- Indeks untuk tabel `sepuh`
--
ALTER TABLE `sepuh`
  ADD PRIMARY KEY (`sepuh_id`);

--
-- Indeks untuk tabel `trans_detail`
--
ALTER TABLE `trans_detail`
  ADD PRIMARY KEY (`td_id`),
  ADD KEY `fk_trans_header` (`th_id`);

--
-- Indeks untuk tabel `trans_header`
--
ALTER TABLE `trans_header`
  ADD PRIMARY KEY (`th_id`),
  ADD KEY `fk_activity` (`activity_id`),
  ADD KEY `fk_trans_status` (`trans_status_id`);

--
-- Indeks untuk tabel `trans_pic_detail`
--
ALTER TABLE `trans_pic_detail`
  ADD PRIMARY KEY (`trans_pic_id`),
  ADD KEY `fk_reference_39` (`th_id`);

--
-- Indeks untuk tabel `trans_status`
--
ALTER TABLE `trans_status`
  ADD PRIMARY KEY (`trans_status_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id_user_activity`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `activity_group`
--
ALTER TABLE `activity_group`
  MODIFY `activity_group_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `cluster`
--
ALTER TABLE `cluster`
  MODIFY `cluster_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `company_type`
--
ALTER TABLE `company_type`
  MODIFY `company_type_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `functional_group`
--
ALTER TABLE `functional_group`
  MODIFY `func_group_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT untuk tabel `group_activity_map_detail`
--
ALTER TABLE `group_activity_map_detail`
  MODIFY `group_dtl_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `group_act_map_header`
--
ALTER TABLE `group_act_map_header`
  MODIFY `group_hdr_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `product_class`
--
ALTER TABLE `product_class`
  MODIFY `product_class_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT untuk tabel `product_class_detail`
--
ALTER TABLE `product_class_detail`
  MODIFY `prd_class_detail_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `product_rate`
--
ALTER TABLE `product_rate`
  MODIFY `prd_rate_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `product_sub_category`
--
ALTER TABLE `product_sub_category`
  MODIFY `prd_sub_cat_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `ring_size_reference`
--
ALTER TABLE `ring_size_reference`
  MODIFY `ring_size_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `sales_area`
--
ALTER TABLE `sales_area`
  MODIFY `sales_area_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `sepuh`
--
ALTER TABLE `sepuh`
  MODIFY `sepuh_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `trans_detail`
--
ALTER TABLE `trans_detail`
  MODIFY `td_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `trans_header`
--
ALTER TABLE `trans_header`
  MODIFY `th_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `trans_pic_detail`
--
ALTER TABLE `trans_pic_detail`
  MODIFY `trans_pic_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `trans_status`
--
ALTER TABLE `trans_status`
  MODIFY `trans_status_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id_user_activity` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=362;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cluster`
--
ALTER TABLE `cluster`
  ADD CONSTRAINT `fk_sales_area` FOREIGN KEY (`sales_area_id`) REFERENCES `sales_area` (`sales_area_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `group_activity_map_detail`
--
ALTER TABLE `group_activity_map_detail`
  ADD CONSTRAINT `fk_func_group2` FOREIGN KEY (`func_group_id`) REFERENCES `functional_group` (`func_group_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_group_hdr` FOREIGN KEY (`group_hdr_id`) REFERENCES `group_act_map_header` (`group_hdr_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_group_hdr2` FOREIGN KEY (`group_hdr_id`) REFERENCES `group_act_map_header` (`group_hdr_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `group_act_map_header`
--
ALTER TABLE `group_act_map_header`
  ADD CONSTRAINT `fk_activity2` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`activity_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `trans_detail`
--
ALTER TABLE `trans_detail`
  ADD CONSTRAINT `fk_trans_header` FOREIGN KEY (`th_id`) REFERENCES `trans_header` (`th_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `trans_header`
--
ALTER TABLE `trans_header`
  ADD CONSTRAINT `fk_activity` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`activity_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_trans_status` FOREIGN KEY (`trans_status_id`) REFERENCES `trans_status` (`trans_status_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `trans_pic_detail`
--
ALTER TABLE `trans_pic_detail`
  ADD CONSTRAINT `fk_reference_39` FOREIGN KEY (`th_id`) REFERENCES `trans_header` (`th_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
