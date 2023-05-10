<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * @param Request $request
     * @return Client
     */
    function getProducts(){
        return response()->json(Product::get(), 200);
    }

    function getProductById($id){
        return response()->json(Product::where('id', $id), 200);
    }
}
