<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Courses\CourseController;
use App\Http\Controllers\subject\SubjectController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::resource('contact-us', ContactUsController::class);
Route::resource('settings', SettingController::class);
Route::resource('gallery', GalleryController::class);
Route::resource('grade', GradeController::class);
Route::resource('subject', SubjectController::class);
Route::resource('courses', CourseController::class);

// require __DIR__ . '/auth.php';

    Route::get('/', [RoutingController::class, 'index'])->name('root');
    Route::get('/{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('/{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('/{any}', [RoutingController::class, 'root'])->name('any');

