<?php
$basePath = '../';
$pageTitle = 'Enerji Politikamız - Gebze Belediyesi';
$navTransparent = false;
$bodyClass = 'page-inner';

require_once '../includes/init.php';
include '../includes/header.php';
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>css/vizyon-misyon.css">

<main class="kurumsal-bolumu page-content">
    <div class="container">
        <div class="kurumsal-grid">
            <div class="kurumsal-ana-kart">
                <nav class="breadcrumb">
                    <a href="<?php echo $basePath; ?>index.php">Anasayfa</a>
                    <span>/</span>
                    <span>Enerji Politikamız</span>
                </nav>

                <header class="section-header section-header-left">
                    <h2>Enerji Politikamız</h2>
                </header>

                <div class="metin-araclari">
                    <button type="button" class="arac-btn" id="fontKucult" aria-label="Yazıyı küçült" title="Yazıyı küçült">
                        <i class="bi bi-zoom-out"></i>
                    </button>
                    <button type="button" class="arac-btn" id="fontNormal" aria-label="Normal boyut" title="Normal boyut">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                    <button type="button" class="arac-btn" id="fontBuyut" aria-label="Yazıyı büyüt" title="Yazıyı büyüt">
                        <i class="bi bi-zoom-in"></i>
                    </button>
                    <button type="button" class="arac-btn" id="yazdirBtn" aria-label="Yazdır" title="Yazdır">
                        <i class="bi bi-printer"></i>
                    </button>
                </div>

                <div class="kurumsal-metin-duz" id="kurumsalMetin">
                    <p>Belediye Kanunu ile tayin edilen hizmetlerimizi; ulusal kanun ve yönetmeliklere, bağlı bulunduğumuz mevzuat hükümlerine ve Enerji Yönetim Sistemi (EnYS) şartlarına bağlı kalarak, hizmetlerimizin sürdürülebilirliğini esas alarak yürütmekteyiz. Bu doğrultuda;</p>
                    <ul class="ilke-listesi">
                        <li>Enerji ve doğal kaynaklarımızı stratejik bir bakış açısıyla ele alarak verimli kullanmayı,</li>
                        <li>Enerji Yönetim Sistemi’ni; ilgili standartlar, uygulanabilir yasal şartlar ve diğer gereklilikler doğrultusunda etkin şekilde yönetmeyi,</li>
                        <li>Kaynaklarımızı etkin ve verimli bir şekilde kullanmayı,</li>
                        <li>Enerji verimliliğini artırmak için gerekli olan süreç ve sistemleri oluşturarak, bu süreçleri gelişmiş teknolojilerle uygulamayı ve sürdürülebilirliği sağlamayı,</li>
                        <li>İklim değişikliğiyle mücadeleye olumlu katkı sağlayacak enerji verimliliği projeleri geliştirerek uygulamayı,</li>
                        <li>Tüm personelin EnYS süreçlerine katılımını sağlamayı, ekip çalışmasını güçlendirmeyi ve enerji verimliliği farkındalığını artırmayı,</li>
                        <li>EnYS hedeflerini belirlemeyi, bu hedeflerin gerçekleşmesi için gerekli kaynakları sağlamayı ve sistemi sürekli gözden geçirerek iyileştirmeyi,</li>
                        <li>Enerji performansını sürekli artırmak amacıyla, belirlenen amaç ve hedeflere ulaşmak için gerekli tüm bilgi ve kaynağı temin ederek; tedarik ve tasarım süreçlerinde enerji verimliliğini ön planda tutmayı,</li>
                        <li>Vatandaşlarımız için faaliyetlerimiz çerçevesinde verimlilik artırıcı projeler tasarlamayı, enerji bakımından verimli ürün ve hizmetlerin tedarik edilmesi hususunda teşvik etmeyi, enerji verimliliği farkındalığını geliştirmek için bilgilendirmeyi ve desteklemeyi, enerji verimliliğimizi sürekli iyileştirmeyi taahhüt ederiz.</li>
                    </ul>
                </div>
            </div>

            <?php $currentKurumsalPage = 'enerji'; include '../includes/kurumsal-sidebar.php'; ?>
        </div>
    </div>
</main>

<script>
(function () {
    var metin = document.getElementById('kurumsalMetin');
    var olcek = 1;
    var ADIM = 0.1;
    var MIN = 0.7;
    var MAX = 1.5;

    function uygula() {
        metin.style.setProperty('--metin-olcek', olcek.toFixed(2));
    }

    document.getElementById('fontBuyut').addEventListener('click', function () {
        olcek = Math.min(MAX, olcek + ADIM);
        uygula();
    });

    document.getElementById('fontKucult').addEventListener('click', function () {
        olcek = Math.max(MIN, olcek - ADIM);
        uygula();
    });

    document.getElementById('fontNormal').addEventListener('click', function () {
        olcek = 1;
        uygula();
    });

    document.getElementById('yazdirBtn').addEventListener('click', function () {
        window.print();
    });
})();
</script>

<?php include '../includes/footer.php'; ?>