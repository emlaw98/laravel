<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function registerUser($data){
        DB::insert('INSERT INTO '.$this->table.' (fullname, email, password) VALUE (? , ? , ?)', $data);
   }
   public function getAllUsers(){
    $users = DB::select("SELECT * from ".$this->table."");

    return $users;
}
}
