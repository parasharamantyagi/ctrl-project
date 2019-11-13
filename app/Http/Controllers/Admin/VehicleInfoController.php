<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleInfoController extends Controller
{
    public function index()
    {
		return view('admin/VehicleInfo/viewvehicleinfo');
    }
	
	public function profile()
    {
		// return view('admin/VehicleInfo/viewvehicleinfo');
		// print_r(id);
		echo 'profile profile';
    }
	
	public function show($id)
    {
		return view('admin/VehicleInfo/profile');
    }
	
	
}
