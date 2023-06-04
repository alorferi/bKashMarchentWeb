<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OtcType;
use App\Models\User;
use Carbon\Carbon;
use App\Traits\AutoUuid;
use App\Utils\MobileNumberUtils;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otc extends Model
{
    use AutoUuid;
    use SoftDeletes;

    protected $dates = ['created_at','sms_sent_at', 'sent_at' ,'verified_at','expired_at'];

    public function setCreatedAtAttribute($created_at)
    {
        $this->attributes['created_at'] = Carbon::parse($created_at);
    }

    public function setSmsSentAtAttribute($sms_sent_at)
    {
        $this->attributes['sms_sent_at'] = Carbon::parse($sms_sent_at);
    }

    public function setVerifiedAtAttribute($verified_at)
    {
        $this->attributes['verified_at'] = Carbon::parse($verified_at);
    }
    public function setExpiredAtAttribute($verified_at)
    {
        $this->attributes['expired_at'] = Carbon::parse($verified_at);
    }

    public function otcType()
    {
        return $this->belongsTo(OtcType::class);
    }

    public function user()
    {
        if ( MobileNumberUtils::isValidMobileNumber($this->username,"*")) {
            return $this->belongsTo(User::class, 'username', 'mobile');
        } else {
            return $this->belongsTo(User::class, 'username', 'email');
        }
    }
}
