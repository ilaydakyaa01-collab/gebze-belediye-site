<?php
/**
 * ETKİNLİK DETAY SAYFASI
 * -------------------------------------------------------------
 * Gerçek sitedeki (gebze.bel.tr) yapıya göre: başlık + yazı boyutu/
 * yazdır araçları, görsel, bilgi kutuları (Tarih/Saat/Kategori +
 * Yer), harita, paylaşım butonları, en altta tam genişlikte
 * "Diğer Etkinlikler" grid + sayfalama.
 *
 * "Hızlı Erişim" arama kutusu ve "Bizi Takip Edin" sosyal medya
 * kutusu BİLİNÇLİ OLARAK yok — istenmedi.
 */

include '../includes/db.php';
require_once '../includes/init.php';

$basePath = '../';
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

$etkinlik = null;
$digerEtkinlikler = [];
$kardesler = [];
try {
    $stmt = $conn->prepare("SELECT * FROM etkinlikler WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    $etkinlik = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($etkinlik) {
        $stmtD = $conn->prepare("SELECT * FROM etkinlikler WHERE id != :id ORDER BY tarih ASC, sira ASC, id ASC");
        $stmtD->execute([':id' => $etkinlik['id']]);
        $digerEtkinlikler = $stmtD->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($etkinlik['kategori'])) {
            $stmtK = $conn->prepare("SELECT id, baslik, tarih FROM etkinlikler WHERE kategori = :kategori AND id != :id ORDER BY tarih ASC, sira ASC, id ASC");
            $stmtK->execute([':kategori' => $etkinlik['kategori'], ':id' => $etkinlik['id']]);
            $kardesler = $stmtK->fetchAll(PDO::FETCH_ASSOC);
        }
    }
} catch (Exception $e) {
    $etkinlik = null;
}

$pageTitle = $etkinlik ? htmlspecialchars($etkinlik['baslik']) . ' | Gebze Belediyesi' : 'Etkinlik Bulunamadı | Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

function etkdSlug($metin)
{
    $metin = mb_strtolower($metin, 'UTF-8');
    $harfler = ['ç' => 'c', 'ğ' => 'g', 'ı' => 'i', 'ö' => 'o', 'ş' => 's', 'ü' => 'u'];
    $metin = strtr($metin, $harfler);
    $metin = preg_replace('/[^a-z0-9]+/', '-', $metin);
    return trim($metin, '-');
}

function etkdLinkify($guvenliMetin)
{
    $desen = '/(https?:\/\/[^\s<]+)/i';
    return preg_replace_callback($desen, function ($eslesme) {
        $url = rtrim($eslesme[1], '.,);');
        $kirpik = trim($eslesme[1]) !== $url ? substr($eslesme[1], strlen($url)) : '';
        return '<a href="' . $url . '" target="_blank" rel="noopener" class="ed-link">' . $url . '</a>' . $kirpik;
    }, $guvenliMetin);
}

