<?php

namespace App\Controllers\frontEnd;

use App\Controllers\BaseController;
use App\Models\{Category, Content, Images, Meta, Title, Searching};

class Home extends BaseController
{
    protected $article, $kategori, $meta, $gambar, $konten, $searching;

    public function __construct()
    {
        $this->article = new Title();
        $this->kategori = new Category();
        $this->meta = new Meta();
        $this->gambar = new Images();
        $this->konten = new Content();
        $this->searching = new Searching();
        
        $this->pager = \Config\Services::pager();
    }

    public function index()
    {
        $data = [
            'title' => 'Satu-Media | News',
            'dropdown_category' => $this->article->getDropdownCategory()->getResultArray(),
            'top_news_slider' => $this->article->orderBy('judul', 'RANDOM')->findAll(4),
            'top_news_right' => $this->article->orderBy('judul', 'RANDOM')->findAll(4),
            
            // Menampilkan judul berdasarkan kategori (masih maintenance)
            // 'judul_grouped_by_category' => $this->article->getJudulGroupedByCategory()->getResultArray(),

            'featured_news' => $this->article->orderBy('judul', 'RANDOM')->findAll(3),
            'popular_news' => $this->article->orderBy('judul', 'ASC')->findAll(3),
            'latest_news' => $this->article->orderBy('judul', 'DESC')->findAll(3),
            'most_viewed' => $this->article->orderBy('judul', 'RANDOM')->findAll(3),
            'most_read' => $this->article->orderBy('judul', 'ASC')->findAll(3),
            'most_recent' => $this->article->orderBy('judul', 'DESC')->findAll(3),
            'main_news' => $this->article->orderBy('judul', 'DESC')->findAll(9),
            'main_news_list' => $this->article->orderBy('judul', 'DESC')->findAll(10)
        ];

        return view('public/template1/home', $data);
        // return view('public/template2/home');
        // return view('public/template3/home');
    }

    public function readnews($slug)
    {
        $dataArticle = $this->article->getArticle($slug);

        // store record judul/article
        $this->article->record_judul($dataArticle['id_judul']);

        // store record kategori
        $this->kategori->record_kategori($dataArticle['id_kategori']);

        // store record meta/tag
        foreach ($dataArticle['meta'] as $m) {
            $this->meta->record_meta($m['id_meta']);
        }

        $data = [
            'title' => 'News detail | Satu-Media',
            'dropdown_category' => $this->article->getDropdownCategory()->getResultArray(),
            'breadcrumb' => 'News',
            'breadcrumb_active' => 'News detail',
            'article' => $dataArticle,
            'category_article_post' => $this->article->getCategoryArticlePost($slug)->getResultArray(),
            'record_judul' => $this->article->getCountViewArticle($slug)->getResultArray(),
            // 'konten' => $this->konten->getKonten()->getResultArray(),
            'related_news' => $this->article->orderBy('judul', 'RANDOM')->findAll(),
            'news_list_widget' => $this->article->orderBy('judul', 'RANDOM')->findAll(5),
            'featured_news_widget' => $this->article->orderBy('judul', 'RANDOM')->findAll(5),
            'popular_news_widget' => $this->article->orderBy('judul', 'ASC')->findAll(5),
            'latest_news_widget' => $this->article->orderBy('judul', 'DESC')->findAll(5),
            'category_widget' => $this->article->getCategoryWidget()->getResultArray(),
            'meta_widget' => $this->meta->findAll()
        ];

        return view('public/template1/read-news', $data);
        // return view('public/template2/read-news');
        // return view('public/template3/read-news');
    }

