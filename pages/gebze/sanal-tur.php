<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = '360 Sanal Tur - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';
include '../../includes/header.php';

$stmt = $conn->query("SELECT * FROM sanal_tur ORDER BY sira ASC");
$tumNoktalar = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sayfaBasi = 4;
$noktaSayfalari = array_chunk($tumNoktalar, $sayfaBasi);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/gebze.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>360 Sanal Tur</span>
                </nav>

                <header class="section-header section-header-left sanaltur-baslik">
                    <h2>360° Sanal Tur</h2>
                </header>

                <div class="sanaltur-grid">
                    <?php foreach ($noktaSayfalari as $sayfaIndex => $sayfaNoktalari): ?>
                        <?php foreach ($sayfaNoktalari as $n): ?>
                            <div class="sanaltur-kart sanaltur-sayfa" data-sayfa="<?php echo $sayfaIndex + 1; ?>" <?php echo $sayfaIndex > 0 ? 'style="display:none;"' : ''; ?>>
                                <img src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=sanal_tur&id=<?php echo (int) $n['id']; ?>" alt="<?php echo htmlspecialchars($n['ad']); ?>" loading="lazy">
                                <div class="sanaltur-icerik">
                                    <span class="sanaltur-adi"><?php echo htmlspecialchars($n['ad']); ?></span>
                                    <div class="sanaltur-buton-grup">
                                        <a class="sanaltur-btn" href="<?php echo htmlspecialchars($n['harita_url']); ?>" target="_blank" rel="noopener">
                                            <i class="bi bi-geo-alt"></i> Konum
                                        </a>
                                        <button type="button" class="sanaltur-btn sanaltur-btn-dolu sanaltur-ac-btn" data-panorama="<?php echo htmlspecialchars($n['panorama_url']); ?>" data-ad="<?php echo htmlspecialchars($n['ad']); ?>">
                                            <i class="bi bi-arrows-fullscreen"></i> Sanal Tur
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>

                <?php if (count($noktaSayfalari) > 1): ?>
                    <div class="meclis-sayfalama" id="sanalturSayfalama">
                        <?php foreach ($noktaSayfalari as $sayfaIndex => $sayfaNoktalari): ?>
                            <button type="button" class="meclis-sayfa-btn<?php echo $sayfaIndex === 0 ? ' active' : ''; ?>" data-sayfa-git="<?php echo $sayfaIndex + 1; ?>"><?php echo $sayfaIndex + 1; ?></button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="gebze-yan-kolon">
                <?php $currentGebzePage = 'sanal-tur'; include '../../includes/gebze-sidebar.php'; ?>
            </div>
        </div>
    </div>
</main>

<div class="sanaltur-modal-arkaplan" id="sanalturModalArkaplan" hidden>
    <div class="sanaltur-modal">
        <div class="sanaltur-modal-ust">
            <span id="sanalturModalBaslik"></span>
            <button type="button" id="sanalturKapat" aria-label="Kapat"><i class="bi bi-x-lg"></i></button>
        </div>
        <iframe id="sanalturIframe" src="" allowfullscreen loading="lazy"></iframe>
    </div>
</div>

<script>
(function () {
    var arkaplan = document.getElementById('sanalturModalArkaplan');
    var iframe = document.getElementById('sanalturIframe');
    var baslik = document.getElementById('sanalturModalBaslik');
    var kapatBtn = document.getElementById('sanalturKapat');

    document.querySelectorAll('.sanaltur-ac-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            iframe.src = btn.getAttribute('data-panorama');
            baslik.textContent = btn.getAttribute('data-ad');
            arkaplan.hidden = false;
        });
    });

    function kapat() {
        arkaplan.hidden = true;
        iframe.src = '';
    }

    kapatBtn.addEventListener('click', kapat);
    arkaplan.addEventListener('click', function (e) {
        if (e.target === arkaplan) kapat();
    });
    document.addEventListener('keydown', function (e) {
        if (!arkaplan.hidden && e.key === 'Escape') kapat();
    });

    // Sayfalama
    var kartlar = document.querySelectorAll('.sanaltur-sayfa');
    var sayfaBtnlar = document.querySelectorAll('#sanalturSayfalama .meclis-sayfa-btn');
    var baslikEl = document.querySelector('.sanaltur-baslik');

    function sayfayaGit(n, kaydir) {
        kartlar.forEach(function (kart) {
            kart.style.display = (kart.getAttribute('data-sayfa') === String(n)) ? '' : 'none';
        });
        sayfaBtnlar.forEach(function (b) {
            b.classList.toggle('active', b.getAttribute('data-sayfa-git') === String(n));
        });
        if (kaydir && baslikEl) {
            baslikEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    sayfaBtnlar.forEach(function (btn) {
        btn.addEventListener('click', function () {
            sayfayaGit(btn.getAttribute('data-sayfa-git'), true);
        });
    });
})();
</script>

<?php include '../../includes/footer.php'; ?>