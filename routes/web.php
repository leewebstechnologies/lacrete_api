<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\HeroController;
use App\Http\Controllers\Backend\PortfolioController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Backend\WelcomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/profile/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
    Route::post('/user/password/update', [ProfileController::class, 'UserPasswordUpdate'])->name('user.password.update');

});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

   Route::controller(HeroController::class)->group(function() {
        Route::get('/all/heroes', 'AllHeroes')->name('all.heroes');
        Route::get('/add/hero', 'AddHero')->name('add.hero');
        Route::post('/store/hero', 'StoreHero')->name('store.hero');
        Route::get('/edit/hero/{id}', 'EditHero')->name('edit.hero');
        Route::post('/update/hero', 'UpdateHero')->name('update.hero');
        Route::get('/delete/hero/{id}', 'DeleteHero')->name('delete.hero');
   });

   Route::controller(VideoController::class)->group(function() {
        Route::get('/all/videos', 'AllVideos')->name('all.videos');
        Route::get('/add/video', 'AddVideo')->name('add.video');
        Route::post('/store/video', 'StoreVideo')->name('store.video');
        Route::get('/edit/video/{id}', 'EditVideo')->name('edit.video');
        Route::post('/update/video', 'UpdateVideo')->name('update.video');
        Route::get('/delete/video/{id}', 'DeleteVideo')->name('delete.video');
   });

   Route::controller(TestimonialController::class)->group(function() {
        Route::get('/all/testimonials', 'AllTestimonials')->name('all.testimonials');
        Route::get('/add/testimonial', 'AddTestimonial')->name('add.testimonial');
        Route::post('/store/testimonial', 'StoreTestimonial')->name('store.testimonial');
        Route::get('/edit/testimonial/{id}', 'EditTestimonial')->name('edit.testimonial');
        Route::post('/update/testimonial', 'UpdateTestimonial')->name('update.testimonial');
        Route::get('/delete/testimonial/{id}', 'DeleteTestimonial')->name('delete.testimonial');
   });

   Route::controller(PortfolioController::class)->group(function() {
        Route::get('/all/portfolios', 'AllPortfolios')->name('all.portfolios');
        Route::get('/add/portfolio', 'AddPortfolio')->name('add.portfolio');
        Route::post('/store/portfolio', 'StorePortfolio')->name('store.portfolio');
        Route::get('/edit/portfolio/{id}', 'EditPortfolio')->name('edit.portfolio');
        Route::post('/update/portfolio', 'UpdatePortfolio')->name('update.portfolio');
        Route::get('/delete/portfolio/{id}', 'DeletePortfolio')->name('delete.portfolio');
   });

    Route::controller(WelcomeController::class)->group(function() {
        Route::get('/all/welcome', 'AllWelcome')->name('all.welcome');
        Route::get('/add/welcome', 'AddWelcome')->name('add.welcome');
        Route::post('/store/welcome', 'StoreWelcome')->name('store.welcome');
        Route::get('/edit/welcome/{id}', 'EditWelcome')->name('edit.welcome');
        Route::post('/update/welcome', 'UpdateWelcome')->name('update.welcome');
        Route::get('/delete/welcome/{id}', 'DeleteWelcome')->name('delete.welcome');
   });

    Route::controller(BlogController::class)->group(function() {
        Route::get('/all/blogs', 'AllBlogs')->name('all.blogs');
        Route::get('/add/welcome', 'AddWelcome')->name('add.welcome');
        Route::post('/store/welcome', 'StoreWelcome')->name('store.welcome');
        Route::get('/edit/welcome/{id}', 'EditWelcome')->name('edit.welcome');
        Route::post('/update/welcome', 'UpdateWelcome')->name('update.welcome');
        Route::get('/delete/welcome/{id}', 'DeleteWelcome')->name('delete.welcome');
   });

});


