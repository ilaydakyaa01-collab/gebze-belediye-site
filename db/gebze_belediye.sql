-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 06 Ağu 2026, 07:50:21
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
-- Tablo için tablo yapısı `haberler`
--

CREATE TABLE `haberler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `icerik` text NOT NULL,
  `resim` varchar(255) NOT NULL,
  `tarih` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `haberler`
--

INSERT INTO `haberler` (`id`, `baslik`, `icerik`, `resim`, `tarih`) VALUES
(1, 'Gebze\'de Yeni Park Açıldı.', 'Gebze Belediyesi tarafından yapılan yeni park bugün hizmete açıldı\r\n', 'img/haberler/haber-3.jpg', '2026-08-05 10:00:00'),
(3, 'Başkan Büyükgözden Mecliste Müjde', 'Belediye meclisi toplantısında vatandaşları ilgilendiren önemli kararlar alındı.', 'img/haberler/haber-1.jpg', '2026-08-05 09:00:00'),
(4, 'Yeni Kültür Merkezi Hizmete Girdi', 'Gebze genelinde vatandaşların kullanımına yeni bir kültür merkezi açıldı.', 'img/haberler/haber-4.jpg', '2026-08-04 10:30:00'),
(5, 'Eskihisar Millet Bahçesinde Buluşma', 'Başkan, vatandaşlarla birlikte park alanında bir araya geldi.', 'img/haberler/haber-3.jpg', '2026-08-04 14:00:00'),
(6, 'Mahallemde Sinema Etkinliği Devam Ediyor', 'Yaz aylarında düzenlenen açık hava sinema etkinlikleri ilgiyle takip ediliyor.', 'img/haberler/haber-4.jpg', '2026-08-03 18:00:00'),
(7, 'Gebzespor Kampa Girdi', 'Takım, yeni sezon hazırlıkları kapsamında kampa başladı.', 'img/haberler/haber-6.jpg', '2026-07-31 16:00:00'),
(8, 'Yeni Spor Kompleksi Tamamlandı', 'Vatandaşların ücretsiz kullanımına açılan spor tesisleri büyük ilgi gördü.', 'img/haberler/haber-6.jpg', '2026-07-30 12:00:00'),
(9, 'Kaymakamlık Ziyareti Gerçekleşti', 'Belediye başkanı, hayırlı olsun ziyaretinde bulundu.', 'img/haberler/haber-2.jpg', '2026-07-29 11:00:00'),
(10, 'Çevre Düzenleme Çalışmaları Sürüyor', 'Şehir genelinde yeşil alan ve park çalışmaları hızla devam ediyor.', 'img/haberler/haber-3.jpg', '2026-07-28 09:30:00'),
(11, 'Engelli Vatandaşlara Yönelik Proje Başladı', 'Erişilebilirlik projeleri kapsamında yeni adımlar atıldı.', 'img/haberler/haber-5.jpg', '2026-07-27 13:00:00'),
(12, 'Belediyeden Öğrencilere Destek', 'Yeni eğitim döneminde öğrencilere kırtasiye desteği sağlanacak.', 'img/haberler/haber-5.jpg', '2026-07-26 10:00:00');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `haberler`
--
ALTER TABLE `haberler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `haberler`
--
ALTER TABLE `haberler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
