<?php
include '../includes/db.php';

$basePath = '../';
$pageTitle = 'Belediye Meclisi - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';
include '../includes/header.php';

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
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            <div class="kurumsal-ana-kart">
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
                        <img src="<?php echo $basePath . htmlspecialchars($meclisBaskani['resim']); ?>" alt="<?php echo htmlspecialchars($meclisBaskani['ad']); ?>">
                        <div class="baskan-metin">
                            <h3><?php echo htmlspecialchars($meclisBaskani['ad']); ?></h3>
                            <span><?php echo htmlspecialchars($meclisBaskani['unvan']); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="meclis-arama-wrap">
                    <input type="text" class="meclis-arama" id="meclisArama" placeholder="İsme göre ara..." aria-label="Meclis üyesi ara">
                    <button type="button" class="meclis-arama-ikon" id="meclisAramaBtn" aria-label="Ara">
                        <i class="bi bi-search"></i>
                    </button>
                </div>

                <h3 class="meclis-alt-baslik">Meclis Üyeleri</h3>
                <hr class="meclis-ayrac">

                <div class="meclis-grid" id="meclisGrid">
                    <?php foreach ($meclisUyeleri as $uye): ?>
                        <div class="meclis-kart" data-ad="<?php echo htmlspecialchars(mb_strtolower($uye['ad'], 'UTF-8')); ?>">
                            <img src="<?php echo $basePath . htmlspecialchars($uye['resim']); ?>" alt="<?php echo htmlspecialchars($uye['ad']); ?>" loading="lazy">
                            <h4><?php echo htmlspecialchars($uye['ad']); ?></h4>
                            <span><?php echo htmlspecialchars($uye['unvan']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php $currentKurumsalPage = 'meclis'; include '../includes/kurumsal-sidebar.php'; ?>
        </div>
    </div>
</main>

<script>
(function () {
    var arama = document.getElementById('meclisArama');
    var aramaBtn = document.getElementById('meclisAramaBtn');
    var kartlar = document.querySelectorAll('#meclisGrid .meclis-kart');

    function filtrele() {
        var deger = arama.value.toLocaleLowerCase('tr-TR').trim();
        kartlar.forEach(function (kart) {
            var ad = kart.getAttribute('data-ad');
            kart.style.display = ad.includes(deger) ? '' : 'none';
        });
    }

    arama.addEventListener('input', filtrele);
    aramaBtn.addEventListener('click', function () {
        arama.focus();
        filtrele();
    });
})();
</script>

<?php include '../includes/footer.php'; ?>