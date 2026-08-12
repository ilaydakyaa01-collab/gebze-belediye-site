-- =====================================================================
-- HİZMETLER SAYFASI VERİTABANI ŞEMASI
-- =====================================================================
-- Bu dosyayı phpMyAdmin > gebze_belediye veritabanı > "İçe Aktar" (Import)
-- sekmesinden yükleyerek iki yeni tablo oluşturabilirsiniz:
--   1) hizmet_kategorileri  -> Dizin panosundaki 9 kategori (Atölyeler, Kütüphane, vb.)
--   2) hizmet_kartlari      -> Her kategorinin altındaki kartlar
--
-- Not: Mevcut "hizmetler" tablonuza DOKUNMUYORUZ, o başka bir amaç için
-- kullanılıyor. Bu yüzden yeni tablolara farklı isimler verdik.
-- =====================================================================

-- ------------------------------------------------
-- 1) KATEGORİLER TABLOSU
-- ------------------------------------------------
CREATE TABLE IF NOT EXISTS `hizmet_kategorileri` (
    `id`        INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `slug`      VARCHAR(60)  NOT NULL,                 -- URL/anchor için: 'atolyeler', 'kutuphane' ...
    `no`        VARCHAR(4)   NOT NULL DEFAULT '',       -- Dizin panosunda görünen numara: '01', '02' ...
    `baslik`    VARCHAR(150) NOT NULL,                  -- 'Atölyeler'
    `aciklama`  VARCHAR(255) DEFAULT NULL,               -- Bölüm başlığının altındaki kısa açıklama
    `sira`      INT UNSIGNED NOT NULL DEFAULT 0,         -- Sıralama (dizinde ve sayfada bu sırayla görünür)
    `aktif`     TINYINT(1)   NOT NULL DEFAULT 1,         -- 0 yapılırsa sayfada gösterilmez
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- ------------------------------------------------
-- 2) KARTLAR TABLOSU (her kategorinin altındaki hizmetler)
-- ------------------------------------------------
CREATE TABLE IF NOT EXISTS `hizmet_kartlari` (
    `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `kategori_id`   INT UNSIGNED NOT NULL,
    `baslik`        VARCHAR(180) NOT NULL,
    `aciklama`      VARCHAR(255) DEFAULT NULL,
    `gorsel`        VARCHAR(255) DEFAULT NULL,           -- ör: img/hizmetler/enderun.jpg (boş kalabilir)
    `link`          VARCHAR(255) DEFAULT '#',             -- Detay sayfası linki
    `sira`          INT UNSIGNED NOT NULL DEFAULT 0,
    `aktif`         TINYINT(1)   NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`),
    KEY `fk_kategori_id` (`kategori_id`),
    CONSTRAINT `fk_hizmet_kartlari_kategori`
        FOREIGN KEY (`kategori_id`) REFERENCES `hizmet_kategorileri` (`id`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- =====================================================================
-- ÖRNEK VERİLER (İSTERSENİZ SİLİP KENDİ VERİLERİNİZİ EKLEYEBİLİRSİNİZ)
-- =====================================================================

INSERT INTO `hizmet_kategorileri` (`slug`, `no`, `baslik`, `aciklama`, `sira`, `aktif`) VALUES
('atolyeler',              '01', 'Atölyeler',                              'Çocuklar ve gençler için ücretsiz atölye ve eğitim programları.', 1, 1),
('kutuphane',               '02', 'Kütüphane',                              'Gebze genelindeki halk kütüphaneleri ve okuma salonları.',         2, 1),
('bebek-cocuk-bakimevi',    '03', 'Bebek ve Çocuk Bakımevi',                'Ailelere destek amaçlı bebek ve çocuk bakım hizmetleri.',          3, 1),
('mesire-alani',            '04', 'Mesire Alanı',                          'Aileler için piknik ve doğa alanları.',                            4, 1),
('merkezler',               '05', 'Merkezler',                             'Halk eğitim, sağlık ve sosyal yaşam merkezleri.',                  5, 1),
('geri-donusum',            '06', 'Geri Dönüşüm',                          'Atık toplama noktaları ve geri dönüşüm hizmetleri.',               6, 1),
('evlendirme',              '07', 'Evlendirme',                            'Nikah başvuru ve salon hizmetleri.',                               7, 1),
('egitimler',               '08', 'Eğitimler',                             'Yetişkinlere yönelik meslek edindirme ve gelişim kursları.',       8, 1),
('hunkar-cayiri',           '09', 'Geleneksel Hünkar Çayırı Yağlı Güreşleri','Her yıl düzenlenen geleneksel yağlı güreş etkinliği.',            9, 1);

-- Kategori id'leri yukarıdaki sırayla 1..9 olacaktır (temiz bir tabloya
-- aktarıyorsanız). Kartları da buna göre ekliyoruz:

INSERT INTO `hizmet_kartlari` (`kategori_id`, `baslik`, `aciklama`, `gorsel`, `link`, `sira`, `aktif`) VALUES
(1, 'Enderun Çocuk Atölyeleri',            'Sanat, müzik ve el becerisi ağırlıklı çocuk atölyeleri.',        '', '#', 1, 1),
(1, 'Sportif Çocuk Atölyesi',              'Futsal, cimnastik, okçuluk ve daha fazlası — 5-8 yaş.',          '', '#', 2, 1),
(1, 'Güzide Gençlik Merkezi Atölyeleri',   'Gençlere yönelik beceri ve gelişim atölyeleri.',                 '', '#', 3, 1),

(2, 'Merkez Kütüphane',                    'Geniş koleksiyon ve sessiz çalışma alanları.',                   '', '#', 1, 1),
(2, 'Çocuk Kütüphanesi',                   'Çocuklara özel kitap ve etkinlik alanı.',                        '', '#', 2, 1),

(3, 'Gündüz Bakımevi',                     'Uzman personel eşliğinde güvenli bakım hizmeti.',                '', '#', 1, 1),

(4, 'Eskihisar Mesire Alanı',              'Deniz kıyısında piknik ve dinlenme alanı.',                      '', '#', 1, 1),
(4, 'Sultan Orhan Mesire Alanı',           'Yeşil alan içinde yürüyüş ve piknik imkânı.',                    '', '#', 2, 1),

(5, 'Kadın ve Aile Yaşam Merkezi',         'Kadınlara yönelik eğitim ve destek programları.',                '', '#', 1, 1),
(5, 'Engelli Yaşam Merkezi',               'Engelli bireylere yönelik rehabilitasyon hizmetleri.',           '', '#', 2, 1),

(6, 'Sıfır Atık Noktaları',                'Mahalle bazlı sıfır atık toplama istasyonları.',                 '', '#', 1, 1),

(7, 'Nikah Salonu Randevu',                'Online randevu ve gerekli evrak bilgileri.',                     '', '#', 1, 1),

(8, 'Meslek Edindirme Kursları',           'Ücretsiz sertifikalı kurs programları.',                         '', '#', 1, 1),

(9, 'Etkinlik Programı',                   'Tarih, güreşçi kayıtları ve alan bilgisi.',                      '', '#', 1, 1);
