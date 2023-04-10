<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {

        $images = Image::orderBy('created_at', 'desc')->paginate();
        return view('gallery.index', compact('images'));
    }
}
