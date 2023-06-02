<?php

namespace App\Business;

use App\Models\ActivityLog;
use App\Utils\bKashEnv;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\ClientException;

class BKashPaymentManager extends BKashManager
{
    public function fetchPaymentListBySubscriptionId($subscriptionId, ?bool $associative = null)
    {
        $headers = $this->getRequestHeaders();

        $now = Carbon::now();
        $now->setTimezone('UTC');

        $request_url = bKashEnv::serverUrl()."/api/subscription/payment/bySubscriptionId/{$subscriptionId}";

        $client = new \GuzzleHttp\Client();

        try {

            $response = $client->request('GET', $request_url, [
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

    public function fetchPaymentByPaymentId($paymentId, ?bool $associative = null)
    {
        $headers = $this->getRequestHeaders();

        $now = Carbon::now();
        $now->setTimezone('UTC');

        $request_url = bKashEnv::serverUrl()."/api/subscription/payment/{$paymentId}";

        $client = new \GuzzleHttp\Client();

        try {

            $response = $client->request('GET', $request_url, [
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


    public function refundPayment($paymentId, $amount, ?bool $associative = null)
    {
        $headers = $this->getRequestHeaders();

        $now = Carbon::now();
        $now->setTimezone('UTC');

        $request_url = bKashEnv::serverUrl()."/api/subscription/payment/refund";

        $client = new \GuzzleHttp\Client();

        try {

            $response = $client->request('POST', $request_url, [
                'headers' => $headers,
                'json' => [
                    "paymentId" => $paymentId,
                    "amount" => $amount
                ],
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

}
