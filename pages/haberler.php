<?php
include '../includes/db.php';

$stmt = $conn->query("SELECT * FROM haberler ORDER BY tarih DESC");
$haberler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Haberler - Gebze Belediyesi</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Gebze Belediyesi - Haberler</h1>
    </header>
    <main style="padding: 20px;">
        <?php if (count($haberler) > 0): ?>
            <?php foreach ($haberler as $haber): ?>
                <div style="background: white; padding: 15px; margin-bottom: 15px; border-radius: 8px;">
                    <h2><?php echo htmlspecialchars($haber['baslik']); ?></h2>
                    <p><?php echo htmlspecialchars($haber['icerik']); ?></p>
                    <small><?php echo $haber['tarih']; ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Henüz haber eklenmemiş.</p>
        <?php endif; ?>
    </main>
</body>
</html>
