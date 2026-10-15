-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: sibibit
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `sibibit`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `sibibit` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `sibibit`;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned DEFAULT NULL,
  `data_lama` json DEFAULT NULL,
  `data_baru` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES (1,1,'create','System',1,NULL,NULL,'127.0.0.1','2026-10-10 08:49:52','2026-10-10 08:49:52'),(2,3,'update','LaporanTumbuhKembang',1,'{\"id\": 1, \"catatan\": \"balalalala 100\", \"foto_url\": null, \"created_at\": \"2026-10-13T04:55:47.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-10-13T04:56:04.000000Z\", \"pendamping_id\": 3, \"tanggal_lapor\": \"2026-10-13\", \"status_kondisi\": \"normal\", \"keluarga_penerima_id\": 1}','{\"id\": 1, \"catatan\": \"Kunjungan rutin: bibit tumbuh sangat subur setinggi 65cm, daun hijau lebat tidak ada tanda hama.\", \"foto_url\": \"https://images.unsplash.com/photo-1542601906990-b4d3fb778b09\", \"created_at\": \"2026-10-13T04:55:47.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-10-14T13:46:24.000000Z\", \"pendamping_id\": 3, \"tanggal_lapor\": \"2026-10-14\", \"status_kondisi\": \"normal\", \"keluarga_penerima_id\": 1}',NULL,'2026-10-14 06:46:24','2026-10-14 06:46:24'),(3,3,'update','LaporanTumbuhKembang',2,'{\"id\": 2, \"catatan\": \"wkwkwkwkwk\", \"foto_url\": null, \"created_at\": \"2026-10-14T13:36:33.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-10-14T13:36:33.000000Z\", \"pendamping_id\": 3, \"tanggal_lapor\": \"2026-10-14\", \"status_kondisi\": \"normal\", \"keluarga_penerima_id\": 4}','{\"id\": 2, \"catatan\": \"asdasdasdadadsadas\", \"foto_url\": null, \"created_at\": \"2026-10-14T13:36:33.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-10-14T13:48:22.000000Z\", \"pendamping_id\": 3, \"tanggal_lapor\": \"2026-10-14\", \"status_kondisi\": \"hama\", \"keluarga_penerima_id\": 4}','127.0.0.1','2026-10-14 06:48:22','2026-10-14 06:48:22'),(4,3,'create','LaporanTumbuhKembang',3,NULL,'{\"id\": 3, \"catatan\": \"aahahahahahahahah\", \"foto_url\": null, \"created_at\": \"2026-10-14T13:48:58.000000Z\", \"updated_at\": \"2026-10-14T13:48:58.000000Z\", \"pendamping_id\": 3, \"tanggal_lapor\": \"2026-10-14\", \"status_kondisi\": \"normal\", \"keluarga_penerima_id\": \"4\"}','127.0.0.1','2026-10-14 06:48:58','2026-10-14 06:48:58'),(5,3,'create','LaporanTumbuhKembang',5,NULL,'{\"id\": 5, \"catatan\": \"tanaman di makan sapi\", \"foto_url\": null, \"created_at\": \"2026-10-14T13:57:16.000000Z\", \"updated_at\": \"2026-10-14T13:57:16.000000Z\", \"pendamping_id\": 3, \"tanggal_lapor\": \"2026-10-14\", \"status_kondisi\": \"gagal\", \"keluarga_penerima_id\": \"4\"}','127.0.0.1','2026-10-14 06:57:16','2026-10-14 06:57:16'),(6,3,'Input Penilaian Desil Kemandirian','PenilaianKemandirian',5,'{\"desil\": 5, \"status_kemandirian\": \"Belum Dinilai\", \"penghasilan_perbulan\": \"0.00\"}','{\"desil\": 3, \"total_skor\": 39, \"status_kemandirian\": \"Rentan\", \"status_perkembangan\": \"Mundur\", \"penghasilan_perbulan\": 1800000}','127.0.0.1','2026-10-14 07:16:24','2026-10-14 07:16:24'),(7,3,'Input Penilaian Desil Kemandirian','PenilaianKemandirian',6,'{\"desil\": 3, \"status_kemandirian\": \"Rentan\", \"penghasilan_perbulan\": \"1800000.00\"}','{\"desil\": 3, \"total_skor\": 39, \"status_kemandirian\": \"Rentan\", \"status_perkembangan\": \"Tetap\", \"penghasilan_perbulan\": 1800000}','127.0.0.1','2026-10-14 07:16:42','2026-10-14 07:16:42'),(8,3,'Input Penilaian Desil Kemandirian','PenilaianKemandirian',7,'{\"desil\": 2, \"status_kemandirian\": \"Belum Dinilai\", \"penghasilan_perbulan\": \"0.00\"}','{\"desil\": 4, \"total_skor\": 49, \"status_kemandirian\": \"Rentan\", \"status_perkembangan\": \"Maju\", \"penghasilan_perbulan\": 3800000}','127.0.0.1','2026-10-14 07:16:57','2026-10-14 07:16:57'),(9,3,'Input Penilaian Desil Kemandirian','PenilaianKemandirian',8,'{\"desil\": 3, \"status_kemandirian\": \"Belum Dinilai\", \"penghasilan_perbulan\": \"0.00\"}','{\"desil\": 3, \"total_skor\": 44, \"status_kemandirian\": \"Rentan\", \"status_perkembangan\": \"Tetap\", \"penghasilan_perbulan\": \"3000000\"}','127.0.0.1','2026-10-14 07:24:49','2026-10-14 07:24:49'),(10,3,'Input Penilaian Desil Kemandirian','PenilaianKemandirian',9,'{\"desil\": 3, \"status_kemandirian\": \"Rentan\", \"penghasilan_perbulan\": \"3000000.00\"}','{\"desil\": 3, \"total_skor\": 44, \"status_kemandirian\": \"Rentan\", \"status_perkembangan\": \"Tetap\", \"penghasilan_perbulan\": \"9000000\"}','127.0.0.1','2026-10-14 07:25:49','2026-10-14 07:25:49'),(11,3,'Input Penilaian Desil Kemandirian','PenilaianKemandirian',12,'{\"desil\": 3, \"status_kemandirian\": \"Tahap Kemandirian\", \"penghasilan_perbulan\": \"1800000.00\"}','{\"desil\": 3, \"total_skor\": 39, \"status_kemandirian\": \"Tahap Kemandirian\", \"status_perkembangan\": \"Tetap\", \"penghasilan_perbulan\": 1800000}','127.0.0.1','2026-10-14 07:33:01','2026-10-14 07:33:01'),(12,3,'Input Penilaian Desil Kemandirian','PenilaianKemandirian',13,'{\"desil\": 2, \"status_kemandirian\": \"Penurunan Desil\", \"penghasilan_perbulan\": \"750000.00\"}','{\"desil\": 2, \"total_skor\": 34, \"status_kemandirian\": \"Tahap Kemandirian\", \"status_perkembangan\": \"Tetap\", \"penghasilan_perbulan\": \"7500000\"}','127.0.0.1','2026-10-14 07:34:35','2026-10-14 07:34:35'),(13,3,'Input Penilaian Desil Kemandirian','PenilaianKemandirian',14,'{\"desil\": 3, \"status_kemandirian\": \"Tahap Kemandirian\", \"penghasilan_perbulan\": \"1800000.00\"}','{\"desil\": 7, \"total_skor\": 72, \"status_kemandirian\": \"Mandiri\", \"status_perkembangan\": \"Maju\", \"penghasilan_perbulan\": 7000000}','127.0.0.1','2026-10-14 07:41:18','2026-10-14 07:41:18'),(14,3,'Tambah Data Keluarga Penerima Binaan','KeluargaPenerima',5,NULL,'{\"nik\": \"5204933420086214\", \"desil\": 4, \"no_kk\": \"5204177388703171\", \"alamat\": \"RT 01 RW 02 Dusun Uji Coba\", \"user_id\": 10, \"kampus_id\": 1, \"wilayah_id\": 1, \"pendamping_id\": 3, \"kepala_keluarga\": \"Bapak Test CRUD Antigravity\", \"status_validasi\": \"valid\", \"program_bantuan_id\": 1, \"status_kemandirian\": \"Tahap Kemandirian\", \"penghasilan_perbulan\": 1800000}','127.0.0.1','2026-10-14 07:51:20','2026-10-14 07:51:20'),(15,3,'Update Data Keluarga Penerima Binaan','KeluargaPenerima',5,'{\"id\": 5, \"nik\": \"5204933420086214\", \"desil\": 4, \"no_kk\": \"5204177388703171\", \"alamat\": \"RT 01 RW 02 Dusun Uji Coba\", \"user_id\": 10, \"kampus_id\": 1, \"created_at\": \"2026-10-14T14:51:20.000000Z\", \"deleted_at\": null, \"is_flagged\": 0, \"updated_at\": \"2026-10-14T14:51:20.000000Z\", \"wilayah_id\": 1, \"pendamping_id\": 3, \"kepala_keluarga\": \"Bapak Test CRUD Antigravity\", \"status_validasi\": \"valid\", \"program_bantuan_id\": 1, \"status_kemandirian\": \"Tahap Kemandirian\", \"penghasilan_perbulan\": \"1800000.00\"}','{\"id\": 5, \"nik\": \"5204933420086214\", \"user\": {\"id\": 10, \"name\": \"Bapak Test CRUD Antigravity (UPDATED)\", \"role\": \"penerima\", \"email\": \"5204933420086214@penerima.com\", \"kampus_id\": null, \"created_at\": \"2026-10-14T14:51:20.000000Z\", \"updated_at\": \"2026-10-14T14:51:21.000000Z\", \"email_verified_at\": null}, \"desil\": 6, \"no_kk\": \"5204177388703171\", \"alamat\": \"RT 05 RW 01 Dusun Baru\", \"user_id\": 10, \"kampus_id\": 1, \"created_at\": \"2026-10-14T14:51:20.000000Z\", \"deleted_at\": null, \"is_flagged\": 0, \"updated_at\": \"2026-10-14T14:51:21.000000Z\", \"wilayah_id\": 1, \"pendamping_id\": 3, \"kepala_keluarga\": \"Bapak Test CRUD Antigravity (UPDATED)\", \"status_validasi\": \"valid\", \"program_bantuan_id\": 1, \"status_kemandirian\": \"Mandiri\", \"penghasilan_perbulan\": 3800000}','127.0.0.1','2026-10-14 07:51:21','2026-10-14 07:51:21'),(16,3,'Hapus Data Keluarga Penerima Binaan','KeluargaPenerima',5,'{\"id\": 5, \"nik\": \"5204933420086214\", \"desil\": 6, \"no_kk\": \"5204177388703171\", \"alamat\": \"RT 05 RW 01 Dusun Baru\", \"user_id\": 10, \"kampus_id\": 1, \"created_at\": \"2026-10-14T14:51:20.000000Z\", \"deleted_at\": null, \"is_flagged\": 0, \"updated_at\": \"2026-10-14T14:51:21.000000Z\", \"wilayah_id\": 1, \"pendamping_id\": 3, \"kepala_keluarga\": \"Bapak Test CRUD Antigravity (UPDATED)\", \"status_validasi\": \"valid\", \"program_bantuan_id\": 1, \"status_kemandirian\": \"Mandiri\", \"penghasilan_perbulan\": \"3800000.00\"}',NULL,'127.0.0.1','2026-10-14 07:51:21','2026-10-14 07:51:21'),(17,3,'Tambah Data Keluarga Penerima Binaan','KeluargaPenerima',6,NULL,'{\"nik\": \"5204221684162502\", \"desil\": 4, \"no_kk\": \"5204205380275646\", \"alamat\": \"RT 01 RW 02 Dusun Uji Coba\", \"user_id\": 11, \"kampus_id\": 1, \"wilayah_id\": 1, \"pendamping_id\": 3, \"kepala_keluarga\": \"Bapak Test CRUD Antigravity\", \"status_validasi\": \"valid\", \"program_bantuan_id\": 1, \"status_kemandirian\": \"Tahap Kemandirian\", \"penghasilan_perbulan\": 1800000}','127.0.0.1','2026-10-14 07:51:57','2026-10-14 07:51:57'),(18,3,'Update Data Keluarga Penerima Binaan','KeluargaPenerima',6,'{\"id\": 6, \"nik\": \"5204221684162502\", \"desil\": 4, \"no_kk\": \"5204205380275646\", \"alamat\": \"RT 01 RW 02 Dusun Uji Coba\", \"user_id\": 11, \"kampus_id\": 1, \"created_at\": \"2026-10-14T14:51:57.000000Z\", \"deleted_at\": null, \"is_flagged\": 0, \"updated_at\": \"2026-10-14T14:51:57.000000Z\", \"wilayah_id\": 1, \"pendamping_id\": 3, \"kepala_keluarga\": \"Bapak Test CRUD Antigravity\", \"status_validasi\": \"valid\", \"program_bantuan_id\": 1, \"status_kemandirian\": \"Tahap Kemandirian\", \"penghasilan_perbulan\": \"1800000.00\"}','{\"id\": 6, \"nik\": \"5204221684162502\", \"user\": {\"id\": 11, \"name\": \"Bapak Test CRUD Antigravity (UPDATED)\", \"role\": \"penerima\", \"email\": \"5204221684162502@penerima.com\", \"kampus_id\": null, \"created_at\": \"2026-10-14T14:51:57.000000Z\", \"updated_at\": \"2026-10-14T14:51:57.000000Z\", \"email_verified_at\": null}, \"desil\": 6, \"no_kk\": \"5204205380275646\", \"alamat\": \"RT 05 RW 01 Dusun Baru\", \"user_id\": 11, \"kampus_id\": 1, \"created_at\": \"2026-10-14T14:51:57.000000Z\", \"deleted_at\": null, \"is_flagged\": 0, \"updated_at\": \"2026-10-14T14:51:57.000000Z\", \"wilayah_id\": 1, \"pendamping_id\": 3, \"kepala_keluarga\": \"Bapak Test CRUD Antigravity (UPDATED)\", \"status_validasi\": \"valid\", \"program_bantuan_id\": 1, \"status_kemandirian\": \"Mandiri\", \"penghasilan_perbulan\": 3800000}','127.0.0.1','2026-10-14 07:51:57','2026-10-14 07:51:57'),(19,3,'Hapus Data Keluarga Penerima Binaan','KeluargaPenerima',6,'{\"id\": 6, \"nik\": \"5204221684162502\", \"desil\": 6, \"no_kk\": \"5204205380275646\", \"alamat\": \"RT 05 RW 01 Dusun Baru\", \"user_id\": 11, \"kampus_id\": 1, \"created_at\": \"2026-10-14T14:51:57.000000Z\", \"deleted_at\": null, \"is_flagged\": 0, \"updated_at\": \"2026-10-14T14:51:57.000000Z\", \"wilayah_id\": 1, \"pendamping_id\": 3, \"kepala_keluarga\": \"Bapak Test CRUD Antigravity (UPDATED)\", \"status_validasi\": \"valid\", \"program_bantuan_id\": 1, \"status_kemandirian\": \"Mandiri\", \"penghasilan_perbulan\": \"3800000.00\"}',NULL,'127.0.0.1','2026-10-14 07:51:57','2026-10-14 07:51:57'),(20,3,'Tambah Data Keluarga Penerima Binaan','KeluargaPenerima',7,NULL,'{\"nik\": \"2010102010202010\", \"desil\": \"2\", \"no_kk\": \"2010102010202010\", \"alamat\": \"Kabuyit Barat/001/001\", \"user_id\": 12, \"kampus_id\": 1, \"wilayah_id\": \"84\", \"pendamping_id\": 3, \"kepala_keluarga\": \"Herman\", \"status_validasi\": \"valid\", \"program_bantuan_id\": \"2\", \"status_kemandirian\": \"Tahap Kemandirian\", \"penghasilan_perbulan\": \"2700000\"}','127.0.0.1','2026-10-14 08:12:57','2026-10-14 08:12:57'),(21,3,'create','LaporanTumbuhKembang',6,NULL,'{\"id\": 6, \"catatan\": \"100 bibit aman\", \"foto_url\": null, \"created_at\": \"2026-10-14T15:14:22.000000Z\", \"updated_at\": \"2026-10-14T15:14:22.000000Z\", \"pendamping_id\": 3, \"tanggal_lapor\": \"2026-10-14\", \"status_kondisi\": \"normal\", \"keluarga_penerima_id\": \"7\"}','127.0.0.1','2026-10-14 08:14:22','2026-10-14 08:14:22'),(22,2,'Kampus Membuat Program Bantuan Baru','ProgramBantuan',3,NULL,'{\"id\": 3, \"status\": \"aktif\", \"deskripsi\": \"yang gak ada alat masak\", \"kampus_id\": 1, \"target_kk\": \"100\", \"created_at\": \"2026-10-14T15:40:10.000000Z\", \"updated_at\": \"2026-10-14T15:40:10.000000Z\", \"nama_program\": \"Alat Masak\", \"jenis_subsidi\": \"barang\", \"pagu_anggaran\": \"150000000\", \"tahun_anggaran\": \"2026\"}','127.0.0.1','2026-10-14 08:40:10','2026-10-14 08:40:10'),(23,3,'Input Penilaian Desil Kemandirian','PenilaianKemandirian',17,'{\"desil\": 2, \"status_kemandirian\": \"Tahap Kemandirian\", \"penghasilan_perbulan\": \"2700000.00\"}','{\"desil\": 8, \"total_skor\": 88, \"status_kemandirian\": \"Mandiri\", \"status_perkembangan\": \"Maju\", \"penghasilan_perbulan\": 7000000}','127.0.0.1','2026-10-14 11:06:03','2026-10-14 11:06:03'),(25,1,'Bappeda Mengekspor Data Penerima Bantuan','KeluargaPenerima',NULL,NULL,'{\"tab\": \"aktif\", \"format\": \"xlsx\", \"filename\": \"Data_Penerima_Bantuan_Bappeda_Aktif_2026-10-14_18-57-43.xlsx\", \"total_baris\": 3}','127.0.0.1','2026-10-14 11:57:43','2026-10-14 11:57:43'),(26,1,'Bappeda Mengekspor Data Penerima Bantuan','KeluargaPenerima',NULL,NULL,'{\"tab\": \"aktif\", \"format\": \"csv\", \"filename\": \"Data_Penerima_Bantuan_Bappeda_Aktif_2026-10-14_18-57-44.csv\", \"total_baris\": 3}','127.0.0.1','2026-10-14 11:57:44','2026-10-14 11:57:44'),(27,1,'Bappeda Mengimpor Data Penerima Bantuan (Excel/CSV)','KeluargaPenerima',NULL,NULL,'{\"mode\": \"update\", \"dilewati\": 0, \"sukses_baru\": 2, \"jumlah_error\": 0, \"total_dibaca\": 2, \"sukses_diperbarui\": 0}','127.0.0.1','2026-10-14 11:57:45','2026-10-14 11:57:45'),(28,1,'Bappeda Mengekspor Data Penerima Bantuan','KeluargaPenerima',NULL,NULL,'{\"tab\": \"aktif\", \"format\": \"xlsx\", \"filename\": \"Data_Penerima_Bantuan_Bappeda_Aktif_2026-10-14_19-03-22.xlsx\", \"total_baris\": 3}','127.0.0.1','2026-10-14 12:03:22','2026-10-14 12:03:22'),(29,1,'User Logout dari Sistem','Auth',1,NULL,'{\"role\": \"pemda\", \"user\": \"Admin Pemda Sumbawa\", \"email\": \"pemda@sumbawakab.go.id\"}','127.0.0.1','2026-10-14 12:15:31','2026-10-14 12:15:31'),(30,1,'User Login ke Sistem','Auth',1,NULL,'{\"role\": \"pemda\", \"user\": \"Admin Pemda Sumbawa\", \"email\": \"pemda@sumbawakab.go.id\", \"login_via\": \"email\"}','127.0.0.1','2026-10-15 05:44:12','2026-10-15 05:44:12');
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_penilaian_kemandirians`
--

DROP TABLE IF EXISTS `detail_penilaian_kemandirians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_penilaian_kemandirians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penilaian_kemandirian_id` bigint unsigned NOT NULL,
  `indikator_kemandirian_id` bigint unsigned NOT NULL,
  `nilai` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_penilaian_kemandirians_penilaian_kemandirian_id_foreign` (`penilaian_kemandirian_id`),
  KEY `detail_penilaian_kemandirians_indikator_kemandirian_id_foreign` (`indikator_kemandirian_id`),
  CONSTRAINT `detail_penilaian_kemandirians_indikator_kemandirian_id_foreign` FOREIGN KEY (`indikator_kemandirian_id`) REFERENCES `indikator_kemandirians` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detail_penilaian_kemandirians_penilaian_kemandirian_id_foreign` FOREIGN KEY (`penilaian_kemandirian_id`) REFERENCES `penilaian_kemandirians` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_penilaian_kemandirians`
