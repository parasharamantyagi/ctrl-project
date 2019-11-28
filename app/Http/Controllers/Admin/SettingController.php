<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleSetting;
use QrCode;

class SettingController extends Controller
{
    public function index()
    {
		$vichle_name =  Vehicle::select('_id','brand','model')->get();
		$userForm = (object)array(
								'id'=>'','vehicle_id'=>'','background_color'=>'','pad_line_color'=>'','pad_background_color'=>'',
								'button_style'=>'','daylight_auto_on'=>'','reverse_speed_motor'=>'',
								'reverse_steer_motor'=>'','motor_off'=>'','steering_control_point'=>'',
								'asset_folder'=>'','firmware'=>'','front_motor'=>'',
								'rear_motor'=>'','gearbox_amount_of_gears'=>'','max_speed_per_gears'=>'',
								'speed_curve'=>'','max_rpm'=>'','idle_rpm'=>'',
								'upper_gear_shift_value'=>'','lower_gear_shift_value'=>'','cell_value_steer_pad'=>'',
								'gear_retio'=>'','max_steering_angle'=>'','led_configuration'=>'','button_config_for_each_menu'=>'',
								);
								
		
		$page_info['page_title'] = 'Settings';
		return view('admin/Setting/viewsetting')->with('userForm', $userForm)->with('vichle_name',$vichle_name)->with('page_info', $page_info)->with('formaction','/admin/settings');
    }
	
	public function store(Request $request)
    {
		$inputData = $request->all();
		
			unset($inputData["id"]);
			unset($inputData["_token"]);
			VehicleSetting::insert($inputData);
			$returnmessage = array('status'=>true,'action'=>'add_form','message'=>'Vehicle setting has been save');
		// if($inputData["id"] && !empty($inputData["id"]))
		// {
			// unset($inputData["id"]);
			// unset($inputData["_token"]);
			// VehicleSetting::insert($inputData);
			// $returnmessage = array('status'=>true,'action'=>'add_form','message'=>'Vehicle setting has been save');
		// }else{
			// unset($inputData["id"]);
			// unset($inputData["_token"]);
			// unset($inputData["vehicle_id"]);
			// $userData = VehicleSetting::where('_id', $request->input('id'))->update($inputData);
			// $returnmessage = array('status'=>true,'action'=>'edit_form','message'=>'Vehicle setting has been update');
		// }
		echo json_encode($returnmessage);
    }
	
	public function show($id)
    {
	   if(VehicleSetting::where('vehicle_id',$id)->count())
	   {
		   $vehicleSettingData = VehicleSetting::where('vehicle_id',$id)->first();
	   }else{
		   $vehicleSettingData = (object)array(
								'_id'=>'','vehicle_id'=>'','background_color'=>'','pad_line_color'=>'','pad_background_color'=>'',
								'button_style'=>'','daylight_auto_on'=>'','reverse_speed_motor'=>'','reverse_steer_motor'=>'','motor_off'=>'',
								'steering_control_point'=>'','asset_folder'=>'','firmware'=>'','front_motor'=>'','rear_motor'=>'',
								'gearbox_amount_of_gears'=>'','max_speed_per_gears'=>'','speed_curve'=>'','max_rpm'=>'','idle_rpm'=>'',
								'upper_gear_shift_value'=>'','lower_gear_shift_value'=>'','cell_value_steer_pad'=>'','gear_retio'=>'','max_steering_angle'=>'',
								'led_configuration'=>'','button_config_for_each_menu'=>''
									  );
	   }
	   echo json_encode(array('status'=>true,'message'=>'VehicleSetting successfully get','data'=>$vehicleSettingData));
    }
	
	public function backgroundColor()
    {
		return view('admin/Setting/backgroundColor');
    }
	public function padLineColor()
    {
		return view('admin/Setting/padLineColor');
    }
	
	public function getQrCode()
    {
		$vichle_name =  Vehicle::select('_id','brand','model')->get();
		$page_info['page_title'] = 'Generate qr-code';
		return view('admin/Setting/qrcode')->with('vichle_name',$vichle_name)->with('page_info', $page_info)->with('formaction','/admin/qr-code');
    }
	
	public function postQrCode(Request $request)
	{
		// return view('admin/Setting/padLineColor');
		
		// {{ base64_encode(QrCode::encoding('UTF-8')->format('png')->margin(1)->size(220)->generate('0023|m123|project|menu')) }}


		// QrCode::size(100)->format('png')->generate('ItSolutionStuff.com', public_path('qrcode/qrcode.png'));
		$inputData = $request->all();
		QrCode::encoding('UTF-8')->format('png')->margin(1)->size(220)->generate($inputData['vehicle_id'], public_path('qrcode/'.$inputData['vehicle_id'].'png'));
		echo json_encode(array('status'=>true,'message'=>'Generate qr-code successfully'));
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
