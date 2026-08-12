-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Ağu 2026, 14:46:13
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
-- Tablo için tablo yapısı `kardes_sehirler`
--

CREATE TABLE `kardes_sehirler` (
  `id` int(11) NOT NULL,
  `belediye_adi` varchar(150) NOT NULL,
  `sehir_adi` varchar(100) NOT NULL,
  `ulke` varchar(100) NOT NULL,
  `tur` enum('yurt_ici','yurt_disi') NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kardes_sehirler`
--

INSERT INTO `kardes_sehirler` (`id`, `belediye_adi`, `sehir_adi`, `ulke`, `tur`, `sira`) VALUES
(1, 'Acıgöl Belediyesi', 'Nevşehir', 'Türkiye', 'yurt_ici', 1),
(2, 'Gülşehir Belediyesi', 'Nevşehir', 'Türkiye', 'yurt_ici', 2),
(3, 'Silvan Belediyesi', 'Diyarbakır', 'Türkiye', 'yurt_ici', 3),
(4, 'Selçuk Belediyesi', 'İzmir', 'Türkiye', 'yurt_ici', 4),
(5, 'Saltukova Belediyesi', 'Zonguldak', 'Türkiye', 'yurt_ici', 5),
(6, 'Malazgirt Belediyesi', 'Muş', 'Türkiye', 'yurt_ici', 6),
(7, 'Durankaya Belediyesi', 'Hakkari', 'Türkiye', 'yurt_ici', 7),
(8, 'Değirmenlik Belediyesi', 'Değirmenlik', 'KKTC', 'yurt_disi', 1),
(9, 'Karakol Şehri', 'Issık-Göl', 'Kırgızistan', 'yurt_disi', 2),
(10, 'Samuil Belediyesi', 'Razgrad', 'Bulgaristan', 'yurt_disi', 3),
(11, 'Pilea Belediyesi', 'Selanik', 'Yunanistan', 'yurt_disi', 4),
(12, 'Oeiras Belediyesi', 'Lizbon', 'Portekiz', 'yurt_disi', 5),
(13, 'Kakanj Belediyesi', 'Kakanj', 'Bosna Hersek', 'yurt_disi', 6),
(14, 'Garowe Belediyesi', 'Garowe', 'Somali', 'yurt_disi', 7),
(15, 'Tyulyachi Belediyesi', 'Tyulyachi', 'Tataristan', 'yurt_disi', 8),
(16, 'Studenicani Belediyesi', 'Studenicani', 'Makedonya', 'yurt_disi', 9),
(17, 'Kiseljak Belediyesi', 'Kiseljak', 'Bosna Hersek', 'yurt_disi', 10),
(18, 'Hasköy Belediyesi', 'Hasköy', 'Bulgaristan', 'yurt_disi', 11);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kardes_sehirler`
--
ALTER TABLE `kardes_sehirler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kardes_sehirler`
--
ALTER TABLE `kardes_sehirler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
