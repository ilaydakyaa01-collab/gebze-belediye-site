<?php
include '../../includes/db.php';
require_once '../../includes/init.php';

$basePath = '../../';
$pageTitle = 'Eski Başkanlar | Gebze Belediyesi';
$navTransparent = false;

$baskanlar = [];
try {
    $baskanlar = $conn->query("SELECT * FROM eski_baskanlar ORDER BY sira ASC, donem_baslangic ASC")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $baskanlar = [];
}

include '../../includes/header.php';
?>

<style>
    .eb-bolumu { padding: 7rem 0 5rem; }

    .eb-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--muted);
        margin-bottom: 0.6rem;
    }
    .eb-breadcrumb a { color: var(--muted); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .eb-breadcrumb a:hover { color: var(--accent-hot); }

    .eb-ustbaslik-satir {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 2.5rem;
    }
    .eb-ustbaslik h1 {
        font-size: clamp(1.8rem, 3vw, 2.3rem);
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 0.5rem;
    }
    .eb-ustbaslik p { color: var(--muted); font-size: 1rem; }

    /* --- Hamburger + Dropdown (Kurumsal menüsü tarzı) --- */
    .eb-menu-wrap { position: relative; margin-top: 4px; flex-shrink: 0; }

    .eb-hamburger {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.6rem 1.1rem;
        background: var(--navy);
        color: var(--white);
        border: none;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
    }
    .eb-hamburger i:last-child { transition: transform 0.2s ease; }
    .eb-hamburger.is-open i:last-child { transform: rotate(180deg); }

    .eb-dropdown {
        position: absolute;
        top: calc(100% + 0.5rem);
        right: 0;
        background: var(--white);
        border-radius: 10px;
        box-shadow: var(--shadow);
        padding: 0.5rem;
        min-width: 240px;
        z-index: 30;
        opacity: 0;
        visibility: hidden;
        transform: translateY(6px);
        transition: 0.18s ease;
    }
    .eb-dropdown.is-open {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .eb-dropdown a {
        display: block;
        padding: 0.55rem 0.8rem;
        color: var(--navy);
        font-size: 0.88rem;
        border-radius: 8px;
        text-decoration: none;
    }
    .eb-dropdown a:hover { background: #eef4fb; }
    .eb-dropdown a.is-active { color: var(--accent-hot); font-weight: 700; }

    /* --- Kart Grid --- */
    .eb-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.2rem;
    }

    .eb-kart {
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        overflow: hidden;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .eb-kart:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow);
    }

    .eb-foto-wrap { aspect-ratio: 4 / 4.4; background: #eef2f7; }
    .eb-foto {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        
    }
    .eb-foto-yok {
        width: 100%;
        height: 100%;
        display: grid;
        place-items: center;
        color: var(--navy);
        font-size: 2.2rem;
        background: #eef2f7;
    }

    .eb-isim {
        padding: 0.9rem 0.9rem 1.1rem;
        text-align: center;
    }
    .eb-isim h3 {
        font-size: 0.98rem;
        font-weight: 600;
        color: var(--navy);
        line-height: 1.3;
    }
    .eb-isim span {
        display: block;
        font-size: 0.82rem;
        color: var(--muted);
        margin-top: 0.3rem;
    }

    .eb-bos { text-align: center; color: var(--muted); padding: 3rem 0; }

    @media (max-width: 992px) {
        .eb-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 640px) {
        .eb-grid { grid-template-columns: repeat(2, 1fr); }
        .eb-dropdown { right: 0; left: auto; }
    }
</style>

<section class="eb-bolumu page-content">
    <div class="container">
        <nav class="eb-breadcrumb">
            <a href="<?php echo $basePath; ?>index.php"><i class="bi bi-house"></i> Anasayfa</a>
            <span>/</span>
            <span>Eski Başkanlar</span>
        </nav>

        <div class="eb-ustbaslik-satir">
            <div class="eb-ustbaslik">
                <h1>Eski Başkanlar</h1>
                <p>Gebze Belediyesi'ne hizmet etmiş geçmiş dönem belediye başkanlarımız.</p>
            </div>

            <div class="eb-menu-wrap">
                <button type="button" class="eb-hamburger" id="ebHamburger">
                    Kurumsal <i class="bi bi-chevron-down"></i>
                </button>
                <div class="eb-dropdown" id="ebDropdown">
                    <a href="<?php echo $basePath; ?>pages/kurumsal/vizyonumuz.php">Vizyonumuz</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/misyonumuz.php">Misyonumuz</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/ilkelerimiz.php">İlkelerimiz</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/enerji-politikamiz.php">Enerji Politikamız</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/belediye-meclisi.php">Belediye Meclisi</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/yonetim-semasi.php">Yönetim Şeması</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/baskan-yardimcilari.php">Başkan Yardımcıları</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/baskan-danismanlari.php">Başkan Danışmanları</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/mudurlukler.php">Müdürlükler</a>
                    <a href="#" class="is-active">Eski Başkanlar</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/arabuluculuk-komisyonu.php">Arabuluculuk Komisyonu</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/etik-komisyonu.php">Etik Komisyonu</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/meclis-kararlari.php">Meclis Kararları</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/kurumsal-kimlik.php">Kurumsal Kimlik</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/kurumsal-raporlar.php">Kurumsal Raporlar</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/kurumsal-dokumanlar.php">Kurumsal Dökümanlar</a>
                    <a href="<?php echo $basePath; ?>pages/kurumsal/yayinlar.php">Yayınlar</a>
                    <li><a href="<?php echo $basePath; ?>pages/kurumsal/kvkk.php">KVKK Aydınlatma Metni</a></li>
                </div>
            </div>
        </div>

        <?php if (count($baskanlar) > 0): ?>
            <div class="eb-grid">
                <?php foreach ($baskanlar as $baskan): ?>
                    <div class="eb-kart">
                        <div class="eb-foto-wrap">
                            <?php if (!empty($baskan['resim'])): ?>
                                <img src="<?php echo $basePath . htmlspecialchars($baskan['resim']); ?>" alt="<?php echo htmlspecialchars($baskan['ad_soyad']); ?>" class="eb-foto">
                            <?php else: ?>
                                <div class="eb-foto-yok"><i class="bi bi-person"></i></div>
                            <?php endif; ?>
                        </div>
                        <div class="eb-isim">
                            <h3><?php echo htmlspecialchars($baskan['ad_soyad']); ?></h3>
                            <span><?php echo htmlspecialchars($baskan['donem_baslangic']); ?> - <?php echo htmlspecialchars($baskan['donem_bitis']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="eb-bos">Henüz eski başkan bilgisi eklenmemiştir.</p>
        <?php endif; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('ebHamburger');
    const dropdown = document.getElementById('ebDropdown');

    btn.addEventListener('click', function () {
        const acikMi = dropdown.classList.contains('is-open');
        dropdown.classList.toggle('is-open', !acikMi);
        btn.classList.toggle('is-open', !acikMi);
    });

    document.addEventListener('click', function (e) {
        if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.remove('is-open');
            btn.classList.remove('is-open');
        }
    });
});
</script>

<?php include '../../includes/footer.php'; ?>