<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\LessonController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sınıflar', [ClassesController::class, 'index'])->name('classes');
Route::get('/dersler', [LessonController::class, 'index'])->name('lessons');
