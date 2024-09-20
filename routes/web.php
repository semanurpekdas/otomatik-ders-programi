<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SınıflarController;
use App\Http\Controllers\DersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AkademisyenController; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AyarlarController; 

Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

// Sınıflar sayfası (Sadece oturum açmış kişiler erişebilir)
Route::get('/sınıflar', [SınıflarController::class, 'index'])->middleware(['auth'])->name('sınıflar.index');
Route::post('/sınıflar/ekle', [SınıflarController::class, 'store'])->middleware(['auth'])->name('sınıflar.store');
Route::put('/sınıflar/update/{id}', [SınıflarController::class, 'updateSalon'])->middleware(['auth'])->name('sınıflar.updateSalon');
Route::delete('/sınıflar/delete/{id}', [SınıflarController::class, 'deleteSalon'])->middleware(['auth'])->name('sınıflar.deleteSalon');

// Dersler sayfası (Sadece oturum açmış kişiler erişebilir)
Route::get('/dersler', [DersController::class, 'index'])->middleware(['auth'])->name('dersler');
Route::post('/dersler/ekle', [DersController::class, 'addDers'])->middleware(['auth'])->name('addDers');
Route::put('/dersler/update/{id}', [DersController::class, 'update'])->name('updateDers');
Route::delete('/dersler/delete/{id}', [DersController::class, 'delete'])->name('deleteDers');


// Profil sayfası (Sadece oturum açmış kişiler erişebilir)
Route::get('/profil', [ProfileController::class, 'index'])->middleware(['auth'])->name('profile');
Route::post('/profil/fotograf', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
Route::post('/profil/update', [ProfileController::class, 'update'])->name('profile.update');


// Akademisyenler sayfası (Sadece oturum açmış kişiler erişebilir)
Route::get('/akademisyenler', [AkademisyenController::class, 'index'])->middleware(['auth'])->name('akademisyenler');
Route::post('/akademisyenler/ekle', [AkademisyenController::class, 'createAkademisyen'])->middleware(['auth'])->name('akademisyenler.store');
Route::put('/akademisyenler/update/{guid}', [AkademisyenController::class, 'updateAkademisyen'])->middleware(['auth'])->name('akademisyenler.update');
Route::delete('/akademisyenler/delete/{guid}', [AkademisyenController::class, 'deleteAkademisyen'])->middleware(['auth'])->name('akademisyenler.delete');

// Ayarlar sayfası (Sadece oturum açmış kişiler erişebilir)
Route::middleware(['auth'])->group(function () {
    Route::get('/ayarlar', [AyarlarController::class, 'index'])->name('ayarlar');
    Route::post('/ayarlar', [AyarlarController::class, 'update'])->name('ayarlar.update');
});

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
Route::middleware('auth')->group(function () {
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

    // Roller
    Route::get('/admin/roller', [AdminController::class, 'roller'])->name('admin.roller');
    Route::post('/admin/role/add', [AdminController::class, 'addRole'])->name('admin.addRole');
    Route::put('/admin/role/update/{id}', [AdminController::class, 'updateRole'])->name('admin.updateRole');
    Route::delete('/admin/role/delete/{id}', [AdminController::class, 'deleteRole'])->name('admin.deleteRole');
    Route::get('/admin/role/users', [AdminController::class, 'userRole'])->name('admin.userRole');

    // Kullanıcılar 
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'userscreate'])->name('admin.userscreate');
    Route::post('/admin/users/add', [AdminController::class, 'adduser'])->name('admin.adduser');
    Route::get('/admin/users/edit/{guid}', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::post('/admin/users/update/{guid}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::delete('/admin/users/delete/{guid}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');


});





