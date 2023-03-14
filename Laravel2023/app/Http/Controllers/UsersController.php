<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Users;

class UsersController extends Controller
{
    private $users;
    public function __construct(){

        $this -> users = new Users();

    }
    public function register(){
        $title = 'Đăng kí tài khoản';

        return view('clients.users.register', compact('title'));
    }

    public function postRegister(Request $request){

        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'cfpassword' => 'same:password',
        ],[
            'fullname.required' => 'Chưa nhập họ tên',
            'fullname.min' => 'Họ và tên phải từ :min kí tự trở lên',
            'email.required' => 'Chưa nhập Email',
            'email.email' => 'Không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải từ :min kí tự trở lên',
            'cfpassword.same' => 'Mật khẩu không khớp',
        ]);
        $dataInsert = [
            $request->fullname,
            $request->email,
            $request->password,

        ];

            $this->users->registerUser($dataInsert);

            return redirect()-> route('homeuser')->with('msg', 'Đăng kí thành công.');
        
    }

    public function login(){
        $title = 'Đăng nhập';

        return view('clients.users.login', compact('title'));
    }

    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Chưa nhập Email',
            'password.required' => 'Chưa nhập mật khẩu',
        ]);
        $dataCheck = [
            $request->fullname,
            $request->email,
            $request->password,

        ];
        $email = $request->input('email');
		$password = $request->input('password');
        
        $usersList = $this -> users->getAllUsers();

        $this->users->registerUser($dataCheck);

        return redirect()-> route('clients.home')->with('msg', 'Đăng nhập thành công.');
    }
}
