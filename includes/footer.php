<?php
require_once __DIR__ . '/init.php';
require_once __DIR__ . '/db.php';

$footerBilgi = $conn->query("SELECT * FROM iletisim_bilgileri LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$footerSosyal = $conn->query("SELECT * FROM iletisim_sosyal_medya ORDER BY sira ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<footer class="site-footer" id="iletisim">
    <div class="container footer-flex-container">
        <!-- 1. SOL SÜTUN: Orijinal class ismi (footer-brand) korundu, yazı tipi ve turuncu ikonlar geri geldi -->
        <div class="footer-brand footer-brand-sinitla">
            <img src="<?php echo $basePath; ?>img/logo-beyaz.png" alt="Gebze Belediyesi" class="footer-logo">
            <div class="footer-social">
                <?php foreach ($footerSosyal as $s): ?>
                    <a href="<?php echo htmlspecialchars($s['url']); ?>" target="_blank" rel="noopener" aria-label="<?php echo htmlspecialchars($s['platform']); ?>">
                        <i class="bi <?php echo htmlspecialchars($s['ikon']); ?>"></i>
                    </a>
                <?php endforeach; ?>
            </div>
            <p><i class="bi bi-telephone-fill"></i> <?php echo htmlspecialchars($footerBilgi['telefon']); ?></p>
            <p><i class="bi bi-envelope-fill"></i> <?php echo htmlspecialchars($footerBilgi['eposta']); ?></p>
            <p><i class="bi bi-geo-alt-fill"></i> <?php echo htmlspecialchars($footerBilgi['adres']); ?></p>
        </div>

        <!-- 2. SÜTUN: Hızlı Erişim -->
        <div class="footer-col">
            <h3>Hızlı Erişim</h3>
            <ul>
                <li><a href="<?php echo $basePath; ?>index.php">Ana Sayfa</a></li>
                <li><a href="<?php echo $basePath; ?>pages/ebelediye/ebelediye.php">E-Belediye</a></li>
                <li><a href="<?php echo $basePath; ?>pages/hizmetler.php">Hizmetler</a></li>
                <li><a href="#">Etkinlikler</a></li>
                <li><a href="<?php echo $basePath; ?>pages/haberler.php">Haberler</a></li>
                <li><a href="#">Duyurular</a></li>
                <li><a href="<?php echo $basePath; ?>pages/iletisim/iletisim.php">İletişim</a></li>
            </ul>
        </div>

        <!-- 3. SÜTUN: Kurumsal -->
        <div class="footer-col footer-kurumsal-col">
            <h3 class="footer-kurumsal-baslik">Kurumsal</h3>
            <div class="footer-kurumsal-iki-sutun">
                <ul>
                    <li><a href="<?php echo $basePath; ?>pages/vizyonumuz.php">Vizyonumuz</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/misyonumuz.php">Misyonumuz</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/ilkelerimiz.php">İlkelerimiz</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/enerji-politikamiz.php">Enerji Politikamız</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/belediye-meclisi.php">Belediye Meclisi</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/yonetim-semasi.php">Yönetim Şeması</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/baskan-yardimcilari.php">Başkan Yardımcıları</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/baskan-danismanlari.php">Başkan Danışmanları</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/mudurlukler.php">Müdürlükler</a></li>
                </ul>
                <ul>
                    <li><a href="<?php echo $basePath; ?>pages/eski-baskanlar.php">Eski Başkanlar</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/arabuluculuk-komisyonu.php">Arabuluculuk Komisyonu</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/etik-komisyonu.php">Etik Komisyonu</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/meclis-kararlari.php">Meclis Kararları</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal-kimlik.php">Kurumsal Kimlik</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal-raporlar.php">Kurumsal Raporlar</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal-dokumanlar.php">Kurumsal Dokümanlar</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/yayinlar.php">Yayınlar</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/kvkk.php">KVKK Aydınlatma Metni</a></li>
                </ul>
            </div>
        </div>

        <!-- 4. SÜTUN: Gebze -->
        <div class="footer-col">
            <h3>Gebze</h3>
            <ul>
                <li><a href="<?php echo $basePath; ?>pages/gebze/tarihce.php">Tarihçe</a></li>
                <li><a href="<?php echo $basePath; ?>pages/gebze/bugunku-gebze.php">Bugünkü Gebze</a></li>
                <li><a href="<?php echo $basePath; ?>pages/gebze/mahalle-muhtarlari.php">Mahalle Muhtarları</a></li>
                <li><a href="<?php echo $basePath; ?>pages/gebze/tarihi-yerler.php">Tarihi Yerler</a></li>
                <li><a href="<?php echo $basePath; ?>pages/gebze/fotograf-galerisi.php">Fotoğraflarla Gebze</a></li>
                <li><a href="<?php echo $basePath; ?>pages/gebze/kardes-sehirler.php">Kardeş Şehirler</a></li>
                <li><a href="<?php echo $basePath; ?>pages/gebze/birlikler.php">Üye Olduğumuz Birlikler</a></li>
                <li><a href="<?php echo $basePath; ?>pages/gebze/sanal-tur.php">360 Sanal Tur</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© <?php echo date('Y'); ?> Gebze Belediyesi — Tüm hakları saklıdır.</p>
    </div>
</footer>

<style>
/* Ana taşıyıcı flex yapısı */
.footer-flex-container {
    display: flex !important;
    justify-content: space-between !important;
    align-items: flex-start !important;
    gap: 1.5rem !important;
}

/* Sol taraftaki iletişim alanını adres 2 satırda kalacak şekilde sınırlama */
.footer-brand-sinitla {
    max-width: 250px !important;
    flex-shrink: 0 !important;
}

.footer-col {
    flex-shrink: 0 !important;
}

/* Kurumsal bloğu sola hizalama */
.footer-kurumsal-col {
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-start !important;
}

.footer-kurumsal-baslik {
    text-align: left !important;
    position: relative !important;
    width: 100% !important;
}

.footer-kurumsal-baslik::after {
    left: 0 !important;
    transform: none !important;
}

.footer-kurumsal-iki-sutun {
    display: flex !important;
    gap: 1.8rem !important;
}

.footer-kurumsal-iki-sutun a {
    white-space: nowrap !important;
    font-size: 0.86rem !important;
}

/* Mobil / Tablet Uyumluluğu */
@media (max-width: 992px) {
    .footer-flex-container {
        flex-wrap: wrap !important;
        gap: 2rem !important;
    }
    .footer-brand-sinitla {
        max-width: 100% !important;
    }
}
</style>

<script src="<?php echo $basePath; ?>js/main.js"></script>
</body>
</html>