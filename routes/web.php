<?php

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
Auth::routes();
Route::group(['middleware'=>'auth'],function(){

    Route::get('/index', function () {
        return view('index');
    });
    Route::get('/sales',function(){
        return view('pages.sales');
    });
    Route::get('/brands', function () {
        return view('pages.brands');
    });
    Route::get('/categories', function () {
        return view('pages.categories');
    });
    Route::get('/purchases', function () {
        return view('pages.purchases');
    });
    Route::get('/products', function () {
        return view('pages.products.products');
    });
    Route::get('/products/add', function () {
        return view('pages.products.AddProducts');
    });
    
    
    Route::get('/{page}', 'AdminController@index');
    
    
    
});

