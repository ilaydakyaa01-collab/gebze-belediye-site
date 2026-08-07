-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Ağu 2026, 14:07:01
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
-- Tablo için tablo yapısı `duyurular`
--

CREATE TABLE `duyurular` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `resim` varchar(255) NOT NULL DEFAULT 'img/duyurular/duyuru.png',
  `tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `duyurular`
--

INSERT INTO `duyurular` (`id`, `baslik`, `resim`, `tarih`) VALUES
(1, 'ARAÇ KİRALAMA HİZMETİ ALINACAKTIR', 'img/duyurular/duyuru.png', '2026-08-05'),
(2, 'Toner, Drum, Atık Toner Kutusu Ve Yedek Parça Satın Alınacaktır', 'img/duyurular/duyuru.png', '2026-08-03'),
(3, 'YIKIM İŞLERİ YAPTIRILACAKTIR', 'img/duyurular/duyuru.png', '2026-07-29'),
(4, 'GENÇLİK MERKEZİ ÇATI TADİLATI İMALATLARI YAPIM İŞİ İHALE İLANI', 'img/duyurular/duyuru.png', '2026-07-24'),
(5, 'CUMHURİYET MEYDANI YERALTI ÇARŞISI YAPIM İŞİ İHALE İLANI', 'img/duyurular/duyuru.png', '2026-07-24'),
(6, 'İmar Plan İlanı', 'img/duyurular/duyuru.png', '2026-07-22'),
(7, 'İmar Plan İlanı', 'img/duyurular/duyuru.png', '2026-07-14'),
(8, 'Metruk Yapı İlanı (3986 Ada, 4 Parsel)', 'img/duyurular/duyuru.png', '2026-07-10');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `etkinlikler`
--

CREATE TABLE `etkinlikler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `renk` varchar(20) NOT NULL DEFAULT '#1a7ae4',
  `tarih` date NOT NULL,
  `saat` varchar(10) NOT NULL,
  `yer` varchar(255) NOT NULL,
  `resim` varchar(255) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `etkinlikler`
--

