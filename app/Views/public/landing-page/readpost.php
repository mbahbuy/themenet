<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <?= $this->include('public/landing-page/header') ?>
</head>

<body>
    <?= $this->include('public/landing-page/menu') ?>

    <!-- Breadcrumb Area -->
    <section class="breadcrumb-area">
        <?= $this->include('public/landing-page/breadcumb') ?>
    </section>
    <!-- End Breadcrumb Area -->

    <!-- News Details Area -->
    <section class="category-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <?= $this->include('public/landing-page/content-news-detail') ?>
                        <?= $this->include('public/landing-page/comments') ?>
                    </div>
                </div>
                <?= $this->include('public/landing-page/widget') ?>
                <?= $this->include('public/landing-page/relate-news') ?>
            </div>
        </div>
    </section>
    <!-- End News Details Area -->

    <!-- Footer Area -->
    <?= $this->include('public/landing-page/footer') ?>
    <!-- End Footer Area -->

    <?= $this->include('public/landing-page/script') ?>
</body>

</html>