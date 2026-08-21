<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'Duyurular - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';

$duyurular = $conn->query("SELECT * FROM duyurular ORDER BY tarih DESC, id ASC")->fetchAll(PDO::FETCH_ASSOC);

$extraCss = 'css/haberler/duyurular.css';
include '../../includes/header.php';
?>

<main class="duyuru-bolumu page-content">
    <div class="container">
        <nav class="duyuru-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Duyurular</span>
        </nav>

        <header class="duyuru-ustbaslik">
            <h1>Duyurular</h1>
            <p>Belediyemizden önemli duyuru ve ilanlar.</p>
        </header>

        <div class="duyuru-layout">
            <div>
                <?php if (count($duyurular) > 0): ?>
                    <div class="duyuru-liste">
                        <?php foreach ($duyurular as $duyuru): ?>
                            <div class="duyuru-kart">
                                <div class="duyuru-kart-sol">
                                    <h3><?php echo htmlspecialchars($duyuru['baslik']); ?></h3>
                                    <time datetime="<?php echo htmlspecialchars($duyuru['tarih']); ?>">
                                        <i class="bi bi-calendar-event"></i>
                                        <?php echo trTarih($duyuru['tarih']); ?>
                                    </time>
                                </div>
                                <a href="<?php echo $basePath; ?>pages/haberler/duyuru-detay.php?id=<?php echo (int) $duyuru['id']; ?>" class="duyuru-detay-btn">
                                    Detaylı bilgi <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="duyuru-bos">Henüz duyuru eklenmemiş.</p>
                <?php endif; ?>
            </div>

            <aside class="duyuru-sidebar">
                <div class="duyuru-yan-kutu">
                    <h3>Haberler</h3>
                    <ul class="duyuru-kategori-liste">
                        <li><a href="<?php echo $basePath; ?>pages/haberler/haberler.php">Haberler</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/haberler/duyurular.php" class="is-active">Duyurular</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/haberler/videolar.php">Videolar</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/haberler/fotograf-galerisi.php">Fotoğraf Galerisi</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>