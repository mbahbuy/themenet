<?php 
namespace App\Models;

use CodeIgniter\Model;
use SteeveDroz\CiSlug\Slugify;
use Config\Services;

class Title extends Model{
    protected $table      = 'judul';
    protected $primaryKey = 'id_judul';
    protected $allowedFields = ['id_kategori', 'user_hash', 'judul', 'meta_keyword', 'slug', 'status', 'waktu_status', 'picture', 'konten_singkat',];// data index yg boleh di isi
    protected $useTimestamps   = true;
    protected $useSoftDeletes = false; // Set to true if you're using soft deletes
    protected $beforeInsert = ['setSlug'];
    protected $beforeUpdate = ['setSlug'];

    public function setSlug($data)
    {
        $slugify = new Slugify($this);
        $data = $slugify->addSlug($data, 'judul');
        return $data;
    }

    public function getArticle($slug = null)
    {
        if ($slug !== null) {            
            $data = $this->db->table('judul j')
            ->select('j.id_judul, j.meta_keyword, u.name AS penulis, u.initial AS inisial, j.judul, j.slug, j.konten_singkat, j.status, j.waktu_status AS published_at, j.picture AS gambar, c.id_kategori, c.nama_kategori AS kategori, j.created_at AS created_at')
            ->join('users u', 'j.user_hash = u.user_hash', 'inner')
            ->join('kategori c', 'j.id_kategori = c.id_kategori', 'left')
            ->where('j.slug', $slug)
            ->get()
            ->getFirstRow();
            if ($data == null) {
                return null;
            }
    
            $dataKonten = $this->db->table('konten')
            ->select('konten')
            ->where('id_judul', $data->id_judul)
            ->orderBy('sequence', 'ASC')
            ->get()
            ->getResult();
            $konten = "";
            foreach ($dataKonten as $k) {
                $konten .= $k->konten;
            }

            $dataMeta = $this->db->table('meta m')
            ->select('m.id_meta, m.meta, m.slug')
            ->join('relasi_meta rm', 'm.id_meta = rm.id_meta', 'inner')
            ->where('rm.id_judul', $data->id_judul)
            ->get()
            ->getResultArray();

            $dataRelated = $this->db->table('judul j')
            ->select('j.judul, j.slug, j.picture AS gambar')
            ->join('backlink b', 'j.id_judul = b.backlink', 'inner')
            ->where('b.id_judul', $data->id_judul)
            ->get()
            ->getResultArray();

            $result = array_merge((array)$data, ['konten' => $konten, 'meta' => $dataMeta, 'related' => $dataRelated]);
            return $result;
        }

        $dataRaw = $this->db->table('judul j')
        ->select('u.name AS penulis, u.initial AS inisial, j.judul, j.slug, j.konten_singkat, j.status, j.waktu_status AS publised_at, j.picture AS gambar, c.nama_kategori AS kategori, j.created_at AS created_at')
        ->join('users u', 'j.user_hash = u.user_hash', 'inner')
        ->join('kategori c', 'j.id_kategori = c.id_kategori', 'inner')
        ->where('j.status', 'P')
        ->where('c.status', true)
        ->orderBy('created_at', 'DESC')
        ->get();    

        $data = $dataRaw->getResult();
        return $data;

    }

    // public function getKonten($slug = null)
    // {
    //     if ($slug !== null) {

    //         $data = $this->db->table('judul j')
    //         ->select('j.id_judul, u.name AS penulis, u.initial AS inisial, j.judul, j.slug, j.konten_singkat, j.status, j.waktu_status AS published_at, j.picture AS gambar, c.nama_kategori AS kategori, c.status AS kategori_status, j.created_at AS created_at, GROUP_CONCAT(m.meta) AS meta')
    //         ->join('users u', 'j.user_hash = u.user_hash', 'inner')
    //         ->join('kategori c', 'j.id_kategori = c.id_kategori', 'left')
    //         ->join('relasi_meta rm', 'j.id_judul = rm.id_judul', 'left')
    //         ->join('meta m', 'rm.id_meta = m.id_meta', 'left')
    //         ->where('j.user_hash', user()->user_hash)
    //         ->where('j.slug', $slug)
    //         ->groupBy('j.id_judul')
    //         ->orderBy('created_at', 'DESC')
    //         ->get()
    //         ->getFirstRow();

