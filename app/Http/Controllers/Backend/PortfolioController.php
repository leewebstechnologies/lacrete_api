<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PortfolioController extends Controller
{
     public function AllPortfolios() {
        $portfolio = Portfolio::latest()->get();
        return view('backend.portfolio.all_portfolios', compact('portfolio'));
    }
    // End Method

    public function AddPortfolio() {
        return view('backend.portfolio.add_portfolio');
    }
    // End Method

    public function StorePortfolio(Request $request) {
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(700, 500)->save(public_path('upload/portfolio/'.$name_gen));
            $save_url = 'upload/portfolio/'.$name_gen;

            Portfolio::create([
                'title' => $request->title,
                'category' => $request->category,
                'image' => $save_url,
            ]);
        }

        $notification = array(
            'message' => 'Portfolio Inserted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolios')->with($notification);
    }
    // End Method

    public function EditPortfolio($id) {
        $portfolio = Portfolio::find($id);
        return view('backend.portfolio.edit_portfolio', compact('portfolio'));
    }
    // End Method

     public function UpdatePortfolio(Request $request) {
        $portfolio_id = $request->id;
        $portfolio = Portfolio::find($portfolio_id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(1124, 750)->save(public_path('upload/portfolio/'.$name_gen));
            $save_url = 'upload/portfolio/'.$name_gen;

            if (file_exists(public_path($portfolio->image))) {
                @unlink(public_path($portfolio->image));
            }

             $portfolio->update([
                'title' => $request->title,
                'category' => $request->category,
                'image' => $save_url,
            ]);


          $notification = array(
            'message' => 'Portfolio Updated With Image Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolios')->with($notification);
        } else {

             $notification = array(
            'message' => 'Portfolio Updated Without Image Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolios')->with($notification);
        }
    }
    // End Method

    public function DeletePortfolio($id) {
        $item = Portfolio::find($id);
        $img = $item->image;
        unlink($img);

        Portfolio::find($id)->delete();

         $notification = array(
            'message' => 'Portfolio Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // Portfolio API
    public function ApiAllPortfolios() {
        $portfolio = Portfolio::latest()->get();
        return $portfolio;
    }
}
