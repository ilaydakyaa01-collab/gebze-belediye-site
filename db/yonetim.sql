-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 10 Ağu 2026, 14:21:58
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
-- Tablo için tablo yapısı `yonetim`
--

CREATE TABLE `yonetim` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(255) NOT NULL,
  `unvan` varchar(255) NOT NULL,
  `telefon` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gorev_ozet` text DEFAULT NULL,
  `grup` enum('baskan','yardimci','mudur') NOT NULL,
  `resim` varchar(255) DEFAULT NULL,
  `sira` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `yonetim`
--

INSERT INTO `yonetim` (`id`, `ad_soyad`, `unvan`, `telefon`, `email`, `gorev_ozet`, `grup`, `resim`, `sira`) VALUES
(1, 'Zinnur Büyükgöz', 'Belediye Başkanı', NULL, NULL, NULL, 'baskan', 'img/baskan.png', 1),
(2, 'Şerif Canpolat', 'Başkan Yardımcısı', NULL, NULL, NULL, 'yardimci', 'img/yonetim/şerifCanpolat.jpg', 1),
(3, 'Muharrem Baltacıoğlu', 'Başkan Yardımcısı', NULL, NULL, NULL, 'yardimci', 'img/yonetim/muharremBaltacıoğlu.jpg', 2),
(4, 'Mahmut Yandık', 'Başkan Yardımcısı', NULL, NULL, NULL, 'yardimci', 'img/yonetim/mahmutYandık.jpg', 3),
(5, 'Şener Akın', 'Başkan Yardımcısı', NULL, NULL, NULL, 'yardimci', 'img/yonetim/şenerAkın.jpg', 4),
(6, 'Zeynep Yıldırım', 'Başkan Yardımcısı', NULL, NULL, NULL, 'yardimci', 'img/yonetim/zeynepYıldırım.jpg', 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `yonetim`
--
ALTER TABLE `yonetim`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `yonetim`
--
ALTER TABLE `yonetim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