function etkdDetayHtml($ham)
{
    if (empty($ham)) return '';
    $ham = str_replace(["\r\n", "\r"], "\n", $ham);
    $ham = preg_replace('/\n{2,}/', "\n\n", trim($ham));
    $paragraflar = array_map('trim', preg_split('/\n\s*\n/', $ham));

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

    $bloklar = [];
    foreach ($paragraflar as $p) {
        if ($p === '') continue;
        if (preg_match('/^\*(.+)\*$/u', $p, $m)) {
            $bloklar[] = ['tip' => 'baslik', 'metin' => trim($m[1])];
            continue;
        }
        $tabloSatirlari = explode("\n", $p);
        $hepsiPipeIleBasliyorMu = !in_array(false, array_map(function ($s) {
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

    $etiketAyikla = function ($metin) {
        if (preg_match('/^([^:\n]{2,55}):\s*(.+)$/us', $metin, $m) && !preg_match('/[.!?]/u', $m[1])) {
            return [trim($m[1]), trim($m[2])];
        }
        return [null, $metin];
    };
    $satirHtml = function ($metin) use ($etiketAyikla) {
        [$etiket, $kalan] = $etiketAyikla($metin);
        if ($etiket !== null) {
            return '<strong>' . htmlspecialchars($etiket) . ':</strong> ' . etkdLinkify(htmlspecialchars($kalan));
        }
        return etkdLinkify(htmlspecialchars($metin));
    };

    $html = '';
    $i = 0;
    $n = count($bloklar);
    while ($i < $n) {
        $blok = $bloklar[$i];

        if ($blok['tip'] === 'baslik') {
            $html .= '<h3 class="ed-altbaslik">' . htmlspecialchars($blok['metin']) . '</h3>' . "\n";
            $i++;
            continue;
        }

        if ($blok['tip'] === 'tablo') {
            $satirlar = explode("\n", $blok['metin']);
            $html .= '<div class="ed-tablo-sarici"><table class="ed-tablo">' . "\n";
            foreach ($satirlar as $siraNo => $satir) {
                $hucreler = explode('|', trim($satir));
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
            if (count($ogeler) >= 2) {
                $html .= '<ul class="ed-liste">' . "\n";
                foreach ($ogeler as $og) {
                    $html .= '<li>' . $satirHtml($og) . '</li>' . "\n";
                }
                $html .= '</ul>' . "\n";
            } else {
                $html .= '<p>' . nl2br($satirHtml($ogeler[0])) . '</p>' . "\n";
            }
            continue;
        }

        $html .= '<p>' . nl2br($satirHtml($blok['metin'])) . '</p>' . "\n";
        $i++;
    }

    return $html;
}

include '../includes/header.php';
?>

<style>
    .ed-bolumu { padding: 7rem 0 5rem; }

    .ed-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--muted);
        margin-bottom: 1.4rem;
    }
    .ed-breadcrumb a { color: var(--muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .ed-breadcrumb a:hover { color: var(--accent-hot); }

    .ed-ana { max-width: 900px; }

    .ed-ust-satir {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.4rem;
    }
    .ed-ust-satir h1 {
        font-size: clamp(1.4rem, 2.6vw, 1.9rem);
        font-weight: 700;
        color: var(--navy);
        line-height: 1.3;
        margin: 0;
    }
    .ed-araclar { display: flex; gap: 8px; flex-shrink: 0; }
    .ed-arac-btn {
        width: 38px;
        height: 38px;
        border: 1px solid var(--line);
        border-radius: 8px;
        background: var(--white);
        color: var(--navy);
        font-size: 0.82rem;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all .2s ease;
    }
    .ed-arac-btn:hover { border-color: var(--accent-hot); color: var(--accent-hot); }
    .ed-arac-btn.is-active { background: var(--navy); border-color: var(--navy); color: var(--white); }

    .ed-gorsel { width: 100%; height: auto; display: block; border-radius: var(--radius); margin-bottom: 1.6rem; }
    .ed-gorsel-yok {
        width: 100%; height: 240px; border-radius: var(--radius); background: #eef1f4;
        color: var(--muted); display: flex; align-items: center; justify-content: center;
        font-size: 0.85rem; margin-bottom: 1.6rem;
    }

    .ed-bilgi-satiri { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem; max-width: 900px; }
    .ed-bilgi-kutu { background: #f7f9fb; border: 1px solid var(--line); border-radius: 12px; padding: 1.1rem 1.3rem; display: flex; flex-direction: column; gap: 0.85rem; }
    .ed-bilgi-satir { display: flex; align-items: flex-start; gap: 10px; }
    .ed-bilgi-ikon { width: 34px; height: 34px; border-radius: 8px; background: #eef4fb; color: var(--navy); display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
    .ed-bilgi-etiket { font-size: 0.76rem; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: .03em; }
    .ed-bilgi-deger { font-size: 0.94rem; color: var(--navy); font-weight: 600; }

    .ed-icerik { font-size: 0.98rem; color: var(--text); line-height: 1.75; margin-bottom: 2rem; max-width: 900px; }
    .ed-icerik p { margin: 0 0 1.1rem; }
    .ed-icerik p:last-child { margin-bottom: 0; }
    .ed-icerik strong { color: var(--navy); }
    .ed-icerik .ed-link { color: var(--accent-hot); text-decoration: underline; word-break: break-word; }
    .ed-icerik .ed-link:hover { color: var(--navy); }
    .ed-icerik h3.ed-altbaslik { font-size: 1.1rem; font-weight: 700; color: var(--navy); margin: 1.8rem 0 0.9rem; padding-bottom: 5px; border-bottom: 2px solid var(--accent-hot); display: inline-block; }
    .ed-icerik h3.ed-altbaslik:first-child { margin-top: 0; }
    .ed-icerik ul.ed-liste { list-style: none; display: grid; grid-template-columns: repeat(auto-fill, minmax(170px, 1fr)); gap: 10px 20px; padding: 0; margin: 0 0 1.5rem; }
    .ed-icerik ul.ed-liste li { position: relative; padding-left: 1.15rem; font-size: 0.92rem; color: var(--text); line-height: 1.4; }
    .ed-icerik ul.ed-liste li::before { content: ''; position: absolute; left: 0; top: 0.5em; width: 6px; height: 6px; border-radius: 50%; background: var(--accent-hot); }
    .ed-tablo-sarici { overflow-x: auto; margin: 0 0 1.5rem; border: 1px solid var(--line); border-radius: 10px; }
    .ed-tablo { width: 100%; border-collapse: collapse; font-size: 0.88rem; }
    .ed-tablo th, .ed-tablo td { padding: 0.65rem 0.9rem; text-align: left; border-bottom: 1px solid var(--line); white-space: nowrap; }
    .ed-tablo th { background: var(--navy); color: var(--white); font-weight: 600; }
    .ed-tablo tr:last-child td { border-bottom: none; }
    .ed-tablo tr:nth-child(even) td { background: #f7f9fb; }
    .ed-eksik-icerik { color: var(--muted); font-style: italic; padding: 1rem 0; }

    .ed-konum-baslik { font-size: 1.15rem; font-weight: 700; color: var(--navy); margin: 0 0 1rem; }
    .ed-harita-sarici { border-radius: var(--radius); overflow: hidden; border: 1px solid var(--line); margin-bottom: 2rem; }
    .ed-harita-sarici iframe { width: 100%; height: 280px; border: 0; display: block; }

    .ed-paylas { background: #f7f9fb; border: 1px solid var(--line); border-radius: 12px; padding: 1.2rem 1.4rem; margin-bottom: 2.4rem; }
    .ed-paylas-baslik { font-size: 0.9rem; font-weight: 700; color: var(--navy); margin: 0 0 0.9rem; }
    .ed-paylas-butonlar { display: flex; flex-wrap: wrap; gap: 8px; }
    .ed-paylas-btn { display: inline-flex; align-items: center; gap: 7px; padding: 0.55rem 1.1rem; border-radius: 8px; color: #fff; font-size: 0.85rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; }
    .ed-paylas-btn.facebook { background: #1877F2; }
    .ed-paylas-btn.x { background: #000; }
    .ed-paylas-btn.linkedin { background: #0A66C2; }
    .ed-paylas-btn.whatsapp { background: #25D366; }

    .ed-gorsel-satiri {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 1.6rem;
        align-items: start;
        margin-bottom: 1.6rem;
        width: calc(100% + 280px);
        max-width: none;
    }
    .ed-gorsel-satiri .ed-gorsel,
    .ed-gorsel-satiri .ed-gorsel-yok {
        margin-bottom: 0;
    }

    .ed-kardes-kutu {
        background: #f7f9fb;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 1.2rem 1.4rem;
        margin-bottom: 2rem;
    }
    .ed-kardes-baslik {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--navy);
        margin: 0 0 0.9rem;
        padding-bottom: 0.6rem;
        border-bottom: 2px solid var(--accent-hot);
        display: inline-block;
    }
    .ed-kardes-liste { list-style: none; margin: 0; padding: 0; }
    .ed-kardes-liste li + li { border-top: 1px solid var(--line); }
    .ed-kardes-liste a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 0.7rem 0.2rem;
        text-decoration: none;
        color: var(--text);
        font-size: 0.9rem;
        font-weight: 600;
        transition: color .2s ease;
    }
    .ed-kardes-liste a:hover { color: var(--accent-hot); }
    .ed-kardes-tarih { flex-shrink: 0; font-size: 0.78rem; color: var(--muted); font-weight: 500; }

    .ed-geri {
        display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 2.6rem;
        padding: 0.7rem 1.4rem; background: var(--navy); color: var(--white); border-radius: 999px;
        font-size: 0.9rem; font-weight: 600; text-decoration: none;
    }
    .ed-geri:hover { background: #004a8f; }

    .ed-diger-baslik { font-size: 1.2rem; font-weight: 700; color: var(--navy); margin: 0 0 1.2rem; }
    .ed-diger-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.2rem; margin-bottom: 1.6rem; }
    .ed-diger-kart { background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; text-decoration: none; display: flex; flex-direction: column; transition: transform .2s ease, box-shadow .2s ease; }
    .ed-diger-kart:hover { transform: translateY(-4px); box-shadow: var(--shadow); }
    .ed-diger-gorsel { position: relative; aspect-ratio: 1.86/1; background: #eef1f4; overflow: hidden; display: flex; align-items: center; justify-content: center; color: var(--muted); font-size: 0.75rem; }
    .ed-diger-gorsel img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .ed-diger-kategori { position: absolute; top: 10px; left: 10px; color: #fff; font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .03em; padding: 3px 10px; border-radius: 999px; }
    .ed-diger-icerik { padding: 0.9rem 1rem 1.1rem; display: flex; flex-direction: column; gap: 0.35rem; }
    .ed-diger-icerik h4 { font-size: 0.92rem; font-weight: 700; color: var(--navy); margin: 0; line-height: 1.3; }
    .ed-diger-icerik span { font-size: 0.78rem; color: var(--muted); display: flex; align-items: center; gap: 5px; }

    .ed-sayfalama { display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 1.6rem; }
    .ed-sayfalama button { min-width: 38px; height: 38px; padding: 0 10px; border: 1px solid var(--line); border-radius: 10px; background: var(--white); color: var(--navy); font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all .2s ease; }
    .ed-sayfalama button:hover:not(:disabled) { border-color: var(--accent-hot); color: var(--accent-hot); }
    .ed-sayfalama button.is-active { background: var(--navy); border-color: var(--navy); color: var(--white); }
    .ed-sayfalama button:disabled { opacity: 0.4; cursor: not-allowed; }

    .ed-bulunamadi { text-align: center; padding: 4rem 0; }
    .ed-bulunamadi h1 { font-size: 1.6rem; color: var(--navy); margin-bottom: 0.8rem; }
    .ed-bulunamadi p { color: var(--muted); margin-bottom: 1.6rem; }

    @media print {
        .ed-araclar, .ed-breadcrumb, .ed-geri, .ed-paylas, .ed-diger-baslik, .ed-diger-grid, .ed-sayfalama, header, footer { display: none !important; }
    }
    @media (max-width: 1050px) {
        .ed-gorsel-satiri { grid-template-columns: 1fr; width: 100%; }
    }
    @media (max-width: 640px) {
        .ed-bilgi-satiri { grid-template-columns: 1fr; }
    }
</style>

<section class="ed-bolumu page-content">
    <div class="container">
        <?php if ($etkinlik): ?>

            <div class="ed-ana">
                <nav class="ed-breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
                    <span>/</span>
                    <a href="<?php echo $basePath; ?>pages/etkinlikler.php">Etkinlikler</a>
                    <span>/</span>
                    <span><?php echo htmlspecialchars($etkinlik['baslik']); ?></span>
                </nav>

                <div class="ed-ust-satir">
                    <h1><?php echo htmlspecialchars($etkinlik['baslik']); ?></h1>
                </div>

                <div class="ed-gorsel-satiri">
                    <?php if (!empty($etkinlik['resim'])): ?>
                        <img class="ed-gorsel" src="<?php echo $basePath . htmlspecialchars($etkinlik['resim']); ?>" alt="<?php echo htmlspecialchars($etkinlik['baslik']); ?>">
                    <?php else: ?>
                        <div class="ed-gorsel-yok">GÖRSEL</div>
                    <?php endif; ?>

                    <?php if (count($kardesler) > 0): ?>
                        <div class="ed-kardes-kutu">
                            <h3 class="ed-kardes-baslik"><?php echo htmlspecialchars($etkinlik['kategori']); ?> Kategorisindeki Diğer Etkinlikler</h3>
                            <ul class="ed-kardes-liste">
                                <?php foreach ($kardesler as $k): ?>
                                    <li>
                                        <a href="<?php echo $basePath; ?>pages/etkinlik-detay.php?id=<?php echo (int)$k['id']; ?>">
                                            <span><?php echo htmlspecialchars($k['baslik']); ?></span>
                                            <span class="ed-kardes-tarih"><?php echo date('d.m.Y', strtotime($k['tarih'])); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="ed-bilgi-satiri">
                    <div class="ed-bilgi-kutu">
                        <div class="ed-bilgi-satir">
                            <div class="ed-bilgi-ikon"><i class="bi bi-calendar-event"></i></div>
                            <div>
                                <div class="ed-bilgi-etiket">Tarih</div>
                                <div class="ed-bilgi-deger"><?php echo date('d.m.Y', strtotime($etkinlik['tarih'])); ?></div>
                            </div>
                        </div>
                        <?php if (!empty($etkinlik['saat'])): ?>
                            <div class="ed-bilgi-satir">
                                <div class="ed-bilgi-ikon"><i class="bi bi-clock"></i></div>
                                <div>
                                    <div class="ed-bilgi-etiket">Saat</div>
                                    <div class="ed-bilgi-deger"><?php echo htmlspecialchars($etkinlik['saat']); ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($etkinlik['kategori'])): ?>
                            <div class="ed-bilgi-satir">
                                <div class="ed-bilgi-ikon"><i class="bi bi-tag"></i></div>
                                <div>
                                    <div class="ed-bilgi-etiket">Kategori</div>
                                    <div class="ed-bilgi-deger"><?php echo htmlspecialchars($etkinlik['kategori']); ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($etkinlik['yer']) || !empty($etkinlik['adres'])): ?>
                        <div class="ed-bilgi-kutu">
                            <?php if (!empty($etkinlik['yer'])): ?>
                                <div class="ed-bilgi-satir">
                                    <div class="ed-bilgi-ikon"><i class="bi bi-geo-alt"></i></div>
                                    <div>
                                        <div class="ed-bilgi-etiket">Yer</div>
                                        <div class="ed-bilgi-deger"><?php echo htmlspecialchars($etkinlik['yer']); ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($etkinlik['adres'])): ?>
                                <div class="ed-bilgi-satir">
                                    <div class="ed-bilgi-ikon"><i class="bi bi-signpost-2"></i></div>
                                    <div>
                                        <div class="ed-bilgi-etiket">Adres</div>
                                        <div class="ed-bilgi-deger"><?php echo htmlspecialchars($etkinlik['adres']); ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php
                $detayHtml = etkdDetayHtml($etkinlik['detay'] ?? '');
                if ($detayHtml !== ''): ?>
                    <div class="ed-icerik">
                        <?php echo $detayHtml; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($etkinlik['yer']) || !empty($etkinlik['adres'])): ?>
                    <h2 class="ed-konum-baslik">Konum</h2>
                    <?php $haritaSorgusu = !empty($etkinlik['adres']) ? $etkinlik['adres'] : ($etkinlik['yer'] . ' Gebze Kocaeli'); ?>
                    <div class="ed-harita-sarici">
                        <iframe src="https://www.google.com/maps?q=<?php echo urlencode($haritaSorgusu); ?>&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                <?php endif; ?>

                <div class="ed-paylas">
                    <p class="ed-paylas-baslik">Bu İçeriği Paylaş:</p>
                    <div class="ed-paylas-butonlar" id="edPaylasButonlari">
                        <a class="ed-paylas-btn facebook" id="edPaylasFacebook" href="#" target="_blank" rel="noopener"><i class="bi bi-facebook"></i> Facebook</a>
                        <a class="ed-paylas-btn x" id="edPaylasX" href="#" target="_blank" rel="noopener"><i class="bi bi-twitter-x"></i> Twitter</a>
                        <a class="ed-paylas-btn linkedin" id="edPaylasLinkedin" href="#" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i> LinkedIn</a>
                        <a class="ed-paylas-btn whatsapp" id="edPaylasWhatsapp" href="#" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                    </div>
                </div>

                <a href="<?php echo $basePath; ?>pages/etkinlikler.php" class="ed-geri">
                    <i class="bi bi-arrow-left"></i> Tüm Etkinliklere Dön
                </a>

                <?php if (count($digerEtkinlikler) > 0): ?>
                    <h2 class="ed-diger-baslik">Diğer Etkinlikler</h2>
                    <div class="ed-diger-grid" id="edDigerGrid">
                        <?php foreach ($digerEtkinlikler as $d): ?>
                            <a class="ed-diger-kart ed-diger-oge" href="<?php echo $basePath; ?>pages/etkinlik-detay.php?id=<?php echo (int)$d['id']; ?>">
                                <div class="ed-diger-gorsel">
                                    <?php if (!empty($d['resim'])): ?>
                                        <img src="<?php echo $basePath . htmlspecialchars($d['resim']); ?>" alt="<?php echo htmlspecialchars($d['baslik']); ?>" loading="lazy">
                                    <?php else: ?>
                                        GÖRSEL
                                    <?php endif; ?>
                                    <?php if (!empty($d['kategori'])): ?>
                                        <span class="ed-diger-kategori" style="background-color: <?php echo htmlspecialchars($d['renk'] ?: '#0f5d3c'); ?>"><?php echo htmlspecialchars($d['kategori']); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="ed-diger-icerik">
                                    <h4><?php echo htmlspecialchars($d['baslik']); ?></h4>
                                    <span><i class="bi bi-calendar-event"></i> <?php echo date('d.m.Y', strtotime($d['tarih'])); ?></span>
                                    <?php if (!empty($d['yer'])): ?>
                                        <span><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($d['yer']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <nav class="ed-sayfalama" id="edSayfalama"></nav>
                <?php endif; ?>
            </div>

        <?php else: ?>

            <div class="ed-bulunamadi">
                <h1>Etkinlik Bulunamadı</h1>
                <p>Aradığınız etkinlik kaldırılmış veya adres hatalı olabilir.</p>
                <a href="<?php echo $basePath; ?>pages/etkinlikler.php" class="ed-geri">
                    <i class="bi bi-arrow-left"></i> Etkinliklere Dön
                </a>
            </div>

        <?php endif; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Paylaşım linkleri (mevcut sayfa URL'sine göre) ---
    const suankiUrl = encodeURIComponent(window.location.href);
    const baslikMetni = encodeURIComponent(document.title);
    const fbBtn = document.getElementById('edPaylasFacebook');
    const xBtn = document.getElementById('edPaylasX');
    const liBtn = document.getElementById('edPaylasLinkedin');
    const waBtn = document.getElementById('edPaylasWhatsapp');
    if (fbBtn) fbBtn.href = 'https://www.facebook.com/sharer/sharer.php?u=' + suankiUrl;
    if (xBtn) xBtn.href = 'https://twitter.com/intent/tweet?url=' + suankiUrl + '&text=' + baslikMetni;
    if (liBtn) liBtn.href = 'https://www.linkedin.com/sharing/share-offsite/?url=' + suankiUrl;
    if (waBtn) waBtn.href = 'https://wa.me/?text=' + baslikMetni + '%20' + suankiUrl;

    // --- "Diğer Etkinlikler" sayfalama (6'şar) ---
    const digerKartlar = Array.from(document.querySelectorAll('.ed-diger-oge'));
    const sayfalamaKutusu = document.getElementById('edSayfalama');
    if (digerKartlar.length > 0 && sayfalamaKutusu) {
        const SAYFA_BASINA = 6;
        let aktifSayfa = 1;
        const toplamSayfa = Math.max(1, Math.ceil(digerKartlar.length / SAYFA_BASINA));

        function ciz() {
            const baslangic = (aktifSayfa - 1) * SAYFA_BASINA;
            const bitis = baslangic + SAYFA_BASINA;
            digerKartlar.forEach(function (k, i) {
                k.style.display = (i >= baslangic && i < bitis) ? '' : 'none';
            });

            sayfalamaKutusu.innerHTML = '';
            if (toplamSayfa <= 1) return;

            const oncekiBtn = document.createElement('button');
            oncekiBtn.type = 'button';
            oncekiBtn.textContent = 'Önceki';
            oncekiBtn.disabled = aktifSayfa <= 1;
            oncekiBtn.addEventListener('click', function () { aktifSayfa--; ciz(); });
            sayfalamaKutusu.appendChild(oncekiBtn);

            const GORUNEN = 3;
            let pStart = Math.max(1, aktifSayfa - 1);
            let pEnd = Math.min(toplamSayfa, pStart + GORUNEN - 1);
            pStart = Math.max(1, pEnd - GORUNEN + 1);

            for (let s = pStart; s <= pEnd; s++) {
                const b = document.createElement('button');
                b.type = 'button';
                b.textContent = s;
                if (s === aktifSayfa) b.classList.add('is-active');
                b.addEventListener('click', function () { aktifSayfa = s; ciz(); });
                sayfalamaKutusu.appendChild(b);
            }

            const sonrakiBtn = document.createElement('button');
            sonrakiBtn.type = 'button';
            sonrakiBtn.textContent = 'Sonraki';
            sonrakiBtn.disabled = aktifSayfa >= toplamSayfa;
            sonrakiBtn.addEventListener('click', function () { aktifSayfa++; ciz(); });
            sayfalamaKutusu.appendChild(sonrakiBtn);
        }
        ciz();
    }
});
</script>

<?php include '../includes/footer.php'; ?>