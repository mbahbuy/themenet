<?php

namespace App\Controllers\backEnd\Report;

use App\Controllers\BaseController;
use config\Database;
// use App\Models\{Category};

class TagController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
        session();
    }

    public function index()
    {
        $dataRaw = $this->db->table('meta m')
        ->select('m.meta AS nama, COUNT(rcm.id_meta) AS views')
        ->join('record_meta rcm', 'rcm.id_meta = m.id_meta', 'left')
        ->groupBy('nama')
        ->orderBy('views', 'DESC');

        $data = $dataRaw->get()->getResult();
        return view('dashboard/report/tag', [
            'title' => 'Report Tag',
            'hal' => 'report/tag',
            'tags' => $data,
        ]);
    }

}
