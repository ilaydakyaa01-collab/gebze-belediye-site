-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Ağu 2026, 15:00:03
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

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
-- Tablo için tablo yapısı `projeler`
--

CREATE TABLE `projeler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `aciklama` text DEFAULT NULL,
  `resim` varchar(255) DEFAULT NULL,
  `durum` varchar(50) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `projeler`
--

INSERT INTO `projeler` (`id`, `baslik`, `aciklama`, `resim`, `durum`, `kategori_id`, `tarih`, `created_at`) VALUES
(1, 'Kültür ve Sanat Sosyal Etkinlikler', 'Kültür ve sosyal etkinlikler kapsamında gerçekleştirdiğimiz; 2019-2023 yılları arasında düzenlediğimiz 1.416 etkinlikte toplam 529.719 vatandaşımızı misafir ettik. \r\n\r\n', 'img/projeler/proje1.webp', 'Devam Eden', 6, NULL, '2026-08-06 12:00:28'),
(2, 'Eskihisar Kalesi Kültür ve Sanat Akşamları\r\n', 'Eskihisar Kalesi’nde gerçekleştirdiğimiz; 38 kültür ve sanat programında 28.550 hemşehrimizi misafir ettik. ', 'img/projeler/proje2.webp', 'Devam Eden', 6, NULL, '2026-08-06 12:02:15'),
(3, 'UCLG- MEWA', 'UCLG-MEWA, Akıllı Yaşam Alanları ve Akıllı Şehirlerin İklim Değişikliği ile Mücadeledeki Rolü konulu toplantılarını Gebze Belediyesi ev sahipliğinde gerçekleştirdi.\r\n\r\n', 'img/projeler/proje3.webp', 'Tamamlanan', 5, NULL, '2026-08-06 12:03:42'),
(4, '41 Genç\r\n', 'Geleceğin liderlerini yetiştirmek amacıyla başlattığımız projemiz ile; 4 yılda 205 gencimizin hayatına dokunduk. Projeye katılan öğrencilerimiz, 1 yıl boyunca ülkemizin önemli eğitim, bilim, teknoloji ve sanat merkezlerinde oryantasyon eğitimleri aldılar.\r\n\r\n', 'img/projeler/proje4.webp', 'Devam Eden', 4, NULL, '2026-08-06 12:04:47'),
(5, 'Driftfest', 'Gebze’de ilk kez; 6 profesyonel drift pilotu ve gerçek yarış aracı ile gösteri yaptı. Alanda 5.000 ziyaretçi ağırladık.', 'img/projeler/proje5.webp', 'Devam Eden', 4, NULL, '2026-08-06 12:20:25'),
(6, 'Gebze Olimpik Spor Kompleksi\r\n', 'Kocaeli Büyükşehir Belediyesi iş birliğiyle; 55.906 m² alanda 7.500 kişi kapasiteli; basketbol, voleybol, yüzme, buz hokeyi, hentbol, olimpik jimnastik gibi spor dalları için uygun sahalar, konser, kongre, kokteyl gibi etkinlikler için çok amaçlı salonlar, her biri 500 seyirci kapasiteli antrenman salonları, günlük kullanıma açık 7 spor salonu yer alacak. \r\n\r\n', 'img/projeler/proje6.webp', 'Planlanan', 4, NULL, '2026-08-06 12:22:31'),
(7, 'Hayvan Satış Alanı ve Kesimhane\r\n', 'Kocaeli Büyükşehir Belediyesi iş birliğiyle Balçık Mahallesi’nde hayata geçireceğimiz modern tesisimiz; 58.570 m² büyüklüğünde, 4.350 m² hayvan satış alanı, 1.170 m² kesimhane, 1.400 m² idari bina ve hizmet birimlerine sahip olacak. \r\n\r\n', 'img/projeler/proje7.webp', 'Devam Eden', 3, NULL, '2026-08-06 12:23:56'),
(8, 'Mevlana Oto Pazarı', 'Mevlâna Kapalı Pazar Alanı, pazar günleri oto pazarı konseptiyle hizmet veriyor. \r\n\r\n', 'img/projeler/proje8.webp', 'Tamamlanan', 3, NULL, '2026-08-06 12:24:54'),
(9, 'Veri Merkezi', 'Tier 3 standartlarındaki yeni veri merkezimizde; Türkiye’de ilk iyon akülü modüler veri sistemini kurduk. Sistem; yedekli elektrik şebekesi, yedekli iklimlendirme ve enerji sistemleri, yedekli internet servis sağlayıcı ve %99.9 uptime oranı ile yüksek güvenliğe sahip. Olası bir afet durumunda Gebze Belediyesi’ne ait hiçbir veri kaybolmayacak, zarar görmeyecek.\r\n\r\n', 'img/projeler/proje9.webp', 'Devam Eden', 7, NULL, '2026-08-06 12:26:51'),
(10, 'Yüksek Hızda İnternet Bağlantısı Hizmeti', 'Gaziler Dağına kurmuş olduğumuz baz istasyonu ile birlikte; 19 noktadaki hizmet alanlarımız arasında yüksek hızda internet erişimi sağladık. Toplam 120 access point cihazımızla vatandaşlarımıza ücretsiz wifi erişim noktası oluşturduk.\r\n\r\n', 'img/projeler/proje10.webp\r\n', 'Devam Eden', 7, NULL, '2026-08-06 12:27:50'),
(11, 'Akıllı Şehir', 'Kocaeli Büyükşehir Belediyesi iş birliğiyle hayata geçirilen Akıllı Şehir Kocaeli Projesi ile ulaşım, otopark ve güvenlik gibi alanlarda dijital platform üzerinden çözümler üretiyoruz.\r\n\r\n', 'img/projeler/proje11.webp', 'Devam Eden', 7, NULL, '2026-08-06 12:28:45'),
(12, 'Ulakbel İletişim Merkezi', '2020 yılı içerisinde hizmete aldığımız iletişim merkezimizde aynı yıl, vatandaşlarımızdan 331.604 çağrı aldık. 17 farklı platformdan aldığımız 84.000 başvuruyu çözüme kavuşturduk.\r\n\r\n', 'img/projeler/proje12.webp', 'Devam Eden', 7, NULL, '2026-08-06 12:29:44'),
(13, 'İmar Yönetim Sistemi', 'Fiziki başvuruların yarattığı zaman kaybını ve kâğıt israfını önlemek, süreçleri daha etkin ve verimli hale getirmek amacıyla İmar Yönetim Sistemi’ni geliştirdik. Yapı sahipleri ve müellifler farklı şehir ya da ülkelerde olsalar bile tek sistem üzerinden işlem yapabilmelerine olanak sağladık. Tüm taraflara anlık SMS göndererek şeffaf takip ve süreç yönetimi anlayışını benimsedik.\r\n\r\n', 'img/projeler/proje13.webp', 'Devam Eden', 7, NULL, '2026-08-06 12:30:27'),
(14, 'Tapu Rayiç Entegrasyonu', 'Türkiye’ de ilk kez Tapu Kadastro Müdürlüğü Rayiç Sorgulama Sistemini hayata geçirdik. 43.451 vatandaşımızın faydalandığı rayiç entegrasyonu, Türkiye Büyük Millet Meclisinde kanunlaşarak tüm Türkiye’de belediyelerin sunmak zorunda olduğu örnek bir hizmete dönüştü.\r\n\r\n', 'img/projeler/proje14.webp', 'Devam Eden', 7, NULL, '2026-08-06 12:31:24'),
(15, 'Dijital Belediye', 'Dijital platformda hizmete sunduğumuz; E-beyan, E-rayiç, E-eksper, E-işyeri, E-kayıt, E-tahsilat ve E-moloz’u kapsayan 40 modül sayesinde belediye hizmetleri artık dijital üzerinden kolaylıkla gerçekleştirilebiliyor. Toplamda 784.242 vatandaşımızın belediyemize ayak basmadan işlemlerini yapabilmesini sağladık.\r\n\r\n', 'img/projeler/proje15.webp', 'Devam Eden', 7, NULL, '2026-08-06 12:32:26'),
(16, 'İnternet Hatları', '190 km internet hattı yatırımı yaptık. İnternet bağlanma hızını ve kalitesini artırdık.\r\n\r\n', 'img/projeler/proje16.webp\r\n', 'Devam Eden', 7, NULL, '2026-08-06 12:33:16'),
(17, 'Boyunca Kitap Projesi', 'Kitap özeti getiren her öğrencimize yeni kitap hediye ederek okuma alışkanlığının yaygınlaştırılmasını teşvik ettik.\r\n\r\n', 'img/projeler/proje17.webp', 'Devam Eden', 6, NULL, '2026-08-06 12:36:50'),
(18, 'Konserler', 'Kültür sanat etkinlikleri kapsamında, 2019- 2023 yılları arasında; 22 adet konser düzenleyerek 88 bin vatandaşımızın iyi vakit geçirmesini sağladık.\r\n\r\n', 'img/projeler/proje18.webp', 'Devam Eden', 6, NULL, '2026-08-06 12:37:41');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `projeler`
--
ALTER TABLE `projeler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `projeler`
--
ALTER TABLE `projeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `projeler`
--
ALTER TABLE `projeler`
  ADD CONSTRAINT `projeler_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `proje_kategorileri` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
