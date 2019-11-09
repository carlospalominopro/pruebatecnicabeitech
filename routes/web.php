<?php

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
    return view('home');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//RUTA PARA CREAR LAS ORDENES
Route::resource('orders', 'OrderController');

//RUTA PARA EL LISTADO DE LAS ORDENES DE DEBIDO CLIENTE
Route::get('order/list', 'OrderController@list')->name('orders.list');
Route::post('order/list', 'OrderController@getProductsByCustomer')->name('orders.getProducts');