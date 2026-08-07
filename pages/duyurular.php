<?php
include '../includes/db.php';

$basePath = '../';
$pageTitle = 'Duyurular - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';

$duyurular = $conn->query("SELECT * FROM duyurular ORDER BY tarih DESC, id ASC")->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
?>

<main class="haber-bolumu page-content">
    <div class="container">
        <header class="section-header">
            <h2>Duyurular</h2>
            <p>Belediyemizden önemli duyuru ve ilanlar.</p>
        </header>
        <div class="haber-grid">
            <?php foreach ($duyurular as $duyuru): ?>
                <article class="haber-kart haber-kart--duyuru">
                    <div class="haber-gorsel">
                        <img src="<?php echo $basePath . htmlspecialchars($duyuru['resim']); ?>" alt="Duyuru" loading="lazy">
                    </div>
                    <div class="haber-meta">
                        <time datetime="<?php echo htmlspecialchars($duyuru['tarih']); ?>">
                            <?php echo trTarih($duyuru['tarih']); ?>
                        </time>
                        <h3><?php echo htmlspecialchars($duyuru['baslik']); ?></h3>
                        <a href="#" class="btn-detay">Detaylı bilgi</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
