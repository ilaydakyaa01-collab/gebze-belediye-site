<?php
include '../includes/db.php';

$basePath = '../';
$pageTitle = 'Haberler - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';

$stmt = $conn->query("SELECT * FROM haberler ORDER BY tarih DESC");
$haberler = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
?>

<main class="haber-bolumu page-content">
    <div class="container">
        <header class="section-header">
            <h2>Haberler</h2>
            <p>Belediyemizden tüm güncel haberler.</p>
        </header>
        <div class="haber-grid">
            <?php if (count($haberler) > 0): ?>
                <?php foreach ($haberler as $i => $haber): ?>
                    <?php
                    $img = !empty($haber['resim'])
                        ? $basePath . ltrim($haber['resim'], '/')
                        : $basePath . 'img/haberler/haber-' . (($i % 6) + 1) . '.jpg';
                    ?>
                    <article class="haber-kart">
                        <div class="haber-gorsel">
                            <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($haber['baslik']); ?>" loading="lazy">
                        </div>
                        <div class="haber-meta">
                            <time datetime="<?php echo htmlspecialchars($haber['tarih']); ?>">
                                <?php echo trTarih($haber['tarih']); ?>
                            </time>
                            <h3><?php echo htmlspecialchars($haber['baslik']); ?></h3>
                            <p class="haber-ozet"><?php echo htmlspecialchars($haber['icerik']); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="bos-mesaj">Henüz haber eklenmemiş.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
