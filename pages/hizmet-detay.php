<?php
/**
 * HİZMET DETAY SAYFASI
 * -------------------------------------------------------------
 * hizmetler.php'deki "Detaylı Bilgi" linki buraya gelir:
 *   hizmet-detay.php?id=7
 *
 * Sağ sidebar'da aynı kategorideki (mudurluk) diğer hizmetleri
 * listeler ve "Bizi Takip Edin" bloğunu gösterir — gerçek siteyle
 * aynı düzen.
 */

include '../includes/db.php';
require_once '../includes/init.php';

$basePath = '../';
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

$hizmet = null;
$kardesler = [];
try {
    $stmt = $conn->prepare("SELECT * FROM hizmet_listesi WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    $hizmet = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($hizmet) {
        $stmtK = $conn->prepare("SELECT id, hizmet_adi FROM hizmet_listesi WHERE mudurluk = :mudurluk ORDER BY sira ASC, hizmet_adi ASC");
        $stmtK->execute([':mudurluk' => $hizmet['mudurluk']]);
        $kardesler = $stmtK->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    $hizmet = null;
}

$pageTitle = $hizmet ? htmlspecialchars($hizmet['hizmet_adi']) . ' | Gebze Belediyesi' : 'Hizmet Bulunamadı | Gebze Belediyesi';
$navTransparent = false;

/**
 * Düz metin içindeki http(s):// bağlantılarını gerçek <a> etiketine çevirir.
 * ÖNEMLİ: Bu fonksiyon zaten htmlspecialchars() ile kaçışlanmış (escape
 * edilmiş) bir metin üzerinde çalışmalı, ham kullanıcı girdisi üzerinde DEĞİL.
 */
function hzLinkify($guvenliMetin)
{
    $desen = '/(https?:\/\/[^\s<]+)/i';
    return preg_replace_callback($desen, function ($eslesme) {
        $url = rtrim($eslesme[1], '.,);'); // cümle sonu noktalama işaretlerini linke dahil etme
        $kirpik = trim($eslesme[1]) !== $url ? substr($eslesme[1], strlen($url)) : '';
        return '<a href="' . $url . '" target="_blank" rel="noopener" class="hd-link">' . $url . '</a>' . $kirpik;
    }, $guvenliMetin);
}

/**
 * Metin içinde "TIKLAYINIZ" / "Tıklayınız" gibi geçen kelimeyi, hizmet
 * satırındaki "link" sütununa işaret eden tıklanabilir bir bağlantıya
 * çevirir. $ctaLink boşsa hiçbir şey değiştirmez.
 * ÖNEMLİ: hzLinkify gibi, zaten htmlspecialchars ile kaçışlanmış metin
 * üzerinde çalışmalı.
 */
function hzTiklayinizLinkify($guvenliMetin, $ctaLink)
{
    if (empty($ctaLink)) return $guvenliMetin;
    $guvenliLink = htmlspecialchars($ctaLink);
    $desen = '/(tıklayınız|tıklayın|tiklayiniz|tiklayin)/iu';
    return preg_replace_callback($desen, function ($eslesme) use ($guvenliLink) {
        return '<a href="' . $guvenliLink . '" target="_blank" rel="noopener" class="hd-link hd-cta-link">' . $eslesme[1] . '</a>';
    }, $guvenliMetin);
}

/**
 * Ham "detay" metnini okunabilir HTML paragraflarına çevirir.
 * $ctaLink verilirse, metin içindeki "tıklayınız" kelimesi o adrese
 * otomatik bağlanır (hizmet_listesi.link sütunu).
 */
function hzDetayHtml($ham, $ctaLink = null)
{
    if (empty($ham)) return '';
    $ham = str_replace(["\r\n", "\r"], "\n", $ham);
    $ham = preg_replace('/\n{2,}/', "\n\n", trim($ham));
    $paragraflar = preg_split('/\n\s*\n/', $ham);

    $html = '';
    foreach ($paragraflar as $p) {
        $p = trim($p);
        if ($p === '') continue;
        $guvenli = nl2br(htmlspecialchars($p));
        $guvenli = hzLinkify($guvenli);
        $guvenli = hzTiklayinizLinkify($guvenli, $ctaLink);
        $html .= '<p>' . $guvenli . '</p>' . "\n";
    }
    return $html;
}

include '../includes/header.php';
?>

<style>
    .hd-bolumu { padding: 7rem 0 5rem; }

    .hd-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--muted);
        margin-bottom: 1.4rem;
    }
    .hd-breadcrumb a { color: var(--muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .hd-breadcrumb a:hover { color: var(--accent-hot); }

    .hd-ust-satir {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.4rem;
    }
    .hd-ust-satir h1 {
        font-size: clamp(1.5rem, 3vw, 2.1rem);
        font-weight: 700;
        color: var(--navy);
        line-height: 1.25;
        margin: 0;
    }
    .hd-araclar { display: flex; gap: 8px; flex-shrink: 0; }
    .hd-arac-btn {
        width: 40px;
        height: 40px;
        border: 1px solid var(--line);
        border-radius: 8px;
        background: var(--white);
        color: var(--navy);
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all .2s ease;
    }
    .hd-arac-btn:hover { border-color: var(--accent-hot); color: var(--accent-hot); }
    .hd-arac-btn.is-active { background: var(--navy); border-color: var(--navy); color: var(--white); }

    /* --- İki kolon düzen: içerik + sidebar --- */
    .hd-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 2.4rem;
        align-items: start;
    }

    .hd-gorsel {
        width: 100%;
        height: auto;
        display: block;
        border-radius: var(--radius);
        margin-bottom: 2rem;
    }
    .hd-gorsel-yok {
        width: 100%;
        height: 220px;
        border-radius: var(--radius);
        background: #eef1f4;
        color: var(--muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        margin-bottom: 2rem;
    }

    .hd-icerik { font-size: 0.98rem; color: var(--text); line-height: 1.75; transition: font-size .15s ease; }
    .hd-icerik p { margin: 0 0 1.1rem; }
    .hd-icerik p:last-child { margin-bottom: 0; }
    .hd-icerik .hd-link { color: var(--accent-hot); text-decoration: underline; word-break: break-word; }
    .hd-icerik .hd-link:hover { color: var(--navy); }
    .hd-icerik .hd-cta-link { font-weight: 700; text-transform: uppercase; }

    .hd-geri {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        margin-top: 2.4rem;
        padding: 0.7rem 1.4rem;
        background: var(--navy);
        color: var(--white);
        border-radius: 999px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
    }
    .hd-geri:hover { background: #004a8f; }

    .hd-eksik-icerik { color: var(--muted); font-style: italic; padding: 1rem 0; }

    /* --- Sidebar --- */
    .hd-sidebar { display: flex; flex-direction: column; gap: 1.4rem; position: sticky; top: 100px; }
    .hd-kutu {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 1.3rem 1.4rem;
    }
    .hd-kutu h3 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--navy);
        margin: 0 0 1rem;
        padding-bottom: 0.6rem;
        border-bottom: 2px solid var(--accent-hot);
        display: inline-block;
    }

    .hd-arama-kutu { display: flex; }
    .hd-arama-kutu input {
        flex: 1;
        padding: 0.65rem 0.9rem;
        border: 1px solid var(--line);
        border-radius: 8px 0 0 8px;
        font-size: 0.88rem;
        outline: none;
    }
    .hd-arama-kutu button {
        padding: 0 1rem;
        background: var(--navy);
        color: var(--white);
        border: none;
        border-radius: 0 8px 8px 0;
        cursor: pointer;
    }

    .hd-kategori-liste { list-style: none; margin: 0; padding: 0; }
    .hd-kategori-liste li + li { margin-top: 4px; }
    .hd-kategori-liste a {
        display: block;
        padding: 0.6rem 0.8rem;
        border-radius: 8px;
        color: var(--text);
        text-decoration: none;
        font-size: 0.9rem;
        line-height: 1.4;
        transition: background .2s ease, color .2s ease;
    }
    .hd-kategori-liste a:hover { background: #f7f9fb; color: var(--accent-hot); }
    .hd-kategori-liste a.is-active {
        background: #eef4fb;
        color: var(--navy);
        font-weight: 700;
        border-left: 3px solid var(--navy);
        padding-left: calc(0.8rem - 3px);
    }

    .hd-sosyal { display: flex; gap: 10px; flex-wrap: wrap; }
    .hd-sosyal a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1.1rem;
        text-decoration: none;
        flex-shrink: 0;
    }
    .hd-sosyal a.whatsapp { background: #25D366; }
    .hd-sosyal a.facebook { background: #1877F2; }
    .hd-sosyal a.x { background: #000; }
    .hd-sosyal a.instagram { background: radial-gradient(circle at 30% 110%, #fdf497 0%, #fd5949 45%, #d6249f 60%, #285AEB 90%); }
    .hd-sosyal a.youtube { background: #FF0000; }

    .hd-bulunamadi { text-align: center; padding: 4rem 0; }
    .hd-bulunamadi h1 { font-size: 1.6rem; color: var(--navy); margin-bottom: 0.8rem; }
    .hd-bulunamadi p { color: var(--muted); margin-bottom: 1.6rem; }

    @media print {
        .hd-sidebar, .hd-araclar, .hd-breadcrumb, .hd-geri, header, footer { display: none !important; }
        .hd-layout { grid-template-columns: 1fr; }
    }

    @media (max-width: 900px) {
        .hd-layout { grid-template-columns: 1fr; }
        .hd-sidebar { position: static; }
    }
</style>

<section class="hd-bolumu page-content">
    <div class="container">
        <?php if ($hizmet): ?>

            <nav class="hd-breadcrumb">
                <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
                <span>/</span>
                <a href="<?php echo $basePath; ?>pages/hizmetler.php">Hizmetler</a>
                <span>/</span>
                <span><?php echo htmlspecialchars($hizmet['hizmet_adi']); ?></span>
            </nav>

            <div class="hd-ust-satir">
                <h1><?php echo htmlspecialchars($hizmet['hizmet_adi']); ?></h1>
                <div class="hd-araclar">
                    <button type="button" class="hd-arac-btn" id="hdFontKucult" title="Yazıyı küçült">A-</button>
                    <button type="button" class="hd-arac-btn is-active" id="hdFontNormal" title="Normal boyut">A</button>
                    <button type="button" class="hd-arac-btn" id="hdFontBuyut" title="Yazıyı büyüt">A+</button>
                    <button type="button" class="hd-arac-btn" id="hdYazdir" title="Yazdır"><i class="bi bi-printer"></i></button>
                </div>
            </div>

            <div class="hd-layout">
                <div>
                    <?php if (!empty($hizmet['gorsel'])): ?>
                        <img class="hd-gorsel" src="<?php echo $basePath . htmlspecialchars(ltrim($hizmet['gorsel'], '/')); ?>" alt="<?php echo htmlspecialchars($hizmet['hizmet_adi']); ?>">
                    <?php else: ?>
                        <div class="hd-gorsel-yok">GÖRSEL</div>
                    <?php endif; ?>

                    <div class="hd-icerik" id="hdIcerik">
                        <?php
                        $detayHtml = hzDetayHtml($hizmet['detay'] ?? '', $hizmet['link'] ?? null);
                        if ($detayHtml !== '') {
                            echo $detayHtml;
                        } else {
                            echo '<p class="hd-eksik-icerik">Bu hizmetle ilgili detay bilgisi henüz eklenmemiştir.</p>';
                        }
                        ?>
                    </div>

                    <a href="<?php echo $basePath; ?>pages/hizmetler.php" class="hd-geri">
                        <i class="bi bi-arrow-left"></i> Tüm Hizmetlere Dön
                    </a>
                </div>

                <aside class="hd-sidebar">
                    <div class="hd-kutu">
                        <h3>Hizmet Ara</h3>
                        <form class="hd-arama-kutu" action="<?php echo $basePath; ?>pages/hizmetler.php" method="get">
                            <input type="text" name="ara" placeholder="En az 2 karakter yazın...">
                            <button type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div>

                    <?php if (count($kardesler) > 1): ?>
                        <div class="hd-kutu">
                            <h3><?php echo htmlspecialchars($hizmet['mudurluk']); ?></h3>
                            <ul class="hd-kategori-liste">
                                <?php foreach ($kardesler as $k): ?>
                                    <li>
                                        <a href="<?php echo $basePath; ?>pages/hizmet-detay.php?id=<?php echo (int)$k['id']; ?>"
                                           class="<?php echo (int)$k['id'] === (int)$hizmet['id'] ? 'is-active' : ''; ?>">
                                            <?php echo htmlspecialchars($k['hizmet_adi']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="hd-kutu">
                        <h3>Bizi Takip Edin</h3>
                        <div class="hd-sosyal">
                            <a class="whatsapp" href="https://wa.me/902626420430" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                            <a class="facebook" href="https://www.facebook.com/gebzebelediye" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                            <a class="x" href="https://x.com/gebzebelediye" target="_blank" rel="noopener" aria-label="X"><i class="bi bi-twitter-x"></i></a>
                            <a class="instagram" href="https://www.instagram.com/gebze_belediyesi" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                            <a class="youtube" href="https://www.youtube.com" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </aside>
            </div>

        <?php else: ?>

            <div class="hd-bulunamadi">
                <h1>Hizmet Bulunamadı</h1>
                <p>Aradığınız hizmet kaldırılmış veya adres hatalı olabilir.</p>
                <a href="<?php echo $basePath; ?>pages/hizmetler.php" class="hd-geri">
                    <i class="bi bi-arrow-left"></i> Hizmetlere Dön
                </a>
            </div>

        <?php endif; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const icerik = document.getElementById('hdIcerik');
    const btnKucult = document.getElementById('hdFontKucult');
    const btnNormal = document.getElementById('hdFontNormal');
    const btnBuyut = document.getElementById('hdFontBuyut');
    const btnYazdir = document.getElementById('hdYazdir');
    const tumButonlar = [btnKucult, btnNormal, btnBuyut].filter(Boolean);

    const boyutlar = { kucuk: '0.88rem', normal: '0.98rem', buyuk: '1.12rem' };

    function boyutAyarla(hedefBtn, boyut) {
        if (!icerik) return;
        icerik.style.fontSize = boyut;
        tumButonlar.forEach(function (b) { b.classList.remove('is-active'); });
        if (hedefBtn) hedefBtn.classList.add('is-active');
    }

    if (btnKucult) btnKucult.addEventListener('click', function () { boyutAyarla(btnKucult, boyutlar.kucuk); });
    if (btnNormal) btnNormal.addEventListener('click', function () { boyutAyarla(btnNormal, boyutlar.normal); });
    if (btnBuyut) btnBuyut.addEventListener('click', function () { boyutAyarla(btnBuyut, boyutlar.buyuk); });
    if (btnYazdir) btnYazdir.addEventListener('click', function () { window.print(); });
});
</script>

<?php include '../includes/footer.php'; ?>