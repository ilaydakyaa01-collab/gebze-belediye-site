<?php
// Bu dosya, veritabanında saklanan fotoğrafları tarayıcıya gösterir.
// Kullanımı: <img src="includes/resim-goster.php?tablo=meclis_uyeleri&id=5">
include 'db.php';

// Güvenlik: sadece izin verilen tablolardan okunabilir
$izinliTablolar = ['meclis_uyeleri', 'mudurlukler', 'baskan_yardimcilari', 'mahalle_muhtarlari', 'fotograf_galerisi', 'tarihi_yerler', 'tarihi_yerler_galeri', 'uye_birlikler', 'sanal_tur', 'tarihce_galeri', 'bugunku_gebze_galeri'];

$tablo = isset($_GET['tablo']) ? $_GET['tablo'] : '';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if (!in_array($tablo, $izinliTablolar, true) || $id <= 0) {
    http_response_code(404);
    exit;
}

$stmt = $conn->prepare("SELECT resim_verisi, resim_turu FROM `$tablo` WHERE id = ?");
$stmt->execute([$id]);
$satir = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$satir || empty($satir['resim_verisi'])) {
    http_response_code(404);
    exit;
}

header('Content-Type: ' . $satir['resim_turu']);
header('Cache-Control: public, max-age=86400');
echo $satir['resim_verisi'];