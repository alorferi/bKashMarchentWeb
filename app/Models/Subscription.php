<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at',
                        'startDate',
                    'expiryDate'];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'subscriptionId', 'id');
    }


    public function subscriptionRequest()
    {
        return $this->belongsTo(SubscriptionRequest::class, "subscriptionRequestId", "id");
    }

}
