<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\SubGallery;
use App\Models\GalleryImage;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use App\Models\ImageGroup;

class AdminGalleryController extends Controller
{
    private $cloudinary;

    public function __construct()
    {
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

        $this->cloudinary = new Cloudinary($config);
    }

    public function mediahome()
    {
        return view('media.adminmedia');
    }

    public function index()
    {
        $galleries = Gallery::with('subGalleries.imageGroups.images')->get();
        $subgalleries = SubGallery::all();
        return view('admin.gallery.galleryUpload', compact('galleries', 'subgalleries'));
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:galleries,title',
            'main_image' => 'nullable|image'
        ]);

        $url = null;
        if ($request->hasFile('main_image')) {
            $url = $this->cloudinary->uploadApi()->upload(
                $request->file('main_image')->getRealPath(),
                ['folder' => 'galleries/main']
            )['secure_url'];
        }

        Gallery::create(['title' => $request->title, 'main_image' => $url]);
        return back()->with('success', 'Main gallery created.');
    }

    public function storeSubGallery(Request $request)
    {
        $request->validate([
            'gallery_id' => 'required|exists:galleries,id',
            'title' => 'required|string|unique:sub_galleries,title,NULL,id,gallery_id,' . $request->gallery_id,
            'image' => 'nullable|image'
        ]);

        $url = null;
        if ($request->hasFile('image')) {
            $url = $this->cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'galleries/sub']
            )['secure_url'];
        }

        SubGallery::create([
            'gallery_id' => $request->gallery_id,
            'title' => $request->title,
            'image' => $url
        ]);

        return back()->with('success', 'Subgallery created.');
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
            $url = $this->cloudinary->uploadApi()->upload(
                $image->getRealPath(),
                ['folder' => 'galleries/images']
            )['secure_url'];

            GalleryImage::create([
                'image_group_id' => $group->id,
                'image_url' => $url,
                'title' => $request->titles[$i] ?? null
            ]);
        }

        return back()->with('success', 'Image group uploaded.');
    }

    public function gallerylist()
    {
        $galleries = Gallery::orderBy('id', 'desc')->get();
        return view('admin.videos.Gallerylist', compact('galleries'));
    }

    public function showSubGalleries(Gallery $gallery)
    {
        $subGalleries = $gallery->subGalleries()->with('imageGroups')->get();
        return view('admin.videos.SubGalleryList', compact('gallery', 'subGalleries'));
    }

    public function showImageGroups(SubGallery $subGallery)
    {
        $imageGroups = $subGallery->imageGroups()->with('images')->get();

        $groupedImageGroups = $imageGroups->groupBy('title')->map(function ($groups) {
            return $groups->flatMap->images;
        });

        return view('admin.videos.ImageGroupList', compact('subGallery', 'groupedImageGroups'));
    }

    public function destroyGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return back()->with('success', 'Gallery deleted successfully.');
    }

    public function deleteImage($id)
    {
        $image = GalleryImage::findOrFail($id);
        $image->delete();
        return back()->with('success', 'Image deleted successfully.');
    }

    public function deleteImageGroup($groupId)
    {
        $imageGroup = ImageGroup::with('images')->findOrFail($groupId);

        foreach ($imageGroup->images as $image) {
            $image->delete();
        }

        $imageGroup->delete();
        return back()->with('success', 'Image group deleted successfully.');
    }

    public function deleteSubGallery($id)
    {
        $subGallery = SubGallery::with('imageGroups.images')->findOrFail($id);

        foreach ($subGallery->imageGroups as $group) {
            foreach ($group->images as $image) {
                $image->delete();
            }
            $group->delete();
        }

        $subGallery->delete();
        return back()->with('success', 'Subgallery and all related data deleted successfully.');
    }

    public function deleteGallery($id)
    {
        $gallery = Gallery::with('subGalleries.imageGroups.images')->findOrFail($id);

        foreach ($gallery->subGalleries as $sub) {
            foreach ($sub->imageGroups as $group) {
                foreach ($group->images as $image) {
                    $image->delete();
                }
                $group->delete();
            }
            $sub->delete();
        }

        $gallery->delete();
        return back()->with('success', 'Gallery and all related data deleted successfully.');
    }
}
