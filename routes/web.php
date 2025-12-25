<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

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

//Article
Route::resource('/article', ArticleController::class)->middleware('auth:sanctum');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('article.show')->middleware('stat');

//Auth
Route::get('/auth/signin', [AuthController::class, 'signin']);
Route::post('/auth/registr', [AuthController::class, 'registr']);
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/authenticate', [AuthController::class, 'authenticate']);
Route::get('/auth/logout', [AuthController::class, 'logout']);

//Main
Route::get('/', [MainController::class, 'index']);
Route::get('/full_image/{img}', [MainController::class, 'show']);

Route::get('/about', function(){
    return view('main.about');
});

Route::get('/contact', function(){
    $array = [
        'name'=>'Moscow Polytech',
        'adres' => 'B. Semenovskaya h.38',
        'email' => '..@maspolytech.ru',
        'number' => '8(499)232-2222'
    ];
    return view('main.contact', ['contact'=>$array]);
});

//Comments
Route::prefix('comment')->name('comment.')->group(function(){
    Route::get('/', [CommentController::class, 'index'])->name('index');       // GET /comment
    Route::post('/', [CommentController::class, 'store'])->name('store');      // POST /comment
    Route::get('/edit/{comment}', [CommentController::class, 'edit'])->name('edit');    // GET /comment/edit/1
    Route::put('/update/{comment}', [CommentController::class, 'update'])->name('update'); // PUT /comment/update/1
    Route::get('/delete/{comment}', [CommentController::class, 'destroy'])->name('destroy');
    Route::get('/accept/{comment}', [CommentController::class, 'accept'])->name('accept');
    Route::get('/reject/{comment}', [CommentController::class, 'reject'])->name('reject');
});

