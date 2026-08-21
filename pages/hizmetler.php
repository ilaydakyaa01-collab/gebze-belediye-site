<?php
/**
 * HİZMETLER SAYFASI
 * -------------------------------------------------------------
 * Veriler hizmet_listesi tablosundan çekilir.
 * Kategoriler = hizmet_listesi.mudurluk sütunundaki farklı değerler.
 * Düzen: üstte breadcrumb + başlık + arama, altta içerik (solda kart
 * grid'i, sağda kategori sidebar'ı) — "Eski Başkanlar" sayfasıyla
 * aynı üst düzen mantığı.
 */

include '../includes/db.php';
require_once '../includes/init.php';

$basePath = '../';
$pageTitle = 'Hizmetler | Gebze Belediyesi';
$navTransparent = false;

$hizmetler = [];
$kategoriler = [];
try {
    $stmt = $conn->query("SELECT * FROM hizmet_listesi ORDER BY mudurluk ASC, sira ASC");
    $hizmetler = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($hizmetler as $h) {
        if (!in_array($h['mudurluk'], $kategoriler)) {
            $kategoriler[] = $h['mudurluk'];
        }
    }
} catch (Exception $e) {
    $hizmetler = [];
}

function hzSlug($metin)
{
    $metin = mb_strtolower($metin, 'UTF-8');
    $harfler = ['ç' => 'c', 'ğ' => 'g', 'ı' => 'i', 'ö' => 'o', 'ş' => 's', 'ü' => 'u'];
    $metin = strtr($metin, $harfler);
    $metin = preg_replace('/[^a-z0-9]+/', '-', $metin);
    return trim($metin, '-');
}

include '../includes/header.php';
?>

