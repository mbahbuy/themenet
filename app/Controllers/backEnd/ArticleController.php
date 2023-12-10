<?php 
namespace App\Controllers\backEnd;

use App\Controllers\BaseController;
use App\Models\{Backlink, Category, Content, Images, Meta, Title};
use Config\Database;
use SteeveDroz\CiSlug\Slugify;

class ArticleController extends BaseController
{
    protected $article, $kategori, $meta, $gambar, $konten, $db, $backlink;

    public function __construct()
    {
        $this->article = new Title();
        $this->kategori = new Category();
        $this->meta = new Meta();
        $this->gambar = new Images();
        $this->konten = new Content();
        $this->backlink = new Backlink();
        $this->db = Database::connect();
        session();
    }


    public function index()
    {
        $dataRaw = $this->db->table('judul j')
        ->select('u.name AS penulis, u.initial AS inisial, j.judul, j.slug, j.konten_singkat, j.status, j.waktu_status AS publised_at, j.picture AS gambar, c.nama_kategori AS kategori, c.status AS kategori_status, j.created_at AS created_at, COUNT(rj.id_judul) as view')
        ->join('users u', 'j.user_id = u.id', 'inner')
        ->join('kategori c', 'j.id_kategori = c.id_kategori', 'left')
        ->join('record_judul rj', 'rj.id_judul = j.id_judul', 'left')
        ->where('j.user_hash', user()->user_hash)
        ->groupBy('j.id_judul')
        ->orderBy('created_at', 'DESC');

        $perPage = 10;
        $page = $this->request->getVar('page') ?? 1;
        $keyword = $this->request->getVar('keyword') ?? null;
        
        if ($keyword !== null) {
            $dataRaw->like('j.judul', $keyword);
            $search = $keyword;
        }

        // Clone the original query builder to retrieve the total number of records
        $totalDataRaw = clone $dataRaw;
        $totalRows = $totalDataRaw->countAllResults();

        // Limit and offset for the current page
        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        // Apply the limit and offset to the original query builder
        $dataRaw->limit($limit, $offset);

        $data = $dataRaw->get()->getResult();

        // Manually create pagination links
        $pager = service('pager');
        // $pager->setPath('dashboard/article/list');

        return view('dashboard/article/list', [
            'title' => 'List Article',
            'hal' => 'article/list',
            'article' => $data,
            'pager' => $pager->makeLinks($page, $perPage, $totalRows, 'dashboard_article_list'),
            'page' => $page,
            'search' => $search ?? '',
        ]);
    }
    
    public function form()
    {
        return view('dashboard/article/form', [
            'title' => 'Form Article',
            'hal' => 'article/form',
            'category' => $this->kategori->findAll(),
            'tags' => $this->meta->findAll(),
        ]);
    }

