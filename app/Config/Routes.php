<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'frontEnd\Home::index');

// routing for public area
$routes->get('post', 'frontEnd\Home::readpost');
$routes->get('registrasi', 'frontEnd\Home::registrasi');
$routes->get('mutasi', 'frontEnd\Home::mutasi');
$routes->get('rekomendasi', 'frontEnd\Home::rekomendasi');
$routes->get('konfirmasi', 'frontEnd\Home::konfirmasi');
$routes->get('pengurus', 'frontEnd\Home::pengurus');
$routes->get('kontak', 'frontEnd\Home::kontak');
// $routes->get('login', 'frontEnd\Home::login');

// routing for member only
$routes->group('dashboard', ['filter' => 'login'], function ($routeDashboard) 
{ // pengelompokan semua route dashboard

    $routeDashboard->get('/', 'backEnd\Dashboard::index', ['as' => 'dashboard']);// halaman dashboard
    
    $routeDashboard->group('article', ['filter' => 'role:admin,redaktur,contributor,editor'], function ($routeArticle)  
    { // pengelompokan semua route dashboard/article
        $routeArticle->get('list', 'backEnd\ArticleController::index', ['as' => 'article.index']);// list artikel
        $routeArticle->get('form', 'backEnd\ArticleController::form', ['as' => 'article.form']);// form artikel
        $routeArticle->post('store', 'backEnd\ArticleController::store', ['as' => 'article.store']);// store/save artikel
        $routeArticle->post('publish', 'backEnd\ArticleController::publish', ['as' => 'article.publish']);// langsung publish artiker
        $routeArticle->get('form/edit/(:any)', 'backEnd\ArticleController::edit/$1', ['as' => 'article.edit']);// edit form artikel
        $routeArticle->put('publish_update/(:any)', 'backEnd\ArticleController::publish_update/$1', ['as' => 'article.publish_update']);// update artikel langsung publish
        $routeArticle->put('update/(:any)', 'backEnd\ArticleController::update/$1', ['as' => 'article.update']);// update artikel
        $routeArticle->delete('delete/(:any)', 'backEnd\ArticleController::delete/$1', ['as' => 'article.delete']);// delete artikel
        $routeArticle->put('restore/(:any)', 'backEnd\ArticleController::restore/$1', ['as' => 'article.restore']);// restore artikel
        $routeArticle->post('backlink', 'backEnd\ArticleController::backlink', ['as' => 'article.backlink']);// list artikel JSON untuk backlink
    });
    
    $routeDashboard->group('gallery', ['filter' => 'role:admin,redaktur,contributor,editor'], function ($routeGallery) 
    { // pengelompokan route dashboard/gallery
        $routeGallery->post('image-from-editor', 'backEnd\GalleryController::editor', ['as' => 'gallery.editor']);// upload foto dari tinymce editor
        $routeGallery->get('foto', 'backEnd\GalleryController::foto', ['as' => 'gallery.foto']);// foto galeri(lihat semua foto)
    });

    $routeDashboard->group('report', ['filter' => 'role:admin,redaktur'], function ($routeReport)
    {
        $routeReport->group('page_view', ['filter' => 'role:admin,redaktur'], function ($routePageView)
        {
            $routePageView->get('/', 'backEnd\Report\ViewController::index', ['as' => 'report.page_view']);
        });

        $routeReport->group('page_active', ['filter' => 'role:admin,redaktur'], function ($routePageActive)
        {
            $routePageActive->get('/', 'backEnd\Report\ActiveController::index', ['as' => 'report.page_active']);
        });

        $routeReport->group('rubrik', ['filter' => 'role:admin,redaktur'], function ($routeRubrik)
        {
            $routeRubrik->get('/', 'backEnd\Report\RubrikController::index', ['as' => 'report.rubrik']);
        });

        $routeReport->group('tag', ['filter' => 'role:admin,redaktur'], function ($routeTag)
        {
            $routeTag->get('/', 'backEnd\Report\TagController::index', ['as' => 'report.tag']);
        });

        $routeReport->group('top_search', ['filter' => 'role:admin,redaktur'], function ($routeTopSearch)
        {
            $routeTopSearch->get('/', 'backEnd\Report\SearchController::index', ['as' => 'report.top_search']);
        });

    });

    $routeDashboard->group('preference', ['filter' => 'role:admin,redaktur'], function ($routePreference) 
    { // pengelompokan route dashboard/preference
        $routePreference->group('rubrik', ['filter' => 'role:admin,redaktur'], function ($routeRubrik)
        {
            $routeRubrik->get('/', 'backEnd\Preference\RubrikController::index', ['as' => 'preference.rubrik']);// list kategori
            $routeRubrik->post('store', 'backEnd\Preference\RubrikController::store', ['as' => 'preference.rubrik.store']);// store kategori
            $routeRubrik->put('update/(:any)', 'backEnd\Preference\RubrikController::update/$1', ['as' => 'preference.rubrik.update']);// update kategori
            $routeRubrik->delete('delete/(:any)', 'backEnd\Preference\RubrikController::delete/$1', ['as' => 'preference.rubrik.delete']);// delete kategori
            $routeRubrik->put('restore/(:any)', 'backEnd\Preference\RubrikController::restore/$1', ['as' => 'preference.rubrik.restore']);// restore kategori
        });
    
        $routePreference->group('tag', ['filter' => 'role:admin,redaktur'], function ($routeTag)
        {
            $routeTag->get('/', 'backEnd\Preference\TagController::index', ['as' => 'preference.tag']);// list tag
            $routeTag->get('json', 'backEnd\Preference\TagController::json', ['as' => 'preference.tag.json']);// list tag in JSON
            $routeTag->post('store', 'backEnd\Preference\TagController::store', ['as' => 'preference.tag.store']);// store tag
            $routeTag->put('update/(:any)', 'backEnd\Preference\TagController::update/$1', ['as' => 'preference.tag.update']);// update tag
            $routeTag->delete('delete/(:any)', 'backEnd\Preference\TagController::delete/$1', ['as' => 'preference.tag.delete']);// delete tag
        });
    
        $routePreference->group('template', ['filter' => 'role:admin,redaktur'], function ($routeTemplate)
        {
            $routeTemplate->get('/', 'backEnd\Preference\TemplateController::index', ['as' => 'preference.template']);// list templete yang tersedia
        });

        $routePreference->group('users', ['filter' => 'role:admin'], function ($routeUser)
        {
            $routeUser->get('/', 'backEnd\Preference\UserController::index', ['as' => 'preference.user']);
            $routeUser->post('json', 'backEnd\Preference\UserController::json', ['as' => 'preference.user.json']);
            $routeUser->post('store', 'backEnd\Preference\UserController::store', ['as' => 'preference.user.store']);
            $routeUser->put('update/(:any)', 'backEnd\Preference\UserController::update/$1', ['as' => 'preference.user.update']);
        });

    });
});

// template
$routes->get('/news', 'frontEnd\Home::index');
$routes->get('/categories', 'frontEnd\Home::categories');
// $routes->get('/read', 'frontEnd\Home::readnews');
$routes->get('/read/(:any)', 'frontEnd\Home::readnews/$1', ['as' => 'read.article']);
$routes->get('/categories/(:any)', 'frontEnd\Home::categories/$1');
$routes->get('/contact', 'frontEnd\Home::contact');
$routes->get('/search', 'frontEnd\Home::search');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
