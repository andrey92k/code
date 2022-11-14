<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Repositories\Interfaces\ArticlesRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::get('categories/{id}',  [CategoryController::class, 'getCategory'])->name('find.categories');
    Route::get('products/{id}',  [ProductController::class, 'getProduct'])->name('find.products');


    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', function()
    {
        return View::make('pages.home');
    });
});

require __DIR__.'/auth.php';
