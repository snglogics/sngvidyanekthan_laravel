<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use App\Models\VideoAlbum;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;



class VideoAlbumController extends Controller
{
    public function frontendVideo()
    {
        $apiKey = config('services.youtube.api_key');
        $channelId = config('services.youtube.channel_id');

        // $url = "https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId={$channelId}&maxResults=6&type=video&key={$apiKey}";

        // $json = file_get_contents($url);
        // $youtubeData = json_decode($json, true); 

        // $youtubeVideos = $youtubeData['items'] ?? [];
        $customVideos = VideoAlbum::all();
        $videos = VideoAlbum::latest()->get();

        return view('media.videolist', [
            'videos' => $videos,
            // 'youtubeVideos' => $youtubeVideos,
            'customeVideos' => $customVideos,
        ]);
    }

    public function index()
    {
        $videos = VideoAlbum::latest()->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }



public function store(Request $request)
{
    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|mimetypes:video/mp4,video/avi,video/mov,video/quicktime|max:204800', // Max 200MB
            'type' => 'required|in:album,virtual',
            'description' => 'nullable|string',
        ]);
    } catch (ValidationException $e) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput()
            ->with('error', 'Validation failed.');
    }

    try {
        $cloudinary = $this->cloudinary();

        $upload = $cloudinary->uploadApi()->upload(
            $request->file('video')->getRealPath(),
            [
                'resource_type' => 'video',
                'folder' => 'video_albums',
                'public_id' => uniqid(),
                'eager' => [
                    ['quality' => 'auto', 'fetch_format' => 'auto']
                ],
                'eager_async' => true,
                'overwrite' => true,
            ]
        );

        VideoAlbum::create([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'video_url' => $upload['secure_url'],
            'public_id' => $upload['public_id'],
            'duration' => $upload['duration'] ?? null,
            'format' => $upload['format'] ?? null,
        ]);

       if ($request->expectsJson() || $request->isJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Video uploaded successfully.'
            ]);
        }

        return redirect()->route('admin.videos.index')->with('success', 'Video uploaded successfully.');
    } catch (\Exception $e) {
        Log::error('Video upload failed: ' . $e->getMessage());

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage(),
            ], 500);
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Upload failed: ' . $e->getMessage());
    }
}


    public function destroy($id)
    {
        $video = VideoAlbum::findOrFail($id);

        // Delete from Cloudinary if public_id exists
        if ($video->public_id) {
            $this->cloudinary()->uploadApi()->destroy($video->public_id, [
                'resource_type' => 'video'
            ]);
        }

        $video->delete();

        return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully.');
    }

    /**
     * DRY helper for consistent Cloudinary initialization.
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
