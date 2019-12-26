<?php

namespace App\Http\Controllers;
use App\User;
use App\Auth;
use App\Post;
use DB;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getpost()
    {
        // return view('admin/NewsDeal/viewnewsdeal');
		// where('role_id','5df911375da0ec64270ee1d2')->
		// $userrecord = User::get();
		echo '<pre>';
		print_r(strval(my_role(3)));
		die;
    }

    public function createPost()
    {
			// echo delete_file('adasbuhbhb');
			// echo delete_file('assets/userimages/LoginController.php');
            // $inputData = array('user_id'=>'5db0a2b253df8c2254003922','title'=>'pb official','discription'=>'best song for ever');
            // Post::insert($inputData);
            // echo '<pre>';
            // print_r($inputData);
    }
}
