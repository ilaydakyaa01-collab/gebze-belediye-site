<?php
include '../includes/db.php';

// Silme işlemi
if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $stmt = $conn->prepare("DELETE FROM haberler WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: haber-yonet.php");
    exit;
}

$stmt = $conn->query("SELECT * FROM haberler ORDER BY tarih DESC");
$haberler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Haberleri Yönet - Admin Paneli</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Gebze Belediyesi - Admin Paneli</h1>
        <nav>
            <a href="../index.php">Ana Sayfa</a>
            <a href="../pages/haberler.php">Haberler</a>
            <a href="haber-ekle.php">Haber Ekle</a>
        </nav>
    </header>
    <main style="padding: 20px;">
        <h2>Haberleri Yönet</h2>

        <?php foreach ($haberler as $haber): ?>
            <div style="background: white; padding: 15px; margin-bottom: 15px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3><?php echo htmlspecialchars($haber['baslik']); ?></h3>
                    <small><?php echo $haber['tarih']; ?></small>
                </div>
                <div>
                    <a href="haber-duzenle.php?id=<?php echo $haber['id']; ?>" style="margin-right: 10px; color: blue;">Düzenle</a>
                    <a href="haber-yonet.php?sil=<?php echo $haber['id']; ?>" 
                       onclick="return confirm('Bu haberi silmek istediğinize emin misiniz?');" 
                       style="color: red;">Sil</a>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>