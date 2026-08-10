-- Müdürlükler tablosuna gerekli sütunları ekle (varsa hata vermez, MariaDB destekler)
ALTER TABLE `mudurlukler` ADD COLUMN IF NOT EXISTS `biyografi` TEXT DEFAULT NULL AFTER `eposta`;
ALTER TABLE `mudurlukler` ADD COLUMN IF NOT EXISTS `yonetmelik` TEXT DEFAULT NULL AFTER `biyografi`;

-- Sadece gerçek siteden doğrulanmış 3 müdürlüğün verisi (diğerleri boş bırakıldı, uydurulmadı)

UPDATE `mudurlukler`
SET `biyografi` = 'Soner BİLİR, 1976 Artvin doğumlu olup inşaat mühendisliği ve iş sağlığı-güvenliği alanlarında eğitim almıştır. Kamu görevine 2001 yılında arama kurtarma birliğinde başlamış, 2015 yılında Gebze Belediyesi''ne geçmiştir. Haziran 2024''ten bu yana Afet İşleri Müdür Vekili olarak görev yapmaktadır.',
    `yonetmelik` = 'Yönetmeliğin amacı, müdürlüğün afet öncesi hazırlık, afet esnasında müdahale ve afet sonrası iyileştirme faaliyetlerindeki görev, yetki ve sorumluluklarını; Türkiye Afet Müdahale Planı (TAMP) doğrultusunda belediye personelinin eğitim, teşkilat ve akreditasyon süreçlerini, kurumlar arası koordinasyon ile arama-kurtarma çalışmalarının usul ve esaslarını düzenlemektir.'
WHERE `ad` = 'Afet İşleri ve Risk Yönetimi Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Yönetmeliğin amacı, Bilgi İşlem Müdürlüğü''nün teşkilat yapısını, hukuki statüsünü, görev, yetki ve çalışma usul ve esaslarını belirleyerek hizmetlerin daha etkin ve verimli yürütülmesini sağlamaktır. Yönetmelik; yazılım geliştirme, bilgi teknolojileri ve web tasarım servislerinin görev ve sorumluluklarını kapsar.'
WHERE `ad` = 'Bilgi İşlem Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Yönetmelik, Destek Hizmetleri Müdürlüğü''nün kuruluş, görev, yetki ve sorumlulukları ile çalışma usul ve esaslarını kapsar; 5393 sayılı Belediye Kanunu ve ilgili mevzuat çerçevesinde satın alma işlemleri ile küçük onarımlar dahil yapıma ilişkin işlerin yürütülmesini düzenler.'
WHERE `ad` = 'Destek Hizmetleri Müdürlüğü';


-- Müdürlükler - 2. parti doğrulanmış gerçek veri (3 müdürlük daha)

UPDATE `mudurlukler`
SET `biyografi` = '1965 yılında Aksaray''da doğan Şaban SARIAY, lise öğrenimini İzmit Endüstri Meslek Lisesi''nde tamamladı. 1991 yılında Selçuk Üniversitesi Mimarlık Mühendislik Fakültesi''nden mezun oldu. Özel sektörde 2 yıl çalıştıktan sonra 1993''te Karamürsel Belediyesi''nde Harita Mühendisi, 1995''te İhsaniye Belediyesi''nde Fen İşleri amiri olarak görev yaptı. 1996''dan itibaren Gebze Belediyesi''nde çeşitli müdürlüklerde (Harita-Emlak İstimlak, İmar, Fen İşleri) çalıştıktan sonra 2016''dan bu yana Emlak ve İstimlak Müdürlüğü görevini yürütmektedir. Evli ve üç çocuk babasıdır.',
    `yonetmelik` = 'Yönetmeliğin amacı; 5393 sayılı Belediye Kanunu''nun 48. maddesi ve ISO 9001-2015 kapsamında müdürlüğün görev, çalışma usul ve esaslarını belirlemektir. Yönetmelik; müdürlüğün görev, yetki ve sorumluluklarını, çalışma usul ve esaslarını, işbirliği ve diğer birimlerle olan koordinasyonunu kapsar. Müdürlük, Belediye Başkanına veya Başkan Yardımcısına bağlı olarak; imar uygulamaları, tevhid-ifraz-yola terk işlemleri ve belediyeye ait hisselerin satışı gibi konularda görev yapar.'
