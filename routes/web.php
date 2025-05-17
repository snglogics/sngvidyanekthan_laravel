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
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\CoCurricularProgramController;
use App\Http\Controllers\Frontend\CoCurricularProgramController as FrontendCoCurricularProgramController;
use App\Http\Controllers\Admin\FieldTripController;
use App\Http\Controllers\Frontend\FieldTripController as FrontendFieldTripController;
use App\Http\Controllers\Frontend\SportsGameController as FrontendSportsGameController;
use App\Http\Controllers\Frontend\AcademicPerformanceController as FrontendAcademicPerformanceController;
use App\Http\Controllers\AcademicPerformanceController;
use App\Http\Controllers\Admin\SportsAwardController as AdminSportsAwardController;
use App\Http\Controllers\Frontend\SportsAwardController as FrontendSportsAwardController;
use App\Http\Controllers\Admin\CulturalCompetitionController;
use App\Http\Controllers\Frontend\CulturalCompetitionFrontendController;
use App\Http\Controllers\Frontend\TeacherAccoladeFrontendController;
use App\Http\Controllers\Admin\TeacherAccoladeController;
use App\Http\Controllers\Admin\SchoolBusRouteController;
use App\Http\Controllers\Frontend\FrontendBusRouteController;
use App\Http\Controllers\SeniorStudentAdmissionController;
use App\Http\Controllers\HigherStudentAdmissionController;
use App\Http\Controllers\Admin\InterschoolParticipationController;
use App\Http\Controllers\Frontend\InterFrontendschoolParticipationController;



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

//admin page routes
Route::get('/admin/home', [AdminController::class, 'adminhome'])->name('admin.home');
Route::get('/admin/about', [AdminController::class, 'adminabout'])->name('admin.about');
Route::get('/admin/academics', [AdminController::class, 'adminacademics'])->name('admin.academics');
Route::get('/admin/faculties', [AdminController::class, 'adminfaculties'])->name('admin.faculties');
Route::get('/admin/activities', [AdminController::class, 'adminactivities'])->name('admin.activities');
Route::get('/admin/achievements', [AdminController::class, 'adminachievements'])->name('admin.achievements');
Route::get('/admin/galleries', [AdminController::class, 'admingalleries'])->name('admin.galleries');
Route::get('/admin/studentlife', [AdminController::class, 'adminstudentlife'])->name('admin.studentlife');
Route::get('/admin/event', [AdminController::class, 'adminevent'])->name('admin.event');



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



// contact page
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
// Teacher Profile

Route::get('/teachers-profile', [TeacherController::class, 'teacherProfile'])->name('teachers.profile');
// Categorized Teachers Page
Route::get('/teachers-categories', [TeacherController::class, 'categorizedList'])->name('teachers.categorized');



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
Route::prefix('admin')
    ->middleware(['auth'])
    ->name('admin.') 
    ->group(function () {
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

// Show the admission form
Route::get('/admissions-senior', [SeniorStudentAdmissionController::class, 'showForm'])->name('admissions.form');

// Handle the form submission
Route::post('/admissions/senior', [SeniorStudentAdmissionController::class, 'submitForm'])->name('admissions.submit');
// academic performance

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
//frontend campus overview
Route::get('/campus-overviews/{campusOverview}', [CampusOverviewController::class, 'frontendshow'])->name('campus-overviews.frontendshow');
Route::get('/campus-overviews-frontend', [CampusOverviewController::class, 'frontendIndex'])->name('campus-overviews.frontendIndex');

//syllabus
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
  Route::resource('syllabuses', SyllabusController::class);
});



Route::get('/syllabus-list', [SyllabusController::class, 'publicList'])->name('syllabus.list');

// curriculum
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
  Route::get('/curriculums', [CurriculumController::class, 'index'])->name('curriculums.index');
  Route::match(['get', 'post'], '/curriculums/create', [CurriculumController::class, 'create'])->name('curriculums.create');
  Route::delete('/curriculums/{curriculum}', [CurriculumController::class, 'destroy'])->name('curriculums.destroy');
  Route::resource('curriculums', CurriculumController::class)->except(['show']);
});
Route::get('/curriculums', [CurriculumController::class, 'frontend'])->name('curriculums.list');

//co-curricular programs

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
  Route::resource('co_curricular_programs', CoCurricularProgramController::class)
      ->parameters(['co_curricular_programs' => 'program']);
});

