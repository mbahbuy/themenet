<?php 
namespace App\Models;

use CodeIgniter\Model;

class Images extends Model{
    protected $table      = 'gambar';
    protected $primaryKey = 'picture';
    protected $allowedFields = ['picture', 'ukuran'];// data index yg boleh di isi
}