WHERE `ad` = 'Emlak ve İstimlak Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Gebze Belediyesi İmar ve Şehircilik Müdürlüğü, 5393 sayılı Belediye Kanunu''nun 48. maddesi dikkate alınarak kurulmuş bir birim müdürlüğüdür. Müdürlük; Proje Onay Bürosu, Yapı Kontrol Bürosu, Kaçak Yapı Bürosu, İmar Kalem Birimi ve İmar Arşiv Birimi alt birimlerinden oluşur. Gebze Belediyesi İmar ve Şehircilik Müdürlüğü, "yerel hizmetleri adil, etkin ve sürekli biçimde sunma" misyonu ve "kenti yaşatan, kenti yaşanan olma" vizyonuyla; insan hak ve özgürlükleri çerçevesinde çağdaş ve sosyal belediyecilik ilkesine bağlı kalarak, hizmette kalite ve vatandaş memnuniyetini esas alan bir çalışma yürütür.'
WHERE `ad` = 'İmar ve Şehircilik Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Bu yönetmeliğin amacı; 5393 sayılı Belediyeler Kanunu''nun 48. ve 49. maddeleri çerçevesinde Etüt ve Proje Müdürlüğü''nün görev, yetki ve sorumluluklarını belirlemektir. Müdür; müdürlükle ilgili tüm hizmetleri belediye adına takip ve kontrol ederek sonuçlandırır, personel ile düzenli iletişim sağlar, aylık ve yıllık çalışma programları hazırlayarak müdürlüğün performansını izler ve değerlendirir.'
WHERE `ad` = 'Etüt ve Proje Müdürlüğü';


-- Müdürlükler - 3. parti doğrulanmış gerçek veri (3 müdürlük daha)

UPDATE `mudurlukler`
SET `biyografi` = '25.06.1986 tarihinde Ankara''da doğdu. İlk ve ortaokulu Adana''da, liseyi Erzurum Lisesi''nde tamamladı. 2003 yılında Gaziantep Üniversitesi Gıda Mühendisliği Bölümü''ne yerleşti; aynı bölümden 2008, 2011 ve 2018''de sırasıyla lisans, yüksek lisans ve doktora derecelerini aldı, 8 yıl Araştırma Görevlisi olarak çalıştı. 2019''da Gaziantep Büyükşehir Belediyesi''ne geçti. Nisan 2020''de Gebze Belediyesi bünyesine katıldı, Ağustos 2020''de Ruhsat ve Denetim Müdür Vekili oldu. Aralık 2025''ten itibaren Gelirler Müdür Vekili olarak görev yapmaktadır.'
WHERE `ad` = 'Gelirler Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Zabıta Müdürlüğü, 5393 sayılı Belediye Kanunu''nun 48. maddesine dayanılarak Gebze Belediye Meclisi''nin 07.09.2006 tarihli kararı gereğince kurulmuştur. Müdürlük; Zabıta Müdürü, Ekipler Amiri, Amir, Komiser ve Memurlardan oluşur. Bünyesinde Yazı İşleri ve Personel, Denetim, Semt Pazarları, Alo Şikayet, Trafik ve Eğitim Okulu, İdari İşler, Çarşı ve Seyyar, Terminal, Beylikbağı, İmar, Mollafenari ve Nöbetçi Grup Zabıta Amirlikleri bulunur. Müdürlük ayrıca okul öncesi ve ilköğretim öğrencilerine trafik eğitimi verir.'
WHERE `ad` = 'Zabıta Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'İşletme ve İştirakler Müdürlüğü, Belediye Başkanına veya görevlendireceği Başkan Yardımcısına bağlı olarak çalışır. Müdürlüğe atanacak personelin unvan ve nitelikleri, 657 sayılı Devlet Memurları Kanunu ile İl Özel İdareleri ve Belediyelerin Görevde Yükselme ve Unvan Değişikliği Esaslarına Dair Yönetmelik doğrultusunda belirlenir.'
WHERE `ad` = 'İşletme ve İştirakler Müdürlüğü';


-- Düzeltme: Etüt ve Proje yönetmeliği yanlış müdürlük adıyla yazılmıştı, düzeltildi
UPDATE `mudurlukler`
SET `yonetmelik` = 'Müdür; müdürlükle ilgili tüm hizmetleri belediye adına takip ve kontrol ederek sonuçlandırır, personel ile düzenli iletişim sağlar, resmi yazışma ve çalışmalara onay verir, diğer müdürlükler arasındaki iletişimi sağlar. Müdürlüğün görev alanına giren konularda personel görevlendirmesi yapar, büro ve büro sorumlularını belirler, faaliyetleri denetler. Aylık ve yıllık çalışma programları hazırlayarak müdürlüğün performans durumunu izler ve değerlendirir.'
WHERE `ad` = 'Etüt ve Proje Müdürlüğü';

