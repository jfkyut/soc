<?php

use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Profile\PasswordController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [ProfileController::class,'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.delete');
    Route::put('/password', [PasswordController::class,'update'])->name('password.update');

    Route::get('/users', [UserController::class,'index'])->name('user.index');

    Route::post('/chat', [ChatController::class,'store'])->name('chat.store');
});
