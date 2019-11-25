<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

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
		$page_info['page_title'] = 'All Users';
		return view('admin/User/viewuser')->with('page_info', $page_info)->with('users', $userData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	   $userForm = (object)array('id'=>'','name'=>'','email'=>'','role_id'=>'','phone_no'=>'','image'=>'/public/assets/userimages/edit_profile_img.png');
	   $page_info['page_title'] = 'Add User';
	   return view('admin/User/adduser')->with('page_info', $page_info)->with('userForm', $userForm)->with('formaction','/admin/users');
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
			$returnmessage = array('status'=>true,'action'=>'storeUser','message'=>'User has been save');
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
	   $userForm = (object)array('id'=>$id,'name'=>$userData->name,'email'=>$userData->email,'role_id'=>$userData->role_id,'phone_no'=>$userData->phone_no,'image'=>'/public/assets/userimages/'.$userData->image);
	   $page_info['page_title'] = 'Update User';
	   return view('admin/User/adduser')->with('page_info', $page_info)->with('userForm', $userForm)->with('formaction','/admin/usersUpdate');
    }
	
	public function usersUpdate(Request $request)
	{
		$inputData = $request->all();
		
		$countUser = User::where('_id',"!=",$request->input('id'))->where('email',$request->input('email'))->count();
		if($countUser) {
			$returnmessage = array('status'=>false,'message'=>'Email already exit');
		}else{
		$resultArray = array('name'=>$request->input('name'),'email'=>$request->input('email'),'role_id'=>$request->input('role_id'),'phone_no'=>$request->input('phone_no'));
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
		
		
		$columns = array( 
                            0 =>'name', 
                            1 =>'email',
                            2=> 'phone_no',
                            3=> 'image'
                        );
  
        $totalData = User::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = User::select('name','email','phone_no','image')->offset($start)
                         // ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 
            $posts =  User::select('name','email','phone_no','image')->where('name', 'LIKE',"%{$search}%")->orWhere('email', 'LIKE',"%{$search}%")->orWhere('phone_no', 'LIKE',"%{$search}%")
                            ->offset($start)
                            // ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
            $totalFiltered = User::select('name','email','phone_no','image')->where('name', 'LIKE',"%{$search}%")->orWhere('email', 'LIKE',"%{$search}%")->orWhere('phone_no', 'LIKE',"%{$search}%")
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
	
	public function viewProfile()
	{
		$userData = Auth::user();
		$page_info['page_title'] = 'Update Profile';
		return view('admin/User/viewprofile')->with('userForm', $userData)->with('page_info', $page_info)->with('formaction','/admin/userProfileUpdate');
	}
	
	public function userProfileUpdate(Request $request)
	{
		$inputData = $request->all();
		
		$updateData = array('name'=>$inputData['name'],'phone_no'=>$inputData['phone_no']);
		if($inputData['password'] && $inputData['confirm_password'] && $inputData['password'] == $inputData['confirm_password'])
		{
			$returnmessage = array('status'=>true,'message'=>'User has been update');
			$updateData['password'] = Hash::make($inputData['password']);
		}else if($inputData['password'] && $inputData['confirm_password'] && $inputData['password'] != $inputData['confirm_password']){
			$returnmessage = array('status'=>false,'message'=>'Your confirm password does not match');
			echo json_encode($returnmessage);
			die;
		}else if(!$inputData['password'] && !$inputData['confirm_password']){
			$returnmessage = array('status'=>true,'message'=>'User has been update');
		}else{
			$returnmessage = array('status'=>true,'message'=>'User has been update');
		}
		if ($request->hasFile('userimage')) {  //check the file present or not
				   $image = $request->file('userimage'); //get the file
				   $namefile = 'profile-photo-' . rand(1,999999) .time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
				   $destinationPath = public_path('/assets/userimages'); //public path folder dir
				   $image->move($destinationPath, $namefile);  //mve to destination you mentioned 
				   $updateData['image'] = $namefile;
			   }
		User::where('_id',Auth::user()->_id)->update($updateData);
		echo json_encode($returnmessage);
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












