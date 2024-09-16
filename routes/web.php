<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AkademisyenController; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;

Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

// Sınıflar sayfası (Sadece oturum açmış kişiler erişebilir)
Route::get('/sınıflar', [ClassesController::class, 'index'])->middleware(['auth'])->name('classes');

// Dersler sayfası (Sadece oturum açmış kişiler erişebilir)
Route::get('/dersler', [LessonController::class, 'index'])->middleware(['auth'])->name('lessons');

// Profil sayfası (Sadece oturum açmış kişiler erişebilir)
Route::get('/profil', [ProfileController::class, 'index'])->middleware(['auth'])->name('profile');
Route::post('/profil/fotograf', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
Route::post('/profil/update', [ProfileController::class, 'update'])->name('profile.update');



// Akademisyenler sayfası (Sadece oturum açmış kişiler erişebilir)
Route::get('/akademisyenler', [AkademisyenController::class, 'index'])->middleware(['auth'])->name('akademisyenler');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Auth::routes(['reset' => true]);  // Parola sıfırlama işlemleri için rotaları aktif eder.
Auth::routes(['verify' => true]);


// Mail işlemleri
Route::get('/email/verify', [VerificationController::class, 'notice'])
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])  // Sadece 'signed' ve 'throttle' middleware'leri kullanılıyor
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['throttle:6,1'])
    ->name('verification.send');

Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->name('verification.resend');





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

    // Bolumler
    Route::get('/admin/bolumler', [AdminController::class, 'bolumler'])->name('admin.bolumler');
    Route::post('/admin/bolumler/ekle', [AdminController::class, 'addBolum'])->name('admin.addBolum');
    Route::put('/admin/bolumler/update/{id}', [AdminController::class, 'updateBolum'])->name('admin.updateBolum');
    Route::delete('/admin/bolumler/delete/{id}', [AdminController::class, 'deleteBolum'])->name('admin.deleteBolum');

    //Roller
    Route::get('/admin/roller', [AdminController::class, 'roller'])->name('admin.roller');
    Route::post('/admin/role/add', [AdminController::class, 'addRole'])->name('admin.addRole');
    Route::put('/admin/role/update/{id}', [AdminController::class, 'updateRole'])->name('admin.updateRole');
    Route::delete('/admin/role/delete/{id}', [AdminController::class, 'deleteRole'])->name('admin.deleteRole');



