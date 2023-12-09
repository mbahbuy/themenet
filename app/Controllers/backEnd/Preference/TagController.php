<?php

namespace App\Controllers\backEnd\Preference;

use App\Controllers\BaseController;
use App\Models\{Meta};

class TagController extends BaseController
{
    protected $meta;

    public function __construct()
    {
        $this->meta = new Meta();

        session();
    }

    public function index()
    {
        return view('dashboard/preference/tag', [
            'title' => 'Meta',
            'hal' => 'preference/tag',
            'data' => $this->meta->orderBy('id_meta', 'DESC')->get()->getResult(),
        ]);
    }

    public function json()
    {
        return $this->response->setJSON($this->meta->orderBy('id_meta', 'DESC')->get()->getResult());
    }

    public function store()
    {
        $validationRules = [
            'tag' => 'required|is_unique[meta.meta]',
        ];
    
        $validationMessages = [
            'required' => '{field} harus di isi.',
            'is_unique' => '{field} sudah ada dalam daftar tag.',
        ];
    
        // Validate the input data
        if (!$this->validate($validationRules, $validationMessages)) {
            $validationErrors = implode(', ', $this->validator->getErrors());
            return $this->response->setJSON(['bg' => 'bg-danger', 'message' => $validationErrors]);
        }

        $this->meta->insert(['meta' => $this->request->getVar('tag')]);
        
        return $this->response->setJSON(['bg' => 'bg-success', 'message' => 'Tag berhasil ditambahkan', 'id_meta' => $this->meta->insertID, 'meta' => $this->request->getVar('tag')]);
    }

    public function update($slug)
    {
        $validationRules = [
            'tag' => 'required|is_unique[meta.meta]',
        ];
    
        $validationMessages = [
            'required' => '{field} harus di isi.',
            'is_unique' => '{field} sudah ada dalam daftar kategori.',
        ];
    
        // Validate the input data
        if (!$this->validate($validationRules, $validationMessages)) {
            $validationErrors = implode(', ', $this->validator->getErrors());
            return $this->response->setJSON(['bg' => 'bg-danger', 'message' => $validationErrors]);
        }

        $existingMeta = $this->meta->where('slug', $slug)->first();
        if (!$existingMeta) {
            return $this->response->setJSON(['bg' => 'bg-danger', 'message' => 'Meta tidak ditemukan']);
        }

        $this->meta->update($existingMeta['id_meta'], ['meta' => $this->request->getVar('tag')]);
        return $this->response->setJSON(['bg' => 'bg-success', 'message' => 'Tag berhasil dirubah']);
    }

    public function delete($slug)
    {
        $existingMeta = $this->meta->where('slug', $slug)->first();
        if (!$existingMeta) {
            return $this->response->setJSON(['bg' => 'bg-danger', 'message' => 'Tag tidak ditemukan']);
        }

        // delete meta and own relationship/relasi meta
        $this->meta->delete($existingMeta['id_meta']);
        $this->meta->delete_meta_ralationship($existingMeta['id_meta']);

        return $this->response->setJSON(['bg' => 'bg-success', 'message' => 'Tag berhasil dihapus']);
    }
}
