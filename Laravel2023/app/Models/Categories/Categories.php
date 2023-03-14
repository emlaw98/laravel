<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    public function getAllCategories(){
        $categories = DB::select('SELECT * from '.$this->table.' ORDER BY create_at DESC');

        return $categories;

    }
    public function addCategory($data){
        DB::insert('INSERT INTO '.$this->table.' (category) VALUE (?)', $data);
   }

   public function getDetail($id){
    return DB::select('SELECT * FROM '.$this->table.' WHERE id=?', [$id]);
}

public function updateCategory($data,$id){

    $data[]=$id;

    return DB::update("UPDATE ".$this->table." SET category=?, update_at=? WHERE id= ?", $data);
}

public function deleteCategory($id){
    return DB::delete("DELETE FROM ".$this->table." WHERE id=?", [$id]);
}
}
