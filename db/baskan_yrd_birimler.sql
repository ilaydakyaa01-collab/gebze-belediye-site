-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Ağu 2026, 14:45:27
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
-- Tablo için tablo yapısı `baskan_yrd_birimler`
--

CREATE TABLE `baskan_yrd_birimler` (
  `id` int(11) NOT NULL,
  `yardimci_id` int(11) NOT NULL,
  `birim_adi` varchar(150) NOT NULL,
  `sorumlu_adi` varchar(100) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `baskan_yrd_birimler`
--

INSERT INTO `baskan_yrd_birimler` (`id`, `yardimci_id`, `birim_adi`, `sorumlu_adi`, `sira`) VALUES
(1, 1, 'Fen İşleri Müdürlüğü', 'Cezmi IRVA', 1),
(2, 1, 'Park ve Bahçeler Müdürlüğü', 'Tuncay TÜRETKEN', 2),
(3, 1, 'Etüt ve Proje Müdürlüğü', 'Asker ÇOBAN', 3),
(4, 1, 'Temizlik İşleri Müdürlüğü', 'Senay ALTINTAŞ', 4),
(5, 1, 'Makine İkmal, Bakım ve Onarım Müdürlüğü', 'Dursun Ali YAYLA', 5),
(6, 1, 'Destek Hizmetleri Müdürlüğü', 'Hamza Melih MALKOÇ', 6),
(7, 2, 'Emlak ve İstimlak Müdürlüğü', 'Şaban SARIAY', 1),
(8, 2, 'Plan ve Proje Müdürlüğü', 'Yusuf BURKUT', 2),
(9, 2, 'İmar ve Şehircilik Müdürlüğü', 'Mücahit KÖKSAL', 3),
(10, 2, 'Yapı Kontrol Müdürlüğü', 'Abdulkadir AKKURT', 4),
(11, 2, 'İşletme ve İştirakler Müdürlüğü', 'Yücel ER', 5),
(12, 3, 'Bilgi İşlem Müdürlüğü', 'Mehmet UÇAR', 1),
(13, 3, 'Mezarlıklar Müdürlüğü', 'İslam ÖZDAĞ', 2),
(14, 3, 'Ruhsat ve Denetim Müdürlüğü', 'Abdullah Talha AKYÜZ', 3),
(15, 3, 'Sosyal Destek Hizmetleri Müdürlüğü', 'Mecit KESKİNOĞLU', 4),
(16, 3, 'Zabıta Müdürlüğü', 'Yusuf Erhan KAYA', 5),
(17, 4, 'Veteriner İşleri Müdürlüğü', 'Cevat ALTINTAŞ', 1),
(18, 4, 'Afet İşleri ve Risk Yönetimi Müdürlüğü', 'Soner BİLİR', 2),
(19, 4, 'Yazı İşleri Müdürlüğü', 'Bahar ÖZALP', 3),
(20, 4, 'İklim Değişikliği ve Sıfır Atık Müdürlüğü', 'Kader DURAN', 4),
(21, 5, 'Gençlik ve Spor Hizmetleri Müdürlüğü', 'Hacı KEY', 1),
(22, 5, 'Basın Yayın ve Halkla İlişkiler Müdürlüğü', 'Dr. Yusuf ATASEVEN', 2),
(23, 5, 'Kültür İşleri Müdürlüğü', 'Carullah Recai ER', 3),
(24, 5, 'Kadın ve Aile Hizmetleri Müdürlüğü', 'Zeynep YÜKSEL', 4);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `baskan_yrd_birimler`
--
ALTER TABLE `baskan_yrd_birimler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `baskan_yrd_birimler`
--
ALTER TABLE `baskan_yrd_birimler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
