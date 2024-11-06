<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

Route::get('/',[userController::class,'index']);
Route::post('/user/store', [UserController::class, 'store'])->name('users.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/user/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
