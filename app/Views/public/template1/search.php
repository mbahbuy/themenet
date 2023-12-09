<?= $this->extend('public/template1/layout') ?>


<?= $this->section('content') ?>

<div class="single-news">
    <div class="container">
        <div class="row">
                
            <div class="col-lg-8">
                <div class="sidebar">
                    <div class="sidebar-widget">
                        <?php $request = \Config\Services::request();
                        foreach ($jumlah_cari as $jm) : ?>
                            <?php if ($jm['jml_cari'] == 0) { ?>
                                <h6>Hasil pencarian dengan kata kunci "<?= $request->getVar('keyword') ?>" tidak ditemukan</h6>
                            <?php } else { ?>
                                <h6>Hasil pencarian dengan kata kunci "<?= $request->getVar('keyword') ?>" ditemukan dalam <?= $jm['jml_cari']; ?> dokumen</h6>
                            <?php } ?>
                        <?php endforeach; ?>
                        <hr class="mb-4">
                        <?php foreach ($judul_by_search as $judul_by_cat) : ?>
                            <div class="news-list">    
                                <div class="nl-item">   
                                    <img src="<?= filter_var($judul_by_cat['picture'], FILTER_VALIDATE_URL) == true ? $judul_by_cat['picture'] : url_to('/') . 'images/gallery/' . $judul_by_cat['picture'] ?>" style="width: 30%; padding-right: 15px;" />
                                    <a href="<?= url_to('read.article', $judul_by_cat['slug']) ?>" class="text-justify"><?= $judul_by_cat['judul'] ?></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if ($jm['jml_cari'] > 5) { ?>
                            <?= $pager; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar">
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

<?= $this->endSection() ?>