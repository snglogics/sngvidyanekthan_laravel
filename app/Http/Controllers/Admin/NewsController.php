<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('admin.news.newsfrontend', compact('news'));
    }

    public function create()
    {
        $allNews = News::latest()->get();
        $news = null; // for form binding
        return view('admin.news.create', compact('allNews', 'news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'youtube_link' => 'nullable|url'
        ]);

        $imageUrl = null;

        try {
            if ($request->hasFile('image')) {
                $uploaded = $this->cloudinary()->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    ['folder' => 'news']
                );
                $imageUrl = $uploaded['secure_url'];
            }

            News::create([
                'title' => $request->title,
                'content' => $request->content,
                'image_url' => $imageUrl,
                'youtube_link' => $request->youtube_link
            ]);

            return redirect()->route('news.create')->with('success', 'News uploaded successfully!');
        } catch (\Exception $e) {
            Log::error('News upload failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'youtube_link' => 'nullable|url'
        ]);

        try {
            if ($request->hasFile('image')) {
                $uploaded = $this->cloudinary()->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    ['folder' => 'news']
                );
                $news->image_url = $uploaded['secure_url'];
            }

            $news->update([
                'title' => $request->title,
                'content' => $request->content,
                'youtube_link' => $request->youtube_link
            ]);

            return redirect()->route('news.create')->with('success', 'News updated successfully!');
        } catch (\Exception $e) {
            Log::error('News update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->back()->with('success', 'News deleted successfully.');
    }

    /**
     * DRY Cloudinary initialization
     */
    private function cloudinary()
    {
        return new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);
    }
}
