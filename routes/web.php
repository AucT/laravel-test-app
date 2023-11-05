<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'user', 'verified'])->name('dashboard');

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts', [\App\Http\Controllers\PostsController::class, 'index'])->name('posts.index');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [HomeController::class, 'index'])->name('admin');

    Route::get('/admin/posts', [PostsController::class, 'index'])->name('admin.posts');
    Route::get('/admin/posts/create', [PostsController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/posts', [PostsController::class, 'store'])->name('admin.posts.store');
    Route::get('/admin/posts/{post}/edit', [PostsController::class, 'edit'])->name('admin.posts.edit');
    Route::patch('/admin/posts/{post}', [PostsController::class, 'update'])->name('admin.posts.update');
    Route::post('/admin/posts/{post}/image', [PostsController::class, 'imageUpdate'])->name('admin.posts.image.update');

    Route::delete('/admin/posts/{post}', [PostsController::class, 'destroy'])->name('admin.posts.delete');

});


require __DIR__ . '/auth.php';
