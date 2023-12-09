<?= $this->extend('public/template1/layout') ?>


<?= $this->section('content') ?>

<!-- Top News Start-->
<div class="top-news">
    <div class="container">
        <div class="row">
            <style>
                .tn-left img {
                    min-height: 350px;
                    max-height: 350px;
                }

                .tn-right img {
                    min-height: 175px;
                    max-height: 175px;
                }
            </style>
            <div class="col-md-6 tn-left">
                <div class="row tn-slider">
                    <?php foreach ($top_news_slider as $article) : ?>
                        <div class="col-md-12">
                            <div class="tn-img">
                                <img src="<?= filter_var($article['picture'], FILTER_VALIDATE_URL) == true ? $article['picture'] : url_to('/') . 'images/gallery/' . $article['picture'] ?>">
                                <div class="tn-title">
                                    <a href="<?= url_to('read.article', $article['slug']) ?>" class="text-justify"><?= $article['judul'] ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-md-6 tn-right">
                <div class="row">
                    <?php foreach ($top_news_right as $article) : ?>
                        <div class="col-md-6">
                            <div class="tn-img">
                                <img src="<?= filter_var($article['picture'], FILTER_VALIDATE_URL) == true ? $article['picture'] : url_to('/') . 'images/gallery/' . $article['picture'] ?>" />
                                <div class="tn-title">
                                    <a href="<?= url_to('read.article', $article['slug']) ?>" class="text-justify"><?= strlen($article['judul']) > 60 ? substr($article['judul'], 0, 60) . "..." : $article['judul'] ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top News End-->

<!-- Tab News Start-->
<div class="tab-news">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#featured">Featured News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#popular">Popular News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#latest">Latest News</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <style>
                        .tn-news img {
                            min-height: 100px;
                            max-height: 100px;
                        }
                    </style>
                    <div id="featured" class="container tab-pane active">
                        <?php foreach ($featured_news as $article) : ?>
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src="<?= filter_var($article['picture'], FILTER_VALIDATE_URL) == true ? $article['picture'] : url_to('/') . 'images/gallery/' . $article['picture'] ?>" />
                                </div>
                                <div class="tn-title text-justify">
                                    <a href="<?= url_to('read.article', $article['slug']) ?>"><?= $article['judul']; ?></a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div id="popular" class="container tab-pane fade">
                        <?php foreach ($popular_news as $article) : ?>    
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
                        <?php foreach ($latest_news as $article) : ?>
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

            <div class="col-md-6">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#m-viewed">Most Viewed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#m-read">Most Read</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#m-recent">Most Recent</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="m-viewed" class="container tab-pane active">
                        <?php foreach ($most_viewed as $article) : ?>
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
                    <div id="m-read" class="container tab-pane fade">
                        <?php foreach ($most_read as $article) : ?>
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
                    <div id="m-recent" class="container tab-pane fade">
                        <?php foreach ($most_recent as $article) : ?>
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
            <!-- <div class="container mb-5">
                <div class="b-ads" width="100%">
                    <a href="#">
                        <img src="<?= url_to('/') ?>template/news_1/img/ads-1.jpg" class="col-lg-12" alt="Ads">
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- Tab News Start-->
<!-- Main News Start-->
<div class="main-news">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <style>
                        .mn-img img {
                            min-height: 165px;
                            max-height: 165px;
                        }

                        /* .tn-right img {
                            min-height: 175px;
                            max-height: 175px;
                        } */
                    </style>
                    <?php foreach ($main_news as $article) : ?>
                        <div class="col-md-4">
                            <div class="mn-img">
                                <img src="<?= filter_var($article['picture'], FILTER_VALIDATE_URL) == true ? $article['picture'] : url_to('/') . 'images/gallery/' . $article['picture'] ?>" />
                                <div class="mn-title">
                                    <a href="<?= url_to('read.article', $article['slug']) ?>" class="text-justify"><?= strlen($article['judul']) > 60 ? substr($article['judul'], 0, 60) . "..." : $article['judul'] ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mn-list">
                    <h2>Read More</h2>
                    <ul>
                        <?php foreach ($main_news_list as $article) : ?>
                            <li><a href="<?= url_to('read.article', $article['slug']) ?>" class="text-justify"><?= $article['judul']; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main News End-->

<?= $this->endSection() ?>