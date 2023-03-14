<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\News;

class NewsController extends Controller
{
    private $news;
    public function __construct(){

        $this -> news = new News();

    }

    public function index(){
        $title = "Danh sách tin tức";

        $newList = $this -> news->getAllNews();

        return view('clients.adminclient.news.list', compact('title', 'newList'));
    }

    public function addNew(){
        $title = 'Thêm tin tức';

        return view('clients.adminclient.news.add', compact('title'));
    }

    public function postaddNew(Request $request){
        $request->validate([
            'title' => 'required|min:10|unique:news',
            'content' => 'required|min:50',

        ],[
            'title.required' => 'Chưa nhập tiêu đề',
            'title.min' => 'Tiêu đề phải từ :min kí tự trở lên',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'content.required' => 'Chưa nhập nội dung',
            'content.min' => 'Nội dung phải từ :min kí tự trở lên',
        ]);
        $dataInsertNew = [
            $request->title,
            $request->content,

        ];

            $this->news->addNew($dataInsertNew);

            return redirect()-> route('admin.news.index')->with('msg', 'Thêm tin tức thành công.');
    }

    public function editNew(Request $request, $id=0){


        
        $title = "Cập nhật tin tức";

        if(!empty($id)){
            $newDetail = $this->news->getNewDetail($id);
            if(!empty($newDetail[0])){
                $request->session()->put('id',$id);
                $newDetail = $newDetail[0];
            }else{
                return redirect()->route('admin.news.index')->with('msg', 'Tin tức không tồn tại');
            }
            
        }else{
            return redirect()->route('admin.news.index')->with('msg', 'Liên kết không tồn tại');
        }

        return view('clients.adminclient.news.edit', compact('title', 'newDetail'));
    }

    public function updateNew(Request $request){
        $id = session('id');

        if(empty($id)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }

        $request->validate([
            'title' => 'required|min:10|unique:news,title,'.$id,
            'content' => 'required|min:50',
        ],[
            'title.required' => 'Chưa nhập tiêu đề',
            'title.min' => 'Tiêu đề phải từ :min kí tự trở lên',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'content.required' => 'Chưa nhập nội dung',
            'content.min' => 'Nội dung phải từ :min kí tự trở lên',
        ]);

        $dataUpdateNew = [
            $request->title,
            $request->content,
            date('Y-m-d H:i:s')
        ];
        $this->news->updateNew($dataUpdateNew, $id);

        return back()->with('msg','Cập nhật tin tức thành công');
    }

    public function deleteNew($id = 0){

        if(!empty($id)){
            $newDetail = $this->news->getNewDetail($id);
            if(!empty($newDetail[0])){
                
                $deleteStatus = $this->news->deleteNew($id);
                if($deleteStatus){
                    $msg = 'Xoá tin tức thành công!';
                }else{
                    $msg = 'Bạn không thể xoá tin tức lúc này. Vui lòng thử lại sau!';
                }

            }else{
                $msg = 'Tin tức không tồn tại';
            }
            
        }else{
            $msg = 'Liên kết không tồn tại';
            return redirect()->route('admin.news.index')->with('msg', $msg);
        }
        return back()->with('msg',$msg);

    }
}
