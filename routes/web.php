<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\EmployerDashboardController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [JobController::class, 'index'])->name('jobs.index');


Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');


Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->name('jobs.edit')
    ->middleware('can:update,job');

Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');

Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

// routes/web.php
Route::get('/employer/dashboard', [EmployerDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('employer.dashboard');



 Route::get('/search', SearchController::class);
 Route::get('/tags/{tag:name}', TagController::class);

Route::middleware('guest')->group(function(){

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

});




Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');