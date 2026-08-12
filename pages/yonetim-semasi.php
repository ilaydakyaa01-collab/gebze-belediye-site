<?php
require_once '../includes/init.php';
require_once '../includes/db.php';

$basePath = '../';
$pageTitle = 'Yönetim Şeması - Gebze Belediyesi';
$navTransparent = false;
$extraCss = 'css/yonetim-semasi.css';

$stmt = $conn->query("SELECT * FROM yonetim ORDER BY grup, sira ASC");
$tumYonetim = $stmt->fetchAll(PDO::FETCH_ASSOC);

$baskan = array_filter($tumYonetim, fn($k) => $k['grup'] === 'baskan');
$yardimcilar = array_filter($tumYonetim, fn($k) => $k['grup'] === 'yardimci');

$birimStmt = $conn->query("SELECT * FROM yonetim_birim ORDER BY sira ASC");
$tumBirimler = $birimStmt->fetchAll(PDO::FETCH_ASSOC);

$birimlerByYardimci = [];
foreach ($tumBirimler as $birim) {
    $birimlerByYardimci[$birim['yardimci_id']][] = $birim;
}

include '../includes/header.php';

function birimButonu($basePath, $birim) {
    $resim = !empty($birim['resim']) ? $basePath . htmlspecialchars($birim['resim']) : '';
    echo '<button type="button" class="yonetim-birim-box yonetim-birim-tetikleyici"
        data-ad="' . htmlspecialchars($birim['sorumlu_ad_soyad']) . '"
        data-birim="' . htmlspecialchars($birim['birim_adi']) . '"
        data-resim="' . $resim . '"
        data-telefon="' . htmlspecialchars($birim['telefon'] ?? '') . '"
        data-email="' . htmlspecialchars($birim['email'] ?? '') . '"
        data-gorevler="' . htmlspecialchars($birim['gorevler'] ?? '') . '"
        data-biyografi="' . htmlspecialchars($birim['biyografi'] ?? '') . '"
        data-yonetmelik="' . htmlspecialchars($birim['yonetmelik'] ?? '') . '">
        <i class="bi bi-building yonetim-birim-icon"></i>
        <div class="yonetim-birim-metin">
            <strong>' . htmlspecialchars($birim['birim_adi']) . '</strong>
            <span>' . htmlspecialchars($birim['sorumlu_ad_soyad']) . '</span>
        </div>
    </button>';
}
?>

