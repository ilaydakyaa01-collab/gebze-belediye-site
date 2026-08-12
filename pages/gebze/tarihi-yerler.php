<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'Tarihi Yerler - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';
include '../../includes/header.php';

$stmt = $conn->query("SELECT * FROM tarihi_yerler ORDER BY sira ASC");
$tumYerler = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sayfaBasi = 4;
$yerSayfalari = array_chunk($tumYerler, $sayfaBasi);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/gebze.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>Tarihi Yerler</span>
                </nav>

                <header class="section-header section-header-left tarihi-yer-baslik">
                    <h2>Gebze'deki Tarihi Yerler</h2>
                </header>

                <div class="tarihi-yer-grid">
                    <?php foreach ($yerSayfalari as $sayfaIndex => $sayfaYerleri): ?>
                        <?php foreach ($sayfaYerleri as $y): ?>
                            <a class="tarihi-yer-kart tarihi-yer-sayfa" data-sayfa="<?php echo $sayfaIndex + 1; ?>" href="tarihi-yer-detay.php?id=<?php echo (int) $y['id']; ?>" <?php echo $sayfaIndex > 0 ? 'style="display:none;"' : ''; ?>>
                                <img src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=tarihi_yerler&id=<?php echo (int) $y['id']; ?>" alt="<?php echo htmlspecialchars($y['baslik']); ?>" loading="lazy">
                                <div class="tarihi-yer-icerik">
                                    <h4><?php echo htmlspecialchars($y['baslik']); ?></h4>
                                    <p><?php echo htmlspecialchars($y['aciklama']); ?></p>
                                    <?php if (!empty($y['konum_url'])): ?>
                                        <span class="tarihi-yer-konum-btn" onclick="event.preventDefault(); event.stopPropagation(); window.open('<?php echo htmlspecialchars($y['konum_url']); ?>', '_blank');">
                                            <i class="bi bi-pin-map"></i> Konum
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>

                <?php if (count($yerSayfalari) > 1): ?>
                    <div class="meclis-sayfalama" id="tarihiYerSayfalama">
                        <?php foreach ($yerSayfalari as $sayfaIndex => $sayfaYerleri): ?>
                            <button type="button" class="meclis-sayfa-btn<?php echo $sayfaIndex === 0 ? ' active' : ''; ?>" data-sayfa-git="<?php echo $sayfaIndex + 1; ?>"><?php echo $sayfaIndex + 1; ?></button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="gebze-yan-kolon">
                <?php $currentGebzePage = 'tarihi-yerler'; include '../../includes/gebze-sidebar.php'; ?>
            </div>
        </div>
    </div>
</main>

<script>
(function () {
    var kartlar = document.querySelectorAll('.tarihi-yer-sayfa');
    var sayfaBtnlar = document.querySelectorAll('#tarihiYerSayfalama .meclis-sayfa-btn');
    var baslik = document.querySelector('.tarihi-yer-baslik');

    function sayfayaGit(n, kaydir) {
        kartlar.forEach(function (kart) {
            kart.style.display = (kart.getAttribute('data-sayfa') === String(n)) ? '' : 'none';
        });
        sayfaBtnlar.forEach(function (btn) {
            btn.classList.toggle('active', btn.getAttribute('data-sayfa-git') === String(n));
        });
        if (kaydir && baslik) {
            baslik.scrollIntoView({ behavior: 'smooth', block: 'start' });
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