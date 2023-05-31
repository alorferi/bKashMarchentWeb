<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\PaymentAmount;
use App\Models\PaymentCycle;
use App\Models\PaymentSector;
use Illuminate\Http\Request;

class DonateUsController extends Controller
{
    public function index()
    {

        $paymentSectors = PaymentSector::get();
        $paymentAmounts = PaymentAmount::orderBy('amount')->get();
        $paymentCycles = PaymentCycle::where('is_active', true)
        ->orderBy('display_serial')
        ->get();

        return view('donate_us.index', compact('paymentAmounts','paymentCycles','paymentSectors'));
    }


    public function subscribe(Request $request){

    }

    public function process()
    {

    }
}
