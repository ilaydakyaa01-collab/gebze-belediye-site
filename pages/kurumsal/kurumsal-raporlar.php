<?php
include '../../includes/db.php';
require_once '../../includes/init.php';

$basePath = '../../';
$pageTitle = 'Kurumsal Raporlar | Gebze Belediyesi';
$navTransparent = false;
$currentKurumsalPage = 'kurumsal-raporlar';

$secilenKategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';
$sayfa = isset($_GET['sayfa']) && is_numeric($_GET['sayfa']) ? (int)$_GET['sayfa'] : 1;
if ($sayfa < 1) $sayfa = 1;
$limit = 10;
$offset = ($sayfa - 1) * $limit;

$kategoriler = [];
try {
    $kategoriler = $conn->query("SELECT DISTINCT kategori FROM kurumsal_raporlar ORDER BY kategori ASC")->fetchAll(PDO::FETCH_COLUMN);
} catch (Exception $e) {
    $kategoriler = [];
}

$raporlar = [];
$toplamRapor = 0;
$toplamSayfa = 1;
try {
    $whereSql = " WHERE 1=1";
    $params = [];
    if ($secilenKategori !== '') {
        $whereSql .= " AND kategori = :kategori";
        $params[':kategori'] = $secilenKategori;
    }

    $countStmt = $conn->prepare("SELECT COUNT(*) FROM kurumsal_raporlar" . $whereSql);
    $countStmt->execute($params);
    $toplamRapor = (int)$countStmt->fetchColumn();
    $toplamSayfa = max(1, (int)ceil($toplamRapor / $limit));
    if ($sayfa > $toplamSayfa) $sayfa = $toplamSayfa;
    $offset = ($sayfa - 1) * $limit;

    $stmt = $conn->prepare("SELECT * FROM kurumsal_raporlar" . $whereSql . " ORDER BY tarih DESC, sira ASC LIMIT :limit OFFSET :offset");
    foreach ($params as $key => $val) {
        $stmt->bindValue($key, $val);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $raporlar = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $raporlar = [];
}

function krFiltreUrl($basePath, $kategori, $sayfaNo = 1) {
    $q = [];
    if ($kategori !== '') $q['kategori'] = $kategori;
    if ($sayfaNo > 1) $q['sayfa'] = $sayfaNo;
    $qs = http_build_query($q);
    return $basePath . 'pages/kurumsal-raporlar.php' . ($qs ? '?' . $qs : '');
}

include '../../includes/header.php';
?>

<style>
    .kr-bolumu { padding: 7rem 0 5rem; }

    .kr-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--muted);
        margin-bottom: 0.6rem;
    }
    .kr-breadcrumb a { color: var(--muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .kr-breadcrumb a:hover { color: var(--accent-hot); }

    .kr-ustbaslik { margin-bottom: 2rem; }
    .kr-ustbaslik h1 {
        font-size: clamp(1.8rem, 3vw, 2.3rem);
        font-weight: 700;
        color: var(--navy);
    }

    .kr-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 2.5rem;
        align-items: start;
    }

    .kr-filtre-kutu {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 1.4rem;
        margin-bottom: 1.6rem;
    }
    .kr-filtre-kutu h4 {
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--muted);
        margin-bottom: 0.9rem;
    }
    .kr-filtre-form {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
        align-items: flex-end;
    }
    .kr-filtre-form select {
        padding: 0.6rem 0.9rem;
        border: 1px solid var(--line);
        border-radius: 8px;
        font-size: 0.9rem;
        color: var(--text);
        background: var(--white);
        min-width: 220px;
    }
    .kr-btn {
        padding: 0.62rem 1.3rem;
        border-radius: 8px;
        font-size: 0.88rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    .kr-btn-uygula { background: var(--navy); color: var(--white); }
    .kr-btn-uygula:hover { background: #004a8f; }
    .kr-btn-sifirla { background: #eef2f7; color: var(--text); }
    .kr-btn-sifirla:hover { background: #e2e8f0; }

    .kr-liste { display: flex; flex-direction: column; gap: 1rem; }

    .kr-karti {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 1.2rem 1.4rem;
    }
    .kr-karti-sol { display: flex; align-items: center; gap: 0.9rem; min-width: 0; }
    .kr-karti-ikon {
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
    .kr-kategori-etiket {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: var(--accent-hot);
        margin-bottom: 0.2rem;
    }
    .kr-karti h3 { font-size: 1rem; font-weight: 700; color: var(--navy); margin-bottom: 0.15rem; }
    .kr-karti time { font-size: 0.83rem; color: var(--muted); }

    .kr-indir {
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
        flex-shrink: 0;
        transition: background 0.2s ease;
    }
    .kr-indir:hover { background: #004a8f; }

    .kr-bos { text-align: center; color: var(--muted); padding: 3rem 0; background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); }

    .kr-pagination {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 1.6rem;
    }
    .kr-pagination a, .kr-pagination span {
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
    .kr-pagination a:hover { border-color: var(--accent); color: var(--accent-hot); }
    .kr-pagination .active { background: var(--navy); border-color: var(--navy); color: var(--white); }
    .kr-pagination .disabled { opacity: 0.4; pointer-events: none; }

    /* --- Sağdaki sabit Kurumsal kutusu --- */
    .kr-yan-kutu {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 1.4rem;
    }
    .kr-yan-kutu h3 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 1rem;
        padding-bottom: 0.7rem;
        border-bottom: 2px solid var(--accent);
    }
    .kr-yan-kutu ul { list-style: none; }
    .kr-yan-kutu ul li + li { margin-top: 10px; padding-top: 10px; border-top: 1px solid var(--line); }
    .kr-yan-kutu ul li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: var(--text);
        font-weight: 500;
        font-size: 0.88rem;
    }
    .kr-yan-kutu ul li a:hover { color: var(--accent-hot); }
    .kr-yan-kutu ul li a.is-active { color: var(--accent-hot); font-weight: 700; }
    .kr-yan-kutu ul li a i { color: var(--muted); font-size: 13px; }

    @media (max-width: 900px) {
        .kr-layout { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
        .kr-karti { flex-direction: column; align-items: flex-start; }
        .kr-indir { width: 100%; justify-content: center; }
    }
</style>

<section class="kr-bolumu page-content">
    <div class="container">
        <nav class="kr-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Kurumsal Raporlar</span>
        </nav>

        <div class="kr-ustbaslik">
            <h1>Kurumsal Raporlar</h1>
        </div>

        <div class="kr-layout">
            <div>
                <div class="kr-filtre-kutu">
                    <h4>Raporları Filtrele</h4>
                    <form class="kr-filtre-form" method="GET">
                        <select name="kategori">
                            <option value="">Tüm Kategoriler</option>
                            <?php foreach ($kategoriler as $kat): ?>
                                <option value="<?php echo htmlspecialchars($kat); ?>" <?php echo ($secilenKategori === $kat) ? 'selected' : ''; ?>><?php echo htmlspecialchars($kat); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="kr-btn kr-btn-uygula">Uygula</button>
                        <a href="<?php echo $basePath; ?>pages/kurumsal-raporlar.php" class="kr-btn kr-btn-sifirla">Sıfırla</a>
                    </form>
                </div>

                <?php if (count($raporlar) > 0): ?>
                    <div class="kr-liste">
                        <?php foreach ($raporlar as $rapor): ?>
                            <div class="kr-karti">
                                <div class="kr-karti-sol">
                                    <div class="kr-karti-ikon"><i class="bi bi-file-earmark-text"></i></div>
                                    <div>
                                        <span class="kr-kategori-etiket"><?php echo htmlspecialchars($rapor['kategori']); ?></span>
                                        <h3><?php echo htmlspecialchars($rapor['baslik']); ?></h3>
                                        <?php if (!empty($rapor['tarih'])): ?>
                                            <time><?php echo date('d.m.Y', strtotime($rapor['tarih'])); ?></time>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if (!empty($rapor['dosya'])): ?>
                                    <a href="<?php echo $basePath . htmlspecialchars($rapor['dosya']); ?>" class="kr-indir" target="_blank" rel="noopener">
                                        <i class="bi bi-download"></i> İndir 
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($toplamSayfa > 1): ?>
                        <nav class="kr-pagination">
                            <a href="<?php echo krFiltreUrl($basePath, $secilenKategori, $sayfa - 1); ?>" class="<?php echo $sayfa <= 1 ? 'disabled' : ''; ?>">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                            <?php for ($p = 1; $p <= $toplamSayfa; $p++): ?>
                                <a href="<?php echo krFiltreUrl($basePath, $secilenKategori, $p); ?>" class="<?php echo $p === $sayfa ? 'active' : ''; ?>">
                                    <?php echo $p; ?>
                                </a>
                            <?php endfor; ?>
                            <a href="<?php echo krFiltreUrl($basePath, $secilenKategori, $sayfa + 1); ?>" class="<?php echo $sayfa >= $toplamSayfa ? 'disabled' : ''; ?>">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </nav>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="kr-bos">Seçilen kritere uygun rapor bulunamadı.</p>
                <?php endif; ?>
            </div>

            <aside class="kr-yan-kutu">
                <h3>Kurumsal</h3>
                <ul>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/vizyonumuz.php">Vizyonumuz <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/misyonumuz.php">Misyonumuz <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/ilkelerimiz.php">İlkelerimiz <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/enerji-politikamiz.php">Enerji Politikamız <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/belediye-meclisi.php">Belediye Meclisi <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/yonetim-semasi.php">Yönetim Şeması <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/baskan-yardimcilari.php">Başkan Yardımcıları <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/baskan-danismanlari.php">Başkan Danışmanları <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/mudurlukler.php">Müdürlükler <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/eski-baskanlar.php">Eski Başkanlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/arabuluculuk-komisyonu.php">Arabuluculuk Komisyonu <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/etik-komisyonu.php">Etik Komisyonu <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/meclis-kararlari.php">Meclis Kararları <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/kurumsal-kimlik.php">Kurumsal Kimlik <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="#" class="is-active">Kurumsal Raporlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/kurumsal-dokumanlar.php">Kurumsal Dökümanlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/yayinlar.php">Yayınlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/kvkk.php">KVKK Aydınlatma Metni</a></li>
                </ul>
            </aside>
        </div>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>