-- Kültür İşleri Müdürlüğü - gerçek yönetmelik verisi (biyografi doğrulanamadığı için eklenmedi)
UPDATE `mudurlukler`
SET `yonetmelik` = 'Bu yönetmeliğin amacı, Kültür İşleri Müdürlüğü''nün görev alanını, sorumluluk ve yetkilerini, görevlerin yerine getirilişini ve yetkilerin kullanımında başvurulacak yöntemleri belirlemektir. Müdürlük; ilçenin tarihi kimliğini yaşatmak ve turizme katkı amacıyla dokümantasyon oluşturur, kültürel etkinliklere yönelik tanıtım materyalleri hazırlar, özel gün ve haftalarda yarışma ve turnuvalar düzenler, kültür merkezleri için gerekli hazırlıkları yapar ve Belediye Başkanlığı''nca verilen yetkiyle nikah akitlerini gerçekleştirir.'
WHERE `ad` = 'Kültür İşleri Müdürlüğü';

UPDATE `mudurlukler`
SET `biyografi` = '07.01.1993 Gebze doğumludur. İlkokul ve ortaokulu Gebze''de, liseyi Gebze Sarkuysan Anadolu Lisesi''nde tamamladı. 2015 yılında Samsun Ondokuz Mayıs Üniversitesi''nden mezun olarak Çevre Görevlisi belgesi almaya hak kazandı. Altyapı, çevre teknolojileri ve atık yönetimi alanlarında çeşitli firmalarda çalıştı. 2016''da Gebze Belediyesi Çevre Koruma ve Kontrol servisinde Çevre Mühendisi olarak göreve başladı. Ekim 2021''de Temizlik İşleri Müdürü, Haziran 2024''ten itibaren Mezarlıklar Müdürü olarak görev yapmaktadır. Evli ve 2 çocuk babasıdır.',
    `yonetmelik` = 'Yönetmeliğin amacı, cenazenin ölümünden defnine kadar bütün iş ve işlemlerin usullerini belirlemektir. Yönetmelik; cenazelerin yıkattırılması, kefenlenmesi, nakli, defni ve gerektiğinde mezarlıktan tekrar çıkartılması ile sağlık açısından sakıncalı cenazelerin defnedilme usul ve esaslarını kapsar. 1930 tarihli Umumi Hıfzıssıhha Kanunu''na dayanılarak hazırlanmıştır.'
WHERE `ad` = 'Mezarlıklar Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Bu yönetmelik, Gebze Belediye Başkanlığı Ruhsat ve Denetim Müdürlüğü''nün görev, yetki ve sorumluluk alanları ile ilgili çalışma esaslarını belirlemek amacıyla düzenlenmiştir. Yönetmelik, müdürlüğün görev, yetki ve sorumluluklarını kapsar; 5393 sayılı Belediye Kanunu''nun 18/m maddesi gereğince hazırlanan çalışma yönetmeliği Ekim 2019''da Belediye Meclisi''ne sunulmuştur.'
WHERE `ad` = 'Ruhsat ve Denetim Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Bu yönetmeliğin amacı, Gebze Belediyesi Fen İşleri Müdürlüğü''nün kuruluş, görev ve çalışma esaslarını düzenlemektir. Yönetmelik; müdürlüğün kuruluşuna, görevlerine, yetki ve sorumluluklarına ilişkin esas ve usulleri kapsar. Fen İşleri Müdürlüğü, Belediye Başkanına veya görevlendireceği Başkan Yardımcısına bağlıdır ve şehrin cadde, sokak ve meydanlarının plana uygun düzenlenmesi, umuma açık köprülerin inşa ve idamesi gibi görevleri yürütür.'
WHERE `ad` = 'Fen İşleri Müdürlüğü';

