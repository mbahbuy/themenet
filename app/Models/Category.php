<?php 
namespace App\Models;

use CodeIgniter\Model;
use SteeveDroz\CiSlug\Slugify;

class Category extends Model{
    protected $table      = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['nama_kategori', 'slug', 'status'];// data index yg boleh di isi
    protected $beforeInsert = ['setSlug'];
    protected $beforeUpdate = ['setSlug'];

    public function setSlug($data)
    {
        $slugify = new Slugify($this);
        $data = $slugify->addSlug($data, 'nama_kategori');
        return $data;
    }

    // store record kategori
    public function record_kategori($id_kategori)
    {
        $this->db->table('record_kategori')
        ->insert(['id_kategori' => $id_kategori]);
    }
}