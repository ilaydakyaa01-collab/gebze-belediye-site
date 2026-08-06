<?php
$basePath = '../';
$pageTitle = 'İlkelerimiz - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';
include '../includes/header.php';
?>

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <header class="section-header">
            <h2>İlkelerimiz</h2>
            <p>Çalışmalarımızı yönlendiren temel değerler.</p>
        </header>

        <div class="kurumsal-kart">
            <div class="kurumsal-ikon">
                <i class="bi bi-shield-check"></i>
            </div>
            <div class="kurumsal-metin">
                <ul class="ilke-listesi">
                    <li><strong>Şeffaflık:</strong> Tüm süreçlerimizi vatandaşlarımızla açık şekilde paylaşırız.</li>
                    <li><strong>Katılımcılık:</strong> Kararlarımızı halkımızın görüşlerini alarak şekillendiririz.</li>
                    <li><strong>Adalet:</strong> Hizmetlerimizi ayrım gözetmeksizin herkese eşit sunarız.</li>
                    <li><strong>Sürdürülebilirlik:</strong> Kaynaklarımızı gelecek nesilleri gözeterek yönetiriz.</li>
                    <li><strong>Hesap Verebilirlik:</strong> Yaptığımız her işin sorumluluğunu üstleniriz.</li>
                </ul>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
