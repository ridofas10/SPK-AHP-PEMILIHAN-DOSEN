-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2025 pada 18.50
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-ahp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_alternatif`
--

CREATE TABLE `hasil_alternatif` (
  `id` int(11) NOT NULL,
  `id_alternatif` varchar(50) DEFAULT NULL,
  `id_kriteria` varchar(50) DEFAULT NULL,
  `bobot` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_alternatif`
--

INSERT INTO `hasil_alternatif` (`id`, `id_alternatif`, `id_kriteria`, `bobot`) VALUES
(1, 'a1', 'K1', 0.125),
(2, 'a2', 'K1', 0.125),
(3, 'a3', 'K1', 0.125),
(4, 'a4', 'K1', 0.125),
(5, 'a5', 'K1', 0.125),
(6, 'a6', 'K1', 0.125),
(7, 'a7', 'K1', 0.125),
(8, 'a8', 'K1', 0.125),
(9, 'a1', 'K2', 0.125),
(10, 'a2', 'K2', 0.125),
(11, 'a3', 'K2', 0.125),
(12, 'a4', 'K2', 0.125),
(13, 'a5', 'K2', 0.125),
(14, 'a6', 'K2', 0.125),
(15, 'a7', 'K2', 0.125),
(16, 'a8', 'K2', 0.125),
(17, 'a1', 'K3', 0.125),
(18, 'a2', 'K3', 0.125),
(19, 'a3', 'K3', 0.125),
(20, 'a4', 'K3', 0.125),
(21, 'a5', 'K3', 0.125),
(22, 'a6', 'K3', 0.125),
(23, 'a7', 'K3', 0.125),
(24, 'a8', 'K3', 0.125),
(25, 'a1', 'K4', 0.074552868466964),
(26, 'a2', 'K4', 0.18978062420087),
(27, 'a3', 'K4', 0.074634435262069),
(28, 'a4', 'K4', 0.19002976886996),
(29, 'a5', 'K4', 0.074716055317064),
(30, 'a6', 'K4', 0.19027941111532),
(31, 'a7', 'K4', 0.015550118917367),
(32, 'a8', 'K4', 0.19045671785039),
(33, 'a1', 'K5', 0.26255533403631),
(34, 'a2', 'K5', 0.043838241242925),
(35, 'a3', 'K5', 0.18501311521987),
(36, 'a4', 'K5', 0.072125729641913),
(37, 'a5', 'K5', 0.21211350956088),
(38, 'a6', 'K5', 0.022891016592064),
(39, 'a7', 'K5', 0.18524778589918),
(40, 'a8', 'K5', 0.016215267806849),
(41, 'a1', 'K6', 0.41910334510178),
(42, 'a2', 'K6', 0.050127577734737),
(43, 'a3', 'K6', 0.19466385407316),
(44, 'a4', 'K6', 0.077364291680817),
(45, 'a5', 'K6', 0.10914971220426),
(46, 'a6', 'K6', 0.020562760654728),
(47, 'a7', 'K6', 0.11433576080342),
(48, 'a8', 'K6', 0.014692697747103),
(49, 'a1', 'K7', 0.125),
(50, 'a2', 'K7', 0.125),
(51, 'a3', 'K7', 0.125),
(52, 'a4', 'K7', 0.125),
(53, 'a5', 'K7', 0.125),
(54, 'a6', 'K7', 0.125),
(55, 'a7', 'K7', 0.125),
(56, 'a8', 'K7', 0.125);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbandingan_alternatif`
--

CREATE TABLE `perbandingan_alternatif` (
  `id` int(11) NOT NULL,
  `id_kriteria` varchar(50) NOT NULL,
  `alternatif1` varchar(50) NOT NULL,
  `alternatif2` varchar(50) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perbandingan_alternatif`
--

