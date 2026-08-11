<?php
include '../includes/db.php';
require_once '../includes/init.php';

$basePath = '../';
$pageTitle = 'Kurumsal Kimlik | Gebze Belediyesi';
$navTransparent = false;
$currentKurumsalPage = 'kurumsal-kimlik';

$secilenKategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';

$kategoriler = [];
try {
    $kategoriler = $conn->query("SELECT DISTINCT kategori FROM kurumsal_kimlik ORDER BY kategori ASC")->fetchAll(PDO::FETCH_COLUMN);
} catch (Exception $e) {
    $kategoriler = [];
}

$gruplar = [];
try {
    $whereSql = " WHERE 1=1";
    $params = [];
    if ($secilenKategori !== '') {
        $whereSql .= " AND kategori = :kategori";
        $params[':kategori'] = $secilenKategori;
    }
    $stmt = $conn->prepare("SELECT * FROM kurumsal_kimlik" . $whereSql . " ORDER BY kategori ASC, sira ASC");
    $stmt->execute($params);
    $tumOgeler = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($tumOgeler as $oge) {
        $gruplar[$oge['kategori']][] = $oge;
    }
} catch (Exception $e) {
    $gruplar = [];
}

include '../includes/header.php';
?>

<style>
    .kk-bolumu { padding: 7rem 0 5rem; }

    .kk-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--muted);
        margin-bottom: 0.6rem;
    }
    .kk-breadcrumb a { color: var(--muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .kk-breadcrumb a:hover { color: var(--accent-hot); }

    .kk-ustbaslik-satir {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.6rem;
    }
    .kk-ustbaslik h1 {
        font-size: clamp(1.8rem, 3vw, 2.3rem);
        font-weight: 700;
        color: var(--navy);
    }

    .kk-yazi-boyut { display: flex; gap: 0.5rem; margin-top: 4px; }
    .kk-yazi-boyut button {
        width: 42px;
        height: 42px;
        border: 1px solid var(--line);
        border-radius: 8px;
        background: var(--white);
        color: var(--navy);
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
    }
    .kk-yazi-boyut button:hover { border-color: var(--accent); color: var(--accent-hot); }

    .kk-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 2.5rem;
        align-items: start;
    }

    .kk-filtre {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
        margin-bottom: 1.6rem;
    }
    .kk-filtre a {
        padding: 0.6rem 1.3rem;
        border-radius: 999px;
        border: 1px solid var(--line);
        color: var(--navy);
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .kk-filtre a:hover { border-color: var(--accent); }
    .kk-filtre a.is-active { background: var(--navy); border-color: var(--navy); color: var(--white); }

    .kk-grup { margin-bottom: 2rem; }

    .kk-grup-baslik {
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--accent-hot);
        margin-bottom: 0.9rem;
    }

    .kk-liste { display: flex; flex-direction: column; gap: 0.8rem; }

    .kk-satir {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        background: var(--white);
        border: 1px solid var(--line);
        border-left: 4px solid var(--navy);
        border-radius: var(--radius);
        padding: 1.1rem 1.3rem;
        transition: border-color .2s ease, transform .2s ease;
    }
    .kk-satir:hover {
        border-left-color: var(--accent);
        transform: translateX(3px);
    }

    .kk-satir-sol { display: flex; align-items: center; gap: 0.9rem; min-width: 0; }

    .kk-satir-ikon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: #eef4fb;
        color: var(--navy);
        display: grid;
        place-items: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .kk-satir h3 { font-size: 0.98rem; font-weight: 700; color: var(--navy); margin-bottom: 0.15rem; }
    .kk-satir p { font-size: 0.83rem; color: var(--muted); }

    .kk-indir {
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
    .kk-indir:hover { background: #004a8f; }

    .kk-bos { text-align: center; color: var(--muted); padding: 3rem 0; background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); }

    /* --- Sağdaki sabit Kurumsal kutusu --- */
    .kk-yan-kutu {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 1.4rem;
    }
    .kk-yan-kutu h3 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 1rem;
        padding-bottom: 0.7rem;
        border-bottom: 2px solid var(--accent);
    }
    .kk-yan-kutu ul { list-style: none; }
    .kk-yan-kutu ul li + li { margin-top: 10px; padding-top: 10px; border-top: 1px solid var(--line); }
    .kk-yan-kutu ul li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: var(--text);
        font-weight: 500;
        font-size: 0.88rem;
    }
    .kk-yan-kutu ul li a:hover { color: var(--accent-hot); }
    .kk-yan-kutu ul li a.is-active { color: var(--accent-hot); font-weight: 700; }
    .kk-yan-kutu ul li a i { color: var(--muted); font-size: 13px; }

    @media (max-width: 900px) {
        .kk-layout { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
        .kk-satir { flex-direction: column; align-items: flex-start; }
        .kk-indir { width: 100%; justify-content: center; }
    }
</style>

<section class="kk-bolumu page-content">
    <div class="container">
        <nav class="kk-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Kurumsal Kimlik</span>
        </nav>

        <div class="kk-ustbaslik-satir">
            <div class="kk-ustbaslik">
                <h1>Kurumsal Kimlik</h1>
            </div>
            
        </div>

        <div class="kk-layout">
            <div>
                <nav class="kk-filtre">
                    <a href="<?php echo $basePath; ?>pages/kurumsal-kimlik.php" class="<?php echo $secilenKategori === '' ? 'is-active' : ''; ?>">Tümü</a>
                    <?php foreach ($kategoriler as $kat): ?>
                        <a href="<?php echo $basePath; ?>pages/kurumsal-kimlik.php?kategori=<?php echo urlencode($kat); ?>" class="<?php echo $secilenKategori === $kat ? 'is-active' : ''; ?>"><?php echo htmlspecialchars($kat); ?></a>
                    <?php endforeach; ?>
                </nav>

                <?php if (count($gruplar) > 0): ?>
                    <?php foreach ($gruplar as $kategoriAdi => $ogeler): ?>
                        <div class="kk-grup">
                            <div class="kk-grup-baslik"><?php echo htmlspecialchars($kategoriAdi); ?></div>
                            <div class="kk-liste">
                                <?php foreach ($ogeler as $oge): ?>
                                    <div class="kk-satir">
                                        <div class="kk-satir-sol">
                                            <div class="kk-satir-ikon"><i class="bi bi-image"></i></div>
                                            <div>
                                                <h3><?php echo htmlspecialchars($oge['baslik']); ?></h3>
                                                <?php if (!empty($oge['aciklama'])): ?>
                                                    <p><?php echo htmlspecialchars($oge['aciklama']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if (!empty($oge['dosya'])): ?>
                                            <a href="<?php echo $basePath . htmlspecialchars($oge['dosya']); ?>" class="kk-indir" target="_blank" rel="noopener">
                                                <i class="bi bi-download"></i> İndir
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="kk-bos">Gösterilecek kurumsal kimlik dosyası bulunamadı.</p>
                <?php endif; ?>
            </div>

            <aside class="kk-yan-kutu">
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
                    <li><a href="<?php echo $basePath; ?>pages/meclis-kararlari.php">Meclis Kararları <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="#" class="is-active">Kurumsal Kimlik <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal-raporlar.php">Kurumsal Raporlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal-dokumanlar.php">Kurumsal Dökümanlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/yayinlar.php">Yayınlar <i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </aside>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>