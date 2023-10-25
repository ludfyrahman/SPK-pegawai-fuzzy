<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TermController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DetailCriteriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlottingController;
use App\Http\Controllers\ProjectController;
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

// Landing
Route::get('/', [LoginController::class, 'index']);


// Route Login
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
// Route Logout
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/storeEmployee/{id}', [EmployeeController::class, 'storeEmployee'])->name('position.storeEmployee');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/plotting-calculation', [PlottingController::class, 'calculation'])->name('plotting.calculation');
Route::resource('plotting', PlottingController::class);
Route::resource('position', PositionController::class);
Route::resource('user', UserController::class);
Route::resource('employee', EmployeeController::class);
Route::resource('criteria', CriteriaController::class);
Route::resource('detail-criteria', DetailCriteriaController::class);
Route::post('importData', [PartController::class, 'importData'])->name('importData');
Route::post('importData', [ProjectController::class, 'importData'])->name('importData');
Route::resource('history', HistoryController::class);
