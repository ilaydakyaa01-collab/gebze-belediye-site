-- =====================================================================
-- HİZMETLER SAYFASI VERİTABANI ŞEMASI (v2)
-- -----------------------------------------------------------------
-- Bu şema, güncel hizmetler.php dosyasıyla (müdürlük gruplu + modal
-- pencereli tasarım) EŞLEŞECEK şekilde hazırlandı.
--
-- ÖNEMLİ: Daha önce paylaştığım "hizmet_kategorileri" ve
-- "hizmet_kartlari" tabloları bu yeni hizmetler.php ile UYUMLU DEĞİL
-- (kod artık farklı bir tablo ve sütun yapısı bekliyor). O iki tabloyu
-- zaten oluşturduysanız ve başka bir yerde kullanmıyorsanız, en alttaki
-- isteğe bağlı DROP satırlarıyla temizleyebilirsiniz.
--
-- Bu dosyayı phpMyAdmin > gebze_belediye veritabanı > "İçe Aktar"
-- sekmesinden yükleyin.
-- =====================================================================

CREATE TABLE IF NOT EXISTS `hizmet_listesi` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `mudurluk`   VARCHAR(150) NOT NULL,            -- Grup başlığı: 'Atölyeler', 'Kütüphane' vb.
    `hizmet_adi` VARCHAR(180) NOT NULL,             -- Kart başlığı: 'Enderun Çocuk Atölyeleri'
    `aciklama`   VARCHAR(255) DEFAULT NULL,          -- Kartın altındaki kısa açıklama
    `detay`      TEXT DEFAULT NULL,                  -- Modal pencerede gösterilen uzun açıklama
    `ikon`       VARCHAR(60)  DEFAULT 'bi-gear',      -- Bootstrap Icons sınıfı, örn: 'bi-book', 'bi-heart'
    `link`       VARCHAR(255) DEFAULT NULL,           -- Modal'daki "Bu Hizmete Git" linki (boş bırakılabilir)
    `sira`       INT UNSIGNED NOT NULL DEFAULT 0,     -- Aynı müdürlük içinde sıralama
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- =====================================================================
-- ÖRNEK VERİLER (İSTERSENİZ SİLİP KENDİ VERİLERİNİZİ EKLEYEBİLİRSİNİZ)
-- =====================================================================

INSERT INTO `hizmet_listesi` (`mudurluk`, `hizmet_adi`, `aciklama`, `detay`, `ikon`, `link`, `sira`) VALUES
('Atölyeler', 'Enderun Çocuk Atölyeleri', 'Sanat, müzik ve el becerisi ağırlıklı çocuk atölyeleri.', 'Enderun Çocuk Atölyeleri, çocukların yaratıcılığını geliştirmeye yönelik sanat, müzik ve el becerisi programlarını kapsar. Kayıtlar dönemsel olarak açılır.', 'bi-palette', '', 1),
('Atölyeler', 'Sportif Çocuk Atölyesi', 'Futsal, cimnastik, okçuluk ve daha fazlası — 5-8 yaş.', '5-8 yaş grubundaki çocuklara yönelik futsal, cimnastik, basketbol, voleybol, okçuluk, masa tenisi, tenis ve badminton branşlarını kapsayan ücretsiz atölye programıdır.', 'bi-trophy', '', 2),
('Atölyeler', 'Güzide Gençlik Merkezi Atölyeleri', 'Gençlere yönelik beceri ve gelişim atölyeleri.', 'Gençlerin kişisel ve sosyal gelişimini desteklemek amacıyla düzenlenen atölye ve etkinlik programlarıdır.', 'bi-people', '', 3),

('Kütüphane', 'Merkez Kütüphane', 'Geniş koleksiyon ve sessiz çalışma alanları.', 'Gebze Merkez Kütüphanesi, geniş bir kitap koleksiyonu ile sessiz çalışma ve okuma salonları sunar.', 'bi-book', '', 1),
('Kütüphane', 'Çocuk Kütüphanesi', 'Çocuklara özel kitap ve etkinlik alanı.', 'Çocuklara yönelik kitap koleksiyonu ve düzenli okuma etkinlikleriyle çocukların kitap sevgisini desteklemeyi amaçlar.', 'bi-book-half', '', 2),

('Bebek ve Çocuk Bakımevi', 'Gündüz Bakımevi', 'Uzman personel eşliğinde güvenli bakım hizmeti.', 'Çalışan ailelere destek amacıyla uzman personel eşliğinde sunulan güvenli gündüz bakım hizmetidir.', 'bi-heart', '', 1),

('Mesire Alanı', 'Eskihisar Mesire Alanı', 'Deniz kıyısında piknik ve dinlenme alanı.', 'Deniz manzaralı Eskihisar Mesire Alanı, aileler için piknik ve dinlenme imkânı sunar.', 'bi-tree', '', 1),
('Mesire Alanı', 'Sultan Orhan Mesire Alanı', 'Yeşil alan içinde yürüyüş ve piknik imkânı.', 'Geniş yeşil alanı ile yürüyüş ve piknik yapmak isteyenler için uygun bir mesire alanıdır.', 'bi-tree-fill', '', 2),

('Merkezler', 'Kadın ve Aile Yaşam Merkezi', 'Kadınlara yönelik eğitim ve destek programları.', 'Kadınların sosyal ve ekonomik hayata katılımını desteklemek amacıyla eğitim ve danışmanlık hizmetleri sunar.', 'bi-gender-female', '', 1),
('Merkezler', 'Engelli Yaşam Merkezi', 'Engelli bireylere yönelik rehabilitasyon hizmetleri.', 'Engelli bireylerin yaşam kalitesini artırmaya yönelik rehabilitasyon ve destek hizmetleri sunulmaktadır.', 'bi-universal-access', '', 2),

('Geri Dönüşüm', 'Sıfır Atık Noktaları', 'Mahalle bazlı sıfır atık toplama istasyonları.', 'Gebze genelinde mahalle bazlı yerleştirilmiş sıfır atık toplama istasyonlarının konum ve bilgilerini içerir.', 'bi-recycle', '', 1),

('Evlendirme', 'Nikah Salonu Randevu', 'Online randevu ve gerekli evrak bilgileri.', 'Nikah salonu için online randevu alma, gerekli evraklar ve ücret bilgilerine buradan ulaşabilirsiniz.', 'bi-heart-fill', '', 1),

('Eğitimler', 'Meslek Edindirme Kursları', 'Ücretsiz sertifikalı kurs programları.', 'Gebze Belediyesi tarafından düzenlenen ücretsiz, sertifikalı meslek edindirme kurs programlarıdır.', 'bi-mortarboard', '', 1),

('Etkinlikler', 'Geleneksel Hünkar Çayırı Yağlı Güreşleri', 'Her yıl düzenlenen geleneksel yağlı güreş etkinliği.', 'Her yıl Hünkar Çayırı''nda düzenlenen, geleneksel yağlı güreş kültürünü yaşatan etkinliktir.', 'bi-award', '', 1);

-- =====================================================================
-- İSTEĞE BAĞLI: Eski (kullanılmayan) tabloları temizlemek isterseniz
-- aşağıdaki iki satırın başındaki "-- " işaretini kaldırıp çalıştırın.
-- =====================================================================
-- DROP TABLE IF EXISTS `hizmet_kartlari`;
-- DROP TABLE IF EXISTS `hizmet_kategorileri`;
