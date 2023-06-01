<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ActivityIpController extends Controller
{
    public function index(Request $request)
    {
        $from_date = $request->from_date??Carbon::now()->format("Y-m-01");

        $to_date =  $request->to_date??Carbon::now()->format("Y-m-d");

        $ips =   DB::table('activity_logs')
        ->selectRaw('activity_logs.ip, count(activity_logs.ip) as cnt')
        ->distinct(['activity_logs.ip'])
        ->orderBy('cnt',"desc")
        ->whereBetween('created_at', ["$from_date 00:00:00", "$to_date 23:59:59"])
        ->groupBy(['activity_logs.ip'])

       ->paginate();

       $ips->appends($request->all());

        return view('activityip.index', compact('ips', 'from_date', 'to_date'));
    }
}
