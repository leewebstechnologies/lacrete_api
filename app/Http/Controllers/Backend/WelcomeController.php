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
}
