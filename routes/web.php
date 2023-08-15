<?php

use App\Http\Controllers\AdminController;
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

Route::get('/csrf', function () {
    // return view('welcome');
    echo csrf_token();
});

Route::get('/',[HomepageController::class, 'homepage']);
Route::get('/explore',[HomepageController::class, 'explore'])->name('explore');
Route::get('/explore-general',[HomepageController::class, 'exploremain'])->name('general');
Route::get('/explore-professional',[HomepageController::class, 'exploremain'])->name('professional');
Route::get('/articles',[HomepageController::class, 'article'])->name('article');
Route::get('/admin',[AdminController::class, 'index'])->name('admin');
Route::get('/article-admin',[AdminController::class, 'articleadmin'])->name('article-admin');

Auth::routes();

Route::resources([
    'article'=>App\Http\Controllers\ArticleController::class,
]);

Route::middleware(['admin'])->group(function () {
    // Semua route yang ada didalam sini hanya bisa diakses oleh user dengan role admin
    Route::get('/dashboard-admin', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard-admin');

});

Route::middleware(['provider'])->group(function () {
    // Semua route yang ada didalam sini hanya bisa diakses oleh user dengan role provider
    Route::get('/dashboard-provider', [App\Http\Controllers\ProviderController::class, 'index'])->name('dashboard-provider');
});


Route::post('/register-provider', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register-provider');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/forbidden', function() {
    return view('403');
})->name('forbidden');
