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

class BKashSubscriptionManager extends BKashManager
{
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

        $startDate =  $now->addHours(1)->format('Y-m-d');

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

            $responseContent = $response->getBody()->getContents();
            $responseContent = json_decode($responseContent);

            return $responseContent;

        } catch(ClientException $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        } catch(Exception $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        }

    }

    public function fetchBySubscriptionList($page, $size,  ?bool $associative = null)
    {
        $headers = $this->getRequestHeaders();

        $now = Carbon::now();
        $now->setTimezone('UTC');

        $request_url = bKashEnv::serverUrl()."api/subscriptions/{$page}/{$size}";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $request_url, [
                'headers' => $headers,
            ]);

            // $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseContent = json_decode($responseContent,$associative);

            // dd($responseContent);

            return $responseContent;

        } catch(ClientException $e) {

            // dd($e->getResponse());

            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        } catch(Exception $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        }
    }

    public function fetchBySubscriptionRequestId($subscriptionRequestId, ?bool $associative = null)
    {
        $headers = $this->getRequestHeaders();

        $now = Carbon::now();
        $now->setTimezone('UTC');

        $request_url = bKashEnv::serverUrl()."/api/subscriptions/request-id/{$subscriptionRequestId}";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $request_url, [
                'headers' => $headers,
            ]);

            // $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseContent = json_decode($responseContent,$associative);

            // dd($responseContent);

            return $responseContent;

        } catch(ClientException $e) {

            // dd($e->getResponse());

            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        } catch(Exception $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        }
    }

    public function fetchBySubscriptionId($subscriptionId, ?bool $associative = null)
    {
        $headers = $this->getRequestHeaders();

        $now = Carbon::now();
        $now->setTimezone('UTC');

        $request_url = bKashEnv::serverUrl()."/api/subscriptions/{$subscriptionId}";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $request_url, [
                'headers' => $headers,
            ]);

            // $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseContent = json_decode($responseContent,$associative);

            // dd($responseContent);

            return $responseContent;

        } catch(ClientException $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        } catch(Exception $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        }
    }


    public function cancelSubscription($subscriptionId, $reason, ?bool $associative = null)
    {
        $headers = $this->getRequestHeaders();

        $now = Carbon::now();
        $now->setTimezone('UTC');

        $request_url = bKashEnv::serverUrl()."/api/subscriptions/{$subscriptionId}?reason={$reason}";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('DELETE', $request_url, [
                'headers' => $headers,
            ]);

            // $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseContent = json_decode($responseContent,$associative);

            // dd($responseContent);

            return $responseContent;

        } catch(ClientException $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        } catch(Exception $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        }
    }

}
