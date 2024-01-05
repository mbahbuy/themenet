<?php

namespace App\Controllers\backEnd\Report;

use App\Controllers\BaseController;
use App\Models\{Title};
use config\Database;

class ActiveController extends BaseController
{
    protected $db, $judul;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->judul = new Title();

        session();
    }

    public function index()
    {
        // Get the total count of all articles
        $totalArticles = $this->db->table('judul j')
            ->select('*')
            ->join('kategori k', 'j.id_kategori = k.id_kategori', 'inner')
            ->where('j.status', 'P')
            ->where('k.status', true)
            ->countAllResults();

        // Modify the existing query to include percentage calculation
        $dataRaw = $this->db->table('users u')
            ->select('u.id, u.name, u.initial, COUNT(rj.id_judul) as articles_view')
            ->join('judul j', 'j.user_id = u.id AND j.status = "P"', 'left') // Use LEFT JOIN instead of INNER JOIN
            ->join('record_judul rj', 'rj.id_judul = j.id_judul', 'left')
            ->join('kategori k', 'j.id_kategori = k.id_kategori AND k.status <> 0', 'left')
            ->groupBy('u.id'); // Include non-aggregated columns in GROUP BY
        
        $data = $dataRaw->get()->getResult();
    

        // Calculate and add the percentage contribution to the result set
        foreach ($data as $row) {
            $articles = $this->judul
                ->select('COUNT(id_judul) AS articles')
                ->where('user_id', $row->id)
                ->first();
            $row->articles = $articles['articles'];

            $row->kontribusi = number_format(((int)$row->articles / (int)$totalArticles) * 100, 2) . '%';
        }

        dd($data);
        return view('dashboard/report/page_active', [
            'title' => 'Report Page Active',
            'hal' => 'report/page_active',
            'users' => $data,
        ]);
    }

}
