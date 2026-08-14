<?php
/**
 * ETKİNLİKLER SAYFASI
 * -------------------------------------------------------------
 * Ekip arkadaşımızın oluşturduğu mevcut "etkinlikler" tablosunu
 * kullanır (tarih, resim, baslik, renk, kategori, saat, yer, sira).
 * Buna arama kutusu, tarih aralığı çipleri (Tümü/Bugün/Bu Hafta/Bu
 * Ay) ve sağ kategori sidebar'ı eklendi.
 */

include '../includes/db.php';

$basePath = '../';
$pageTitle = 'Etkinlikler - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';

$etkinlikler = [];
$kategoriler = [];
try {
    $etkinlikler = $conn->query("SELECT *, (tarih = CURDATE()) AS bugun FROM etkinlikler ORDER BY tarih ASC, sira ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($etkinlikler as $e) {
        if (!empty($e['kategori']) && !in_array($e['kategori'], $kategoriler)) {
            $kategoriler[] = $e['kategori'];
        }
    }
} catch (Exception $e) {
    $etkinlikler = [];
}

function etkSlug($metin)
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
    .etk-bolumu { padding: 7rem 0 5rem; }

    .etk-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--muted);
        margin-bottom: 0.8rem;
    }
    .etk-breadcrumb a { color: var(--muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .etk-breadcrumb a:hover { color: var(--accent-hot); }

    .etk-ustbaslik { margin-bottom: 1.6rem; }
    .etk-ustbaslik h1 {
        font-size: clamp(1.9rem, 3.4vw, 2.5rem);
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 0.5rem;
    }
    .etk-ustbaslik p { color: var(--muted); font-size: 1rem; }

    .etk-arama {
        display: flex;
        max-width: 560px;
        margin-bottom: 1.4rem;
    }
    .etk-arama input {
        flex: 1;
        padding: 0.8rem 1.2rem;
        border: 1px solid var(--line);
        border-radius: 10px 0 0 10px;
        font-size: 0.95rem;
        outline: none;
    }
    .etk-arama button {
        padding: 0 1.4rem;
        background: var(--navy);
        color: var(--white);
        border: none;
        border-radius: 0 10px 10px 0;
        cursor: pointer;
    }

    .etk-tarih-cipler { display: flex; flex-wrap: wrap; gap: 0.6rem; margin-bottom: 2.2rem; }
    .etk-cip {
        padding: 0.55rem 1.2rem;
        border: 1px solid var(--line);
        border-radius: 999px;
        background: var(--white);
        color: var(--navy);
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s ease;
    }
    .etk-cip:hover { border-color: var(--accent-hot); color: var(--accent-hot); }
    .etk-cip.is-active { background: var(--navy); border-color: var(--navy); color: var(--white); }

    .etk-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 2.4rem;
        align-items: start;
    }

    .etkinlik-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.2rem;
    }
    .etkinlik-kart {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .etkinlik-kart:hover { transform: translateY(-4px); box-shadow: var(--shadow); }

    .etkinlik-gorsel {
        position: relative;
        aspect-ratio: 1.86 / 1;
        background: #eef1f4;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        font-size: 0.78rem;
        letter-spacing: .04em;
    }
    .etkinlik-gorsel img { width: 100%; height: 100%; object-fit: cover; display: block; }

    .etkinlik-kategori {
        position: absolute;
        top: 12px;
        left: 12px;
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
        padding: 4px 11px;
        border-radius: 999px;
    }
    .etkinlik-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: var(--accent-hot);
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 11px;
        border-radius: 999px;
    }

    .etkinlik-bilgi { padding: 1.1rem 1.2rem 1.3rem; display: flex; flex-direction: column; gap: 0.4rem; flex: 1; }
    .etkinlik-bilgi time { font-size: 0.8rem; color: var(--muted); display: flex; align-items: center; gap: 6px; }
    .etkinlik-bilgi p.etkinlik-tarih-satiri {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 14px;
    }
    .etkinlik-bilgi p.etkinlik-tarih-satiri span { display: flex; align-items: center; gap: 6px; }
    .etkinlik-bilgi h3 { font-size: 1rem; font-weight: 700; color: var(--navy); margin: 0; line-height: 1.35; }
    .etkinlik-bilgi p { font-size: 0.85rem; color: var(--muted); margin: 0; display: flex; align-items: center; gap: 6px; }
    .etkinlik-detaylar-btn {
        align-self: flex-start;
        margin-top: 0.5rem;
        padding: 0.5rem 1.2rem;
        background: var(--navy);
        color: var(--white);
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
    }
    .etkinlik-detaylar-btn:hover { background: #004a8f; }

    .etk-bos { text-align: center; color: var(--muted); padding: 3rem 0; background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); }
    #etkSonucYok { display: none; text-align: center; color: var(--muted); padding: 3rem 0; }

    .etk-sayfalama {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 2rem;
    }
    .etk-sayfalama button {
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border: 1px solid var(--line);
        border-radius: 10px;
        background: var(--white);
        color: var(--navy);
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s ease;
    }
    .etk-sayfalama button:hover:not(:disabled) { border-color: var(--accent-hot); color: var(--accent-hot); }
    .etk-sayfalama button.is-active { background: var(--navy); border-color: var(--navy); color: var(--white); }
    .etk-sayfalama button:disabled { opacity: 0.4; cursor: not-allowed; }

    .etk-sidebar { position: sticky; top: 100px; }
    .etk-kutu {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 1.3rem 1.4rem;
    }
    .etk-kutu h3 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--navy);
        margin: 0 0 1rem;
        padding-bottom: 0.6rem;
        border-bottom: 2px solid var(--accent-hot);
        display: inline-block;
    }
    .etk-kategori-liste { list-style: none; margin: 0; padding: 0; }
    .etk-kategori-liste li + li { margin-top: 4px; }
    .etk-kategori-liste button {
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
    .etk-kategori-liste button:hover { background: #f7f9fb; color: var(--accent-hot); }
    .etk-kategori-liste button.is-active {
        background: #eef4fb;
        color: var(--navy);
        font-weight: 700;
        border-left: 3px solid var(--navy);
        padding-left: calc(0.8rem - 3px);
    }

    @media (max-width: 992px) {
        .etk-layout { grid-template-columns: 1fr; }
        .etk-sidebar { position: static; order: -1; }
        .etk-kategori-liste { display: flex; flex-wrap: wrap; gap: 8px; }
        .etk-kategori-liste li { flex: 0 0 auto; }
        .etk-kategori-liste button { border-radius: 999px; padding: 0.55rem 1rem; }
        .etk-kategori-liste button.is-active { border-left: none; padding-left: 1rem; }
    }
    @media (max-width: 640px) {
        .etkinlik-grid { grid-template-columns: 1fr; }
    }
</style>

<main class="etkinlik-bolumu etk-bolumu page-content">
    <div class="container">

        <nav class="etk-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Etkinlikler</span>
        </nav>

        <div class="etk-ustbaslik">
            <h1>Etkinlikler</h1>
            <p>Şehrimizdeki güncel etkinlikleri keşfedin.</p>
        </div>

        <?php if (count($etkinlikler) > 0): ?>

            <div class="etk-layout">
                <div>
                    <div class="etk-arama">
                        <input type="text" id="etkArama" placeholder="Etkinlik, kategori veya yer ara...">
                        <button type="button"><i class="bi bi-search"></i></button>
                    </div>

                    <div class="etk-tarih-cipler" id="etkTarihCipler">
                        <button type="button" class="etk-cip is-active" data-tarih-filtre="tumu">Tümü</button>
                        <button type="button" class="etk-cip" data-tarih-filtre="bugun">Bugün</button>
                        <button type="button" class="etk-cip" data-tarih-filtre="hafta">Bu Hafta</button>
                        <button type="button" class="etk-cip" data-tarih-filtre="ay">Bu Ay</button>
                    </div>

                    <div class="etkinlik-grid" id="etkGrid">
                        <?php foreach ($etkinlikler as $etkinlik):
                            $katSlug = etkSlug($etkinlik['kategori'] ?? '');
                            $aramaMetni = mb_strtolower(($etkinlik['baslik'] ?? '') . ' ' . ($etkinlik['kategori'] ?? '') . ' ' . ($etkinlik['yer'] ?? ''), 'UTF-8');
                        ?>
                            <article class="etkinlik-kart etk-kart-oge"
                                     data-kategori="<?php echo htmlspecialchars($katSlug); ?>"
                                     data-tarih="<?php echo htmlspecialchars($etkinlik['tarih']); ?>"
                                     data-arama="<?php echo htmlspecialchars($aramaMetni); ?>">
                                <div class="etkinlik-gorsel">
                                    <?php if (!empty($etkinlik['resim'])): ?>
                                        <img src="<?php echo $basePath . htmlspecialchars($etkinlik['resim']); ?>" alt="<?php echo htmlspecialchars($etkinlik['baslik']); ?>" loading="lazy">
                                    <?php else: ?>
                                        GÖRSEL
                                    <?php endif; ?>
                                    <?php if (!empty($etkinlik['kategori'])): ?>
                                        <span class="etkinlik-kategori" style="background-color: <?php echo htmlspecialchars($etkinlik['renk'] ?: '#0f5d3c'); ?>">
                                            <?php echo htmlspecialchars($etkinlik['kategori']); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if (!empty($etkinlik['bugun'])): ?>
                                        <span class="etkinlik-badge">Bugün</span>
                                    <?php endif; ?>
                                </div>
                                <div class="etkinlik-bilgi">
                                    <h3><?php echo htmlspecialchars($etkinlik['baslik']); ?></h3>
                                    <?php if (!empty($etkinlik['yer'])): ?>
                                        <p><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($etkinlik['yer']); ?></p>
                                    <?php endif; ?>
                                    <p class="etkinlik-tarih-satiri">
                                        <time datetime="<?php echo htmlspecialchars($etkinlik['tarih']); ?>">
                                            <i class="bi bi-calendar-event"></i>
                                            <?php echo date('d.m.Y', strtotime($etkinlik['tarih'])); ?>
                                        </time>
                                        <?php if (!empty($etkinlik['saat'])): ?>
                                            <span><i class="bi bi-clock"></i> <?php echo htmlspecialchars($etkinlik['saat']); ?></span>
                                        <?php endif; ?>
                                    </p>
                                    <a class="etkinlik-detaylar-btn" href="<?php echo $basePath; ?>pages/etkinlik-detay.php?id=<?php echo (int)$etkinlik['id']; ?>">Detaylar</a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    <p id="etkSonucYok">Aramanızla eşleşen bir etkinlik bulunamadı.</p>
                    <nav class="etk-sayfalama" id="etkSayfalama"></nav>
                </div>

                <aside class="etk-sidebar">
                    <div class="etk-kutu">
                        <h3>Kategoriler</h3>
                        <ul class="etk-kategori-liste" id="etkKategoriListe">
                            <li>
                                <button type="button" class="is-active" data-kategori="tumu-kategori">Tüm Kategoriler</button>
                            </li>
                            <?php foreach ($kategoriler as $kat): ?>
                                <li>
                                    <button type="button" data-kategori="<?php echo htmlspecialchars(etkSlug($kat)); ?>">
                                        <?php echo htmlspecialchars($kat); ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </aside>
            </div>

        <?php else: ?>
            <p class="etk-bos">Henüz etkinlik eklenmemiştir.</p>
        <?php endif; ?>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kartlar = Array.from(document.querySelectorAll('.etk-kart-oge'));
    const tarihCipler = document.querySelectorAll('#etkTarihCipler .etk-cip');
    const kategoriBtn = document.querySelectorAll('#etkKategoriListe button');
    const aramaInput = document.getElementById('etkArama');
    const sonucYok = document.getElementById('etkSonucYok');
    const sayfalamaKutusu = document.getElementById('etkSayfalama');

    const SAYFA_BASINA = 6;
    let aktifTarihFiltre = 'tumu';
    let aktifKategori = 'tumu-kategori';
    let aktifSayfa = 1;

    function bugununTarihi() {
        const d = new Date();
        d.setHours(0, 0, 0, 0);
        return d;
    }

    function tarihUygunMu(tarihStr) {
        if (aktifTarihFiltre === 'tumu') return true;
        const parcalar = tarihStr.split('-').map(Number);
        const etkinlikTarihi = new Date(parcalar[0], parcalar[1] - 1, parcalar[2]);
        const bugun = bugununTarihi();

        if (aktifTarihFiltre === 'bugun') {
            return etkinlikTarihi.getTime() === bugun.getTime();
        }
        if (aktifTarihFiltre === 'hafta') {
            const haftaBasi = new Date(bugun);
            const gunIndex = (bugun.getDay() + 6) % 7;
            haftaBasi.setDate(bugun.getDate() - gunIndex);
            const haftaSonu = new Date(haftaBasi);
            haftaSonu.setDate(haftaBasi.getDate() + 6);
            return etkinlikTarihi >= haftaBasi && etkinlikTarihi <= haftaSonu;
        }
        if (aktifTarihFiltre === 'ay') {
            return etkinlikTarihi.getFullYear() === bugun.getFullYear() && etkinlikTarihi.getMonth() === bugun.getMonth();
        }
        return true;
    }

    function eslesenleriBul() {
        const q = aramaInput.value.trim().toLocaleLowerCase('tr');
        return kartlar.filter(function (kart) {
            const aramaUygun = q === '' || kart.dataset.arama.includes(q);
            const kategoriUygun = aktifKategori === 'tumu-kategori' || kart.dataset.kategori === aktifKategori;
            const tarihUygun = tarihUygunMu(kart.dataset.tarih);
            return aramaUygun && kategoriUygun && tarihUygun;
        });
    }

    function sayfalamaCiz(toplamSayfa) {
        sayfalamaKutusu.innerHTML = '';
        if (toplamSayfa <= 1) return;

        // Aynı anda en fazla 3 sayfa numarası göster, aktif sayfayı ortala
        const GORUNEN_SAYFA_SAYISI = 3;
        let pencereBaslangic = Math.max(1, aktifSayfa - 1);
        let pencereBitis = pencereBaslangic + GORUNEN_SAYFA_SAYISI - 1;
        if (pencereBitis > toplamSayfa) {
            pencereBitis = toplamSayfa;
            pencereBaslangic = Math.max(1, pencereBitis - GORUNEN_SAYFA_SAYISI + 1);
        }

        const oncekiBtn = document.createElement('button');
        oncekiBtn.type = 'button';
        oncekiBtn.textContent = 'Önceki';
        oncekiBtn.disabled = aktifSayfa <= 1;
        oncekiBtn.addEventListener('click', function () { aktifSayfa--; kartlariUygula(); });
        sayfalamaKutusu.appendChild(oncekiBtn);

        for (let s = pencereBaslangic; s <= pencereBitis; s++) {
            const sayfaBtn = document.createElement('button');
            sayfaBtn.type = 'button';
            sayfaBtn.textContent = s;
            if (s === aktifSayfa) sayfaBtn.classList.add('is-active');
            sayfaBtn.addEventListener('click', function () { aktifSayfa = s; kartlariUygula(); });
            sayfalamaKutusu.appendChild(sayfaBtn);
        }

        const sonrakiBtn = document.createElement('button');
        sonrakiBtn.type = 'button';
        sonrakiBtn.textContent = 'Sonraki';
        sonrakiBtn.disabled = aktifSayfa >= toplamSayfa;
        sonrakiBtn.addEventListener('click', function () { aktifSayfa++; kartlariUygula(); });
        sayfalamaKutusu.appendChild(sonrakiBtn);
    }

    function kartlariUygula(filtreDegisti) {
        if (filtreDegisti) aktifSayfa = 1;

        const eslesenler = eslesenleriBul();
        const toplamSayfa = Math.max(1, Math.ceil(eslesenler.length / SAYFA_BASINA));
        if (aktifSayfa > toplamSayfa) aktifSayfa = toplamSayfa;

        const baslangic = (aktifSayfa - 1) * SAYFA_BASINA;
        const bitis = baslangic + SAYFA_BASINA;

        kartlar.forEach(function (kart) { kart.style.display = 'none'; });
        eslesenler.slice(baslangic, bitis).forEach(function (kart) { kart.style.display = ''; });

        sonucYok.style.display = eslesenler.length === 0 ? 'block' : 'none';
        sayfalamaCiz(toplamSayfa);

        window.scrollTo({ top: 0, behavior: 'instant' });
    }

    tarihCipler.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tarihCipler.forEach(function (b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            aktifTarihFiltre = btn.dataset.tarihFiltre;
            kartlariUygula(true);
        });
    });

    kategoriBtn.forEach(function (btn) {
        btn.addEventListener('click', function () {
            kategoriBtn.forEach(function (b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            aktifKategori = btn.dataset.kategori;
            kartlariUygula(true);
        });
    });

    if (aramaInput) {
        aramaInput.addEventListener('input', function () { kartlariUygula(true); });
    }

    kartlariUygula(true);
});
</script>

<?php include '../includes/footer.php'; ?>