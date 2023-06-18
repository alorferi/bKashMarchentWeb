<?php

namespace App\Http\Controllers;

use App\Business\BkashSubscriptionManager;
use App\Models\ActivityLog;
use App\Models\PaymentAmount;
use App\Models\PaymentFrequency;
use App\Models\DonationSector;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\SubscriptionRequest;
use Carbon\Carbon;
use Exception;
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
            $request= $request->merge(["source"=>"local"]);
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

            $bKashSubscriptionMgr = new BkashSubscriptionManager();

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
        $donationSectors = DonationSector::get();
        $paymentAmounts = PaymentAmount::orderBy('amount')->get();
        $PaymentFrequencys = PaymentFrequency::where('is_active', true)
        ->orderBy('display_serial')
        ->get();

        return view('Subscription.create', compact('paymentAmounts', 'PaymentFrequencys', 'donationSectors'));
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
            'donation_sector_id' => ['required'],
            'amount' => ['required', 'integer'],
            'payment_frequency' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',
            //'unique:subscription_requests'
        ],
        ]);

        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__);

        $bKashSubscriptionMgr = new BkashSubscriptionManager();

        $responseObject = $bKashSubscriptionMgr->create($request);

        if(!$responseObject) {
            return redirect()->to(route("subscriptions.create"));
        }

        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, json_encode($responseObject));

        // dd($responseContent, $statusCode);

        Session::put("subscriptionRequestId", $responseObject->subscriptionRequestId);
        Session::put("expirationTime", new Carbon($responseObject->expirationTime));

        try {
            SubscriptionRequest::create(
                [
                   'id'=>$responseObject->subscriptionRequestId,
                   'name'=>$request->name,
                   'email'=>$request->email,
                   'donationSectorId'=>$request->donation_sector_id,
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

        try {

            $bKashSubscriptionMgr = new BkashSubscriptionManager();

            $responseObject = $bKashSubscriptionMgr->fetchBySubscriptionId($id, true);

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
            //  dd($e->getMessage());
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
        }

        return view('Subscription.show', compact('subscription'));
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

        if($subscriptionRequest) {
            $subscriptionRequest->update([
                'reference' => $request->reference,
                'status' => $request->status,
           ]);


            $bKashSubscriptionMgr = new BkashSubscriptionManager();

            $subscriptionObject = $bKashSubscriptionMgr->fetchBySubscriptionRequestId($subscriptionRequest->id, true);

            if($subscriptionObject) {

                try {
                    Subscription::create($subscriptionObject);
                } catch(Exception $e) {
                    ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
                }


            }

        }




        return view('Subscription.finish')->with('message', "reference: {$request->reference}, status: {$request->status}");
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
