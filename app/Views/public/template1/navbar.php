<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                <?php $uri = current_url(true); ?>
                    <a href="/news" class="nav-item nav-link <?= $uri->getSegment(1) == '/' ? '' : 'active'; ?>">Home</a>
                    <?php foreach ($dropdown_category as $category_lists) : ?>
                        <a href="/categories/<?= $category_lists['nama_kategori'] ?>" class="nav-item nav-link"><?= ucfirst($category_lists['nama_kategori']); ?></a>
                    <?php endforeach ?>
                </div>
                <!-- <div class="social ml-auto">
                    <a href=""><i class="fab fa-twitter"></i></a>
                    <a href=""><i class="fab fa-facebook-f"></i></a>
                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                    <a href=""><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-youtube"></i></a>
                </div> -->
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->