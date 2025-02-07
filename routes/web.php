<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

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


Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'registerPage'])->name('registerPage');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::post('/task', [TaskController::class, 'store'])->name('store');
    Route::put('/task/{task}', [TaskController::class, 'update'])->name('update');
    Route::delete('/task/{task}' , [TaskController::class, 'destroy'])->name('delete');

    Route::post('/tasks/{task}/attachments', [AttachmentController::class, 'store'])->name('store.file');
    Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])->name('delete.file');
});

