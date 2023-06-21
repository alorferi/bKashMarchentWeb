<?php

namespace App\Http\Controllers;

use App\Business\BkashPaymentManager;
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

        $message = null;
        $show_otc_dialog = false;
        $ot_code = null;

        $otcObject = null;
        $subscriptions = null;

        $payer = Session::get('payer');

        if($payer) {
            $subscriptions =  Subscription::where('payer', $payer)->paginate();
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

                    // $responseContent = $otcResponse->getContents();
                    // $responseContent = json_decode($responseContent, $responseContent);

                    // dd( json_decode($otcResponse->content()) ,$otcResponse->status(),$otcResponse->statusText());
                    // dd( $otcResponse['content'] );

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

                        $subscriptions =  Subscription::where('payer', $payer)->paginate();

                        //   return ResponseUtils::ok(['token' => $otcVerifyResult['data']], "Verification Success.", $otcVerifyResult['status']);
                        break;

                    case ResponseUtils::MSG_STATUS_OTC_REJECTED:
                        //   dump(__LINE__, $otcVerifyResult);
                        $show_otc_dialog = true;
                        //   return ResponseUtils::ok($otcVerifyResult['data'], $otcVerifyResult['message'], $otcVerifyResult['status']);
                        break;

                    case ResponseUtils::MSG_STATUS_FAILED:
                        //   dump(__LINE__, $otcVerifyResult);
                        $show_otc_dialog = true;
                        //   return ResponseUtils::unProcessableEntity($otcVerifyResult['data'], $otcVerifyResult['message'], $otcVerifyResult['status']);
                        break;

                    default:
                        //   dump(__LINE__, $otcVerifyResult);
                        $show_otc_dialog = true;
                        //   return ResponseUtils::unProcessableEntity($otcVerifyResult['data'], $otcVerifyResult['message'], $otcVerifyResult['status'], );
                        break;
                }
            }


        }


        // dump(__LINE__, $otcObject);

        return view('MySubscription.index', compact('subscriptions', 'payer', "message", 'show_otc_dialog', "otcObject", "ot_code"));
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
        //
    }


    public function showPaymentsBySubscriptionId($subscriptionId)
    {


        $subscription = Subscription::find($subscriptionId);

        $manager = new BkashPaymentManager();

        $payments = $manager->fetchPaymentListBySubscriptionId($subscriptionId);

        // dd($responseObject);
        return view("MySubscription.show_by_payments", compact("subscription",'payments'));
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


    public function logout()
    {
        Session::forget('payer');

        return redirect()->to(route("my-subscriptions.index"));

    }
}
