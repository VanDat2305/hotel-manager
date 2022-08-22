<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', function () {
    // alert()->success('It worked!', 'The form was submitted');
    return view('welcome');
})->name('client.home');
Route::get('/admin/login', 'Auth\LoginAdminController@getFormLogin')->name('formLoginAdmin');
Route::get('/admin/logout', 'Auth\LoginAdminController@logOut')->name('logOut');
Route::post('/admin/login', 'Auth\LoginAdminController@postLogin')->name('postLoginAdmin');
Route::middleware('auth')->prefix('admin')->name('admin.')->group(
    function () {
        Route::get('', 'Admin\DashboardController@index')->name('dashboard');
        Route::prefix('user')->middleware('admin')->name('user.')->group(
            function () {
                Route::get('/', 'Admin\UserController@index')->name('index');
                Route::get('/create', 'Admin\UserController@create')->name('create');
                Route::post('/store', 'Admin\UserController@store')->name('store');
                Route::get('/{id}/edit', 'Admin\UserController@edit')->name('edit');
                Route::post('/update/{id}', 'Admin\UserController@update')->name('update');
                Route::delete('/destroy/{id}', 'Admin\UserController@destroy')->name('destroy');
                Route::post('/update-status/{id}','Admin\UserController@updateStatus')->name('update-status');
            }
        );
        Route::prefix('customer')->name('customer.')->group(
            function () {
                Route::get('/', 'Admin\CustomerController@index')->name('index');
                // Route::get('/create', 'Admin\CustomerController@create')->name('create');
                // Route::post('/store', 'Admin\CustomerController@store')->name('store');
                // Route::get('/{id}/edit', 'Admin\CustomerController@edit')->name('edit');
                // Route::post('/update/{id}', 'Admin\CustomerController@update')->name('update');
                Route::post('/update-status/{id}','Admin\CustomerController@updateStatus')->name('update-status');
                Route::delete('/destroy/{id}', 'Admin\CustomerController@destroy')->name('destroy');
            }
        );
        Route::prefix('category')->name('category.')->group(
            function () {
                Route::get('/', 'Admin\CategoryController@index')->name('index');
                Route::get('/create', 'Admin\CategoryController@create')->name('create');
                Route::post('/store', 'Admin\CategoryController@store')->name('store');
                Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('edit');
                Route::post('/update/{id}', 'Admin\CategoryController@update')->name('update');
                Route::post('/update-status/{id}','Admin\CategoryController@updateStatus')->name('update-status');
                Route::delete('/destroy/{id}', 'Admin\CategoryController@destroy')->name('destroy');
            }
        );
        Route::prefix('room')->name('room.')->group(
            function () {
                Route::get('/', 'Admin\RoomController@index')->name('index');
                Route::get('/create', 'Admin\RoomController@create')->name('create');
                Route::post('/store', 'Admin\RoomController@store')->name('store');
                Route::get('/{id}/edit', 'Admin\RoomController@edit')->name('edit');
                Route::post('/update/{id}', 'Admin\RoomController@update')->name('update');
                Route::post('/update-status/{id}','Admin\RoomController@updateStatus')->name('update-status');
                Route::delete('/destroy/{id}', 'Admin\RoomController@destroy')->name('destroy');
            }
        );
        Route::prefix('booking')->name('booking.')->group(
            function () {
                Route::get('/', 'Admin\BookingController@index')->name('index');
                Route::get('/create/{room}', 'Admin\BookingController@create')->name('create');
                Route::post('/store/{room}', 'Admin\BookingController@store')->name('store');
                Route::get('/{id}/detail', 'Admin\BookingController@show')->name('detail');
                Route::get('/listRoom', 'Admin\BookingController@listRoom')->name('listRoom');
                Route::post('/update-status/{id}','Admin\BookingController@updateStatus')->name('update-status');
                Route::delete('/destroy/{id}', 'Admin\BookingController@destroy')->name('destroy');
            }
        );
    }
);