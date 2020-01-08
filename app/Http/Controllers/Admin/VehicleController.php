<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
use App\User;
use Auth;

class VehicleController extends Controller
{
    public function index()
    {
		if(user_role() === 'admin')
				$user_all = User::where('role_id', '!=' , '0')->get();
			else
				$user_all = User::where('parent_id',Auth::user()->id)->get();
			
			
		$userForm = (object)array(
								'id'=>'','user_id'=>'','brand'=>'','model'=>'','model_spec'=>'',
								'release_year'=>'','moter_type'=>'','horse_power'=>'',
								'torque'=>'','km_h_0_100'=>'','km_h_0_160'=>'',
								'km_h_100_0'=>'','weight'=>'','max_weight'=>'',
								'manufacturer'=>'','scale'=>'','vehicle_type'=>'',
								'special_car_specialization'=>'','lenght'=>'','length_front_of_car'=>'',
								'wheelbase'=>'','track_width'=>'','width'=>'',
								'wheel_diameter'=>'','height'=>'',
								);
		$page_info['page_title'] = 'Add Vehicle';
		return view('admin/Vehicle/addvehicle')->with('all_user', $user_all)->with('userForm', $userForm)->with('page_info', $page_info)->with('formaction','/admin/vehicle');
    }
	
	public function store(Request $request)
    {
        $inputData = $request->all();
		unset($inputData["id"]);
		unset($inputData["_token"]);
		$inputData["from_id"] = Auth::user()->id;
		Vehicle::insert($inputData);
		$returnmessage = array('status'=>true,'action'=>'storeVehicle','message'=>'Vehicle has been save');
		echo json_encode($returnmessage);
    }
	
	public function show($id)
    {	
			if(user_role() === 'admin')
				$user_all = User::where('role_id', '!=' , '0')->get();
			else
				$user_all = User::where('parent_id',Auth::user()->id)->get();
			
			$vichleData = Vehicle::find($id);
			$userForm = (object)array(
								'id'=>$vichleData->_id,'user_id'=>$vichleData->user_id,'brand'=>$vichleData->brand,'model'=>$vichleData->model,'model_spec'=>$vichleData->model_spec,
								'release_year'=>$vichleData->release_year,'moter_type'=>$vichleData->moter_type,'horse_power'=>$vichleData->horse_power,
								'torque'=>$vichleData->torque,'km_h_0_100'=>$vichleData->km_h_0_100,'km_h_0_160'=>$vichleData->km_h_0_160,
								'km_h_100_0'=>$vichleData->km_h_100_0,'weight'=>$vichleData->weight,'max_weight'=>$vichleData->max_weight,
								'manufacturer'=>$vichleData->manufacturer,'scale'=>$vichleData->scale,'vehicle_type'=>$vichleData->vehicle_type,
								'special_car_specialization'=>$vichleData->special_car_specialization,'lenght'=>$vichleData->lenght,'length_front_of_car'=>$vichleData->length_front_of_car,
								'wheelbase'=>$vichleData->wheelbase,'track_width'=>$vichleData->track_width,'width'=>$vichleData->width,
								'wheel_diameter'=>$vichleData->wheel_diameter,'height'=>$vichleData->height,
								);
			$page_info['page_title'] = 'Edit Vehicle';
			return view('admin/Vehicle/addvehicle')->with('all_user', $user_all)->with('userForm', $userForm)->with('page_info', $page_info)->with('formaction','/admin/vehicleUpdate');
	}
	
	public function vehicleUpdate(Request $request)
	{
		$inputData = $request->all();
		$vehicle_id = $request->input('id');
		unset($inputData["id"]);
		unset($inputData["_token"]);
		Vehicle::where('_id', $vehicle_id)->update($inputData);
		$returnmessage = array('status'=>true,'action'=>'updateVehicle','message'=>'Vehicle has been update');
		echo json_encode($returnmessage);
	}
	
	public function viewVehicleAll()
	{
		// if(user_role() === 'admin')
				// $vehicles = Vehicle::all();
			// else
				// $vehicles = Vehicle::where('user_id',Auth::user()->id)->orWhere('from_id',Auth::user()->id)->get();
		$page_info['page_title'] = 'Add Vehicle';
		return view('admin/Vehicle/viewvehicleinfoall')->with('page_info', $page_info);
	}
	
	public function vehicleTable(Request $request)
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
                            8=> 'wheel_diameter'
                        );
		if(user_role() === 'admin')
				$vehicles = Vehicle::select('brand','model','model_spec','release_year','weight','manufacturer','vehicle_type','width','wheel_diameter');
			else
				$vehicles = Vehicle::select('brand','model','model_spec','release_year','weight','manufacturer','vehicle_type','width','wheel_diameter')->where('user_id',Auth::user()->id)->orWhere('from_id',Auth::user()->id);
			
			
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
			$vichleData = Vehicle::find($id);
			if(user_role() === 'admin')
				$user_all = User::where('role_id', '!=' , '0')->get();
			else
				$user_all = User::where('parent_id',Auth::user()->id)->get();
			
			
			
			$userForm = (object)array(
								'id'=>$vichleData->_id,'user_id'=>$vichleData->user_id,'brand'=>$vichleData->brand,'model'=>$vichleData->model,'model_spec'=>$vichleData->model_spec,
								'release_year'=>$vichleData->release_year,'moter_type'=>$vichleData->moter_type,'horse_power'=>$vichleData->horse_power,
								'torque'=>$vichleData->torque,'km_h_0_100'=>$vichleData->km_h_0_100,'km_h_0_160'=>$vichleData->km_h_0_160,
								'km_h_100_0'=>$vichleData->km_h_100_0,'weight'=>$vichleData->weight,'max_weight'=>$vichleData->max_weight,
								'manufacturer'=>$vichleData->manufacturer,'scale'=>$vichleData->scale,'vehicle_type'=>$vichleData->vehicle_type,
								'special_car_specialization'=>$vichleData->special_car_specialization,'lenght'=>$vichleData->lenght,'length_front_of_car'=>$vichleData->length_front_of_car,
								'wheelbase'=>$vichleData->wheelbase,'track_width'=>$vichleData->track_width,'width'=>$vichleData->width,
								'wheel_diameter'=>$vichleData->wheel_diameter,'height'=>$vichleData->height,
								);
			$page_info['page_title'] = 'Vehicle information';
			return view('admin/Vehicle/addvehicle')->with('all_user', $user_all)->with('userForm', $userForm)->with('page_info', $page_info)->with('formaction','vehicleview');
	}
	
	public function destroy($id)
    {
		$Users = Vehicle::find($id); // Can chain this line with the next one
		$Users->delete($id);
		echo json_encode(array('status'=>true,'message'=>'Vehicle successfully delete'));
        // print_r($ids);	
    }
	
	public function getVehicleQrcode($id)
	{	
		if(file_exists(public_path('/qrcode/'.$id.'png')))
			echo json_encode(url('/public/qrcode/'.$id.'png'));
		else
			echo json_encode(url('/public/qrcode/qrcode.png'));
	}

	public function redirectUrl($url)
	{
		return redirect(user_role().'/vehicle-setting/'.$url)->with('flash-message',$_GET['message']);
	}
	
	
}
