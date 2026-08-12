<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'E-Belediye - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';
include '../../includes/header.php';

$kategoriler = $conn->query("SELECT * FROM ebelediye_kategoriler ORDER BY sira ASC")->fetchAll(PDO::FETCH_ASSOC);
$tumHizmetler = $conn->query("SELECT * FROM ebelediye_hizmetler ORDER BY kategori_id ASC, sira ASC")->fetchAll(PDO::FETCH_ASSOC);

// Her kategori için ayrı bir ikon (görsel çeşitlilik için)
$kategoriIkonlari = [
    29 => 'bi-receipt-cutoff',      // Vergi İşlemleri
    30 => 'bi-headset',             // Gebze İletişim Merkezi
    31 => 'bi-app-indicator',       // İnteraktif Hizmetler
    17 => 'bi-mortarboard',         // Spor ve Eğitim
    32 => 'bi-building',            // İmar Yönetim Sistemi
    15 => 'bi-info-circle',         // Bilgilendirme Hizmetleri
    22 => 'bi-briefcase',           // Kurum İçi İşlemler
];

$kategoriAdlariMap = [];
foreach ($kategoriler as $k) {
    $kategoriAdlariMap[$k['id']] = $k['ad'];
}

$sayfaBasi = 12;
$hizmetSayfalari = array_chunk($tumHizmetler, $sayfaBasi);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/ebelediye.css">

<main class="ebelediye-bolumu page-content">
    <div class="container">
        <header class="section-header section-header-left ebelediye-baslik">
            <h2>E-Belediye Hizmetleri</h2>
            <p class="ebelediye-alt-baslik">Tüm belediye hizmetlerine tek noktadan erişim</p>
        </header>

        <div class="ebelediye-ust-bar">
            <div class="meclis-arama-wrap ebelediye-arama-wrap">
                <input type="text" class="meclis-arama" id="ebelediyeArama" placeholder="Hizmet ara" aria-label="Hizmet ara">
                <button type="button" class="meclis-arama-ikon" id="ebelediyeAramaBtn" aria-label="Ara">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <div class="ebelediye-kategori-dropdown-wrap">
                <button type="button" class="ebelediye-hamburger-btn" id="ebelediyeHamburgerBtn" aria-label="Kategoriler">
                    <i class="bi bi-list"></i>
                    <span>Kategoriler</span>
                </button>
                <div class="ebelediye-kategori-dropdown" id="ebelediyeKategoriDropdown" hidden>
                    <button type="button" class="ebelediye-kategori-btn active" data-kategori="hepsi">Tümü</button>
                    <?php foreach ($kategoriler as $k): ?>
                        <button type="button" class="ebelediye-kategori-btn" data-kategori="<?php echo (int) $k['id']; ?>"><?php echo htmlspecialchars($k['ad']); ?></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="ebelediye-aktif-kategori" id="ebelediyeAktifKategoriYazi"><i class="bi bi-funnel"></i> Tümü</div>

        <div class="ebelediye-hizmet-grid">
            <?php foreach ($hizmetSayfalari as $sayfaIndex => $sayfaHizmetleri): ?>
                <?php foreach ($sayfaHizmetleri as $h): ?>
                    <?php
                        $ikonSinifi = $kategoriIkonlari[$h['kategori_id']] ?? 'bi-grid-1x2-fill';
                    ?>
                    <button type="button"
                            class="ebelediye-kart ebelediye-sayfa"
                            data-sayfa="<?php echo $sayfaIndex + 1; ?>"
                            data-kategori="<?php echo (int) $h['kategori_id']; ?>"
                            data-kategori-adi="<?php echo htmlspecialchars($kategoriAdlariMap[$h['kategori_id']] ?? ''); ?>"
                            data-has-modal="<?php echo (int) $h['has_modal']; ?>"
                            data-url="<?php echo htmlspecialchars($h['url'] ?? ''); ?>"
                            data-ad="<?php echo htmlspecialchars(mb_strtolower($h['ad'], 'UTF-8')); ?>"
                            <?php if ($h['has_modal']): ?>data-steps="<?php echo htmlspecialchars($h['modal_steps_json']); ?>"<?php endif; ?>
                            <?php echo $sayfaIndex > 0 ? 'style="display:none;"' : ''; ?>>
                        <i class="bi <?php echo $ikonSinifi; ?> ebelediye-ikon"></i>
                        <span class="ebelediye-kart-adi"><?php echo htmlspecialchars($h['ad']); ?></span>
                    </button>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>

        <?php if (count($hizmetSayfalari) > 1): ?>
            <div class="meclis-sayfalama" id="ebelediyeSayfalama">
                <?php foreach ($hizmetSayfalari as $sayfaIndex => $sayfaHizmetleri): ?>
                    <button type="button" class="meclis-sayfa-btn<?php echo $sayfaIndex === 0 ? ' active' : ''; ?>" data-sayfa-git="<?php echo $sayfaIndex + 1; ?>"><?php echo $sayfaIndex + 1; ?></button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<div class="ebelediye-modal-arkaplan" id="ebelediyeModalArkaplan" hidden>
    <div class="ebelediye-modal">
        <div class="ebelediye-modal-ust">
            <button type="button" class="ebelediye-modal-geri" id="ebelediyeModalGeri" hidden><i class="bi bi-arrow-left"></i></button>
            <span id="ebelediyeModalBaslik"></span>
            <button type="button" class="ebelediye-modal-kapat" id="ebelediyeModalKapat" aria-label="Kapat"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="ebelediye-modal-govde" id="ebelediyeModalGovde"></div>
    </div>
