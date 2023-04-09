<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('/posts')->group(function () {
        Route::get('', [\App\Http\Controllers\Api\PostController::class, 'index']);
        Route::get('/{post}', [\App\Http\Controllers\Api\PostController::class, 'show']);
        Route::post('', [\App\Http\Controllers\Api\PostController::class, 'store']);
        Route::put('/{post}', [\App\Http\Controllers\Api\PostController::class, 'update']);
        Route::delete('/{post}', [\App\Http\Controllers\Api\PostController::class, 'destroy']);
    });
});



Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});
