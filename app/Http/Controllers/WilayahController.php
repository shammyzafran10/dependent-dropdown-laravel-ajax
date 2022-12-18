<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kabkota;
use App\Models\Kecamatan;
use App\Models\keldes;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kabupaten($id)
    {
        $kabupaten = kabkota::where('id_provinsi',$id)->get();
        return response()->json($kabupaten);
    }
    public function kecamatan($id)
    {
        $Kecamatan = Kecamatan::where('id_kabkota',$id)->get();
        return response()->json($Kecamatan);
    }
    public function keldes($id)
    {
        $kelurahaan = keldes::where('id_kecamatan',$id)->get();
        return response()->json($kelurahaan);
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
