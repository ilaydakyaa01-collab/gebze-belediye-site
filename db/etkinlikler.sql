-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 14 Ağu 2026, 10:48:56
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `gebze_belediye`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `etkinlikler`
--

CREATE TABLE `etkinlikler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `renk` varchar(20) NOT NULL DEFAULT '#1a7ae4',
  `tarih` date NOT NULL,
  `saat` varchar(10) NOT NULL,
  `yer` varchar(255) NOT NULL,
  `adres` varchar(255) DEFAULT NULL,
  `detay` text DEFAULT NULL,
  `resim` varchar(255) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `etkinlikler`
--

INSERT INTO `etkinlikler` (`id`, `baslik`, `kategori`, `renk`, `tarih`, `saat`, `yer`, `adres`, `detay`, `resim`, `sira`) VALUES
(1, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-06', '20:00', 'ORHANGAZİ İLKOKULU', 'Köşklü Çeşme, 530. Sk. No:22, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/mahallemde-sinema-var-6.jpg', 1),
(2, 'Gebzede Müziğin Ritmi', 'Konser', '#1a7ae4', '2026-08-07', '20:00', 'ESKİHİSAR KALE ALTI', 'Eskihisar, 41400 Gebze/Kocaeli Eskihisar', NULL, 'img/etkinlikler/gebzede-muzigin-ritmi.jpeg', 2),
(3, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-07', '20:00', 'GEBZE MİLLET BAHÇESİ', 'Sultan Orhan, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/mahallemde-sinema-var-7.jpg', 3),
(4, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-08', '20:00', '15 TEMMUZ MİLLİ İRADE KENT MEYDANI', 'Hacıhalil, 1222/2. Sk. Çoban Mustafa Paşa Cami No:2, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/mahallemde-sinema-var-8.jpg', 4),
(5, 'Gebze 2. Drift Festivali', 'Özel Program', '#6b7280', '2026-08-09', '16:00', 'MEVLANA KAPALI PAZAR YERİ', 'Mevlana, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/gebze-2-dift-festivali.jpg', 5),
(6, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-09', '20:00', 'ŞEHİT İLKER AĞÇAY İLKOKULU', 'Mevlana, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/mahallemde-sinema-var-9.jpg', 6),
(7, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-10', '20:00', 'ATATÜRK İLKOKULU', 'Mustafapaşa, Yeni Bağdat Cd. No:483, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/mahallemde-sinema-var-10.jpg', 7),
(8, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-11', '20:00', 'MEHMET AKİF ERSOY İLKÖĞRETİM OKULU', 'Barış, Dr. Zeki Acar Cd. No:7, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/mahallemde-sinema-var-11.jpg', 8),
(9, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-12', '20:00', 'İSTASYON BİLİM SANAT MERKEZİ', 'İstasyon, 1409/1. Sk. No:14, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/mahallemde-sinema-var-12.jpg', 9),
(10, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-13', '20:00', 'EMLAK KONUTLARI İLKÖĞRETİM OKULU', 'Kirazpınar, Yeni Bağdat Cd. No:941, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/mahallemde-sinema-var-13.jpg', 10),
(11, 'Gebzede Müziğin Ritmi', 'Konser', '#1a7ae4', '2026-08-14', '20:00', 'GEBZE MİLLET BAHÇESİ', 'Sultan Orhan, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/gebzede-muzigin-ritmi-14.jpeg', 11),
(12, 'Yaz Konserleri', 'Konser', '#1a7ae4', '2026-08-16', '20:00', 'GEBZE MİLLET BAHÇESİ', 'Sultan Orhan, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/yaz-konserleri.jpeg', 12),
(15, 'Gebzede Müziğin Ritmi', 'Konser', '#1a7ae4', '2026-08-21', '20:00', 'ESKİHİSAR KALE ALTI', 'Eskihisar, 41400 Gebze/Kocaeli Eskihisar', NULL, 'img/etkinlikler/gebzede-muzigin-ritmi-21.jpeg', 13),
(16, 'Geleneksel Gebze Aile Şenliği ve Açık Hava Konseri', 'Özel Program', '#6b7280', '2026-06-20', '11:00', 'GEBZE MİLLET BAHÇESİ', 'Sultan Orhan, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/aile-senligi.jpeg', 13),
(17, 'Milli Maç', 'Özel Program', '#6b7280', '2026-06-14', '07:00', '15 TEMMUZ MİLLİ İRADE KENT MEYDANI', 'Hacıhalil, 1222/2. Sk. Çoban Mustafa Paşa Cami No:2, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/milli-mac.jpeg', 14),
(18, '31. Geleneksel Sünnet Şöleni', 'Özel Program', '#6b7280', '2026-06-14', '19:00', 'TATLIKUYU KAPALI PAZAR ALANI', 'Tatlıkuyu, 1319/2. Sk. No:5, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/sunnet-soleni.jpeg', 15),
(19, 'Kanıt Fotoğraf Sergisi - Gazze de Soykırım Var', 'Özel Program', '#6b7280', '2025-10-07', '19:30', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/gazze.jpg', 16),
(20, 'Aşıklar Gecesi', 'Özel Program', '#6b7280', '2025-08-01', '20:45', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', 'Eskihisar / Gebze', 'img/etkinlikler/asiklar-gecesi.jpg', 17),
(21, 'Bilim Show ve Onur Erol Çocuk Konseri', 'Çocuk Etkinliği', '#f59e0b', '2026-07-26', '20:30', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', NULL, 'img/etkinlikler/onur-erol.jpg', 18),
(22, 'Vantrolog Gösterisi ve Rafadan Tayfa Kapadokya', 'Çocuk Etkinliği', '#f59e0b', '2026-07-25', '20:30', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', NULL, 'img/etkinlikler/rafadan-tayfa.jpg', 19),
(23, 'İllüzyon Gösterisi - Jonglör - Nasrettin Hoca - İbiş ve Kukla Gösterisi', 'Çocuk Etkinliği', '#f59e0b', '2026-07-20', '20:30', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', NULL, 'img/etkinlikler/illuzyon.jpg', 20),
(24, 'Zeynep Betül Akyıldız ile Çocuk Şarkıları Konseri ve Masal Dinletisi', 'Çocuk Etkinliği', '#f59e0b', '2025-08-03', '20:45', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', NULL, 'img/etkinlikler/zeynep-betul.jpg', 21),
(25, 'Erkan Obüs ile Jonglör ve Kukla Gösterisi', 'Çocuk Etkinliği', '#f59e0b', '2025-05-24', '12:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/erkan-obus.jpg', 22),
(26, 'Çocuk Etkinliği - İllizyonist Çiğdem Bağcı', 'Çocuk Etkinliği', '#f59e0b', '2025-04-20', '12:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/illizyonist.jpg', 23),
(27, 'Hıçkırık', 'Yetişkin Sineması', '#8b5cf6', '2026-07-24', '20:30', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', NULL, 'img/etkinlikler/hickirik.jpg', 24),
(28, 'Gülen Gözler', 'Yetişkin Sineması', '#8b5cf6', '2026-07-23', '20:30', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', NULL, 'img/etkinlikler/gulen-gozler.jpg', 25),
(29, 'Bizim Aile', 'Yetişkin Sineması', '#8b5cf6', '2026-07-22', '20:30', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', NULL, 'img/etkinlikler/bizim-aile.jpg', 26),
(30, 'Selvi Boylum Al Yazmalım', 'Yetişkin Sineması', '#8b5cf6', '2026-07-21', '20:30', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', NULL, 'img/etkinlikler/selvi-boylum.jpg', 27),
(31, 'Yetişkin Sineması - Neşeli Günler', 'Yetişkin Sineması', '#8b5cf6', '2025-07-28', '20:45', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', NULL, 'img/etkinlikler/neseli-gunler.jpg', 28),
(32, 'Yetişkin Sineması - Ayla', 'Yetişkin Sineması', '#8b5cf6', '2025-07-27', '20:45', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', NULL, 'img/etkinlikler/ayla.jpg', 29),
(33, '15 Temmuz', 'Anma Programı', '#dc2626', '2026-07-15', '20:00', '15 TEMMUZ MİLLİ İRADE KENT MEYDANI', 'Hacıhalil, 1222/2. Sk. Çoban Mustafa Paşa Cami No:2, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/15-temmuz.jpg', 1),
(34, 'Tarihçi Yazar Dr. Recep Kankal - Bir Cihan Hükümdarı Fatih Sultan Mehmet Han', 'Anma Programı', '#dc2626', '2026-05-03', '13:00', 'HÜNKAR ÇAYIRI', 'Çayırova, 2257. Sk., 41420 Çayırova/Kocaeli', NULL, 'img/etkinlikler/recep-kankal.jpg', 2),
(35, 'Fatih Sultan Mehmet Hanı Anma', 'Anma Programı', '#dc2626', '2025-05-03', '13:00', 'HÜNKAR ÇAYIRI', 'Çayırova, 2257. Sk., 41420 Çayırova/Kocaeli', NULL, 'img/etkinlikler/mehmet-hanı.jpg', 3),
(36, 'İki Sohbet Biri Demli - Mehmet Akif Ersoyu Anma Programı', 'Anma Programı', '#dc2626', '2024-12-28', '19:30', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/iki-sohbet.jpg', 4),
(37, 'Kardelen Çiçekleri - Vatan İçin Kefenleri Kar Olan Kahramanlar', 'Anma Programı', '#dc2626', '2024-12-22', '19:30', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/kardelen.jpg', 5),
(38, 'Sinan Yağmur ile Mevlana ve Şeb-i Arus', 'Anma Programı', '#dc2626', '2024-12-17', '19:30', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/sinan.jpg', 6),
(39, '4.Gebze Off-Road Festivali', 'Off-Road', '#78716c', '2026-06-12', '14:00', 'DENİZLİ GÖLETİ', 'Denizli, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/off-road.jpg\r\n', 1),
(40, 'Modern Yansımalar Sergisi', 'Sergi', '#0891b2', '2026-06-10', '12:00', 'GEBZE BELEDİYESİ SANAT GALERİSİ', 'Hacihali̇l Mah Şehit Numan Dede Cd. No:5, Hacıhalil, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/sergi.jpg', 1),
(41, 'Sanal Yaşam', 'Yetişkin Tiyatrosu', '#7c3aed', '2026-05-23', '20:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/sanal-yasam.jpg', 1),
(42, 'Kurak Gürültü 12;01', 'Yetişkin Tiyatrosu', '#7c3aed', '2026-05-09', '20:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/kurak.jpg', 2),
(43, 'Yetişkin Tiyatrosu - Kılıbık Hayrullah', 'Yetişkin Tiyatrosu', '#7c3aed', '2026-04-22', '20:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/kilibik.jpg', 3),
(44, 'Yetişkin Tiyatrosu - Bin Yıl', 'Yetişkin Tiyatrosu', '#7c3aed', '2026-02-12', '14:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/bin-yil.jpg', 4),
(45, 'Yetişkin Tiyatrosu - Gazzenin Kadınları', 'Yetişkin Tiyatrosu', '#7c3aed', '2026-01-25', '19:30', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/gazzenin-kadinlari.jpg', 5),
(46, 'Yetişkin Tiyatrosu - İki Gönül Bir Olunca', 'Yetişkin Tiyatrosu', '#7c3aed', '2026-01-10', '19:30', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/iki-gonul.jpg', 6),
(53, 'Bremen Mızıkacıları', 'Çocuk Tiyatrosu', '#ea580c', '2026-05-17', '14:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/bremen.jpg', 1),
(54, 'Sihirli Ada', 'Çocuk Tiyatrosu', '#ea580c', '2026-05-10', '14:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/sihirli-ada.jpg', 2),
(55, 'Şaşkın Korsan', 'Çocuk Tiyatrosu', '#ea580c', '2026-05-09', '14:00', 'BEYLİKBAĞI BİLİM SANAT MERKEZİ', 'Mimar Sinan, Ankara Cd. No:7, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/saskin-korsan.jpg', 3),
(56, 'Nasreddin Hoca ve Komşuları', 'Çocuk Tiyatrosu', '#ea580c', '2026-05-02', '14:00', 'ARAPÇEŞME BİLİM SANAT MERKEZİ', 'Arapçeşme, Arapçeşme Mahallesi Kavak Caddesi, 1066. Sk. No:27, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/nasrettin-hoca.jpg', 4),
(57, 'Çocuk Tiyatrosu - İbiş', 'Çocuk Tiyatrosu', '#ea580c', '2026-04-19', '16:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/ibis.jpg', 5),
(58, 'Çocuk Tiyatrosu - Aliş İle Hüriş Düşler Diyarında', 'Çocuk Tiyatrosu', '#ea580c', '2026-04-11', '13:00', 'ARAPÇEŞME BİLİM SANAT MERKEZİ', 'Arapçeşme, Arapçeşme Mahallesi Kavak Caddesi, 1066. Sk. No:27, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/alis.jpg', 6),
(59, 'Akademisyen Yazar Dr. Ömer Demirbağ - Ailenin İçinde Saklı Cennet', 'Söyleşi', '#0d9488', '2026-05-15', '19:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/omer.jpg', 1),
(60, 'Klinik Psikolog Beyhan Budak - Birlikte İyi Hissetmek', 'Söyleşi', '#0d9488', '2026-05-13', '20:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/beyhan.jpg', 2),
(61, 'Yazar Ahmet Ümit - Edebiyat Edepten Gelir', 'Söyleşi', '#0d9488', '2026-05-12', '20:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/ahmet.jpg', 3),
(62, 'Jinekolog Doktor Ayşe Duman - Ruh Beden Bütünlüğünde Kadınlığın Keşfi', 'Söyleşi', '#0d9488', '2026-05-10', '20:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/ayse.jpg', 4),
(63, 'Yazar Sıtkı Aslanhan - Bu Çağın Ebeveyni Olmak', 'Söyleşi', '#0d9488', '2026-05-02', '20:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/sitki.jpg', 5),
(64, 'Söyleşi - Osman Sarı - LGS ve YKS', 'Söyleşi', '#0d9488', '2026-04-30', '11:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/osman.jpg', 6),
(65, 'Ahmet Kürşat Batur - Kudüs ve Gazze Bize Ne Söyler', 'Stand - up', '#16a34a', '2026-05-03', '20:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/ahmet-kursat.jpg', 1),
(66, 'Stand - Up Gösterisi - Recep Demirkaynak', 'Stand - up', '#16a34a', '2025-07-31', '20:45', 'ESKİHİSAR KALESİ', 'Eskihisar / Gebze', NULL, 'img/etkinlikler/recep-demirkaynak.jpg', 2),
(67, 'Panel - Çoban Mustafa Paşa', 'Panel', '#b45309', '2026-04-27', '14:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/coban-mustafa.jpg', 1),
(68, 'Panel - Kansersiz Hayatlar', 'Panel', '#b45309', '2026-04-05', '12:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/kansersiz.jpg', 2),
(69, '6 Şubat Kahramanmaraş Depremi Anısına - Afet, Kadın ve Sağlık Üçgeni - Panel ve GEAK Sergisi', 'Panel', '#b45309', '2025-02-05', '13:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/6-subat.jpg', 3),
(70, 'Bir Menzil Kasabasından Tarih Kültür ve Sanayi Kentine Gebze Paneli', 'Panel', '#b45309', '2024-12-20', '11:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/bir-menzil.jpg', 4),
(71, 'Şiir Dinletisi - Dursun Ali Erzincanlı', 'Şiir Dinletisi', '#be185d', '2026-04-18', '20:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/dursun-ali.jpg', 1),
(72, 'Dursun Ali Erzincanlı - En Sevgiliye Şiir Dinletisi', 'Şiir Dinletisi', '#be185d', '2025-04-12', '20:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/dursun-en.jpg', 2),
(73, 'Ramazan 2026 - Hafız M. Mansur Sağır', 'Ramazan Özel Cami Programı', '#d97706', '2026-03-18', '20:37', 'ADEMYAVUZ ELMAS CAMİ', 'Adem Yavuz, 2339. Sk. No:21, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/hafiz-mansur.jpg', 1),
(74, 'Ramazan 2026 - Hafız Rıdvan Akbaş', 'Ramazan Özel Cami Programı', '#d97706', '2026-03-17', '20:36', 'ÇARŞI CAMİ', 'Hacıhalil, İsmet Paşa Cd. 12-1, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/hafiz-ridvan.jpg', 2),
(75, 'Ramazan 2026 - Kurra Hafız Dr. Fatih Çollak (Kadir Gecesi)', 'Ramazan Özel Cami Programı', '#d97706', '2026-03-16', '20:35', 'MEHMET AKİF ERSOY CAMİ', 'Osman Yılmaz, Mehmet Akif Ersoy Cd. No:32, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/hafiz-kurra.jpg', 3),
(76, 'Ramazan 2026 - Prof.Dr. Mehmet Emin Ay (Kadir Gecesi)', 'Ramazan Özel Cami Programı', '#d97706', '2026-03-16', '20:36', 'ÇOBAN MUSTAFA PAŞA CAMİ', 'Hacıhalil, 1222/2. Sk. No:3, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/hafiz-mehmet.jpg', 4),
(77, 'Ramazan 2026 - Hafız Kerim Öztürk', 'Ramazan Özel Cami Programı', '#d97706', '2026-03-15', '20:34', 'MİMAR SİNAN MERKEZ CAMİ', 'Mimar Sinan, 6. Sk. No:25, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/hafiz-kerim.jpg', 5),
(78, 'Ramazan 2026 - Hafız Muhammed Sizcan', 'Ramazan Özel Cami Programı', '#d97706', '2026-03-14', '20:33', 'YILDIZLI CAMİ', 'Mustafapaşa, İbrahim Ağa Cd. No:89, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/hafiz-muhammet.jpg', 6),
(79, 'Sirk Gösterisi - Yetenek Sirkiniz', 'Sirk Çocuk', '#c026d3', '2026-01-25', '12:15', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/sirk-gosterisi.jpg', 1),
(80, 'İllüzyon Gösterisi ve Balon Show - İllüzyonist Çiğdem Bağcı', 'Sirk Çocuk', '#c026d3', '2025-01-28', '12:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/balon-show.jpg', 2),
(81, 'Çocuk Tiyatrosu ve Sihirbaz Sabu Gösterisi - 2 Seans - 1. seans 12.00 - 2. seans 14.00', 'Sirk Çocuk', '#c026d3', '2025-01-22', '12:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/sihirbaz-sabu.jpg', 3),
(82, 'Kur-anı Kerim Tilaveti ve Teravih Namazı - Öğretim Görevlisi Prof. Dr. Mustafa Ağırman - Hafız İrfan Tatlı - Hafız Adem Akbaş - Hafız Emrecan Tekel', 'Kandil Programı', '#0369a1', '2025-03-26', '20:32', 'ÇOBAN MUSTAFA PAŞA CAMİİ', 'Hacıhalil, 1222/2. Sk. No:3, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/kandil.jpg', 1),
(83, 'Youtuber Sertaç Abi İle Miraç Kandilinde Kardeşlik Cami Buluşmaları', 'Sohbet', '#059669', '2025-01-26', '07:15', 'BEYLİKBAĞI MERKEZ ( SARI ) CAMİ', 'Beylikbağı, Yaşar Doğu Cd. No:115, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/sohbet.jpg', 1),
(84, 'Serdar Vatansever - Kendini Keşfeden İlişkisini Yönetir', 'Konferans', '#1d4ed8', '2025-01-18', '19:30', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/konferans-serdar.jpg', 1),
(85, 'Söyleşi - Tuğba Coşkuner - Çocuk Eğitiminde Değiltirmemiz Gereken ve Geliştirmemiz Gereken Alışkanlıklarımız', 'Konferans', '#1d4ed8', '2025-01-05', '16:00', 'GEBZE KÜLTÜR MERKEZİ', 'Hacıhalil, Şht. Numan Dede Cd. No:8, 41400 Gebze/Kocaeli', NULL, 'img/etkinlikler/konferans-tugba.jpg', 2),
(86, 'Saniye Bencik Kangal - Çocuğumun Beyninde Neler Oluyor?', 'Konferans', '#1d4ed8', '2024-12-15', '19:30', 'GEBZE BELEDİYESİ', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', NULL, 'img/etkinlikler/konferans-saniye.jpg', 3);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `etkinlikler`
--
ALTER TABLE `etkinlikler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `etkinlikler`
--
ALTER TABLE `etkinlikler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
