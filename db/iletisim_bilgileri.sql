-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Ağu 2026, 08:21:51
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
-- Tablo için tablo yapısı `iletisim_bilgileri`
--

CREATE TABLE `iletisim_bilgileri` (
  `id` int(11) NOT NULL,
  `telefon` varchar(50) DEFAULT NULL,
  `faks` varchar(50) DEFAULT NULL,
  `adres` varchar(255) DEFAULT NULL,
  `eposta` varchar(150) DEFAULT NULL,
  `kep` varchar(150) DEFAULT NULL,
  `harita_embed_url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `iletisim_bilgileri`
--

INSERT INTO `iletisim_bilgileri` (`id`, `telefon`, `faks`, `adres`, `eposta`, `kep`, `harita_embed_url`) VALUES
(1, '+90 262 642 0430', '+90 262 642 0438', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'gebze@gebze.bel.tr', 'gebzebelediyesi@hs01.kep.tr', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3020.0038566989574!2d29.438006315714482!3d40.80590903980137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cb2088efaa11d3%3A0x575a512b11a2fd35!2sGebze%20Belediyesi!5e0!3m2!1str!2str!4v1574241717553!5m2!1str!2str');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `iletisim_bilgileri`
--
ALTER TABLE `iletisim_bilgileri`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `iletisim_bilgileri`
--
ALTER TABLE `iletisim_bilgileri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
