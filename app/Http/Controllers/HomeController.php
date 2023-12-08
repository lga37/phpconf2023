<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $products = Product::inRandomOrder()->take(15)->get();


        return view('home',compact('products'));
    }


    public function list(Category $category){
        $products = $category->products()->paginate(10);


        return view('home',compact('products'));
    }

    public function search(Request $request){
        $q = $request->get('q');

        $products = Product::where('name','LIKE',"%$q%")
        ->when(is_numeric($q),function($query) use($q){
            $id = (int) $q;
            return $query->orWhere('id',$id);
        })
        #->toSql()
        ->paginate(10)
        ;

        return view('home',compact('products'));
    }



}
