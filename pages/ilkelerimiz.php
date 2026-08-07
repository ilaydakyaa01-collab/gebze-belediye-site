<?php
$basePath = '../';
$pageTitle = 'İlkelerimiz - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';
include '../includes/header.php';
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid">
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>İlkelerimiz</span>
                </nav>

                <header class="section-header section-header-left">
                    <h2>İlkelerimiz</h2>
                </header>

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

                <div class="kurumsal-metin-duz" id="kurumsalMetin">
                    <ul class="ilke-listesi">
                        <li>Belediye hizmetlerinde kalite, etkinlik ve verimlilik sağlamak görevimizdir.</li>
                        <li>Belediye karar ve uygulamalarında şeffaflık ve hesap verebilirlik esastır.</li>
                        <li>Belediye hizmetlerinde insan ve vatandaş odaklılık esastır.</li>
                        <li>Gebze’yi katılımcı anlayışla yönetmek temel prensiptir.</li>
                        <li>Belediye hizmetlerinin üretim ve sunumunda bilgi teknolojilerinden azami derecede yararlanmak esastır.</li>
                        <li>Belediye karar ve uygulamalarında yasalara uymak zorunluluktur.</li>
                        <li>Belediye hizmetlerinin ihtiyaçlara ve önceliklere göre adil dağıtımı esastır.</li>
                        <li>Çalışanlarımızın memnuniyeti temel önceliklerimizdendir.</li>
                        <li>Kurum kültürünün oluşturulması için çaba sarf ederiz.</li>
                        <li>Sorunları oluşmadan önlemeye çalışırız.</li>
                    </ul>
                </div>
            </div>

            <?php $currentKurumsalPage = 'ilkeler'; include '../includes/kurumsal-sidebar.php'; ?>
        </div>
    </div>
</main>

<script>
(function () {
    var metin = document.getElementById('kurumsalMetin');
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

<?php include '../includes/footer.php'; ?>