<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('articles', ['articles' => Article::all()]);
    }

    public function view($articleId)
    {
        $article = Article::findOrFail($articleId);
        Gate::authorize('view-article', $article);  // DEFINED IN: AuthServiceProvider.php boot()
        dd($article->first()->toArray());
    }

    public function anotherview($articleId)
    {
        $article = Article::findOrFail($articleId);
        Gate::authorize('view', $article); // DEFINED IN: ArticlePolicy.php
        dd($article->first()->toArray());
    }
}
