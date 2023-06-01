<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnBoard extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AutoUuid;

    protected $guarded = [];

}
