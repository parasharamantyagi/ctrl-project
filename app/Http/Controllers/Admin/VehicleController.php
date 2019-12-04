<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
use Auth;

class VehicleController extends Controller
{
    public function index()
    {
		$userForm = (object)array(
								'id'=>'','brand'=>'','model'=>'','model_spec'=>'',
								'release_year'=>'','moter_type'=>'','horse_power'=>'',
								'torque'=>'','km_h_0_100'=>'','km_h_0_160'=>'',
								'km_h_100_0'=>'','weight'=>'','max_weight'=>'',
								'manufacturer'=>'','scale'=>'','vehicle_type'=>'',
								'special_car_specialization'=>'','lenght'=>'','length_front_of_car'=>'',
								'wheelbase'=>'','track_width'=>'','width'=>'',
								'wheel_diameter'=>'','height'=>'',
								);
		$page_info['page_title'] = 'Add Vehicle';
		return view('admin/Vehicle/addvehicle')->with('userForm', $userForm)->with('page_info', $page_info)->with('formaction','/admin/vehicle');
    }
	
	public function store(Request $request)
    {
        $inputData = $request->all();
		unset($inputData["id"]);
		unset($inputData["_token"]);
		$inputData['user_id'] = Auth::user()->id;
		Vehicle::insert($inputData);
		$returnmessage = array('status'=>true,'action'=>'storeVehicle','message'=>'Vehicle has been save');
		echo json_encode($returnmessage);
    }
	
	public function show($id)
    {
			$vichleData = Vehicle::find($id);
			$userForm = (object)array(
								'id'=>$vichleData->_id,'brand'=>$vichleData->brand,'model'=>$vichleData->model,'model_spec'=>$vichleData->model_spec,
								'release_year'=>$vichleData->release_year,'moter_type'=>$vichleData->moter_type,'horse_power'=>$vichleData->horse_power,
								'torque'=>$vichleData->torque,'km_h_0_100'=>$vichleData->km_h_0_100,'km_h_0_160'=>$vichleData->km_h_0_160,
								'km_h_100_0'=>$vichleData->km_h_100_0,'weight'=>$vichleData->weight,'max_weight'=>$vichleData->max_weight,
								'manufacturer'=>$vichleData->manufacturer,'scale'=>$vichleData->scale,'vehicle_type'=>$vichleData->vehicle_type,
								'special_car_specialization'=>$vichleData->special_car_specialization,'lenght'=>$vichleData->lenght,'length_front_of_car'=>$vichleData->length_front_of_car,
								'wheelbase'=>$vichleData->wheelbase,'track_width'=>$vichleData->track_width,'width'=>$vichleData->width,
								'wheel_diameter'=>$vichleData->wheel_diameter,'height'=>$vichleData->height,
								);
			$page_info['page_title'] = 'Edit Vehicle';
			return view('admin/Vehicle/addvehicle')->with('userForm', $userForm)->with('page_info', $page_info)->with('formaction','/admin/vehicleUpdate');
	}
	
	public function vehicleUpdate(Request $request)
	{
		$inputData = $request->all();
		$vehicle_id = $request->input('id');
		unset($inputData["id"]);
		unset($inputData["_token"]);
		Vehicle::where('_id', $vehicle_id)->update($inputData);
		$returnmessage = array('status'=>true,'message'=>'Vehicle has been update');
		echo json_encode($returnmessage);
	}
	
	public function viewVehicleAll()
	{
		$vehicles = Vehicle::all();
		$page_info['page_title'] = 'Add Vehicle';
		return view('admin/Vehicle/viewvehicleinfoall')->with('page_info', $page_info)->with('vehicles', $vehicles);
	}
	
	public function vehicleview($id)
    {
			$vichleData = Vehicle::find($id);
			$userForm = (object)array(
								'id'=>$vichleData->_id,'brand'=>$vichleData->brand,'model'=>$vichleData->model,'model_spec'=>$vichleData->model_spec,
								'release_year'=>$vichleData->release_year,'moter_type'=>$vichleData->moter_type,'horse_power'=>$vichleData->horse_power,
								'torque'=>$vichleData->torque,'km_h_0_100'=>$vichleData->km_h_0_100,'km_h_0_160'=>$vichleData->km_h_0_160,
								'km_h_100_0'=>$vichleData->km_h_100_0,'weight'=>$vichleData->weight,'max_weight'=>$vichleData->max_weight,
								'manufacturer'=>$vichleData->manufacturer,'scale'=>$vichleData->scale,'vehicle_type'=>$vichleData->vehicle_type,
								'special_car_specialization'=>$vichleData->special_car_specialization,'lenght'=>$vichleData->lenght,'length_front_of_car'=>$vichleData->length_front_of_car,
								'wheelbase'=>$vichleData->wheelbase,'track_width'=>$vichleData->track_width,'width'=>$vichleData->width,
								'wheel_diameter'=>$vichleData->wheel_diameter,'height'=>$vichleData->height,
								);
			$page_info['page_title'] = 'Vehicle information';
			return view('admin/Vehicle/addvehicle')->with('userForm', $userForm)->with('page_info', $page_info)->with('formaction','vehicleview');
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
		// $Users = Vehicle::find($id); // Can chain this line with the next one
		echo json_encode(url('/public/qrcode/5dd2d7825da0ec04c20f9213png'));
	}

	
	
	
}
