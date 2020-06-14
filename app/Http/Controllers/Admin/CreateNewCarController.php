<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Vehicle;
use App\VehicleSetting;
use App\EditTable;
use App\CreateNewCar;
use Auth;
use File;

class CreateNewCarController extends Controller
{
    public function index()
    {
		$page_info['page_title'] = 'Manage Table';
		$createNewCar_leds = array(array('pin'=>'','color','position'));
		$createNewCar_excel_leds = '{"sequences":[{"bit":"","pin":"","position":"","data":[]}]}';
		$vehicleSetting_options = array('reverse_speed_motor'=>'','reverse_steer_motor'=>'','max_steering_angle'=>'','motor_steps_for_max_steering'=>'','gear_retio'=>'');
		$vehicle_id = '';
		$setting_id = '';
		$setting_page_id = '';
		$blinkers_override = array('blinkers_override_l'=>array(),'blinkers_override_r'=>array());
		
		if(isset($_GET['vehicle_id'])){
			$vehicle_id = $_GET['vehicle_id'];
			$setting_page_id = "?vehicle_id={$vehicle_id}";
			
			// select('reverse_speed_motor','reverse_steer_motor','max_steering_angle','motor_steps_for_max_steering','gear_retio')->
			$vehicleSetting_options = VehicleSetting::where('vehicle_id',$vehicle_id)->first();
			if($vehicleSetting_options){
					$vehicleSetting_options = $vehicleSetting_options->toArray();
					$setting_page_id = "/{$vehicleSetting_options['_id']}";
			}
			$createNewCar = CreateNewCar::select('data_leds','excel_leds')->where('vehicle_id',$vehicle_id)->first();
				if($createNewCar && $createNewCar->data_leds){
					$createNewCar_leds = json_decode($createNewCar->data_leds,true)['leds'];
				}
				if($createNewCar && $createNewCar->excel_leds){
					$createNewCar_excel_leds_array = $createNewCar->excel_leds;
					$createNewCar_excel_leds_array = json_decode($createNewCar_excel_leds_array);
					if(array_key_exists('options',$createNewCar_excel_leds_array)) {
						if(isset($createNewCar_excel_leds_array->options->blinkers_override_l) && isset($createNewCar_excel_leds_array->options->blinkers_override_r)){
						$blinkers_override = array(
													'blinkers_override_l'=>($createNewCar_excel_leds_array->options->blinkers_override_l) ?  array_map(function($value) { return intval($value); },$createNewCar_excel_leds_array->options->blinkers_override_l): array(),
													'blinkers_override_r'=>($createNewCar_excel_leds_array->options->blinkers_override_r) ?  array_map(function($value) { return intval($value); }, $createNewCar_excel_leds_array->options->blinkers_override_r): array()
												);
						}
						// pr($blinkers_override);
						unset($createNewCar_excel_leds_array->options);
					}
					// pr($createNewCar_excel_leds_array);
					$createNewCar_excel_leds = json_encode($createNewCar_excel_leds_array);
				}
			$setting_id = (isset($vehicleSetting_options['_id'])) ? $vehicleSetting_options['_id'] : '';
			}
		// pr($vehicleSetting_options); blinkers_override_l
		$setting_option = json_encode(array(
										'f-motor-mirror'=>(isset($vehicleSetting_options['reverse_speed_motor']) && $vehicleSetting_options['reverse_speed_motor'] == 'on') ? 1 : 0,
										'r-motor-mirror'=>(isset($vehicleSetting_options['reverse_steer_motor']) && $vehicleSetting_options['reverse_steer_motor'] == 'on') ? 1 : 0,
										'steering-angle'=>($vehicleSetting_options['max_steering_angle']) ? floatval($vehicleSetting_options['max_steering_angle']) : 0,
										'steering-steps'=>($vehicleSetting_options['motor_steps_for_max_steering']) ? floatval($vehicleSetting_options['motor_steps_for_max_steering']) : 0,
										'car-factor'=>($vehicleSetting_options['gear_retio']) ? floatval($vehicleSetting_options['gear_retio']) : 0,
										'hall-sensor-hz'=>($vehicleSetting_options['hall_sensor_frequency']) ? (int)$vehicleSetting_options['hall_sensor_frequency'] : 0,
										'auto-daylight'=>(isset($vehicleSetting_options['daylight_auto_on'])  && $vehicleSetting_options['daylight_auto_on'] == 'on') ? 1 : 0,
										'brakelight-front'=>($vehicleSetting_options['brake_lights_1']) ? (int)$vehicleSetting_options['brake_lights_1'] : 0,
										'brakelight-rev'=>($vehicleSetting_options['brake_lights_2']) ? (int)$vehicleSetting_options['brake_lights_2'] : 0,
										'motion-1'=>($vehicleSetting_options['motion_sensor_level_1']) ? (int)$vehicleSetting_options['motion_sensor_level_1'] : 0,
										'motion-2'=>($vehicleSetting_options['motion_sensor_level_2']) ? (int)$vehicleSetting_options['motion_sensor_level_2'] : 0,
										'motion-3'=>($vehicleSetting_options['motion_sensor_theft']) ? (int)$vehicleSetting_options['motion_sensor_theft'] : 0,
										'out-of-range'=>($vehicleSetting_options['out_of_range']) ? (int)$vehicleSetting_options['out_of_range'] : 0
									));
		$jsonData = '{"leds":[{"pin":"","color":"","position":""}]}';
		$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
		return view('admin/CreateNewCar/createcar')->with('setting_id', $setting_id)->with('setting_page_id', $setting_page_id)->with('blinkers_override', $blinkers_override)->with('page_info', $page_info)->with('setting_option', $setting_option)->with('vehicle_id', $vehicle_id)->with('data_leds', $createNewCar_leds)->with('excel_leds', $createNewCar_excel_leds);
    }
	
