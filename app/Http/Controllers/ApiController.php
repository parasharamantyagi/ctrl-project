<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Role;


class ApiController extends Controller
{
	
	public function getRoles()
    {
		$inputData = Role::all();
		// $inputData = Role::create(array('roll_id'=>1,'roll'=>'Admin'));
		// $inputData = Role::create(array('roll_id'=>2,'roll'=>'Manufacturer'));
		// $inputData = Role::create(array('roll_id'=>3,'roll'=>'User'));
		return response()->json($inputData);
    }
	
	
}