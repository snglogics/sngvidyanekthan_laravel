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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Admin\ManagerImageUploadController;
use App\Http\Controllers\Admin\MagazineController;
use App\Http\Controllers\Admin\FacultyStatController;
use App\Http\Controllers\Admin\VideoAlbumController;
use App\Http\Controllers\Admin\LiveClassController;
use App\Http\Controllers\Admin\TimeTableController;
use App\Http\Controllers\StudentApplicationController;
use App\Http\Controllers\AcademicCalendarController;
use App\Http\Controllers\CampusOverviewController;

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

// Principal message routes
Route::get('/principalmsg', [FrontEndController::class, 'viewPrincipal'])->name('principal.msg');


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
//uploaded event frontend
Route::get('/eventslist', [EventController::class, 'eventlist'])->name('events.list');

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
//frontend gallery
Route::get('/gallerylist', [AdminGalleryController::class, 'gallerylist'])->name('gallery.list');

// Route for the main gallery



// contact pate
Route::get('/contact', [ContactController::class, 'viewContact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Adding Teacher Routes
Route::get('admin/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('admin/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
Route::post('admin/teachers', [TeacherController::class, 'store'])->name('teachers.store');
Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

//View Teachers
Route::get('/teacherslist', [TeacherController::class, 'publicList'])->name('teachers.public');
//addimng manager image upload
Route::prefix('admin')->name('admin.')->group(function () {
  Route::get('/manager-message', [ManagerImageUploadController::class, 'showForm'])->name('manager.upload.form');
  Route::post('/manager-message', [ManagerImageUploadController::class, 'upload'])->name('manager.upload');
});

// school info in about
Route::view('/school-info', 'about.school-info')->name('school.info');
Route::view('/school-vision', 'about.vision_mission')->name('school.vision');

//magazine upload
Route::prefix('admin')->middleware('auth')->group(function () {
  Route::get('/magazines', [MagazineController::class, 'index'])->name('admin.magazines.index');
  Route::post('/magazines', [MagazineController::class, 'store'])->name('admin.magazines.store');
});
Route::get('/magazineslist', [MagazineController::class, 'list'])->name('magazines.list');
Route::get('/magazines/{id}', [MagazineController::class, 'show'])->name('magazines.show');

//Faculty stats
Route::get('/admin/faculty', [FacultyStatController::class, 'facultyHome'])->name('faculty.home');

// routes/web.php
Route::get('/admin/faculty/create', [FacultyStatController::class, 'create'])->name('admin.faculty.create');
Route::post('/admin/faculty/store', [FacultyStatController::class, 'store'])->name('admin.faculty.store');
Route::get('/faculty', [FacultyStatController::class, 'showFacultyStats'])->name('faculty.stats');

//upload video album
Route::prefix('admin')->name('admin.')->group(function () {
  Route::get('videos', [VideoAlbumController::class, 'index'])->name('videos.index');
  Route::get('videos/create', [VideoAlbumController::class, 'create'])->name('videos.create');
  Route::post('videos', [VideoAlbumController::class, 'store'])->name('videos.store');
  Route::delete('videos/{id}', [VideoAlbumController::class, 'destroy'])->name('videos.destroy');
});
// frontend video album
Route::get('/videolist', [VideoAlbumController::class, 'frontendVideo'])->name('videos.list');

Route::get('/admin/facility', [LiveClassController::class, 'facilityHome'])->name('facility.home');
//zoom meeting
Route::prefix('admin')->middleware(['auth'])->group(function () {
  Route::resource('live-classes', LiveClassController::class);
});

// time table management
Route::prefix('admin')->middleware(['auth'])->as('admin.')->group(function () {
  Route::resource('timetables', TimeTableController::class);
});

Route::get('/admin/timetablelist', [TimeTableController::class, 'timetableview'])->name('timetable.list');
require __DIR__.'/auth.php';

//News routes
Route::prefix('admin')->middleware('auth')->group(function () {
  Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
});

Route::get('/newsShow', [App\Http\Controllers\Admin\NewsController::class, 'index'])->name('news.index');

// submitting forms


// Protect routes with authentication
Route::prefix('admin')->middleware(['auth'])->group(function () {
  Route::get('/admission-form', [StudentApplicationController::class, 'showForm'])->name('student.form');
  Route::post('/admission-form', [StudentApplicationController::class, 'submitForm'])->name('student.submit');
});





Route::prefix('admin')->middleware(['auth'])->as('admin.')->group(function () {
  Route::resource('academic-calendars', AcademicCalendarController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/profile', function () {
      return view('profile.edit');
  })->name('profile.edit');
});
Route::get('/academic-calendar', [AcademicCalendarController::class, 'academicCalendarFrontend'])->name('academic-calendar.frontend');
Route::get('/academic-calendars/events', [AcademicCalendarController::class, 'academicCalendar'])->name('academic-calendars.events');

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
  Route::resource('campus-overviews', CampusOverviewController::class);
  Route::delete('campus-overviews/{campusOverview}/photos/{photoIndex}', [CampusOverviewController::class, 'destroyPhoto'])->name('campus-overviews.delete-photo');
  Route::put('campus-overviews/{campusOverview}/photos/{photoIndex}/update', [CampusOverviewController::class, 'updatePhoto'])->name('campus-overviews.update-photo');
});

