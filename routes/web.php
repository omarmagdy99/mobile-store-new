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

Route::get('/', function () {
    return view('home');
});
// Sales Route

Route::get('/AddSales', 'SalesInvoiceController@show');
 Route::resource('/sales', 'SalesInvoiceController');
 Route::get('/salesDetails/{id}', 'salesInvoiceController@detials');
// ===============================================================
// Purchases Route

// Add Purchases Route

Route::get('/Addpurchases', 'PurchasesInvoiceController@show');

Route::get('/purchasesDetails/{id}', 'PurchasesInvoiceController@detials');
Route::get('/purchasesShowUpdate/{id}', 'PurchasesInvoiceController@edit');
Route::get('/purchasesUpdate/{id}', 'PurchasesInvoiceController@update');
Route::resource('/purchases', 'PurchasesInvoiceController');
// ===============================================================
// Suppliers Route

// ===============================================================
// Reportes Route



Route::get('/productReportes/{id}','ProductController@showReport');
Route::get('/productSearch','ProductController@productSearch');
// ===============================================================
// Reportes Route

Route::resource('/suppliers', 'SupplierController');
// ===============================================================
// Customers Route

Route::resource('/customers', 'CustomerController');
// ===============================================================
// Products Route

Route::resource('/products', 'ProductController');

// Add Products Route


Route::get('/addProducts', 'ProductController@cat');
// Update Product Route

Route::get('/editProducts/{barcode}', 'ProductController@edit');
// ===============================================================
// Brands Route


// ===============================================================
// Categories Route

Route::resource('/categories', 'CategoryController');
// ===============================================================
// Add User Route


Route::resource('/usersList', 'Auth\RegisterController');

Route::get('/addUsers', function () {
    return view('pages.users.addUsers');
});
// User List Route


Route::get('/updateUser/{id}', 'Auth\RegisterController@update_data');
// ===============================================================


Route::get('/{page}', 'AdminController@index');
// });
