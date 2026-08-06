-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Ağu 2026, 15:00:27
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

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
-- Tablo için tablo yapısı `proje_kategorileri`
--

CREATE TABLE `proje_kategorileri` (
  `id` int(11) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sira` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `proje_kategorileri`
--

INSERT INTO `proje_kategorileri` (`id`, `ad`, `slug`, `sira`) VALUES
(1, 'İmar ve Şehircilik', 'imar-sehir', 0),
(2, 'Ulaşım ve Altyapı', 'ulasim-altyapi', 1),
(3, 'Üstyapı', 'üstyapi', 2),
(4, 'Eğitim, Gençlik ve Spor', 'egitim', 3),
(5, 'Çevre', 'cevre', 4),
(6, 'Kültür ve Sanat', 'kultur-sanat', 5),
(7, 'Dijital Belediyecilik', 'dijital', 6),
(8, 'Sosyal Belediyecilik', 'sosyal', 7);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `proje_kategorileri`
--
ALTER TABLE `proje_kategorileri`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `proje_kategorileri`
--
ALTER TABLE `proje_kategorileri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
