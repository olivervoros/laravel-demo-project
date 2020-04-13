<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function create() {

        return view('cms.create');
    }
}
