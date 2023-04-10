<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {

        $images = Image::orderBy('created_at', 'desc')->paginate();
        return view('about_us.index', compact('images'));

    }
}
