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

$sayfa = isset($_GET['sayfa']) && is_numeric($_GET['sayfa']) ? (int)$_GET['sayfa'] : 1;
if ($sayfa < 1) $sayfa = 1;
$limit = 9;
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

    $countSql = "SELECT COUNT(*) FROM projeler p" . $whereSql;
    $stmtCount = $conn->prepare($countSql);
    $stmtCount->execute($params);
    $toplamProjeler = (int)$stmtCount->fetchColumn();

    $toplamSayfa = ceil($toplamProjeler / $limit);
    if ($toplamSayfa < 1) $toplamSayfa = 1;
    if ($sayfa > $toplamSayfa) $sayfa = $toplamSayfa;

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

    /* Başlık + kategori/hamburger tek satırda: başlık solda, diğerleri sağda */
    .proje-ust-satir {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 30px;
    }

    .proje-ustbaslik { margin-bottom: 0; }
    .proje-ustbaslik h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 6px 0 8px;
    }
    .proje-ustbaslik p {
        color: #5b6470;
        font-size: 1rem;
    }

    .proje-sekme-satir {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 1.5rem;
        margin-bottom: 0;
        flex-shrink: 0;
    }

    .proje-sekme-satir .proje-sekme {
        margin-bottom: 0;
    }

    .proje-hamburger {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        border-radius: 10px;
        border: 1px solid #e3e6ea;
        background: #fff;
        font-size: 1.3rem;
        color: #1a1a1a;
        cursor: pointer;
        transition: background .2s ease, border-color .2s ease;
    }
    .proje-hamburger:hover {
        border-color: var(--brand-color, #0f5d3c);
        color: var(--brand-color, #0f5d3c);
    }

    .proje-sekme {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
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
        display: block;
    }

    .proje-sol-alan {
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    .proje-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 56px 40px;
        align-items: start;
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

    .proje-grid .proje-kart {
    width: auto;
    aspect-ratio: auto;
    height: auto;
    background: #fff;
    }
    .proje-kart:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.07);
    }

    .proje-gorsel {
        position: relative;
        height: 280px;
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

    .proje-meta {
        padding: 16px 18px 18px;
        display: flex;
        flex-direction: column;
    }
    .proje-kategori-etiket {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: var(--brand-color, #0f5d3c);
        margin-bottom: 8px;
    }
    .proje-meta h3 {
        font-size: 1.08rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.35;
        color: #1a1a1a;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: calc(1.35em * 2);
    }

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

    .proje-yan-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 2999;
        opacity: 0;
        pointer-events: none;
        transition: opacity .3s ease;
    }
    .proje-yan-backdrop.is-open {
        opacity: 1;
        pointer-events: auto;
    }

    .proje-yan {
        position: fixed;
        top: 0;
        right: 0;
        height: 100vh;
        width: 320px;
        max-width: 85vw;
        background: #fff;
        z-index: 3000;
        padding: 1.6rem 1.4rem 2rem;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 24px;
        transform: translateX(100%);
        transition: transform .3s ease;
        box-shadow: -10px 0 30px rgba(0, 0, 0, 0.15);
    }
    .proje-yan.is-open {
        transform: translateX(0);
    }

    .proje-yan-baslik-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 12px;
        border-bottom: 1px solid #edeff1;
    }
    .proje-yan-baslik-bar h2 {
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0;
    }
    .proje-yan-kapat {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #f1f2f4;
        border: none;
        font-size: 1rem;
        color: #1a1a1a;
        cursor: pointer;
    }
    .proje-yan-kapat:hover { background: #e3e6ea; }

    .yan-kutu {
        background: #f8f9fa;
        border: 1px solid #edeff1;
        border-radius: 14px;
        padding: 20px;
    }
    .yan-kutu h3 { font-size: 1.02rem; font-weight: 700; margin: 0 0 14px; }
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

    .proje-tetikleyici {
        width: 100%;
        border: none;
        text-align: left;
        font-family: inherit;
        cursor: pointer;
    }

    .proje-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        z-index: 4000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }
    .proje-modal-backdrop[hidden] { display: none !important; }

    .proje-modal {
        position: relative;
        background: #fff;
        border-radius: 16px;
        max-width: 640px;
        width: 100%;
        max-height: 88vh;
        overflow-y: auto;
        box-shadow: 0 20px 50px rgba(0,0,0,0.3);
    }

    .proje-modal-kapat {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 2;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255,255,255,0.92);
        border: none;
        display: grid;
        place-items: center;
        font-size: 1rem;
        color: #1a1a1a;
        cursor: pointer;
    }

    .proje-modal-foto {
        width: 100%;
        height: 280px;
        object-fit: cover;
        display: block;
    }

    .proje-modal-icerik {
        padding: 24px 28px 30px;
    }

    .proje-modal-icerik h2 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1a1a1a;
        margin: 10px 0 14px;
    }

    .proje-modal-durum {
        position: static;
        display: inline-flex;
        margin-bottom: 1rem;
    }

    .proje-modal-metin {
        color: #3a3f45;
        font-size: 0.98rem;
        line-height: 1.8;
        white-space: pre-line;
        margin-top: 8px;
    }

    @media (max-width: 980px) {
        .proje-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 720px) {
        .proje-ust-satir { flex-direction: column; align-items: stretch; }
        .proje-sekme-satir { justify-content: flex-start; }
    }
    @media (max-width: 580px) {
        .proje-grid { grid-template-columns: 1fr; }
        .proje-yan { width: 100%; max-width: 100%; }
    }
