<?php
include '../includes/db.php';

$basePath = '../';
$pageTitle = 'Müdürlükler - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';
include '../includes/header.php';

$stmt = $conn->query("SELECT * FROM mudurlukler ORDER BY sira ASC");
$tumMudurlukler = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sayfaBasi = 9;
$mudurlukSayfalari = array_chunk($tumMudurlukler, $sayfaBasi);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-ana-kart mudurluk-tam-kart">
            <nav class="breadcrumb">
                <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                <span>/</span>
                <span>Müdürlükler</span>
            </nav>

            <div class="mudurluk-ust-bar">
                <header class="section-header section-header-left mudurluk-baslik">
                    <h2>Müdürlükler</h2>
                </header>

                <div class="mudurluk-arac-grup">
                    <div class="meclis-arama-wrap mudurluk-arama-wrap">
                        <input type="text" class="meclis-arama" id="mudurlukArama" placeholder="Ara" aria-label="Müdürlük ara">
                        <button type="button" class="meclis-arama-ikon" id="mudurlukAramaBtn" aria-label="Ara">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <div class="kurumsal-hamburger-wrap">
                        <button type="button" class="kurumsal-hamburger-btn" id="kurumsalHamburgerBtn" aria-label="Kurumsal menü">
                            <i class="bi bi-list"></i>
                        </button>
                        <div class="kurumsal-dropdown" id="kurumsalDropdown" hidden>
                            <?php $currentKurumsalPage = 'mudurlukler'; include '../includes/kurumsal-sidebar.php'; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mudurluk-grid">
                <?php foreach ($mudurlukSayfalari as $sayfaIndex => $sayfaMudurlukleri): ?>
                    <?php foreach ($sayfaMudurlukleri as $m): ?>
                        <div class="mudurluk-kart mudurluk-sayfa" data-sayfa="<?php echo $sayfaIndex + 1; ?>" data-ara="<?php echo htmlspecialchars(mb_strtolower($m['ad'] . ' ' . $m['sorumlu_adi'] . ' ' . $m['eposta'], 'UTF-8')); ?>" data-href="mudurluk-detay.php?id=<?php echo (int) $m['id']; ?>" <?php echo $sayfaIndex > 0 ? 'style="display:none;"' : ''; ?>>
                            <img src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=mudurlukler&id=<?php echo (int) $m['id']; ?>" alt="<?php echo htmlspecialchars($m['sorumlu_adi']); ?>" loading="lazy">
                            <div class="mudurluk-kart-icerik">
                                <h4><?php echo htmlspecialchars($m['ad']); ?></h4>
                                <span class="mudurluk-sorumlu"><?php echo htmlspecialchars($m['sorumlu_adi']); ?></span>
                                <?php if (!empty($m['eposta'])): ?>
                                    <span class="mudurluk-eposta"><?php echo htmlspecialchars($m['eposta']); ?></span>
                                <?php endif; ?>
                                <div class="mudurluk-linkler">
                                    <a href="mudurluk-detay.php?id=<?php echo (int) $m['id']; ?>" class="mudurluk-biyografi-link">Biyografi</a>
                                    <a href="#" class="mudurluk-yonetmelik-link">Yönetmelik</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>

            <?php if (count($mudurlukSayfalari) > 1): ?>
                <div class="meclis-sayfalama" id="mudurlukSayfalama">
                    <?php foreach ($mudurlukSayfalari as $sayfaIndex => $sayfaMudurlukleri): ?>
                        <button type="button" class="meclis-sayfa-btn<?php echo $sayfaIndex === 0 ? ' active' : ''; ?>" data-sayfa-git="<?php echo $sayfaIndex + 1; ?>"><?php echo $sayfaIndex + 1; ?></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
(function () {
    // Kartlara tıklanınca detay sayfasına git (Yönetmelik linkine tıklanınca hariç)
    document.querySelectorAll('.mudurluk-kart').forEach(function (kart) {
        kart.style.cursor = 'pointer';
        kart.addEventListener('click', function (e) {
            if (e.target.closest('.mudurluk-yonetmelik-link')) {
                return;
            }
            window.location.href = kart.getAttribute('data-href');
        });
    });

    // Hamburger dropdown
    var hamburgerBtn = document.getElementById('kurumsalHamburgerBtn');
    var dropdown = document.getElementById('kurumsalDropdown');

    hamburgerBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.hidden = !dropdown.hidden;
    });

    document.addEventListener('click', function (e) {
        if (!dropdown.hidden && !dropdown.contains(e.target) && e.target !== hamburgerBtn) {
            dropdown.hidden = true;
        }
    });

    // Arama + sayfalama
    var arama = document.getElementById('mudurlukArama');
    var aramaBtn = document.getElementById('mudurlukAramaBtn');
    var kartlar = document.querySelectorAll('.mudurluk-sayfa');
    var sayfaBtnlar = document.querySelectorAll('#mudurlukSayfalama .meclis-sayfa-btn');
    var sayfalamaKutu = document.getElementById('mudurlukSayfalama');
    var mudurlukBaslik = document.querySelector('.mudurluk-baslik');

    function sayfayaGit(n, kaydir) {
        kartlar.forEach(function (kart) {
            kart.style.display = (kart.getAttribute('data-sayfa') === String(n)) ? '' : 'none';
        });
        sayfaBtnlar.forEach(function (btn) {
            btn.classList.toggle('active', btn.getAttribute('data-sayfa-git') === String(n));
        });
        if (kaydir && mudurlukBaslik) {
            mudurlukBaslik.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function filtrele() {
        var deger = arama.value.toLocaleLowerCase('tr-TR').trim();
        var aramaAktif = deger.length > 0;

        if (aramaAktif) {
            if (sayfalamaKutu) sayfalamaKutu.style.display = 'none';
            kartlar.forEach(function (kart) {
                var metin = kart.getAttribute('data-ara');
                kart.style.display = metin.includes(deger) ? '' : 'none';
            });
        } else {
            if (sayfalamaKutu) sayfalamaKutu.style.display = '';
            var aktifBtn = document.querySelector('#mudurlukSayfalama .meclis-sayfa-btn.active');
            sayfayaGit(aktifBtn ? aktifBtn.getAttribute('data-sayfa-git') : '1');
        }
    }

    arama.addEventListener('input', filtrele);
    aramaBtn.addEventListener('click', function () {
        arama.focus();
        filtrele();
    });

    sayfaBtnlar.forEach(function (btn) {
        btn.addEventListener('click', function () {
            sayfayaGit(btn.getAttribute('data-sayfa-git'), true);
        });
    });
})();
</script>

<?php include '../includes/footer.php'; ?>