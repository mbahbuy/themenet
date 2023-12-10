<?php

namespace App\Controllers\backEnd\Report;

use App\Controllers\BaseController;
use App\Models\{Category};
use config\Database;

class ActiveController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();

        session();
    }

    public function index()
    {
        // Get the total count of all articles
        $totalArticles = $this->db->table('judul j')
            ->select('*')
            ->join('kategori k', 'j.id_kategori = k.id_kategori', 'left')
            ->where('j.status', 'P')
            ->where('k.status', true)
            ->countAllResults();

        // Modify the existing query to include percentage calculation
        $dataRaw = $this->db->table('users u')
            ->select('u.name, u.initial, COUNT(j.judul) as articles, COUNT(rj.id_judul) as articles_view')
            ->join('judul j', 'j.user_id = u.id AND j.status = "P"', 'left') // Use LEFT JOIN instead of INNER JOIN
            ->join('record_judul rj', 'rj.id_judul = j.id_judul', 'left')
            ->join('kategori k', 'j.id_kategori = k.id_kategori AND k.status <> 0', 'left')
            ->groupBy('u.id') // Include non-aggregated columns in GROUP BY
            ->orderBy('articles', 'DESC');
        
        $data = $dataRaw->get()->getResult();
    

        // Calculate and add the percentage contribution to the result set
        foreach ($data as $row) {
            $row->kontribusi = number_format(($row->articles / $totalArticles) * 100, 2) . '%';
        }

        return view('dashboard/report/page_active', [
            'title' => 'Report Page Active',
            'hal' => 'report/page_active',
            'users' => $data,
        ]);
    }

}
