<?php

namespace App\Utils;

class EmailUtils
{
    public static function isEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
