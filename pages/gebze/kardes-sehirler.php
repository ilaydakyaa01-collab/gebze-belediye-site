<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'Kardeş Şehirler - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';
include '../../includes/header.php';

$stmt = $conn->query("SELECT * FROM kardes_sehirler ORDER BY tur ASC, sira ASC");
$tumSehirler = $stmt->fetchAll(PDO::FETCH_ASSOC);

$yurtIci = array_filter($tumSehirler, fn($s) => $s['tur'] === 'yurt_ici');
$yurtDisi = array_filter($tumSehirler, fn($s) => $s['tur'] === 'yurt_disi');
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/gebze.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>Kardeş Şehirler</span>
                </nav>

                <header class="section-header section-header-left">
                    <h2>Kardeş Şehirler</h2>
                </header>

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

                <div id="kardesMetin" style="--metin-olcek: 1;">
                    <h3 class="tarihce-alt-baslik">Yurt İçi Kardeş Şehirlerimiz</h3>
                    <div class="kardes-liste kardes-grid-2">
                        <?php foreach ($yurtIci as $s): ?>
                            <div class="kardes-satir">
                                <i class="bi bi-geo-alt"></i>
                                <div>
                                    <strong><?php echo htmlspecialchars($s['belediye_adi']); ?></strong>
                                    <span><?php echo htmlspecialchars($s['sehir_adi']); ?>, <?php echo htmlspecialchars($s['ulke']); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <h3 class="tarihce-alt-baslik">Yurt Dışı Kardeş Şehirlerimiz</h3>
                    <div class="kardes-liste kardes-grid-2">
                        <?php foreach ($yurtDisi as $s): ?>
                            <div class="kardes-satir">
                                <i class="bi bi-globe2"></i>
                                <div>
                                    <strong><?php echo htmlspecialchars($s['belediye_adi']); ?></strong>
                                    <span><?php echo htmlspecialchars($s['sehir_adi']); ?>, <?php echo htmlspecialchars($s['ulke']); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="gebze-yan-kolon">
                <?php $currentGebzePage = 'kardes-sehirler'; include '../../includes/gebze-sidebar.php'; ?>
            </div>
        </div>
    </div>
</main>

<script>
(function () {
    var metin = document.getElementById('kardesMetin');
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

<?php include '../../includes/footer.php'; ?>