    public function categories($nama_kategori)
    {
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 5;
        $total   = $this->article->countAll();

        $data = [
            'title' => 'Satu-Media | News',
            'dropdown_category' => $this->article->getDropdownCategory()->getResultArray(),
            'category_selected' => $this->article->getCategorySelected($nama_kategori)->getResultArray(),
            'jumlah_judul_by_kat' => $this->article->getJumlahJudulByKat($nama_kategori)->getResultArray(),
            'judul_by_category_selected' => $this->article->getJudulByCategorySelected($nama_kategori, $page, $perPage)->getResultArray(),
            'pager' => $this->pager->makeLinks($page, $perPage, $total, 'pagination'),
            // 'judul_grouped_by_category' => $this->article->getJudulGroupedByCategory()->getResultArray(),
            'related_news' => $this->article->orderBy('judul', 'RANDOM')->findAll(),
            'news_list_widget' => $this->article->orderBy('judul', 'RANDOM')->findAll(5),
            'featured_news_widget' => $this->article->orderBy('judul', 'RANDOM')->findAll(5),
            'popular_news_widget' => $this->article->orderBy('judul', 'ASC')->findAll(5),
            'latest_news_widget' => $this->article->orderBy('judul', 'DESC')->findAll(5),
            'category_widget' => $this->article->getCategoryWidget()->getResultArray(),
            'meta_widget' => $this->meta->findAll()
        ];

        return view('public/template1/categories', $data);
        // return view('public/template2/categories');
        // return view('public/template3/categories');
    }
    
    public function search($keyword = null)
    {
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 5;
        $total   = $this->article->countAll();

        $keyword = $this->request->getVar('keyword');
        
        if ($keyword !== '' && $keyword !== null) {
            $this->searching->insert(['keyword' => $keyword]);
        }

        $data = [
            'title' => 'Satu-Media | News',
            'dropdown_category' => $this->article->getDropdownCategory()->getResultArray(),
            'jumlah_cari' => $this->article->selectCount('judul', 'jml_cari')->like('judul', $keyword)->find(),
            'judul_by_search' => $this->article->search($keyword, $page, $perPage)->getResultArray(),
            'pager' => $this->pager->makeLinks($page, $perPage, $total, 'pagination'),
            // 'judul_grouped_by_category' => $this->article->getJudulGroupedByCategory()->getResultArray(),
            'related_news' => $this->article->orderBy('judul', 'RANDOM')->findAll(),
            'news_list_widget' => $this->article->orderBy('judul', 'RANDOM')->findAll(5),
            'featured_news_widget' => $this->article->orderBy('judul', 'RANDOM')->findAll(5),
            'popular_news_widget' => $this->article->orderBy('judul', 'ASC')->findAll(5),
            'latest_news_widget' => $this->article->orderBy('judul', 'DESC')->findAll(5),
            'category_widget' => $this->article->getCategoryWidget()->getResultArray(),
            'meta_widget' => $this->meta->findAll()
        ];
        
        return view('public/template1/search', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact | Satu-Media',
            'dropdown_category' => $this->article->getDropdownCategory()->getResultArray(),
            'breadcrumb' => 'Contact'
        ];

        return view('public/template1/contact', $data);
        // return view('public/template2/contact');
        // return view('public/template3/contact');
    }

    // Landing Page
    public function landing_page()
    {
        return view('public/landing-page/home');
    }

    public function readpost()
    {
        return view('public/landing-page/readpost');
    }

    public function login()
    {
        $header['title'] = "LOGIN - Layanan IDI kab. Sidoarjo";
        $header['description'] = "Login layanan anggota IDI kab. Sidoarjo memerlukan username dan password. Jika belum memiliki, dapat mengajukan dengan mengisi formulir registrasi pada tautan terkait";
        $header['keywords'] = "login, IDI kab. Sidoarjo, Layanan IDI";

        echo view('public/landing-page/header', $header);
        echo view('public/landing-page/menu');
        echo view('public/landing-page/login');
        echo view('public/landing-page/footer');
        echo view('public/landing-page/script');
    }

    public function registrasi()
    {
        $header['title'] = "LOGIN - Layanan IDI kab. Sidoarjo";
        $header['description'] = "Login layanan anggota IDI kab. Sidoarjo memerlukan username dan password. Jika belum memiliki, dapat mengajukan dengan mengisi formulir registrasi pada tautan terkait";
        $header['keywords'] = "login, IDI kab. Sidoarjo, Layanan IDI";

        echo view('public/landing-page/header', $header);
        echo view('public/landing-page/menu');
        echo '
        <section class="news-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="latest-news">
                                    <div class="tab-box d-flex justify-content-between">
                                        <div class="sec-title">
                                            <p> <p> 
                                            <h5>REGISTRASI VIEW DI SINI</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        ';
        echo view('public/landing-page/footer');
        echo view('public/landing-page/script');
    }

