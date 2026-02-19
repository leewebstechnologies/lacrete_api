<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HeroController;
use App\Http\Controllers\Backend\PortfolioController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\VideoController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Hero API
Route::get('/hero', [HeroController::class, 'ApiAllHeroes']);

// Video API
Route::get('/video', [VideoController::class, 'ApiAllVideos']);

// Blog API
Route::get('/blog', [BlogController::class, 'ApiAllBlogs']);
Route::get('/blog/{slug}', [BlogController::class, 'ApiAllBlogsBySlug']);

// Testimonial API
Route::get('/testimonial', [TestimonialController::class, 'ApiAllTestimonials']);

// About API
Route::get('/about', [AboutController::class, 'ApiAbout']);

// Portfolio API
Route::get('/portfolio', [PortfolioController::class, 'ApiAllPortfolios']);

// Contact API
Route::post('/contact', [ContactController::class, 'ApiContact']);

