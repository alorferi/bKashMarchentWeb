<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['created_at','updated_at'];



     /**
     * Get all of the posts that are assigned this tag.
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }


     /**
     * Get all of the videos that are assigned this tag.
     */
    public function images()
    {
        return $this->morphedByMany(Image::class, 'taggable');
    }
}
