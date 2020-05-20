<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Role;
use App\Vehicle;
use App\VehicleSetting;
use QrCode;


class ApiController extends Controller
{
	
	public function myuserdata()
	{
		$inputData = User::first();
		return response()->json($inputData);
	}
	
	public function allRoles()
    {
		$inputData = Role::all();
		return response()->json($inputData);
    }
	
	public function addRoles(Request $request)
	{
		$inputData = $request->all();
		Role::insert($inputData);
		return response()->json($inputData);
	}
	
	public function updateUser(Request $request)
	{
		$inputData = $request->all();
		$user_id = array('_id'=>$inputData['user_id']);
		unset($inputData['user_id']);
		User::where($user_id)->update($inputData);
		return response()->json($inputData);
	}
	
	public function vehicleAll()
	{
		$allvehicle = Vehicle::all();
		return response()->json($allvehicle, 201);
	}
	
	public function vehicleAllId(Request $request)
	{
		$vehicle_id = $request->input('vehicle_id');
		$allvehicle = Vehicle::where('_id',$vehicle_id)->get();
		return response()->json($allvehicle, 201);
	}
	
	public function settingAll(Request $request)
	{
		$inputData = VehicleSetting::with('getvehicle')->get()->toArray();
		// $vehicle_id = $request->input('vehicle_id');
		// $vehicleSetting = VehicleSetting::with('getvehicle')->get();
		return response()->json(api_response(200,"vechile data",$inputData));
		// print_r($inputData);
	}
	public function testing(Request $request)
	{
		$inputData = $request->all();
		$bar_code_id = rand(111111,999999);
		VehicleSetting::where('_id', $request->input('id'))->update(array("bar_code_id"=>$bar_code_id));
		print_r($inputData);
		// $vichleSetting_text = (string)$inputData['id'];
		// QrCode::encoding('UTF-8')->format('png')->margin(1)->size(220)->generate($vichleSetting_text, public_path('qrcode/'.$inputData['id'].'png'));
		// pr($inputData);
		// VehicleSetting::where('setting_status','1')->update(array('setting_use_status'=>'0'));
		// echo 'testing testing';
		// $vehicle_id = $request->input('vehicle_id');
		// $vehicleSetting = Vehicle::with('vehicle_setting')->get();
		// return response()->json(api_response(200,"vechile data",$vehicleSetting));
	}
	
	
	
}



