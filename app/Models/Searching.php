<?php 
namespace App\Models;

use CodeIgniter\Model;

class Searching extends Model{
    protected $table      = 'searching';
    protected $primaryKey = 'id';
    protected $allowedFields = ['keyword'];// data index yg boleh di isi
}