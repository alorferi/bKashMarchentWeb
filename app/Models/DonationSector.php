<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationSector extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
      'is_active' => 'boolean',
    ];

    public function subscriptionRequest()
    {
        return $this->hasOne(SubscriptionRequest::class, "donationRequestId", 'id');
    }

}
