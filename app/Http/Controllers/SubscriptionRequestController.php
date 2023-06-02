<?php

namespace App\Http\Controllers;

use App\Business\BKashSubscriptionManager;
use App\Models\Subscription;
use App\Models\SubscriptionRequest;
use App\Utils\ArrayUtils;
use Exception;
use Illuminate\Http\Request;

class SubscriptionRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptionRequests = SubscriptionRequest::orderBy('created_at', 'desc')->paginate();

        return view('SubscriptionRequest.index', compact('subscriptionRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscriptionRequest  $subscriptionRequest
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionRequest $subscriptionRequest)
    {

        $subscription = Subscription::where('subscriptionRequestId', $subscriptionRequest->id)->first();

        if($subscription){
            return view("Subscription.show",compact('subscription'));
        }

        $bKashSubscriptionMgr = new BKashSubscriptionManager();

        $subscriptionObject = $bKashSubscriptionMgr->fetchBySubscriptionRequestId($subscriptionRequest->id,true);

        if($subscriptionObject) {

            try{
                Subscription::create($subscriptionObject);
            }catch(Exception $e){
                ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            }


        }
        return view("SubscriptionRequest.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscriptionRequest  $subscriptionRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionRequest $subscriptionRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubscriptionRequest  $subscriptionRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriptionRequest $subscriptionRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriptionRequest  $subscriptionRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionRequest $subscriptionRequest)
    {
        //
    }
}
