-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Ağu 2026, 14:47:46
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
-- Tablo için tablo yapısı `sayfa_ilkelerimiz`
--

CREATE TABLE `sayfa_ilkelerimiz` (
  `id` int(11) NOT NULL,
  `baslik` varchar(150) NOT NULL,
  `icerik` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sayfa_ilkelerimiz`
--

INSERT INTO `sayfa_ilkelerimiz` (`id`, `baslik`, `icerik`) VALUES
(1, 'İlkelerimiz', '<ul class=\"ilke-listesi\">\r\n                        <li>Belediye hizmetlerinde kalite, etkinlik ve verimlilik sağlamak görevimizdir.</li>\r\n                        <li>Belediye karar ve uygulamalarında şeffaflık ve hesap verebilirlik esastır.</li>\r\n                        <li>Belediye hizmetlerinde insan ve vatandaş odaklılık esastır.</li>\r\n                        <li>Gebze’yi katılımcı anlayışla yönetmek temel prensiptir.</li>\r\n                        <li>Belediye hizmetlerinin üretim ve sunumunda bilgi teknolojilerinden azami derecede yararlanmak esastır.</li>\r\n                        <li>Belediye karar ve uygulamalarında yasalara uymak zorunluluktur.</li>\r\n                        <li>Belediye hizmetlerinin ihtiyaçlara ve önceliklere göre adil dağıtımı esastır.</li>\r\n                        <li>Çalışanlarımızın memnuniyeti temel önceliklerimizdendir.</li>\r\n                        <li>Kurum kültürünün oluşturulması için çaba sarf ederiz.</li>\r\n                        <li>Sorunları oluşmadan önlemeye çalışırız.</li>\r\n                    </ul>');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `sayfa_ilkelerimiz`
--
ALTER TABLE `sayfa_ilkelerimiz`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `sayfa_ilkelerimiz`
--
ALTER TABLE `sayfa_ilkelerimiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
