<?php
include '../includes/db.php';
require_once '../includes/init.php';

$basePath = '../';
$pageTitle = 'Yayınlar | Gebze Belediyesi';
$navTransparent = false;
$currentKurumsalPage = 'yayinlar';

$secilenKategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';

$kategoriler = [];
try {
    $kategoriler = $conn->query("SELECT DISTINCT kategori FROM yayinlar ORDER BY kategori ASC")->fetchAll(PDO::FETCH_COLUMN);
} catch (Exception $e) {
    $kategoriler = [];
}

$yayinlar = [];
try {
    $whereSql = " WHERE 1=1";
    $params = [];
    if ($secilenKategori !== '') {
        $whereSql .= " AND kategori = :kategori";
        $params[':kategori'] = $secilenKategori;
    }
    $stmt = $conn->prepare("SELECT * FROM yayinlar" . $whereSql . " ORDER BY tarih DESC, sira ASC");
    $stmt->execute($params);
    $yayinlar = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $yayinlar = [];
}

$ayIsimleri = [1=>'Ocak',2=>'Şubat',3=>'Mart',4=>'Nisan',5=>'Mayıs',6=>'Haziran',7=>'Temmuz',8=>'Ağustos',9=>'Eylül',10=>'Ekim',11=>'Kasım',12=>'Aralık'];
function yayinTarihYaz($tarih, $ayIsimleri) {
    if (empty($tarih)) return '';
    $t = strtotime($tarih);
    return (int)date('j', $t) . ' ' . $ayIsimleri[(int)date('n', $t)] . ' ' . date('Y', $t);
}

include '../includes/header.php';
?>

