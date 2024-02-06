<?php

use App\Http\Controllers\Api\ApiAccountController;
use App\Http\Controllers\Api\ApiArticleController;
use App\Http\Controllers\Api\ApiInventoryController;
use App\Http\Controllers\Api\ApiPortfolioController;
use App\Http\Controllers\Api\ApiProviderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/portfolio')->group(function () {
    Route::get('/get-portfolio', [ApiPortfolioController::class, 'getPortfolio'])->name('portfolio.get');
    Route::get('/admin-datatable', [ApiPortfolioController::class, 'adminDatatable'])->name('portfolio.admin-datatable');
});

Route::prefix('/inventory')->group(function () {
    Route::get('/get-inventory', [ApiInventoryController::class, 'getInventory'])->name('inventory.get');
    Route::get('/admin-datatable', [ApiInventoryController::class, 'adminDatatable'])->name('inventory.admin-datatable');
});

Route::prefix('/account')->group(function () {
    Route::get('/datatable', [ApiAccountController::class, 'datatable'])->name('account.datatable');
});

Route::prefix('/article')->group(function () {
    Route::get('/get-article', [ApiArticleController::class, 'getArticle'])->name('articles.get');
});

Route::prefix('/provider')->group(function () {
    Route::get('/get-provider', [ApiProviderController::class, 'getProvider'])->name('provider.get');
});
