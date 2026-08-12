-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Ağu 2026, 14:47:54
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
-- Tablo için tablo yapısı `sayfa_misyonumuz`
--

CREATE TABLE `sayfa_misyonumuz` (
  `id` int(11) NOT NULL,
  `baslik` varchar(150) NOT NULL,
  `icerik` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sayfa_misyonumuz`
--

INSERT INTO `sayfa_misyonumuz` (`id`, `baslik`, `icerik`) VALUES
(1, 'Misyonumuz', '<p>Gebze’de yaşam kalitesini arttırmak için yerel hizmetleri adil, etkin ve sürekli biçimde sunmaktır.</p>');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `sayfa_misyonumuz`
--
ALTER TABLE `sayfa_misyonumuz`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `sayfa_misyonumuz`
--
ALTER TABLE `sayfa_misyonumuz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
