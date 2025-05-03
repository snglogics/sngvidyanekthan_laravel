<?php

use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\UpcomingEventController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\ShowGalleryController;
use App\Http\Controllers\ContactController;


// Routes for the Frontend (Public Pages)
Route::get('/', [FrontEndController::class, 'home'])->name('home');  // Define home route
Route::get('/about', [FrontEndController::class, 'about'])->name('about');
Route::get('/footer', [FrontEndController::class, 'footer'])->name('footer');

// Routes for Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
  // Login page
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');  // Registration page

// dashboard route
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard'); // Using AdminController for the dashboard
});

// admin login
Route::post('/login', [LoginController::class, 'login'])->name('adminlogin');

Route::get('/admin/home', [AdminController::class, 'adminhome'])->name('admin.home');
// Handle Signout (Redirect to FrontEndController home page after logout)
Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('home');  // Redirect to the home page of FrontEndController
})->name('logout');

// image upload routes
Route::get('/upload-image', [ImageUploadController::class, 'showForm'])->name('image.form');
Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('image.upload');

//upload slider
Route::get('/admin/slider-upload', [SliderController::class, 'showSliderUpload'])->name('upload.slider');
Route::post('/admin/slider-upload', [SliderController::class, 'sliderupload'])->name('slider.upload');

 //upload event

 Route::get('/admin/uploadevents', [EventController::class, 'showUploadForm'])->name('events.upload');
 Route::post('/admin/uploadevents/upload', [EventController::class, 'eventUpload'])->name('event.upload');
 Route::get('/admin/uploadevents/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
Route::delete('/admin/uploadevents/{id}', [EventController::class, 'delete'])->name('event.delete');
Route::post('/admin/uploadevents/delete-by-header', [EventController::class, 'deleteByHeader'])->name('event.deleteByHeader');

//upload announcement
Route::get('/admin/announcements', [AnnouncementController::class, 'showUploadForm'])->name('announcement.uploadForm');
Route::post('/admin/announcements/upload', [AnnouncementController::class, 'uploadAnnouncement'])->name('announcement.upload');
Route::get('/admin/announcements/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcement.edit');

// Update announcement (submit edit form)
Route::post('/admin/announcements/{id}/update', [AnnouncementController::class, 'update'])->name('announcement.update');

// Delete announcement
Route::delete('/admin/announcements/{id}', [AnnouncementController::class, 'destroy'])->name('announcement.delete');
// upcoming events
Route::prefix('admin/events')->name('admin.events.')->group(function () {
  Route::get('/', [UpcomingEventController::class, 'index'])->name('index');
  Route::get('/create', [UpcomingEventController::class, 'create'])->name('create');
  Route::post('/store', [UpcomingEventController::class, 'store'])->name('store');
  Route::delete('/{id}', [UpcomingEventController::class, 'destroy'])->name('destroy');
});



//Admin Media routes
Route::get('/admin/media', [AdminGalleryController::class, 'mediahome'])->name('admin.media');

// Route for the gallery
Route::prefix('admin/gallery')->name('admin.gallery.')->group(function () {
  Route::get('/', [AdminGalleryController::class, 'index'])->name('index');
  Route::post('/store', [AdminGalleryController::class, 'storeGallery'])->name('store');
  Route::post('/subgallery/store', [AdminGalleryController::class, 'storeSubGallery'])->name('subgallery.store');
  Route::post('/group/store', [AdminGalleryController::class, 'storeImageGroup'])->name('group.store');
});
// Route for the main gallery
// route::get('/gallery', [ShowGalleryController::class, 'showGallery'])->name('gallery.show');
Route::get('admin/gallery', [ShowGalleryController::class, 'showGallery'])->name('gallery.show');

// contact pate
Route::get('/contact', [ContactController::class, 'viewContact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');



require __DIR__.'/auth.php';
