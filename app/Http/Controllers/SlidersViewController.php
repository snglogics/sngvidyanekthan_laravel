<?php

namespace App\Http\Controllers;

use App\Models\Slider;

class SlidersViewController extends Controller
{
    /**
     * Show frontend slider preview
     */
    public function viewSlider()
    {
        // Get all sliders (latest first, or customize order)
        $sliders = Slider::latest()->get();

        // Return them directly to the view
        return view('frontend.viewSlider', compact('sliders'));
    }
}
