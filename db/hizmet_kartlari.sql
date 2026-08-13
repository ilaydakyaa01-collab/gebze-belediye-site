-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 13 Ağu 2026, 11:26:00
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
-- Tablo için tablo yapısı `hizmet_kartlari`
--

CREATE TABLE `hizmet_kartlari` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL,
  `baslik` varchar(180) NOT NULL,
  `aciklama` varchar(255) DEFAULT NULL,
  `gorsel` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT '#',
  `sira` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `hizmet_kartlari`
--

INSERT INTO `hizmet_kartlari` (`id`, `kategori_id`, `baslik`, `aciklama`, `gorsel`, `link`, `sira`, `aktif`) VALUES
(1, 1, 'Enderun Çocuk Atölyeleri', 'Sanat, müzik ve el becerisi ağırlıklı çocuk atölyeleri.', '', '#', 1, 1),
(2, 1, 'Sportif Çocuk Atölyesi', 'Futsal, cimnastik, okçuluk ve daha fazlası — 5-8 yaş.', '', '#', 2, 1),
(3, 1, 'Güzide Gençlik Merkezi Atölyeleri', 'Gençlere yönelik beceri ve gelişim atölyeleri.', '', '#', 3, 1),
(4, 2, 'Merkez Kütüphane', 'Geniş koleksiyon ve sessiz çalışma alanları.', '', '#', 1, 1),
(5, 2, 'Çocuk Kütüphanesi', 'Çocuklara özel kitap ve etkinlik alanı.', '', '#', 2, 1),
(6, 3, 'Gündüz Bakımevi', 'Uzman personel eşliğinde güvenli bakım hizmeti.', '', '#', 1, 1),
(7, 4, 'Eskihisar Mesire Alanı', 'Deniz kıyısında piknik ve dinlenme alanı.', '', '#', 1, 1),
(8, 4, 'Sultan Orhan Mesire Alanı', 'Yeşil alan içinde yürüyüş ve piknik imkânı.', '', '#', 2, 1),
(9, 5, 'Kadın ve Aile Yaşam Merkezi', 'Kadınlara yönelik eğitim ve destek programları.', '', '#', 1, 1),
(10, 5, 'Engelli Yaşam Merkezi', 'Engelli bireylere yönelik rehabilitasyon hizmetleri.', '', '#', 2, 1),
(11, 6, 'Sıfır Atık Noktaları', 'Mahalle bazlı sıfır atık toplama istasyonları.', '', '#', 1, 1),
(12, 7, 'Nikah Salonu Randevu', 'Online randevu ve gerekli evrak bilgileri.', '', '#', 1, 1),
(13, 8, 'Meslek Edindirme Kursları', 'Ücretsiz sertifikalı kurs programları.', '', '#', 1, 1),
(14, 9, 'Etkinlik Programı', 'Tarih, güreşçi kayıtları ve alan bilgisi.', '', '#', 1, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `hizmet_kartlari`
--
ALTER TABLE `hizmet_kartlari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategori_id` (`kategori_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `hizmet_kartlari`
--
ALTER TABLE `hizmet_kartlari`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `hizmet_kartlari`
--
ALTER TABLE `hizmet_kartlari`
  ADD CONSTRAINT `fk_hizmet_kartlari_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `hizmet_kategorileri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
