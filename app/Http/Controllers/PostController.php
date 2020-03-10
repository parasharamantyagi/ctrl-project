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
		pr(get_language('hi'));
      // $userForm = (object)array('id'=>'','name'=>'','email'=>'','phone_no'=>'','image'=>'');
      // $page_info['page_title'] = 'Update User';
      // return view('post')->with('page_info', $page_info)->with('userForm', $userForm)->with('formaction','/user/profile');
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
