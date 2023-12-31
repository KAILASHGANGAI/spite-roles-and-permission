<?php

use App\Http\Controllers\productController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleControllerler;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleControllerler::class);
    Route::resource('users', UserController::class);
    Route::resource('products', productController::class);
});


require __DIR__.'/auth.php';
