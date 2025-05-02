<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\SubGallery;
use App\Models\GalleryImage;
use Cloudinary\Cloudinary;
use App\Models\ImageGroup;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('subGalleries.imageGroups.images')->get();
        $subgalleries = SubGallery::all();
        return view('admin.gallery.galleryUpload', compact('galleries', 'subgalleries'));
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'main_image' => 'nullable|image'
        ]);

        $url = null;
        if ($request->hasFile('main_image')) {
            $url = (new Cloudinary())->uploadApi()->upload($request->file('main_image')->getRealPath())['secure_url'];
        }

        Gallery::create(['title' => $request->title, 'main_image' => $url]);
        return back()->with('success', 'Main gallery created.');
    }

    public function storeSubGallery(Request $request)
    {
        $request->validate([
            'gallery_id' => 'required|exists:galleries,id',
            'title' => 'required|string',
            'image' => 'nullable|image'
        ]);

        $url = null;
        if ($request->hasFile('image')) {
            $url = (new Cloudinary())->uploadApi()->upload($request->file('image')->getRealPath())['secure_url'];
        }

        SubGallery::create(['gallery_id' => $request->gallery_id, 'title' => $request->title, 'image' => $url]);
        return back()->with('success', 'Subcategory added.');
    }

    public function storeImageGroup(Request $request)
    {
        $request->validate([
            'sub_gallery_id' => 'required|exists:sub_galleries,id',
            'group_title' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'image',
            'titles' => 'array'
        ]);

        $group = ImageGroup::create([
            'sub_gallery_id' => $request->sub_gallery_id,
            'title' => $request->group_title,
        ]);

        foreach ($request->file('images') as $i => $image) {
            $url = (new Cloudinary())->uploadApi()->upload($image->getRealPath())['secure_url'];

            GalleryImage::create([
                'image_group_id' => $group->id,
                'image_url' => $url,
                'title' => $request->titles[$i] ?? null
            ]);
        }

        return back()->with('success', 'Image group uploaded.');
    }
}
