<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class ActivityLogController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $from_date = $request->from_date??Carbon::now()->format("Y-m-01");

        $to_date =  $request->to_date??Carbon::now()->format("Y-m-d");

        $term = $request->term;

        $logs = null;
        if (filter_var($term, FILTER_VALIDATE_IP)) {
            $logs = $this->searchByStringIpAddress($term, $from_date, $to_date);
        } elseif (is_numeric($term)) {
            $stringIp = long2ip($term);
            Session::flash('message', " String IP :$stringIp ");
            $logs = $this->searchByStringIpAddress($stringIp, $from_date, $to_date);
        } elseif ($term==null) {
            // do nothing
        } else {
            $logs = $this->searchByUserFullName($term, $from_date, $to_date);
        }

        if ($logs==null) {
            $logs= ActivityLog::with("user")->whereBetween('created_at', ["$from_date 00:00:00", "$to_date 23:59:59"])->latest()->paginate();
        }

        $logs->appends($request->all());

        return view('activitylog.index', compact('logs', 'from_date', 'to_date', 'term'));
    }

    public function searchByStringIpAddress($stringIp, $from_date, $to_date)
    {
        $logs =  ActivityLog::with("user")->where(function ($query) use ($stringIp, $from_date, $to_date) {
            $query->where('ip', $stringIp);
        })
        ->whereBetween('created_at', ["$from_date 00:00:00", "$to_date 23:59:59"])
        ->orderBy('created_at', "desc")
        ->paginate();
        return $logs;
    }

    public function searchByUserFullName($term, $from_date, $to_date)
    {
        $logs =  ActivityLog::with("user")->whereHas("user", function ($query) use ($term, $from_date, $to_date) {
            $query->where(DB::raw('CONCAT_WS(" ", users.first_name, users.surname, users.nickname)'), 'like', "%$term%");
        })->whereBetween('created_at', ["$from_date 00:00:00", "$to_date 23:59:59"])->orderBy('created_at', "desc")->paginate();

        return $logs;
    }
}
