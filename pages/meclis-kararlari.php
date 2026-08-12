<?php
include '../includes/db.php';
require_once '../includes/init.php';

$basePath = '../';
$pageTitle = 'Meclis Kararları | Gebze Belediyesi';
$navTransparent = false;
$currentKurumsalPage = 'meclis-kararlari';

$secilenYil = isset($_GET['yil']) && is_numeric($_GET['yil']) ? (int)$_GET['yil'] : '';
$secilenAy = isset($_GET['ay']) && is_numeric($_GET['ay']) ? (int)$_GET['ay'] : '';
$sayfa = isset($_GET['sayfa']) && is_numeric($_GET['sayfa']) ? (int)$_GET['sayfa'] : 1;
if ($sayfa < 1) $sayfa = 1;
$limit = 10;
$offset = ($sayfa - 1) * $limit;

$ayIsimleri = [
    1 => 'Ocak', 2 => 'Şubat', 3 => 'Mart', 4 => 'Nisan', 5 => 'Mayıs', 6 => 'Haziran',
    7 => 'Temmuz', 8 => 'Ağustos', 9 => 'Eylül', 10 => 'Ekim', 11 => 'Kasım', 12 => 'Aralık',
];

$yillar = [];
try {
    $yillar = $conn->query("SELECT DISTINCT YEAR(tarih) AS yil FROM meclis_kararlari ORDER BY yil DESC")->fetchAll(PDO::FETCH_COLUMN);
} catch (Exception $e) {
    $yillar = [];
}

