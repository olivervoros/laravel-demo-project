<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    // 100+1 queries
    public function lazy() {
        $articles = Article::all()->toArray();
        dd($articles);
    }

    // 2 Queries
    public function eager()
    {
        $articles = Article::with('user')->get()->toArray();
        dd($articles);
    }
}
