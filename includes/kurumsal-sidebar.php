<?php
// Bu dosya sadece Kurumsal menü sayfaları (Vizyonumuz, Misyonumuz, vb.)
// tarafından kullanılır. Her sayfa, include etmeden önce
// $currentKurumsalPage değişkenini kendi anahtarıyla tanımlamalı.
if (!isset($currentKurumsalPage)) {
    $currentKurumsalPage = '';
}

$kurumsalMenu = [
    'vizyon'          => ['label' => 'Vizyonumuz',          'href' => 'vizyonumuz.php'],
    'misyon'          => ['label' => 'Misyonumuz',          'href' => 'misyonumuz.php'],
    'ilkeler'         => ['label' => 'İlkelerimiz',         'href' => 'ilkelerimiz.php'],
    'enerji'          => ['label' => 'Enerji Politikamız',  'href' => 'enerji-politikamiz.php'],
    'meclis'          => ['label' => 'Belediye Meclisi',    'href' => 'belediye-meclisi.php'],
    'yonetim-semasi'  => ['label' => 'Yönetim Şeması',      'href' => 'yonetim-semasi.php'],
    'baskan-yrd'      => ['label' => 'Başkan Yardımcıları', 'href' => 'baskan-yardimcilari.php'],
    'baskan-dan'      => ['label' => 'Başkan Danışmanları', 'href' => 'baskan-danismanlari.php'],
    'mudurlukler'     => ['label' => 'Müdürlükler',         'href' => 'mudurlukler.php'],
    'eski-baskanlar'  => ['label' => 'Eski Başkanlar',      'href' => '#'],
    'arabuluculuk'    => ['label' => 'Arabuluculuk Komisyonu', 'href' => '#'],
    'etik'            => ['label' => 'Etik Komisyonu',      'href' => '#'],
    'meclis-kararlari'=> ['label' => 'Meclis Kararları',    'href' => '#'],
    'kimlik'          => ['label' => 'Kurumsal Kimlik',     'href' => '#'],
    'raporlar'        => ['label' => 'Kurumsal Raporlar',   'href' => '#'],
    'dokumanlar'      => ['label' => 'Kurumsal Dökümanlar', 'href' => '#'],
    'yayinlar'        => ['label' => 'Yayınlar',            'href' => '#'],
];
?>
<aside class="kurumsal-sidebar">
    <h3>Kurumsal</h3>
    <ul>
        <?php foreach ($kurumsalMenu as $key => $item): ?>
            <li<?php echo $key === $currentKurumsalPage ? ' class="active"' : ''; ?>>
                <a href="<?php echo $item['href']; ?>"><?php echo htmlspecialchars($item['label']); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>