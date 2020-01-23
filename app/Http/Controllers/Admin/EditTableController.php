<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Vehicle;
use App\EditTable;
use Auth;

class EditTableController extends Controller
{
    public function index()
    {
		if(user_role() === 'admin')
				$vichle_name =  Vehicle::select('_id','brand','model')->get();
			else
				$vichle_name =  Vehicle::select('_id','brand','model')->where('user_id',Auth::user()->id)->orWhere('from_id',Auth::user()->id)->get();
		if(user_role() === 'admin')
				$users = User::select('_id','name','email')->where('role_id', '!=' , '0')->get();
			else
				$users = User::select('_id','name','email')->where('parent_id',Auth::user()->id)->get();
		$EditTable = EditTable::where('user_id',strval(Auth::user()->id))->first();
		$page_info['page_title'] = 'Manage Table';
		return view('admin/Table/viewtable')->with('page_info', $page_info)->with('vichle_name', $vichle_name)->with('users', $users)->with('editTable', $EditTable);
    }
	
	public function store(Request $request)
    {
		$inputData = $request->all();
		$vehicle_id = ($request->input('vehicle_id')) ? implode(',',$request->input('vehicle_id')) : 0;
		$users = ($request->input('users')) ? implode(',',$request->input('users')) : 0;
		$user_id = strval(Auth::user()->id);
		EditTable::updateOrCreate(array('user_id' => $user_id),array('vehicle_id'=>$vehicle_id,'user_id'=>$user_id,'users'=>$users));
		$returnmessage = array('status'=>true,'message'=>'Setting add successfully');
		echo json_encode($returnmessage);
	}
}
