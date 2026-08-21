<?php
/**
 * DUYURU DETAY SAYFASI
 * -------------------------------------------------------------
 * duyurular.php'deki "Detaylı bilgi" linki buraya gelir:
 *   duyuru-detay.php?id=7
 */

include '../../includes/db.php';
require_once '../../includes/init.php';

$basePath = '../../';
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

$duyuru = null;
$digerDuyurular = [];

try {
    $stmt = $conn->prepare("SELECT * FROM duyurular WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    $duyuru = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($duyuru) {
        $stmtD = $conn->prepare("SELECT id, baslik, tarih FROM duyurular WHERE id != :id ORDER BY tarih DESC LIMIT 8");
        $stmtD->execute([':id' => $duyuru['id']]);
        $digerDuyurular = $stmtD->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    $duyuru = null;
}

$pageTitle = $duyuru ? htmlspecialchars($duyuru['baslik']) . ' | Gebze Belediyesi' : 'Duyuru Bulunamadı | Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

$extraCss = 'css/haberler/duyuru-detay.css';
include '../../includes/header.php';
?>

<section class="dd-bolumu page-content">
    <div class="container">
        <?php if ($duyuru): ?>

            <nav class="dd-breadcrumb">
                <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
                <span>/</span>
                <a href="<?php echo $basePath; ?>pages/haberler/duyurular.php">Duyurular</a>
                <span>/</span>
                <span><?php echo htmlspecialchars($duyuru['baslik']); ?></span>
            </nav>

            <div class="dd-layout">
                <div>
                    <div class="dd-karti">
                        <div class="dd-tarih">
                            <i class="bi bi-calendar-event"></i> <?php echo trTarih($duyuru['tarih']); ?>
                        </div>
                        <h1 class="dd-baslik"><?php echo htmlspecialchars($duyuru['baslik']); ?></h1>

                        <?php if (!empty($duyuru['dosya'])): ?>
                            <?php
                                $ddBelgeAdi = !empty($duyuru['belge_adi']) ? $duyuru['belge_adi'] : 'Belgeyi İndir';
                            ?>
                            <a href="<?php echo $basePath . htmlspecialchars(ltrim($duyuru['dosya'], '/')); ?>" class="dd-indir" target="_blank" rel="noopener">
                                <i class="bi bi-download"></i> <?php echo htmlspecialchars($ddBelgeAdi); ?>
                            </a>
                        <?php else: ?>
                            <p class="dd-belge-yok">Bu duyuru için indirilebilir belge henüz eklenmemiştir.</p>
                        <?php endif; ?>
                    </div>

                    <a href="<?php echo $basePath; ?>pages/haberler/duyurular.php" class="dd-geri">
                        <i class="bi bi-arrow-left"></i> Tüm Duyurulara Dön
                    </a>
                </div>

                <?php if (count($digerDuyurular) > 0): ?>
                    <aside class="dd-sidebar">
                        <div class="dd-yan-kutu">
                            <h3>Diğer Duyurular</h3>
                            <ul class="dd-diger-liste">
                                <?php foreach ($digerDuyurular as $d): ?>
                                    <li>
                                        <a href="<?php echo $basePath; ?>pages/haberler/duyuru-detay.php?id=<?php echo (int)$d['id']; ?>">
                                            <?php echo htmlspecialchars($d['baslik']); ?>
                                            <span class="dd-diger-tarih"><?php echo trTarih($d['tarih']); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </aside>
                <?php endif; ?>
            </div>

        <?php else: ?>

            <div class="dd-bulunamadi">
                <h1>Duyuru Bulunamadı</h1>
                <p>Aradığınız duyuru kaldırılmış veya adres hatalı olabilir.</p>
                <a href="<?php echo $basePath; ?>pages/haberler/duyurular.php" class="dd-geri">
                    <i class="bi bi-arrow-left"></i> Duyurulara Dön
                </a>
            </div>

        <?php endif; ?>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>