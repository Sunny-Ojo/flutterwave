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

// route for initializing payment
Route::post('/teachers/pay', 'PaymentController@teachersPayment')->name('teachers.pay');
Route::post('/children/payment', 'PaymentController@childrenPayment');

// route for validating payment

Route::get('/teenspayment/successful', 'PaymentController@validateChildrenPayment');
Route::get('/teacherspayment/successful', 'PaymentController@validateTeachersPayment');

Route::get('/childrens', 'PaymentController@children');
Route::get('/teachers', 'PaymentController@teachers');
Route::get('/payment/successful', function () {
    return view('payment');
});
Route::get('/payment/failed', function () {
    return view('failed');
});