<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Vehicle;
use App\VehicleSetting;
use App\EntranceWestBuilding;
use App\LedExternalBoardid;
use App\UserSetting;
use App\EditTable;
use App\CreateNewCar;
use App\LedMotorExcelSheet;
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
		$user_id = Auth::user()->id;
		// $setting_page_id = '';
		$blinkers_override = array('blinkers_override_l'=>array(),'blinkers_override_r'=>array());
		
		if(Auth::user()){
			// $setting_page_id = "?vehicle_id={$vehicle_id}";
			// ledMotor_buttons 
			$vehicleSetting_options = UserSetting::where('user_id',Auth::user()->id)->first();
			
			$createNewCar = CreateNewCar::select('data_leds','excel_leds')->where('user_id',Auth::user()->id)->first();
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
						unset($createNewCar_excel_leds_array->options);
					}
					$createNewCar_excel_leds = json_encode($createNewCar_excel_leds_array);
				}
			}
			
		$setting_option = json_encode(array(
										'f-motor-mirror'=>(isset($vehicleSetting_options['reverse_speed_motor']) && $vehicleSetting_options['reverse_speed_motor'] == 'on') ? 1 : 0,
										'steering-steps'=>($vehicleSetting_options['motor_steps_for_max_steering']) ? floatval($vehicleSetting_options['motor_steps_for_max_steering']) : 0,
										'steer_mA'=>(isset($vehicleSetting_options['steer_motor_ma_limitation'])) ? (int)$vehicleSetting_options['steer_motor_ma_limitation'] : 0,
										'steer_msteps'=>(isset($vehicleSetting_options['micro_steps'])) ? (int)$vehicleSetting_options['micro_steps'] : 0,
										'r-motor-mirror'=>(isset($vehicleSetting_options['reverse_steer_motor']) && $vehicleSetting_options['reverse_steer_motor'] == 'on') ? 1 : 0,
										'speed_mA'=>(isset($vehicleSetting_options['speed_motor_ma_limitation'])) ? (int)$vehicleSetting_options['speed_motor_ma_limitation'] : 0,
										// 'steering-angle'=>($vehicleSetting_options['max_steering_angle']) ? floatval($vehicleSetting_options['max_steering_angle']) : 0,
										// 'car-factor'=>($vehicleSetting_options['gear_retio']) ? floatval($vehicleSetting_options['gear_retio']) : 0,
										'hall-sensor-hz'=>(isset($vehicleSetting_options['hall_sensor_frequency'])) ? (int)$vehicleSetting_options['hall_sensor_frequency'] : 0,
										'auto-daylight'=>(isset($vehicleSetting_options['daylight_auto_on'])  && $vehicleSetting_options['daylight_auto_on'] == 'on') ? 1 : 0,
										'brakelight-front'=>($vehicleSetting_options['brake_lights_1']) ? (int)$vehicleSetting_options['brake_lights_1'] : 0,
										'brakelight-rev'=>($vehicleSetting_options['brake_lights_2']) ? (int)$vehicleSetting_options['brake_lights_2'] : 0,
										// 'motion-1'=>($vehicleSetting_options['motion_sensor_level_1']) ? (int)$vehicleSetting_options['motion_sensor_level_1'] : 0,
										// 'motion-2'=>($vehicleSetting_options['motion_sensor_level_2']) ? (int)$vehicleSetting_options['motion_sensor_level_2'] : 0,
										// 'motion-3'=>($vehicleSetting_options['motion_sensor_theft']) ? (int)$vehicleSetting_options['motion_sensor_theft'] : 0,
										// 'out-of-range'=>($vehicleSetting_options['out_of_range']) ? (int)$vehicleSetting_options['out_of_range'] : 0
									));
		$jsonData = '{"leds":[{"pin":"","color":"","position":""}]}';
		$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
		return view('user/createcar')->with('user_id', $user_id)->with('blinkers_override', $blinkers_override)->with('page_info', $page_info)->with('setting_option', $setting_option)->with('data_leds', $createNewCar_leds)->with('excel_leds', $createNewCar_excel_leds);
    }
	
	public function store(Request $request)
    {
		if($request->type == 'data_leds'){
			CreateNewCar::updateOrCreate(array('user_id' =>$request->user_id),array('data_leds'=>$request->data_leds));
			return response()->json(array('status'=>true,'user_id'=>$request->user_id,'message'=>$request->data_leds));
		}else if($request->type == 'led-external-board-id'){
			$excel_leds = '{"sequences":[{"bit":"","pin":"","position":"","data":[]}]}';
			if(!empty(json_decode($request->excel_leds)->sequences)){
				$excel_leds = $request->excel_leds;
			}
			LedExternalBoardid::updateOrCreate(array('vehicle_id'=>$request->vehicle_id,'user_id'=>Auth::user()->id),array('excel_leds'=>$excel_leds));
			return response()->json(array('status'=>true,'vehicle_id'=>$request->vehicle_id,'message'=>'LED config save successfully'));
		}else if($request->type == 'excel_leds'){
			$excel_led_s = $request->excel_leds;
			// $excel_leds = '{"sequences":[{"bit":"","pin":"","position":"","data":[]}]}';
			// if(!empty(json_decode($request->excel_leds)->sequences)){
				// $excel_leds = $request->excel_leds;
			// }
			// print_r($excel_leds);
			// die;
			// ,'user_id'=>$request->user_id,'message'=>'LED config save successfully'
			LedMotorExcelSheet::updateOrCreate(array('user_id' =>Auth::user()->id),array('user_id' =>Auth::user()->id,'excel_leds'=>$excel_led_s));
			return response()->json(array('status'=>true));
		}else{
			return response()->json(array('status'=>false));
		}
	}
	
	public function ledExternalBoardId()
    {
		$page_info['page_title'] = 'Manage Table';
		// $data_leds_car = array(array('pin'=>'','color','position'));
		$createNewCar_leds = array(array('pin'=>'','color','position'));
		$createNewCar_excel_leds = '{"sequences":[{"bit":"","pin":"","position":"","data":[]}]}';
		// $vehicleSetting_options = array('reverse_speed_motor'=>'','reverse_steer_motor'=>'','max_steering_angle'=>'','motor_steps_for_max_steering'=>'','gear_retio'=>'');
		$vehicle_id = '';
		$setting_id = '';
		$setting_page_id = '';
		$blinkers_override = array('blinkers_override_l'=>array(),'blinkers_override_r'=>array());
		// $vehicle_excel_sheet = json_encode(array(),true);
		$led_motor = array();
		if(isset($_GET['vehicle_id'])){
			$vehicle_id = $_GET['vehicle_id'];
			$setting_page_id = "?vehicle_id={$vehicle_id}";
			
			// select('reverse_speed_motor','reverse_steer_motor','max_steering_angle','motor_steps_for_max_steering','gear_retio')->
			// $vehicleSetting_options = VehicleSetting::where('vehicle_id',$vehicle_id)->first();
			// $ledMotor = VehicleLedMotorExcelSheet::select('excel_leds')->where('vehicle_id',$_GET['vehicle_id'])->first();
			// if($ledMotor){
				// $vehicle_excel_sheet = json_encode($ledMotor->excel_leds,true);
			// }
			// if($vehicleSetting_options){
					// $vehicleSetting_options = $vehicleSetting_options->toArray();
					// $setting_page_id = "/{$vehicleSetting_options['_id']}";
			// }
			// $createNewCar = LedExternalBoardid::select('data_leds','excel_leds')->where('vehicle_id',$vehicle_id)->first();
			// $data_leds_car = CreateNewCar::select('data_leds')->where('vehicle_id',$vehicle_id)->first();
			// $createNewCar = LedExternalBoardid::select('data_leds','excel_leds')->where('vehicle_id',$vehicle_id)->first();
				// if($data_leds_car && $data_leds_car->data_leds){
					// $createNewCar_leds = json_decode($data_leds_car->data_leds,true)['leds'];
				// }
				 // $data_leds_car = CreateNewCar::select('data_leds')->where('vehicle_id',$vehicle_id)->first();
				 
				$createNewCar = LedExternalBoardid::select('data_leds','excel_leds')->where('user_id',Auth::user()->id)->where('vehicle_id',$vehicle_id)->first();
				// if($data_leds_car && $data_leds_car->data_leds){
					// $createNewCar_leds = json_decode($data_leds_car->data_leds,true)['leds'];
				// }
				
				// VehicleEntranceWestBuilding
				// ->where('select_button_type','led')
				$entrance = EntranceWestBuilding::select('button_title')->where('user_id',Auth::user()->id)->where('vehicle_id',$vehicle_id)->where('select_button_type','led')->where('is_copy','1')->get();
				foreach($entrance as $entrance_s){
					if(isset($entrance_s->button_title)){
						$led_motor[] = $entrance_s->button_title;
					}
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
			// $setting_id = (isset($vehicleSetting_options['_id'])) ? $vehicleSetting_options['_id'] : '';
			}
		
		$jsonData = '{"leds":[{"pin":"","color":"","position":""}]}';
		$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
		return view('user/CreateNewCar/ledExternalBoardId')->with('entrance_val', json_encode($led_motor))->with('excel_leds',$createNewCar_excel_leds)->with('vehicle_id',$vehicle_id)->with('setting_page_id',$setting_page_id);
    }
	
	public function show($id)
	{
		$inputData = CreateNewCar::all();
		pr($inputData->toArray());
	}
	
	public function createExcelSheet()
    {
		$createNewCar = CreateNewCar::select('data_leds')->where('user_id',Auth::user()->id);
		$page_info['page_title'] = 'Excel sheet';
		$page_info['error'] = '';
		$page_info['file_name'] = '';
		$page_info['inputData_val'] = $createNewCar->first()->data_leds;
		$CreateNewCars = json_encode($createNewCar->first());
		if($createNewCar->count())
			$jsonData = '{
										  "X-Light" : {
											"bit" : 1
										  },
										  "DayLight" : {
											"bit" : 2
										  },
										  "Low beam" : {
											"bit" : 3
										  },
										  "High beam" : {
											"bit" : 8
										  },
										  "Biinkers left" : {
											"bit" : 9
										  },
										  "Biinkers right" : {
											"bit" : 10
										  },
										  "Rear Light" : {
											"bit" : 11
										  }
										}';
		else
			$jsonData = '{"leds":[{"pin":"","color":"","position":""}]}';
		// pr($page_info['inputData']);
		$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
		return view('user/CreateNewCar/createExcelSheet')->with('page_info',$page_info)->with('CreateNewCars',$CreateNewCars)->with('uploded_file_name',false);
	}
	
	public function createExcelSheetPost(Request $request)
	{
		// $inputData = $request->username;
		$createNewCar = CreateNewCar::select('data_leds')->where('user_id',Auth::user()->id);
		$page_info['inputData_val'] = $createNewCar->first()->data_leds;
		$CreateNewCars = json_encode($createNewCar->first());
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
					$page_info['inputData'] = json_encode(json_decode($file,true),true);
					$page_info['error'] = '';
					$page_info['file_name'] = $request->file('jsonfile')->getClientOriginalName();
					return view('user/CreateNewCar/createExcelSheet')->with('page_info',$page_info)->with('CreateNewCars',$CreateNewCars);
				// }else{
					// die('ssssssssssss');
				// }
		}else{
				$page_info['page_title'] = 'Excel sheet';
				// $page_info['inputData'] = json_encode(json_decode($file,true),true);
				$jsonData = '{
										  "X-Light" : {
											"bit" : 1
										  },
										  "DayLight" : {
											"bit" : 2
										  },
										  "Low beam" : {
											"bit" : 3
										  },
										  "High beam" : {
											"bit" : 8
										  },
										  "Biinkers left" : {
											"bit" : 9
										  },
										  "Biinkers right" : {
											"bit" : 10
										  },
										  "Rear Light" : {
											"bit" : 11
										  }
							}';
				// pr($page_info['inputData']);
				$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
				$page_info['error'] = 'Sorry you can upload only json file!';
				$page_info['file_name'] = '';
				return view('user/CreateNewCar/createExcelSheet')->with('page_info',$page_info)->with('CreateNewCars',$CreateNewCars);
		}
		// pr($sadasdas);
		// echo $inputData;
		die;
	}
	
	
	public function ledMotorExcelSheet()
    {
		$page_info['page_title'] = 'Manage Table';
		$createNewCar_leds = array(array('pin'=>'','color','position'));
		// $createNewCar_excel_leds = '{"sequences":[{"bit":"","pin":"","position":"","data":[]}]}';
		$vehicle_id = '';
		$user_id = Auth::user()->id;
		
		$entrance = EntranceWestBuilding::select('button_title')->where('user_id',Auth::user()->id)->where('is_copy','1')->get();
		$entrance_val = array();
		foreach($entrance as $entrance_s){
			if(isset($entrance_s->button_title)){
				$entrance_val[] = $entrance_s->button_title;
			}
		}
		
		// LedMotorExcelSheet::updateOrCreate(array('user_id' =>Auth::user()->id),array('user_id' =>Auth::user()->id,'excel_leds'=>$excel_led_s));
			
		$ledMotor = LedMotorExcelSheet::select('excel_leds')->where('user_id',Auth::user()->id)->first();
		
		$createNewCar_excel_leds = json_encode($ledMotor->excel_leds,true);
		 
		// excel_leds
		// pr($ledMotor->toArray());
		// die;
		// $setting_page_id = '';
		// $blinkers_override = array('blinkers_override_l'=>array(),'blinkers_override_r'=>array());
		
		$jsonData = '{"leds":[{"pin":"","color":"","position":""}]}';
		$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
		// led-motor-excel-sheet
		return view('user/ledmotorexcelsheet')->with('user_id', $user_id)->with('entrance_val', json_encode($entrance_val))->with('data_leds', $createNewCar_leds)->with('page_info', $page_info)->with('excel_leds', $createNewCar_excel_leds);
    }
}










