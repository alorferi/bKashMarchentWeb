<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Onboard;
use App\Models\PaymentAmount;
use App\Models\PaymentCycle;
use App\Models\PaymentSector;
use App\Utils\bKashUtils;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Redirect;

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

        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__);

        $onboard = Onboard::create(
            [
            'name'=>$request->name,
            'email'=>$request->email,
            'frequency'=>$request->payment_cycle,
            'amount'=>$request->amount]
        );


        $now = Carbon::now();
        $now->setTimezone('UTC');

        // Header Params
        $channelId = bKashUtils::channelId();
        $timeStamp = $now->format("Y-m-d")."T".$now->format("H:i:s.u")."Z";
        $obf_api_key =  bKashUtils::apiKey();

        $headers = array(
            'version' => "v1.0",
            'channelId' => $channelId,
            'timeStamp' => $timeStamp,
            'x-api-key' => $obf_api_key,
            'Content-Type' => "application/json"
        );

        $request_url = bKashUtils::serverUrl().'/api/subscription';

        $client = new \GuzzleHttp\Client();

        //Body Params
        $obf_service_id = bKashUtils::serviceId();

        $obf_m_short_code = bKashUtils::mShortCode();

        $obf_web_hook_endpoint = bKashUtils::webhookUrl();

        $startDate =  $now->addDays(1)->format('Y-m-d');

        $endDate = $now->addYears(1)->format('Y-m-d');

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
              "subscriptionRequestId"=>"obf-{$onboard->id}",
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
            $responseContent = json_decode($responseContent);

            if($statusCode!=200) {
                ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__);
                return Redirect::to(route('books.create'))
                ->withInput($request)->with('message', $responseContent->reason);
            }


            // dd($responseContent, $statusCode);

            $onboard->subscriptionRequestId = $responseContent->subscriptionRequestId;
            $onboard->expirationTime =  new Carbon($responseContent->expirationTime);
            $onboard->save();

            return redirect()->to($responseContent->redirectURL);

        } catch(ClientException $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return Redirect::to(route('donate-us.index'))
            ->withInput($request->all())->with('message', $e->getMessage());
            // dump(__LINE__, $e->getMessage());
        } catch(Exception $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return Redirect::to(route('donate-us.index'))
            ->withInput($request->all())->with('message', $e->getMessage());
            // dump(__LINE__, $e->getMessage());
        }




        // dump($request->all());


        // return redirect(route('donate-us.index'));

    }
}
