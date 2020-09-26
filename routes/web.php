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

Route::get('/', function () {
    return redirect(route('login'));
    // return view('userView.invoicepdf');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/','AdminController@adminView')->name('admin');
    Route::get('/additem','AdminController@addItemView')->name('addItemView');
    Route::post('/additem','AdminController@addItem')->name('addItem');
    Route::get('/updateitem/{id}','AdminController@updateItemView')->where('id','[0-9]+')->name('updateItemView');
    Route::patch('/updateitem/{id}','AdminController@updateItem')->where('id','[0-9]+')->name('updateItem');
    Route::delete('/deleteitem/{id}','AdminController@deleteData')->where('id','[0-9]+')->name('deleteItem');
});


Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
    Route::get('/','UserController@homeView')->name('user');
    Route::post('/checkout','UserController@checkOut')->name('checkOut');
    Route::get('/invoicelist','UserController@invoiceListView')->name('invoiceListView');
    Route::get('/printinvoice/{id}','UserController@invoicePrint')->name('printInvoice');
    Route::get('/invoicedetail/{id}','UserController@invoiceDetailView')->name('invoiceDetailView');

    Route::group(['prefix' => 'invoice'], function () {
        Route::get('/','UserController@invoiceView')->name('invoiceView')->middleware('invoice');
        Route::post('/{userID}','UserController@invoice')->name('saveInvoice');
    });
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
