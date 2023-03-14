<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index () {

        $title = 'Trang quản trị';

        return view('clients.adminclient.admin', compact('title'));
    }

    
}


