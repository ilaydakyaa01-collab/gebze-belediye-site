<?php
/**
 * ALBÜM DETAY SAYFASI
 * -------------------------------------------------------------
 * fotograf-galerisi.php'deki albüm kartına tıklanınca buraya gelir:
 *   album-detay.php?id=3
 */

include '../../includes/db.php';
require_once '../../includes/init.php';

$basePath = '../../';
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

$album = null;
$fotograflar = [];
$digerAlbumler = [];

try {
    $stmt = $conn->prepare("SELECT * FROM galeri_albumler WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    $album = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($album) {
        $stmtF = $conn->prepare("SELECT * FROM galeri_fotograflar WHERE album_id = :id ORDER BY sira ASC, id ASC");
        $stmtF->execute([':id' => $album['id']]);
        $fotograflar = $stmtF->fetchAll(PDO::FETCH_ASSOC);

        $stmtD = $conn->prepare("SELECT id, baslik, kapak_resim, tarih FROM galeri_albumler WHERE id != :id ORDER BY tarih DESC LIMIT 6");
        $stmtD->execute([':id' => $album['id']]);
        $digerAlbumler = $stmtD->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    $album = null;
}

$pageTitle = $album ? htmlspecialchars($album['baslik']) . ' | Gebze Belediyesi' : 'Albüm Bulunamadı | Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

$extraCss = 'css/haberler/album-detay.css';
include '../../includes/header.php';
?>


<section class="ad-bolumu page-content">
    <div class="container">
        <?php if ($album): ?>

            <nav class="ad-breadcrumb">
                <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
                <span>/</span>
                <a href="<?php echo $basePath; ?>pages/haberler/fotograf-galerisi.php">Fotoğraf Galerisi</a>
                <span>/</span>
                <span><?php echo htmlspecialchars($album['baslik']); ?></span>
            </nav>

            <div class="ad-tarih">
                <i class="bi bi-calendar-event"></i> <?php echo date('d.m.Y', strtotime($album['tarih'])); ?>
            </div>
            <h1 class="ad-baslik"><?php echo htmlspecialchars($album['baslik']); ?></h1>

            <?php if (count($fotograflar) > 0): ?>
                <div class="ad-grid" id="adGrid">
                    <?php foreach ($fotograflar as $f): ?>
                        <button type="button" class="ad-foto-oge" data-buyuk="<?php echo $basePath . htmlspecialchars(ltrim($f['resim'], '/')); ?>">
                            <img src="<?php echo $basePath . htmlspecialchars(ltrim($f['resim'], '/')); ?>" alt="<?php echo htmlspecialchars($album['baslik']); ?>" loading="lazy">
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="ad-bos-foto">Bu albümde henüz fotoğraf eklenmemiştir.</p>
            <?php endif; ?>

            <a href="<?php echo $basePath; ?>pages/haberler/fotograf-galerisi.php" class="ad-geri">
                <i class="bi bi-arrow-left"></i> Tüm Albümlere Dön
            </a>

            <?php if (count($digerAlbumler) > 0): ?>
                <h2 class="ad-diger-baslik">Diğer Albümler</h2>
                <div class="ad-diger-grid">
                    <?php foreach ($digerAlbumler as $d): ?>
                        <a class="ad-diger-kart" href="<?php echo $basePath; ?>pages/haberler/album-detay.php?id=<?php echo (int)$d['id']; ?>">
                            <div class="ad-diger-gorsel">
                                <?php if (!empty($d['kapak_resim'])): ?>
                                    <img src="<?php echo $basePath . htmlspecialchars(ltrim($d['kapak_resim'], '/')); ?>" alt="<?php echo htmlspecialchars($d['baslik']); ?>" loading="lazy">
                                <?php endif; ?>
                            </div>
                            <div class="ad-diger-icerik">
                                <h4><?php echo htmlspecialchars($d['baslik']); ?></h4>
                                <span><?php echo date('d.m.Y', strtotime($d['tarih'])); ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <?php else: ?>

            <div class="ad-bulunamadi">
                <h1>Albüm Bulunamadı</h1>
                <p>Aradığınız albüm kaldırılmış veya adres hatalı olabilir.</p>
                <a href="<?php echo $basePath; ?>pages/haberler/fotograf-galerisi.php" class="ad-geri">
                    <i class="bi bi-arrow-left"></i> Galeriye Dön
                </a>
            </div>

        <?php endif; ?>
    </div>
</section>

<div class="ad-lightbox-arkaplan" id="adLightbox" hidden>
    <button type="button" class="ad-lightbox-kapat" id="adLightboxKapat"><i class="bi bi-x-lg"></i></button>
    <button type="button" class="ad-lightbox-nav prev" id="adLightboxOnceki"><i class="bi bi-chevron-left"></i></button>
    <img class="ad-lightbox-img" id="adLightboxImg" src="" alt="">
    <button type="button" class="ad-lightbox-nav next" id="adLightboxSonraki"><i class="bi bi-chevron-right"></i></button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fotoBtnlar = Array.from(document.querySelectorAll('.ad-foto-oge'));
    const lightbox = document.getElementById('adLightbox');
    const lightboxImg = document.getElementById('adLightboxImg');
    const lightboxKapat = document.getElementById('adLightboxKapat');
    const oncekiBtn = document.getElementById('adLightboxOnceki');
    const sonrakiBtn = document.getElementById('adLightboxSonraki');
    let aktifIndex = 0;

    function goster(index) {
        if (index < 0) index = fotoBtnlar.length - 1;
        if (index >= fotoBtnlar.length) index = 0;
        aktifIndex = index;
        lightboxImg.src = fotoBtnlar[aktifIndex].dataset.buyuk;
    }

    fotoBtnlar.forEach(function (btn, index) {
        btn.addEventListener('click', function () {
            goster(index);
            lightbox.hidden = false;
            document.body.style.overflow = 'hidden';
        });
    });

    function kapat() {
        lightbox.hidden = true;
        document.body.style.overflow = '';
    }

    if (lightboxKapat) lightboxKapat.addEventListener('click', kapat);
    if (oncekiBtn) oncekiBtn.addEventListener('click', function () { goster(aktifIndex - 1); });
    if (sonrakiBtn) sonrakiBtn.addEventListener('click', function () { goster(aktifIndex + 1); });

    if (lightbox) {
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) kapat();
        });
    }
    document.addEventListener('keydown', function (e) {
        if (lightbox.hidden) return;
        if (e.key === 'Escape') kapat();
        if (e.key === 'ArrowLeft') goster(aktifIndex - 1);
        if (e.key === 'ArrowRight') goster(aktifIndex + 1);
    });
});
</script>

<?php include '../../includes/footer.php'; ?>