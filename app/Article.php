<?php

namespace App;

use App\ArticleFilters\RemoveLinks;
use App\ArticleFilters\RemovePhoneNumbers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Article extends Model
{

    public $timestamps = true;

    public static function getFilteredArticles() {
        return $articles = app(Pipeline::class)
            ->send(Article::all()->toArray())
            ->through([
                RemoveLinks::class,
                RemovePhoneNumbers::class

            ])
            ->thenReturn();
    }
}
