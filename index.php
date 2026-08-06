<?php
include 'includes/db.php';

// Son 3 haberi çek (ana sayfada gösterilecek)
$stmt = $conn->query("SELECT * FROM haberler ORDER BY tarih DESC LIMIT 3");
$sonHaberler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebze Belediyesi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="topbar">
        <div class="container">
            <span>📞 0262 XXX XX XX</span>
            <span>✉️ info@gebze.bel.tr</span>
        </div>
    </div>

    <header class="main-header">
        <div class="container header-inner">
            <div class="logo">
                <h2>GEBZE<span>BELEDİYESİ</span></h2>
            </div>
            <nav>
                <a href="index.php">Ana Sayfa</a>
                <a href="pages/haberler.php">Haberler</a>
                <a href="#">Hizmetler</a>
                <a href="#">Duyurular</a>
                <a href="#">İletişim</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Gebze'nin Geleceğine Birlikte Yön Veriyoruz</h1>
            <p>Şeffaf, katılımcı ve modern belediyecilik anlayışıyla hizmetinizdeyiz.</p>
        </div>
    </section>

    <section class="son-haberler">
        <div class="container">
            <h2>Son Haberler</h2>
            <div class="haber-grid">
                <?php foreach ($sonHaberler as $haber): ?>
                    <div class="haber-kart">
                        <h3><?php echo htmlspecialchars($haber['baslik']); ?></h3>
                        <p><?php echo htmlspecialchars(substr($haber['icerik'], 0, 100)); ?>...</p>
                        <small><?php echo date('d.m.Y', strtotime($haber['tarih'])); ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="pages/haberler.php" class="tum-haberler-btn">Tüm Haberler →</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2026 Gebze Belediyesi. Tüm hakları saklıdır.</p>
        </div>
    </footer>

</body>
</html>