	public function store(Request $request)
    {	
		// pr($request->all());
		if($request->type == 'data_leds'){
			CreateNewCar::updateOrCreate(array('vehicle_id' =>$request->vehicle_id),array('data_leds'=>$request->data_leds));
			return response()->json(array('status'=>true,'vehicle_id'=>$request->vehicle_id,'message'=>$request->data_leds));
		}else if($request->type == 'excel_leds'){
			$excel_leds = '{"sequences":[{"bit":"","pin":"","position":"","data":[]}]}';
			if(!empty(json_decode($request->excel_leds)->sequences)){
				$excel_leds = $request->excel_leds;
			}
			// $file = $request->vehicle_id. '_file.json';
			// $destinationPath = public_path()."/assets/excel_leds/";
			// File::put($destinationPath.$file,$excel_leds);
			CreateNewCar::updateOrCreate(array('vehicle_id' =>$request->vehicle_id),array('excel_leds'=>$excel_leds));
			// $file = $request->vehicle_id. '_file.json';
			// $destinationPath = public_path()."/assets/excel_leds/";
			// File::put($destinationPath.$file,$request->excel_leds);
			// CreateNewCar::updateOrCreate(array('vehicle_id' =>$request->vehicle_id),array('excel_leds'=>$request->excel_leds));
			return response()->json(array('status'=>true,'vehicle_id'=>$request->vehicle_id,'message'=>'LED config save successfully'));
		}else{
			return response()->json(array('status'=>false));
		}
	}
	
	public function show($id)
	{
		$inputData = CreateNewCar::all();
		pr($inputData->toArray());
	}
	
	public function createExcelSheet()
    {
		// $createNewCar = CreateNewCar::select('data_leds')->where('user_id',Auth::user()->id);
		$page_info['page_title'] = 'Excel sheet';
		$page_info['error'] = '';
		$page_info['file_name'] = '';
		// $page_info['inputData_val'] = $createNewCar->first()->data_leds;
		// $CreateNewCars = json_encode($createNewCar->first());
		// if($createNewCar->count())
			// $jsonData = '{"leds":[]}';
		// else
			$jsonData = '{"leds":[{"pin":"","color":"","position":""}]}';
		// pr($page_info['inputData']);
		$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
		return view('admin/CreateNewCar/createExcelSheet')->with('page_info',$page_info)->with('uploded_file_name',false);
	}
	
	public function createExcelSheetPost(Request $request)
	{
		// $inputData = $request->username;
		// $createNewCar = CreateNewCar::select('data_leds')->where('user_id',Auth::user()->id);
		// $page_info['inputData_val'] = $createNewCar->first()->data_leds;
		// $CreateNewCars = json_encode($createNewCar->first());
		if ($request->hasFile('jsonfile') && $request->file('jsonfile')->getClientOriginalExtension() === 'json') {
				
					// $uploded_file_name = $request->file('jsonfile')->getClientOriginalName();
					// $uploded_file_name .= ' has been uploaded';
				// $validatedData = \Validator::make([
					// 'jsonfile' => 'mimes:json',
				// ]);
				// if(!$validatedData->fails())
				// {
					$file = file_get_contents($request->file('jsonfile'));
					$page_info['page_title'] = 'Excel sheet';
					$checkData = json_decode($file,true);
					// pr(array_key_first($checkData));
					if(array_key_first($checkData) == 'leds'){
						$page_info['inputData'] = json_encode(json_decode($file,true),true);
						$page_info['error'] = '';
						$page_info['file_name'] = $request->file('jsonfile')->getClientOriginalName();
						return view('admin/CreateNewCar/createExcelSheet')->with('page_info',$page_info);
					}else{
						$page_info['page_title'] = 'Excel sheet';
				// $page_info['inputData'] = json_encode(json_decode($file,true),true);
				$jsonData = '{"leds":[{"pin":"","color":"","position":""}]}';
				// pr($page_info['inputData']);
				$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
				$page_info['error'] = 'this is invalid data!';
				$page_info['file_name'] = '';
				return view('admin/CreateNewCar/createExcelSheet')->with('page_info',$page_info);
					}
		}else{
				$page_info['page_title'] = 'Excel sheet';
				// $page_info['inputData'] = json_encode(json_decode($file,true),true);
				$jsonData = '{"leds":[{"pin":"","color":"","position":""}]}';
				// pr($page_info['inputData']);
				$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
				$page_info['error'] = 'Sorry you can upload only json file!';
				$page_info['file_name'] = '';
				return view('admin/CreateNewCar/createExcelSheet')->with('page_info',$page_info);
		}
		// pr($sadasdas);
		// echo $inputData;
		die;
	}
}











