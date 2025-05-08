<?php

namespace App\Http\Controllers\Admin;
use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index() {
        $news = News::latest()->get();
        return view('admin.news.newsfrontend', compact('news'));
    }
    
    public function create() {
        return view('admin.news.create');
    }
    
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'image' => 'nullable|image',
            'youtube_link' => 'nullable|url'
        ]);
    
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $uploaded = (new \Cloudinary\Cloudinary())->uploadApi()->upload($request->file('image')->getRealPath());
            $imageUrl = $uploaded['secure_url'];
        }
    
        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $imageUrl,
            'youtube_link' => $request->youtube_link
        ]);
        return back()->with('success', 'Image group uploaded.');
        
    }
    
    public function edit(News $news) {
        return view('admin.news.edit', compact('news'));
    }
    
    public function update(Request $request, News $news) {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'image' => 'nullable|image',
            'youtube_link' => 'nullable|url'
        ]);
    
        if ($request->hasFile('image')) {
            $uploaded = (new \Cloudinary\Cloudinary())->uploadApi()->upload($request->file('image')->getRealPath());
            $news->image_url = $uploaded['secure_url'];
        }
    
        $news->update($request->only(['title', 'content', 'youtube_link']));
    
        return redirect()->route('admin.news.index')->with('success', 'News updated!');
    }
    
    public function destroy(News $news) {
        $news->delete();
        return redirect()->back()->with('success', 'News deleted.');
    }
}
