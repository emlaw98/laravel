<?php

namespace App\Http\Controllers;

use App\Models\Categories\Categories;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    private $categories;
    public function __construct(){

        $this -> categories = new Categories();

    }

    public function index () {

        $title = 'Trang quản trị';

        return view('clients.adminclient.admin', compact('title'));
    }

    public function addCategory(){
        $title = 'Thêm danh mục';

        return view('clients.adminclient.add', compact('title'));
    }

    public function postaddCategory(Request $request){
        $request->validate([
            'category' => 'required|min:5',
        ],[
            'category.required' => 'Chưa nhập danh mục',
            'category.min' => 'Danh mục phải từ :min kí tự trở lên',
        ]);
        $dataInsert = [
            $request->category,

        ];

            $this->categories->addCategory($dataInsert);

            return redirect()-> route('admin.index')->with('msg', 'Thêm danh mục thành công.');
    }
}
