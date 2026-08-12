-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 11 Ağu 2026, 13:49:44
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
-- Tablo için tablo yapısı `kurumsal_raporlar`
--

CREATE TABLE `kurumsal_raporlar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `aciklama` varchar(255) DEFAULT NULL,
  `dosya` varchar(255) DEFAULT NULL,
  `dosya_tipi` varchar(10) DEFAULT 'PDF',
  `kategori` varchar(100) NOT NULL,
  `tarih` date DEFAULT NULL,
  `sira` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kurumsal_raporlar`
--

INSERT INTO `kurumsal_raporlar` (`id`, `baslik`, `aciklama`, `dosya`, `dosya_tipi`, `kategori`, `tarih`, `sira`) VALUES
(1, '2025 Yılı Faaliyet Raporu', 'Belediyemizin 2025 yılına ait faaliyet raporu', 'dosya/raporlar/faaliyet-2025.pdf', 'PDF', 'Faaliyet Raporları', '2026-01-15', 1),
(2, '2024 Yılı Faaliyet Raporu', 'Belediyemizin 2024 yılına ait faaliyet raporu', 'dosya/raporlar/faaliyet-2024.pdf', 'PDF', 'Faaliyet Raporları', '2025-01-15', 2),
(3, '2023 Yılı Faaliyet Raporu', 'Belediyemizin 2023 yılına ait faaliyet raporu', 'dosya/raporlar/faaliyet-2023.pdf', 'PDF', 'Faaliyet Raporları', '2024-01-15', 3),
(4, '2022 Yılı Faaliyet Raporu', 'Belediyemizin 2022 yılına ait faaliyet raporu', 'dosya/raporlar/faaliyet-2022.pdf', 'PDF', 'Faaliyet Raporları', '2023-01-15', 4),
(5, '2021 Yılı Faaliyet Raporu', 'Belediyemizin 2021 yılına ait faaliyet raporu', 'dosya/raporlar/faaliyet-2021.pdf', 'PDF', 'Faaliyet Raporları', '2022-01-15', 5),
(6, '2020 Yılı Faaliyet Raporu', 'Belediyemizin 2020 yılına ait faaliyet raporu', 'dosya/raporlar/faaliyet-2020.pdf', 'PDF', 'Faaliyet Raporları', '2021-01-15', 6),
(7, '2019 Yılı Faaliyet Raporu', 'Belediyemizin 2019 yılına ait faaliyet raporu', 'dosya/raporlar/faaliyet-2019.pdf', 'PDF', 'Faaliyet Raporları', '2020-01-15', 7),
(8, '2018 Yılı Faaliyet Raporu', 'Belediyemizin 2018 yılına ait faaliyet raporu', 'dosya/raporlar/faaliyet-2018.pdf', 'PDF', 'Faaliyet Raporları', '2019-01-15', 8),
(9, '2017 Yılı Faaliyet Raporu', 'Belediyemizin 2017 yılına ait faaliyet raporu', 'dosya/raporlar/faaliyet-2017.pdf', 'PDF', 'Faaliyet Raporları', '2018-01-15', 9),
(10, '2016 Yılı Faaliyet Raporu', 'Belediyemizin 2016 yılına ait faaliyet raporu', 'dosya/raporlar/faaliyet-2016.pdf', 'PDF', 'Faaliyet Raporları', '2017-01-15', 10),
(11, '2023 Mali Durum ve Beklentiler Raporu', NULL, 'dosya/raporlar/mali-durum-2023.pdf', 'PDF', 'Mali Durum ve Beklentiler Raporu', '2023-09-05', 1),
(12, '2022 Mali Durum ve Beklentiler Raporu', NULL, 'dosya/raporlar/mali-durum-2022.pdf', 'PDF', 'Mali Durum ve Beklentiler Raporu', '2022-09-13', 2),
(13, 'Gebze Belediyesi 2021 Mali Durum ve Beklentiler Raporu', NULL, 'dosya/raporlar/mali-durum-2021.pdf', 'PDF', 'Mali Durum ve Beklentiler Raporu', '2021-09-01', 3),
(14, 'Gebze Belediyesi 2020 Kurumsal Mali Durum ve Beklentiler Raporu', NULL, 'dosya/raporlar/mali-durum-2020.docx', 'DOCX', 'Mali Durum ve Beklentiler Raporu', '2020-08-07', 4),
(15, '2026 Mali Yılı Performans Programı', NULL, 'dosya/raporlar/performans-2026.pdf', 'PDF', 'Performans Programı', '2025-10-23', 5),
(16, '2025 Mali Yılı Performans Programı', NULL, 'dosya/raporlar/performans-2025.pdf', 'PDF', 'Performans Programı', '2024-10-15', 6),
(17, '2024 Mali Yılı Performans Kitabı', NULL, 'dosya/raporlar/performans-2024.pdf', 'PDF', 'Performans Programı', '2023-10-16', 7),
(18, '2023 Mali Yılı Performans Programı', NULL, 'dosya/raporlar/performans-2023.pdf', 'PDF', 'Performans Programı', '2022-10-21', 8),
(19, '2022 Mali Yılı Performans Programı', NULL, 'dosya/raporlar/performans-2022.pdf', 'PDF', 'Performans Programı', '2021-11-22', 9),
(20, '2021 Performans Programı', NULL, 'dosya/raporlar/performans-2021.pdf', 'PDF', 'Performans Programı', '2020-10-23', 10);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kurumsal_raporlar`
--
ALTER TABLE `kurumsal_raporlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kurumsal_raporlar`
--
ALTER TABLE `kurumsal_raporlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
