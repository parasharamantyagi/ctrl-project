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
	   $userForm = (object)array('id'=>'','name'=>'','email'=>'','role_id'=>'','phone_no'=>'','image'=>'/public/assets/userimages/userdefault.png');
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
			$returnmessage = array('status'=>false,'type'=>'publisherEmailValidation','message'=>'Email already exit');
		}else{
			
			if($inputData['password'] && $inputData['confirm_password'] && $inputData['password'] == $inputData['confirm_password'])
			{
				$inputData['password'] = Hash::make($inputData['password']);
			}else if($inputData['password'] && $inputData['confirm_password'] && $inputData['password'] != $inputData['confirm_password']){
				$returnmessage = array('status'=>false,'type'=>'passwordcanformValidation','message'=>'Your confirm password does not match');
				echo json_encode($returnmessage);
				die;
			}

			$imageName = "userdefault.png";
			if ($request->hasFile('userimage')) {  //check the file present or not
				   $image = $request->file('userimage'); //get the file
				   $namefile = 'profile-photo-' . rand(1,999999) .time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
				   $destinationPath = public_path('/assets/userimages'); //public path folder dir
				   $image->move($destinationPath, $namefile);  //mve to destination you mentioned 
				   $imageName = $namefile;
			   }
			$inputData['image'] = $imageName;
			$inputData['parent_id'] = Auth::user()->_id;
			$inputData["status"] = '1';
			
			if(user_role() === 'admin')
				$inputData['role_id'] = $request->input('role_id');
			else
				$inputData['role_id'] = strval(my_role(3));
			
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
			$returnmessage = array('status'=>false,'type'=>'publisherEmailValidation','message'=>'Email already exit');
		}else{
		$resultArray = array('name'=>$request->input('name'),'email'=>$request->input('email'),'phone_no'=>$request->input('phone_no'));
		
		if(user_role() == 'admin')
			$resultArray = array_merge($resultArray,array('role_id'=>$request->input('role_id')));
		else
			$resultArray = array_merge($resultArray,array('role_id'=>strval(my_role(3))));
		
		if($inputData['password'] && $inputData['confirm_password'] && $inputData['password'] == $inputData['confirm_password'])
		{
			$resultArray['password'] = Hash::make($inputData['password']);
		}else if($inputData['password'] && $inputData['confirm_password'] && $inputData['password'] != $inputData['confirm_password']){
			$returnmessage = array('status'=>false,'type'=>'passwordcanformValidation','message'=>'Your confirm password does not match');
			echo json_encode($returnmessage);
			die;
		}
		
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
	
	public function userStatus(Request $request)
	{
		$inputData = $request->all();
		$status = ($request->input('status') == "true") ? '1':'0';
		User::where('_id', $request->input('id'))->update(array("status"=>$status));
		$returnmessage = array('status'=>true,'message'=>'User status has been update');
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
		$userrecord = User::select('name','email','phone_no','image','status');
		if(user_role() === 'admin')
				$userrecord = $userrecord->where('role_id','!=','0');
			else
				$userrecord = $userrecord->where('parent_id',Auth::user()->id);
		if($request->input('user_roll') ===  "0")
				$userrecord = $userrecord->where('role_id','!=','0');
			else
				$userrecord = $userrecord->where('role_id',$request->input('user_roll'));
		
		
		// $userrecord = User::select('name','email','phone_no','image','status');
        $totalData = $userrecord->count();
            
        $totalFiltered = $totalData; 

        $limit = (int)$request->input('length');
        $start = (int)$request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		
        if(empty($request->input('search.value')))
        {            
            $posts = $userrecord->skip($start)
                         ->take($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 
            $userrecord =  $userrecord->where(function($q) use ($search){
							$q->where('name', 'LIKE',"%{$search}%")->orWhere('email', 'LIKE',"%{$search}%")->orWhere('phone_no', 'LIKE',"%{$search}%");
							});
			$posts =  $userrecord->skip($start)
                            ->take($limit)
                            ->orderBy($order,$dir)
                            ->get();
            $totalFiltered = $userrecord->count();
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
		
		$returnmessage = array('status'=>true,'email_id'=>Auth::user()->email,'message'=>'User has been update');
		if($inputData['old_password'] && $inputData['new_password'] && $inputData['confirm_password'])
		{
			$user = User::find(Auth::user()->_id);
			$hasher = app('hash');
			if(!$hasher->check($inputData['old_password'],$user->password)){
				$returnmessage = array('status'=>false,'type'=>'old_passwordValidation','message'=>'Your old password does not match');
				die(json_encode($returnmessage));
			}else if($inputData['new_password'] && $inputData['confirm_password'] && $inputData['new_password'] == $inputData['confirm_password']){
				$updateData['password'] = Hash::make($inputData['new_password']);
				$returnmessage = array('status'=>true,'email_id'=>Auth::user()->email,'message'=>'User has been update');
			}else if($inputData['new_password'] && $inputData['confirm_password'] && $inputData['new_password'] != $inputData['confirm_password']){
				$returnmessage = array('status'=>false,'type'=>'passwordcanformValidation','message'=>'Your confirm password does not match');
				die(json_encode($returnmessage));
			}
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
    }
	
	public function redirectUrl($url)
	{
		return redirect(user_role().'/'.$url)->with('flash-message',$_GET['message']);
	}
	
	
}












