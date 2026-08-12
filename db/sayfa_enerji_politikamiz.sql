-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Ağu 2026, 14:47:39
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
-- Tablo için tablo yapısı `sayfa_enerji_politikamiz`
--

CREATE TABLE `sayfa_enerji_politikamiz` (
  `id` int(11) NOT NULL,
  `baslik` varchar(150) NOT NULL,
  `icerik` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sayfa_enerji_politikamiz`
--

INSERT INTO `sayfa_enerji_politikamiz` (`id`, `baslik`, `icerik`) VALUES
(1, 'Enerji Politikamız', '<p>Belediye Kanunu ile tayin edilen hizmetlerimizi; ulusal kanun ve yönetmeliklere, bağlı bulunduğumuz mevzuat hükümlerine ve Enerji Yönetim Sistemi (EnYS) şartlarına bağlı kalarak, hizmetlerimizin sürdürülebilirliğini esas alarak yürütmekteyiz. Bu doğrultuda;</p>\r\n                    <ul class=\"ilke-listesi\">\r\n                        <li>Enerji ve doğal kaynaklarımızı stratejik bir bakış açısıyla ele alarak verimli kullanmayı,</li>\r\n                        <li>Enerji Yönetim Sistemi’ni; ilgili standartlar, uygulanabilir yasal şartlar ve diğer gereklilikler doğrultusunda etkin şekilde yönetmeyi,</li>\r\n                        <li>Kaynaklarımızı etkin ve verimli bir şekilde kullanmayı,</li>\r\n                        <li>Enerji verimliliğini artırmak için gerekli olan süreç ve sistemleri oluşturarak, bu süreçleri gelişmiş teknolojilerle uygulamayı ve sürdürülebilirliği sağlamayı,</li>\r\n                        <li>İklim değişikliğiyle mücadeleye olumlu katkı sağlayacak enerji verimliliği projeleri geliştirerek uygulamayı,</li>\r\n                        <li>Tüm personelin EnYS süreçlerine katılımını sağlamayı, ekip çalışmasını güçlendirmeyi ve enerji verimliliği farkındalığını artırmayı,</li>\r\n                        <li>EnYS hedeflerini belirlemeyi, bu hedeflerin gerçekleşmesi için gerekli kaynakları sağlamayı ve sistemi sürekli gözden geçirerek iyileştirmeyi,</li>\r\n                        <li>Enerji performansını sürekli artırmak amacıyla, belirlenen amaç ve hedeflere ulaşmak için gerekli tüm bilgi ve kaynağı temin ederek; tedarik ve tasarım süreçlerinde enerji verimliliğini ön planda tutmayı,</li>\r\n                        <li>Vatandaşlarımız için faaliyetlerimiz çerçevesinde verimlilik artırıcı projeler tasarlamayı, enerji bakımından verimli ürün ve hizmetlerin tedarik edilmesi hususunda teşvik etmeyi, enerji verimliliği farkındalığını geliştirmek için bilgilendirmeyi ve desteklemeyi, enerji verimliliğimizi sürekli iyileştirmeyi taahhüt ederiz.</li>\r\n                    </ul>');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `sayfa_enerji_politikamiz`
--
ALTER TABLE `sayfa_enerji_politikamiz`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `sayfa_enerji_politikamiz`
--
ALTER TABLE `sayfa_enerji_politikamiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
