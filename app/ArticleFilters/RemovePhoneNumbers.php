<?php


namespace App\ArticleFilters;


class RemovePhoneNumbers
{
    public function handle($articles, \Closure $next) {

        foreach($articles as $key => $article) {
            $articles[$key]['article'] = preg_replace('~[+\d-](?=[\d-]{4})~', '*', $article['article']);
        }

        return $next($articles);
    }
}