UPDATE `mudurlukler`
SET `biyografi` = '1979 yılında Darıca''da doğan Mecit KESKİNOĞLU, ön lisans eğitimini 2001''de Ege Üniversitesi Endüstriyel Otomasyon bölümünde, lisans eğitimini 2016''da Anadolu Üniversitesi İşletme Fakültesi''nde, 2019''da Sosyal Hizmetler alanında, yüksek lisansını 2022''de Ahmet Yesevi Üniversitesi Siber Güvenlik bölümünde tamamladı. 2002-2006 arası Koç Şirketler Grubu''nda, 2006-2013 arası aile şirketinde yönetim kurulu başkanlığı yaptı. 2013''te Tapu ve Kadastro Genel Müdürlüğü''nde memur olarak görev aldı.',
    `yonetmelik` = 'Bu yönetmelik, belediye sınırları içinde belediyece yapılacak sosyal yardımlar ile bu yardımlardan faydalananları ve faydalanacak durumda olanları kapsar. 5393 sayılı Belediye Kanunu''nun ilgili maddelerine dayanılarak hazırlanmıştır.'
WHERE `ad` = 'Sosyal Destek Hizmetleri Müdürlüğü';

UPDATE `mudurlukler`
SET `biyografi` = '1964 yılında Trabzon Sürmene''de doğdu. İlk, orta ve lise eğitimini Sürmene''de tamamladı. 1987''de İstanbul Üniversitesi Veteriner Fakültesi''nde lisans ve yüksek lisans eğitimini tamamladı. Sakarya''da 2 yıl özel veteriner kliniği işletti. 1989''da Çatalağzı ve Zonguldak Belediyelerinde 5 yıl Veteriner Hekim olarak görev yaptı. 1994''te yatay geçişle Gebze Belediyesi''ne atandı, Mezbaha ve Veteriner İşleri Müdürlüğü görevini üstlendi. Sokak hayvanlarına yönelik birçok sosyal sorumluluk projesinde bulunmuştur. Evli ve 4 çocuk babasıdır.',
    `yonetmelik` = 'Bu yönetmeliğin amacı, Veteriner İşleri Müdürlüğü''nün 5393 sayılı Belediye Kanunu''nun 48. maddesi ve ISO 9001-2015 kapsamında görev, çalışma usul ve esaslarını belirlemektir. Yönetmelik; müdürlüğün kuruluş, görev, yetki ve sorumluluklarını kapsar. Müdürlük, Belediye Başkanına veya görevlendireceği Başkan Yardımcısına bağlı olarak; salgın hastalık durumlarında ilgili kurumları haberdar etme ve gerekli tedbirlerin alınmasına yardımcı olma gibi görevleri yürütür.'
WHERE `ad` = 'Veteriner İşleri Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Bu yönetmeliğin amacı; 5393 sayılı Belediyeler Kanunu''nun 48. ve 49. maddeleri gereği, 10.04.2007 tarihli Belediye Meclis kararı ile yeniden adlandırılan Plan ve Proje Müdürlüğü''nün görev, yetki ve çalışma usul ve esaslarını belirlemektir. Müdürlük; belediye sınırları içindeki 1/1000 ölçekli uygulama imar planlarının hazırlanması, üst ölçekli imar planlarının Kocaeli Büyükşehir Belediyesi ile takibi, imar planlarıyla ilgili vatandaş ve resmi kurum yazışmaları ile belediyenin yapacağı yapıların projelerinin hazırlanmasından sorumludur.'
WHERE `ad` = 'Plan ve Proje Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Bu yönetmeliğin amacı, Hukuk İşleri Müdürlüğü''nün görev, çalışma teşkilat yapısını, işleyişini, yetkileri ile sorumluluğunu düzenlemektir. Müdürlük avukatları; 1136 sayılı Avukatlık Kanunu çerçevesinde adli, idari ve mali yargı yerlerinde Belediye Başkanlığı lehine dava açmak, takip başlatmak ve aleyhte açılmış tüm dava ve icra-iflas takiplerini yürütüp sonuçlandırmakla görevlidir. Bu kapsamda ilk derece mahkemeleri, Bölge Adliye Mahkemesi, Bölge İdare Mahkemesi, Yargıtay ve Danıştay''daki duruşma ve keşiflere katılırlar.'
WHERE `ad` = 'Hukuk İşleri Müdürlüğü';

UPDATE `mudurlukler`
SET `adres` = 'Mevlana Mahallesi Issıkgöl Caddesi No: 111'
WHERE `ad` = 'İklim Değişikliği ve Sıfır Atık Müdürlüğü';

