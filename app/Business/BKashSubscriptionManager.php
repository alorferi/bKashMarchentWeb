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

class BKashSubscriptionManager
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
    public function create(Request $request)
    {

        $headers = $this->getRequestHeaders();

        $now = Carbon::now();
        $now->setTimezone('UTC');

        $request_url = bKashEnv::serverUrl().'/api/subscription';

        $client = new \GuzzleHttp\Client();

        //Body Params
        $obf_service_id = bKashEnv::serviceId();

        $obf_m_short_code = bKashEnv::mShortCode();

        $obf_redirect_url = bKashEnv::redirectUrl();

        $startDate =  $now->addDays(1)->format('Y-m-d');

        $endDate = $now->addYears(1)->format('Y-m-d');

        $uuid = Str::uuid()->toString();

        $bodyData =  [
              "amount" => $request->amount,
              "amountQueryUrl"=> null,
              "firstPaymentAmount"=> null,
              "firstPaymentIncludedInCycle"=> true,
              "serviceId"=> $obf_service_id,
              "currency"=> "BDT",
              "startDate"=> $startDate,
              "expiryDate"=>  $endDate,
              "frequency"=> $request->payment_cycle,
              "subscriptionType"=> "BASIC",
              "maxCapAmount"=> null,
              "maxCapRequired"=> false,
              "merchantShortCode"=> "{$obf_m_short_code}",
              "payer"=> null,
              "payerType"=> "CUSTOMER",
              "paymentType"=> "FIXED",
              "redirectUrl"=> "{$obf_redirect_url}",
              "subscriptionRequestId"=>$uuid,
              "subscriptionReference"=> "MSMSR2",
              "extraParams"=> null
        ];


        try {
            $response = $client->request('POST', $request_url, [
                'headers' => $headers,
                'json' => $bodyData
            ]);

            // $statusCode = $response->getStatusCode();
            // $responseContent = $response->getBody()->getContents();
            // $responseContent = json_decode($responseContent);

            // dd($responseContent);

            return $response;

        } catch(ClientException $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        } catch(Exception $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        }

    }

    public function show($requestId)
    {
        $headers = $this->getRequestHeaders();

        $now = Carbon::now();
        $now->setTimezone('UTC');

        $request_url = bKashEnv::serverUrl()."/api/subscriptions/request-id/{$requestId}";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $request_url, [
                'headers' => $headers,
            ]);

            // $statusCode = $response->getStatusCode();
            // $responseContent = $response->getBody()->getContents();
            // $responseContent = json_decode($responseContent);

            // dd($responseContent);

            return $response;

        } catch(ClientException $e) {

            // dd($e->getResponse());

            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        } catch(Exception $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        }
    }

}
