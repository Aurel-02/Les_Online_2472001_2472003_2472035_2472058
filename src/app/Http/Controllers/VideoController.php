<?php

namespace App\Http\Controllers;

use App\Pattern\MateriFactory;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $materi = MateriFactory::create('video');
        return view($materi->getView(), $materi->getData());
    }

}
