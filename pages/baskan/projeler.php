<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'Başkan - Projeler | Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';

$durumMap = [
    'planlanan'    => 'Planlanan',
    'devam-eden'   => 'Devam Eden',
    'tamamlanan'   => 'Tamamlanan',
];
$aktifDurumSlug = isset($_GET['durum']) && isset($durumMap[$_GET['durum']]) ? $_GET['durum'] : '';
$aktifKategoriSlug = isset($_GET['kategori']) ? preg_replace('/[^a-z0-9\-]/', '', $_GET['kategori']) : '';

// --- SAYFALANDIRMA (PAGINATION) AYARLARI ---
$sayfa = isset($_GET['sayfa']) && is_numeric($_GET['sayfa']) ? (int)$_GET['sayfa'] : 1;
if ($sayfa < 1) $sayfa = 1;
$limit = 9; // Her sayfada gösterilecek proje sayısı
$offset = ($sayfa - 1) * $limit;

$kategoriler = [];
try {
    $kategoriler = $conn->query("SELECT * FROM proje_kategorileri ORDER BY sira ASC")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $kategoriler = [];
}

$aktifKategori = null;
foreach ($kategoriler as $k) {
    if ($k['slug'] === $aktifKategoriSlug) {
        $aktifKategori = $k;
        break;
    }
}

$projeler = [];
$toplamProjeler = 0;
$toplamSayfa = 1;

