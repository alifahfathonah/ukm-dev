-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2016 at 08:07 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ukm_db`
--
CREATE DATABASE IF NOT EXISTS `ukm_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ukm_db`;

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
CREATE TABLE IF NOT EXISTS `agenda` (
`AGENDA_ID` int(11) NOT NULL,
  `UKM_ID` int(11) DEFAULT NULL COMMENT 'ref ukm',
  `AGENDA_TITLE` varchar(100) NOT NULL,
  `AGENDA_TEXT` text,
  `AGENDA_TIME` timestamp NULL DEFAULT NULL,
  `AGENDA_TIMETO` timestamp NULL DEFAULT NULL,
  `AGENDA_STATUS` int(11) DEFAULT NULL COMMENT '0=draft;1=publish;2=hapus;3=selesai'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`AGENDA_ID`, `UKM_ID`, `AGENDA_TITLE`, `AGENDA_TEXT`, `AGENDA_TIME`, `AGENDA_TIMETO`, `AGENDA_STATUS`) VALUES
(1, 1, 'Hunting Foto Landscape', 'Hunting foto landscape di Gunung Bromo, Probolinggo', '2014-12-28 16:17:08', '2014-12-28 16:17:08', 3),
(2, 1, 'Pameran Tema Rumah', 'Pameran bertemakan "Rumah" didukung juga oleh Matanesia', '2014-12-28 16:17:08', '0000-00-00 00:00:00', 1),
(3, 1, 'Seminar Fotografi', 'Seminar fotografi bersama blablablabla', '2015-01-18 01:00:00', '0000-00-00 00:00:00', 1),
(4, 1, 'Hunting Human Interest', 'hunting aja', '2015-01-22 22:00:00', '2015-01-23 04:00:00', 1),
(5, 3, 'Latihan Bareng ITS', 'Latihan bareng UKM Voli ITS', '2015-01-23 05:00:00', '2015-01-23 05:00:00', 1),
(6, 1, 'Roadshow Fotografi', 'roadshow aja', '2015-01-18 00:00:00', '2015-01-18 03:00:00', 1),
(7, 1, 'Yeeay', 'okokeokeoekoekoekoekeokek', '2015-06-09 05:00:00', '2015-06-30 05:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

DROP TABLE IF EXISTS `anggota`;
CREATE TABLE IF NOT EXISTS `anggota` (
`ANGGOTA_ID` int(11) NOT NULL,
  `UKM_ID` int(11) DEFAULT NULL COMMENT 'ref ukm',
  `ANGGOTA_NAME` char(50) DEFAULT NULL,
  `ANGGOTA_STATUS` int(11) DEFAULT '1',
  `ANGGOTA_LEVEL` int(11) DEFAULT NULL COMMENT '10=anggota;11=pengurus;12=ketua'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`ANGGOTA_ID`, `UKM_ID`, `ANGGOTA_NAME`, `ANGGOTA_STATUS`, `ANGGOTA_LEVEL`) VALUES
(1, 1, 'Yufi', 1, 11),
(2, 1, 'Eko', 1, 10),
(3, 1, 'Firmansyah', 1, 10),
(4, 1, 'Ival', 1, 12),
(5, 1, 'Coba', 0, 10),
(6, 1, 'ZZZZ', 1, 11),
(7, 1, 'Agus', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

DROP TABLE IF EXISTS `data`;
CREATE TABLE IF NOT EXISTS `data` (
`DATA_ID` int(11) NOT NULL,
  `UKM_ID` int(11) DEFAULT NULL COMMENT 'ref ukm',
  `DATA_FILE` char(255) DEFAULT NULL,
  `DATA_MSG` char(255) DEFAULT NULL,
  `DATA_FROM` int(11) DEFAULT NULL COMMENT 'ref user',
  `DATA_TO` int(11) DEFAULT '2' COMMENT 'ref user',
  `DATA_TIME` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DATA_STATUS` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=unread;1=read;2=delete'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`DATA_ID`, `UKM_ID`, `DATA_FILE`, `DATA_MSG`, `DATA_FROM`, `DATA_TO`, `DATA_TIME`, `DATA_STATUS`) VALUES
