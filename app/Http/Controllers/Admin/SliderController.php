<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class SliderController extends Controller
{
    protected Cloudinary $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary(
            new Configuration([
                'cloud' => [
                    'cloud_name' => config('cloudinary.cloud_name'),
                    'api_key'    => config('cloudinary.api_key'),
                    'api_secret' => config('cloudinary.api_secret'),
                ],
                'url' => ['secure' => true],
            ])
        );
    }

    /**
     * ✅ Upload or update a slider.
     */
    public function sliderupload(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'heading' => 'nullable|string|max:555',
            'description' => 'nullable|string',
            'slider_id' => 'nullable|exists:sliders,id',
        ]);

        try {
            $slider = $request->slider_id
                ? Slider::find($request->slider_id)
                : new Slider();

            if ($request->hasFile('image')) {
                $uploadedFile = $this->cloudinary->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    ['folder' => 'sliders']
                );
                $slider->image = $uploadedFile['secure_url'];
            }

            $slider->heading = $request->heading;
            $slider->description = $request->description;
            $slider->save();

            return response()->json([
                'success' => true,
                'message' => 'Slider updated successfully.',
                'imageUrl' => $slider->image ?? null,
                'slider_id' => $slider->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Operation failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * ✅ Show upload form with all sliders
     */
    public function showSliderUpload()
    {
        $sliders = Slider::latest()->get();

        return view('admin.sliderUpload', compact('sliders'));
    }

    public function destroy(Request $request)
{
    $request->validate([
        'id' => 'required|exists:sliders,id',
    ]);

    try {
        $slider = Slider::findOrFail($request->id);

        // Optional: if using Cloudinary and want to delete image, extract public_id
        // Cloudinary deletion logic can go here if you store public_id

        $slider->delete();

        return response()->json([
            'success' => true,
            'message' => 'Slider deleted successfully.',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete slider: ' . $e->getMessage(),
        ], 500);
    }
}

}
