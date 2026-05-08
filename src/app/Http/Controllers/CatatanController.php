<?php

namespace App\Http\Controllers;

use App\Pattern\MateriFactory;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    public function index()
    {
        $materi = MateriFactory::create('catatan');
        return view($materi->getView(), $materi->getData());
    }

}
