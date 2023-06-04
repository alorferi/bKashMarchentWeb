<?php

namespace App\Business;

use App\Utils\bKashEnv;
use Carbon\Carbon;

class BkashManager
{
    public function getRequestHeaders()
    {
        $now = Carbon::now();
        $now->setTimezone('UTC');

        // Header Params
        $channelId = bKashEnv::channelId();
        $timeStamp = $now->format("Y-m-d")."T".$now->format("H:i:s.u")."Z";
        $obf_api_key =  bKashEnv::apiKey();

        $headers = array(
            'version' => "v1.0",
            'channelId' => $channelId,
            'timeStamp' => $timeStamp,
            'x-api-key' => $obf_api_key,
            'Content-Type' => "application/json"
        );

        return $headers;
    }
}
