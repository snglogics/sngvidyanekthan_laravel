<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KindergartenSlider;
use App\Models\KinderPrincipalMsg;
use App\Models\KinderGallery;
use Cloudinary\Cloudinary;

class KindergartenSliderController extends Controller
{
    public function index()
    {
       
        $sliders = KindergartenSlider::latest()->get();
        return view('admin.kinderGardenSlider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.kinderGardenSlider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'header' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        $uploaded = $cloudinary->uploadApi()->upload(
            $request->file('image')->getRealPath(),
            ['folder' => 'kindergarten_sliders']
        );

        KindergartenSlider::create([
            'image_url' => $uploaded['secure_url'],
            'header' => $request->header,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.kinder-sliders.index')->with('success', 'Slider uploaded!');
    }

    public function show(KindergartenSlider $kinder_slider)
{
    return view('admin.kinderGardenSlider.show', compact('kinder_slider'));
}

    public function destroy(KindergartenSlider $kinder_slider)
    {
        $kinder_slider->delete();
        return redirect()->back()->with('success', 'Deleted successfully!');
    }

    public function kindergarten()
{
     $principalMsg = KinderPrincipalMsg::latest()->first();
    $kinderSliders = KindergartenSlider::latest()->get();
    $kinderGallery = KinderGallery::orderBy('id', 'desc')->get()->groupBy('common_header');
    return view('frontend/kindergarten', compact('kinderSliders','principalMsg','kinderGallery'));
}

}
