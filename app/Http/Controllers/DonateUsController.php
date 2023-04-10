<?php

namespace App\Http\Controllers;

use App\Models\DonationAmount;
use App\Models\Image;
use Illuminate\Http\Request;

class DonateUsController extends Controller
{
    public function index()
    {

      $amounts = DonationAmount::orderBy('amount')->get();

        return view('donate_us.index', compact('amounts'));
    }
}
