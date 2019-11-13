<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
		$userForm = (object)array('id'=>'','name'=>'','email'=>'','phone_no'=>'','image'=>'/public/assets/userimages/edit_profile_img.png');
		return view('admin/Setting/viewsetting')->with('userForm', $userForm)->with('formaction','/admin/users');
    }
	
	public function backgroundColor()
    {
		return view('admin/Setting/backgroundColor');
    }
	public function padLineColor()
    {
		return view('admin/Setting/padLineColor');
    }
	
}
