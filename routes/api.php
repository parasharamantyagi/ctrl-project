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

Route::get('vehicle-setting/{id}','Api\AuthController@vehicleSettingWithoutLogin');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
        Route::post('user-short-id', 'Api\AuthController@userShortId');
		Route::post('vehicle', 'Api\AuthController@vehicle');
		Route::post('userupdate','Api\AuthController@userUpdate');
		Route::get('vehicle-setting/{id}','Api\AuthController@vehicleSetting');
		Route::post('vehicle-setting/{id}','Api\AuthController@vehicleSettingUpdate');
    });
});


Route::get('get-config/{id}','Api\AuthController@getConfig');

Route::get('vehicle/{id}','Api\AuthController@vehicleById');

Route::get('roles','Api\ApiController@allRoles');
Route::post('testing','Api\ApiController@testing');

Route::post('roles','Api\ApiController@addRoles');

Route::get('mytest','Api\MyApiController@getMyPost');
Route::post('mytest-search','Api\MyApiController@getMyPostSearch');
Route::post('mytest','Api\MyApiController@addMyPost');


// Route::get('my-user-data','Api\ApiController@myuserdata');
// Route::get('getroles','Api\ApiController@getRoles');
// Route::get('vehicle','Api\ApiController@vehicleAll');
Route::post('setting','Api\ApiController@settingAll');

