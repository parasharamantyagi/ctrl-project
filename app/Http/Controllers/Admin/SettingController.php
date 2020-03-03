<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleSetting;
use QrCode;
use Auth;

class SettingController extends Controller
{
    public function index()
    {
		// user_id from_id
		if(user_role() === 'admin')
				$vichle_name =  Vehicle::select('_id','brand','model')->get();
			else
				$vichle_name =  Vehicle::select('_id','brand','model')->where('from_id',Auth::user()->id)->get();
		$userForm = (object)array(
								'_id'=>'','vehicle_id'=>'','background_color'=>'#ffffff','pad_line_color'=>'#ffffff','pad_background_color'=>'#ffffff',
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
		$myVehicle = Vehicle::find($inputData['vehicle_id']);
		unset($inputData["_token"]);
		// $inputData['user_id'] = Auth::user()->id;
		$inputData['from_id'] = Auth::user()->id;
		$inputData['setting_status'] = '1';
		$inputData['asset_folder'] = 'mycar.png';
		$inputData['setting_art_no'] = car_model($myVehicle->brand);
		$inputData['setting_use_status'] = '0';
		$inputData['brand_name'] = $myVehicle->brand;
		$vichleSetting = VehicleSetting::insertGetId($inputData);
		// $vichleSetting_image = 'http://18.212.23.117/blogs/post';
		$vichleSetting_text = url('api/vehicle-setting/'.(string)$vichleSetting);
		QrCode::encoding('UTF-8')->format('png')->margin(1)->size(220)->generate($vichleSetting_text, public_path('qrcode/'.$vichleSetting.'png'));
		$returnmessage = array('status'=>true,'action'=>'add_form','vehicle_id'=>$request->input('vehicle_id'),'message'=>'Vehicle setting has been save');
		echo json_encode($returnmessage);
    }
	
	public function show($id)
    {
		
	   if(user_role() === 'admin')
				$vichle_name =  Vehicle::select('_id','brand','model')->get();
			else
				$vichle_name =  Vehicle::select('_id','brand','model')->where('from_id',Auth::user()->id)->get();
		$vehicleSettingData = VehicleSetting::find($id);
		$page_info['page_title'] = 'Settings';
		return view('admin/Setting/viewsetting')->with('userForm', $vehicleSettingData)->with('vichle_name',$vichle_name)->with('page_info', $page_info)->with('formaction','/admin/settings-update');
    }
	
	public function settingsUpdate(Request $request)
	{
		$inputData = $request->all();
		$setting_id = $request->input('id');
		unset($inputData["_token"]);
		unset($inputData["id"]);
		$inputData['brand_name'] = Vehicle::find($inputData['vehicle_id'])->brand;
		VehicleSetting::where('_id',$setting_id)->update($inputData);
		$returnmessage = array('status'=>true,'vehicle_id'=>$request->input('vehicle_id'),'action'=>'update_form','message'=>'Vehicle setting has been update');
		echo json_encode($returnmessage);
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
	
	public function vehicleSetting($id)
    {
		if(user_role() === 'admin')
				$allVehicle = Vehicle::all();
			else
				$allVehicle = Vehicle::where('from_id',Auth::user()->id)->get();
		$vehicleSetting = Vehicle::with('vehicle_setting')->where('_id',$id)->first();
		$page_info['page_title'] = 'Add Vehicle';
		return view('admin/Setting/vehicle-setting')->with('page_info', $page_info)->with('allVehicle', $allVehicle)->with('vehicles', $vehicleSetting);
    }
	
	public function destroy($id)
    {
		$Users = VehicleSetting::find($id); // Can chain this line with the next one
		$Users->delete($id);
		echo json_encode(array('status'=>true,'message'=>'Vehicle setting successfully delete'));
    }
	
	public function vehicleSettingStatus(Request $request)
	{
		$inputData = $request->all();
		$setting_status = ($request->input('status') == "true") ? '1':'0';
		VehicleSetting::where('_id', $request->input('id'))->update(array("setting_status"=>$setting_status));
		$returnmessage = array('status'=>true,'message'=>'Vehicle setting status has been update');
		echo json_encode($returnmessage);
	}
}
