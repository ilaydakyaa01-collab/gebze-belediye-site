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



-- Belediye Meclisi Üyeleri tablosu
-- phpMyAdmin > gebze_belediye veritabanı > İçe Aktar sekmesinden bu dosyayı yükle
-- NOT: resim sütunu artık yerel dosya yollarını (img/... ) tutuyor,
-- fotoğrafları img/meclis/ klasörüne o isimlerle koymuş olman gerekiyor.

CREATE TABLE `meclis_uyeleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(100) NOT NULL,
  `unvan` varchar(100) NOT NULL DEFAULT 'Meclis Üyesi',
  `resim` varchar(255) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0,
  `baskan_mi` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `meclis_uyeleri` (`ad`, `unvan`, `resim`, `sira`, `baskan_mi`) VALUES
('Zinnur BÜYÜKGÖZ', 'Belediye Başkanı', 'img/baskan-ozgecmis.jpg', 0, 1),
('Hasan SOBA', 'Meclis Üyesi', 'img/meclis/hasan-soba.jpg', 1, 0),
('Mahmut YANDIK', 'Meclis Üyesi', 'img/meclis/mahmut-yandik.jpg', 2, 0),
('Mustafa DEMİRHAN', 'Meclis Üyesi', 'img/meclis/mustafa-demirhan.jpg', 3, 0),
('Ömer Cihan KAVAK', 'Meclis Üyesi', 'img/meclis/omer-cihan-kavak.jpg', 4, 0),
('Habibe ÇIRAK', 'Meclis Üyesi', 'img/meclis/habibe-cirak.jpg', 5, 0),
('Selim MALKOÇ', 'Meclis Üyesi', 'img/meclis/selim-malkoc.jpg', 6, 0),
('Mehmet Fatih İŞLEK', 'Meclis Üyesi', 'img/meclis/mehmet-fatih-islek.jpg', 7, 0),
('Talip DEMİR', 'Meclis Üyesi', 'img/meclis/talip-demir.jpg', 8, 0),
('Azim UYSAL', 'Meclis Üyesi', 'img/meclis/azim-uysal.jpg', 9, 0),
('Efari BAHÇEVAN', 'Meclis Üyesi', 'img/meclis/efari-bahcevan.jpg', 10, 0),
('Güler ŞAHİN GENCAY', 'Meclis Üyesi', 'img/meclis/guler-sahin-gencay.jpg', 11, 0),
('Selamet GÜNER', 'Meclis Üyesi', 'img/meclis/selamet-guner.jpg', 12, 0),
('Birgül TOKMAK', 'Meclis Üyesi', 'img/meclis/birgul-tokmak.jpg', 13, 0),
('Mustafa DEMİR', 'Meclis Üyesi', 'img/meclis/mustafa-demir.jpg', 14, 0),
('Mustafa ÖNAL', 'Meclis Üyesi', 'img/meclis/mustafa-onal.jpg', 15, 0),
('Ayhan YILMAZ', 'Meclis Üyesi', 'img/meclis/ayhan-yilmaz.jpg', 16, 0),
('Vasfiye AYDIN', 'Meclis Üyesi', 'img/meclis/vasfiye-aydin.jpg', 17, 0),
('Şener AKIN', 'Meclis Üyesi', 'img/meclis/sener-akin.jpg', 18, 0),
('Mehmet DİNÇ', 'Meclis Üyesi', 'img/meclis/mehmet-dinc.jpg', 19, 0),
('Okan ŞEN', 'Meclis Üyesi', 'img/meclis/okan-sen.jpg', 20, 0),
('Halil AYTAÇ', 'Meclis Üyesi', 'img/meclis/halil-aytac.jpg', 21, 0),
('Osman SEZER', 'Meclis Üyesi', 'img/meclis/osman-sezer.jpg', 22, 0),
('Mustafa ATEŞ', 'Meclis Üyesi', 'img/meclis/mustafa-ates.jpg', 23, 0),
('Hasan ÖZDEMİR', 'Meclis Üyesi', 'img/meclis/hasan-ozdemir.jpg', 24, 0),
('Emrullah BİLGİN', 'Meclis Üyesi', 'img/meclis/emrullah-bilgin.jpg', 25, 0),
('Hüseyin ÖNDER', 'Meclis Üyesi', 'img/meclis/huseyin-onder.jpg', 26, 0),
('İrfan İRTEGÜN', 'Meclis Üyesi', 'img/meclis/irfan-irtegun.jpg', 27, 0),
('Ahmet KADI', 'Meclis Üyesi', 'img/meclis/ahmet-kadi.jpg', 28, 0),
('Gülcan AKSU', 'Meclis Üyesi', 'img/meclis/gulcan-aksu.jpg', 29, 0),
('Engin SÖZBİR', 'Meclis Üyesi', 'img/meclis/engin-sozbir.jpg', 30, 0),
('Ferman TORUN', 'Meclis Üyesi', 'img/meclis/ferman-torun.jpg', 31, 0),
('Nuran GÖKDEMİR', 'Meclis Üyesi', 'img/meclis/nuran-gokdemir.jpg', 32, 0),
('Birol ELÜSTÜ', 'Meclis Üyesi', 'img/meclis/birol-elustu.jpg', 33, 0),
('Zeynep ASLAN ÇAPÇI', 'Meclis Üyesi', 'img/meclis/zeynep-aslan-capci.png', 34, 0),
('Yunus Umut AYDOĞDU', 'Meclis Üyesi', 'img/meclis/yunus-umut-aydogdu.png', 35, 0),
('Hakan KAHRAMAN', 'Meclis Üyesi', 'img/meclis/hakan-kahraman.jpg', 36, 0),
('Hüseyin KATI', 'Meclis Üyesi', 'img/meclis/huseyin-kati.jpg', 37, 0);
