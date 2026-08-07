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
        return match ($durum) {
            'tamamlanan' => 'Tamamlanan',
            'planlanan' => 'Planlanan',
            default => 'Devam Eden',
        };
    }
}
