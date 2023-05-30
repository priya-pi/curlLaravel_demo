<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;




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


//LOGIN
Route::get('/',[registerController::class,'index']);
Route::post('/',[registerController::class,'loginAuth']);
Route::get('/logout',[registerController::class,'logout']);

//DASHBOARD
Route::get('dashboard',[DashboardController::class,'getAuthors'])->name('dashboard');

//AUTHOR
Route::delete('/dashboard/delete/{author}',[AuthorController::class,'deleteAuthor'])->name('delete');
Route::get('/singleAuthor/{author}',[AuthorController::class,'singleAuthor']);


//BOOK
Route::delete('/singleAuthor/delete/{book}',[BookController::class,'bookDelete'])->name('delete');
Route::get('/create',[BookController::class,'addBook'])->name('create');
Route::post('/create',[BookController::class,'store'])->name('create');
