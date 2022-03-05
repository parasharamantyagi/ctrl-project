<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
    // return $request->user();
// });



Route::group(['prefix' => 'auth','namespace' => 'Api'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    // Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::post('user-short-id', 'AuthController@userShortId');
		Route::post('vehicle', 'AuthController@vehicle');
		Route::post('userupdate','AuthController@userUpdate');
		Route::get('vehicle-setting/{id}','AuthController@vehicleSetting');
		Route::get('led-motor-config/{id}','AuthController@ledMotorConfig');
		Route::post('vehicle-setting/{id}','AuthController@vehicleSettingUpdate');
		Route::get('vehicle-setting-byId/{id}','AuthController@vehicleSettingbyId');
		
		Route::post('my-coordinate', 'AuthController@myCoordinates');
    // });
});


Route::group(['namespace' => 'Api'], function(){
	Route::get('vehicle-setting/{id}','AuthController@vehicleSettingWithoutLogin');
	Route::get('get-config/{id}','AuthController@getConfig');
	Route::get('vehicle/{id}','AuthController@vehicleById');
	
	Route::get('roles','ApiController@allRoles');
	Route::post('testing','ApiController@testing');
	Route::post('roles','ApiController@addRoles');
	Route::post('setting','ApiController@settingAll');
	
	Route::get('mytest','MyApiController@getMyPost');
	Route::post('mytest-search','MyApiController@getMyPostSearch');
	Route::post('mytest','MyApiController@addMyPost');
});

Route::post('user-setting','Api\ApiController@userSetting');



Route::post('password','Api\ApiController@password');
// Route::get('getroles','Api\ApiController@getRoles');
// Route::get('vehicle','Api\ApiController@vehicleAll');


