<?php
include '../includes/db.php';

$basePath = '../';
$pageTitle = 'Videolar - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';
include '../includes/header.php';

$tumVideolar = $conn->query("SELECT * FROM videolar ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);

$sayfaBasi = 6;
$videoSayfalari = array_chunk($tumVideolar, $sayfaBasi);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/videolar.css">

<style>
/* Modal Stilleri */
.video-modal-arkaplan {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.85);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 999999;
    padding: 20px;
    box-sizing: border-box;
}

.video-modal-arkaplan.aktif {
    display: flex !important;
}

.video-modal {
    position: relative;
    width: 100%;
    max-width: 860px;
    background: #000;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
}

.video-modal-kapat {
    position: absolute;
    top: -40px;
    right: 0;
    background: transparent;
    border: none;
    color: #ffffff;
    font-size: 32px;
    cursor: pointer;
    line-height: 1;
    padding: 5px;
}

.video-modal-govde {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 Oranı */
    height: 0;
    overflow: hidden;
    background: #000;
    border-radius: 8px;
}

.video-modal-govde iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}
</style>

<main class="videolar-bolumu page-content">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
            <span>/</span>
            <span>Videolar</span>
        </nav>

        <header class="section-header section-header-left videolar-baslik">
            <h2>Videolar</h2>
        </header>

        <div class="videolar-ust-bar">
            <div class="meclis-arama-wrap videolar-arama-wrap">
                <input type="text" class="meclis-arama" id="videoArama" placeholder="Video ara" aria-label="Video ara">
                <button type="button" class="meclis-arama-ikon" id="videoAramaBtn" aria-label="Ara">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <div class="videolar-hamburger-wrap">
                <button type="button" class="ebelediye-hamburger-btn" id="videoHamburgerBtn" aria-label="Haberler menüsü">
                    <i class="bi bi-list"></i>
                    <span>Haberler</span>
                </button>
                <div class="videolar-hamburger-dropdown" id="videoHamburgerDropdown" hidden>
                    <a href="<?php echo $basePath; ?>pages/haberler.php">Haberler</a>
                    <a href="#">Duyurular</a>
                    <a href="<?php echo $basePath; ?>pages/videolar.php" class="active">Videolar</a>
                    <a href="#">Fotoğraf Galerisi</a>
                </div>
            </div>
        </div>

        <div class="videolar-grid">
            <?php foreach ($videoSayfalari as $sayfaIndex => $sayfaVideolari): ?>
                <?php foreach ($sayfaVideolari as $v): ?>
                    <div class="video-kart video-sayfa"
                         data-sayfa="<?php echo $sayfaIndex + 1; ?>"
                         data-ara="<?php echo htmlspecialchars(mb_strtolower($v['baslik'] ?? '', 'UTF-8')); ?>"
                         data-video-id="<?php echo htmlspecialchars(trim($v['youtube_id'] ?? '')); ?>"
                         <?php echo $sayfaIndex > 0 ? 'style="display:none;"' : ''; ?>>
                        <div class="video-kart-thumb">
                            <img src="https://img.youtube.com/vi/<?php echo htmlspecialchars(trim($v['youtube_id'] ?? '')); ?>/hqdefault.jpg" alt="<?php echo htmlspecialchars($v['baslik'] ?? 'Video'); ?>" loading="lazy">
                            <span class="video-oynat-ikon"><i class="bi bi-play-fill"></i></span>
                        </div>
                        <div class="video-kart-icerik">
                            <?php if (!empty($v['baslik'])): ?>
                                <h4><?php echo htmlspecialchars($v['baslik']); ?></h4>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>

        <?php if (count($videoSayfalari) > 1): ?>
            <div class="meclis-sayfalama" id="videoSayfalama">
                <button type="button" class="meclis-sayfa-btn video-sayfa-ok" id="videoOnceki" aria-label="Önceki sayfa"><i class="bi bi-chevron-left"></i></button>
                <?php foreach ($videoSayfalari as $sayfaIndex => $sayfaVideolari): ?>
                    <button type="button" class="meclis-sayfa-btn<?php echo $sayfaIndex === 0 ? ' active' : ''; ?>" data-sayfa-git="<?php echo $sayfaIndex + 1; ?>"><?php echo $sayfaIndex + 1; ?></button>
                <?php endforeach; ?>
                <button type="button" class="meclis-sayfa-btn video-sayfa-ok" id="videoSonraki" aria-label="Sonraki sayfa"><i class="bi bi-chevron-right"></i></button>
            </div>
        <?php endif; ?>
    </div>
