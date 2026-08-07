<?php
include '../includes/db.php';

$basePath = '../';
$pageTitle = 'Videolar - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';

$stmt = $conn->query("SELECT youtube_id, baslik FROM videolar ORDER BY id ASC");
$videolar = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
?>

<main class="haber-bolumu page-content">
    <div class="container">
        <header class="section-header">
            <h2>Videolar</h2>
            <p>Belediyemizin video arşivi.</p>
        </header>
        <div class="haber-grid">
            <?php if (count($videolar) > 0): ?>
                <?php foreach ($videolar as $video): ?>
                    <?php
                    $ytId = $video['youtube_id'];
                    $ytLink = 'https://www.youtube.com/watch?v=' . rawurlencode($ytId);
                    $ytThumb = 'https://img.youtube.com/vi/' . rawurlencode($ytId) . '/hqdefault.jpg';
                    ?>
                    <article class="haber-kart video-kart">
                        <a href="<?php echo htmlspecialchars($ytLink); ?>" class="haber-gorsel video-thumb" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo htmlspecialchars($ytThumb); ?>" alt="<?php echo htmlspecialchars($video['baslik']); ?>" loading="lazy">
                            <span class="video-play" aria-hidden="true"><i class="bi bi-play-fill"></i></span>
                        </a>
                        <div class="haber-meta">
                            <h3>
                                <a href="<?php echo htmlspecialchars($ytLink); ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo htmlspecialchars($video['baslik']); ?>
                                </a>
                            </h3>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="bos-mesaj">Henüz video eklenmemiş.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
