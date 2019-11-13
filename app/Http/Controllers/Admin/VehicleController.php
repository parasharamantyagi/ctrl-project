<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;

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
		return view('admin/Vehicle/viewvehicle')->with('userForm', $userForm)->with('formaction','/admin/vehicle');
    }
	
	public function store(Request $request)
    {
        $inputData = $request->all();
		unset($inputData["id"]);
		unset($inputData["_token"]);
		Vehicle::insert($inputData);
		echo '<pre>';
		print_r($inputData);
		die;
        //
    }
	
	public function show($id)
    {
			// for($i = 2010 ; $i <= date('Y'); $i++){
				// $inputData[] = $i;
			  // echo "<option>$i</option>";
		   // }
			echo '<pre>';
			print_r(ctrl_year());
	}
}
