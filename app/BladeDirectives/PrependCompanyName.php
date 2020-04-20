<?php


namespace App\BladeDirectives;

use Illuminate\Support\Str;


class PrependCompanyName
{
    public static function text($text, $companyName)
    {
        return Str::slug($companyName)."-".$text;
    }
}
