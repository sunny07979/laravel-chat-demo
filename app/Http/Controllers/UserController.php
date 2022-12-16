<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function list(Request $request){
        $users = User::where('id', '!=', Auth::id())->get();
        return $users;
    }
}
