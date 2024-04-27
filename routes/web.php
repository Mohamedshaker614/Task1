<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();
Route::get('dashboard/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('dashboard/admin/login', [AdminAuthController::class, 'auth'])->name('admin.auth');

Route::get('dashboard/user/login', [UserAuthController::class, 'login'])->name('user.login');
Route::post('dashboard/user/login', [UserAuthController::class, 'auth'])->name('user.auth');

Route::group(['middleware' => 'admin.verify'], function () {
    Route::get('dashboard/index', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);
    Route::post('updateProduct/{id}', [ProductController::class,'updateProduct']);
    Route::post('updateCategory/{id}', [CategoryController::class,'updateCategory']);
    Route::resource('categories', CategoryController::class)->except('show');
});

Route::group(['middleware' => 'user.verify'], function () {
    Route::get('user/dashboard/index', [UserAuthController::class, 'dashboard'])->name('user.dashboard');
});
