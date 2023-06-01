<?php

namespace App\Utils;


class ColorUtils
{
    public static function getColorCodeForHttpMethod(string $method_name)
    {
        switch ($method_name) {

            case "GET":
                return "text-success";
            break;

            case "POST":
            case "created":
                return "text-warning";
            break;

            case "PUT":
            case "updated":
                return "text-primary";
            break;

            case "PATCH":
                return "#";
            break;

            case "DELETE":
            case "deleted":
                return "text-danger";
            break;

       }
    }
}
