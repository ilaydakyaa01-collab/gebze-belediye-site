-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 13 Ağu 2026, 11:26:17
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
-- Tablo için tablo yapısı `hizmet_dokumanlari`
--

CREATE TABLE `hizmet_dokumanlari` (
  `id` int(11) NOT NULL,
  `hizmet_id` int(11) NOT NULL,
  `dosya_adi` varchar(200) NOT NULL,
  `dosya_yolu` varchar(255) NOT NULL,
  `dosya_boyutu` varchar(20) DEFAULT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `hizmet_dokumanlari`
--

INSERT INTO `hizmet_dokumanlari` (`id`, `hizmet_id`, `dosya_adi`, `dosya_yolu`, `dosya_boyutu`, `sira`) VALUES
(3, 35, 'Ambalaj Atıkları Toplama Gün Ve Saatleri', 'dosya/dokumanlar/ambalaj-atiklari-toplama-gun-ve-saatleri.jpg', '523KB', 1),
(4, 35, 'Hedef Sıfır Atık Broşürü', 'dosya/dokumanlar/hedef-sifir-atik-brosuru.pdf', '30,6 MB', 2),
(5, 17, 'Hedef Sıfır Atık Broşürü', 'dosya/dokumanlar/hedef-sifir-atik-brosuru.pdf', '30,6 MB', 1),
(6, 18, 'Evlendirme Başvuru Belgesi', 'dosya/dokumanlar/evlendirme.docx', NULL, 1),
(7, 36, 'Hedef Sıfır Atık Broşürü', 'dosya/dokumanlar/hedef-sifir-atik-brosuru.pdf', '29.2 MB', 1),
(8, 37, 'Hedef Sıfır Atık Broşürü', 'dosya/dokumanlar/hedef-sifir-atik-brosuru.pdf', '29.2 MB', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `hizmet_dokumanlari`
--
ALTER TABLE `hizmet_dokumanlari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hizmet_id` (`hizmet_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `hizmet_dokumanlari`
--
ALTER TABLE `hizmet_dokumanlari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `hizmet_dokumanlari`
--
ALTER TABLE `hizmet_dokumanlari`
  ADD CONSTRAINT `fk_hizmet_dokumanlari_hizmet` FOREIGN KEY (`hizmet_id`) REFERENCES `hizmet_listesi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
