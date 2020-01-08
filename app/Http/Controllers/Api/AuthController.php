<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Vehicle;
use App\Role;
use App\VehicleSetting;


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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
		
		$user_role_id = ($request->role_id) ? $request->role_id : strval(my_role(3));
		$phone_no = ($request->phone_no) ? $request->phone_no : '';
		
		if ($request->hasFile('image')) {  //check the file present or not
				   $image = $request->file('image'); //get the file
				   $namefile = 'profile-photo-' . rand(1,999999) .time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
				   $destinationPath = public_path('/assets/userimages'); //public path folder dir
				   $image->move($destinationPath, $namefile);  //mve to destination you mentioned 
				   // $imageName = $namefile;
			}else{
				   $namefile = 'userdefault.png';
		}
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $user_role_id,
            'phone_no' => $phone_no,
            'image' => $namefile,
			'status' => "1",
            'password' => bcrypt($request->password)
        ]);
        $user->save();
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
		if($request->input('social_type') == strtoupper('N'))
		{
			$request->validate([
				'email' => 'required|string|email',
				'password' => 'required|string',
				'remember_me' => 'boolean'
			]);
			$credentials = request(['email', 'password']);
			if(!Auth::attempt($credentials))

				return response()->json(api_response(0,"Invalid email or password",(object)array()));
			$user = $request->user();
			$tokenResult = $user->createToken('Personal Access Token');
			$token = $tokenResult->token;
			if ($request->remember_me)
				$token->expires_at = Carbon::now()->addWeeks(1);
			$token->save();
			return response()->json(api_response(1,"User login successfully",[
				'access_token' => $tokenResult->accessToken,
				'token_type' => 'Bearer',
				'expires_at' => Carbon::parse(
					$tokenResult->token->expires_at
				)->toDateTimeString(),
				'name'=> $user['name'],
				'email'=> $user['email']
			]));
		}else if(count(array_filter($request->all())) === 5){

			$request->validate([
				'name' => 'required|string',
				'email' => 'required|string|email',
				'device_type' => 'required|string',
				'social_type' => 'required|string',
				'social_token' => 'required|string'
			]);

			$user = User::where('email', '=', $request->input('email'))->first();
			if($user)
			{
				User::where('id', $user->_id)->update(array(
													'device_type'=>strtoupper($request->input('social_type')),
													'social_type'=>strtoupper($request->input('social_type')),
													'social_token'=>$request->input('social_token'),
													'name'=>$request->input('name'),
													'role_id'=>'5ded4c225da0ec557c6efdc2'
													));
				$tokenResult = $user->createToken('Personal Access Token');
				$token = $tokenResult->token;
				$token->save();
				return response()->json(api_response(1,"User login successfully",[
					'access_token' => $tokenResult->accessToken,
					'token_type' => 'Bearer',
					'expires_at' => Carbon::parse(
						$tokenResult->token->expires_at
					)->toDateTimeString(),
					'name'=> $user->name,
					'email'=> $user->email
				]));
			}else{
				$insertData = $request->all();
				$insertData['role_id'] = '5ded4c225da0ec557c6efdc2';
				$user_id = User::insertGetId($insertData);
				$user = User::find($user_id);
				$tokenResult = $user->createToken('Personal Access Token');
				$token = $tokenResult->token;
				$token->save();
				return response()->json(api_response(1,"User login successfully",[
					'access_token' => $tokenResult->accessToken,
					'token_type' => 'Bearer',
					'expires_at' => Carbon::parse(
						$tokenResult->token->expires_at
					)->toDateTimeString(),
					'name'=> $user->name,
					'email'=> $user->email
				]));
			}
		}else{
			return response()->json(api_response(0,"This is invalid entry",(object)array()));
		}
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
		$user_id = $request->user()->_id;
		$userData = User::with('role')->where('_id',$user_id)->first();
        return response()->json($userData);
    }

	public function userUpdate(Request $request)
	{
		$user = $request->user();
		if($request->input('name'))
			$user->name = $request->input('name');
		if($request->input('phone_no'))
			$user->phone_no = $request->input('phone_no');
		if($request->input('image'))
			$user->image = $request->input('image');

		$user->save();
		return response()->json(api_response(1,"User update successfully",$user));
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
					$useruserVehicles = Vehicle::with(array('vehicle_setting'=>function($myQuery){
						return $myQuery->select('_id','vehicle_id');
					}))->where('user_id',$request->user()->_id)->get();
		}
		if($useruserVehicles->toArray())
			foreach($useruserVehicles as $vehicle_settings) {
				  $vehicle_settings1 = $vehicle_settings;
				  $my_vehicle_setting_array = $vehicle_settings->vehicle_setting;
				  unset($vehicle_settings->vehicle_setting);
				  $my_vehicle_setting = array();
				  foreach($my_vehicle_setting_array as $vehicle_setting)
					{
						$vehicle_setting['qr_code'] = url('public/qrcode/'.$vehicle_setting->_id.'png');
						$my_vehicle_setting[] = $vehicle_setting;
					}
				  
				  $vehicle_settings1['vehicle_setting'] = $my_vehicle_setting;
		   
				  $useruserVehicle[] = $vehicle_settings1;
			  }
		else
			$useruserVehicle = (object)array();
		
        return response()->json(api_response(1,"All vehicle",$useruserVehicle));
    }


	public function vehicleSetting($id)
    {
		$vehicleSetting = VehicleSetting::find($id);
		$myVehicle = Vehicle::select('model_spec','moter_type','torque','manufacturer')->find($vehicleSetting->vehicle_id);
		$myVehicle->vehicle_setting = $vehicleSetting;
		return response()->json(api_response(1,"my vehicle setting",$myVehicle));
    }






	public function getRoles()
    {
        // return response()->json('roles roles');
		print_r('getRoles getRoles getRoles');
    }


}
