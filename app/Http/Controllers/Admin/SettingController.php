<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleSetting;
use Illuminate\Support\Facades\Hash;
use App\User;
use QrCode;
use Auth;

class SettingController extends Controller
{
	// max_speed_per_gears
	public function __construct(){
		$this->vechile_setting = (object)array(
								'_id'=>'','vehicle_id'=>'','background_color'=>'#181921','pad_line_color'=>'#ffffff','pad_background_color'=>'#000000',
								'button_style'=>'','daylight_auto_on'=>'','reverse_speed_motor'=>'off','brake_lights_1'=>'0','brake_lights_2'=>'0',
								'motion_sensor_level_1'=>'0','motion_sensor_level_2'=>'0','motion_sensor_theft'=>'0','out_of_range'=>'0 sec',
								'reverse_steer_motor'=>'off','motor_off'=>'off','steering_control_point'=>'0','front_motor_off_ms'=>0,'rear_motor_off_ms'=>0,
								'asset_folder'=>'','firmware'=>'1.0','front_motor'=>'','front_motor_resistor_value'=>80,'rear_motor_resistor_value'=>80,
								'rear_motor'=>'','gear_shift_a_value'=>200,'gear_shift_b_value'=>400,
								'acceleration_curve'=>'','motor_trim_kit'=>0,'gear_shift_a_rpm_value'=>200,
								'upper_gear_shift_value'=>3000,'lower_gear_shift_value'=>1800,'cell_value_steer_pad'=>'0.25','sound_file_folder'=>'','hall_sensor_frequency'=>'10',
								'gear_retio'=>'','max_steering_angle'=>'','led_configuration'=>'','button_config_for_each_menu'=>'','motor_steps_for_max_steering'=>'','onboard_sound'=>'off',
								'screen_rotation_landscape'=>'on','pad_design_2_directional'=>'on','electric_motor_re_built'=>'off'
								);
	}
	
	
    public function index()
    {
		
		if(user_role() === 'admin')
				$vichle_name =  Vehicle::select('_id','brand','model')->get();
			else
				$vichle_name =  Vehicle::select('_id','brand','model')->where('from_id',Auth::user()->id)->get();
		$userForm = $this->vechile_setting;
		$page_info['page_title'] = 'Settings';
		return view('admin/Setting/viewsetting')->with('userForm', $userForm)->with('vichle_name',$vichle_name)->with('page_info', $page_info)->with('formaction','/admin/settings');
    }
	
	public function store(Request $request)
    {
		$inputData = $request->all();
		$hasher = app('hash');
		// if ($hasher->check($inputData['password'], Auth::user()->password)) {
			$myVehicle = Vehicle::find($inputData['vehicle_id']);
			unset($inputData["_token"]);
			unset($inputData["password"]);
			// $inputData['user_id'] = Auth::user()->id;
			$inputData['from_id'] = Auth::user()->id;
			$inputData['setting_status'] = '1';
			$inputData['asset_folder'] = 'mycar.png';
			$inputData['setting_art_no'] = $myVehicle->art_no;
			$inputData['setting_use_status'] = '0';
			$inputData['brand_name'] = $myVehicle->brand;
			
			$vichleSetting = VehicleSetting::insertGetId($inputData);
			$vichleSetting_text = (string)$vichleSetting;
			QrCode::encoding('UTF-8')->format('png')->margin(1)->size(220)->generate($vichleSetting_text, public_path('qrcode/'.$vichleSetting.'png'));
			$returnmessage = array('status'=>true,'action'=>'add_form','vehicle_id'=>$request->input('vehicle_id'),'message'=>'Vehicle setting has been save');
		// }else{
			// $returnmessage = array('status'=>false,'action'=>'password','vehicle_id'=>$request->input('vehicle_id'),'message'=>'Your password is incorrect');
		// }
		echo json_encode($returnmessage);
    }
	
	public function show($id)
    {
		
	   if(user_role() === 'admin')
				$vichle_name =  Vehicle::select('_id','brand','model')->get();
			else
				$vichle_name =  Vehicle::select('_id','brand','model')->where('from_id',Auth::user()->id)->get();
		$vehicleSettingData = VehicleSetting::find($id);
		$type_stting = '/admin/settings-edit';
		if(isset($_GET['type']) && $_GET['type'] == 'update')
		{
			$type_stting = '/admin/settings-update';
		}
		$page_info['page_title'] = 'Settings';
		return view('admin/Setting/viewsetting')->with('userForm', $vehicleSettingData)->with('vichle_name',$vichle_name)->with('page_info', $page_info)->with('formaction',$type_stting);
    }
	
	public function settingsUpdate(Request $request)
	{
		$inputData = $request->all();
		$setting_id = $request->input('id');
		unset($inputData["_token"]);
		unset($inputData["id"]);
		$myVehicle = Vehicle::find($inputData['vehicle_id']);
		$inputData['brand_name'] = $myVehicle->brand;
		$inputData['setting_art_no'] = $myVehicle->art_no;
		VehicleSetting::where('_id',$setting_id)->update($inputData);
		$returnmessage = array('status'=>true,'setting_id'=>$setting_id,'vehicle_id'=>$request->input('vehicle_id'),'action'=>'update_form','message'=>'Vehicle setting has been update');
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
		$all_Vehicle = VehicleSetting::with('getvehicle')->get();
		$page_info['page_title'] = 'qr-code list';
		return view('admin/Setting/qrcode')->with('all_Vehicle',$all_Vehicle)->with('page_info', $page_info)->with('formaction','/admin/qr-code');
    }
	
	public function postQrCode(Request $request)
	{
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
