<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Mongo\TwitterController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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

Route::get('/getCategoryWithAllChildsTree', function () {
    return Category::whereNull('parent_id')->with('childs')->get();
});

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'          => 'twitter' , 'as' => 'twitter.'  ], function () {
    Route::get('/'              ,   [TwitterController::class , 'index'])   ->name('index');
    Route::get('data'           ,   [TwitterController::class , 'data'])    ->name('data') ;
    Route::post('pullData'      ,   [TwitterController::class , 'pullData'])->name('fetch');
});

Route::group(['prefix'          => 'upload_task' , 'as' => 'upload_task.'  ], function () {
    Route::get('/'              ,   [UploadsController::class , 'index'])   ->name('index');
});

Route::get('/eloquent'              ,   [AccountController::class , 'index'])   ->name('eloquent.index');



Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
