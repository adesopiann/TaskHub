<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Models\Task;

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
    Route::get('/', [DashboardController::class, 'landingPage'])->name('landingPage');
    Route::get('/register', [AuthController::class, 'registerPage'])->name('registerPage');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

    Route::post('/task', [TaskController::class, 'store'])->name('store');
    Route::put('/task/{task}', [TaskController::class, 'update'])->name('update');
    Route::delete('/task/{task}' , [TaskController::class, 'destroy'])->name('delete');
    Route::get('/task/{id}', [TaskController::class, 'show'])->name('show.id');
    Route::get('/task/{id}/edit', [TaskController::class, 'edit']);
    Route::put('/task/{id}', [TaskController::class, 'updateStatus'])->name("updateStatus");

    Route::delete('/task/{task}/attachments/{attachment}', [TaskController::class, 'destroyAttachment'])->name('delete.attachment');
    Route::post('/tasks/{id}/update-status', [TaskController::class, 'updateStatus']);
    Route::get('/tasks/{task}', [TaskController::class, 'show']);
});
