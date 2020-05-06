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

Route::get('/', function () {
    return view('products.index');
});

Auth::routes();
Route::resource('products', 'ProductsController');
Route::resource('customers', 'CustomersController');
Route::resource('userproducts', 'UserproductsController');
Route::resource('contact', 'ContactController');
Route::get('/home', function () {
    return redirect('/products');
});
Route::post('/children/payment', 'PaymentController@childrenPayment');
Route::get('/payment/successful', 'PaymentController@validateChildrenPayment');
Route::get('/validate/childrenpayment', 'PaymentController@validateChildrenPayment');

Route::post('/teachers/pay', 'PaymentController@teachersPayment')->name('teachers.pay');
Route::get('/childrens', 'PaymentController@children');
Route::get('/teenagers', 'PaymentController@teenagers');
Route::get('/teachers', 'PaymentController@teachers');
Route::get('/payment/successful', function () {
    return view('payment');
});
Route::get('/payment/failed', function () {
    return view('failed');
});