    public function store()
    {
        // Validation rules
        $validationRules = [
            'judul' => 'required|is_unique[judul.judul]|max_length[100]',
            'poster' => 'is_image[poster]|mime_in[poster,image/jpg,image/jpeg,image/png,image/gif,image/svg]|max_size[poster,2048]',
            'meta_keyword' => 'max_length[225]',
            'kategori' => 'required|is_not_unique[kategori.id_kategori]',
            'konten' => 'required',
            'deskripsi' => 'required|max_length[225]',
            'meta' => 'required|valid_json',
        ];
    
        $validationMessages = [
            'required' => '{field} harus di isi.',
            'is_unique' => '{field} sudah ada dalam daftar berita.',
            'is_image' => '{field} harus berupa gambar.',
            'mime_in' => '{field} harus berupa file jpg, jpeg, gif, png, atau svg.',
            'max_size' => 'Maksimal ukuran {field} adalah 2MB.',
            'max_lenght' => '{field} melebihi huruf yang ditentukan',
            'is_not_unique' => 'Data tidak terdaftar dalam database.',
            'valid_json' => '{field} bukanlah data JSON.',
        ];
    
        // Validate the input data
        if (!$this->validate($validationRules, $validationMessages)) {
            $validationErrors = implode(', ', $this->validator->getErrors());
            return $this->response->setJSON(['bg' => 'bg-danger', 'message' => $validationErrors]);
        }
    
        // Handle the uploaded poster image
        $filePoster = $this->request->getFile('poster');
        $namaPoster = $filePoster->getError() == 4 ? 'default.png' : $filePoster->getRandomName();
        
        if ($filePoster->getError() !== 4) {
            list($width, $height, $type, $attr) = getimagesize($filePoster);
            $filePoster->move('images/gallery/', $namaPoster);
    
            // Save to the images table
            $this->gambar->insert([
                "picture" => $namaPoster,
                "ukuran" => $width . '.' . $height
            ]);
        }
    
        // Determine the article status
        $status = $this->request->getVar('date') && $this->request->getVar('date') !== null || $this->request->getVar('date') && $this->request->getVar('date') !== "" ? 'P' : 'D';
        $waktu_status = null;
        if ($this->request->getVar('date') && $this->request->getVar('date') !== null || $this->request->getVar('date') && $this->request->getVar('date') !== "") {
            $today = new \DateTime();
            $parsedDate = new \DateTime($this->request->getVar('date'));
        
            if ($parsedDate->format('Y-m-d') == $today->format('Y-m-d')) {
                $status = 'P'; // Published
                $waktu_status = $today->format('Y-m-d');
            } elseif ($parsedDate->format('Y-m-d') > $today->format('Y-m-d')) {
                $status = 'F'; // Scheduled for Future
                $waktu_status = $parsedDate->format('Y-m-d');
            }
        }
    
        // Save the article data
        $this->article->save([
            'judul' => $this->request->getVar('judul'),
            'meta_keyword' => $this->request->getVar('meta_keyword'),
            'picture' => $namaPoster,
            'id_kategori' => $this->request->getVar('kategori'),
            'user_hash' => user()->user_hash,
            'status' => $status,
            'waktu_status' => $waktu_status,
            'konten_singkat' => $this->request->getVar('deskripsi')
        ]);
        
        $id_judul = $this->article->insertID();
    
        // Split and save the content into the konten table
        $panjang_max = 225;
        $potongan_konten = str_split($this->request->getVar('konten'), $panjang_max);
        $sequence = 1;
    
        foreach ($potongan_konten as $potongan) {
            $this->konten->insert([
                'id_judul' => $id_judul,
                'sequence' => $sequence++,
                'konten'   => $potongan,
            ]);
        }
    
        // Update the tags in the meta table
        $meta = json_decode($this->request->getVar('meta'), true);
        foreach ($meta as $tag) {
            // Insert the relationship between the article and the tag
            $this->meta->insert_relasi_meta($id_judul, $tag);
        }

        // insert backlink/relateda article
        $backlink = json_decode($this->request->getVar('backlink'), true);
        if (sizeof($backlink)) {
            foreach ($backlink as $value) {
                $this->backlink->insert([
                    'id_judul' => $id_judul,
                    'backlink' => $value,
                ]);
            }
        }

        $slug = $this->article->select('slug')->find($id_judul);
    
        return $this->response->setJSON(['bg' => 'bg-success', 'message' => 'Article telah disimpan', 'slug' => $slug['slug']]);
    }
    

