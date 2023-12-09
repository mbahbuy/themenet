<?php 
namespace App\Controllers\backEnd;

use App\Controllers\BaseController;
use App\Models\Images;

class GalleryController extends BaseController
{
    protected $gambar;

    public function __construct()
    {
        $this->gambar = new Images();
    }
    
    public function foto()
    {
        return view('dashboard/gallery/foto', [
            'title' => 'Foto Gallery',
            'hal' => 'gallery/foto',
            'fotos' => $this->gambar->findAll()
        ]);
    }

    public function editor()
    {
        // return $this->response->setJSON($this->request->getPost());
        $fileUpload = $this->request->getFile('file');

        // generate random nama Upload
        $namaUpload = $fileUpload->getRandomName();
        
        // Get the image size and other information
        list($width, $height, $type, $attr) = getimagesize($fileUpload);
        // simpan gambar ke dalam public/images
        $fileUpload->move('images/gallery/', $namaUpload);

        // save to images table
        $this->gambar->insert([
            "picture" => $namaUpload,
            "ukuran" => $width . '.' . $height
        ]);

        // Your data to be included in the JSON response
        $data = [
            'location'=>"/images/gallery/$namaUpload",
        ];

        // Return the JSON response
        return $this->response->setJSON($data);
    }
}