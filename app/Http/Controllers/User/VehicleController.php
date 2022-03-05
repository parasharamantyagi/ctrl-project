<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleSetting;
use App\UserSetting;
use App\UserUniqData;
use App\EntranceWestBuilding;
use App\UndoEntranceWestBuilding;
use App\LedMotorConfig;
use App\User;
use App\VehicleLogo;
use Auth;

class VehicleController extends Controller
{
    public function index()
    {
		$page_info['page_title'] = 'All Product';
		$vehicles = UserSetting::with('vehicle_info')->where('user_id',Auth::user()->id)->get();
		return view('user/Vehicle/viewvehicleinfoall')->with('page_info', $page_info)->with('vehicles',$vehicles);
	}
	
	public function store(Request $request)
    {
        $inputData = $request->all();
		$columns = array( 
                            0 =>'_id', 
                            1 =>'pad_background_color',
                            2=> 'daylight_auto_on',
							3=> 'front_motor',
							4=> 'pad_line_color'
                        );
	
		// $vehicles = Vehicle::select('brand','model','model_spec','release_year','weight','manufacturer','vehicle_type','width','height','wheel_diameter')->where('user_id',Auth::user()->id);
		
		$vehicles = UserSetting::with('vehicle_info')->where('user_id',Auth::user()->id);
		
		
		// $vehicles = VehicleSetting::with('getvehicle')->where('user_id',Auth::user()->id)->where('setting_status',"1");
		
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
            $search = $request->input('search.value');
            $posts =  $vehicles->where('brand', 'LIKE',"%{$search}%")->orWhere('model', 'LIKE',"%{$search}%")->orWhere('model_spec', 'LIKE',"%{$search}%")
                            ->skip($start)
                            ->take($limit)
                            ->orderBy($order,$dir)
                            ->get();
            $totalFiltered = $vehicles->where('brand', 'LIKE',"%{$search}%")->orWhere('model', 'LIKE',"%{$search}%")->orWhere('model_spec', 'LIKE',"%{$search}%")
                             ->count();
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $posts   
                    );
        return response()->json($json_data);
        // echo json_encode($json_data);
    }
	
	public function settingId($id)
    {
		$allVehicle = Vehicle::where('user_id',Auth::user()->id)->get();
		
		$vehicleSetting = UserSetting::with('vehicle_info')->where('_id',$id)->first();
		
		
		// $vehicleSetting = Vehicle::with(['vehicle_setting' => function($query){
				// $query->where('setting_status', '=',"1");
		// }])->where('_id',$id)->first();
		
		$page_info['page_title'] = 'Add Vehicle';
		return view('user/Vehicle/vehicle-setting')->with('page_info', $page_info)->with('allVehicle', $allVehicle)->with('vehicles', $vehicleSetting);		
	}
	
	public function editSettingId($id)
	{	
		$vichle_name =  Vehicle::select('_id','brand','model')->where('user_id',Auth::user()->id)->get();
		$vehicleSettingData = UserSetting::find($id);
		$page_info['page_title'] = 'Settings';
		return view('user/Setting/viewsetting')->with('userForm', $vehicleSettingData)->with('vichle_name',$vichle_name)->with('page_info', $page_info)->with('formaction','/user/settings-update');
	}
	
	public function ledMotorConfigUndo() {

		$led_motor_config = LedMotorConfig::where('user_id',Auth::user()->id)->orderBy("_id", "DESC")->take(1)->first();
		$led_motor_config->delete();
		return response()->json(array('status'=>true));
	}
	
	
	
	public function ledMotorConfigDefaultVal($input) {
		if(!$input){
			$entranceWest = array();
			for($i=1; $i<=6; $i++){
			$entranceWest[] = array(
							'user_id'=>Auth::user()->id,'is_copy'=>'1','sequence_name'=>'LED_SEQUENCE_'.$i,'sequence_text'=>'LED SEQUENCE '.$i,
							'on_mode_color_1'=>'#d1d1d2','on_mode_color_2'=>'#181921','off_mode_color_1'=>'#868e96','off_mode_color_2'=>'#f5d6d6',
							'on_mode_align_text'=>'Centre','off_mode_align_text'=>'Centre','on_mode_image'=>'','off_mode_image'=>''
							);
			}
			EntranceWestBuilding::insert($entranceWest);
		}
		return true;
	}
	
	
	public function ledMotorConfig() {
		$page_info['page_title'] = 'All Product';
		$options = 5;
		$vehicle_id = isset($_GET['vehicle_id']) ? $_GET['vehicle_id'] : '';
		$led_motor_config_all = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('vehicle_id',$vehicle_id)->where('is_copy','1')->get()->toArray();
		// $led_motor_config = count($led_motor_config_all->toArray());
		$ledMotorConfig = LedMotorConfig::where('user_id',Auth::user()->id)->pluck('cordinate');
		$ledMotorConfigs = json_encode($ledMotorConfig,true);
		
		// $led_motor_config_all = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('is_copy','1')->get()->toArray();
		
		$un_do = UndoEntranceWestBuilding::where('user_id',Auth::user()->id)->count();
		
		return view('user/let_motor_config_2')->with('page_info', $page_info)->with('vehicle_id', $vehicle_id)->with('ledMotor_buttons', $led_motor_config_all)->with('ledMotorConfigs', $ledMotorConfigs)->with('un_do',$un_do);
	}
	
	
	public function entranceWestBuilding() {
		$page_info['page_title'] = 'All Product';
		
		if(isset($_GET['name']) && $_GET['name'] == 'testing'){
			// EntranceWestBuilding::insert(array(
										// 'user_id'=>Auth::user()->id,'sequence_name'=>'LED_SEQUENCE_131',
										// 'on_mode_color_1'=>'#d1d1d2','on_mode_color_2'=>'#181921','off_mode_color_1'=>'#868e96','off_mode_color_2'=>'#f5d6d6',
										// 'on_mode_align_text'=>'left','off_mode_align_text'=>'left','on_mode_image'=>'assets/ctrlImages/on_mode_image5217191618513544.png',
										// 'sequence_text'=>'LED SEQUENCE 131','sequence_key'=>'LED_SEQUENCE_131','is_copy'=>'1'
							// ));
			// EntranceWestBuilding::where('sequence_key','LED_SEQUENCE_34')->delete();
			// EntranceWestBuilding::where('_id','6078951e480f2a574f3a8fd4')->update(array('sequence_key'=>'LED_SEQUENCE_95'));
			$led_motor_config_all = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('is_copy','1')->get()->toArray();

			// $led_motor_config_all = EntranceWestBuilding::where('user_id',Auth::user()->id)->delete();
			echo '<pre>';
			print_r($led_motor_config_all);
			die;
		}
		// 
		$entranceWest = (object)array('on_mode_color_1'=>'#d1d1d2','on_mode_color_2'=>'#181921','led_motor_config'=>'on','off_mode_color_1'=>'#868e96','off_mode_color_2'=>'#f5d6d6','on_mode_align_text'=>'Centre','off_mode_align_text'=>'Centre','off_mode_image'=>'','on_mode_image'=>'');
		if(isset($_GET['name'])){
			$page_name = $_GET['name'];
			$entranceWestss = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('sequence_name',$_GET['name'])->first();
			if($entranceWestss){
				$entranceWest = $entranceWestss;
				if(!$entranceWest->sequence_text){
					$entranceWest->sequence_text = '';
				}
				if(!$entranceWest->led_motor_config){
					$entranceWest->led_motor_config = 'on';
				}
				if(!$entranceWest->off_sequence_text){
					$entranceWest->off_sequence_text = '';
				}
				if(!$entranceWest->sequence_key){
					$entranceWest->sequence_key = $entranceWest->sequence_name;
				}
			}else{
				$entranceWest->sequence_name = $_GET['name'];
				$entranceWest->sequence_text = '';
				$entranceWest->off_sequence_text = '';
				$entranceWest->sequence_key = $_GET['name'];
			}
		}else{
			$led_motor_config = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('is_copy','1')->count();
			$numbert_page = $led_motor_config + 1;
			$page_name = 'LED_SEQUENCE_'.$numbert_page;
			$entranceWest->sequence_name = $page_name;
			$entranceWest->sequence_key = $entranceWest->sequence_name;
			$entranceWest->sequence_text = '';
			$entranceWest->off_sequence_text = '';
		}
		return view('user/entrance_west_building')->with('page_info', $page_info)->with('entranceWest', $entranceWest)->with('page_name', $page_name);
	}
	
	public function entranceWestBuildingPost(Request $request){
			// $request->vehicle_id
			$inputData = array(
							'user_id'=>Auth::user()->id,'button_title'=>$request->button_title,'vehicle_id'=>$request->vehicle_id,
							'on_mode_color_1'=>$request->on_mode_color_1,'on_mode_color_2'=>$request->on_mode_color_2,
							'off_mode_color_1'=>$request->off_mode_color_1,'off_mode_color_2'=>$request->off_mode_color_2,
							'on_mode_align_text'=>$request->on_mode_align_text,'off_mode_align_text'=>$request->off_mode_align_text,
							'led_motor_config'=>$request->led_motor_config,'select_button_type'=>$request->select_button_type
				);
			if ($request->on_mode_image) {
				$inputData['on_mode_image'] = $request->on_mode_image;
			}
			if ($request->off_mode_image) {
				$inputData['off_mode_image'] = $request->off_mode_image;
			}
			if($request->sequence_name){
				$inputData['sequence_name'] = $request->sequence_name;
				$inputData['sequence_number'] = ltrim($request->sequence_name,"LED_SEQUENCE_");
				$inputData['sequence_text'] = $request->sequence_text;
				$inputData['off_sequence_text'] = $request->off_sequence_text;
				$inputData['on_sequence_text_name'] = $request->on_sequence_text_name;
				$inputData['off_sequence_text_name'] = $request->off_sequence_text_name;
				$inputData['sequence_key'] = $request->sequence_name;
			}
				$inputData['is_copy'] = '1';
			$checkint = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('vehicle_id',$request->vehicle_id)->where('sequence_name',$request->sequence_name)->first();
			if($checkint){
				$checkintArray = $checkint->toArray();
				unset($checkintArray['_id']);
				$checkintArray['entrance_west_building_id'] = $checkint->_id;
				UndoEntranceWestBuilding::insert($checkintArray);
			}
			UserUniqData::updateOrCreate(array('user_id'=>Auth::user()->id),array('on_mode_color_2'=>$request->on_mode_color_2,'off_mode_color_2'=>$request->off_mode_color_2));
			$insert_id = EntranceWestBuilding::updateOrCreate(array('user_id'=>Auth::user()->id,'vehicle_id'=>$request->vehicle_id,'sequence_name'=>$request->sequence_name),$inputData);
		return response()->json(array('status'=>1));
	}
	
	public function settingsUpdate(Request $request)
	{
		$inputData = $request->all();
		$setting_id = $request->input('id');
		$vehicle_id = $request->input('vehicle_id');
		unset($inputData["_token"]);
		unset($inputData["id"]);
		unset($inputData["vehicle_id"]);
		UserSetting::where('_id',$setting_id)->update($inputData);
		// $vechileData = VehicleSetting::select('vehicle_id')->find($setting_id);
		$returnmessage = array('status'=>true,'action'=>'update_form','vehicle_id'=>$vehicle_id,'message'=>'Vehicle setting has been update');
		echo json_encode($returnmessage);
	}
	
	public function redirectUrl($url)
	{
		return redirect(user_role().'/'.$url)->with('flash-message',$_GET['message']);
	}
	
	
	
	public function getVehicleQrcode($id)
	{	
		if(file_exists(public_path('/qrcode/'.$id.'png')))
			echo json_encode(url('/public/qrcode/'.$id.'png'));
		else
			echo json_encode(url('/public/qrcode/qrcode.png'));
	}
	
	public function some_function($input,$sequence__name,$vehicle_id){
		
		$entrance = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('vehicle_id',$vehicle_id)->where('sequence_name',$sequence__name)->first();
		// return response()->json($entrance);
		$insert_new_array = array(
						'user_id'=>Auth::user()->id,'vehicle_id'=>$vehicle_id,'sequence_name'=>'LED_SEQUENCE_'.$input,'on_mode_color_1'=>$entrance->on_mode_color_1,'button_title'=>$entrance->button_title,
						'on_mode_color_2'=>$entrance->on_mode_color_2,'off_mode_color_1'=>$entrance->off_mode_color_1,'off_mode_color_2'=>$entrance->off_mode_color_2,
						'on_mode_align_text'=>$entrance->on_mode_align_text,'off_mode_align_text'=>$entrance->off_mode_align_text,'on_mode_image'=>$entrance->on_mode_image,
						'sequence_text'=>$entrance->sequence_text,'sequence_key'=>'LED_SEQUENCE_'.$input,'is_copy'=>$entrance->is_copy,
						'off_mode_image'=>$entrance->off_mode_image,'led_motor_config'=>$entrance->led_motor_config,'off_sequence_text'=>$entrance->off_sequence_text,'sequence_number'=>$input,
						'on_sequence_text_name'=>$entrance->on_sequence_text_name,'off_sequence_text_name'=>$entrance->off_sequence_text_name
						);
		EntranceWestBuilding::updateOrCreate(array('user_id'=>Auth::user()->id,'vehicle_id'=>$vehicle_id,'sequence_name'=>'LED_SEQUENCE_'.$input),$insert_new_array);
		return true;
	}
	
	public function ledMotorConfig_cordinate($input)
    {
		$result = array('cordinate_of_x'=>0,'cordinate_of_y'=>0);
		$number = (int)ltrim($input, 'LED_SEQUENCE_') - 1;
		
		$ave_num = $number % 12;
		$result['cordinate_of_x'] = $ave_num * 220;
		
		$ave_num_2 = floor($number / 12);
		$result['cordinate_of_y'] = $ave_num_2 * 140;
		return $result;
    }
	
	public function entranceWestBuildingClone(Request $request){
		$input = $request->all();
		if($request->type == 'json_file'){
			// 'vehicle_id'=>$request->vehicle_id
			$entranceWestss = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('vehicle_id',$request->vehicle_id)->get();
			$finalArray = array();
			
			foreach($entranceWestss as $entranceWests){
				$sequence_key = $this->ledMotorConfig_cordinate($entranceWests->sequence_key);
				$finalArray[$entranceWests->sequence_name] = array(
									'on_mode'=>array(
											'_id'=>$entranceWests->_id,'user_id'=>$entranceWests->user_id,'sequence_name'=>$entranceWests->sequence_name,'sequence_text'=>$entranceWests->sequence_text,
											'is_copy'=>$entranceWests->is_copy,'on_mode_color_1'=>$entranceWests->on_mode_color_1,'on_mode_color_2'=>$entranceWests->on_mode_color_2,
											'on_mode_align_text'=>$entranceWests->on_mode_align_text,'on_mode_image'=>$entranceWests->on_mode_image,
											'cordinate_of_x'=>$sequence_key['cordinate_of_x'],'cordinate_of_y'=>$sequence_key['cordinate_of_y']
									),
									'off_mode'=>array(
											'_id'=>$entranceWests->_id,'user_id'=>$entranceWests->user_id,'sequence_name'=>$entranceWests->sequence_name,'off_sequence_text'=>$entranceWests->off_sequence_text,
											'is_copy'=>$entranceWests->is_copy,'off_mode_color_1'=>$entranceWests->off_mode_color_1,'off_mode_color_2'=>$entranceWests->off_mode_color_2,
											'off_mode_align_text'=>$entranceWests->off_mode_align_text,'off_mode_image'=>$entranceWests->off_mode_image,
											'cordinate_of_x'=>$sequence_key['cordinate_of_x'],'cordinate_of_y'=>$sequence_key['cordinate_of_y']
								));
			}
			return response()->json(array('status'=>1,'data'=>$finalArray));
		}else if($request->type == 'led_undo'){
			$checkint = UndoEntranceWestBuilding::where('user_id',Auth::user()->id)->orderBy('_id','DESC')->first();
			if($checkint){
				$checkintArray = $checkint->toArray();
				$entrance_west_building_id = $checkint->entrance_west_building_id;
				unset($checkintArray['entrance_west_building_id']);
				unset($checkintArray['updated_at']);
				unset($checkintArray['created_at']);
				unset($checkintArray['_id']);
				unset($checkintArray['user_id']);
				EntranceWestBuilding::where('_id',$entrance_west_building_id)->update($checkintArray);
				$checkint->delete();
			}
			return response()->json(array('status'=>true));
		}else if($request->type == 'change_button_position'){
			EntranceWestBuilding::where('user_id',Auth::user()->id)->where('vehicle_id',$request->vehicle_id)->where('sequence_name',$request->sequence_name)->update(array('sequence_key'=>$request->sequence_key));
			return response()->json(true);
		}else if($request->type == 'change_button_title'){
			EntranceWestBuilding::updateOrCreate(array('user_id'=>Auth::user()->id,'vehicle_id'=>$request->vehicle_id,'sequence_key'=>$request->sequence_name),array('button_title'=>$request->button_title));
			return response()->json(true);
		}else if($request->type == 'save_cordinate'){
			LedMotorConfig::insert(array('user_id'=>Auth::user()->id,'cordinate'=>$request->cordinate));
			// $ledMotorConfig = LedMotorConfig::all();
			return response()->json(true);
		}else if($request->type == 'get_entrance_west_building'){
			$entrance_array = array('on_mode_color_1'=>'#181921','on_mode_color_2'=>'#181921','off_mode_color_1'=>'#181921','off_mode_color_2'=>'#181921','button_title'=>false);
			$userUniq = UserUniqData::where('user_id',Auth::user()->id)->first();
			if($userUniq){
				if($userUniq->on_mode_color_2){
					$entrance_array['on_mode_color_2'] = $userUniq->on_mode_color_2;
					$entrance_array['off_mode_color_2'] = $userUniq->on_mode_color_2;
				}
				if($userUniq->off_mode_color_2){
					$entrance_array['on_mode_color_2'] = $userUniq->off_mode_color_2;
					$entrance_array['off_mode_color_2'] = $userUniq->off_mode_color_2;
				}
				// if($userUniq->button_title){
					// $entrance_array['button_title'] = $userUniq->button_title;
				// }
			}
			$entrance = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('vehicle_id',$request->vehicle_id)->where('sequence_key',$request->sequence_name)->first();
			if($entrance){
				// $entrance->on_mode_color_2 = $entrance_array['on_mode_color_2'];
				// $entrance->off_mode_color_2 = $entrance_array['off_mode_color_2'];
				// $entrance->button_title = $entrance_array['button_title'];
				return response()->json($entrance);
			}else{
				return response()->json($entrance_array);
			}
			
		}else if($request->type == 'delete_led_sequence'){
			$entrance = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('vehicle_id',$request->vehicle_id)->where('sequence_key',$request->sequence_name)->delete();
			return response()->json(array('status'=>1));
		}else if($request->type == 'button_clone'){
			
			$inputData = array(
							'user_id'=>Auth::user()->id,'button_title'=>$request->button_title,'vehicle_id'=>$request->vehicle_id,
							'on_mode_color_1'=>$request->on_mode_color_1,'on_mode_color_2'=>$request->on_mode_color_2,
							'off_mode_color_1'=>$request->off_mode_color_1,'off_mode_color_2'=>$request->off_mode_color_2,
							'on_mode_align_text'=>$request->on_mode_align_text,'off_mode_align_text'=>$request->off_mode_align_text,
							'led_motor_config'=>$request->led_motor_config,'select_button_type'=>$request->select_button_type
				);
			if ($request->on_mode_image) {
				$inputData['on_mode_image'] = $request->on_mode_image;
			}
			if ($request->off_mode_image) {
				$inputData['off_mode_image'] = $request->off_mode_image;
			}
			if($request->sequence_name){
				$inputData['sequence_name'] = $request->sequence_name;
				$inputData['sequence_number'] = ltrim($request->sequence_name,"LED_SEQUENCE_");
				$inputData['sequence_text'] = $request->sequence_text;
				$inputData['off_sequence_text'] = $request->off_sequence_text;
				$inputData['on_sequence_text_name'] = ($request->on_sequence_text_name) ? $request->on_sequence_text_name: '';
				$inputData['off_sequence_text_name'] = ($request->off_sequence_text_name) ? $request->off_sequence_text_name: '';
				$inputData['sequence_key'] = $request->sequence_name;
			}
				$inputData['is_copy'] = '1';
			EntranceWestBuilding::updateOrCreate(array('user_id'=>Auth::user()->id,'vehicle_id'=>$request->vehicle_id,'sequence_name'=>$request->sequence_name),$inputData);
			
			
			$sequence__name = $request->sequence_name;
			$sequence_name = (int)ltrim($sequence__name,"LED_SEQUENCE_");
			$entrance = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('vehicle_id',$request->vehicle_id)->where('sequence_number','>=',$sequence_name)->orderBy('sequence_number','ASC')->get()->toArray();
			
			
			for($is = $sequence_name+1; $is < 144; $is++){
					$key = array_search($is, array_column($entrance, 'sequence_number'));
					if($key == ""){
						$this->some_function($is,$sequence__name,$request->vehicle_id);
						break;
					}
			}
			return response()->json(array('status'=>1));
		}else if($request->type == 'clear_led_config'){
			LedMotorConfig::where('user_id',Auth::user()->id)->delete();
			return response()->json(array('status'=>1));
		}else if($request->type == 'change_button_name'){
			$entranceWest  = EntranceWestBuilding::where('user_id',Auth::user()->id)->where('vehicle_id',$request->vehicle_id)->where('sequence_key',$request->sequence_name)->first();
			if($entranceWest->led_motor_config == "on"){
				EntranceWestBuilding::where('_id',$entranceWest->id)->update(array('led_motor_config'=>"off"));
				$on_mode_image_val = array(
								'on_mode_color_2'=>$entranceWest->off_mode_color_2,
								'sequence_text'=>$entranceWest->off_sequence_text_name,
								'on_mode_align_text'=>$entranceWest->off_mode_align_text,
								'sequence_name'=>$entranceWest->sequence_name
							);
				if($entranceWest->off_mode_image){
					$on_mode_image_val['on_mode_image'] = $entranceWest->off_mode_image;
				}else{
					$on_mode_image_val['on_mode_image'] = 'assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_13.png';
				}
				return response()->json($on_mode_image_val);
			}else{
				EntranceWestBuilding::where('_id',$entranceWest->id)->update(array('led_motor_config'=>"on"));
				return response()->json(array(
								'on_mode_image'=>$entranceWest->on_mode_image,'on_mode_color_2'=>$entranceWest->on_mode_color_2,
								'sequence_text'=>$entranceWest->on_sequence_text_name,'on_mode_align_text'=>$entranceWest->on_mode_align_text,
								'sequence_name'=>$entranceWest->sequence_name
							));
			}
		}else{
			$led_motor_config = LedMotorConfig::where('user_id',Auth::user()->id)->pluck('cordinate');
			$led_motor_configs = json_encode($led_motor_config,true);
			return response()->json($led_motor_configs);
		}
	}
	
	public function vehicleSettingStatus(Request $request)
	{
		$inputData = $request->all();
		$setting_status = ($request->input('status') == "true") ? '1':'0';
		VehicleSetting::where('_id', $request->input('id'))->update(array("setting_status"=>$setting_status));
		$returnmessage = array('status'=>true,'message'=>'Vehicle setting status has been update');
		echo json_encode($returnmessage);
	}
	
	public function test()
    {
		$allVehicle = Vehicle::first();
		pr($allVehicle->toArray());
		// $vehicleSetting = Vehicle::with('vehicle_setting')->where('_id',$id)->first();
		// $page_info['page_title'] = 'Add Vehicle';
		// return view('user/Vehicle/vehicle-setting')->with('page_info', $page_info)->with('allVehicle', $allVehicle)->with('vehicles', $vehicleSetting);		
	}
	
	public function multimediaId($id)
	{	
		$vechileForm_1 = array(
								'vehicle_id'=>'','brand'=>'','pad2_image'=>'assets/ctrlImages/multimedia/default/white.jpg','logo_image'=>'assets/ctrlImages/multimedia/default/white.jpg','pad4_image'=>'assets/ctrlImages/multimedia/default/white.jpg',
								'icone_image'=>'assets/ctrlImages/multimedia/default/white.jpg','pad3_image'=>'assets/ctrlImages/multimedia/default/white.jpg','larger_logo'=>'assets/ctrlImages/multimedia/default/white.jpg',
								'p_pad2_image'=>'No file chosen','full_screen_movie_links'=>'','p_logo_image'=>'No file chosen','p_icone_image'=>'No file chosen','p_pad3_image'=>'No file chosen','p_pad4_image'=>'No file chosen',
								'p_start_engine_sound'=>'No file chosen','p_idle_motor_sound'=>'No file chosen','p_acceleration_sound'=>'No file chosen','p_deceleration_sound'=>'No file chosen','p_larger_logo'=>'No file chosen',
								'p_gear_shift_sound_1'=>'No file chosen','p_gear_shift_sound_2'=>'No file chosen','p_shut_off_sound'=>'No file chosen','p_blinkers_sound'=>'No file chosen','p_horn_sound'=>'No file chosen'
							);
		$vechileForm_2 = array();
		$vechileForm_db = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image','larger_logo','pad4_image','p_pad2_image','full_screen_movie_links','p_logo_image','p_icone_image','p_pad3_image','p_larger_logo','p_pad4_image','p_start_engine_sound','p_idle_motor_sound','p_acceleration_sound','p_deceleration_sound','p_gear_shift_sound_1','p_gear_shift_sound_2','p_shut_off_sound','p_blinkers_sound','p_horn_sound');
		$vechileForm_db_user_setting_id = $vechileForm_db->where('user_setting_id',$id)->first();
		// pr($vechileForm_db_user_setting_id->delete());
		if(!$vechileForm_db_user_setting_id){
			
			$vechileForm_db = VehicleLogo::select('vehicle_id','pad2_image','logo_image','icone_image','pad3_image','larger_logo','pad4_image','p_pad2_image','full_screen_movie_links','p_logo_image','p_icone_image','p_pad3_image','p_larger_logo','p_pad4_image','p_start_engine_sound','p_idle_motor_sound','p_acceleration_sound','p_deceleration_sound','p_gear_shift_sound_1','p_gear_shift_sound_2','p_shut_off_sound','p_blinkers_sound','p_horn_sound');
			$vehicleSettingData = UserSetting::find($id);
			$vechileForm_db_user_setting_id = $vechileForm_db->where('vehicle_id',$vehicleSettingData->vehicle_id)->first();
			// 5ef978bb5da0ec4301385874
		}
		
		if($vechileForm_db_user_setting_id){
			$vechileForm_2 = $vechileForm_db_user_setting_id->toArray();
		}
		$result = array_merge($vechileForm_1, $vechileForm_2);
		$result['logo_image_size'] = getimagesize(url($result['logo_image']));
		$page_info['page_title'] = 'Multimedia';
		return view('user/Vehicle/multimedia')->with('userForm', $result)->with('setting_id', $id)->with('page_info', $page_info);					
		// $vichle_name =  Vehicle::select('_id','brand','model')->where('user_id',Auth::user()->id)->get();
		// $vehicleSettingData = UserSetting::find($id);
		// pr($vehicleSettingData->toArray());
		
		// $page_info['page_title'] = 'Settings';
		// return view('user/Setting/viewsetting')->with('userForm', $vehicleSettingData)->with('vichle_name',$vichle_name)->with('page_info', $page_info)->with('formaction','/user/settings-update');
	}
	
	public function multimediaIdPost(Request $request, $id){
		$inputData = $request->all();
		$vehicleSettingData = UserSetting::find($id);
		$vehicleLogo_db = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image','larger_logo','pad4_image','p_pad2_image','full_screen_movie_links','p_logo_image','p_icone_image','p_pad3_image','p_larger_logo','p_pad4_image','p_start_engine_sound','p_idle_motor_sound','p_acceleration_sound','p_deceleration_sound','p_gear_shift_sound_1','p_gear_shift_sound_2','p_shut_off_sound','p_blinkers_sound','p_horn_sound')->where('vehicle_id',$vehicleSettingData->vehicle_id)->where('user_setting_id',"1")->first()->toArray();
		$saveData = array('user_setting_id'=>$id);
		// $vechileForm_db = Vehicle::with('vehicle_logo')->select('brand')->find($_GET['vehicle_id']);
		$brand_name = 'user';
		// if($vechileForm_db){
			// $brand_name = strtolower(str_replace(' ', '', $vechileForm_db->brand));
		// }
		$saveData['vehicle_id'] = $vehicleSettingData->vehicle_id;
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
		if ($request->hasFile('gear_shift_sound_1')) {
				   $gear_shift_sound_1 = $request->file('gear_shift_sound_1'); //get the file
				   $namefile = $brand_name.'-gear_shift_sound_1' . rand(1,999999) .time() . '.' . $gear_shift_sound_1->getClientOriginalExtension();
				   $p_gear_shift_sound_1 = $gear_shift_sound_1->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $gear_shift_sound_1->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['gear_shift_sound_1'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_gear_shift_sound_1'] = $p_gear_shift_sound_1;
			}
		if ($request->hasFile('gear_shift_sound_2')) {
				   $gear_shift_sound_2 = $request->file('gear_shift_sound_2'); //get the file
				   $namefile = $brand_name.'-gear_shift_sound_2' . rand(1,999999) .time() . '.' . $gear_shift_sound_2->getClientOriginalExtension();
				   $p_gear_shift_sound_2 = $gear_shift_sound_2->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $gear_shift_sound_2->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['gear_shift_sound_2'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_gear_shift_sound_2'] = $p_gear_shift_sound_2;
			}
		if ($request->hasFile('shut_off_sound')) {
				   $shut_off_sound = $request->file('shut_off_sound'); //get the file
				   $namefile = $brand_name.'-shut_off_sound' . rand(1,999999) .time() . '.' . $shut_off_sound->getClientOriginalExtension();
				   $p_shut_off_sound = $shut_off_sound->getClientOriginalName();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $shut_off_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['shut_off_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
				   $saveData['p_shut_off_sound'] = $p_shut_off_sound;
			}
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
		$saveData = array_filter($saveData);
		$vechileForm_db = VehicleLogo::select('vehicle_id')->where('user_setting_id',$id)->first();
		if(!$vechileForm_db){
			$saveData = array_merge($vehicleLogo_db, $saveData);
			// $vehicleLogo_db
		}
		VehicleLogo::updateOrCreate(array('user_setting_id' =>$id),$saveData);
		return redirect(user_role().'/multimedia/'.$id)->with('flash-message','Data update successfully');
		
	}
	
}