<section class="page-content">
    <div class="container">
        <header class="section-header" style="text-align: left; margin-bottom: 1.5rem;">
            <h2>Yönetim Şeması</h2>
            <p>Gebze Belediyesi'nin kurumsal organizasyon yapısı.</p>
        </header>

        <div class="yonetim-arac-cubugu">
            <form action="<?php echo $basePath; ?>pages/arama.php" method="GET" class="yonetim-arama">
                <input type="text" name="q" placeholder="Sitede ara...">
                <button type="submit"><i class="bi bi-search"></i></button>
            </form>

            <div class="yonetim-kurumsal-menu">
                <button type="button" class="kurumsal-toggle" id="kurumsalToggle">
                    Kurumsal <i class="bi bi-chevron-down"></i>
                </button>
                <div class="kurumsal-dropdown" id="kurumsalDropdown" hidden>
                    <a href="<?php echo $basePath; ?>pages/vizyonumuz.php">Vizyonumuz</a>
                    <a href="<?php echo $basePath; ?>pages/misyonumuz.php">Misyonumuz</a>
                    <a href="<?php echo $basePath; ?>pages/ilkelerimiz.php">İlkelerimiz</a>
                    <a href="<?php echo $basePath; ?>pages/enerji-politikamiz.php">Enerji Politikamız</a>
                    <a href="<?php echo $basePath; ?>pages/belediye-meclisi.php">Belediye Meclisi</a>
                    <a href="#" class="is-active">Yönetim Şeması</a>
                    <a href="<?php echo $basePath; ?>pages/baskan-yardimcilari.php">Başkan Yardımcıları</a>
                    <a href="<?php echo $basePath; ?>pages/baskan-danismanlari.php">Başkan Danışmanları</a>
                    <a href="<?php echo $basePath; ?>pages/mudurlukler.php">Müdürlükler</a>
                    <a href="<?php echo $basePath; ?>pages/eski-baskanlar.php">Eski Başkanlar</a>
                    <a href="<?php echo $basePath; ?>pages/arabuluculuk-komisyonu.php">Arabuluculuk Komisyonu</a>
                    <a href="<?php echo $basePath; ?>pages/etik-komisyonu.php">Etik Komisyonu</a>
                    <a href="<?php echo $basePath; ?>pages/meclis-kararlari.php">Meclis Kararları</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal-kimlik.php">Kurumsal Kimlik</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal-raporlar.php">Kurumsal Raporlar</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal-dokumanlar.php">Kurumsal Dökümanlar</a>
                    <a href="<?php echo $basePath; ?>pages/yayinlar.php">Yayınlar</a>
                </div>
            </div>
        </div>

        <div class="yonetim-grid">

            <!-- BELEDİYE BAŞKANI KARTI -->
            <?php foreach ($baskan as $kisi): ?>
                <div class="yonetim-baskan-card" data-grup="baskan">
                    <div class="yonetim-baskan-header">
                        <?php if (!empty($kisi['resim'])): ?>
                            <img src="<?php echo $basePath . htmlspecialchars($kisi['resim']); ?>" alt="<?php echo htmlspecialchars($kisi['ad_soyad']); ?>" class="yonetim-foto-buyuk">
                        <?php else: ?>
                            <div class="yonetim-icon-buyuk"><i class="bi bi-person-badge"></i></div>
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($kisi['ad_soyad']); ?></h3>
                        <p><?php echo htmlspecialchars($kisi['unvan']); ?></p>
                    </div>

                    <?php if (!empty($birimlerByYardimci[$kisi['id']])): ?>
                        <div class="yonetim-baskan-birimler">
                            <h4>Başkana Bağlı Birimler</h4>
                            <div class="yonetim-baskan-birim-grid">
                                <?php foreach ($birimlerByYardimci[$kisi['id']] as $birim): ?>
                                    <?php birimButonu($basePath, $birim); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <!-- BAŞKAN YARDIMCILARI GRİDİ -->
            <div class="yonetim-yardimci-grid">
                <?php foreach ($yardimcilar as $kisi): ?>
                    <div class="yonetim-yardimci-kart" data-grup="yardimci">
                        <div class="yonetim-yardimci-ust">
                            <?php if (!empty($kisi['resim'])): ?>
                                <img src="<?php echo $basePath . htmlspecialchars($kisi['resim']); ?>" alt="<?php echo htmlspecialchars($kisi['ad_soyad']); ?>" class="yonetim-foto-kucuk">
                            <?php else: ?>
                                <div class="yonetim-icon"><i class="bi bi-person"></i></div>
                            <?php endif; ?>
                            <div>
                                <h3><?php echo htmlspecialchars($kisi['ad_soyad']); ?></h3>
                                <span><?php echo htmlspecialchars($kisi['unvan']); ?></span>
                            </div>
                        </div>

                        <?php if (!empty($birimlerByYardimci[$kisi['id']])): ?>
                            <div class="yonetim-birim-liste">
                                <?php foreach ($birimlerByYardimci[$kisi['id']] as $birim): ?>
                                    <?php birimButonu($basePath, $birim); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>