    public function publish()
    {
        // Validation rules
        $validationRules = [
            'judul' => 'required|is_unique[judul.judul]|max_length[100]',
            'poster' => 'is_image[poster]|mime_in[poster,image/jpg,image/jpeg,image/png,image/gif,image/svg]|max_size[poster,2048]',
            'meta_keyword' => 'max_length[225]',
            'kategori' => 'required|is_not_unique[kategori.id_kategori]',
            'konten' => 'required',
            'deskripsi' => 'required|max_length[225]',
            'meta' => 'required|valid_json',
        ];
    
        $validationMessages = [
            'required' => '{field} harus di isi.',
            'is_unique' => '{field} sudah ada dalam daftar komik.',
            'is_image' => '{field} harus berupa gambar.',
            'mime_in' => '{field} harus berupa file jpg, jpeg, gif, png, atau svg.',
            'max_size' => 'Maksimal ukuran {field} adalah 2MB.',
            'max_lenght' => '{field} melebihi huruf yang ditentukan',
            'is_not_unique' => 'Data tidak terdaftar dalam database.',
            'valid_json' => '{field} bukanlah data JSON.',
        ];
    
        // Validate the input data
        if (!$this->validate($validationRules, $validationMessages)) {
            $validationErrors = implode(', ', $this->validator->getErrors());
            return $this->response->setJSON(['bg' => 'bg-danger', 'message' => $validationErrors]);
        }

        // Handle the uploaded poster image
        $filePoster = $this->request->getFile('poster');
        $namaPoster = $filePoster->getError() == 4 ? 'default.png' : $filePoster->getRandomName();
        
        if ($filePoster->getError() !== 4) {
            list($width, $height, $type, $attr) = getimagesize($filePoster);
            $filePoster->move('images/gallery/', $namaPoster);
    
            // Save to the images table
            $this->gambar->insert([
                "picture" => $namaPoster,
                "ukuran" => $width . '.' . $height
            ]);
        }

        $today = new \DateTime();
        $this->article->save([
            'judul' => $this->request->getVar('judul'),
            'meta_keyword' => $this->request->getVar('meta_keyword'),
            'picture' => $namaPoster,
            'id_kategori' => $this->request->getVar('kategori'),
            'user_hash' => user()->user_hash,
            'status' => 'P',
            'waktu_status' => $today->format('Y-m-d'),
            'konten_singkat' => $this->request->getVar('deskripsi'),
        ]);

        $id_judul = $this->article->insertID();

        // Split and save the content into the konten table
        $panjang_max = 225;
        $potongan_konten = str_split($this->request->getVar('konten'), $panjang_max);
        $sequence = 1;
    
        foreach ($potongan_konten as $potongan) {
            $this->konten->insert([
                'id_judul' => $id_judul,
                'sequence' => $sequence++,
                'konten'   => $potongan,
            ]);
        }

        // Update the tags in the meta table
        $meta = json_decode($this->request->getVar('meta'), true);
        foreach ($meta as $tag) {
            // Insert the relationship between the article and the tag
            $this->meta->insert_relasi_meta($id_judul, $tag);
        }

        // insert backlink/relateda article
        $backlink = json_decode($this->request->getVar('backlink'), true);
        if (sizeof($backlink)) {
            foreach ($backlink as $value) {
                $this->backlink->insert([
                    'id_judul' => $id_judul,
                    'backlink' => $value,
                ]);
            }
        }

        $slug = $this->article->select('slug')->find($id_judul);

        return $this->response->setJSON(['bg' => 'bg-success', 'message' => 'Article telah dipublish', 'slug' => $slug['slug']]);
    }

    public function edit($data)
    {
        $dataArticle = $this->article->getArticle($data);
        return view('dashboard/article/edit', [
            'title' => 'Form Article-' . $dataArticle['judul'],
            'hal' => 'article/form',
            'category' => $this->kategori->findAll(),
            'tags' => $this->meta->findAll(),
            'article' => $dataArticle,
        ]);
    }