// Frontend Routes
Route::prefix('co-curricular-programs')->name('frontend.co_curricular_programs.')->group(function () {
  Route::get('/', [FrontendCoCurricularProgramController::class, 'index'])->name('index');
  Route::get('/{program}', [FrontendCoCurricularProgramController::class, 'show'])->name('show');
});

//field trip
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
  Route::resource('field_trips', FieldTripController::class)
      ->parameters(['field_trips' => 'trip']);
});

//frontend field trip
Route::prefix('field-trips')->name('frontend.field_trips.')->group(function () {
  Route::get('/', [FrontendFieldTripController::class, 'index'])->name('index');
  Route::get('/{trip}', [FrontendFieldTripController::class, 'show'])->name('show');
});

// student counsil
Route::get('/student-council', function () {
  return view('student_council');
})->name('student_council');

// sports and games
use App\Http\Controllers\Admin\SportsGameController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('sports_games', SportsGameController::class);
});
// Frontend Routes for Sports & Games
Route::prefix('sports-games')->name('frontend.sports_games.')->group(function () {
  Route::get('/', [FrontendSportsGameController::class, 'index'])->name('index');
  Route::get('/{sportsGame}', [FrontendSportsGameController::class, 'show'])->name('show');
});

// houselife
Route::get('/house-life', function () {
  return view('house_life');
})->name('house_life');

// Frontend Routes for Academic Performances
Route::prefix('academic-performances')->name('frontend.academic_performances.')->group(function () {
  Route::get('/', [FrontendAcademicPerformanceController::class, 'index'])->name('index');
  Route::get('/{academicPerformance}', [FrontendAcademicPerformanceController::class, 'show'])->name('show');
});

// Admin Routes for Academic Performances
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
  Route::resource('academic_performances', AcademicPerformanceController::class);
});

//sports awards
// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('sports_awards', AdminSportsAwardController::class);
});

// Frontend Routes
Route::prefix('sports-awards')->name('frontend.sports_awards.')->group(function () {
  Route::get('/', [FrontendSportsAwardController::class, 'index'])->name('index');
  Route::get('/{sportsAward}', [FrontendSportsAwardController::class, 'show'])->name('show');
});

// cultural competition
// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
  Route::resource('cultural_competitions', CulturalCompetitionController::class);
});

// Frontend Routes
Route::prefix('cultural-competitions')->name('frontend.cultural_competitions.')->group(function () {
  Route::get('/', [CulturalCompetitionFrontendController::class, 'index'])->name('index');
  Route::get('/{culturalCompetition}', [CulturalCompetitionFrontendController::class, 'show'])->name('show');
});

//Teacher Accolate
// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
  Route::resource('teachers_accolades', TeacherAccoladeController::class);
});
//frontend
Route::prefix('teachers-accolades')->name('frontend.teachers_accolades.')->group(function () {
  Route::get('/', [TeacherAccoladeFrontendController::class, 'index'])->name('index');
  Route::get('/{teacherAccolade}', [TeacherAccoladeFrontendController::class, 'show'])->name('show');
});

// Admin Routes for School Bus Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
  Route::resource('school_bus_routes', SchoolBusRouteController::class);
});

// Frontend Bus Routes
Route::get('/bus-routes', [FrontendBusRouteController::class, 'index'])->name('frontend.bus_routes');
Route::get('/bus-routes/{schoolBusRoute}', [FrontendBusRouteController::class, 'show'])->name('frontend.bus_routes.show');

//higher secondary admission form
Route::get('/higher-admission', [HigherStudentAdmissionController::class, 'showHigherForm'])->name('higher-admission.form');

// Handle the form submission
Route::post('/higher-admission', [HigherStudentAdmissionController::class, 'submitHigherForm'])->name('higher-admission.submit');

Route::get('/admin/higher-students', [HigherStudentAdmissionController::class, 'listStudents'])->name('admin.higher-students.list');
Route::get('/admin/higher-student/{id}', [HigherStudentAdmissionController::class, 'viewStudent'])->name('admin.higher-student.details');
Route::get('/admin/higher-student/print/{id}', [HigherStudentAdmissionController::class, 'printStudent'])->name('admin.higher-student.print');

//interschool participation
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
  Route::resource('interschool-participations', InterschoolParticipationController::class);
});
//frontend interschool participation
Route::get('/interschool-participationslist', [InterFrontendschoolParticipationController::class, 'frontendIndex'])->name('interschool-participations.index');
