<?php
$basePath = '../../';
$pageTitle = 'Arabuluculuk Komisyonu - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';
include '../../includes/header.php';
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid">

            <div class="kurumsal-ana-kart">

                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>Arabuluculuk Komisyonu</span>
                </nav>

                <header class="section-header section-header-left">
                    <h2>Arabuluculuk Komisyonu</h2>
                </header>

                <div class="metin-araclari">
                    <button type="button"
                            class="arac-btn"
                            id="fontKucult"
                            aria-label="Yazıyı küçült"
                            title="Yazıyı küçült">
                        <i class="bi bi-zoom-out"></i>
                    </button>

                    <button type="button"
                            class="arac-btn"
                            id="fontNormal"
                            aria-label="Normal boyut"
                            title="Normal boyut">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>

                    <button type="button"
                            class="arac-btn"
                            id="fontBuyut"
                            aria-label="Yazıyı büyüt"
                            title="Yazıyı büyüt">
                        <i class="bi bi-zoom-in"></i>
                    </button>

                    <button type="button"
                            class="arac-btn"
                            id="yazdirBtn"
                            aria-label="Yazdır"
                            title="Yazdır">
                        <i class="bi bi-printer"></i>
                    </button>
                </div>

                <div class="arabuluculuk-icerik" id="kurumsalMetin">

                    <section class="arabuluculuk-grup">
                        <h3>ASIL ÜYELER</h3>

                        <div class="arabuluculuk-uye">
                            <strong>Başkan</strong>
                            <span>Av. Murat TUNCA</span>
                            <small>Hukuk İşleri Müdürlüğü V.</small>
                        </div>

                        <div class="arabuluculuk-uye">
                            <strong>İsmail DENK</strong>
                            <span>Mali Hizmetler Müdür V.</span>
                        </div>
                    </section>


                    <section class="arabuluculuk-grup">
                        <h3>YEDEK ÜYELER</h3>

                        <div class="arabuluculuk-uye">
                            <strong>Av. Gizem ÖZMETE</strong>
                            <span>Hukuk İşleri Müdürlüğü</span>
                        </div>

                        <div class="arabuluculuk-uye">
                            <strong>Av. Ebru ÜNAL</strong>
                            <span>Hukuk İşleri Müdürlüğü</span>
                        </div>

                        <div class="arabuluculuk-uye">
                            <strong>Av. Sümeyye Elif PEHLİVAN</strong>
                            <span>Hukuk İşleri Müdürlüğü</span>
                        </div>

                        <div class="arabuluculuk-uye">
                            <strong>Berna YILMAZ</strong>
                            <span>İnsan Kaynakları ve Eğitim Müdürlüğü</span>
                        </div>

                        <div class="arabuluculuk-uye">
                            <strong>Mutlu DURAL</strong>
                            <span>İnsan Kaynakları ve Eğitim Müdürlüğü</span>
                        </div>

                        <div class="arabuluculuk-uye">
                            <strong>Erkan YAKIN</strong>
                            <span>Mali Hizmetler Müdürlüğü</span>
                        </div>

                        <div class="arabuluculuk-uye">
                            <strong>Elvan GÜLFİDANE</strong>
                            <span>Mali Hizmetler Müdürlüğü</span>
                        </div>
                    </section>

                </div>
            </div>

            <?php
            $currentKurumsalPage = 'arabuluculuk';
            include '../../includes/kurumsal-sidebar.php';
            ?>

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

<?php include '../../includes/footer.php'; ?>