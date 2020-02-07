<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Vehicle;
use App\VehicleSetting;


class MyApiController extends Controller
{
	
	public function getMyPost()
	{
		$inputData = VehicleSetting::all();
		// foreach($inputData as $inputDatad)
		// {
			// $inputDatad['setting_art_no'] = car_model(Vehicle::find($inputDatad->vehicle_id)->model);
			// VehicleSetting::where('_id',$inputDatad->_id)->update(array('setting_art_no'=>$inputDatad['setting_art_no']));
			// $inputDatads[] = $inputDatad;
		// }
		return response()->json(api_response(1,"Successfully created user!",$inputData));
		// print_r($inputData);
	}
	
	public function addMyPost(Request $request)
	{
		$inputData = $request->all();
		$myId = $request->input('id');
		unset($inputData['id']);
		$reault = Post::updateOrCreate(array('_id' => $myId),$inputData);
		pr($reault->toArray());
	}
	
	public function getMyPostSearch(Request $request)
	{
		$reault = Post::where('title',$request->input('title'))->first();
		pr($reault->toArray());
	}
	
	
	
	
}



