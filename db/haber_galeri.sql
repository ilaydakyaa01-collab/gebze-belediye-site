-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 21 Ağu 2026, 13:28:58
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
-- Tablo için tablo yapısı `haber_galeri`
--

CREATE TABLE `haber_galeri` (
  `id` int(11) NOT NULL,
  `haber_id` int(11) NOT NULL,
  `resim` varchar(255) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `haber_galeri`
--

INSERT INTO `haber_galeri` (`id`, `haber_id`, `resim`, `sira`) VALUES
(1, 1, 'img/haberler/galeri/yaz-1.jpeg', 1),
(2, 1, 'img/haberler/galeri/yaz-2.jpeg', 2),
(3, 1, 'img/haberler/galeri/yaz-3.jpeg', 3),
(4, 1, 'img/haberler/galeri/yaz-4.jpeg', 4),
(5, 1, 'img/haberler/galeri/yaz-5.jpeg', 5),
(6, 1, 'img/haberler/galeri/yaz-6.jpeg', 6),
(7, 1, 'img/haberler/galeri/yaz-7.jpeg', 7),
(8, 1, 'img/haberler/galeri/yaz-7.jpeg', 7),
(10, 1, 'img/haberler/galeri/yaz-8.jpeg', 8),
(12, 1, 'img/haberler/galeri/yaz-konseri17.jpg', 9),
(13, 13, 'img/haberler/galeri/cosku-1.jpeg', 10),
(14, 13, 'img/haberler/galeri/cosku-2.jpeg', 11),
(15, 13, 'img/haberler/galeri/cosku-3.jpeg', 12),
(16, 13, 'img/haberler/galeri/cosku-4.jpeg', 13),
(17, 13, 'img/haberler/galeri/cosku-5.jpeg', 14),
(18, 13, 'img/haberler/galeri/cosku-6.jpeg', 15),
(19, 13, 'img/haberler/galeri/cosku-7.jpeg', 16),
(20, 4, 'img/haberler/galeri/seltifika-1.png', 17),
(21, 7, 'img/haberler/galeri/drift-1.jpeg', 18),
(22, 7, 'img/haberler/galeri/drift-2.jpeg', 19),
(23, 7, 'img/haberler/galeri/drift-3.jpeg', 20),
(24, 7, 'img/haberler/galeri/drift-4.jpeg', 21),
(25, 7, 'img/haberler/galeri/drift-5.jpeg', 22),
(26, 7, 'img/haberler/galeri/drift-6.jpeg', 23),
(27, 7, 'img/haberler/galeri/drift-7.jpeg', 24),
(30, 8, 'img/haberler/galeri/sporcu-1.jpeg', 25),
(31, 8, 'img/haberler/galeri/spor-2.jpeg', 26),
(32, 8, 'img/haberler/galeri/sporcu-3.jpeg', 27),
(33, 9, 'img/haberler/galeri/hava-1.jpeg', 28),
(34, 9, 'img/haberler/galeri/hava-2.jpeg', 29),
(35, 9, 'img/haberler/galeri/hava-3.jpeg', 30),
(36, 9, 'img/haberler/galeri/hava-4.jpeg', 31),
(37, 9, 'img/haberler/galeri/hava-5.jpeg', 32),
(38, 9, 'img/haberler/galeri/hava-6.jpeg', 33),
(39, 11, 'img/haberler/galeri/sehit-1.jpeg\r\n', 35),
(40, 11, 'img/haberler/galeri/sehit-2.jpeg\r\n', 36),
(41, 11, 'img/haberler/galeri/sehit-3.jpeg\r\n', 37),
(42, 11, 'img/haberler/galeri/sehit-4.jpeg\r\n', 38),
(43, 11, 'img/haberler/galeri/sehit-5.jpeg\r\n', 39),
(44, 11, 'img/haberler/galeri/sehit-6.jpeg\r\n', 40),
(45, 3, 'img/haberler/galeri/meclis-1.jpeg', 41),
(46, 3, 'img/haberler/galeri/meclis-2.jpeg', 42),
(47, 3, 'img/haberler/galeri/meclis-3.jpeg', 43),
(48, 3, 'img/haberler/galeri/meclis-4.jpeg', 44),
(49, 3, 'img/haberler/galeri/meclis-5.jpeg', 45),
(50, 3, 'img/haberler/galeri/meclis-6.jpeg', 46),
(57, 6, 'img/haberler/galeri/sinema-1.jpeg', 47),
(58, 6, 'img/haberler/galeri/sinema-2.jpeg', 48),
(59, 6, 'img/haberler/galeri/sinema-3.jpeg', 49),
(60, 6, 'img/haberler/galeri/sinema-4.jpeg', 50),
(61, 6, 'img/haberler/galeri/sinema-5.jpeg', 51),
(62, 6, 'img/haberler/galeri/sinema-6.jpeg', 52),
(63, 5, 'img/haberler/galeri/eskihisar-1.jpeg', 53),
(64, 5, 'img/haberler/galeri/eskihisar-2.jpeg', 54),
(65, 5, 'img/haberler/galeri/eskihisar-3.jpeg', 55),
(66, 5, 'img/haberler/galeri/eskihisar-4.jpeg', 56),
(67, 5, 'img/haberler/galeri/eskihisar-5.jpeg', 57),
(68, 10, 'img/haberler/galeri/yks-1.jpeg', 58),
(69, 10, 'img/haberler/galeri/yks-2.jpeg', 59),
(70, 10, 'img/haberler/galeri/yks-3.jpeg', 60),
(71, 10, 'img/haberler/galeri/yks-4.jpeg', 61),
(72, 10, 'img/haberler/galeri/yks-5.jpeg', 62),
(73, 12, 'img/haberler/galeri/kaymakam-2.jpeg', 63),
(74, 12, 'img/haberler/galeri/kaymakam-1.jpeg', 64),
(75, 12, 'img/haberler/galeri/kaymakam-3.jpeg', 65);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `haber_galeri`
--
ALTER TABLE `haber_galeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `haber_id` (`haber_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `haber_galeri`
--
ALTER TABLE `haber_galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `haber_galeri`
--
ALTER TABLE `haber_galeri`
  ADD CONSTRAINT `haber_galeri_ibfk_1` FOREIGN KEY (`haber_id`) REFERENCES `haberler` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