    //         $dataKonten = $this->db->table('konten')
    //         ->select('konten')
    //         ->where('id_judul', $data->id_judul)
    //         ->orderBy('sequence', 'ASC')
    //         ->get()
    //         ->getResult();
    //         $konten = "";
    //         foreach ($dataKonten as $k) {
    //             $konten .= $k->konten;
    //         }
    //         $result = array_merge((array)$data, ['konten' => $konten]);
    //         return $result;

    //     }

    //     $dataRaw = $this->db->table('judul j')
    //     ->select('u.name AS penulis, u.initial AS inisial, j.judul, j.slug, j.konten_singkat, j.status, j.waktu_status AS publised_at, j.picture AS gambar, c.nama_kategori AS kategori, c.status AS kategori_status, j.created_at AS created_at')
    //     ->join('users u', 'j.user_hash = u.user_hash', 'inner')
    //     ->join('kategori c', 'j.id_kategori = c.id_kategori', 'left')
    //     ->where('j.user_hash', user()->user_hash)
    //     ->orderBy('created_at', 'DESC')
    //     ->get();    

    //     $data = $dataRaw->getResult();
    //     return $data;
    // }

    // public function getJudulGroupedByCategory()
    // {
    //     $builder = $this->db->table('judul')
    //         ->join('kategori', 'judul.id_kategori = kategori.id_kategori')
    //         ->orderBy('judul.id_kategori', 'ASC');
                       
    //     $query = $builder->get();
    //     return $query;
    // }

    public function search($keyword, $page, $perPage)
    {
        $builder = $this->db->table('kategori')
            ->join('judul', 'judul.id_kategori = kategori.id_kategori')
            ->like('judul', $keyword)
            ->limit($perPage, ($page - 1) * $perPage);
                       
        $query = $builder->get();
        return $query;
    }

    public function getDropdownCategory()
    {
        $builder = $this->db->table('kategori')
            ->distinct()->select('nama_kategori')
            ->join('judul', 'judul.id_kategori = kategori.id_kategori', 'left');
                       
        $query = $builder->get();
        return $query;
    }

    public function getCategorySelected($nama_kategori)
    {
        $builder = $this->db->table('kategori')
            ->distinct()->select('nama_kategori')
            ->join('judul', 'judul.id_kategori = kategori.id_kategori', 'left')
            ->where('nama_kategori', $nama_kategori);
                       
        $query = $builder->get();
        return $query;
    }

    public function getJumlahJudulByKat($nama_kategori)
    {
        $builder = $this->db->table('kategori')
            ->select('nama_kategori')
            ->selectCount('judul', 'jml_judul_by_kat')
            ->join('judul', 'judul.id_kategori = kategori.id_kategori')
            ->where('nama_kategori', $nama_kategori);
                       
        $query = $builder->get();
        return $query;
    }

    public function getJudulByCategorySelected($nama_kategori, $page, $perPage)
    {
        $builder = $this->db->table('kategori')
            ->join('judul', 'judul.id_kategori = kategori.id_kategori')
            ->where('nama_kategori', $nama_kategori)
            ->limit($perPage, ($page - 1) * $perPage);
                       
        $query = $builder->get();
        return $query;
    }

    public function getCategoryWidget()
    {
        $builder = $this->db->table('kategori')
            ->select('nama_kategori')
            ->selectCount('nama_kategori', 'jumlah_nama_kategori')
            ->join('judul', 'judul.id_kategori = kategori.id_kategori', 'left')
            ->orderBy('nama_kategori', 'DESC')
            ->groupBy('nama_kategori');
                       
        $query = $builder->get();
        return $query;
    }

    // store record_article
    public function record_judul($id_judul)
    {
        $this->db->table('record_judul')
        ->insert(['id_judul' => $id_judul]);
    }

    public function getCountViewArticle($slug)
    {
        $builder = $this->db->table('judul')
            ->join('record_judul', 'record_judul.id = judul.id_judul')
            ->where('slug', $slug);
                       
        $query = $builder->get();
        return $query;
    }

    public function getCategoryArticlePost($slug)
    {
        $builder = $this->db->table('kategori')
            ->join('judul', 'judul.id_kategori = kategori.id_kategori')
            ->where('judul.slug', $slug);
                       
        $query = $builder->get();
        return $query;
    }    
    
// SELECT nama_kategori, judul, picture FROM judul JOIN kategori ON judul.id_kategori = kategori.id_kategori
}