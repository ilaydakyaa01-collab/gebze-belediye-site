-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Ağu 2026, 14:47:33
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
-- Tablo için tablo yapısı `sayfa_bugunku_gebze`
--

CREATE TABLE `sayfa_bugunku_gebze` (
  `id` int(11) NOT NULL,
  `baslik` varchar(150) NOT NULL,
  `icerik` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sayfa_bugunku_gebze`
--

INSERT INTO `sayfa_bugunku_gebze` (`id`, `baslik`, `icerik`) VALUES
(1, 'Bugünkü Gebze', '<p>Gebze, Marmara Bölgesinin doğusunda, İzmit Körfezi\'nin kuzey kesiminde yer alan, zengin bir tarihi geçmişe sahip, ekonomisi, tarım, hayvancılık ve sanayiye dayalı Türkiye\'nin hızla gelişen ve büyüyen bir ilçesidir.</p>\r\n\r\n                    <p>Gebze, Kocaeli\'nin endüstrisinin büyük bölümünü barındıran, Marmara Denizi\'nin kuzeyi ile İstanbul\'un 45 kilometre doğusunda yer alan bir ilçedir. Marmara bölgesinin en büyük ikinci ilçesi olup Türkiye sanayisinin %15\'ini barındırmaktadır.</p>\r\n\r\n                    <p>Gebze, Marmara Bölgesi\'nde Kocaeli iline bağlı olarak Anadolu\'nun İstanbul\'a ve Avrupa\'ya bağlantı konumunda bulunan limanlar, havalimanı, devlet demir yolları ve E-5, TEM karayolları çevresinde kurulmuştur. Yolların doğu-batı yönünde olması nedeniyle kentsel alanı ve sanayisi bu doğrultuda gelişmiş bir sanayi bölgesidir.</p>\r\n\r\n                    <p>Gebze ana ulaşım yolları üzerindeki konumu nedeni ile uzun yıllar Anadolu\'dan İstanbul\'a göç eden Anadolu halkının, İstanbul\'dan önce uğradığı bir ayak olmuştur. İstanbul nüfusunun 10 milyonu aşması kentin sorunlarını artırmış, sanayi tesislerinin İstanbul dışında yerleşmesine gereksinim duyulmuştur.</p>\r\n\r\n                    <p>Yeni yerleşim yeri arayışlarının bir sonucu olarak, sanayi tesislerinin büyük çoğunluğu İstanbul\'a en yakın konumda olan Gebze\'ye akın etmiştir. Toprağın maliyetinin ucuz ve kolay bulunur oluşu Gebze\'yi sanayinin cazibe merkezi haline getirmiştir.</p>\r\n\r\n                    <p>Kentin, limanlara yakınlığının yanında E-5 ve TEM karayollarının birbirine çok yakın bir alanında kurulmuş olması, havalimanlarına ve demiryollarına yakınlığı, hem Avrupa\'ya yapılacak ticarette hem de Anadolu, Orta Asya ve Orta Anadolu\'ya geçiş için taşıma kolaylıkları sunması, Türkiye\'nin en fazla kalkınmış üç büyük kentinin ortasında ve onlara yaklaşık olarak 45 dakika uzaklıkta olması da yatırımcıların dikkatlerini bu bölge üzerinde yoğunlaştırmasının temel nedenleri arasında bulunmaktadır.</p>\r\n\r\n                    <p>Gebze, Marmara sahiline 7 km., İzmit\'e 49 km., İstanbul\'a 45 km. uzaklıkta bulunmaktadır. Deniz seviyesinden yüksekliği 130 metredir.</p>\r\n\r\n                    <p>Günümüzde Gebze kara, deniz ve demiryollarının birbirleriyle kesiştiği önemli kavşak noktasında bulunmaktadır. Eski Gebze şimdiki kasabanın yakınındadır. Yüzeyi kuzeydoğuda dağ ve sırtlardan, batı güneyde kıyıya yakın bölümlerinde düzlüklerden ibarettir.</p>\r\n\r\n                    <p>İlçe sınırları içinde, göl, dağ, akarsu bulunmamakla beraber, yaklaşık 650 metre yüksekliği geçmeyen tepelerin ve sırtların varlığından söz edilebilmektedir. Bu tepelerin en yükseği Gaziler Tepesi\'dir. Ancak akarsu yerine dereler ve derecikler mevcuttur.</p>\r\n\r\n                    <p>Genellikle Karadeniz ve Akdeniz bölgeleri arasında bir geçiş özelliği taşımaktadır. Yaz mevsimi sıcak ve az yağışlı, kış mevsimi oldukça serin ve daha ziyade yağışlı geçmektedir. Yıllık yağış ortalaması 550 mm. En çok yağış Aralık-Ocak aylarında, en az yağış ise Ağustos ayındadır. En sıcak ay ortalaması 24.2 derece ile Ağustos ayı, en soğuk ay ortalaması 6.5 derece ile Ocak ayıdır.</p>\r\n\r\n                    <p>Gebze\'nin Körfez şeridi üzerindeki yerleşim yerlerinde, tabiatın oluşturduğu birbirinden güzel koyları ve tabii plajları ile çekici düzeydedir. Yörenin ekilebilir topraklarında tarım, meyvecilik, sebzecilik ileri bir durumdadır. Marmara kıyısında ilçe toprakları genellikle ovalıktır.</p>\r\n\r\n                    <p>Yoğun sanayi yapılanması ile dikkat çeken Gebze, her ne kadar idari olarak Kocaeli\'ye bağlıysa da, İstanbul iline daha yakın olduğu için, bu ille hem ticari hem de sosyal ilişkileri gelişmiştir. Uzun yıllar il olması için mücadele edilmiş olsa da hali hazırda Kocaeli Büyükşehir Belediyesi sınırları içindedir. İstanbul Büyükşehir Belediyesi, yıllar boyu Gebze\'yi kendisine bağlamak istemiş ancak buna izin verilmemiştir.</p>\r\n\r\n                    <p>Sürekli yükselen bir nüfus grafiği çizen Gebze, 2008 yılında çıkarılan kanunla birlikte kendisine bağlı olan Çayırova, Darıca ve Dilovası\'nın birer ilçe olması sonucu nüfusunun bir bölümünü bu yeni ilçelere vermiştir.</p>\r\n\r\n                    <table class=\"bugunku-gebze-tablo\">\r\n                        <thead>\r\n                            <tr><th>Yıl</th><th>Nüfus</th></tr>\r\n                        </thead>\r\n                        <tbody>\r\n                            <tr><td>1973</td><td>27.000</td></tr>\r\n                            <tr><td>1990</td><td>159.116</td></tr>\r\n                            <tr><td>2000</td><td>253.487</td></tr>\r\n                            <tr><td>2007</td><td>521.291</td></tr>\r\n                            <tr><td>2008</td><td>288.569</td></tr>\r\n                        </tbody>\r\n                    </table>\r\n\r\n                    <h3 class=\"tarihce-alt-baslik\">Önemli Kurum ve Kuruluşlar</h3>\r\n\r\n                    <p>Gebze Organize Sanayi Bölgesi (GOSB), Gebze merkezine 7 km mesafede 10.370.000 m\'lik planlanmış bir alanda, 1985 yılında Gebze ve civarında çarpık sanayileşmenin yol açtığı çevre kirliliğini önlemek, sanayiyi disipline etmek amacıyla, kredi kullanmadan, tamamen katılımcıların finansmanı ile kurulmuş ve şu an itibariyle 85 firmada yaklaşık 9100 kişi istihdamı ile faaliyet göstermektedir. GOSB\'da bulunan sanayi yatırımlarının adet olarak %33\'ü, yatırım tutarı olarak %65\'i yabancı sermayeli, özellikle de çok uluslu büyük kuruluşlardır. Yurtiçi ve yurtdışı OSB\'lere model olan GOSB da bugün itibari ile makine, kimya, otomotiv yan sanayi, optik, elektronik, sınai ve tıbbi gaz, gıda ve ambalaj ve bilişim sektöründe üretim yapan firmalar yer almaktadır.</p>\r\n\r\n                    <p>Gebze, bilimsel çalışmalar, hizmet iyileştirme ve teknik hizmet eğitimleri üzerinde de gelişme göstermekte olan kuruluşlara sahiptir. Gebze\'de bulunan TSE, laboratuvar hizmetleri olarak kalibrasyon, deney, tahribatsız muayene hizmetleri, ürün ve hizmet yeri belgelendirme dallarında; TSE Uygunluk Belgesi, Kalite Uygunluk Belgesi (TSEK), İthal Malların Belgelendirilmesi, Araç Proje Hizmetleri, Karayolları Atık Taşıma Belgesi, Hizmet Yeterlilik Belgelendirmesi (HYB), Laboratuar Yeterlilik Hizmetleri, Sistem Belgelendirme, TS EN ISO 9000 Kalite Yönetim Sistemi, TS EN ISO 14000 Çevre Yönetim Sistemi, TS EN ISO 22000 HACCP Yönetim Sistemi, TS 18001 OHSAS Yönetim Sistemi dallarında belgelendirme hizmetleri sunmaktadır.</p>\r\n\r\n                    <p>1985 yılında kurulan TÜSSİDE, kamu ve özel sektör kurum ve kuruluşlarında görev yapan yönetici ve çalışanlarına yönelik olarak; liderlik, motivasyon, etkin iletişim, takım çalışması, üretim yönetimi, stratejik yönetim, teknoloji yönetimi, insan kaynakları ve performans yönetimi, temel kalite kavramları ve kurum kültürü, iyileştirme takımları ve teknik gibi konularda hizmet vermektedir.</p>\r\n\r\n                    <p>Üniversiteler genel sıralamasında tıp fakültesi olmayan üniversiteler içerisinde Türkiye\'nin en iyi 2. Üniversitesi Gebze Teknik Üniversitesi ilçemiz sınırları içindeki saygın tek üniversitedir. 1992\'de kurulan Gebze Yüksek Teknoloji Enstitüsü\'nün temelleri ve tecrübe birikimleri üzerine, 22 yıllık mirasa sahip çıkarak 4 Kasım 2014 tarihindeki Türkiye Büyük Millet Meclisi kararı ile kurulmuştur. Gebze Teknik Üniversitesi, ARGE ve İnovasyon hedefli altyapısı, donanımıyla, uluslararası diplomalı akademik kadrosuyla ülkemizin en önemli bilim üssü olma yolunda hızla ilerlemektedir. Gebze Teknik Üniversitesi Türkiye üniversiteler genel sıralamasında Türkiye\'nin en iyi 5., tıp fakültesi olmayan üniversiteler içerisinde 2. ve 6000 civarı öğrencisi olan üniversiteler içinde Türkiye 1.\'si olarak yer alan genç, dinamik ve deneyimli bir üniversitedir.</p>\r\n\r\n                    <p>TÜBİTAK Marmara Araştırma Merkezi ise, Türkiye\'nin küresel rekabet gücünün artırılmasına bilim ve teknolojiyi kullanarak katkıda bulunmaktadır. Bünyesinde, Bilişim Teknolojileri Enstitüsü, Enerji Enstitüsü, Yer ve Deniz Bilimleri Enstitüsü, Malzeme Enstitüsü ve Teknoloji Serbest Bölgesi ve Teknopark İşletmeciliğini yürüten MARTEK A.Ş. bulunmaktadır. Endüstriyel kuruluşların, savunma kuruluşlarının, üniversitelerin ve kamu kuruluşlarının hizmetindedir.</p>');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `sayfa_bugunku_gebze`
--
ALTER TABLE `sayfa_bugunku_gebze`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `sayfa_bugunku_gebze`
--
ALTER TABLE `sayfa_bugunku_gebze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
