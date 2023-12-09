<?php

namespace App\Controllers\backEnd\Report;

use App\Controllers\BaseController;
use App\Models\{Category};

class RubrikController extends BaseController
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new Category();

        session();
    }

    public function index()
    {
        return view('dashboard/preference/rubrik', [
            'title' => 'Rubrik',
            'hal' => 'preference/rubrik',
            'data' => $this->kategori->orderBy('id_kategori', 'DESC')->get()->getResult(),
        ]);
    }

}
