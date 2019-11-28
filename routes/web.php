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



Route::namespace('Admin')->prefix('admin')->group(function () {
	Route::resource('/', 'LoginController');
	
	Route::group(['middleware' => 'auth'], function () {
		Route::resource('/dashboard', 'DashboardController');
		Route::resource('users', 'UsersController');
		Route::resource('vehicle', 'VehicleController');
		Route::resource('settings', 'SettingController');
		Route::resource('my-settings', 'MySettingController');
		// Route::resource('vehicle-info', 'VehicleInfoController');
		Route::resource('news-deals', 'NewsDealsController');
		
		Route::get('background-color', 'SettingController@backgroundColor');
		Route::get('pad-line-color', 'SettingController@padLineColor');
		Route::get('qr-code', 'SettingController@getQrCode');
		Route::post('qr-code', 'SettingController@postQrCode');
		
		Route::get('view-profile', 'UsersController@viewProfile');
		Route::post('usersUpdate', 'UsersController@usersUpdate');
		Route::post('userProfileUpdate', 'UsersController@userProfileUpdate');
		Route::post('user-table', 'UsersController@userTable');
		
		
		Route::get('view-vehicle','VehicleController@viewVehicleAll');
		Route::post('vehicleUpdate', 'VehicleController@vehicleUpdate');
		Route::get('vehicle-view/{id}','VehicleController@vehicleview');
		
	});
});
	
	
	
Route::get('/', function () {
    return view('welcome');
});

Route::get('/post','PostController@getpost');
Route::get('/create-post','PostController@createPost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
