<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Welcome;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function AllWelcome() {
        $welcome = Welcome::latest()->get();
        return view('backend.welcome.all_welcome', compact('welcome'));
    }
    // End Method

    public function AddWelcome() {
        return view('backend.welcome.add_welcome');
    }
    // End Method

    public function StoreWelcome(Request $request) {
            Welcome::create([
                'title' => $request->title,
            ]);

        $notification = array(
            'message' => 'Welcome Inserted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.welcome')->with($notification);
    }
    // End Method

    public function EditWelcome($id) {
        $welcome= Welcome::find($id);
        return view('backend.welcome.edit_welcome', compact('welcome'));
    }
    // End Method

    public function UpdateWelcome(Request $request) {
        $welcome_id = $request->id;
        $welcome = Welcome::find($welcome_id);

        $welcome->update([
        'title' => $request->title,
        ]);

        $notification = array(
        'message' => 'Title Updated Successfully!',
        'alert-type' => 'success'
        );

        return redirect()->route('all.welcome')->with($notification);
    }
    // End Method

    public function DeleteWelcome($id) {
        Welcome::find($id)->delete();

         $notification = array(
            'message' => 'Welcome Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // End Method


}
