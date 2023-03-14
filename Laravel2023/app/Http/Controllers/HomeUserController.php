<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeUserController extends Controller
{
    public function index()
    {
        
        $title ='Trang chủ';


        return view('clients.home',compact('title'));
}
}
