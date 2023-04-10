<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    public function post(){
        return $this->belongsTo(Post::class,'id','comment_post_id');
    }

}
