-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Ağu 2026, 15:00:44
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
-- Tablo için tablo yapısı `baskan`
--

CREATE TABLE `baskan` (
  `id` int(10) UNSIGNED NOT NULL,
  `ad_soyad` varchar(150) NOT NULL,
  `unvan` varchar(150) NOT NULL DEFAULT 'Gebze Belediye Başkanı',
  `fotograf` varchar(255) DEFAULT NULL COMMENT 'ör: img/baskan/baskan.jpg',
  `biyografi` text DEFAULT NULL COMMENT 'Paragraflar iki alt satır (\n\n) ile ayrılır',
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `web_sitesi` varchar(255) DEFAULT NULL COMMENT 'Başkanın kişisel web sayfası (dış link)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `baskan`
--

INSERT INTO `baskan` (`id`, `ad_soyad`, `unvan`, `fotograf`, `biyografi`, `facebook`, `twitter`, `instagram`, `web_sitesi`, `created_at`, `updated_at`) VALUES
(1, 'Zinnur Büyükgöz', 'Gebze Belediye Başkanı', 'img/baskan-ozgecmis.jpg', '1964 yılında Erzurum’da doğdu. İlköğretim tahsilini 1975’te Bakırköy Koca Sinan İlkokulu’nda ve 1978’de Kadıköy İmam Hatip Ortaokulu’nda tamamladı. 1983’te ise Gebze İmam Hatip Lisesi’nden mezun oldu.\n\n1987’de Yıldız Teknik Üniversitesi Mimarlık Fakültesi’nden Şehir ve Bölge Plancısı unvanıyla mezun oldu. 1987-1989 yılları arasında aynı üniversitede Şehir ve Bölge Planlaması dalında yüksek lisansını tamamladı. 33 Yıldan bu yana ise Şehir Plancısı unvanıyla hizmet etmeye devam etmektedir. Evli ve dört çocuk babasıdır.\n\nRefah Partisi’nden Darıca Belde Başkanlığı ve Gebze Yönetim Kurulu Üyeliği ile Fazilet Partisi’nden Kocaeli İl Yönetimi İcra Kurulu Üyeliği yapmıştır.\n\n2004-2009 yılları arasında Gebze Belediyesi Teknik Başkan Yardımcılığı ve Belediye Meclis Üyeliği, Kocaeli Büyükşehir Belediyesi Meclis Üyeliği ve İmar Komisyon Üyeliği görevlerinde bulunmuştur. \n\nGebze ve Kocaeli’nde siyasi görevlerde bulunmanın yanı sıra, sivil toplum kuruluşlarında ve birçok farklı platformlarda faaliyetler sürdürmüştür. 2004’ten itibaren İstanbul Kültür Varlıklarını Koruma Bölge Kurulu ile Bursa ve Kocaeli Kültür Varlıklarını Koruma Bölge Kurulları’nda üyelik yapmıştır. \n\nTürkiye geneli İdare Mahkemeleri’nde Bilirkişi unvanıyla adaletin tecellisine yardımcı olmaya gayret etmiştir. \n\n2014-2016 yılları arasında İstanbul Ticaret Odası Proje Danışma Kurul Üyesi olarak çalışmıştır. 2014’ten bu yana ise Teknopark İstanbul Teknoloji Bölgesi’nde Proje Danışma Kurulu Üyeliği yapmaktadır. \n\nOcak 2019 itibarıyla Kültür Varlıklarını Koruma Bölge Kurulu Üyeliği’nden ayrılmıştır. \n\n31 Mart 2019 Mahalli İdareler Seçimi’nde halkımızın teveccühü ile Gebze Belediye Başkanı seçilmiştir ve halen bu görevi yürütmeye devam etmektedir.', 'https://www.facebook.com/zinnurbuyukgoz', 'https://twitter.com/zinnurbuyukgoz', 'https://www.instagram.com/zinnurbuyukgoz', 'https://www.zinnurbuyukgoz.com', '2026-08-06 11:08:48', '2026-08-06 11:31:45');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `baskan`
--
ALTER TABLE `baskan`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `baskan`
--
ALTER TABLE `baskan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
