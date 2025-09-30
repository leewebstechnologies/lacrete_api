<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at','DESC')->get();

         return response()->json([
                'status' => true,
                'data' => $blogs
            ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $model = new Blog();
        $model->title = $request->title;
        $model->desc = $request->desc;
        $model->slug = Str::slug($request->slug);
        $model->content = $request->content;
        $model->status = $request->status;
        $model->save();

         return response()->json([
            'status' => true,
            'message' => 'Blog added successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $blog = Blog::find($id);

         if ($blog == null) {
            return response()->json([
            'status' => false,
            'message' => 'Blog not found!'
            ]);
        }

         return response()->json([
            'status' => true,
            'data' => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        if ($blog == null) {
            return response()->json([
            'status' => false,
            'message' => 'Blog not found!'
            ]);
        }

         $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug,'.$id.',id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $blog->title = $request->title;
        $blog->desc = $request->desc;
        $blog->slug = Str::slug($request->slug);
        $blog->content = $request->content;
        $blog->status = $request->status;
        $blog->save();

        // Save Temp Image here
        if ($request->imageId > 0) {
            $oldImage = $blog->image;
            $tempImage = TempImage::find($request->imageId);
            if ($tempImage != null) {
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $fileName = strtotime('now').$blog->id.'.'.$ext;

                // Create small thumbnail here
                $sourcePath = public_path('uploads/temp/'.$tempImage->name);
                $destPath = public_path('uploads/blog/small/'.$fileName);
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($sourcePath);
                $image->coverDown(300, 300);
                $image->save($destPath);

                // Create large thumbnail here
                $sourcePath = public_path('uploads/temp/'.$tempImage->name);
                $destPath = public_path('uploads/blog/large/'.$fileName);
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($sourcePath);
                $image->scaleDown(1200);
                $image->save($destPath);

                $blog->image = $fileName;
                $blog->save();

                if ($oldImage != '') {
                    File::delete(public_path('uploads/blogs/large/'.$oldImage));
                    File::delete(public_path('uploads/blogs/small/'.$oldImage));
                }

            }
        }

         return response()->json([
            'status' => true,
            'message' => 'Blog updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);

        if ($blog == null) {
            return response()->json([
            'status' => false,
            'message' => 'Blog not found!'
            ]);
        }

        $blog->delete();

         return response()->json([
            'status' => true,
            'message' => "Blog deleted successfully!"
        ]);
    }
}
