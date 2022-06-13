<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $cartID = Cart::where(['created_by' => auth()->user()->id])->get();
        $productId = [];
        foreach ($cartID as $value) {
            array_push($productId, $value['product_id']);
        }

        $cart = Product::with('prodCard')->whereIn('id', $productId)->get();
        $total = 0;
        foreach ($cart as $value) {
            $total = $total + ($value['price']*$value['prodCard']['quantity']);
        }
        return Inertia::render('Cart', ['cart' => $cart,'total' => number_format((float)$total, 2, '.', '')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function store(Request $request)
    {
        $prod_find = Cart::where(['product_id'=>$request->input('product_id')])->first();
        if(!$prod_find){
            $product = new Cart();
            $product->product_id = $request->input('product_id');
            $product->created_by = $request->input('created_by');
            if( $product->save()){
                return Inertia::render('dashboard');
            }
        }
        return Inertia::render('dashboard');

    }

    public function remove(Request $request)
    {
        $prod_find = Cart::where([
            'product_id'=>$request->input('product_id'),
            'created_by'=>$request->input('created_by')
        ])->first();
        $prod_find->delete();
        return Inertia::render('cart');
    }

    public function add(Request $request)
    {
        $prod_find = Cart::where([
            'product_id'=>$request->input('product_id'),
            'created_by'=>$request->input('created_by'),
        ])->first();
        $prod_find->quantity = $request->input('quantity');
        $prod_find->save();
        return Inertia::render('cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
