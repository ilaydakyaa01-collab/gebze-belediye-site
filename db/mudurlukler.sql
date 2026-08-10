-- Müdürlükler tablosu
-- phpMyAdmin > gebze_belediye veritabanı > İçe Aktar sekmesinden bu dosyayı yükle
-- NOT: resim sütunu yerel dosya yollarını tutuyor, fotoğrafları
-- img/mudurlukler/ klasörüne o isimlerle koymuş olman gerekiyor.

CREATE TABLE `mudurlukler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(150) NOT NULL,
  `sorumlu_adi` varchar(100) NOT NULL,
  `resim` varchar(255) NOT NULL,
  `eposta` varchar(150) DEFAULT NULL,
  `sira` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `mudurlukler` (`ad`, `sorumlu_adi`, `resim`, `eposta`, `sira`) VALUES
('Afet İşleri ve Risk Yönetimi Müdürlüğü', 'Soner BİLİR', 'img/mudurlukler/soner-bilir.jpg', 'afet.isleri@gebze.bel.tr', 1),
('Basın Yayın ve Halkla İlişkiler Müdürlüğü', 'Dr. Yusuf ATASEVEN', 'img/mudurlukler/yusuf-ataseven.jpg', 'basin@gebze.bel.tr', 2),
('Bilgi İşlem Müdürlüğü', 'Mehmet UÇAR', 'img/mudurlukler/mehmet-ucar.jpg', 'bilgiislem@gebze.bel.tr', 3),
('Destek Hizmetleri Müdürlüğü', 'Hamza Melih MALKOÇ', 'img/mudurlukler/hamza-melih-malkoc.jpg', 'destek@gebze.bel.tr', 4),
('Emlak ve İstimlak Müdürlüğü', 'Şaban SARIAY', 'img/mudurlukler/saban-sariay.jpg', 'emlak@gebze.bel.tr', 5),
('Etüt ve Proje Müdürlüğü', 'Asker ÇOBAN', 'img/mudurlukler/asker-coban.jpg', 'etutproje@gebze.bel.tr', 6),
('Fen İşleri Müdürlüğü', 'Cezmi IRVA', 'img/mudurlukler/cezmi-irva.jpg', 'fenisleri@gebze.bel.tr', 7),
('Gelirler Müdürlüğü', 'Erhan HORUZ', 'img/mudurlukler/erhan-horuz.jpg', 'gelirler@gebze.bel.tr', 8),
('Gençlik ve Spor Hizmetleri Müdürlüğü', 'Hacı KEY', 'img/mudurlukler/haci-key.jpg', 'genclik.spor@gebze.bel.tr', 9),
('Hukuk İşleri Müdürlüğü', 'Av. Murat TUNCA', 'img/mudurlukler/murat-tunca.jpg', 'hukuk@gebze.bel.tr', 10),
('İklim Değişikliği ve Sıfır Atık Müdürlüğü', 'Kader DURAN', 'img/mudurlukler/kader-duran.jpg', 'iklimdegisikligi@gebze.bel.tr', 11),
('İmar ve Şehircilik Müdürlüğü', 'Mücahit KÖKSAL', 'img/mudurlukler/mucahit-koksal.png', 'imar@gebze.bel.tr', 12),
('İnsan Kaynakları ve Eğitim Müdürlüğü', 'Mustafa KARATAŞ', 'img/mudurlukler/mustafa-karatas.jpg', 'personel@gebze.bel.tr', 13),
('İşletme ve İştirakler Müdürlüğü', 'Yücel ER', 'img/mudurlukler/yucel-er.jpg', 'isletme.istirak@gebze.bel.tr', 14),
('Kadın ve Aile Hizmetleri Müdürlüğü', 'Zeynep YÜKSEL', 'img/mudurlukler/zeynep-yuksel.jpg', 'kadinailehizmetleri@gebze.bel.tr', 15),
('Kültür İşleri Müdürlüğü', 'Carullah Recai ER', 'img/mudurlukler/carullah-recai-er.jpg', 'kultur@gebze.bel.tr', 16),
('Makine İkmal, Bakım ve Onarım Müdürlüğü', 'Dursun Ali YAYLA', 'img/mudurlukler/dursun-ali-yayla.jpg', 'dursun.yayla@gebze.bel.tr', 17),
('Mali Hizmetler Müdürlüğü', 'İsmail DENK', 'img/mudurlukler/ismail-denk.jpg', 'malihizmetler@gebze.bel.tr', 18),
('Mezarlıklar Müdürlüğü', 'İslam ÖZDAĞ', 'img/mudurlukler/islam-ozdag.jpg', 'mezarlik@gebze.bel.tr', 19),
('Özel Kalem Müdürlüğü', 'Mücahit BİRBEN', 'img/mudurlukler/mucahit-birben.jpg', 'ozelkalem@gebze.bel.tr', 20),
('Park ve Bahçeler Müdürlüğü', 'Tuncay TÜRETKEN', 'img/mudurlukler/tuncay-turetken.jpg', 'parkbahceler@gebze.bel.tr', 21),
('Plan ve Proje Müdürlüğü', 'Yusuf BURKUT', 'img/mudurlukler/yusuf-burkut.jpg', 'planproje@gebze.bel.tr', 22),
('Rehberlik ve Teftiş Kurulu Müdürlüğü', 'Hasan GÜLER', 'img/mudurlukler/hasan-guler.jpg', 'teftis@gebze.bel.tr', 23),
('Ruhsat ve Denetim Müdürlüğü', 'Abdullah Talha AKYÜZ', 'img/mudurlukler/abdullah-talha-akyuz.jpg', 'ruhsat@gebze.bel.tr', 24),
('Sosyal Destek Hizmetleri Müdürlüğü', 'Mecit KESKİNOĞLU', 'img/mudurlukler/mecit-keskinoglu.jpg', 'sosyalyardim@gebze.bel.tr', 25),
('Temizlik İşleri Müdürlüğü', 'Senay ALTINTAŞ', 'img/mudurlukler/senay-altintas.jpg', 'temizlikisleri@gebze.bel.tr', 26),
('Veteriner İşleri Müdürlüğü', 'Cevat ALTINTAŞ', 'img/mudurlukler/cevat-altintas.jpg', 'veteriner@gebze.bel.tr', 27),
('Yapı Kontrol Müdürlüğü', 'Abdulkadir AKKURT', 'img/mudurlukler/abdulkadir-akkurt.jpg', NULL, 28),
('Yazı İşleri Müdürlüğü', 'Bahar ÖZALP', 'img/mudurlukler/bahar-ozalp.jpg', 'yaziisleri@gebze.bel.tr', 29),
('Zabıta Müdürlüğü', 'Yusuf Erhan KAYA', 'img/mudurlukler/yusuf-erhan-kaya.jpg', 'zabita@gebze.bel.tr', 30);