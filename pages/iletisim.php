<?php
/**
 * İLETİŞİM SAYFASI
 * -------------------------------------------------------------
 * Üst kısım (adres/telefon/e-posta/harita) statik bilgi.
 * Alt kısımdaki "Hizmet Noktalarımız" ise hizmet_noktalari
 * tablosundan, kategoriye göre filtrelenebilir şekilde geliyor.
 */

include '../includes/db.php';
require_once '../includes/init.php';

$basePath = '../';
$pageTitle = 'İletişim - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';
$extraCss = 'css/iletisim.css';

$hizmetNoktalari = [];
try {
    $stmt = $conn->query("SELECT * FROM hizmet_noktalari ORDER BY sira ASC, id ASC");
    if ($stmt) {
        $hizmetNoktalari = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (\Throwable $e) {
    $hizmetNoktalari = [];
}

$kategoriEtiketleri = [
    'mudurlukler' => 'Müdürlükler',
    'merkezler' => 'Merkezler',
    'sosyal_tesisler' => 'Sosyal Tesisler',
    'egitim_merkezleri' => 'Eğitim Merkezleri',
    'diger' => 'Diğer',
];

include '../includes/header.php';
?>

<main class="iletisim-bolumu page-content">
    <div class="container">
        <nav class="iletisim-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>İletişim</span>
        </nav>

        <header class="iletisim-ustbaslik">
            <h1>İletişim</h1>
            <p>Bize aşağıdaki kanallardan ulaşabilirsiniz.</p>
        </header>

        <div class="iletisim-ust-alan">
            <div class="iletisim-harita-sarici">
                <iframe
                    src="https://www.google.com/maps?q=G%C3%BCzeller%20Mahallesi%2C%20Bahar%20Caddesi%20No%3A1%2C%2041400%20Gebze%2FKocaeli&output=embed"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Gebze Belediyesi Konumu">
                </iframe>
            </div>

            <div class="iletisim-kartlar">
                <div class="iletisim-bilgi-kart">
                    <h3><i class="bi bi-telephone"></i> Telefon &amp; Adres</h3>
                    <p><strong>Telefon:</strong> <a href="tel:+902626420430">0262 642 04 30</a></p>
                    <p><strong>Faks:</strong> 0262 642 04 38</p>
                    <p><strong>Adres:</strong> Güzeller Mahallesi, Bahar Caddesi No:1, 41400 Gebze/Kocaeli</p>
                </div>

                <div class="iletisim-bilgi-kart">
                    <h3><i class="bi bi-envelope"></i> E-posta</h3>
                    <p><strong>Belediye:</strong> <a href="mailto:[email protected]">[email protected]</a></p>
                    <p><strong>KEP:</strong> [email protected]</p>
                </div>

                <div class="iletisim-bilgi-kart">
                    <h3><i class="bi bi-share"></i> Sosyal Medya</h3>
                    <div class="iletisim-sosyal">
                        <a href="https://wa.me/902626420430" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        <a href="https://www.facebook.com/gebzebelediye" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://twitter.com/gebze_belediye" target="_blank" rel="noopener" aria-label="X (Twitter)"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://www.instagram.com/gebze_belediyesi" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/channel/UCj2OaUgzp76dOS2jTlz2frg/" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <section class="hn-bolumu">
            <h2 class="hn-baslik">Hizmet Noktalarımız</h2>

            <div class="hn-filtreler" role="tablist" aria-label="Hizmet noktası filtreleri">
                <button type="button" class="hn-filtre is-active" data-filter="tumu">Tümü</button>
                <?php foreach ($kategoriEtiketleri as $anahtar => $etiket): ?>
                    <button type="button" class="hn-filtre" data-filter="<?php echo htmlspecialchars($anahtar); ?>"><?php echo htmlspecialchars($etiket); ?></button>
                <?php endforeach; ?>
            </div>

            <?php if (count($hizmetNoktalari) > 0): ?>
                <div class="hn-grid" id="hnGrid">
                    <?php foreach ($hizmetNoktalari as $hn): ?>
                        <div class="hn-kart" data-kategori="<?php echo htmlspecialchars($hn['kategori']); ?>">
                            <span class="hn-etiket"><?php echo htmlspecialchars($kategoriEtiketleri[$hn['kategori']] ?? 'Diğer'); ?></span>
                            <h3><?php echo htmlspecialchars($hn['baslik']); ?></h3>
                            <?php if (!empty($hn['adres'])): ?>
                                <p class="hn-satir"><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($hn['adres']); ?></p>
                                <a class="hn-konum-btn" href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($hn['adres']); ?>" target="_blank" rel="noopener">
                                    <i class="bi bi-signpost-2"></i> Konuma Git
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="hn-bos" id="hnBosMesaj" hidden>Bu kategoride hizmet noktası bulunamadı.</p>
            <?php else: ?>
                <p class="hn-bos">Henüz hizmet noktası eklenmemiş.</p>
            <?php endif; ?>
        </section>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filtreBtnlar = document.querySelectorAll('.hn-filtre');
    const kartlar = document.querySelectorAll('.hn-kart');
    const bosMesaj = document.getElementById('hnBosMesaj');

    filtreBtnlar.forEach(function (btn) {
        btn.addEventListener('click', function () {
            filtreBtnlar.forEach(function (b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');

            const secilen = btn.dataset.filter;
            let gorunenSayisi = 0;

            kartlar.forEach(function (kart) {
                const goster = secilen === 'tumu' || kart.dataset.kategori === secilen;
                kart.style.display = goster ? '' : 'none';
                if (goster) gorunenSayisi++;
            });

            if (bosMesaj) bosMesaj.hidden = gorunenSayisi > 0;
        });
    });
});
</script>

<?php include '../includes/footer.php'; ?>