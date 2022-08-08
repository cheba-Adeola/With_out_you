<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\auth;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/creer-form', [App\Http\Controllers\ArticleController::class, 'create'])->name('creation_article');
Route::post('/sauvegarde', [App\Http\Controllers\ArticleController::class, 'store'])->name('sauvegarde_article');
Route::patch('/modification/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->name('update_article');
Route::get('/edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit'])->name('edit_article/{id}');