<style>
    .hz-bolumu { padding: 7rem 0 5rem; }

    /* --- Üst bölüm: breadcrumb + başlık + arama --- */
    .hz-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--muted);
        margin-bottom: 0.8rem;
    }
    .hz-breadcrumb a { color: var(--muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .hz-breadcrumb a:hover { color: var(--accent-hot); }

    .hz-ustbaslik { margin-bottom: 1.6rem; }
    .hz-ustbaslik h1 {
        font-size: clamp(1.9rem, 3.4vw, 2.5rem);
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 0.5rem;
    }
    .hz-ustbaslik p { color: var(--muted); font-size: 1rem; }

    .hz-arama {
        display: flex;
        max-width: 560px;
        margin-bottom: 2.4rem;
    }
    .hz-arama input {
        flex: 1;
        padding: 0.8rem 1.2rem;
        border: 1px solid var(--line);
        border-radius: 10px 0 0 10px;
        font-size: 0.95rem;
        outline: none;
    }
    .hz-arama button {
        padding: 0 1.4rem;
        background: var(--navy);
        color: var(--white);
        border: none;
        border-radius: 0 10px 10px 0;
        cursor: pointer;
    }

    /* --- İki kolon düzen: içerik + sağ kategori sidebar --- */
    .hz-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 2.4rem;
        align-items: start;
    }

    /* --- Kart grid --- */
    .hz-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.2rem;
    }
    .hz-kart {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        overflow: hidden;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .hz-kart:hover { transform: translateY(-4px); box-shadow: var(--shadow); }

    .hz-kart-gorsel {
        height: 180px;
        background: #eef1f4;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        font-size: 0.78rem;
        letter-spacing: .04em;
        overflow: hidden;
    }
    .hz-kart-gorsel img { width: 100%; height: 100%; object-fit: cover; display: block; }

    .hz-kart-icerik {
        padding: 1.2rem 1.3rem 1.4rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        flex: 1;
    }
    .hz-kart-icerik h3 { font-size: 1.02rem; font-weight: 700; color: var(--navy); line-height: 1.35; margin: 0; }
    .hz-kart-icerik p { font-size: 0.85rem; color: var(--muted); line-height: 1.5; margin: 0; flex: 1; }
    .hz-kart-link {
        margin-top: 0.4rem;
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--accent-hot);
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }
    .hz-kart:hover .hz-kart-link { text-decoration: underline; }

    .hz-bos { text-align: center; color: var(--muted); padding: 3rem 0; background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); }
    #hzSonucYok { display: none; text-align: center; color: var(--muted); padding: 3rem 0; }

    /* --- Sağ sidebar: kategori kutusu --- */
    .hz-sidebar { position: sticky; top: 100px; }
    .hz-kutu {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 1.3rem 1.4rem;
    }
    .hz-kutu h3 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--navy);
        margin: 0 0 1rem;
        padding-bottom: 0.6rem;
        border-bottom: 2px solid var(--accent-hot);
        display: inline-block;
    }
    .hz-kategori-liste { list-style: none; margin: 0; padding: 0; }
    .hz-kategori-liste li + li { margin-top: 4px; }
    .hz-kategori-liste button {
        display: block;
        width: 100%;
        text-align: left;
        padding: 0.65rem 0.8rem;
        border: none;
        border-radius: 8px;
        background: none;
        color: var(--text);
        font-size: 0.9rem;
        font-family: inherit;
        line-height: 1.4;
        cursor: pointer;
        transition: background .2s ease, color .2s ease;
    }
    .hz-kategori-liste button:hover { background: #f7f9fb; color: var(--accent-hot); }
    .hz-kategori-liste button.is-active {
        background: #eef4fb;
        color: var(--navy);
        font-weight: 700;
        border-left: 3px solid var(--navy);
        padding-left: calc(0.8rem - 3px);
    }

    @media (max-width: 992px) {
        .hz-layout { grid-template-columns: 1fr; }
        .hz-sidebar { position: static; order: -1; }
        .hz-kategori-liste { display: flex; flex-wrap: wrap; gap: 8px; }
        .hz-kategori-liste li { flex: 0 0 auto; }
        .hz-kategori-liste button { border-radius: 999px; padding: 0.55rem 1rem; }
        .hz-kategori-liste button.is-active { border-left: none; padding-left: 1rem; }
    }
    @media (max-width: 640px) {
        .hz-grid { grid-template-columns: 1fr; }
    }
</style>

<section class="hz-bolumu page-content">
    <div class="container">

        <nav class="hz-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Hizmetler</span>
        </nav>

        <div class="hz-ustbaslik">
            <h1>Hizmetler</h1>
            <p>Gebze Belediyesi'nin sunduğu tüm hizmetleri buradan görüntüleyebilirsiniz.</p>
        </div>

        <div class="hz-arama">
            <input type="text" id="hzArama" placeholder="Hizmet ara...">
            <button type="button"><i class="bi bi-search"></i></button>
        </div>

        <?php if (count($hizmetler) > 0): ?>

            <div class="hz-layout">
                <div>
                    <div class="hz-grid" id="hzGrid">
                        <?php foreach ($hizmetler as $i => $hizmet):
                            $katSlug = hzSlug($hizmet['mudurluk']);
                            // Kartlar artık HER ZAMAN kendi detay sayfamıza gider.
                            // "link" sütunu artık detay sayfası içindeki "TIKLAYINIZ"
                            // gibi CTA metinleri için kullanılıyor, kartın kendisi için değil.
                            $hzHref = $basePath . 'pages/hizmet-detay.php?id=' . (int)$hizmet['id'];
                        ?>
                            <a class="hz-kart hz-kart-oge"
                               href="<?php echo $hzHref; ?>"
                               data-kategori="<?php echo htmlspecialchars($katSlug); ?>"
                               data-arama="<?php echo htmlspecialchars(mb_strtolower($hizmet['hizmet_adi'] . ' ' . $hizmet['mudurluk'], 'UTF-8')); ?>">
                                <div class="hz-kart-gorsel">
                                    <?php if (!empty($hizmet['gorsel'])): ?>
                                        <img src="<?php echo $basePath . htmlspecialchars(ltrim($hizmet['gorsel'], '/')); ?>" alt="<?php echo htmlspecialchars($hizmet['hizmet_adi']); ?>" loading="lazy">
                                    <?php else: ?>
                                        GÖRSEL
                                    <?php endif; ?>
                                </div>
                                <div class="hz-kart-icerik">
                                    <h3><?php echo htmlspecialchars($hizmet['hizmet_adi']); ?></h3>
                                    <?php if (!empty($hizmet['aciklama'])): ?>
                                        <p><?php echo htmlspecialchars($hizmet['aciklama']); ?></p>
                                    <?php endif; ?>
                                    <span class="hz-kart-link">Detaylı Bilgi <i class="bi bi-arrow-right"></i></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <p id="hzSonucYok">Aramanızla eşleşen bir hizmet bulunamadı.</p>
                </div>

                <aside class="hz-sidebar">
                    <div class="hz-kutu">
                        <h3>Kategoriler</h3>
                        <ul class="hz-kategori-liste" id="hzKategoriListe">
                            <li>
                                <button type="button" class="is-active" data-kategori="tumu">
                                    Tümü
                                </button>
                            </li>
                            <?php foreach ($kategoriler as $i => $kat): ?>
                                <li>
                                    <button type="button" data-kategori="<?php echo htmlspecialchars(hzSlug($kat)); ?>">
                                        <?php echo htmlspecialchars($kat); ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </aside>
            </div>

        <?php else: ?>
            <p class="hz-bos">Henüz hizmet eklenmemiştir.</p>
        <?php endif; ?>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kategoriBtn = document.querySelectorAll('#hzKategoriListe button');
    const kartlar = document.querySelectorAll('.hz-kart-oge');
    const aramaInput = document.getElementById('hzArama');
    const sonucYok = document.getElementById('hzSonucYok');

    let aktifKategori = kategoriBtn.length > 0 ? kategoriBtn[0].dataset.kategori : null;

    function kartlariUygula() {
        const q = aramaInput.value.trim().toLocaleLowerCase('tr');
        let gorunenSayisi = 0;

        kartlar.forEach(function (kart) {
            let uygun;
            if (q !== '') {
                // Arama yazılıyorsa kategoriden bağımsız, tüm kartlarda ara
                uygun = kart.dataset.arama.includes(q);
            } else if (aktifKategori === 'tumu') {
                // "Tümü" seçiliyse kategori fark etmeksizin her şeyi göster
                uygun = true;
            } else {
                // Belirli bir kategori seçiliyse sadece onu göster
                uygun = kart.dataset.kategori === aktifKategori;
            }
            kart.style.display = uygun ? '' : 'none';
            if (uygun) gorunenSayisi++;
        });

        sonucYok.style.display = gorunenSayisi === 0 ? 'block' : 'none';
    }

    kategoriBtn.forEach(function (btn) {
        btn.addEventListener('click', function () {
            aramaInput.value = '';
            kategoriBtn.forEach(function (b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            aktifKategori = btn.dataset.kategori;
            kartlariUygula();
        });
    });

    if (aramaInput) {
        aramaInput.addEventListener('input', kartlariUygula);
    }
});
</script>

<?php include '../includes/footer.php'; ?>