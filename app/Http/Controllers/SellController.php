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
        // $sell = Sell::where('state', 1)->orderBy('registration_date', 'desc')->get();
        // return $sell;
        $sales = DB::select('SELECT sel.sell_id, usu.id, usu.name, usu.lastname, sel.total_price, sel.subtotal_price, sel.tax, sel.discount, sel.date, sel.state, sed.sells_description_id, sed.price as item_price, sed.amount,  
                                    pro.product_id, pro.name as product_name, pro.purchase_price, ser.service_id, ser.name as service_name
                            FROM sells sel 
                            INNER JOIN sells_description sed ON sells_sell_id = sell_id
                            LEFT JOIN users usu ON id = sel.users_user_id
                            LEFT JOIN products pro ON product_id = sed.products_product_id
                            LEFT JOIN services ser ON service_id = sed.services_service_id
                            ORDER BY sel.sell_id DESC');
        //  $sales = DB::table('sells')->get();
        return $sales;
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
        // Crea y guarda la venta
        $sell = new Sell;
        $sell->sell_id = $request->sell_id;
        $sell->total_price = $request->total_price;
        $sell->subtotal_price = $request->subtotal_price;
        $sell->tax = $request->tax;
        $sell->discount = $request->discount;
        $sell->date = $request->date;
        $sell->state = $request->state;
        $sell->users_user_id = $request->users_user_id;
        $sell->clients_client_id = $request->clients_client_id;
        $sell->save();

        //Obtiene el Id de la venta recién creada
        $sellId = DB::table('sells')->where('sell_id', DB::raw("(select max(`sell_id`) from sells)"))->get();

        //Recorre el array recibido que contiene los productos de esa venta y los va insertando
        foreach ($request->sellContent as $item) {

            //Agrega el producto como parte de cierta venta
            $sellD = new SellsDescription();
            $sellD->amount = $item['amount'];
            $sellD->price = $item['sale_price'];
            $sellD->sells_sell_id = $sellId[0]->sell_id;

            //Esto no
            if ($item['type'] == 1) {
                $sellD->products_product_id = $item['id'];
            } else if ($item['type'] == 2) {
                $sellD->services_service_id = $item['id'];
            }

            $sellD->save(); //Lo guarda

            //Esto no
            //Actualiza el inventario
            $data = array();
            $data['stock'] = $item['stock'] - $item['amount'];

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
