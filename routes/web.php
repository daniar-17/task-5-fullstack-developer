<?php

use Illuminate\Support\Facades\Route;
use App\Http\Resources\CategoriesResource;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ArticlesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
// Route::get('/', function () { return view('auth/first'); });
Route::get('/', [HomeController::class, 'first'])->name('first');
Route::get('/first_detail/{id}', [HomeController::class, 'first_detail']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/logout', [HomeController::class, 'logout']);

Route::group(['middleware'=>'auth'], function(){
    
    //CATEGORY
    Route::get('/categories', [CategoriesController::class, 'data']);
    Route::get('/categories/add', [CategoriesController::class, 'add']);
    Route::post('/categories/addProcess', [CategoriesController::class, 'addProcess']);
    Route::get('/categories/edit/{id}', [CategoriesController::class, 'edit']);
    Route::post('/categories/editProcess/{id}', [CategoriesController::class, 'editProcess']);
    Route::post('/categories/delete/{id}', [CategoriesController::class, 'delete']);

    //ARTICLES
    Route::get('/articles', [ArticlesController::class, 'data']);
    Route::get('/articles/add', [ArticlesController::class, 'add']);
    Route::post('/articles/addProcess', [ArticlesController::class, 'addProcess']);
    Route::get('/articles/edit/{id}', [ArticlesController::class, 'edit']);
    Route::post('/articles/editProcess/{id}', [ArticlesController::class, 'editProcess']);
    Route::post('/articles/delete/{id}', [ArticlesController::class, 'delete']);

    Route::post('/articles/uploads', [ArticlesController::class, 'uploadImage'])->name('posts.upload');
});


