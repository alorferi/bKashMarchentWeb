<?php

namespace App\Business;

use App\Models\ActivityLog;
use App\Models\Subscription;
use App\Utils\bKashEnv;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Redirect;
use Illuminate\Support\Str;

class BkashSubscriptionManager extends BkashManager
{
    public function create(Request $request)
    {

        $now = Carbon::now();
        $now->setTimezone('UTC');

        $headers = $this->getRequestHeaders( $now );

        $bkash_srv_url = bKashEnv::serverUrl().'/api/subscription';

        $client = new \GuzzleHttp\Client();

        //Body Params
        $obf_service_id = bKashEnv::serviceId();

        $obf_m_short_code = bKashEnv::mShortCode();

        $obf_redirect_url = bKashEnv::redirectUrl();

        $startDate =  $now->addDays(1)->format('Y-m-d');

        $expiryDate = $now->addYears(1)->format('Y-m-d');

        // dd( $startDate,  $expiryDate);

        $uuid = Str::uuid()->toString();

        $bodyData =  [
              "amount" => $request->amount,
              "amountQueryUrl"=> null,
              "firstPaymentAmount"=> null,
              "firstPaymentIncludedInCycle"=> true,
              "serviceId"=> $obf_service_id,
              "currency"=> "BDT",
              "startDate"=> $startDate,
              "expiryDate"=>  $expiryDate,
              "frequency"=> $request->payment_frequency,
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


        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null,  json_encode($headers));

        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, json_encode($bodyData) );


        try {
            $response = $client->request('POST', $bkash_srv_url, [
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
            // dd($e->getMessage());
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        } catch(Exception $e) {
             // dd($e->getMessage());
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return false;
        }

    }

    public function fetchBySubscriptionList($page, $size, ?bool $associative = null)
    {

        $now = Carbon::now();
        $now->setTimezone('UTC');

        $headers = $this->getRequestHeaders($now);
        $bkash_srv_url = bKashEnv::serverUrl()."/api/subscriptions/{$page}/{$size}";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $bkash_srv_url, [
                'headers' => $headers,
            ]);

            // $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseContent = json_decode($responseContent, $associative);

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
        $now = Carbon::now();
        $now->setTimezone('UTC');

        $headers = $this->getRequestHeaders($now);



        $bkash_srv_url = bKashEnv::serverUrl()."/api/subscriptions/request-id/{$subscriptionRequestId}";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $bkash_srv_url, [
                'headers' => $headers,
            ]);

            // $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseContent = json_decode($responseContent, $associative);

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
        $now = Carbon::now();
        $now->setTimezone('UTC');

        $headers = $this->getRequestHeaders($now);

        $bkash_srv_url = bKashEnv::serverUrl()."/api/subscriptions/{$subscriptionId}";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $bkash_srv_url, [
                'headers' => $headers,
            ]);

            // $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseContent = json_decode($responseContent, $associative);

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
        $now = Carbon::now();
        $now->setTimezone('UTC');

        $headers = $this->getRequestHeaders($now);


        $bkash_srv_url = bKashEnv::serverUrl()."/api/subscriptions/{$subscriptionId}?reason={$reason}";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('DELETE', $bkash_srv_url, [
                'headers' => $headers,
            ]);

            // $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseContent = json_decode($responseContent, $associative);

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

    public function fetchPaymentSchedule($frequency, $startDate, $expiryDate, ?bool $associative = null)
    {
        $now = Carbon::now();
        $now->setTimezone('UTC');

        $headers = $this->getRequestHeaders($now);

        $bkash_srv_url = bKashEnv::serverUrl()."/api/subscription/payment/schedule?frequency={$frequency}&startDate={$startDate}&expiryDate={$expiryDate}";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $bkash_srv_url, [
                'headers' => $headers,
            ]);

            // $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseContent = json_decode($responseContent, $associative);

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


    public function fetchAndUpdateBySubscriptionId($id)
    {

        $subscription = Subscription::find($id);

        try {

            $responseObject = $this->fetchBySubscriptionId($id, true);

            if($responseObject) {

                if($responseObject['extraParams']) {
                    $responseObject['extraParams'] = json_encode($responseObject['extraParams']);
                }

                if($subscription) {
                    $subscription->update($responseObject);
                } else {
                    $subscription = Subscription::create($responseObject);
                }

            }

        } catch(Exception $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
        }

       return $subscription;

    }

}
