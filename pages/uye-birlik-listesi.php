<?php
$basePath = '../';
$pageTitle = 'Üye Olduğumuz Birlikler - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';
include '../includes/header.php';
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

                <div class="kurumsal-metin-duz">
                    <p>Bu sayfanın içeriği yakında eklenecek.</p>
                </div>
            </div>

            <div class="gebze-yan-kolon">
                <?php $currentGebzePage = 'birlikler'; include '../includes/gebze-sidebar.php'; ?>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
