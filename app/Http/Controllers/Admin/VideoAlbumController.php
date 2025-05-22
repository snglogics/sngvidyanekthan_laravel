<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use App\Models\VideoAlbum;

class VideoAlbumController extends Controller
{

    public function frontendVideo()
    {
        $apiKey = env('YOUTUBE_API_KEY');
    $channelId = env('YOUTUBE_CHANNEL_ID');

    $url = "https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId={$channelId}&maxResults=6&type=video&key={$apiKey}";

    $json = file_get_contents($url);
    $youtubeData = json_decode($json, true);

    $youtubeVideos = $youtubeData['items'] ?? [];

    $customVideos = VideoAlbum::all(); 
    
        $videos = VideoAlbum::latest()->get();
        return view('media.videolist', [
        'videos' => $videos,
        'youtubeVideos' => $youtubeVideos,
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
        $request->validate([
            'title' => 'required',
            'video' => 'required|mimetypes:video/mp4,video/avi,video/mov|max:51200', // max ~50MB
            'type' => 'required|in:album,virtual',
        ]);

        $cloudinary = new Cloudinary();
        $upload = $cloudinary->uploadApi()->upload(
            $request->file('video')->getRealPath(),
            [
                'resource_type' => 'video',
                'folder' => 'video_albums',
                'eager' => [['quality' => 'auto']]
            ]
        );

        VideoAlbum::create([
            'title' => $request->title,
            'type' => $request->type,
            'video_url' => $upload['secure_url'],
            'public_id' => $upload['public_id'],
        ]);

        return redirect()->back()->with('success', 'Video uploaded.');
    }
    public function destroy($id)
{
    $video = VideoAlbum::findOrFail($id);

    // Optionally delete from Cloudinary (if you stored public_id)
    // (new \Cloudinary\Cloudinary())->uploadApi()->destroy($video->cloudinary_public_id);

    $video->delete();

    return redirect()->back()->with('success', 'Video deleted successfully.');
}

// In your controller method


}
