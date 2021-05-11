<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

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
Route::get('/home', [IndexController::class, 'index']);
Route::get('/product/create', [IndexController::class, 'create']);
Route::post('/product/store', [IndexController::class, 'store']);
Route::get('/product/specialItem', [IndexController::class, 'splcreate']);
Route::post('/product/specialItemStore', [IndexController::class, 'splstore']);
Route::post('/product/cart', [IndexController::class, 'cart']);
Route::get('/', function () {
    return view('welcome');
});
