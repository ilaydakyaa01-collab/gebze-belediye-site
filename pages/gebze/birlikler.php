<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'Üye Olduğumuz Birlikler - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';
include '../../includes/header.php';

$stmt = $conn->query("SELECT * FROM uye_birlikler ORDER BY sira ASC");
$birlikler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/gebze.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>Üye Olduğumuz Birlikler</span>
                </nav>

                <header class="section-header section-header-left">
                    <h2>Üye Olduğumuz Birlikler</h2>
                </header>

                <div class="birlik-grid">
                    <?php foreach ($birlikler as $b): ?>
                        <?php $hedef = (!empty($b['url']) && $b['url'] !== '#') ? $b['url'] : '#'; ?>
                        <a class="birlik-kart" href="<?php echo htmlspecialchars($hedef); ?>" <?php echo $hedef !== '#' ? 'target="_blank" rel="noopener"' : ''; ?>>
                            <div class="birlik-logo-wrap">
                                <img src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=uye_birlikler&id=<?php echo (int) $b['id']; ?>" alt="<?php echo htmlspecialchars($b['adi']); ?>" loading="lazy">
                            </div>
                            <span class="birlik-adi"><?php echo htmlspecialchars($b['adi']); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="gebze-yan-kolon">
                <?php $currentGebzePage = 'birlikler'; include '../../includes/gebze-sidebar.php'; ?>
            </div>
        </div>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>