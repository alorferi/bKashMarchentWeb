<?php

namespace App\Http\Controllers;

use App\Models\PaymentAmount;
use App\Models\PaymentCycle;
use App\Models\PaymentSector;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Str;

class DonateUsController extends Controller
{
    public function index()
    {

        $paymentSectors = PaymentSector::get();
        $paymentAmounts = PaymentAmount::orderBy('amount')->get();
        $paymentCycles = PaymentCycle::where('is_active', true)
        ->orderBy('display_serial')
        ->get();

        return view('donate_us.index', compact('paymentAmounts', 'paymentCycles', 'paymentSectors'));
    }


    public function subscribe(Request $request)
    {

        $request->validate([
            'payment_sectors' => ['required'],
            'amount' => ['required', 'integer'],
            'payment_cycle' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);




        $now = Carbon::now();
        $now->setTimezone('UTC');

        // Header Params
        $channelId = "Merchant WEB";
        $timeStamp = $now->format("Y-m-d")."T".$now->format("H:i:s.u")."Z";
        $obf_api_key = "QQLymPdRg9oZbxbGMQQkacuUOxpf7rnZ";

        $headers = array(
            'version' => "v1.0",
            'channelId' => $channelId,
            'timeStamp' => $timeStamp,
            'x-api-key' => $obf_api_key,
            'Content-Type' => "application/json"
        );

        $request_url = 'https://gateway.sbrecurring.pay.bka.sh/gateway/api/subscription';

        $client = new \GuzzleHttp\Client();


        //Body Params
        $obf_service_id = 100001;
        $obf_m_short_code = 50022;
        $obf_web_hook_endpoint = "https://odommo-dev.babulmirdha.com/api/web-hook/bkash";

        $subscriptionRequestId = Str::uuid()->toString();

        $startDate =  $now->addDays(1)->format('Y-m-d');

        $endDate = $now->addYears(1)->format('Y-m-d');

        $bodyData =  [
              "amount" => 1,
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
              "subscriptionRequestId"=> "obf-{$subscriptionRequestId}",
              "subscriptionReference"=> "MSMSR2",
              "extraParams"=> null
        ];


        try {
            $response = $client->request('POST', $request_url, [
                'headers' => $headers,
                'json' => $bodyData
            ]);

            // dd($response);

            $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();

            dump($responseContent, $statusCode);


           $response = json_decode($responseContent);

            return redirect($response->redirectURL);

        } catch(ClientException $e) {
            dump($e->getMessage());
        } catch(Exception $e) {
            dump($e->getMessage());
        }




        // dump($request->all());


        // return redirect(route('donate-us.index'));

    }

    public function process()
    {

    }
}
