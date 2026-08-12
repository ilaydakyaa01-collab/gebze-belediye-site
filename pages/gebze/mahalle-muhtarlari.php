<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'Mahalle Muhtarları - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';
include '../../includes/header.php';

$stmt = $conn->query("SELECT * FROM mahalle_muhtarlari ORDER BY sira ASC");
$tumMuhtarlar = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sayfaBasi = 6;
$muhtarSayfalari = array_chunk($tumMuhtarlar, $sayfaBasi);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/gebze.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid kurumsal-grid-genis">
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>Mahalle Muhtarları</span>
                </nav>

                <div class="mudurluk-ust-bar">
                    <header class="section-header section-header-left mudurluk-baslik">
                        <h2>Mahalle Muhtarlarımız</h2>
                    </header>

                    <div class="meclis-arama-wrap mudurluk-arama-wrap">
                        <input type="text" class="meclis-arama" id="muhtarArama" placeholder="Ara" aria-label="Mahalle veya muhtar ara">
                        <button type="button" class="meclis-arama-ikon" id="muhtarAramaBtn" aria-label="Ara">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <div class="metin-araclari">
                    <button type="button" class="arac-btn" id="fontKucult" aria-label="Yazıyı küçült" title="Yazıyı küçült">
                        <i class="bi bi-zoom-out"></i>
                    </button>
                    <button type="button" class="arac-btn" id="fontNormal" aria-label="Normal boyut" title="Normal boyut">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                    <button type="button" class="arac-btn" id="fontBuyut" aria-label="Yazıyı büyüt" title="Yazıyı büyüt">
                        <i class="bi bi-zoom-in"></i>
                    </button>
                    <button type="button" class="arac-btn" id="yazdirBtn" aria-label="Yazdır" title="Yazdır">
                        <i class="bi bi-printer"></i>
                    </button>
                </div>

                <div class="muhtar-grid" id="muhtarMetin">
                    <?php foreach ($muhtarSayfalari as $sayfaIndex => $sayfaMuhtarlari): ?>
                        <?php foreach ($sayfaMuhtarlari as $m): ?>
                            <div class="muhtar-kart muhtar-sayfa"
                                 data-sayfa="<?php echo $sayfaIndex + 1; ?>"
                                 data-ara="<?php echo htmlspecialchars(mb_strtolower($m['mahalle'] . ' ' . $m['muhtar_adi'] . ' ' . $m['telefon'] . ' ' . $m['eposta'] . ' ' . $m['adres'], 'UTF-8')); ?>"
                                 <?php echo $sayfaIndex > 0 ? 'style="display:none;"' : ''; ?>>

                                <?php if (!empty($m['resim'])): ?>
                                    <img class="muhtar-foto" src="<?php echo $basePath; ?>includes/resim-goster.php?tablo=mahalle_muhtarlari&id=<?php echo (int) $m['id']; ?>" alt="<?php echo htmlspecialchars($m['muhtar_adi']); ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="muhtar-foto muhtar-foto-bos"><i class="bi bi-person"></i></div>
                                <?php endif; ?>

                                <div class="muhtar-icerik">
                                    <h4><?php echo htmlspecialchars($m['mahalle']); ?></h4>

                                    <?php if (!empty($m['muhtar_adi'])): ?>
                                        <span class="muhtar-isim"><?php echo htmlspecialchars($m['muhtar_adi']); ?></span>
                                    <?php else: ?>
                                        <span class="muhtar-isim muhtar-bilinmiyor">Muhtar bilgisi güncelleniyor</span>
                                    <?php endif; ?>

                                    <?php if (!empty($m['eposta'])): ?>
                                        <div class="muhtar-satir"><i class="bi bi-envelope"></i><span><?php echo htmlspecialchars($m['eposta']); ?></span></div>
                                    <?php endif; ?>

                                    <?php if (!empty($m['adres'])): ?>
                                        <div class="muhtar-satir"><i class="bi bi-geo-alt"></i><span><?php echo htmlspecialchars($m['adres']); ?></span></div>
                                    <?php endif; ?>

                                    <div class="muhtar-buton-grup">
                                        <?php if (!empty($m['telefon'])): ?>
                                            <a class="muhtar-btn" href="tel:<?php echo preg_replace('/\s+/', '', $m['telefon']); ?>">
                                                <i class="bi bi-telephone"></i> Ara
                                            </a>
                                        <?php endif; ?>

                                        <?php if (!empty($m['google_url'])): ?>
                                            <a class="muhtar-btn muhtar-btn-dolu" href="<?php echo htmlspecialchars($m['google_url']); ?>" target="_blank" rel="noopener">
                                                <i class="bi bi-pin-map"></i> Konuma Git
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>

                <?php if (count($muhtarSayfalari) > 1): ?>
                    <div class="meclis-sayfalama" id="muhtarSayfalama">
                        <?php foreach ($muhtarSayfalari as $sayfaIndex => $sayfaMuhtarlari): ?>
                            <button type="button" class="meclis-sayfa-btn<?php echo $sayfaIndex === 0 ? ' active' : ''; ?>" data-sayfa-git="<?php echo $sayfaIndex + 1; ?>"><?php echo $sayfaIndex + 1; ?></button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="gebze-yan-kolon">
                <?php $currentGebzePage = 'muhtarlar'; include '../../includes/gebze-sidebar.php'; ?>
            </div>
        </div>
    </div>
