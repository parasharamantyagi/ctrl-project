<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Vehicle;
use App\Role;
use App\VehicleMap;
use App\VehicleSetting;
use App\UserCoordinate;
// use App\UserVechileSetting;
use App\UserSetting;
use App\VehicleLogo;
use App\CreateNewCar;
use App\EntranceWestBuilding;
use App\LedExternalBoardid;
use App\VehicleLedMotorExcelSheet;
use App\VehicleLedSequenceConfig;
use App\VehicleEntranceWestBuilding;
use DB;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Vehicle as VehicleResource;
use App\Http\Resources\VehicleLogo as VehicleLogoResource;
use App\Http\Resources\VehicleSetting as VehicleSettingResource;


class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {

	  $user = array();
      $user = User::where('email',$request->email)->first();
      if($user)
      {
          return response()->json(api_response(0,"This email is taken by another account!",(object)array()));
        }else{
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
		
		$user_role_id = ($request->role_id) ? $request->role_id : strval(my_role(3));
		$phone_no = ($request->phone_no) ? $request->phone_no : '';
		$name = $request->first_name.' '.$request->last_name;
		
		if ($request->hasFile('image')) {  //check the file present or not
				   $image = $request->file('image'); //get the file
				   $namefile = 'profile-photo-' . rand(1,999999) .time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
				   $destinationPath = public_path('/assets/userimages'); //public path folder dir
				   $image->move($destinationPath, $namefile);  //mve to destination you mentioned 
				   // $imageName = $namefile;
			}else{
				   $namefile = 'userdefault.png';
		}
		
		$short_id = str_replace(' ', '', $name);
			$user_short_id = User::where('short_id','like','%'.$short_id.'%')->count();
				if($user_short_id){
					$short_id = $short_id.'_'.$user_short_id;
					// User::where('where',$user['_id'])->update(array('short_id'=>$short_id));
				}
				
        $user = new User([
            'name' => $name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role_id' => $user_role_id,
            'phone_no' => $phone_no,
			'short_id'=>$short_id,
			'driver_name'=>strtoupper($name),
            'image' => $namefile,
			'status' => "1",
            'password' => bcrypt($request->password)
        ]);
        $user->save();
		// $user_id = $user->_id;
		// $tokenResult = $user->createToken('Personal Access Token');
		// $token = $tokenResult->token;
		
		$user->access_token = $user->_id;
		$user->token_type = 'Bearer';
		$user->expires_at = Carbon::now()->toDateTimeString();
		$user->short_id = $short_id;
		$user->bought_car = 0;
		$user->setting_id = "";
		
        return response()->json(api_response(1,"Successfully created user!",$user));
      }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
		$bought_car = 0;
		$setting_id = '';
		if($request->input('social_type') == strtoupper('N'))
		{
			$request->validate([
				'email' => 'required|string',
				'password' => 'required|string',
				'remember_me' => 'boolean'
			]);
			$credentials_email = array('email'=>$request->input('email'),'password'=>$request->input('password'));
			$credentials_short_id = array('short_id'=>$request->input('email'),'password'=>$request->input('password'));
			
			if(filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
				Auth::attempt($credentials_email);
			}else{
				Auth::attempt($credentials_short_id);
			}
			if(!Auth::check())

				return response()->json(api_response(0,"Invalid email or password",(object)array()));
			$user = $request->user();
			// $tokenResult = $user->createToken('Personal Access Token');
			// print_r($tokenResult);
			// die;
			// $token = $tokenResult->token;
			// if ($request->remember_me)
				// $token->expires_at = Carbon::now()->addWeeks(1);
			// $token->save();
			$UserSetting_count = UserSetting::select('_id','setting_id')->where('user_id', $user['_id'])->first();
			if($UserSetting_count){
				$bought_car = 1;
				$setting_id = $UserSetting_count->setting_id;
			}
			
			if(empty($user['short_id'])){
			$short_id = str_replace(' ', '', $user['name']);
			$user_short_id = User::where('short_id','like','%'.$short_id.'%')->count();
				if($user_short_id){
					$short_id = $short_id.'_'.$user_short_id;
					User::where('where',$user['_id'])->update(array('short_id'=>$short_id));
				}
			}else{
				$short_id = $user['short_id'];
			}
				
			return response()->json(api_response(1,"User login successfully",[
				'access_token' => $user['_id'],
				'token_type' => 'Bearer',
				'expires_at' => Carbon::parse()->toDateTimeString(),
				'name'=> $user['name'],
				'first_name'=> $user['first_name'],
				'last_name'=> $user['last_name'],
				'email'=> $user['email'],
				'short_id'=> $short_id,
				'bought_car'=> $bought_car,
				'setting_id'=> $setting_id
			]));
		}else if(count($request->all()) === 6){

			$request->validate([
				'first_name' => 'required|string',
				'email' => 'required|string|email',
				'device_type' => 'required|string',
				'social_type' => 'required|string',
				'social_token' => 'required|string'
			]);

			$user = User::where('email', '=', $request->input('email'))->first();
			if($user)
			{
				$last_name = '';
				if($request->input('last_name')){
					$last_name = $request->input('last_name');
				}
				
				$full_name = trim($request->input('first_name').' '.$last_name);
				
				User::where('id', $user->_id)->update(array(
													'device_type'=>strtoupper($request->input('social_type')),
													'social_type'=>strtoupper($request->input('social_type')),
													'social_token'=>$request->input('social_token'),
													'name'=>$full_name,
													'short_id'=>str_replace(' ', '', $full_name),
													'first_name'=>$request->input('first_name'),
													'last_name'=>$last_name,
													'role_id'=>'5ded4c225da0ec557c6efdc2'
													));
				// $tokenResult = $user->createToken('Personal Access Token');
				// $token = $tokenResult->token;
				// $token->save();
				$UserSetting_count = UserSetting::select('_id','setting_id')->where('user_id', $user['_id'])->first();
				if($UserSetting_count){
					$bought_car = 1;
					$setting_id = $UserSetting_count->setting_id;
				}
				return response()->json(api_response(1,"User login successfully",[
					'access_token' => $user->_id,
					'token_type' => 'Bearer',
					'expires_at' => Carbon::parse()->toDateTimeString(),
					'name'=> $user->name,
					'first_name'=> $user->first_name,
					'last_name'=> $user->last_name,
					'email'=> $user->email,
					'short_id'=> $user->short_id,
					'bought_car'=> $bought_car,
					'setting_id'=> $setting_id
				]));
				
			}else{
				$insertData = $request->all();
				$namme = trim($insertData['first_name'].' '.$insertData['last_name']);
				$insertData['image'] = "userdefault.png";
				$insertData['role_id'] = my_role(3);
				$insertData['name'] = $namme;
				$insertData['short_id'] = str_replace(' ', '', $namme);
				$user_short_id = User::where('short_id','like','%'.$insertData['short_id'].'%')->count();
				if($user_short_id){
					$insertData['short_id'] = $insertData['short_id'].'_'.$user_short_id;
				}
				$insertData['driver_name'] = strtoupper($namme);
				$user_id = User::insertGetId($insertData);
				$user = User::find($user_id);
				// $tokenResult = $user->createToken('Personal Access Token');
				// $token = $tokenResult->token;
				// $token->save();
				$UserSetting_count = UserSetting::select('_id','setting_id')->where('user_id', $user['_id'])->first();
				if($UserSetting_count){
					$bought_car = 1;
					$setting_id = $UserSetting_count->setting_id;
				}
								
				return response()->json(api_response(1,"User login successfully",[
					'access_token' => $user->_id,
					'token_type' => 'Bearer',
					'expires_at' => Carbon::parse()->toDateTimeString(),
					'name'=> $user->name,
					'first_name'=> $user->first_name,
					'last_name'=> $user->last_name,
					'email'=> $user->email,
					'short_id'=> $user->short_id,
					'bought_car'=> $bought_car,
					'setting_id'=> $setting_id
				]));
			}
		}else{
			return response()->json(api_response(0,"Something went wrong",(object)array()));
		}
    }
	
	
	public function userShortId(Request $request)
	{
		// $user_id = $request->user()->_id;
		$user_id = $request->header('Authorization');
		$user = User::where('short_id',$request->short_id)->where('_id','!=',$user_id)->first();
		if($user)
		{
			$status = 0;
			$message = 'Sorry this is invalid short id';
			$user_array = array();
		}else{
			// User::updateOrCreate(array('_id' =>$user_id),array('short_id'=>$request->short_id));
			$userData = User::find($user_id);
			$userData->update(array('short_id'=>$request->short_id));
			$status = 1;
			$message = 'Short id update successfully';
			$userData->short_id = $request->short_id;
			$user_array = $userData;
		}
		// where('email',$request->email)->first();
		return response()->json(api_response($status,$message,$user_array));
		
	}

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
		// with('role')->
		$user_id = $request->header('Authorization');
		$user = User::find($user_id);
		if($user){
		$bought_car = 0;
		$setting_id = "";
		$userSetting = UserSetting::select('setting_id')->where(array('user_id' =>$user_id))->first();
		if($userSetting){
			$setting_id = $userSetting->setting_id;
			$bought_car = 1;
		}
		$status = 1;
		$message = "User detail";
		$userSetting_vechile = UserSetting::with('vehicle_info')->where('user_id',$user_id)->get();
		
		$mergeData = array();
		$mergeData['car'] = array();
		$mergeData['light_truck'] = array();
		$mergeData['heavy_truck'] = array();
		$mergeData['trailer'] = array();
		$mergeData['bus'] = array();
		$mergeData['aircraft'] = array();
		$mergeData['tram'] = array();
		$mergeData['crane'] = array();
		$mergeData['electric_loco'] = array();
		$mergeData['steam_loco'] = array();
		$mergeData['diesel_loco'] = array();
		
		$userSetting_vechile_array = (object)array();
		
		foreach($userSetting_vechile as $userSetting_vechile){
			
			$userSetting_vechile_array = $userSetting_vechile;
			$myCoordinate = UserCoordinate::where('user_id',$user_id)->where('vehicle_id',$userSetting_vechile_array->_id)->pluck('coordinate');
			if($myCoordinate)
			{
				$userSetting_vechile->coordinate = $myCoordinate;
			}else{
				$userSetting_vechile->coordinate = (object)array();
			}
			
			$userSetting_vechile_array->vechile_setting = new VehicleSettingResource($userSetting_vechile);
			$userSetting_vechile_array_vehicle_info = new VehicleResource($userSetting_vechile->vehicle_info);
			unset($userSetting_vechile->vehicle_info);
			
			$m_vehicle_id = $userSetting_vechile->vehicle_id;
			$createNewCar = CreateNewCar::select('excel_leds')->where('vehicle_id',$m_vehicle_id)->first();
			if($createNewCar){
				$userSetting_vechile_array->led_config = json_decode($createNewCar->excel_leds,true);
			}else{
				$userSetting_vechile_array->led_config = array();
			}
			$vehicleMap = VehicleMap::where('vehicle_id',$m_vehicle_id)->get();
			$userSetting_vechile_array->vehicle_map = $vehicleMap;
			
			$multimedia = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image','full_screen_movie_links','start_engine_sound','idle_motor_sound','acceleration_sound','deceleration_sound','gear_shift_sound_1','gear_shift_sound_2','shut_off_sound','blinkers_sound','horn_sound','car_button','train_button')->where('vehicle_id',$m_vehicle_id)->first();
			if($multimedia){
				$userSetting_vechile_array->multimedia = new VehicleLogoResource($multimedia);
			}else{
				$userSetting_vechile_array->multimedia = array(
														'_id'=>'','pad2_image'=>'','logo_image'=>'','icone_image'=>'','pad3_image'=>'',
														'blinkers_sound'=>'','full_screen_movie_links'=>'','acceleration_sound'=>'','deceleration_sound'=>'','gear_shift_sound_1'=>'',
														'gear_shift_sound_2'=>'','idle_motor_sound'=>'','shut_off_sound'=>'','start_engine_sound'=>'','car_button'=>[],'train_button'=>[]
								);
			}
			
			$userSetting_vechile_array->led_motor_config = $this->ledMotorFromUser($user_id,$m_vehicle_id);
			
			$entranceWestBuilding = VehicleEntranceWestBuilding::where('vehicle_id',$m_vehicle_id)->get();
			if($entranceWestBuilding){
				$userSetting_vechile_array->entrance_west_building = $entranceWestBuilding->toArray();
			}else{
				$userSetting_vechile_array->entrance_west_building = array();
			}
			// $userSetting_vechile_array->coordinate = $myCoordinate;
			foreach(vehicle_type() as $vehicle_types){
				if($vehicle_types == $userSetting_vechile_array_vehicle_info->vehicle_type){
					$userSetting_vechile_array->vehicle_info = $userSetting_vechile_array_vehicle_info;
					$mergeData[$vehicle_types][] = $userSetting_vechile_array;
				}
			}
		}
		// $myCoordinate = UserCoordinate::select('_id','vehicle_id','coordinate')->where('user_id',$user_id)->get();
		// VehicleEntranceWestBuilding
		// $entrance_west_building = EntranceWestBuilding::where('user_id',$user_id)->get();
		// $entrance_west_building = $this->ledMotorConfig_cordinate($entrance_west_building);
		$user_array = array_remove_null(array(
							'_id'=>$user->_id,'name'=>$user->name,'email'=>$user->email,'phone_no'=>$user->phone_no,'date_of_birth'=>$user->date_of_birth,
							'parent_first_name'=>$user->parent_first_name,'parent_last_name'=>$user->parent_last_name,
							'country'=>$user->country,'image'=>$user->image,'address'=>$user->address,'address_2'=>$user->address_2,'city'=>$user->city,
							'company_name'=>$user->company_name,'driver_name'=>$user->driver_name,'first_name'=>$user->first_name,'language'=>$user->language,'last_name'=>$user->last_name,
							'postal_code'=>$user->postal_code,'state'=>$user->state,'short_id'=>$user->short_id,'train_direction'=>$user->train_direction,'setting_id'=>$setting_id,'bought_car'=>$bought_car,
							'vehicle_type'=>$mergeData
						));
		}else{
			$status = 0;
			$message = "No user found";
			$user_array = array();
		}
        return response()->json(api_response($status,$message,$user_array));
    }

	public function userUpdate(Request $request)
	{
		$user = User::find($request->header('Authorization'));
		if($request->input('first_name') && !empty($request->input('first_name')))
			$user->first_name = $request->input('first_name');
		if($request->input('last_name') && !empty($request->input('last_name')))
			$user->last_name = $request->input('last_name');
		if($request->input('country') && !empty($request->input('country')))
			$user->country = $request->input('country');
		if($request->input('driver_name') && !empty($request->input('driver_name')))
			$user->driver_name = $request->input('driver_name');
		if($request->input('short_id') && !empty($request->input('short_id')))
			$user->short_id = $request->input('short_id');
		if($request->input('address') && !empty($request->input('address')))
			$user->address = $request->input('address');
		if($request->input('address_2') && !empty($request->input('address_2')))
			$user->address_2 = $request->input('address_2');
		if($request->input('company_name') && !empty($request->input('company_name')))
			$user->company_name = $request->input('company_name');
		if($request->input('city') && !empty($request->input('city')))
			$user->city = $request->input('city');
		if($request->input('postal_code') && !empty($request->input('postal_code')))
			$user->postal_code = $request->input('postal_code');
		if($request->input('language') && !empty($request->input('language')))
			$user->language = $request->input('language');
		if($request->input('state') && !empty($request->input('state')))
			$user->state = $request->input('state');
		if($request->input('date_of_birth') && !empty($request->input('date_of_birth')))
			$user->date_of_birth = $request->input('date_of_birth');
		if($request->input('parent_first_name') && !empty($request->input('parent_first_name')))
			$user->parent_first_name = $request->input('parent_first_name');
		if($request->input('parent_last_name') && !empty($request->input('parent_last_name')))
			$user->parent_last_name = $request->input('parent_last_name');
		if($request->input('train_direction') && !empty($request->input('train_direction')))
			$user->train_direction = $request->input('train_direction');
		$user->save();
		
		$setting_id = "";
		$userSetting = UserSetting::select('setting_id')->where(array('user_id' =>$user->_id))->first();
		if($userSetting){
			$setting_id = $userSetting->setting_id;
		}
		
		$user_array = array_remove_null(array(
							'_id'=>$user->_id,'name'=>$user->name,'email'=>$user->email,'phone_no'=>$user->phone_no,'date_of_birth'=>$user->date_of_birth,
							'parent_first_name'=>$user->parent_first_name,'parent_last_name'=>$user->parent_last_name,
							'country'=>$user->country,'image'=>$user->image,'address'=>$user->address,'address_2'=>$user->address_2,'city'=>$user->city,
							'company_name'=>$user->company_name,'driver_name'=>$user->driver_name,'first_name'=>$user->first_name,'language'=>$user->language,'last_name'=>$user->last_name,
							'postal_code'=>$user->postal_code,'state'=>$user->state,'short_id'=>$user->short_id,'setting_id'=>$setting_id,'train_direction'=>$user->train_direction
						));
		return response()->json(api_response(1,"User update successfully",$user_array));
	}

	public function myCoordinates(Request $request)
    {
		$user_id = $request->header('Authorization');
		if($request->vehicle_id && $request->coordinate){
			$vehicle_id = $request->vehicle_id;
			$coordinate = $request->coordinate;
			UserCoordinate::updateOrCreate(array('user_id' =>$user_id,'vehicle_id' =>$vehicle_id),array("coordinate"=>$coordinate));
			return response()->json(api_response(1,"Coordinates set successfully",$coordinate));
		}else{
			$myCoordinate = UserCoordinate::where('user_id',$user_id)->get();
			// array('user_id' =>$user_id,'vehicle_id' =>$vehicle_id),$coordinate
			return response()->json(api_response(1,"My Coordinates",$myCoordinate));
		}
		
    }
	
	public function vehicle(Request $request)
    {
		if($request->input('search'))
		{
				$search = $request->input('search');
					$useruserVehicles = Vehicle::with(array('vehicle_setting'=>function($myQuery){
						return $myQuery->select('_id','vehicle_id');
					}))->where('user_id',$request->user()->_id)->where(function($query) use($search) {
							$query->where('brand', 'LIKE',"%{$search}%")->orWhere('model_spec', 'LIKE',"%{$search}%");
					})->get();

		}else{
					$useruserVehicles = Vehicle::all()->filter(function ($post) {
											return $post->user_id > 3;
										});
					
				
		}
		
        return response()->json(api_response(1,"All vehicle",$useruserVehicles));
    }
	
	public function vehicleSettingbyId(Request $request, $id){
		$user_id = $request->header('Authorization');
		
				// $vehicleSetting = VehicleSetting::where('_id',$id)->orWhere('bar_code_id',(int)$id)->first();
				
				$vehicleSetting = UserSetting::with('vehicle_info')->find($id);
				
				// $myVehicle = Vehicle::find($vehicleSetting->vehicle_id);
				$myVehicle = new VehicleResource($vehicleSetting->vehicle_info);
				
				$sequences = array("sequences"=>array());
				$createNewCar = CreateNewCar::select('data_leds','excel_leds')->where('vehicle_id',$vehicleSetting->vehicle_id)->first();
				if($createNewCar){
					$sequences = json_decode($createNewCar->excel_leds,true);
				}
				$multimedia = array();
				$vehicleLogo = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image','full_screen_movie_links','start_engine_sound','idle_motor_sound','acceleration_sound','deceleration_sound','gear_shift_sound_1','gear_shift_sound_2','shut_off_sound','blinkers_sound','horn_sound','car_button','train_button')->where('vehicle_id',$vehicleSetting->vehicle_id)->first();
				if($vehicleLogo){
					$multimedia = new VehicleLogoResource($vehicleLogo);
				}
				$my_vehicleSetting = array(
											'vehicle_info'=>$myVehicle,
											'vehicle_setting'=>$vehicleSetting,
											'led_config'=>$sequences,
											'multimedia'=>$multimedia
										);
				$status = 1;
				$message = "my vehicle setting";
			
		return response()->json(api_response($status,$message,$my_vehicleSetting));
		
	}
	
	public function vehicleSetting(Request $request, $id)
    {
			// $user_id = $request->user()->_id;
			$user_id = $request->header('Authorization');
			// $UserSetting_vechile = UserSetting::where('user_id',$user_id)->where('setting_id',$id)->first();
			// if($UserSetting_vechile){
				// $vehicleSetting = new VehicleSettingResource($UserSetting_vechile);
				// $vehicleSetting->setting_status = "1";
			// }else{
				$vehicleSetting = VehicleSetting::with('getvehicle')->where('_id',$id)->orWhere('bar_code_id',(int)$id)->first();
				
				// print_r($vehicleSetting);
				// die;
				
				$vehicleSetting->user_id = $user_id;
				// $vehicleSetting->vehicle_id = $vehicleSetting->vehicle_id;
				// $vehicleSetting->setting_id = $id;
				$vehicleSetting = new VehicleSettingResource($vehicleSetting);
				
				if($vehicleSetting){
					$userSetting = json_decode(json_encode($vehicleSetting, true), true);
					unset($userSetting['_id']);
					unset($userSetting['id']);
					unset($userSetting['updated_at']);
					unset($userSetting['created_at']);
					$userSetting['user_id'] = $user_id;
					// $userSetting['vehicle_id'] = $vehicleSetting->vehicle_id;
					$userSetting['setting_id'] = $id;
					// UserSetting::updateOrCreate(array('user_id' =>$user_id,'setting_id' =>$id),$userSetting);
					$userSetting_id = UserSetting::insertGetId($userSetting);
					$userSetting['_id'] = strval($userSetting_id);
					
					
				// $userSetting_iddddd = UserSetting::find('60be536a1d913e31427f2003');
				
				// print_r($userSetting);
				// die;
				}
			// }
			
			
			
			// if($vehicleSetting && $vehicleSetting->setting_status === "1") {
				VehicleSetting::where('_id',$id)->update(array("setting_use_status"=>"1"));
				
				// $myVehicle = Vehicle::find($vehicleSetting->vehicle_id);
				$myVehicle = new VehicleResource($vehicleSetting->getvehicle);
				
				$sequences = array("sequences"=>array());
				$createNewCar = CreateNewCar::select('data_leds','excel_leds')->where('vehicle_id',$vehicleSetting->vehicle_id)->first();
				if($createNewCar){
					$sequences = json_decode($createNewCar->excel_leds,true);
				}
				$multimedia = array();
				$vehicleLogo = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image','full_screen_movie_links','start_engine_sound','idle_motor_sound','acceleration_sound','deceleration_sound','gear_shift_sound_1','gear_shift_sound_2','shut_off_sound','blinkers_sound','horn_sound','car_button','train_button')->where('vehicle_id',$vehicleSetting->vehicle_id)->first();
				if($vehicleLogo){
					$multimedia = new VehicleLogoResource($vehicleLogo);
				}
				$my_vehicleSetting = array(
											'vehicle_info'=>$myVehicle,
											'vehicle_setting'=>$userSetting,
											'led_config'=>$sequences,
											'multimedia'=>$multimedia
										);
				$status = 1;
				$message = "my vehicle setting";
			// } else {
				// $status = 0;
				// $my_vehicleSetting = array();
				// $message = "You can't access this setting";
			// }
		return response()->json(api_response($status,$message,$my_vehicleSetting));
    }
	
	public function vehicleSettingUpdate(Request $request, $id)
    {
		// $user_id = $request->user()->_id;
		$user_id = $request->header('Authorization');
		$inputRequest = $request->all();
		
		$vehicleAllInfo = UserSetting::with('vehicle_info')->find($id);
		
		// UserSetting::with('vehicle_info')
		
		// $vehicleAllInfo = VehicleSetting::with('getvehicle')->where('_id',$resultMyS->setting_id)->first();
		// print_r($vehicleAllInfo);
		// die;
		
		$userVechile = $inputRequest;
		$vehicleAllInfo_data = array();
		$sequences = array("sequences"=>array());
		$multimedia = array();
		if($vehicleAllInfo->vehicle_info){
			$userVechile = array_filter($userVechile);
			// array('user_id' =>$user_id,'_id' =>$id),$userVechile
			// $resultMy = UserSetting::where('_id',$id)->update($userVechile);
			
			
			
			// $resultMy = UserSetting::updateOrCreate(array('user_id' =>$user_id,'_id' =>$id),$userVechile);
			UserSetting::where('_id',$id)->update($userVechile);
			$resultMy = UserSetting::find($id);
			$resultMy = new VehicleSettingResource($resultMy);
			
			// vehicle_id
			// print_r($resultMy);
			// die;
			
			
			// print_r($resultMy);
			// die;
			
			$vehicleAllInfo_data = $vehicleAllInfo->vehicle_info;
			$vehicleAllInfo_data = new VehicleResource($vehicleAllInfo_data);
			
			
			
			$createNewCar = CreateNewCar::select('data_leds','excel_leds')->where('vehicle_id',$vehicleAllInfo->vehicle_info->_id)->first();
				if($createNewCar){
					$sequences = json_decode($createNewCar->excel_leds,true);
				}
			
			
			
			$vehicleLogo = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image','start_engine_sound','idle_motor_sound','acceleration_sound','deceleration_sound','gear_shift_sound_1','gear_shift_sound_2','shut_off_sound','blinkers_sound','car_button','train_button')->where('vehicle_id',$vehicleAllInfo->vehicle_info->_id)->first();
				if($vehicleLogo){
					$multimedia = new VehicleLogoResource($vehicleLogo);
				}
			// print_r($multimedia);
			// die;
		}		
		$status = 1;
		$message = "Setting update successfully";
		$my_vehicleSetting = array('vehicle_info'=>$vehicleAllInfo_data,'vehicle_setting'=>$resultMy,'led_config'=>$sequences,'multimedia'=>$multimedia);
		return response()->json(api_response($status,$message,$my_vehicleSetting));
	}
	
	public function typeChange($data,$type){
		if($type == 'setting'){
			$data->front_motor_resistor_value = (int)$data->front_motor_resistor_value;
			$data->rear_motor_resistor_value = (int)$data->rear_motor_resistor_value;
			$data->front_motor_off_ms = (int)$data->front_motor_off_ms;
			$data->rear_motor_off_ms = (int)$data->rear_motor_off_ms;
			$data->gearbox_amount_of_gears = (int)$data->gearbox_amount_of_gears;
			$data->motor_trim_kit = (int)$data->motor_trim_kit;
			$data->upper_gear_shift_value = (int)$data->upper_gear_shift_value;
			$data->steer_angle_limit_per_100_ms = $data->steer_angle_limit_per_100_ms;
			$data->shift_value_race = (int)$data->shift_value_race;
			$data->lower_gear_shift_value = (int)$data->lower_gear_shift_value;
			$data->gear_shift_a_rpm_value = (int)$data->gear_shift_a_rpm_value;
			$data->max_steering_angle = floatval($data->max_steering_angle);
			$data->gear_shift_a_value = (int)$data->gear_shift_a_value;
			$data->gear_shift_b_value = (int)$data->gear_shift_b_value;
			$data->motor_steps_for_max_steering = "0";
			return $data;
		}else if($type == 'vechile'){
			$data->release_year = (int)$data->release_year;
			$data->horse_power = (int)$data->horse_power;
			$data->torque = (int)$data->torque;
			$data->km_h_0_100 = floatval($data->km_h_0_100);
			$data->km_h_0_160 = floatval($data->km_h_0_160);
			$data->deceleration_speed = (int)$data->deceleration_speed;
			$data->distance = (int)$data->distance;
			$data->weight = (int)$data->weight;
			$data->max_weight = (int)$data->max_weight;
			$data->lenght = (int)$data->lenght;
			$data->length_front_of_car = (int)$data->length_front_of_car;
			$data->wheelbase = (int)$data->wheelbase;
			$data->track_width = (int)$data->track_width;
			$data->width = (int)$data->width;
			$data->wheel_diameter = floatval($data->wheel_diameter);
			$data->height = (int)$data->height;
			$data->max_rpm = (int)$data->max_rpm;
			$data->idle_rpm = (int)$data->idle_rpm;
			$data->gearbox_amount_of_gears = (int)$data->gearbox_amount_of_gears;
			$data->config_url = 'get-config/'.$data->_id;
			return $data;
		}
	}
	
	public function vehicleSettingWithoutLogin($id)
    {
			
			$vehicleSetting = VehicleSetting::where('_id',$id)->orWhere('bar_code_id',(int)$id)->first();
			// if($vehicleSetting){
				// $userSetting = $vehicleSetting->toArray();
				// unset($userSetting['_id']);
				// unset($userSetting['id']);
				// $userSetting['vehicle_id'] = $vehicleSetting->vehicle_id;
				// $userSetting['setting_id'] = $id;
			// }
		
			if($vehicleSetting && $vehicleSetting->setting_status === "1") {
				// VehicleSetting::where('_id',$id)->update(array("setting_use_status"=>"1"));
				
				$vehicleSetting = $this->typeChange($vehicleSetting,'setting');
				
				$myVehicle = Vehicle::find($vehicleSetting->vehicle_id);
				
				$myVehicle = $this->typeChange($myVehicle,'vechile');
				
				$sequences = array("sequences"=>array());
				$createNewCar = CreateNewCar::select('data_leds','excel_leds')->where('vehicle_id',$vehicleSetting->vehicle_id)->first();
				if($createNewCar){
					$sequences = json_decode($createNewCar->excel_leds,true);
					// $sequences['options']['blinkers_override_l'] = explode(",",$sequences['options']['blinkers_override_l']);
					// $sequences['options']['blinkers_override_r'] = explode(",",$sequences['options']['blinkers_override_r']);
				}
				$multimedia = array();
				$vehicleLogo = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image','full_screen_movie_links','start_engine_sound','idle_motor_sound','acceleration_sound','deceleration_sound','gear_shift_sound_1','gear_shift_sound_2','shut_off_sound','blinkers_sound','car_button','train_button')->where('vehicle_id',$vehicleSetting->vehicle_id)->first();
				if($vehicleLogo){
					$multimedia = $vehicleLogo;
				}
				$my_vehicleSetting = array(
											'vehicle_info'=>array_remove_null($myVehicle->toArray()),
											'vehicle_setting'=>array_remove_null($vehicleSetting->toArray()),
											'led_config'=>$sequences,
											'multimedia'=>$multimedia
										);
				$status = 1;
				$message = "my vehicle setting";
			} else {
				$status = 0;
				$my_vehicleSetting = array();
				$message = "You can't access this setting";
			}
		return response()->json(api_response($status,$message,$my_vehicleSetting));
		
	}
	
	public function getConfig($id)
    {
		$myVehicle = CreateNewCar::where('vehicle_id',$id)->first();
		if($myVehicle){
			$status = 1;
			$message = "Config leds data";
			$excel_leds_decode = json_decode($myVehicle->excel_leds);
		}else{
			$status = 0;
			$message = "No config leds";
			$excel_leds_decode = array();
		}
		return response()->json($excel_leds_decode);
	}
	
	
	public function ledMotorFromUser($user_id, $id)
    {
		try{
			// $user_id = $request->header('Authorization');
			$entrance_west_buildings = EntranceWestBuilding::where('user_id',$user_id)->where('vehicle_id',$id)->get();
			if($entrance_west_buildings){
				$entrance_west_building = VehicleEntranceWestBuilding::where('vehicle_id',$id)->where('is_copy','1')->get();
				$ledExternal = VehicleLedSequenceConfig::select('excel_leds')->where('vehicle_id',$id)->first();
				$ledMotor = VehicleLedMotorExcelSheet::select('excel_leds')->where('vehicle_id',$id)->first();
				$ledExternals = $this->ledMotorConfig_cordinate($entrance_west_building,$ledExternal,$ledMotor);
				return $ledExternals;
				// return response()->json(api_response(1,"led motor config",$ledExternals));
			}else{
				return array();
				// return response()->json(api_response(0,"No led motor config",array()));
			}
		}catch(\Exception $e){
			return array();
            // return response()->json(api_response(0,"invalid",$e->getMessage()));
        }
    }
	
	public function ledMotorConfig(Request $request, $id)
    {
		try{
			$user_id = $request->header('Authorization');
			$entrance_west_buildings = EntranceWestBuilding::where('user_id',$user_id)->where('vehicle_id',$id)->get();
			if($entrance_west_buildings){
				$entrance_west_building = VehicleEntranceWestBuilding::where('vehicle_id',$id)->where('is_copy','1')->get();
				$ledExternal = VehicleLedSequenceConfig::select('excel_leds')->where('vehicle_id',$id)->first();
				$ledMotor = VehicleLedMotorExcelSheet::select('excel_leds')->where('vehicle_id',$id)->first();
				$ledExternals = $this->ledMotorConfig_cordinate($entrance_west_building,$ledExternal,$ledMotor);
				return response()->json(api_response(1,"led motor config",$ledExternals));
			}else{
				return response()->json(api_response(0,"No led motor config",array()));
			}
		}catch(\Exception $e){
            return response()->json(api_response(0,"invalid",$e->getMessage()));
        }
    }
	
	public function get_pin_from_bit($button_title,$ledExternal){
		$values = array();
		if($ledExternal){
			$excel_led = $ledExternal->excel_leds;
			$key = array_search($button_title, array_column($excel_led, 'name'));
			if(is_numeric($key)){
				$values = array(
							'BoardID'=>$excel_led[$key]['board'],'DriverID'=>$excel_led[$key]['driver'],
							'TypeID'=>$excel_led[$key]['type'],'sequence'=>$excel_led[$key]['sequence']
					);
			}
		}
		return $values;
	}
	
	public function get_ledMotor_excel($button_title,$ledExternal){
		$values = array();
		if($ledExternal){
			$excel_led = $ledExternal->excel_leds;
			$key = array_search($button_title, array_column($excel_led, 0));
			if(is_numeric($key)){
				$values = array(
					'BoardID'=>$excel_led[$key][1],'DriverID'=>$excel_led[$key][2],
					'TypeID'=>$excel_led[$key][3],'Gear_ratio'=>$excel_led[$key][4],
					'mode'=>$excel_led[$key][5]
				);
				if(array_key_exists(6,$excel_led[$key])){
					$values['on_mode_val_1'] = is_null($excel_led[$key][6]) ? '' : $excel_led[$key][6];
				}
				if(array_key_exists(7,$excel_led[$key])){
					$values['on_mode_unit_1'] = is_null($excel_led[$key][7]) ? '' : $excel_led[$key][7];
				}
				if(array_key_exists(8,$excel_led[$key])){
					$values['on_mode_val_2'] = is_null($excel_led[$key][8]) ? '' : $excel_led[$key][8];
				}
				if(array_key_exists(9,$excel_led[$key])){
					$values['on_mode_unit_2'] = is_null($excel_led[$key][9]) ? '' : $excel_led[$key][9];
				}
				if(array_key_exists(10,$excel_led[$key])){
					$values['off_mode_val_1'] = is_null($excel_led[$key][10]) ? '' : $excel_led[$key][10];
				}
				if(array_key_exists(11,$excel_led[$key])){
					$values['off_mode_unit_1'] = is_null($excel_led[$key][11]) ? '' : $excel_led[$key][11];
				}
				if(array_key_exists(12,$excel_led[$key])){
					$values['off_mode_val_2'] = is_null($excel_led[$key][12]) ? '' : $excel_led[$key][12];
				}
				if(array_key_exists(13,$excel_led[$key])){
					$values['off_mode_unit_2'] = is_null($excel_led[$key][13]) ? '' : $excel_led[$key][13];
				}
			}
		}
		return $values;
	}
	
	
	
	
	public function ledMotorConfig_cordinate($inputs,$ledExternal,$ledMotor)
    {
		$result = array();
		if($inputs){
			foreach($inputs as $input){
				$number = (int)ltrim($input->sequence_key, 'LED_SEQUENCE_') - 1;
				$ave_num = $number % 12;
				$input->cordinate_of_x = $ave_num * 220;
				$input->is_switch_on = 0;
				$input->is_switch_off = 0;
				if($input->on_mode_image && $input->on_mode_image == "assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_12.png"){
					$input->is_switch_on = 1;
				}
				if($input->off_mode_image && $input->off_mode_image == "assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_12.png"){
					$input->is_switch_off = 1;
				}
				
				$ave_num_2 = floor($number / 12);
				$input->cordinate_of_y = $ave_num_2 * 140;
				if($input->select_button_type == "led"){
					$ledMotor_excel = $this->get_pin_from_bit($input->button_title,$ledExternal);
					$input->led_sequence_config = $ledMotor_excel;
					// $input->BoardID = $ledMotor_excel['BoardID'];
					// $input->DriverID = $ledMotor_excel['DriverID'];
					// $input->TypeID = $ledMotor_excel['TypeID'];
					// $input->sequence = $ledMotor_excel['sequence'];
				}else if($input->select_button_type == "motor"){
					$ledMotor_excel = $this->get_ledMotor_excel($input->button_title,$ledMotor);
					$input->led_motor_excel = $ledMotor_excel;
					// $input->BoardID = $ledMotor_excel['BoardID'];
					// $input->DriverID = $ledMotor_excel['DriverID'];
					// $input->TypeID = $ledMotor_excel['TypeID'];
					// $input->Gear_ratio = $ledMotor_excel['Gear_ratio'];
					// $input->mode = $ledMotor_excel['mode'];
				}
				$result[] = $input;
			}
		}
		return $result;
    }

	public function vehicleById($id)
	{
		$myVehicle = VehicleSetting::with('getvehicle')->where('user_id','5e09c3575da0ec68223e14e2')->orWhere('from_id','5e09c3575da0ec68223e14e2')->where('setting_use_status','1')->get();
		// 
		// $myVehicle = Vehicle::with('vehicle_setting')->get();
		return response()->json(api_response(1,"my vehicle setting",$myVehicle));
		// print_r($myVehicle);
	}





	public function getRoles()
    {
        // return response()->json('roles roles');
		print_r('getRoles getRoles getRoles');
    }


}