</main>

<!-- Video Popup / Modal Penceresi -->
<div class="video-modal-arkaplan" id="videoModalArkaplan">
    <div class="video-modal">
        <button type="button" class="video-modal-kapat" id="videoModalKapat" aria-label="Kapat">&times;</button>
        <div class="video-modal-govde" id="videoIframeKapsayici">
            <!-- Iframe burada dinamik oluşur -->
        </div>
    </div>
</div>

<script>
(function () {
    var TUM_KARTLAR = Array.prototype.slice.call(document.querySelectorAll('.video-sayfa'));
    var SAYFA_BASI = 6;
    var videolarBaslik = document.querySelector('.videolar-baslik');
    var sayfalamaKutu = document.getElementById('videoSayfalama');
    var oncekiBtn = document.getElementById('videoOnceki');
    var sonrakiBtn = document.getElementById('videoSonraki');
    var aktifArama = '';
    var mevcutSayfa = 1;

    // Hamburger menü
    var hamburgerBtn = document.getElementById('videoHamburgerBtn');
    var hamburgerDropdown = document.getElementById('videoHamburgerDropdown');
    if (hamburgerBtn && hamburgerDropdown) {
        hamburgerBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            hamburgerDropdown.hidden = !hamburgerDropdown.hidden;
        });
        document.addEventListener('click', function (e) {
            if (hamburgerDropdown.hidden) return;
            if (!e.target.closest('#videoHamburgerBtn') && !e.target.closest('#videoHamburgerDropdown')) {
                hamburgerDropdown.hidden = true;
            }
        });
    }

    function eslesenleriGetir() {
        return TUM_KARTLAR.filter(function (kart) {
            return aktifArama === '' || (kart.getAttribute('data-ara') && kart.getAttribute('data-ara').includes(aktifArama));
        });
    }

    function sayfalamaButonlariniOlustur(toplamSayfa) {
        if (!sayfalamaKutu) return;
        if (toplamSayfa <= 1) { sayfalamaKutu.style.display = 'none'; return; }
        sayfalamaKutu.style.display = '';
        sayfalamaKutu.querySelectorAll('.meclis-sayfa-btn[data-sayfa-git]').forEach(function (b) { b.remove(); });
        for (var i = 1; i <= toplamSayfa; i++) {
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'meclis-sayfa-btn' + (i === mevcutSayfa ? ' active' : '');
            btn.setAttribute('data-sayfa-git', i);
            btn.textContent = i;
            btn.addEventListener('click', function () { sayfayaGit(parseInt(this.getAttribute('data-sayfa-git'), 10), true); });
            sayfalamaKutu.insertBefore(btn, sonrakiBtn);
        }
    }

    function goster(kaydir) {
        var eslesenler = eslesenleriGetir();
        var toplamSayfa = Math.max(1, Math.ceil(eslesenler.length / SAYFA_BASI));
        if (mevcutSayfa > toplamSayfa) mevcutSayfa = toplamSayfa;
        TUM_KARTLAR.forEach(function (k) { k.style.display = 'none'; });
        var baslangic = (mevcutSayfa - 1) * SAYFA_BASI;
        eslesenler.slice(baslangic, baslangic + SAYFA_BASI).forEach(function (k) { k.style.display = ''; });
        sayfalamaButonlariniOlustur(toplamSayfa);
        if (kaydir && videolarBaslik) videolarBaslik.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function sayfayaGit(n, kaydir) { mevcutSayfa = n; goster(kaydir); }

    if (oncekiBtn) oncekiBtn.addEventListener('click', function () {
        var toplamSayfa = Math.max(1, Math.ceil(eslesenleriGetir().length / SAYFA_BASI));
        sayfayaGit(mevcutSayfa > 1 ? mevcutSayfa - 1 : toplamSayfa, true);
    });
    if (sonrakiBtn) sonrakiBtn.addEventListener('click', function () {
        var toplamSayfa = Math.max(1, Math.ceil(eslesenleriGetir().length / SAYFA_BASI));
        sayfayaGit(mevcutSayfa < toplamSayfa ? mevcutSayfa + 1 : 1, true);
    });

    var arama = document.getElementById('videoArama');
    var aramaBtn = document.getElementById('videoAramaBtn');
    function aramaUygula() {
        if (!arama) return;
        aktifArama = arama.value.toLocaleLowerCase('tr-TR').trim();
        mevcutSayfa = 1;
        goster(false);
    }
    if (arama) arama.addEventListener('input', aramaUygula);
    if (aramaBtn) aramaBtn.addEventListener('click', function () { arama.focus(); aramaUygula(); });

    // Video ID Ayıklayıcı (URL veya düz ID gelse de çözer)
    function cleanYouTubeId(input) {
        if (!input) return '';

        input = input.trim();

        // Veritabanında doğrudan 11 karakterlik YouTube ID'si tutuluyorsa.
        if (/^[\w-]{11}$/.test(input)) {
            return input;
        }

        // YouTube URL'sinden ID'yi çıkar.
        var match = input.match(/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/);

        return match ? match[1] : '';
    }

    // Modal Yönetimi
    var modalArkaplan = document.getElementById('videoModalArkaplan');
    var iframeKapsayici = document.getElementById('videoIframeKapsayici');
    var modalKapat = document.getElementById('videoModalKapat');

    TUM_KARTLAR.forEach(function (kart) {
        kart.addEventListener('click', function () {
            var rawId = kart.getAttribute('data-video-id');
            var videoId = cleanYouTubeId(rawId);

            if (!videoId) return;

            // Kart tıklandığında videonun doğrudan başlaması için autoplay kullanıyoruz.
            // iframe'de ses açık olacağı için tarayıcı autoplay'i engellerse
            // kullanıcı YouTube oynat butonuna basarak devam edebilir.
            var origin = window.location.origin;
            var embedUrl = 'https://www.youtube-nocookie.com/embed/' +
                encodeURIComponent(videoId) +
                '?autoplay=1&playsinline=1&rel=0&modestbranding=1&origin=' +
                encodeURIComponent(origin);

            // Önce eski iframe'i tamamen kaldır, ardından yeni player oluştur.
            iframeKapsayici.innerHTML = '';

            var iframe = document.createElement('iframe');
            iframe.src = embedUrl;
            iframe.title = 'Gebze Belediyesi Videosu';
            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
            iframe.setAttribute('allowfullscreen', '');
            iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');

            iframeKapsayici.appendChild(iframe);
            modalArkaplan.classList.add('aktif');
        });
    });

    function modalKapatFn() {
        modalArkaplan.classList.remove('aktif');
        iframeKapsayici.innerHTML = ''; // Kapatıldığında sesi ve oynatmayı anında keser
    }

    if (modalKapat) modalKapat.addEventListener('click', modalKapatFn);
    if (modalArkaplan) {
        modalArkaplan.addEventListener('click', function (e) {
            if (e.target === modalArkaplan) modalKapatFn();
        });
    }
    document.addEventListener('keydown', function (e) {
        if (modalArkaplan.classList.contains('aktif') && e.key === 'Escape') modalKapatFn();
    });

    goster(false);
})();
</script>

<?php include '../includes/footer.php'; ?>