INSERT INTO `perbandingan_alternatif` (`id`, `id_kriteria`, `alternatif1`, `alternatif2`, `nilai`) VALUES
(1, 'c1', 'a1', 'a2', 2.5),
(2, 'c2', 'a1', 'a2', 1),
(3, 'c1', 'a2', 'a1', 0.4),
(4, 'c2', 'a2', 'a1', 1),
(5, 'c3', 'a1', 'a2', 1),
(6, 'c3', 'a2', 'a1', 1),
(7, 'c4', 'a1', 'a2', 2.5),
(8, 'c4', 'a2', 'a1', 0.4),
(9, 'K1', 'a1', 'a2', 1),
(10, 'K1', 'a2', 'a1', 1),
(11, 'K1', 'a1', 'a3', 1),
(12, 'K1', 'a3', 'a1', 1),
(13, 'K1', 'a1', 'a4', 1),
(14, 'K1', 'a4', 'a1', 1),
(15, 'K1', 'a1', 'a5', 1),
(16, 'K1', 'a5', 'a1', 1),
(17, 'K1', 'a1', 'a6', 1),
(18, 'K1', 'a6', 'a1', 1),
(19, 'K1', 'a1', 'a7', 1),
(20, 'K1', 'a7', 'a1', 1),
(21, 'K1', 'a1', 'a8', 1),
(22, 'K1', 'a8', 'a1', 1),
(23, 'K1', 'a2', 'a3', 1),
(24, 'K1', 'a3', 'a2', 1),
(25, 'K1', 'a2', 'a4', 1),
(26, 'K1', 'a4', 'a2', 1),
(27, 'K1', 'a2', 'a5', 1),
(28, 'K1', 'a5', 'a2', 1),
(29, 'K1', 'a2', 'a6', 1),
(30, 'K1', 'a6', 'a2', 1),
(31, 'K1', 'a2', 'a7', 1),
(32, 'K1', 'a7', 'a2', 1),
(33, 'K1', 'a2', 'a8', 1),
(34, 'K1', 'a8', 'a2', 1),
(35, 'K1', 'a3', 'a4', 1),
(36, 'K1', 'a4', 'a3', 1),
(37, 'K1', 'a3', 'a5', 1),
(38, 'K1', 'a5', 'a3', 1),
(39, 'K1', 'a3', 'a6', 1),
(40, 'K1', 'a6', 'a3', 1),
(41, 'K1', 'a3', 'a7', 1),
(42, 'K1', 'a7', 'a3', 1),
(43, 'K1', 'a3', 'a8', 1),
(44, 'K1', 'a8', 'a3', 1),
(45, 'K1', 'a4', 'a5', 1),
(46, 'K1', 'a5', 'a4', 1),
(47, 'K1', 'a4', 'a6', 1),
(48, 'K1', 'a6', 'a4', 1),
(49, 'K1', 'a4', 'a7', 1),
(50, 'K1', 'a7', 'a4', 1),
(51, 'K1', 'a4', 'a8', 1),
(52, 'K1', 'a8', 'a4', 1),
(53, 'K1', 'a5', 'a6', 1),
(54, 'K1', 'a6', 'a5', 1),
(55, 'K1', 'a5', 'a7', 1),
(56, 'K1', 'a7', 'a5', 1),
(57, 'K1', 'a5', 'a8', 1),
(58, 'K1', 'a8', 'a5', 1),
(59, 'K1', 'a6', 'a7', 1),
(60, 'K1', 'a7', 'a6', 1),
(61, 'K1', 'a6', 'a8', 1),
(62, 'K1', 'a8', 'a6', 1),
(63, 'K1', 'a7', 'a8', 1),
(64, 'K1', 'a8', 'a7', 1),
(65, 'K2', 'a1', 'a2', 1),
(66, 'K2', 'a2', 'a1', 1),
(67, 'K2', 'a1', 'a3', 1),
(68, 'K2', 'a3', 'a1', 1),
(69, 'K2', 'a1', 'a4', 1),
(70, 'K2', 'a4', 'a1', 1),
(71, 'K2', 'a1', 'a5', 1),
(72, 'K2', 'a5', 'a1', 1),
(73, 'K2', 'a1', 'a6', 1),
(74, 'K2', 'a6', 'a1', 1),
(75, 'K2', 'a1', 'a7', 1),
(76, 'K2', 'a7', 'a1', 1),
(77, 'K2', 'a1', 'a8', 1),
(78, 'K2', 'a8', 'a1', 1),
(79, 'K2', 'a2', 'a3', 1),
(80, 'K2', 'a3', 'a2', 1),
(81, 'K2', 'a2', 'a4', 1),
(82, 'K2', 'a4', 'a2', 1),
(83, 'K2', 'a2', 'a5', 1),
(84, 'K2', 'a5', 'a2', 1),
(85, 'K2', 'a2', 'a6', 1),
(86, 'K2', 'a6', 'a2', 1),
(87, 'K2', 'a2', 'a7', 1),
(88, 'K2', 'a7', 'a2', 1),
(89, 'K2', 'a2', 'a8', 1),
(90, 'K2', 'a8', 'a2', 1),
(91, 'K2', 'a3', 'a4', 1),
(92, 'K2', 'a4', 'a3', 1),
(93, 'K2', 'a3', 'a5', 1),
(94, 'K2', 'a5', 'a3', 1),
(95, 'K2', 'a3', 'a6', 1),
(96, 'K2', 'a6', 'a3', 1),
(97, 'K2', 'a3', 'a7', 1),
(98, 'K2', 'a7', 'a3', 1),
(99, 'K2', 'a3', 'a8', 1),
(100, 'K2', 'a8', 'a3', 1),
(101, 'K2', 'a4', 'a5', 1),
(102, 'K2', 'a5', 'a4', 1),
(103, 'K2', 'a4', 'a6', 1),
(104, 'K2', 'a6', 'a4', 1),
(105, 'K2', 'a4', 'a7', 1),
(106, 'K2', 'a7', 'a4', 1),
(107, 'K2', 'a4', 'a8', 1),
(108, 'K2', 'a8', 'a4', 1),
(109, 'K2', 'a5', 'a6', 1),
(110, 'K2', 'a6', 'a5', 1),
(111, 'K2', 'a5', 'a7', 1),
(112, 'K2', 'a7', 'a5', 1),
(113, 'K2', 'a5', 'a8', 1),
(114, 'K2', 'a8', 'a5', 1),
(115, 'K2', 'a6', 'a7', 1),
(116, 'K2', 'a7', 'a6', 1),
(117, 'K2', 'a6', 'a8', 1),
(118, 'K2', 'a8', 'a6', 1),
(119, 'K2', 'a7', 'a8', 1),
(120, 'K2', 'a8', 'a7', 1),
(121, 'K3', 'a1', 'a2', 1),
(122, 'K3', 'a2', 'a1', 1),
(123, 'K3', 'a1', 'a3', 1),
(124, 'K3', 'a3', 'a1', 1),
(125, 'K3', 'a1', 'a4', 1),
(126, 'K3', 'a4', 'a1', 1),
(127, 'K3', 'a1', 'a5', 1),
(128, 'K3', 'a5', 'a1', 1),
(129, 'K3', 'a1', 'a6', 1),
(130, 'K3', 'a6', 'a1', 1),
(131, 'K3', 'a1', 'a7', 1),
(132, 'K3', 'a7', 'a1', 1),
(133, 'K3', 'a1', 'a8', 1),
(134, 'K3', 'a8', 'a1', 1),
(135, 'K3', 'a2', 'a3', 1),
(136, 'K3', 'a3', 'a2', 1),
(137, 'K3', 'a2', 'a4', 1),
(138, 'K3', 'a4', 'a2', 1),
(139, 'K3', 'a2', 'a5', 1),
(140, 'K3', 'a5', 'a2', 1),
(141, 'K3', 'a2', 'a6', 1),
(142, 'K3', 'a6', 'a2', 1),
(143, 'K3', 'a2', 'a7', 1),
(144, 'K3', 'a7', 'a2', 1),
(145, 'K3', 'a2', 'a8', 1),
(146, 'K3', 'a8', 'a2', 1),
(147, 'K3', 'a3', 'a4', 1),
(148, 'K3', 'a4', 'a3', 1),
(149, 'K3', 'a3', 'a5', 1),
(150, 'K3', 'a5', 'a3', 1),
(151, 'K3', 'a3', 'a6', 1),
(152, 'K3', 'a6', 'a3', 1),
(153, 'K3', 'a3', 'a7', 1),
(154, 'K3', 'a7', 'a3', 1),
(155, 'K3', 'a3', 'a8', 1),
(156, 'K3', 'a8', 'a3', 1),
(157, 'K3', 'a4', 'a5', 1),
(158, 'K3', 'a5', 'a4', 1),
(159, 'K3', 'a4', 'a6', 1),
(160, 'K3', 'a6', 'a4', 1),
(161, 'K3', 'a4', 'a7', 1),
(162, 'K3', 'a7', 'a4', 1),
(163, 'K3', 'a4', 'a8', 1),
(164, 'K3', 'a8', 'a4', 1),
(165, 'K3', 'a5', 'a6', 1),
(166, 'K3', 'a6', 'a5', 1),
(167, 'K3', 'a5', 'a7', 1),
(168, 'K3', 'a7', 'a5', 1),
(169, 'K3', 'a5', 'a8', 1),
(170, 'K3', 'a8', 'a5', 1),
(171, 'K3', 'a6', 'a7', 1),
(172, 'K3', 'a7', 'a6', 1),
(173, 'K3', 'a6', 'a8', 1),
(174, 'K3', 'a8', 'a6', 1),
(175, 'K3', 'a7', 'a8', 1),
(176, 'K3', 'a8', 'a7', 1),
(177, 'K4', 'a1', 'a2', 0.33),
(178, 'K4', 'a2', 'a1', 3.0303),
(179, 'K4', 'a1', 'a3', 1),
(180, 'K4', 'a3', 'a1', 1),
(181, 'K4', 'a1', 'a4', 0.33),
(182, 'K4', 'a4', 'a1', 3.0303),
(183, 'K4', 'a1', 'a5', 1),
(184, 'K4', 'a5', 'a1', 1),
(185, 'K4', 'a1', 'a6', 0.33),
(186, 'K4', 'a6', 'a1', 3.0303),
(187, 'K4', 'a1', 'a7', 9),
(188, 'K4', 'a7', 'a1', 0.111111),
(189, 'K4', 'a1', 'a8', 0.33),
(190, 'K4', 'a8', 'a1', 3.0303),
(191, 'K4', 'a2', 'a3', 3),
(192, 'K4', 'a3', 'a2', 0.333333),
(193, 'K4', 'a2', 'a4', 1),
(194, 'K4', 'a4', 'a2', 1),
(195, 'K4', 'a2', 'a5', 3),
(196, 'K4', 'a5', 'a2', 0.333333),
(197, 'K4', 'a2', 'a6', 1),
(198, 'K4', 'a6', 'a2', 1),
(199, 'K4', 'a2', 'a7', 9),
(200, 'K4', 'a7', 'a2', 0.111111),
(201, 'K4', 'a2', 'a8', 1),
(202, 'K4', 'a8', 'a2', 1),
(203, 'K4', 'a3', 'a4', 0.33),
(204, 'K4', 'a4', 'a3', 3.0303),
(205, 'K4', 'a3', 'a5', 1),
(206, 'K4', 'a5', 'a3', 1),
(207, 'K4', 'a3', 'a6', 0.33),
(208, 'K4', 'a6', 'a3', 3.0303),
(209, 'K4', 'a3', 'a7', 9),
(210, 'K4', 'a7', 'a3', 0.111111),
(211, 'K4', 'a3', 'a8', 0.33),
(212, 'K4', 'a8', 'a3', 3.0303),
(213, 'K4', 'a4', 'a5', 3),
(214, 'K4', 'a5', 'a4', 0.333333),
(215, 'K4', 'a4', 'a6', 1),
(216, 'K4', 'a6', 'a4', 1),
(217, 'K4', 'a4', 'a7', 9),
(218, 'K4', 'a7', 'a4', 0.111111),
(219, 'K4', 'a4', 'a8', 1),
(220, 'K4', 'a8', 'a4', 1),
(221, 'K4', 'a5', 'a6', 0.33),
(222, 'K4', 'a6', 'a5', 3.0303),
(223, 'K4', 'a5', 'a7', 9),
(224, 'K4', 'a7', 'a5', 0.111111),
(225, 'K4', 'a5', 'a8', 0.33),
(226, 'K4', 'a8', 'a5', 3.0303),
(227, 'K4', 'a6', 'a7', 9),
(228, 'K4', 'a7', 'a6', 0.111111),
(229, 'K4', 'a6', 'a8', 1),
(230, 'K4', 'a8', 'a6', 1),
(231, 'K4', 'a7', 'a8', 0.11),
(232, 'K4', 'a8', 'a7', 9.09091),
(233, 'K5', 'a1', 'a2', 9),
(234, 'K5', 'a2', 'a1', 0.111111),
(235, 'K5', 'a1', 'a3', 2),
(236, 'K5', 'a3', 'a1', 0.5),
(237, 'K5', 'a1', 'a4', 7),
(238, 'K5', 'a4', 'a1', 0.142857),
(239, 'K5', 'a1', 'a5', 1),
(240, 'K5', 'a5', 'a1', 1),
(241, 'K5', 'a1', 'a6', 9),
(242, 'K5', 'a6', 'a1', 0.111111),
(243, 'K5', 'a1', 'a7', 2),
(244, 'K5', 'a7', 'a1', 0.5),
(245, 'K5', 'a1', 'a8', 9),
(246, 'K5', 'a8', 'a1', 0.111111),
(247, 'K5', 'a2', 'a3', 0.13),
(248, 'K5', 'a3', 'a2', 7.69231),
(249, 'K5', 'a2', 'a4', 0.33),
(250, 'K5', 'a4', 'a2', 3.0303),
(251, 'K5', 'a2', 'a5', 0.11),
(252, 'K5', 'a5', 'a2', 9.09091),
(253, 'K5', 'a2', 'a6', 4),
(254, 'K5', 'a6', 'a2', 0.25),
(255, 'K5', 'a2', 'a7', 0.13),
(256, 'K5', 'a7', 'a2', 7.69231),
(257, 'K5', 'a2', 'a8', 7),
(258, 'K5', 'a8', 'a2', 0.142857),
(259, 'K5', 'a3', 'a4', 5),
(260, 'K5', 'a4', 'a3', 0.2),
(261, 'K5', 'a3', 'a5', 1),
(262, 'K5', 'a5', 'a3', 1),
(263, 'K5', 'a3', 'a6', 9),
(264, 'K5', 'a6', 'a3', 0.111111),
(265, 'K5', 'a3', 'a7', 1),
(266, 'K5', 'a7', 'a3', 1),
(267, 'K5', 'a3', 'a8', 9),
(268, 'K5', 'a8', 'a3', 0.111111),
(269, 'K5', 'a4', 'a5', 0.17),
(270, 'K5', 'a5', 'a4', 5.88235),
(271, 'K5', 'a4', 'a6', 7),
(272, 'K5', 'a6', 'a4', 0.142857),
(273, 'K5', 'a4', 'a7', 0.2),
(274, 'K5', 'a7', 'a4', 5),
(275, 'K5', 'a4', 'a8', 9),
(276, 'K5', 'a8', 'a4', 0.111111),
(277, 'K5', 'a5', 'a6', 9),
(278, 'K5', 'a6', 'a5', 0.111111),
(279, 'K5', 'a5', 'a7', 1),
(280, 'K5', 'a7', 'a5', 1),
(281, 'K5', 'a5', 'a8', 9),
(282, 'K5', 'a8', 'a5', 0.111111),
(283, 'K5', 'a6', 'a7', 0.11),
(284, 'K5', 'a7', 'a6', 9.09091),
(285, 'K5', 'a6', 'a8', 3),
(286, 'K5', 'a8', 'a6', 0.333333),
(287, 'K5', 'a7', 'a8', 9),
(288, 'K5', 'a8', 'a7', 0.111111),
(289, 'K6', 'a1', 'a2', 9),
(290, 'K6', 'a2', 'a1', 0.111111),
(291, 'K6', 'a1', 'a3', 9),
(292, 'K6', 'a3', 'a1', 0.111111),
(293, 'K6', 'a1', 'a4', 9),
(294, 'K6', 'a4', 'a1', 0.111111),
(295, 'K6', 'a1', 'a5', 9),
(296, 'K6', 'a5', 'a1', 0.111111),
(297, 'K6', 'a1', 'a6', 9),
(298, 'K6', 'a6', 'a1', 0.111111),
(299, 'K6', 'a1', 'a7', 9),
(300, 'K6', 'a7', 'a1', 0.111111),
(301, 'K6', 'a1', 'a8', 9),
(302, 'K6', 'a8', 'a1', 0.111111),
(303, 'K6', 'a2', 'a3', 0.11),
(304, 'K6', 'a3', 'a2', 9.09091),
(305, 'K6', 'a2', 'a4', 0.14),
(306, 'K6', 'a4', 'a2', 7.14286),
(307, 'K6', 'a2', 'a5', 0.11),
(308, 'K6', 'a5', 'a2', 9.09091),
(309, 'K6', 'a2', 'a6', 9),
(310, 'K6', 'a6', 'a2', 0.111111),
(311, 'K6', 'a2', 'a7', 0.11),
(312, 'K6', 'a7', 'a2', 9.09091),
(313, 'K6', 'a2', 'a8', 7),
(314, 'K6', 'a8', 'a2', 0.142857),
(315, 'K6', 'a3', 'a4', 9),
(316, 'K6', 'a4', 'a3', 0.111111),
(317, 'K6', 'a3', 'a5', 5),
(318, 'K6', 'a5', 'a3', 0.2),
(319, 'K6', 'a3', 'a6', 9),
(320, 'K6', 'a6', 'a3', 0.111111),
(321, 'K6', 'a3', 'a7', 4),
(322, 'K6', 'a7', 'a3', 0.25),
(323, 'K6', 'a3', 'a8', 9),
(324, 'K6', 'a8', 'a3', 0.111111),
(325, 'K6', 'a4', 'a5', 0.25),
(326, 'K6', 'a5', 'a4', 4),
(327, 'K6', 'a4', 'a6', 9),
(328, 'K6', 'a6', 'a4', 0.111111),
(329, 'K6', 'a4', 'a7', 0.2),
(330, 'K6', 'a7', 'a4', 5),
(331, 'K6', 'a4', 'a8', 9),
(332, 'K6', 'a8', 'a4', 0.111111),
(333, 'K6', 'a5', 'a6', 9),
(334, 'K6', 'a6', 'a5', 0.111111),
(335, 'K6', 'a5', 'a7', 1),
(336, 'K6', 'a7', 'a5', 1),
(337, 'K6', 'a5', 'a8', 9),
(338, 'K6', 'a8', 'a5', 0.111111),
(339, 'K6', 'a6', 'a7', 0.11),
(340, 'K6', 'a7', 'a6', 9.09091),
(341, 'K6', 'a6', 'a8', 3),
(342, 'K6', 'a8', 'a6', 0.333333),
(343, 'K6', 'a7', 'a8', 9),
(344, 'K6', 'a8', 'a7', 0.111111),
(345, 'K7', 'a1', 'a2', 1),
(346, 'K7', 'a2', 'a1', 1),
(347, 'K7', 'a1', 'a3', 1),
(348, 'K7', 'a3', 'a1', 1),
(349, 'K7', 'a1', 'a4', 1),
(350, 'K7', 'a4', 'a1', 1),
(351, 'K7', 'a1', 'a5', 1),
(352, 'K7', 'a5', 'a1', 1),
(353, 'K7', 'a1', 'a6', 1),
(354, 'K7', 'a6', 'a1', 1),
(355, 'K7', 'a1', 'a7', 1),
(356, 'K7', 'a7', 'a1', 1),
(357, 'K7', 'a1', 'a8', 1),
(358, 'K7', 'a8', 'a1', 1),
(359, 'K7', 'a2', 'a3', 1),
(360, 'K7', 'a3', 'a2', 1),
(361, 'K7', 'a2', 'a4', 1),
(362, 'K7', 'a4', 'a2', 1),
(363, 'K7', 'a2', 'a5', 1),
(364, 'K7', 'a5', 'a2', 1),
(365, 'K7', 'a2', 'a6', 1),
(366, 'K7', 'a6', 'a2', 1),
(367, 'K7', 'a2', 'a7', 1),
(368, 'K7', 'a7', 'a2', 1),
(369, 'K7', 'a2', 'a8', 1),
(370, 'K7', 'a8', 'a2', 1),
(371, 'K7', 'a3', 'a4', 1),
(372, 'K7', 'a4', 'a3', 1),
(373, 'K7', 'a3', 'a5', 1),
(374, 'K7', 'a5', 'a3', 1),
(375, 'K7', 'a3', 'a6', 1),
(376, 'K7', 'a6', 'a3', 1),
(377, 'K7', 'a3', 'a7', 1),
(378, 'K7', 'a7', 'a3', 1),
(379, 'K7', 'a3', 'a8', 1),
(380, 'K7', 'a8', 'a3', 1),
(381, 'K7', 'a4', 'a5', 1),
(382, 'K7', 'a5', 'a4', 1),
(383, 'K7', 'a4', 'a6', 1),
(384, 'K7', 'a6', 'a4', 1),
(385, 'K7', 'a4', 'a7', 1),
(386, 'K7', 'a7', 'a4', 1),
(387, 'K7', 'a4', 'a8', 1),
(388, 'K7', 'a8', 'a4', 1),
(389, 'K7', 'a5', 'a6', 1),
(390, 'K7', 'a6', 'a5', 1),
(391, 'K7', 'a5', 'a7', 1),
(392, 'K7', 'a7', 'a5', 1),
(393, 'K7', 'a5', 'a8', 1),
(394, 'K7', 'a8', 'a5', 1),
(395, 'K7', 'a6', 'a7', 1),
(396, 'K7', 'a7', 'a6', 1),
(397, 'K7', 'a6', 'a8', 1),
(398, 'K7', 'a8', 'a6', 1),
(399, 'K7', 'a7', 'a8', 1),
(400, 'K7', 'a8', 'a7', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbandingan_kriteria`
--

CREATE TABLE `perbandingan_kriteria` (
  `id` int(11) NOT NULL,
  `kriteria1` varchar(50) NOT NULL,
  `kriteria2` varchar(50) NOT NULL,
  `nilai` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perbandingan_kriteria`
--

INSERT INTO `perbandingan_kriteria` (`id`, `kriteria1`, `kriteria2`, `nilai`) VALUES
(1, 'c1', 'c2', '1.000'),
(2, 'c1', 'c3', '1.000'),
(3, 'c1', 'c4', '1.000'),
(4, 'c2', 'c3', '2.500'),
(5, 'c2', 'c4', '2.500'),
(6, 'c3', 'c4', '1.000'),
(7, 'c2', 'c1', '1.000'),
(8, 'c3', 'c1', '1.000'),
(9, 'c4', 'c1', '1.000'),
(10, 'c3', 'c2', '0.400'),
(11, 'c4', 'c2', '0.400'),
(12, 'c4', 'c3', '1.000'),
(13, 'K1', 'K2', '8.000'),
(14, 'K2', 'K1', '0.125'),
(15, 'K1', 'K3', '2.000'),
(16, 'K3', 'K1', '0.500'),
(17, 'K1', 'K4', '1.000'),
(18, 'K4', 'K1', '1.000'),
(19, 'K1', 'K5', '1.000'),
(20, 'K5', 'K1', '1.000'),
(21, 'K1', 'K6', '1.000'),
(22, 'K6', 'K1', '1.000'),
(23, 'K1', 'K7', '0.170'),
(24, 'K7', 'K1', '5.882'),
(25, 'K2', 'K3', '0.130'),
(26, 'K3', 'K2', '7.692'),
(27, 'K2', 'K4', '6.000'),
(28, 'K4', 'K2', '0.167'),
(29, 'K2', 'K5', '7.000'),
(30, 'K5', 'K2', '0.143'),
(31, 'K2', 'K6', '8.000'),
(32, 'K6', 'K2', '0.125'),
(33, 'K2', 'K7', '6.000'),
(34, 'K7', 'K2', '0.167'),
(35, 'K3', 'K4', '9.000'),
(36, 'K4', 'K3', '0.111'),
(37, 'K3', 'K5', '8.000'),
(38, 'K5', 'K3', '0.125'),
(39, 'K3', 'K6', '9.000'),
(40, 'K6', 'K3', '0.111'),
(41, 'K3', 'K7', '8.000'),
(42, 'K7', 'K3', '0.125'),
(43, 'K4', 'K5', '8.000'),
(44, 'K5', 'K4', '0.125'),
(45, 'K4', 'K6', '9.000'),
(46, 'K6', 'K4', '0.111'),
(47, 'K4', 'K7', '5.000'),
(48, 'K7', 'K4', '0.200'),
(49, 'K5', 'K6', '9.000'),
(50, 'K6', 'K5', '0.111'),
(51, 'K5', 'K7', '4.000'),
(52, 'K7', 'K5', '0.250'),
(53, 'K6', 'K7', '9.000'),
(54, 'K7', 'K6', '0.111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id_alternatif` varchar(20) NOT NULL,
  `nama_alternatif` varchar(100) NOT NULL,
  `hasil_akhir` decimal(10,6) DEFAULT 0.000000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id_alternatif`, `nama_alternatif`, `hasil_akhir`) VALUES
('a1', 'Yudo Bismo Utomo, S.Kom., M.Kom', '0.147860'),
('a2', 'Harso Kurniadi, S.Kom., M.Kom', '0.122257'),
('a3', 'Halimahtus Mukminna, S.Pd., M.Pd.', '0.127615'),
('a4', 'Achmad Arif Alfin, S.Si., M.MT.', '0.126225'),
('a5', 'Iin Kurniasari, S.Kom., M.Si., M.Kom.', '0.124343'),
('a6', 'Dody Pradipta, S.Pd., M.Kom', '0.118812'),
('a7', 'Dr. Riska Nurtantyo Sarbini, S.T., M.T.', '0.114946'),
('a8', 'Moh. Syaiful Anam, S.Kom., M.Kom.', '0.117942');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `jumlah_kriteria` decimal(10,5) DEFAULT 0.00000,
  `bobot_kriteria` decimal(10,5) DEFAULT 0.00000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `nama_kriteria`, `jumlah_kriteria`, `bobot_kriteria`) VALUES
('K1', 'Kompetensi Pengajaran', '1.24190', '0.17740'),
('K2', 'Kualitas Materi', '1.12240', '0.16030'),
('K3', 'Hubungan Interpersonal', '2.08530', '0.29790'),
('K4', 'Beban Kerja Dosen', '0.90170', '0.12880'),
('K5', 'Publikasi Artikel', '0.54790', '0.07830'),
('K6', 'Sitasi Artikel', '0.44220', '0.06320'),
('K7', 'Pengembangan Diri', '0.65860', '0.09410');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id_nilai`, `jumlah`, `keterangan`) VALUES
(3, '1.00', 'Sama pentingnya '),
(4, '2.00', 'Nilai antara sama penting dan sedikit lebih penting'),
(5, '3.00', 'Sedikit lebih penting'),
(6, '4.00', 'Nilai antara sedikit lebih penting dan jelas penting'),
(7, '5.00', 'Jelas lebih penting'),
(8, '6.00', 'Nilai antara jelas penting dan sangat penting'),
(9, '7.00', 'Sangat penting'),
(10, '8.00', 'Nilai antara sangat penting dan mutlak penting'),
(11, '9.00', 'Mutlak sangat penting'),
(12, '0.50', 'Sedikit kurang penting'),
(13, '0.33', 'Agak kurang penting'),
(14, '0.25', 'Cukup kurang penting'),
(15, '0.20', 'Jelas kurang penting'),
(16, '0.17', 'Antara jelas dan sangat kurang penting'),
(17, '0.14', 'Sangat kurang penting'),
(18, '0.13', 'Antara sangat dan mutlak kurang penting'),
(19, '0.11', 'Mutlak sangat tidak penting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `role`) VALUES
(1, 'admin', '$2y$10$DZFomDv571bsgDikD/PPy.T2mBtWD2qNI.G6vvYPWWRf5DrmqXZAa', 'ADMIN', 'admin'),
(2, 'user', '$2y$10$oIs.j9nG7LcW1NyUG6FzQOoPRcorTuDc7dlXVnhO/ulik0409C3fK', 'user', 'user'),
(4, 'coba', '$2y$10$/F.Z2RFi8KKr0IZdgoSKX.sAo6aBdNJ8IuazwTmqNzDN0QVlKo3B.', 'coba', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil_alternatif`
--
ALTER TABLE `hasil_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perbandingan_alternatif`
--
ALTER TABLE `perbandingan_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perbandingan_kriteria`
--
ALTER TABLE `perbandingan_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasil_alternatif`
--
ALTER TABLE `hasil_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `perbandingan_alternatif`
--
ALTER TABLE `perbandingan_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT untuk tabel `perbandingan_kriteria`
--
ALTER TABLE `perbandingan_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
