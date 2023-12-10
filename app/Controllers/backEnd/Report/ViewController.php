<?php

namespace App\Controllers\backEnd\Report;

use App\Controllers\BaseController;
// use App\Models\{Category};
use config\Database;

class ViewController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
        session();
    }

    public function index()
    {
        $dataRaw = $this->db->table('judul j')
        ->select('u.name AS penulis, u.initial, j.judul, j.waktu_status AS published_at, c.nama_kategori AS kategori, COUNT(rj.id_judul) as view')
        ->join('users u', 'j.user_id = u.id', 'left')
        ->join('kategori c', 'j.id_kategori = c.id_kategori', 'inner')
        ->join('record_judul rj', 'rj.id_judul = j.id_judul', 'left') // Use left join for optional views
        ->where('j.status', 'P')
        ->where('c.status', true)
        ->groupBy('j.id_judul') // Group by the article ID to count views per article
        ->orderBy('view', 'DESC');
    

        $perPage = 10;
        $page = $this->request->getVar('page') ?? 1;
        $keyword = $this->request->getVar('keyword') ?? null;
        
        if ($keyword !== null) {
            $dataRaw->like('j.judul', $keyword);
            $search = $keyword;
        }

        // Clone the original query builder to retrieve the total number of records
        $totalDataRaw = clone $dataRaw;
        $totalRows = $totalDataRaw->countAllResults();

        // Limit and offset for the current page
        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        // Apply the limit and offset to the original query builder
        $dataRaw->limit($limit, $offset);

        $data = $dataRaw->get()->getResult();

        // Manually create pagination links
        $pager = service('pager');
        // $pager->setPath('dashboard/article/list');

        return view('dashboard/report/page_view', [
            'title' => 'Report View',
            'hal' => 'report/page_view',
            'article' => $data,
            'pager' => $pager->makeLinks($page, $perPage, $totalRows, 'dashboard_article_list'),
            'page' => $page,
            'search' => $search ?? '',
        ]);
    }

}
