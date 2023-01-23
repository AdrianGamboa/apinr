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
        $product = Product::all();
        return $product;

        // $propiedades = DB::table('tcr_propiedades')->get();
        // return $propiedades;
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
        $propiedad = new Product;
        $propiedad->product_id = $request->product_id;
        $propiedad->name = $request->name;
        $propiedad->purchase_price = $request->purchase_price;
        $propiedad->sale_price = $request->sale_price;
        $propiedad->stock = $request->stock;
        $propiedad->original_stock = $request->original_stock;
        $propiedad->state = $request->state;
        $propiedad->registration_date = $request->registration_date;
        $propiedad->description = $request->description;
        $propiedad->save();
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
        // $propiedad = DB::table('tcr_propiedades')->where('idPropiedad', $id)->first();
        // return response()->json($propiedad);
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
        // $data = array();
        // $data['nombre'] = $request->nombre;
        // $data['descripcion'] = $request->descripcion;
        // $data['precio'] = $request->precio;
        // $data['tamanioArea'] = $request->tamanioArea;
        // $data['unidadTamanioArea'] = $request->unidadTamanioArea;
        // $data['terrenoArea'] = $request->terrenoArea;
        // $data['unidadTerrenoArea'] = $request->unidadTerrenoArea;
        // $data['habitaciones'] = $request->habitaciones;
        // $data['dormitorios'] = $request->dormitorios;
        // $data['banios'] = $request->banios;
        // $data['anioConstruccion'] = $request->anioConstruccion;
        // $data['urlVideo'] = $request->urlVideo;
        // $data['direccion'] = $request->direccion;
        // $data['tcr_provincias_idProvincia'] = $request->tcr_provincias_idProvincia;
        // $data['tcr_ciudades_idCiudad'] = $request->tcr_ciudades_idCiudad;
        // $data['tcr_localidades_idLocalidad'] = $request->tcr_localidades_idLocalidad;
        // $data['tcr_tiposPropiedad_idTiposPropiedad'] = $request->tcr_tiposPropiedad_idTiposPropiedad;
        // DB::table('tcr_propiedades')->where('idPropiedad', $id)->update($data);
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
        DB::table('products')->where('product_id', $id)->delete();
    }
}
