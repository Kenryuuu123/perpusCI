/*
SQLyog Community v13.1.3  (64 bit)
MySQL - 10.1.25-MariaDB : Database - perpus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`perpus` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `perpus`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id_admin` varchar(8) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `no_hp` char(13) NOT NULL,
  `img` varchar(50) NOT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `id_admin` (`id_admin`,`password`,`nama`,`alamat`,`no_hp`),
  KEY `id_admin_2` (`id_admin`,`password`,`nama`,`alamat`,`no_hp`,`img`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_admin` */

/*Table structure for table `tb_agama` */

DROP TABLE IF EXISTS `tb_agama`;

CREATE TABLE `tb_agama` (
  `id_agama` int(2) NOT NULL AUTO_INCREMENT,
  `agama` varchar(20) NOT NULL,
  PRIMARY KEY (`id_agama`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_agama` */

insert  into `tb_agama`(`id_agama`,`agama`) values 
(2,'Islam'),
(3,'Konghucu'),
(4,'Budha'),
(5,'Katholik'),
(6,'Hindu');

/*Table structure for table `tb_anggota` */

DROP TABLE IF EXISTS `tb_anggota`;

CREATE TABLE `tb_anggota` (
  `id_anggota` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_agama` int(2) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `id_agama` (`id_agama`),
  CONSTRAINT `tb_anggota_ibfk_1` FOREIGN KEY (`id_agama`) REFERENCES `tb_agama` (`id_agama`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_anggota` */

insert  into `tb_anggota`(`id_anggota`,`nama`,`id_agama`,`jenis_kelamin`,`hp`,`alamat`,`ket`) values 
('ANGG000001','Nova',2,'P','081259304168','benowo','');

/*Table structure for table `tb_buku` */

DROP TABLE IF EXISTS `tb_buku`;

CREATE TABLE `tb_buku` (
  `id_buku` char(15) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `id_kategori` int(3) NOT NULL,
  `id_penerbit` int(3) NOT NULL,
  `id_pengarang` int(3) NOT NULL,
  `no_rak` int(2) NOT NULL,
  `thn_terbit` year(4) NOT NULL,
  `stok` int(3) NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`id_buku`),
  KEY `id_kategori` (`id_kategori`),
  KEY `id_penerbit` (`id_penerbit`),
  KEY `id_pengarang` (`id_pengarang`),
  KEY `no_rak` (`no_rak`),
  KEY `id_buku` (`id_buku`,`ISBN`,`judul`,`id_kategori`,`id_penerbit`,`id_pengarang`,`no_rak`,`thn_terbit`,`stok`),
  CONSTRAINT `tb_buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_buku_ibfk_2` FOREIGN KEY (`id_penerbit`) REFERENCES `tb_penerbit` (`id_penerbit`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_buku_ibfk_3` FOREIGN KEY (`id_pengarang`) REFERENCES `tb_pengarang` (`id_pengarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_buku_ibfk_4` FOREIGN KEY (`no_rak`) REFERENCES `tb_rak` (`no_rak`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_buku` */

insert  into `tb_buku`(`id_buku`,`ISBN`,`judul`,`id_kategori`,`id_penerbit`,`id_pengarang`,`no_rak`,`thn_terbit`,`stok`,`ket`) values 
('1','132142','Ekonomi Negara',1,5,4,1,2010,6,'http://192.168.1.15/E-Klaim'),
('2','1213451','Sok Hok Gie',3,4,6,3,2009,2,''),
('3','131414','Machine Learning',5,4,2,5,2017,1,''),
('4','67322','Pesantren Impian',2,1,5,2,2010,3,''),
('5','24522','Tuntunan Shalat',4,6,6,4,2019,6,'Donasi Siswa'),
('6','096525','Mohammad Ali',3,6,1,3,2012,1,'Donasi Guru'),
('LJ001','26207761','Jurnal Kesehatan is a scientific journal of the Faculty of Health Sciences of Universitas Muhammadiy',6,1,3,7,2010,0,'http://journals.ums.ac.id/index.php/JK');

/*Table structure for table `tb_denda` */

DROP TABLE IF EXISTS `tb_denda`;

CREATE TABLE `tb_denda` (
  `id_denda` int(6) NOT NULL AUTO_INCREMENT,
  `denda` int(6) NOT NULL,
  `status` enum('A','N') NOT NULL,
  PRIMARY KEY (`id_denda`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_denda` */

insert  into `tb_denda`(`id_denda`,`denda`,`status`) values 
(6,500,'A'),
(7,1000,'N');

/*Table structure for table `tb_detail_buku` */

DROP TABLE IF EXISTS `tb_detail_buku`;

CREATE TABLE `tb_detail_buku` (
  `id_detail_buku` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` char(15) NOT NULL,
  `no_buku` int(4) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0',
  KEY `id_detail_buku` (`id_detail_buku`,`id_buku`,`no_buku`,`status`),
  KEY `id_buku` (`id_buku`),
  CONSTRAINT `tb_detail_buku_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_buku` */

insert  into `tb_detail_buku`(`id_detail_buku`,`id_buku`,`no_buku`,`status`) values 
(71,'1',1,'1'),
(72,'1',2,'0'),
(73,'1',3,'0'),
(74,'1',4,'1'),
(75,'1',5,'0'),
(76,'1',6,'1'),
(77,'2',1,'1'),
(78,'2',2,'1'),
(81,'3',1,'1'),
(82,'4',1,'1'),
(83,'4',2,'1'),
(84,'4',3,'0'),
(85,'5',1,'1'),
(86,'5',2,'1'),
(87,'5',3,'1'),
(88,'5',4,'0'),
(89,'5',5,'1'),
(90,'5',6,'1'),
(91,'6',1,'1');

/*Table structure for table `tb_detail_pinjam` */

DROP TABLE IF EXISTS `tb_detail_pinjam`;

CREATE TABLE `tb_detail_pinjam` (
  `id_detail_pinjam` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjam` int(11) NOT NULL,
  `id_buku` char(15) NOT NULL,
  `no_buku` int(4) NOT NULL,
  `flag` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_pinjam`),
  KEY `id_anggota` (`id_pinjam`),
  KEY `id_detail_pinjam` (`id_detail_pinjam`,`id_pinjam`,`id_buku`,`no_buku`),
  KEY `id_buku` (`id_buku`),
  CONSTRAINT `tb_detail_pinjam_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `tb_pinjam` (`id_pinjam`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_detail_pinjam_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_pinjam` */

/*Table structure for table `tb_kategori` */

DROP TABLE IF EXISTS `tb_kategori`;

CREATE TABLE `tb_kategori` (
  `id_kategori` int(3) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kategori` */

insert  into `tb_kategori`(`id_kategori`,`kategori`) values 
(1,'SOSIAL'),
(2,'NOVEL'),
(3,'BIOGRAFI'),
(4,'RELIGI'),
(5,'MATEMATIKA'),
(6,'Rumah Sakit');

/*Table structure for table `tb_kelas` */

DROP TABLE IF EXISTS `tb_kelas`;

CREATE TABLE `tb_kelas` (
  `id_kelas` int(2) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(10) NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kelas` */

insert  into `tb_kelas`(`id_kelas`,`kelas`) values 
(4,'X IPS 1'),
(5,'X IPS 2'),
(6,'X IPS 3'),
(7,'X IPA 1'),
(8,'X IPA 2'),
(9,'X IPA 3'),
(10,'XI IPS 1'),
(11,'XI IPS 2'),
(12,'XI IPS 3'),
(13,'XI IPA 1'),
(14,'XI IPA 2'),
(15,'XI IPA 3'),
(16,'XII IPS 1'),
(17,'XII IPS 2'),
(18,'XII IPS 3'),
(19,'XII IPA 1'),
(20,'XII IPA 2'),
(21,'XII IPA 3');

/*Table structure for table `tb_kembali` */

DROP TABLE IF EXISTS `tb_kembali`;

CREATE TABLE `tb_kembali` (
  `id_kembali` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjam` int(11) NOT NULL,
  `tgl_dikembalikan` date NOT NULL,
  `terlambat` int(2) NOT NULL,
  `id_denda` int(6) NOT NULL,
  `denda` int(11) NOT NULL,
  PRIMARY KEY (`id_kembali`),
  KEY `id_detail` (`id_pinjam`),
  KEY `id_kembali` (`id_kembali`,`id_pinjam`,`tgl_dikembalikan`,`terlambat`,`id_denda`),
  CONSTRAINT `tb_kembali_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `tb_pinjam` (`id_pinjam`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kembali` */

/*Table structure for table `tb_login` */

DROP TABLE IF EXISTS `tb_login`;

CREATE TABLE `tb_login` (
  `username` varchar(15) NOT NULL,
  `password` varchar(75) NOT NULL,
  `stts` varchar(10) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `username` (`username`,`password`,`stts`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_login` */

insert  into `tb_login`(`username`,`password`,`stts`) values 
('1630511','afb91ef692fd08c445e8cb1bab2ccf9c','petugas'),
('admin','21232f297a57a5a743894a0e4a801fc3','admin'),
('administrator','5f4dcc3b5aa765d61d8327deb882cf99','admin');

/*Table structure for table `tb_penerbit` */

DROP TABLE IF EXISTS `tb_penerbit`;

CREATE TABLE `tb_penerbit` (
  `id_penerbit` int(3) NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(50) NOT NULL,
  `id_provinsi` int(4) NOT NULL,
  PRIMARY KEY (`id_penerbit`),
  KEY `id_penerbit` (`id_penerbit`,`nama_penerbit`,`id_provinsi`),
  KEY `id_provinsi` (`id_provinsi`),
  CONSTRAINT `tb_penerbit_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `tb_provinsi` (`id_provinsi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_penerbit` */

insert  into `tb_penerbit`(`id_penerbit`,`nama_penerbit`,`id_provinsi`) values 
(1,'Erlangga',1),
(4,'Andi',2),
(5,'Gramedia',8),
(6,'HGS',2);

/*Table structure for table `tb_pengarang` */

DROP TABLE IF EXISTS `tb_pengarang`;

CREATE TABLE `tb_pengarang` (
  `id_pengarang` int(3) NOT NULL AUTO_INCREMENT,
  `nama_pengarang` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pengarang`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengarang` */

insert  into `tb_pengarang`(`id_pengarang`,`nama_pengarang`) values 
(1,'Susanto Sunaryo'),
(2,'Tere Liye'),
(3,'Graha Mulia'),
(4,'Boy Candra'),
(5,'Asma Nadia'),
(6,'Bambang Kunaryo');

/*Table structure for table `tb_petugas` */

DROP TABLE IF EXISTS `tb_petugas`;

CREATE TABLE `tb_petugas` (
  `id_petugas` char(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `img` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_agama` int(2) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`id_petugas`),
  KEY `id_agama` (`id_agama`),
  CONSTRAINT `tb_petugas_ibfk_1` FOREIGN KEY (`id_agama`) REFERENCES `tb_agama` (`id_agama`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_petugas` */

insert  into `tb_petugas`(`id_petugas`,`nama`,`img`,`jenis_kelamin`,`alamat`,`password`,`id_agama`,`hp`,`ket`) values 
('1630511','Asep Gumasep','XJTSVN4OB8LA17FIY9RZP5E630C2QUMGHDWK.jpg','L','Wangun','petugas',2,'012861212134',''),
('admin','Adminstrator','G981H6QF3574DOTMSXCUP0WZ2JERLIVAYNBK.jpg','L','Gudang','admin',2,'053244252522',''),
('administra','Nova','','P','benowo','password',2,'081259304168','');

/*Table structure for table `tb_pinjam` */

DROP TABLE IF EXISTS `tb_pinjam`;

CREATE TABLE `tb_pinjam` (
  `id_pinjam` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pinjam` date NOT NULL,
  `id_anggota` varchar(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `total_buku` int(4) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_pinjam`),
  KEY `id_detail` (`tgl_kembali`),
  KEY `id_buku` (`id_anggota`),
  KEY `id_pinjam` (`id_pinjam`,`tgl_pinjam`,`id_anggota`,`tgl_kembali`,`total_buku`),
  CONSTRAINT `tb_pinjam_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pinjam` */

/*Table structure for table `tb_provinsi` */

DROP TABLE IF EXISTS `tb_provinsi`;

CREATE TABLE `tb_provinsi` (
  `id_provinsi` int(2) NOT NULL AUTO_INCREMENT,
  `nama_provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tb_provinsi` */

insert  into `tb_provinsi`(`id_provinsi`,`nama_provinsi`,`kota`) values 
(1,'Sumatera Selatan','Palembang'),
(2,'D.I.Y Yogyakarta','Yogya'),
(4,'Jambi','Jambi Kota'),
(6,'Pekan Baru','Riau'),
(7,'Jakarta','Jakarta'),
(8,'Jawa Barat','Bandung');

/*Table structure for table `tb_rak` */

DROP TABLE IF EXISTS `tb_rak`;

CREATE TABLE `tb_rak` (
  `no_rak` int(2) NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(50) NOT NULL,
  `id_kategori` int(3) NOT NULL,
  PRIMARY KEY (`no_rak`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `tb_rak_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_rak` */

insert  into `tb_rak`(`no_rak`,`nama_rak`,`id_kategori`) values 
(1,'1-150 SSL',1),
(2,'150-300 NVL',2),
(3,'300-370 BGF',3),
(4,'390-500 RLG',4),
(5,'500-567 MTK',5),
(7,'LINK JURNAL',6);

/*Table structure for table `test` */

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `kode` varchar(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `mboh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `test` */

insert  into `test`(`kode`,`nama`,`mboh`) values 
('','ari',''),
('Kode000001','ari2',''),
('Kode000002','ari2',''),
('Kode000003','Ariandi AS','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
