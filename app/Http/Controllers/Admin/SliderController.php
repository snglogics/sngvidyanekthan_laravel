<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function sliderupload(Request $request)
    {
        $request->validate([
            'slider' => 'required|in:slider1,slider2,slider3',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'heading' => 'nullable|string|max:555',
            'description' => 'nullable|string',
        ]);

        $sliderField = $request->input('slider');
        $heading = $request->input('heading');
        $description = $request->input('description');

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        try {
            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'sliders']
            );

            $imageUrl = $uploadedFile['secure_url'];

            // Update the slider record
            $slider = Slider::first(); // Only 1 record
            if (!$slider) {
                $slider = new Slider();
            }
            $slider->$sliderField = $imageUrl;
            $slider->{$sliderField . '_heading'} = $heading;
            $slider->{$sliderField . '_description'} = $description;
            $slider->save();

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully.',
                'imageUrl' => $imageUrl,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage(),
            ], 500);
        }
    }


    // show db images in  UI
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
