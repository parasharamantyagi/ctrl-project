<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;


class MyApiController extends Controller
{
	
	public function getMyPost()
	{
		$inputData = Post::get();
		print_r($inputData->toArray());
	}
	
	public function addMyPost(Request $request)
	{
		$inputData = $request->all();
		$myId = $request->input('id');
		unset($inputData['id']);
		$reault = Post::updateOrCreate(array('_id' => $myId),$inputData);
		pr($reault->toArray());
	}
	
	public function getMyPostSearch(Request $request)
	{
		$reault = Post::where('title',$request->input('title'))->first();
		pr($reault->toArray());
	}
	
	
	
	
}