    public function update($slug)
    {
        // Validate input data
        $validationRules = [
            'judul' => 'required|max_length[100]',
            'kategori' => 'required|is_not_unique[kategori.id_kategori]',
            'meta_keyword' => 'max_length[225]',
            'konten' => 'required',
            'deskripsi' => 'required|max_length[225]',
            'meta' => 'required|valid_json',
        ];
    
        $validationMessages = [
            'required' => '{field} harus di isi.',
            'max_lenght' => '{field} melebihi huruf yang ditentukan',
            'is_not_unique' => 'Data tidak terdaftar dalam database.',
            'valid_json' => '{field} bukanlah data JSON.',
        ];
    
        // Validate the input data
        if (!$this->validate($validationRules, $validationMessages)) {
            $validationErrors = implode(', ', $this->validator->getErrors());
            return $this->response->setJSON(['bg' => 'bg-danger', 'message' => $validationErrors]);
        }
    
        // Fetch the existing article data
        $existingArticle = $this->article->where('slug', $slug)->first();
    
        if (!$existingArticle) {
            return $this->response->setJSON(['bg' => 'bg-danger', 'message' => 'Article tidak ditemukan']);
        }
    
        $id_judul = $existingArticle['id_judul'];

        // Get the old poster filename
        $oldPoster = $this->request->getVar('old_poster');
        
        // Handle the uploaded poster image
        $filePoster = $this->request->getFile('poster');
        
        if ($filePoster) {
            if ($filePoster->getError() == 4) {
                $namaPoster = $oldPoster;
            } else {
                $validationImage = ['poster' => 'permit_empty|is_image[poster]|mime_in[poster,image/jpg,image/jpeg,image/png,image/gif,image/svg]|max_size[poster,2048]'];
                $validationImageMessage = [
                    'is_image' => '{field} harus berupa gambar.',
                    'mime_in' => '{field} harus berupa file jpg, jpeg, gif, png, atau svg.',
                    'max_size' => 'Maksimal ukuran {field} adalah 2MB.',
                ];
                // Validate the input data
                if (!$this->validate($validationImage, $validationImageMessage)) {
                    $validationImageErrors = implode(', ', $this->validator->getErrors());
                    return $this->response->setJSON(['bg' => 'bg-danger', 'message' => $validationImageErrors]);
                }
    
                $namaPoster =  $filePoster->getError() == 4 ? $oldPoster : $filePoster->getRandomName(); // Initialize with the old poster filename
                
                // Handle the new poster image and update $namaPoster accordingly
                list($width, $height, $type, $attr) = getimagesize($filePoster);
                $filePoster->move('images/gallery/', $namaPoster);
    
                // Delete the old poster image if it has changed
                if ($oldPoster !== 'default.png' && $oldPoster !== $namaPoster) {
                    // unlink('images/gallery/' . $oldPoster);
        
                    // Save to the images table
                    $this->gambar->insert([
                        "picture" => $namaPoster,
                        "ukuran" => $width . '.' . $height
                    ]);
                }
            }
        } else {
            $namaPoster = $oldPoster;
        }
        
    
        $status = $existingArticle['status'];
        $waktu_status = $existingArticle['waktu_status'];

        if ($status == "D") {
            if($this->request->getVar('date') && $this->request->getVar('date') !== null || $this->request->getVar('date') && $this->request->getVar('date') !== ""){
                // Determine the article status
                $status = $this->request->getVar('date') ? 'P' : 'D';
            
                $today = new \DateTime();
                $parsedDate = new \DateTime($this->request->getVar('date'));
            
                if ($parsedDate->format('Y-m-d') == $today->format('Y-m-d')) {
                    $status = 'P'; // Published
                    $waktu_status = $today->format('Y-m-d');
                } elseif ($parsedDate->format('Y-m-d') > $today->format('Y-m-d')) {
                    $status = 'F'; // Scheduled for Future
                    $waktu_status = $parsedDate->format('Y-m-d');
                }
            }
        }
    
        // Update the article data
        $this->article->update($id_judul, [
            'judul' => $this->request->getVar('judul'),
            'meta_keyword' => $this->request->getVar('meta_keyword'),
            'picture' => $namaPoster,
            'id_kategori' => $this->request->getVar('kategori'),
            'status' => $status,
            'waktu_status' => $waktu_status,
            'konten_singkat' => $this->request->getVar('deskripsi')
        ]);
    
        // Update the content in the konten table
        $panjang_max = 225;
        $potongan_konten = str_split($this->request->getVar('konten'), $panjang_max);
        $sequence = 1;

        foreach ($potongan_konten as $potongan) {
            $existingContent = $this->konten->where(['id_judul' => $id_judul, 'sequence' => $sequence])->first();

            if ($existingContent) {
                $this->konten->update($existingContent['id_konten'],[
                    'konten' => $potongan,
                ]);
            } else {
                $this->konten->insert([
                    'id_judul' => $id_judul,
                    'sequence' => $sequence,
                    'konten' => $potongan,
                ]);
            }
            $sequence++;
        }

        // Delete overload sequences
        $this->konten->where('id_judul', $id_judul)->where('sequence >', $sequence)->delete();
    
        // Update the tags
        $meta = json_decode($this->request->getVar('meta'), true);

        // Get the current relationships for the article
        $currentRelationships = $this->db->table('relasi_meta')
            ->select('id_meta')
            ->where('id_judul', $id_judul)
            ->get()
            ->getResultArray();

        foreach ($meta as $tag) {
            // Check if the tag relationship already exists
            $relationshipExists = false;

            foreach ($currentRelationships as $relationship) {
                if ($relationship['id_meta'] == $tag) {
                    $relationshipExists = true;
                    break;
                }
            }

            if (!$relationshipExists || $relationshipExists == false) {
                // Insert the relationship between the article and the tag
                $this->meta->insert_relasi_meta($id_judul, $tag);
            }
        }

        // Delete relationships that exist in the database but not in the "meta" field
        foreach ($currentRelationships as $relationship) {
            if (!in_array($relationship['id_meta'], $meta)) {
                // Delete the relationship
                $this->meta->delete_spesific_relationship($id_judul, $relationship['id_meta']);
            }
        }

        // update backlink/relateda article
        $backlink = json_decode($this->request->getVar('backlink'), true);

        // get Current backlink
        $currentBacklink = $this->backlink->where('id_judul', $id_judul)->findAll();

        if (sizeof($backlink)) {
            foreach ($backlink as $value) {
                $backlinkSaved = false;
                foreach ($currentBacklink as $cb) {
                    if ($cb['backlink'] == $value) {
                        $backlinkSaved = true;
                        break;
                    }
                }
                if (!$backlinkSaved || $backlinkSaved == false) {
                    $this->backlink->insert([
                        'id_judul' => $id_judul,
                        'backlink' => $value,
                    ]);
                }
            }
        }

        // delete current backlink jika tidak ada dalam field backlink form
        foreach ($currentBacklink as $currentb) {
            if (!in_array($currentb['backlink'], $backlink)) {
                $this->backlink->delete($currentb['id_backlink']);
            }
        }
    
        return $this->response->setJSON(['bg' => 'bg-success', 'message' => 'Article telah diperbarui']);
    }
    

