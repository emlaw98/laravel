<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin_Users extends Model
{
    use HasFactory;

    protected $table = 'users';

   public function getAllUsers(){
    $ad_users = DB::select("SELECT * from ".$this->table."");

    return $ad_users;
    }

    public function addAd_User($data){
        DB::insert('INSERT INTO '.$this->table.' (fullname, email, password, create_at) VALUES (? , ? , ?, ?)', $data);
   }

   public function getDetailUser($id){
       return DB::select("SELECT * FROM ".$this->table." WHERE id=?", [$id]);
   }

   public function updateUser($data,$id){

       $data[]=$id;

       return DB::update("UPDATE ".$this->table." SET fullname=?, email=?, update_at=? WHERE id= ?", $data);
   }

   public function deleteUser($id){
       return DB::delete("DELETE FROM ".$this->table." WHERE id=?", [$id]);
   }
}
