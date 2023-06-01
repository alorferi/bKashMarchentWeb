<?php

namespace App\Utils;

class bKashEnv
{
    public static function channelId()
    {
        return env("BKASH_CHANNEL_ID");
    }

    public static function apiKey()
    {
        return  env("BKASH_API_KEY");
    }


    public static function serverUrl()
    {
        return env("BKASH_SERVER_URL");
    }

    public static function webhookUrl()
    {
        return env("APP_URL").env("BKASH_WEBHOOK_ENDPOINT");
    }

    public static function serviceId()
    {
        return env("BKASH_SERVICE_ID");
    }

    public static function mShortCode()
    {
        return env("BKASH_M_SHORT_CODE");
    }

}