UPDATE `mudurlukler`
SET `adres` = 'Kirazpınar Mahallesi Yeni Bağdat Caddesi No: 883/A'
WHERE `ad` = 'Temizlik İşleri Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Bu yönetmeliğin amacı, Park ve Bahçeler Müdürlüğü''nün kuruluş, görev, yetki ve sorumlulukları ile çalışma usul ve esaslarını düzenlemektir. Müdürlük; Gebze ilçesi sınırlarında yetişkin, genç ve çocukların rekreatif faaliyetlerine hizmet etmek amacıyla parklar içinde yürüyüş yolları, bisiklet yolları, spor alanları ve yeşil alanlar tesis eder. Cadde, sokak ve meydanlarda ağaçlandırma ve yeşil alan düzenlemeleri yaparak ilçe ekolojisine katkıda bulunur ve estetik peyzaj görünümleri oluşturur.'
WHERE `ad` = 'Park ve Bahçeler Müdürlüğü';

UPDATE `mudurlukler`
SET `biyografi` = 'Hatay Altınözü''de doğdu. Hatay İmam Hatip Lisesi''nde okudu, Yerel Yönetimler ve İktisat Fakültesi Kamu Yönetimi Bölümü''nden mezun oldu. Altınkaya Belediyesi''nde göreve başladı, 2002''de Yazı İşleri Müdür Vekili olarak görevlendirildi. 2014''ten itibaren Altınözü Belediyesi''nde sırasıyla Temizlik İşleri Müdürü, Kültür İşleri Müdürü ve İnsan Kaynakları Eğitim Müdürü olarak görev yaptı. 2023''te Gebze Belediyesi''ne geçiş yaparak Yazı İşleri Müdürü olarak atandı, halen bu görevde devam etmektedir.',
    `yonetmelik` = 'Bu yönetmeliğin amacı, Yazı İşleri Müdürlüğü''nün kuruluş, görev, yetki ve sorumlulukları ile çalışma usul ve esaslarını düzenlemektir. Müdürlük; belediyeye posta yoluyla, elektronik ortamda ya da elden gelen dilekçe ve evrakın kaydını yaparak içeriğine göre ilgili birimlere süresi içinde ulaştırılmasını sağlar. Belediye Başkanına veya Başkan Yardımcısına bağlı olarak çalışır.'
WHERE `ad` = 'Yazı İşleri Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Bu yönetmeliğin amacı, Mali Hizmetler Müdürlüğü''nün çalışma usul ve esaslarını düzenlemektir. Yönetmelik; müdürlüğün kuruluş amacı, faaliyet alanları, yönetim statüsü ile yönetici ve diğer personelin görev, yetki ve sorumluluk alanlarını kapsar. 5018 sayılı Kamu Mali Yönetimi ve Kontrol Kanunu, 2464 sayılı Belediye Gelirleri Kanunu ve 5393 sayılı Belediye Kanunu''na dayanılarak hazırlanmıştır.'
WHERE `ad` = 'Mali Hizmetler Müdürlüğü';

UPDATE `mudurlukler`
SET `biyografi` = '1986 yılında Bakırköy''de doğdu. İlk, orta ve lise öğrenimini Gebze''de tamamladı. Süleyman Demirel Üniversitesi Teknik Eğitim Fakültesi Yapı Öğretmenliği Bölümü''nden 2010''da, Sakarya Üniversitesi Mühendislik Fakültesi İnşaat Mühendisliği Bölümü''nden 2018''de mezun oldu. 2013''te Gebze Belediyesi İmar ve Şehircilik Müdürlüğü''nde göreve başladı; Kaçak Yapı biriminde saha ve birim sorumlusu, Etüt ve Proje Müdürlüğü''nde Bakım Onarım Servis Sorumlusu olarak toplam 11 yıl görev yaptı. Aralık 2025''ten itibaren Makine İkmal, Bakım ve Onarım Müdürlüğü görevini yürütmektedir. Evli ve 3 çocuk babasıdır.'
WHERE `ad` = 'Makine İkmal, Bakım ve Onarım Müdürlüğü';

