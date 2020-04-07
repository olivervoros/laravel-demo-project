<?php


namespace App\Mixins;


class CollectionMixins
{

    public function everySecondElementUppercase() {

        return function(array $array) {

            $result = collect($array);

            foreach ($result as $key => $val) {
                // Array starts with zero index...
                if ($key % 2 !== 0) {
                    $result[$key] = strtoupper($val);
                } else {
                    $result[$key] = $val;
                }
            }

            return $result;
        };
    }

}
