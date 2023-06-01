<?php

namespace App\Http\Controllers;

use App\Business\BKashSubscriptionManager;
use App\Models\ActivityLog;
use App\Models\OnBoard;
use App\Models\PaymentAmount;
use App\Models\PaymentCycle;
use App\Models\PaymentSector;
use Illuminate\Http\Request;
use Redirect;
use Carbon\Carbon;

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

        $response = $bKashSubscriptionMgr->createSubscription($request);

        $statusCode = $response->getStatusCode();
        $responseContent = $response->getBody()->getContents();
        $responseContent = json_decode($responseContent);

        if($statusCode!=200) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__);
            return Redirect::to(route('donate_us.index'))
            ->withInput($request)->with('message', $responseContent->reason);
        }

        // dd($responseContent, $statusCode);

        OnBoard::create(
            [
              'id'=>$responseContent->subscriptionRequestId,
              'name'=>$request->name,
              'email'=>$request->email,
              'frequency'=>$request->payment_cycle,
              'amount'=>$request->amount,
              'expirationTime'=> new Carbon($responseContent->expirationTime)
              ]
        );

        return redirect()->to($responseContent->redirectURL);

    }
}
