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
		
	   // $userData = User::find(Auth::user()->_id);
	   $userData = Auth::user();
	   // $userForm = (object)array('id'=>Auth::user()->_id,'name'=>$userData->name,'email'=>$userData->email,'phone_no'=>$userData->phone_no,'image'=>'/public/assets/userimages/'.$userData->image);
	   $page_info['page_title'] = 'Update User';
	   return view('user/User/adduser')->with('page_info', $page_info)->with('userForm', $userData)->with('formaction','/user/profile');
    }

    
    public function store(Request $request)
    {
        $inputData = $request->all();
		$updateData = $inputData;
		
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
		$updateData = array_filter($updateData);
		User::where('_id',Auth::user()->_id)->update($updateData);
		echo json_encode($returnmessage);
    }
	
	public function redirectUrl($url)
	{
		return redirect(user_role().'/'.$url)->with('flash-message',$_GET['message']);
	}

	
	
}












