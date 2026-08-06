<?php
include '../../includes/db.php';

$basePath = '../../';
$pageTitle = 'Başkan - Özgeçmiş | Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../../includes/init.php';

/*
 * Başkan bilgileri "baskan" tablosundan çekiliyor.
 * Tablo yapısı için bkz: /database/baskan_tablolari.sql
 */
$baskan = null;
try {
    $stmt = $conn->query("SELECT * FROM baskan ORDER BY id DESC LIMIT 1");
    $baskan = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $baskan = null;
}

if (!$baskan) {
    $baskan = [
        'ad_soyad'   => 'Zinnur Büyükgöz',
        'unvan'      => 'Gebze Belediye Başkanı',
        'fotograf'   => '',
        'facebook'   => 'https://www.facebook.com/zinnurbuyukgoz',
        'twitter'    => 'https://twitter.com/zinnurbuyukgoz',
        'instagram'  => 'https://www.instagram.com/zinnurbuyukgoz',
        'web_sitesi' => 'https://www.zinnurbuyukgoz.com',
        'biyografi'  => '',
    ];
}

$img = !empty($baskan['fotograf'])
    ? $basePath . ltrim($baskan['fotograf'], '/')
    : $basePath . 'img/baskan/baskan.jpg';

include '../../includes/header.php';
?>

