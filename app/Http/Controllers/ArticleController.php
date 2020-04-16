<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function getArticlesIncludingSoftDeleted() {
        return  Article::withTrashed()->get();
    }

    public function restore($articleId)
    {
       Article::withTrashed()
            ->where('id', $articleId)
            ->restore();

        return redirect('/');
    }

    public function destroy($articleId)
    {
        Article::destroy($articleId);

        return redirect('/');
    }

    public function harddestroy($articleId)
    {
        Article::withTrashed()
            ->where('id', $articleId)
            ->forceDelete();

        return redirect('/');
    }
}
