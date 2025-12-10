<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
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

Route::get('/', [MainController::class, 'index']);
Route::get('/full_image/{img}', [MainController::class, 'show']);


Route::get('/about', function () {
    return view('main/about');
});

Route::get('/contact', function () {
    $array = [
        'name' => 'Mikhail',
        'email' => 'shel130477@gmail.com',
        'number' => '+79527167957'
    ];
    return view('main/contact', ['contact' => $array]);
 });

 //Auth
Route::get('/auth/signin', [AuthController::class, 'signin']);
Route::post('/auth/registr', [AuthController::class, 'registr']);


//Article
Route::resource('/article', ArticleController::class);
