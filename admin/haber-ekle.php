<?php
include '../includes/db.php';

$mesaj = "";

// Form gönderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];
    $resim = $_POST['resim'];

    $stmt = $conn->prepare("INSERT INTO haberler (baslik, icerik, resim, tarih) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$baslik, $icerik, $resim]);

    $mesaj = "Haber başarıyla eklendi!";
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Haber Ekle - Admin Paneli</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Gebze Belediyesi - Admin Paneli</h1>
        <nav>
            <a href="../index.php">Ana Sayfa</a>
            <a href="../pages/haberler.php">Haberler</a>
        </nav>
    </header>
    <main style="padding: 20px; max-width: 600px;">
        <h2>Yeni Haber Ekle</h2>

        <?php if ($mesaj): ?>
            <p style="color: green; font-weight: bold;"><?php echo $mesaj; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Başlık:</label><br>
            <input type="text" name="baslik" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

            <label>İçerik:</label><br>
            <textarea name="icerik" rows="5" required style="width: 100%; padding: 8px; margin-bottom: 10px;"></textarea><br>

            <label>Resim URL (isteğe bağlı):</label><br>
            <input type="text" name="resim" style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

            <button type="submit" style="background: #003366; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                Haberi Kaydet
            </button>
        </form>
    </main>
</body>
</html>