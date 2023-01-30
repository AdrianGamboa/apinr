<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $service = Service::all();
        $service = Service::where('state', 1)->orderBy('registration_date', 'desc')->get();
        return $service;

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
        $service = new Service;
        $service->service_id = $request->service_id;
        $service->name = $request->name;
        $service->price = $request->price;
        $service->state = $request->state;
        $service->registration_date = $request->registration_date;
        $service->description = $request->description;
        $service->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $service = DB::table('tcr_productes')->where('idPropiedad', $id)->first();
        // return response()->json($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = array();
    
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['description'] = $request->description;

        DB::table('services')->where('service_id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = array();
        $data['state']  = false;
        DB::table('services')->where('service_id', $id)->update($data);
        // DB::table('products')->where('product_id', $id)->delete();
    }
}