<style>
    .baskan-hero {
        position: relative;
        padding: 9rem 0 60px;
        background: linear-gradient(180deg, #f6f7f9 0%, #ffffff 100%);
        overflow: hidden;
    }
    .baskan-hero::before {
        content: "";
        position: absolute;
        top: -120px;
        right: -120px;
        width: 360px;
        height: 360px;
        border-radius: 50%;
        background: var(--brand-color, #0f5d3c);
        opacity: 0.06;
    }
    .baskan-profil {
        position: relative;
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 40px;
        align-items: center;
    }
    .baskan-foto-wrap {
        position: relative;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        overflow: hidden;
        border: 6px solid #fff;
        box-shadow: 0 18px 40px rgba(15, 93, 60, 0.18);
    }
    .baskan-foto-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .baskan-bilgi .kurum-etiket {
        display: inline-block;
        font-size: 12px;
        letter-spacing: .12em;
        text-transform: uppercase;
        font-weight: 600;
        color: var(--brand-color, #0f5d3c);
        background: rgba(15, 93, 60, .08);
        padding: 6px 14px;
        border-radius: 999px;
        margin-bottom: 14px;
    }
    .baskan-bilgi h1 {
        font-size: 2.4rem;
        font-weight: 700;
        margin: 0 0 6px;
        line-height: 1.15;
    }
    .baskan-bilgi p.unvan {
        font-size: 1.05rem;
        color: #5b6470;
        margin: 0 0 20px;
    }
    .baskan-sosyal {
        display: flex;
        gap: 10px;
    }
    .baskan-sosyal a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #fff;
        color: var(--brand-color, #0f5d3c);
        border: 1px solid #e3e6ea;
        transition: background .2s ease, color .2s ease, transform .2s ease;
    }
    .baskan-sosyal a:hover {
        background: var(--brand-color, #0f5d3c);
        color: #fff;
        transform: translateY(-2px);
    }

    .baskan-icerik {
        padding: 60px 0 80px;
    }
    .baskan-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 50px;
        align-items: start;
    }
    .baskan-metin h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0 0 20px;
        position: relative;
        padding-bottom: 12px;
    }
    .baskan-metin h2::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 48px;
        height: 3px;
        background: var(--brand-color, #0f5d3c);
        border-radius: 2px;
    }
    .baskan-metin p {
        color: #4a5158;
        line-height: 1.85;
        margin: 0 0 18px;
        font-size: 1rem;
    }

    .baskan-yan {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .yan-kutu {
        background: #f8f9fa;
        border: 1px solid #edeff1;
        border-radius: 14px;
        padding: 26px;
    }
    .yan-kutu h3 {
        font-size: 1.05rem;
        font-weight: 700;
        margin: 0 0 16px;
    }
    .yan-kutu ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .yan-kutu ul li + li {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #edeff1;
    }
    .yan-kutu ul li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #2a2f35;
        font-weight: 500;
        text-decoration: none;
    }
    .yan-kutu ul li a:hover {
        color: var(--brand-color, #0f5d3c);
    }
    .yan-kutu ul li a.is-active {
        color: var(--brand-color, #0f5d3c);
        font-weight: 700;
    }
    .yan-kutu ul li a i {
        color: #b7bcc2;
        font-size: 14px;
    }

    @media (max-width: 860px) {
        .baskan-profil {
            grid-template-columns: 1fr;
            text-align: center;
            justify-items: center;
        }
        .baskan-sosyal { justify-content: center; }
        .baskan-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="baskan-hero">
    <div class="container baskan-profil">
        <div class="baskan-foto-wrap">
            <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($baskan['ad_soyad']); ?>">
        </div>
        <div class="baskan-bilgi">
            <span class="kurum-etiket">Gebze Belediyesi</span>
            <h1><?php echo htmlspecialchars($baskan['ad_soyad']); ?></h1>
            <p class="unvan"><?php echo htmlspecialchars($baskan['unvan']); ?></p>
            <div class="baskan-sosyal">
                <?php if (!empty($baskan['facebook'])): ?>
                    <a href="<?php echo htmlspecialchars($baskan['facebook']); ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <?php endif; ?>
                <?php if (!empty($baskan['twitter'])): ?>
                    <a href="<?php echo htmlspecialchars($baskan['twitter']); ?>" target="_blank" rel="noopener" aria-label="X"><i class="bi bi-twitter-x"></i></a>
                <?php endif; ?>
                <?php if (!empty($baskan['instagram'])): ?>
                    <a href="<?php echo htmlspecialchars($baskan['instagram']); ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<main class="baskan-icerik page-content">
    <div class="container baskan-grid">
        <article class="baskan-metin">
            <h2>Başkanın Biyografisi</h2>

            <?php if (!empty($baskan['biyografi'])): ?>
                <?php foreach (explode("\n\n", trim($baskan['biyografi'])) as $paragraf): ?>
                    <p><?php echo nl2br(htmlspecialchars(trim($paragraf))); ?></p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>1964 yılında Erzurum'da dünyaya geldi. İlkokulu Bakırköy'de, ortaokulu Kadıköy'de tamamladıktan sonra 1983 yılında Gebze İmam Hatip Lisesi'nden mezun oldu.</p>

                <p>Yükseköğrenimini Yıldız Teknik Üniversitesi Mimarlık Fakültesi Şehir ve Bölge Planlama Bölümü'nde 1987 yılında tamamladı; aynı üniversitede 1989 yılına kadar sürdürdüğü yüksek lisans eğitiminin ardından uzun yıllardır şehir plancısı olarak mesleğini icra etmektedir. Evli ve dört çocuk babasıdır.</p>

                <p>Siyasi hayatına farklı partiler bünyesinde yerel ve il düzeyinde çeşitli yönetim görevleriyle başlayan Büyükgöz, 2004-2009 döneminde Gebze Belediyesi'nde teknik başkan yardımcılığı ve meclis üyeliği ile Kocaeli Büyükşehir Belediyesi meclisinde imar komisyonu üyeliği yaptı.</p>

                <p>Yerel siyasetin yanı sıra kültür varlıklarının korunmasına yönelik bölge kurullarında, çeşitli ticaret ve teknoloji kuruluşlarının danışma kurullarında ve idare mahkemelerinde bilirkişilik görevlerinde yer alarak kamu hizmetine katkı sundu.</p>

                <p>31 Mart 2019 yerel seçimlerinde Gebze halkının teveccühüyle Gebze Belediye Başkanı seçilen Zinnur Büyükgöz, görevini büyük bir özveriyle sürdürmektedir.</p>
            <?php endif; ?>
        </article>

        <aside class="baskan-yan">
            <div class="yan-kutu">
                <h3>Başkan</h3>
                <ul>
                    <li><a class="is-active" href="<?php echo $basePath; ?>pages/baskan/ozgecmis.php">Özgeçmiş <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/baskan/projeler.php">Projeler <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo htmlspecialchars($baskan['web_sitesi'] ?? '#'); ?>" target="_blank" rel="noopener">Başkanın Web Sayfası <i class="bi bi-box-arrow-up-right"></i></a></li>
                </ul>
            </div>

            <div class="yan-kutu">
                <h3>Hızlı Erişim</h3>
                <ul>
                    <li><a href="<?php echo $basePath; ?>index.php">Ana Sayfa <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>pages/haberler.php">Haberler <i class="bi bi-chevron-right"></i></a></li>
                    <li><a href="<?php echo $basePath; ?>index.php#iletisim">İletişim <i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </div>

            <div class="yan-kutu">
                <h3>Bizi Takip Edin</h3>
                <ul>
                    <li><a href="https://wa.me/902626420430" target="_blank" rel="noopener">WhatsApp <i class="bi bi-whatsapp"></i></a></li>
                    <li><a href="https://www.facebook.com/gebzebelediye" target="_blank" rel="noopener">Facebook <i class="bi bi-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/gebze_belediyesi" target="_blank" rel="noopener">Instagram <i class="bi bi-instagram"></i></a></li>
                </ul>
            </div>
        </aside>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>