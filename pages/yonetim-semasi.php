<?php
require_once '../includes/init.php';

$basePath = '../';
$pageTitle = 'Yönetim Şeması - Gebze Belediyesi';
$navTransparent = false;
$extraCss = 'css/pages/yonetim-semasi.css';

include '../includes/header.php';
?>

<section class="page-content">
    <div class="container">
        <header class="section-header" style="text-align: left; margin-bottom: 2.5rem;">
            <h2>Yönetim Şeması</h2>
            <p>Gebze Belediyesi'nin kurumsal organizasyon yapısı.</p>
        </header>

        <div class="yonetim-grid">
            <div class="yonetim-kart yonetim-baskan">
                <div class="yonetim-icon"><i class="bi bi-person-badge"></i></div>
                <h3>Belediye Başkanı</h3>
                <p>Zinnur Büyükgöz</p>
            </div>

            <div class="yonetim-satir">
                <div class="yonetim-kart">
                    <div class="yonetim-icon"><i class="bi bi-person"></i></div>
                    <h3>Başkan Yardımcısı</h3>
                    <p>—</p>
                </div>
                <div class="yonetim-kart">
                    <div class="yonetim-icon"><i class="bi bi-person"></i></div>
                    <h3>Başkan Yardımcısı</h3>
                    <p>—</p>
                </div>
                <div class="yonetim-kart">
                    <div class="yonetim-icon"><i class="bi bi-person"></i></div>
                    <h3>Başkan Yardımcısı</h3>
                    <p>—</p>
                </div>
            </div>

            <h3 class="yonetim-alt-baslik">Müdürlükler</h3>

            <div class="yonetim-mudurluk-grid">
                <div class="yonetim-mudurluk">
                    <i class="bi bi-buildings"></i>
                    <span>İmar ve Şehircilik Müdürlüğü</span>
                </div>
                <div class="yonetim-mudurluk">
                    <i class="bi bi-cash-coin"></i>
                    <span>Mali Hizmetler Müdürlüğü</span>
                </div>
                <div class="yonetim-mudurluk">
                    <i class="bi bi-tree"></i>
                    <span>Park ve Bahçeler Müdürlüğü</span>
                </div>
                <div class="yonetim-mudurluk">
                    <i class="bi bi-truck"></i>
                    <span>Fen İşleri Müdürlüğü</span>
                </div>
                <div class="yonetim-mudurluk">
                    <i class="bi bi-people"></i>
                    <span>İnsan Kaynakları Müdürlüğü</span>
                </div>
                <div class="yonetim-mudurluk">
                    <i class="bi bi-shield-check"></i>
                    <span>Zabıta Müdürlüğü</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>