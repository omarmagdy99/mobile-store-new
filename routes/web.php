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
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('home');
    });
    Route::get('/sales', function () {
        return view('pages.Invoices.sales');
    });
    Route::get('/purchases', function () {
        return view('pages.Invoices.purchases');
    });
    Route::get('/customers', function () {
        return view('pages.customers.customers');
    });
    Route::get('/products', function () {
        return view('pages.products.products');
    });
    Route::get('/products/add', function () {
        return view('pages.products.AddProducts');
    });
    Route::get('/brands', function () {
        return view('pages.BrandsAndCategories.brands');
    });
    Route::get('/categories', function () {
        return view('pages.BrandsAndCategories.categories');
    });
    Route::get('/addUsers', function () {
        return view('pages.users.addUsers');
    });
    Route::get('/usersList', function () {
        return view('pages.users.usersList');
    });


    Route::get('/{page}', 'AdminController@index');
});