(1, 1, 'laporan_frens2014.docx', 'Laporan UKM Frens tahun 2014', 1, 2, '2015-01-07 07:57:26', 2),
(3, 3, 'laporan_voli2014.docx', 'Laporan UKM Volitahun 2014', 3, 2, '2015-01-07 07:57:26', 1),
(4, 1, 'Modul_4-sudo_tripwire-kel01-F4.docx', 'laporan kedua\\\\ sdzabasav', 1, 2, '2015-01-12 07:10:11', 0),
(5, 1, 'Kamdat03.pdf', 'laporan ketiga ukm frens', 1, 2, '2015-01-15 13:06:17', 0),
(6, 1, 'webSSL.docx', 'laporan', 1, 2, '2015-01-16 10:06:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
`LOG_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL COMMENT 'ref user',
  `LOG_TEXT` varchar(100) NOT NULL,
  `LOG_TIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`LOG_ID`, `USER_ID`, `LOG_TEXT`, `LOG_TIME`) VALUES
(32, 1, 'User admin logout di SIM UKM', '2015-01-15 10:17:55'),
(33, 4, 'User frens login di SIM UKM', '2015-01-15 10:18:10'),
(34, 1, 'User admin login di SIM UKM', '2015-01-15 12:43:06'),
(35, 3, 'User yufieko login di SIM UKM', '2015-01-15 12:51:16'),
(36, 3, 'User yufieko logout di SIM UKM', '2015-01-15 12:52:45'),
(37, 2, 'User manajemen login di SIM UKM', '2015-01-15 12:53:13'),
(38, 2, 'User manajemen logout di SIM UKM', '2015-01-15 12:57:57'),
(39, 3, 'User yufieko login di SIM UKM', '2015-01-15 12:58:11'),
(40, 3, 'User yufieko logout di SIM UKM', '2015-01-15 13:06:37'),
(41, 1, 'User admin login di SIM UKM', '2015-01-15 13:06:44'),
(42, 1, 'User admin logout di SIM UKM', '2015-01-15 13:07:21'),
(43, 2, 'User manajemen login di SIM UKM', '2015-01-15 13:07:29'),
(44, 2, 'User manajemen logout di SIM UKM', '2015-01-15 13:23:37'),
(45, 3, 'User yufieko login di SIM UKM', '2015-01-15 13:23:47'),
(46, 3, 'User yufieko login di SIM UKM', '2015-01-16 02:02:11'),
(47, 1, 'User admin login di SIM UKM', '2015-01-16 02:47:43'),
(48, 1, 'User admin logout di SIM UKM', '2015-01-16 02:48:17'),
(49, 5, 'User yees login di SIM UKM', '2015-01-16 02:48:33'),
(50, 5, 'User yees logout di SIM UKM', '2015-01-16 05:56:21'),
(51, 1, 'User admin login di SIM UKM', '2015-01-16 05:56:26'),
(52, 1, 'User admin logout di SIM UKM', '2015-01-16 06:31:24'),
(53, 2, 'User manajemen login di SIM UKM', '2015-01-16 06:31:34'),
(54, 2, 'User manajemen logout di SIM UKM', '2015-01-16 06:32:54'),
(55, 3, 'User yufieko login di SIM UKM', '2015-01-16 06:43:53'),
(56, 3, 'User yufieko logout di SIM UKM', '2015-01-16 06:43:58'),
(57, 3, 'User yufieko login di SIM UKM', '2015-01-16 08:06:17'),
(58, 3, 'User yufieko logout di SIM UKM', '2015-01-16 08:06:36'),
(59, 1, 'User admin login di SIM UKM', '2015-01-16 09:21:42'),
(60, 1, 'User admin logout di SIM UKM', '2015-01-16 09:21:56'),
(61, 5, 'User yees login di SIM UKM', '2015-01-16 09:22:06'),
(62, 5, 'User yees logout di SIM UKM', '2015-01-16 09:31:25'),
(63, 1, 'User admin login di SIM UKM', '2015-01-16 09:31:30'),
(64, 1, 'User admin logout di SIM UKM', '2015-01-16 09:33:31'),
(65, 1, 'User admin login di SIM UKM', '2015-01-16 09:56:58'),
(66, 1, 'User admin menghapus Data laporan_voli2014.docx ', '2015-01-16 09:59:39'),
(67, 1, 'User admin mengembalikan data laporan_voli2014.docx', '2015-01-16 09:59:55'),
(68, 1, 'User admin logout di SIM UKM', '2015-01-16 10:00:48'),
(69, 2, 'User manajemen login di SIM UKM', '2015-01-16 10:00:57'),
(70, 2, 'User manajemen logout di SIM UKM', '2015-01-16 10:03:29'),
(71, 3, 'User yufieko login di SIM UKM', '2015-01-16 10:03:44'),
(72, 3, 'User yufieko logout di SIM UKM', '2015-01-16 10:10:48'),
(73, 2, 'User manajemen login di SIM UKM', '2015-01-16 10:11:00'),
(74, 2, 'User manajemen logout di SIM UKM', '2015-01-16 10:12:11'),
(75, 3, 'User yufieko login di SIM UKM', '2015-01-22 22:36:09'),
(76, 1, 'User admin login di SIM UKM', '2015-02-01 16:38:10'),
(77, 1, 'User admin logout di SIM UKM', '2015-02-01 16:38:44'),
(78, 3, 'User yufieko login di SIM UKM', '2015-02-01 16:38:57'),
(79, 3, 'User yufieko logout di SIM UKM', '2015-02-01 17:34:57'),
(80, 1, 'User admin login di SIM UKM', '2015-02-02 23:30:17'),
(81, 1, 'User admin logout di SIM UKM', '2015-02-02 23:36:14'),
(82, 3, 'User yufieko login di SIM UKM', '2015-02-02 23:36:20'),
(83, 3, 'User yufieko login di SIM UKM', '2015-02-04 00:30:33'),
(84, 3, 'User yufieko login di SIM UKM', '2015-02-04 04:43:32'),
(85, 3, 'User yufieko logout di SIM UKM', '2015-02-04 04:43:54'),
(86, 1, 'User admin login di SIM UKM', '2015-02-04 04:43:59'),
(87, 1, 'User admin logout di SIM UKM', '2015-02-04 04:46:52'),
(88, 2, 'User manajemen login di SIM UKM', '2015-02-04 04:47:03'),
(89, 1, 'User admin login di SIM UKM', '2015-02-05 01:00:21'),
(90, 1, 'User admin login di SIM UKM', '2015-02-05 13:45:03'),
(91, 3, 'User yufieko login di SIM UKM', '2015-02-05 23:39:11'),
(92, 1, 'User admin login di SIM UKM', '2015-04-08 12:14:39'),
(93, 1, 'User admin login di SIM UKM', '2015-04-09 07:29:05'),
(94, 1, 'User admin login di SIM UKM', '2015-04-09 22:36:11'),
(95, 3, 'User yufieko login di SIM UKM', '2015-05-09 02:36:51'),
(96, 3, 'User yufieko logout di SIM UKM', '2015-05-09 02:36:59'),
(97, 1, 'User admin login di SIM UKM', '2015-05-09 02:37:04'),
(98, 1, 'User admin logout di SIM UKM', '2015-05-09 02:37:08'),
(99, 1, 'User admin login di SIM UKM', '2015-05-09 13:58:55'),
(100, 1, 'User admin login di SIM UKM', '2015-05-13 08:28:59'),
(101, 3, 'User yufieko login di SIM UKM', '2015-05-25 07:59:19'),
(102, 1, 'User admin login di SIM UKM', '2015-06-27 02:05:30'),
(103, 1, 'User admin logout di SIM UKM', '2015-06-27 02:06:04'),
(104, 3, 'User yufieko login di SIM UKM', '2015-06-27 02:06:14'),
(105, 3, 'User yufieko login di SIM UKM', '2015-06-30 06:54:08'),
(106, 3, 'User yufieko login di SIM UKM', '2015-08-27 03:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

DROP TABLE IF EXISTS `notifikasi`;
CREATE TABLE IF NOT EXISTS `notifikasi` (
`NOTIF_ID` int(11) NOT NULL,
  `USER_ID` int(11) DEFAULT NULL COMMENT 'ref user',
  `UKM_ID` int(11) DEFAULT NULL COMMENT 'ref ukm',
  `NOTIF_ACTIVITY` char(255) DEFAULT NULL,
  `NOTIF_TIME` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `NOTIF_READ` int(11) DEFAULT '0' COMMENT '0=unread;1=read; 2=hapus',
  `NOTIF_FROM` int(11) DEFAULT NULL COMMENT 'ref user',
  `NOTIF_TO` int(11) DEFAULT NULL COMMENT 'ref usser',
  `NOTIF_TIPE` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'ref notif tipe'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`NOTIF_ID`, `USER_ID`, `UKM_ID`, `NOTIF_ACTIVITY`, `NOTIF_TIME`, `NOTIF_READ`, `NOTIF_FROM`, `NOTIF_TO`, `NOTIF_TIPE`) VALUES
(1, 2, 1, 'Harap mengumpulkan laporan pertanggung jawaban untuk acara tahun 2014', '2014-12-28 15:59:30', 1, 2, 1, 1),
(2, 2, 1, 'Segera mengumpulkan laporan pertanggung jawaban hari ini', '2014-12-28 15:59:30', 1, 2, 1, 4),
(3, 2, 1, 'Ketua UKM diharapkan untuk menghadap ke manajemen pada  tanggal 30 Desember 2014', '2014-12-29 05:23:20', 1, 2, 1, 2),
(4, 2, 1, 'Kumpulkan laporan', '2014-12-29 08:08:27', 2, 2, 1, 2),
(5, 3, 1, 'User yufieko dari UKM Fotografi PENS mengirimkan laporan', '2015-01-15 13:06:17', 0, 3, 2, 1),
(6, 2, 1, 'PEsan COba', '2015-01-16 10:03:15', 0, 2, 1, 1),
(7, 3, 1, 'User yufieko dari UKM Fotografi PENS mengirimkan laporan', '2015-01-16 10:06:22', 0, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
`ROLE_ID` int(11) NOT NULL,
  `ROLE_NAME` varchar(50) NOT NULL,
  `ROLE_CREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ROLE_ID`, `ROLE_NAME`, `ROLE_CREATED`) VALUES
(40, 'Administrator', '2014-12-18 15:53:33'),
(41, 'Manajemen', '2014-12-18 15:53:33'),
(42, 'UKM', '2014-12-18 15:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `tipenotif`
--

DROP TABLE IF EXISTS `tipenotif`;
CREATE TABLE IF NOT EXISTS `tipenotif` (
`tipe_id` tinyint(4) NOT NULL,
  `tipe_nama` varchar(25) NOT NULL,
  `tipe_teks` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipenotif`
--

INSERT INTO `tipenotif` (`tipe_id`, `tipe_nama`, `tipe_teks`) VALUES
(1, 'info', 'Info'),
(2, 'danger', 'Penting'),
(3, 'success', 'Selesai'),
(4, 'warning', 'Perhatian'),
(5, 'primary', 'Oke');

-- --------------------------------------------------------

--
-- Table structure for table `ukm`
--

DROP TABLE IF EXISTS `ukm`;
CREATE TABLE IF NOT EXISTS `ukm` (
`UKM_ID` int(11) NOT NULL,
  `USER_ID` int(11) DEFAULT NULL COMMENT 'ref user',
  `UKM_NAME` char(50) DEFAULT NULL,
  `UKM_CREATED` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UKM_STATUS` int(11) DEFAULT '1' COMMENT '0=tidak aktif; 1=aktif',
  `UKM_INFO` char(100) DEFAULT '-',
  `UKM_CONTACT` char(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ukm`
--

INSERT INTO `ukm` (`UKM_ID`, `USER_ID`, `UKM_NAME`, `UKM_CREATED`, `UKM_STATUS`, `UKM_INFO`, `UKM_CONTACT`) VALUES
(0, NULL, 'Tidak Ada', '2014-12-29 06:50:21', 1, '-', '-'),
(1, 1, 'Fotografi PENS', '2014-12-18 17:36:59', 1, 'seminar fotografi', 'frens@ukm.pens.ac.id'),
(3, NULL, 'UKM Voli', '2015-01-04 17:07:09', 1, '-', '0392913495');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
`USER_ID` int(11) NOT NULL,
  `UKM_ID` int(11) DEFAULT '0' COMMENT 'ref ukm',
  `USER_NAME` char(50) DEFAULT NULL,
  `USER_MAIL` varchar(30) DEFAULT NULL,
  `USER_PASS` varchar(100) DEFAULT NULL COMMENT 'encrypt sha1',
  `USER_STATUS` int(11) DEFAULT '0' COMMENT '0=online;1=offline',
  `USER_CREATED` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `USER_ROLE` int(11) NOT NULL COMMENT 'ref role'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `UKM_ID`, `USER_NAME`, `USER_MAIL`, `USER_PASS`, `USER_STATUS`, `USER_CREATED`, `USER_ROLE`) VALUES
(1, 0, 'admin', 'admin@ukm.pens.ac.id', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, '2014-12-18 17:19:09', 40),
(2, 0, 'manajemen', 'manajemen@pens.ac.id', '1a721611cee74f7f198f603654ee738a694262cd', 1, '2014-12-18 17:38:43', 41),
(3, 1, 'yufieko', 'yuko@it.student.pens.ac.id', '8415b069e0d90145102c07562ae330a910fe8a30', 1, '2014-12-18 17:39:35', 42),
(4, 1, 'frens', 'frens@gmail.com', 'a763c3baccf357bf2dd69be98f0869fdec99fba7', 1, '2015-01-02 03:37:52', 42),
(5, 3, 'yees', 'yees@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 0, '2015-01-02 10:56:10', 42);

-- --------------------------------------------------------

--
-- Table structure for table `user_akses`
--

DROP TABLE IF EXISTS `user_akses`;
CREATE TABLE IF NOT EXISTS `user_akses` (
`akses_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT 'ref role',
  `akses_menu` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_akses`
--

INSERT INTO `user_akses` (`akses_id`, `role_id`, `akses_menu`) VALUES
(45, 40, 'dashboard'),
(46, 40, 'log'),
(47, 40, 'laporan'),
(48, 40, 'user'),
(49, 40, 'ukm'),
(50, 41, 'dashboard'),
(51, 41, 'notifikasi'),
(52, 41, 'reminder'),
(53, 41, 'laporan'),
(54, 41, 'profil'),
(55, 42, 'dashboard'),
(56, 42, 'notifikasi'),
(57, 42, 'laporan'),
(58, 0, 'ukm'),
(59, 42, 'anggota'),
(60, 42, 'agenda'),
(61, 42, 'profil');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE IF NOT EXISTS `user_menu` (
`menu_id` int(11) NOT NULL,
  `menu_tipe` int(11) NOT NULL DEFAULT '1' COMMENT '0=parent, 1=child, 2=inside page',
  `menu_parent` varchar(15) DEFAULT NULL COMMENT 'Diisi kode pada menu',
  `akses_menu` varchar(25) NOT NULL,
  `menu_nama` varchar(30) NOT NULL,
  `menu_url` varchar(50) NOT NULL DEFAULT '#',
  `menu_icon` varchar(30) DEFAULT NULL,
  `menu_urutan` int(11) NOT NULL,
  `menu_aktif` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=nonaktif; 1=aktif'
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`menu_id`, `menu_tipe`, `menu_parent`, `akses_menu`, `menu_nama`, `menu_url`, `menu_icon`, `menu_urutan`, `menu_aktif`) VALUES
(35, 0, NULL, 'log', 'Log', '/log', 'fa fa-warning', 1, 1),
(36, 0, NULL, 'notifikasi', 'Notifikasi', '/notifikasi', 'fa fa-warning', 2, 1),
(37, 0, NULL, 'laporan', 'Laporan', '/laporan', 'fa fa-book', 3, 1),
(38, 0, NULL, 'reminder', 'Reminder', '/reminder', 'fa fa-check', 4, 1),
(39, 0, NULL, 'profil', 'Profil', '/profil', 'fa fa-user', 5, 1),
(40, 0, NULL, 'user', 'User', '/user', 'fa fa-users', 6, 1),
(41, 0, NULL, 'ukm', 'UKM', '/ukm', 'fa fa-sitemap', 7, 1),
(42, 0, NULL, 'anggota', 'Anggota', '/anggota', 'fa fa-users', 8, 1),
(43, 0, NULL, 'agenda', 'Agenda', '/agenda', 'fa fa-sort-alpha-asc', 9, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
 ADD PRIMARY KEY (`AGENDA_ID`), ADD KEY `fk_ukmidagenda` (`UKM_ID`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
 ADD PRIMARY KEY (`ANGGOTA_ID`), ADD KEY `fk_ukmidanggota` (`UKM_ID`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
 ADD PRIMARY KEY (`DATA_ID`), ADD KEY `fk_ukmiddata` (`UKM_ID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
 ADD PRIMARY KEY (`LOG_ID`), ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
 ADD PRIMARY KEY (`NOTIF_ID`), ADD KEY `FK_MENERIMA` (`UKM_ID`), ADD KEY `FK_MENGIRIM` (`USER_ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`ROLE_ID`);

--
-- Indexes for table `tipenotif`
--
ALTER TABLE `tipenotif`
 ADD PRIMARY KEY (`tipe_id`);

--
-- Indexes for table `ukm`
--
ALTER TABLE `ukm`
 ADD PRIMARY KEY (`UKM_ID`), ADD KEY `fk_useridukm` (`USER_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`USER_ID`), ADD KEY `USER_ROLE` (`USER_ROLE`), ADD KEY `USER_ROLE_2` (`USER_ROLE`), ADD KEY `fk_ukmid` (`UKM_ID`);

--
-- Indexes for table `user_akses`
--
ALTER TABLE `user_akses`
 ADD PRIMARY KEY (`akses_id`), ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
 ADD PRIMARY KEY (`menu_id`), ADD UNIQUE KEY `akses_menu` (`akses_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
MODIFY `AGENDA_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
MODIFY `ANGGOTA_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
MODIFY `DATA_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
MODIFY `LOG_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
MODIFY `NOTIF_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `ROLE_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `tipenotif`
--
ALTER TABLE `tipenotif`
MODIFY `tipe_id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ukm`
--
ALTER TABLE `ukm`
MODIFY `UKM_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_akses`
--
ALTER TABLE `user_akses`
MODIFY `akses_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda`
--
ALTER TABLE `agenda`
ADD CONSTRAINT `fk_ukmidagenda` FOREIGN KEY (`UKM_ID`) REFERENCES `ukm` (`UKM_ID`);

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
ADD CONSTRAINT `fk_ukmidanggota` FOREIGN KEY (`UKM_ID`) REFERENCES `ukm` (`UKM_ID`);

--
-- Constraints for table `data`
--
ALTER TABLE `data`
ADD CONSTRAINT `fk_ukmiddata` FOREIGN KEY (`UKM_ID`) REFERENCES `ukm` (`UKM_ID`);

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
ADD CONSTRAINT `FK_MENERIMA` FOREIGN KEY (`UKM_ID`) REFERENCES `ukm` (`UKM_ID`),
ADD CONSTRAINT `FK_MENGIRIM` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);

--
-- Constraints for table `ukm`
--
ALTER TABLE `ukm`
ADD CONSTRAINT `fk_useridukm` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `fk_roleid` FOREIGN KEY (`USER_ROLE`) REFERENCES `role` (`ROLE_ID`),
ADD CONSTRAINT `fk_ukmid` FOREIGN KEY (`UKM_ID`) REFERENCES `ukm` (`UKM_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
