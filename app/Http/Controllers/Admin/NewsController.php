<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
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
        $news = null;
        return view('admin.news.create', compact('allNews', 'news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'youtube_link' => 'nullable|url|max:255'
        ]);

        try {
            $data = $request->only(['title', 'content', 'youtube_link']);

            if ($request->hasFile('image')) {
                $cloudinary = $this->cloudinary();
                $uploaded = $cloudinary->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'news',
                        'public_id' => 'news_' . uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'image',
                        'quality' => 'auto',
                        'fetch_format' => 'auto'
                    ]
                );

                $data['image_url'] = $uploaded['secure_url'];
                $data['public_id'] = $uploaded['public_id'];
            }

            News::create($data);
            return redirect()->route('admin.news.create')->with('success', 'News created successfully.');
        } catch (\Exception $e) {
            Log::error('News creation failed: ' . $e->getMessage());
            return back()->with('error', 'News creation failed: ' . $e->getMessage())->withInput();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'youtube_link' => 'nullable|url|max:255'
        ]);

        try {
            $data = $request->only(['title', 'content', 'youtube_link']);

            if ($request->hasFile('image')) {
                $cloudinary = $this->cloudinary();

                // Delete old image if exists
                if ($news->public_id) {
                    $cloudinary->uploadApi()->destroy($news->public_id);
                }

                $uploaded = $cloudinary->uploadApi()->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'news',
                        'public_id' => 'news_' . uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'image',
                        'quality' => 'auto',
                        'fetch_format' => 'auto'
                    ]
                );

                $data['image_url'] = $uploaded['secure_url'];
                $data['public_id'] = $uploaded['public_id'];
            }

            $news->update($data);
            return redirect()->route('admin.news.create')->with('success', 'News updated successfully.');
        } catch (\Exception $e) {
            Log::error('News update failed: ' . $e->getMessage());
            return back()->with('error', 'News update failed: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(News $news)
    {
        try {
            if ($news->public_id) {
                $cloudinary = $this->cloudinary();
                $cloudinary->uploadApi()->destroy($news->public_id);
            }

            $news->delete();
            return redirect()->back()->with('success', 'News deleted successfully.');
        } catch (\Exception $e) {
            Log::error('News deletion failed: ' . $e->getMessage());
            return back()->with('error', 'News deletion failed: ' . $e->getMessage());
        }
    }

    /**
     * DRY helper for consistent Cloudinary initialization
     */
    private function cloudinary()
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

        return new Cloudinary($config);
    }
}