--

LOCK TABLES `detail_penilaian_kemandirians` WRITE;
/*!40000 ALTER TABLE `detail_penilaian_kemandirians` DISABLE KEYS */;
INSERT INTO `detail_penilaian_kemandirians` VALUES (1,1,1,88,'2026-10-10 08:49:52','2026-10-10 08:49:52'),(2,1,2,53,'2026-10-10 08:49:52','2026-10-10 08:49:52'),(3,1,3,81,'2026-10-10 08:49:52','2026-10-10 08:49:52'),(4,2,1,63,'2026-10-10 08:49:53','2026-10-10 08:49:53'),(5,2,2,91,'2026-10-10 08:49:53','2026-10-10 08:49:53'),(6,2,3,84,'2026-10-10 08:49:53','2026-10-10 08:49:53'),(7,3,1,82,'2026-10-10 08:49:53','2026-10-10 08:49:53'),(8,3,2,90,'2026-10-10 08:49:53','2026-10-10 08:49:53'),(9,3,3,90,'2026-10-10 08:49:53','2026-10-10 08:49:53');
/*!40000 ALTER TABLE `detail_penilaian_kemandirians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indikator_kemandirians`
--

DROP TABLE IF EXISTS `indikator_kemandirians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `indikator_kemandirians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_indikator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indikator_kemandirians`
--

LOCK TABLES `indikator_kemandirians` WRITE;
/*!40000 ALTER TABLE `indikator_kemandirians` DISABLE KEYS */;
INSERT INTO `indikator_kemandirians` VALUES (1,'Peningkatan Pendapatan (Rp/Bulan)',40,'2026-10-10 08:49:52','2026-10-10 08:49:52'),(2,'Pekerjaan / Usaha Sampingan',30,'2026-10-10 08:49:52','2026-10-10 08:49:52'),(3,'Partisipasi Sosial Ekonomi',30,'2026-10-10 08:49:52','2026-10-10 08:49:52');
/*!40000 ALTER TABLE `indikator_kemandirians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_bantuans`
--

DROP TABLE IF EXISTS `item_bantuans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item_bantuans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `program_bantuan_id` bigint unsigned NOT NULL,
  `jenis` enum('bibit','uang','barang') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bibit',
  `nama_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unit',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `nominal_satuan` decimal(15,2) DEFAULT '0.00',
  `total_stok` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_bantuans_program_bantuan_id_foreign` (`program_bantuan_id`),
  CONSTRAINT `item_bantuans_program_bantuan_id_foreign` FOREIGN KEY (`program_bantuan_id`) REFERENCES `program_bantuans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_bantuans`
--

LOCK TABLES `item_bantuans` WRITE;
/*!40000 ALTER TABLE `item_bantuans` DISABLE KEYS */;
INSERT INTO `item_bantuans` VALUES (1,1,'bibit','Bibit Jagung Hibrida Bisi-18','kg','Bibit jagung hibrida unggul tahan kering dan produktivitas tinggi.',75000.00,500.00,'2026-10-14 08:24:43','2026-10-14 08:24:43',NULL),(2,1,'bibit','Bibit Cabai Rawit Unggul','batang','Bibit cabai rawit siap tanam untuk pekarangan produktif.',5000.00,2000.00,'2026-10-14 08:24:43','2026-10-14 08:24:43',NULL),(3,1,'uang','Bantuan Tunai Modal Usaha Tani','rupiah','Subsidi dana tunai untuk pembelian pupuk, obat tanaman, atau sewa traktor olah lahan.',1500000.00,50.00,'2026-10-14 08:24:43','2026-10-14 08:24:43',NULL),(4,1,'barang','Kompor Gas Usaha Pengolahan Hasil Panen','unit','Kompor gas 2 tungku + selang regulator SNI untuk industri olahan pangan rumah tangga.',450000.00,30.00,'2026-10-14 08:24:43','2026-10-14 08:24:43',NULL),(5,1,'barang','Hand Sprayer Elektrik 16 Liter','unit','Alat semprot pupuk cair dan pestisida ramah lingkungan.',350000.00,40.00,'2026-10-14 08:24:43','2026-10-14 08:24:43',NULL),(6,1,'bibit','Bibit Cabai Rawit Hibrida','polybag','Bibit cabai rawit siap tanam varietas unggul.',5000.00,1000.00,'2026-10-14 08:36:04','2026-10-14 08:36:04',NULL),(7,1,'uang','Bantuan Modal Usaha Tani Tunai','rupiah','Subsidi tunai untuk modal pembelian pakan, bibit ikan, atau pupuk.',1500000.00,50.00,'2026-10-14 08:36:04','2026-10-14 08:36:04',NULL),(8,1,'barang','Kompor Gas 2 Tungku + Regulator SNI','unit','Peralatan kompor gas untuk industri olahan pangan rumah tangga.',450000.00,30.00,'2026-10-14 08:36:04','2026-10-14 08:36:04',NULL),(9,3,'barang','kompor gas 1 tungku + regulator','unit','bsp',250000.00,100.00,'2026-10-14 08:41:08','2026-10-14 08:41:08',NULL),(10,3,'barang','Minyak Goreng','LT','minyak',60000.00,100.00,'2026-10-14 08:42:56','2026-10-14 08:42:56',NULL);
/*!40000 ALTER TABLE `item_bantuans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenis_bibits`
--

DROP TABLE IF EXISTS `jenis_bibits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jenis_bibits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_bibit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_varian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jenis_bibits_kode_bibit_unique` (`kode_bibit`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_bibits`
--

LOCK TABLES `jenis_bibits` WRITE;
/*!40000 ALTER TABLE `jenis_bibits` DISABLE KEYS */;
INSERT INTO `jenis_bibits` VALUES (1,'BBT-MG-01','Buah-buahan','Mangga Arumanis','Pohon','2026-10-10 08:49:52','2026-10-10 08:49:52',NULL),(2,'BBT-DR-01','Buah-buahan','Durian Musang King','Pohon','2026-10-10 08:49:52','2026-10-10 08:49:52',NULL);
/*!40000 ALTER TABLE `jenis_bibits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kampus_mitras`
--

DROP TABLE IF EXISTS `kampus_mitras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kampus_mitras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nama_universitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wilayah_binaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mou_berlaku_sampai` date DEFAULT NULL,
  `status_mou` enum('aktif','tidak_aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `dana_bappeda` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kampus_mitras_user_id_foreign` (`user_id`),
  CONSTRAINT `kampus_mitras_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kampus_mitras`
--

LOCK TABLES `kampus_mitras` WRITE;
/*!40000 ALTER TABLE `kampus_mitras` DISABLE KEYS */;
INSERT INTO `kampus_mitras` VALUES (1,9,'Universitas Samawa','Bryan','082342359160','Kec.Lape,Lopok','2026-12-31','aktif',600600000.00,'2026-10-10 09:08:34','2026-10-14 11:44:51',NULL);
/*!40000 ALTER TABLE `kampus_mitras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keluarga_penerimas`
--

DROP TABLE IF EXISTS `keluarga_penerimas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keluarga_penerimas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_kk` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepala_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desil` int NOT NULL DEFAULT '1',
  `penghasilan_perbulan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `user_id` bigint unsigned DEFAULT NULL,
  `pendamping_id` bigint unsigned DEFAULT NULL,
  `kampus_id` bigint unsigned DEFAULT NULL,
  `wilayah_id` bigint unsigned NOT NULL,
  `program_bantuan_id` bigint unsigned NOT NULL,
  `status_validasi` enum('menunggu_validasi','proses_lapangan','valid','anomali') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_validasi',
  `status_kemandirian` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'Belum Dinilai',
  `is_flagged` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `keluarga_penerimas_no_kk_unique` (`no_kk`),
  UNIQUE KEY `keluarga_penerimas_nik_unique` (`nik`),
  KEY `keluarga_penerimas_user_id_foreign` (`user_id`),
  KEY `keluarga_penerimas_wilayah_id_foreign` (`wilayah_id`),
  KEY `keluarga_penerimas_program_bantuan_id_foreign` (`program_bantuan_id`),
  KEY `keluarga_penerimas_pendamping_id_foreign` (`pendamping_id`),
  KEY `keluarga_penerimas_kampus_id_foreign` (`kampus_id`),
  CONSTRAINT `keluarga_penerimas_kampus_id_foreign` FOREIGN KEY (`kampus_id`) REFERENCES `kampus_mitras` (`id`) ON DELETE SET NULL,
  CONSTRAINT `keluarga_penerimas_pendamping_id_foreign` FOREIGN KEY (`pendamping_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `keluarga_penerimas_program_bantuan_id_foreign` FOREIGN KEY (`program_bantuan_id`) REFERENCES `program_bantuans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `keluarga_penerimas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `keluarga_penerimas_wilayah_id_foreign` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keluarga_penerimas`
--

LOCK TABLES `keluarga_penerimas` WRITE;
/*!40000 ALTER TABLE `keluarga_penerimas` DISABLE KEYS */;
INSERT INTO `keluarga_penerimas` VALUES (1,'5204012001000001','Kepala Keluarga 1','5204010000000001','Jalan Desa Semamung RT 01',2,1500000.00,5,3,1,2,1,'valid','Tahap Kemandirian',0,'2026-10-10 08:49:52','2026-10-14 07:42:18',NULL),(2,'5204012001000002','Kepala Keluarga 2','5204010000000002','Jalan Desa Semamung RT 02',4,3200000.00,6,3,1,2,1,'valid','Tahap Kemandirian',0,'2026-10-10 08:49:53','2026-10-14 07:42:18',NULL),(3,'5204012001000003','Kepala Keluarga 3','5204010000000003','Jalan Desa Semamung RT 03',7,5500000.00,7,3,1,2,1,'valid','Mandiri',0,'2026-10-10 08:49:53','2026-10-14 07:28:50',NULL),(4,'1234567887654321','Bryan','1234567887654321',NULL,7,7500000.00,8,3,1,1,2,'valid','Mandiri',0,'2026-10-10 08:51:44','2026-10-14 07:41:43',NULL),(7,'2010102010202010','Herman','2010102010202010','Kabuyit Barat/001/001',2,2700000.00,12,3,1,84,2,'valid','Tahap Kemandirian',0,'2026-10-14 08:12:57','2026-10-14 11:06:03',NULL);
/*!40000 ALTER TABLE `keluarga_penerimas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laporan_penerimas`
--

DROP TABLE IF EXISTS `laporan_penerimas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laporan_penerimas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `keluarga_penerima_id` bigint unsigned NOT NULL,
  `laporan_teks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read_by_pemda` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporan_penerimas_keluarga_penerima_id_foreign` (`keluarga_penerima_id`),
  CONSTRAINT `laporan_penerimas_keluarga_penerima_id_foreign` FOREIGN KEY (`keluarga_penerima_id`) REFERENCES `keluarga_penerimas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporan_penerimas`
--

LOCK TABLES `laporan_penerimas` WRITE;
/*!40000 ALTER TABLE `laporan_penerimas` DISABLE KEYS */;
INSERT INTO `laporan_penerimas` VALUES (1,1,'Bibit sudah ditanam, namun butuh pupuk tambahan.',NULL,0,'2026-10-10 08:49:52','2026-10-10 08:49:52'),(2,2,'Bibit sudah ditanam, namun butuh pupuk tambahan.',NULL,1,'2026-10-10 08:49:53','2026-10-11 00:47:39'),(3,3,'Bibit sudah ditanam, namun butuh pupuk tambahan.',NULL,0,'2026-10-10 08:49:53','2026-10-10 08:49:53'),(4,1,'saya lapar mau makan',NULL,1,'2026-10-10 17:33:26','2026-10-10 17:42:03'),(5,1,'saya mau lapor pendampingnya nakal',NULL,1,'2026-10-12 22:01:10','2026-10-14 11:34:34');
/*!40000 ALTER TABLE `laporan_penerimas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laporan_tumbuh_kembangs`
--

DROP TABLE IF EXISTS `laporan_tumbuh_kembangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laporan_tumbuh_kembangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `keluarga_penerima_id` bigint unsigned NOT NULL,
  `pendamping_id` bigint unsigned NOT NULL,
  `tanggal_lapor` date NOT NULL,
  `status_kondisi` enum('normal','hama','gagal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `catatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporan_tumbuh_kembangs_keluarga_penerima_id_foreign` (`keluarga_penerima_id`),
  KEY `laporan_tumbuh_kembangs_pendamping_id_foreign` (`pendamping_id`),
  CONSTRAINT `laporan_tumbuh_kembangs_keluarga_penerima_id_foreign` FOREIGN KEY (`keluarga_penerima_id`) REFERENCES `keluarga_penerimas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `laporan_tumbuh_kembangs_pendamping_id_foreign` FOREIGN KEY (`pendamping_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporan_tumbuh_kembangs`
--

LOCK TABLES `laporan_tumbuh_kembangs` WRITE;
/*!40000 ALTER TABLE `laporan_tumbuh_kembangs` DISABLE KEYS */;
INSERT INTO `laporan_tumbuh_kembangs` VALUES (1,1,3,'2026-10-14','normal','Kunjungan rutin: bibit tumbuh sangat subur setinggi 65cm, daun hijau lebat tidak ada tanda hama.','https://images.unsplash.com/photo-1542601906990-b4d3fb778b09','2026-10-12 21:55:47','2026-10-14 06:46:24',NULL),(2,4,3,'2026-10-14','hama','asdasdasdadadsadas',NULL,'2026-10-14 06:36:33','2026-10-14 06:48:22',NULL),(3,4,3,'2026-10-14','normal','aahahahahahahahah',NULL,'2026-10-14 06:48:58','2026-10-14 06:48:58',NULL),(4,1,3,'2026-10-14','normal','Kunjungan ke-2: Tanaman semakin tinggi 80cm, daun subur.',NULL,'2026-10-14 06:53:04','2026-10-14 06:53:04',NULL),(5,4,3,'2026-10-14','gagal','tanaman di makan sapi',NULL,'2026-10-14 06:57:16','2026-10-14 06:57:16',NULL),(6,7,3,'2026-10-14','normal','100 bibit aman',NULL,'2026-10-14 08:14:22','2026-10-14 08:14:22',NULL);
/*!40000 ALTER TABLE `laporan_tumbuh_kembangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2026_10_07_032244_create_program_bantuans_table',1),(6,'2026_10_07_044449_create_wilayahs_table',1),(7,'2026_10_07_044450_create_jenis_bibits_table',1),(8,'2026_10_07_044451_create_kampus_mitras_table',1),(9,'2026_10_07_044451_create_keluarga_penerimas_table',1),(10,'2026_10_07_044452_create_penyalurans_table',1),(11,'2026_10_07_044452_create_validasi_cpcls_table',1),(12,'2026_10_07_044453_create_laporan_tumbuh_kembangs_table',1),(13,'2026_10_07_044454_create_spjs_table',1),(14,'2026_10_09_050000_create_audit_logs_table',1),(15,'2026_10_09_074411_add_soft_deletes_to_tables',1),(16,'2026_10_10_152835_create_indikator_kemandirians_table',1),(17,'2026_10_10_152835_create_laporan_penerimas_table',1),(18,'2026_10_10_152836_create_penilaian_kemandirians_table',1),(19,'2026_10_10_152837_create_detail_penilaian_kemandirians_table',1),(20,'2026_10_11_003801_add_pendamping_and_kampus_to_users_and_keluarga_penerimas',2),(21,'2026_10_14_212000_add_desil_assessment_fields',3),(22,'2026_10_14_212500_alter_status_kemandirian_in_keluarga_penerimas',4),(23,'2026_10_14_223000_create_bantuan_and_penyaluran_tables',5),(24,'2026_10_14_230000_add_dana_bappeda_to_kampus_mitras_table',6),(25,'2026_10_14_173940_add_profile_fields_to_users_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penilaian_kemandirians`
--

DROP TABLE IF EXISTS `penilaian_kemandirians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penilaian_kemandirians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `keluarga_penerima_id` bigint unsigned NOT NULL,
  `pendamping_id` bigint unsigned NOT NULL,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penghasilan_perbulan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `jumlah_anak` int NOT NULL DEFAULT '0',
  `aset_rumah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aset_tanah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aset_kendaraan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendapatan_per_kapita` decimal(15,2) NOT NULL DEFAULT '0.00',
  `desil_sebelumnya` int DEFAULT NULL,
  `desil_hasil` int NOT NULL DEFAULT '1',
  `total_skor` int NOT NULL DEFAULT '0',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `status_perkembangan` enum('Maju','Tetap','Mundur') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penilaian_kemandirians_keluarga_penerima_id_foreign` (`keluarga_penerima_id`),
  KEY `penilaian_kemandirians_pendamping_id_foreign` (`pendamping_id`),
  CONSTRAINT `penilaian_kemandirians_keluarga_penerima_id_foreign` FOREIGN KEY (`keluarga_penerima_id`) REFERENCES `keluarga_penerimas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penilaian_kemandirians_pendamping_id_foreign` FOREIGN KEY (`pendamping_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penilaian_kemandirians`
--

LOCK TABLES `penilaian_kemandirians` WRITE;
/*!40000 ALTER TABLE `penilaian_kemandirians` DISABLE KEYS */;
INSERT INTO `penilaian_kemandirians` VALUES (1,1,3,'Q1 2026',0.00,0,NULL,NULL,NULL,0.00,NULL,1,90,NULL,'Maju','2026-10-10 08:49:52','2026-10-10 08:49:52'),(2,2,3,'Q1 2026',0.00,0,NULL,NULL,NULL,0.00,NULL,1,59,NULL,'Maju','2026-10-10 08:49:53','2026-10-10 08:49:53'),(3,3,3,'Q1 2026',0.00,0,NULL,NULL,NULL,0.00,NULL,1,78,NULL,'Maju','2026-10-10 08:49:53','2026-10-10 08:49:53'),(4,1,3,'Oktober 2026 (Monitoring Pasca Panen 1)',1800000.00,2,'semi_permanen','sedang','motor_layak',0.00,5,3,39,'Bibit tanaman berbuah baik, penghasilan meningkat dari hasil panen awal.','Mundur','2026-10-14 07:15:49','2026-10-14 07:15:49'),(5,1,3,'Oktober 2026 (Monitoring Pasca Panen 1)',1800000.00,2,'semi_permanen','sedang','motor_layak',0.00,5,3,39,'Bibit tanaman berbuah baik, penghasilan meningkat dari hasil panen awal.','Mundur','2026-10-14 07:16:24','2026-10-14 07:16:24'),(6,1,3,'Oktober 2026 (Monitoring Pasca Panen 1)',1800000.00,2,'semi_permanen','sedang','motor_layak',0.00,3,3,39,'Bibit tanaman berbuah baik, penghasilan meningkat dari hasil panen awal.','Tetap','2026-10-14 07:16:42','2026-10-14 07:16:42'),(7,2,3,'November 2026 (Evaluasi Panen Raya Bibit)',3800000.00,2,'permanen','sedang','motor_layak',0.00,2,6,63,'Hasil panen bibit melonjak, keluarga telah mandiri dan memiliki tabungan usaha.','Maju','2026-10-14 07:16:57','2026-10-14 07:41:42'),(8,4,3,'Bulan October 2026',3000000.00,2,'permanen','sedang','motor_tua',0.00,3,4,42,NULL,'Maju','2026-10-14 07:24:49','2026-10-14 07:41:42'),(9,4,3,'Bulan October 2026',9000000.00,2,'permanen','sedang','motor_tua',0.00,3,8,82,NULL,'Maju','2026-10-14 07:25:49','2026-10-14 07:41:42'),(10,3,3,'September 2026 (Monitoring Pasca Panen 2)',5500000.00,1,'permanen','sedang','motor_layak',1833333.00,4,7,78,'Keluarga binaan telah sukses mengelola bibit buah produktif, omzet meningkat signifikan dan telah mencapai graduasi mandiri.','Maju','2026-10-14 07:28:50','2026-10-14 07:28:50'),(11,4,3,'Oktober 2026 (Evaluasi Triwulan IV)',750000.00,3,'tidak_layak','tidak_ada','tidak_ada',150000.00,3,1,10,'Tanaman bibit mengalami serangan hama kemarau, pendapatan menurun sementara. Perlu pendampingan intensif & bantuan pupuk tambahan.','Mundur','2026-10-14 07:28:50','2026-10-14 07:41:42'),(12,1,3,'Oktober 2026 (Monitoring Pasca Panen 1)',1800000.00,2,'semi_permanen','sedang','motor_layak',0.00,3,3,39,'Bibit tanaman berbuah baik, penghasilan meningkat dari hasil panen awal.','Tetap','2026-10-14 07:33:01','2026-10-14 07:33:01'),(13,4,3,'Bulan October 2026',7500000.00,2,'semi_permanen','sedang','motor_tua',0.00,2,7,70,NULL,'Maju','2026-10-14 07:34:35','2026-10-14 07:41:43'),(14,1,3,'Oktober 2026 (Uji Coba Gaji 7 Juta)',7000000.00,2,'semi_permanen','sedang','motor_layak',1750000.00,3,7,72,'Uji coba input pendapatan keluarga 7 juta rupiah.','Maju','2026-10-14 07:41:18','2026-10-14 07:41:18'),(15,1,3,'Oktober 2026 (Tahap Pembinaan Awal)',1500000.00,2,'tidak_layak','tidak_ada','tidak_ada',375000.00,1,2,17,'Mulai menanam bibit produktif, pendapatan meningkat dari buruh tani.','Maju','2026-10-14 07:42:18','2026-10-14 07:42:18'),(16,2,3,'Oktober 2026 (Monitoring Pasca Panen)',3200000.00,2,'semi_permanen','sedang','motor_tua',800000.00,3,4,37,'Bibit berkembang sangat baik, hasil panen perdana mendongkrak pendapatan.','Maju','2026-10-14 07:42:18','2026-10-14 07:42:18'),(17,7,3,'Bulan Oktober 2026 Uji Kelulusan',7000000.00,1,'permanen','luas','mobil',2333333.33,2,8,88,'Sudah mandiri dan sukses panen bibit','Maju','2026-10-14 11:06:03','2026-10-14 11:06:03');
/*!40000 ALTER TABLE `penilaian_kemandirians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penyaluran_bantuans`
--

DROP TABLE IF EXISTS `penyaluran_bantuans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penyaluran_bantuans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `keluarga_penerima_id` bigint unsigned NOT NULL,
  `program_bantuan_id` bigint unsigned NOT NULL,
  `item_bantuan_id` bigint unsigned NOT NULL,
  `pendamping_id` bigint unsigned DEFAULT NULL,
  `jenis` enum('bibit','uang','barang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` decimal(12,2) NOT NULL DEFAULT '1.00',
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unit',
  `nominal_uang` decimal(15,2) DEFAULT '0.00',
  `peruntukan` text COLLATE utf8mb4_unicode_ci,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `foto_penyerahan_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_penyaluran` date NOT NULL,
  `status` enum('disalurkan','diterima','batal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diterima',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penyaluran_bantuans_keluarga_penerima_id_foreign` (`keluarga_penerima_id`),
  KEY `penyaluran_bantuans_program_bantuan_id_foreign` (`program_bantuan_id`),
  KEY `penyaluran_bantuans_item_bantuan_id_foreign` (`item_bantuan_id`),
  KEY `penyaluran_bantuans_pendamping_id_foreign` (`pendamping_id`),
  CONSTRAINT `penyaluran_bantuans_item_bantuan_id_foreign` FOREIGN KEY (`item_bantuan_id`) REFERENCES `item_bantuans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penyaluran_bantuans_keluarga_penerima_id_foreign` FOREIGN KEY (`keluarga_penerima_id`) REFERENCES `keluarga_penerimas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penyaluran_bantuans_pendamping_id_foreign` FOREIGN KEY (`pendamping_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `penyaluran_bantuans_program_bantuan_id_foreign` FOREIGN KEY (`program_bantuan_id`) REFERENCES `program_bantuans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penyaluran_bantuans`
--

LOCK TABLES `penyaluran_bantuans` WRITE;
/*!40000 ALTER TABLE `penyaluran_bantuans` DISABLE KEYS */;
INSERT INTO `penyaluran_bantuans` VALUES (1,1,1,7,3,'uang',1.00,'rupiah',1500000.00,'Pembelian pakan ikan lele dan sewa pembuatan kolam terpal','Diserahkan langsung tunai kepada kepala keluarga dengan bukti kuitansi',NULL,'2026-10-14','diterima','2026-10-14 08:36:04','2026-10-14 08:36:04',NULL),(2,1,1,8,3,'barang',1.00,'unit',NULL,NULL,'Kompor gas diterima dalam kondisi baru tersegel lengkap selang regulator',NULL,'2026-10-14','diterima','2026-10-14 08:36:04','2026-10-14 08:36:04',NULL),(3,1,1,6,3,'bibit',25.00,'polybag',NULL,NULL,'Bibit cabai rawit siap tanam kondisi segar',NULL,'2026-10-14','diterima','2026-10-14 08:36:04','2026-10-14 08:36:04',NULL),(4,1,1,7,3,'uang',1.00,'rupiah',1500000.00,'Pembelian pakan ikan lele dan sewa pembuatan kolam terpal','Diserahkan langsung tunai kepada kepala keluarga dengan bukti kuitansi',NULL,'2026-10-14','diterima','2026-10-14 08:36:27','2026-10-14 08:36:27',NULL),(5,1,1,8,3,'barang',1.00,'unit',NULL,NULL,'Kompor gas diterima dalam kondisi baru tersegel lengkap selang regulator',NULL,'2026-10-14','diterima','2026-10-14 08:36:27','2026-10-14 08:36:27',NULL),(6,1,1,6,3,'bibit',25.00,'polybag',NULL,NULL,'Bibit cabai rawit siap tanam kondisi segar',NULL,'2026-10-14','diterima','2026-10-14 08:36:27','2026-10-14 08:36:27',NULL),(7,1,1,7,3,'uang',1.00,'rupiah',1500000.00,'Pembelian pakan ikan lele dan sewa pembuatan kolam terpal','Diserahkan langsung tunai kepada kepala keluarga dengan bukti kuitansi',NULL,'2026-10-14','diterima','2026-10-14 08:48:27','2026-10-14 08:48:27',NULL),(8,1,1,8,3,'barang',1.00,'unit',NULL,NULL,'Kompor gas diterima dalam kondisi baru tersegel lengkap selang regulator',NULL,'2026-10-14','diterima','2026-10-14 08:48:27','2026-10-14 08:48:27',NULL),(9,1,1,6,3,'bibit',25.00,'polybag',NULL,NULL,'Bibit cabai rawit siap tanam kondisi segar',NULL,'2026-10-14','diterima','2026-10-14 08:48:27','2026-10-14 08:48:27',NULL),(10,1,1,7,3,'uang',1.00,'rupiah',1500000.00,'Pembelian pakan ikan lele dan sewa pembuatan kolam terpal','Diserahkan langsung tunai kepada kepala keluarga dengan bukti kuitansi',NULL,'2026-10-14','diterima','2026-10-14 08:57:02','2026-10-14 08:57:02',NULL),(11,1,1,8,3,'barang',1.00,'unit',NULL,NULL,'Kompor gas diterima dalam kondisi baru tersegel lengkap selang regulator',NULL,'2026-10-14','diterima','2026-10-14 08:57:02','2026-10-14 08:57:02',NULL),(12,1,1,6,3,'bibit',25.00,'polybag',NULL,NULL,'Bibit cabai rawit siap tanam kondisi segar',NULL,'2026-10-14','diterima','2026-10-14 08:57:02','2026-10-14 08:57:02',NULL),(13,1,1,7,3,'uang',1.00,'rupiah',1500000.00,'Pembelian pakan ikan lele dan sewa pembuatan kolam terpal','Diserahkan langsung tunai kepada kepala keluarga dengan bukti kuitansi',NULL,'2026-10-14','diterima','2026-10-14 09:00:18','2026-10-14 09:00:18',NULL),(14,1,1,8,3,'barang',1.00,'unit',NULL,NULL,'Kompor gas diterima dalam kondisi baru tersegel lengkap selang regulator',NULL,'2026-10-14','diterima','2026-10-14 09:00:18','2026-10-14 09:00:18',NULL),(15,1,1,6,3,'bibit',25.00,'polybag',NULL,NULL,'Bibit cabai rawit siap tanam kondisi segar',NULL,'2026-10-14','diterima','2026-10-14 09:00:18','2026-10-14 09:00:18',NULL),(16,1,1,7,3,'uang',1.00,'rupiah',1500000.00,'Pembelian pakan ikan lele dan sewa pembuatan kolam terpal','Diserahkan langsung tunai kepada kepala keluarga dengan bukti kuitansi',NULL,'2026-10-14','diterima','2026-10-14 09:05:04','2026-10-14 09:05:04',NULL),(17,1,1,8,3,'barang',1.00,'unit',NULL,NULL,'Kompor gas diterima dalam kondisi baru tersegel lengkap selang regulator',NULL,'2026-10-14','diterima','2026-10-14 09:05:04','2026-10-14 09:05:04',NULL),(18,1,1,6,3,'bibit',25.00,'polybag',NULL,NULL,'Bibit cabai rawit siap tanam kondisi segar',NULL,'2026-10-14','diterima','2026-10-14 09:05:04','2026-10-14 09:05:04',NULL),(19,1,1,7,3,'uang',1.00,'rupiah',1500000.00,'Pembelian pakan ikan lele dan sewa pembuatan kolam terpal','Diserahkan langsung tunai kepada kepala keluarga dengan bukti kuitansi',NULL,'2026-10-14','diterima','2026-10-14 09:08:55','2026-10-14 09:08:55',NULL),(20,1,1,8,3,'barang',1.00,'unit',NULL,NULL,'Kompor gas diterima dalam kondisi baru tersegel lengkap selang regulator',NULL,'2026-10-14','diterima','2026-10-14 09:08:55','2026-10-14 09:08:55',NULL),(21,1,1,6,3,'bibit',25.00,'polybag',NULL,NULL,'Bibit cabai rawit siap tanam kondisi segar',NULL,'2026-10-14','diterima','2026-10-14 09:08:55','2026-10-14 09:08:55',NULL),(22,1,1,7,3,'uang',1.00,'rupiah',1500000.00,'Pembelian pakan ikan lele dan sewa pembuatan kolam terpal','Diserahkan langsung tunai kepada kepala keluarga dengan bukti kuitansi',NULL,'2026-10-14','diterima','2026-10-14 09:23:03','2026-10-14 09:23:03',NULL),(23,1,1,8,3,'barang',1.00,'unit',NULL,NULL,'Kompor gas diterima dalam kondisi baru tersegel lengkap selang regulator',NULL,'2026-10-14','diterima','2026-10-14 09:23:03','2026-10-14 09:23:03',NULL),(24,1,1,6,3,'bibit',25.00,'polybag',NULL,NULL,'Bibit cabai rawit siap tanam kondisi segar',NULL,'2026-10-14','diterima','2026-10-14 09:23:03','2026-10-14 09:23:03',NULL);
/*!40000 ALTER TABLE `penyaluran_bantuans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penyalurans`
--

DROP TABLE IF EXISTS `penyalurans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penyalurans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_bast` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_kirim` date NOT NULL,
  `wilayah_id` bigint unsigned NOT NULL,
  `jenis_bibit_id` bigint unsigned NOT NULL,
  `kuantitas` int NOT NULL,
  `status` enum('disiapkan','dikirim','diterima') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disiapkan',
  `dokumen_bast_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `penyalurans_nomor_bast_unique` (`nomor_bast`),
  KEY `penyalurans_wilayah_id_foreign` (`wilayah_id`),
  KEY `penyalurans_jenis_bibit_id_foreign` (`jenis_bibit_id`),
  CONSTRAINT `penyalurans_jenis_bibit_id_foreign` FOREIGN KEY (`jenis_bibit_id`) REFERENCES `jenis_bibits` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penyalurans_wilayah_id_foreign` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penyalurans`
--

LOCK TABLES `penyalurans` WRITE;
/*!40000 ALTER TABLE `penyalurans` DISABLE KEYS */;
INSERT INTO `penyalurans` VALUES (1,'001','2026-10-11',65,2,1000,'dikirim',NULL,'2026-10-10 09:10:00','2026-10-10 09:10:00',NULL);
/*!40000 ALTER TABLE `penyalurans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_bantuans`
--

DROP TABLE IF EXISTS `program_bantuans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program_bantuans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kampus_id` bigint unsigned DEFAULT NULL,
  `nama_program` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `pagu_anggaran` bigint NOT NULL,
  `target_kk` int NOT NULL,
  `tahun_anggaran` int NOT NULL,
  `jenis_subsidi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'bibit, uang, barang',
  `status` enum('aktif','draf','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draf',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `program_bantuans_kampus_id_foreign` (`kampus_id`),
  CONSTRAINT `program_bantuans_kampus_id_foreign` FOREIGN KEY (`kampus_id`) REFERENCES `kampus_mitras` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_bantuans`
--

LOCK TABLES `program_bantuans` WRITE;
/*!40000 ALTER TABLE `program_bantuans` DISABLE KEYS */;
INSERT INTO `program_bantuans` VALUES (1,1,'Pemberdayaan Lahan Kritis 2026','Program bantuan bibit pohon produktif untuk lahan kritis.',150000000,500,2026,'bibit,uang,barang','aktif','2026-10-10 08:49:52','2026-10-14 08:24:43',NULL),(2,1,'Bansos',NULL,150000000,500,2026,'bibit,uang,barang','aktif','2026-10-10 08:52:08','2026-10-14 08:24:43',NULL),(3,1,'Alat Masak','yang gak ada alat masak',150000000,100,2026,'barang','aktif','2026-10-14 08:40:10','2026-10-14 08:40:10',NULL);
/*!40000 ALTER TABLE `program_bantuans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spjs`
--

DROP TABLE IF EXISTS `spjs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `spjs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kampus_id` bigint unsigned NOT NULL,
  `nomor_spj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `uraian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` bigint NOT NULL,
  `status` enum('diajukan','review','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `dokumen_spj_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `spjs_nomor_spj_unique` (`nomor_spj`),
  KEY `spjs_kampus_id_foreign` (`kampus_id`),
  CONSTRAINT `spjs_kampus_id_foreign` FOREIGN KEY (`kampus_id`) REFERENCES `kampus_mitras` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spjs`
--

LOCK TABLES `spjs` WRITE;
/*!40000 ALTER TABLE `spjs` DISABLE KEYS */;
/*!40000 ALTER TABLE `spjs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim_nip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakultas_prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pemda',
  `kampus_id` bigint unsigned DEFAULT NULL,
  `status_keaktifan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `desa_penugasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_kampus_id_foreign` (`kampus_id`),
  CONSTRAINT `users_kampus_id_foreign` FOREIGN KEY (`kampus_id`) REFERENCES `kampus_mitras` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Pemda Sumbawa',NULL,NULL,'pemda@sumbawakab.go.id',NULL,'pemda',NULL,'aktif',NULL,NULL,'$2y$12$AO5cexCoy4HxH/VQG/Hd9er.sP.WudGgZyafTa8GGeie7s.hr3nN2',NULL,'2026-10-10 08:49:51','2026-10-10 08:49:51'),(2,'Admin Kampus Mitra UTS',NULL,NULL,'kampus@sumbawakab.go.id',NULL,'kampus',1,'aktif',NULL,NULL,'$2y$12$7b18RVdF5bNEj4uBY9sN5uoZ2AW.ycJyui5lPnXNPgf774AR9QlvG',NULL,'2026-10-10 08:49:51','2026-10-14 08:24:43'),(3,'Bryan Oktoviano S.Kom.','221001072','Pertanian','pendamping@sumbawakab.go.id','082342359160','pendamping',1,'aktif','Desa Langam (Kec. Lopok)',NULL,'$2y$12$Dw9Yz3ZmUjMTNrhcGH14Benm8BQShy7Yt.FzJkO1UyrMBuH0MOtCy',NULL,'2026-10-10 08:49:51','2026-10-14 10:48:17'),(4,'Siti Validator (DPL)',NULL,NULL,'validator@sumbawakab.go.id',NULL,'validator',NULL,'aktif',NULL,NULL,'$2y$12$QKn4ZfthELmkFdDh2QuGR.2280.rhOWVrcNwuxb7PijHfpERDhS4.',NULL,'2026-10-10 08:49:52','2026-10-10 08:49:52'),(5,'Kepala Keluarga 1',NULL,NULL,'kk1@example.com',NULL,'penerima',NULL,'aktif',NULL,NULL,'$2y$12$kGapEDXGEM6MlTtCxE0vvOYLz4bN7JjYqUYQP6vlfsoPMBaLi74fu',NULL,'2026-10-10 08:49:52','2026-10-10 08:49:52'),(6,'Kepala Keluarga 2',NULL,NULL,'kk2@example.com',NULL,'penerima',NULL,'aktif',NULL,NULL,'$2y$12$J2IU1o1kkuh8jAkxVYiTguIZFVmDEHAgGhMoFoZTNUIavm.o9UWBe',NULL,'2026-10-10 08:49:53','2026-10-10 08:49:53'),(7,'Kepala Keluarga 3',NULL,NULL,'kk3@example.com',NULL,'penerima',NULL,'aktif',NULL,NULL,'$2y$12$4OZgVZpW4QfvvyfwHdRnCukdeRarCkABNSJY3V04FCy324pZsLLEm',NULL,'2026-10-10 08:49:53','2026-10-10 08:49:53'),(8,'Bryan',NULL,NULL,'1234567887654321@penerima.com',NULL,'penerima',NULL,'aktif',NULL,NULL,'$2y$12$ywTvvt.BpCJIBd75fY9dyuoa7xfEuqrxX8IenIDxh30diyJ6CUG0q',NULL,'2026-10-10 08:51:44','2026-10-10 08:51:44'),(9,'Universitas Samawa',NULL,NULL,'admin@unsa.ac.id',NULL,'kampus',1,'aktif',NULL,NULL,'$2y$12$IGAjTe.I3AewZSRAy3AAN./bwUh3a1pL0m5wfkYCMnJjThjDpOUMu',NULL,'2026-10-10 09:08:34','2026-10-14 08:24:43'),(12,'Herman',NULL,NULL,'2010102010202010@penerima.com',NULL,'penerima',NULL,'aktif',NULL,NULL,'$2y$12$DbBDN4aXlXCJs1A.5RcbVuvnzB4OrTJUeIFMT8AzSDVubaKcRmzp2',NULL,'2026-10-14 08:12:57','2026-10-14 08:12:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `validasi_cpcls`
--

DROP TABLE IF EXISTS `validasi_cpcls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `validasi_cpcls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `keluarga_penerima_id` bigint unsigned NOT NULL,
  `pendamping_id` bigint unsigned NOT NULL,
  `validator_id` bigint unsigned DEFAULT NULL,
  `tgl_survei` date NOT NULL,
  `status_kelayakan` enum('layak','tidak_layak','review') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'review',
  `status_approval_pemda` enum('menunggu','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `foto_lahan_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `validasi_cpcls_keluarga_penerima_id_foreign` (`keluarga_penerima_id`),
  KEY `validasi_cpcls_pendamping_id_foreign` (`pendamping_id`),
  KEY `validasi_cpcls_validator_id_foreign` (`validator_id`),
  CONSTRAINT `validasi_cpcls_keluarga_penerima_id_foreign` FOREIGN KEY (`keluarga_penerima_id`) REFERENCES `keluarga_penerimas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `validasi_cpcls_pendamping_id_foreign` FOREIGN KEY (`pendamping_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `validasi_cpcls_validator_id_foreign` FOREIGN KEY (`validator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `validasi_cpcls`
--

LOCK TABLES `validasi_cpcls` WRITE;
/*!40000 ALTER TABLE `validasi_cpcls` DISABLE KEYS */;
INSERT INTO `validasi_cpcls` VALUES (1,1,3,4,'2026-10-10','review','menunggu','Survei lahan dan berkas CPCL untuk Kepala Keluarga 1 telah selesai di lapangan. Menunggu verifikasi.',NULL,'2026-10-10 23:01:29','2026-10-10 23:02:57',NULL),(2,2,3,4,'2026-10-09','layak','menunggu','Survei lahan dan berkas CPCL untuk Kepala Keluarga 2 telah selesai di lapangan. Menunggu verifikasi.',NULL,'2026-10-10 23:01:29','2026-10-10 23:03:12',NULL),(3,3,3,NULL,'2026-10-08','review','menunggu','Survei lahan dan berkas CPCL untuk Kepala Keluarga 3 telah selesai di lapangan. Menunggu verifikasi.',NULL,'2026-10-10 23:01:29','2026-10-10 23:01:29',NULL),(4,4,3,NULL,'2026-10-07','review','menunggu','Survei lahan dan berkas CPCL untuk Bryan telah selesai di lapangan. Menunggu verifikasi.',NULL,'2026-10-10 23:01:29','2026-10-10 23:01:29',NULL);
/*!40000 ALTER TABLE `validasi_cpcls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wilayahs`
--

DROP TABLE IF EXISTS `wilayahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wilayahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_wilayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('kecamatan','desa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wilayahs_kode_wilayah_unique` (`kode_wilayah`),
  KEY `wilayahs_parent_id_foreign` (`parent_id`),
  CONSTRAINT `wilayahs_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `wilayahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wilayahs`
--

LOCK TABLES `wilayahs` WRITE;
/*!40000 ALTER TABLE `wilayahs` DISABLE KEYS */;
INSERT INTO `wilayahs` VALUES (1,'52.04.01','Moyo Hulu','kecamatan',NULL,1,'2026-10-10 08:49:52','2026-10-10 08:49:52',NULL),(2,'52.04.01.2001','Desa Semamung','desa',1,1,'2026-10-10 08:49:52','2026-10-10 08:49:52',NULL),(3,'52.04.05','Alas','kecamatan',NULL,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(4,'52.04.05.0001','Baru','desa',3,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(5,'52.04.05.0002','Dalam','desa',3,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(6,'52.04.05.0003','Juranalas','desa',3,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(7,'52.04.05.0004','Kalimango','desa',3,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(8,'52.04.05.0005','Labuhan Alas','desa',3,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(9,'52.04.05.0006','Luar','desa',3,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(10,'52.04.05.0007','Marenteh','desa',3,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(11,'52.04.05.0008','Pulau Bungin','desa',3,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(12,'52.04.17','Alas Barat','kecamatan',NULL,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(13,'52.04.17.0001','Gontar','desa',12,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(14,'52.04.17.0002','Gontar Baru','desa',12,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(15,'52.04.17.0003','Labuhan Mapin','desa',12,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(16,'52.04.17.0004','Lekong','desa',12,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(17,'52.04.17.0005','Mapin Baru','desa',12,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(18,'52.04.17.0006','Mapin Kebak','desa',12,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(19,'52.04.17.0007','Mapin Rea','desa',12,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(20,'52.04.17.0008','Usar Mapin','desa',12,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(21,'52.04.07','Batu Lanteh','kecamatan',NULL,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(22,'52.04.07.0001','Bao Desa','desa',21,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(23,'52.04.07.0002','Batudulang','desa',21,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(24,'52.04.07.0003','Baturotok','desa',21,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(25,'52.04.07.0004','Kelungkung','desa',21,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(26,'52.04.07.0005','Tangkan Pulit','desa',21,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(27,'52.04.07.0006','Tepal','desa',21,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(28,'52.04.20','Buer','kecamatan',NULL,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(29,'52.04.20.0001','Buin Baru','desa',28,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(30,'52.04.20.0002','Juru Mapin','desa',28,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(31,'52.04.20.0003','Kalabeso','desa',28,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(32,'52.04.20.0004','Labuhan Burung','desa',28,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(33,'52.04.20.0005','Pulau Kaung','desa',28,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(34,'52.04.20.0006','Tarusa','desa',28,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(35,'52.04.14','Empang','kecamatan',NULL,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(36,'52.04.14.0001','Boal','desa',35,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(37,'52.04.14.0002','Bunga Eja','desa',35,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(38,'52.04.14.0003','Empang Atas','desa',35,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(39,'52.04.14.0004','Empang Bawah','desa',35,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(40,'52.04.14.0005','Gapit','desa',35,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(41,'52.04.14.0006','Jotang','desa',35,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(42,'52.04.14.0007','Jotang Beru','desa',35,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(43,'52.04.14.0008','Lamenta','desa',35,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(44,'52.04.14.0009','Ongko','desa',35,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(45,'52.04.14.0010','Pamanto','desa',35,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(46,'52.04.19','Labangka','kecamatan',NULL,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(47,'52.04.19.0001','Jaya Makmur','desa',46,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(48,'52.04.19.0002','Labangka','desa',46,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(49,'52.04.19.0003','Sekokat','desa',46,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(50,'52.04.19.0004','Suka Damai','desa',46,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(51,'52.04.19.0005','Suka Mulya','desa',46,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(52,'52.04.18','Labuhan Badas','kecamatan',NULL,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(53,'52.04.18.0001','Bajo Medang','desa',52,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(54,'52.04.18.0002','Bugis Medang','desa',52,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(55,'52.04.18.0003','Karang Dima','desa',52,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(56,'52.04.18.0004','Labuan Aji','desa',52,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(57,'52.04.18.0005','Labuan Sumbawa','desa',52,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(58,'52.04.18.0006','Labuhan Badas','desa',52,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(59,'52.04.18.0007','Sebotok','desa',52,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(60,'52.04.29','Lantung','kecamatan',NULL,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(61,'52.04.29.0001','Ai Mual','desa',60,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(62,'52.04.29.0002','Lantung','desa',60,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(63,'52.04.29.0003','Padesa','desa',60,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(64,'52.04.29.0004','Sepukur','desa',60,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(65,'52.04.12','Lape','kecamatan',NULL,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(66,'52.04.12.0001','Dete','desa',65,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(67,'52.04.12.0002','Hijrah','desa',65,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(68,'52.04.12.0003','Labuhan Kuris','desa',65,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(69,'52.04.12.0004','Lape','desa',65,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(70,'52.04.27','Lenangguar','kecamatan',NULL,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(71,'52.04.27.0001','Ledang','desa',70,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(72,'52.04.27.0002','Lenangguar','desa',70,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(73,'52.04.27.0003','Tatebal','desa',70,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(74,'52.04.02','Lunyuk','kecamatan',NULL,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(75,'52.04.02.0001','Emang Lestari','desa',74,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(76,'52.04.02.0002','Jamu','desa',74,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(77,'52.04.02.0003','Lunyuk Ode','desa',74,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(78,'52.04.02.0004','Lunyuk Rea','desa',74,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(79,'52.04.02.0005','Pada Suka','desa',74,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(80,'52.04.02.0006','Perung','desa',74,1,'2026-10-10 08:58:23','2026-10-10 08:58:23',NULL),(81,'52.04.02.0007','Suka Maju','desa',74,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(82,'52.04.26','Lopok','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(83,'52.04.26.0001','Berora','desa',82,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(84,'52.04.26.0002','Langam','desa',82,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(85,'52.04.26.0003','Lopok','desa',82,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(86,'52.04.26.0004','Lopok Baru','desa',82,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(87,'52.04.26.0005','Mama','desa',82,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(88,'52.04.26.0006','Pungkit','desa',82,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(89,'52.04.26.0007','Tatede','desa',82,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(90,'52.04.24','Maronge','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(91,'52.04.24.0001','Labuhan Sangoro','desa',90,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(92,'52.04.24.0002','Maronge','desa',90,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(93,'52.04.24.0003','Pemasar','desa',90,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(94,'52.04.24.0004','Simu','desa',90,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(95,'52.04.09','Moyo Hilir','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(96,'52.04.09.0001','Batu Bangka','desa',95,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(97,'52.04.09.0002','Berare','desa',95,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(98,'52.04.09.0003','Kakiang','desa',95,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(99,'52.04.09.0004','Labuhan Ijuk','desa',95,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(100,'52.04.09.0005','Moyo','desa',95,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(101,'52.04.09.0006','Moyo Mekar','desa',95,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(102,'52.04.09.0007','Ngeru','desa',95,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(103,'52.04.09.0008','Olat Rawa','desa',95,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(104,'52.04.09.0009','Poto','desa',95,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(105,'52.04.09.0010','Serading','desa',95,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(106,'52.04.10.0001','Brang Rea','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(107,'52.04.10.0002','Batu Bulan','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(108,'52.04.10.0003','Batu Tering','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(109,'52.04.10.0004','Leseng','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(110,'52.04.10.0005','Lito','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(111,'52.04.10.0006','Maman','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(112,'52.04.10.0007','Marga Karya','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(113,'52.04.10.0008','Mokong','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(114,'52.04.10.0009','Pernek','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(115,'52.04.10.0010','Sebasang','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(116,'52.04.10.0011','Semamung','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(117,'52.04.10.0012','Sempe','desa',1,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(118,'52.04.23','Moyo Utara','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(119,'52.04.23.0001','Baru Tahan','desa',118,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(120,'52.04.23.0002','Kukin','desa',118,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(121,'52.04.23.0003','Penyaring','desa',118,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(122,'52.04.23.0004','Pungkit','desa',118,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(123,'52.04.23.0005','Sebewe','desa',118,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(124,'52.04.23.0006','Songkar','desa',118,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(125,'52.04.28','Orong Telu','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(126,'52.04.28.0001','Kelawis','desa',125,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(127,'52.04.28.0002','Mungkin','desa',125,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(128,'52.04.28.0003','Sebeok','desa',125,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(129,'52.04.28.0004','Senawang','desa',125,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(130,'52.04.13','Plampang','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(131,'52.04.13.0001','Brang Kolong','desa',130,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(132,'52.04.13.0002','Muer','desa',130,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(133,'52.04.13.0003','Plampang','desa',130,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(134,'52.04.13.0004','Selante','desa',130,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(135,'52.04.13.0005','Sepakat','desa',130,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(136,'52.04.13.0006','Sepayung','desa',130,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(137,'52.04.13.0007','Sp I Perode','desa',130,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(138,'52.04.13.0008','Sp II Perode','desa',130,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(139,'52.04.13.0009','Sp III Perode','desa',130,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(140,'52.04.13.0010','Teluk Santong','desa',130,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(141,'52.04.13.0011','Usar','desa',130,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(142,'52.04.21','Rhee','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(143,'52.04.21.0001','Luk','desa',142,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(144,'52.04.21.0002','Rhee','desa',142,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(145,'52.04.21.0003','Rhee Loka','desa',142,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(146,'52.04.21.0004','Sampe','desa',142,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(147,'52.04.11','Ropang','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(148,'52.04.11.0001','Lawin','desa',147,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(149,'52.04.11.0002','Lebangkar','desa',147,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(150,'52.04.11.0003','Lebin','desa',147,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(151,'52.04.11.0004','Lebin Mekar','desa',147,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(152,'52.04.11.0005','Ranan','desa',147,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(153,'52.04.11.0006','Ropang','desa',147,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(154,'52.04.08','Sumbawa','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(155,'52.04.08.0001','Brang Bara','desa',154,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(156,'52.04.08.0002','Brang Biji','desa',154,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(157,'52.04.08.0003','Bugis','desa',154,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(158,'52.04.08.0004','Lempeh','desa',154,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(159,'52.04.08.0005','Pekat','desa',154,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(160,'52.04.08.0006','Samapuin','desa',154,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(161,'52.04.08.0007','Seketeng','desa',154,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(162,'52.04.22','Unter Iwes','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(163,'52.04.22.0001','Boak','desa',162,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(164,'52.04.22.0002','Jorok','desa',162,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(165,'52.04.22.0003','Kerato','desa',162,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(166,'52.04.22.0004','Kerekeh','desa',162,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(167,'52.04.22.0005','Nijang','desa',162,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(168,'52.04.22.0006','Pelat','desa',162,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(169,'52.04.22.0007','Pungka','desa',162,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(170,'52.04.22.0008','Uma Beringin','desa',162,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(171,'52.04.06','Utan','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(172,'52.04.06.0001','Bale Brang','desa',171,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(173,'52.04.06.0002','Jorok','desa',171,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(174,'52.04.06.0003','Labuan Bajo','desa',171,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(175,'52.04.06.0004','Motong','desa',171,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(176,'52.04.06.0005','Orong Bawa','desa',171,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(177,'52.04.06.0006','Pukat','desa',171,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(178,'52.04.06.0007','Sabedo','desa',171,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(179,'52.04.06.0008','Stowe Brang','desa',171,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(180,'52.04.06.0009','Tengah','desa',171,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(181,'52.04.25','Tarano','kecamatan',NULL,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(182,'52.04.25.0001','Banda','desa',181,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(183,'52.04.25.0002','Bantulanteh','desa',181,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(184,'52.04.25.0003','Labuan Aji','desa',181,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(185,'52.04.25.0004','Labuan Bontong','desa',181,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(186,'52.04.25.0005','Labuan Jambu','desa',181,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(187,'52.04.25.0006','Labuhan Pidang','desa',181,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(188,'52.04.25.0007','Mata','desa',181,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL),(189,'52.04.25.0008','Tolo Oi','desa',181,1,'2026-10-10 08:58:24','2026-10-10 08:58:24',NULL);
/*!40000 ALTER TABLE `wilayahs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-15 19:55:07
