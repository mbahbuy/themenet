<?php 
namespace App\Models;

use CodeIgniter\Model;

class Backlink extends Model{
    protected $table      = 'backlink';
    protected $primaryKey = 'id_backlink';
    protected $allowedFields = ['id_judul', 'backlink'];// data index yg boleh di isi
}