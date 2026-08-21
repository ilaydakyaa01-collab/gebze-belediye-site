-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Ağu 2026, 08:22:39
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
-- Tablo için tablo yapısı `hizmet_noktalari`
--

CREATE TABLE `hizmet_noktalari` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `konum` varchar(255) DEFAULT NULL,
  `google_maps_url` varchar(255) DEFAULT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hizmet_noktalari`
--

INSERT INTO `hizmet_noktalari` (`id`, `baslik`, `kategori`, `konum`, `google_maps_url`, `sira`) VALUES
(1, 'Basın Yayın ve Halkla İlişkiler Müdürlüğü', 'mudurluk', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 1),
(2, 'Bilgi İşlem Müdürlüğü', 'mudurluk', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 2),
(3, 'Destek Hizmetleri Müdürlüğü', 'mudurluk', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 3),
(4, 'Emlak ve İstimlak Müdürlüğü', 'mudurluk', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 4),
(5, 'Fen İşleri Müdürlüğü', 'mudurluk', 'Köşklüçeşme Mah. Yeni Bağdat Cad. No.118 Gebze Kocaeli', 'https://goo.gl/maps/RbiPaCmWjqWmbUQy6', 5),
(6, 'Hukuk İşleri Müdürlüğü', 'mudurluk', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 6),
(7, 'İmar ve Şehircilik Müdürlüğü', 'mudurluk', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 7),
(8, 'İnsan Kaynakları ve Eğitim Müdürlüğü', 'mudurluk', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 8),
(9, 'İşletme ve İştirakler Müdürlüğü', 'mudurluk', 'Mevlana Mah. Issıkgöl Cad. No:111 Gebze Kocaeli', 'https://goo.gl/maps/z2Cgmot5MgYok7yW6', 9),
(10, 'Kültür İşleri Müdürlüğü', 'mudurluk', '15 Temmuz Milli İrade Kent Meydanı Hacı Halil Mah. Atatürk Cad. No:8 Gebze', 'https://goo.gl/maps/DwRG4MYyQsWte7X8A', 10),
(11, 'Mali Hizmetler Müdürlüğü', 'mudurluk', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 11),
(12, 'Mezarlıklar Müdürlüğü', 'mudurluk', 'Mevlana Mah. Issıkgöl cad. no:121 Gebze Kocaeli', 'https://goo.gl/maps/phEqcT9qrq8EN5ac7', 12),
(13, 'Özel Kalem Müdürlüğü', 'mudurluk', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 13),
(14, 'Park ve Bahçeler Müdürlüğü', 'mudurluk', 'Gaziler Mahallesi Issıkgöl caddesi 1727 sokak No:1 Gebze Kocaeli', 'https://goo.gl/maps/S5KgKLDVC2P4SFBj7', 14),
(15, 'Plan ve Proje Müdürlüğü', 'mudurluk', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 15),
(16, 'Rehberlik ve Teftiş Kurulu Müdürlüğü', 'mudurluk', 'Mevlana Mah. Issıkgöl Cad. No:111 Gebze Kocaeli', 'https://goo.gl/maps/z2Cgmot5MgYok7yW6', 16),
(17, 'Ruhsat ve Denetim Müdürlüğü', 'mudurluk', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 17),
(18, 'Sosyal Destek Hizmetleri Müdürlüğü', 'mudurluk', '15 Temmuz Milli İrade Kent Meydanı Hacı Halil Mah. Atatürk Cad. No:8 Gebze', 'https://goo.gl/maps/DwRG4MYyQsWte7X8A', 18),
(19, 'Temizlik İşleri Müdürlüğü', 'mudurluk', 'Kirazpınar Mah. Yeni Bağdat Cad. No:883 Gebze KOCAELİ', 'https://goo.gl/maps/KJTbTzxgdHVLkdGe9', 19),
(20, 'Veteriner İşleri Müdürlüğü', 'mudurluk', 'Mevlana Mah. Issıkgöl Cad. No:111 Gebze Kocaeli', 'https://goo.gl/maps/z2Cgmot5MgYok7yW6', 20),
(21, 'Yazı İşleri Müdürlüğü', 'mudurluk', '15 Temmuz Milli İrade Kent Meydanı Hacı Halil Mah. Atatürk Cad. No:8 Gebze', 'https://goo.gl/maps/DwRG4MYyQsWte7X8A', 21),
(22, 'Zabıta Müdürlüğü', 'mudurluk', 'Mevlana Mah. Issıkgöl Cad. No:111 Gebze Kocaeli', 'https://goo.gl/maps/z2Cgmot5MgYok7yW6', 22),
(23, 'Beylikbağı Karakolu', 'servis', 'Mimar Sinan, Ankara Cd. No:7 Gebze/Kocaeli', 'https://goo.gl/maps/btPU9FEjJugnFFqX9', 23),
(24, 'Çarşı ve Seyyar Zabıta Amirliği', 'servis', '15 Temmuz Milli İrade Kent Meydanı Hacı Halil Mah. Atatürk Cad. No:8 Gebze', 'https://goo.gl/maps/DwRG4MYyQsWte7X8A', 24),
(25, 'Evlendirme Memurluğu', 'servis', '15 Temmuz Milli İrade Kent Meydanı Hacı Halil Mah. Atatürk Cad. No:8 Gebze', 'https://goo.gl/maps/DwRG4MYyQsWte7X8A', 25),
(26, 'Evrak Kayıt Servisi', 'servis', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 26),
(27, 'İstihdam Büro', 'servis', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 27),
(28, 'Kamyon Tır Garajı Zabıta Karakolu', 'servis', 'Barış Mah. 1805. Sok. No:6 Gebze Kocaeli', 'https://goo.gl/maps/A148bYf5VNtkJPKz5', 28),
(29, 'Makina İkmal Bakım Onarım Servisi', 'servis', 'Mevlana Mah. Issıkgöl Cad. No:111 Gebze Kocaeli', 'https://goo.gl/maps/z2Cgmot5MgYok7yW6', 29),
(30, 'Mollafenari Zabıta Amirliği', 'servis', 'Mollafenari mah. Eski İstanbul Cad. No:9 Gebze Kocaeli', 'https://goo.gl/maps/TRrYuGeknaXrVxtP6', 30),
(31, 'Numarataj Şefliği', 'servis', 'Güzeller Mahallesi. Bahar Cad. N:1 41400 Gebze/KOCAELİ', 'https://goo.gl/maps/KdpYiyUNCHrnApvR7', 31),
(32, 'Otobüs İşleri Servisi', 'servis', 'Mevlana Mah. Issıkgöl Cad. No:111 Gebze Kocaeli', 'https://goo.gl/maps/z2Cgmot5MgYok7yW6', 32),
(33, 'Terminal Zabıta Amirliği', 'servis', 'Barış Mah. Koşuyolu Cad. No:20', 'https://goo.gl/maps/Xw9x2WsAETv1BeB3A', 33),
(34, 'Trafik ve Eğitim Okulu Zabıta Amirliği', 'servis', 'Arapçeşme mah. 1051/1 Sok. No:18 Gebze Kocaeli', 'https://goo.gl/maps/LgMDtXK8wPUoFcJf7', 34),
(35, 'Arapçeşme Bilim Sanat Merkezi', 'merkezler', 'Arapçeşme Mahallesi Kavak Caddesi 1066. Sokak No:27 Gebze/Kocaeli', 'https://goo.gl/maps/DAGnAFSzUp2Am3Jk9', 35),
(36, 'Beylikbağı Bilim ve Sanat Merkezi', 'merkezler', 'Mimar Sinan, Ankara Cd. No:7 Gebze/Kocaeli', 'https://goo.gl/maps/btPU9FEjJugnFFqX9', 36),
(37, 'İstasyon Bilim ve Sanat Merkezi', 'merkezler', 'İstasyon Mahallesi Şehit Abdullah Horoz Caddesi No:26 Gebze/Kocaeli', 'https://goo.gl/maps/4Hxv9jP7BUPtgMJbA', 37),
(38, 'Güzide Cumhuriyet Meydanı', 'sosyal-tesisler', 'Hacıhalil Mah. Atatürk Cd. No:10/9 Gebze/Kocaeli', 'https://goo.gl/maps/zWb9688jGA4FsQik8', 38),
(39, 'Güzide Kent Meydanı', 'sosyal-tesisler', 'Hacıhalil Mah. Şehit Numan Dede Cd. Gebze/Kocaeli', 'https://goo.gl/maps/oJfc8yfREYzHsibp7', 39),
(40, 'Atlı Eğitim Merkezi', 'egitim-merkezleri', 'Gaziler Mah. 1793 Sok. No:58 Gebze Belediyesi Atlı Eğitim Merkezi Gebze/Kocaeli', 'https://goo.gl/maps/kdk8GT8KhJ5Hi3KUA', 40),
(41, 'Cumhuriyet Spor Salonu', 'egitim-merkezleri', 'Cumhuriyet Mahallesi Necip Fazıl Caddesi No:102 Gebze Kocaeli', 'https://goo.gl/maps/DCJgiujNpcHYZRrb8', 41),
(42, 'Enderun Çocuk Atölyeleri', 'egitim-merkezleri', 'Mustafapaşa Mah. 712/2 Sok. No:2 Gebze / Kocaeli', 'https://maps.app.goo.gl/YNANZMyzpqCRwSrWA', 42),
(43, 'GESMEK Ademyavuz Mahalle Kursu', 'egitim-merkezleri', 'Adem Yavuz Mahallesi 2322 Sokak No:1 Gebze/Kocaeli', 'https://goo.gl/maps/PFkikartDBwHFRSX8', 43),
(44, 'GESMEK Gaziler Mahalle Kursu', 'egitim-merkezleri', 'Gaziler Mahallesi İbrahim Ağa Caddesi Eşref Bitlis Parkı İçi Gebze/Kocaeli', 'https://goo.gl/maps/cCpTLb6RS8gpwBcUA', 44),
(45, 'GESMEK Merkez', 'egitim-merkezleri', 'Hacı Halil Mahallesi Zübeyde Hanım Caddesi Eyüp Güvenç İş Merkezi No:13 Gebze/Kocaeli', 'https://goo.gl/maps/Sh1CgvYjqxjShXmY6', 45),
(46, 'GESMEK Yenikent Mahalle Kursu', 'egitim-merkezleri', 'Yenikent Mahallesi Dicle Caddesi 2409 Sokak No:3 Gebze/Kocaeli', 'https://goo.gl/maps/XMc8siZ4KfrBg6fu7', 46),
(47, 'Adem Yavuz Mezarlığı', 'diger', 'Adem Yavuz mah. Karacaoğlan cad. no:23 Gebze Kocaeli', 'https://goo.gl/maps/5QVoYNuiEPZQgKSj8', 47),
(48, 'Elden Ele Gönül Çarşısı', 'diger', 'Hacı Halil Mah. Yeni Bağdat Cad. No:394 Gebze Kocaeli', 'https://goo.gl/maps/sq7pm6QFLeNEbpZf6', 48),
(49, 'Gebze Merkez Mezarlığı ve Şehitliği', 'diger', 'Mevlana Mah. Issıkgöl cad. no:121 Gebze Kocaeli', 'https://goo.gl/maps/phEqcT9qrq8EN5ac7', 49),
(50, 'Gebze Terminali', 'diger', 'Barış Mah. Koşuyolu Cad. No:20', 'https://goo.gl/maps/Xw9x2WsAETv1BeB3A', 50),
(51, 'Kamyon ve Tır Parkı', 'diger', 'Barış Mah. 1805. Sok. No:6 Gebze Kocaeli', 'https://goo.gl/maps/A148bYf5VNtkJPKz5', 51),
(52, 'Mevlana Kapalı Pazar Alanı', 'diger', 'Mevlana Mah. Issıkgöl Cad. No:111 Gebze Kocaeli', 'https://goo.gl/maps/z2Cgmot5MgYok7yW6', 52),
(53, 'Mimar Sinan Mezarlığı', 'diger', 'Mimar Sinan mah. Mimar Sinan cad. no:60 Gebze Kocaeli', 'https://goo.gl/maps/jio4xcWfKKctfXAeA', 53),
(54, 'Osman Yılmaz Mezarlığı', 'diger', 'Osman Yılmaz mah. 611 sk. no:16 Gebze Kocaeli', 'https://goo.gl/maps/6qYqEmSu8kHoe7Ku5', 54),
(55, 'Pelitli Mezarlığı', 'diger', 'Pelitli mah. yeni mezarlık yolu cad. no:107 Gebze Kocaeli', 'https://goo.gl/maps/JfRq1U34KfALgwrbA', 55),
(56, 'Sokak Hayvanları Tedavi, Rehabilitasyon ve Eğitim Merkezi', 'diger', 'Pelitli Mahallesi Yeni Mezarlık Yolu Caddesi No:49 Gebze Kocaeli', 'https://goo.gl/maps/DQdBNR5WVGwJwQaS7', 56),
(57, 'Tatlıkuyu Pazar Alanı', 'diger', 'Tatlıkuyu, 1319/2. Sk. No:5 Gebze/Kocaeli', 'https://goo.gl/maps/cYQm8MxsfebMJjSR9', 57);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `hizmet_noktalari`
--
ALTER TABLE `hizmet_noktalari`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
