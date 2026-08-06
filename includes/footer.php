<?php
require_once __DIR__ . '/init.php';
?>
<footer class="site-footer" id="iletisim">
    <div class="container footer-grid">
        <div class="footer-brand">
            <img src="<?php echo $basePath; ?>img/logo-beyaz.png" alt="Gebze Belediyesi" class="footer-logo">
            <div class="footer-social">
                <a href="https://wa.me/902626420430" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                <a href="https://www.facebook.com/gebzebelediye" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com/gebze_belediye" aria-label="X"><i class="bi bi-twitter-x"></i></a>
                <a href="https://www.instagram.com/gebze_belediyesi" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://www.youtube.com/channel/UCj2OaUgzp76dOS2jTlz2frg/" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
            </div>
            <p><i class="bi bi-telephone-fill"></i> +90 262 642 04 30</p>
            <p><i class="bi bi-envelope-fill"></i> gebze@gebze.bel.tr</p>
            <p><i class="bi bi-geo-alt-fill"></i> Güzeller Mah. Bahar Cad. No:1 Gebze / Kocaeli</p>
        </div>
        <div>
            <h3>Hızlı Erişim</h3>
            <ul>
                <li><a href="<?php echo $basePath; ?>index.php">Ana Sayfa</a></li>
                <li><a href="#">E-Belediye</a></li>
                <li><a href="#">Hizmetler</a></li>
                <li><a href="<?php echo $basePath; ?>pages/haberler.php">Haberler</a></li>
                <li><a href="<?php echo $basePath; ?>index.php#iletisim">İletişim</a></li>
            </ul>
        </div>
        <div>
            <h3>Kurumsal</h3>
            <ul>
                <li><a href="#">Vizyonumuz</a></li>
                <li><a href="#">Misyonumuz</a></li>
                <li><a href="#">Belediye Meclisi</a></li>
                <li><a href="#">Müdürlükler</a></li>
                <li><a href="#">Kurumsal Raporlar</a></li>
            </ul>
        </div>
        <div>
            <h3>Gebze</h3>
            <ul>
                <li><a href="#">Tarihçe</a></li>
                <li><a href="#">Bugünkü Gebze</a></li>
                <li><a href="#">Mahalle Muhtarları</a></li>
                <li><a href="#">Tarihi Yerler</a></li>
                <li><a href="#">360 Sanal Tur</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© <?php echo date('Y'); ?> Gebze Belediyesi — Tüm hakları saklıdır.</p>
    </div>
</footer>

<script src="<?php echo $basePath; ?>js/main.js"></script>
</body>
</html>
