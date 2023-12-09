<?= $this->extend('public/template1/layout') ?>


<?= $this->section('content') ?>

<!-- Breadcrumb -->
<?= $this->include('public/template1/breadcrumb') ?>

<!-- Single News Start-->
<div class="single-news">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="sn-container">
                    <div class="sn-img">
                        <img src="<?= filter_var($article['gambar'], FILTER_VALIDATE_URL) == true ? $article['gambar'] : url_to('/') . 'images/gallery/' . $article['gambar'] ?>" />
                    </div>
                    <span class="badge rounded-0 text-white mt-3 p-2 mr-2" style="background-color: #FF6F61">
                    <?php foreach ($category_article_post as $kategori_post) : ?>
                        <?= ucfirst($kategori_post['nama_kategori']); ?>
                    </span> 
                    <?= date('d/m/Y', strtotime($kategori_post['waktu_status'])); ?>
                    <?php endforeach ?>
                    <div class="sn-content">
                        <h2 class="sn-title"><?= $article['judul']; ?></h2>
                        <p style="text-align: justify;">
                            <?= $article['konten']; ?>
                        </p>
                    </div>
                </div>
                <div class="d-flex justify-content-between p-3 mb-5" style="background-color: #FF6F61">
		            <div class="d-flex align-items-center text-white">
			            Kontributor: Bagus
		            </div>
		            <div class="d-flex align-items-center text-white">
			            <span class="ml-3"><i class="far fa-eye mr-2"></i>
                            <span id="viewctr">
                                <?php foreach ($record_judul as $countViewArticle) : ?>
                                    <?= $countViewArticle['id_judul']; ?>
                                <?php endforeach ?>
                            </span>
                        </span>
		            </div>
	            </div>
                <div class="sn-related">
                    <h2>Related News</h2>
                        <style>
                            .sn-related img {
                                min-height: 150px;
                                max-height: 150px;
                            }
                        </style>
                    <div class="row sn-slider">
                        <?php foreach ($related_news as $article) : ?>
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="<?= filter_var($article['picture'], FILTER_VALIDATE_URL) == true ? $article['picture'] : url_to('/') . 'images/gallery/' . $article['picture'] ?>" />
                                    <div class="sn-title">
                                        <a href="<?= url_to('read.article', $article['slug']) ?>" class="text-justify"><?= strlen($article['judul']) > 50 ? substr($article['judul'], 0, 50) . "..." : $article['judul'] ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="sidebar-widget">
                        <h2 class="sw-title">In This Category</h2>
                        <div class="news-list">
                            <?php foreach ($news_list_widget as $article) : ?>
                                <div class="nl-item">
                                    <div class="nl-img">
                                        <img src="<?= filter_var($article['picture'], FILTER_VALIDATE_URL) == true ? $article['picture'] : url_to('/') . 'images/gallery/' . $article['picture'] ?>" />
                                    </div>
                                    <div class="nl-title text-justify">
                                        <a href="<?= url_to('read.article', $article['slug']) ?>" class="text-justify"><?= $article['judul']; ?></a>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <div class="image">
                            <a href="#"><img src="<?= url_to('/') ?>template/news_1/img/ads-2.jpg" alt="Image"></a>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <div class="tab-news">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#featured">Featured</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#popular">Popular</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#latest">Latest</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="featured" class="container tab-pane active">
                                    <?php foreach ($featured_news_widget as $article) : ?>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="<?= filter_var($article['picture'], FILTER_VALIDATE_URL) == true ? $article['picture'] : url_to('/') . 'images/gallery/' . $article['picture'] ?>" />
                                            </div>
                                            <div class="tn-title text-justify">
                                                <a href="<?= url_to('read.article', $article['slug']) ?>" class="text-justify"><?= $article['judul']; ?></a>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div id="popular" class="container tab-pane fade">
                                    <?php foreach ($popular_news_widget as $article) : ?>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="<?= filter_var($article['picture'], FILTER_VALIDATE_URL) == true ? $article['picture'] : url_to('/') . 'images/gallery/' . $article['picture'] ?>" />
                                            </div>
                                            <div class="tn-title text-justify">
                                                <a href="<?= url_to('read.article', $article['slug']) ?>" class="text-justify"><?= $article['judul']; ?></a>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div id="latest" class="container tab-pane fade">
                                    <?php foreach ($latest_news_widget as $article) : ?>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="<?= filter_var($article['picture'], FILTER_VALIDATE_URL) == true ? $article['picture'] : url_to('/') . 'images/gallery/' . $article['picture'] ?>" />
                                            </div>
                                            <div class="tn-title text-justify">
                                                <a href="<?= url_to('read.article', $article['slug']) ?>" class="text-justify"><?= $article['judul']; ?></a>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <div class="image">
                            <a href="#"><img src="<?= url_to('/') ?>template/news_1/img/ads-2.jpg" alt="Image"></a>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <h2 class="sw-title">News Category</h2>
                        <div class="category">
                            <ul>
                                <?php foreach ($category_widget as $cw) : ?>
                                    <li><a href="/categories/<?= $cw['nama_kategori'] ?>"><?= ucfirst($cw['nama_kategori']); ?></a><span>(<?= $cw['jumlah_nama_kategori'] == 1 ? 0 : $cw['jumlah_nama_kategori'] ?>)</span></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <div class="image">
                            <a href="#"><img src="<?= url_to('/') ?>template/news_1/img/ads-2.jpg" alt="Image"></a>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <h2 class="sw-title">Tags Cloud</h2>
                        <div class="tags">
                            <?php foreach ($meta_widget as $tag) : ?>
                                <a href="#"><?= $tag['meta'] ?></a>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Single News End-->

<?= $this->endSection() ?>