<!-- MODAL -->
<div class="yonetim-modal-backdrop" id="yonetimModalBackdrop" hidden>
    <div class="yonetim-modal">
        <div class="yonetim-modal-baslik-bar">
            <h2 id="modalBaslik"></h2>
            <button type="button" class="yonetim-modal-kapat" id="yonetimModalKapat"><i class="bi bi-x-lg"></i></button>
        </div>

        <div class="yonetim-modal-icerik">
            <div class="yonetim-modal-sol">
                <img id="modalResim" src="" alt="" class="yonetim-modal-foto" hidden>
                <div id="modalIkon" class="yonetim-modal-icon"><i class="bi bi-person"></i></div>

                <p id="modalTelefon"><i class="bi bi-telephone"></i> <span></span></p>
                <p id="modalEmail"><i class="bi bi-envelope"></i> <span></span></p>
            </div>

            <div class="yonetim-modal-sag">
                <div class="yonetim-modal-sekmeler" id="modalSekmeler">
                    <button type="button" class="yonetim-sekme-btn is-aktif" data-sekme="biyografi">Müdür Biyografi</button>
                    <button type="button" class="yonetim-sekme-btn" data-sekme="yonetmelik">Müdürlük Yönetmelik</button>
                </div>
                <div id="modalBiyografi" class="yonetim-sekme-panel is-aktif"></div>
                <div id="modalYonetmelik" class="yonetim-sekme-panel"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kurumsalToggle = document.getElementById('kurumsalToggle');
    const kurumsalDropdown = document.getElementById('kurumsalDropdown');

    if (kurumsalToggle && kurumsalDropdown) {
        kurumsalToggle.addEventListener('click', function () {
            const acikMi = !kurumsalDropdown.hidden;
            kurumsalDropdown.hidden = acikMi;
            kurumsalToggle.classList.toggle('is-open', !acikMi);
        });

        document.addEventListener('click', function (e) {
            if (!kurumsalToggle.contains(e.target) && !kurumsalDropdown.contains(e.target)) {
                kurumsalDropdown.hidden = true;
                kurumsalToggle.classList.remove('is-open');
            }
        });
    }

    const modalBackdrop = document.getElementById('yonetimModalBackdrop');
    const modalKapat = document.getElementById('yonetimModalKapat');
    const modalResim = document.getElementById('modalResim');
    const modalIkon = document.getElementById('modalIkon');
    const modalBaslik = document.getElementById('modalBaslik');
    const modalTelefon = document.getElementById('modalTelefon');
    const modalEmail = document.getElementById('modalEmail');
    const modalSekmeler = document.getElementById('modalSekmeler');
    const modalBiyografi = document.getElementById('modalBiyografi');
    const modalYonetmelik = document.getElementById('modalYonetmelik');

    function metniParagraflaDoldur(el, metin, bosMesaj) {
        el.innerHTML = '';
        const satirlar = (metin || '').split('\n').filter(s => s.trim() !== '');
        if (satirlar.length > 0) {
            satirlar.forEach(function (satir) {
                const p = document.createElement('p');
                p.textContent = satir.trim();
                el.appendChild(p);
            });
        } else {
            const p = document.createElement('p');
            p.textContent = bosMesaj;
            el.appendChild(p);
        }
    }

    function sekmeSec(sekmeAdi) {
        modalSekmeler.querySelectorAll('.yonetim-sekme-btn').forEach(function (btn) {
            btn.classList.toggle('is-aktif', btn.dataset.sekme === sekmeAdi);
        });
        modalBiyografi.classList.toggle('is-aktif', sekmeAdi === 'biyografi');
        modalYonetmelik.classList.toggle('is-aktif', sekmeAdi === 'yonetmelik');
    }

    modalSekmeler.addEventListener('click', function (e) {
        const btn = e.target.closest('.yonetim-sekme-btn');
        if (!btn) return;
        sekmeSec(btn.dataset.sekme);
    });

    document.querySelectorAll('.yonetim-birim-tetikleyici').forEach(function (btn) {
        btn.addEventListener('click', function () {
            modalBaslik.textContent = btn.dataset.birim + ' (' + btn.dataset.ad + ')';

            if (btn.dataset.resim) {
                modalResim.src = btn.dataset.resim;
                modalResim.hidden = false;
                modalIkon.hidden = true;
            } else {
                modalResim.hidden = true;
                modalIkon.hidden = false;
            }

            if (btn.dataset.telefon) {
                modalTelefon.querySelector('span').textContent = btn.dataset.telefon;
                modalTelefon.hidden = false;
            } else {
                modalTelefon.hidden = true;
            }

            if (btn.dataset.email) {
                modalEmail.querySelector('span').textContent = btn.dataset.email;
                modalEmail.hidden = false;
            } else {
                modalEmail.hidden = true;
            }

            metniParagraflaDoldur(modalBiyografi, btn.dataset.biyografi, 'Biyografi bilgisi henüz eklenmemiştir.');
            metniParagraflaDoldur(modalYonetmelik, btn.dataset.yonetmelik, 'Yönetmelik bilgisi henüz eklenmemiştir.');
            sekmeSec('biyografi');

            modalBackdrop.hidden = false;
            document.body.style.overflow = 'hidden';
        });
    });

    function modalKapatFn() {
        modalBackdrop.hidden = true;
        document.body.style.overflow = '';
    }

    modalKapat.addEventListener('click', modalKapatFn);
    modalBackdrop.addEventListener('click', function (e) {
        if (e.target === modalBackdrop) modalKapatFn();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') modalKapatFn();
    });
});
</script>
<?php include '../includes/footer.php'; ?>