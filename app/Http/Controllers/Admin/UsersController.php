<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// $imageName = 'example.png';
		// $fullpath = human_file_size($imageName);
		$userData = User::all();
		return view('admin/User/viewuser')->with('users', $userData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	   $userForm = (object)array('id'=>'','name'=>'','email'=>'','phone_no'=>'','image'=>'/public/assets/userimages/edit_profile_img.png');
	   return view('admin/User/adduser')->with('userForm', $userForm)->with('formaction','/admin/users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputData = $request->all();
		$countUser = User::where('email', $inputData['email'])->count();
		if($countUser) {
			$returnmessage = array('status'=>false,'message'=>'Email already exit');
		}else{
			$imageName = "userdefault.png";
			if ($request->hasFile('userimage')) {  //check the file present or not
				   $image = $request->file('userimage'); //get the file
				   $namefile = 'profile-photo-' . rand(1,999999) .time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
				   $destinationPath = public_path('/assets/userimages'); //public path folder dir
				   $image->move($destinationPath, $namefile);  //mve to destination you mentioned 
				   $imageName = $namefile;
			   }
			$inputData['image'] = $imageName;
			unset($inputData["id"]);
			unset($inputData["_token"]);
			unset($inputData["userimage"]);
			User::insert($inputData);
			$returnmessage = array('status'=>true,'message'=>'User has been save');
		}
		echo json_encode($returnmessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $userData = User::find($id);
	   $userForm = (object)array('id'=>$id,'name'=>$userData->name,'email'=>$userData->email,'phone_no'=>$userData->phone_no,'image'=>'/public/assets/userimages/'.$userData->image);
	   return view('admin/User/adduser')->with('userForm', $userForm)->with('formaction','/admin/usersUpdate');
    }
	
	public function usersUpdate(Request $request)
	{
		$inputData = $request->all();
		
		$countUser = User::where('_id',"!=",$request->input('id'))->where('email',$request->input('email'))->count();
		if($countUser) {
			$returnmessage = array('status'=>false,'message'=>'Email already exit');
		}else{
		$resultArray = array('name'=>$request->input('name'),'email'=>$request->input('email'),'phone_no'=>$request->input('phone_no'));
		if ($request->hasFile('userimage')) {  //check the file present or not
				   $image = $request->file('userimage'); //get the file
				   $namefile = 'profile-photo-' . rand(1,999999) .time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
				   $destinationPath = public_path('/assets/userimages'); //public path folder dir
				   $image->move($destinationPath, $namefile);  //mve to destination you mentioned 
				   $resultArray['image'] = $namefile;
			   }
		$userData = User::where('_id', $request->input('id'))->update($resultArray);
		$returnmessage = array('status'=>true,'message'=>'User has been update');
		}
		echo json_encode($returnmessage);
	}
	
	public function userTable(Request $request)
	{
		$inputData = $request->all();
		
		echo '<pre>';
		print_r($inputData);
		die;
	}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userData = User::all();
		echo '<pre>';
		print_r($userData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$Users = User::find($id); // Can chain this line with the next one
		$Users->delete($id);
		echo json_encode(array('status'=>true,'message'=>'User successfully delete'));
        // print_r($ids);	
    }
	
	
}












