<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class CollectionController extends Controller
{

    private $collection = [[

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
        [
            'user_id' => '4',
            'title' => 'Title Number 4',
            'content' => 'Article 4',
            'category' => 'node.js'
        ],
        [
            'user_id' => '5',
            'title' => 'Title Number 5',
            'content' => 'Long Article 5',
            'category' => 'react'
        ]
    ];

    public function filter()
    {
        // 1, Filter
        $filter = collect($this->collection)->filter(function ($value, $key) {
            if ($value['user_id'] == 2) {
                return true;
            }
        });

        dump($filter->all());
    }

    public function search()
    {
        $names = collect(['Alex', 'John', 'Jason', 'Martyn', 'Hanlin']);
        $result1 = $names->search('Jason');
        dump($result1);

        // Another search example
        $result2 = $names->search(function ($value, $key) {
            return strlen($value) == 6;
        });
        dump($result2);
    }

    public function chunk()
    {
        $prices = collect([18, 23, 65, 36, 97, 43, 81]);
        $result = $prices->chunk(3)->toArray();
        dump($result);
    }

    public function map()
    {

        $changed = collect($this->collection)->map(function ($value, $key) {
            $value['user_id'] += 1;
            return $value;
        });

        dump($changed->all());
    }

    public function zip()
    {
        $zipped = collect($this->collection)->zip([1, 2, 3]);

        dump($zipped->all());
    }

    public function wherenotin()
    {
        $result = collect($this->collection)->whereNotIn('user_id', [1, 2]);
        dump($result);
    }

    public function max()
    {
        $result = collect($this->collection)->max('user_id');
        dump($result);
    }

    public function pluck()
    {
        $title = collect($this->collection)->pluck('title');
        dump($title->all());

        // Another example
        $title = collect($this->collection)->pluck('user_id', 'title');
        dump($title->all());
    }

    public function each()
    {
         collect($this->collection)->each(function ($item, $key) {
            dump($item['user_id']);
        });

    }

    public function tap()
    {
        collect($this->collection)->whereNotIn('user_id', 3)
            ->tap(function ($collection) {
                $collection = $collection->where('user_id', 1);
                dump($collection->values());
            })
            ->all();

    }


    public function pipe()
    {
        $result = collect($this->collection)->pipe(function ($collection) {
            return $collection->min('user_id');
        });

        dump($result);
    }

    public function contains()
    {
        $contains = collect(['country' => 'USA', 'state' => 'NY']);
        dump($contains->contains('USA')); // true
        dump($contains->contains('UK')); // false

        // Another example
        dump(collect($this->collection)->contains('user_id', '1')); // true
        dump(collect($this->collection)->contains('title', 'Not Found Title')); // false

        // And another one...
        $result = collect($this->collection)->contains(function ($value, $key) {
            return strlen($value['title']) < 13;
        });

        dump($result);
    }

    // FORGET -> Does not work on multidimensional arrays
    public function forget()
    {
        $forget = collect(['country' => 'usa', 'state' => 'ny']);
        $result = $forget->forget('country')->all();
        dump($result);
    }

    public function avg()
    {
        $result = collect([
            ['shoes' => 10],
            ['shoes' => 35],
            ['shoes' => 7],
            ['shoes' => 68],
        ])->avg('shoes');

        dump($result);

        // Another Example
        $avg = collect([12, 32, 54, 92, 37]);
        dump($avg->avg());
    }

    // COLLAPSE -> the opposite of the chunk method, do not work on multidimensional arrays
    public function collapse()
    {
        $data = [
            [1, 2, 3],
            [4, 5, 6]
        ];

        dump(collect($data)->collapse());
    }

    public function combine()
    {
        $keys = collect(['column1', 'column2']);
        dump($keys->combine(['value1', 'value2']));

        // returns ['column1' => 'value1', 'column2' => 'value2']; returns a collection so you can do ->first() for example
    }


}
