<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){

        $data['meta_title']='E-commerce';
        $data['meta_description']='';
        $data['keywords']='';
        return view('home',$data);
    }
}