    public function mutasi()
    {
        $header['title'] = "LOGIN - Layanan IDI kab. Sidoarjo";
        $header['description'] = "Login layanan anggota IDI kab. Sidoarjo memerlukan username dan password. Jika belum memiliki, dapat mengajukan dengan mengisi formulir registrasi pada tautan terkait";
        $header['keywords'] = "login, IDI kab. Sidoarjo, Layanan IDI";

        echo view('public/landing-page/header', $header);
        echo view('public/landing-page/menu');
        echo '
        <section class="news-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="latest-news">
                                    <div class="tab-box d-flex justify-content-between">
                                        <div class="sec-title">
                                            <p> <p> 
                                            <h5>MUTASI VIEW DI SINI</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        ';
        echo view('public/landing-page/footer');
        echo view('public/landing-page/script');
    }

    public function rekomendasi()
    {
        $header['title'] = "LOGIN - Layanan IDI kab. Sidoarjo";
        $header['description'] = "Login layanan anggota IDI kab. Sidoarjo memerlukan username dan password. Jika belum memiliki, dapat mengajukan dengan mengisi formulir registrasi pada tautan terkait";
        $header['keywords'] = "login, IDI kab. Sidoarjo, Layanan IDI";

        echo view('public/landing-page/header', $header);
        echo view('public/landing-page/menu');
        echo '
        <section class="news-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="latest-news">
                                    <div class="tab-box d-flex justify-content-between">
                                        <div class="sec-title">
                                            <p> <p> 
                                            <h5>REKOM VIEW DI SINI</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        ';
        echo view('public/landing-page/footer');
        echo view('public/landing-page/script');
    }

    public function konfirmasi()
    {
        $header['title'] = "KONFIRMASI PEMBAYARAN - Layanan IDI kab. Sidoarjo";
        $header['description'] = "Konfirmasi pembayaran untuk keperluan keanggotaan dan layanan keanggotaan IDI kab. Sidoarjo.";
        $header['keywords'] = "login, IDI kab. Sidoarjo, Layanan IDI, Mutasi, Rekomendasi, Konfirmasi Pembayaran";

        echo view('public/landing-page/header', $header);
        echo view('public/landing-page/menu');
        echo '
        <section class="news-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="latest-news">
                                    <div class="tab-box d-flex justify-content-between">
                                        <div class="sec-title">
                                            <p> <p> 
                                            <h5>KONFIRMASI VIEW DI SINI</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        ';
        echo view('public/landing-page/footer');
        echo view('public/landing-page/script');
    }

    public function pengurus()
    {
        $header['title'] = "LOGIN - Layanan IDI kab. Sidoarjo";
        $header['description'] = "Siapa saja pengurus IDI kab. Sidoarjo periode 2022 sampai dengan 2027?";
        $header['keywords'] = "login, IDI kab. Sidoarjo, Layanan IDI";

        echo view('public/landing-page/header', $header);
        echo view('public/landing-page/menu');
        echo '
        <section class="news-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="latest-news">
                                    <div class="tab-box d-flex justify-content-between">
                                        <div class="sec-title">
                                            <p> <p> 
                                            <h5>PENGURUS VIEW DI SINI</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        ';
        echo view('public/landing-page/footer');
        echo view('public/landing-page/script');
    }

    public function kontak()
    {
        $header['title'] = "KONTAK - Layanan IDI kab. Sidoarjo";
        $header['description'] = "Kontak pengurus IDI kab. Sidoarjo berupa alamat sekretariat, nomor telepon sekretariat, email sekretariat. ";
        $header['keywords'] = "Kontak, IDI kab. Sidoarjo, Layanan IDI";

        echo view('public/landing-page/header', $header);
        echo view('public/landing-page/menu');
        echo view('public/landing-page/kontak');
        echo view('public/landing-page/footer');
        echo view('public/landing-page/script');
    }
}
