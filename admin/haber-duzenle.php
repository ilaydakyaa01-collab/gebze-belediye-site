<?php
include '../includes/db.php';

$id = $_GET['id'];

// Form gönderildiyse güncelle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];
    $resim = $_POST['resim'];

    $stmt = $conn->prepare("UPDATE haberler SET baslik = ?, icerik = ?, resim = ? WHERE id = ?");
    $stmt->execute([$baslik, $icerik, $resim, $id]);

    header("Location: haber-yonet.php");
    exit;
}

// Mevcut haberi çek
$stmt = $conn->prepare("SELECT * FROM haberler WHERE id = ?");
$stmt->execute([$id]);
$haber = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Haber Düzenle - Admin Paneli</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Gebze Belediyesi - Admin Paneli</h1>
        <nav>
            <a href="../index.php">Ana Sayfa</a>
            <a href="../pages/haberler.php">Haberler</a>
            <a href="haber-yonet.php">Haberleri Yönet</a>
        </nav>
    </header>
    <main style="padding: 20px; max-width: 600px;">
        <h2>Haberi Düzenle</h2>

        <form method="POST">
            <label>Başlık:</label><br>
            <input type="text" name="baslik" value="<?php echo htmlspecialchars($haber['baslik']); ?>" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

            <label>İçerik:</label><br>
            <textarea name="icerik" rows="5" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><?php echo htmlspecialchars($haber['icerik']); ?></textarea><br>

            <label>Resim URL:</label><br>
            <input type="text" name="resim" value="<?php echo htmlspecialchars($haber['resim']); ?>" style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

            <button type="submit" style="background: #003366; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                Güncelle
            </button>
        </form>
    </main>
</body>
</html>
