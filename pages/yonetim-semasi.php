<?php
require_once '../includes/init.php';
require_once '../includes/db.php';

$basePath = '../';
$pageTitle = 'Yönetim Şeması - Gebze Belediyesi';
$navTransparent = false;
$extraCss = 'css/yonetim-semasi.css';

$stmt = $conn->query("SELECT * FROM yonetim ORDER BY grup, sira ASC");
$tumYonetim = $stmt->fetchAll(PDO::FETCH_ASSOC);

$baskan = array_filter($tumYonetim, fn($k) => $k['grup'] === 'baskan');
$yardimcilar = array_filter($tumYonetim, fn($k) => $k['grup'] === 'yardimci');
$mudurler = array_filter($tumYonetim, fn($k) => $k['grup'] === 'mudur');

// Her yardımcının ve başkanın bağlı birimlerini çek
$birimStmt = $conn->query("SELECT * FROM yonetim_birim ORDER BY sira ASC");
$tumBirimler = $birimStmt->fetchAll(PDO::FETCH_ASSOC);

$birimlerByYardimci = [];
foreach ($tumBirimler as $birim) {
    $birimlerByYardimci[$birim['yardimci_id']][] = $birim;
}

include '../includes/header.php';
?>

<section class="page-content">
    <div class="container">
        <header class="section-header" style="text-align: left; margin-bottom: 1.5rem;">
            <h2>Yönetim Şeması</h2>
            <p>Gebze Belediyesi'nin kurumsal organizasyon yapısı.</p>
        </header>

        <div class="yonetim-arac-cubugu">
            <form action="<?php echo $basePath; ?>pages/arama.php" method="GET" class="yonetim-arama">
                <input type="text" name="q" placeholder="Sitede ara...">
                <button type="submit"><i class="bi bi-search"></i></button>
            </form>

            <div class="yonetim-kurumsal-menu">
                <button type="button" class="kurumsal-toggle" id="kurumsalToggle">
                    Kurumsal <i class="bi bi-chevron-down"></i>
                </button>
                <div class="kurumsal-dropdown" id="kurumsalDropdown" hidden>
                    <a href="#">Vizyonumuz</a>
                    <a href="#">Misyonumuz</a>
                    <a href="#">İlkelerimiz</a>
                    <a href="#">Enerji Politikamız</a>
                    <a href="#">Belediye Meclisi</a>
                    <a href="<?php echo $basePath; ?>pages/yonetim-semasi.php">Yönetim Şeması</a>
                    <a href="#">Başkan Yardımcıları</a>
                    <a href="#">Başkan Danışmanları</a>
                    <a href="#">Müdürlükler</a>
                    <a href="#">Eski Başkanlar</a>
                    <a href="#">Arabuluculuk Komisyonu</a>
                    <a href="#">Etik Komisyonu</a>
                    <a href="#">Meclis Kararları</a>
                    <a href="#">Kurumsal Kimlik</a>
                    <a href="#">Kurumsal Raporlar</a>
                    <a href="#">Kurumsal Dökümanlar</a>
                    <a href="#">Yayınlar</a>
                </div>
            </div>
        </div>

        <div class="yonetim-grid">

            <!-- BELEDİYE BAŞKANI KARTI -->
            <?php foreach ($baskan as $kisi): ?>
                <div class="yonetim-baskan-card" data-grup="baskan">
                    <div class="yonetim-baskan-header">
                        <?php if (!empty($kisi['resim'])): ?>
                            <img src="<?php echo $basePath . htmlspecialchars($kisi['resim']); ?>" alt="<?php echo htmlspecialchars($kisi['ad_soyad']); ?>" class="yonetim-foto-buyuk">
                        <?php else: ?>
                            <div class="yonetim-icon-buyuk"><i class="bi bi-person-badge"></i></div>
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($kisi['ad_soyad']); ?></h3>
                        <p><?php echo htmlspecialchars($kisi['unvan']); ?></p>
                    </div>

                    <?php if (!empty($birimlerByYardimci[$kisi['id']])): ?>
                        <div class="yonetim-baskan-birimler">
                            <h4>Başkana Bağlı Birimler</h4>
                            <div class="yonetim-baskan-birim-grid" data-grup="mudur">
                                <?php foreach ($birimlerByYardimci[$kisi['id']] as $birim): ?>
                                    <div class="yonetim-birim-box">
                                        <i class="bi bi-building yonetim-birim-icon"></i>
                                        <div class="yonetim-birim-metin">
                                            <strong><?php echo htmlspecialchars($birim['birim_adi']); ?></strong>
                                            <span><?php echo htmlspecialchars($birim['sorumlu_ad_soyad']); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <!-- BAŞKAN YARDIMCILARI GRİDİ -->
            <div class="yonetim-yardimci-grid">
                <?php foreach ($yardimcilar as $kisi): ?>
                    <div class="yonetim-yardimci-kart" data-grup="yardimci">
                        <div class="yonetim-yardimci-ust">
                            <?php if (!empty($kisi['resim'])): ?>
                                <img src="<?php echo $basePath . htmlspecialchars($kisi['resim']); ?>" alt="<?php echo htmlspecialchars($kisi['ad_soyad']); ?>" class="yonetim-foto-kucuk">
                            <?php else: ?>
                                <div class="yonetim-icon"><i class="bi bi-person"></i></div>
                            <?php endif; ?>
                            <div>
                                <h3><?php echo htmlspecialchars($kisi['ad_soyad']); ?></h3>
                                <span><?php echo htmlspecialchars($kisi['unvan']); ?></span>
                            </div>
                        </div>

                        <?php if (!empty($birimlerByYardimci[$kisi['id']])): ?>
                            <div class="yonetim-birim-liste" data-grup="mudur">
                                <?php foreach ($birimlerByYardimci[$kisi['id']] as $birim): ?>
                                    <div class="yonetim-birim-box">
                                        <i class="bi bi-building yonetim-birim-icon"></i>
                                        <div class="yonetim-birim-metin">
                                            <strong><?php echo htmlspecialchars($birim['birim_adi']); ?></strong>
                                            <span><?php echo htmlspecialchars($birim['sorumlu_ad_soyad']); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kurumsalToggle = document.getElementById('kurumsalToggle');
    const kurumsalDropdown = document.getElementById('kurumsalDropdown');

    if (kurumsalToggle && kurumsalDropdown) {
        kurumsalToggle.addEventListener('click', function () {
            const acikMi = !kurumsalDropdown.hidden;
            kurumsalDropdown.hidden = acikMi;
            kurumsalToggle.classList.toggle('is-open', !acikMi);
        });

        document.addEventListener('click', function (e) {
            if (!kurumsalToggle.contains(e.target) && !kurumsalDropdown.contains(e.target)) {
                kurumsalDropdown.hidden = true;
                kurumsalToggle.classList.remove('is-open');
            }
        });
    }
});
</script>
<?php include '../includes/footer.php'; ?>