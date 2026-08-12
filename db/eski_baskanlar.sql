-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 11 Ağu 2026, 08:27:58
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
-- Tablo için tablo yapısı `eski_baskanlar`
--

CREATE TABLE `eski_baskanlar` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(255) NOT NULL,
  `resim` varchar(255) DEFAULT NULL,
  `donem_baslangic` year(4) DEFAULT NULL,
  `donem_bitis` year(4) DEFAULT NULL,
  `aciklama` text DEFAULT NULL,
  `sira` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `eski_baskanlar`
--

INSERT INTO `eski_baskanlar` (`id`, `ad_soyad`, `resim`, `donem_baslangic`, `donem_bitis`, `aciklama`, `sira`) VALUES
(1, 'Adnan Köşker', 'img/eski-baskanlar/adnanKosker.jpg', '2009', '2019', NULL, 1),
(2, 'İbrahim Pehlivan', 'img/eski-baskanlar/ibrahimPehlivan.jpg', '2004', '2009', NULL, 2),
(3, 'Ahmet Penbegüllü', 'img/eski-baskanlar/ahmetPenbegullu.jpg', '1994', '2004', NULL, 3),
(4, 'Mehmet Emin Akın', 'img/eski-baskanlar/mehmetEminAkin.jpg', '1989', '1994', NULL, 4),
(5, 'Bülent Atasayan', 'img/eski-baskanlar/bulentAtasayan.jpg', '1984', '1987', NULL, 5),
(6, 'Bnb. Erol Sanver', 'img/eski-baskanlar/erolSanver.jpg', '1980', '1980', NULL, 6),
(7, 'Kubilay İlgün', 'img/eski-baskanlar/kubilayIlgun.jpg', '1980', '1983', NULL, 7),
(8, 'Sedat Tüze', 'img/eski-baskanlar/sedatTuze.jpg', '1977', '1980', NULL, 8),
(9, 'Ziya Fırat', 'img/eski-baskanlar/ziyaFirat.jpg', '1973', '1977', NULL, 9),
(10, 'Mehmet Üstündağ', 'img/eski-baskanlar/mehmetUstundag.jpg', '1963', '1973', NULL, 10),
(11, 'Selahattin Altaş', 'img/eski-baskanlar/selahattinAltas.jpg', '1960', '1963', NULL, 11),
(12, 'Hüseyin Özgen', 'img/eski-baskanlar/huseyinOzgen.jpg', '1950', '1960', NULL, 12),
(13, 'Hayri Gökçen', 'img/eski-baskanlar/hayriGokcen.jpg', '1945', '1950', NULL, 13),
(14, 'Esat Sayduk', 'img/eski-baskanlar/esatSayduk.jpg', '1939', '1945', NULL, 14),
(15, 'Ahmet Eldem', 'img/eski-baskanlar/ahmetEldem.jpg', '1935', '1939', NULL, 15),
(16, 'Lütfü Bey', 'img/eski-baskanlar/lutfuBey.jpg', '1933', '1935', NULL, 16),
(17, 'Bekir Kandilci', 'img/eski-baskanlar/bekirKandilci.jpg', '1932', '1933', NULL, 17),
(18, 'İsmail Artar', 'img/eski-baskanlar/ismailArtar.jpg', '1930', '1932', NULL, 18),
(19, 'Mustafa Zeki Toros', 'img/eski-baskanlar/mustafaZekiToros.jpg', '1928', '1930', NULL, 19),
(20, 'Arif Çavuş Söğütlü', 'img/eski-baskanlar/arifCavusSogutlu.jpg', '1926', '1928', NULL, 20),
(21, 'A. Maşar Akifoğlu', 'img/eski-baskanlar/masharAkifoglu.jpg', '1924', '1926', NULL, 21),
(22, 'İzzet Bey', 'img/eski-baskanlar/izzetBey.jpg', '1923', '1924', NULL, 22),
(23, 'Hacı Mehmet Bey', 'img/eski-baskanlar/haciMehmetBey.jpg', '1922', '1923', NULL, 23),
(24, 'Sandıkçı Hüzeyin Efe', 'img/eski-baskanlar/sandikciHuseyinEfe.jpg', '1921', '1922', NULL, 24),
(25, 'Nazmi Çavuş', 'img/eski-baskanlar/nazmiCavus.jpg', '1920', '1921', NULL, 25),
(26, 'Cerrah Apdullah Efendi', 'img/eski-baskanlar/cerrahApdullahEfendi.jpg', '1919', '1920', NULL, 26),
(27, 'Halil Akifoğlu', 'img/eski-baskanlar/halilAkifoglu.jpg', '1918', '1919', NULL, 27),
(28, 'Nalbant Kadir Usta', 'img/eski-baskanlar/kadirUsta.jpg', '1916', '1918', NULL, 28),
(29, 'Vodinalı Hafız Bey', 'img/eski-baskanlar/hafizBey.jpg', '1915', '1916', NULL, 29),
(30, 'Hafız Ali Dönmez', 'img/eski-baskanlar/hafizAliDonmez.jpg', '1914', '1915', NULL, 30),
(31, 'Sapcı Mehmet Çavuş', 'img/eski-baskanlar/sapciMehmetCavus.jpg', '1911', '1914', NULL, 31);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `eski_baskanlar`
--
ALTER TABLE `eski_baskanlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `eski_baskanlar`
--
ALTER TABLE `eski_baskanlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
