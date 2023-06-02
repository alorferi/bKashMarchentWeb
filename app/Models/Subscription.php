<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AutoUuid;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at','expirationTime'];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'subscriptionId','id');
    }

}
