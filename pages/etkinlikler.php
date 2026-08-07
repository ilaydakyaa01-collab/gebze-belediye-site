<?php
include '../includes/db.php';

$basePath = '../';
$pageTitle = 'Etkinlikler - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';

$etkinlikler = $conn->query("SELECT *, (tarih = CURDATE()) AS bugun FROM etkinlikler ORDER BY sira ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
?>

<main class="etkinlik-bolumu page-content">
    <div class="container">
        <header class="section-header">
            <h2>Etkinlikler</h2>
            <p>Şehrimizdeki güncel etkinlikleri keşfedin.</p>
        </header>
        <div class="etkinlik-grid">
            <?php foreach ($etkinlikler as $etkinlik): ?>
                <article class="etkinlik-kart">
                    <div class="etkinlik-gorsel">
                        <img src="<?php echo $basePath . htmlspecialchars($etkinlik['resim']); ?>" alt="<?php echo htmlspecialchars($etkinlik['baslik']); ?>" loading="lazy">
                        <span class="etkinlik-kategori" style="background-color: <?php echo htmlspecialchars($etkinlik['renk']); ?>">
                            <?php echo htmlspecialchars($etkinlik['kategori']); ?>
                        </span>
                        <?php if (!empty($etkinlik['bugun'])): ?>
                            <span class="etkinlik-badge">Bugün</span>
                        <?php endif; ?>
                    </div>
                    <div class="etkinlik-bilgi">
                        <time datetime="<?php echo htmlspecialchars($etkinlik['tarih']); ?>">
                            <i class="bi bi-calendar-event"></i>
                            <?php echo date('d.m.Y', strtotime($etkinlik['tarih'])); ?>
                        </time>
                        <h3><?php echo htmlspecialchars($etkinlik['baslik']); ?></h3>
                        <p><i class="bi bi-clock"></i> <?php echo htmlspecialchars($etkinlik['saat']); ?></p>
                        <p><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($etkinlik['yer']); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
