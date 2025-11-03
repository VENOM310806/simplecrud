/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - db_nasabah
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_nasabah` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_nasabah`;

/*Table structure for table `tb_jenis_bank` */

DROP TABLE IF EXISTS `tb_jenis_bank`;

CREATE TABLE `tb_jenis_bank` (
  `kode_bank` char(10) NOT NULL,
  `nm_bank` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`kode_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_jenis_bank` */

insert  into `tb_jenis_bank`(`kode_bank`,`nm_bank`) values 
('BCA','Bank Central Asia'),
('BI','Bank Indonesia'),
('BJI','Bank Jago Indonesia'),
('BNI','Bank Negara Indonesia'),
('BPD','Bank Pembangunan Daerah'),
('BRI','Bank Rakyat Indonesia'),
('BSI','Bank Syariah Indonesia'),
('BTN','Bank Tabungan Negara'),
('MNDR','Bank Mandiri');

/*Table structure for table `tb_nasabah` */

DROP TABLE IF EXISTS `tb_nasabah`;

CREATE TABLE `tb_nasabah` (
  `id_nsb` int NOT NULL AUTO_INCREMENT,
  `no_rekening` char(12) NOT NULL DEFAULT '',
  `nm_nsb` varchar(50) NOT NULL DEFAULT '',
  `jenis_bank` char(50) NOT NULL DEFAULT '',
  `alamat` text NOT NULL,
  `provinsi` mediumint NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telp` char(20) NOT NULL DEFAULT '',
  `status_nsb` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_nsb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_nasabah` */

/*Table structure for table `tb_provinsi` */

DROP TABLE IF EXISTS `tb_provinsi`;

CREATE TABLE `tb_provinsi` (
  `id_provinsi` smallint NOT NULL AUTO_INCREMENT,
  `nm_provinsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_provinsi` */

insert  into `tb_provinsi`(`id_provinsi`,`nm_provinsi`) values 
(1,'Jakarta'),
(2,'Jawa Barat'),
(3,'Jawa Tengah'),
(4,'Jawa Timur'),
(5,'Nusa Tenggara Timur'),
(6,'Bali');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
