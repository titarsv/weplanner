<?php

namespace App\Http\Controllers;

use App\Models\Newpost;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Products;
use App\Models\ProductsCart;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use App\Models\User;
use App\Models\Order;
use Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Обновление продукта в корзине
     *
     * @param Request $request
     * @param Cart $cart
     * @return mixed
     */
    public function updateCart(Request $request, Cart $cart)
    {
        $product_id = $request->product_id;

        $current_cart = $cart->current_cart(true);

        if($request->action == 'add'){
            $product_quantity = $request->quantity ? $request->quantity : 1;
            $current_cart->increment_product_quantity($product_id, $product_quantity);
        }elseif($request->action == 'remove'){
            $current_cart->remove_product($product_id);
        }elseif($request->action == 'update'){
            $product_quantity = $request->quantity ? $request->quantity : 0;
            $current_cart->update_product_quantity($product_id, $product_quantity);
        }

        return $this->getCart();
    }

    /**
     * Корзина пользователя
     *
     * @param bool $json
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function getCart($json = false)
    {
        $cart = new Cart;
        $current_cart = $cart->current_cart();

        if($json){
            return response()->json($current_cart);
        }else
            return view('public.layouts.cart')->with('cart', $current_cart);
    }

    /**
     * Страница оформления заказа
     *
     * @param Cart $cart
     * @return mixed
     */
    public function show(Cart $cart, Newpost $newpost, Order $order, Request $request)
    {
        $user = null;
        
        if (Sentinel::check()) {
            $user = User::find(Sentinel::check()->id);
        }

        if ($request->cookie('current_order_id') !== null){
            $current_order_id = $request->cookie('current_order_id');
        } else {
            $current_order_id = $order->getCurrentIncompleteOrder($user);
        }

        if(!is_null($current_order_id) && $current_order_id) {
            Cookie::queue('current_order_id', $current_order_id);
        }

        return view('public.order', [
            'user'      => $user,
            'current_order_id' => $current_order_id
        ]);
    }

    /**
     * Метод передает корзину юзеру
     * @param $user_id
     * @return array
     */
    public static function cartToUser($user_id)
    {
        $session_cart = Cart::where('session_id', Session::getId())->first();
        $user_cart = Cart::where('user_id', $user_id)->first();

        if(!is_null($session_cart)){
            if(!is_null($user_cart)){
                $products = null;
                $session_cart_products = json_decode($session_cart->products, true);
                $user_cart_products = json_decode($user_cart->products, true);

                if($session_cart_products && $user_cart_products){
                    foreach ($session_cart_products as $product_id => $product_quantity) {
                        $products[$product_id] = $product_quantity;
                    }
                    foreach ($user_cart_products as $product_id => $product_quantity) {
                        if(array_key_exists($product_id, $products)) {
                            $products[$product_id] = $products[$product_id] + $product_quantity;
                        } else {
                            $products[$product_id] = $product_quantity;
                        }
                    }
                } else {
                    if ($session_cart_products && !$user_cart_products){
                        $products = $session_cart_products;
                    } elseif (!$session_cart_products && $user_cart_products) {
                        $products = $user_cart_products;
                    }
                }

                $update = [
                    'total_quantity'    => $session_cart->total_quantity + $user_cart->total_quantity,
                    'total_price'       => $session_cart->total_price + $user_cart->total_price,
                    'products'          => json_encode($products),
                    'session_id'        => Session::getId()
                ];

                $user_cart->update($update);
                $session_cart->delete();
            } else {
                $session_cart->update(['user_id' => $user_id]);
            }
        }
    }
}
