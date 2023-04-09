<?php

use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

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

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();

});

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->stateless()->user();
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/posts');
});


Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();

});

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();
    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
    ]);

    Auth::login($user);

    return redirect('/posts');
});
