<?php

namespace App\Controllers\backEnd\Report;

use App\Controllers\BaseController;
// use App\Models\{Category, Searching};
use config\Database;

class SearchController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
        session();
    }

    public function index()
    {
        $dataRaw = $this->db->table('searching s')
            ->select('s.keyword, COUNT(*) as times')
            ->groupBy('s.keyword')
            ->orderBy('times', 'DESC');

        $data = $dataRaw->get()->getResult();

        return view('dashboard/report/search', [
            'title' => 'Report Top Search',
            'hal' => 'report/top_search',
            'data' => $data,
        ]);
    }

}
