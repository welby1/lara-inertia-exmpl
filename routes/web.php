<?php

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
Route::get('/page2', [App\Http\Controllers\TestController::class, 'index2'])->name('page2');
Route::get('/page3', [App\Http\Controllers\TestController::class, 'page3'])->name('page3');
Route::get('/page4', [App\Http\Controllers\TestController::class, 'page4'])->name('page4');
Route::post('/page4', [App\Http\Controllers\TestController::class, 'send'])->name('page4.send');

Route::get('/form/login', [App\Http\Controllers\Auth\LoginController::class, 'create'])->name('form.login');


Auth::routes();
Route::get('/page1', [App\Http\Controllers\TestController::class, 'index'])->name('page1');
Route::post('/page1', [App\Http\Controllers\TestController::class, 'store'])->name('page1.store');
