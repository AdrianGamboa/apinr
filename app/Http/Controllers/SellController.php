<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\SellsDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $sell = Sell::all();
        $sell = Sell::where('state', 1)->orderBy('registration_date', 'desc')->get();
        return $sell;

        // $selles = DB::table('tcr_selles')->get();
        // return $selles;
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
        $sell = new Sell;
        $sell->sell_id = $request->sell_id;
        $sell->total_price = $request->total_price;
        $sell->discount = $request->discount;
        $sell->date = $request->date;
        $sell->state = $request->state;
        $sell->users_user_id = $request->users_user_id;
        $sell->clients_client_id = $request->clients_client_id;
        $sell->save();

        $sellId = DB::table('sells')->where('sell_id', DB::raw("(select max(`sell_id`) from sells)"))->get();

        foreach ($request->sellContent as $item) {

            //Agrega el producto como parte de cierta venta
            $sellD = new SellsDescription();
            $sellD->amount = $item['amount'];
            $sellD->price = $item['sale_price'];
            $sellD->sells_sell_id = $sellId[0]->sell_id;

            // if (es producto) {
            //     $sellD->products_product_id = $item['id']; 
            // }
            // else if(es servicio) {
            //     $sellD->services_service_id = $item['id'];
            // }

            $sellD->products_product_id = $item['id']; 
            $sellD->save();

            //Actualiza el inventario
            $data = array();
            $data['stock'] = $item['stock']-$item['amount'];

            if ($data['stock'] <= 0) {
                $data['state']  = false;
            }

            DB::table('products')->where('product_id', $item['id'])->update($data);
        }

        return response()->json(['data' => '200']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $sell = DB::table('tcr_selles')->where('idPropiedad', $id)->first();
        // return response()->json($sell);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function edit(Sell $sell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = array();

        // $data['sell_id'] = $request->sell_id;
        $data['name'] = $request->name;
        $data['purchase_price'] = $request->purchase_price;
        $data['sale_price'] = $request->sale_price;
        $data['stock'] = $request->stock;
        $data['description'] = $request->description;

        if ($request->stock <= 0) {
            $data['state']  = false;
        }

        DB::table('sells')->where('sell_id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('sells')->where('sell_id', $id)->delete();
    }
}
