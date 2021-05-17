<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/', '/login', 301);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resources([
        'admin' => AdminController::class,
        'user' => UserController::class,
    ]);

    Route::prefix('admins')->group(function () {
        Route::match(['get', 'put'], '/changePass/{id?}', [App\Http\Controllers\AdminController::class, 'changePassword'])->name('admin.cpass');
        Route::post('/cPhoto/{id}', [App\Http\Controllers\AdminController::class, 'ChangePhoto'])->name('admin.cPhoto');
    });

    Route::prefix('users')->group(function () {
        Route::match(['get', 'put'], '/changePass/{id?}', [App\Http\Controllers\UserController::class, 'changePassword'])->name('user.cpass');
        Route::post('/cPhoto/{id}', [App\Http\Controllers\UserController::class, 'ChangePhoto'])->name('user.cPhoto');
    });
});

