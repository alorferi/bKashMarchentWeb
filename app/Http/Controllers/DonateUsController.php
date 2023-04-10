<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class DonateUsController extends Controller
{
    public function index()
    {
        $images = Image::orderBy('created_at', 'desc')->paginate();
        return view('donate_us.index', compact('images'));
    }
}
