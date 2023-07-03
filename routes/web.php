<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/',[HomepageController::class, 'homepage']);

Auth::routes();

Route::middleware(['admin'])->group(function () {
    // Semua route yang ada didalam sini hanya bisa diakses oleh user dengan role admin
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::middleware(['provider'])->group(function () {
    // Semua route yang ada didalam sini hanya bisa diakses oleh user dengan role provider
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/forbidden', function() {
    return view('403');
})->name('forbidden');