    public function publish_update($slug)
    {
        // Validate input data
        $validationRules = [
            'judul' => 'required|max_length[100]',
            'meta_keyword' => 'max_length[225]',
            'kategori' => 'required|is_not_unique[kategori.id_kategori]',
            'konten' => 'required',
            'deskripsi' => 'required|max_length[225]',
            'meta' => 'required|valid_json',
        ];
    
        $validationMessages = [
            'required' => '{field} harus di isi.',
            'max_lenght' => '{field} melebihi huruf yang ditentukan',
            'is_not_unique' => 'Data tidak terdaftar dalam database.',
            'valid_json' => '{field} bukanlah data JSON.',
        ];
    
        // Validate the input data
        if (!$this->validate($validationRules, $validationMessages)) {
            $validationErrors = implode(', ', $this->validator->getErrors());
            return $this->response->setJSON(['bg' => 'bg-danger', 'message' => $validationErrors]);
        }
    
        // Fetch the existing article data
        $existingArticle = $this->article->where('slug', $slug)->first();
    
        if (!$existingArticle) {
            return $this->response->setJSON(['bg' => 'bg-danger', 'message' => 'Article tidak ditemukan']);
        }
    
        $id_judul = $existingArticle['id_judul'];

        // Get the old poster filename
        $oldPoster = $this->request->getVar('old_poster');
        
        // Handle the uploaded poster image
        $filePoster = $this->request->getFile('poster');
        
        if ($filePoster) {
            if ($filePoster->getError() == 4) {
                $namaPoster = $oldPoster;
            } else {
                $validationImage = ['poster' => 'permit_empty|is_image[poster]|mime_in[poster,image/jpg,image/jpeg,image/png,image/gif,image/svg]|max_size[poster,2048]'];
                $validationImageMessage = [
                    'is_image' => '{field} harus berupa gambar.',
                    'mime_in' => '{field} harus berupa file jpg, jpeg, gif, png, atau svg.',
                    'max_size' => 'Maksimal ukuran {field} adalah 2MB.',
                ];
                // Validate the input data
                if (!$this->validate($validationImage, $validationImageMessage)) {
                    $validationImageErrors = implode(', ', $this->validator->getErrors());
                    return $this->response->setJSON(['bg' => 'bg-danger', 'message' => $validationImageErrors]);
                }
    
                $namaPoster =  $filePoster->getError() == 4 ? $oldPoster : $filePoster->getRandomName(); // Initialize with the old poster filename
                
                // Handle the new poster image and update $namaPoster accordingly
                list($width, $height, $type, $attr) = getimagesize($filePoster);
                $filePoster->move('images/gallery/', $namaPoster);
    
                // Delete the old poster image if it has changed
                if ($oldPoster !== 'default.png' && $oldPoster !== $namaPoster) {
                    // unlink('images/gallery/' . $oldPoster);
                    
                    // Save to the images table
                    $this->gambar->insert([
                        "picture" => $namaPoster,
                        "ukuran" => $width . '.' . $height
                    ]);
                }
            }
        } else {
            $namaPoster = $oldPoster;
        }
    
        $today = new \DateTime();
        // Update the article data
        $this->article->update($id_judul, [
            'judul' => $this->request->getVar('judul'),
            'picture' => $namaPoster,
            'id_kategori' => $this->request->getVar('kategori'),
            'status' => 'P',
            'waktu_status' => $today->format('Y-m-d'),
            'konten_singkat' => $this->request->getVar('deskripsi')
        ]);
    
        // Update the content in the konten table
        $panjang_max = 225;
        $potongan_konten = str_split($this->request->getVar('konten'), $panjang_max);
        $sequence = 1;

        foreach ($potongan_konten as $potongan) {
            $existingContent = $this->konten->where(['id_judul' => $id_judul, 'sequence' => $sequence])->first();

            if ($existingContent) {
                $this->konten->update($existingContent['id_konten'],[
                    'konten' => $potongan,
                ]);
            } else {
                $this->konten->insert([
                    'id_judul' => $id_judul,
                    'sequence' => $sequence,
                    'konten' => $potongan,
                ]);
            }
            $sequence++;
        }

        // Delete overload sequences
        $this->konten->where('id_judul', $id_judul)->where('sequence >', $sequence)->delete();
    
        // Update the tags
        $meta = json_decode($this->request->getVar('meta'), true);

        // Get the current relationships for the article
        $currentRelationships = $this->db->table('relasi_meta')
            ->select('id_meta')
            ->where('id_judul', $id_judul)
            ->get()
            ->getResultArray();

        foreach ($meta as $tag) {
            // Check if the tag relationship already exists
            $relationshipExists = false;

            foreach ($currentRelationships as $relationship) {
                if ($relationship['id_meta'] == $tag) {
                    $relationshipExists = true;
                    break;
                }
            }

            if (!$relationshipExists || $relationshipExists == false) {
                // Insert the relationship between the article and the tag
                $this->meta->insert_relasi_meta($id_judul, $tag);
            }
        }

        // Delete relationships that exist in the database but not in the "meta" field
        foreach ($currentRelationships as $relationship) {
            if (!in_array($relationship['id_meta'], $meta)) {
                // Delete the relationship
                $this->meta->delete_spesific_relationship($id_judul, $relationship['id_meta']);
            }
        }

    
        return $this->response->setJSON(['bg' => 'bg-success', 'message' => 'Article telah diperbarui']);
    }

