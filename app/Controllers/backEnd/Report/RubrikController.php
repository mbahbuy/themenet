<?php

namespace App\Controllers\backEnd\Report;

use App\Controllers\BaseController;
// use App\Models\{Category};
use config\Database;

class RubrikController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
        session();
    }

    public function index()
    {
        $dataRaw = $this->db->table('kategori k')
            ->select('k.id_kategori, k.nama_kategori AS nama, COUNT(DISTINCT j.id_judul) AS articles')
            ->join('judul j', "k.id_kategori = j.id_kategori AND j.status = 'P'", 'left')
            ->groupBy('k.id_kategori, nama')
            ->orderBy('articles', 'DESC');

        $data = $dataRaw->get()->getResult();

        foreach ($data as $row) {
            $row->views = $this->db->table('record_kategori')
                ->select('COUNT(*) as count')
                ->where('id_kategori', $row->id_kategori)
                ->get()
                ->getFirstRow()
                ->count;
        }

        return view('dashboard/report/rubrik', [
            'title' => 'Report Rubrik',
            'hal' => 'report/rubrik',
            'rubriks' => $data,
        ]);
    }

}
