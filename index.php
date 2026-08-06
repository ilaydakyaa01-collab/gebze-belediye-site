<?php
include 'includes/db.php';
require_once 'includes/init.php';

$basePath = '';
$pageTitle = 'Gebze Belediyesi';
$navTransparent = true;

$stmt = $conn->query("SELECT * FROM haberler ORDER BY tarih DESC LIMIT 6");
$haberler = $stmt->fetchAll(PDO::FETCH_ASSOC);

$tickerStmt = $conn->query("SELECT id, baslik FROM haberler ORDER BY tarih DESC LIMIT 8");
$tickerHaberler = $tickerStmt->fetchAll(PDO::FETCH_ASSOC);

$duyurular = [
    ['baslik' => 'Araç Kiralama Hizmeti Alınacaktır', 'tarih' => '2026-08-05'],
    ['baslik' => 'Toner ve Yedek Parça Satın Alınacaktır', 'tarih' => '2026-08-03'],
    ['baslik' => 'Yıkım İşleri Yaptırılacaktır', 'tarih' => '2026-07-29'],
    ['baslik' => 'Cumhuriyet Meydanı Yeraltı Çarşısı İhale İlanı', 'tarih' => '2026-07-24'],
    ['baslik' => 'Gençlik Merkezi Çatı Tadilatı İhale İlanı', 'tarih' => '2026-07-24'],
    ['baslik' => 'İmar Plan İlanı', 'tarih' => '2026-07-22'],
];

$videolar = [
    ['baslik' => 'Gebze\'nin Geleceği: Başkan\'dan Mesaj', 'tarih' => '2026-08-01', 'resim' => 'img/haberler/haber-1.jpg', 'sure' => '03:24'],
    ['baslik' => 'Eskihisar Millet Bahçesi Tanıtımı', 'tarih' => '2026-07-28', 'resim' => 'img/haberler/haber-3.jpg', 'sure' => '02:45'],
    ['baslik' => 'Mahallemde Sinema Var', 'tarih' => '2026-07-20', 'resim' => 'img/haberler/haber-4.jpg', 'sure' => '01:58'],
    ['baslik' => 'TDBB Yönetim Kurulu Toplantısı', 'tarih' => '2026-07-15', 'resim' => 'img/haberler/haber-5.jpg', 'sure' => '04:12'],
    ['baslik' => 'Gebzespor Sezon Hazırlıkları', 'tarih' => '2026-07-10', 'resim' => 'img/haberler/haber-6.jpg', 'sure' => '02:30'],
    ['baslik' => 'Kaymakamlık Ziyareti', 'tarih' => '2026-07-05', 'resim' => 'img/haberler/haber-2.jpg', 'sure' => '01:42'],
];

$hizmetler = [
    ['icon' => 'bi-laptop', 'baslik' => 'E-Belediye', 'href' => '#'],
    ['icon' => 'bi-file-earmark-text', 'baslik' => 'Başvuru', 'href' => '#'],
    ['icon' => 'bi-buildings', 'baslik' => 'İmar', 'href' => '#'],
    ['icon' => 'bi-capsule-pill', 'baslik' => 'Eczane', 'href' => '#'],
    ['icon' => 'bi-bus-front', 'baslik' => 'Ulaşım', 'href' => '#'],
    ['icon' => 'bi-headset', 'baslik' => 'Alo 153', 'href' => '#'],
];

