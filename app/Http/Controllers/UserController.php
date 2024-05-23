<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Dashboard(){
        $data['meta_title']='Dashboard';
        $data['meta_description']='';
        $data['keywords']='';
        return view('user.dashboard',$data);
    }
    public function Orders(){
        $data['meta_title']='Orders';
        $data['meta_description']='';
        $data['keywords']='';
        return view('user.orders',$data);
    }
    public function EditProfile(){
        $data['meta_title']='Edit Profile';
        $data['meta_description']='';
        $data['keywords']='';
        return view('user.edit-profile',$data);
    }
    public function ChangePassword()
    {
        $data['meta_title']='Change Password';
        $data['meta_description']='';
        $data['keywords']='';
        return view('user.change-password',$data);
    }
}
