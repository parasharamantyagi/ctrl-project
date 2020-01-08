<?php

namespace App\Http\Controllers\User;

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
		// $userData = User::all();
		// $page_info['page_title'] = 'All Users';
		// return view('admin/User/viewuser')->with('page_info', $page_info)->with('users', $userData);
		
	   $userData = User::find(Auth::user()->_id);
	   $userForm = (object)array('id'=>Auth::user()->_id,'name'=>$userData->name,'email'=>$userData->email,'phone_no'=>$userData->phone_no,'image'=>'/public/assets/userimages/'.$userData->image);
	   $page_info['page_title'] = 'Update User';
	   return view('user/User/adduser')->with('page_info', $page_info)->with('userForm', $userForm)->with('formaction','/user/profile');
    }

    
    public function store(Request $request)
    {
        $inputData = $request->all();
			if($inputData['password'] && $inputData['confirm_password'] && $inputData['password'] == $inputData['confirm_password'])
			{
				$userData['password'] = Hash::make($inputData['password']);
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
				   $userData['image'] = $namefile;   
			   }
			$userData['name'] = $inputData['name'];
			$userData['phone_no'] = $inputData['phone_no'];
			// unset($inputData["userimage"]);
			
			User::where('_id',Auth::user()->_id)->update($userData);
			$returnmessage = array('status'=>true,'action'=>'storeUser','email_id'=>Auth::user()->email,'message'=>'Your profile has been update');
			echo json_encode($returnmessage);
    }
	
	public function redirectUrl($url)
	{
		return redirect(user_role().'/'.$url)->with('flash-message',$_GET['message']);
	}

	
	
}












