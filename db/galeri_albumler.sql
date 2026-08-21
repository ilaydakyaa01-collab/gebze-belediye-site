-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 21 Ağu 2026, 13:11:34
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
-- Tablo için tablo yapısı `galeri_albumler`
--

CREATE TABLE `galeri_albumler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `kapak_resim` varchar(255) DEFAULT NULL,
  `tarih` date NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `galeri_albumler`
--

INSERT INTO `galeri_albumler` (`id`, `baslik`, `kapak_resim`, `tarih`, `sira`) VALUES
(1, 'KİRAZPINAR MAHALLEMDE SİNEMA VAR', 'img/galeri-album/kirazpinar.jpg', '2026-08-14', 1),
(2, 'MAHALLEMDE SİNEMA VAR OSMAN YILMAZ', 'img/galeri-album/osman.jpg', '2026-08-08', 2),
(3, 'ULUS MAHALLEMDE SİNEMA VAR', 'img/galeri-album/ulus.jpg', '2026-04-08', 3),
(4, 'Yavuz Selim İlkokulu Mahallemde Sinema Var', 'img/galeri-album/selim.jpg', '2026-04-08', 4),
(5, 'Fevzi Çakmak İlkokulu Mahallemde sinema var ', 'img/galeri-album/fevzi.jpg', '2026-04-08', 5),
(6, 'Mollafenari Mahallemde Sinema Var', 'img/galeri-album/mollafenari.jpg', '2026-04-08', 6),
(9, 'Adem Yavuz-Mimar Sinan Mahallemde Sinema Var', 'img/galeri-album/adem.jpg', '2026-04-08', 7),
(10, 'Mahallemde Sinema Var Beylikbağı', 'img/galeri-album/beylikbagi.jpg', '2026-04-08', 8),
(11, '15 Temmuz', 'img/galeri-album/temmuz.jpg', '2026-07-16', 9),
(12, 'Nikah Programı', 'img/galeri-album/nikah.jpg', '2026-07-13', 10);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `galeri_albumler`
--
ALTER TABLE `galeri_albumler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `galeri_albumler`
--
ALTER TABLE `galeri_albumler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
