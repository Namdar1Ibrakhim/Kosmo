<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\CartProduct;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * @param Request $request
     * @return Client
     */

    public function cart()
    {
        $cart = Cart::select()->where('client_id', Auth::user()->id)->get();
        return response($cart, 200);
    }

    public function mycart()
    {
        $cart = Cart::select('id')->where('client_id', Auth::user()->id)->first()->id;
        $cartProduct = CartProduct::where('cart_id', $cart)->get();
        return response($cartProduct, 200);
    }

    public function addtocart(Request $request)
    {
        $cartid = Cart::select()->where('client_id', Auth::user()->id)->first();
        $set = Product::select()->where('id', $request->product_id)->get();
        $newprice = $cartid->totalprice;

        foreach ($set as $tar) {
            $newprice += (($tar->price) * ($request->quantity));
        }
        DB::update('update carts set totalprice = ? where id = ?', [$newprice, $cartid->id]);

        $cartProduct = CartProduct::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'cart_id' => $cartid->id
        ]);
        return response('Успешно добавлено', 200);

    }

    public function deletecart()
    {
        $cart = Cart::select('id')->where('client_id', Auth::user()->id)->first()->id;
        DB::update('update carts set totalprice = 0 where id = ?', [$cart]);

        $cartProduct = CartProduct::select('id')->where('cart_id', $cart)->get();

        foreach ($cartProduct as $target_result) {
            DB::delete('delete from cart_products where id = ?', [$target_result->id]);
        }
        return response('Success', 200);

    }
}
