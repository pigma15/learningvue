<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchitectController;
use App\Http\Controllers\ProjectController;

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
    Route::post('delete', [ArchitectController::class, 'delete']);
    Route::post('edit', [ArchitectController::class, 'edit']);
 });


 Route::group(['prefix' => 'projects'], function(){
    Route::post('', [ProjectController::class, 'index']);
    Route::post('create', [ProjectController::class, 'create']);
    Route::post('delete', [ProjectController::class, 'delete']);
    Route::post('edit', [ProjectController::class, 'edit']);
 });