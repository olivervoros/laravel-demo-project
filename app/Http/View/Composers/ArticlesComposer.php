<?php


namespace App\Http\View\Composers;


use App\Article;
use Illuminate\View\View;

class ArticlesComposer
{

    public function compose(View $view) {
        $view->with('articles', Article::orderby('title', 'asc')->get());
    }

}
