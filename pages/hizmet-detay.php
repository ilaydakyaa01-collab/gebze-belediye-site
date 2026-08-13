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
$dokumanlar = [];
try {
    $stmt = $conn->prepare("SELECT * FROM hizmet_listesi WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    $hizmet = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($hizmet) {
        $stmtK = $conn->prepare("SELECT id, hizmet_adi FROM hizmet_listesi WHERE mudurluk = :mudurluk ORDER BY sira ASC, hizmet_adi ASC");
        $stmtK->execute([':mudurluk' => $hizmet['mudurluk']]);
        $kardesler = $stmtK->fetchAll(PDO::FETCH_ASSOC);

        // hizmet_dokumanlari tablosu henüz oluşturulmamışsa sayfa
        // yine de çalışmaya devam etsin diye ayrı try/catch içinde.
        try {
            $stmtD = $conn->prepare("SELECT * FROM hizmet_dokumanlari WHERE hizmet_id = :hizmet_id ORDER BY sira ASC, id ASC");
            $stmtD->execute([':hizmet_id' => $hizmet['id']]);
            $dokumanlar = $stmtD->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $dokumanlar = [];
        }
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
/**
 * Ham "detay" metnini gruplandırılmış, okunabilir HTML'e çevirir:
 *  - "*Başlık*" gibi yıldız içine alınmış tek satırlık paragraflar
 *    gerçek bir alt başlığa (<h3>) dönüştürülür.
 *  - Art arda gelen kısa satırlar (ör. ders/atölye isimleri) tek tek
 *    paragraf yerine düzenli bir ızgara listesine (<ul class="hd-liste">)
 *    dönüştürülür.
 *  - Diğer her şey normal paragraf olarak kalır.
 */
/**
 * Bir metin "Etiket: açıklama" kalıbına uyuyorsa [etiket, açıklama]
 * döner, uymuyorsa [null, orijinal metin] döner.
 * "Etiket" kısmı cümle noktalaması içermemeli (yani gerçek bir cümle
 * değil, kısa bir başlık/terim olmalı).
 */
function hzEtiketAyikla($metin)
{
    if (preg_match('/^([^:\n]{2,55}):\s*(.+)$/us', $metin, $m) && !preg_match('/[.!?]/u', $m[1])) {
        return [trim($m[1]), trim($m[2])];
    }
    return [null, $metin];
}

/**
 * "Etiket: açıklama" metnini güvenli, kalın etiketli HTML'e çevirir.
 */
function hzSatirHtml($metin)
{
    [$etiket, $kalan] = hzEtiketAyikla($metin);
    if ($etiket !== null) {
        return '<strong>' . htmlspecialchars($etiket) . ':</strong> ' . hzLinkify(htmlspecialchars($kalan));
    }
    return hzLinkify(htmlspecialchars($metin));
}

function hzDetayHtml($ham, $ctaLink = null)
{
    if (empty($ham)) return '';
    $ham = str_replace(["\r\n", "\r"], "\n", $ham);
    $ham = preg_replace('/\n{2,}/', "\n\n", trim($ham));
    $paragraflar = array_map('trim', preg_split('/\n\s*\n/', $ham));

    // 0) Ön geçiş: "Etiket" satırının hemen ardından tek başına
    //    "(açıklama)" satırı geliyorsa, ikisini "Etiket: açıklama"
    //    şeklinde tek paragrafta birleştir. Böylece örn.
    //    "Manevi Danışmanlık" + "(Değerler Eğitimi)" satırları
    //    "Manevi Danışmanlık: Değerler Eğitimi" olur.
    $birlesmis = [];
    $i = 0;
    $n = count($paragraflar);
    while ($i < $n) {
        $mevcut = $paragraflar[$i];
        if ($mevcut === '') { $i++; continue; }
        $sonraki = ($i + 1 < $n) ? $paragraflar[$i + 1] : '';
        $baslikMi = (bool)preg_match('/^\*(.+)\*$/u', $mevcut);
        if (!$baslikMi && $sonraki !== '' && preg_match('/^\((.+)\)$/u', $sonraki, $m2)) {
            $birlesmis[] = rtrim($mevcut, ': ') . ': ' . trim($m2[1]);
            $i += 2;
        } else {
            $birlesmis[] = $mevcut;
            $i++;
        }
    }
    $paragraflar = $birlesmis;

    // 1) Her paragrafı sınıflandır: baslik / tablo / liste / paragraf
    $bloklar = [];
    foreach ($paragraflar as $p) {
        if ($p === '') continue;

        if (preg_match('/^\*(.+)\*$/u', $p, $m)) {
            $bloklar[] = ['tip' => 'baslik', 'metin' => trim($m[1])];
            continue;
        }

        // Her satırı '|' ile başlayan bir blok = tablo
        $tabloSatirlari = explode("\n", $p);
        $hepsiPipeIleBasliyorMu = count($tabloSatirlari) >= 1 && !in_array(false, array_map(function ($s) {
            return strpos(trim($s), '|') === 0;
        }, $tabloSatirlari));
        if ($hepsiPipeIleBasliyorMu) {
            $bloklar[] = ['tip' => 'tablo', 'metin' => $p];
            continue;
        }

        $satirIciCokMu = strpos($p, "\n") !== false;
        $noktalamaIleBitiyorMu = (bool)preg_match('/[.!?:]\s*$/u', $p);
        $kisaMi = !$satirIciCokMu && !$noktalamaIleBitiyorMu && mb_strlen($p, 'UTF-8') <= 55;

        $bloklar[] = ['tip' => $kisaMi ? 'liste' : 'paragraf', 'metin' => $p];
    }

    // 2) Ardışık "liste" bloklarını tek bir <ul>'da grupla, HTML üret
    $html = '';
    $i = 0;
    $n = count($bloklar);
    while ($i < $n) {
        $blok = $bloklar[$i];

        if ($blok['tip'] === 'baslik') {
            $html .= '<h3 class="hd-altbaslik">' . htmlspecialchars($blok['metin']) . '</h3>' . "\n";
            $i++;
            continue;
        }

        if ($blok['tip'] === 'tablo') {
            $satirlar = explode("\n", $blok['metin']);
            $html .= '<div class="hd-tablo-sarici"><table class="hd-tablo">' . "\n";
            foreach ($satirlar as $siraNo => $satir) {
                $hucreler = explode('|', trim($satir));
                // Baştaki/sondaki boş hücreleri at (satır '|a|b|' şeklinde başlayıp bitiyorsa)
                if (count($hucreler) > 0 && trim($hucreler[0]) === '') array_shift($hucreler);
                if (count($hucreler) > 0 && trim(end($hucreler)) === '') array_pop($hucreler);

                $etiketAdi = $siraNo === 0 ? 'th' : 'td';
                $html .= '<tr>';
                foreach ($hucreler as $hucre) {
                    $html .= '<' . $etiketAdi . '>' . htmlspecialchars(trim($hucre)) . '</' . $etiketAdi . '>';
                }
                $html .= '</tr>' . "\n";
            }
            $html .= '</table></div>' . "\n";
            $i++;
            continue;
        }

        if ($blok['tip'] === 'liste') {
            $ogeler = [];
            while ($i < $n && $bloklar[$i]['tip'] === 'liste') {
                $ogeler[] = $bloklar[$i]['metin'];
                $i++;
            }
            // En az 2 ardışık kısa satır varsa liste olarak grupla;
            // tek başınaysa normal paragraf gibi göster.
            if (count($ogeler) >= 2) {
                $html .= '<ul class="hd-liste">' . "\n";
                foreach ($ogeler as $og) {
                    $html .= '<li>' . hzSatirHtml($og) . '</li>' . "\n";
                }
                $html .= '</ul>' . "\n";
            } else {
                [$etiket, $kalan] = hzEtiketAyikla($ogeler[0]);
                if ($etiket !== null) {
                    $guvenli = '<strong>' . htmlspecialchars($etiket) . ':</strong> ' . nl2br(hzLinkify(htmlspecialchars($kalan)));
                } else {
                    $guvenli = nl2br(htmlspecialchars($ogeler[0]));
                    $guvenli = hzLinkify($guvenli);
                }
                $guvenli = hzTiklayinizLinkify($guvenli, $ctaLink);
                $html .= '<p>' . $guvenli . '</p>' . "\n";
            }
            continue;
        }

        // normal paragraf
        [$etiket, $kalan] = hzEtiketAyikla($blok['metin']);
        if ($etiket !== null) {
            $guvenli = '<strong>' . htmlspecialchars($etiket) . ':</strong> ' . nl2br(hzLinkify(htmlspecialchars($kalan)));
        } else {
            $guvenli = nl2br(htmlspecialchars($blok['metin']));
            $guvenli = hzLinkify($guvenli);
        }
        $guvenli = hzTiklayinizLinkify($guvenli, $ctaLink);
        $html .= '<p>' . $guvenli . '</p>' . "\n";
        $i++;
    }

    return $html;
}

/**

 * Dosya uzantısına göre uygun Bootstrap Icons sınıfını döner.
 */
function hzDosyaIkonu($dosyaYolu)
{
    $uzanti = strtolower(pathinfo($dosyaYolu, PATHINFO_EXTENSION));
    $eslesme = [
        'pdf'  => 'bi-filetype-pdf',
        'doc'  => 'bi-filetype-doc',
        'docx' => 'bi-filetype-docx',
        'xls'  => 'bi-filetype-xls',
        'xlsx' => 'bi-filetype-xlsx',
        'ppt'  => 'bi-filetype-ppt',
        'pptx' => 'bi-filetype-pptx',
        'zip'  => 'bi-file-earmark-zip',
        'jpg'  => 'bi-filetype-jpg',
        'jpeg' => 'bi-filetype-jpg',
        'png'  => 'bi-filetype-png',
    ];
    return $eslesme[$uzanti] ?? 'bi-file-earmark';
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
    .hd-icerik strong { color: var(--navy); }

    .hd-tablo-sarici { overflow-x: auto; margin: 0 0 1.5rem; border: 1px solid var(--line); border-radius: 10px; }
    .hd-tablo { width: 100%; border-collapse: collapse; font-size: 0.88rem; }
    .hd-tablo th, .hd-tablo td { padding: 0.65rem 0.9rem; text-align: left; border-bottom: 1px solid var(--line); white-space: nowrap; }
    .hd-tablo th { background: var(--navy); color: var(--white); font-weight: 600; }
    .hd-tablo tr:last-child td { border-bottom: none; }
    .hd-tablo tr:nth-child(even) td { background: #f7f9fb; }
    .hd-icerik p:last-child { margin-bottom: 0; }
    .hd-icerik .hd-link { color: var(--accent-hot); text-decoration: underline; word-break: break-word; }
    .hd-icerik .hd-link:hover { color: var(--navy); }
    .hd-icerik .hd-cta-link { font-weight: 700; text-transform: uppercase; }

    .hd-icerik h3.hd-altbaslik {
        font-size: 1.12rem;
        font-weight: 700;
        color: var(--navy);
        margin: 2rem 0 0.9rem;
        padding-bottom: 5px;
        border-bottom: 2px solid var(--accent-hot);
        display: inline-block;
    }
    .hd-icerik h3.hd-altbaslik:first-child { margin-top: 0; }

    .hd-icerik ul.hd-liste {
        list-style: none;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
        gap: 10px 20px;
        padding: 0;
        margin: 0 0 1.5rem;
    }
    .hd-icerik ul.hd-liste li {
        position: relative;
        padding-left: 1.15rem;
        font-size: 0.92rem;
        color: var(--text);
        line-height: 1.4;
    }
    .hd-icerik ul.hd-liste li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.5em;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--accent-hot);
    }

    .hd-dokumanlar { margin-top: 2.2rem; }
    .hd-dokumanlar-baslik {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--navy);
        margin: 0 0 1rem;
        padding-bottom: 0.6rem;
        border-bottom: 1px solid var(--line);
    }
    .hd-dokumanlar-liste { display: flex; flex-direction: column; gap: 10px; }
    .hd-dokuman-kart {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        padding: 0.9rem 1.1rem;
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: 10px;
        text-decoration: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }
    .hd-dokuman-kart:hover { border-color: var(--navy); box-shadow: var(--shadow); }
    .hd-dokuman-ikon { font-size: 1.6rem; color: var(--navy); flex-shrink: 0; width: 32px; text-align: center; }
    .hd-dokuman-metin { display: flex; flex-direction: column; gap: 2px; flex: 1; min-width: 0; }
    .hd-dokuman-ad { font-size: 0.95rem; font-weight: 600; color: var(--text); }
    .hd-dokuman-boyut { font-size: 0.78rem; color: var(--muted); text-transform: uppercase; letter-spacing: .03em; }
    .hd-dokuman-indir { font-size: 1.1rem; color: var(--muted); flex-shrink: 0; }
    .hd-dokuman-kart:hover .hd-dokuman-indir { color: var(--accent-hot); }

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

                    <?php if (count($dokumanlar) > 0): ?>
                        <div class="hd-dokumanlar">
                            <h2 class="hd-dokumanlar-baslik">İndirilebilir Dökümanlar</h2>
                            <div class="hd-dokumanlar-liste">
                                <?php foreach ($dokumanlar as $dok): ?>
                                    <a class="hd-dokuman-kart" href="<?php echo $basePath . htmlspecialchars(ltrim($dok['dosya_yolu'], '/')); ?>" download>
                                        <div class="hd-dokuman-ikon"><i class="bi <?php echo hzDosyaIkonu($dok['dosya_yolu']); ?>"></i></div>
                                        <div class="hd-dokuman-metin">
                                            <span class="hd-dokuman-ad"><?php echo htmlspecialchars($dok['dosya_adi']); ?></span>
                                            <?php if (!empty($dok['dosya_boyutu'])): ?>
                                                <span class="hd-dokuman-boyut"><?php echo strtoupper(pathinfo($dok['dosya_yolu'], PATHINFO_EXTENSION)); ?>, <?php echo htmlspecialchars($dok['dosya_boyutu']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <i class="bi bi-download hd-dokuman-indir"></i>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

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