<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;


class NewGalleryController extends Controller{
    public function showGallery(Request $request)
    {
        $query = Gallery::with('subGalleries.imageGroups.images');
    
        if ($request->filled('gallery')) {
            $query->where('id', $request->gallery);
        }
    
        $galleries = $query->paginate(5); // Or use ->get() if you want all at once
        $allGalleries = Gallery::all();
    
        return view('gallery', compact('galleries', 'allGalleries'));
    }
    
    
}