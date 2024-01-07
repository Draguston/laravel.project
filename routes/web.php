<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\MessagesController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\ClientController;
use App\Http\Controllers\User\NewsController;
use App\Models\Post;
use Illuminate\Foundation\Auth\User;
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


//Роуты на админ панель
Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('homeAdmin');


    Route::resource('users', UsersController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);
});


//Роут на страничку юзера
Route::middleware(['auth'])->prefix('main')->group(function () {
    Route::get('/', [UserHomeController::class, 'index'])->name('homeUser');


    Route::get('/dashboard', function () {
        return view('user.dashboard'); })->name('dashboard');
    Route::resource('user', ClientController::class);
    Route::resource('news', NewsController::class);
    Route::resource('messages', MessagesController::class);
});


//Роуты на редактирование данных пользователя
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';