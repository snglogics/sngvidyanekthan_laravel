<?php

namespace App\Http\Controllers;



use App\Models\Slider;


class ViewSliderController extends Controller
{
    public function viewSlider()
    {



        $slider = Slider::first();

        $sliders = [
            [
                'image_url' => $slider->slider1,
                'header' => $slider->slider1_heading,
                'common_header' => $slider->slider1_description,
            ],
            [
                'image_url' => $slider->slider2,
                'header' => $slider->slider2_heading,
                'common_header' => $slider->slider2_description,
            ],
            [
                'image_url' => $slider->slider3,
                'header' => $slider->slider3_heading,
                'common_header' => $slider->slider3_description,
            ],
        ];

        return view('frontend.viewSlider', compact('sliders'));
    }
}
