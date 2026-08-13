-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 13 Ağu 2026, 11:26:29
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
-- Tablo için tablo yapısı `kurumsal_kimlik`
--

CREATE TABLE `kurumsal_kimlik` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `aciklama` varchar(255) DEFAULT NULL,
  `dosya` varchar(255) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT 'Kurumsal Logo',
  `sira` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kurumsal_kimlik`
--

INSERT INTO `kurumsal_kimlik` (`id`, `baslik`, `aciklama`, `dosya`, `kategori`, `sira`) VALUES
(1, 'Başkan Logo', 'PNG formatında logo', 'dosya/kimlik/baskan-logo.png', 'Kurumsal Logo', 1),
(2, 'Gebze Belediyesi Yatay Logo', 'PNG formatında logo', 'dosya/kimlik/yatay-logo.png', 'Kurumsal Logo', 2),
(3, 'Gebze Belediyesi Dikey Logo', 'PNG formatında logo', 'dosya/kimlik/dikey-logo.png', 'Kurumsal Logo', 3),
(4, 'Kurumsal Logo Vektörel', 'PDF formatında vektörel logo', 'dosya/kimlik/logo-vektorel.pdf', 'Kurumsal Logo', 4);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kurumsal_kimlik`
--
ALTER TABLE `kurumsal_kimlik`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kurumsal_kimlik`
--
ALTER TABLE `kurumsal_kimlik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
