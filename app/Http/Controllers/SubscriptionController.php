<?php

namespace App\Http\Controllers;

use App\Business\BKashSubscriptionManager;
use App\Models\ActivityLog;
use App\Models\PaymentAmount;
use App\Models\PaymentCycle;
use App\Models\PaymentSector;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\SubscriptionRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(!$request->has("source")) {
            $request= $request->merge(["source"=>"bkash"]);
        }

        $source =  $request->source;


        if($source=="local") {
            $subscriptions = Subscription::paginate();

            return view('Subscription.index_local', compact('subscriptions', "source"));
        } else {


            if(!$request->has("page")) {
                $request= $request->merge(["page"=>0]);
            }

            $page =  $request->page;
            $size = 25;

            $bKashSubscriptionMgr = new BKashSubscriptionManager();

            $subscriptions = $bKashSubscriptionMgr->fetchBySubscriptionList($page, $size);

            return view('Subscription.index_bkash', compact('subscriptions', "source", 'page'));

        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentSectors = PaymentSector::get();
        $paymentAmounts = PaymentAmount::orderBy('amount')->get();
        $paymentCycles = PaymentCycle::where('is_active', true)
        ->orderBy('display_serial')
        ->get();

        return view('Subscription.create', compact('paymentAmounts', 'paymentCycles', 'paymentSectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_sectors' => ['required'],
            'amount' => ['required', 'integer'],
            'payment_cycle' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',
            //'unique:subscription_requests'
        ],
        ]);

        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__);

        $bKashSubscriptionMgr = new BKashSubscriptionManager();

        $responseObject = $bKashSubscriptionMgr->create($request);

        if(!$responseObject) {
            return redirect()->to(route("subscriptions.create"));
        }

        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, json_encode($responseObject));

        // dd($responseContent, $statusCode);

        Session::put("subscriptionRequestId", $responseObject->subscriptionRequestId);
        Session::put("expirationTime", new Carbon($responseObject->expirationTime));

        try {
            $subscriptionRequest = SubscriptionRequest::create(
                [
                   'id'=>$responseObject->subscriptionRequestId,
                   'name'=>$request->name,
                   'email'=>$request->email,
                   ]
            );

        } catch(Exception $e) {
            // dd($e->getMessage());
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
        }

        return redirect()->to($responseObject->redirectURL);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $subscription = Subscription::with("payments")->find($id);

        if($subscription==null) {
            $bKashSubscriptionMgr = new BKashSubscriptionManager();

            $responseObject = $bKashSubscriptionMgr->fetchBySubscriptionId($id,true);

            if( $responseObject){
                $subscription =  Subscription::create($responseObject);
            }


        }

        return view('Subscription.show', compact('subscription'));
    }

    public function showMyPayments(Request $request)
    {

        $mobile =  $request->mobile;

        $subscription = Subscription::with("payments")->where('payer', $request->mobile)->first();

        return view('Subscription.show_by_payments', compact('subscription', 'mobile'));
    }


  public function showMySubscriptions(Request $request)
    {

        $payer =  $request->payer;

        $subscriptions = Subscription::with("payments")->where('payer', $request->payer)->get();

        return view('Subscription.show_my_subscriptions', compact('subscriptions', 'payer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function finish(Request $request)
    {

        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, json_encode($request->all()));


        $subscriptionRequestId = session('subscriptionRequestId');

        $subscriptionRequest =  SubscriptionRequest::find($subscriptionRequestId);
        $subscriptionRequest->update([
             'reference' => $request->reference,
             'status' => $request->status,
        ]);

        $bKashSubscriptionMgr = new BKashSubscriptionManager();

        $subscriptionObject = $bKashSubscriptionMgr->fetchBySubscriptionRequestId($subscriptionRequest->id, true);

        if($subscriptionObject) {

            try {
                Subscription::create($subscriptionObject);
            } catch(Exception $e) {
                ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            }


        }


        return view('donate_us.bkash_finish')->with('message', "reference: {$request->reference}, status: {$request->status}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
