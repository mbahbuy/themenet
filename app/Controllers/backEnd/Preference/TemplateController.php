<?php

namespace App\Controllers\backEnd\Preference;

use App\Controllers\BaseController;
use App\Models\{Template};

class TemplateController extends BaseController
{
    protected $template;

    public function __construct()
    {
        $this->template = new Template();

        session();
    }

    public function index()
    {
        return view('dashboard/preference/template', [
            'title' => 'Template',
            'hal' => 'preference/template',
            'data' => $this->template->orderBy('id_template', 'DESC')->get()->getResult()
        ]);
    }
}
