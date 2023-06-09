<?php

namespace App\Http\Controllers;

use App\Business\BkashPaymentManager;
use App\Business\BkashSubscriptionManager;
use Illuminate\Http\Request;

use App\Business\OtcManager;
use App\Models\Subscription;
use App\Utils\ResponseUtils;
use Illuminate\Support\Facades\Session;

class MySubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $payer = Session::get('payer');

        $subscriptions =  Subscription::where('payer', $payer)->paginate();

        return view('MySubscription.index', compact('subscriptions', 'payer'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $bKashSubscriptionManager = new BkashSubscriptionManager();

        $subscription = $bKashSubscriptionManager->fetchAndUpdateBySubscriptionId($id);

        $bKashPaymentManager = new BkashPaymentManager();

        $payments = $bKashPaymentManager->fetchPaymentListBySubscriptionId($id);

        // dd($responseObject);
        return view("MySubscription.show", compact("subscription", 'payments'));
    }


    public function showPaymentsBySubscriptionId($id)
    {
        return $this->show($id);
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


    public function createCancel(Subscription $subscription)
    {
        return view('MySubscription.create_cancel', compact('subscription'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmCancel(Subscription $subscription, Request $request)
    {

        $request->validate([
            'reason' => ['required', 'string', 'max:30'],
        ]);

        dump($request->all());

        $manager = new BkashSubscriptionManager();

        $response = $manager->cancelSubscription($subscription->id, $request->reason);

        if($response->subscriptionStatus=="CANCELLED") {

            $bKashSubscriptionMgr = new BkashSubscriptionManager();

            $subscription = $bKashSubscriptionMgr->fetchAndUpdateBySubscriptionId($subscription->id);

        }

        return redirect(route("my-subscriptions.show", $subscription->id));

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


    public function login(Request $request)
    {

        $message = null;
        $show_otc_dialog = false;
        $ot_code = null;

        $otcObject = null;

        $payer = Session::get('payer');

        if($payer) {
            return redirect()->route("my-subscriptions.index");
        } else {

            $payer =  $request->payer;
            $ot_code =  $request->ot_code;

            $otcTypeName = "SHOW_MY_SUBSCRIPTIONS";

            $otcManager = new OtcManager();
            if($payer && !$ot_code) {

                $cnt = Subscription::where('payer', $request->payer)->count();

                if($cnt==0) {
                    $message = "You have no subscription";
                } else {

                    //Generate OTP
                    $otcResponse = $otcManager->generateOtc($payer, $otcTypeName);


                    $show_otc_dialog = true;

                    $otcObject = json_decode($otcResponse->content());

                    // dump(__LINE__, $otcObject);


                }

            } elseif($payer && $ot_code) {
                //Verify Otc here

                $otcVerifyResult = $otcManager->verifyOtc($payer, $ot_code, $otcTypeName);

                $otcObject = json_decode(json_encode($otcVerifyResult));

                //   dump(__LINE__, $otcVerifyResult);



                switch ($otcVerifyResult['status']) {
                    case ResponseUtils::MSG_STATUS_OK:
                        //   dump(__LINE__, $otcVerifyResult);
                        $show_otc_dialog = false;

                        Session::put('payer', $payer);

                        return redirect()->route("my-subscriptions.index");
                        break;

                    case ResponseUtils::MSG_STATUS_OTC_REJECTED:
                        //   dump(__LINE__, $otcVerifyResult);
                        $show_otc_dialog = true;
                        break;

                    case ResponseUtils::MSG_STATUS_FAILED:
                        //   dump(__LINE__, $otcVerifyResult);
                        $show_otc_dialog = true;
                        break;

                    default:
                        //   dump(__LINE__, $otcVerifyResult);
                        $show_otc_dialog = true;
                        break;
                }
            }


        }


        return view('MySubscription.login', compact('payer', "message", 'show_otc_dialog', "otcObject", "ot_code"));
    }

    public function logout()
    {
        Session::forget('payer');

        return redirect()->to(route("my-subscriptions.index"));

    }
}
