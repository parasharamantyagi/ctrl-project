<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleSetting;
use App\User;
use App\UserUniqData;
use App\VehicleEntranceWestBuilding;
use App\VehicleLedMotorExcelSheet;
use App\VehicleLedSequenceConfig;
use App\VehicleMap;
// use App\CarModel;
use App\LedExternalBoardid;
use App\CreateNewCar;
use App\CarBrand;
use App\VehicleLogo;
use Auth;

class VehicleController extends Controller
{
	public function __construct(){
		$this->vechile_info = (object)array(
									'id'=>'','brand'=>'','model'=>'','model_spec'=>'','car_quote'=>'',
									'release_year'=>'','art_no'=>'','license_plate'=>'','moter_type'=>'','horse_power'=>'',
									'torque'=>'','km_h_0_100'=>'','km_h_0_160'=>'','deceleration_speed'=>'','distance'=>'',
									'km_h_100_0'=>'','weight'=>'','max_weight'=>'',
									'manufacturer'=>'','scale'=>'1:87','vehicle_type'=>'',
									'special_car_specialization'=>'','car_value'=>'0','lenght'=>'','length_front_of_car'=>'',
									'wheelbase'=>'','track_width'=>'','width'=>'',
									'max_rpm'=>0,'idle_rpm'=>800,'gearbox_amount_of_gears'=>0,'max_speed_per_gears'=>'',
									'wheel_diameter'=>'','height'=>'',
									'transmission_ratios'=>'','reverse_gear_ratio'=>'','top_speed'=>'',
									);
	}
	
    public function index()
    {
		if(user_role() === 'admin')
				$user_all = User::where('role_id', '!=' , '0')->get();
			else
				$user_all = User::where('parent_id',Auth::user()->id)->get();
		$carBrand = CarBrand::all();
		
		$all_Vehicle = Vehicle::where('moter_type','!=','')->get();
		
		if(isset($_GET['vehicle_id']) && !empty($_GET['vehicle_id'])) {
			$userForm = Vehicle::find($_GET['vehicle_id']);
			$formaction = '/admin/vehicleUpdate';
		}else{
			$userForm = $this->vechile_info;
			$formaction = '/admin/vehicle';
		}
		
		$page_info['page_title'] = 'Add product';
		return view('admin/Vehicle/addvehicle')->with('all_user', $user_all)->with('all_Vehicle', $all_Vehicle)->with('userForm', $userForm)->with('carBrand', $carBrand)->with('page_info', $page_info)->with('formaction',$formaction);
    }
	
	public function clones($clone_id,$vehicle_id)
	{
		$vechile_setting = VehicleSetting::where('vehicle_id',$clone_id)->first()->toArray();
		unset($vechile_setting['_id']);
		unset($vechile_setting['id']);
		unset($vechile_setting['updated_at']);
		unset($vechile_setting['created_at']);
		$vechile_setting['vehicle_id'] = $vehicle_id;
		VehicleSetting::insert($vechile_setting);
		$vehicleLogo = VehicleLogo::where('vehicle_id',$clone_id)->where('user_setting_id',"1")->first()->toArray();
		unset($vehicleLogo['_id']);
		unset($vehicleLogo['updated_at']);
		unset($vehicleLogo['created_at']);
		$vehicleLogo['vehicle_id'] = $vehicle_id;
		$vehicleLogo['user_setting_id'] = "1";
		VehicleLogo::insert($vehicleLogo);
		$createNewCar = CreateNewCar::select('data_leds','excel_leds')->where('vehicle_id',$clone_id)->first();
		$createNewCars = array('vehicle_id'=>$vehicle_id,'data_leds'=>$createNewCar->data_leds,'excel_leds'=>$createNewCar->excel_leds);
		CreateNewCar::insert($createNewCars);
		$ledExternalBoardids = LedExternalBoardid::select('excel_leds')->where('vehicle_id',$clone_id)->first()->toArray();
		unset($ledExternalBoardids['_id']);
		$ledExternalBoardids['vehicle_id'] = $vehicle_id;
		$ledExternalBoardids['user_id'] = 0;
		LedExternalBoardid::insert($ledExternalBoardids);
		
		$led_motor_config_all = VehicleEntranceWestBuilding::where('vehicle_id',$clone_id)->get();
		if($led_motor_config_all){
			// on_mode_align_text
			$led_motor_config_all_array = array();
			foreach($led_motor_config_all as $led_motor_config){
				$led_motor_config_all_array[] = array_filter(array(
							'vehicle_id'=>$vehicle_id,'sequence_name'=>$led_motor_config['sequence_name'],
							'on_mode_color_1'=>$led_motor_config['on_mode_color_1'],'button_title'=>$led_motor_config['button_title'],
							'on_mode_color_2'=>$led_motor_config['on_mode_color_2'],'off_mode_color_1'=>$led_motor_config['off_mode_color_1'],
							'off_mode_color_2'=>$led_motor_config['off_mode_color_2'],'on_mode_align_text'=>$led_motor_config['on_mode_align_text'],
							'off_mode_align_text'=>$led_motor_config['off_mode_align_text'],'led_motor_config'=>$led_motor_config['led_motor_config'],
							'select_button_type'=>$led_motor_config['select_button_type'],'on_mode_image'=>$led_motor_config['on_mode_image'],
							'off_mode_image'=>$led_motor_config['off_mode_image'],'sequence_number'=>$led_motor_config['sequence_number'],
							'sequence_text'=>$led_motor_config['sequence_text'],'off_sequence_text'=>$led_motor_config['off_sequence_text'],
							'on_sequence_text_name'=>$led_motor_config['on_sequence_text_name'],'off_sequence_text_name'=>$led_motor_config['off_sequence_text_name'],
							'sequence_key'=>$led_motor_config['sequence_key'],'is_copy'=>'1'
				));
			}
			VehicleEntranceWestBuilding::insert($led_motor_config_all_array);
		}
		$ledMotor = VehicleLedMotorExcelSheet::select('excel_leds')->where('vehicle_id',$clone_id)->first()->toArray();
		if($ledMotor){
			unset($ledMotor['_id']);
			$ledMotor['vehicle_id'] = $vehicle_id;
			VehicleLedMotorExcelSheet::insert($ledMotor);
		}
		$ledMotor2 = VehicleLedSequenceConfig::select('excel_leds')->where('vehicle_id',$clone_id)->first()->toArray();
		if($ledMotor2 ){
			unset($ledMotor2['_id']);
			$ledMotor2['vehicle_id'] = $vehicle_id;
			VehicleLedSequenceConfig::insert($ledMotor2);
		}
		return true;
	}
	
