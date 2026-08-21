<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'Fotoğraf Galerisi - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';

$sayfa = isset($_GET['sayfa']) && is_numeric($_GET['sayfa']) ? (int)$_GET['sayfa'] : 1;
if ($sayfa < 1) $sayfa = 1;
$sayfaBasi = 9;

$albumler = [];
$toplamAlbum = 0;
$toplamSayfa = 1;
try {
    $toplamAlbum = (int) $conn->query("SELECT COUNT(*) FROM galeri_albumler")->fetchColumn();
    $toplamSayfa = max(1, (int) ceil($toplamAlbum / $sayfaBasi));
    if ($sayfa > $toplamSayfa) $sayfa = $toplamSayfa;
    $offset = ($sayfa - 1) * $sayfaBasi;

    $stmt = $conn->prepare("
        SELECT a.*, COUNT(f.id) AS foto_sayisi
        FROM galeri_albumler a
        LEFT JOIN galeri_fotograflar f ON f.album_id = a.id
        GROUP BY a.id
        ORDER BY a.tarih DESC, a.sira ASC, a.id DESC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':limit', $sayfaBasi, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $albumler = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Bu sayfadaki albümlerin fotoğraflarını topluca çekip albüme göre grupluyoruz
    // (modal içinde sayfa yenilenmeden gösterebilmek için)
    $fotograflarByAlbum = [];
    if (count($albumler) > 0) {
        $idler = array_column($albumler, 'id');
        $yerTutucular = implode(',', array_fill(0, count($idler), '?'));
        $stmtF = $conn->prepare("SELECT * FROM galeri_fotograflar WHERE album_id IN ($yerTutucular) ORDER BY sira ASC, id ASC");
        $stmtF->execute($idler);
        foreach ($stmtF->fetchAll(PDO::FETCH_ASSOC) as $foto) {
            $fotograflarByAlbum[$foto['album_id']][] = $basePath . ltrim($foto['resim'], '/');
        }
    }
} catch (Exception $e) {
    $albumler = [];
    $fotograflarByAlbum = [];
}

function galeriSayfaUrl($basePath, $sayfaNo)
{
    $qs = $sayfaNo > 1 ? '?sayfa=' . $sayfaNo : '';
    return $basePath . 'pages/haberler/fotograf-galerisi.php' . $qs;
}

$extraCss = 'css/haberler/fotograf-galerisi.css';
include '../../includes/header.php';
?>


<main class="galeri-bolumu page-content">
    <div class="container">
        <nav class="galeri-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Fotoğraf Galerisi</span>
        </nav>

        <div class="galeri-ust-satir">
            <header class="galeri-ustbaslik">
                <h1>Fotoğraf Galerisi</h1>
                <p>Belediyemizin etkinliklerinden en güzel kareler.</p>
            </header>

            <div class="galeri-menu-wrap">
                <button type="button" class="galeri-hamburger" id="galeriHamburger">
                    <i class="bi bi-list"></i>
                </button>
                <div class="galeri-dropdown" id="galeriDropdown" hidden>
                    <a href="<?php echo $basePath; ?>pages/haberler/haberler.php">Haberler</a>
                    <a href="<?php echo $basePath; ?>pages/haberler/duyurular.php">Duyurular</a>
                    <a href="<?php echo $basePath; ?>pages/haberler/videolar.php">Videolar</a>
                    <a href="<?php echo $basePath; ?>pages/haberler/fotograf-galerisi.php" class="is-active">Fotoğraf Galerisi</a>
                </div>
            </div>
        </div>

        <?php if (count($albumler) > 0): ?>
            <div class="galeri-grid">
                <?php foreach ($albumler as $album): ?>
                    <?php
                        $albumFotolar = $fotograflarByAlbum[$album['id']] ?? [];
                        $albumTarihGosterim = date('d.m.Y', strtotime($album['tarih']));
                    ?>
                    <button type="button" class="galeri-album-kart galeri-album-tetikleyici"
                        data-baslik="<?php echo htmlspecialchars($album['baslik']); ?>"
                        data-tarih="<?php echo htmlspecialchars($albumTarihGosterim); ?>"
                        data-fotograflar="<?php echo htmlspecialchars(json_encode($albumFotolar)); ?>">
                        <div class="galeri-album-kapak">
                            <?php if (!empty($album['kapak_resim'])): ?>
                                <img src="<?php echo $basePath . htmlspecialchars(ltrim($album['kapak_resim'], '/')); ?>" alt="<?php echo htmlspecialchars($album['baslik']); ?>" loading="lazy">
                            <?php endif; ?>
                            <span class="galeri-foto-sayisi"><i class="bi bi-images"></i> <?php echo (int) $album['foto_sayisi']; ?></span>
                        </div>
                        <div class="galeri-album-icerik">
                            <h3><?php echo htmlspecialchars($album['baslik']); ?></h3>
                            <span class="galeri-album-tarih"><i class="bi bi-calendar-event"></i> <?php echo $albumTarihGosterim; ?></span>
                        </div>
                    </button>
                <?php endforeach; ?>
            </div>

            <?php if ($toplamSayfa > 1): ?>
                <nav class="galeri-pagination">
                    <a href="<?php echo galeriSayfaUrl($basePath, $sayfa - 1); ?>" class="<?php echo $sayfa <= 1 ? 'disabled' : ''; ?>">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    <?php for ($p = 1; $p <= $toplamSayfa; $p++): ?>
                        <a href="<?php echo galeriSayfaUrl($basePath, $p); ?>" class="<?php echo $p === $sayfa ? 'active' : ''; ?>">
                            <?php echo $p; ?>
                        </a>
                    <?php endfor; ?>
                    <a href="<?php echo galeriSayfaUrl($basePath, $sayfa + 1); ?>" class="<?php echo $sayfa >= $toplamSayfa ? 'disabled' : ''; ?>">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </nav>
            <?php endif; ?>
        <?php else: ?>
            <p class="galeri-bos">Henüz albüm eklenmemiş.</p>
        <?php endif; ?>
    </div>
</main>

<!-- ALBÜM MODALI -->
<div class="galeri-modal-arkaplan" id="galeriModalBackdrop" hidden>
    <div class="galeri-modal">
        <div class="galeri-modal-baslik-bar">
            <div>
                <h2 id="galeriModalBaslik"></h2>
                <div class="galeri-modal-tarih"><i class="bi bi-calendar-event"></i> <span id="galeriModalTarih"></span></div>
            </div>
            <button type="button" class="galeri-modal-kapat" id="galeriModalKapat"><i class="bi bi-x-lg"></i></button>
        </div>

        <div class="galeri-modal-govde">
            <div class="galeri-modal-buyuk-resim-wrap" id="galeriModalBuyukAlan">
                <img class="galeri-modal-buyuk-resim" id="galeriModalBuyukResim" src="" alt="">
                <button type="button" class="galeri-modal-nav prev" id="galeriModalOnceki"><i class="bi bi-chevron-left"></i></button>
                <button type="button" class="galeri-modal-nav next" id="galeriModalSonraki"><i class="bi bi-chevron-right"></i></button>
                <span class="galeri-modal-sayac" id="galeriModalSayac"></span>
            </div>
        </div>

        <div class="galeri-modal-serit" id="galeriModalSerit"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Hamburger dropdown
    const hamburgerBtn = document.getElementById('galeriHamburger');
    const dropdown = document.getElementById('galeriDropdown');

    hamburgerBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.hidden = !dropdown.hidden;
    });

    document.addEventListener('click', function (e) {
        if (dropdown.hidden) return;
        if (!e.target.closest('#galeriHamburger') && !e.target.closest('#galeriDropdown')) {
            dropdown.hidden = true;
        }
    });

    // Albüm modalı
    const backdrop = document.getElementById('galeriModalBackdrop');
    const kapatBtn = document.getElementById('galeriModalKapat');
    const baslikEl = document.getElementById('galeriModalBaslik');
    const tarihEl = document.getElementById('galeriModalTarih');
    const buyukAlan = document.getElementById('galeriModalBuyukAlan');
    const buyukResim = document.getElementById('galeriModalBuyukResim');
    const oncekiBtn = document.getElementById('galeriModalOnceki');
    const sonrakiBtn = document.getElementById('galeriModalSonraki');
    const sayacEl = document.getElementById('galeriModalSayac');
    const seritEl = document.getElementById('galeriModalSerit');

    let aktifFotolar = [];
    let aktifIndex = 0;

    function goster(index) {
        if (aktifFotolar.length === 0) return;
        if (index < 0) index = aktifFotolar.length - 1;
        if (index >= aktifFotolar.length) index = 0;
        aktifIndex = index;

        buyukResim.src = aktifFotolar[aktifIndex];
        sayacEl.textContent = (aktifIndex + 1) + ' / ' + aktifFotolar.length;

        seritEl.querySelectorAll('button').forEach(function (btn, i) {
            btn.classList.toggle('is-active', i === aktifIndex);
        });

        const aktifThumb = seritEl.querySelector('button.is-active');
        if (aktifThumb) aktifThumb.scrollIntoView({ inline: 'center', block: 'nearest', behavior: 'smooth' });
    }

    document.querySelectorAll('.galeri-album-tetikleyici').forEach(function (btn) {
        btn.addEventListener('click', function () {
            baslikEl.textContent = btn.dataset.baslik;
            tarihEl.textContent = btn.dataset.tarih;

            try {
                aktifFotolar = JSON.parse(btn.dataset.fotograflar || '[]');
            } catch (e) {
                aktifFotolar = [];
            }

            seritEl.innerHTML = '';
            if (aktifFotolar.length > 0) {
                buyukAlan.hidden = false;
                aktifFotolar.forEach(function (url, i) {
                    const thumb = document.createElement('button');
                    thumb.type = 'button';
                    const img = document.createElement('img');
                    img.src = url;
                    img.alt = '';
                    thumb.appendChild(img);
                    thumb.addEventListener('click', function () { goster(i); });
                    seritEl.appendChild(thumb);
                });
                goster(0);
            } else {
                buyukResim.src = '';
                sayacEl.textContent = '';
                const bosMesaj = document.createElement('p');
                bosMesaj.className = 'galeri-modal-bos';
                bosMesaj.style.width = '100%';
                bosMesaj.textContent = 'Bu albümde henüz fotoğraf eklenmemiştir.';
                seritEl.appendChild(bosMesaj);
            }

            backdrop.hidden = false;
            document.body.style.overflow = 'hidden';
        });
    });

    function kapat() {
        backdrop.hidden = true;
        document.body.style.overflow = '';
        buyukResim.src = '';
    }

    kapatBtn.addEventListener('click', kapat);
    backdrop.addEventListener('click', function (e) {
        if (e.target === backdrop) kapat();
    });
    oncekiBtn.addEventListener('click', function () { goster(aktifIndex - 1); });
    sonrakiBtn.addEventListener('click', function () { goster(aktifIndex + 1); });

    document.addEventListener('keydown', function (e) {
        if (backdrop.hidden) return;
        if (e.key === 'Escape') kapat();
        if (e.key === 'ArrowLeft') goster(aktifIndex - 1);
        if (e.key === 'ArrowRight') goster(aktifIndex + 1);
    });
});
</script>

<?php include '../../includes/footer.php'; ?>