<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\SubGallery;
use App\Models\GalleryImage;
use Cloudinary\Cloudinary;
use App\Models\ImageGroup;

class AdminGalleryController extends Controller
{
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
            $url = (new Cloudinary())->uploadApi()->upload($request->file('main_image')->getRealPath())['secure_url'];
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

    // Group ImageGroups by title and flatten their images
    $groupedImageGroups = $imageGroups->groupBy('title')->map(function ($groups) {
        // Merge all images from groups with the same title
        $allImages = $groups->flatMap->images;
        return $allImages;
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

    // Optional: If you are storing file URLs and not paths, you might skip this
    // However, if you want to delete from Cloudinary, use their API
    // For example:
    // (new Cloudinary())->uploadApi()->destroy(public_id)

    // Delete from database
    $image->delete();

    return back()->with('success', 'Image deleted successfully.');
}

public function deleteImageGroup($groupId)
{
    $imageGroup = ImageGroup::with('images')->findOrFail($groupId);

    // Delete each image file if stored locally
    foreach ($imageGroup->images as $image) {
        if (Storage::exists($image->image_url)) {
            Storage::delete($image->image_url);
        }
        $image->delete(); // deletes DB entry
    }

    $imageGroup->delete(); // delete the image group itself

    return back()->with('success', 'Image group deleted successfully.');
}

public function deleteSubGallery($id)
{
    $subGallery = SubGallery::with('imageGroups.images')->findOrFail($id);

    foreach ($subGallery->imageGroups as $group) {
        foreach ($group->images as $image) {
            // Optional: delete physical image file
            if ($image->image_url && File::exists(public_path($image->image_url))) {
                File::delete(public_path($image->image_url));
            }

            $image->delete();
        }

        $group->delete();
    }

    $subGallery->delete();

    return redirect()->back()->with('success', 'Subgallery, its image groups, and all images have been deleted.'); 
}

public function deleteGallery($id)
{
    $gallery = Gallery::with('subGalleries.imageGroups.images')->findOrFail($id);

    // Delete main image if exists
    if ($gallery->main_image && File::exists(public_path($gallery->main_image))) {
        File::delete(public_path($gallery->main_image));
    }

    foreach ($gallery->subGalleries as $sub) {
        // Delete subgallery image
        if ($sub->image && File::exists(public_path($sub->image))) {
            File::delete(public_path($sub->image));
        }

        foreach ($sub->imageGroups as $group) {
            foreach ($group->images as $image) {
                if ($image->image_url && File::exists(public_path($image->image_url))) {
                    File::delete(public_path($image->image_url));
                }
                $image->delete();
            }
            $group->delete();
        }

        $sub->delete();
    }

    $gallery->delete();

    return redirect()->back()->with('success', 'Gallery and all related data deleted successfully.');
}
}
 