INSERT INTO `etkinlikler` (`id`, `baslik`, `kategori`, `renk`, `tarih`, `saat`, `yer`, `resim`, `sira`) VALUES
(1, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-06', '20:00', 'Orhangazi İlkokulu', 'img/etkinlikler/etkinlik1.jpg', 1),
(2, 'Gebzede Müziğin Ritmi', 'Konser', '#1a7ae4', '2026-08-07', '20:00', 'Eskihisar Kale Altı', 'img/etkinlikler/etkinlik2.jpg', 2),
(3, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-07', '20:00', 'Gebze Millet Bahçesi', 'img/etkinlikler/etkinlik3.jpg', 3),
(4, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-08', '20:00', '15 Temmuz Milli İrade Kent Meydanı', 'img/etkinlikler/etkinlik4.jpg', 4),
(5, 'Gebze 2. Drift Festivali', 'Özel Program', '#6b7280', '2026-08-09', '16:00', 'Mevlana Kapalı Pazar Yeri', 'img/etkinlikler/etkinlik5.jpg', 5),
(6, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-09', '20:00', 'Şehit İlker Ağçay İlkokulu', 'img/etkinlikler/etkinlik6.jpg', 6),
(7, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-10', '20:00', 'Atatürk İlkokulu', 'img/etkinlikler/etkinlik7.jpg', 7),
(8, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-11', '20:00', 'Mehmet Akif Ersoy İlköğretim Okulu', 'img/etkinlikler/etkinlik8.jpg', 8),
(9, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-12', '20:00', 'İstasyon Bilim Sanat Merkezi', 'img/etkinlikler/etkinlik9.jpg', 9),
(10, 'Mahallemde Sinema Var', 'Çocuk Sineması', '#e91e8c', '2026-08-13', '20:00', 'Emlak Konutları İlköğretim Okulu', 'img/etkinlikler/etkinlik10.jpg', 10),
(11, 'Gebzede Müziğin Ritmi', 'Konser', '#1a7ae4', '2026-08-14', '20:00', 'Gebze Millet Bahçesi', 'img/etkinlikler/etkinlik11.jpg', 11);

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
(1, 'Başkan Büyükgöz\'den Mecliste Müjde', '', 'img/haberler/haber1.jpg', '2026-08-05 10:00:00'),
(2, 'Başkan Büyükgöz\'den Kaymakam Özyiğit\'e Hayırlı Olsun Ziyareti', '', 'img/haberler/haber2.jpg', '2026-08-04 14:00:00'),
(3, 'Başkan Büyükgöz, Eskihisar Millet Bahçesi ve Botanik Parkı\'nda Vatandaşlarla Bir Araya Geldi', '', 'img/haberler/haber3.jpg', '2026-08-04 12:00:00'),
(4, 'Mahallemde Sinema Var Tam Gaz Devam Ediyor', '', 'img/haberler/haber4.jpg', '2026-08-04 10:00:00'),
(5, 'Başkan Büyükgöz, TDBB Yönetim Kurulu Toplantısı\'na Katıldı', '', 'img/haberler/haber5.jpg', '2026-07-31 16:00:00'),
(6, 'Başkan Büyükgöz Gebzespor\'un Bolu Kampında', '', 'img/haberler/haber6.jpg', '2026-07-31 14:00:00'),
(7, 'Gebze Belediyesi Asfalt Serim Çalışmalarına Devam Ediyor', '', 'img/haberler/haber7.jpg', '2026-07-31 11:00:00'),
(8, 'Başkan Büyükgöz Yaz Okulu Öğrencileriyle Buluştu', '', 'img/haberler/haber8.jpg', '2026-07-30 12:00:00'),
(9, 'Gebze Belediyesi\'nden Kamu Kurumlarına Bir Hizmet Yatırımı Daha', '', 'img/haberler/haber9.jpg', '2026-07-29 14:00:00'),
(10, 'Mahallemde Sinema Var Başladı', '', 'img/haberler/haber10.jpg', '2026-07-29 10:00:00'),
(11, 'Başkan Büyükgöz\'den Köy Ziyaretleri', '', 'img/haberler/haber11.jpg', '2026-07-27 16:00:00'),
(12, 'Uluslararası Gebze Grand Prix Tamamlandı', '', 'img/haberler/haber12.jpg', '2026-07-27 14:00:00'),
(13, 'Eskihisar Kalesi\'nde Çocukların Akşamı', '', 'img/haberler/haber13.jpg', '2026-07-27 10:00:00'),
(14, 'Asfalt Çalışmaları Aralıksız Sürüyor', '', 'img/haberler/haber14.jpg', '2026-07-22 10:00:00');

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
-- Tablo için tablo yapısı `projeler`
--

CREATE TABLE `projeler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `durum` enum('devam','tamamlanan','planlanan') NOT NULL DEFAULT 'devam',
  `resim` varchar(255) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `projeler`
--

INSERT INTO `projeler` (`id`, `baslik`, `durum`, `resim`, `sira`) VALUES
(1, 'Kültürel ve Sosyal Etkinlikler', 'devam', 'img/projeler/projeler1.webp', 1),
(2, 'Eskihisar Kalesi Kültür ve Sanat Akşamları', 'devam', 'img/projeler/projeler2.webp', 2),
(3, '41 Genç', 'devam', 'img/projeler/projeler3.webp', 3),
(4, 'Driftfest', 'devam', 'img/projeler/projeler4.webp', 4),
(5, 'Hayvan Satış Alanı ve Kesimhane', 'tamamlanan', 'img/projeler/projeler5.webp', 5),
(6, 'Veri Merkezi', 'tamamlanan', 'img/projeler/projeler6.webp', 6),
(7, 'Yüksek Hızda İnternet Bağlantısı Hizmeti', 'planlanan', 'img/projeler/projeler7.webp', 7),
(8, 'Akıllı Şehir', 'planlanan', 'img/projeler/projeler8.webp', 8);

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
-- Tablo için indeksler `duyurular`
--
ALTER TABLE `duyurular`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `etkinlikler`
--
ALTER TABLE `etkinlikler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `haberler`
--
ALTER TABLE `haberler`
  ADD PRIMARY KEY (`id`);

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
-- Tablo için indeksler `projeler`
--
ALTER TABLE `projeler`
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
-- Tablo için AUTO_INCREMENT değeri `duyurular`
--
ALTER TABLE `duyurular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `etkinlikler`
--
ALTER TABLE `etkinlikler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `haberler`
--
ALTER TABLE `haberler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- Tablo için AUTO_INCREMENT değeri `projeler`
--
ALTER TABLE `projeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `videolar`
--
ALTER TABLE `videolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
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
