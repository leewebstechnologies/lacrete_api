<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AboutController extends Controller
{
    public function About() {
        $about = About::firstOrFail();;
        return view('backend.about.about', compact('about'));
    }
    // End Method

    public function UpdateAbout(Request $request) {
    $request->validate([
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $about = About::findOrFail($request->id);

    if ($request->file('image')) {

        $image = $request->file('image');
        $manager = new ImageManager(new Driver());

        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img->resize(500, 453)->save(public_path('upload/about/' . $name_gen));

        $save_url = 'upload/about/' . $name_gen;

        // Delete old image if exists
        if ($about->image && file_exists(public_path($about->image))) {
            @unlink(public_path($about->image));
        }

        // Update only image
        $about->update([
            'image' => $save_url,
        ]);
    }

    return redirect()->back()->with([
        'message' => 'About Image Updated Successfully!',
        'alert-type' => 'success',
    ]);
}


    //  public function UpdateAbout(Request $request) {
    //     $about_id = $request->id;
    //     $about = About::find($about_id);

    //     if ($request->file('image')) {
    //         $image = $request->file('image');
    //         $manager = new ImageManager(new Driver());
    //         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    //         $img = $manager->read($image);
    //         $img->resize(500, 453)->save(public_path('upload/about/'.$name_gen));
    //         $save_url = 'upload/about/'.$name_gen;

    //         if (file_exists(public_path($about->image))) {
    //             @unlink(public_path($about->image));
    //         }

    //          $about->update([
    //             'image' => $save_url,
    //         ]);


    //       $notification = array(
    //         'message' => 'About Updated With Image Successfully!',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->back()->with($notification);
    //     } else {

    //       $about->update([
    //             'title' => $request->title,
    //             'description' => $request->description,
    //             'services' => $request->services,
    //             'mission' => $request->mission,
    //             'vision' => $request->vision,
    //             'values' => $request->values,
    //             'history' => $request->history,
    //         ]);


    //         $notification = array(
    //         'message' => 'About Updated Without Image Successfully!',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->back()->with($notification);

    //     }
    // }
    // End Method

    // About API
    public function ApiAbout() {
        $about = About::find(1);
        return $about;
    }
}
