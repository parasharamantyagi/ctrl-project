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
		Route::get('vehicle-setting/{id}','SettingController@vehicleSetting');
		Route::post('vehicle-setting-status', 'SettingController@vehicleSettingStatus');
		Route::post('settings-update', 'SettingController@settingsUpdate');
		
		
		Route::get('my-setting', 'UsersController@viewProfile');
		Route::post('usersUpdate', 'UsersController@usersUpdate');
		Route::post('userProfileUpdate', 'UsersController@userProfileUpdate');
		Route::post('user-table', 'UsersController@userTable');
		Route::post('user-status', 'UsersController@userStatus');
		Route::get('redirect/{id}','UsersController@redirectUrl');
		
		Route::get('view-vehicle','VehicleController@viewVehicleAll');
		Route::post('vehicleUpdate', 'VehicleController@vehicleUpdate');
		Route::post('vehicle-table', 'VehicleController@vehicleTable');
		Route::get('vehicle-view/{id}','VehicleController@vehicleview');
		Route::post('get-vehicle-qrcode','VehicleController@getVehicleQrcode');
		Route::get('redirectsetting/{id}','VehicleController@redirectUrl');
		Route::get('owned','VehicleController@viewOwnedVehicleAll');
		
		Route::resource('edit-tables', 'EditTableController');
		
		Route::resource('create-new-car', 'CreateNewCarController');
		Route::get('create-excel-sheet', 'CreateNewCarController@createExcelSheet');
		Route::post('create-excel-sheet','CreateNewCarController@createExcelSheetPost');
		
	});
});


Route::namespace('Admin')->prefix('manufacturer')->group(function () {
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
		Route::get('vehicle-setting/{id}','SettingController@vehicleSetting');
		Route::post('vehicle-setting-status', 'SettingController@vehicleSettingStatus');
		Route::post('settings-update', 'SettingController@settingsUpdate');
		
		Route::get('my-setting', 'UsersController@viewProfile');
		Route::post('usersUpdate', 'UsersController@usersUpdate');
		Route::post('userProfileUpdate', 'UsersController@userProfileUpdate');
		Route::post('user-table', 'UsersController@userTable');
		Route::post('user-status', 'UsersController@userStatus');
		Route::get('redirect/{id}','UsersController@redirectUrl');
		
		Route::get('view-vehicle','VehicleController@viewVehicleAll');
		Route::post('vehicleUpdate', 'VehicleController@vehicleUpdate');
		Route::get('vehicle-view/{id}','VehicleController@vehicleview');
		Route::get('get-vehicle-qrcode/{id}','VehicleController@getVehicleQrcode');
		Route::get('owned','VehicleController@viewOwnedVehicleAll');
		
	});
});

	
	
Route::resource('/', 'Admin\LoginController');

Route::namespace('User')->prefix('user')->group(function () {
	Route::resource('/', 'LoginController');
	Route::group(['middleware' => 'auth'], function () {
		Route::resource('/dashboard', 'DashboardController');
		Route::resource('profile', 'UsersController');
		Route::get('redirect/{id}','UsersController@redirectUrl');
		
		Route::resource('vehicle', 'VehicleController');
		
		Route::get('test', 'VehicleController@test');
		Route::post('settings-update', 'VehicleController@settingsUpdate');
		Route::get('setting/{id}','VehicleController@settingId');
		Route::get('settings/{id}','VehicleController@editSettingId');
		Route::get('get-vehicle-qrcode/{id}','VehicleController@getVehicleQrcode');
		Route::post('vehicle-setting-status', 'VehicleController@vehicleSettingStatus');
		Route::get('redirectsetting/{id}','VehicleController@redirectUrl');
		
		// Route::get('view-vehicle','VehicleController@viewVehicleAll');
		// Route::post('vehicle-table', 'VehicleController@vehicleTable');
		
		
	});
});

Route::get('/post','PostController@getpost');
Route::get('/create-post','PostController@createPost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
