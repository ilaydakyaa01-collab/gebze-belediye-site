-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Ağu 2026, 08:34:23
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
-- Tablo için tablo yapısı `ebelediye_kategoriler`
--

CREATE TABLE `ebelediye_kategoriler` (
  `id` int(11) NOT NULL,
  `ad` varchar(150) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ebelediye_kategoriler`
--

INSERT INTO `ebelediye_kategoriler` (`id`, `ad`, `sira`) VALUES
(15, 'Bilgilendirme Hizmetleri', 6),
(17, 'Spor ve Eğitim', 4),
(22, 'Kurum İçi İşlemler', 7),
(29, 'Vergi İşlemleri', 1),
(30, 'Gebze İletişim Merkezi', 2),
(31, 'İnteraktif Hizmetler', 3),
(32, 'İmar Yönetim Sistemi', 5);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ebelediye_kategoriler`
--
ALTER TABLE `ebelediye_kategoriler`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
