<?php 
namespace App\Database\Seeds;

use jcobhams\NewsApi\NewsApi;
use App\Models\{Content, Meta, Title, Category};

class ArticleSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $judul = new Title();
        $konten = new Content();
        $meta = new Meta();
        $meta->insert(['meta' => 'Internasional']);
        $id_meta = $meta->insertID;
        $newsapi = new NewsApi('e3251800c3f84b94955818bea4a37d86');
        $today = new \DateTime();
        $kategori = new Category();
        $kategories = $kategori->findAll();

        $users = [1, 2, 3, 4];
        foreach ($kategories as $value) {
            $news = $newsapi->getEverything($value['nama_kategori']);
    
            foreach ($news->articles as $n) {
                $randKey = array_rand([3,2,1,0]);
                $data = [
                    'judul' => $n->title,
                    'picture' => $n->urlToImage,
                    'id_kategori' => $value['id_kategori'],
                    'user_id' => $users[$randKey],
                    'status' => 'P',
                    'waktu_status' => $today->format('Y-m-d'),
                    'konten_singkat' => $n->description
                ];
        
                $judul->insert($data);
                $id_judul = $judul->insertID;
    
                $konten->insert([
                    'id_judul' => $id_judul,
                    'sequence' => 1,
                    'konten'   => $n->content,
                ]);
    
                $meta->insert_relasi_meta($id_judul, $id_meta);
                
            }
        }
    }
}