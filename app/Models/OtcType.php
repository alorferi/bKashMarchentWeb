<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoUuid;

class OtcType extends Model
{
    use AutoUuid;

    public const K_REGISTER_USER = "REGISTER_USER";
    public const K_RESET_PASSWORD = "RESET_PASSWORD";

    protected $guarded = [];
}
