<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin_Users;

class Admin_UsersController extends Controller
{
    private $ad_users;
    public function __construct(){

        $this -> ad_users = new Admin_Users();

    }
    public function index(){
        $title = "Danh sách người dùng";

        $ad_usersList = $this -> ad_users->getAllUsers();

        return view('clients.adminclient.users.list', compact('title', 'ad_usersList'));
    }

    public function addUser(){
        $title = 'Thêm người dùng';

        return view('clients.adminclient.users.add', compact('title'));
    }

    public function postaddUser(Request $request){
        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ],[
            'fullname.required' => 'Chưa nhập họ tên',
            'fullname.min' => 'Họ và tên phải lớn hơn :min kí tự',
            'email.required' => 'Chưa nhập Email',
            'email.email' => 'Không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải từ :min kí tự trở lên'
        ]);
        $dataUserInsert = [
            $request->fullname,
            $request->email,
            $request->password,
            date('Y-m-d H:i:s')
        ];
        $this->ad_users->addAd_User($dataUserInsert);

        return redirect()-> route('admin.users.index')->with('msg', 'Thêm người dùng thành công');
    }
    
    public function editUser(Request $request, $id=0){
        
        $title = "Cập nhật người dùng";

        if(!empty($id)){
            $ad_userDetail = $this->ad_users->getDetailUser($id);
            if(!empty($ad_userDetail[0])){
                $request->session()->put('id',$id);
                $ad_userDetail = $ad_userDetail[0];
            }else{
                return redirect()->route('admin.users.index')->with('msg', 'Người dùng không tồn tại');
            }
            
        }else{
            return redirect()->route('admin.users.index')->with('msg', 'Liên kết không tồn tại');
        }

        return view('clients.adminclient.users.edit', compact('title', 'ad_userDetail'));
    }

    public function updateUser(Request $request){
        $id = session('id');

        if(empty($id)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }

        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users,email,'.$id
        ],[
            'fullname.required' => 'Chưa nhập họ tên',
            'fullname.min' => 'Họ và tên phải lớn hơn :min kí tự',
            'email.required' => 'Chưa nhập Email',
            'email.email' => 'Không đúng định dạng',
            'email.unique' => 'Email đã tồn tại'
        ]);

        $dataUpdate = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->ad_users->updateUser($dataUpdate, $id);

        return back()->with('msg','Cập nhật người dùng thành công');
    }

    public function deleteUser($id = 0){

        if(!empty($id)){
            $ad_userDetail = $this->ad_users->getDetailUser($id);
            if(!empty($ad_userDetail[0])){
                
                $deleteStatus = $this->ad_users->deleteUser($id);
                if($deleteStatus){
                    $msg = 'Xoá người dùng thành công!';
                }else{
                    $msg = 'Bạn không thể xoá người dùng lúc này. Vui lòng thử lại sau!';
                }

            }else{
                $msg = 'Người dùng không tồn tại';
            }
            
        }else{
            $msg = 'Liên kết không tồn tại';
            return redirect()->route('admin.user.index')->with('msg', $msg);
        }
        return back()->with('msg',$msg);

    }

}
