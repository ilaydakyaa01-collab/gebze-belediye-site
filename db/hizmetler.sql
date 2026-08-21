-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 21 Ağu 2026, 13:15:38
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
-- Tablo için tablo yapısı `hizmetler`
--

CREATE TABLE `hizmetler` (
  `id` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `baslik` varchar(100) NOT NULL,
  `href` varchar(255) NOT NULL DEFAULT '#',
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hizmetler`
--

INSERT INTO `hizmetler` (`id`, `icon`, `baslik`, `href`, `sira`) VALUES
(7, 'bi-laptop', 'E-Belediye', 'https://www.belediye.gov.tr/e-belediye-giris', 1),
(8, 'bi-file-earmark-text', 'Başvuru', 'https://ulakbel.kocaeli.bel.tr/BasvuruTakip#/', 2),
(9, 'bi-building', 'İmar', 'https://www.kocaeli.bel.tr/imarplanlari.html', 3),
(10, 'bi-capsule', 'Eczane', 'https://www.kocaelieo.org.tr/nobetci-eczaneler', 4),
(11, 'bi-bus-front', 'Ulaşım', 'https://e-komobil.com/index.php?cmd=main', 5),
(12, 'bi-headset', 'Alo 153', 'https://www.kocaeli.bel.tr/hizmet/153-cagri-merkezi-2.html', 6);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `hizmetler`
--
ALTER TABLE `hizmetler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `hizmetler`
--
ALTER TABLE `hizmetler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
