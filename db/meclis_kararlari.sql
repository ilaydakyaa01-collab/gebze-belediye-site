-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 14 Ağu 2026, 13:18:43
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
-- Tablo için tablo yapısı `meclis_kararlari`
--

CREATE TABLE `meclis_kararlari` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `tarih` date NOT NULL,
  `sira` int(11) DEFAULT 0,
  `pdf_dosya` varchar(255) DEFAULT NULL,
  `dosya_tipi` varchar(50) DEFAULT 'PDF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `meclis_kararlari`
--

INSERT INTO `meclis_kararlari` (`id`, `baslik`, `tarih`, `sira`, `pdf_dosya`, `dosya_tipi`) VALUES
(1, 'Ağustos 2026 Meclis Kararları', '2026-08-01', 1, 'uploads/meclis/agustos-2026.pdf', 'PDF'),
(2, 'Temmuz 2026 Meclis Kararları', '2026-07-01', 2, 'uploads/meclis/temmuz-2026.pdf', 'PDF'),
(3, 'Haziran 2026 Meclis Kararları', '2026-06-01', 3, 'uploads/meclis/haziran-2026.pdf', 'PDF'),
(4, 'Mayıs 2026 Meclis Kararları', '2026-05-01', 4, 'uploads/meclis/mayis-2026.pdf', 'PDF'),
(5, 'Nisan 2026 Meclis Kararları', '2026-04-01', 5, 'uploads/meclis/nisan-2026.pdf', 'PDF'),
(6, 'Mart 2026 Meclis Kararları', '2026-03-01', 6, 'uploads/meclis/mart-2026.pdf', 'PDF'),
(7, 'Şubat 2026 Meclis Kararları', '2026-02-01', 7, 'uploads/meclis/subat-2026.pdf', 'PDF'),
(8, 'Ocak 2026 Meclis Kararları', '2026-01-01', 8, 'uploads/meclis/ocak-2026.pdf', 'PDF'),
(9, 'Aralık 2025 Meclis Kararları', '2025-12-01', 9, 'uploads/meclis/aralik-2025.pdf', 'PDF'),
(10, 'Kasım 2025 Meclis Kararları', '2025-11-01', 10, 'uploads/meclis/kasim-2025.pdf', 'PDF'),
(11, 'Ekim 2025 Meclis Kararları', '2025-10-01', 11, 'uploads/meclis/ekim-2025.pdf', 'PDF'),
(12, 'Eylül 2025 Meclis Kararları', '2025-09-01', 12, 'uploads/meclis/eylul-2025.pdf', 'PDF'),
(13, 'Ağustos 2025 Meclis Kararları', '2025-08-01', 13, 'uploads/meclis/agustos-2025.pdf', 'PDF'),
(14, 'Temmuz 2025 Meclis Kararları', '2025-07-01', 14, 'uploads/meclis/temmuz-2025.pdf', 'PDF'),
(15, 'Haziran 2025 Meclis Kararları', '2025-06-01', 15, 'uploads/meclis/haziran-2025.pdf', 'PDF'),
(16, 'Mayıs 2025 Meclis Kararları', '2025-05-01', 16, 'uploads/meclis/mayis-2025.pdf', 'PDF'),
(17, 'Nisan 2025 Meclis Kararları', '2025-04-01', 17, 'uploads/meclis/nisan-2025.pdf', 'PDF'),
(18, 'Mart 2025 Meclis Kararları', '2025-03-01', 18, 'uploads/meclis/mart-2025.rar', 'RAR'),
(19, 'Şubat 2025 Meclis Kararları', '2025-02-01', 19, 'uploads/meclis/subat-2025.pdf', 'PDF'),
(20, 'Ocak 2025 Meclis Kararları', '2025-01-01', 20, 'uploads/meclis/ocak-2025.pdf', 'PDF');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `meclis_kararlari`
--
ALTER TABLE `meclis_kararlari`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `meclis_kararlari`
--
ALTER TABLE `meclis_kararlari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
