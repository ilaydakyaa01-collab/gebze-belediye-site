-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 11 Ağu 2026, 13:50:30
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
-- Tablo için tablo yapısı `yayinlar`
--

CREATE TABLE `yayinlar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `kapak_resim` varchar(255) DEFAULT NULL,
  `dosya` varchar(255) DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `sira` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `yayinlar`
--

INSERT INTO `yayinlar` (`id`, `baslik`, `kategori`, `kapak_resim`, `dosya`, `tarih`, `sira`) VALUES
(1, 'Söz Verdiğimiz Gibi', 'Gebze Belediyesi Projeleri', 'img/yayinlar/yayin-default.png', 'dosya/yayinlar/soz-verdigimiz-gibi.pdf', '2026-01-02', 1),
(2, 'Gebze Manşet', 'Gebze Manşet', 'img/yayinlar/yayin-default.png', 'dosya/yayinlar/gebze-manset.pdf', '2026-01-02', 2),
(3, 'Fatih Sultan Mehmed Dönemi Ferman ve Arşiv Belgeleri', 'Kültür Yayınları', 'img/yayinlar/yayin-default.png', 'dosya/yayinlar/fatih-sultan-mehmed.pdf', '2025-12-15', 3),
(4, 'Çoban Mustafa Paşa Külliyesi 2', 'Kültür Yayınları', 'img/yayinlar/yayin-default.png', 'dosya/yayinlar/coban-mustafa-pasa-kulliyesi-2.pdf', '2025-12-01', 4),
(5, 'Çoban Mustafa Paşa Külliyesi 1', 'Kültür Yayınları', 'img/yayinlar/yayin-default.png', 'dosya/yayinlar/coban-mustafa-pasa-kulliyesi-1.pdf', '2025-11-15', 5);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `yayinlar`
--
ALTER TABLE `yayinlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `yayinlar`
--
ALTER TABLE `yayinlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
