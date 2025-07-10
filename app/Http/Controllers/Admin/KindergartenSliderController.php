<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KindergartenSlider;
use App\Models\KinderPrincipalMsg;
use App\Models\KinderGallery;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

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
            'description' => 'nullable|string',
        ]);

        $cloudinary = $this->cloudinary();

        $uploaded = $cloudinary->uploadApi()->upload(
            $request->file('image')->getRealPath(),
            [
                'folder' => 'kindergarten_sliders',
                'public_id' => uniqid(),
                'overwrite' => true,
                'resource_type' => 'image',
                'quality' => 'auto',
                'fetch_format' => 'auto',
            ]
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
        return view('frontend.kindergarten', compact('kinderSliders', 'principalMsg', 'kinderGallery'));
    }

    /**
     * DRY helper for Cloudinary initialization
     */
    private function cloudinary()
    {
        $config = new Configuration([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);

        return new Cloudinary($config);
    }
}
