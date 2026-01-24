<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HeroController extends Controller
{
    public function AllHeroes() {
        $hero = Hero::latest()->get();
        return view('backend.hero.all_heroes', compact('hero'));
    }
    // End Method

    public function AddHero() {
        return view('backend.hero.add_hero');
    }
    // End Method

    public function StoreHero(Request $request) {
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(700, 500)->save(public_path('upload/hero/'.$name_gen));
            $save_url = 'upload/hero/'.$name_gen;

            Hero::create([
                'heading' => $request->heading,
                'description' => $request->description,
                'link' => $request->link,
                'image' => $save_url,
            ]);
        }

        $notification = array(
            'message' => 'Hero Inserted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.heroes')->with($notification);
    }
    // End Method

    public function EditHero($id) {
        $hero = Hero::find($id);
        return view('backend.hero.edit_hero', compact('hero'));
    }
    // End Method

     public function UpdateHero(Request $request) {
        $hero_id = $request->id;
        $hero = Hero::find($hero_id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(1124, 750)->save(public_path('upload/hero/'.$name_gen));
            $save_url = 'upload/hero/'.$name_gen;

            if (file_exists(public_path($hero->image))) {
                @unlink(public_path($hero->image));
            }

             $hero->update([
                'heading' => $request->heading,
                'description' => $request->description,
                'link' => $request->link,
                'image' => $save_url,
            ]);


          $notification = array(
            'message' => 'Hero Updated With Image Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.hero')->with($notification);
        } else {

             $notification = array(
            'message' => 'Hero Updated Without Image Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.hero')->with($notification);

        }
    }
    // End Method

    public function DeleteHero($id) {
        $item = Hero::find($id);
        $img = $item->image;
        unlink($img);

        Hero::find($id)->delete();

         $notification = array(
            'message' => 'Hero Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



    }

}
