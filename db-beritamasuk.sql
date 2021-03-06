-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.6.26 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table sspd_bantul.berita
DROP TABLE IF EXISTS `berita`;
CREATE TABLE IF NOT EXISTS `berita` (
  `berita_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `berita_judul` varchar(255) NOT NULL,
  `berita_sinopsis` varchar(200) NOT NULL,
  `berita_detail` longtext NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `create_by` int(10) NOT NULL,
  `update_by` int(10) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `berita_image` varchar(255) DEFAULT NULL,
  `berita_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`berita_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.berita: 1 rows
/*!40000 ALTER TABLE `berita` DISABLE KEYS */;
INSERT INTO `berita` (`berita_id`, `berita_judul`, `berita_sinopsis`, `berita_detail`, `create_date`, `update_date`, `create_by`, `update_by`, `featured`, `berita_image`, `berita_url`) VALUES
	(1, 'Artikel 1', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquam luctus fringilla. Fusce tempus mauris ac gravida tempor. Quisque feugiat pellentesque nulla nec mattis. Maecenas eget blandit erat.</p>\r\n', '2017-10-24 05:28:01', '2017-10-24 05:35:19', 0, 0, 1, '2017/10/artikel-1.jpg', '');
/*!40000 ALTER TABLE `berita` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `catatan` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.customer: ~1 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`id`, `nama_customer`, `alamat`, `no_hp`, `email`, `catatan`, `status`) VALUES
	(1, 'Sukir', 'Belakang UGM', '081123123', '', '', 0);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.file
DROP TABLE IF EXISTS `file`;
CREATE TABLE IF NOT EXISTS `file` (
  `id` varchar(255) NOT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `table_field` varchar(255) DEFAULT NULL,
  `field_value` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `input_by` varchar(255) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.file: ~3 rows (approximately)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`id`, `table_name`, `table_field`, `field_value`, `file_name`, `url`, `input_by`, `input_date`) VALUES
	('c60d98aaedb65c8ba5e023cbacb41874eb4d22ad', 'user', 'id', 'c4cab7526d9d124d79b30c818d2fcc37a1f63c73', 'Tamako.Market.600.1416434.jpg', '2016/05/c60d98aaedb65c8ba5e023cbacb41874eb4d22ad.jpg', 'c4cab7526d9d124d79b30c818d2fcc37a1f63c73', '2016-05-12 11:39:53'),
	('da914eaac18d19433fe9c5b3eb8788c7b9457650', 'user', 'id', 'c4cab7526d9d124d79b30c818d2fcc37a1f63c73', 'Emoticons-icon.png', '2016/06/da914eaac18d19433fe9c5b3eb8788c7b9457650.png', 'c4cab7526d9d124d79b30c818d2fcc37a1f63c73', '2016-06-08 06:20:56'),
	('eaad7968553d65eed16bdf5ddcfd516a33858b58', 'user', 'id', 'c4cab7526d9d124d79b30c818d2fcc37a1f63c73', 'user2-160x160.jpg', '2016/06/eaad7968553d65eed16bdf5ddcfd516a33858b58.jpg', 'c4cab7526d9d124d79b30c818d2fcc37a1f63c73', '2016-06-03 05:51:08');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.group
DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT '0',
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.group: ~3 rows (approximately)
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`id`, `name`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
	('54345880d047bf8496e0df28c4a3db5359083240', 'Operator', '2015-04-28 10:58:29', 0, '2015-07-14 10:35:49', 'c4cab7526d9d124d79b30c818d2fcc37a1f63c73'),
	('67544603076af2daf15675402647dcbe85c629ec', 'Administrator', '2015-04-28 10:57:53', 0, '2015-07-02 08:20:31', 'c4cab7526d9d124d79b30c818d2fcc37a1f63c73'),
	('da51c984897cd84a051074fe171d5a2a74757e45', 'Auditor', '2015-04-28 10:58:39', 0, '2015-07-02 08:22:16', 'c4cab7526d9d124d79b30c818d2fcc37a1f63c73');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.layanan
DROP TABLE IF EXISTS `layanan`;
CREATE TABLE IF NOT EXISTS `layanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(30) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `harga_normal` int(10) NOT NULL,
  `harga_express` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.layanan: ~2 rows (approximately)
/*!40000 ALTER TABLE `layanan` DISABLE KEYS */;
INSERT INTO `layanan` (`id`, `nama_layanan`, `unit`, `harga_normal`, `harga_express`) VALUES
	(1, 'Cuci Setrika', 'KG', 4000, 6000),
	(2, 'Setrika Saja', 'PCS', 3000, 4500);
/*!40000 ALTER TABLE `layanan` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.link
DROP TABLE IF EXISTS `link`;
CREATE TABLE IF NOT EXISTS `link` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `link_judul` varchar(125) NOT NULL,
  `link_alamat` varchar(125) NOT NULL,
  `link_create_date` datetime NOT NULL,
  `link_update_date` datetime DEFAULT NULL,
  `link_create_by` int(10) NOT NULL,
  `link_update_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.link: 0 rows
/*!40000 ALTER TABLE `link` DISABLE KEYS */;
/*!40000 ALTER TABLE `link` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL COMMENT 'full class icon template',
  `status` int(1) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT 'view',
  `create_date` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT '0',
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.menu: ~22 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`, `url`, `icon`, `status`, `order`, `parent`, `state`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
	(1, 'DASHBOARD', 'dashboard', 'fa fa-dashboard', 1, 1, '0', 'view', '2015-04-22 12:49:30', 1, NULL, '0'),
	(2, 'TRANSAKSI', 'transaksi', 'fa fa-shopping-cart', 0, 2, '0', 'view', '2016-06-04 00:00:00', 1, NULL, '0'),
	(3, 'CUSTOMER', '#', 'fa fa-users', 0, 3, '0', 'view', '2016-06-04 00:00:00', 1, NULL, NULL),
	(4, 'Tambah Customer', 'customer/add', 'fa fa-user-plus', 0, 1, '3', 'view', '2016-06-07 00:00:00', 1, NULL, NULL),
	(5, 'Data Customer', 'customer', 'fa fa-list', 0, 2, '3', 'view', '2016-06-07 00:00:00', 1, NULL, NULL),
	(6, 'REKAPITULASI', '#', 'fa fa-file-text-o', 0, 4, '0', 'view', '2016-06-04 00:00:00', 1, NULL, NULL),
	(7, 'Rekap Transaksi', 'rekapitulasi', 'fa fa-calendar', 0, 1, '6', 'view', '2016-06-07 00:00:00', 1, NULL, NULL),
	(8, 'Rekap Lunas', 'rekapitulasi/index?rekap=lunas', 'fa fa-calendar-check-o', 0, 2, '6', 'view', '2016-06-07 00:00:00', 1, NULL, NULL),
	(9, 'Rekap Belum Lunas', 'rekapitulasi/index?rekap=belum_lunas', 'fa fa-calendar-times-o', 0, 3, '6', 'view', '2016-06-07 00:00:00', 1, NULL, NULL),
	(10, 'STATUS LAUNDRY', '#', 'fa fa-info-circle', 0, 5, '0', 'view', '2016-06-04 00:00:00', 1, NULL, NULL),
	(11, 'Tambah Status', 'status_laundry', 'fa fa-exchange', 0, 1, '10', 'view', '2016-06-07 00:00:00', 1, NULL, NULL),
	(12, 'Status Laundry', 'status', 'fa fa-calendar-check-o', 0, 2, '10', 'view', '2016-06-07 00:00:00', 1, NULL, NULL),
	(13, 'PENGATURAN', '#', 'fa fa-cog', 0, 6, '0', 'view', '2016-06-04 00:00:00', 1, NULL, NULL),
	(14, 'Layanan & Harga', 'layanan', 'fa fa-money', 0, 1, '13', 'view', '2016-06-07 00:00:00', 1, NULL, NULL),
	(15, 'Profile', 'profile', 'fa fa-user', 0, 2, '13', 'view', '2015-04-23 16:35:09', 1, NULL, '0'),
	(99, 'Group', 'group', 'fa fa-users', 0, 1, 'e0fdbf7f46ee7595818fc4f42a8c91f86c455d69', 'view\r\n', '2015-05-06 18:27:31', 1, NULL, '0'),
	(100, 'SSPD', 'sspd', 'fa fa-file-text-o', 1, 7, '0', 'view', '2017-09-26 19:33:15', 1, '2017-09-26 19:33:17', NULL),
	(101, 'MANAJEMEN FRONTEND', 'front', 'fa fa-file-text-o', 1, 8, '0', 'view', '2017-10-09 13:54:00', 1, '2017-10-09 13:54:11', NULL),
	(102, 'SLIDER', 'slider', 'fa fa-file-text-o', 0, 1, '101', 'view', '2017-10-09 13:55:32', 1, '2017-10-09 13:55:36', NULL),
	(103, 'BERITA', 'berita', 'fa fa-file-text-o', 1, 2, '101', 'view', '2017-10-09 13:56:14', 1, '2017-10-09 13:56:15', NULL),
	(104, 'LINK TERKAIT', 'link', 'fa fa-file-text-o', 1, 3, '101', 'view', '2017-10-09 13:56:50', 1, '2017-10-09 13:56:52', NULL),
	(105, 'WIDGET', 'widget', 'fa fa-square', 1, 4, '101', 'view', '2017-10-19 06:26:42', 0, NULL, NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.menugroup
DROP TABLE IF EXISTS `menugroup`;
CREATE TABLE IF NOT EXISTS `menugroup` (
  `group_id` varchar(255) NOT NULL DEFAULT '',
  `menu_id` varchar(255) NOT NULL DEFAULT '',
  `view` tinyint(1) DEFAULT NULL,
  `add` tinyint(1) DEFAULT NULL,
  `edit` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`group_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.menugroup: ~21 rows (approximately)
/*!40000 ALTER TABLE `menugroup` DISABLE KEYS */;
INSERT INTO `menugroup` (`group_id`, `menu_id`, `view`, `add`, `edit`, `delete`) VALUES
	('67544603076af2daf15675402647dcbe85c629ec', '1', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '10', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '100', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '101', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '102', 0, 0, 0, 0),
	('67544603076af2daf15675402647dcbe85c629ec', '103', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '104', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '105', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '11', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '12', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '13', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '14', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '15', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '2', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '3', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '4', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '5', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '6', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '7', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '8', 1, 1, 1, 1),
	('67544603076af2daf15675402647dcbe85c629ec', '9', 1, 1, 1, 1);
/*!40000 ALTER TABLE `menugroup` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.outlet
DROP TABLE IF EXISTS `outlet`;
CREATE TABLE IF NOT EXISTS `outlet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_outlet` text NOT NULL,
  `slogan` varchar(100) NOT NULL,
  `logo` varchar(55) NOT NULL,
  `alamat` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.outlet: ~0 rows (approximately)
/*!40000 ALTER TABLE `outlet` DISABLE KEYS */;
/*!40000 ALTER TABLE `outlet` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.profile
DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(2) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.profile: ~1 rows (approximately)
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` (`id`, `username`, `password`, `nama`, `foto`) VALUES
	(0, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Karunia Laundry', '');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.ref_kabupaten
DROP TABLE IF EXISTS `ref_kabupaten`;
CREATE TABLE IF NOT EXISTS `ref_kabupaten` (
  `id_provinsi` char(3) NOT NULL,
  `id_kabupaten` char(3) NOT NULL,
  `nama_kabupaten` varchar(50) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `lat` double DEFAULT '0',
  `lon` double DEFAULT '0',
  `kabCode` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`,`id_kabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.ref_kabupaten: ~1 rows (approximately)
/*!40000 ALTER TABLE `ref_kabupaten` DISABLE KEYS */;
INSERT INTO `ref_kabupaten` (`id_provinsi`, `id_kabupaten`, `nama_kabupaten`, `fullName`, `lat`, `lon`, `kabCode`) VALUES
	('34', '2', 'BANTUL', 'Bantul, 55711, Indonesia', -7.8846111, 110.3341111, '3402');
/*!40000 ALTER TABLE `ref_kabupaten` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.ref_kecamatan
DROP TABLE IF EXISTS `ref_kecamatan`;
CREATE TABLE IF NOT EXISTS `ref_kecamatan` (
  `id_provinsi` char(3) NOT NULL,
  `id_kabupaten` char(3) NOT NULL,
  `id_kecamatan` char(3) NOT NULL,
  `nama_kecamatan` varchar(50) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `lat` double DEFAULT '0',
  `lon` double DEFAULT '0',
  `kecCode` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`,`id_kabupaten`,`id_kecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.ref_kecamatan: ~78 rows (approximately)
/*!40000 ALTER TABLE `ref_kecamatan` DISABLE KEYS */;
INSERT INTO `ref_kecamatan` (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `nama_kecamatan`, `fullName`, `lat`, `lon`, `kecCode`) VALUES
	('34', '1', '1', 'TEMON', NULL, 0, 0, '340101'),
	('34', '1', '10', 'NANGGULAN', NULL, 0, 0, '340110'),
	('34', '1', '11', 'SAMIGALUH', NULL, 0, 0, '340111'),
	('34', '1', '12', 'KALIBAWANG', NULL, 0, 0, '340112'),
	('34', '1', '2', 'WATES', NULL, 0, 0, '340102'),
	('34', '1', '3', 'PANJATAN', NULL, 0, 0, '340103'),
	('34', '1', '4', 'GALUR', NULL, 0, 0, '340104'),
	('34', '1', '5', 'LENDAH', NULL, 0, 0, '340105'),
	('34', '1', '6', 'SENTOLO', NULL, 0, 0, '340106'),
	('34', '1', '7', 'PENGASIH', NULL, 0, 0, '340107'),
	('34', '1', '8', 'KOKAP', NULL, 0, 0, '340108'),
	('34', '1', '9', 'GIRIMULYO', NULL, 0, 0, '340109'),
	('34', '2', '1', 'SRANDAKAN', NULL, 0, 0, '340201'),
	('34', '2', '10', 'IMOGIRI', NULL, 0, 0, '340210'),
	('34', '2', '11', 'DLINGO', NULL, 0, 0, '340211'),
	('34', '2', '12', 'BANGUNTAPAN', NULL, 0, 0, '340212'),
	('34', '2', '13', 'PLERET', NULL, 0, 0, '340213'),
	('34', '2', '14', 'PIYUNGAN', NULL, 0, 0, '340214'),
	('34', '2', '15', 'SEWON', NULL, 0, 0, '340215'),
	('34', '2', '16', 'KASIHAN', NULL, 0, 0, '340216'),
	('34', '2', '17', 'SEDAYU', NULL, 0, 0, '340217'),
	('34', '2', '2', 'SANDEN', NULL, 0, 0, '340202'),
	('34', '2', '3', 'KRETEK', NULL, 0, 0, '340203'),
	('34', '2', '4', 'PUNDONG', NULL, 0, 0, '340204'),
	('34', '2', '5', 'BAMBANG LIPURO', NULL, 0, 0, '340205'),
	('34', '2', '6', 'PANDAK', NULL, 0, 0, '340206'),
	('34', '2', '7', 'PAJANGAN', NULL, 0, 0, '340207'),
	('34', '2', '8', 'BANTUL', NULL, 0, 0, '340208'),
	('34', '2', '9', 'JETIS', NULL, 0, 0, '340209'),
	('34', '3', '1', 'WONOSARI', NULL, 0, 0, '340301'),
	('34', '3', '10', 'PONJONG', NULL, 0, 0, '340310'),
	('34', '3', '11', 'RONGKOP', NULL, 0, 0, '340311'),
	('34', '3', '12', 'SEMIN', NULL, 0, 0, '340312'),
	('34', '3', '13', 'NGAWEN', NULL, 0, 0, '340313'),
	('34', '3', '14', 'GEDANGSARI', NULL, 0, 0, '340314'),
	('34', '3', '15', 'SAPTOSARI', NULL, 0, 0, '340315'),
	('34', '3', '16', 'GIRISUBO', NULL, 0, 0, '340316'),
	('34', '3', '17', 'TANJUNGSARI', NULL, 0, 0, '340317'),
	('34', '3', '18', 'PURWOSARI', NULL, 0, 0, '340318'),
	('34', '3', '2', 'NGLIPAR', NULL, 0, 0, '340302'),
	('34', '3', '3', 'PLAYEN', NULL, 0, 0, '340303'),
	('34', '3', '4', 'PATUK', NULL, 0, 0, '340304'),
	('34', '3', '5', 'PALIYAN', NULL, 0, 0, '340305'),
	('34', '3', '6', 'PANGGANG', NULL, 0, 0, '340306'),
	('34', '3', '7', 'TEPUS', NULL, 0, 0, '340307'),
	('34', '3', '8', 'SEMANU', NULL, 0, 0, '340308'),
	('34', '3', '9', 'KARANGMOJO', NULL, 0, 0, '340309'),
	('34', '4', '1', 'GAMPING', NULL, 0, 0, '340401'),
	('34', '4', '10', 'KALASAN', NULL, 0, 0, '340410'),
	('34', '4', '11', 'NGEMPLAK', NULL, 0, 0, '340411'),
	('34', '4', '12', 'NGAGLIK', NULL, 0, 0, '340412'),
	('34', '4', '13', 'SLEMAN', NULL, 0, 0, '340413'),
	('34', '4', '14', 'TEMPEL', NULL, 0, 0, '340414'),
	('34', '4', '15', 'TURI', NULL, 0, 0, '340415'),
	('34', '4', '16', 'PAKEM', NULL, 0, 0, '340416'),
	('34', '4', '17', 'CANGKRINGAN', NULL, 0, 0, '340417'),
	('34', '4', '2', 'GODEAN', NULL, 0, 0, '340402'),
	('34', '4', '3', 'MOYUDAN', NULL, 0, 0, '340403'),
	('34', '4', '4', 'MINGGIR', NULL, 0, 0, '340404'),
	('34', '4', '5', 'SEYEGAN', NULL, 0, 0, '340405'),
	('34', '4', '6', 'MLATI', NULL, 0, 0, '340406'),
	('34', '4', '7', 'DEPOK', NULL, 0, 0, '340407'),
	('34', '4', '8', 'BERBAH', NULL, 0, 0, '340408'),
	('34', '4', '9', 'PRAMBANAN', NULL, 0, 0, '340409'),
	('34', '71', '1', 'TEGALREJO', NULL, 0, 0, '347101'),
	('34', '71', '10', 'GONDOMANAN', NULL, 0, 0, '347110'),
	('34', '71', '11', 'PAKUALAMAN', NULL, 0, 0, '347111'),
	('34', '71', '12', 'MERGANGSAN', NULL, 0, 0, '347112'),
	('34', '71', '13', 'UMBULHARJO', NULL, 0, 0, '347113'),
	('34', '71', '14', 'KOTAGEDE', NULL, 0, 0, '347114'),
	('34', '71', '2', 'JETIS', NULL, 0, 0, '347102'),
	('34', '71', '3', 'GONDOKUSUMAN', NULL, 0, 0, '347103'),
	('34', '71', '4', 'DANUREJAN', NULL, 0, 0, '347104'),
	('34', '71', '5', 'GEDONGTENGEN', NULL, 0, 0, '347105'),
	('34', '71', '6', 'NGAMPILAN', NULL, 0, 0, '347106'),
	('34', '71', '7', 'WIROBRAJAN', NULL, 0, 0, '347107'),
	('34', '71', '8', 'MANTRIJERON', NULL, 0, 0, '347108'),
	('34', '71', '9', 'KRATON', NULL, 0, 0, '347109');
/*!40000 ALTER TABLE `ref_kecamatan` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.ref_kelurahan
DROP TABLE IF EXISTS `ref_kelurahan`;
CREATE TABLE IF NOT EXISTS `ref_kelurahan` (
  `id_provinsi` char(3) NOT NULL,
  `id_kabupaten` char(3) NOT NULL,
  `id_kecamatan` char(3) NOT NULL,
  `id_kelurahan` char(4) NOT NULL,
  `nama_kelurahan` varchar(100) DEFAULT NULL,
  `kelCode` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_kelurahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.ref_kelurahan: ~75 rows (approximately)
/*!40000 ALTER TABLE `ref_kelurahan` DISABLE KEYS */;
INSERT INTO `ref_kelurahan` (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`, `nama_kelurahan`, `kelCode`) VALUES
	('34', '2', '1', '2001', 'PONCOSARI', '3402012001'),
	('34', '2', '1', '2002', 'TRIMURTI', '3402012002'),
	('34', '2', '10', '2001', 'SELOPAMIORO', '3402102001'),
	('34', '2', '10', '2002', 'SRIHARJO', '3402102002'),
	('34', '2', '10', '2003', 'WUKIRSARI', '3402102003'),
	('34', '2', '10', '2004', 'KEBONAGUNG', '3402102004'),
	('34', '2', '10', '2005', 'KARANG TENGAH', '3402102005'),
	('34', '2', '10', '2006', 'GIRIREJO', '3402102006'),
	('34', '2', '10', '2007', 'KARANGTALUN', '3402102007'),
	('34', '2', '10', '2008', 'IMOGIRI', '3402102008'),
	('34', '2', '11', '2001', 'MANGUNAN', '3402112001'),
	('34', '2', '11', '2002', 'MUNTUK', '3402112002'),
	('34', '2', '11', '2003', 'DLINGO', '3402112003'),
	('34', '2', '11', '2004', 'TEMUWUH', '3402112004'),
	('34', '2', '11', '2005', 'TERONG', '3402112005'),
	('34', '2', '11', '2006', 'JATIMULYO', '3402112006'),
	('34', '2', '12', '2001', 'BATURETNO', '3402122001'),
	('34', '2', '12', '2002', 'BANGUNTAPAN', '3402122002'),
	('34', '2', '12', '2003', 'JAGALAN', '3402122003'),
	('34', '2', '12', '2004', 'SINGOSAREN', '3402122004'),
	('34', '2', '12', '2005', 'JAMBITAN', '3402122005'),
	('34', '2', '12', '2006', 'POTORONO', '3402122006'),
	('34', '2', '12', '2007', 'TAMANAN', '3402122007'),
	('34', '2', '12', '2008', 'WIROKERTEN', '3402122008'),
	('34', '2', '13', '2001', 'WONOKROMO', '3402132001'),
	('34', '2', '13', '2002', 'PLERET', '3402132002'),
	('34', '2', '13', '2003', 'SEGOROYOSO', '3402132003'),
	('34', '2', '13', '2004', 'BAWURAN', '3402132004'),
	('34', '2', '13', '2005', 'WONOLELO', '3402132005'),
	('34', '2', '14', '2001', 'SITIMULYO', '3402142001'),
	('34', '2', '14', '2002', 'SRIMULYO', '3402142002'),
	('34', '2', '14', '2003', 'SRIMARTANI', '3402142003'),
	('34', '2', '15', '2001', 'PENDOWOHARJO', '3402152001'),
	('34', '2', '15', '2002', 'TIMBULHARJO', '3402152002'),
	('34', '2', '15', '2003', 'BANGUNHARJO', '3402152003'),
	('34', '2', '15', '2004', 'PANGGUNGHARJO', '3402152004'),
	('34', '2', '16', '2001', 'BANGUJIWO', '3402162001'),
	('34', '2', '16', '2002', 'TIRTONIRMOLO', '3402162002'),
	('34', '2', '16', '2003', 'TAMANTIRTO', '3402162003'),
	('34', '2', '16', '2004', 'NGESTIHARJO', '3402162004'),
	('34', '2', '17', '2001', 'ARGODADI', '3402172001'),
	('34', '2', '17', '2002', 'ARGOREJO', '3402172002'),
	('34', '2', '17', '2003', 'ARGOSARI', '3402172003'),
	('34', '2', '17', '2004', 'ARGOMULYO', '3402172004'),
	('34', '2', '2', '2001', 'GADINGSARI', '3402022001'),
	('34', '2', '2', '2002', 'GADINGHARJO', '3402022002'),
	('34', '2', '2', '2003', 'SRI GADING', '3402022003'),
	('34', '2', '2', '2004', 'MURTIGADING', '3402022004'),
	('34', '2', '3', '2001', 'TIRTOMULYO', '3402032001'),
	('34', '2', '3', '2002', 'PARANGTRITIS', '3402032002'),
	('34', '2', '3', '2003', 'DONOTIRTO', '3402032003'),
	('34', '2', '3', '2004', 'TIRTOSARI', '3402032004'),
	('34', '2', '3', '2005', 'TIRTOHARJO', '3402032005'),
	('34', '2', '4', '2001', 'SELOHARJO', '3402042001'),
	('34', '2', '4', '2002', 'PANJANG REJO', '3402042002'),
	('34', '2', '4', '2003', 'SRI HARDONO', '3402042003'),
	('34', '2', '5', '2001', 'SIDOMULYO', '3402052001'),
	('34', '2', '5', '2002', 'MULYODADI', '3402052002'),
	('34', '2', '5', '2003', 'SUMBER MULYO', '3402052003'),
	('34', '2', '6', '2001', 'CATUHARJO', '3402062001'),
	('34', '2', '6', '2002', 'TRIHARJO', '3402062002'),
	('34', '2', '6', '2003', 'GILANG HARJO', '3402062003'),
	('34', '2', '6', '2004', 'WIJIREJO', '3402062004'),
	('34', '2', '7', '2001', 'TRI WIDADI', '3402072001'),
	('34', '2', '7', '2002', 'SENDANGSARI', '3402072002'),
	('34', '2', '7', '2003', 'GUWOSARI', '3402072003'),
	('34', '2', '8', '2001', 'PALBAPANG', '3402082001'),
	('34', '2', '8', '2002', 'RINGIN HARJO', '3402082002'),
	('34', '2', '8', '2003', 'BANTUL', '3402082003'),
	('34', '2', '8', '2004', 'TRIRENGGO', '3402082004'),
	('34', '2', '8', '2005', 'SABDODADI', '3402082005'),
	('34', '2', '9', '2001', 'PATALAN', '3402092001'),
	('34', '2', '9', '2002', 'CANDEN', '3402092002'),
	('34', '2', '9', '2003', 'SUMBER AGUNG', '3402092003'),
	('34', '2', '9', '2004', 'TRIMULYO', '3402092004');
/*!40000 ALTER TABLE `ref_kelurahan` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.setting
DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` text,
  `create_date` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT '0',
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.setting: ~15 rows (approximately)
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `name`, `value`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
	(1, 'site_title', 'Karunia Laundry', '2015-04-24 10:32:01', 1, '2015-04-28 16:14:47', '0'),
	(2, 'tagline', 'BBM : 2187956E - 0878 4562 5173', '2015-04-24 10:32:01', 1, '2015-04-28 16:14:47', '0'),
	(3, 'email', 'siapp@setneg.go.id', '2015-04-24 10:32:01', 1, '2015-04-28 16:14:47', '0'),
	(4, 'time_zone', 'UTC+7', '2015-04-24 10:32:01', 1, '2015-04-28 16:14:47', '0'),
	(5, 'lang', 'en', '2015-04-24 10:32:01', 1, '2015-04-28 16:14:47', '0'),
	(6, 'logo', '', '2015-04-24 11:31:45', 1, '2015-04-24 11:41:25', '0'),
	(7, 'facebook', '', '2015-04-24 13:32:14', 1, '2015-04-28 16:14:44', '0'),
	(8, 'twitter', '', '2015-04-24 13:32:14', 1, '2015-04-28 16:14:44', '0'),
	(9, 'youtube', '', '2015-04-24 13:32:14', 1, '2015-04-28 16:14:44', '0'),
	(10, 'google-plus', '', '2015-04-24 13:32:14', 1, '2015-04-28 16:14:44', '0'),
	(11, 'instagram', '', '2015-04-24 13:32:14', 1, '2015-04-28 16:14:44', '0'),
	(12, 'template_admin', 'admin_lte', '2015-04-29 17:58:02', 1, NULL, '0'),
	(13, 'template', 'moderna', '2015-04-29 17:58:21', 1, NULL, '0'),
	(14, 'app_version', '1.0', '2015-06-21 04:36:00', 0, NULL, '0'),
	(15, 'first_login', '0', NULL, 0, '2015-09-03 09:19:02', '0');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.sspd
DROP TABLE IF EXISTS `sspd`;
CREATE TABLE IF NOT EXISTS `sspd` (
  `sspdId` int(11) NOT NULL AUTO_INCREMENT,
  `sspdFormNo` varchar(12) DEFAULT NULL,
  `sspdNik` varchar(20) DEFAULT NULL,
  `sspdNama` varchar(255) DEFAULT NULL,
  `sspdAlamat` varchar(255) DEFAULT NULL,
  `sspdBlok` varchar(50) DEFAULT NULL,
  `sspdRtRw` varchar(20) DEFAULT NULL,
  `sspdKabupaten` varchar(4) DEFAULT NULL,
  `sspdKecamatan` varchar(6) DEFAULT NULL,
  `sspdKelurahan` varchar(10) DEFAULT NULL,
  `sspdTelp` varchar(20) DEFAULT NULL,
  `sspdKodepos` varchar(5) DEFAULT NULL,
  `hargaTransaksi` double DEFAULT NULL,
  `sspdNpop` double DEFAULT NULL,
  `sspdNpoptkp` double DEFAULT NULL,
  `sspdNpopkp` double DEFAULT NULL,
  `sspdTerhutang` double DEFAULT NULL,
  `sspdPersenValue` double DEFAULT NULL,
  `sspdBayar` double DEFAULT NULL,
  `jmlSetoranCheck` char(1) DEFAULT NULL,
  `jmlSetoranValue` varchar(255) DEFAULT NULL,
  `sspdStatusBayar` char(1) DEFAULT NULL COMMENT '0 : belum bayar, 1 : sudah bayar',
  `sspdTrxDate` timestamp NULL DEFAULT NULL,
  `hasPrint` char(1) DEFAULT '0',
  PRIMARY KEY (`sspdId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.sspd: ~6 rows (approximately)
/*!40000 ALTER TABLE `sspd` DISABLE KEYS */;
INSERT INTO `sspd` (`sspdId`, `sspdFormNo`, `sspdNik`, `sspdNama`, `sspdAlamat`, `sspdBlok`, `sspdRtRw`, `sspdKabupaten`, `sspdKecamatan`, `sspdKelurahan`, `sspdTelp`, `sspdKodepos`, `hargaTransaksi`, `sspdNpop`, `sspdNpoptkp`, `sspdNpopkp`, `sspdTerhutang`, `sspdPersenValue`, `sspdBayar`, `jmlSetoranCheck`, `jmlSetoranValue`, `sspdStatusBayar`, `sspdTrxDate`, `hasPrint`) VALUES
	(3, '2017.09.0001', '3333333333333333', 'HANIEF', 'JL KUTOARJO', '84', '1/11', '3402', '340205', '3402052002', '085878757466', '21321', 120000000, 100000000, 60000000, 40000000, 2000000, 1000000, 1000000, 'A', '', '0', '2017-09-09 06:22:20', '0'),
	(4, '2017.09.0002', '3333333333333333', 'HANIEF', 'JL KUTOARJO', '84', '1/11', '3402', '340205', '3402052002', '085878757466', '21321', 120000000, 100000000, 60000000, 40000000, 2000000, 1000000, 1000000, 'C', '{"alasanPenguranganC":"1"}', '0', '2017-09-11 16:15:44', '0'),
	(5, '2017.09.0003', '3333333333333333', 'HANIEF', 'JL KUTOARJO', '84', '1/11', '3402', '340205', '3402052002', '085878757466', '21321', 20000000, 200000000, 60000000, 140000000, 7000000, 0, 7000000, 'A', '', '0', '2017-09-20 09:50:08', '0'),
	(6, '2017.09.0004', '4444444444444444', 'SUKIR SUKIRAN', 'JL KUNG GG JIN', '123456', '1/1', '3402', '340205', '3402052002', '081232321213', '12323', 100000000, 100000000, 60000000, 40000000, 2000000, 0, 2000000, 'A', '', '0', '2017-09-25 15:25:44', '0'),
	(7, '2017.09.0005', '5555555555555555', 'ANDRE SULE', 'JL KUNG GG JIN', '123456', '1/1', '3402', '340205', '3402052002', '081232321213', '12323', 100000000, 100000000, 60000000, 40000000, 2000000, 0, 2000000, 'D', '{"alasanPenguranganD":"ada aja deh"}', '0', '2017-09-25 15:36:02', '0'),
	(8, '2017.09.0006', '9999999999999999', 'SUKIR SUKIRAN', 'JL KUNG GG JIN', '12345', '1/1', '3402', '340205', '3402052002', '081232321213', '12345', 100000000, 100000000, 60000000, 40000000, 2000000, 0, 2000000, 'B', '{"alasanPenguranganBradio":"stpd","alasanPenguranganBNo":"11223123","alasanPenguranganBTgl":"24\\/01\\/1990"}', '0', '2017-09-25 16:16:45', '0');
/*!40000 ALTER TABLE `sspd` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.sspd_detail
DROP TABLE IF EXISTS `sspd_detail`;
CREATE TABLE IF NOT EXISTS `sspd_detail` (
  `detId` int(11) NOT NULL AUTO_INCREMENT,
  `sspdId` int(11) DEFAULT NULL,
  `nopPBB` varchar(20) DEFAULT NULL,
  `lokasiPBB` varchar(255) DEFAULT NULL,
  `blokPBB` varchar(50) DEFAULT NULL,
  `rtrwPBB` varchar(20) DEFAULT NULL,
  `kabupatenPBB` varchar(4) DEFAULT NULL,
  `kecamatanPBB` varchar(6) DEFAULT NULL,
  `kelurahanPBB` varchar(10) DEFAULT NULL,
  `kodeposPBB` varchar(5) DEFAULT NULL,
  `hakAtasTanah` int(11) DEFAULT NULL,
  `noSertifikat` varchar(20) DEFAULT NULL,
  `luasBumi` float DEFAULT NULL,
  `luasBangunan` float DEFAULT NULL,
  `njopBumi` double DEFAULT NULL,
  `njopBangunan` double DEFAULT NULL,
  `npop` double DEFAULT NULL,
  `is_sspd` char(1) DEFAULT '1',
  PRIMARY KEY (`detId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.sspd_detail: ~6 rows (approximately)
/*!40000 ALTER TABLE `sspd_detail` DISABLE KEYS */;
INSERT INTO `sspd_detail` (`detId`, `sspdId`, `nopPBB`, `lokasiPBB`, `blokPBB`, `rtrwPBB`, `kabupatenPBB`, `kecamatanPBB`, `kelurahanPBB`, `kodeposPBB`, `hakAtasTanah`, `noSertifikat`, `luasBumi`, `luasBangunan`, `njopBumi`, `njopBangunan`, `npop`, `is_sspd`) VALUES
	(3, 3, '123231231232131232', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '123456', 100, 0, 1000000, 0, 100000000, '1'),
	(4, 4, '123323231232131232', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '12123213213', 100, 0, 1000000, 0, 100000000, '1'),
	(5, 5, '123231231232131232', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '123456', 100, 0, 2000000, 0, 200000000, '1'),
	(6, 6, '123456778987777665', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1212321312312', 100, 0, 1000000, 0, 100000000, '1'),
	(7, 7, '111111111111111111', 'JL KUNG GG JIN', '12345', '1/1', '3402', '340205', '3402052002', '12345', 1, '1212321312312', 100, 0, 1000000, 0, 100000000, '1'),
	(8, 8, '123456778987777665', 'JL KUNG GG JIN', '12345', '1/1', '3402', '340205', '3402052002', '12344', 1, '1212321312312', 100, 0, 1000000, 0, 100000000, '1');
/*!40000 ALTER TABLE `sspd_detail` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.status_laundry
DROP TABLE IF EXISTS `status_laundry`;
CREATE TABLE IF NOT EXISTS `status_laundry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.status_laundry: ~4 rows (approximately)
/*!40000 ALTER TABLE `status_laundry` DISABLE KEYS */;
INSERT INTO `status_laundry` (`id`, `nama_status`) VALUES
	(1, 'Proses Order'),
	(2, 'Proses Cuci'),
	(3, 'Proses Pengeringan'),
	(4, 'Selesai');
/*!40000 ALTER TABLE `status_laundry` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.sys_group_users
DROP TABLE IF EXISTS `sys_group_users`;
CREATE TABLE IF NOT EXISTS `sys_group_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.sys_group_users: ~1 rows (approximately)
/*!40000 ALTER TABLE `sys_group_users` DISABLE KEYS */;
INSERT INTO `sys_group_users` (`id`, `level`, `deskripsi`) VALUES
	(1, 'admin', 'Administrator');
/*!40000 ALTER TABLE `sys_group_users` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.sys_menu
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE IF NOT EXISTS `sys_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nav_act` varchar(150) DEFAULT NULL,
  `page_name` varchar(150) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  `main_table` varchar(150) DEFAULT NULL,
  `icon` varchar(150) DEFAULT NULL,
  `urutan_menu` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `dt_table` enum('Y','N') NOT NULL,
  `tampil` enum('Y','N') NOT NULL,
  `type_menu` enum('main','page') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.sys_menu: ~1 rows (approximately)
/*!40000 ALTER TABLE `sys_menu` DISABLE KEYS */;
INSERT INTO `sys_menu` (`id`, `nav_act`, `page_name`, `url`, `main_table`, `icon`, `urutan_menu`, `parent`, `dt_table`, `tampil`, `type_menu`) VALUES
	(2, 'transaksi', 'transaksi', 'transaksi', 'transaksi', 'fa-shopping-cart', 2, 0, 'Y', 'Y', 'page');
/*!40000 ALTER TABLE `sys_menu` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.sys_menu_role
DROP TABLE IF EXISTS `sys_menu_role`;
CREATE TABLE IF NOT EXISTS `sys_menu_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `read_act` enum('Y','N') DEFAULT NULL,
  `insert_act` enum('Y','N') DEFAULT NULL,
  `update_act` enum('Y','N') DEFAULT NULL,
  `delete_act` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sys_menu_role_sys_menu` (`id_menu`),
  KEY `FK_sys_menu_role_sys_users` (`group_id`),
  CONSTRAINT `FK_sys_menu_role_sys_group_users` FOREIGN KEY (`group_id`) REFERENCES `sys_group_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sys_menu_role_sys_menu` FOREIGN KEY (`id_menu`) REFERENCES `sys_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.sys_menu_role: ~1 rows (approximately)
/*!40000 ALTER TABLE `sys_menu_role` DISABLE KEYS */;
INSERT INTO `sys_menu_role` (`id`, `id_menu`, `group_id`, `read_act`, `insert_act`, `update_act`, `delete_act`) VALUES
	(2, 2, 1, 'Y', 'Y', 'Y', 'Y');
/*!40000 ALTER TABLE `sys_menu_role` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.sys_users
DROP TABLE IF EXISTS `sys_users`;
CREATE TABLE IF NOT EXISTS `sys_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL DEFAULT '0',
  `last_name` varchar(50) NOT NULL DEFAULT '0',
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `foto_user` varchar(150) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sys_users_sys_group_users` (`id_group`),
  CONSTRAINT `FK_sys_users_sys_group_users` FOREIGN KEY (`id_group`) REFERENCES `sys_group_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.sys_users: ~1 rows (approximately)
/*!40000 ALTER TABLE `sys_users` DISABLE KEYS */;
INSERT INTO `sys_users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `date_created`, `foto_user`, `id_group`, `aktif`) VALUES
	(1, 'mohamad ', 'wildannudin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'wildannudin@gmail.com', '2015-01-26', '10965740_10206190197982755_22114424_n.jpg', 1, 'Y');
/*!40000 ALTER TABLE `sys_users` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.template
DROP TABLE IF EXISTS `template`;
CREATE TABLE IF NOT EXISTS `template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.template: ~3 rows (approximately)
/*!40000 ALTER TABLE `template` DISABLE KEYS */;
INSERT INTO `template` (`id`, `name`, `url`, `type`, `image`) VALUES
	(1, 'sb_admin2', 'template/sb_admin2/', 'admin', NULL),
	(2, 'moderna', 'template/moderna/', 'public', NULL),
	(3, 'admin_lte', 'template/admin_lte/', 'admin', NULL);
/*!40000 ALTER TABLE `template` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.transaksi
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) DEFAULT NULL,
  `no_invoice` varchar(30) DEFAULT NULL,
  `jenis_bayar` varchar(15) DEFAULT NULL,
  `jenis_diskon` varchar(15) DEFAULT NULL,
  `diskon` int(10) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `dibayar` int(10) DEFAULT NULL,
  `sisa` int(10) DEFAULT NULL,
  `status_pembayaran` varchar(15) DEFAULT NULL COMMENT '0 : hutang, 1 : lunas',
  `status_order` int(15) DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `tgl_ambil` date DEFAULT NULL,
  `nama_pengambil` varchar(30) DEFAULT NULL,
  `catatan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.transaksi: ~3 rows (approximately)
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` (`id`, `id_customer`, `no_invoice`, `jenis_bayar`, `jenis_diskon`, `diskon`, `total`, `dibayar`, `sisa`, `status_pembayaran`, `status_order`, `tgl_terima`, `tgl_selesai`, `tgl_ambil`, `nama_pengambil`, `catatan`) VALUES
	(1, 1, '2016061200020', 'nanti', 'nodiskon', NULL, 40000, 0, -40000, 'belum lunas', 1, '2016-06-12', '2016-06-12', NULL, NULL, ''),
	(2, 1, '2016061200021', 'nanti', 'nodiskon', NULL, 40000, 0, -40000, 'belum lunas', 1, '2016-06-12', '2016-06-12', NULL, NULL, ''),
	(3, 1, '2016061400001', 'nanti', 'nodiskon', NULL, 11000, 0, -11000, 'belum lunas', 1, '2016-06-14', '2016-06-14', NULL, NULL, '');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.transaksi_detail
DROP TABLE IF EXISTS `transaksi_detail`;
CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) DEFAULT NULL,
  `layanan_id` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `tipe_harga` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.transaksi_detail: ~3 rows (approximately)
/*!40000 ALTER TABLE `transaksi_detail` DISABLE KEYS */;
INSERT INTO `transaksi_detail` (`id`, `transaksi_id`, `layanan_id`, `qty`, `tipe_harga`, `harga`, `sub_total`) VALUES
	(1, 1, 1, 10, 'harga_normal', 4000, 40000),
	(2, 2, 1, 10, 'harga_normal', 4000, 40000),
	(3, 3, 1, 2.75, 'harga_normal', 4000, 11000);
/*!40000 ALTER TABLE `transaksi_detail` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `group_id` varchar(255) DEFAULT NULL,
  `userfile` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT '0',
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `username`, `password`, `email`, `group_id`, `userfile`, `create_date`, `create_by`, `update_date`, `update_by`, `last_login`) VALUES
	('5dab4804c4f05f11d7e2ac6379a55ed9b3d24fda', 'Admin Dev', 'isaadmin', 'a5039e5b86e2b0588c0af55d1c40e74ad616d5d7', 'hanief@isatechindonesia.com', '54345880d047bf8496e0df28c4a3db5359083240', NULL, '2015-04-28 11:06:47', 0, '2015-04-28 16:29:10', '0', '0000-00-00 00:00:00'),
	('c4cab7526d9d124d79b30c818d2fcc37a1f63c73', 'Admin SSPD', 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'haniefhan@gmail.com', '67544603076af2daf15675402647dcbe85c629ec', NULL, '2015-04-28 12:48:38', 0, '2017-10-24 04:43:54', 'c4cab7526d9d124d79b30c818d2fcc37a1f63c73', '2017-10-24 04:43:54');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.wajib_pajak
DROP TABLE IF EXISTS `wajib_pajak`;
CREATE TABLE IF NOT EXISTS `wajib_pajak` (
  `wpId` int(11) NOT NULL AUTO_INCREMENT,
  `wpNoFormulir` varchar(10) DEFAULT NULL COMMENT 'tahun formulir [dot] bulan formulir [dot] no_urut : xx.xx.xxxx',
  `wpNama` varchar(255) DEFAULT NULL,
  `wpNik` varchar(50) DEFAULT NULL,
  `wpAlamat` varchar(255) DEFAULT NULL,
  `wpBlok` varchar(50) DEFAULT NULL,
  `wpKelurahan` varchar(50) DEFAULT NULL,
  `wpRtRw` varchar(50) DEFAULT NULL,
  `wpKecamatan` varchar(50) DEFAULT NULL,
  `wpKabupaten` varchar(50) DEFAULT NULL,
  `wpTelp` varchar(20) DEFAULT NULL,
  `wpKodepos` varchar(6) DEFAULT NULL,
  `wpNpop` int(11) DEFAULT NULL,
  `wpNpoptkp` int(11) DEFAULT NULL,
  `wpNpopkp` int(11) DEFAULT NULL,
  `wpTerhutang` int(11) DEFAULT NULL,
  `wpPersenType` varchar(20) DEFAULT NULL,
  `wpPersenValue` int(11) DEFAULT NULL,
  `wpBeaHarusBayar` int(11) DEFAULT NULL,
  `wpSetoranA` char(1) DEFAULT NULL COMMENT '0 : not check, 1 : check',
  `wpSetoranB` char(1) DEFAULT NULL COMMENT '0 : not check, 1 : check',
  `wpSetoranBtype` char(10) DEFAULT NULL,
  `wpSetoranBno` varchar(50) DEFAULT NULL,
  `wpSetoranBtgl` date DEFAULT NULL,
  `wpSetoranC` char(1) DEFAULT NULL COMMENT '0 : not check, 1 : check',
  `wpSetoranCvalue` varchar(255) DEFAULT NULL,
  `wpSetoranD` char(1) DEFAULT NULL COMMENT '0 : not check, 1 : check',
  `wpSetoranDvalue` varchar(255) DEFAULT NULL,
  `wpBayar` int(11) DEFAULT NULL,
  `createDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`wpId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.wajib_pajak: ~0 rows (approximately)
/*!40000 ALTER TABLE `wajib_pajak` DISABLE KEYS */;
/*!40000 ALTER TABLE `wajib_pajak` ENABLE KEYS */;

-- Dumping structure for table sspd_bantul.widget
DROP TABLE IF EXISTS `widget`;
CREATE TABLE IF NOT EXISTS `widget` (
  `widId` int(11) NOT NULL AUTO_INCREMENT,
  `widTitle` varchar(255) DEFAULT NULL,
  `widIconType` enum('fa','img') DEFAULT NULL,
  `widIconValue` varchar(255) DEFAULT NULL,
  `widDesc` varchar(255) DEFAULT NULL,
  `widUrl` varchar(255) DEFAULT NULL,
  `widType` enum('online','info') DEFAULT NULL,
  `widOrder` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`widId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table sspd_bantul.widget: ~11 rows (approximately)
/*!40000 ALTER TABLE `widget` DISABLE KEYS */;
INSERT INTO `widget` (`widId`, `widTitle`, `widIconType`, `widIconValue`, `widDesc`, `widUrl`, `widType`, `widOrder`) VALUES
	(1, 'PBB', 'fa', 'fa-home', 'Cetak SSPD PBB', '#', 'info', 1),
	(2, 'BPHTB', 'fa', 'fa-globe', 'Cetak SSPD BPHTB', 'http://localhost:8012/sspd_bantul/index.php/layanan/add?type=bphtb', 'online', 1),
	(3, 'Hotel', 'fa', 'fa-building-o', 'Cetak SSPD Hotel', '#', 'info', 2),
	(4, 'Restoran', 'fa', 'fa-cutlery', 'Cetak SSPD Restoran', '#', 'info', 3),
	(5, 'Hiburan', 'fa', 'fa-music', 'Cetak SSPD Hiburan', '#', 'info', 4),
	(6, 'Reklame', 'fa', 'fa-calendar-o', 'Cetak SSPD Reklame', '#', 'info', 5),
	(7, 'PPJ', 'fa', 'fa-lightbulb-o', 'Cetak SSPD PPJ', '#', 'info', 6),
	(8, 'MBLB', 'fa', 'fa-desktop', 'Cetak SSPD MBLB', '#', 'info', 7),
	(9, 'Parkir', 'fa', 'fa-desktop', 'Cetak SSPD Parkir', '#', 'info', 8),
	(10, 'Air Tanah', 'fa', 'fa-desktop', 'Cetak SSPD Air Tanah', '#', 'info', 9),
	(11, 'Sarang Burung Walet', 'fa', 'fa-twitter ', 'Cetak SSPD Sarang Burung Walet', '#', 'info', 10);
/*!40000 ALTER TABLE `widget` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
