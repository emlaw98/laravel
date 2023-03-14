<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    public function getAllNews(){
        $news = DB::select('SELECT * from '.$this->table.' ORDER BY create_at DESC');

        return $news;

    }

    public function addNew($data){
        return DB::insert('INSERT INTO '.$this->table.' (title, content) VALUE (? , ? )', $data);
    }

    public function getNewDetail($id){
        return DB::select('SELECT * FROM '.$this->table.' WHERE id=?', [$id]);
    }

    public function updateNew($data,$id){

        $data[]=$id;

        return DB::update("UPDATE ".$this->table." SET title=?, content=?, update_at=? WHERE id= ?", $data);
    }

    public function deleteNew($id){
        return DB::delete("DELETE FROM ".$this->table." WHERE id=?", [$id]);
    }
}

