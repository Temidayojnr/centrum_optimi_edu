<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = Setting::group('about', config('about'));

        return view('about', compact('about'));
    }
}
