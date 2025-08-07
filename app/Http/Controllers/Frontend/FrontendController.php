<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $data['sliders'] = Slider::where('status', true)->get();
        // Logic to display the frontend homepage
        return view('frontend.index', $data); // Assuming you have a view for the frontend homepage
    }
}
