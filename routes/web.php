<?php

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

Auth::routes();
// Route::group(['middleware' => 'auth'], function () {

<<<<<<< HEAD
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/sales', function () {
        return view('pages.Invoices.sales.sales');
    });
    Route::get('/purchases', function () {
        return view('pages.Invoices.purchases.purchases');
    });
    Route::get('/Addpurchases', function () {
        return view('pages.Invoices.purchases.AddPurchases');
    });
  
=======
Route::get('/', function () {
    return view('home');
});
Route::get('/sales', function () {
    return view('pages.Invoices.sales.sales');
});
Route::get('/purchases', function () {
    return view('pages.Invoices.purchases.purchases');
});
>>>>>>> 7af557f9bb7e6b96e528da29ec481abb8c0341d5



Route::resource('/suppliers', 'SupplierController');
Route::resource('/customers', 'CustomerController');

Route::resource('/products', 'ProductController');
Route::get('/addProducts', 'ProductController@brand_cat');

Route::resource('/brands', 'BrandController');
Route::resource('/categories', 'CategoryController');

Route::resource('/addPurchaseInvoice', 'PurchasesInvoiceController');

Route::get('/addUsers', function () {
    return view('pages.users.addUsers');
});
Route::resource('/usersList', 'Auth\RegisterController');


<<<<<<< HEAD







 Route::resource('/suppliers','SupplierController');
 Route::resource('/customers','CustomerController');
 
















    Route::resource('/products','ProductController');
    Route::get('/addProducts','ProductController@brand_cat' );
    Route::get('/editProducts/{barcode}','ProductController@edit' );

    Route::resource('/brands', 'BrandController');
    Route::resource('/categories', 'CategoryController');
    
    Route::get('/addUsers', function () {
        return view('pages.users.addUsers');
    });
    Route::resource('/usersList', 'Auth\RegisterController');


    Route::get('/{page}', 'AdminController@index');
=======
Route::get('/{page}', 'AdminController@index');
>>>>>>> 7af557f9bb7e6b96e528da29ec481abb8c0341d5
// });
