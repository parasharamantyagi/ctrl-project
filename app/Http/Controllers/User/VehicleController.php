<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleSetting;
use App\User;
use Auth;

class VehicleController extends Controller
{
    public function index()
    {
		$page_info['page_title'] = 'View Vehicle';
		return view('user/Vehicle/viewvehicleinfoall')->with('page_info', $page_info);
	}
	
	public function store(Request $request)
    {
        $inputData = $request->all();
		$columns = array( 
                            0 =>'brand', 
                            1 =>'model',
                            2=> 'model_spec',
                            3=> 'release_year',
                            4=> 'weight',
                            5=> 'manufacturer',
                            6=> 'vehicle_type',
                            7=> 'width',
                            8=> 'height',
                            9=> 'wheel_diameter'
                        );
	
		$vehicles = Vehicle::select('brand','model','model_spec','release_year','weight','manufacturer','vehicle_type','width','height','wheel_diameter')->where('user_id',Auth::user()->id);
			
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
	
	public function settingId($id)
    {
		$allVehicle = Vehicle::where('user_id',Auth::user()->id)->get();
		$vehicleSetting = Vehicle::with(['vehicle_setting' => function($query){
				$query->where('setting_status', '=',"1");
		}])->where('_id',$id)->first();
		$page_info['page_title'] = 'Add Vehicle';
		return view('user/Vehicle/vehicle-setting')->with('page_info', $page_info)->with('allVehicle', $allVehicle)->with('vehicles', $vehicleSetting);		
	}
	
	public function editSettingId($id)
	{	
		$vichle_name =  Vehicle::select('_id','brand','model')->where('user_id',Auth::user()->id)->get();
		$vehicleSettingData = VehicleSetting::find($id);
		$page_info['page_title'] = 'Settings';
		return view('user/Setting/viewsetting')->with('userForm', $vehicleSettingData)->with('vichle_name',$vichle_name)->with('page_info', $page_info)->with('formaction','/user/settings-update');
	}
	
	public function settingsUpdate(Request $request)
	{
		$inputData = $request->all();
		$setting_id = $request->input('id');
		unset($inputData["_token"]);
		unset($inputData["id"]);
		VehicleSetting::where('_id',$setting_id)->update($inputData);
		$vechileData = VehicleSetting::select('vehicle_id')->find($setting_id);
		$returnmessage = array('status'=>true,'action'=>'update_form','vehicle_id'=>$vechileData->vehicle_id,'message'=>'Vehicle setting has been update');
		echo json_encode($returnmessage);
	}
	
	public function redirectUrl($url)
	{
		return redirect(user_role().'/setting/'.$url)->with('flash-message',$_GET['message']);
	}
	
	
	
	public function getVehicleQrcode($id)
	{	
		if(file_exists(public_path('/qrcode/'.$id.'png')))
			echo json_encode(url('/public/qrcode/'.$id.'png'));
		else
			echo json_encode(url('/public/qrcode/qrcode.png'));
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
	
	// public function show($id)
    // {	
			// if(user_role() === 'admin')
				// $user_all = User::where('role_id', '!=' , '0')->get();
			// else
				// $user_all = User::where('parent_id',Auth::user()->id)->get();
			
			// $vichleData = Vehicle::find($id);
			// $userForm = (object)array(
								// 'id'=>$vichleData->_id,'user_id'=>$vichleData->user_id,'brand'=>$vichleData->brand,'model'=>$vichleData->model,'model_spec'=>$vichleData->model_spec,
								// 'release_year'=>$vichleData->release_year,'moter_type'=>$vichleData->moter_type,'horse_power'=>$vichleData->horse_power,
								// 'torque'=>$vichleData->torque,'km_h_0_100'=>$vichleData->km_h_0_100,'km_h_0_160'=>$vichleData->km_h_0_160,
								// 'km_h_100_0'=>$vichleData->km_h_100_0,'weight'=>$vichleData->weight,'max_weight'=>$vichleData->max_weight,
								// 'manufacturer'=>$vichleData->manufacturer,'scale'=>$vichleData->scale,'vehicle_type'=>$vichleData->vehicle_type,
								// 'special_car_specialization'=>$vichleData->special_car_specialization,'lenght'=>$vichleData->lenght,'length_front_of_car'=>$vichleData->length_front_of_car,
								// 'wheelbase'=>$vichleData->wheelbase,'track_width'=>$vichleData->track_width,'width'=>$vichleData->width,
								// 'wheel_diameter'=>$vichleData->wheel_diameter,'height'=>$vichleData->height,
								// );
			// $page_info['page_title'] = 'Edit Vehicle';
			// return view('admin/Vehicle/addvehicle')->with('all_user', $user_all)->with('userForm', $userForm)->with('page_info', $page_info)->with('formaction','/admin/vehicleUpdate');
	// }
	
	// public function vehicleUpdate(Request $request)
	// {
		// $inputData = $request->all();
		// $vehicle_id = $request->input('id');
		// unset($inputData["id"]);
		// unset($inputData["_token"]);
		// Vehicle::where('_id', $vehicle_id)->update($inputData);
		// $returnmessage = array('status'=>true,'action'=>'updateVehicle','message'=>'Vehicle has been update');
		// echo json_encode($returnmessage);
	// }
	

	
	// public function vehicleTable(Request $request)
	// {
		// $inputData = $request->all();
		// $columns = array( 
                            // 0 =>'brand', 
                            // 1 =>'model',
                            // 2=> 'model_spec',
                            // 3=> 'release_year',
                            // 4=> 'weight',
                            // 5=> 'manufacturer',
                            // 6=> 'vehicle_type',
                            // 7=> 'width',
                            // 8=> 'wheel_diameter'
                        // );
		// if(user_role() === 'admin')
				// $vehicles = Vehicle::select('brand','model','model_spec','release_year','weight','manufacturer','vehicle_type','width','wheel_diameter');
			// else
				// $vehicles = Vehicle::select('brand','model','model_spec','release_year','weight','manufacturer','vehicle_type','width','wheel_diameter')->where('user_id',Auth::user()->id)->orWhere('from_id',Auth::user()->id);
			
			
		// $totalData = $vehicles->count();
		// $totalFiltered = $totalData;
		
		// $limit = (int)$request->input('length');
        // $start = (int)$request->input('start');
        // $order = $columns[$request->input('order.0.column')];
        // $dir = $request->input('order.0.dir');
		
		// if(empty($request->input('search.value')))
        // {            
            // $posts = $vehicles->skip($start)
                         // ->take($limit)
                         // ->orderBy($order,$dir)
                         // ->get();
        // }
        // else {
            // $search = $request->input('search.value');
            // $posts =  $vehicles->where('brand', 'LIKE',"%{$search}%")->orWhere('model', 'LIKE',"%{$search}%")->orWhere('model_spec', 'LIKE',"%{$search}%")
                            // ->skip($start)
                            // ->take($limit)
                            // ->orderBy($order,$dir)
                            // ->get();
            // $totalFiltered = $vehicles->where('brand', 'LIKE',"%{$search}%")->orWhere('model', 'LIKE',"%{$search}%")->orWhere('model_spec', 'LIKE',"%{$search}%")
                             // ->count();
        // }
          
        // $json_data = array(
                    // "draw"            => intval($request->input('draw')),  
                    // "recordsTotal"    => intval($totalData),  
                    // "recordsFiltered" => intval($totalFiltered), 
                    // "data"            => $posts   
                    // );
            
        // echo json_encode($json_data);
	// }
		
}