	public function store(Request $request)
    {
        $inputData = $request->all();
		
		unset($inputData["id"]);
		unset($inputData["_token"]);
		$inputData["from_id"] = Auth::user()->id;
		if(!CarBrand::where('brand_name',$inputData["brand"])->count())
		{
			CarBrand::updateOrCreate(array('brand_name' =>$inputData["brand"]),array('brand_name'=>$inputData["brand"],'art_no'=>rand(111111,999999)));
		}
		$inputData['max_speed_per_gears'] = implode(",",$inputData['max_speed_per_gears']);
		$inputData['transmission_ratios'] = implode(",",$inputData['transmission_ratios']);
		$insertId = Vehicle::insertGetId($inputData);
		if(!empty($request->id) && strpos($request->id,'clone') == true){
			$this->clones(rtrim($request->id,'-clone'),strval($insertId));
		}
		$returnmessage = array('status'=>true,'action'=>'storeVehicle','insert_id'=>strval($insertId),'message'=>'Vehicle has been save');
		echo json_encode($returnmessage);
    }
	
	public function getVehicleId($id)
	{
		$vechile = Vehicle::where('art_no',$id)->first();
		if($vechile){
			return response()->json(array('status'=>true,'message'=>'Successfull get cart number','data'=>$vechile));
		}else{
			return response()->json(array('status'=>false,'message'=>'Invalid cart number','data'=>array()));
		}		
	}
	
	public function deleteUploadMap($id){
		$Users = VehicleMap::find($id); // Can chain this line with the next one
		$Users->delete($id);
		return response()->json(array('status'=>true,'message'=>'This map data has been delete successfully ','data'=>array()));
	}
	
