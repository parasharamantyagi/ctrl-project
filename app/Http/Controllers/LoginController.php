<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
		return view('admin/Login/login');
    }
	
    public function store(Request $request)
    {
        $input = $request->all();
		$credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            // return response()->json([
                // 'message' => 'Unauthorized'
            // ], 401);
			return redirect('/admin')->withErrors(['Invalid email or password']);
		return redirect('/'.Auth::user()->role->roll.'/dashboard');
    }
	
	
}
