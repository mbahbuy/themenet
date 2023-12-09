<?php 
namespace App\Models;

use CodeIgniter\Model;

class Template extends Model{
    protected $table      = 'templates';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_hash', 'template', 'status',];// data index yg boleh di isi
    protected $useTimestamps   = true;

    protected $beforeInsert = ['setFalseToOldTemplate'];

    public function setFalseToOldTemplate()
    {
        $this->where(['user_hash' => user()->user_hash, 'status' => true])->update(['status' => false]);
    }
}