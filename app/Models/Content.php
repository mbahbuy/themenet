<?php 
namespace App\Models;

use CodeIgniter\Model;

class Content extends Model{
    protected $table      = 'konten';
    protected $primaryKey = 'id_konten';
    protected $allowedFields = ['id_judul', 'sequence', 'konten'];// data index yg boleh di isi

    public function getKonten(){
        $builder = $this->db->table('konten')
            ->join('judul', 'konten.id_judul = judul.id_judul')
            ->limit(1)
            ->orderBy('konten', 'RANDOM');

        $query = $builder->get();
        return $query;
    }
}