<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Courses\CourseController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\subject\SubjectController;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::resource('contact-us', ContactUsController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('grade', GradeController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('subject', SubjectController::class);
    Route::resource('courses', CourseController::class);
    Route::get('/', function () {
        view('dashboards.index');
    });
    Route::get('/dashboard', function () {
        view('dashboards.index');
    })->name('dashboard');
});


######################################## theem routs ################################################
Route::get('/', [RoutingController::class, 'index'])->name('root');
Route::get('/{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
Route::get('/{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
Route::get('/{any}', [RoutingController::class, 'root'])->name('any');
