<?php
include '../includes/db.php';

$basePath = '../';
$pageTitle = 'Başkan Yardımcıları - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';
include '../includes/header.php';

$stmt = $conn->query("SELECT * FROM baskan_yardimcilari ORDER BY sira ASC");
$yardimcilar = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>Başkan Yardımcıları</span>
                </nav>

                <header class="section-header section-header-left">
                    <h2>Başkan Yardımcıları</h2>
                </header>

                <div class="baskan-yrd-grid">
                    <?php foreach ($yardimcilar as $kisi): ?>
                        <a class="baskan-yrd-kart" href="baskan-yardimcisi-detay.php?id=<?php echo (int) $kisi['id']; ?>">
                            <img src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=baskan_yardimcilari&id=<?php echo (int) $kisi['id']; ?>" alt="<?php echo htmlspecialchars($kisi['ad']); ?>" loading="lazy">
                            <div class="baskan-yrd-overlay">
                                <h4><?php echo htmlspecialchars($kisi['ad']); ?></h4>
                                <span><?php echo htmlspecialchars($kisi['unvan']); ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php $currentKurumsalPage = 'baskan-yrd'; include '../includes/kurumsal-sidebar.php'; ?>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>