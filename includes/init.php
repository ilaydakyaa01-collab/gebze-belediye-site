<?php
/**
 * Sayfa yolu: kökten '' , alt klasörlerden '../'
 * Örnek: $basePath = '../'; include '../includes/header.php';
 */
if (!isset($basePath)) {
    $basePath = '';
}

if (!isset($pageTitle)) {
    $pageTitle = 'Gebze Belediyesi';
}

if (!isset($navTransparent)) {
    $navTransparent = false;
}

if (!isset($navScrolled)) {
    $navScrolled = !$navTransparent;
}

if (!function_exists('trTarih')) {
    function trTarih(string $tarih, ?array $aylar = null): string {
        static $defaultAylar = [
            1 => 'Ocak', 2 => 'Şubat', 3 => 'Mart', 4 => 'Nisan',
            5 => 'Mayıs', 6 => 'Haziran', 7 => 'Temmuz', 8 => 'Ağustos',
            9 => 'Eylül', 10 => 'Ekim', 11 => 'Kasım', 12 => 'Aralık'
        ];
        $aylar = $aylar ?? $defaultAylar;
        $ts = strtotime($tarih);
        return date('d', $ts) . ' ' . $aylar[(int) date('n', $ts)] . ' ' . date('Y', $ts);
    }
}

if (!function_exists('projeDurumYazi')) {
    function projeDurumYazi(string $durum): string {
        $normalize = trim(mb_strtolower($durum, 'UTF-8'));
        return match (true) {
            in_array($normalize, ['tamamlanan', 'tamamlandi', 'tamamlandı'], true) => 'Tamamlanan',
            in_array($normalize, ['planlanan', 'planlaniyor', 'planlanıyor'], true) => 'Planlanan',
            in_array($normalize, ['devam', 'devam_eden', 'devam eden', 'devameden'], true) => 'Devam Eden',
            default => 'Devam Eden',
        };
    }
}

if (!function_exists('projeDurumAnahtari')) {
    /**
     * projeler.durum sütunundaki değeri, filtre butonlarının
     * data-filter değerleriyle (devam/tamamlanan/planlanan) birebir
     * eşleşecek "temiz" bir anahtara çevirir. data-durum özelliğinde
     * bunu kullanmak, yazım farklarından dolayı filtrelemenin boş
     * sonuç dönmesini engeller.
     */
    function projeDurumAnahtari(string $durum): string {
        $normalize = trim(mb_strtolower($durum, 'UTF-8'));
        return match (true) {
            in_array($normalize, ['tamamlanan', 'tamamlandi', 'tamamlandı'], true) => 'tamamlanan',
            in_array($normalize, ['planlanan', 'planlaniyor', 'planlanıyor'], true) => 'planlanan',
            default => 'devam',
        };
    }
}