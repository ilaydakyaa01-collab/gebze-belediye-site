<?php
include '../includes/db.php';

$basePath = '../';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM baskan_yardimcilari WHERE id = ?");
$stmt->execute([$id]);
$kisi = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$kisi) {
    header("Location: baskan-yardimcilari.php");
    exit;
}

$pageTitle = $kisi['ad'] . ' - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';
include '../includes/header.php';

// Dinamik link için JOIN'li güncel sorgumuz
$stmt2 = $conn->prepare("
    SELECT b.*, m.id AS mudurluk_id 
    FROM baskan_yrd_birimler b
    LEFT JOIN mudurlukler m ON LOWER(TRIM(b.birim_adi)) = LOWER(TRIM(m.ad))
    WHERE b.yardimci_id = ? 
    ORDER BY b.sira ASC
");
$stmt2->execute([$id]);
$birimler = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            
            <!-- Sol İçerik Alanı -->
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <a href="baskan-yardimcilari.php">Başkan Yardımcıları</a>
                    <span>/</span>
                    <span><?php echo htmlspecialchars($kisi['ad']); ?></span>
                </nav>

                <div class="yrd-detay-ust">
                    <img src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=baskan_yardimcilari&id=<?php echo (int) $kisi['id']; ?>" alt="<?php echo htmlspecialchars($kisi['ad']); ?>">
                    <div>
                        <h2><?php echo htmlspecialchars($kisi['ad']); ?></h2>
                        <span class="yrd-detay-unvan"><?php echo htmlspecialchars($kisi['unvan']); ?></span>
                    </div>
                </div>

                <div class="yrd-tab-group" role="tablist">
                    <button type="button" class="yrd-tab active" data-tab="biyografi">Biyografi</button>
                    <button type="button" class="yrd-tab" data-tab="birimler">Bağlı Birimler</button>
                </div>

                <div class="yrd-tab-panel" data-panel="biyografi">
                    <p class="meclis-toplam">Biyografi bilgisi henüz eklenmedi.</p>
                </div>

                <div class="yrd-tab-panel" data-panel="birimler" hidden>
                    <?php if (count($birimler) > 0): ?>
                        <div class="yrd-birim-liste">
                            <?php foreach ($birimler as $birim): ?>
                                <?php 
                                    // Eşleşen mudurluk_id varsa ilgili detay sayfasına bağlar, yoksa pasif kalır
                                    $link = !empty($birim['mudurluk_id']) ? "mudurluk-detay.php?id=" . (int)$birim['mudurluk_id'] : "#"; 
                                ?>
                                <a href="<?php echo $link; ?>" class="yrd-birim-satir">
                                    <span class="yrd-birim-adi"><?php echo htmlspecialchars($birim['birim_adi']); ?></span>
                                    <span class="yrd-birim-sorumlu"><?php echo htmlspecialchars($birim['sorumlu_adi']); ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="meclis-toplam">Bu kişiye bağlı birim bilgisi henüz eklenmedi.</p>
                    <?php endif; ?>
                </div>
            </div> <!-- .kurumsal-ana-kart KAPANIŞI -->

            <!-- Sağ Sidebar Alanı -->
            <?php $currentKurumsalPage = 'baskan-yrd'; include '../includes/kurumsal-sidebar.php'; ?>
            
        </div> <!-- .kurumsal-grid KAPANIŞI -->
    </div> <!-- .container KAPANIŞI -->
</main> <!-- .kurumsal-bolumu KAPANIŞI -->

<script>
(function () {
    var tabButonlar = document.querySelectorAll('.yrd-tab');
    var paneller = document.querySelectorAll('.yrd-tab-panel');

    tabButonlar.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var hedef = btn.getAttribute('data-tab');

            tabButonlar.forEach(function (b) { b.classList.toggle('active', b === btn); });
            paneller.forEach(function (p) {
                p.hidden = p.getAttribute('data-panel') !== hedef;
            });
        });
    });
})();
</script>

<?php include '../includes/footer.php'; ?>