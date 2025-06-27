<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController; 
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\PostController; 
use App\Http\Controllers\UserFollowController;  

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
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return redirect('/login');
    }
});

Route::get('/home', [PostController::class, 'index'])->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/my-likes', [PostController::class, 'likedBlogs'])->name('my.likes');

    Route::prefix('users/{id}')->group(function () {
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow');
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings');
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');
    });

    Route::resource('users', UsersController::class);
    Route::resource('posts', PostController::class, ['only' => ['index', 'store']]);
    Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.toggleLike');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
