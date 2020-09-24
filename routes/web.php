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
});

Route::get('/admin','AdminController@adminView')->name('admin');
Route::get('/admin/additem','AdminController@addItemView')->name('addItemView');
Route::post('/admin/additem','AdminController@addItem')->name('addItem');
Route::get('/admin/updateitem/{id}','AdminController@updateItemView')->where('id','[0-9]+')->name('updateItemView');
Route::patch('/admin/updateitem/{id}','AdminController@updateItem')->where('id','[0-9]+')->name('updateItem');
Route::delete('/admin/deleteitem/{id}','AdminController@deleteData')->where('id','[0-9]+')->name('deleteItem');

Route::get('/user','UserController@homeView')->name('user');
Route::post('/user/checkout','UserController@checkOut')->name('checkOut');

Route::group(['prefix' => '', 'middleware' => 'invoice'], function () {
    Route::get('/user/invoice','UserController@invoiceView')->name('invoiceView');
    Route::post('/user/invoice/{userID}','UserController@invoice')->name('saveInvoice');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
