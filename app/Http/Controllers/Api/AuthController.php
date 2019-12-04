<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Vehicle;
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
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
			'phone_no' => 'required|string',
			'image' => 'required|string'
        ]);

		$user_role_id = ($request->role_id) ? $request->role_id : 1;
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $user_role_id,
            'phone_no' => $request->phone_no,
            'image' => "userdefault.png",
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json(api_response(201,"Successfully created user!",$user));
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
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
			
            return response()->json(api_response(401,"Unauthorized",array()));
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json(api_response(201,"User login successfully",[
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]));
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
        return response()->json($request->user());
    }
	
	public function vehicle(Request $request)
    {
		$useruserVehicle = Vehicle::with('vehicle_setting')->where('user_id',$request->user()->_id)->get();
        return response()->json(api_response(201,"All vehicle",$useruserVehicle));
    }
	
	
	
	
	public function getRoles()
    {
        // return response()->json('roles roles');
		print_r('getRoles getRoles getRoles');
    }
	
	
}