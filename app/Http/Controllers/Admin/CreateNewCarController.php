<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Vehicle;
use App\EditTable;
use Auth;

class CreateNewCarController extends Controller
{
    public function index()
    {
		$page_info['page_title'] = 'Manage Table';
		return view('admin/CreateNewCar/createcar')->with('page_info', $page_info);
    }
	
	public function store(Request $request)
    {
		// $inputData = $request->all();
		// echo json_encode($returnmessage);
	}
	
	public function createExcelSheet()
    {
		$page_info['page_title'] = 'Excel sheet';
		return view('admin/CreateNewCar/createExcelSheet')->with('page_info', $page_info);
	}
}
