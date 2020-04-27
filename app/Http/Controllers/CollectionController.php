<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use function foo\func;

class CollectionController extends Controller
{

    private $collection = [
        [
            'user_id' => 1,
            'user_age' => 18,
            'user_name' => 'David',
            'title' => 'Helpers in Laravel',
            'content' => 'Create custom helpers in Laravel',
            'category' => 'php'
        ],
        [
            'user_id' => 2,
            'user_age' => 23,
            'user_name' => 'Fraser',
            'title' => 'Testing in Laravel',
            'content' => 'Testing File Uploads in Laravel',
            'category' => 'php'
        ],
        [
            'user_id' => 3,
            'user_age' => 65,
            'user_name' => 'Oliver',
            'title' => 'Telegram Bot',
            'content' => 'Crypto Telegram Bot in Laravel',
            'category' => 'php'
        ],
        [
            'user_id' => 4,
            'user_age' => 36,
            'user_name' => 'Paul',
            'title' => 'Title Number 4',
            'content' => 'Article 4',
            'category' => 'node.js'
        ],
        [
            'user_id' => 5,
            'user_age' => 43,
            'user_name' => 'Jack',
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
        $names = collect($this->collection)->pluck('user_name');
        $result1 = $names->search('Fraser');
        dump($result1);

        // Another search example
        $result2 = $names->search(function ($value, $key) {
            return strlen($value) == 6;
        });
        dump($result2);
    }

    public function chunk()
    {
        dump(collect($this->collection)->chunk(2)->toArray());
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

        dump(collect($this->collection)->contains('user_id', '1')); // true
        dump(collect($this->collection)->contains('title', 'Not Found Title')); // false

        // And another one...
        $result = collect($this->collection)->contains(function ($value, $key) {
            return strlen($value['title']) < 13;
        });

        dump($result);
    }

    // FORGET -> Does not work on multidimensional array
    public function forget()
    {
        dump(collect($this->collection[0])->forget('user_name')->all());
    }

    public function avg()
    {
        dump(collect($this->collection)->avg('user_age'));

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

    public function nth()
    {
        dump(collect($this->collection)->pluck('user_id')->nth(2,0));
    }

    public function times()
    {
        $result = Collection::times(3, function ($value) {
            return factory(User::class)->make();
        })->toArray();

        dump($result);
    }

    public function take()
    {
        dump(collect($this->collection)->take(3));

        dump(collect($this->collection)->take(-2)); // take from the back

        $newCollection = collect($this->collection)->take(2);
        dd($newCollection);
    }

    public function last()
    {
        dump(collect($this->collection)->last()); // This is the same as take(-1)

        $result = collect($this->collection)->last(function($element) {
            return $element['user_age'] < 30;
        }, 20);

        dump($result);
    }

    public function reverse()
    {
        dump(collect($this->collection)->reverse()); // maintains and reserves the keys too

        dump(collect($this->collection)->reverse()->values()); // do not maintain the keys
    }

    public function only()
    {
        dump(collect($this->collection)->only(0, 2, 4)); // Grabs the elements with key 0,2,4

        dump(collect($this->collection[0])->only('user_id', 'user_name'));
        dump(collect($this->collection[0])->only(['user_age', 'title']));
    }




}
