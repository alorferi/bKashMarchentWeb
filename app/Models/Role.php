<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends LaratrustRole
{
    use HasFactory;
    use SoftDeletes;

    public $guarded = [];

    const sa = 'sa';
    const author = 'author';
    const subscriber = 'subscriber';
    const contributor = 'contributor';
    const editor = 'editor';
    const administrator = 'administrator';
    const seo_editor = 'seo_editor';
    const seo_manager = 'seo_manager';


}
