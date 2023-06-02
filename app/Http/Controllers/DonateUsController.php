<?php

namespace App\Http\Controllers;

use App\Business\BKashSubscriptionManager;
use App\Models\ActivityLog;
use App\Models\OnBoard;
use App\Models\PaymentAmount;
use App\Models\PaymentCycle;
use App\Models\PaymentSector;
use App\Models\Subscription;
use App\Models\SubscriptionRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

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

        $bKashSubscriptionMgr = new BKashSubscriptionManager();

        $response = $bKashSubscriptionMgr->create($request);

        $statusCode = $response->getStatusCode();
        $responseContent = $response->getBody()->getContents();
        $responseContent = json_decode($responseContent);

        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, json_encode($responseContent));

        // dd($responseContent, $statusCode);

        Session::put("subscriptionRequestId", $responseContent->subscriptionRequestId);
        Session::put("expirationTime", new Carbon($responseContent->expirationTime));

        try {
            $subscriptionRequest = SubscriptionRequest::create(
                [
                   'id'=>$responseContent->subscriptionRequestId,
                   'name'=>$request->name,
                   'email'=>$request->email,
                   ]
            );

            dump($subscriptionRequest);
        } catch(Exception $e) {
            dd($e->getMessage());
        }



        return redirect()->to($responseContent->redirectURL);

    }

    public function finish(Request $request)
    {
        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, json_encode($request->all()));

        return view('donate_us.bkash_finish')->with('message', "reference: {$request->reference}, status: {$request->status}");
    }
}
