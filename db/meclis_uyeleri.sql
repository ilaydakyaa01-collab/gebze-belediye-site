-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 Ağu 2026, 13:39:05
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
-- Tablo için tablo yapısı `meclis_uyeleri`
--

CREATE TABLE `meclis_uyeleri` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) NOT NULL,
  `unvan` varchar(100) NOT NULL DEFAULT 'Meclis Üyesi',
  `resim` varchar(255) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0,
  `baskan_mi` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `meclis_uyeleri`
--

INSERT INTO `meclis_uyeleri` (`id`, `ad`, `unvan`, `resim`, `sira`, `baskan_mi`) VALUES
(1, 'Zinnur BÜYÜKGÖZ', 'Belediye Başkanı', 'img/baskan-ozgecmis.jpg', 0, 1),
(2, 'Hasan SOBA', 'Meclis Üyesi', 'img/meclis/hasan-soba.jpg', 1, 0),
(3, 'Mahmut YANDIK', 'Meclis Üyesi', 'img/meclis/mahmut-yandik.jpg', 2, 0),
(4, 'Mustafa DEMİRHAN', 'Meclis Üyesi', 'img/meclis/mustafa-demirhan.jpg', 3, 0),
(5, 'Ömer Cihan KAVAK', 'Meclis Üyesi', 'img/meclis/omer-cihan-kavak.jpg', 4, 0),
(6, 'Habibe ÇIRAK', 'Meclis Üyesi', 'img/meclis/habibe-cirak.jpg', 5, 0),
(7, 'Selim MALKOÇ', 'Meclis Üyesi', 'img/meclis/selim-malkoc.jpg', 6, 0),
(8, 'Mehmet Fatih İŞLEK', 'Meclis Üyesi', 'img/meclis/mehmet-fatih-islek.jpg', 7, 0),
(9, 'Talip DEMİR', 'Meclis Üyesi', 'img/meclis/talip-demir.jpg', 8, 0),
(10, 'Azim UYSAL', 'Meclis Üyesi', 'img/meclis/azim-uysal.jpg', 9, 0),
(11, 'Efari BAHÇEVAN', 'Meclis Üyesi', 'img/meclis/efari-bahcevan.jpg', 10, 0),
(12, 'Güler ŞAHİN GENCAY', 'Meclis Üyesi', 'img/meclis/guler-sahin-gencay.jpg', 11, 0),
(13, 'Selamet GÜNER', 'Meclis Üyesi', 'img/meclis/selamet-guner.jpg', 12, 0),
(14, 'Birgül TOKMAK', 'Meclis Üyesi', 'img/meclis/birgul-tokmak.jpg', 13, 0),
(15, 'Mustafa DEMİR', 'Meclis Üyesi', 'img/meclis/mustafa-demir.jpg', 14, 0),
(16, 'Mustafa ÖNAL', 'Meclis Üyesi', 'img/meclis/mustafa-onal.jpg', 15, 0),
(17, 'Ayhan YILMAZ', 'Meclis Üyesi', 'img/meclis/ayhan-yilmaz.jpg', 16, 0),
(18, 'Vasfiye AYDIN', 'Meclis Üyesi', 'img/meclis/vasfiye-aydin.jpg', 17, 0),
(19, 'Şener AKIN', 'Meclis Üyesi', 'img/meclis/sener-akin.jpg', 18, 0),
(20, 'Mehmet DİNÇ', 'Meclis Üyesi', 'img/meclis/mehmet-dinc.jpg', 19, 0),
(21, 'Okan ŞEN', 'Meclis Üyesi', 'img/meclis/okan-sen.jpg', 20, 0),
(22, 'Halil AYTAÇ', 'Meclis Üyesi', 'img/meclis/halil-aytac.jpg', 21, 0),
(23, 'Osman SEZER', 'Meclis Üyesi', 'img/meclis/osman-sezer.jpg', 22, 0),
(24, 'Mustafa ATEŞ', 'Meclis Üyesi', 'img/meclis/mustafa-ates.jpg', 23, 0),
(25, 'Hasan ÖZDEMİR', 'Meclis Üyesi', 'img/meclis/hasan-ozdemir.jpg', 24, 0),
(26, 'Emrullah BİLGİN', 'Meclis Üyesi', 'img/meclis/emrullah-bilgin.jpg', 25, 0),
(27, 'Hüseyin ÖNDER', 'Meclis Üyesi', 'img/meclis/huseyin-onder.jpg', 26, 0),
(28, 'İrfan İRTEGÜN', 'Meclis Üyesi', 'img/meclis/irfan-irtegun.jpg', 27, 0),
(29, 'Ahmet KADI', 'Meclis Üyesi', 'img/meclis/ahmet-kadi.jpg', 28, 0),
(30, 'Gülcan AKSU', 'Meclis Üyesi', 'img/meclis/gulcan-aksu.jpg', 29, 0),
(31, 'Engin SÖZBİR', 'Meclis Üyesi', 'img/meclis/engin-sozbir.jpg', 30, 0),
(32, 'Ferman TORUN', 'Meclis Üyesi', 'img/meclis/ferman-torun.jpg', 31, 0),
(33, 'Nuran GÖKDEMİR', 'Meclis Üyesi', 'img/meclis/nuran-gokdemir.jpg', 32, 0),
(34, 'Birol ELÜSTÜ', 'Meclis Üyesi', 'img/meclis/birol-elustu.jpg', 33, 0),
(35, 'Zeynep ASLAN ÇAPÇI', 'Meclis Üyesi', 'img/meclis/zeynep-aslan-capci.png', 34, 0),
(36, 'Yunus Umut AYDOĞDU', 'Meclis Üyesi', 'img/meclis/yunus-umut-aydogdu.png', 35, 0),
(37, 'Hakan KAHRAMAN', 'Meclis Üyesi', 'img/meclis/hakan-kahraman.jpg', 36, 0),
(38, 'Hüseyin KATI', 'Meclis Üyesi', 'img/meclis/huseyin-kati.jpg', 37, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `meclis_uyeleri`
--
ALTER TABLE `meclis_uyeleri`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `meclis_uyeleri`
--
ALTER TABLE `meclis_uyeleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
