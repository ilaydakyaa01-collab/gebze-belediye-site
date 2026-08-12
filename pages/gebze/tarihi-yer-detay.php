<?php
include '../../includes/db.php';

$basePath = '../../';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM tarihi_yerler WHERE id = ?");
$stmt->execute([$id]);
$yer = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$yer) {
    header("Location: tarihi-yerler.php");
    exit;
}

$stmt2 = $conn->prepare("SELECT * FROM tarihi_yerler_galeri WHERE tarihi_yer_id = ? ORDER BY sira ASC");
$stmt2->execute([$id]);
$galeri = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = $yer['baslik'] . ' - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';
include '../../includes/header.php';
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/gebze.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <a href="tarihi-yerler.php">Tarihi Yerler</a>
                    <span>/</span>
                    <span><?php echo htmlspecialchars($yer['baslik']); ?></span>
                </nav>

                <header class="section-header section-header-left">
                    <h2><?php echo htmlspecialchars($yer['baslik']); ?></h2>
                </header>

                <img class="tarihi-yer-detay-foto" src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=tarihi_yerler&id=<?php echo (int) $yer['id']; ?>" alt="<?php echo htmlspecialchars($yer['baslik']); ?>">

                <div class="kurumsal-metin-duz">
                    <?php foreach (explode("\n\n", $yer['aciklama']) as $paragraf): ?>
                        <p><?php echo htmlspecialchars(trim($paragraf)); ?></p>
                    <?php endforeach; ?>
                </div>

                <?php if (count($galeri) > 0): ?>
                    <h3 class="tarihce-alt-baslik" style="margin-top: 1.8rem;">Resim Galerisi</h3>
                    <div class="tarihi-yer-galeri-izgara">
                        <?php foreach ($galeri as $index => $g): ?>
                            <img src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=tarihi_yerler_galeri&id=<?php echo (int) $g['id']; ?>" alt="<?php echo htmlspecialchars($yer['baslik']); ?>" loading="lazy" data-index="<?php echo $index; ?>">
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="gebze-yan-kolon">
                <?php $currentGebzePage = 'tarihi-yerler'; include '../../includes/gebze-sidebar.php'; ?>
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
    var lightbox = document.getElementById('fotoLightbox');
    var lightboxImg = document.getElementById('fotoLightboxImg');
    var kapatBtn = document.getElementById('fotoLightboxKapat');
    var onceki = document.getElementById('fotoLightboxOnceki');
    var sonraki = document.getElementById('fotoLightboxSonraki');
    var galeriResimleri = document.querySelectorAll('.tarihi-yer-galeri-izgara img');
    var mevcutIndex = 0;

    function goster(index) {
        if (galeriResimleri.length === 0) return;
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
    onceki.addEventListener('click', function (e) { e.stopPropagation(); goster(mevcutIndex - 1); });
    sonraki.addEventListener('click', function (e) { e.stopPropagation(); goster(mevcutIndex + 1); });
    lightbox.addEventListener('click', function (e) { if (e.target === lightbox) lightboxKapat(); });
    document.addEventListener('keydown', function (e) {
        if (lightbox.hidden) return;
        if (e.key === 'Escape') lightboxKapat();
        if (e.key === 'ArrowLeft') goster(mevcutIndex - 1);
        if (e.key === 'ArrowRight') goster(mevcutIndex + 1);
    });
})();
</script>

<?php include '../../includes/footer.php'; ?>