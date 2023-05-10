<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use App\Models\CartProduct;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orders(){
        $order = new Order;
        $id = Auth::user()->id;
        return response()->json($order->find($id), 200);
    }

    public function makeOrder(){
        $cart = Cart::select()->where('client_id',Auth::user()->id)->first();
        $cartProduct = CartProduct::select()->where('cart_id', $cart->id)->get();

        //Order for my cart
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->total_price = $cart -> totalprice;
        $order->status = 'waiting';
        $order -> save();

        foreach ($cartProduct as $target_result) {
            $orderproduct = new OrderProduct;
            $orderproduct->order_id = $order->id;
            $orderproduct->product_id = $target_result->product_id;
            $orderproduct->quantity = $target_result->quantity;
            $orderproduct -> save();

        }
        DB::update('update carts set totalprice = 0 where id = ?',[$cart->id]);
        $cartProduct = CartProduct::select('id')->where('cart_id', $cart->id)->get();

        foreach ($cartProduct as $target_result) {
            DB::delete('delete from cart_products where id = ?',[$target_result->id]);
        }

        return response('Успешно сделан заказ', 200);

    }
}
