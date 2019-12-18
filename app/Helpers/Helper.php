<?php

use Auth;
use DB;
// namespace App\Helpers; 
if (!function_exists('human_file_size')) {
    function human_file_size($image_name)
    {
		
        return 'images/products/'.$image_name;
 
    }
}
 
if (!function_exists('in_arrayi')) {

    function in_arrayi($needle, $haystack, $strict = false)
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack), $strict);
    }
}


if (!function_exists('url_segment')) {
 
    function url_segment($needle)
    {
        return 'active';
    }
}

if (!function_exists('pr_year')) {
 
    function ctrl_year()
    {
		for($i = date('Y') ; $i >= 2010; $i--){
				$inputData[] = $i;
		   }
        return $inputData;
    }
}

if (!function_exists('api_response')) {
	
	function api_response($status,$message,$data)
    {
        return array("status"=>$status,"message"=>$message,"data"=>$data);
    }
}

if (!function_exists('delete_file')) {
	
	function delete_file($file)
    {
		File::delete(public_path($file));
        return true;
    }
}

if (!function_exists('user_role')) {
	
	function user_role($value = null)
    {
		if(!$value)
			return Auth::user()->role->roll;
		return Auth::user()->role->roll.'/'.$value;
    }
}

if (!function_exists('my_role')) {
	
	function my_role($no = null,$key = null)
    {
		$roles = DB::table('roles')->select('id','roll_id','roll')->get();
		if($no)
		{
			$indexing = (int)$no - 1;
			if(!$key)
				return $roles[$indexing]['_id'];
			return $roles[$indexing]['roll'];
		}else{
			return $roles;
		}
    }
}



if (!function_exists('pr')) {
	
	function pr($value)
    {
		echo '<pre>';
		print_r($value->toArray());
		echo '</pre>';
		die;
    }
}




