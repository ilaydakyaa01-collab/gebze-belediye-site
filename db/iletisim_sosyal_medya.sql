-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Ağu 2026, 08:22:14
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

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
-- Tablo için tablo yapısı `iletisim_sosyal_medya`
--

CREATE TABLE `iletisim_sosyal_medya` (
  `id` int(11) NOT NULL,
  `platform` varchar(50) NOT NULL,
  `ikon` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `iletisim_sosyal_medya`
--

INSERT INTO `iletisim_sosyal_medya` (`id`, `platform`, `ikon`, `url`, `sira`) VALUES
(1, 'WhatsApp', 'bi-whatsapp', 'https://wa.me/902626420430', 1),
(2, 'Facebook', 'bi-facebook', 'https://www.facebook.com/gebzebelediye', 2),
(3, 'X (Twitter)', 'bi-twitter-x', 'https://twitter.com/gebze_belediye', 3),
(4, 'Instagram', 'bi-instagram', 'https://www.instagram.com/gebze_belediyesi', 4),
(5, 'YouTube', 'bi-youtube', 'https://www.youtube.com/channel/UCj2OaUgzp76dOS2jTlz2frg/', 5);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `iletisim_sosyal_medya`
--
ALTER TABLE `iletisim_sosyal_medya`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `iletisim_sosyal_medya`
--
ALTER TABLE `iletisim_sosyal_medya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
