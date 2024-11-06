<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\demoController;
use App\http\Controllers\userController;

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


Route::get('/', [userController::class,"admin"]);
Route::post('/user/add',[userController::class,"addusers"])->name('users.add');
Route::delete('/user/delete/{id}',[userController::class,"deleteusers"])->name('users.delete');
Route::get('/user/edit/{id}',[userController::class,"editusers"])->name('users.edit');
Route::post('/user/update/{id}',[userController::class,"updateusers"])->name('users.update');

