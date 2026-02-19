<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    // READ
    public function AllVideos()
    {
        $videos = Video::latest()->get();
        return view('backend.video.all_videos', compact('videos'));
    }

    // CREATE FORM
    public function AddVideo()
    {
        return view('backend.video.add_video');
    }

    // STORE
    public function StoreVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:51200', // 50MB
        ]);

        $path = $request->file('video')->store('videos', 'public');

        Video::create([
            'video' => $path,
        ]);

        return redirect()->route('all.videos')->with([
            'message' => 'Video Uploaded Successfully!',
            'alert-type' => 'success'
        ]);
    }

    // EDIT FORM
    public function EditVideo($id)
    {
        $video = Video::findOrFail($id);
        return view('backend.video.edit_video', compact('video'));
    }

    // UPDATE
    public function UpdateVideo(Request $request)
    {
        $video = Video::findOrFail($request->id);

        if ($request->file('video')) {
            $request->validate([
                'video' => 'mimes:mp4,mov,avi,wmv|max:51200',
            ]);

            // delete old video
            if (Storage::disk('public')->exists($video->video)) {
                Storage::disk('public')->delete($video->video);
            }

            $path = $request->file('video')->store('videos', 'public');

            $video->update([
                'video' => $path,
            ]);
        }

        return redirect()->route('all.videos')->with([
            'message' => 'Video Updated Successfully!',
            'alert-type' => 'success'
        ]);
    }

    // DELETE
    public function DeleteVideo($id)
    {
        $video = Video::findOrFail($id);

        if (Storage::disk('public')->exists($video->video)) {
            Storage::disk('public')->delete($video->video);
        }

        $video->delete();

        return redirect()->back()->with([
            'message' => 'Video Deleted Successfully!',
            'alert-type' => 'success'
        ]);
    }

    // Video API
    public function ApiAllVideos() {
        $video = Video::latest()->get();
        return $video;
    }
}

