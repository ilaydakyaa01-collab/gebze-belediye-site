<?php
$pageTitle = 'Başkan Danışmanları - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

$basePath = '../../';

require_once '../../includes/init.php';
include '../../includes/header.php';

$danismanlar = [
    [
        'id' => 1,
        'ad' => 'Remzi ŞEKER',
        'unvan' => 'Başkan Danışmanı',
        'resim' => 'img/baskan-danismani/remzi-seker.jpg'
    ]
];
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <a href="#">Kurumsal</a>
                    <span>/</span>
                    <span>Başkan Danışmanları</span>
                </nav>

                <header class="section-header section-header-left">
                    <h2>Başkan Danışmanları</h2>
                </header>

                <!-- Yan yana 2 kart sığacak şekilde genişletilmiş 2 sütunlu grid yapısı -->
                <div class="mudurlukler-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                    <?php foreach ($danismanlar as $kisi): ?>
                        <!-- Tüm kart tıklanabilir (Biyografi detay sayfasına yönlendirir) -->
                        <a href="baskan-danismanlari-detay.php?id=<?php echo $kisi['id']; ?>" class="mudurluk-kart" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 15px; border: 1px solid #f1f5f9; border-radius: 16px; padding: 20px; background-color: #f8fafc; transition: all 0.3s ease;">
                            <img src="<?php echo $basePath . $kisi['resim']; ?>" alt="<?php echo htmlspecialchars($kisi['ad']); ?>" style="width: 110px; height: 110px; object-fit: cover; border-radius: 12px; flex-shrink: 0;">
                            <div class="mudurluk-info" style="display: flex; flex-direction: column; gap: 4px;">
                                <h3 style="font-size: 17px; font-weight: 700; margin: 0; color: #003366; line-height: 1.3;"><?php echo htmlspecialchars($kisi['unvan']); ?></h3>
                                <p style="font-size: 16px; font-weight: 600; margin: 0; color: #1e293b;"><?php echo htmlspecialchars($kisi['ad']); ?></p>
                                <span style="font-size: 14px; color: #0284c7; font-weight: 600; margin-top: 6px; display: inline-block;">Biyografi</span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php $currentKurumsalPage = 'baskan-dan'; include '../../includes/kurumsal-sidebar.php'; ?>
        </div>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>