<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Set;
use App\Models\SetProduct;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;

class SetController extends Controller
{

    /**
     * @param Request $request
     * @return Client
     */
    function getSets(){
        return response()->json(Set::get(), 200);
    }

    function getSetById($id){
        return response()->json(Set::where('id', $id), 200);
    }
    function getSetProductsById($id){
        return response()->json(SetProduct::where('id', $id), 200);
    }
}
