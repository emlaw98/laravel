<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\Products\Products;

class ProductsController extends Controller
{

    private $products;
    public function __construct(){

        $this -> products = new Products();

    }

    public function index(){
        $title = "Danh sách sản phẩm";

        $ProductList = $this -> products->getAllProducts();

        return view('clients.adminclient.categories.products.listproducts', compact('title','ProductList'));
    }
}
