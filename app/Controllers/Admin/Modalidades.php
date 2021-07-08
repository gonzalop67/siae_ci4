<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\Modalidades_model;

class Modalidades extends BaseController
{
	public function __construct()
    {
        $this->modalidades = new Modalidades_model();
    }

	public function index()
    {
        return view('Admin/Modalidades/index', [
            'modalidades' => $this->modalidades->paginate(config('Blog')->regPerPage),
            'pager' => $this->modalidades->pager
        ]);
    }
}
