<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use PHPUnit\Metadata\Test;

class TestimonialController extends Controller
{
     public function AllTestimonials() {
        $testimonial = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonials', compact('testimonial'));
    }
    // End Method

    public function AddTestimonial() {
        return view('backend.testimonial.add_testimonial');
    }
    // End Method

    public function StoreTestimonial(Request $request) {
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(700, 500)->save(public_path('upload/testimonial/'.$name_gen));
            $save_url = 'upload/testimonial/'.$name_gen;

            Testimonial::create([
                'name' => $request->name,
                'comment' => $request->comment,
                'image' => $save_url,
            ]);
        }

        $notification = array(
            'message' => 'Testimonial Inserted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.testimonials')->with($notification);
    }
    // End Method

    public function EditTestimonial($id) {
        $testimonial = Testimonial::find($id);
        return view('backend.testimonial.edit_testimonial', compact('testimonial'));
    }
    // End Method

     public function UpdateTestimonial(Request $request) {
        $testimonial_id = $request->id;
        $testimonial = Testimonial::find($testimonial_id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(1124, 750)->save(public_path('upload/testimonial/'.$name_gen));
            $save_url = 'upload/testimonial/'.$name_gen;

            if (file_exists(public_path($testimonial->image))) {
                @unlink(public_path($testimonial->image));
            }

             $testimonial->update([
                'name' => $request->name,
                'comment' => $request->comment,
                'image' => $save_url,
            ]);


          $notification = array(
            'message' => 'Testimonial Updated With Image Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.testimonials')->with($notification);
        } else {

             $notification = array(
            'message' => 'Testimonial Updated Without Image Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.testimonials')->with($notification);
        }
    }
    // End Method

    public function DeleteTestimonial($id) {
        $item = Testimonial::find($id);
        $img = $item->image;
        unlink($img);

        Testimonial::find($id)->delete();

         $notification = array(
            'message' => 'Testimonial Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
