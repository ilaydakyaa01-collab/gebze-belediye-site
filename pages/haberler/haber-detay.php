<?php
/**
 * HABER DETAY SAYFASI
 * -------------------------------------------------------------
 * haberler.php'deki "Devamını Oku" / başlık linki buraya gelir:
 *   haber-detay.php?id=7
 *
 * Kapak görseli (haberler.resim), galeri (haber_galeri tablosu,
 * birden fazla foto) ve uzun açıklama metnini (haberler.detay,
 * baslik/tablo/liste destekli) gösterir.
 */

include '../../includes/db.php';
require_once '../../includes/init.php';

$basePath = '../../';
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

$haber = null;
$galeri = [];
$digerHaberler = [];

try {
    $stmt = $conn->prepare("SELECT * FROM haberler WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    $haber = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($haber) {
        $stmtG = $conn->prepare("SELECT * FROM haber_galeri WHERE haber_id = :id ORDER BY sira ASC, id ASC");
        $stmtG->execute([':id' => $haber['id']]);
        $galeri = $stmtG->fetchAll(PDO::FETCH_ASSOC);

        $stmtD = $conn->prepare("SELECT id, baslik, resim, tarih FROM haberler WHERE id != :id ORDER BY tarih DESC LIMIT 6");
        $stmtD->execute([':id' => $haber['id']]);
        $digerHaberler = $stmtD->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    $haber = null;
}

$pageTitle = $haber ? htmlspecialchars($haber['baslik']) . ' | Gebze Belediyesi' : 'Haber Bulunamadı | Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

/**
 * Ham "detay" metnini gruplandırılmış, okunabilir HTML'e çevirir
 * (etkinlik-detay.php / hizmet-detay.php'deki mantığın aynısı).
 */
function hbdLinkify($guvenliMetin)
{
    $desen = '/(https?:\/\/[^\s<]+)/i';
    return preg_replace_callback($desen, function ($eslesme) {
        $url = rtrim($eslesme[1], '.,);');
        $kirpik = trim($eslesme[1]) !== $url ? substr($eslesme[1], strlen($url)) : '';
        return '<a href="' . $url . '" target="_blank" rel="noopener" class="hd-link">' . $url . '</a>' . $kirpik;
    }, $guvenliMetin);
}

function hbdDetayHtml($ham)
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
            return '<strong>' . htmlspecialchars($etiket) . ':</strong> ' . hbdLinkify(htmlspecialchars($kalan));
        }
        return hbdLinkify(htmlspecialchars($metin));
    };

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
                $html .= '<ul class="hd-liste">' . "\n";
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

$extraCss = 'css/haberler/haber-detay.css';
include '../../includes/header.php';
?>

<section class="hd-bolumu page-content">
    <div class="container">
        <?php if ($haber): ?>

            <div class="hd-ana">
                <nav class="hd-breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
                    <span>/</span>
                    <a href="<?php echo $basePath; ?>pages/haberler/haberler.php">Haberler</a>
                    <span>/</span>
                    <span><?php echo htmlspecialchars($haber['baslik']); ?></span>
                </nav>

                <div class="hd-tarih">
                    <i class="bi bi-calendar-event"></i> <?php echo trTarih($haber['tarih']); ?>
                </div>
                <h1 class="hd-baslik"><?php echo htmlspecialchars($haber['baslik']); ?></h1>

                <?php if (!empty($haber['resim'])): ?>
                    <img class="hd-kapak" src="<?php echo $basePath . htmlspecialchars(ltrim($haber['resim'], '/')); ?>" alt="<?php echo htmlspecialchars($haber['baslik']); ?>">
                <?php else: ?>
                    <div class="hd-kapak-yok">GÖRSEL</div>
                <?php endif; ?>

                <?php if (count($galeri) > 0): ?>
                    <h2 class="hd-galeri-baslik">Fotoğraf Galerisi</h2>
                    <div class="hd-galeri" id="hdGaleri">
                        <?php foreach ($galeri as $g): ?>
                            <button type="button" class="hd-galeri-oge" data-buyuk="<?php echo $basePath . htmlspecialchars(ltrim($g['resim'], '/')); ?>">
                                <img src="<?php echo $basePath . htmlspecialchars(ltrim($g['resim'], '/')); ?>" alt="<?php echo htmlspecialchars($haber['baslik']); ?> galeri görseli" loading="lazy">
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="hd-icerik">
                    <?php
                    $detayHtml = hbdDetayHtml($haber['detay'] ?? '');
                    if ($detayHtml !== '') {
                        echo $detayHtml;
                    }
                    ?>
                </div>

                <a href="<?php echo $basePath; ?>pages/haberler/haberler.php" class="hd-geri">
                    <i class="bi bi-arrow-left"></i> Tüm Haberlere Dön
                </a>

                <?php if (count($digerHaberler) > 0): ?>
                    <h2 class="hd-diger-baslik">Diğer Haberler</h2>
                    <div class="hd-diger-grid">
                        <?php foreach ($digerHaberler as $d): ?>
                            <?php $dImg = !empty($d['resim']) ? $basePath . ltrim($d['resim'], '/') : $basePath . 'img/haberler/haber1.jpg'; ?>
                            <a class="hd-diger-kart" href="<?php echo $basePath; ?>pages/haberler/haber-detay.php?id=<?php echo (int)$d['id']; ?>">
                                <div class="hd-diger-gorsel">
                                    <img src="<?php echo htmlspecialchars($dImg); ?>" alt="<?php echo htmlspecialchars($d['baslik']); ?>" loading="lazy">
                                </div>
                                <div class="hd-diger-icerik">
                                    <h4><?php echo htmlspecialchars($d['baslik']); ?></h4>
                                    <span><?php echo trTarih($d['tarih']); ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php else: ?>

            <div class="hd-bulunamadi">
                <h1>Haber Bulunamadı</h1>
                <p>Aradığınız haber kaldırılmış veya adres hatalı olabilir.</p>
                <a href="<?php echo $basePath; ?>pages/haberler/haberler.php" class="hd-geri">
                    <i class="bi bi-arrow-left"></i> Haberlere Dön
                </a>
            </div>

        <?php endif; ?>
    </div>
</section>

<div class="hd-lightbox-arkaplan" id="hdLightbox" hidden>
    <button type="button" class="hd-lightbox-kapat" id="hdLightboxKapat"><i class="bi bi-x-lg"></i></button>
    <img class="hd-lightbox-img" id="hdLightboxImg" src="" alt="">
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.getElementById('hdLightbox');
    const lightboxImg = document.getElementById('hdLightboxImg');
    const lightboxKapat = document.getElementById('hdLightboxKapat');

    document.querySelectorAll('.hd-galeri-oge').forEach(function (btn) {
        btn.addEventListener('click', function () {
            lightboxImg.src = btn.dataset.buyuk;
            lightbox.hidden = false;
            document.body.style.overflow = 'hidden';
        });
    });

    function kapat() {
        lightbox.hidden = true;
        document.body.style.overflow = '';
    }
    if (lightboxKapat) lightboxKapat.addEventListener('click', kapat);
    if (lightbox) {
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) kapat();
        });
    }
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !lightbox.hidden) kapat();
    });
});
</script>

<?php include '../../includes/footer.php'; ?>