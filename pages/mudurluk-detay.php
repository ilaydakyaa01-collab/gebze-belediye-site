<?php
include '../includes/db.php';

$basePath = '../';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM mudurlukler WHERE id = ?");
$stmt->execute([$id]);
$mudurluk = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$mudurluk) {
    header("Location: mudurlukler.php");
    exit;
}

$pageTitle = $mudurluk['ad'] . ' - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';
include '../includes/header.php';
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <a href="mudurlukler.php">Müdürlükler</a>
                    <span>/</span>
                    <span><?php echo htmlspecialchars($mudurluk['ad']); ?></span>
                </nav>

                <header class="section-header section-header-left mudurluk-detay-baslik">
                    <h2><?php echo htmlspecialchars($mudurluk['ad']); ?></h2>
                </header>

                <div class="mudurluk-detay-ust">
                    <img src="<?php echo $basePath . htmlspecialchars($mudurluk['resim']); ?>" alt="<?php echo htmlspecialchars($mudurluk['sorumlu_adi']); ?>">
                    <div class="mudurluk-detay-bilgi">
                        <h3><?php echo htmlspecialchars($mudurluk['sorumlu_adi']); ?></h3>
                        <div class="mudurluk-detay-satir">
                            <i class="bi bi-telephone"></i>
                            <span>0262 642 04 30</span>
                        </div>
                        <?php if (!empty($mudurluk['eposta'])): ?>
                            <div class="mudurluk-detay-satir">
                                <i class="bi bi-envelope"></i>
                                <span><?php echo htmlspecialchars($mudurluk['eposta']); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($mudurluk['adres'])): ?>
                            <div class="mudurluk-detay-satir">
                                <i class="bi bi-geo-alt"></i>
                                <span><?php echo htmlspecialchars($mudurluk['adres']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="metin-araclari">
                    <button type="button" class="arac-btn" id="fontKucult" aria-label="Yazıyı küçült" title="Yazıyı küçült">
                        <i class="bi bi-zoom-out"></i>
                    </button>
                    <button type="button" class="arac-btn" id="fontNormal" aria-label="Normal boyut" title="Normal boyut">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                    <button type="button" class="arac-btn" id="fontBuyut" aria-label="Yazıyı büyüt" title="Yazıyı büyüt">
                        <i class="bi bi-zoom-in"></i>
                    </button>
                    <button type="button" class="arac-btn" id="yazdirBtn" aria-label="Yazdır" title="Yazdır">
                        <i class="bi bi-printer"></i>
                    </button>
                </div>

                <div class="yrd-tab-group" role="tablist">
                    <button type="button" class="yrd-tab active" data-tab="biyografi">Biyografi</button>
                    <button type="button" class="yrd-tab" data-tab="yonetmelik">Yönetmelik</button>
                </div>

                <div class="kurumsal-metin-duz" id="mudurlukMetin">
                    <div class="yrd-tab-panel" data-panel="biyografi">
                        <?php if (!empty($mudurluk['biyografi'])): ?>
                            <p><?php echo nl2br(htmlspecialchars($mudurluk['biyografi'])); ?></p>
                        <?php else: ?>
                            <p>Bu müdürlük için biyografi bilgisi henüz eklenmedi.</p>
                        <?php endif; ?>
                    </div>

                    <div class="yrd-tab-panel" data-panel="yonetmelik" hidden>
                        <?php if (!empty($mudurluk['yonetmelik'])): ?>
                            <p><?php echo nl2br(htmlspecialchars($mudurluk['yonetmelik'])); ?></p>
                        <?php else: ?>
                            <p>Bu müdürlük için yönetmelik bilgisi henüz eklenmedi.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php $currentKurumsalPage = 'mudurlukler'; include '../includes/kurumsal-sidebar.php'; ?>
        </div>
    </div>
</main>

<script>
(function () {
    var tabButonlar = document.querySelectorAll('.yrd-tab');
    var paneller = document.querySelectorAll('.yrd-tab-panel');

    tabButonlar.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var hedef = btn.getAttribute('data-tab');
            tabButonlar.forEach(function (b) { b.classList.toggle('active', b === btn); });
            paneller.forEach(function (p) {
                p.hidden = p.getAttribute('data-panel') !== hedef;
            });
        });
    });

    var metin = document.getElementById('mudurlukMetin');
    var olcek = 1;
    var ADIM = 0.1;
    var MIN = 0.7;
    var MAX = 1.5;

    function uygula() {
        metin.style.setProperty('--metin-olcek', olcek.toFixed(2));
    }

    document.getElementById('fontBuyut').addEventListener('click', function () {
        olcek = Math.min(MAX, olcek + ADIM);
        uygula();
    });

    document.getElementById('fontKucult').addEventListener('click', function () {
        olcek = Math.max(MIN, olcek - ADIM);
        uygula();
    });

    document.getElementById('fontNormal').addEventListener('click', function () {
        olcek = 1;
        uygula();
    });

    document.getElementById('yazdirBtn').addEventListener('click', function () {
        window.print();
    });
})();
</script>

<?php include '../includes/footer.php'; ?>