-- Başkan Yardımcıları tablosu
-- phpMyAdmin > gebze_belediye veritabanı > İçe Aktar sekmesinden bu dosyayı yükle
-- NOT: resim sütunu yerel dosya yollarını tutuyor, fotoğrafları
-- img/baskan-yardimcilari/ klasörüne o isimlerle koymuş olman gerekiyor.

CREATE TABLE `baskan_yardimcilari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(100) NOT NULL,
  `unvan` varchar(100) NOT NULL DEFAULT 'Başkan Yardımcısı',
  `resim` varchar(255) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `baskan_yardimcilari` (`ad`, `unvan`, `resim`, `sira`) VALUES
('Şerif CANPOLAT', 'Başkan Yardımcısı', 'img/baskan-yardimcilari/serif-canpolat.jpg', 1),
('Muharrem BALTACIOĞLU', 'Başkan Yardımcısı', 'img/baskan-yardimcilari/muharrem-baltacioglu.jpg', 2),
('Mahmut YANDIK', 'Başkan Yardımcısı', 'img/baskan-yardimcilari/mahmut-yandik.jpg', 3),
('Şener AKIN', 'Başkan Yardımcısı', 'img/baskan-yardimcilari/sener-akin.jpg', 4),
('Zeynep YILDIRIM', 'Başkan Yardımcısı', 'img/baskan-yardimcilari/zeynep-yildirim.jpg', 5);