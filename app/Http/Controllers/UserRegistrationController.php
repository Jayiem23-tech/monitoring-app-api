<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\User; 
use Illuminate\Http\Request; 

class UserRegistrationController extends Controller
{
    function register(){ 
        $user = new User;
        $user->name = "Sample Manager";
        $user->email = "sample@gmail.com"; 
        $user->password = Str::random();  
        $user->save();
        return User::all();
    }
}
