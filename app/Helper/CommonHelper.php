<?php

namespace App\Helpers;

class CommonHelper
{
    /**
     * Generate a random string.
     *
     * @param  int  $length
     * @return string
     */

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
