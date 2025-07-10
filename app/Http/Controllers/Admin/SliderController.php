<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class SliderController extends Controller
{
    public function sliderupload(Request $request)
    {
        // Custom validation for image (required only if no existing image)
        $request->validate([
            'slider' => 'required|in:slider1,slider2,slider3',
            'image' => [
                function ($attribute, $value, $fail) use ($request) {
                    $slider = Slider::first();
                    $sliderField = $request->input('slider');

                    if ((!$slider || empty($slider->$sliderField)) && !$request->hasFile('image')) {
                        $fail("The {$sliderField} image is required.");
                    }
                },
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120'
            ],
            'heading' => 'nullable|string|max:555',
            'description' => 'nullable|string',
        ]);

        $sliderField = $request->input('slider');
        $heading = $request->input('heading');
        $description = $request->input('description');

        /**
         * ✅ Updated to use config/cloudinary.php
         */
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        $cloudinary = new Cloudinary($config);

        $slider = Slider::first() ?? new Slider();

        try {
            // Only upload new image if provided
            if ($request->hasFile('image')) {
                $uploadedFile = $cloudinary->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    ['folder' => 'sliders']
                );
                $slider->$sliderField = $uploadedFile['secure_url'];
            }

            // Always update heading and description
            $slider->{$sliderField . '_heading'} = $heading;
            $slider->{$sliderField . '_description'} = $description;
            $slider->save();

            return response()->json([
                'success' => true,
                'message' => 'Slider updated successfully.',
                'imageUrl' => $slider->$sliderField ?? null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Operation failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function showSliderUpload()
    {
        $slider = Slider::first();
        $images = [
            'slider1' => $slider?->slider1,
            'slider2' => $slider?->slider2,
            'slider3' => $slider?->slider3,
            'slider1_heading' => $slider?->slider1_heading,
            'slider1_description' => $slider?->slider1_description,
            'slider2_heading' => $slider?->slider2_heading,
            'slider2_description' => $slider?->slider2_description,
            'slider3_heading' => $slider?->slider3_heading,
            'slider3_description' => $slider?->slider3_description,
        ];
        return view('admin.sliderUpload', compact('images'));
    }
}
