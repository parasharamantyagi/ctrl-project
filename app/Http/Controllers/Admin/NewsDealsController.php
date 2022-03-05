<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsDealsController extends Controller
{
    public function index()
    {
		// return view('admin/NewsDeal/viewnewsdeal');
		// $inputData = Auth::user()->toArray();
		// $inputData = my_role();
		// echo '<pre>';
		// print_r($inputData[0]);
		return view('admin/NewsDeal/viewnewsdeal');
    }
}
