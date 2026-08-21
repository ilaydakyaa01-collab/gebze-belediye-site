<?php
$basePath = '../../';
$pageTitle = 'Etik Komisyonu - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';
include '../../includes/header.php';
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid">

            <!-- ANA İÇERİK -->
            <div class="kurumsal-ana-kart">

                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>Etik Komisyonu</span>
                </nav>

                <header class="section-header section-header-left">
                    <h2>Etik Komisyonu</h2>
                </header>

                <div class="metin-araclari">
                    <button type="button"
                            class="arac-btn"
                            id="fontKucult"
                            title="Yazıyı küçült">
                        <i class="bi bi-zoom-out"></i>
                    </button>

                    <button type="button"
                            class="arac-btn"
                            id="fontNormal"
                            title="Normal boyut">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>

                    <button type="button"
                            class="arac-btn"
                            id="fontBuyut"
                            title="Yazıyı büyüt">
                        <i class="bi bi-zoom-in"></i>
                    </button>

                    <button type="button"
                            class="arac-btn"
                            id="yazdirBtn"
                            title="Yazdır">
                        <i class="bi bi-printer"></i>
                    </button>
                </div>

                <div class="etik-icerik" id="kurumsalMetin">

                    <!-- ETİK DAVRANIŞ İLKELERİ -->
                    <section class="etik-bolum">

                        <h3>ETİK DAVRANIŞ İLKELERİ</h3>

                        <ul class="etik-ilke-listesi">
                            <li>Halka Hizmet Bilinci</li>
                            <li>Hizmet Standartlarına Uymak</li>
                            <li>Amaç ve Misyona Bağlılık</li>
                            <li>Dürüstlük ve Tarafsızlık</li>
                            <li>Saygınlık ve Güven</li>
                            <li>Nezaket ve Saygı</li>
                            <li>Ayrımcılık Yapmamak</li>
                            <li>Saydamlık ve Katılımcılık</li>
                            <li>Hediye Almamak</li>
                            <li>Kamu Mallarını Korumak</li>
                            <li>Savurganlıktan Kaçınmak</li>
                            <li>Çıkar Çatışmasından Kaçınmak</li>
                            <li>Hesap Verme Sorumluluğu</li>
                            <li>İmtiyazsız Kamu Hizmeti</li>
                            <li>Doğruluk</li>
                        </ul>

                    </section>


                    <!-- ETİK KOMİSYONU -->
                    <section class="etik-bolum">

                        <h3>ETİK KOMİSYONU LİSTESİ</h3>

                        <div class="etik-komisyon-grid">

                            <div class="etik-uye-kart">
                                <strong>Ahmet HÜSEYİNÇELEBİ</strong>
                                <span>Başkan Yardımcısı</span>
                                <small>Komisyon Başkanı</small>
                            </div>

                        </div>

                    </section>

                </div>
            </div>

            <!-- SAĞ SIDEBAR -->
            <?php
            $currentKurumsalPage = 'etik';
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