-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 21 Ağu 2026, 13:22:48
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
-- Tablo için tablo yapısı `videolar`
--

CREATE TABLE `videolar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `youtube_id` varchar(50) NOT NULL,
  `tarih` date NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `videolar`
--

INSERT INTO `videolar` (`id`, `baslik`, `youtube_id`, `tarih`, `sira`) VALUES
(1, 'Şehirler Arası Otobüs Terminalimizin işlevselliğini artırıyoruz', 'BiY2WK24UHY', '2023-09-07', 1),
(3, 'Yapım işini tamamladığımız İlyasbey Sağlıklı Yaşam Merkezi', 'MSFDvjXzKek', '2023-09-07', 2),
(4, 'Gençliğin Merkezi Yükleniyor', '5UFionJo50M', '2023-09-07', 3),
(5, 'Eskihisar Kalesinde gerçekleştiğimiz çevre düzenleme projesi', '5YbeMEfOG_k', '2023-09-07', 4),
(6, 'Trafik Eğitim Merkezi ve Spor Kompleksi Pelitli yükleniyor', 'ogBsqhMCNGY', '2023-09-07', 5),
(7, 'Evlatlarımıza ; kırtasiye ,eğitim seti ve okul kıyafeti hediyelerini takdim ettik', 'qbnngwnklwI', '2023-09-07', 6),
(8, 'Bilal Sonses Konseri', '93v47skWyIo', '2022-07-26', 7),
(9, 'ULUS MAHALLESİ KAPALI PAZAR ALANI VE KÜLTÜR MERKEZİ PROJESİ', '26S85bc6kgc', '2021-11-22', 8),
(10, 'Avrupa Haraketlilik Haftası', 'YYqlDamdvJU', '2020-09-23', 9),
(11, 'Başkan Amcalarından; Parklara Koşan Çocuklara Sürpriz\r\n', 'GTVdX7VgItA', '2020-05-22', 10),
(12, 'Toprağın Bereketini İşleyen, Büyüten Çiftçilerimize Ziyarette Bulunduk\r\n', 'orM4Fb7H2eI', '2020-05-22', 11),
(13, 'Başkan Büyükgöz İşçileri Unutmadı\r\n', 'MrjGFrx8_e0', '2020-05-09', 12);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `videolar`
--
ALTER TABLE `videolar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `videolar`
--
ALTER TABLE `videolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
