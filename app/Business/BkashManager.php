<?php

namespace App\Business;

use App\Models\ActivityLog;
use App\Utils\bKashEnv;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Redirect;
use Illuminate\Support\Str;

class BKashManager
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
