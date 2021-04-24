<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/set-language/{lang}', [App\Http\Controllers\LanguagesController::class, 'set'])->name('set.language');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    Route::prefix('admin')->group(function () {
        Route::middleware(['role:dev|admin',])->group(function () {
            Route::prefix('users')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
                Route::get('/{user}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->where('user', '[0-9]+')->name('admin.users.edit');
                Route::post('/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->where('user', '[0-9]+')->name('admin.users.update');
                Route::get('/{user}/delete', [App\Http\Controllers\Admin\UserController::class, 'delete'])->where('user', '[0-9]+')->name('admin.users.delete');
                Route::post('/{user}/password', [App\Http\Controllers\Admin\UserController::class, 'password'])->where('user', '[0-9]+')->name('admin.users.password');
                Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'createFrm'])->name('admin.users.createFrm');
                Route::post('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
            });
            Route::prefix('roles')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.roles.index');
                Route::get('/{role}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->where('role', '[0-9]+')->name('admin.roles.edit');
                Route::post('/{role}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->where('role', '[0-9]+')->name('admin.roles.update');
                Route::get('/{role}/delete', [App\Http\Controllers\Admin\RoleController::class, 'delete'])->where('role', '[0-9]+')->name('admin.roles.delete');
                Route::post('/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('admin.roles.create');
            });
        });
    });
});
