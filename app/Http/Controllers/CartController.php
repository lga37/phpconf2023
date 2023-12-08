<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Checkout;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(){

        return view('cart');
    }

    public function add(Product $prod){
        $cart = session()->get('cart');
        $prod->qty = 1;
        $cart[$prod->id]=$prod;
        session(['cart'=>$cart]);

        return view('cart');
    }

    public function incr(Product $prod){
        $cart = session()->get('cart');
        $cart[$prod->id]->qty++;
        session(['cart'=>$cart]);
        return view('cart');
    }

    public function del(Product $prod){
        $cart = session()->get('cart');
        $id = $prod->id;
        if(array_key_exists($id,$cart)){
            unset($cart[$id]);
            session(['cart'=>$cart]);
            #session()->flash('success', "prod $id excluido flashhh");
            return view('cart');
        } else {
            return view('cart');
        }

    }

    public function clear(){
        session()->forget('cart');

        return view('cart');
    }

    public function checkout(){

        if(!auth()->check()){
            return 'deve logar';
        }
        $cart = session()->get('cart');

        $array = array_map(function($product){
            return $product->toArray();
        },$cart);

        $products = json_encode($array);
        #$products = $array;
        $user_id = auth()->id();
        $dados = compact('products','user_id');
        $checkout = Checkout::create($dados);

        #dd($checkout);

        session()->forget('cart');
        session()->flash('success', "pedido $checkout->id ok");
        return redirect()->route('dashboard');
    }


}
