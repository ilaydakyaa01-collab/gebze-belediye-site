<?php
require_once '../includes/init.php';
require_once '../includes/db.php';

$basePath = '../';
$pageTitle = 'Arama Sonuçları - Gebze Belediyesi';
$navTransparent = false;
$extraCss = 'css/arama.css';

$q = trim($_GET['q'] ?? '');
$sonuclar = [];

if ($q !== '') {
    $like = '%' . $q . '%';

    // Haberler
    $stmt = $conn->prepare("SELECT baslik, tarih FROM haberler WHERE baslik LIKE :q ORDER BY tarih DESC LIMIT 10");
    $stmt->execute(['q' => $like]);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $sonuclar[] = [
            'tur' => 'Haber',
            'baslik' => $row['baslik'],
            'aciklama' => 'Yayın tarihi: ' . date('d.m.Y', strtotime($row['tarih'])),
            'link' => 'haberler.php',
        ];
    }

    // Duyurular
    $stmt = $conn->prepare("SELECT baslik, tarih FROM duyurular WHERE baslik LIKE :q ORDER BY tarih DESC LIMIT 10");
    $stmt->execute(['q' => $like]);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $sonuclar[] = [
            'tur' => 'Duyuru',
            'baslik' => $row['baslik'],
            'aciklama' => 'Yayın tarihi: ' . date('d.m.Y', strtotime($row['tarih'])),
            'link' => 'duyurular.php',
        ];
    }

    // Yönetim (başkan / yardımcılar)
    $stmt = $conn->prepare("SELECT ad_soyad, unvan FROM yonetim WHERE ad_soyad LIKE :q OR unvan LIKE :q LIMIT 10");
    $stmt->execute(['q' => $like]);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $sonuclar[] = [
            'tur' => 'Yönetim',
            'baslik' => $row['ad_soyad'],
            'aciklama' => $row['unvan'],
            'link' => 'kurumsal/yonetim-semasi.php',
        ];
    }

    // Müdürlükler
    $stmt = $conn->prepare("SELECT birim_adi, sorumlu_ad_soyad FROM yonetim_birim WHERE birim_adi LIKE :q OR sorumlu_ad_soyad LIKE :q LIMIT 10");
    $stmt->execute(['q' => $like]);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $sonuclar[] = [
            'tur' => 'Müdürlük',
            'baslik' => $row['birim_adi'],
            'aciklama' => $row['sorumlu_ad_soyad'],
            'link' => '',
        ];
    }
}

include '../includes/header.php';
?>

<style>
    .arama-sonuc-kart-pasif { cursor: default; }
</style>

<section class="page-content" style="padding-bottom: 4rem;">
    <div class="container">
        <header class="section-header" style="text-align: left; margin-bottom: 1.5rem;">
            <h2>Arama Sonuçları</h2>
            <p>
                <?php if ($q === ''): ?>
                    Aramak istediğiniz kelimeyi yukarıdaki arama kutusuna yazın.
                <?php else: ?>
                    "<strong><?php echo htmlspecialchars($q); ?></strong>" için <?php echo count($sonuclar); ?> sonuç bulundu.
                <?php endif; ?>
            </p>
        </header>

        <form action="<?php echo $basePath; ?>pages/arama.php" method="GET" class="yonetim-arama" style="max-width: 420px; margin-bottom: 2rem;">
            <input type="text" name="q" placeholder="Sitede ara..." value="<?php echo htmlspecialchars($q); ?>" autocomplete="off">
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>

        <?php if ($q !== '' && count($sonuclar) === 0): ?>
            <p class="bos-mesaj">Aramanızla eşleşen bir sonuç bulunamadı.</p>
        <?php elseif (count($sonuclar) > 0): ?>
            <div class="arama-sonuc-liste">
                <?php foreach ($sonuclar as $sonuc): ?>
                    <?php if (!empty($sonuc['link'])): ?>
                        <a href="<?php echo $basePath . 'pages/' . $sonuc['link']; ?>" class="arama-sonuc-kart">
                            <span class="arama-sonuc-tur"><?php echo htmlspecialchars($sonuc['tur']); ?></span>
                            <h3><?php echo htmlspecialchars($sonuc['baslik']); ?></h3>
                            <p><?php echo htmlspecialchars($sonuc['aciklama']); ?></p>
                        </a>
                    <?php else: ?>
                        <div class="arama-sonuc-kart arama-sonuc-kart-pasif">
                            <span class="arama-sonuc-tur"><?php echo htmlspecialchars($sonuc['tur']); ?></span>
                            <h3><?php echo htmlspecialchars($sonuc['baslik']); ?></h3>
                            <p><?php echo htmlspecialchars($sonuc['aciklama']); ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include '../includes/footer.php'; ?>