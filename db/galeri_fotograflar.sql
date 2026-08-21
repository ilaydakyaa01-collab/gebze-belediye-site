-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 21 Ağu 2026, 13:12:19
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
-- Tablo için tablo yapısı `galeri_fotograflar`
--

CREATE TABLE `galeri_fotograflar` (
  `id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `resim` varchar(255) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `galeri_fotograflar`
--

INSERT INTO `galeri_fotograflar` (`id`, `album_id`, `resim`, `sira`) VALUES
(1, 1, 'img/galeri-album/ara/kirazpinar/kirazpinar1.jpg', 1),
(2, 1, 'img/galeri-album/ara/kirazpinar/kirazpinar2.jpg', 2),
(3, 1, 'img/galeri-album/ara/kirazpinar/kirazpinar3.jpg', 3),
(4, 2, 'img/galeri-album/ara/osman/osman1.jpg', 1),
(5, 2, 'img/galeri-album/ara/osman/osman2.jpg', 2),
(6, 2, 'img/galeri-album/ara/osman/osman3.jpg', 3),
(7, 3, 'img/galeri-album/ara/ulus/ulus1.jpg', 1),
(8, 3, 'img/galeri-album/ara/ulus/ulus2.jpg', 2),
(9, 3, 'img/galeri-album/ara/ulus/ulus3.jpg', 3),
(10, 4, 'img/galeri-album/ara/selim/selim1.jpg', 1),
(11, 4, 'img/galeri-album/ara/selim/selim2.jpg', 2),
(12, 4, 'img/galeri-album/ara/selim/selim3.jpg', 3),
(13, 5, 'img/galeri-album/ara/fevzi/fecviz1.jpg', 1),
(14, 5, 'img/galeri-album/ara/fevzi/fecviz2.jpg', 2),
(15, 5, 'img/galeri-album/ara/fevzi/fecviz3.jpg', 3),
(16, 9, 'img/galeri-album/ara/adem/adem1.jpg', 1),
(17, 9, 'img/galeri-album/ara/adem/adem2.jpg', 2),
(18, 9, 'img/galeri-album/ara/adem/adem3.jpg', 3),
(19, 9, 'img/galeri-album/ara/adem/adem4.jpg', 4),
(20, 11, 'img/galeri-album/ara/temmuz/temmuz1.jpg', 1),
(21, 11, 'img/galeri-album/ara/temmuz/temmuz2.jpg', 2),
(22, 11, 'img/galeri-album/ara/temmuz/temmuz3.jpg', 4),
(23, 11, 'img/galeri-album/ara/temmuz/temmuz3.jpg', 4),
(24, 12, 'img/galeri-album/ara/nikah/nikah1.jpg', 1),
(25, 12, 'img/galeri-album/ara/nikah/nikah2.jpg', 2),
(26, 1, 'img/galeri-album/ara/kirazpinar/kirazpinar4.jpg', 4),
(27, 1, 'img/galeri-album/ara/kirazpinar/kirazpinar5.jpg', 5);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `galeri_fotograflar`
--
ALTER TABLE `galeri_fotograflar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_id` (`album_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `galeri_fotograflar`
--
ALTER TABLE `galeri_fotograflar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `galeri_fotograflar`
--
ALTER TABLE `galeri_fotograflar`
  ADD CONSTRAINT `galeri_fotograflar_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `galeri_albumler` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
