<?php 
namespace App\Models;

use CodeIgniter\Model;
use SteeveDroz\CiSlug\Slugify;

class Meta extends Model{
    protected $table      = 'meta';
    protected $primaryKey = 'id_meta';
    protected $allowedFields = ['meta', 'slug'];// data index yg boleh di isi
    protected $beforeInsert = ['setSlug'];
    protected $beforeUpdate = ['setSlug'];

    public function setSlug($data)
    {
        $slugify = new Slugify($this);
        $data = $slugify->addSlug($data, 'meta');
        return $data;
    }

    public function insert_relasi_meta($id_judul, $id_meta)
    {
        $this->db->table('relasi_meta')->insert([
            'id_judul' => $id_judul,
            'id_meta' => $id_meta
        ]);
    }

    public function delete_relasi_meta($id_judul)
    {
        $this->db->table('relasi_meta')->where('id_judul', $id_judul)->delete();
    }

    public function delete_meta_ralationship($id_meta)
    {
        $this->db->table('relasi_meta')->where('id_meta', $id_meta)->delete();

    }

    public function delete_spesific_relationship($id_judul, $id_meta)
    {
        $this->db->table('relasi_meta')
        ->where('id_judul', $id_judul)
        ->where('id_meta', $id_meta)
        ->delete();
    }

    // store record meta
    public function record_meta($id_meta)
    {
        $this->db->table('record_meta')
        ->insert(['id_meta' => $id_meta]);
    }
    
}