</style>

<main class="proje-bolumu page-content">
    <div class="container">
        <nav class="proje-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
            <span>/</span>
            <span>Tüm Projeler</span>
        </nav>

        <div class="proje-ust-satir">
            <div class="proje-ustbaslik">
                <h1>Tüm Projeler</h1>
                <p>Tüm projeleri buradan görüntüleyebilirsiniz.</p>
            </div>

            <div class="proje-sekme-satir">
                <nav class="proje-sekme">
                    <a href="<?php echo projeFiltreUrl($basePath, '', $aktifKategoriSlug); ?>" class="<?php echo $aktifDurumSlug === '' ? 'is-active' : ''; ?>">Tümü</a>
                    <a href="<?php echo projeFiltreUrl($basePath, 'planlanan', $aktifKategoriSlug); ?>" class="<?php echo $aktifDurumSlug === 'planlanan' ? 'is-active' : ''; ?>">Planlanan</a>
                    <a href="<?php echo projeFiltreUrl($basePath, 'devam-eden', $aktifKategoriSlug); ?>" class="<?php echo $aktifDurumSlug === 'devam-eden' ? 'is-active' : ''; ?>">Devam Eden</a>
                    <a href="<?php echo projeFiltreUrl($basePath, 'tamamlanan', $aktifKategoriSlug); ?>" class="<?php echo $aktifDurumSlug === 'tamamlanan' ? 'is-active' : ''; ?>">Tamamlanan</a>
                </nav>
                <button type="button" class="proje-hamburger" id="projeHamburger" aria-label="Menüyü aç">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>

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
                            <button type="button" class="proje-kart proje-tetikleyici"
                                data-baslik="<?php echo htmlspecialchars($proje['baslik']); ?>"
                                data-resim="<?php echo htmlspecialchars($img); ?>"
                                data-kategori="<?php echo htmlspecialchars($proje['kategori_ad'] ?? ''); ?>"
                                data-durum="<?php echo htmlspecialchars($durum); ?>"
                                data-durum-class="<?php echo htmlspecialchars($durumClass); ?>"
                                data-aciklama="<?php echo htmlspecialchars($proje['aciklama'] ?? ''); ?>">
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
                            </button>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="bos-mesaj">Gösterilecek proje bulunamadı.</p>
                    <?php endif; ?>
                </div>

                <?php if ($toplamSayfa > 1): ?>
                    <nav class="proje-pagination">
                        <a href="<?php echo projeFiltreUrl($basePath, $aktifDurumSlug, $aktifKategoriSlug, $sayfa - 1); ?>" class="<?php echo $sayfa <= 1 ? 'disabled' : ''; ?>">
                            <i class="bi bi-chevron-left"></i>
                        </a>

                        <?php for ($p = 1; $p <= $toplamSayfa; $p++): ?>
                            <a href="<?php echo projeFiltreUrl($basePath, $aktifDurumSlug, $aktifKategoriSlug, $p); ?>" class="<?php echo $p === $sayfa ? 'active' : ''; ?>">
                                <?php echo $p; ?>
                            </a>
                        <?php endfor; ?>

                        <a href="<?php echo projeFiltreUrl($basePath, $aktifDurumSlug, $aktifKategoriSlug, $sayfa + 1); ?>" class="<?php echo $sayfa >= $toplamSayfa ? 'disabled' : ''; ?>">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<div class="proje-yan-backdrop" id="projeYanBackdrop"></div>
