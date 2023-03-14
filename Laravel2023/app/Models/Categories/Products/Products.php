<?php

namespace App\Models\Categories\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    public function getAllProducts(){
        $products = DB::select('SELECT * from '.$this->table.' ORDER BY create_at DESC');

        return $products;

    }
}