UPDATE `mudurlukler`
SET `biyografi` = '1984 yılında Kadıköy''de doğdu. İlkokulu Kartal Cumhuriyet İlkokulu''nda, ortaokul ve liseyi Kartal İmam Hatip Lisesi''nde okudu. 2006''da Ondokuz Mayıs Üniversitesi Amasya Meslek Yüksekokulu''nu bölüm ikincisi olarak tamamladı, 2012''de Yıldız Teknik Üniversitesi İnşaat Fakültesi''nden İnşaat Mühendisi olarak mezun oldu. Kartal-Tavşantepe Metro Hattı inşaatında çalıştıktan sonra 2014-2023 arası Erzurum Büyükşehir Belediyesi Etüt ve Projeler Daire Başkanlığı''nda görev yaptı. Temmuz 2023''te eş durumu tayiniyle Gebze Belediyesi''ne atandı, Etüt ve Proje Müdürlüğü''nde bir süre çalıştıktan sonra Aralık 2025''ten itibaren Yapı Kontrol Müdür Vekili olarak görevlendirildi.'
WHERE `ad` = 'Yapı Kontrol Müdürlüğü';

-- SON PARTİ: Kalan 8 müdürlük (30/30 tamamlandı)

UPDATE `mudurlukler`
SET `biyografi` = '05.01.1977 tarihinde İstanbul-Kartal''da doğdu. Cumhuriyet İlkokulu''nda başladığı eğitimine 60. Yıl İlköğretim Okulu ve Darıca Lisesi''nde devam etti. 1999''da Sakarya Üniversitesi Mahalli İdareler Bölümü''nden mezun oldu, ardından Anadolu Üniversitesi Kamu Yönetimi''ni bitirdi. 2000-2004 arası öğretmenlik yaptı. 2004''te Gebze Belediyesi''nde çalışmaya başladı, 2020''de Destek Hizmetleri Müdürü oldu. Aralık 2025''ten itibaren Gençlik ve Spor Hizmetleri Müdürlüğü görevini yürütmektedir. Evli ve 3 çocuk babasıdır.',
    `yonetmelik` = 'Bu yönetmeliğin amacı, Gebze Belediyesi Gençlik ve Spor Hizmetleri Müdürlüğü''nün kuruluş, görev, yetki ve sorumlulukları ile çalışma usul ve esaslarını düzenlemektir. Müdürlük; belediyemizce kurulan spor tesislerinin işletilmesi, sporcuların gelişimini sağlamak, gençleri kötü alışkanlıklardan korumak, spor okulları açmak ve gençlere yönelik plan, proje ve organizasyonlar düzenlemekle görevlidir.'
WHERE `ad` = 'Gençlik ve Spor Hizmetleri Müdürlüğü';

UPDATE `mudurlukler`
SET `biyografi` = '1989 yılında İstanbul Bakırköy''de doğdu. İstanbul Üniversitesi Siyasal Bilgiler Fakültesi Siyaset Bilimi ve Kamu Yönetimi bölümünü tamamladı, lisansüstü eğitimini Sakarya Üniversitesi Mahalli İdareler ve Şehircilik programında sürdürdü. 2017''de KPSS ile Gebze Belediyesi Zabıta Müdürlüğü''nde kamu görevine başladı. 2022''de İnsan Kaynakları ve Eğitim Müdürlüğü''ne atanarak Personel Özlük İşlemleri Servis Sorumlusu oldu. 2026 yılında İnsan Kaynakları ve Eğitim Müdürü olarak görevlendirildi.',
    `yonetmelik` = 'Bu yönetmeliğin amacı; İnsan Kaynakları ve Eğitim Müdürlüğü''nün kuruluş, görev, yetki ve sorumlulukları ile çalışma usul ve esaslarını belirlemek ve uygulamaktır. Müdürlük; Özlük İşleri, Maaş Tahakkuk, Eğitim, KHK''lı Personel İşleri ve İstihdam servislerinden oluşur; personel alımı, özlük işlemleri, performans değerlendirme ve kurum içi eğitim programlarını yürütür.'
WHERE `ad` = 'İnsan Kaynakları ve Eğitim Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Bu yönetmeliğin amacı, Gebze Belediyesi Özel Kalem Müdürlüğü''nün kuruluş, görev, yetki ve sorumlulukları ile çalışma usul ve esaslarını düzenlemektir. Müdürlük; Belediye Başkanının resmi ve özel yazışmalarını yürütür, ziyaret-davet-karşılama-ağırlama gibi protokol işlerini düzenler, Başkanlık makamının randevu ve toplantı programlarını planlar ve vatandaşlardan gelen talep/şikayetleri ilgili birimlere yönlendirerek sonuçlarını takip eder.'
WHERE `ad` = 'Özel Kalem Müdürlüğü';

