<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\Categories;

class CategoriesController extends Controller
{
    private $categories;
    public function __construct(){

        $this -> categories = new Categories();

    }

    public function index(){
        $title = "Danh sách danh mục";

        $categoryList = $this -> categories->getAllCategories();

        return view('clients.adminclient.categories.list', compact('title', 'categoryList'));
    }

    public function addCategory(){
        $title = 'Thêm danh mục';

        return view('clients.adminclient.categories.add', compact('title'));
    }

    public function postaddCategory(Request $request){
        $request->validate([
            'category' => 'required|min:5|unique:categories',
        ],[
            'category.required' => 'Chưa nhập danh mục',
            'category.min' => 'Danh mục phải từ :min kí tự trở lên',
            'category.unique' => 'Danh mục đã tồn tại',
        ]);
        $dataInsert = [
            $request->category,

        ];

            $this->categories->addCategory($dataInsert);

            return redirect()-> route('admin.categories.index')->with('msg', 'Thêm danh mục thành công.');
    }

    public function getEdit(Request $request, $id=0){


        
        $title = "Cập nhật danh mục";

        if(!empty($id)){
            $categoryDetail = $this->categories->getDetail($id);
            if(!empty($categoryDetail[0])){
                $request->session()->put('id',$id);
                $categoryDetail = $categoryDetail[0];
            }else{
                return redirect()->route('admin.categories.index')->with('msg', 'Danh mục không tồn tại');
            }
            
        }else{
            return redirect()->route('admin.categories.index')->with('msg', 'Liên kết không tồn tại');
        }

        return view('clients.adminclient.categories.edit', compact('title', 'categoryDetail'));
    }

    public function postEdit(Request $request){
        $id = session('id');

        if(empty($id)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }

        $request->validate([
            'category' => 'required|min:5|unique:categories,category,'.$id
        ],[
            'category.required' => 'Chưa nhập danh mục',
            'category.min' => 'Danh mục phải từ :min kí tự trở lên',
            'category.unique' => 'Danh mục đã tồn tại',
        ]);

        $dataUpdate = [
            $request->category,
            date('Y-m-d H:i:s')
        ];
        $this->categories->updateCategory($dataUpdate, $id);

        return back()->with('msg','Cập nhật danh mục thành công');
    }

    public function delete($id = 0){

        if(!empty($id)){
            $categoryDetail = $this->categories->getDetail($id);
            if(!empty($categoryDetail[0])){
                
                $deleteStatus = $this->categories->deleteCategory($id);
                if($deleteStatus){
                    $msg = 'Xoá danh mục thành công!';
                }else{
                    $msg = 'Bạn không thể xoá danh mục lúc này. Vui lòng thử lại sau!';
                }

            }else{
                $msg = 'Danh mục không tồn tại';
            }
            
        }else{
            $msg = 'Liên kết không tồn tại';
            return redirect()->route('admin.categories.index')->with('msg', $msg);
        }
        return back()->with('msg',$msg);

    }

    
}
