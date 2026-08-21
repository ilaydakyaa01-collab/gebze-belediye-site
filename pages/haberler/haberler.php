<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'Haberler - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';

$stmt = $conn->query("SELECT * FROM haberler ORDER BY tarih DESC");
$haberler = $stmt->fetchAll(PDO::FETCH_ASSOC);

$extraCss = 'css/haberler/haberler.css';
include '../../includes/header.php';
?>

<main class="haber-bolumu page-content">
    <div class="container">
        <nav class="haber-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Haberler</span>
        </nav>

        <div class="haber-ust-satir">
            <header class="section-header">
                <h2>Haberler</h2>
                <p>Belediyemizden tüm güncel haberler.</p>
            </header>

            <div class="haber-menu-wrap">
                <button type="button" class="haber-hamburger-btn" id="haberHamburgerBtn" aria-label="Haberler menüsü">
                    <i class="bi bi-list"></i>
                </button>
                <div class="haber-hamburger-dropdown" id="haberHamburgerDropdown" hidden>
                    <a href="<?php echo $basePath; ?>pages/haberler/haberler.php" class="is-active">Haberler</a>
                    <a href="<?php echo $basePath; ?>pages/haberler/duyurular.php">Duyurular</a>
                    <a href="<?php echo $basePath; ?>pages/haberler/videolar.php">Videolar</a>
                    <a href="<?php echo $basePath; ?>pages/haberler/fotograf-galerisi.php">Fotoğraf Galerisi</a>
                </div>
            </div>
        </div>
        <div class="haber-grid">
            <?php if (count($haberler) > 0): ?>
                <?php foreach ($haberler as $i => $haber): ?>
                    <?php
                    $img = !empty($haber['resim'])
                        ? $basePath . ltrim($haber['resim'], '/')
                        : $basePath . 'img/haberler/haber' . (($i % 14) + 1) . '.jpg';
                    ?>
                    <article class="haber-kart">
                        <a href="<?php echo $basePath; ?>pages/haberler/haber-detay.php?id=<?php echo (int) $haber['id']; ?>" class="haber-gorsel">
                            <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($haber['baslik']); ?>" loading="lazy">
                        </a>
                        <div class="haber-meta">
                            <time datetime="<?php echo htmlspecialchars($haber['tarih']); ?>">
                                <?php echo trTarih($haber['tarih']); ?>
                            </time>
                            <h3>
                                <a href="<?php echo $basePath; ?>pages/haberler/haber-detay.php?id=<?php echo (int) $haber['id']; ?>">
                                    <?php echo htmlspecialchars($haber['baslik']); ?>
                                </a>
                            </h3>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="bos-mesaj">Henüz haber eklenmemiş.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('haberHamburgerBtn');
    const dropdown = document.getElementById('haberHamburgerDropdown');
    if (!btn || !dropdown) return;

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.hidden = !dropdown.hidden;
    });

    document.addEventListener('click', function (e) {
        if (!dropdown.hidden && !dropdown.contains(e.target) && e.target !== btn) {
            dropdown.hidden = true;
        }
    });
});
</script>

<?php include '../../includes/footer.php'; ?>