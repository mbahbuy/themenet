<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <?= $this->include('public/landing-page/header') ?>
</head>

<body>
    <?= $this->include('public/landing-page/menu') ?>

    <!-- Slider Area -->
    <section class="slider-area">
        <?= $this->include('public/landing-page/slider') ?>
    </section>
    <!-- End Slider Area -->

    <!-- News Area (Informasi Terkini) -->
    <section class="news-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <?= $this->include('public/landing-page/content-news') ?>
                        <?= $this->include('public/landing-page/content-layanan-anggota') ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End News Area -->

    <!-- Footer Area -->
    <?= $this->include('public/landing-page/footer') ?>
    <!-- End Footer Area -->

    <?= $this->include('public/landing-page/script') ?>
</body>

</html>