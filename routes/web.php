<?php

use App\Http\Controllers\HistoryActivityController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'index']);
Route::get('/about', [IndexController::class, 'about']);

Route::get('/admin/activity', [HistoryActivityController::class, 'index'])
    ->middleware('auth.basic.once');
