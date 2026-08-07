-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 Ağu 2026, 11:21:40
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
-- Tablo için tablo yapısı `hero_slaytlar`
--

CREATE TABLE `hero_slaytlar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `aciklama` varchar(255) NOT NULL,
  `resim` varchar(255) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hero_slaytlar`
--

INSERT INTO `hero_slaytlar` (`id`, `baslik`, `aciklama`, `resim`, `sira`) VALUES
(1, 'Şehrimize değer katan hizmetler', 'Şeffaf, katılımcı ve modern belediyecilik.', 'img/haberler/haber3.jpg', 1),
(2, 'Katılımcı ve şeffaf yönetim', 'Gebze için birlikte üretiyoruz.', 'img/haberler/haber4.jpg', 2),
(3, 'Yeşil alanlar, kültür ve spor', 'Yaşanabilir bir Gebze için çalışıyoruz.', 'img/haberler/haber1.jpg', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hizmetler`
--

CREATE TABLE `hizmetler` (
  `id` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `baslik` varchar(100) NOT NULL,
  `href` varchar(255) NOT NULL DEFAULT '#',
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hizmetler`
--

INSERT INTO `hizmetler` (`id`, `icon`, `baslik`, `href`, `sira`) VALUES
(1, 'bi-laptop', 'E-Belediye', '#', 1),
(2, 'bi-file-earmark-text', 'Başvuru', '#', 2),
(3, 'bi-buildings', 'İmar', '#', 3),
(4, 'bi-capsule-pill', 'Eczane', '#', 4),
(5, 'bi-bus-front', 'Ulaşım', '#', 5),
(6, 'bi-headset', 'Alo 153', '#', 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `videolar`
--

CREATE TABLE `videolar` (
  `id` int(11) NOT NULL,
  `youtube_id` varchar(50) NOT NULL,
  `baslik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `videolar`
--

INSERT INTO `videolar` (`id`, `youtube_id`, `baslik`) VALUES
(1, 'qLqYPQgUPEc', 'Gebze Offroad Heyecanı'),
(2, 'aUQ3uIAfL-k', 'Türkiye\'nin Sıfır Atık Kenti Bilgilendiriyor'),
(3, 'RhVDYrAb0xQ', 'Gebze #shorts'),
(4, 'c0vbYSFwMzU', 'Gebze Belediyesi MBB Altın Karınca Yarışması Dijital Kapı Projesi'),
(5, '-0Wxna6PjqQ', 'Vatandaşlarımızın Hayatını Kolaylaştırıyoruz'),
(6, 'e65zC48s8Wc', 'Çocuklarımızı Da Elbette Unutmadık'),
(7, 'YXat3fIWc7w', 'İnteraktif Belediyecilikle Gebze\'de artık her şey çok kolay...'),
(8, 'QRizu8RhGnU', 'Dijital Belediye İnteraktif Yaklaşım'),
(9, 'Z2dH2UIXb8Y', 'Zeki Bey\'in \'interaktif\' macerası başlıyor...'),
(10, 'G2KNC3OAnjE', 'Türkiye Aşkına'),
(11, 'RhD1ArYsuKo', 'Türkiye\'nin 7/24 hizmet veren ilk ve tek bebek & çocuk bakımevini Gebze\'mizde hizmete açtık'),
(12, 'IEc5W0JyADU', 'Gesmek Sergimiz'),
(13, '3ePuzpC2S0Q', 'Eskihisarda Müzik Rüzgarı'),
(14, 'qdPXmtKXXc4', 'Yapım işini tamamladığımız İlyasbey Sağlıklı Yaşam Merkezi \'miz'),
(15, 'uUFZvM9kqf4', 'Marmara\'nın İncisi Eskihisar\'da,30 bin metrekare yakın hayalet ağ çıkaracağız'),
(16, 'BiY2WK24UHY', 'Şehirler Arası Otobüs Terminalimizin işlevselliğini artırıyoruz'),
(17, 'xot-DBvkkq4', 'Matematik, Edebiyat Sınıfları ve modern derslikler gençliğin Güzide Merkezinde...'),
(18, 'ABIqjRnV5dU', 'Cam Şişe Bırakma, Ormanlarımız Hep Yaşasın!'),
(19, 'psmlNSPRDsM', 'Türkiye Panorama II'),
(20, 'pAHStsCd9jo', 'E Atık | Kent Madenciliği'),
(21, 'eUBQYWMZyH8', 'Atık Sonu | End of Waste'),
(22, 'GWfDmGr6tlg', 'Gebze\'yi Sağlama Aldık'),
(23, 'D1b-CZYtCTg', 'Gebzeli CEZA');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `hero_slaytlar`
--
ALTER TABLE `hero_slaytlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hizmetler`
--
ALTER TABLE `hizmetler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `videolar`
--
ALTER TABLE `videolar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_videolar_youtube_id` (`youtube_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `hero_slaytlar`
--
ALTER TABLE `hero_slaytlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `hizmetler`
--
ALTER TABLE `hizmetler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `videolar`
--
ALTER TABLE `videolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