	public function uploadMap(Request $request)
	{
		if ($request->hasFile('logo_image')) {
			$logo_image = $request->file('logo_image'); //get the file
			if($logo_image->getClientOriginalExtension() === 'json'){
				$checkVehicle = VehicleMap::where('vehicle_id',$request->vehicle_id)->where('file_name',$logo_image->getClientOriginalName())->first();
				if(!$checkVehicle){
					$json = json_decode(file_get_contents($logo_image), true);
					$insertData = array('vehicle_id'=>$request->vehicle_id,'file_name'=>$logo_image->getClientOriginalName(),'upload_data'=>$json);
					if ($request->hasFile('map_image')) {
						$map_image = $request->file('map_image'); //get the file
						$namefile = 'map' . rand(1,999999) .time() . '.' . $map_image->getClientOriginalExtension();
						$destinationPath = public_path('/vehicle-map');
						$map_image->move($destinationPath, $namefile);  //move to destination you mentioned
						$insertData['map_image'] = 'vehicle-map/'.$namefile;
					}
					VehicleMap::insert($insertData);
					return redirect(user_role().'/upload-map?vehicle_id='.$request->vehicle_id)->with('flash-message','Data update successfully');
				}else{
					return redirect(user_role().'/upload-map?vehicle_id='.$request->vehicle_id)->with('flash-message','This file is exit');
				}
			}else{
				return redirect(user_role().'/upload-map?vehicle_id='.$request->vehicle_id)->with('flash-message','Sorry you can upload only json file');
			}
		}else{
			$mapData = array();
			if($request->vehicle_id){
				$mapData['vehicle_id'] =  $request->vehicle_id;
				$setting_id = '?vehicle_id='.$_GET['vehicle_id'];
				$vechile_setting = VehicleSetting::select('_id')->where('vehicle_id',$_GET['vehicle_id'])->first();
				if($vechile_setting){
					$setting_id = '/'.$vechile_setting->_id;
				}
				$mapData['setting_id'] =  $setting_id;
			}
			$page_info['page_title'] = 'Map data';
			$mapData['vehicle_maps'] = VehicleMap::where('vehicle_id',$request->vehicle_id)->get();
			return view('admin/Vehicle/upload-map',$mapData)->with('page_info', $page_info);
		}
	}
	
	
	public function multimediaAction()
	{
		$vechileForm_1 = array(
								'vehicle_id'=>'','brand'=>'','pad2_image'=>'assets/ctrlImages/multimedia/default/white.jpg','logo_image'=>'assets/ctrlImages/multimedia/default/white.jpg','pad4_image'=>'assets/ctrlImages/multimedia/default/white.jpg',
								'icone_image'=>'assets/ctrlImages/multimedia/default/white.jpg','pad3_image'=>'assets/ctrlImages/multimedia/default/white.jpg','larger_logo'=>'assets/ctrlImages/multimedia/default/white.jpg',
								'p_pad2_image'=>'No file chosen','full_screen_movie_links'=>'','p_logo_image'=>'No file chosen','p_icone_image'=>'No file chosen','p_pad3_image'=>'No file chosen','p_pad4_image'=>'No file chosen',
								'p_start_engine_sound'=>'No file chosen','p_idle_motor_sound'=>'No file chosen','p_acceleration_sound'=>'No file chosen','p_deceleration_sound'=>'No file chosen','p_larger_logo'=>'No file chosen',
								'p_gear_shift_sound_1'=>'No file chosen','p_gear_shift_sound_2'=>'No file chosen','p_shut_off_sound'=>'No file chosen','p_blinkers_sound'=>'No file chosen','p_horn_sound'=>'No file chosen'
							);
		// pad3_image p_larger_logo larger_logo pad4_image 
		$vechileForm_2 = array();
		$setting_id = '';
		if(isset($_GET['vehicle_id']) && !empty($_GET['vehicle_id'])) {
			$setting_id = '?vehicle_id='.$_GET['vehicle_id'];
			$vechile_setting = VehicleSetting::select('_id')->where('vehicle_id',$_GET['vehicle_id'])->first();
			if($vechile_setting){
				$setting_id = '/'.$vechile_setting->_id;
			}
			$vechileForm_db = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image','larger_logo','pad4_image','p_pad2_image','full_screen_movie_links','p_logo_image','p_icone_image','p_pad3_image','p_larger_logo','p_pad4_image','p_start_engine_sound','p_idle_motor_sound','p_acceleration_sound','p_deceleration_sound','p_gear_shift_sound_1','p_gear_shift_sound_2','p_shut_off_sound','p_blinkers_sound','p_horn_sound')->where('vehicle_id',$_GET['vehicle_id'])->where('user_setting_id',"1")->first();
			if($vechileForm_db){
				$vechileForm_2 = $vechileForm_db->toArray();
			}
		}
		$result = array_merge($vechileForm_1, $vechileForm_2);
		$result['logo_image_size'] = getimagesize(url($result['logo_image']));
		$page_info['page_title'] = 'Multimedia';
		return view('admin/Vehicle/multimedia')->with('userForm', $result)->with('setting_id', $setting_id)->with('page_info', $page_info);
	}
	
	
	public function multimediaActionPost(Request $request)
	{
		$inputData = $request->all();
		$saveData = array('vehicle_id'=>$request->vehicle_id);
		$vechileForm_db = Vehicle::with('vehicle_logo')->select('brand')->find($_GET['vehicle_id']);
		$brand_name = '';
		if($vechileForm_db){
			$brand_name = strtolower(str_replace(' ', '', $vechileForm_db->brand));
		}
		$saveData['brand'] = $brand_name;
		$saveData['pad2_image'] = '';
		// $saveData['p_pad2_image'] = 'No file chosen';
		if ($request->hasFile('pad2_image')) {
				   $pad2_image = $request->file('pad2_image'); //get the file
				   $namefile = $brand_name.'-pad2_image' . rand(1,999999) .time() . '.' . $pad2_image->getClientOriginalExtension();
				   $p_pad2_image = $pad2_image->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $pad2_image->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['pad2_image'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_pad2_image'] = $p_pad2_image;
			}
		$saveData['logo_image'] = '';
		// $saveData['p_logo_image'] = 'No file chosen';
		if ($request->hasFile('logo_image')) {
				   $logo_image = $request->file('logo_image'); //get the file
				   $namefile = $brand_name.'-logo_image' . rand(1,999999) .time() . '.' . $logo_image->getClientOriginalExtension();
				   $p_logo_image = $logo_image->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $logo_image->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['logo_image'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_logo_image'] = $p_logo_image;
			}
		$saveData['icone_image'] = '';
		// $saveData['p_icone_image'] = 'No file chosen';
		if ($request->hasFile('icone_image')) {
				   $icone_image = $request->file('icone_image'); //get the file
				   $namefile = $brand_name.'-icone_image' . rand(1,999999) .time() . '.' . $icone_image->getClientOriginalExtension();
				   $p_icone_image = $icone_image->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $icone_image->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['icone_image'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_icone_image'] = $p_icone_image;
			}
		$saveData['pad3_image'] = '';
		// $saveData['p_pad3_image'] = 'No file chosen';
		if ($request->hasFile('pad3_image')) {
				   $pad3_image = $request->file('pad3_image'); //get the file
				   $namefile = $brand_name.'-pad3_image' . rand(1,999999) .time() . '.' . $pad3_image->getClientOriginalExtension();
				   $p_pad3_image = $pad3_image->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $pad3_image->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['pad3_image'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_pad3_image'] = $p_pad3_image;
			}
		// $saveData['p_pad3_image'] = 'No file chosen';
		if ($request->hasFile('pad4_image')) {
				   $pad4_image = $request->file('pad4_image'); //get the file
				   $namefile = $brand_name.'-pad4_image' . rand(1,999999) .time() . '.' . $pad4_image->getClientOriginalExtension();
				   $p_pad4_image = $pad4_image->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $pad4_image->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['pad4_image'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_pad4_image'] = $p_pad4_image;
			}
			
		if ($request->hasFile('larger_logo')) {
				   $larger_logo = $request->file('larger_logo'); //get the file
				   $namefile = $brand_name.'-larger_logo' . rand(1,999999) .time() . '.' . $larger_logo->getClientOriginalExtension();
				   $p_larger_logo = $larger_logo->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $larger_logo->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['larger_logo'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_larger_logo'] = $p_larger_logo;
			}
		
		// $saveData['start_engine_sound'] = '';
		if ($request->hasFile('start_engine_sound')) {
				   $start_engine_sound = $request->file('start_engine_sound'); //get the file
				   $namefile = $brand_name.'-start_engine_sound' . rand(1,999999) .time() . '.' . $start_engine_sound->getClientOriginalExtension();
				   $p_start_engine_sound = $start_engine_sound->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $start_engine_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['start_engine_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_start_engine_sound'] = $p_start_engine_sound;
			}
		// $saveData['idle_motor_sound'] = '';
		if ($request->hasFile('idle_motor_sound')) {
				   $idle_motor_sound = $request->file('idle_motor_sound'); //get the file
				   $namefile = $brand_name.'-idle_motor_sound' . rand(1,999999) .time() . '.' . $idle_motor_sound->getClientOriginalExtension();
				   $p_idle_motor_sound = $idle_motor_sound->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $idle_motor_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['idle_motor_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_idle_motor_sound'] = $p_idle_motor_sound;
			}
		// $saveData['acceleration_sound'] = '';
		if ($request->hasFile('acceleration_sound')) {
				   $acceleration_sound = $request->file('acceleration_sound'); //get the file
				   $namefile = $brand_name.'-acceleration_sound' . rand(1,999999) .time() . '.' . $acceleration_sound->getClientOriginalExtension();
				   $p_acceleration_sound = $acceleration_sound->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $acceleration_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['acceleration_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_acceleration_sound'] = $p_acceleration_sound;
			}
		// $saveData['deceleration_sound'] = '';
		if ($request->hasFile('deceleration_sound')) {
				   $deceleration_sound = $request->file('deceleration_sound'); //get the file
				   $namefile = $brand_name.'-deceleration_sound' . rand(1,999999) .time() . '.' . $deceleration_sound->getClientOriginalExtension();
				   $p_deceleration_sound = $deceleration_sound->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $deceleration_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['deceleration_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_deceleration_sound'] = $p_deceleration_sound;
			}
		// $saveData['gear_shift_sound_1'] = '';
		if ($request->hasFile('gear_shift_sound_1')) {
				   $gear_shift_sound_1 = $request->file('gear_shift_sound_1'); //get the file
				   $namefile = $brand_name.'-gear_shift_sound_1' . rand(1,999999) .time() . '.' . $gear_shift_sound_1->getClientOriginalExtension();
				   $p_gear_shift_sound_1 = $gear_shift_sound_1->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $gear_shift_sound_1->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['gear_shift_sound_1'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_gear_shift_sound_1'] = $p_gear_shift_sound_1;
			}
		// $saveData['gear_shift_sound_2'] = '';
		if ($request->hasFile('gear_shift_sound_2')) {
				   $gear_shift_sound_2 = $request->file('gear_shift_sound_2'); //get the file
				   $namefile = $brand_name.'-gear_shift_sound_2' . rand(1,999999) .time() . '.' . $gear_shift_sound_2->getClientOriginalExtension();
				   $p_gear_shift_sound_2 = $gear_shift_sound_2->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $gear_shift_sound_2->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['gear_shift_sound_2'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_gear_shift_sound_2'] = $p_gear_shift_sound_2;
			}
		// $saveData['shut_off_sound'] = '';
		if ($request->hasFile('shut_off_sound')) {
				   $shut_off_sound = $request->file('shut_off_sound'); //get the file
				   $namefile = $brand_name.'-shut_off_sound' . rand(1,999999) .time() . '.' . $shut_off_sound->getClientOriginalExtension();
				   $p_shut_off_sound = $shut_off_sound->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $shut_off_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['shut_off_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_shut_off_sound'] = $p_shut_off_sound;
			}
		// $saveData['blinkers_sound'] = '';
		if ($request->hasFile('blinkers_sound')) {
				   $blinkers_sound = $request->file('blinkers_sound'); //get the file
				   $namefile = $brand_name.'-blinkers_sound' . rand(1,999999) .time() . '.' . $blinkers_sound->getClientOriginalExtension();
				   $p_blinkers_sound = $blinkers_sound->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $blinkers_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['blinkers_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_blinkers_sound'] = $p_blinkers_sound;
			}
		if ($request->hasFile('horn_sound')) {
				   $horn_sound = $request->file('horn_sound'); //get the file
				   $namefile = $brand_name.'-horn_sound' . rand(1,999999) .time() . '.' . $horn_sound->getClientOriginalExtension();
				   $p_horn_sound = $horn_sound->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $horn_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['horn_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_horn_sound'] = $p_horn_sound;
		}
		$saveData['full_screen_movie_links'] = $request->full_screen_movie_links;
		$saveData['user_setting_id'] = "1";
		
		$saveData = array_filter($saveData);
		VehicleLogo::updateOrCreate(array('vehicle_id' =>$inputData["vehicle_id"]),$saveData);
		return redirect(user_role().'/multimedia?vehicle_id='.$inputData['vehicle_id'])->with('flash-message','Data update successfully');
	}
	
	public function carButton()
	{
		$setting_id = '';
		$car_button = array();
		$train_button = array();
		if(isset($_GET['vehicle_id']) && !empty($_GET['vehicle_id'])) {
			$setting_id = '?vehicle_id='.$_GET['vehicle_id'];
			$vechile_setting = VehicleSetting::select('_id')->where('vehicle_id',$_GET['vehicle_id'])->first();
			if($vechile_setting){
				$setting_id = '/'.$vechile_setting->_id;
			}
			
			$vechileForm_db = VehicleLogo::select('car_button','train_button')->where('vehicle_id',$_GET['vehicle_id'])->where('user_setting_id',"1")->first();
			if($vechileForm_db)
			{
				$vechileForm_db =	$vechileForm_db->toArray();
				$car_button = (array_key_exists('car_button',$vechileForm_db)) ? $vechileForm_db['car_button'] : array();
				$train_button = (array_key_exists('train_button',$vechileForm_db)) ? $vechileForm_db['train_button'] : array();
			}
		}
		$page_info['page_title'] = 'Buttons';
		return view('admin/Vehicle/carbutton')->with('setting_id', $setting_id)->with('car_button', $car_button)->with('train_button', $train_button)->with('page_info', $page_info);
	}
	
	public function carButtonPost(Request $request)
	{
		// $inputData = $request->all();
		$inputData = array();
		$inputData['car_button'] = array();
		$inputData['train_button'] = array();
		if($request->car_button && !empty($request->car_button)){
			$inputData['car_button'] = $request->car_button;
		}
		if($request->train_button && !empty($request->train_button)){
			$inputData['train_button'] = $request->train_button;
		}
		VehicleLogo::updateOrCreate(array('vehicle_id' =>$request->vehicle_id),$inputData);
		
		return redirect(user_role().'/car-button?vehicle_id='.$request->vehicle_id)->with('flash-message','Data update successfully');
		// return redirect(user_role().'/car-button?vehicle_id='.$inputData['vehicle_id'])->with('flash-message','Data update successfully');
	}
	
	public function show($id)
    {	
			if(user_role() === 'admin')
				$user_all = User::where('role_id', '!=' , '0')->get();
			else
				$user_all = User::where('parent_id',Auth::user()->id)->get();
			
			$userForm = Vehicle::find($id);
			$all_Vehicle = Vehicle::where('moter_type','!=','')->get();
			$settign_id = '?vehicle_id='.$id;
			$VehicleSetting = VehicleSetting::select('_id')->where('vehicle_id',$id)->first();
			if($VehicleSetting)
			{
				$settign_id = $VehicleSetting->_id;
			}
			
			$carBrand = CarBrand::all();
			
			$page_info['page_title'] = 'Edit Vehicle';
			return view('admin/Vehicle/addvehicle')->with('all_user', $user_all)->with('all_Vehicle', $all_Vehicle)->with('userForm', $userForm)->with('settign_id', $settign_id)->with('carBrand', $carBrand)->with('page_info', $page_info)->with('formaction','/admin/vehicleUpdate');
	}
	
	public function vehicleUpdate(Request $request)
	{
		$inputData = $request->all();
		$VehicleSetting = VehicleSetting::select('_id')->where('vehicle_id',$inputData["id"])->first();
		$vehicle_id = $request->input('id');
		unset($inputData["id"]);
		unset($inputData["_token"]);
		if(!CarBrand::where('brand_name',$inputData["brand"])->count())
		{
			CarBrand::updateOrCreate(array('brand_name' =>$inputData["brand"]),array('brand_name'=>$inputData["brand"],'art_no'=>rand(111111,999999)));
		}
		$inputData['max_speed_per_gears'] = implode(",",$inputData['max_speed_per_gears']);
		$inputData['transmission_ratios'] = implode(",",$inputData['transmission_ratios']);
		Vehicle::where('_id', $vehicle_id)->update($inputData);
		$returnmessage = array('status'=>true,'action'=>'updateVehicle','vehicle_id'=>$vehicle_id,'message'=>'Vehicle has been update');
		echo json_encode($returnmessage);
	}
	
	public function viewVehicleAll()
	{
		$page_info['page_title'] = 'All product';
		// $vichleData = Vehicle::all();
		return view('admin/Vehicle/viewvehicleinfoall')->with('page_info', $page_info);
	}
	
	public function viewOwnedVehicleAll()
	{
		$page_info['page_title'] = 'All Vehicle';
		return view('admin/Vehicle/view-owned-vehicleinfoall')->with('page_info', $page_info);
	}
	
	
	public function vehicleTable(Request $request)
	{
		$inputData = $request->all();
		$columns = array( 
                            0 =>'brand', 
                            1 =>'model',
                            2=> 'model_spec',
							3=> 'release_year',
							4=> 'art_no',
                        );
		// $vehicles = VehicleSetting::with('getvehicle');
		$vehicles = Vehicle::with('vehicle_setting');
		// if(edit_table('vehicle_id'))
				// $vehicles = $vehicles->whereIn('vehicle_id',explode(',',edit_table('vehicle_id')));
			
		// if(edit_table('users'))
				// $vehicles = $vehicles->whereIn('user_id',explode(',',edit_table('users')));
			
		if(user_role() != 'admin')
				$vehicles = $vehicles->where('from_id',Auth::user()->id);
		
		// if($request->input('vehicle_id') && $request->input('vehicle_id') !=  "0")
				// $vehicles = $vehicles->where('vehicle_id',$request->input('vehicle_id'));
			
		if($request->input('type')){
			$vehicles = $vehicles->whereHas('vehicle_setting',function ($query){
				$query->where('setting_status',1);
			});
			// ->whereHas('products', function ($query) use ($searchString){
            // $query->where('name', 'like', '%'.$searchString.'%');
				// $vehicles = $vehicles->where('_id',12);
		}
		// else{
				// $vehicles = $vehicles->where('setting_use_status','0');
		// }
		
		// if($request->input('brand_name'))
				// $vehicles = $vehicles->where('brand_name',$request->input('brand_name'));
		
		$totalData = $vehicles->count();
		$totalFiltered = $totalData;
		
		$limit = (int)$request->input('length');
        $start = (int)$request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
        {            
            $posts = $vehicles->skip($start)
                         ->take($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
			// art_no
            $search = $request->input('search.value');
            $posts =  $vehicles->where('brand', 'LIKE',"%{$search}%")->orWhere('art_no', 'LIKE',"%{$search}%")->orWhere('model', 'LIKE',"%{$search}%")->orWhere('model_spec', 'LIKE',"%{$search}%")
                            ->skip($start)
                            ->take($limit)
                            ->orderBy($order,$dir)
                            ->get();
            $totalFiltered = $vehicles->where('brand', 'LIKE',"%{$search}%")->orWhere('art_no', 'LIKE',"%{$search}%")->orWhere('model', 'LIKE',"%{$search}%")->orWhere('model_spec', 'LIKE',"%{$search}%")
                             ->count();
        }
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $posts
                    );
        echo json_encode($json_data);
	}
	
	public function ledMotorConfig() {
		$page_info['page_title'] = 'All Product';
		$options = 5;
		if(isset($_GET['vehicle_id']) && !empty($_GET['vehicle_id'])) {
			$vehicle_id = $_GET['vehicle_id'];
			$led_motor_config_all = VehicleEntranceWestBuilding::where('vehicle_id',$vehicle_id)->where('is_copy','1')->get()->toArray();
			return view('admin/let_motor_config_2')->with('page_info', $page_info)->with('vehicle_id', $vehicle_id)->with('ledMotor_buttons', $led_motor_config_all);
		}else{
			return redirect(user_role().'/dashboard');
		}
	}
	
	public function ledSequenceConfig()
    {
		$page_info['page_title'] = 'Manage Table';
		
		$vehicle_id = '';
		$user_id = Auth::user()->id;
		
		$entrance = VehicleEntranceWestBuilding::select('button_title')->where('vehicle_id',$_GET['vehicle_id'])->where('is_copy','1')->where('select_button_type','led')->get();
		$entrance_val = array();
		foreach($entrance as $entrance_s){
			if(isset($entrance_s->button_title)){
				$entrance_val[] = $entrance_s->button_title;
			}
		}
			
		$ledMotor = VehicleLedSequenceConfig::select('excel_leds')->where('vehicle_id',$_GET['vehicle_id'])->first();
		if($ledMotor){
			$createNewCar_excel_leds = json_encode($ledMotor->excel_leds,true);
		}else{
			$createNewCar_excel_leds = json_encode(array(),true);
		}
		
		$jsonData = '{"leds":[{"pin":"","color":"","position":""}]}';
		$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
		return view('admin/ledSequenceConfig')->with('user_id', $user_id)->with('entrance_val', json_encode($entrance_val))->with('page_info', $page_info)->with('excel_leds', $createNewCar_excel_leds);
    }
	
	public function ledMotorExcelSheet()
    {
		// $entrance = VehicleEntranceWestBuilding::select('button_title')->where('vehicle_id',$_GET['vehicle_id'])->where('is_copy','1')->where('select_button_type','led')->get();
		
		$page_info['page_title'] = 'Manage Table';
		$createNewCar_leds = array(array('pin'=>'','color','position'));
		$vehicle_id = '';
		$user_id = Auth::user()->id;
		
		$entrance = VehicleEntranceWestBuilding::select('button_title')->where('vehicle_id',$_GET['vehicle_id'])->where('is_copy','1')->where('select_button_type','motor')->get();
		$entrance_val = array();
		foreach($entrance as $entrance_s){
			if(isset($entrance_s->button_title)){
				$entrance_val[] = $entrance_s->button_title;
			}
		}
			
		$ledMotor = VehicleLedMotorExcelSheet::select('excel_leds')->where('vehicle_id',$_GET['vehicle_id'])->first();
		if($ledMotor){
			$createNewCar_excel_leds = json_encode($ledMotor->excel_leds,true);
		}else{
			$createNewCar_excel_leds = json_encode(array(),true);
		}
		
		$jsonData = '{"leds":[{"pin":"","color":"","position":""}]}';
		$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
		return view('admin/ledmotorexcelsheet')->with('user_id', $user_id)->with('entrance_val', json_encode($entrance_val))->with('data_leds', $createNewCar_leds)->with('page_info', $page_info)->with('excel_leds', $createNewCar_excel_leds);
    }
	
	
	public function ledMotorExcelSheetPOst(Request $request){
		if($request->type == 'excel_leds'){
			VehicleLedMotorExcelSheet::updateOrCreate(array('vehicle_id' =>$request->vehicle_id),array('vehicle_id' =>$request->vehicle_id,'excel_leds'=>$request->excel_leds));
			return response()->json(array('status'=>true));
		}else if($request->type == 'led-sequence-config'){
			VehicleLedSequenceConfig::updateOrCreate(array('vehicle_id' =>$request->vehicle_id),array('vehicle_id' =>$request->vehicle_id,'excel_leds'=>$request->excel_leds));
			return response()->json(array('status'=>true));
		}else if($request->type == 'delete-led-sequence-config'){
			VehicleLedSequenceConfig::where('vehicle_id',$request->vehicle_id)->delete();
			return response()->json(array('status'=>true));
		}else if($request->type == 'delete_excel_leds'){
			VehicleLedMotorExcelSheet::where('vehicle_id',$request->vehicle_id)->delete();
			return response()->json(array('status'=>true));
		}else{
			return response()->json(array('status'=>true));
		}
	}
	
	public function some_function($input,$sequence__name,$vehicle_id){
		$entrance = VehicleEntranceWestBuilding::where('vehicle_id',$vehicle_id)->where('sequence_name',$sequence__name)->first();
		$insert_new_array = array(
						'vehicle_id'=>$vehicle_id,'sequence_name'=>'LED_SEQUENCE_'.$input,'on_mode_color_1'=>$entrance->on_mode_color_1,
						'on_mode_color_2'=>$entrance->on_mode_color_2,'off_mode_color_1'=>$entrance->off_mode_color_1,'off_mode_color_2'=>$entrance->off_mode_color_2,
						'on_mode_align_text'=>$entrance->on_mode_align_text,'off_mode_align_text'=>$entrance->off_mode_align_text,'on_mode_image'=>$entrance->on_mode_image,
						'sequence_text'=>$entrance->sequence_text,'sequence_key'=>'LED_SEQUENCE_'.$input,'is_copy'=>$entrance->is_copy,
						'off_mode_image'=>$entrance->off_mode_image,'led_motor_config'=>$entrance->led_motor_config,
						'off_sequence_text'=>$entrance->off_sequence_text,'sequence_number'=>$input,'on_sequence_text_name'=>$entrance->on_sequence_text_name,
						'off_sequence_text_name'=>$entrance->off_sequence_text_name,'select_button_type'=>$entrance->select_button_type
						);
		VehicleEntranceWestBuilding::updateOrCreate(array('vehicle_id'=>$vehicle_id,'sequence_name'=>'LED_SEQUENCE_'.$input),$insert_new_array);
		return true;
	}
	
	public function entranceWestBuildingClone(Request $request){
		$input = $request->all();
		if($request->type == 'json_file'){
			$entranceWestss = VehicleEntranceWestBuilding::where('user_id',Auth::user()->id)->get();
			$finalArray = array();
			foreach($entranceWestss as $entranceWests){
				$finalArray[$entranceWests->sequence_name] = array(
									'on_mode'=>array(
											'_id'=>$entranceWests->_id,'user_id'=>$entranceWests->user_id,'sequence_name'=>$entranceWests->sequence_name,
											'is_copy'=>$entranceWests->is_copy,'on_mode_color_1'=>$entranceWests->on_mode_color_1,'on_mode_color_2'=>$entranceWests->on_mode_color_2,
											'on_mode_align_text'=>$entranceWests->on_mode_align_text,'on_mode_image'=>$entranceWests->on_mode_image
									),
									'off_mode'=>array(
											'_id'=>$entranceWests->_id,'user_id'=>$entranceWests->user_id,'sequence_name'=>$entranceWests->sequence_name,
											'is_copy'=>$entranceWests->is_copy,'off_mode_color_1'=>$entranceWests->off_mode_color_1,'off_mode_color_2'=>$entranceWests->off_mode_color_2,
											'off_mode_align_text'=>$entranceWests->off_mode_align_text,'off_mode_image'=>$entranceWests->off_mode_image
								));
			}
			return response()->json(array('status'=>1,'data'=>$finalArray));
		}else if($request->type == 'change_button_position'){
			VehicleEntranceWestBuilding::where('vehicle_id',$request->vehicle_id)->where('sequence_name',$request->sequence_name)->update(array('sequence_key'=>$request->sequence_key));
			return response()->json(true);
		}else if($request->type == 'entrance-motor-config'){
			$ledMotor = VehicleLedMotorExcelSheet::select('excel_leds')->where('vehicle_id',$request->vehicle_id)->first();
			$ledMotor_array = ($ledMotor) ? true:false;
			return response()->json($ledMotor_array);
		}else if($request->type == 'led-sequence-config'){
			$entrance = VehicleEntranceWestBuilding::select('button_title')->where('vehicle_id',$request->vehicle_id)->where('is_copy','1')->where('select_button_type','led')->count();
			return response()->json($entrance);
		}else if($request->type == 'get_entrance_west_building'){
			$entrance_array = (object)array();
			$userUniq = UserUniqData::where('vehicle_id',$request->vehicle_id)->first();
			if($userUniq){
				$entrance_array->on_mode_color_2 = $userUniq->on_mode_color_2;
				$entrance_array->off_mode_color_2 = $userUniq->off_mode_color_2;
			}
			$entrance = VehicleEntranceWestBuilding::where('vehicle_id',$request->vehicle_id)->where('sequence_key',$request->sequence_name)->first();
			if($entrance){
				$entrance_array = $entrance;
			}
			return response()->json($entrance_array);
		}else if($request->type == 'change_button_title'){
			VehicleEntranceWestBuilding::updateOrCreate(array('vehicle_id'=>$request->vehicle_id,'sequence_key'=>$request->sequence_name),array('button_title'=>$request->button_title));
			return response()->json(true);
		}else if($request->type == 'delete_led_sequence'){
			$entrance = VehicleEntranceWestBuilding::where('vehicle_id',$request->vehicle_id)->where('sequence_key',$request->sequence_name)->delete();
			return response()->json(array('status'=>true));
		}else if($request->type == 'save-entrance-west-building'){
			$inputData = array(
							'vehicle_id'=>$request->vehicle_id,'on_mode_color_1'=>$request->on_mode_color_1,'button_title'=>$request->button_title,
							'on_mode_color_2'=>$request->on_mode_color_2,'off_mode_color_1'=>$request->off_mode_color_1,'off_mode_color_2'=>$request->off_mode_color_2,
							'on_mode_align_text'=>$request->on_mode_align_text,'off_mode_align_text'=>$request->off_mode_align_text,
							'led_motor_config'=>$request->led_motor_config,'select_button_type'=>$request->select_button_type
				);
			if ($request->on_mode_image) {
				$inputData['on_mode_image'] = $request->on_mode_image;
			}else{
				$inputData['on_mode_image'] = '';
			}
			if ($request->off_mode_image) {
				$inputData['off_mode_image'] = $request->off_mode_image;
			}else{
				$inputData['off_mode_image'] = '';
			}
			if($request->sequence_name){
				$inputData['sequence_name'] = $request->sequence_name;
				$inputData['sequence_number'] = (int)ltrim($request->sequence_name,"LED_SEQUENCE_");
				$inputData['sequence_text'] = ($request->sequence_text) ? $request->sequence_text : '';
				$inputData['off_sequence_text'] = ($request->off_sequence_text) ? $request->off_sequence_text: '';
				$inputData['on_sequence_text_name'] = ($request->on_sequence_text_name) ? $request->on_sequence_text_name: '';
				$inputData['off_sequence_text_name'] = ($request->off_sequence_text_name) ? $request->off_sequence_text_name: '';
				$inputData['sequence_key'] = $request->sequence_name;
			}
			$inputData['is_copy'] = '1';
			UserUniqData::updateOrCreate(array('vehicle_id'=>$request->vehicle_id),array('on_mode_color_2'=>$request->on_mode_color_2,'off_mode_color_2'=>$request->off_mode_color_2));
			VehicleEntranceWestBuilding::updateOrCreate(array('vehicle_id'=>$request->vehicle_id,'sequence_name'=>$request->sequence_name),$inputData);
			return response()->json(array('status'=>1));
		}else if($request->type == 'button_clone'){
			$inputData = array(
							'vehicle_id'=>$request->vehicle_id,'on_mode_color_1'=>$request->on_mode_color_1,'button_title'=>$request->button_title,
							'on_mode_color_2'=>$request->on_mode_color_2,'off_mode_color_1'=>$request->off_mode_color_1,
							'off_mode_color_2'=>$request->off_mode_color_2,'on_mode_align_text'=>$request->on_mode_align_text,
							'off_mode_align_text'=>$request->off_mode_align_text,'led_motor_config'=>$request->led_motor_config,
							'select_button_type'=>$request->select_button_type
				);
			if($request->on_mode_image) {
				$inputData['on_mode_image'] = $request->on_mode_image;
			}else{
				$inputData['on_mode_image'] = '';
			}
			if($request->off_mode_image) {
				$inputData['off_mode_image'] = $request->off_mode_image;
			}else{
				$inputData['off_mode_image'] = '';
			}
			if($request->sequence_name){
				$inputData['sequence_name'] = $request->sequence_name;
				$inputData['sequence_number'] = (int)ltrim($request->sequence_name,"LED_SEQUENCE_");
				$inputData['sequence_text'] = ($request->sequence_text) ? $request->sequence_text : '';
				$inputData['off_sequence_text'] = ($request->off_sequence_text) ? $request->off_sequence_text: '';
				$inputData['on_sequence_text_name'] = ($request->on_sequence_text_name) ? $request->on_sequence_text_name: '';
				$inputData['off_sequence_text_name'] = ($request->off_sequence_text_name) ? $request->off_sequence_text_name: '';
				$inputData['sequence_key'] = $request->sequence_name;
			}
				$inputData['is_copy'] = '1';
			
			VehicleEntranceWestBuilding::updateOrCreate(array('vehicle_id'=>$request->vehicle_id,'sequence_name'=>$request->sequence_name),$inputData);
			$sequence__name = $request->sequence_name;
			$sequence_name = (int)ltrim($sequence__name,"LED_SEQUENCE_");
			$entrance = VehicleEntranceWestBuilding::where('vehicle_id',$request->vehicle_id)->orderBy('sequence_number','ASC')->get()->toArray();
			$entrance_array = array();
			foreach($entrance as $entra_nce){
				if(array_key_exists('sequence_number',$entra_nce)){
					if($entra_nce['sequence_number'] >= $sequence_name){
						$entrance_array[] = $entra_nce;
					}
				}
			}
			for($is = $sequence_name; $is < 144; $is++){
					$key = array_search($is, array_column($entrance_array, 'sequence_number'));
					if($key == ""){
						if($key === false){
							$this->some_function($is,$sequence__name,$request->vehicle_id);
							break;
						}
					}
			}
			return response()->json(array('status'=>1));
		}else if($request->type == 'clear_led_config'){
			LedMotorConfig::where('user_id',Auth::user()->id)->delete();
			return response()->json(array('status'=>1));
		}else if($request->type == 'change_button_name'){
			$entranceWest  = VehicleEntranceWestBuilding::where('vehicle_id',$request->vehicle_id)->where('sequence_key',$request->sequence_name)->first();
			if($entranceWest){
				if($entranceWest->led_motor_config == "on"){
					VehicleEntranceWestBuilding::where('_id',$entranceWest->id)->update(array('led_motor_config'=>"off"));
					return response()->json(array(
									'on_mode_image'=>$entranceWest->off_mode_image,'on_mode_color_2'=>$entranceWest->off_mode_color_2,
									'sequence_text'=>$entranceWest->off_sequence_text_name,'on_mode_align_text'=>$entranceWest->off_mode_align_text,
									'sequence_name'=>$entranceWest->sequence_name
								));
				}else{
					VehicleEntranceWestBuilding::where('_id',$entranceWest->id)->update(array('led_motor_config'=>"on"));
					return response()->json(array(
									'on_mode_image'=>$entranceWest->on_mode_image,'on_mode_color_2'=>$entranceWest->on_mode_color_2,
									'sequence_text'=>$entranceWest->on_sequence_text_name,'on_mode_align_text'=>$entranceWest->on_mode_align_text,
									'sequence_name'=>$entranceWest->sequence_name
								));
				}
			}else{
				return response()->json(array());
			}
		}else{
			$led_motor_config = LedMotorConfig::where('user_id',Auth::user()->id)->pluck('cordinate');
			$led_motor_configs = json_encode($led_motor_config,true);
			return response()->json($led_motor_configs);
		}
	}
	
	
	public function vehicleview($id)
    {
			$userForm = Vehicle::find($id);
			$settign_id = '?vehicle_id='.$id;
			$VehicleSetting = VehicleSetting::select('_id')->where('vehicle_id',$id)->first();
			$all_Vehicle = Vehicle::where('moter_type','!=','')->get();
			if($VehicleSetting)
			{
				$settign_id = $VehicleSetting->_id;
			}
			$carBrand = CarBrand::all();
			if(user_role() === 'admin')
				$user_all = User::where('role_id', '!=' , '0')->get();
			else
				$user_all = User::where('parent_id',Auth::user()->id)->get();
			
			// $userForm = (object)array(
								// 'id'=>$vichleData->_id,'brand'=>$vichleData->brand,'model'=>$vichleData->model,'art_no'=>$vichleData->art_no,'model_spec'=>$vichleData->model_spec,
								// 'release_year'=>$vichleData->release_year,'moter_type'=>$vichleData->moter_type,'horse_power'=>$vichleData->horse_power,
								// 'torque'=>$vichleData->torque,'km_h_0_100'=>$vichleData->km_h_0_100,'km_h_0_160'=>$vichleData->km_h_0_160,'deceleration_speed'=>$vichleData->deceleration_speed,'distance'=>$vichleData->distance,
								// 'km_h_100_0'=>$vichleData->km_h_100_0,'weight'=>$vichleData->weight,'max_weight'=>$vichleData->max_weight,
								// 'manufacturer'=>$vichleData->manufacturer,'scale'=>$vichleData->scale,'vehicle_type'=>$vichleData->vehicle_type,
								// 'special_car_specialization'=>$vichleData->special_car_specialization,'lenght'=>$vichleData->lenght,'length_front_of_car'=>$vichleData->length_front_of_car,
								// 'wheelbase'=>$vichleData->wheelbase,'track_width'=>$vichleData->track_width,'width'=>$vichleData->width,
								// 'wheel_diameter'=>$vichleData->wheel_diameter,'height'=>$vichleData->height,
								// );
			$page_info['page_title'] = 'Vehicle information';
			return view('admin/Vehicle/addvehicle')->with('all_user', $user_all)->with('all_Vehicle', $all_Vehicle)->with('settign_id', $settign_id)->with('carBrand', $carBrand)->with('userForm', $userForm)->with('page_info', $page_info)->with('formaction','vehicleview');
	}
	
	public function destroy($id)
    {
		$Users = Vehicle::find($id); // Can chain this line with the next one
		$Users->delete($id);
		VehicleSetting::where('vehicle_id',$id)->delete();
		echo json_encode(array('status'=>true,'message'=>'Vehicle successfully delete'));
    }
	
	public function getVehicleQrcode(Request $request)
	{
		if(file_exists(public_path('/qrcode/'.$request->id.'png'))){
			// echo json_encode(url('/public/qrcode/'.$request->id.'png'));
			echo '<img class="d-block w-100" src="'.url('/qrcode/'.$request->id.'png').'" alt="First slide">';
		}else{
			echo json_encode(url('/qrcode/qrcode.png'));
		}
	}

	public function redirectUrl($url)
	{
		return redirect(user_role().'/vehicle-setting/'.$url)->with('flash-message',$_GET['message']);
	}
	
}