</div>

<script>
(function () {
    var kartlar = document.querySelectorAll('.ebelediye-sayfa');
    var kategoriBtnlar = document.querySelectorAll('.ebelediye-kategori-btn');
    var sayfaBtnlar = document.querySelectorAll('#ebelediyeSayfalama .meclis-sayfa-btn');
    var sayfalamaKutu = document.getElementById('ebelediyeSayfalama');
    var baslikEl = document.querySelector('.ebelediye-baslik');
    var aktifKategori = 'hepsi';

    // Hamburger / kategori açılır menüsü
    var hamburgerBtn = document.getElementById('ebelediyeHamburgerBtn');
    var kategoriDropdown = document.getElementById('ebelediyeKategoriDropdown');

    hamburgerBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        kategoriDropdown.hidden = !kategoriDropdown.hidden;
    });
    document.addEventListener('click', function (e) {
        if (kategoriDropdown.hidden) return;
        var tiklananHamburger = e.target.closest('#ebelediyeHamburgerBtn');
        var tiklananDropdown = e.target.closest('#ebelediyeKategoriDropdown');
        if (!tiklananHamburger && !tiklananDropdown) {
            kategoriDropdown.hidden = true;
        }
    });

    function sayfayaGit(n, kaydir) {
        kartlar.forEach(function (kart) {
            var kategoriUyar = (aktifKategori === 'hepsi' || kart.getAttribute('data-kategori') === aktifKategori);
            var sayfaUyar = (aktifKategori !== 'hepsi') || (kart.getAttribute('data-sayfa') === String(n));
            kart.style.display = (kategoriUyar && sayfaUyar) ? '' : 'none';
        });
        sayfaBtnlar.forEach(function (b) {
            b.classList.toggle('active', b.getAttribute('data-sayfa-git') === String(n));
        });
        if (kaydir && baslikEl) {
            baslikEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    var aktifKategoriYazi = document.getElementById('ebelediyeAktifKategoriYazi');

    function kategoriUygula(kategori, kaydir) {
        aktifKategori = kategori;
        kategoriBtnlar.forEach(function (btn) {
            btn.classList.toggle('active', btn.getAttribute('data-kategori') === kategori);
        });

        if (kategori === 'hepsi') {
            if (sayfalamaKutu) sayfalamaKutu.style.display = '';
            sayfayaGit('1', false);
            if (aktifKategoriYazi) aktifKategoriYazi.innerHTML = '<i class="bi bi-funnel"></i> Tümü';
        } else {
            if (sayfalamaKutu) sayfalamaKutu.style.display = 'none';
            var kategoriAdi = '';
            kartlar.forEach(function (kart) {
                var uyar = kart.getAttribute('data-kategori') === kategori;
                kart.style.display = uyar ? '' : 'none';
                if (uyar && !kategoriAdi) kategoriAdi = kart.getAttribute('data-kategori-adi');
            });
            if (aktifKategoriYazi) aktifKategoriYazi.innerHTML = '<i class="bi bi-funnel"></i> ' + kategoriAdi;
        }
        if (kaydir && baslikEl) {
            baslikEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        kategoriDropdown.hidden = true;
    }

    kategoriBtnlar.forEach(function (btn) {
        btn.addEventListener('click', function () {
            kategoriUygula(btn.getAttribute('data-kategori'), true);
        });
    });

    sayfaBtnlar.forEach(function (btn) {
        btn.addEventListener('click', function () {
            sayfayaGit(btn.getAttribute('data-sayfa-git'), true);
        });
    });

    // Arama
    var arama = document.getElementById('ebelediyeArama');
    var aramaBtn = document.getElementById('ebelediyeAramaBtn');

    function filtrele() {
        var deger = arama.value.toLocaleLowerCase('tr-TR').trim();
        var aramaAktif = deger.length > 0;

        if (aramaAktif) {
            if (sayfalamaKutu) sayfalamaKutu.style.display = 'none';
            kartlar.forEach(function (kart) {
                kart.style.display = kart.getAttribute('data-ad').includes(deger) ? '' : 'none';
            });
        } else {
            kategoriUygula(aktifKategori, false);
        }
    }

    arama.addEventListener('input', filtrele);
    aramaBtn.addEventListener('click', function () {
        arama.focus();
        filtrele();
    });

    // Kart tıklama: direkt link ya da çok adımlı pencere (modal)
    var modalArkaplan = document.getElementById('ebelediyeModalArkaplan');
    var modalBaslik = document.getElementById('ebelediyeModalBaslik');
    var modalGovde = document.getElementById('ebelediyeModalGovde');
    var modalGeri = document.getElementById('ebelediyeModalGeri');
    var modalKapat = document.getElementById('ebelediyeModalKapat');

    var mevcutSteps = null;
    var stepGecmisi = [];

    function stepBul(stepId) {
        return mevcutSteps.find(function (s) { return s.id === stepId; });
    }

    function stepGoster(stepId) {
        var step = stepBul(stepId);
        if (!step) return;

        modalBaslik.textContent = step.title;
        modalGeri.hidden = !step.backStep;

        modalGovde.innerHTML = '';
        step.options.forEach(function (opt) {
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'ebelediye-modal-secenek';
            if (opt.tooltip) btn.title = opt.tooltip;

            var yazi = document.createElement('span');
            yazi.textContent = opt.text;
            btn.appendChild(yazi);

            var ok = document.createElement('i');
            ok.className = 'bi bi-chevron-right';
            btn.appendChild(ok);

            btn.addEventListener('click', function () {
                if (opt.nextStep) {
                    stepGecmisi.push(stepId);
                    stepGoster(opt.nextStep);
                } else if (opt.url) {
                    window.open(opt.url, '_blank');
                }
            });

            modalGovde.appendChild(btn);
        });
    }

    modalGeri.addEventListener('click', function () {
        var oncekiStep = stepGecmisi.pop();
        if (oncekiStep) stepGoster(oncekiStep);
    });

    function modalKapatFn() {
        modalArkaplan.hidden = true;
        mevcutSteps = null;
        stepGecmisi = [];
    }

    modalKapat.addEventListener('click', modalKapatFn);
    modalArkaplan.addEventListener('click', function (e) {
        if (e.target === modalArkaplan) modalKapatFn();
    });
    document.addEventListener('keydown', function (e) {
        if (!modalArkaplan.hidden && e.key === 'Escape') modalKapatFn();
    });

    kartlar.forEach(function (kart) {
        kart.addEventListener('click', function () {
            var hasModal = kart.getAttribute('data-has-modal') === '1';
            if (hasModal) {
                mevcutSteps = JSON.parse(kart.getAttribute('data-steps'));
                stepGecmisi = [];
                modalArkaplan.hidden = false;
                stepGoster('step1');
            } else {
                var url = kart.getAttribute('data-url');
                if (url) window.open(url, '_blank');
            }
        });
    });
})();
</script>

<?php include '../../includes/footer.php'; ?>