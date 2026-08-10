-- Başkan Yardımcılarına bağlı birimler tablosu
-- phpMyAdmin > gebze_belediye veritabanı > İçe Aktar sekmesinden bu dosyayı yükle
-- (baskan_yardimcilari tablosu zaten var olmalı, bu ona bağlı ikinci bir tablo)

CREATE TABLE `baskan_yrd_birimler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yardimci_id` int(11) NOT NULL,
  `birim_adi` varchar(150) NOT NULL,
  `sorumlu_adi` varchar(100) NOT NULL,
  `sira` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- NOT: Aşağıdaki INSERT'lerde yardimci_id değerleri, baskan_yardimcilari
-- tablosundaki id sütununa göre eşleşmeli. Sıra (ad'a göre): 1=Şerif Canpolat,
-- 2=Muharrem Baltacıoğlu, 3=Mahmut Yandık, 4=Şener Akın, 5=Zeynep Yıldırım
-- (senin tablonda id'ler farklıysa, aşağıdaki yardimci_id değerlerini güncellemen gerekir)

INSERT INTO `baskan_yrd_birimler` (`yardimci_id`, `birim_adi`, `sorumlu_adi`, `sira`) VALUES
(1, 'Fen İşleri Müdürlüğü', 'Cezmi IRVA', 1),
(1, 'Park ve Bahçeler Müdürlüğü', 'Tuncay TÜRETKEN', 2),
(1, 'Etüt ve Proje Müdürlüğü', 'Asker ÇOBAN', 3),
(1, 'Temizlik İşleri Müdürlüğü', 'Senay ALTINTAŞ', 4),
(1, 'Makine İkmal, Bakım ve Onarım Müdürlüğü', 'Dursun Ali YAYLA', 5),
(1, 'Destek Hizmetleri Müdürlüğü', 'Hamza Melih MALKOÇ', 6),
(2, 'Emlak ve İstimlak Müdürlüğü', 'Şaban SARIAY', 1),
(2, 'Plan ve Proje Müdürlüğü', 'Yusuf BURKUT', 2),
(2, 'İmar ve Şehircilik Müdürlüğü', 'Mücahit KÖKSAL', 3),
(2, 'Yapı Kontrol Müdürlüğü', 'Abdulkadir AKKURT', 4),
(2, 'İşletme ve İştirakler Müdürlüğü', 'Yücel ER', 5),
(3, 'Bilgi İşlem Müdürlüğü', 'Mehmet UÇAR', 1),
(3, 'Mezarlıklar Müdürlüğü', 'İslam ÖZDAĞ', 2),
(3, 'Ruhsat ve Denetim Müdürlüğü', 'Abdullah Talha AKYÜZ', 3),
(3, 'Sosyal Destek Hizmetleri Müdürlüğü', 'Mecit KESKİNOĞLU', 4),
(3, 'Zabıta Müdürlüğü', 'Yusuf Erhan KAYA', 5),
(4, 'Veteriner İşleri Müdürlüğü', 'Cevat ALTINTAŞ', 1),
(4, 'Afet İşleri ve Risk Yönetimi Müdürlüğü', 'Soner BİLİR', 2),
(4, 'Yazı İşleri Müdürlüğü', 'Bahar ÖZALP', 3),
(4, 'İklim Değişikliği ve Sıfır Atık Müdürlüğü', 'Kader DURAN', 4),
(5, 'Gençlik ve Spor Hizmetleri Müdürlüğü', 'Hacı KEY', 1),
(5, 'Basın Yayın ve Halkla İlişkiler Müdürlüğü', 'Dr. Yusuf ATASEVEN', 2),
(5, 'Kültür İşleri Müdürlüğü', 'Carullah Recai ER', 3),
(5, 'Kadın ve Aile Hizmetleri Müdürlüğü', 'Zeynep YÜKSEL', 4);