-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2025 pada 15.47
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
-- Database: `projectukl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `acara`
--

CREATE TABLE `acara` (
  `id_wilayah` int(50) NOT NULL,
  `id_acara` int(5) NOT NULL,
  `nama_acara` text NOT NULL,
  `tanggal_acara` date NOT NULL,
  `tempat_acara` text NOT NULL,
  `quantity` int(3) NOT NULL,
  `id_budaya` int(11) NOT NULL,
  `harga` int(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `acara`
--

INSERT INTO `acara` (`id_wilayah`, `id_acara`, `nama_acara`, `tanggal_acara`, `tempat_acara`, `quantity`, `id_budaya`, `harga`, `deskripsi`) VALUES
(4, 24, 'Tari Reog', '2025-05-08', 'Ashton Hall', 1000, 45, 100000, 'Tari Reog adalah salah satu tarian tradisional yang berasal dari Ponorogo, Jawa Timur, Indonesia. Tarian ini merupakan bagian dari pertunjukan Reog Ponorogo, sebuah seni pertunjukan rakyat yang memadukan unsur tari, musik gamelan, drama, dan akrobat, serta memiliki nuansa magis dan spiritual yang sangat kuat. Dalam pertunjukannya, Tari Reog menampilkan karakter ikonik seperti Singa Barong—topeng besar berbentuk kepala singa berhias bulu merak yang bisa mencapai berat puluhan kilogram dan dibawa dengan kekuatan gigi oleh penarinya. Selain itu, ada juga penari Jathilan (kuda lumping), Warok, dan Gemblak yang masing-masing memiliki peran tersendiri dalam alur cerita yang biasanya mengisahkan tentang keberanian, kekuatan, dan perjuangan. Tari Reog tidak hanya menjadi hiburan, tetapi juga mencerminkan identitas budaya dan nilai-nilai luhur masyarakat Ponorogo.'),
(2, 27, 'Hari Batik Nasional', '2025-05-12', 'Taman Monas', 1000, 43, 30000, 'Hari Batik Nasional ditetapkan oleh pemerintah Indonesia untuk memperingati pengakuan batik sebagai warisan budaya dunia oleh UNESCO. Pada tanggal 2 Oktober 2009, UNESCO secara resmi memasukkan batik Indonesia ke dalam daftar Representative List of the Intangible Cultural Heritage of Humanity.  Sejak saat itu, setiap tanggal 2 Oktober, masyarakat Indonesia dianjurkan untuk mengenakan batik sebagai bentuk kebanggaan terhadap warisan budaya bangsa.'),
(3, 28, 'Pagelaran Wayang', '2025-05-28', 'Mall Yogyakarta', 500, 44, 50000, 'Pagelaran wayang adalah pertunjukan seni tradisional Indonesia yang menampilkan cerita-cerita epik melalui boneka wayang dan diiringi musik gamelan serta narasi dari seorang dalang. Wayang memiliki berbagai jenis, seperti wayang kulit, wayang golek, dan wayang orang, yang masing-masing memiliki bentuk dan teknik pertunjukan yang berbeda.  Cerita yang dibawakan biasanya berasal dari epos Ramayana dan Mahabharata, atau legenda dan cerita lokal seperti Panji. Dalam pertunjukan wayang, dalang memainkan peran penting sebagai narator, pengisi suara tokoh-tokoh, sekaligus pengatur jalannya cerita dan irama musik.  Pagelaran wayang bukan sekadar hiburan, tetapi juga sarat dengan nilai filsafat, moral, budaya, dan spiritualitas. Pertunjukan ini sering digunakan dalam upacara adat, perayaan, atau kegiatan kebudayaan untuk menyampaikan pesan-pesan kehidupan kepada masyarakat.'),
(19, 35, 'panji x pirlo collaboration', '2025-06-01', 'Hall astom', 99999, 44, 1050500, 'kolab');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_tradisional`
--

