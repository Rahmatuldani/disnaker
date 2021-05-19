<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DinasController;
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
        'dinas' => DinasController::class,
    ]);

    Route::prefix('admins')->group(function () {
        Route::match(['get', 'put'], '/changePass/{id?}', [App\Http\Controllers\AdminController::class, 'changePassword'])->name('admin.cpass');
        Route::post('/cPhoto/{id}', [App\Http\Controllers\AdminController::class, 'ChangePhoto'])->name('admin.cPhoto');
        Route::match(['get', 'post'], 'user/{add?}', [App\Http\Controllers\AdminController::class, 'Users'])->name('admin.users');
        Route::match(['get', 'post'], 'office/{action?}', [App\Http\Controllers\AdminController::class, 'Office'])->name('admin.office');
        Route::match(['get', 'post'], 'position/{action?}', [App\Http\Controllers\AdminController::class, 'Position'])->name('admin.position');
        Route::match(['get', 'post'], 'education/{action?}', [App\Http\Controllers\AdminController::class, 'education'])->name('admin.education');
        Route::match(['get', 'post'], 'jobPosition/{action?}', [App\Http\Controllers\AdminController::class, 'jobPosition'])->name('admin.jobPosition');
    });

    Route::prefix('users')->group(function () {
        Route::match(['get', 'put'], '/changePass/{id?}', [App\Http\Controllers\UserController::class, 'changePassword'])->name('user.cpass');
        Route::post('/cPhoto/{id}', [App\Http\Controllers\UserController::class, 'ChangePhoto'])->name('user.cPhoto');
        Route::match(['get', 'post'], '/ipk1/{action?}', [App\Http\Controllers\UserController::class, 'ipk1'])->name('user.ipk1');
        Route::match(['get', 'post'], '/ipk2/{action?}', [App\Http\Controllers\UserController::class, 'ipk2'])->name('user.ipk2');
        Route::match(['get', 'post'], '/ipk3/{action?}', [App\Http\Controllers\UserController::class, 'ipk3'])->name('user.ipk3');
        Route::match(['get', 'post'], '/ipk4/{action?}', [App\Http\Controllers\UserController::class, 'ipk4'])->name('user.ipk4');
        Route::match(['get', 'post'], '/ipk5/{action?}', [App\Http\Controllers\UserController::class, 'ipk5'])->name('user.ipk5');
        Route::match(['get', 'post'], '/ipk6/{action?}', [App\Http\Controllers\UserController::class, 'ipk6'])->name('user.ipk6');
        // Route::post('/print/{set?}', [App\Http\Controllers\UserController::class, 'print'])->name('user.print');
    });

    Route::prefix('disnaker')->group(function () {

    });

    Route::get('userRegion', [App\Http\Controllers\AdminController::class, 'userRegion']);
    Route::get('userPosition', [App\Http\Controllers\AdminController::class, 'userPosition']);
});

// Route::get('test', [App\Http\Controllers\AdminController::class, 'userPosition']);

