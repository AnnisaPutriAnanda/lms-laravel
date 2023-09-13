<?php

use Illuminate\Support\Facades\Route;
//Crud
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\personalGoalController;
use App\Http\Controllers\toolsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function() {
    return view('index');;
})->middleware(['auth', 'role:admin'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'role:admin')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(JobController::class)->group(function () {
        Route::get('/JobTable',  'index')->name('Jobtable.index');
        Route::delete('/deleteJob/{id}', 'destroy');
        Route::get('/editJob/{id}', 'edit');
        route::post('/updateCreateJob', 'store')->name('updateCreateJob');
    });

    Route::controller(personalGoalController::class)->group(function () {
        Route::get('/personalGoalTable', 'index');
        Route::delete('/deleteGoal/{id}', 'destroy');
        Route::get('/editGoal/{id}', 'edit');
        route::post('/updateCreateGoal', 'store')->name('updateCreateGoal');
    });

    Route::get('/ToolsTable',[App\Http\Controllers\toolsController::class,'index']);
    
});

require __DIR__.'/auth.php';
