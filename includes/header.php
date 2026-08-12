<?php
require_once __DIR__ . '/init.php';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="Gebze Belediyesi resmi web sayfası.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>css/style.css">
    <?php if (!empty($extraCss)): ?>
    <link rel="stylesheet" href="<?php echo $basePath . $extraCss; ?>">
    <?php endif; ?>
</head>
<body<?php echo !empty($bodyClass) ? ' class="' . htmlspecialchars($bodyClass) . '"' : ''; ?>>

<nav class="site-nav<?php echo $navTransparent ? ' nav-transparent' : ' nav-solid is-scrolled'; ?>" id="siteNav"<?php echo $navTransparent ? ' data-transparent="1"' : ''; ?>>
    <div class="container nav-inner">
        <a href="<?php echo $basePath; ?>index.php" class="nav-brand">
            <img src="<?php echo $basePath; ?>img/logo-beyaz.png" alt="Gebze Belediyesi">
        </a>

        <ul class="nav-links" id="navLinks">
            <li class="has-dropdown">
                <a href="<?php echo $basePath; ?>pages/baskan/ozgecmis.php">Başkan</a>
                <ul class="dropdown">
                    <li><a href="<?php echo $basePath; ?>pages/baskan/ozgecmis.php">Özgeçmiş</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/baskan/projeler.php">Projeler</a></li>
                    <li><a href="https://www.zinnurbuyukgoz.com" target="_blank" rel="noopener">Başkanın Web Sayfası</a></li>
                </ul>
            </li>
            <li class="has-dropdown">
                <a href="#">Kurumsal</a>
                <ul class="dropdown">
                    <li><a href="<?php echo $basePath; ?>pages/vizyonumuz.php">Vizyonumuz</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/misyonumuz.php">Misyonumuz</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/ilkelerimiz.php">İlkelerimiz</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/enerji-politikamiz.php">Enerji Politikamız</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/belediye-meclisi.php">Belediye Meclisi</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/mudurlukler.php">Müdürlükler</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/yonetim-semasi.php">Yönetim Şeması</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/baskan-yardimcilari.php">Başkan Yardımcıları</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/baskan-danismanlari.php">Başkan Danışmanı</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/arabuluculuk-komisyonu.php">Arabuluculuk Komisyonu</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/etik-komisyonu.php">Etik Komisyonu</a></li>
                </ul>
            </li>
            <li class="has-dropdown">
                <a href="#">Gebze</a>
                <ul class="dropdown">
                    <li><a href="<?php echo $basePath; ?>pages/gebze/tarihce.php">Tarihçe</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/gebze/bugunku-gebze.php">Bugünkü Gebze</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/gebze/mahalle-muhtarlari.php">Mahalle Muhtarları</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/gebze/tarihi-yerler.php">Tarihi Yerler</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/gebze/fotograf-galerisi.php">Fotoğraflarla Gebze</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/gebze/kardes-sehirler.php">Kardeş Şehirler</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/gebze/birlikler.php">Üye Olduğumuz Birlikler</a></li>
                    <li><a href="<?php echo $basePath; ?>pages/gebze/sanal-tur.php">360 Sanal Tur</a></li>
                </ul>
            </li>
            <li><a href="#">Hizmetler</a></li>
            <li><a href="#">E-Belediye</a></li>
            <li><a href="<?php echo $basePath; ?>pages/haberler.php">Haberler</a></li>
            <li><a href="<?php echo $basePath; ?>index.php#iletisim">İletişim</a></li>
        </ul>

        <button class="nav-toggle" id="navToggle" aria-label="Menüyü aç" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<div class="mobile-menu" id="mobileMenu" hidden>
    <div class="mobile-menu-header">
        <img src="<?php echo $basePath; ?>img/logo-beyaz.png" alt="" class="mobile-logo">
        <button type="button" id="navClose" aria-label="Menüyü kapat">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <a href="<?php echo $basePath; ?>index.php">Ana Sayfa</a>
    <a href="<?php echo $basePath; ?>pages/baskan/ozgecmis.php">Başkan</a>
    <a href="#">Kurumsal</a>
    <a href="#">Gebze</a>
    <a href="#">Hizmetler</a>
    <a href="#">E-Belediye</a>
    <a href="<?php echo $basePath; ?>pages/haberler.php">Haberler</a>
    <a href="<?php echo $basePath; ?>index.php#iletisim">İletişim</a>
</div>
<div class="mobile-backdrop" id="mobileBackdrop" hidden></div>