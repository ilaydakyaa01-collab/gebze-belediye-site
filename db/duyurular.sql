-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 21 Ağu 2026, 13:09:57
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
-- Tablo için tablo yapısı `duyurular`
--

CREATE TABLE `duyurular` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `resim` varchar(255) NOT NULL DEFAULT 'img/duyurular/duyuru.png',
  `dosya` varchar(255) DEFAULT NULL,
  `belge_adi` varchar(255) DEFAULT NULL,
  `tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `duyurular`
--

INSERT INTO `duyurular` (`id`, `baslik`, `resim`, `dosya`, `belge_adi`, `tarih`) VALUES
(1, 'ARAÇ KİRALAMA HİZMETİ ALINACAKTIR', 'img/duyurular/duyuru.png', 'dosya/duyurular/arac-kiralama.docx', 'ARAÇ KİRALAMA HİZMETİ İLAN METNİ', '2026-08-19'),
(2, 'ARAÇ KİRALAMA HİZMETİ ALINACAKTIR', 'img/duyurular/duyuru.png', 'dosya/duyurular/arac-kiralama-alimi.docx', 'ARAÇ KİRALAMA HİZMETİ ALIMI İLAN METNİ', '2026-08-19'),
(3, 'YIKIM İŞLERİ YAPTIRILACAKTIR', 'img/duyurular/duyuru.png', 'dosya/duyurular/yikim-islemleri.docx', 'YIKIM İŞLERİ YAPTIRILACAKTIR', '2026-07-29'),
(4, 'Duraklı Mahallesi Yerleşik ve Gelişim Alanları İmar Uygulaması 2. Askı İlanı', 'img/duyurular/duyuru.png', 'dosya/duyurular/duzenleme-siniri.pdf', 'Düzenleme Sınırı', '2026-08-14'),
(5, 'ARAÇ KİRALAMA HİZMETİ ALINACAKTIR', 'img/duyurular/duyuru.png', 'dosya/duyurular/arac-5.docx', 'ARAÇ KİRALAMA HİZMETİ İLAN METNİ', '2026-08-05'),
(6, 'İmar Plan İlanı', 'img/duyurular/duyuru.png', 'dosya/duyurular/imar-plani.pdf', 'Askı İlan Tutanağı', '2026-07-22'),
(9, 'İmar Plan İlanı', 'img/duyurular/duyuru.png', 'dosya/duyurular/imar-1.pdf', 'İmar Plan İlan Metni', '2026-08-19'),
(10, 'İmar Plan İlanı', 'img/duyurular/duyuru.png', 'dosya/duyurular/imar-2.pdf', 'İmar Plan İlan Metni', '2026-08-19');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `duyurular`
--
ALTER TABLE `duyurular`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `duyurular`
--
ALTER TABLE `duyurular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
