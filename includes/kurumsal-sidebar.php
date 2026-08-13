<?php
// Bu dosya sadece Kurumsal menü sayfaları (Vizyonumuz, Misyonumuz, vb.)
// tarafından kullanılır. Her sayfa, include etmeden önce
// $currentKurumsalPage değişkenini kendi anahtarıyla tanımlamalı.
if (!isset($currentKurumsalPage)) {
    $currentKurumsalPage = '';
}

$kurumsalMenu = [
    'vizyon'          => ['label' => 'Vizyonumuz',           'href' => 'vizyonumuz.php'],
    'misyon'          => ['label' => 'Misyonumuz',           'href' => 'misyonumuz.php'],
    'ilkeler'         => ['label' => 'İlkelerimiz',          'href' => 'ilkelerimiz.php'],
    'enerji'          => ['label' => 'Enerji Politikamız',   'href' => 'enerji-politikamiz.php'],
    'meclis'          => ['label' => 'Belediye Meclisi',     'href' => 'belediye-meclisi.php'],
    'yonetim-semasi'  => ['label' => 'Yönetim Şeması',       'href' => 'yonetim-semasi.php'],
    'baskan-yrd'      => ['label' => 'Başkan Yardımcıları',  'href' => 'baskan-yardimcilari.php'],
    'baskan-dan'      => ['label' => 'Başkan Danışmanları',  'href' => 'baskan-danismanlari.php'],
    'mudurlukler'     => ['label' => 'Müdürlükler',          'href' => 'mudurlukler.php'],
    'eski-baskanlar'  => ['label' => 'Eski Başkanlar',       'href' => 'eski-baskanlar.php'],
    'arabuluculuk'    => ['label' => 'Arabuluculuk Komisyonu', 'href' => 'arabuluculuk-komisyonu.php'],
    'etik'            => ['label' => 'Etik Komisyonu',       'href' => 'etik-komisyonu.php'],
    'meclis-kararlari'=> ['label' => 'Meclis Kararları',     'href' => 'meclis-kararlari.php'],
    'kimlik'          => ['label' => 'Kurumsal Kimlik',      'href' => 'kurumsal-kimlik.php'],
    'raporlar'        => ['label' => 'Kurumsal Raporlar',    'href' => 'kurumsal-raporlar.php'],
    'dokumanlar'      => ['label' => 'Kurumsal Dökümanlar',  'href' => 'kurumsal-dokumanlar.php'],
    'yayinlar'        => ['label' => 'Yayınlar',             'href' => 'yayinlar.php'],
    'kvkk-aydınlatma' => ['label' => 'KVKK Aydınlatma Metni','href' => 'kvkk.php'],
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