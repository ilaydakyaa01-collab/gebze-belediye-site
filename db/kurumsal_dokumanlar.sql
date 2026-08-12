-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 11 Ağu 2026, 13:49:30
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
-- Tablo için tablo yapısı `kurumsal_dokumanlar`
--

CREATE TABLE `kurumsal_dokumanlar` (
  `id` int(11) NOT NULL,
  `mudurluk` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `belge_adi` varchar(255) NOT NULL,
  `dosya` varchar(255) DEFAULT NULL,
  `sira` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kurumsal_dokumanlar`
--

INSERT INTO `kurumsal_dokumanlar` (`id`, `mudurluk`, `kategori`, `belge_adi`, `dosya`, `sira`) VALUES
(1, 'Zabıta Müdürlüğü', 'Dilekçe Listeleri', 'Pazar Yeri İptal - Tahsis Dilekçesi', 'dosya/dokumanlar/zabita/pazar-iptal-tahsis.doc', 1),
(2, 'Zabıta Müdürlüğü', 'Dilekçe Listeleri', 'Pazar Yeri Sorgulama', 'dosya/dokumanlar/zabita/pazar-sorgulama.doc', 2),
(3, 'Zabıta Müdürlüğü', 'Dilekçe Listeleri', 'Rayiç Bedel Dilekçesi', 'dosya/dokumanlar/zabita/rayic-bedel.doc', 3),
(4, 'Zabıta Müdürlüğü', 'Evrak Listeleri', 'Zabıta Müdürlüğü Organizasyon Şeması', 'dosya/dokumanlar/zabita/organizasyon-semasi.pdf', 4),
(5, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', '376 Pişmanlık', 'dosya/dokumanlar/mali/376-pismanlik.doc', 1),
(6, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', 'Ç.T.V Kapatma', 'dosya/dokumanlar/mali/ctv-kapatma.doc', 2),
(7, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', 'Ç.T.V Mükerrer İptal', 'dosya/dokumanlar/mali/ctv-mukerrer-iptal.doc', 3),
(8, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', 'Çevre Temizlik Adres Değişikliği', 'dosya/dokumanlar/mali/cevre-temizlik-adres.doc', 4),
(9, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', 'Emlak Beyan Değişikliği', 'dosya/dokumanlar/mali/emlak-beyan-degisikligi.doc', 5),
(10, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', 'Emlak Mükerer İptal', 'dosya/dokumanlar/mali/emlak-mukerer-iptal.doc', 6),
(11, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', 'Emlak Taşınmaz Satış', 'dosya/dokumanlar/mali/emlak-tasinmaz-satis.doc', 7),
(12, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', 'İ.R.V Tabela Kaldırılması', 'dosya/dokumanlar/mali/irv-tabela-kaldirilmasi.doc', 8),
(13, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', 'İlan Reklam Kapatma', 'dosya/dokumanlar/mali/ilan-reklam-kapatma.doc', 9),
(14, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', 'İlan Reklam Mükerrer İptal', 'dosya/dokumanlar/mali/ilan-reklam-mukerrer-iptal.doc', 10),
(15, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', 'İlan Reklam Vergisi Değişiklik', 'dosya/dokumanlar/mali/ilan-reklam-vergisi-degisiklik.doc', 11),
(16, 'Mali Hizmetler Müdürlüğü', 'Dilekçe Listeleri', 'Vergi Sorgulama', 'dosya/dokumanlar/mali/vergi-sorgulama.doc', 12);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kurumsal_dokumanlar`
--
ALTER TABLE `kurumsal_dokumanlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kurumsal_dokumanlar`
--
ALTER TABLE `kurumsal_dokumanlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