include 'includes/header.php';
?>

    <section class="hero-slider" id="heroSlider" aria-label="Ana görseller">
        <div class="hero-slides">
            <article class="hero-slide is-active" style="background-image: url('img/haberler/haber-3.jpg')">
                <div class="hero-overlay"></div>
                <div class="hero-caption container">
                    <h1>Şehrimize değer katan hizmetler</h1>
                    <p>Şeffaf, katılımcı ve modern belediyecilik.</p>
                </div>
            </article>
            <article class="hero-slide" style="background-image: url('img/haberler/haber-4.jpg')">
                <div class="hero-overlay"></div>
                <div class="hero-caption container">
                    <h1>Katılımcı ve şeffaf yönetim</h1>
                    <p>Gebze için birlikte üretiyoruz.</p>
                </div>
            </article>
            <article class="hero-slide" style="background-image: url('img/haberler/haber-1.jpg')">
                <div class="hero-overlay"></div>
                <div class="hero-caption container">
                    <h1>Yeşil alanlar, kültür ve spor</h1>
                    <p>Yaşanabilir bir Gebze için çalışıyoruz.</p>
                </div>
            </article>
        </div>
        <div class="hero-controls">
            <button type="button" class="hero-btn" id="heroPrev" aria-label="Önceki"><i class="bi bi-chevron-left"></i></button>
            <div class="hero-dots" id="heroDots"></div>
            <button type="button" class="hero-btn" id="heroNext" aria-label="Sonraki"><i class="bi bi-chevron-right"></i></button>
        </div>
    </section>

    <section class="baskan-bar">
        <div class="container baskan-inner">
            <div class="baskan-foto-wrap">
                <img src="img/baskan.png" alt="Zinnur Büyükgöz" class="baskan-foto">
            </div>
            <div class="baskan-info">
                <p class="baskan-title">Belediye Başkanı</p>
                <h2>Zinnur Büyükgöz</h2>
            </div>
            <div class="baskan-social">
                <a href="https://x.com/zinnurbuyukgoz" target="_blank" rel="noopener" aria-label="X"><i class="bi bi-twitter-x"></i></a>
                <a href="https://www.facebook.com/zinnurbuyukgoz" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/zinnurbuyukgoz/" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://www.youtube.com/@zinnurbuyukgoz" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
            </div>
            <a href="#" class="baskan-cta">Başkanı Tanıyın <i class="bi bi-arrow-right"></i></a>
        </div>
    </section>

    <section class="news-ticker" aria-label="Güncel haberler">
        <div class="ticker-inner">
            <div class="ticker-label">
                <span class="ticker-pulse" aria-hidden="true"></span>
                Güncel Haberler
            </div>
            <div class="ticker-track-wrap">
                <div class="ticker-track" id="tickerTrack">
                    <?php foreach (array_merge($tickerHaberler, $tickerHaberler) as $item): ?>
                        <a class="ticker-item" href="pages/haberler.php">
                            <span class="ticker-dot" aria-hidden="true"></span>
                            <?php echo htmlspecialchars($item['baslik']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <button type="button" class="ticker-toggle" id="tickerPause" aria-pressed="false" aria-label="Duraklat">
                <span class="ticker-toggle-icon" aria-hidden="true">
                    <i class="bi bi-pause-fill icon-pause"></i>
                    <i class="bi bi-play-fill icon-play" hidden></i>
                </span>
                <span class="ticker-toggle-text">Duraklat</span>
            </button>
        </div>
    </section>

    <section class="hizli-erisim">
        <div class="container">
            <div class="hizli-grid">
                <?php foreach ($hizmetler as $hizmet): ?>
                    <a class="hizli-item" href="<?php echo $hizmet['href']; ?>">
                        <span class="hizli-icon" aria-hidden="true">
                            <i class="bi <?php echo htmlspecialchars($hizmet['icon']); ?>"></i>
                        </span>
                        <span><?php echo htmlspecialchars($hizmet['baslik']); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="haber-bolumu" id="haberler">
        <div class="container">
            <header class="section-header">
                <h2 id="sectionTitle">Haberler</h2>
                <p id="sectionDesc">Belediyemizden güncel gelişmeler.</p>
                <div class="tab-group" role="tablist">
                    <button type="button" class="tab-btn is-active" data-tab="haber-panel" data-title="Haberler" data-desc="Belediyemizden güncel gelişmeler." role="tab" aria-selected="true">
                        <i class="bi bi-newspaper"></i> Haberler
                    </button>
                    <button type="button" class="tab-btn" data-tab="duyuru-panel" data-title="Duyurular" data-desc="Önemli duyuru ve ilanları buradan takip edin." role="tab" aria-selected="false">
                        <i class="bi bi-megaphone"></i> Duyurular
                    </button>
                    <button type="button" class="tab-btn" data-tab="video-panel" data-title="Videolar" data-desc="Belediyemizin video arşivinden seçmeler." role="tab" aria-selected="false">
                        <i class="bi bi-play-circle"></i> Videolar
                    </button>
                </div>
            </header>

            <div class="tab-panel is-active" id="haber-panel" role="tabpanel">
                <div class="haber-grid">
                    <?php if (count($haberler) > 0): ?>
                        <?php foreach ($haberler as $i => $haber): ?>
                            <?php $img = !empty($haber['resim']) ? $haber['resim'] : 'img/haberler/haber-' . (($i % 6) + 1) . '.jpg'; ?>
                            <article class="haber-kart">
                                <a href="pages/haberler.php" class="haber-gorsel">
                                    <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($haber['baslik']); ?>" loading="lazy">
                                </a>
                                <div class="haber-meta">
                                    <time datetime="<?php echo htmlspecialchars($haber['tarih']); ?>">
                                        <?php echo trTarih($haber['tarih']); ?>
                                    </time>
                                    <h3><a href="pages/haberler.php"><?php echo htmlspecialchars($haber['baslik']); ?></a></h3>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="bos-mesaj">Henüz haber eklenmemiş.</p>
                    <?php endif; ?>
                </div>
                <div class="section-actions">
                    <a href="pages/haberler.php" class="btn-outline">Tüm Haberler <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="tab-panel" id="duyuru-panel" role="tabpanel" hidden>
                <div class="haber-grid">
                    <?php foreach ($duyurular as $duyuru): ?>
                        <article class="haber-kart">
                            <div class="haber-gorsel duyuru-gorsel">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div class="haber-meta">
                                <time><?php echo trTarih($duyuru['tarih']); ?></time>
                                <h3><a href="#"><?php echo htmlspecialchars($duyuru['baslik']); ?></a></h3>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="section-actions">
                    <a href="#" class="btn-outline">Tüm Duyurular <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="tab-panel" id="video-panel" role="tabpanel" hidden>
                <div class="haber-grid">
                    <?php foreach ($videolar as $video): ?>
                        <article class="haber-kart video-kart">
                            <a href="#" class="haber-gorsel video-thumb">
                                <img src="<?php echo htmlspecialchars($video['resim']); ?>" alt="<?php echo htmlspecialchars($video['baslik']); ?>" loading="lazy">
                                <span class="video-play" aria-hidden="true"><i class="bi bi-play-fill"></i></span>
                                <span class="video-sure"><?php echo htmlspecialchars($video['sure']); ?></span>
                            </a>
                            <div class="haber-meta">
                                <time><?php echo trTarih($video['tarih']); ?></time>
                                <h3><a href="#"><?php echo htmlspecialchars($video['baslik']); ?></a></h3>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="section-actions">
                    <a href="#" class="btn-outline">Tüm Videolar <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
