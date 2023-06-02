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



    }

    public function finish(Request $request)
    {
        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, json_encode($request->all()));

        return view('donate_us.bkash_finish')->with('message', "reference: {$request->reference}, status: {$request->status}");
    }
}
