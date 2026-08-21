<?php
include '../../includes/db.php';
require_once '../../includes/init.php';

$basePath = '../../';
$pageTitle = 'Belediye Meclisi - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

include '../../includes/header.php';

$stmt = $conn->query("SELECT * FROM meclis_uyeleri ORDER BY sira ASC");
$tumUyeler = $stmt->fetchAll(PDO::FETCH_ASSOC);

$meclisBaskani = null;
$meclisUyeleri = [];
foreach ($tumUyeler as $uye) {
    if ($uye['baskan_mi']) {
        $meclisBaskani = $uye;
    } else {
        $meclisUyeleri[] = $uye;
    }
}

// Her sayfada 10 üye
$sayfaBasi = 10;
$toplamUye = count($meclisUyeleri);
$uyeSayfalari = array_chunk($meclisUyeleri, $sayfaBasi);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            <div class="kurumsal-ana-kart meclis-ust-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>Belediye Meclisi</span>
                </nav>

                <header class="section-header section-header-left">
                    <h2>Belediye Meclis Üyeleri</h2>
                </header>

                <?php if ($meclisBaskani): ?>
                    <div class="meclis-baskan-kart">
                        <img src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=meclis_uyeleri&id=<?php echo (int) $meclisBaskani['id']; ?>" alt="<?php echo htmlspecialchars($meclisBaskani['ad']); ?>">
                        <div class="baskan-metin">
                            <h3><?php echo htmlspecialchars($meclisBaskani['ad']); ?></h3>
                            <span><?php echo htmlspecialchars($meclisBaskani['unvan']); ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php $currentKurumsalPage = 'meclis'; include '../../includes/kurumsal-sidebar.php'; ?>
        </div>

        <div class="meclis-alt-bolum">
            <div class="meclis-arama-wrap">
                <input type="text" class="meclis-arama" id="meclisArama" placeholder="İsme göre ara..." aria-label="Meclis üyesi ara">
                <button type="button" class="meclis-arama-ikon" id="meclisAramaBtn" aria-label="Ara">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <h3 class="meclis-alt-baslik">Meclis Üyeleri</h3>
            <hr class="meclis-ayrac">

            <p class="meclis-toplam">Toplam <?php echo $toplamUye; ?> meclis üyesi</p>

            <?php foreach ($uyeSayfalari as $sayfaIndex => $sayfaUyeleri): ?>
                <div class="meclis-grid meclis-sayfa" data-sayfa="<?php echo $sayfaIndex + 1; ?>" <?php echo $sayfaIndex > 0 ? 'style="display:none;"' : ''; ?>>
                    <?php foreach ($sayfaUyeleri as $uye): ?>
                        <div class="meclis-kart" data-ad="<?php echo htmlspecialchars(mb_strtolower($uye['ad'], 'UTF-8')); ?>">
                            <img src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=meclis_uyeleri&id=<?php echo (int) $uye['id']; ?>" alt="<?php echo htmlspecialchars($uye['ad']); ?>" loading="lazy">
                            <h4><?php echo htmlspecialchars($uye['ad']); ?></h4>
                            <span><?php echo htmlspecialchars($uye['unvan']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <?php if (count($uyeSayfalari) > 1): ?>
                <div class="meclis-sayfalama" id="meclisSayfalama">
                    <?php foreach ($uyeSayfalari as $sayfaIndex => $sayfaUyeleri): ?>
                        <button type="button" class="meclis-sayfa-btn<?php echo $sayfaIndex === 0 ? ' active' : ''; ?>" data-sayfa-git="<?php echo $sayfaIndex + 1; ?>"><?php echo $sayfaIndex + 1; ?></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
(function () {
    var arama = document.getElementById('meclisArama');
    var aramaBtn = document.getElementById('meclisAramaBtn');
    var sayfalar = document.querySelectorAll('.meclis-sayfa');
    var sayfaBtnlar = document.querySelectorAll('.meclis-sayfa-btn');
    var sayfalamaKutu = document.getElementById('meclisSayfalama');
    var baslik = document.querySelector('.meclis-alt-baslik');
    var aramaAktif = false;

    function sayfayaGit(n, kaydir) {
        sayfalar.forEach(function (sayfa) {
            sayfa.style.display = (sayfa.getAttribute('data-sayfa') === String(n)) ? '' : 'none';
        });
        sayfaBtnlar.forEach(function (btn) {
            btn.classList.toggle('active', btn.getAttribute('data-sayfa-git') === String(n));
        });
        if (kaydir && baslik) {
            baslik.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function filtrele() {
        var deger = arama.value.toLocaleLowerCase('tr-TR').trim();
        aramaAktif = deger.length > 0;

        if (aramaAktif) {
            // Arama sırasında tüm sayfaları göster, sadece eşleşenleri listele
            sayfalar.forEach(function (sayfa) { sayfa.style.display = ''; });
            if (sayfalamaKutu) sayfalamaKutu.style.display = 'none';
            document.querySelectorAll('.meclis-kart').forEach(function (kart) {
                var ad = kart.getAttribute('data-ad');
                kart.style.display = ad.includes(deger) ? '' : 'none';
            });
        } else {
            // Arama temizlendi, sayfalamaya geri dön
            document.querySelectorAll('.meclis-kart').forEach(function (kart) {
                kart.style.display = '';
            });
            if (sayfalamaKutu) sayfalamaKutu.style.display = '';
            var aktifBtn = document.querySelector('.meclis-sayfa-btn.active');
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

<?php include '../../includes/footer.php'; ?>