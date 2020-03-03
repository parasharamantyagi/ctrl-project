<?php

namespace App\Http\Controllers;
use App\User;
use DB;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getpost()
    {

        $users = User::all();
        echo '<pre>';
        print_r($users);
    }
}
