<?php 
namespace App\Database\Seeds;

use App\Models\{Category};
use jcobhams\NewsApi\NewsApi;

class CategorySeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $categori = new Category();

        $categoriApi = new NewsApi('e3251800c3f84b94955818bea4a37d86');
        $categories = $categoriApi->getCategories();

        foreach ($categories as $value) {
            $categori->insert(['nama_kategori' => $value]);
        }

    }
}