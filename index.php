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

$duyurularAna = $conn->query("SELECT * FROM duyurular ORDER BY tarih DESC, id ASC LIMIT 6")->fetchAll(PDO::FETCH_ASSOC);
$videolar = $conn->query("SELECT youtube_id, baslik FROM videolar ORDER BY id ASC LIMIT 6")->fetchAll(PDO::FETCH_ASSOC);
$hizmetler = $conn->query("SELECT icon, baslik, href FROM hizmetler ORDER BY sira ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);
$etkinlikler = $conn->query("SELECT *, (tarih = CURDATE()) AS bugun FROM etkinlikler ORDER BY sira ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);
$projeler = $conn->query("SELECT * FROM projeler ORDER BY sira ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);
$heroSlaytlar = $conn->query("SELECT * FROM hero_slaytlar ORDER BY sira ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

    <section class="hero-slider" id="heroSlider" aria-label="Ana görseller">
        <div class="hero-slides">
            <?php foreach ($heroSlaytlar as $i => $slide): ?>
                <article class="hero-slide<?php echo $i === 0 ? ' is-active' : ''; ?>" style="background-image: url('<?php echo htmlspecialchars($slide['resim']); ?>')">
                    <div class="hero-overlay"></div>
                    <div class="hero-caption container">
                        <h1><?php echo htmlspecialchars($slide['baslik']); ?></h1>
                        <p><?php echo htmlspecialchars($slide['aciklama']); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="hero-controls">
            <button type="button" class="hero-btn" id="heroPrev" aria-label="Önceki"><i class="bi bi-chevron-left"></i></button>
            <div class="hero-dots" id="heroDots"></div>
            <button type="button" class="hero-btn" id="heroNext" aria-label="Sonraki"><i class="bi bi-chevron-right"></i></button>
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
            <header class="section-header haber-header-yatay">
                <div class="haber-baslik-grup">
                    <h2 id="sectionTitle">Haberler</h2>
                    <p id="sectionDesc">Belediyemizden güncel gelişmeler.</p>
                </div>
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
                            <?php $img = !empty($haber['resim']) ? $haber['resim'] : 'img/haberler/haber' . (($i % 14) + 1) . '.jpg'; ?>
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
                    <?php foreach ($duyurularAna as $duyuru): ?>
                        <article class="haber-kart">
                            <a href="pages/duyurular.php" class="haber-gorsel">
                                <img src="<?php echo htmlspecialchars($duyuru['resim']); ?>" alt="Duyuru" loading="lazy">
                            </a>
                            <div class="haber-meta">
                                <time datetime="<?php echo htmlspecialchars($duyuru['tarih']); ?>"><?php echo trTarih($duyuru['tarih']); ?></time>
                                <h3><a href="pages/duyurular.php"><?php echo htmlspecialchars($duyuru['baslik']); ?></a></h3>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="section-actions">
                    <a href="pages/duyurular.php" class="btn-outline">Tüm Duyurular <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="tab-panel" id="video-panel" role="tabpanel" hidden>
                <div class="haber-grid">
                    <?php if (count($videolar) > 0): ?>
                        <?php foreach ($videolar as $video): ?>
                            <?php
                            $ytId = $video['youtube_id'];
                            $ytLink = 'https://www.youtube.com/watch?v=' . rawurlencode($ytId);
                            $ytThumb = 'https://img.youtube.com/vi/' . rawurlencode($ytId) . '/hqdefault.jpg';
                            ?>
                            <article class="haber-kart video-kart">
                                <a href="<?php echo htmlspecialchars($ytLink); ?>" class="haber-gorsel video-thumb" target="_blank" rel="noopener noreferrer">
                                    <img src="<?php echo htmlspecialchars($ytThumb); ?>" alt="<?php echo htmlspecialchars($video['baslik']); ?>" loading="lazy">
                                    <span class="video-play" aria-hidden="true"><i class="bi bi-play-fill"></i></span>
                                </a>
                                <div class="haber-meta">
                                    <h3>
                                        <a href="<?php echo htmlspecialchars($ytLink); ?>" target="_blank" rel="noopener noreferrer">
                                            <?php echo htmlspecialchars($video['baslik']); ?>
                                        </a>
                                    </h3>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="bos-mesaj">Henüz video eklenmemiş.</p>
                    <?php endif; ?>
                </div>
                <div class="section-actions">
                    <a href="pages/videolar.php" class="btn-outline">Tüm Videolar <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="etkinlik-bolumu" id="etkinlikler">
        <div class="container">
            <header class="etkinlik-header">
                <div>
                    <h2>Etkinlikler</h2>
                    <p>Şehrimizdeki güncel etkinlikleri keşfedin.</p>
                </div>
                <a href="pages/etkinlikler.php" class="btn-outline">Tüm Etkinlikler <i class="bi bi-arrow-right"></i></a>
            </header>

            <div class="etkinlik-slider">
                <button type="button" class="etkinlik-nav prev" id="etkinlikPrev" aria-label="Önceki etkinlikler">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <div class="etkinlik-viewport" id="etkinlikViewport">
                    <div class="etkinlik-track" id="etkinlikTrack">
                        <?php foreach ($etkinlikler as $etkinlik): ?>
                            <article class="etkinlik-kart">
                                <div class="etkinlik-gorsel">
                                    <img src="<?php echo htmlspecialchars($etkinlik['resim']); ?>" alt="<?php echo htmlspecialchars($etkinlik['baslik']); ?>" loading="lazy">
                                    <span class="etkinlik-kategori" style="background-color: <?php echo htmlspecialchars($etkinlik['renk']); ?>">
                                        <?php echo htmlspecialchars($etkinlik['kategori']); ?>
                                    </span>
                                    <?php if (!empty($etkinlik['bugun'])): ?>
                                        <span class="etkinlik-badge">Bugün</span>
                                    <?php endif; ?>
                                </div>
                                <div class="etkinlik-bilgi">
                                    <time datetime="<?php echo htmlspecialchars($etkinlik['tarih']); ?>">
                                        <i class="bi bi-calendar-event"></i>
                                        <?php echo date('d.m.Y', strtotime($etkinlik['tarih'])); ?>
                                    </time>
                                    <h3><?php echo htmlspecialchars($etkinlik['baslik']); ?></h3>
                                    <p><i class="bi bi-clock"></i> <?php echo htmlspecialchars($etkinlik['saat']); ?></p>
                                    <p><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($etkinlik['yer']); ?></p>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button type="button" class="etkinlik-nav next" id="etkinlikNext" aria-label="Sonraki etkinlikler">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <section class="proje-bolumu" id="projeler">
        <div class="container">
            <header class="proje-header">
                <h2>Projelerimiz</h2>
                <div class="proje-filtreler" role="tablist" aria-label="Proje filtreleri">
                    <button type="button" class="proje-filtre is-active" data-filter="tumu">Tümü</button>
                    <button type="button" class="proje-filtre" data-filter="devam">Devam Eden</button>
                    <button type="button" class="proje-filtre" data-filter="tamamlanan">Tamamlanan</button>
                    <button type="button" class="proje-filtre" data-filter="planlanan">Planlanan</button>
                </div>
            </header>

            <div class="proje-slider">
                <div class="proje-viewport" id="projeViewport">
                    <div class="proje-track" id="projeTrack">
                        <?php foreach ($projeler as $proje): ?>
                            <article class="proje-kart" data-durum="<?php echo htmlspecialchars($proje['durum']); ?>">
                                <img src="<?php echo htmlspecialchars($proje['resim']); ?>" alt="<?php echo htmlspecialchars($proje['baslik']); ?>" loading="lazy" draggable="false">
                                <span class="proje-durum"><?php echo htmlspecialchars(projeDurumYazi($proje['durum'])); ?></span>
                                <div class="proje-overlay">
                                    <h3><?php echo htmlspecialchars($proje['baslik']); ?></h3>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="proje-navs">
                    <button type="button" class="proje-nav" id="projePrev" aria-label="Önceki projeler">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button type="button" class="proje-nav" id="projeNext" aria-label="Sonraki projeler">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>