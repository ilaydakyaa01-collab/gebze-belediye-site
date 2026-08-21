<?php
include '../../includes/db.php';
require_once '../../includes/init.php';

$basePath = '../../';
$pageTitle = 'Kurumsal Dökümanlar | Gebze Belediyesi';
$navTransparent = false;
$currentKurumsalPage = 'kurumsal-dokumanlar';

$gruplar = [];
try {
    $stmt = $conn->query("SELECT * FROM kurumsal_dokumanlar ORDER BY mudurluk ASC, kategori ASC, sira ASC");
    $tumBelgeler = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($tumBelgeler as $belge) {
        $gruplar[$belge['mudurluk']][$belge['kategori']][] = $belge;
    }
} catch (Exception $e) {
    $gruplar = [];
}

include '../../includes/header.php';
?>

<style>
    .kd-bolumu { padding: 7rem 0 5rem; }

    .kd-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--muted);
        margin-bottom: 0.6rem;
    }
    .kd-breadcrumb a { color: var(--muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .kd-breadcrumb a:hover { color: var(--accent-hot); }

    .kd-ustbaslik { margin-bottom: 2rem; }
    .kd-ustbaslik h1 {
        font-size: clamp(1.8rem, 3vw, 2.3rem);
        font-weight: 700;
        color: var(--navy);
    }

    .kd-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 2.5rem;
        align-items: start;
    }

    .kd-arama {
        display: flex;
        margin-bottom: 1.6rem;
    }
    .kd-arama input {
        flex: 1;
        padding: 0.75rem 1.1rem;
        border: 1px solid var(--line);
        border-radius: 10px 0 0 10px;
        font-size: 0.92rem;
        outline: none;
    }
    .kd-arama button {
        padding: 0 1.2rem;
        background: var(--navy);
        color: var(--white);
        border: none;
        border-radius: 0 10px 10px 0;
        cursor: pointer;
    }

    .kd-akordiyon { display: flex; flex-direction: column; gap: 0.9rem; }

    .kd-panel {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        overflow: hidden;
    }

    .kd-panel-baslik {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.1rem 1.4rem;
        background: none;
        border: none;
        cursor: pointer;
        text-align: left;
    }
    .kd-panel-baslik h3 { font-size: 1.05rem; font-weight: 700; color: var(--navy); }

    .kd-panel-toggle {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        background: var(--navy);
        color: var(--white);
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        flex-shrink: 0;
    }
    .kd-panel-toggle i { transition: transform 0.2s ease; }
    .kd-panel.is-open .kd-panel-toggle i { transform: rotate(180deg); }

    .kd-panel-icerik {
        display: none;
        padding: 0 1.4rem 1.4rem;
    }
    .kd-panel.is-open .kd-panel-icerik { display: block; }

    .kd-kategori-baslik {
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--navy);
        margin: 1.1rem 0 0.6rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--accent);
    }
    .kd-kategori-baslik:first-child { margin-top: 0; }

    .kd-belge-satir {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 0.7rem 0;
    }
    .kd-belge-satir + .kd-belge-satir { border-top: 1px solid var(--line); }
    .kd-belge-satir span:first-child { font-size: 0.92rem; color: var(--text); }

    .kd-belge-indir {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        color: var(--navy);
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .kd-belge-indir:hover { color: var(--accent-hot); }

    .kd-bos { text-align: center; color: var(--muted); padding: 3rem 0; background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); }

    /* --- Sağdaki sabit Kurumsal kutusu --- */
    .kd-yan-kutu {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 1.4rem;
    }
    .kd-yan-kutu h3 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 1rem;
        padding-bottom: 0.7rem;
        border-bottom: 2px solid var(--accent);
    }
    .kd-yan-kutu ul { list-style: none; }
    .kd-yan-kutu ul li + li { margin-top: 10px; padding-top: 10px; border-top: 1px solid var(--line); }
    .kd-yan-kutu ul li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: var(--text);
        font-weight: 500;
        font-size: 0.88rem;
    }
    .kd-yan-kutu ul li a:hover { color: var(--accent-hot); }
    .kd-yan-kutu ul li a.is-active { color: var(--accent-hot); font-weight: 700; }
    .kd-yan-kutu ul li a i { color: var(--muted); font-size: 13px; }

    @media (max-width: 900px) {
        .kd-layout { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
        .kd-panel-baslik { flex-direction: column; align-items: flex-start; gap: 0.6rem; }
        .kd-belge-satir { flex-direction: column; align-items: flex-start; gap: 0.4rem; }
    }
</style>

<section class="kd-bolumu page-content">
    <div class="container">
        <nav class="kd-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Kurumsal Dökümanlar</span>
        </nav>

        <div class="kd-ustbaslik">
            <h1>Kurumsal Dökümanlar</h1>
        </div>

        <div class="kd-layout">
            <div>
                <div class="kd-arama">
                    <input type="text" id="kdArama" placeholder="Müdürlük veya döküman ara...">
                    <button type="button"><i class="bi bi-search"></i></button>
                </div>

                <?php if (count($gruplar) > 0): ?>
                    <div class="kd-akordiyon" id="kdAkordiyon">
                        <?php foreach ($gruplar as $mudurlukAdi => $kategoriler): ?>
                            <div class="kd-panel" data-mudurluk="<?php echo htmlspecialchars(mb_strtolower($mudurlukAdi)); ?>">
                                <button type="button" class="kd-panel-baslik">
                                    <h3><?php echo htmlspecialchars($mudurlukAdi); ?></h3>
                                    <span class="kd-panel-toggle">Tüm Dökümanlar <i class="bi bi-chevron-down"></i></span>
                                </button>
                                <div class="kd-panel-icerik">
                                    <?php foreach ($kategoriler as $kategoriAdi => $belgeler): ?>
                                        <div class="kd-kategori-baslik"><?php echo htmlspecialchars($kategoriAdi); ?></div>
                                        <?php foreach ($belgeler as $belge): ?>
                                            <div class="kd-belge-satir" data-belge="<?php echo htmlspecialchars(mb_strtolower($belge['belge_adi'])); ?>">
                                                <span><?php echo htmlspecialchars($belge['belge_adi']); ?></span>
                                                <?php if (!empty($belge['dosya'])): ?>
                                                    <a href="<?php echo $basePath . htmlspecialchars($belge['dosya']); ?>" class="kd-belge-indir" target="_blank" rel="noopener">
                                                        İndir <i class="bi bi-download"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="kd-bos">Henüz kurumsal döküman eklenmemiştir.</p>
                <?php endif; ?>
            </div>

            <aside class="kd-yan-kutu">
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
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/kurumsal-raporlar.php">Kurumsal Raporlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="#" class="is-active">Kurumsal Dökümanlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/yayinlar.php">Yayınlar <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/kvkk.php">KVKK Aydınlatma Metni</a></li>
                </ul>
            </aside>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.kd-panel-baslik').forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn.closest('.kd-panel').classList.toggle('is-open');
        });
    });

    const aramaInput = document.getElementById('kdArama');
    if (aramaInput) {
        aramaInput.addEventListener('input', function () {
            const q = aramaInput.value.trim().toLocaleLowerCase('tr');
            document.querySelectorAll('.kd-panel').forEach(function (panel) {
                const mudurluk = panel.dataset.mudurluk || '';
                let eslesenVar = mudurluk.includes(q);
                panel.querySelectorAll('.kd-belge-satir').forEach(function (satir) {
                    const belge = satir.dataset.belge || '';
                    const uygun = q === '' || belge.includes(q);
                    satir.hidden = !uygun;
                    if (uygun) eslesenVar = true;
                });
                panel.hidden = q !== '' && !eslesenVar;
                if (q !== '' && eslesenVar) {
                    panel.classList.add('is-open');
                }
            });
        });
    }
});
</script>

<?php include '../../includes/footer.php'; ?>