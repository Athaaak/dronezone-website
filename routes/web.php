<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\HomepageController;
=======
>>>>>>> f1f65041cf3cc36a808bc4359849db1c6d413e63

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

<<<<<<< HEAD
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomepageController::class, 'homepage']);

=======
Route::get('/', function () {
    return view('welcome');
});
>>>>>>> f1f65041cf3cc36a808bc4359849db1c6d413e63