<aside class="proje-yan" id="projeYanPanel">
    <div class="proje-yan-baslik-bar">
        <h2>Menü</h2>
        <button type="button" class="proje-yan-kapat" id="projeYanKapat" aria-label="Menüyü kapat">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

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

<div class="proje-modal-backdrop" id="projeModalBackdrop" hidden>
    <div class="proje-modal">
        <button type="button" class="proje-modal-kapat" id="projeModalKapat"><i class="bi bi-x-lg"></i></button>
        <img id="projeModalResim" src="" alt="" class="proje-modal-foto">
        <div class="proje-modal-icerik">
            <span id="projeModalKategori" class="proje-kategori-etiket"></span>
            <h2 id="projeModalBaslik"></h2>
            <span id="projeModalDurum" class="proje-durum proje-modal-durum"></span>
            <div id="projeModalAciklama" class="proje-modal-metin"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const hamburger = document.getElementById('projeHamburger');
    const panel = document.getElementById('projeYanPanel');
    const backdrop = document.getElementById('projeYanBackdrop');
    const kapatBtn = document.getElementById('projeYanKapat');

    function panelAc() {
        panel.classList.add('is-open');
        backdrop.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function panelKapat() {
        panel.classList.remove('is-open');
        backdrop.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    hamburger.addEventListener('click', panelAc);
    kapatBtn.addEventListener('click', panelKapat);
    backdrop.addEventListener('click', panelKapat);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') panelKapat();
    });

    const projeModalBackdrop = document.getElementById('projeModalBackdrop');
    const projeModalKapat = document.getElementById('projeModalKapat');
    const projeModalResim = document.getElementById('projeModalResim');
    const projeModalBaslik = document.getElementById('projeModalBaslik');
    const projeModalKategori = document.getElementById('projeModalKategori');
    const projeModalDurum = document.getElementById('projeModalDurum');
    const projeModalAciklama = document.getElementById('projeModalAciklama');

    document.querySelectorAll('.proje-tetikleyici').forEach(function (btn) {
        btn.addEventListener('click', function () {
            projeModalResim.src = btn.dataset.resim;
            projeModalResim.alt = btn.dataset.baslik;
            projeModalBaslik.textContent = btn.dataset.baslik;
            projeModalKategori.textContent = btn.dataset.kategori;
            projeModalDurum.textContent = btn.dataset.durum;
            projeModalDurum.className = 'proje-durum proje-modal-durum ' + (btn.dataset.durumClass || '');
            projeModalAciklama.textContent = btn.dataset.aciklama || 'Bu proje için henüz açıklama eklenmemiştir.';
            projeModalBackdrop.hidden = false;
            document.body.style.overflow = 'hidden';
        });
    });

    function projeModalKapatFn() {
        projeModalBackdrop.hidden = true;
        document.body.style.overflow = '';
    }

    projeModalKapat.addEventListener('click', projeModalKapatFn);
    projeModalBackdrop.addEventListener('click', function (e) {
        if (e.target === projeModalBackdrop) projeModalKapatFn();
    });
});
</script>

<?php include '../../includes/footer.php'; ?>