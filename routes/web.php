<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [EventController::class, 'home'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/events_create', [EventController::class, 'create'])->name('event.create');
    Route::get('/events', [EventController::class, 'index'])->name('event.index');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');

    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');

});

require __DIR__.'/auth.php';
