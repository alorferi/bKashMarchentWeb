<?php

namespace App\Models;

use App\Traits\AutoUuid;
use App\Models\User;
use ErrorException;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Request;

class ActivityLog extends Model
{
    use HasFactory;
    use AutoUuid;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function addToLog($class, $function, $line, $tags=null, $data=null)
    {
        try {
            $data = $data==null ? json_encode(request()->except('password')) : $data;

            $log = [
                'method' => Request::method(),
                'url' => Request::fullUrl(),
                'class' => $class,
                'function' => $function,
                'line' => $line,
                'ip' => Request::ip(),
                'agent' =>  Request::header('user-agent'),
                'user_id' => auth()->check() ? auth()->user()->id : null,
                'tags' => $tags,
                'data' => $data,
            ];


            $activityLog =	ActivityLog::create($log);

            return $activityLog;
        } catch(ErrorException $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return null;
        } catch(Exception $e) {
            ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $e->getMessage());
            return null;
        }
    }
}
