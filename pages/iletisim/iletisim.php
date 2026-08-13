<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'İletişim - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';
include '../../includes/header.php';

$bilgi = $conn->query("SELECT * FROM iletisim_bilgileri LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$sosyalMedya = $conn->query("SELECT * FROM iletisim_sosyal_medya ORDER BY sira ASC")->fetchAll(PDO::FETCH_ASSOC);
$tumNoktalar = $conn->query("SELECT * FROM hizmet_noktalari ORDER BY sira ASC")->fetchAll(PDO::FETCH_ASSOC);

$kategoriler = [
    'hepsi' => 'Tümü',
    'mudurluk' => 'Müdürlükler',
    'servis' => 'Merkezler',
    'merkezler' => 'Merkezler',
    'sosyal-tesisler' => 'Sosyal Tesisler',
    'egitim-merkezleri' => 'Eğitim Merkezleri',
    'diger' => 'Diğer',
];
// Not: gerçek sitede "servis" ve "merkezler" ayrı iki kategori ama ikisi de
// filtre sekmelerinde "Merkezler" olarak görünüyor - orijinal veriye sadık kalındı.

$sayfaBasi = 9;
$noktaSayfalari = array_chunk($tumNoktalar, $sayfaBasi);
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/iletisim.css">

<main class="iletisim-bolumu page-content">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
            <span>/</span>
            <span>İletişim</span>
        </nav>

        <header class="section-header section-header-left iletisim-baslik">
            <h2>İletişim</h2>
        </header>

        <div class="iletisim-ust-grid">
            <div class="iletisim-bilgi-kart">
                <h3><span class="iletisim-ikon-rozet"><i class="bi bi-telephone"></i></span> Telefon &amp; Adres</h3>
                <p><strong>Telefon:</strong> <a href="tel:<?php echo preg_replace('/\s+/', '', $bilgi['telefon']); ?>"><?php echo htmlspecialchars($bilgi['telefon']); ?></a></p>
                <p><strong>Faks:</strong> <?php echo htmlspecialchars($bilgi['faks']); ?></p>
                <p><strong>Adres:</strong> <?php echo htmlspecialchars($bilgi['adres']); ?></p>
            </div>

            <div class="iletisim-bilgi-kart">
                <h3><span class="iletisim-ikon-rozet"><i class="bi bi-envelope"></i></span> E-posta</h3>
                <p><strong>Belediye:</strong> <a href="mailto:<?php echo htmlspecialchars($bilgi['eposta']); ?>"><?php echo htmlspecialchars($bilgi['eposta']); ?></a></p>
                <p><strong>Kep:</strong> <?php echo htmlspecialchars($bilgi['kep']); ?></p>
            </div>

            <div class="iletisim-bilgi-kart">
                <h3><span class="iletisim-ikon-rozet"><i class="bi bi-share"></i></span> Sosyal Medya</h3>
                <p>Bizi sosyal medya hesaplarımızdan takip edebilirsiniz.</p>
                <div class="iletisim-sosyal-ikonlar">
                    <?php foreach ($sosyalMedya as $s): ?>
                        <a href="<?php echo htmlspecialchars($s['url']); ?>" target="_blank" rel="noopener" aria-label="<?php echo htmlspecialchars($s['platform']); ?>">
                            <i class="bi <?php echo htmlspecialchars($s['ikon']); ?>"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="iletisim-harita">
            <iframe src="<?php echo htmlspecialchars($bilgi['harita_embed_url']); ?>" loading="lazy" allowfullscreen></iframe>
        </div>

        <header class="section-header section-header-left iletisim-noktalar-baslik">
            <h2>Hizmet Noktalarımız</h2>
        </header>

        <div class="iletisim-ust-bar">
            <div class="meclis-arama-wrap iletisim-arama-wrap">
                <input type="text" class="meclis-arama" id="iletisimArama" placeholder="Hizmet noktası ara" aria-label="Hizmet noktası ara">
                <button type="button" class="meclis-arama-ikon" id="iletisimAramaBtn" aria-label="Ara">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <div class="iletisim-filtre-dropdown-wrap">
                <button type="button" class="ebelediye-hamburger-btn" id="iletisimHamburgerBtn" aria-label="Kategoriler">
                    <i class="bi bi-list"></i>
                    <span>Filtrele</span>
                </button>
                <div class="iletisim-filtre-dropdown" id="iletisimFiltreDropdown" hidden>
                    <button type="button" class="iletisim-filtre-btn active" data-kategori="hepsi">Tümü</button>
                    <button type="button" class="iletisim-filtre-btn" data-kategori="mudurluk">Müdürlükler</button>
                    <button type="button" class="iletisim-filtre-btn" data-kategori="servis,merkezler">Merkezler</button>
                    <button type="button" class="iletisim-filtre-btn" data-kategori="sosyal-tesisler">Sosyal Tesisler</button>
                    <button type="button" class="iletisim-filtre-btn" data-kategori="egitim-merkezleri">Eğitim Merkezleri</button>
                    <button type="button" class="iletisim-filtre-btn" data-kategori="diger">Diğer</button>
                </div>
            </div>
        </div>

        <div class="iletisim-nokta-grid">
            <?php foreach ($noktaSayfalari as $sayfaIndex => $sayfaNoktalari): ?>
                <?php foreach ($sayfaNoktalari as $n): ?>
                    <div class="iletisim-nokta-kart iletisim-nokta-sayfa"
                         data-sayfa="<?php echo $sayfaIndex + 1; ?>"
                         data-kategori="<?php echo htmlspecialchars($n['kategori']); ?>"
                         data-ara="<?php echo htmlspecialchars(mb_strtolower($n['baslik'] . ' ' . $n['konum'], 'UTF-8')); ?>"
                         <?php echo $sayfaIndex > 0 ? 'style="display:none;"' : ''; ?>>
                        <h4><?php echo htmlspecialchars($n['baslik']); ?></h4>
                        <p><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($n['konum']); ?></p>
                        <?php if (!empty($n['google_maps_url'])): ?>
                            <a class="iletisim-nokta-konum-btn" href="<?php echo htmlspecialchars($n['google_maps_url']); ?>" target="_blank" rel="noopener">
                                <i class="bi bi-pin-map"></i> Konuma Git
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>

        <?php if (count($noktaSayfalari) > 1): ?>
            <div class="meclis-sayfalama" id="iletisimSayfalama">
                <button type="button" class="meclis-sayfa-btn iletisim-sayfa-ok" id="iletisimOnceki" aria-label="Önceki sayfa"><i class="bi bi-chevron-left"></i></button>
                <?php foreach ($noktaSayfalari as $sayfaIndex => $sayfaNoktalari): ?>
                    <button type="button" class="meclis-sayfa-btn<?php echo $sayfaIndex === 0 ? ' active' : ''; ?>" data-sayfa-git="<?php echo $sayfaIndex + 1; ?>"><?php echo $sayfaIndex + 1; ?></button>
                <?php endforeach; ?>
                <button type="button" class="meclis-sayfa-btn iletisim-sayfa-ok" id="iletisimSonraki" aria-label="Sonraki sayfa"><i class="bi bi-chevron-right"></i></button>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
(function () {
    var TUM_KARTLAR = Array.prototype.slice.call(document.querySelectorAll('.iletisim-nokta-sayfa'));
    var SAYFA_BASI = 9;

    var filtreBtnlar = document.querySelectorAll('.iletisim-filtre-btn');
    var sayfalamaKutu = document.getElementById('iletisimSayfalama');
    var noktalarBaslik = document.querySelector('.iletisim-noktalar-baslik');
    var oncekiBtn = document.getElementById('iletisimOnceki');
    var sonrakiBtn = document.getElementById('iletisimSonraki');

    var aktifKategori = 'hepsi';
    var aktifArama = '';
    var mevcutSayfa = 1;

    // Hamburger / filtre açılır menüsü
    var hamburgerBtn = document.getElementById('iletisimHamburgerBtn');
    var filtreDropdown = document.getElementById('iletisimFiltreDropdown');

    hamburgerBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        filtreDropdown.hidden = !filtreDropdown.hidden;
    });
    document.addEventListener('click', function (e) {
        if (filtreDropdown.hidden) return;
        var tiklananHamburger = e.target.closest('#iletisimHamburgerBtn');
        var tiklananDropdown = e.target.closest('#iletisimFiltreDropdown');
        if (!tiklananHamburger && !tiklananDropdown) {
            filtreDropdown.hidden = true;
        }
    });

    function eslesenKartlariGetir() {
        return TUM_KARTLAR.filter(function (kart) {
            var kategoriUyar = true;
            if (aktifKategori !== 'hepsi') {
                var kategoriListesi = aktifKategori.split(',');
                kategoriUyar = kategoriListesi.includes(kart.getAttribute('data-kategori'));
            }
            var aramaUyar = aktifArama === '' || kart.getAttribute('data-ara').includes(aktifArama);
            return kategoriUyar && aramaUyar;
        });
    }

    function sayfalamaButonlariniOlustur(toplamSayfa) {
        if (!sayfalamaKutu) return;
        if (toplamSayfa <= 1) {
            sayfalamaKutu.style.display = 'none';
            return;
        }
        sayfalamaKutu.style.display = '';

        // Önceki/sonraki dışındaki sayı butonlarını temizleyip yeniden oluştur
        var eskiler = sayfalamaKutu.querySelectorAll('.meclis-sayfa-btn[data-sayfa-git]');
        eskiler.forEach(function (b) { b.remove(); });

        for (var i = 1; i <= toplamSayfa; i++) {
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'meclis-sayfa-btn' + (i === mevcutSayfa ? ' active' : '');
            btn.setAttribute('data-sayfa-git', i);
            btn.textContent = i;
            btn.addEventListener('click', function () {
                sayfayaGit(parseInt(this.getAttribute('data-sayfa-git'), 10), true);
            });
            sayfalamaKutu.insertBefore(btn, sonrakiBtn);
        }
    }

    function goster(kaydir) {
        var eslesenler = eslesenKartlariGetir();
        var toplamSayfa = Math.max(1, Math.ceil(eslesenler.length / SAYFA_BASI));
        if (mevcutSayfa > toplamSayfa) mevcutSayfa = toplamSayfa;

        TUM_KARTLAR.forEach(function (kart) { kart.style.display = 'none'; });

        var baslangic = (mevcutSayfa - 1) * SAYFA_BASI;
        var gosterilecekler = eslesenler.slice(baslangic, baslangic + SAYFA_BASI);
        gosterilecekler.forEach(function (kart) { kart.style.display = ''; });

        sayfalamaButonlariniOlustur(toplamSayfa);

        if (kaydir && noktalarBaslik) {
            noktalarBaslik.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function sayfayaGit(n, kaydir) {
        mevcutSayfa = n;
        goster(kaydir);
    }

    function filtreUygula(kategoriDegeri, kaydir) {
        aktifKategori = kategoriDegeri;
        mevcutSayfa = 1;
        filtreBtnlar.forEach(function (btn) {
            btn.classList.toggle('active', btn.getAttribute('data-kategori') === kategoriDegeri);
        });
        goster(kaydir);
        filtreDropdown.hidden = true;
    }

    filtreBtnlar.forEach(function (btn) {
        btn.addEventListener('click', function () {
            filtreUygula(btn.getAttribute('data-kategori'), true);
        });
    });

    if (oncekiBtn) {
        oncekiBtn.addEventListener('click', function () {
            var eslesenler = eslesenKartlariGetir();
            var toplamSayfa = Math.max(1, Math.ceil(eslesenler.length / SAYFA_BASI));
            var hedef = mevcutSayfa > 1 ? mevcutSayfa - 1 : toplamSayfa;
            sayfayaGit(hedef, true);
        });
    }
    if (sonrakiBtn) {
        sonrakiBtn.addEventListener('click', function () {
            var eslesenler = eslesenKartlariGetir();
            var toplamSayfa = Math.max(1, Math.ceil(eslesenler.length / SAYFA_BASI));
            var hedef = mevcutSayfa < toplamSayfa ? mevcutSayfa + 1 : 1;
            sayfayaGit(hedef, true);
        });
    }

    // Arama
    var arama = document.getElementById('iletisimArama');
    var aramaBtn = document.getElementById('iletisimAramaBtn');

    function aramaUygula() {
        aktifArama = arama.value.toLocaleLowerCase('tr-TR').trim();
        mevcutSayfa = 1;
        goster(false);
    }

    arama.addEventListener('input', aramaUygula);
    aramaBtn.addEventListener('click', function () {
        arama.focus();
        aramaUygula();
    });

    // İlk yükleme
    goster(false);
})();
</script>

<?php include '../../includes/footer.php'; ?>