</main>

<script>
(function () {
    // Yazı boyutu araçları
    var metin = document.getElementById('muhtarMetin');
    var olcek = 1;
    var ADIM = 0.1;
    var MIN = 0.7;
    var MAX = 1.5;

    function olcekUygula() {
        metin.style.setProperty('--metin-olcek', olcek.toFixed(2));
    }

    document.getElementById('fontBuyut').addEventListener('click', function () {
        olcek = Math.min(MAX, olcek + ADIM);
        olcekUygula();
    });
    document.getElementById('fontKucult').addEventListener('click', function () {
        olcek = Math.max(MIN, olcek - ADIM);
        olcekUygula();
    });
    document.getElementById('fontNormal').addEventListener('click', function () {
        olcek = 1;
        olcekUygula();
    });
    document.getElementById('yazdirBtn').addEventListener('click', function () {
        window.print();
    });

    // Arama + sayfalama
    var arama = document.getElementById('muhtarArama');
    var aramaBtn = document.getElementById('muhtarAramaBtn');
    var kartlar = document.querySelectorAll('.muhtar-sayfa');
    var sayfaBtnlar = document.querySelectorAll('#muhtarSayfalama .meclis-sayfa-btn');
    var sayfalamaKutu = document.getElementById('muhtarSayfalama');
    var muhtarBaslik = document.querySelector('.mudurluk-baslik');

    function sayfayaGit(n, kaydir) {
        kartlar.forEach(function (kart) {
            kart.style.display = (kart.getAttribute('data-sayfa') === String(n)) ? '' : 'none';
        });
        sayfaBtnlar.forEach(function (btn) {
            btn.classList.toggle('active', btn.getAttribute('data-sayfa-git') === String(n));
        });
        if (kaydir && muhtarBaslik) {
            muhtarBaslik.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function filtrele() {
        var deger = arama.value.toLocaleLowerCase('tr-TR').trim();
        var aramaAktif = deger.length > 0;

        if (aramaAktif) {
            if (sayfalamaKutu) sayfalamaKutu.style.display = 'none';
            kartlar.forEach(function (kart) {
                var metinDeger = kart.getAttribute('data-ara');
                kart.style.display = metinDeger.includes(deger) ? '' : 'none';
            });
        } else {
            if (sayfalamaKutu) sayfalamaKutu.style.display = '';
            var aktifBtn = document.querySelector('#muhtarSayfalama .meclis-sayfa-btn.active');
            sayfayaGit(aktifBtn ? aktifBtn.getAttribute('data-sayfa-git') : '1');
        }
    }

    arama.addEventListener('input', filtrele);
    aramaBtn.addEventListener('click', function () {
        arama.focus();
        filtrele();
    });

    sayfaBtnlar.forEach(function (btn) {
        btn.addEventListener('click', function () {
            sayfayaGit(btn.getAttribute('data-sayfa-git'), true);
        });
    });
})();
</script>

<?php include '../../includes/footer.php'; ?>