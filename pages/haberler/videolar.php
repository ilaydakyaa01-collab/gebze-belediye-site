<?php
/**
 * VİDEOLAR SAYFASI (SIFIRDAN)
 * -------------------------------------------------------------
 * Veriler: videolar tablosu (id, baslik, youtube_id, tarih, sira)
 * Diğer sayfalarla (Duyurular, Fotoğraf Galerisi) aynı desen:
 * breadcrumb + başlık/hamburger satırı + sayfalama.
 * Videoya tıklayınca sayfa içinde modal ile YouTube oynatılıyor.
 */

include '../../includes/db.php';
require_once '../../includes/init.php';

$basePath = '../../';
$pageTitle = 'Videolar - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

$sayfa = isset($_GET['sayfa']) && is_numeric($_GET['sayfa']) ? (int)$_GET['sayfa'] : 1;
if ($sayfa < 1) $sayfa = 1;
$sayfaBasi = 9;

$videolar = [];
$toplamVideo = 0;
$toplamSayfa = 1;
try {
    $toplamVideo = (int) $conn->query("SELECT COUNT(*) FROM videolar")->fetchColumn();
    $toplamSayfa = max(1, (int) ceil($toplamVideo / $sayfaBasi));
    if ($sayfa > $toplamSayfa) $sayfa = $toplamSayfa;
    $offset = ($sayfa - 1) * $sayfaBasi;

    $stmt = $conn->prepare("SELECT * FROM videolar ORDER BY tarih DESC, sira ASC, id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $sayfaBasi, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $videolar = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $videolar = [];
}

function videoSayfaUrl($basePath, $sayfaNo)
{
    $qs = $sayfaNo > 1 ? '?sayfa=' . $sayfaNo : '';
    return $basePath . 'pages/haberler/videolar.php' . $qs;
}

$extraCss = 'css/haberler/videolar.css';
include '../../includes/header.php';
?>

<main class="video-bolumu page-content">
    <div class="container">
        <nav class="video-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Videolar</span>
        </nav>

        <div class="video-ust-satir">
            <header class="video-ustbaslik">
                <h1>Videolar</h1>
                <p>Belediyemizin video arşivinden seçmeler.</p>
            </header>

            <div class="video-menu-wrap">
                <button type="button" class="video-hamburger" id="videoHamburger">
                    <i class="bi bi-list"></i>
                </button>
                <div class="video-dropdown" id="videoDropdown" hidden>
                    <a href="<?php echo $basePath; ?>pages/haberler/haberler.php">Haberler</a>
                    <a href="<?php echo $basePath; ?>pages/haberler/duyurular.php">Duyurular</a>
                    <a href="<?php echo $basePath; ?>pages/haberler/videolar.php" class="is-active">Videolar</a>
                    <a href="<?php echo $basePath; ?>pages/haberler/fotograf-galerisi.php">Fotoğraf Galerisi</a>
                </div>
            </div>
        </div>

        <?php if (count($videolar) > 0): ?>
            <div class="video-grid">
                <?php foreach ($videolar as $video): ?>
                    <?php
                        $ytId = trim($video['youtube_id']);
                        $ytThumb = 'https://img.youtube.com/vi/' . rawurlencode($ytId) . '/hqdefault.jpg';
                        $videoTarihGosterim = date('d.m.Y', strtotime($video['tarih']));
                    ?>
                    <button type="button" class="video-kart video-tetikleyici" data-youtube-id="<?php echo htmlspecialchars($ytId); ?>" data-baslik="<?php echo htmlspecialchars($video['baslik']); ?>">
                        <div class="video-thumb-wrap">
                            <img src="<?php echo htmlspecialchars($ytThumb); ?>" alt="<?php echo htmlspecialchars($video['baslik']); ?>" loading="lazy">
                            <span class="video-oynat-ikon"><i class="bi bi-play-fill"></i></span>
                        </div>
                        <div class="video-icerik">
                            <h3><?php echo htmlspecialchars($video['baslik']); ?></h3>
                            <span class="video-tarih"><i class="bi bi-calendar-event"></i> <?php echo $videoTarihGosterim; ?></span>
                        </div>
                    </button>
                <?php endforeach; ?>
            </div>

            <?php if ($toplamSayfa > 1): ?>
                <nav class="video-pagination">
                    <a href="<?php echo videoSayfaUrl($basePath, $sayfa - 1); ?>" class="<?php echo $sayfa <= 1 ? 'disabled' : ''; ?>">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    <?php for ($p = 1; $p <= $toplamSayfa; $p++): ?>
                        <a href="<?php echo videoSayfaUrl($basePath, $p); ?>" class="<?php echo $p === $sayfa ? 'active' : ''; ?>">
                            <?php echo $p; ?>
                        </a>
                    <?php endfor; ?>
                    <a href="<?php echo videoSayfaUrl($basePath, $sayfa + 1); ?>" class="<?php echo $sayfa >= $toplamSayfa ? 'disabled' : ''; ?>">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </nav>
            <?php endif; ?>
        <?php else: ?>
            <p class="video-bos">Henüz video eklenmemiş.</p>
        <?php endif; ?>
    </div>
</main>

<!-- VİDEO OYNATMA MODALI -->
<div class="video-modal-arkaplan" id="videoModalBackdrop" hidden>
    <div class="video-modal">
        <button type="button" class="video-modal-kapat" id="videoModalKapat" aria-label="Kapat"><i class="bi bi-x-lg"></i></button>
        <div class="video-modal-govde" id="videoIframeKapsayici"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Hamburger dropdown
    const hamburgerBtn = document.getElementById('videoHamburger');
    const dropdown = document.getElementById('videoDropdown');

    hamburgerBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.hidden = !dropdown.hidden;
    });

    document.addEventListener('click', function (e) {
        if (dropdown.hidden) return;
        if (!e.target.closest('#videoHamburger') && !e.target.closest('#videoDropdown')) {
            dropdown.hidden = true;
        }
    });

    // Video oynatma modalı
    const modalBackdrop = document.getElementById('videoModalBackdrop');
    const modalKapat = document.getElementById('videoModalKapat');
    const iframeKapsayici = document.getElementById('videoIframeKapsayici');

    document.querySelectorAll('.video-tetikleyici').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const videoId = btn.dataset.youtubeId;
            if (!videoId) return;

            const origin = window.location.origin;
            const embedUrl = 'https://www.youtube-nocookie.com/embed/' +
                encodeURIComponent(videoId) +
                '?autoplay=1&playsinline=1&rel=0&modestbranding=1&origin=' +
                encodeURIComponent(origin);

            iframeKapsayici.innerHTML = '';
            const iframe = document.createElement('iframe');
            iframe.src = embedUrl;
            iframe.title = btn.dataset.baslik || 'Gebze Belediyesi Videosu';
            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
            iframe.setAttribute('allowfullscreen', '');
            iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
            iframeKapsayici.appendChild(iframe);

            modalBackdrop.hidden = false;
            document.body.style.overflow = 'hidden';
        });
    });

    function modalKapatFn() {
        modalBackdrop.hidden = true;
        iframeKapsayici.innerHTML = '';
        document.body.style.overflow = '';
    }

    modalKapat.addEventListener('click', modalKapatFn);
    modalBackdrop.addEventListener('click', function (e) {
        if (e.target === modalBackdrop) modalKapatFn();
    });
    document.addEventListener('keydown', function (e) {
        if (!modalBackdrop.hidden && e.key === 'Escape') modalKapatFn();
    });
});
</script>

<?php include '../../includes/footer.php'; ?>