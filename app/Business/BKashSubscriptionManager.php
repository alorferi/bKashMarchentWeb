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
    public function createSubscription(Request $request)
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

        $request_url = bKashEnv::serverUrl().'/api/subscription';

        $client = new \GuzzleHttp\Client();

        //Body Params
        $obf_service_id = bKashEnv::serviceId();

        $obf_m_short_code = bKashEnv::mShortCode();

        $obf_web_hook_endpoint = bKashEnv::webhookUrl();

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
              "redirectUrl"=> "{$obf_web_hook_endpoint}",
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




        // dump($request->all());


        // return redirect(route('donate-us.index'));
    }
}