$kararlar = [];
$toplamKarar = 0;
$toplamSayfa = 1;
try {
    $whereSql = " WHERE 1=1";
    $params = [];
    if ($secilenYil !== '') {
        $whereSql .= " AND YEAR(tarih) = :yil";
        $params[':yil'] = $secilenYil;
    }
    if ($secilenAy !== '') {
        $whereSql .= " AND MONTH(tarih) = :ay";
        $params[':ay'] = $secilenAy;
    }

    $countStmt = $conn->prepare("SELECT COUNT(*) FROM meclis_kararlari" . $whereSql);
    $countStmt->execute($params);
    $toplamKarar = (int)$countStmt->fetchColumn();
    $toplamSayfa = max(1, (int)ceil($toplamKarar / $limit));
    if ($sayfa > $toplamSayfa) $sayfa = $toplamSayfa;
    $offset = ($sayfa - 1) * $limit;

    $stmt = $conn->prepare("SELECT * FROM meclis_kararlari" . $whereSql . " ORDER BY tarih DESC, sira ASC LIMIT :limit OFFSET :offset");
    foreach ($params as $key => $val) {
        $stmt->bindValue($key, $val);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $kararlar = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $kararlar = [];
}

function mkFiltreUrl($basePath, $yil, $ay, $sayfaNo = 1) {
    $q = [];
    if ($yil !== '') $q['yil'] = $yil;
    if ($ay !== '') $q['ay'] = $ay;
    if ($sayfaNo > 1) $q['sayfa'] = $sayfaNo;
    $qs = http_build_query($q);
    return $basePath . 'pages/meclis-kararlari.php' . ($qs ? '?' . $qs : '');
}

include '../includes/header.php';
?>

<style>
    .mk-bolumu { padding: 7rem 0 5rem; }

    .mk-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--muted);
        margin-bottom: 0.6rem;
    }
    .mk-breadcrumb a { color: var(--muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .mk-breadcrumb a:hover { color: var(--accent-hot); }

    .mk-ustbaslik { margin-bottom: 2rem; }
    .mk-ustbaslik h1 {
        font-size: clamp(1.8rem, 3vw, 2.3rem);
        font-weight: 700;
        color: var(--navy);
    }

    .mk-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 2.5rem;
        align-items: start;
    }

    .mk-filtre {
        display: flex;
        gap: 1.2rem;
        flex-wrap: wrap;
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 1.2rem 1.4rem;
        margin-bottom: 1.6rem;
    }
    .mk-filtre-grup { display: flex; flex-direction: column; gap: 0.4rem; }
    .mk-filtre-grup label { font-size: 0.82rem; font-weight: 600; color: var(--muted); }
    .mk-filtre-grup select {
        padding: 0.6rem 0.9rem;
        border: 1px solid var(--line);
        border-radius: 8px;
        font-size: 0.9rem;
        color: var(--text);
        background: var(--white);
        min-width: 160px;
    }

    .mk-liste { display: flex; flex-direction: column; gap: 1rem; }

    .mk-karti {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        background: var(--white);
        border: 1px solid var(--line);
        border-left: 4px solid var(--accent);
        border-radius: var(--radius);
        padding: 1.2rem 1.4rem;
    }
    .mk-karti-sol { display: flex; align-items: center; gap: 0.9rem; }
    .mk-karti-ikon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #eef4fb;
        color: var(--navy);
        display: grid;
        place-items: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .mk-karti h3 { font-size: 1rem; font-weight: 700; color: var(--navy); margin-bottom: 0.2rem; }
    .mk-karti time { font-size: 0.85rem; color: var(--muted); }

    .mk-indir {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.6rem 1.1rem;
        background: var(--navy);
        color: var(--white);
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: background 0.2s ease;
    }
    .mk-indir:hover { background: #004a8f; }

    .mk-bos { text-align: center; color: var(--muted); padding: 3rem 0; background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); }

    .mk-pagination {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 1.6rem;
    }
    .mk-pagination a, .mk-pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        padding: 0 10px;
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--text);
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .mk-pagination a:hover { border-color: var(--accent); color: var(--accent-hot); }
    .mk-pagination .active { background: var(--navy); border-color: var(--navy); color: var(--white); }
    .mk-pagination .disabled { opacity: 0.4; pointer-events: none; }

    /* --- Sağdaki sabit Kurumsal kutusu --- */
    .mk-yan-kutu {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 1.4rem;
    }
    .mk-yan-kutu h3 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 1rem;
        padding-bottom: 0.7rem;
        border-bottom: 2px solid var(--accent);
    }
    .mk-yan-kutu ul { list-style: none; }
    .mk-yan-kutu ul li + li { margin-top: 10px; padding-top: 10px; border-top: 1px solid var(--line); }
    .mk-yan-kutu ul li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: var(--text);
        font-weight: 500;
        font-size: 0.88rem;
    }
    .mk-yan-kutu ul li a:hover { color: var(--accent-hot); }
    .mk-yan-kutu ul li a.is-active { color: var(--accent-hot); font-weight: 700; }
    .mk-yan-kutu ul li a i { color: var(--muted); font-size: 13px; }

    @media (max-width: 900px) {
        .mk-layout { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
        .mk-karti { flex-direction: column; align-items: flex-start; }
        .mk-indir { width: 100%; justify-content: center; }
    }
</style>

<section class="mk-bolumu page-content">
    <div class="container">
        <nav class="mk-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Meclis Kararları</span>
        </nav>

        <div class="mk-ustbaslik">
            <h1>Meclis Kararları</h1>
        </div>

        <div class="mk-layout">
            <div>
                <form class="mk-filtre" method="GET">
                    <div class="mk-filtre-grup">
                        <label for="mkYil">Yıl</label>
                        <select name="yil" id="mkYil" onchange="this.form.submit()">
                            <option value="">Tüm Yıllar</option>
                            <?php foreach ($yillar as $y): ?>
                                <option value="<?php echo $y; ?>" <?php echo ($secilenYil == $y) ? 'selected' : ''; ?>><?php echo $y; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mk-filtre-grup">
                        <label for="mkAy">Ay</label>
                        <select name="ay" id="mkAy" onchange="this.form.submit()">
                            <option value="">Tüm Aylar</option>
                            <?php foreach ($ayIsimleri as $no => $isim): ?>
                                <option value="<?php echo $no; ?>" <?php echo ($secilenAy == $no) ? 'selected' : ''; ?>><?php echo $isim; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>

                <?php if (count($kararlar) > 0): ?>
                    <div class="mk-liste">
                        <?php foreach ($kararlar as $karar): ?>
                            <div class="mk-karti">
                                <div class="mk-karti-sol">
                                    <div class="mk-karti-ikon"><i class="bi bi-file-earmark-pdf"></i></div>
                                    <div>
                                        <h3><?php echo htmlspecialchars($karar['baslik']); ?></h3>
                                        <time><?php echo date('d.m.Y', strtotime($karar['tarih'])); ?></time>
                                    </div>
                                </div>
                                <?php if (!empty($karar['pdf_dosya'])): ?>
                                    <a href="<?php echo $basePath . htmlspecialchars($karar['pdf_dosya']); ?>" class="mk-indir" target="_blank" rel="noopener">
                                        <i class="bi bi-download"></i> <?php echo htmlspecialchars($karar['dosya_tipi'] ?? 'PDF'); ?> İndir
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($toplamSayfa > 1): ?>
                        <nav class="mk-pagination">
                            <a href="<?php echo mkFiltreUrl($basePath, $secilenYil, $secilenAy, $sayfa - 1); ?>" class="<?php echo $sayfa <= 1 ? 'disabled' : ''; ?>">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                            <?php for ($p = 1; $p <= $toplamSayfa; $p++): ?>
                                <a href="<?php echo mkFiltreUrl($basePath, $secilenYil, $secilenAy, $p); ?>" class="<?php echo $p === $sayfa ? 'active' : ''; ?>">
                                    <?php echo $p; ?>
                                </a>
                            <?php endfor; ?>
                            <a href="<?php echo mkFiltreUrl($basePath, $secilenYil, $secilenAy, $sayfa + 1); ?>" class="<?php echo $sayfa >= $toplamSayfa ? 'disabled' : ''; ?>">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </nav>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="mk-bos">Seçilen kriterlere uygun meclis kararı bulunamadı.</p>
                <?php endif; ?>
            </div>

            <aside class="mk-yan-kutu">
                <h3>Kurumsal</h3>
                <ul>
                    <li><a href="<?php echo $basePath; ?>pages/vizyonumuz.php">Vizyonumuz <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/misyonumuz.php">Misyonumuz <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/ilkelerimiz.php">İlkelerimiz <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/enerji-politikamiz.php">Enerji Politikamız <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/belediye-meclisi.php">Belediye Meclisi <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/yonetim-semasi.php">Yönetim Şeması <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/baskan-yardimcilari.php">Başkan Yardımcıları <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/baskan-danismanlari.php">Başkan Danışmanları <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/mudurlukler.php">Müdürlükler <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/eski-baskanlar.php">Eski Başkanlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/arabuluculuk-komisyonu.php">Arabuluculuk Komisyonu <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/etik-komisyonu.php">Etik Komisyonu <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="#" class="is-active">Meclis Kararları <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal-kimlik.php">Kurumsal Kimlik <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal-raporlar.php">Kurumsal Raporlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal-dokumanlar.php">Kurumsal Dökümanlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/yayinlar.php">Yayınlar <i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </aside>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>