<?php

namespace App\Utils;

use Illuminate\Support\Facades\Log;

class LogWrite
{
    public static function info(string $tag,  ...$messages)
    {
        $term = "";
        $i = 0;
        Log::info("$tag:: Start");
        foreach ($messages as $message) {
            $term .= "\n [$i] => $message";
            $i++;
        }
        Log::info($term);
        Log::info("$tag:: End");
    }
}