UPDATE `mudurlukler`
SET `biyografi` = '1968 yılında Erzurum''da doğdu, ilk-orta-lise eğitimini Gebze''de tamamladı. 1994''te Çukurova Üniversitesi İİBF İktisat Bölümü''nden mezun oldu, 2013''te TODAİE''de Kamu Yönetimi Yerel Yönetimler alanında yüksek lisans yaptı. 1997''de İETT''de çalışma hayatına başladı, 1999''da Gebze Belediyesi''nde Gelirler Müdür Yardımcısı oldu. 2007''de Kültür ve Sosyal İşler Müdürü, 2015''te Mezarlıklar Müdürü olarak görev yaptı. Aralık 2025''ten itibaren Rehberlik ve Teftiş Kurulu Müdürlüğü görevini yürütmektedir.',
    `yonetmelik` = 'Bu Yönetmeliğin amacı; Gebze Belediye Başkanlığı Teftiş Kurulu''nun kuruluş, yetki ve sorumluluklarını, çalışma usul ve esaslarını, müfettiş yardımcılarının sınav ve yetiştirilme usullerini düzenlemektir. Kurul, doğrudan Belediye Başkanına bağlı olup; belediye birimlerinde teftiş, denetim ve soruşturma işlemlerini yürütür, hizmetlerin mevzuata uygun ve verimli yürütülmesi için araştırma ve öneriler hazırlar.'
WHERE `ad` = 'Rehberlik ve Teftiş Kurulu Müdürlüğü';

UPDATE `mudurlukler`
SET `biyografi` = '1983 yılında Eğirdere/Kırcali''de (Bulgaristan) doğan Senay ALTINTAŞ, lise öğrenimini Gebze Anadolu Teknik Lisesi Tıp Elektroniği bölümünde tamamladı. 2008''de Akdeniz Üniversitesi Çevre Mühendisliği''nden mezun oldu. 2010''da Gebze Belediyesi Çevre Koruma ve Kontrol servisinde Çevre Mühendisi olarak göreve başladı. 2018''den bu yana Sağlıklı Kentler Birliği Koordinatörlüğü''nü yürütmekte olup, 2019-2021 arası ve Aralık 2025''ten itibaren Temizlik İşleri Müdürü olarak görev yapmaktadır. Evli ve iki çocuk annesidir.',
    `yonetmelik` = 'Bu Yönetmelik, Gebze Belediyesi Temizlik İşleri Müdürlüğü ve bağlı birimlerindeki personelin görev, yetki ve sorumlulukları ile çalışma usul ve esaslarını düzenler. Müdürlük; çöp toplama, cadde/sokak temizliği, semt pazarlarının temizliği, katı atık yönetimi, sıfır atık uygulamaları ve çevre kirliliğine ilişkin denetim faaliyetlerini yürütür.'
WHERE `ad` = 'Temizlik İşleri Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Bu yönetmeliğin amacı, 5393 sayılı Belediye Kanunu''nun 48. maddesi ve ISO 9001-2015 kapsamında kurulan; Halkla İlişkiler Servisi, Sosyal Medya ve İletişim Servisi ile Basın Yayın Servisi''nden oluşan Basın Yayın ve Halkla İlişkiler Müdürlüğü''nün görev, çalışma usul ve esaslarını düzenlemektir. Müdürlük; vatandaş talep ve şikayetlerini yönlendirmek, basın bültenleri hazırlamak, sosyal medya ve kurumsal iletişimi yönetmekle görevlidir.'
WHERE `ad` = 'Basın Yayın ve Halkla İlişkiler Müdürlüğü';

UPDATE `mudurlukler`
SET `yonetmelik` = 'Bu yönetmelik, Kocaeli İli Gebze Belediyesi İklim Değişikliği ve Sıfır Atık Müdürlüğü''nün görev, yetki ve sorumluluklarını, çalışma usul ve esaslarını, teşkilat yapısını belirlemek amacıyla hazırlanmıştır. Müdürlük; sürdürülebilir kalkınma ilkesine bağlı olarak sıfır atık yönetim sistemini kurmak, atık toplama ekipmanları yerleştirmek, 1. Sınıf Atık Getirme Merkezi''ni işletmek ve iklim değişikliğiyle mücadeleye yönelik proje ve eğitimler düzenlemekle görevlidir.'
WHERE `ad` = 'İklim Değişikliği ve Sıfır Atık Müdürlüğü';