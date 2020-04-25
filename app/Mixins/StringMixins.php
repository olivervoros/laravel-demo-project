<?php


namespace App\Mixins;


class StringMixins
{

    public function generateRandomAlphabets()
    {
        return function(int $length = 10) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        };
    }
}