<style>
    .yy-bolumu { padding: 7rem 0 5rem; }

    .yy-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--muted);
        margin-bottom: 0.6rem;
    }
    .yy-breadcrumb a { color: var(--muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .yy-breadcrumb a:hover { color: var(--accent-hot); }

    .yy-ustbaslik { margin-bottom: 2rem; }
    .yy-ustbaslik h1 {
        font-size: clamp(1.8rem, 3vw, 2.3rem);
        font-weight: 700;
        color: var(--navy);
    }

    .yy-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 2.5rem;
        align-items: start;
    }

    .yy-filtre {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
        margin-bottom: 1.8rem;
    }
    .yy-filtre a {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.65rem 1.3rem;
        border-radius: 999px;
        border: 1px solid var(--line);
        color: var(--navy);
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .yy-filtre a:hover { border-color: var(--accent); }
    .yy-filtre a.is-active {
        background: linear-gradient(135deg, var(--navy), #0066bf);
        border-color: transparent;
        color: var(--white);
    }

    .yy-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.4rem;
    }

    .yy-kart {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        overflow: hidden;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .yy-kart:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow);
    }

    .yy-kapak-wrap {
        position: relative;
        aspect-ratio: 16 / 10;
        background: linear-gradient(135deg, var(--accent) 0%, #f6d1a0 100%);
        overflow: hidden;
    }
    .yy-kapak-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .yy-kapak-yok {
        width: 100%;
        height: 100%;
        display: grid;
        place-items: center;
        color: var(--white);
        font-size: 2.4rem;
    }

    .yy-kategori-etiket {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255,255,255,0.95);
        color: var(--navy);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.3rem 0.8rem;
        border-radius: 999px;
    }

    .yy-icerik { padding: 1.2rem 1.3rem; }
    .yy-icerik h3 { font-size: 1.02rem; font-weight: 700; color: var(--navy); margin-bottom: 1rem; line-height: 1.35; }

    .yy-alt-satir {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }
    .yy-tarih { display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.83rem; color: var(--muted); }

    .yy-indir {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.55rem 1rem;
        background: var(--navy);
        color: var(--white);
        border-radius: 999px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: background 0.2s ease;
    }
    .yy-indir:hover { background: #004a8f; }

    .yy-bos { text-align: center; color: var(--muted); padding: 3rem 0; background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); grid-column: 1 / -1; }

    .yy-yan-kutu {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 1.4rem;
    }
    .yy-yan-kutu h3 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 1rem;
        padding-bottom: 0.7rem;
        border-bottom: 2px solid var(--accent);
    }
    .yy-yan-kutu ul { list-style: none; }
    .yy-yan-kutu ul li + li { margin-top: 10px; padding-top: 10px; border-top: 1px solid var(--line); }
    .yy-yan-kutu ul li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: var(--text);
        font-weight: 500;
        font-size: 0.88rem;
    }
    .yy-yan-kutu ul li a:hover { color: var(--accent-hot); }
    .yy-yan-kutu ul li a.is-active { color: var(--accent-hot); font-weight: 700; }
    .yy-yan-kutu ul li a i { color: var(--muted); font-size: 13px; }

    @media (max-width: 900px) {
        .yy-layout { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
        .yy-grid { grid-template-columns: 1fr; }
    }
</style>

<section class="yy-bolumu page-content">
    <div class="container">
        <nav class="yy-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Yayınlar</span>
        </nav>

        <div class="yy-ustbaslik">
            <h1>Gebze Belediyesi Yayınları</h1>
        </div>

        <div class="yy-layout">
            <div>
                <nav class="yy-filtre">
                    <a href="<?php echo $basePath; ?>pages/yayinlar.php" class="<?php echo $secilenKategori === '' ? 'is-active' : ''; ?>">
                        <i class="bi bi-grid"></i> Tüm Yayınlar
                    </a>
                    <?php foreach ($kategoriler as $kat): ?>
                        <a href="<?php echo $basePath; ?>pages/yayinlar.php?kategori=<?php echo urlencode($kat); ?>" class="<?php echo $secilenKategori === $kat ? 'is-active' : ''; ?>">
                            <i class="bi bi-file-earmark"></i> <?php echo htmlspecialchars($kat); ?>
                        </a>
                    <?php endforeach; ?>
                </nav>

                <div class="yy-grid">
                    <?php if (count($yayinlar) > 0): ?>
                        <?php foreach ($yayinlar as $yayin): ?>
                            <div class="yy-kart">
                                <div class="yy-kapak-wrap">
                                    <span class="yy-kategori-etiket"><?php echo htmlspecialchars($yayin['kategori']); ?></span>
                                    <?php if (!empty($yayin['kapak_resim'])): ?>
                                        <img src="<?php echo $basePath . htmlspecialchars($yayin['kapak_resim']); ?>" alt="<?php echo htmlspecialchars($yayin['baslik']); ?>">
                                    <?php else: ?>
                                        <div class="yy-kapak-yok"><i class="bi bi-journal-bookmark"></i></div>
                                    <?php endif; ?>
                                </div>
                                <div class="yy-icerik">
                                    <h3><?php echo htmlspecialchars($yayin['baslik']); ?></h3>
                                    <div class="yy-alt-satir">
                                        <?php if (!empty($yayin['tarih'])): ?>
                                            <span class="yy-tarih"><i class="bi bi-calendar3"></i> <?php echo yayinTarihYaz($yayin['tarih'], $ayIsimleri); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($yayin['dosya'])): ?>
                                            <a href="<?php echo $basePath . htmlspecialchars($yayin['dosya']); ?>" class="yy-indir" target="_blank" rel="noopener">
                                                <i class="bi bi-file-earmark-pdf"></i> PDF İndir
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="yy-bos">Gösterilecek yayın bulunamadı.</p>
                    <?php endif; ?>
                </div>
            </div>

            <aside>
                <div class="yy-yan-kutu">
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
                        <li><a href="<?php echo $basePath; ?>pages/kurumsal-kimlik.php">Kurumsal Kimlik <i class="bi bi-chevron-right"></i></a></li>
                        <li><a href="<?php echo $basePath; ?>pages/kurumsal-raporlar.php">Kurumsal Raporlar <i class="bi bi-chevron-right"></i></a></li>
                        <li><a href="<?php echo $basePath; ?>pages/kurumsal-dokumanlar.php">Kurumsal Dökümanlar <i class="bi bi-chevron-right"></i></a></li>
                        <li><a href="#" class="is-active">Yayınlar <i class="bi bi-chevron-right"></i></a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>