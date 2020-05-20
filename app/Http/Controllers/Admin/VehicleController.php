<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleSetting;
use App\User;
// use App\CarModel;
use App\CarBrand;
use App\VehicleLogo;
use Auth;

class VehicleController extends Controller
{
	public function __construct(){
		$this->vechile_info = (object)array(
									'id'=>'','brand'=>'','model'=>'','model_spec'=>'',
									'release_year'=>'','art_no'=>'','moter_type'=>'','horse_power'=>'',
									'torque'=>'','km_h_0_100'=>'','km_h_0_160'=>'','deceleration_speed'=>'','distance'=>'',
									'km_h_100_0'=>'','weight'=>'','max_weight'=>'',
									'manufacturer'=>'','scale'=>'1:87','vehicle_type'=>'',
									'special_car_specialization'=>'','lenght'=>'','length_front_of_car'=>'',
									'wheelbase'=>'','track_width'=>'','width'=>'',
									'max_rpm'=>0,'idle_rpm'=>800,'gearbox_amount_of_gears'=>0,'max_speed_per_gears'=>'',
									'wheel_diameter'=>'','height'=>'',
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
		$insertId = Vehicle::insertGetId($inputData);
		$returnmessage = array('status'=>true,'action'=>'storeVehicle','insert_id'=>strval($insertId),'message'=>'Vehicle has been save');
		echo json_encode($returnmessage);
    }
	
	public function getVehicleId($id)
	{
		$vechile = Vehicle::find($id);
		return response()->json($vechile);
	}
	
	public function multimediaAction()
	{
		$vechileForm_1 = array(
								'vehicle_id'=>'','brand'=>'','pad2_image'=>'assets/ctrlImages/multimedia/default/white.jpg','logo_image'=>'assets/ctrlImages/multimedia/default/white.jpg',
								'icone_image'=>'assets/ctrlImages/multimedia/default/white.jpg','pad3_image'=>'assets/ctrlImages/multimedia/default/white.jpg'
							);
		$vechileForm_2 = array();
		$setting_id = '';
		if(isset($_GET['vehicle_id']) && !empty($_GET['vehicle_id'])) {
			$setting_id = '?vehicle_id='.$_GET['vehicle_id'];
			$vechile_setting = VehicleSetting::select('_id')->where('vehicle_id',$_GET['vehicle_id'])->first();
			if($vechile_setting){
				$setting_id = '/'.$vechile_setting->_id;
			}
			
			$vechile_db = Vehicle::select('brand')->find($_GET['vehicle_id']);
			if($vechile_db){
				$brand_name = strtolower(str_replace(' ', '', $vechile_db->brand));
				$vechileForm_db = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image')->where('brand',$brand_name)->first();
			}else{
				$vechileForm_db = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image')->where('vehicle_id',$_GET['vehicle_id'])->first();
			}
			if($vechileForm_db){
				$vechileForm_2 = $vechileForm_db->toArray();
			}
		}
		$result = array_merge($vechileForm_1, $vechileForm_2);
		$page_info['page_title'] = 'Multimedia';
		return view('admin/Vehicle/multimedia')->with('userForm', $result)->with('setting_id', $setting_id)->with('page_info', $page_info);
	}
	
	
	public function multimediaActionPost(Request $request)
	{
		$inputData = $request->all();
		$saveData = array('vehicle_id'=>$request->vehicle_id);
		$vechileForm_db = Vehicle::select('brand')->find($_GET['vehicle_id']);
		$brand_name = '';
		if($vechileForm_db){
			$brand_name = strtolower(str_replace(' ', '', $vechileForm_db->brand));
		}
		$saveData['brand'] = $brand_name;
		if ($request->hasFile('pad2_image')) {
				   $pad2_image = $request->file('pad2_image'); //get the file
				   $namefile = $brand_name.'-pad2_image' . rand(1,999999) .time() . '.' . $pad2_image->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $pad2_image->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['pad2_image'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		if ($request->hasFile('logo_image')) {
				   $logo_image = $request->file('logo_image'); //get the file
				   $namefile = $brand_name.'-logo_image' . rand(1,999999) .time() . '.' . $logo_image->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $logo_image->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['logo_image'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		if ($request->hasFile('icone_image')) {
				   $icone_image = $request->file('icone_image'); //get the file
				   $namefile = $brand_name.'-icone_image' . rand(1,999999) .time() . '.' . $icone_image->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $icone_image->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['icone_image'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		if ($request->hasFile('pad3_image')) {
				   $pad3_image = $request->file('pad3_image'); //get the file
				   $namefile = $brand_name.'-pad3_image' . rand(1,999999) .time() . '.' . $pad3_image->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $pad3_image->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['pad3_image'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		if ($request->hasFile('start_engine_sound')) {
				   $start_engine_sound = $request->file('start_engine_sound'); //get the file
				   $namefile = $brand_name.'-start_engine_sound' . rand(1,999999) .time() . '.' . $start_engine_sound->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $start_engine_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['start_engine_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		if ($request->hasFile('idle_motor_sound')) {
				   $idle_motor_sound = $request->file('idle_motor_sound'); //get the file
				   $namefile = $brand_name.'-idle_motor_sound' . rand(1,999999) .time() . '.' . $idle_motor_sound->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $idle_motor_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['idle_motor_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		if ($request->hasFile('acceleration_sound')) {
				   $acceleration_sound = $request->file('acceleration_sound'); //get the file
				   $namefile = $brand_name.'-acceleration_sound' . rand(1,999999) .time() . '.' . $acceleration_sound->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $acceleration_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['acceleration_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		if ($request->hasFile('deceleration_sound')) {
				   $deceleration_sound = $request->file('deceleration_sound'); //get the file
				   $namefile = $brand_name.'-deceleration_sound' . rand(1,999999) .time() . '.' . $deceleration_sound->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $deceleration_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['deceleration_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		if ($request->hasFile('gear_shift_sound_1')) {
				   $gear_shift_sound_1 = $request->file('gear_shift_sound_1'); //get the file
				   $namefile = $brand_name.'-gear_shift_sound_1' . rand(1,999999) .time() . '.' . $gear_shift_sound_1->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $gear_shift_sound_1->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['gear_shift_sound_1'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		if ($request->hasFile('gear_shift_sound_2')) {
				   $gear_shift_sound_2 = $request->file('gear_shift_sound_2'); //get the file
				   $namefile = $brand_name.'-gear_shift_sound_2' . rand(1,999999) .time() . '.' . $gear_shift_sound_2->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $gear_shift_sound_2->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['gear_shift_sound_2'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		if ($request->hasFile('shut_off_sound')) {
				   $shut_off_sound = $request->file('shut_off_sound'); //get the file
				   $namefile = $brand_name.'-shut_off_sound' . rand(1,999999) .time() . '.' . $shut_off_sound->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $shut_off_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['shut_off_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		if ($request->hasFile('blinkers_sound')) {
				   $blinkers_sound = $request->file('blinkers_sound'); //get the file
				   $namefile = $brand_name.'-blinkers_sound' . rand(1,999999) .time() . '.' . $blinkers_sound->getClientOriginalExtension();
				   $destinationPath = public_path('/assets/ctrlImages/multimedia'); //public path folder dir
				   $blinkers_sound->move($destinationPath, $namefile);  //mve to destination you mentioned
				   $saveData['blinkers_sound'] = 'assets/ctrlImages/multimedia/'.$namefile;
			}
		VehicleLogo::updateOrCreate(array('vehicle_id' =>$inputData["vehicle_id"]),$saveData);
		return redirect(user_role().'/multimedia?vehicle_id='.$inputData['vehicle_id'])->with('flash-message','Data update successfully');
	}
	
	public function carButton()
	{
		$vechileForm_1 = array('vehicle_id'=>'','brand'=>'','pad2_image'=>'default/pad_2@2x.png','logo_image'=>'default/white.jpg','icone_image'=>'default/white.jpg','pad3_image'=>'default/pad_3@2x.png');
		$vechileForm_2 = array();
		$setting_id = '';
		if(isset($_GET['vehicle_id']) && !empty($_GET['vehicle_id'])) {
			$setting_id = '?vehicle_id='.$_GET['vehicle_id'];
			$vechile_setting = VehicleSetting::select('_id')->where('vehicle_id',$_GET['vehicle_id'])->first();
			if($vechile_setting){
				$setting_id = '/'.$vechile_setting->_id;
			}
			
			$vechile_db = Vehicle::select('brand')->find($_GET['vehicle_id']);
			if($vechile_db){
				$brand_name = strtolower(str_replace(' ', '', $vechile_db->brand));
				$vechileForm_db = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image')->where('brand',$brand_name)->first();
			}else{
				$vechileForm_db = VehicleLogo::select('pad2_image','logo_image','icone_image','pad3_image')->where('vehicle_id',$_GET['vehicle_id'])->first();
			}
			if($vechileForm_db){
				$vechileForm_2 = $vechileForm_db->toArray();
			}
		}
		$result = array_merge($vechileForm_1, $vechileForm_2);
		$page_info['page_title'] = 'Buttons';
		return view('admin/Vehicle/carbutton')->with('userForm', $result)->with('setting_id', $setting_id)->with('page_info', $page_info);
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
		Vehicle::where('_id', $vehicle_id)->update($inputData);
		$returnmessage = array('status'=>true,'action'=>'updateVehicle','vehicle_id'=>$vehicle_id,'message'=>'Vehicle has been update');
		echo json_encode($returnmessage);
	}
	
	public function viewVehicleAll()
	{
		$page_info['page_title'] = 'All product';
		$vichleData = Vehicle::all();
		return view('admin/Vehicle/viewvehicleinfoall')->with('page_info', $page_info)->with('all_Vehicle', $vichleData);
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
        echo json_encode($json_data);
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
		if(file_exists(public_path('/qrcode/'.$request->id.'png')))
			echo json_encode(url('/public/qrcode/'.$request->id.'png'));
		else
			echo json_encode(url('/public/qrcode/qrcode.png'));
	}

	public function redirectUrl($url)
	{
		return redirect(user_role().'/vehicle-setting/'.$url)->with('flash-message',$_GET['message']);
	}
	
}
