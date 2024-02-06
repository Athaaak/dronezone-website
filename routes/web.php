<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Provider\ProviderController;
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

Route::get('/', [HomepageController::class, 'homepage']);
Route::get('/explore', [HomepageController::class, 'explore'])->name('explore');
Route::get('/explore-general', [HomepageController::class, 'exploregeneral'])->name('general');
Route::get('/explore-professional', [HomepageController::class, 'exploreprofessional'])->name('professional');
Route::get('/provider', [HomepageController::class, 'provider'])->name('provider.home');
Route::get('/article', [HomepageController::class, 'article'])->name('article');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Auth::routes();

Route::middleware(['admin'])->group(function () {
    // Semua route yang ada didalam sini hanya bisa diakses oleh user dengan role admin
    Route::get('/dashboard-admin', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard-admin');

    Route::prefix('/admin')->group(function () {
        Route::get('/company-profile', [CompanyController::class, 'index'])->name('company-proile');
        Route::resources([
            'dashboard' => DashboardController::class,
        ]);
    });
});

Route::middleware(['role:admin,provider'])->group(function () {
    Route::get('/company-profile', [ProviderController::class, 'index'])->name('company-profile');
    Route::put('/update-company-profile', [ProviderController::class, 'update'])->name('update-company-profile');

    Route::resources([
        'articles' => ArticleController::class,
        'portfolio' => PortfolioController::class,
        'inventory' => InventoryController::class,
        'accounts' => AccountController::class,
    ]);
});


Route::middleware(['provider'])->group(function () {
    // Semua route yang ada didalam sini hanya bisa diakses oleh user dengan role provider
    Route::get('/dashboard-provider', [ProviderController::class, 'index'])->name('dashboard-provider');
});


Route::post('/register-provider', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register-provider');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/forbidden', function () {
    return view('403');
})->name('forbidden');
