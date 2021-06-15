<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->take(10);
        return view("products.main")->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::all();

        return view('products.create',[
            'currencies' => $currencies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "price" => "required|numeric"
        ]);

        Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "manufactured" => $request->manufactured,
            "experation" => $request->experation,
            "currency_id" => $request->currency_id
        ]);

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currencies = Currency::all();
        $product = Product::where('id', $id)->get()->first();
        return view('products.edit',[
            'product' => $product,
            'currencies' => $currencies
        ]);
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
        Product::where('id', $id)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                "manufactured" => $request->manufactured,
                "experation" => $request->experation,
                "currency_id" => $request->currency_id
            ]);

        return redirect("products/$id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)
            ->get()
            ->first();
        $product->delete();
        return redirect('/products');
    }
}
