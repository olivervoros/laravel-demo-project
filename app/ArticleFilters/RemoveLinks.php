<?php


namespace App\ArticleFilters;


class RemoveLinks
{

    public function handle($articles, \Closure $next) {

        foreach($articles as $key => $article) {
            $articles[$key]['article'] = preg_replace("#<a.*?>.*?</a>#i", "{link removed}", $article['article']);
        }
        return $next($articles);
    }

}
