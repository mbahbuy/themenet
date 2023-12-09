<?php

namespace App\Controllers\backEnd\Report;

use App\Controllers\BaseController;
use App\Models\{Category};
use config\Database;

class ActivityController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();

        session();
    }

    public function index()
    {
        $dataRaw = $this->db->table('users u')
        ->select('u.name AS penulis, COUNT(j.id_judul) as article, all_article_view, kontribusi')
        ->join('users u', 'j.user_hash = u.user_hash', 'left')
        ->join('judul j', 'j.user_hash = u.user_hash', 'left')
        ->join('record_judul rj', 'rj.id_judul = j.id_judul', 'left')
        ->where('j.status', 'P')
        ->where('c.status', true)
        ->groupBy('u.id');
    

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

        return view('dashboard/report/page_activity', [
            'title' => 'Report Activity',
            'hal' => 'report/page_activity',
            'user' => $data,
            'pager' => $pager->makeLinks($page, $perPage, $totalRows, 'dashboard_article_list'),
            'page' => $page,
            'search' => $search ?? '',
        ]);
    }

}
