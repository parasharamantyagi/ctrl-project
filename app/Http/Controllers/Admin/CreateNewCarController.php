<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Vehicle;
use App\EditTable;
use App\CreateNewCar;
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
		$inputData = array('user_id'=>Auth::user()->id,'data_leds'=>$request->data_leds);
		CreateNewCar::updateOrCreate(array('user_id' =>Auth::user()->id),$inputData);
		$returnmessage = array('status'=>true,'message'=>'Data has been save');
		echo json_encode($returnmessage);
	}
	
	public function show($id)
	{
		$inputData = CreateNewCar::all();
		pr($inputData->toArray());
	}
	
	public function createExcelSheet()
    {
		$createNewCar = CreateNewCar::select('data_leds')->where('user_id',Auth::user()->id);
		$page_info['page_title'] = 'Excel sheet';
		$page_info['error'] = '';
		$page_info['inputData_val'] = $createNewCar->first()->data_leds;
		if($createNewCar->count())
			$jsonData = '{
										  "X-Light" : {
											"bit" : 1
										  },
										  "DayLight" : {
											"bit" : 2
										  },
										  "Low beam" : {
											"bit" : 3
										  },
										  "High beam" : {
											"bit" : 8
										  },
										  "Biinkers left" : {
											"bit" : 9
										  },
										  "Biinkers right" : {
											"bit" : 10
										  },
										  "Rear Light" : {
											"bit" : 11
										  }
										}';
		else
			$jsonData = '{"leds":[{"pin":"","color":"","position":""}]}';
		// pr($page_info['inputData']);
		$page_info['inputData'] = json_encode(json_decode($jsonData,true),true);
		return view('admin/CreateNewCar/createExcelSheet')->with('page_info',$page_info);
	}
	
	public function createExcelSheetPost(Request $request)
	{
		// $inputData = $request->username;
		$createNewCar = CreateNewCar::select('data_leds')->where('user_id',Auth::user()->id);
		$page_info['inputData_val'] = $createNewCar->first()->data_leds;
		if ($request->hasFile('jsonfile')) {
				
				// $validatedData = \Validator::make([
					// 'jsonfile' => 'mimes:json',
				// ]);
				// if(!$validatedData->fails())
				// {
					$file = file_get_contents($request->file('jsonfile'));
					$page_info['page_title'] = 'Excel sheet';
					$page_info['inputData'] = json_encode(json_decode($file,true),true);
					$page_info['error'] = '';
					return view('admin/CreateNewCar/createExcelSheet')->with('page_info',$page_info);
				// }else{
					// die('ssssssssssss');
				// }
		}else{
				echo 'file is not exits';
		}
		// pr($sadasdas);
		// echo $inputData;
		die;
	}
}











