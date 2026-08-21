<?php
$pageTitle = 'Remzi ŞEKER - Başkan Danışmanı - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

$basePath = '../../';

require_once '../../includes/init.php';
include '../../includes/header.php';

$kisi = [
    'ad' => 'Remzi ŞEKER',
    'unvan' => 'Başkan Danışmanı',
    'resim' => 'img/baskan-danismani/remzi-seker.jpg',
    'biyografi' => "1968 Yılında Rize ili Pazar İlçesinde doğdu. İlk, Orta ve Lise tahsilini Pazar ilçesinde tamamladı. 1991 Yılında Yıldız Teknik Üniversitesi Mühendislik Fakültesi Harita Mühendisliği Bölümünden mezun oldu. 1992 Yılında Pazar Belediyesi İmar İşleri Müdürlüğünde Harita Mühendisi olarak göreve başladı. 1994 Yılında Gebze Belediyesi Harita İmar Müdürlüğüne naklen atandı. Gebze Belediyesinin çeşitli kademelerinde Mühendis, Müdür Yardımcısı ve Harita ve Kamulaştırma Müdürü olarak görev yaptı. 2011 Yılında Gebze Teknik Üniversitesinde (GYTE) Yüksek Lisansını Harita Mühendisliği alanında tamamlayarak Harita Yüksek Mühendisi unvanını aldı. Kocaeli Üniversitesi Sosyal Bilimler Enstitüsü Yönetim ve Organizasyon alanında İkinci Yüksek Lisans eğitimine devam etmektedir.\n\n2021-2024 Yılları arasında Gebze Belediyesinde Teknik Başkan Yardımcısı olarak görev yaptı. Halen Başkan Danışmanı sıfatıyla, Gebze Belediyesinde Belediye Başkanımızın Teknik Danışmanı olarak memuriyetine devam etmektedir.\n\nEvli, İki Kız ve İki Erkek Çocuk Babasıdır."
];
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <a href="baskan-danismanlari.php">Başkan Danışmanları</a>
                    <span>/</span>
                    <span><?php echo htmlspecialchars($kisi['ad']); ?></span>
                </nav>

                <header class="section-header section-header-left mudurluk-detay-baslik">
                    <h2><?php echo htmlspecialchars($kisi['unvan']); ?></h2>
                </header>

                <!-- Telefon ve E-posta bilgileri kaldırılmış temiz üst kart -->
                <div class="mudurluk-detay-ust">
                    <img src="<?php echo $basePath . $kisi['resim']; ?>" alt="<?php echo htmlspecialchars($kisi['ad']); ?>">
                    <div class="mudurluk-detay-bilgi">
                        <h3><?php echo htmlspecialchars($kisi['ad']); ?></h3>
                    </div>
                </div>

                <div class="metin-araclari">
                    <button type="button" class="arac-btn" id="fontKucult" aria-label="Yazıyı küçült" title="Yazıyı küçült">
                        <i class="bi bi-zoom-out"></i>
                    </button>
                    <button type="button" class="arac-btn" id="fontNormal" aria-label="Normal boyut" title="Normal boyut">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                    <button type="button" class="arac-btn" id="fontBuyut" aria-label="Yazıyı büyüt" title="Yazıyı büyüt">
                        <i class="bi bi-zoom-in"></i>
                    </button>
                    <button type="button" class="arac-btn" id="yazdirBtn" aria-label="Yazdır" title="Yazdır">
                        <i class="bi bi-printer"></i>
                    </button>
                </div>

                <div class="yrd-tab-group" role="tablist">
                    <button type="button" class="yrd-tab active" data-tab="biyografi">Biyografi</button>
                </div>

                <div class="kurumsal-metin-duz" id="mudurlukMetin">
                    <div class="yrd-tab-panel" data-panel="biyografi">
                        <p><?php echo nl2br(htmlspecialchars($kisi['biyografi'])); ?></p>
                    </div>
                </div>
            </div>

            <?php $currentKurumsalPage = 'baskan-dan'; include '../../includes/kurumsal-sidebar.php'; ?>
        </div>
    </div>
</main>

<script>
(function () {
    var metin = document.getElementById('mudurlukMetin');
    var olcek = 1;
    var ADIM = 0.1;
    var MIN = 0.7;
    var MAX = 1.5;

    function uygula() {
        metin.style.setProperty('--metin-olcek', olcek.toFixed(2));
    }

    document.getElementById('fontBuyut').addEventListener('click', function () {
        olcek = Math.min(MAX, olcek + ADIM);
        uygula();
    });

    document.getElementById('fontKucult').addEventListener('click', function () {
        olcek = Math.max(MIN, olcek - ADIM);
        uygula();
    });

    document.getElementById('fontNormal').addEventListener('click', function () {
        olcek = 1;
        uygula();
    });

    document.getElementById('yazdirBtn').addEventListener('click', function () {
        window.print();
    });
})();
</script>

<?php include '../../includes/footer.php'; ?>