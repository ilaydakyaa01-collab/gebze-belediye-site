-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 21 Ağu 2026, 13:29:30
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
-- Tablo için tablo yapısı `hizmet_kategorileri`
--

CREATE TABLE `hizmet_kategorileri` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(60) NOT NULL,
  `no` varchar(4) NOT NULL DEFAULT '',
  `baslik` varchar(150) NOT NULL,
  `aciklama` varchar(255) DEFAULT NULL,
  `sira` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `hizmet_kategorileri`
--

INSERT INTO `hizmet_kategorileri` (`id`, `slug`, `no`, `baslik`, `aciklama`, `sira`, `aktif`) VALUES
(1, 'atolyeler', '01', 'Atölyeler', 'Çocuklar ve gençler için ücretsiz atölye ve eğitim programları.', 1, 1),
(2, 'kutuphane', '02', 'Kütüphane', 'Gebze genelindeki halk kütüphaneleri ve okuma salonları.', 2, 1),
(3, 'bebek-cocuk-bakimevi', '03', 'Bebek ve Çocuk Bakımevi', 'Ailelere destek amaçlı bebek ve çocuk bakım hizmetleri.', 3, 1),
(4, 'mesire-alani', '04', 'Mesire Alanı', 'Aileler için piknik ve doğa alanları.', 4, 1),
(5, 'merkezler', '05', 'Merkezler', 'Halk eğitim, sağlık ve sosyal yaşam merkezleri.', 5, 1),
(6, 'geri-donusum', '06', 'Geri Dönüşüm', 'Atık toplama noktaları ve geri dönüşüm hizmetleri.', 6, 1),
(7, 'evlendirme', '07', 'Evlendirme', 'Nikah başvuru ve salon hizmetleri.', 7, 1),
(8, 'egitimler', '08', 'Eğitimler', 'Yetişkinlere yönelik meslek edindirme ve gelişim kursları.', 8, 1),
(9, 'hunkar-cayiri', '09', 'Geleneksel Hünkar Çayırı Yağlı Güreşleri', 'Her yıl düzenlenen geleneksel yağlı güreş etkinliği.', 9, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `hizmet_kategorileri`
--
ALTER TABLE `hizmet_kategorileri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_slug` (`slug`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `hizmet_kategorileri`
--
ALTER TABLE `hizmet_kategorileri`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
