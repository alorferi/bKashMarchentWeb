<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {

        return view('about_us.index');

    }
}