    public function delete($slug)
    {
        // Fetch the existing article data
        $existingArticle = $this->article->where('slug', $slug)->first();

        if (!$existingArticle) {
            return redirect()->to(url_to('article.index'))->with('message' , 'Artikel tidak ditemukan!!!');
        }

        // set status Removed to Judul
        $this->article->update($existingArticle['id_judul'], ['status' => 'R']);

        return redirect()->to(url_to('article.index'))->with('message' , 'Data artikel berhasil dihapus.');
    }

    public function restore($slug)
    {
        // Fetch the existing article data
        $existingArticle = $this->article->where('slug', $slug)->first();

        if (!$existingArticle) {
            return redirect()->to(url_to('article.index'))->with('message' , 'Artikel tidak ditemukan!!!');
        }

        // set status Draft to Judul
        $this->article->update($existingArticle['id_judul'], ['status' => 'D']);

        return redirect()->to(url_to('article.index'))->with('message' , 'Data artikel berhasil di ambil dari tempat sampah.');
    }

    public function updatePublishStatus()
    {
        // Get today's date in the format 'Y-m-d'
        $today = date('Y-m-d');

        // Update the status of articles where 'waktu_status' is today
        $$this->article->where('waktu_status', $today)->set(['status' => 'P'])->update();
    }

    public function backlink() // json untuk related article/backlink
    {
        $dataReq = $this->request->getVar('data') ?? null;
        
        if ($dataReq !== null) {
            $dataRaw = $this->db->table('judul j')
            ->select('j.judul, j.id_judul')
            ->join('backlink b', 'j.id_judul = b.backlink', 'inner')
            ->where('b.id_judul', $dataReq)
            ->get()
            ->getResultArray();
            
            return response()->setJSON($dataRaw);
        }
        
        $dataRaw = $this->db->table('judul j')
        ->select('j.judul, j.id_judul')
        ->join('kategori c', 'j.id_kategori = c.id_kategori', 'inner')
        ->where('c.status', true)
        ->where('j.status', 'P')
        ->orderBy('created_at', 'DESC')
        ->get()
        ->getResultArray();

        return response()->setJSON($dataRaw);
    }

}