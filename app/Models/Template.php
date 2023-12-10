<?php 
namespace App\Models;

use CodeIgniter\Model;

class Template extends Model{
    protected $table      = 'templates';
    protected $primaryKey = 'id';
    protected $allowedFields = [ 'template', 'location',];// data index yg boleh di isi

}