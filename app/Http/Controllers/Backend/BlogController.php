<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    public function AllBlogs() {
        $blog = Blog::latest()->get();
        return view('backend.blog.all_blogs', compact('blog'));
    }
    // End Method

    public function AddBlog() {
        return view('backend.blog.add_blog');
    }
    // End Method

     public function StoreBlog(Request $request) {
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(688, 436)->save(public_path('upload/blog/'.$name_gen));
            $save_url = 'upload/blog/'.$name_gen;

            Blog::create([
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'desc' => $request->desc,
                'content' => $request->content,
                'image' => $save_url,
            ]);
        }

          $notification = array(
            'message' => 'Blog Inserted Successfully!',
            'alert-type' => 'success'
        );


        return redirect()->route('all.blogs')->with($notification);
    }
    // End Method

    public function EditBlog($id) {
        $blog = Blog::find($id);
        return view('backend.blog.edit_blog', compact('blog'));
    }
    // End Method

    public function UpdateBlog(Request $request) {
        $blog_id = $request->id;
        $blog = Blog::find($blog_id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(688, 436)->save(public_path('upload/blog/'.$name_gen));
            $save_url = 'upload/blog/'.$name_gen;

            if (file_exists(public_path($blog->image))) {
                @unlink(public_path($blog->image));
            }

             $blog->update([
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'desc' => $request->desc,
                'content' => $request->content,
                'image' => $save_url,
            ]);


          $notification = array(
            'message' => 'Blog Updated With Image Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blogs')->with($notification);
        } else {
            $blog->update([
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'desc' => $request->desc,
                'content' => $request->content,
            ]);


             $notification = array(
            'message' => 'Blog Updated Without Image Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blogs')->with($notification);

        }
    }
    // End Method

     public function DeleteBlog($id) {
        $item = Blog::find($id);
        $img = $item->image;
        unlink($img);

        Blog::find($id)->delete();

         $notification = array(
            'message' => 'Blog Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // End Method

    // Blog API
    public function ApiAllBlogs() {
        $blog = Blog::latest()->get();
        return $blog;
    }

    public function ApiAllBlogsBySlug($slug) {
        $blog = Blog::where('slug', $slug)->first();
        if (!$blog) {
            return response()->json(['error' => 'Blog not found'], 404);
        }
        return response()->json($blog);
    }





}
