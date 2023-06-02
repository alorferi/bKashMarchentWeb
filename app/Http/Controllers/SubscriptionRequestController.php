<?php

namespace App\Http\Controllers;

use App\Business\BKashSubscriptionManager;
use App\Models\Subscription;
use App\Models\SubscriptionRequest;
use App\Utils\ArrayUtils;
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
        $subscriptionRequests = SubscriptionRequest::orderBy('created_at','desc')->paginate();

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
        $bKashSubscriptionMgr = new BKashSubscriptionManager();

        $response = $bKashSubscriptionMgr->show($subscriptionRequest->id);

        if($response) {
            $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseContent = json_decode($responseContent, true);

            Subscription::create(ArrayUtils::arrayExclude($responseContent,[
            // 'createdAt','modifiedAt','requesterId',
            // 'serviceId','paymentType','subscriptionType',
            // 'amountQueryUrl','firstPaymentAmount','maxCapRequired',
            // 'maxCapAmount','payerType','currency',
            // 'nextPaymentDate','subscriptionReference','extraParams',
            // "enabled",'expired','rrule','active'
        ]));

            // dd($responseContent, $statusCode);
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
