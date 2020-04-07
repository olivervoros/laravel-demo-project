<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{

    public function index() {

        $collection = collect([
            [
                'user_id' => '1',
                'title' => 'Helpers in Laravel',
                'content' => 'Create custom helpers in Laravel',
                'category' => 'php'
            ],
            [
                'user_id' => '2',
                'title' => 'Testing in Laravel',
                'content' => 'Testing File Uploads in Laravel',
                'category' => 'php'
            ],
            [
                'user_id' => '3',
                'title' => 'Telegram Bot',
                'content' => 'Crypto Telegram Bot in Laravel',
                'category' => 'php'
            ],
        ]);

        // 1, Filter
        $filter = $collection->filter(function($value, $key) {
            if ($value['user_id'] == 2) {
                return true;
            }
        });

        $filter->all();

        // 2, Search
        $names = collect(['Alex', 'John', 'Jason', 'Martyn', 'Hanlin']);

        $names->search('Jason');

        // Another search example
        $names->search(function($value, $key) {
            return strlen($value) == 6;
        });

        // 3, Chunk
        $prices = collect([18, 23, 65, 36, 97, 43, 81]);

        $prices = $prices->chunk(3);

        $prices->toArray();

        // 4, MAP
        $changed = $collection->map(function ($value, $key) {
            $value['user_id'] += 1;
            return $value;
        });

        $changed->all();

        // 5, ZIP
        $zipped = $collection->zip([1, 2, 3]);

        $zipped->all();

        // 6, whereNotIn

        $collection->whereNotIn('user_id', [1, 2]);

        // 7, MAX
        $collection->max('user_id');

        // 8, PLUCK
        $title = $collection->pluck('title');
        $title->all();

        // Another example
        $title = $collection->pluck('user_id', 'title');
        $title->all();

        // 9, EACH
        $collection->each(function ($item, $key) {
            info($item['user_id']);
        });

        // 10. TAP
        $collection->whereNotIn('user_id', 3)
            ->tap(function ($collection) {
                $collection = $collection->where('user_id', 1);
                info($collection->values());
            })
            ->all();

        // 11, PIPE
        $collection->pipe(function($collection) {
            return $collection->min('user_id');
        });

        // 12, CONTAINS
        $contains = collect(['country' => 'USA', 'state' => 'NY']);
        $contains->contains('USA'); // true
        $contains->contains('UK'); // false

        // Another example
        $collection->contains('user_id', '1'); // true
        $collection->contains('title', 'Not Found Title'); // false

        // And another one...
        $collection->contains(function ($value, $key) {
            return strlen($value['title']) < 13;
        });

        // 13, FORGET -> Does not work on multidimensional arrays
        $forget = collect(['country' => 'usa', 'state' => 'ny']);
        $forget->forget('country')->all();

        // 14, AVG
        $avg = collect([
            ['shoes' => 10],
            ['shoes' => 35],
            ['shoes' => 7],
            ['shoes' => 68],
        ])->avg('shoes');

        // Another Example
        $avg = collect([12, 32, 54, 92, 37]);
        $avg->avg();

        // 15, COLLAPSE -> the opposite of the chunk method, do not work on multidimensional arrays
        $data = [
            [1,2,3],
            [4,5,6]
        ];

        collect($data)->collapse();

        // returns: [0 => 1, 1 => 2, 2 => 3 => 4, 4 => 5, 5 => 6]


        // 16, COMBINE

        $keys = collect(['column1', 'column2']);
        $keys->combine(['value1', 'value2']);

        // returns ['column1' => 'value1', 'column2' => 'value2']; returns a collection so you can do ->first() for example

    }
}
