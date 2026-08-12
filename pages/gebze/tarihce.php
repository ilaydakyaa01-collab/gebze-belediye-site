<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'Tarihçe - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';
include '../../includes/header.php';

$stmt = $conn->query("SELECT icerik FROM sayfa_tarihce LIMIT 1");
$sayfaVerisi = $stmt->fetch(PDO::FETCH_ASSOC);
$sayfaIcerik = $sayfaVerisi ? $sayfaVerisi['icerik'] : '';
$stmt2 = $conn->query("SELECT * FROM tarihce_galeri ORDER BY sira ASC");
$galeriFotolari = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/gebze.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>Tarihçe</span>
                </nav>

                <header class="section-header section-header-left">
                    <h2>Tarihçe</h2>
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
                    <?php echo $sayfaIcerik; ?>
                </div>
            </div>

            <div class="gebze-yan-kolon">
                <?php $currentGebzePage = 'tarihce'; include '../../includes/gebze-sidebar.php'; ?>

                <div class="tarihce-galeri-dikey">
                    <h3 class="tarihce-galeri-baslik">Fotoğraflar</h3>
                    <?php foreach ($galeriFotolari as $index => $g): ?>
                        <img src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=tarihce_galeri&id=<?php echo (int) $g['id']; ?>" alt="Tarihçe" loading="lazy" data-index="<?php echo $index; ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="foto-lightbox" id="fotoLightbox" hidden>
    <button type="button" class="foto-lightbox-kapat" id="fotoLightboxKapat" aria-label="Kapat">
        <i class="bi bi-x-lg"></i>
    </button>
    <button type="button" class="foto-lightbox-ok foto-lightbox-ok-sol" id="fotoLightboxOnceki" aria-label="Önceki fotoğraf">
        <i class="bi bi-chevron-left"></i>
    </button>
    <img src="" alt="" id="fotoLightboxImg">
    <button type="button" class="foto-lightbox-ok foto-lightbox-ok-sag" id="fotoLightboxSonraki" aria-label="Sonraki fotoğraf">
        <i class="bi bi-chevron-right"></i>
    </button>
</div>

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

    // Fotoğraf büyütme (lightbox) + oklarla gezinme
    var lightbox = document.getElementById('fotoLightbox');
    var lightboxImg = document.getElementById('fotoLightboxImg');
    var kapatBtn = document.getElementById('fotoLightboxKapat');
    var onceki = document.getElementById('fotoLightboxOnceki');
    var sonraki = document.getElementById('fotoLightboxSonraki');
    var galeriResimleri = document.querySelectorAll('.tarihce-galeri-dikey img');
    var mevcutIndex = 0;

    function goster(index) {
        if (index < 0) index = galeriResimleri.length - 1;
        if (index >= galeriResimleri.length) index = 0;
        mevcutIndex = index;
        var img = galeriResimleri[index];
        lightboxImg.src = img.src;
        lightboxImg.alt = img.alt;
    }

    galeriResimleri.forEach(function (img, index) {
        img.style.cursor = 'pointer';
        img.addEventListener('click', function () {
            goster(index);
            lightbox.hidden = false;
        });
    });

    function lightboxKapat() {
        lightbox.hidden = true;
        lightboxImg.src = '';
    }

    kapatBtn.addEventListener('click', lightboxKapat);
    onceki.addEventListener('click', function (e) {
        e.stopPropagation();
        goster(mevcutIndex - 1);
    });
    sonraki.addEventListener('click', function (e) {
        e.stopPropagation();
        goster(mevcutIndex + 1);
    });
    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) lightboxKapat();
    });
    document.addEventListener('keydown', function (e) {
        if (lightbox.hidden) return;
        if (e.key === 'Escape') lightboxKapat();
        if (e.key === 'ArrowLeft') goster(mevcutIndex - 1);
        if (e.key === 'ArrowRight') goster(mevcutIndex + 1);
    });
})();
</script>

<?php include '../../includes/footer.php'; ?>