<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AkademisyenController; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sınıflar', [ClassesController::class, 'index'])->name('classes');
Route::get('/dersler', [LessonController::class, 'index'])->name('lessons');
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
Route::get('/akademisyenler', [AkademisyenController::class, 'index'])->name('akademisyenler');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Auth::routes(['reset' => true]);  // Parola sıfırlama işlemleri için rotaları aktif eder.




// Admin Paneli
    // Universiteler
    Route::get('/admin/universiteler', [AdminController::class, 'university'])->name('admin.university');
    Route::post('/admin/university/add', [AdminController::class, 'addUniversity'])->name('admin.addUniversity');
    Route::delete('/admin/university/delete/{id}', [AdminController::class, 'deleteUniversity'])->name('admin.deleteUniversity');
    Route::put('/admin/university/update/{id}', [AdminController::class, 'updateUniversity'])->name('admin.updateUniversity');

    // Fakulteler
    Route::get('/admin/fakulteler', [AdminController::class, 'fakulteler'])->name('admin.fakulteler');
    Route::post('/admin/fakulteler/ekle', [AdminController::class, 'addFakulte'])->name('admin.addFakulte');
    Route::put('/admin/fakulteler/update/{id}', [AdminController::class, 'updateFakulte'])->name('admin.updateFakulte');
    Route::delete('/admin/fakulteler/delete/{id}', [AdminController::class, 'deleteFakulte'])->name('admin.deleteFakulte');


