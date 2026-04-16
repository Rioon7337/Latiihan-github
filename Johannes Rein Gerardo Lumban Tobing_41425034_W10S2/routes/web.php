<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UploadController;



Route::get('/', [UploadController::class, 'form'])->name('uploads.form');

Route::post('/upload', [UploadController::class, 'upload'])->name('uploads.upload');
Route::resource('uploads', UploadController::class);