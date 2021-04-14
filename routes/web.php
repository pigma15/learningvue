<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchitectController;

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
    return view('home');
});


Route::group(['prefix' => 'architects'], function(){
    Route::post('', [ArchitectController::class, 'index']);
    Route::post('create', [ArchitectController::class, 'create']);
 });