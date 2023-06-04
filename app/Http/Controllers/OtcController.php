<?php

namespace App\Http\Controllers;

use App\Models\Otc;
use Illuminate\Http\Request;

class OtcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $otcs = Otc::with(['otcType','user'])->orderBy("created_at",'desc')->paginate();

        return view("otc.index",compact('otcs'));
    }
}