CREATE TABLE `barang_tradisional` (
  `nama_barang` text NOT NULL,
  `gambar_barang` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_barang` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_tradisional`
--

INSERT INTO `barang_tradisional` (`nama_barang`, `gambar_barang`, `id_barang`, `harga_barang`) VALUES
('Blangkon', 'blangkon1.png', 4, 50000),
('Baju Batik', 'batik.jpg', 5, 100000),
('Angklung', 'angklung.png', 6, 70000),
('Topeng Bali', 'topeng.png', 7, 100000),
('Baju lurik', 'lurik.jpg', 8, 400000),
('panji', 'Cuplikan layar 2025-05-31 220754.png', 12, 1000000),
('tok', 'Cuplikan layar 2025-05-28 202908.png', 13, 5000000),
('haha', 'Cuplikan layar 2025-05-29 194713.png', 14, 2147483647),
('pirlo', 'Cuplikan layar 2025-05-21 180557.png', 15, 99999999);

-- --------------------------------------------------------

--
-- Struktur dari tabel `budaya`
--

CREATE TABLE `budaya` (
  `nama_budaya` text NOT NULL,
  `id_budaya` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `budaya`
--

INSERT INTO `budaya` (`nama_budaya`, `id_budaya`, `id_wilayah`) VALUES
('Budaya10', 43, 2),
('Budaya5', 44, 2),
('Budaya7', 45, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_proof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `payment_method`, `total_amount`, `status`, `created_at`, `updated_at`, `payment_proof`) VALUES
(2, 34, 'Bergkamp', 'demzzonata@gmail.com', '08123456789', 'jl.poco', 'cod', 1070000.00, 'cancelled', '2025-05-13 07:51:12', '2025-05-15 10:01:25', NULL),
(3, 33, 'sca', 'nadimnibos@gmail.com', '22', 'dff', 'ewallet', 150000.00, 'cancelled', '2025-05-13 08:50:21', '2025-05-13 21:19:01', NULL),
(4, 33, 'jbb', 'naadhim.fahly34@smk.belajar.id', '12', 'c  cds s', 'ewallet', 100000.00, 'cancelled', '2025-05-13 08:59:02', '2025-05-13 21:19:07', NULL),
(5, 33, '3d', 'demzzonata@gmail.com', '081252060878', 'wef', 'ewallet', 100000.00, 'cancelled', '2025-05-13 09:01:51', '2025-05-14 14:43:36', NULL),
(7, 33, 'Sura bubble pubg', 'nadimnibos@gmail.com', '081252060878', 'jl.siwalan panji\r\n', 'ewallet', 50000.00, 'cancelled', '2025-05-13 09:18:49', '2025-05-15 09:35:03', 'proof_682444727c8f2_Cuplikan layar 2025-05-08 191716.png'),
(8, 33, 'Blupblup', 'naadhim_mubaarok_ts7_24@student.sda.sch.id', '22', 'tyjd', 'ewallet', 130000.00, 'shipped', '2025-05-13 09:33:31', '2025-05-14 14:44:42', 'proof_68244461a516e_Cuplikan layar 2025-05-14 125920.png'),
(9, 40, 'nadem', 'nadimnibos@gmail.com', '081252060878', 'jl.toma', 'ewallet', 600000.00, 'pending', '2025-05-13 09:44:09', '2025-05-13 09:44:09', 'proof_6822b1f9d2076_Cuplikan layar 2024-11-07 163525.png'),
(10, 40, 'feds', 'demzzonata@gmail.com', '12', 'ewvf', 'ewallet', 60000.00, 'pending', '2025-05-13 10:06:54', '2025-05-13 10:06:54', 'proof_6822b74e4477b_Cuplikan layar 2024-11-29 093700.png'),
(11, 40, 'ytjt', 'demzzonata@gmail.com', '08123456789', 'jydt', 'ewallet', 50000.00, 'pending', '2025-05-13 10:11:00', '2025-05-13 10:11:00', 'proof_6822b8440060f_Instagram-Logo.png'),
(12, 40, 'ntr', 'demzzonata@gmail.com', '081252060878', 'erb', 'ewallet', 220000.00, 'pending', '2025-05-13 10:14:38', '2025-05-13 10:14:38', 'proof_6822b91eec6ba_logo n.jpeg'),
(13, 40, 'Oi oi oi', 'demzzonata@gmail.com', '08123456789', 'dtyutduyk', 'ewallet', 180000.00, 'paid', '2025-05-13 10:53:56', '2025-05-31 19:19:54', 'proof_683af3ea94ebc_Cuplikan layar 2025-05-29 194713.png'),
(15, 33, 'Sura bubble pubg', 'demzzonata@gmail.com', '081252060878', 'jl.dorops\r\n', 'ewallet', 70000.00, 'completed', '2025-05-13 11:42:37', '2025-05-13 21:03:34', 'proof_6822cdbceff18_Instagram-Logo.png'),
(16, 33, 'dem', 'nadimnibos@gmail.com', '081252060878', 'jl.dongkak', 'ewallet', 3320000.00, 'cancelled', '2025-05-14 14:04:49', '2025-05-14 14:10:33', 'proof_68244091e9d19_Cuplikan layar 2025-05-14 125920.png'),
(17, 33, 'dem', 'nadimnibos@gmail.com', '081252060878', 'ytj', 'ewallet', 70000.00, 'cancelled', '2025-05-14 14:10:19', '2025-05-14 14:39:58', 'proof_682441db96ec7_Cuplikan layar 2024-11-07 163525.png'),
(18, 33, 'dem', 'demzzonata@gmail.com', '08123456789', 'dyk', 'ewallet', 130000.00, 'shipped', '2025-05-14 14:26:27', '2025-05-14 14:44:33', 'proof_682445b7a7f36_Cuplikan layar 2025-05-13 100814.png'),
(19, 33, 'dem', 'demzzonata@gmail.com', '08123456789', 'yuk', 'ewallet', 100000.00, 'cancelled', '2025-05-14 14:45:42', '2025-05-15 09:34:52', 'proof_6825527b967dd_Cuplikan layar 2025-04-29 130743.png'),
(20, 33, 'dsv', 'nadimnibos@gmail.com', '081252060878', 'sdzvvds', 'ewallet', 430000.00, 'paid', '2025-05-15 09:02:49', '2025-05-15 09:03:38', 'proof_68254b7a57fb3_Cuplikan layar 2025-05-14 125920.png'),
(21, 33, 'Oi oi oi', 'demzzonata@gmail.com', '22', 'pidshvjpd', 'ewallet', 60000.00, 'paid', '2025-05-15 09:04:07', '2025-05-15 09:06:43', 'proof_68254c33e8e45_Cuplikan layar 2025-05-14 125920.png'),
(22, 33, 'dem', 'nadimnibos@gmail.com', '081252060878', 'oiug', 'ewallet', 30000.00, 'paid', '2025-05-15 09:07:44', '2025-05-15 09:15:08', 'proof_68254e2c18040_Cuplikan layar 2025-05-13 211417.png'),
(23, 33, 'dem', 'demzzonata@gmail.com', '22', 'sdhkjcb ', 'ewallet', 30000.00, 'paid', '2025-05-15 09:15:27', '2025-05-15 09:18:34', 'proof_68254efa35c2e_Cuplikan layar 2025-04-29 133454.png'),
(24, 33, 'dem', 'demzzonata@gmail.com', '081252060878', 'jlkonqas', 'ewallet', 30000.00, 'completed', '2025-05-15 09:18:54', '2025-05-15 09:35:32', 'proof_68254f15508dd_Cuplikan layar 2025-05-12 071931.png'),
(25, 33, 'Oi oi oi', 'nadimnibos@gmail.com', '081252060878', 'odsubcloc', 'ewallet', 150000.00, 'cancelled', '2025-05-15 09:36:33', '2025-05-15 09:47:52', 'proof_682555c8d7023_Cuplikan layar 2025-05-08 195815.png'),
(26, 33, 'dem', 'nadimnibos@gmail.com', '08123456789', 'phoi', 'ewallet', 250000.00, 'cancelled', '2025-05-15 09:50:06', '2025-05-22 13:30:37', 'proof_68255672d97f6_Cuplikan layar 2025-05-05 102708.png'),
(27, 34, 'dem', 'nadimnibos@gmail.com', '081252060878', 'halo halo', 'ewallet', 150000.00, 'paid', '2025-05-15 13:55:20', '2025-05-15 13:55:42', 'proof_68258feeacc59_e-ticket (4).jpg'),
(29, 34, 'dem', 'telkom@gmail.com', '081252060878', 'telkom', 'ewallet', 350000.00, 'pending', '2025-05-20 14:45:45', '2025-05-20 14:45:45', NULL),
(32, 34, 'Naadhim Fahly Mubaarok', 'nadimnibos@gmail.com', '081252060878', 'Jl. Pecantingan', 'ewallet', 400000.00, 'pending', '2025-05-21 18:01:50', '2025-05-21 18:01:50', NULL),
(33, 34, 'Naadhim Fahly Mubaarok', 'nadimnibos@gmail.com', '081252060878', 'Jl. Pecantingan', 'ewallet', 400000.00, 'cancelled', '2025-05-22 07:25:22', '2025-05-22 07:26:32', 'proof_682e6f194dd03_fardan.jpg'),
(35, 57, 'Naadhim Fahly Mubaarok', 'nadimnibos@gmail.com', '081252060878', 'Jl. Pecantingan', 'ewallet', 30000.00, 'cancelled', '2025-06-01 13:32:17', '2025-06-01 13:34:53', 'proof_683bf425be67a_Cuplikan layar 2025-05-21 180557.png'),
(36, 57, 'Naadhim Fahly Mubaarok', 'nadimnibos@gmail.com', '081252060878', 'Jl. Pecantingan', 'ewallet', 99999999.99, 'paid', '2025-06-01 13:48:20', '2025-06-01 13:48:29', 'proof_683bf7bdbdc51_Cuplikan layar 2025-05-31 132041.png'),
(37, 33, 'Naadhim Fahly Mubaarok', 'nadimnibos@gmail.com', '081252060878', 'Jl. Pecantingan', 'ewallet', 99999999.99, 'pending', '2025-06-02 12:58:28', '2025-06-02 12:58:28', NULL),
(38, 34, 'Naadhim Fahly Mubaarok', 'nadimnibos@gmail.com', '081252060878', 'Jl. Pecantingan', 'ewallet', 80000.00, 'paid', '2025-06-05 07:57:11', '2025-06-05 08:12:44', 'proof_6840ef0cd1d79_Cuplikan layar 2025-06-04 195024.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_type`, `product_id`, `product_name`, `quantity`, `price`, `subtotal`) VALUES
(6, 2, 'acara', 24, 'Tari Reog', 1, 100000.00, 100000.00),
(7, 2, 'acara', 28, 'Pagelaran Wayang', 1, 50000.00, 50000.00),
(8, 3, 'barang', 4, 'Blangkon', 1, 50000.00, 50000.00),
(9, 3, 'barang', 5, 'Baju Batik', 1, 100000.00, 100000.00),
(10, 4, 'barang', 7, 'Topeng Bali', 1, 100000.00, 100000.00),
(11, 5, 'barang', 5, 'Baju Batik', 1, 100000.00, 100000.00),
(13, 7, 'acara', 28, 'Pagelaran Wayang', 1, 50000.00, 50000.00),
(14, 8, 'acara', 24, 'Tari Reog', 1, 100000.00, 100000.00),
(15, 8, 'acara', 27, 'Hari Batik Nasional', 1, 30000.00, 30000.00),
(16, 9, 'barang', 8, 'Baju lurik', 1, 400000.00, 400000.00),
(17, 9, 'barang', 7, 'Topeng Bali', 1, 100000.00, 100000.00),
(18, 9, 'acara', 24, 'Tari Reog', 1, 100000.00, 100000.00),
(19, 10, 'acara', 27, 'Hari Batik Nasional', 2, 30000.00, 60000.00),
(20, 11, 'acara', 28, 'Pagelaran Wayang', 1, 50000.00, 50000.00),
(21, 12, 'barang', 6, 'Angklung', 1, 70000.00, 70000.00),
(22, 12, 'acara', 28, 'Pagelaran Wayang', 1, 50000.00, 50000.00),
(23, 12, 'acara', 24, 'Tari Reog', 1, 100000.00, 100000.00),
(24, 13, 'barang', 5, 'Baju Batik', 1, 100000.00, 100000.00),
(25, 13, 'acara', 27, 'Hari Batik Nasional', 1, 30000.00, 30000.00),
(26, 13, 'acara', 28, 'Pagelaran Wayang', 1, 50000.00, 50000.00),
(28, 15, 'barang', 6, 'Angklung', 1, 70000.00, 70000.00),
(29, 16, 'barang', 6, 'Angklung', 3, 70000.00, 210000.00),
(30, 16, 'barang', 8, 'Baju lurik', 7, 400000.00, 2800000.00),
(31, 16, 'acara', 27, 'Hari Batik Nasional', 2, 30000.00, 60000.00),
(32, 16, 'acara', 28, 'Pagelaran Wayang', 5, 50000.00, 250000.00),
(33, 17, 'barang', 6, 'Angklung', 1, 70000.00, 70000.00),
(34, 18, 'barang', 5, 'Baju Batik', 1, 100000.00, 100000.00),
(35, 18, 'acara', 27, 'Hari Batik Nasional', 1, 30000.00, 30000.00),
(36, 19, 'barang', 4, 'Blangkon', 1, 50000.00, 50000.00),
(37, 19, 'acara', 28, 'Pagelaran Wayang', 1, 50000.00, 50000.00),
(38, 20, 'barang', 8, 'Baju lurik', 1, 400000.00, 400000.00),
(39, 20, 'acara', 27, 'Hari Batik Nasional', 1, 30000.00, 30000.00),
(40, 21, 'acara', 27, 'Hari Batik Nasional', 2, 30000.00, 60000.00),
(41, 22, 'acara', 27, 'Hari Batik Nasional', 1, 30000.00, 30000.00),
(42, 23, 'acara', 27, 'Hari Batik Nasional', 1, 30000.00, 30000.00),
(43, 24, 'acara', 27, 'Hari Batik Nasional', 1, 30000.00, 30000.00),
(44, 25, 'acara', 28, 'Pagelaran Wayang', 1, 50000.00, 50000.00),
(45, 25, 'acara', 24, 'Tari Reog', 1, 100000.00, 100000.00),
(46, 26, 'barang', 7, 'Topeng Bali', 1, 100000.00, 100000.00),
(47, 26, 'acara', 24, 'Tari Reog', 1, 100000.00, 100000.00),
(48, 26, 'acara', 28, 'Pagelaran Wayang', 1, 50000.00, 50000.00),
(49, 27, 'barang', 6, 'Angklung', 1, 70000.00, 70000.00),
(50, 27, 'barang', 4, 'Blangkon', 1, 50000.00, 50000.00),
(51, 27, 'acara', 27, 'Hari Batik Nasional', 1, 30000.00, 30000.00),
(57, 29, 'barang', 6, 'Angklung', 5, 70000.00, 350000.00),
(63, 32, 'barang', 8, 'Baju lurik', 1, 400000.00, 400000.00),
(64, 33, 'barang', 8, 'Baju lurik', 1, 400000.00, 400000.00),
(66, 35, 'acara', 27, 'Hari Batik Nasional', 1, 30000.00, 30000.00),
(67, 36, 'barang', 15, 'pirlo', 11, 99999999.00, 99999999.99),
(68, 36, 'barang', 14, 'haha', 2, 99999999.99, 99999999.99),
(69, 36, 'barang', 13, 'tok', 2, 5000000.00, 10000000.00),
(70, 37, 'barang', 12, 'panji', 1, 1000000.00, 1000000.00),
(71, 37, 'barang', 13, 'tok', 1, 5000000.00, 5000000.00),
(72, 37, 'barang', 15, 'pirlo', 1, 99999999.00, 99999999.00),
(73, 37, 'acara', 35, 'panji x pirlo collaboration', 1, 1050500.00, 1050500.00),
(74, 38, 'barang', 4, 'Blangkon', 1, 50000.00, 50000.00),
(75, 38, 'acara', 27, 'Hari Batik Nasional', 1, 30000.00, 30000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(33, 'admin', '$2y$10$fUsEsx/A8uNzfPSrtDAdfemtz8KkYX1Eo1euALzM9CXOL3zPj9vlu'),
(34, '123', '$2y$10$IDo1gI/dTcZvL6MEfNHVDOLSPQMdYHxz39hFAK9xKEAi4j669.Ilu'),
(40, 'nadem', '$2y$10$fZf3jRf9qVGOPTXvsPP4H.Sa/fYep5DIWI/AUQqhN8YWmXxo2CFPe'),
(41, '100', '$2y$10$BdHYKDOPI93PAxeXVISNy.fz.YPolveHgx/NlT5bVHacjCrlUhFzO'),
(42, 'hol', '$2y$10$.iMnNGzqaaN9pil0HBZpnOzpOHw7YsV3ROPyg9axeHfxHoKHN5UnG'),
(43, '1234', '$2y$10$PJnrLtYk.whA4Q2EbzQzzuAqD1jhMa.rQx0EPktA3tveDaN20FXUK'),
(46, 'Naadhim Fahly Mubaarok', '$2y$10$esHKHRNEsC7981bH9f81f.kfpKsJ4Jrqe5tWbWtHEmLD5qSIadnS.'),
(49, 'messi', '$2y$10$WipIby2cZGaXyKFdi1SDGuWkZOAjsJnp0rhqsO48930ld9aHmuEum'),
(50, 'pirlo', '$2y$10$OaAQNg61qDCVba9D7YzAAOiSSqtczaFQ.lDRo.4lFvwboudt5Bl4q'),
(51, 'qqq', '$2y$10$zN24EZ0fobA9ghCiCGsEj.tJyPvnWvRLKT8fI.WZOEBG.nn9yULOe'),
(52, 'oke', '$2y$10$nFQF6gUzX0Kr4K8c1fkOgOCiXJiEcL12.RI.eqGYOmw7Z76T8r4Iy'),
(53, 'eee', '$2y$10$USF8i49XCmmc1zCZjm4zxOcOztf/FO2J0WqRbqr/IlEojgIddgJpy'),
(54, 'er', '$2y$10$QJ4XoC5.2FKNIMfAR6bt3Of/.UJ16yPTIgST8Dm8HkIV33MoDnh2u'),
(55, 'abis', '$2y$10$lFaVfEwSIlvecdJ2pkx27.vGwdxz2u8pvVxjhQrWv7GUfMhG8K/s6'),
(56, 'blitz', '$2y$10$FMFJtxSY96r/sz8apK2MM.0vg5jUuufx/ZkzPiaA9vqcMBflfnIi6'),
(57, 'curler', '$2y$10$yB12giPesaOIFI9b7D2jv.Dzp37/txGoSf5Ndgq9FOEPiTgw1UhfK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wilayah`
--

CREATE TABLE `wilayah` (
  `id_wilayah` int(11) NOT NULL,
  `nama_wilayah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wilayah`
--

INSERT INTO `wilayah` (`id_wilayah`, `nama_wilayah`) VALUES
(2, 'JAWA BARAT'),
(3, 'JAWA TENGAH'),
(4, 'JAWA TIMUR'),
(14, 'SUMATRA UTARA'),
(15, 'SUMATRA BARAT'),
(16, 'SUMATRA TENGAH'),
(17, 'SUMATRA SELATAN'),
(18, 'SUMATRA TIMUR'),
(19, 'BALI'),
(20, 'KALIMANTAN BARAT'),
(21, 'KALIMANTAN TENGAH'),
(22, 'KALIMANTAN TIMUR'),
(23, 'KALIMANTAN UTARA'),
(24, 'KALIMANTAN SELATAN'),
(25, 'SULAWESI UTARA'),
(26, 'SULAWESI TENGAH'),
(27, 'SULAWESI BARAT'),
(28, 'SULAWESI TIMUR'),
(29, 'SULAWESI SELATAN'),
(30, 'PAPUA'),
(31, 'SULAWESI TENGGARA'),
(32, 'NUSA TENGGARA BARAT'),
(33, 'NUSA TENGGARA TIMUR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wilayah_content`
--

CREATE TABLE `wilayah_content` (
  `id` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `unique_facts` text DEFAULT NULL,
  `culture_items` text DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wilayah_content`
--

INSERT INTO `wilayah_content` (`id`, `id_wilayah`, `description`, `unique_facts`, `culture_items`, `title`) VALUES
(2, 2, 'Sebagai tanah kelahiran budaya Sunda, Jawa Barat menyimpan warisan budaya yang sangat kaya. Tidak hanya dikenal melalui bahasa dan keseniannya, Jawa Barat juga menjadi rumah bagi banyak tradisi unik yang terus dilestarikan. Penduduknya terkenal ramah, dan kehidupan sehari-hari mereka sangat dipengaruhi oleh nilai-nilai kekeluargaan serta kearifan lokal.', '-Bahasa Sunda diajarkan sebagai mata pelajaran wajib di sekolah dasar dan menengah di Jawa Barat.\r\n-Angklung dibuat dari bambu dan dimainkan dengan cara digoyangkan. Masing-masing alat memiliki nada tertentu, sehingga harus dimainkan bersama dalam harmoni.\r\n-Kesenian Reak atau Sisingaan biasa ditampilkan dalam perayaan sunatan, dengan anak yang duduk di atas boneka singa diiringi musik dan tarian.\r\n-Budaya gotong royong di pedesaan Jawa Barat masih sangat kental, seperti dalam acara panen, pembangunan rumah, hingga pernikahan.', 'Jawa Barat memiliki banyak tradisi yang masih dijalankan hingga saat ini, seperti:\r\n-Ngabungbang: Tradisi mandi bersama di sungai atau sumber air alami pada malam bulan purnama, dipercaya dapat membersihkan diri lahir dan batin.\r\n-Seren Taun: Upacara adat masyarakat Sunda yang dilakukan sebagai bentuk syukur atas hasil panen, biasanya diselenggarakan di wilayah adat seperti Cigugur dan Kasepuhan Ciptagelar.\r\n-Ngaruat: Ritual yang dilakukan untuk membersihkan seseorang dari nasib buruk atau kesialan berdasarkan kepercayaan tradisional.\r\n\r\nKesenian Tradisional\r\n-Jawa Barat memiliki banyak seni pertunjukan yang khas:\r\n-Wayang Golek: Teater boneka kayu tiga dimensi yang disertai gamelan dan sinden.\r\n-Tari Jaipongan: Tari kontemporer berbasis tradisi Sunda yang diciptakan oleh Gugum Gumbira pada 1970-an, penuh semangat dan gerakan energik.\r\n-Calung dan Angklung: Instrumen bambu tradisional yang dimainkan secara kelompok. Angklung bahkan sudah diakui UNESCO sebagai warisan budaya dunia.\r\n\r\nKuliner Khas\r\nKuliner di Jawa Barat menawarkan rasa yang khas dengan dominasi rasa asin, asam, dan pedas. Beberapa makanan khas antara lain:\r\n-Seblak: Makanan pedas berbahan dasar kerupuk basah dengan bumbu kencur.\r\n-Surabi: Makanan dari adonan tepung beras yang dipanggang di atas tungku tanah liat, disajikan dengan oncom atau gula merah.\r\n-Tutug Oncom: Nasi yang dicampur dengan oncom yang dibakar, biasanya disajikan dengan ayam goreng dan lalapan.\r\n-Colenak: Singkatan dari “dicocol enak”, berupa tape singkong yang dibakar lalu disiram gula merah cair.\r\n\r\nTempat Wisata dan Sejarah\r\n-Gunung Tangkuban Parahu: Gunung berapi yang terkenal dengan kawahnya dan legenda Sangkuriang.\r\n-Candi Cangkuang: Satu-satunya candi Hindu yang ditemukan di wilayah Sunda, menunjukkan adanya pengaruh agama Hindu pada masa lalu.\r\n-Gedung Sate: Bangunan bersejarah peninggalan kolonial Belanda yang kini menjadi kantor gubernur Jawa Barat, simbol arsitektur khas Bandung.\r\n-Kampung Naga: Desa adat yang masih mempertahankan tatanan tradisional tanpa listrik dan teknologi modern.', 'Keindahan Alam dan Budaya Sunda yang Memikat'),
(3, 3, 'Jawa Tengah dikenal sebagai jantung kebudayaan Jawa. Wilayah ini menjadi pusat berkembangnya nilai-nilai tradisional Jawa yang penuh filosofi, seperti unggah-ungguh (sopan santun), tata krama, dan konsep hidup selaras dengan alam. Di tengah arus modernisasi, budaya tradisional masih hidup berdampingan dengan kehidupan masyarakat masa kini.', '-Bahasa Jawa Krama dan Ngoko digunakan sesuai tingkatan sopan santun, mencerminkan kedalaman budaya tutur masyarakat Jawa.\r\n-Ritual Ruwatan dilakukan untuk membebaskan seseorang dari \"nasib buruk\", dengan pementasan Wayang Kulit khusus.\r\n-Jawa Tengah adalah rumah bagi dua kota budaya besar: Surakarta (Solo) dan Yogyakarta meskipun secara administratif Yogyakarta adalah provinsi sendiri, keduanya masih memiliki akar budaya yang sama.\r\n-Tari Serimpi dan Bedhaya hanya dipentaskan di lingkungan keraton dan dianggap sakral.', 'Tradisi di Jawa Tengah penuh makna dan masih dilestarikan secara turun-temurun:\r\n-Sekaten: Perayaan hari kelahiran Nabi Muhammad SAW yang dirayakan dengan gamelan pusaka dan pasar malam di alun-alun Keraton Yogyakarta dan Surakarta.\r\n-Grebeg Maulud dan Grebeg Syawal: Upacara adat keraton yang menyimbolkan harmoni antara rakyat dan raja.\r\n-Tedak Siten: Tradisi untuk bayi yang pertama kali menginjak tanah, sebagai simbol kesiapan anak untuk menjalani kehidupan.\r\n\r\nKesenian Tradisional\r\nKesenian Jawa Tengah begitu luas dan dalam:\r\n-Wayang Kulit: Seni pertunjukan bayangan kulit yang dipimpin oleh dalang, mengandung ajaran moral dan falsafah hidup.\r\n-Tari Gambyong: Tarian halus dan lemah gemulai yang dahulu dipersembahkan untuk bangsawan.\r\n-Kerajinan Batik: Kota seperti Solo dan Pekalongan dikenal sebagai sentra batik, dengan motif khas seperti Parang, Kawung, dan Sekar Jagad.\r\n-Keroncong dan Campursari: Musik tradisional perpaduan alat musik barat dan irama lokal yang masih dinikmati berbagai kalangan.\r\n\r\nKuliner Khas\r\nKuliner Jawa Tengah memiliki cita rasa dominan manis dan lembut:\r\n-Gudeg: Masakan dari nangka muda yang dimasak lama dengan santan dan gula merah, biasanya disajikan dengan ayam, telur, dan krecek.\r\n-Soto Kudus dan Soto Semarang: Dua varian soto khas dengan kuah bening dan isian daging ayam atau sapi.\r\n-Lumpia Semarang: Kulit tipis berisi rebung, ayam, dan udang, bisa digoreng atau basah.\r\n-Tahu Gimbal: Sajian tahu goreng dengan udang goreng tepung (gimbal), kol, dan bumbu kacang khas.\r\n\r\nTempat Sejarah dan Budaya\r\n-Candi Borobudur: Candi Buddha terbesar di dunia, simbol kejayaan Dinasti Syailendra, dan telah diakui UNESCO.\r\n-Candi Prambanan: Candi Hindu terbesar di Indonesia, dengan legenda Roro Jonggrang yang melegenda.\r\n-Keraton Surakarta dan Pura Mangkunegaran: Istana kerajaan yang masih aktif menjaga budaya Jawa klasik.\r\n-Kota Lama Semarang: Kawasan berarsitektur kolonial Belanda yang kini menjadi destinasi wisata budaya dan sejarah.', 'Harmoni Budaya Jawa yang Luhur'),
(4, 4, 'Jawa Timur merupakan provinsi yang sarat sejarah dan dinamika budaya. Wilayah ini menjadi tempat lahir dan berkembangnya Kerajaan Majapahit, salah satu kerajaan terbesar di Nusantara. Budaya masyarakatnya merupakan perpaduan antara nilai-nilai Jawa Timur asli, pengaruh Hindu-Buddha, serta sentuhan Islam yang kuat, menghasilkan tradisi yang unik dan penuh semangat kebersamaan.', '-Bahasa Jawa Timur lebih lugas dan ekspresif, berbeda dengan Jawa Tengah yang halus. Dialek \"Arek\" di Surabaya dan \"Mataraman\" di Kediri menambah kekayaan bahasa daerah.\r\n-Reyog Ponorogo telah diajukan sebagai Warisan Budaya Dunia ke UNESCO karena nilai filosofis dan spiritual yang tinggi.\r\n-Jawa Timur memiliki keberagaman sub-etnis, termasuk masyarakat Madura, Osing (Banyuwangi), dan Tengger (sekitar Bromo).\r\n-Festival Gandrung Sewu di Pantai Boom Banyuwangi menampilkan ribuan penari Gandrung, menjadi atraksi budaya berskala internasional.', '-Larung Saji: Tradisi melarung sesajen ke laut sebagai ungkapan syukur masyarakat pesisir, seperti di Banyuwangi dan Tulungagung.\r\n-Unan-Unan: Upacara adat masyarakat Madura yang diadakan setiap tahun sekali sebagai bentuk tolak bala dan penghormatan leluhur.\r\n-Reog Ponorogo: Sebuah pertunjukan budaya penuh makna, yang menampilkan barongan besar dengan topeng Singo Barong dan tarian warok.\r\n\r\nKesenian Tradisional\r\n-Ludruk: Seni teater rakyat yang dibawakan dalam bahasa Jawa Timuran, mengangkat kisah keseharian dengan selipan humor.\r\n-Tari Remo: Tarian penyambutan yang energik, sering menjadi pembuka pertunjukan Wayang Topeng atau Ludruk.\r\n-Karapan Sapi: Tradisi pacuan sapi yang berasal dari Madura, bukan hanya olahraga tetapi juga simbol status sosial.\r\n-Gandrung Banyuwangi: Tarian tradisional sebagai wujud rasa syukur masyarakat nelayan, dengan gerakan lemah gemulai namun ekspresif.\r\n\r\nKuliner Khas\r\n-Rawon: Sup daging berkuah hitam khas Surabaya, menggunakan kluwek sebagai bahan utama.\r\n-Rujak Cingur: Hidangan campuran sayur, buah, dan irisan moncong sapi (cingur), dengan bumbu kacang dan petis.\r\n-Soto Lamongan: Soto berkuah kuning dengan koya, sangat populer dan tersebar ke berbagai daerah.\r\n-Pecel Madiun: Sayuran rebus dengan siraman sambal kacang, disajikan dengan rempeyek dan nasi hangat.\r\n\r\nTempat Sejarah dan Budaya\r\n-Trowulan: Situs bekas pusat Kerajaan Majapahit yang menyimpan banyak peninggalan arkeologis.\r\n-Gunung Bromo: Gunung berapi aktif yang tidak hanya menjadi destinasi wisata alam, tetapi juga tempat upacara adat Yadnya Kasada oleh masyarakat Tengger.\r\n-Masjid Agung Sunan Ampel: Masjid bersejarah di Surabaya yang menjadi pusat penyebaran Islam oleh Wali Songo.\r\n-Museum Mpu Tantular: Museum yang menyimpan berbagai koleksi budaya dan sejarah Jawa Timur.', 'Dinamika Budaya di Tanah Majapahit'),
(5, 3, 'Jawa Tengah dikenal sebagai jantung kebudayaan Jawa. Wilayah ini menjadi pusat berkembangnya nilai-nilai tradisional Jawa yang penuh filosofi, seperti unggah-ungguh (sopan santun), tata krama, dan konsep hidup selaras dengan alam. Di tengah arus modernisasi, budaya tradisional masih hidup berdampingan dengan kehidupan masyarakat masa kini.', '-Bahasa Jawa Krama dan Ngoko digunakan sesuai tingkatan sopan santun, mencerminkan kedalaman budaya tutur masyarakat Jawa.\r\n-Ritual Ruwatan dilakukan untuk membebaskan seseorang dari \"nasib buruk\", dengan pementasan Wayang Kulit khusus.\r\n-Jawa Tengah adalah rumah bagi dua kota budaya besar: Surakarta (Solo) dan Yogyakarta meskipun secara administratif Yogyakarta adalah provinsi sendiri, keduanya masih memiliki akar budaya yang sama.\r\n-Tari Serimpi dan Bedhaya hanya dipentaskan di lingkungan keraton dan dianggap sakral.', 'Tradisi di Jawa Tengah penuh makna dan masih dilestarikan secara turun-temurun:\r\n-Sekaten: Perayaan hari kelahiran Nabi Muhammad SAW yang dirayakan dengan gamelan pusaka dan pasar malam di alun-alun Keraton Yogyakarta dan Surakarta.\r\n-Grebeg Maulud dan Grebeg Syawal: Upacara adat keraton yang menyimbolkan harmoni antara rakyat dan raja.\r\n-Tedak Siten: Tradisi untuk bayi yang pertama kali menginjak tanah, sebagai simbol kesiapan anak untuk menjalani kehidupan.\r\n\r\nKesenian Tradisional\r\nKesenian Jawa Tengah begitu luas dan dalam:\r\n-Wayang Kulit: Seni pertunjukan bayangan kulit yang dipimpin oleh dalang, mengandung ajaran moral dan falsafah hidup.\r\n-Tari Gambyong: Tarian halus dan lemah gemulai yang dahulu dipersembahkan untuk bangsawan.\r\n-Kerajinan Batik: Kota seperti Solo dan Pekalongan dikenal sebagai sentra batik, dengan motif khas seperti Parang, Kawung, dan Sekar Jagad.\r\n-Keroncong dan Campursari: Musik tradisional perpaduan alat musik barat dan irama lokal yang masih dinikmati berbagai kalangan.\r\n\r\nKuliner Khas\r\nKuliner Jawa Tengah memiliki cita rasa dominan manis dan lembut:\r\n-Gudeg: Masakan dari nangka muda yang dimasak lama dengan santan dan gula merah, biasanya disajikan dengan ayam, telur, dan krecek.\r\n-Soto Kudus dan Soto Semarang: Dua varian soto khas dengan kuah bening dan isian daging ayam atau sapi.\r\n-Lumpia Semarang: Kulit tipis berisi rebung, ayam, dan udang, bisa digoreng atau basah.\r\n-Tahu Gimbal: Sajian tahu goreng dengan udang goreng tepung (gimbal), kol, dan bumbu kacang khas.\r\n\r\nTempat Sejarah dan Budaya\r\n-Candi Borobudur: Candi Buddha terbesar di dunia, simbol kejayaan Dinasti Syailendra, dan telah diakui UNESCO.\r\n-Candi Prambanan: Candi Hindu terbesar di Indonesia, dengan legenda Roro Jonggrang yang melegenda.\r\n-Keraton Surakarta dan Pura Mangkunegaran: Istana kerajaan yang masih aktif menjaga budaya Jawa klasik.\r\n-Kota Lama Semarang: Kawasan berarsitektur kolonial Belanda yang kini menjadi destinasi wisata budaya dan sejarah.', 'Harmoni Budaya Jawa yang Luhur'),
(6, 3, 'Jawa Tengah dikenal sebagai jantung kebudayaan Jawa. Wilayah ini menjadi pusat berkembangnya nilai-nilai tradisional Jawa yang penuh filosofi, seperti unggah-ungguh (sopan santun), tata krama, dan konsep hidup selaras dengan alam. Di tengah arus modernisasi, budaya tradisional masih hidup berdampingan dengan kehidupan masyarakat masa kini.', '-Bahasa Jawa Krama dan Ngoko digunakan sesuai tingkatan sopan santun, mencerminkan kedalaman budaya tutur masyarakat Jawa.\r\n-Ritual Ruwatan dilakukan untuk membebaskan seseorang dari \"nasib buruk\", dengan pementasan Wayang Kulit khusus.\r\n-Jawa Tengah adalah rumah bagi dua kota budaya besar: Surakarta (Solo) dan Yogyakarta meskipun secara administratif Yogyakarta adalah provinsi sendiri, keduanya masih memiliki akar budaya yang sama.\r\n-Tari Serimpi dan Bedhaya hanya dipentaskan di lingkungan keraton dan dianggap sakral.', 'Tradisi di Jawa Tengah penuh makna dan masih dilestarikan secara turun-temurun:\r\n-Sekaten: Perayaan hari kelahiran Nabi Muhammad SAW yang dirayakan dengan gamelan pusaka dan pasar malam di alun-alun Keraton Yogyakarta dan Surakarta.\r\n-Grebeg Maulud dan Grebeg Syawal: Upacara adat keraton yang menyimbolkan harmoni antara rakyat dan raja.\r\n-Tedak Siten: Tradisi untuk bayi yang pertama kali menginjak tanah, sebagai simbol kesiapan anak untuk menjalani kehidupan.\r\n\r\nKesenian Tradisional\r\nKesenian Jawa Tengah begitu luas dan dalam:\r\n-Wayang Kulit: Seni pertunjukan bayangan kulit yang dipimpin oleh dalang, mengandung ajaran moral dan falsafah hidup.\r\n-Tari Gambyong: Tarian halus dan lemah gemulai yang dahulu dipersembahkan untuk bangsawan.\r\n-Kerajinan Batik: Kota seperti Solo dan Pekalongan dikenal sebagai sentra batik, dengan motif khas seperti Parang, Kawung, dan Sekar Jagad.\r\n-Keroncong dan Campursari: Musik tradisional perpaduan alat musik barat dan irama lokal yang masih dinikmati berbagai kalangan.\r\n\r\nKuliner Khas\r\nKuliner Jawa Tengah memiliki cita rasa dominan manis dan lembut:\r\n-Gudeg: Masakan dari nangka muda yang dimasak lama dengan santan dan gula merah, biasanya disajikan dengan ayam, telur, dan krecek.\r\n-Soto Kudus dan Soto Semarang: Dua varian soto khas dengan kuah bening dan isian daging ayam atau sapi.\r\n-Lumpia Semarang: Kulit tipis berisi rebung, ayam, dan udang, bisa digoreng atau basah.\r\n-Tahu Gimbal: Sajian tahu goreng dengan udang goreng tepung (gimbal), kol, dan bumbu kacang khas.\r\n\r\nTempat Sejarah dan Budaya\r\n-Candi Borobudur: Candi Buddha terbesar di dunia, simbol kejayaan Dinasti Syailendra, dan telah diakui UNESCO.\r\n-Candi Prambanan: Candi Hindu terbesar di Indonesia, dengan legenda Roro Jonggrang yang melegenda.\r\n-Keraton Surakarta dan Pura Mangkunegaran: Istana kerajaan yang masih aktif menjaga budaya Jawa klasik.\r\n-Kota Lama Semarang: Kawasan berarsitektur kolonial Belanda yang kini menjadi destinasi wisata budaya dan sejarah.', 'Harmoni Budaya Jawa yang Luhur');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `acara`
--
ALTER TABLE `acara`
  ADD PRIMARY KEY (`id_acara`),
  ADD KEY `budaya` (`id_budaya`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- Indeks untuk tabel `barang_tradisional`
--
ALTER TABLE `barang_tradisional`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `budaya`
--
ALTER TABLE `budaya`
  ADD PRIMARY KEY (`id_budaya`),
  ADD KEY `id_wilayah` (`id_wilayah`) USING BTREE;

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`),
  ADD KEY `nama_wilayah` (`nama_wilayah`(768)) USING HASH;

--
-- Indeks untuk tabel `wilayah_content`
--
ALTER TABLE `wilayah_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `acara`
--
ALTER TABLE `acara`
  MODIFY `id_acara` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `barang_tradisional`
--
ALTER TABLE `barang_tradisional`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `budaya`
--
ALTER TABLE `budaya`
  MODIFY `id_budaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id_wilayah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `wilayah_content`
--
ALTER TABLE `wilayah_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `acara`
--
ALTER TABLE `acara`
  ADD CONSTRAINT `acara_ibfk_1` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`),
  ADD CONSTRAINT `acara_ibfk_2` FOREIGN KEY (`id_budaya`) REFERENCES `budaya` (`id_budaya`);

--
-- Ketidakleluasaan untuk tabel `budaya`
--
ALTER TABLE `budaya`
  ADD CONSTRAINT `budaya_ibfk_1` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`);

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Ketidakleluasaan untuk tabel `wilayah_content`
--
ALTER TABLE `wilayah_content`
  ADD CONSTRAINT `wilayah_content_ibfk_1` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
