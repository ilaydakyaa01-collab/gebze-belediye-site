<?php
// Bu dosya sadece pages/gebze/ klasöründeki sayfalar (Tarihçe, Bugünkü Gebze, vb.)
// tarafından kullanılır. Her sayfa, include etmeden önce
// $currentGebzePage değişkenini kendi anahtarıyla tanımlamalı.
if (!isset($currentGebzePage)) {
    $currentGebzePage = '';
}

$gebzeMenu = [
    'tarihce'         => ['label' => 'Tarihçe',              'href' => 'tarihce.php'],
    'bugunku-gebze'   => ['label' => 'Bugünkü Gebze',        'href' => 'bugunku-gebze.php'],
    'muhtarlar'       => ['label' => 'Mahalle Muhtarları',   'href' => 'mahalle-muhtarlari.php'],
    'tarihi-yerler'   => ['label' => 'Tarihi Yerler',        'href' => 'tarihi-yerler.php'],
    'foto-galeri'     => ['label' => 'Fotoğraflarla Gebze',  'href' => 'fotograf-galerisi.php'],
    'kardes-sehirler' => ['label' => 'Kardeş Şehirler',      'href' => 'kardes-sehirler.php'],
    'birlikler'       => ['label' => 'Üye Olduğumuz Birlikler', 'href' => 'birlikler.php'],
    'sanal-tur'       => ['label' => '360 Sanal Tur',        'href' => 'sanal-tur.php'],
];
?>
<aside class="kurumsal-sidebar">
    <h3>Gebze</h3>
    <ul>
        <?php foreach ($gebzeMenu as $key => $item): ?>
            <li<?php echo $key === $currentGebzePage ? ' class="active"' : ''; ?>>
                <a href="<?php echo $item['href']; ?>"><?php echo htmlspecialchars($item['label']); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>