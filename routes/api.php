<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CommentController;

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
//Article
Route::resource('/article', ArticleController::class)->middleware('auth:sanctum');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('article.show')->middleware('stat');

//Auth
Route::get('/auth/signin', [AuthController::class, 'signin']);
Route::post('/auth/registr', [AuthController::class, 'registr']);
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/authenticate', [AuthController::class, 'authenticate']);
Route::get('/auth/logout', [AuthController::class, 'logout']);
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