try {
    // Filtreleme Koşulları
    $whereSql = " WHERE 1=1";
    $params = [];

    if ($aktifDurumSlug !== '') {
        $whereSql .= " AND p.durum = :durum";
        $params[':durum'] = $durumMap[$aktifDurumSlug];
    }
    if ($aktifKategori) {
        $whereSql .= " AND p.kategori_id = :kategori_id";
        $params[':kategori_id'] = $aktifKategori['id'];
    }

    // 1. Toplam Proje Sayısını Bul (Sayfa sayısını hesaplamak için)
    $countSql = "SELECT COUNT(*) FROM projeler p" . $whereSql;
    $stmtCount = $conn->prepare($countSql);
    $stmtCount->execute($params);
    $toplamProjeler = (int)$stmtCount->fetchColumn();

    $toplamSayfa = ceil($toplamProjeler / $limit);
    if ($toplamSayfa < 1) $toplamSayfa = 1;
    if ($sayfa > $toplamSayfa) $sayfa = $toplamSayfa;

    // 2. Sayfaya Göre 9 Adet Proje Çek (LIMIT / OFFSET)
    $sql = "SELECT p.*, k.ad AS kategori_ad, k.slug AS kategori_slug
            FROM projeler p
            LEFT JOIN proje_kategorileri k ON k.id = p.kategori_id"
            . $whereSql .
            " ORDER BY p.id ASC
            LIMIT :limit OFFSET :offset";

    $stmt = $conn->prepare($sql);
    foreach ($params as $key => $val) {
        $stmt->bindValue($key, $val);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $projeler = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $projeler = [];
}

// Filtre ve Sayfa URL Oluşturucu
function projeFiltreUrl($basePath, $durum, $kategori, $sayfaNo = 1)
{
    $q = [];
    if ($durum) $q['durum'] = $durum;
    if ($kategori) $q['kategori'] = $kategori;
    if ($sayfaNo > 1) $q['sayfa'] = $sayfaNo;
    $qs = http_build_query($q);
    return $basePath . 'pages/baskan/projeler.php' . ($qs ? '?' . $qs : '');
}

include '../../includes/header.php';
?>

<style>
    .proje-bolumu { padding-top: 7rem; padding-bottom: 80px; }

    .proje-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #9aa0a7;
        margin-bottom: 8px;
    }
    .proje-breadcrumb a { color: #9aa0a7; }
    .proje-breadcrumb a:hover { color: var(--brand-color, #0f5d3c); }

    .proje-ustbaslik { margin-bottom: 30px; }
    .proje-ustbaslik h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 6px 0 8px;
    }
    .proje-ustbaslik p {
        color: #5b6470;
        font-size: 1rem;
    }

    .proje-sekme {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 34px;
    }
    .proje-sekme a {
        padding: 9px 18px;
        font-size: .88rem;
        font-weight: 600;
        color: #5b6470;
        text-decoration: none;
        border: 1px solid #e3e6ea;
        border-radius: 999px;
        transition: background .2s ease, color .2s ease, border-color .2s ease;
    }
    .proje-sekme a:hover {
        border-color: var(--brand-color, #0f5d3c);
        color: var(--brand-color, #0f5d3c);
    }
    .proje-sekme a.is-active {
        background: var(--brand-color, #0f5d3c);
        border-color: var(--brand-color, #0f5d3c);
        color: #fff;
    }

    .proje-layout {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 40px;
        align-items: start;
    }

    .proje-sol-alan {
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    /* Kart Izgarası */
    .proje-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
    }
    .proje-kart {
        background: #fff;
        border: 1px solid #eef0f3;
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all .25s ease;
    }
    .proje-kart:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.07);
    }
    
    .proje-gorsel {
        position: relative;
        height: 165px;
        overflow: hidden;
        background: #f1f2f4;
    }
    .proje-gorsel img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .3s ease;
    }
    .proje-kart:hover .proje-gorsel img {
        transform: scale(1.04);
    }

    /* Durum Etiketi */
    .proje-durum {
        position: absolute;
        top: 12px;
        left: 12px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .02em;
        padding: 5px 13px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(8px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        color: #10b981;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .proje-durum::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: currentColor;
    }
    .proje-durum.devam { color: #d97706; }
    .proje-durum.planlanan { color: #6b7280; }

    .proje-meta { padding: 14px 16px; flex: 1; display: flex; flex-direction: column; }
    .proje-kategori-etiket {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: var(--brand-color, #0f5d3c);
        margin-bottom: 6px;
    }
    .proje-meta h3 { font-size: 0.95rem; font-weight: 700; margin: 0; line-height: 1.35; color: #1a1a1a; }

    /* Sayfalandırma (Pagination) Stilleri */
    .proje-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 10px;
    }
    .proje-pagination a, .proje-pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #5b6470;
        background: #fff;
        border: 1px solid #e3e6ea;
        border-radius: 10px;
        text-decoration: none;
        transition: all .2s ease;
    }
    .proje-pagination a:hover {
        border-color: var(--brand-color, #0f5d3c);
        color: var(--brand-color, #0f5d3c);
    }
    .proje-pagination .active {
        background: var(--brand-color, #0f5d3c);
        border-color: var(--brand-color, #0f5d3c);
        color: #fff;
    }
    .proje-pagination .disabled {
        opacity: 0.4;
        pointer-events: none;
    }

    .proje-yan { display: flex; flex-direction: column; gap: 24px; }
    .yan-kutu {
        background: #f8f9fa;
        border: 1px solid #edeff1;
        border-radius: 14px;
        padding: 24px;
    }
    .yan-kutu h3 { font-size: 1.05rem; font-weight: 700; margin: 0 0 16px; }
    .yan-kutu ul { list-style: none; margin: 0; padding: 0; }
    .yan-kutu ul li + li { margin-top: 10px; padding-top: 10px; border-top: 1px solid #edeff1; }
    .yan-kutu ul li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #2a2f35;
        font-weight: 500;
        text-decoration: none;
    }
    .yan-kutu ul li a:hover { color: var(--brand-color, #0f5d3c); }
    .yan-kutu ul li a.is-active { color: var(--brand-color, #0f5d3c); font-weight: 700; }
    .yan-kutu ul li a i { color: #b7bcc2; font-size: 14px; }

    .bos-mesaj { grid-column: 1 / -1; color: #8a919a; padding: 40px 0; text-align: center; }

    @media (max-width: 980px) {
        .proje-layout { grid-template-columns: 1fr; }
        .proje-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 580px) {
        .proje-grid { grid-template-columns: 1fr; }
    }
</style>

<main class="proje-bolumu page-content">
    <div class="container">
        <nav class="proje-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
            <span>/</span>
            <span>Tüm Projeler</span>
        </nav>

        <div class="proje-ustbaslik">
            <h1>Tüm Projeler</h1>
            <p>Tüm projeleri buradan görüntüleyebilirsiniz.</p>
        </div>

        <nav class="proje-sekme">
            <a href="<?php echo projeFiltreUrl($basePath, '', $aktifKategoriSlug); ?>" class="<?php echo $aktifDurumSlug === '' ? 'is-active' : ''; ?>">Tümü</a>
            <a href="<?php echo projeFiltreUrl($basePath, 'planlanan', $aktifKategoriSlug); ?>" class="<?php echo $aktifDurumSlug === 'planlanan' ? 'is-active' : ''; ?>">Planlanan</a>
            <a href="<?php echo projeFiltreUrl($basePath, 'devam-eden', $aktifKategoriSlug); ?>" class="<?php echo $aktifDurumSlug === 'devam-eden' ? 'is-active' : ''; ?>">Devam Eden</a>
            <a href="<?php echo projeFiltreUrl($basePath, 'tamamlanan', $aktifKategoriSlug); ?>" class="<?php echo $aktifDurumSlug === 'tamamlanan' ? 'is-active' : ''; ?>">Tamamlanan</a>
        </nav>

        <div class="proje-layout">
            <div class="proje-sol-alan">
                <div class="proje-grid">
                    <?php if (count($projeler) > 0): ?>
                        <?php foreach ($projeler as $i => $proje): ?>
                            <?php
                            $img = !empty($proje['resim'])
                                ? $basePath . ltrim($proje['resim'], '/')
                                : $basePath . 'img/baskan/proje-' . (($i % 4) + 1) . '.jpg';
                            $durum = $proje['durum'] ?? 'Tamamlanan';
                            $durumClass = $durum === 'Devam Eden' ? 'devam' : ($durum === 'Planlanan' ? 'planlanan' : '');
                            ?>
                            <article class="proje-kart">
                                <div class="proje-gorsel">
                                    <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($proje['baslik']); ?>" loading="lazy">
                                    <span class="proje-durum <?php echo $durumClass; ?>"><?php echo htmlspecialchars($durum); ?></span>
                                </div>
                                <div class="proje-meta">
                                    <?php if (!empty($proje['kategori_ad'])): ?>
                                        <span class="proje-kategori-etiket"><?php echo htmlspecialchars($proje['kategori_ad']); ?></span>
                                    <?php endif; ?>
                                    <h3><?php echo htmlspecialchars($proje['baslik']); ?></h3>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="bos-mesaj">Gösterilecek proje bulunamadı.</p>
                    <?php endif; ?>
                </div>

                <!-- SAYFALANDIRMA (PAGINATION) -->
                <?php if ($toplamSayfa > 1): ?>
                    <nav class="proje-pagination">
                        <!-- Önceki Sayfa -->
                        <a href="<?php echo projeFiltreUrl($basePath, $aktifDurumSlug, $aktifKategoriSlug, $sayfa - 1); ?>" class="<?php echo $sayfa <= 1 ? 'disabled' : ''; ?>">
                            <i class="bi bi-chevron-left"></i>
                        </a>

                        <!-- Sayfa Numaraları -->
                        <?php for ($p = 1; $p <= $toplamSayfa; $p++): ?>
                            <a href="<?php echo projeFiltreUrl($basePath, $aktifDurumSlug, $aktifKategoriSlug, $p); ?>" class="<?php echo $p === $sayfa ? 'active' : ''; ?>">
                                <?php echo $p; ?>
                            </a>
                        <?php endfor; ?>

                        <!-- Sonraki Sayfa -->
                        <a href="<?php echo projeFiltreUrl($basePath, $aktifDurumSlug, $aktifKategoriSlug, $sayfa + 1); ?>" class="<?php echo $sayfa >= $toplamSayfa ? 'disabled' : ''; ?>">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </nav>
                <?php endif; ?>
            </div>

            <aside class="proje-yan">
                <div class="yan-kutu">
                    <h3>Başkan</h3>
                    <ul>
                        <li><a href="<?php echo $basePath; ?>pages/baskan/ozgecmis.php">Özgeçmiş <i class="bi bi-chevron-right"></i></a></li>
                        <li><a class="is-active" href="<?php echo $basePath; ?>pages/baskan/projeler.php">Projeler <i class="bi bi-chevron-right"></i></a></li>
                    </ul>
                </div>

                <div class="yan-kutu">
                    <h3>Kategoriler</h3>
                    <ul>
                        <li>
                            <a href="<?php echo projeFiltreUrl($basePath, $aktifDurumSlug, ''); ?>" class="<?php echo $aktifKategoriSlug === '' ? 'is-active' : ''; ?>">
                                Tüm Kategoriler <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                        <?php foreach ($kategoriler as $k): ?>
                            <li>
                                <a href="<?php echo projeFiltreUrl($basePath, $aktifDurumSlug, $k['slug']); ?>" class="<?php echo $aktifKategoriSlug === $k['slug'] ? 'is-active' : ''; ?>">
                                    <?php echo htmlspecialchars($k['ad']); ?> <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="yan-kutu">
                    <h3>Bizi Takip Edin</h3>
                    <ul>
                        <li><a href="https://wa.me/902626420430" target="_blank" rel="noopener">WhatsApp <i class="bi bi-whatsapp"></i></a></li>
                        <li><a href="https://www.facebook.com/gebzebelediye" target="_blank" rel="noopener">Facebook <i class="bi bi-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/gebze_belediyesi" target="_blank" rel="noopener">Instagram <i class="bi bi-instagram"></i></a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>