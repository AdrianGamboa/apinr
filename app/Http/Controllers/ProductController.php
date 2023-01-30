<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $product = Product::all();
        $product = Product::where('state', 1)->orderBy('registration_date', 'desc')->get();
        return $product;

        // $productes = DB::table('tcr_productes')->get();
        // return $productes;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $product = new Product;
        $product->product_id = $request->product_id;
        $product->name = $request->name;
        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->sale_price;
        $product->stock = $request->stock;
        $product->original_stock = $request->original_stock;
        $product->state = $request->state;
        $product->registration_date = $request->registration_date;
        $product->description = $request->description;
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $product = DB::table('tcr_productes')->where('idPropiedad', $id)->first();
        // return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = array();
        
        // $data['product_id'] = $request->product_id;
        $data['name'] = $request->name;
        $data['purchase_price'] = $request->purchase_price;
        $data['sale_price'] = $request->sale_price;
        $data['stock'] = $request->stock;
        $data['description'] = $request->description;

        if ($request->stock <= 0) {
            $data['state']  = false;
        }

        DB::table('products')->where('product_id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = array();
        $data['state']  = false;
        DB::table('products')->where('product_id', $id)->update($data);
        // DB::table('products')->where('product_id', $id)->delete();
    }
}
