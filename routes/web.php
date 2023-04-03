<?php

use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view("welcome");
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('/posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('', [PostController::class, 'store'])->name('posts.store');
        Route::get('/restore', [PostController::class, 'restore'])->name('posts.restore');
        Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
        Route::post('/{post}/comments', [PostController::class, 'addComment'])->name('posts.addComment');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::put('/{post}/comments', [PostController::class, 'updateComment'])->name('posts.updateComment');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::delete('/{post}/comments', [PostController::class, 'deleteComment'])->name('posts.deleteComment');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');