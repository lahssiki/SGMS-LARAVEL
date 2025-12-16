<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SecurityGuardController;
use App\Http\Controllers\WeeklyPlanningController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

Route::get('/', [SecurityGuardController::class, 'index'])->name('security-guards.index');
Route::get('/create', [SecurityGuardController::class, 'create'])->name('security-guards.create');
Route::post('/security-guards', [SecurityGuardController::class, 'store'])->name('security-guards.store');
Route::get('/security-guards/{id}', [SecurityGuardController::class, 'show'])->name('security-guards.show');
Route::get('/security-guards/{id}/edit', [SecurityGuardController::class, 'edit'])->name('security-guards.edit');
Route::put('/security-guards/{id}/update', [SecurityGuardController::class, 'update'])->name('security-guards.update');
Route::delete('/security-guards/{id}',[SecurityGuardController::class, 'destroy'])->name('security-guards.destroy');
*/
Route::resource('security-guards',SecurityGuardController::class);

Route::get('/weekly-plannings', [WeeklyPlanningController::class, 'index'])->name('weekly-plannings.index');
Route::get('/weekly-plannings/create', [WeeklyPlanningController::class, 'create'])->name('weekly-plannings.create');
Route::post('/weekly-plannings', [WeeklyPlanningController::class, 'store'])->name('weekly-plannings.store');
Route::get('/weekly-plannings/{id}/edit', [WeeklyPlanningController::class, 'edit'])->name('weekly-plannings.edit');
Route::put('/weekly-plannings/{id}', [WeeklyPlanningController::class, 'update'])->name('weekly-plannings.update');
    

Route::get('/register', [AuthController::class, 'register'])->name('login.register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login.login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [SecurityGuardController::class, 'index'])->name('security-guards.index');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});