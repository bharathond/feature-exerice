<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductModel;
use App\Models\ProductSpecialModel;

class IndexController extends Controller
{
    //

    public function index(){
        $product = DB::table('product')->get();
        return view('index')->with('product', $product);
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        try
        {
            $product = new ProductModel;
            $product->name = $request->input('itemName');
            $product->price = $request->input('price');
            $product->save();

            return redirect()->to('home');
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
            return redirect()->to('home')->withErrors(new \Illuminate\Support\MessageBag(['catch_exception'=>$e->getMessage()]));
        }
    }

    public function splcreate(){
        $product = DB::table('product')->get();
        return view('createsplitem')->with('product', $product);
    }

    public function splstore(Request $request){
        try
        {
            $product = new ProductSpecialModel;
            $product->item_id = $request->input('itemId');
            $product->special_qty = $request->input('splQty');
            $product->special_price = $request->input('splPrice');
            $product->save();
            return redirect()->to('home');
        }
        catch(\Exception $e)
        {
            return redirect()->to('home')->withErrors(new \Illuminate\Support\MessageBag(['catch_exception'=>$e->getMessage()]));
        }
    }

    public function cart(Request $request){
        $data = $request->all();
        $returnHTML = '';
        if(!empty($data['cart'])){
            foreach($data['cart'] as $key => $cart){
                $ids[] = $cart['model_id']; 
            }
            $product = DB::table('product')->whereIn('id' , $ids)->get();
            $returnHTML = view('cart')->with(['product' => $product,'cart' => $data['cart']])->render();
        }
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}
