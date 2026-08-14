-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Ağu 2026, 09:03:21
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
(10, 'G2KNC3OAnjE', 'Türkiye Aşkına'),
(16, 'BiY2WK24UHY', 'Şehirler Arası Otobüs Terminalimizin işlevselliğini artırıyoruz'),
(23, 'D1b-CZYtCTg', 'Gebzeli CEZA'),
(24, 'x-3QRu3ZErI', 'Gebze Belediyesi Video'),
(25, 'MSFDvjXzKek', 'Yapım işini tamamladığımız İlyasbey Sağlıklı Yaşam Merkezi'),
(26, '5UFionJo50M', 'Gençliğin Merkezi Yükleniyor'),
(27, '5YbeMEfOG_k', 'Eskihisar Kalesinde gerçekleştiğimiz çevre düzenleme projesi'),
(28, 'ogBsqhMCNGY', 'Trafik Eğitim Merkezi ve Spor Kompleksi Pelitli yükleniyor'),
(29, 'qbnngwnklwI', 'Evlatlarımıza; kırtasiye, eğitim seti ve okul kıyafeti hediyelerini takdim ettik'),
(30, '93v47skWyIo', 'Gebze Belediyesi Video'),
(31, '26S85bc6kgc', 'Ulus Mahallesi Kapalı Pazar Alanı ve Kültür Merkezi Projesi'),
(32, 'YYqlDamdvJU', 'Gebze Belediyesi Video'),
(33, 'GTVdX7VgItA', 'Gebze Belediyesi Video'),
(34, 'J-ispJDpRgg', 'Gebze Belediyesi Video'),
(35, 'orM4Fb7H2eI', 'Gebze Belediyesi Video'),
(36, 'guINI5D8sGM', 'Gebze Belediyesi Video'),
(37, 'MrjGFrx8_e0', 'Gebze Belediyesi Video'),
(38, 'THh6RwsOP68', 'Gebze Belediyesi Video'),
(39, 'jhbA_o3lXDE', 'Gebze Belediyesi Video'),
(40, '7xVSxFWqc6M', 'Gebze Belediyesi Video'),
(41, 'PpzqQtyaewA', 'Gebze Belediyesi Video'),
(42, 'hWtxBcmQyh0', 'Gebze Belediyesi Video'),
(43, 'hPtwNzy23uU', 'Gebze Belediyesi Video'),
(44, 'QZqtNqNCvck', 'Gebze Belediyesi Video'),
(45, 'DIien--dMYg', 'Gebze Belediyesi Video'),
(46, 'f3R5olxCbrQ', 'Gebze Belediyesi Video'),
(47, 'nRfLJPAB2HU', 'Gebze Belediyesi Video'),
(48, 'KyzqrSj3gpE', 'Gebze Belediyesi Video'),
(49, 'g98oiFKkVp4', 'Gebze Belediyesi Video'),
(50, 'Ed4RBoIGs5g', 'Gebze Belediyesi Video'),
(51, 'yJ0y4HyFfno', 'Gebze Belediyesi Video'),
(52, 'aNWZfYJ3dqw', 'Gebze Belediyesi Video'),
(53, 'EdhcNmxNjGA', 'Gebze Belediyesi Video'),
(54, 'yxTfIBErv3k', 'Başkan Büyükgöz Akıllı Şehircilik Konferansında'),
(55, 'X_1KZ5ZVKuA', 'Zinnur Büyükgöz Regaip Kandili Mesajı');

--
-- Dökümü yapılmış tablolar için indeksler
--

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
-- Tablo için AUTO_INCREMENT değeri `videolar`
--
ALTER TABLE `videolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
